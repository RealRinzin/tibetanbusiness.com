<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-md table-striped table-hover ">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">S.No</th>
                    <th scope="col">Profile</th>
                    <th scope="col">Name</th>
                    <th scope="col">Questions</th>
                    <th scope="col">View</th>
                    <th scope="col">Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(question,index) in questions">
                        <th scope="row">{{index + 1}}</th>
                        <th scope="row"><img :src="question.avatar" class="img-circle" alt="" style="height:35px;width:35px"></th>
                        <td>{{question.name}}</td>
                        <td>{{question.question | trim}}</td>
                        <td><button class="btn btn-sm btn-primary" @mouseover="view(index,question.id)"><i class="fas fa-eye"></i></button></td>
                        <td><timeago :datetime="question.created_at" /></td>
                    </tr>
                </tbody>
                </table>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="job_question_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="media">
                            <img class="mr-2 img-circle" :src="view_question.avatar" alt="Generic placeholder image" style="height:50px;width:50px">
                            <div class="media-body">
                                <h6 class="mt-0">{{view_question.name}}</h6>
                                <p class="text-muted">{{view_question.question}}</p>
                                    <form @submit.prevent="reply()" data-vv-scope="job_valid_reply_form">
                                        <div class="input-group input-group-sm">
                                            <input type="text" v-validate="'required|min:1|max:255|alpha_spaces'"  class="form-control" name="reply" placeholder="Give your reply here!!!">
                                            <span class="input-group-append">
                                                <button type="submit" class="btn btn-info btn-flat btn-lg" placeholder="Write your Question">Reply</button>
                                            </span>
                                            <div class="valid-feedback"></div>
                                            <div v-if="errors.has('job_valid_reply_form.question')" class="invalid-feedback">
                                                <span v-for="error in errors.collect('job_valid_reply_form.question')">{{ error }}</span>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- <div class="text-center mt-3 p-2" v-if="questions.repliesCount > 0 && replies.next_page_url"> -->
                                    <!-- <div class="text-center mt-3 p-2" v-if="questions.repliesCount > 0"> -->
                                        <!-- {{questions}} -->
                                        <!-- {{view_question.question.id}} -->
                                        <button @click="load_replies(view_question.id)" class="btn btn-secondary btn-sm">Load Replies ({{questions.repliesCount}})</button>
                                    <!-- </div> -->
                                <div class="media mt-3" v-for="reply in replies.data">
                                    <div class="media-body">
                                        <h6 class="mt-0">{{reply.name}}</h6>
                                        <p class="text-muted">{{reply.question}}</p>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props:['questions'],
    data(){
        return{
            view_question:{},
            // question:{}
            modal_status:false,
            replies:{
                data:[],
                // next_page_url:`/api/job/${this.questions.job_basic_info_id}/replies`,
                },
        }
    },
    methods:{
        view(index,question){
            // this.replies= {};
            $("#job_question_modal").modal("show");
            this.modal_status = true;
            this.view_question = this.questions[index];  
            // this.view_reply(this.view_question.id);
            // axios.get(`/api/job/${question}/replies`)
            //     .then(({data})=>{
            //         this.replies = data;
            //         console.log(this.queries);
                    
            //     })
        },
        load_replies(question){
            axios.get('/api/job/'+question+'/replies')
            .then(({data})=>{
                this.replies ={
                    ...data,
                    data:[
                        ...this.replies.data,
                        ...data.data
                    ]
                }
            })
        }
    },
    // Filter
    filters:{
        // Trim or Slice the text
        trim(str){
            return str.slice(0, 50) + "..."
        }
    },
    mounted(){
        if(!this.modal_status){
            this.view_question = {};
            console.log("false");
        }
    }
}
</script>