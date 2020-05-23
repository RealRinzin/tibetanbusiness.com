<template>
    <div>
        <div class="media mt-3" v-for="reply in replies">
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
        <div class="text-center">
            <!-- {{questions}} -->
            <button @click="load_replies" class="btn btn-default btn-sm">Load Replies</button>
        </div>
    </div>
    
</template>
<script>
export default {
    props:['questions'],
    data(){
        return{
            // question_id : this.questions,
            replies:{},
        }
    },
    // Methods
    methods:{
        load_replies(){
            axios.get('/api/job/'+this.questions.id+'/replies')
            .then(response=>{
                this.replies = response.data.data;
                console.log(response);
                
            })
        },

    },
    mounted(){
        console.log("mounted");
        // console.log(this.question_id);
        
    }
    
}
</script>