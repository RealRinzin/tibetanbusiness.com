<template>
    <div>
        <div class="d-flex justify-content-center">
            <div class="text-left w-75">
                <form data-vv-scope="job_valid_reply_form">
                    <div class="input-group input-group-sm">
                        <input type="text" v-validate="'required|min:1|max:255'" class="form-control" name="reply" placeholder="Give your reply here!!!">
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
                        <!-- <span v-if="reply.user_id === user_id" class="p-2">
                            <span class="btn btn-xs btn-secondary" @click="edit(reply.id,index)"><i class="fas fa-pencil-alt "></i></span>
                            <span class="btn btn-xs btn-danger" @click="destory(reply.id,index)"><i class="fas fa-trash-alt"></i></span>
                        </span> -->
                    </small>
                </h6>
                <p class="text-muted">
                    {{reply.reply}}
                </p>
            </div>
        </div>
        <!-- {{questions}} -->
        <!-- <div class="text-center mt-3 p-2" v-if="questions.repliesCount > 0 && replies.next_page_url"> -->
            <!-- {{questions}} -->
            <!-- <button @click="load_replies" class="btn btn-secondary btn-sm small">Load Replies</button> -->
        </div>
    </div>
</template>
<script>
export default {
    props:['id'],
    data(){
        return{
            replies:{},
        }
    },
    // methods
    methods:{
        load_replies(){
            axios.get('/api/restaurant/'+this.id+'/reply')
            .then((response) => {
                this.replies = response.data;
            }).catch((err) => {
                
            });
        }
    },

    mounted(){
        this.load_replies();
    }
}
</script>