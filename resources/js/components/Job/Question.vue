<template>
    <div>
        <div class="card my-2">
            <div class="row p-3">
                <div class="col-md-12">
                    <h6 class="text-muted">Ask Questions?</h6>
                        <div v-if="is_logged">
                            <form @submit.prevent="post_question(id)" data-vv-scope="job_valid_question_form">
                                <div class="input-group input-group-sm">
                                    <input type="text" v-validate="'required|min:1|max:5000'" v-model="question.question" class="form-control" name="question" placeholder="Ask your Questions here !!!">
                                    <span class="input-group-append">
                                        <button type="submit" class="btn btn-danger btn-flat btn-lg" placeholder="Write your Question">Post</button>
                                    </span>
                                    <div class="valid-feedback"></div>
                                    <div v-if="errors.has('job_valid_question_form.question')" class="invalid-feedback">
                                        <span v-for="error in errors.collect('job_valid_question_form.question')">{{ error }}</span>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div v-else>
                            <p class="pt-3 text-muted">Please login to leave Questions.</p>
                            <p><a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#login">Login </a></p>
                        </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="row p-2">
                <div class="col-12">
                    <h5 class="text-dark">Questions<span class="text-muted ml-2 small">({{total_questions}})</span></h5>
                </div>
            </div>
        </div>
       <!-- Comment View -->
        <!-- <div class="card p-3"> -->
            <div class="card my-2" v-for="(question,index) in questions">
                <div class="row p-3">
                    <div class="col-md-12">
                        <div class="media animated fadeIn duration-1s">
                        <img class="mr-2 rounded-circle" :src="question.avatar" alt="Generic placeholder image" style="height:50px;width:50px">
                        <div class="media-body border-0">
                            <h6 class="mt-0">{{question.name}} 
                                <small class="text-muted">
                                <timeago :datetime="question.created_at" />
                                    <span v-if="question.user_id === user_id" class="p-2">
                                        <span class="btn btn-sm btn-danger" @click="destory(question.id,index)"><i class="fas fa-trash-alt"></i></span>
                                    </span>
                                </small>
                            </h6>
                            <p class="text-muted small">{{question.question}}</p>
                            <replies :id="question.id" :login_status="is_logged"></replies>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <div class="row">
            <div class="col-md-12 text-center" v-if="load_more_button">
                <button @click="load_more_questions()" class="btn btn-danger btn-sm">Load more</button>
            </div>
        </div>
        <!-- </div> -->
    </div>
</template>
<script>
import Replies from './Reply.vue'
export default {
    props:['job_uuid'],
    data(){
        return{
            id:'',
            // User Id
            user_id:localStorage.getItem('user_id'),
            update_question:{},
            /**
             * Review 
             * Comments
             * Object
             *  */ 
            question:{
                job_basic_info_id:this.job_uuid,
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
            queries:{
                data:[]
            },
            // replies:{},
            nextPage:2,
            load_more_button : false,
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
        axios.get('/api/job/'+this.job_uuid+'/questions')
            .then(response=>{ 
                this.questions = response.data.data;
                this.total_questions = response.data.total;
                if(response.data.total > response.data.per_page){
                    this.load_more_button = true;
                }
            })
        },
        /**
         * Load More
         * Comments 
         *  */ 
        load_more_questions(nextPage){
            axios.get('/api/job/'+this.job_uuid+'/questions/?page='+this.nextPage)
            .then(response=>{
                if(response.data.current_page <= response.data.last_page){
                    this.nextPage = response.data.current_page + 1;
                    // Load more hide
                    if(response.data.current_page ===response.data.last_page){
                        this.load_more_button = false
                    }
                    // this.questions = response.data.data;
                    /**
                     * Comments 
                     * data Distribution
                     *  */  
                    this.questions = [
                        ...this.questions,
                        ...response.data.data
                    ];                    
                }
            })
        },
        /**
         * Post Comment
         *  */ 
        post_question(id){
            /* Valid for post */
            this.$validator.validateAll('job_valid_question_form').then((result) => {
                if(result){
                    axios.post('/api/job_question',this.question,{
                    headers : { Authorization : localStorage.getItem("token")}
                    }).then(response=>{
                        this.load_questions();
                        location.reload();
                        toast.fire({
                            icon:'success',
                            title:'Comment Posted',
                        });
                    })
                }
            })
        },
        /**
        Delete Review
         */  
         destory(id,index){
            let confirmBox = confirm('Are you sure want to Delete!!!');
            if(confirmBox == true){
                axios.delete('/api/job_question/'+id,{
                    headers : { Authorization : localStorage.getItem("token")}
                }).then(response=>{
                    //  Flash Message  
                    toast.fire({
                        icon:'success',
                        title:'Successfully Deleted',
                    });
                    this.load_questions();
                    this.$delete(this.questions,index);
                })
            }
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