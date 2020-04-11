<template>
    <div>
        <div class="card">
            <div class="row p-3">
                <div class="col-md-12">
                    <h5>Write Reviews</h5>
                        <div v-if="is_logged">
                            <form @submit.prevent="post_comment()">
                                <p><star-rating v-model="review.rate"
                                                v-bind:fixed-points="1"
                                                v-bind:rating="0"
                                                v-bind:increment="0.3"
                                                v-bind:max-rating="5"
                                                border-color="#33373a"
                                                inactive-color="#dcdcdc"
                                                active-color="#f9c132"
                                                v-bind:star-size="25"
                                    ></star-rating></p>
                                <div class="input-group input-group-sm">
                                    <input type="text" v-validate="'required|min:1|max:255|'" v-model="review.comment" class="form-control" name="comment" data-vv-scope="valid_comment_form">
                                    <span class="input-group-append">
                                        <button type="submit" class="btn btn-danger btn-flat btn-lg" placeholder="Write your comment">Post</button>
                                    </span>
                                    <div class="valid-feedback"></div>
                                    <div v-if="errors.has('valid_comment_form.comment')" class="invalid-feedback">
                                        <span v-for="error in errors.collect('valid_comment_form.comment')">{{ error }}</span>
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
        <!-- Comment View -->
        <div class="card p-3">
            <div class="row">
                <h5 class="text-dark">Reviews<span class="text-muted ml-2" style="font-size:14px">({{total_comments}})</span></h5>
                <div v-if="comments_lazy_load">
                    <loading :active.sync="comments_lazy_load"></loading>
                </div>
                    <div class="col-md-12 p-3" v-for="(comments,index) in comments">
                        <div class="media animated fadeIn duration-1s">
                        <img class="mr-2 img-circle" :src="comments.avatar" alt="Generic placeholder image" style="height:50px;width:50px">
                        <div class="media-body">
                            <h6 class="mt-0">{{comments.name}}
                                <small>
                                <span  v-bind:class="comments.rate_color" class="p-1 rounded"><i class="fas fa-star pr-1"></i>{{comments.rate}}</span>
                                </small>
                                </h6>
                            <p class="text-muted" style="font-size:12px"><timeago :datetime="comments.created_at" /></p>
                            <p class="text-muted">{{comments.comment}}</p>
                        </div>
                        </div>
                    </div>
                <div class="col-md-12 text-center" v-if="load_more_button">
                    <button @click="load_comments()" class="btn btn-danger btn-sm">Load more</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
// initialize with defaults
import { Validator } from 'vee-validate';
export default {
    props:['restaurant','rating'],
    data(){
        return{
            value:'',
            // Restaurant id
            rest_id:this.restaurant,
            // Start rating
            // rating: 0,
            // user: localStorage.getItem('user'),
            // Post comment
            review:{
                restaurant_basic_info_id:this.restaurant,
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
            load_more_button : true,
            total_comments:0,
            comments_lazy_load:false,
            /**
             * Check Login status
             *  */ 
            is_logged:false,
        }
    },
    /**
     * Methods
     *  */ 
    methods:{
        comment(){
            /**
             * 
             * Comments
             * API 
             * Comments
             *  */ 
            axios.get('/api/restaurant_comments/comment/'+this.rest_id).then(response=>{
                this.comments = response.data.data;
                this.total_comments = response.data.total;
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
         * 
         * Load Comments
         * Pagination
         *  */
        load_comments(nextPage){
            axios.get('/api/restaurant_comments/comment/'+this.rest_id+'/?page='+this.nextPage).then(response=>{
                if(response.data.current_page <= response.data.last_page){
                    this.nextPage = response.data.current_page + 1;
                    this.load_more_button = true; 
                    // this.comments = response.data.data;
                    /**
                     * Comments 
                     * data Distribution
                     *  */  
                    this.comments = [
                        ...this.comments,
                        ...response.data.data
                    ];
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
                    // for (let index = 0; index < this.comments.length; index++) {
                    //     if(this.comments[index].rate >= 0.0 && this.comments[index].rate <= 3.5){
                    //         this.comments[index].rate_color = 'bg-danger';
                    //     }else if(this.comments[index].rate >= 3.6 && this.comments[index].rate <= 5.5 ){
                    //         this.comments[index].rate_color = 'bg-warning';
                    //     }else if(this.comments[index].rate >= 5.6 && this.comments[index].rate <= 7.0 ){
                    //         this.comments[index].rate_color = 'bg-info';
                    //     }else if(this.comments[index].rate >= 7.1 && this.comments[index].rate <= 10.0 ){
                    //         this.comments[index].rate_color = 'bg-success';
                    //     }else{
                    //         this.comments[index].rate_color = 'bg-secondary';
                    //     }
                    // }
                    
                }else{
                    this.load_more_button = false;
                }
            })
        },
        /**
         * Post Comment
         *  */ 
        post_comment($id){
            /* Valid for post */
            this.$validator.validateAll('valid_comment_form').then((result) => {
                if(result){
                    axios.post('/api/restaurant_comments',this.review,{
                        headers : { Authorization : localStorage.getItem("token")}
                    }).then(response=>{
                        // this.review.comment = '';
                        // this.review.rate ='';
                        // refresh comment
                        this.comment();
                        // Reset form
                        // this.review = [];
                        toast.fire({
                            icon:'success',
                            title:'Comment Posted',
                        });
                    })
                }
            })
        }
    },
    mounted(){
        // Comments load
        this.comment();
            axios.get('/login_status').then(response => {
                if(response.data.status === true){
                    this.is_logged = true
                }
            })
    }
}
</script>