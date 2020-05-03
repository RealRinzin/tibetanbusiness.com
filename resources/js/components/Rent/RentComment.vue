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
                                    ></star-rating></p>
                                <div class="input-group input-group-sm">
                                    <input type="text" v-validate="'required|min:1|max:255|alpha_spaces'" v-model="review.comment" class="form-control" name="comment">
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
       <!-- Comment View -->
        <div class="card p-3">
            <div class="row">
                <h5 class="text-dark">Reviews<span class="text-muted ml-2" style="font-size:14px">({{total_comments}})</span></h5>
                <div v-if="comments_lazy_load">
                    <loading :active.sync="comments_lazy_load"></loading>
                </div>
                    <div class="col-md-12 p-3" v-for="(comment,index) in comments">
                        <div class="media animated fadeIn duration-1s">
                        <img class="mr-2 img-circle" :src="comment.avatar" alt="Generic placeholder image" style="height:50px;width:50px">
                        <div class="media-body">
                            <h6 class="mt-0">{{comment.name}}
                                <small>
                                <span  v-bind:class="comment.rate_color" class="p-1 rounded"><i class="fas fa-star pr-1"></i>{{comment.rate}}</span>
                                </small>
                                </h6>
                            <p class="text-muted" style="font-size:12px"><timeago :datetime="comment.created_at" /></p>
                            <p class="text-muted">{{comment.comment}}</p>
                        </div>
                        </div>
                    </div>
                <div class="col-md-12 text-center" v-if="load_more_button">
                    <button @click="load_more_comments()" class="btn btn-danger btn-sm">Load more</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props:['rent_uuid'],
    data(){
        return{
            id:'',
            // comments:{},
            /**
             * Review 
             * Comments
             * Object
             *  */ 
            review:{
                rent_basic_info_id:'5f6fb7045dcb429bbb58c99332da4afa',
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
        // load Comments
        load_comments(){
            axios.get('/api/rent_comments/comment/5f6fb7045dcb429bbb58c99332da4afa')
            .then(response=>{
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
                    /**
                     * 
                     * Update the star rate
                     *  */ 
                    this.count_rate = parseFloat(this.count_rate) + parseFloat(this.comments[index].rate);
                }
                // aggregating rating
                this.average_rate = (this.count_rate / this.total_comments).toFixed(1);
            })
        },
        /**
         * Load More
         * Comments
         *  */ 
        load_more_comments(nextPage){
            axios.get('/api/rent_comments/comment/5f6fb7045dcb429bbb58c99332da4afa/?page='+this.nextPage)
            .then(response=>{
                console.log(response);
                
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
        post_comment(id){
            /* Valid for post */
            if(this.review.rate){
                this.$validator.validateAll('rent_valid_comment_form').then((result) => {
                    if(result){
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
                        })
                    }
                })
            }else{
                alert('Please give your rating ***')
            }
        }
    },
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