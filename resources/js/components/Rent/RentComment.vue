<template>
    <div>
        <div class="card">
            <div class="row p-3">
                <div class="col-md-12">
                    <h5>Write Reviews</h5>
                        <div v-if="is_logged">
                            <form @submit.prevent="post_comment(id)" data-vv-scope="rent_valid_comment_form">
                                <p><star-rating v-model="review.rate"
                                                v-bind:fixed-points="1"
                                                v-bind:increment="0.3"
                                                v-bind:max-rating="5"
                                                border-color="#33373a"
                                                inactive-color="#dcdcdc"
                                                active-color="#f9c132"
                                                v-bind:star-size="25"
                                                @rating-selected ="setRating"
                                    ></star-rating></p>
                                <div class="input-group input-group-sm">
                                    <input type="text" v-validate="'required|min:1|max:255'" v-model="review.comment" class="form-control" name="comment">
                                    <span class="input-group-append">
                                        <button type="submit" class="btn btn-danger btn-flat btn-lg" placeholder="Write your comment">Post</button>
                                    </span>
                                    <div class="valid-feedback"></div>
                                    <div v-if="errors.has('rent_valid_comment_form.comment')" class="invalid-feedback">
                                        <span v-for="error in errors.collect('rent_valid_comment_form.comment')">{{ error }}</span>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div v-else>
                            <p class="pt-3">Please login to leave comment</p>
                            <p><a href="#" class="btn btn-danger btn-md" data-toggle="modal" data-target="#login">Login </a></p>
                        </div>
                </div>
            </div>
        </div>
       <!-- Comments -->
        <div class="row">
            <h5 class="text-dark">Reviews<span class="text-muted ml-2" style="font-size:14px">({{total_comments}})</span></h5>
            <div class="col-md-12 card p-3" v-for="(comment,index) in comments">
                <div class="media animated fadeIn duration-1s">
                <img class="mr-2 img-circle" :src="comment.avatar" alt="Generic placeholder image" style="height:50px;width:50px">
                    <div class="media-body border-0">
                        <h6 class="mt-0">{{comment.name}}
                            <small>
                                <span  v-bind:class="comment.rate_color" class="p-1 rounded"><i class="fas fa-star pr-1"></i>{{comment.rate}}</span>
                                <span v-if="comment.user_id === user_id" class="p-2">
                                    <span class="btn btn-xs btn-secondary" @click="edit(comment.id,index)"><i class="fas fa-pencil-alt "></i></span>
                                    <span class="btn btn-xs btn-danger" @click="destory(comment.id,index)"><i class="fas fa-trash-alt"></i></span>
                                </span>
                            </small>
                            </h6>
                        <p class="text-muted" style="font-size:12px"><timeago :datetime="comment.created_at" /></p>
                        <p class="text-muted">{{comment.comment}}</p>
                        <!-- Comment Replies -->
                        <replies :id="comment.id"></replies>
                    </div>
                </div>
            </div>
            <div class="col-md-12 text-center" v-if="load_more_button">
                <button @click="load_more_comments()" class="btn btn-danger btn-sm">Load more</button>
            </div>
        </div>
