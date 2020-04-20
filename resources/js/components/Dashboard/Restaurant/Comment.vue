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
                    <th scope="col">Comment</th>
                    <th scope="col">Rate</th>
                    <th scope="col">Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(comment,index) in comment">
                        <th scope="row">{{index + 1}}</th>
                        <th scope="row"><img :src="comment.avatar" class="img-circle" alt="" style="height:35px;width:35px"></th>
                        <td>{{comment.name}}</td>
                        <td>{{comment.comment}}</td>
                        <td>{{comment.rate}}</td>
                        <td><timeago :datetime="comment.created_at" /></td>
                    </tr>
                </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props:['comments'],
    data(){
        return{
            comment:{},
        }
    },
    methods:{
        load_comments(){
        }
    },
    /**
     * Watch the props
     * data
     *  */ 
    watch:{
        comments:function(data){
            this.comment = this.comments
        }
    },
    // mounted
    mounted(){
        this.load_comments();
        
    }
}
</script>