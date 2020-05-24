<template>
    <div>
        <div class="text-left w-75">
            <form @submit.prevent="reply(id)" data-vv-scope="job_valid_reply_form">
                <div class="input-group input-group-sm">
                    <input type="text" v-validate="'required|min:1|max:255|alpha_spaces'" v-model="question.reply" class="form-control" name="reply" placeholder="Give your reply here!!!">
                    <span class="input-group-append">
                        <button type="submit" class="btn btn-info btn-flat btn-lg" placeholder="Write your Question">Reply</button>
                    </span>
                    <div class="valid-feedback"></div>
                    <div v-if="errors.has('job_valid_reply_form.question')" class="invalid-feedback">
                        <span v-for="error in errors.collect('job_valid_reply_form.question')">{{ error }}</span>
                    </div>
                </div>
            </form>
        </div>
        <div class="media mt-3" v-for="reply in replies.data">
            <a class="pr-3" href="#">
                <img class="mr-2 img-circle" src="https://graph.facebook.com/v3.3/2656023347975235/picture?type=normal" alt="Generic placeholder image" style="height:50px;width:50px">
            </a>
            <div class="media-body">
                <h6 class="mt-0">{{reply.name}}</h6>
                <p class="text-muted">
                    {{reply.question}}
                </p>
            </div>
        </div>
        <!-- {{questions}} -->
        <div class="text-center mt-3" v-if="questions.repliesCount > 0 && replies.next_page_url">
            <!-- {{questions}} -->
            <button @click="load_replies" class="btn btn-secondary btn-sm">Load Replies</button>
        </div>
    </div>
    
</template>
<script>
export default {
    props:['questions'],
    data(){
        return{
            question:{},
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
        reply(id){
            console.log(id);
        }

    },
    mounted(){
        
        // console.log("mounted");
        // console.log(this.question_id);
    }
    
}
</script>