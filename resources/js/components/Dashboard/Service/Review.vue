<template>
    <div>
       <!-- Questions View -->
        <div class="p-3">
            <div class="row">
                <h5 class="text-dark">Questions<span class="text-muted ml-2" style="font-size:14px">({{total_reviews}})</span></h5>
                <div v-if="reviews_lazy_load">
                    <loading :active.sync="reviews_lazy_load"></loading>
                </div>
                    <div class="col-md-12 p-3 card" v-for="(review,index) in reviews">
                        <div class="media animated fadeIn duration-1s">
                        <img class="mr-2 img-circle" :src="review.avatar" alt="Generic placeholder image" style="height:50px;width:50px">
                            <div class="media-body">
                                <h6 class="mt-0">{{review.name}} <small class="text-muted"><timeago :datetime="review.created_at" /></small></h6>
                                <p class="text-muted">{{review.review}}</p>
                            </div>
                        </div>
                    </div>
                <div class="col-md-12 text-center" v-if="load_more_button">
                    <button @click="load_more_reviews()" class="btn btn-danger btn-sm">Load more</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
// import Replies from './Reply.vue'
export default {
    props:['service'],
    data(){
        return{
            id:this.service.id,
            // reviews:{},
            /**
             * Review 
             * Comments
             * Object
             *  */ 
            // review:{
            //     service_basic_info_id:this.job_id,
            //     review:'',
            //     avatar:localStorage.getItem('user_avatar'),
            //     name:localStorage.getItem('user_name'),
            // },
            /**
             * Comments
             * Current Page 
             * pagination
             * last page
             *  */ 
            reviews:{},
            // replies:{},
            nextPage:2,
            load_more_button : true,
            total_reviews:0,
            reviews_lazy_load:false,
            /**
             * Check Login status
             *  */ 
            is_logged:false,
            // count comment
            count_rate : 0,
            // average_rate:0,
        }
    },
    // Methods
    methods:{
        // load Comments
        load_reviews(){
            axios.get('/api/service/'+this.id+'/reviews')
            .then(response=>{ 
                this.reviews = response.data.data;
                this.total_reviews = response.data.total;
                if(this.total_reviews  == 0){
                    this.load_more_button = false;
                }
            })
        },
        /**
         * Load More
         * Comments 
         *  */ 
        load_more_reviews(nextPage){
            axios.get('/api/service/'+this.id+'/reviews/?page='+this.nextPage)
            .then(response=>{
                if(response.data.current_page <= response.data.last_page){
                    this.nextPage = response.data.current_page + 1;
                    this.load_more_button = true; 
                    // this.reviews = response.data.data;
                    /**
                     * Comments 
                     * data Distribution
                     *  */  
                    this.reviews = [
                        ...this.reviews,
                        ...response.data.data
                    ];                    
                }else{
                    this.load_more_button = false;
                }
            })
        },
        /**
         * Post Comment
         *  */ 
        // reply(id){
        //     /* Valid for post */
        //     this.$validator.validateAll('job_valid_question_form').then((result) => {
        //         if(result){
        //             axios.post('/api/job_question',this.review,{
        //             headers : { Authorization : localStorage.getItem("token")}
        //             }).then(response=>{

        //                 this.load_questions();
        //                 // Reset form
        //                 // this.review = [];
        //                 toast.fire({
        //                     icon:'success',
        //                     title:'Comment Posted',
        //                 });
        //             })
        //         }
        //     })
        // },
    },
    // components
    components:{},
    // Mounted
    mounted(){
        this.load_reviews();
    },
}
</script>