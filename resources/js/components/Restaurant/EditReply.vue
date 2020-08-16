<template>
    <div>
<!-- <div class="modal"  id="check" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {{id}}

        <p>Modal body text goes here.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div> -->
<!-- Modal -->
        <div class="modal fade" id="check" tabindex="1" role="dialog" aria-labelledby="id" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="id">Update Reply</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{update_reply}}
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
    props:['update_reply'],
    data(){
        return{
            reply_id:this.id,
            // update_reply:{}
        }
    },

    methods:{
        // load_reply(){
        //      axios.get('/api/restaurant_comment_replies/'+this.reply_id)
        //      .then(response=>{
        //          this.update_reply = response.data;
        //      })
        // },
        // Update
        // reply_update(id){
        //     this.$validator.validateAll('reply_update').then((result) => {                  
        //         if(result){
        //             axios.patch('/api/restaurant_comment_replies/'+id,this.update_reply,{
        //             headers : { Authorization : localStorage.getItem("token")}
        //             })
        //             .then(response=>{
        //                 console.log(response);
        //                 // closing modal
        //                 // $('#reply_update_modal').appendTo("body").modal('hide');
        //                     // $('#reply_update_modal').modal('hide');
        //                     $('#'+id).appendTo("body").modal('hide');

        //                     //  Flash Message  
        //                     toast.fire({
        //                         icon:'success',
        //                         title:'Updated',
        //                     });
        //                     this.load_replies();
        //             })
        //         }
        //     })
        // },
    },

    mounted(){
        // this.load_reply();
    }
}
</script>