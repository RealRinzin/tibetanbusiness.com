<template>
    <div>
        <div v-if="!login_status">
            <div class="justify-content-start">
                <p class="m-0 text-muted small">Please <a href="#" class="text-danger font-weight-bolder" data-toggle="modal" data-target="#login">Login </a> to  reply</p>
            </div>
        </div>
        <div class="d-flex justify-content-center" v-if="login_status">
            <div class="text-left w-75">
                <form @submit.prevent="reply_comment(id)" data-vv-scope="valid_reply_form">
                    <div class="input-group input-group-sm">
                        <input type="text" v-validate="'required|min:1|max:255'" v-model="create_reply.reply" class="form-control" name="reply" placeholder="Give your reply here!!!">
                        <span class="input-group-append">
                            <button type="submit" class="btn btn-info btn-flat btn-lg" placeholder="Write you Answer..">Reply</button>
                        </span>
                        <div class="valid-feedback"></div>
                        <div v-if="errors.has('valid_reply_form.reply')" class="invalid-feedback">
                            <span v-for="error in errors.collect('valid_reply_form.reply')">{{ error }}</span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="media mt-3" v-for="(reply,index) in replies">
            <a class="pr-3" href="#">
                <img class="mr-2 img-circle" :src="reply.avatar" alt="Generic placeholder image" style="height:50px;width:50px">
            </a>
            <div class="media-body border-0">
                <h6 class="mt-0">{{reply.name}} 
                    <small class="text-muted"><timeago :datetime="reply.created_at" />
                        <span v-if="reply.user_id === user_id" class="p-2">
                            <span class="btn btn-sm btn-secondary" @click="edit(reply.id,index)"><i class="fas fa-pencil-alt "></i></span>
                            <span class="btn btn-sm btn-danger" @click="destory(reply.id)"><i class="fas fa-trash-alt"></i></span>
                        </span>
                    </small>
                </h6>
                <p class="text-muted">
                    {{reply.reply}}
                </p>
            </div>
        </div>
        <div class="col-md-12 text-center" v-if="load_more_button">
            <p  @click="load_more_replies()" class="small text-secondary" style="cursor:pointer">Load replies..</p>
        </div>
        <!-- Modal -->
        <div class="modal fade" :id="reply_id" tabindex="1" role="dialog" aria-labelledby="id" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="id">Update Reply</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form @submit.prevent="reply_update(update_reply.id)"  data-vv-scope="reply_update">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Review<span class="text-danger p-1">*</span></label>
                                <textarea v-validate="'required'" v-model="update_reply.reply" name="reply_update" class="form-control" :id="update_reply.id" aria-describedby="emailHelp" placeholder="Reply" rows="4" cols="50">
                                </textarea>
                            <div class="valid-feedback"></div>
                            <div v-if="errors.has('reply_update.reply_update')" class="invalid-feedback">
                                <span v-for="error in errors.collect('reply_update.reply_update')">{{ error }}</span>
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
export default {
    props:['id','login_status'],
    data(){
        return{
            replies:{},
            reply_id:'',
            update_reply:{},
            load_more_button:false, //load more button
            nextPage:2, // page numbers
            user_id:localStorage.getItem('user_id'), //User ID
            create_reply:{
                event_review_id:this.id,
                reply:'',
                avatar:localStorage.getItem('user_avatar'),
                name:localStorage.getItem('user_name'),
            },
        }
    },
    // methods
    methods:{
        load_replies(){
            axios.get('/api/event/'+this.id+'/reply')
            .then((response) => {
                this.replies = response.data.data;
              if(response.data.total > response.data.per_page){
                    this.load_more_button = true; 
                }
            }).catch((err) => {
            });
        },
        // Load more replies
        load_more_replies(nextPage){
            axios.get('/api/event/'+this.id+'/reply?page='+this.nextPage)
            .then((response) => {
                if(response.data.current_page <= response.data.last_page){
                    this.nextPage = response.data.current_page + 1; //page number
                    // reply object
                    this.replies = [
                        ...this.replies,
                        ...response.data.data
                    ];
                    // loadmore Button
                    if(response.data.current_page == response.data.last_page){
                        this.load_more_button = false; 
                    }else{
                        this.load_more_button = true; 
                    }
                }
                
            }).catch((err) => {
            });
        },
        // Replying Comment
        reply_comment(){
            this.$validator.validateAll('valid_reply_form').then((result) => {
                if(result){
                    axios.post('/api/event_review_replies',this.create_reply,{
                        headers : { Authorization : localStorage.getItem("token")}
                    }).then(response=>{
                        this.load_replies();
                        toast.fire({
                            icon:'success',
                            title:'Comment Posted',
                        });
                    })
                }
            });
        },

      //  Edit
         edit(id,index){
             this.reply_id = id;
             axios.get('/api/event_review_replies/'+id)
             .then(response=>{
                 this.update_reply = response.data;
                $('#'+id).appendTo("body").modal('show');
             })
         },
       //  update
        reply_update(id){
            this.$validator.validateAll('reply_update').then((result) => {                  
                if(result){
                    axios.patch('/api/event_review_replies/'+id,this.update_reply,{
                    headers : { Authorization : localStorage.getItem("token")}
                    })
                    .then(response=>{
                            $('#'+id).appendTo("body").modal('hide');
                            toast.fire({
                                icon:'success',
                                title:'Updated',
                            });
                            // location.reload();
                            this.load_replies();
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
                axios.delete('/api/event_review_replies/'+id,{
                    headers : { Authorization : localStorage.getItem("token")}
                }).then(response=>{
                    //  Flash Message  
                        this.load_replies();
                    toast.fire({
                        icon:'success',
                        title:'Successfully Deleted',
                    });
                    this.$delete(this.replies,index);
                })
            }
         },
    },
    mounted(){
        this.load_replies();
    }
}
</script>