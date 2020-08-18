<template>
    <div>
        <div class="card">
            <div class="row p-3">
                <div class="col-md-12">
                    <h5>Write Reviews</h5>
                        <div v-if="is_logged">
                            <form @submit.prevent="review_post(id)" data-vv-scope="service_valid_review_form">
                                <p><star-rating 
                                                :rating="rating"
                                                v-model="post_review.rate"
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
                                    <input type="text" v-validate="'required|min:1|max:255'" v-model="post_review.review" class="form-control" name="review">
                                    <span class="input-group-append">
                                        <button type="submit" class="btn btn-danger btn-flat btn-lg" placeholder="Write your comment">Post</button>
                                    </span>
                                    <div class="valid-feedback"></div>
                                    <div v-if="errors.has('service_valid_review_form.review')" class="invalid-feedback">
                                        <span v-for="error in errors.collect('service_valid_review_form.review')">{{ error }}</span>
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
        <!-- Show Review -->
        <div class="row">
            <h5 class="text-dark">Reviews<span class="text-muted ml-2" style="font-size:14px">({{total_reviews}})</span></h5>
            <div class="col-md-12 card p-3" v-for="(service,index) in reviews">
                <div class="media animated fadeIn duration-1s">
                <img class="mr-2 img-circle" :src="service.avatar" alt="Generic placeholder image" style="height:50px;width:50px">
                <div class="media-body border-0">
                    <h6 class="mt-0">{{service.name}} 
                        <!-- <small class="text-muted"><timeago :datetime="service.created_at" /></small> -->
                        <small>
                            <span  v-bind:class="service.rate_color" class="p-1 rounded justify-content-start"><i class="fas fa-star pr-1"></i>{{service.rate}}</span>
                            <span v-if="service.user_id === user_id" class="p-2">
                                <span class="btn btn-xs btn-secondary" @click="edit(service.id,index)"><i class="fas fa-pencil-alt "></i></span>
                                <span class="btn btn-xs btn-danger" @click="destory(service.id,index)"><i class="fas fa-trash-alt"></i></span>
                            </span>
                        </small>
                    </h6>
                    <small class="text-muted" style="font-size:12px"><timeago :datetime="service.created_at" /></small>
                    <p class="text-muted">{{service.review}}</p>
                        <replies :id="service.id"></replies>
                    </div>
                </div>
            </div>
            <div class="col-md-12 text-center" v-if="load_more_button">
                <button @click="load_more_reviews()" class="btn btn-danger btn-sm">Load more</button>
            </div>
        </div>