<!-- Edit Modal -->
<!-- Modal -->
        <div class="modal fade" id="rent_review_update_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Review</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form @submit.prevent="review_update()"  data-vv-scope="rent_update_review">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Review<span class="text-danger p-1">*</span></label>
                                <textarea v-validate="'required'" v-model="update_review.comment" name="review" class="form-control" id="review" aria-describedby="emailHelp" placeholder="Comments" rows="4" cols="50">
                                </textarea>
                            <div class="valid-feedback"></div>
                            <div v-if="errors.has('rent_update_review.review')" class="invalid-feedback">
                                <span v-for="error in errors.collect('rent_update_review.review')">{{ error }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <button type="button" class="btn btn-secondary w-25" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger btn-md w-25" placeholder="Write your comment">Update</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Replies from './Reply.vue';
export default {
    props:['rent_uuid','avg_rating'],
    data(){
        return{
            id:'',
            rating:0,
            // comments:{},
            // User Id
            user_id:localStorage.getItem('user_id'),
            update_review:{},
            /**
             * Review 
             * Comments
             * Object
             *  */ 
            review:{
                rent_basic_info_id:this.rent_uuid,
                rate:'',
                comment:'',
                avatar:localStorage.getItem('user_avatar'),
                name:localStorage.getItem('user_name'),
            },
            /**
             * Comments
             * Current Page 
             * pagination
             * last page
             *  */ 
            comments:{},
            nextPage:2,
            load_more_button : false,
            total_comments:0,
            comments_lazy_load:false,
            /**
             * Check Login status
             *  */ 
            is_logged:false,
            // count comment
            count_rate : 0,
            average_rate:0,
        }
    },
    // watch
    watch:{
        rent_uuid(data){
            this.id = data
        }
    },
    // Methods
    methods:{
        // start
        setRating: function(rating){
        this.rating= rating;
        },
        // load Comments
        load_comments(){
            axios.get('/api/rent_comments/comment/'+this.rent_uuid)
            .then(response=>{
                this.comments = response.data.data;
                this.total_comments = response.data.total;

                if(response.data.total > response.data.per_page){
                    this.load_more_button = true;
                }
                /**
                 * Rating background
                 * Danger, Warning, Info, Success
                 *  0-3 , 3-5, 5-7 , 7-3
                 *  */ 
                for (let index = 0; index < this.comments.length; index++) {
                    if(this.comments[index].rate >= 0.0 && this.comments[index].rate <= 1.0){
                        this.comments[index].rate_color = 'bg-danger';
                    }else if(this.comments[index].rate >= 1.1 && this.comments[index].rate <= 2.0 ){
                        this.comments[index].rate_color = 'bg-warning';
                    }else if(this.comments[index].rate >= 2.1 && this.comments[index].rate <= 3.0 ){
                        this.comments[index].rate_color = 'bg-info';
                    }else if(this.comments[index].rate >= 3.1 && this.comments[index].rate <= 5.0 ){
                        this.comments[index].rate_color = 'bg-success';
                    }else{
                        this.comments[index].rate_color = 'bg-secondary';
                    }
                }
            })
        },
        /**
         * Load More
         * Comments
         *  */ 
        load_more_comments(nextPage){
            axios.get('/api/rent_comments/comment/'+this.rent_uuid+'/?page='+this.nextPage)
            .then(response=>{
                if(response.data.current_page <= response.data.last_page){
                    this.nextPage = response.data.current_page + 1;
                    // this.comments = response.data.data;
                    /**
                     * Comments 
                     * data Distribution
                     *  */  
                    this.comments = [
                        ...this.comments,
                        ...response.data.data
                    ];
                    // loadmore Button
                    if(response.data.current_page == response.data.last_page){
                        this.load_more_button = false; 
                    }else{
                        this.load_more_button = true; 
                    }
                    /**
                     * Comment 
                     * Load rate background
                     * RGB
                     *  */ 
                    for (let index = 0; index < this.comments.length; index++) {
                        if(this.comments[index].rate >= 0.0 && this.comments[index].rate <= 1.0){
                            this.comments[index].rate_color = 'bg-danger';
                        }else if(this.comments[index].rate >= 1.1 && this.comments[index].rate <= 2.0 ){
                            this.comments[index].rate_color = 'bg-warning';
                        }else if(this.comments[index].rate >= 2.1 && this.comments[index].rate <= 3.0 ){
                            this.comments[index].rate_color = 'bg-info';
                        }else if(this.comments[index].rate >= 3.1 && this.comments[index].rate <= 5.0 ){
                            this.comments[index].rate_color = 'bg-success';
                        }else{
                            this.comments[index].rate_color = 'bg-secondary';
                        }
                    }
                    
                }else{
                    this.load_more_button = false;
                }
            })
        },
        /**
         * Post Comment
         *  */ 
        post_comment(id){
            /* Valid for post */
            if(this.review.rate){
                this.$validator.validateAll('rent_valid_comment_form').then((result) => {
                    if(result){
                    // calculating the rating
                        let calculate_rate =(((this.avg_rating*this.comments.length) + (this.review.rate))/(this.comments.length+1)).toFixed(1);
                        // Post Review
                        axios.post('/api/rent_comments',this.review,{
                        headers : { Authorization : localStorage.getItem("token")}
                        }).then(response=>{
                            this.load_comments();
                            // Reset form
                            // this.review = [];
                            toast.fire({
                                icon:'success',
                                title:'Comment Posted',
                            });
                        /**
                         * 
                         * Update rate
                         *  */ 
                        axios({
                            method: 'patch',
                            url: '/api/rent/rating/'+this.rent_uuid,
                            data: {rate: calculate_rate},
                            headers : { Authorization : localStorage.getItem("token")}
                            }).then(response=>{
                            });
                        })
                    }
                })
            }else{
                alert('Please give your rating ***')
            }
        },
        /**
        Delete Review
         */  
         destory(id,index){
            let confirmBox = confirm('Are you sure want to Delete!!!');
            if(confirmBox == true){
                axios.delete('/api/rent_comments/'+id,{
                    headers : { Authorization : localStorage.getItem("token")}
                }).then(response=>{
                    //  Flash Message  
                    toast.fire({
                        icon:'success',
                        title:'Successfully Deleted',
                    });
                    this.load_comments();
                    this.$delete(this.comments,index);
                })
            }
         },
        //  Edit
         edit(id,index){
            $("#rent_review_update_modal").modal("show");
             this.update_review = this.comments[index];
         },
        //  update
        review_update(){
            this.$validator.validateAll('rent_update_review').then((result) => {                  
                if(result){
                    axios.patch('/api/rent_comments/'+this.update_review.id,this.update_review,{
                    headers : { Authorization : localStorage.getItem("token")}
                    })
                    .then(response=>{
                        // closing modal
                            $("#rent_review_update_modal").modal("hide");  
                            //  Flash Message  
                            toast.fire({
                                icon:'success',
                                title:'Updated',
                            });
                    })
                }
            })
        }
    },
    // Components
    components:{Replies},
    // Mounted
    mounted(){
        this.load_comments();
        // login stauts for comment
        axios.get('/login_status').then(response => {
            if(response.data.status === true){
                this.is_logged = true
            }
        })
    },
}
</script>