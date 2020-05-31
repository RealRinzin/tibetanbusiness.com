<template>
    <div>
       <!-- Questions View -->
        <div class="p-3">
            <div class="row">
                <h5 class="text-dark">Questions<span class="text-muted ml-2" style="font-size:14px">({{total_questions}})</span></h5>
                <div v-if="questions_lazy_load">
                    <loading :active.sync="questions_lazy_load"></loading>
                </div>
                    <div class="col-md-12 p-3 card" v-for="(question,index) in questions">
                        <div class="media animated fadeIn duration-1s">
                        <img class="mr-2 img-circle" :src="question.avatar" alt="Generic placeholder image" style="height:50px;width:50px">
                        <div class="media-body">
                            <h6 class="mt-0">{{question.name}} <small class="text-muted"><timeago :datetime="question.created_at" /></small></h6>
                            <p class="text-muted">{{question.question}}</p>
                            <replies :questions="question"></replies>
                            </div>
                        </div>
                    </div>
                <div class="col-md-12 text-center" v-if="load_more_button">
                    <button @click="load_more_questions()" class="btn btn-danger btn-sm">Load more</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Replies from './Reply.vue'
export default {
    props:['job_id'],
    data(){
        return{
            id:'',
            // questions:{},
            /**
             * Review 
             * Comments
             * Object
             *  */ 
            question:{
                job_basic_info_id:this.job_id,
                question:'',
                avatar:localStorage.getItem('user_avatar'),
                name:localStorage.getItem('user_name'),
            },
            /**
             * Comments
             * Current Page 
             * pagination
             * last page
             *  */ 
            questions:{},
            // replies:{},
            nextPage:2,
            load_more_button : true,
            total_questions:0,
            questions_lazy_load:false,
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
        load_questions(){
            console.log(this.job_id);
            
        axios.get('/api/job/'+this.job_id+'/questions')
            .then(response=>{ 
                this.questions = response.data.data;
                this.total_questions = response.data.total;
                if(this.total_questions  == 0){
                    this.load_more_button = false;
                }
            })
            // Auto
            axios.get(`/api/job/${this.job_id}/questions`)
            .then(({data})=>{
                this.queries = data;
            })
        },
        /**
         * Load More
         * Comments 
         *  */ 
        load_more_questions(nextPage){
            axios.get('/api/job/'+this.job_id+'/questions/?page='+this.nextPage)
            .then(response=>{
                if(response.data.current_page <= response.data.last_page){
                    this.nextPage = response.data.current_page + 1;
                    this.load_more_button = true; 
                    // this.questions = response.data.data;
                    /**
                     * Comments 
                     * data Distribution
                     *  */  
                    this.questions = [
                        ...this.questions,
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
        reply(id){
            /* Valid for post */
            this.$validator.validateAll('job_valid_question_form').then((result) => {
                if(result){
                    axios.post('/api/job_question',this.question,{
                    headers : { Authorization : localStorage.getItem("token")}
                    }).then(response=>{

                        this.load_questions();
                        // Reset form
                        // this.review = [];
                        toast.fire({
                            icon:'success',
                            title:'Comment Posted',
                        });
                    })
                }
            })
        },
    },
    // components
    components:{Replies},
    // Mounted
    mounted(){
        this.load_questions();

        // login stauts for comment
        axios.get('/login_status').then(response => {
            if(response.data.status === true){
                this.is_logged = true
            }
        })
    },
}
</script>