<!-- Edit Modal -->
<!-- Modal -->
        <div class="modal fade" id="service_review_update_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Review</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form @submit.prevent="review_update()"  data-vv-scope="event_update_review">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Review<span class="text-danger p-1">*</span></label>
                                <textarea v-validate="'required'" v-model="update_review.review" name="review" class="form-control" id="review" aria-describedby="emailHelp" placeholder="Review" rows="4" cols="50">
                                </textarea>
                            <div class="valid-feedback"></div>
                            <div v-if="errors.has('event_update_review.review')" class="invalid-feedback">
                                <span v-for="error in errors.collect('event_update_review.review')">{{ error }}</span>
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
import { format, formatDistance, formatRelative, subDays } from 'date-fns';
export default {
    props:['service_id','avg_rating'],
    data(){
        return{
            id:this.service_id,
            reviews:{},
            rating:0,
            update_review:{},
            user_id:localStorage.getItem('user_id'),
            /**
             * Check Login status
             *  */ 
            is_logged:false, //login status check
            events_lazy_load:false, //lazy loading
            post_review:{
                service_basic_info_id:this.service_id,
                rate:'',
                review:'',
                avatar:localStorage.getItem('user_avatar'),
                name:localStorage.getItem('user_name'),
            }, //post review object
            load_more_button : false, //load more button
            total_reviews:0, //total review counts
            nextPage:2, //paginating 


        }
    },
    // methods
    methods:{
        // start
        setRating: function(rating){
        this.rating= rating;
        },
    // Loading
        load_review(){
            var result = format(new Date(2014, 1, 11), 'MM/dd/yyyy');
            axios.get('/api/service/'+this.service_id+'/reviews')
            .then(response=>{
                this.reviews = response.data.data;
                this.total_reviews = response.data.total;
                // load more
                if(response.data.total > response.data.per_page){
                    this.load_more_button = true;
                }
                /**
                 * Rating background
                 * Danger, Warning, Info, Success
                 *  0-3 , 3-5, 5-7 , 7-3
                 *  */ 
                for (let index = 0; index < this.reviews.length; index++) {
                    if(this.reviews[index].rate >= 0.0 && this.reviews[index].rate <= 1.0){
                        this.reviews[index].rate_color = 'bg-danger';
                    }else if(this.reviews[index].rate >= 1.1 && this.reviews[index].rate <= 2.0 ){
                        this.reviews[index].rate_color = 'bg-warning';
                    }else if(this.reviews[index].rate >= 2.1 && this.reviews[index].rate <= 3.0 ){
                        this.reviews[index].rate_color = 'bg-info';
                    }else if(this.reviews[index].rate >= 3.1 && this.reviews[index].rate <= 5.0 ){
                        this.reviews[index].rate_color = 'bg-success';
                    }else{
                        this.reviews[index].rate_color = 'bg-secondary';
                    }
                }

            })
        },
        // Load more reviews
        load_more_reviews(nextPage){
            axios.get('/api/service/'+this.id+'/reviews?page='+this.nextPage)
            .then(response=>{
                this.nextPage = this.nextPage +1;
                    this.reviews = [
                        ...this.reviews,
                        ...response.data.data
                    ];
                    // Load more hide
                    if(response.data.current_page ===response.data.last_page){
                        this.load_more_button = false
                    }
                /**
                 * Rating background
                 * Danger, Warning, Info, Success
                 *  0-3 , 3-5, 5-7 , 7-3
                 *  */ 
                for (let index = 0; index < this.reviews.length; index++) {
                    if(this.reviews[index].rate >= 0.0 && this.reviews[index].rate <= 1.0){
                        this.reviews[index].rate_color = 'bg-danger';
                    }else if(this.reviews[index].rate >= 1.1 && this.reviews[index].rate <= 2.0 ){
                        this.reviews[index].rate_color = 'bg-warning';
                    }else if(this.reviews[index].rate >= 2.1 && this.reviews[index].rate <= 3.0 ){
                        this.reviews[index].rate_color = 'bg-info';
                    }else if(this.reviews[index].rate >= 3.1 && this.reviews[index].rate <= 5.0 ){
                        this.reviews[index].rate_color = 'bg-success';
                    }else{
                        this.reviews[index].rate_color = 'bg-secondary';
                    }
                }

            })
        },
        /**
         * Post Comment
         *  */ 
        review_post(id){
            /* Valid for post */
            if(this.post_review.rate){
                this.$validator.validateAll('service_valid_review_form').then((result) => {
                    if(result){
                        // Calculate rating
                        let calculate_rate =(((this.avg_rating*this.reviews.length) + (this.post_review.rate))/(this.reviews.length+1)).toFixed(1);
                        // Post Review
                        axios.post('/api/service_review',this.post_review,{
                        headers : { Authorization : localStorage.getItem("token")}
                        }).then(response=>{
                            this.load_review();
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
                            url: '/api/service/rating/'+this.id,
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
                axios.delete('/api/service_review/'+id,{
                    headers : { Authorization : localStorage.getItem("token")}
                }).then(response=>{
                    //  Flash Message  
                    toast.fire({
                        icon:'success',
                        title:'Successfully Deleted',
                    });
                    this.load_review();
                    this.$delete(this.reviews,index);
                })
            }
         },
        //  Edit
         edit(id,index){
            $("#service_review_update_modal").modal("show");
             this.update_review = this.reviews[index];
         },
        //  update
        review_update(){
            // console.log(this.update_review);
            this.$validator.validateAll('service_update_review').then((result) => {                  
                if(result){
                    axios.patch('/api/service_review/'+this.update_review.id,this.update_review,{
                    headers : { Authorization : localStorage.getItem("token")}
                    })
                    .then(response=>{
                        // closing modal
                            $("#service_review_update_modal").modal("hide");  
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
    mounted(){
        axios.get('/login_status').then(response => {
            if(response.data.status === true){
                this.is_logged = true
            }
        })
        this.load_review();
    }
}
</script>