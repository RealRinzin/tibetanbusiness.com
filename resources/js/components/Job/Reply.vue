<template>
    <div>
        <div class="d-flex justify-content-center">
            <div class="text-left w-75">
                <form @submit.prevent="reply()" data-vv-scope="job_valid_reply_form">
                    <div class="input-group input-group-sm">
                        <input type="text" v-validate="'required|min:1|max:255'" v-model="question.reply" class="form-control" name="reply" placeholder="Give your reply here!!!">
                        <span class="input-group-append">
                            <button type="submit" class="btn btn-info btn-flat btn-lg" placeholder="Write you Answer..">Reply</button>
                        </span>
                        <div class="valid-feedback"></div>
                        <div v-if="errors.has('job_valid_reply_form.question')" class="invalid-feedback">
                            <span v-for="error in errors.collect('job_valid_reply_form.question')">{{ error }}</span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="media mt-3" v-for="(reply,index) in replies.data">
            <a class="pr-3" href="#">
                <img class="mr-2 img-circle" src="https://graph.facebook.com/v3.3/2656023347975235/picture?type=normal" alt="Generic placeholder image" style="height:50px;width:50px">
            </a>
            <div class="media-body border-0">
                <h6 class="mt-0">{{reply.name}} 
                    <small class="text-muted"><timeago :datetime="reply.created_at" />
                        <span v-if="reply.user_id === user_id" class="p-2">
                            <span class="btn btn-xs btn-secondary" @click="edit(reply.id,index)"><i class="fas fa-pencil-alt "></i></span>
                            <span class="btn btn-xs btn-danger" @click="destory(reply.id,index)"><i class="fas fa-trash-alt"></i></span>
                        </span>
                    </small>
                </h6>
                <p class="text-muted">
                    {{reply.question}}
                </p>
            </div>
        </div>
        <!-- {{questions}} -->
        <div class="text-center mt-3 p-2" v-if="questions.repliesCount > 0 && replies.next_page_url">
            <!-- {{questions}} -->
            <button @click="load_replies" class="btn btn-secondary btn-sm small">Load Replies</button>
        </div>
<!-- Edit Modal -->
<!-- Modal -->
        <div class="modal fade" id="reply" tabindex="-2" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Reply</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form @submit.prevent="review_update()"  data-vv-scope="reply_update">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Reply<span class="text-danger p-1">*</span></label>
                            <!-- <input type="text" v-validate="'required'" v-model="update_reply.question" name="reply" class="form-control" :id="update_reply.id" aria-describedby="emailHelp" placeholder="Reply"> -->
                                <textarea v-validate="'required'" v-model="update_reply.question" name="reply" class="form-control"  aria-describedby="emailHelp" placeholder="Review" rows="4" cols="50">
                                </textarea>
                            <div class="valid-feedback"></div>
                            <div v-if="errors.has('reply_update.reply')" class="invalid-feedback">
                                <span v-for="error in errors.collect('reply_update.reply')">{{ error }}</span>
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
<!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="rinzin" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="rinzin">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
            </div>
        </div>
        </div>
    </div>
    
</template>
<script>
export default {
    props:['questions','load'],
    data(){
        return{
            // User Id
            user_id:localStorage.getItem('user_id'),
            update_reply:{},
            question:{
                job_basic_info_id:this.questions.job_basic_info_id,
                job_question_id:this.questions.id,
                reply:'',
                avatar:localStorage.getItem('user_avatar'),
                name:localStorage.getItem('user_name'),
            },
            replies:{
                data:[],
                next_page_url:`/api/job/${this.questions.id}/replies`,
                },
                
            // nextPage:1,
        }
    },
    // Methods
    methods:{
        load_replies(){
            // axios.get('/api/job/'+this.questions.id+'/replies/?page='+this.nextPage)
            axios.get(this.replies.next_page_url)
            .then(({data})=>{
                this.replies ={
                    ...data,
                    data:[
                        ...this.replies.data,
                        ...data.data
                    ]
                }
            })
        },
        // Reply the question
        reply(){
            /* Valid for post */
            this.$validator.validateAll('job_valid_reply_form').then((result) => {
                if(result){
                    axios.post('/api/job/question/reply',this.question,{
                    headers : { Authorization : localStorage.getItem("token")}
                    }).then(response=>{
                        this.load_replies();
                        toast.fire({
                            icon:'success',
                            title:'Replied',
                        });
                        this.$emit('load');
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
                    // this.load_replies();
                    this.$delete(this.replies.data,index);
                    this.load_replies();
                })
            }
         },
        //  Edit
         edit(id,index){
            $('#reply').appendTo("body").modal('show');
            // this.update_reply.delete()
             this.update_reply = this.replies.data[index];
         },
        //  update
        review_update(){
            this.$validator.validateAll('reply_update').then((result) => {                  
                if(result){
                    axios.patch('/api/job_question/'+this.update_reply.id,this.update_reply,{
                    headers : { Authorization : localStorage.getItem("token")}
                    })
                    .then(response=>{
                        // closing modal
                            $("#reply").modal("hide");  
                            //  Flash Message  
                            toast.fire({
                                icon:'success',
                                title:'Reply Updated!!!',
                            });
                    })
                }
            })
        }

    },
    mounted(){

    }
    
}
</script>