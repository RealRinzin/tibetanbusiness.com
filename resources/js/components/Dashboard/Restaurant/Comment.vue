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
                    <th scope="col">View</th>
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
                        <td><button class="btn btn-sm btn-primary" @mouseover="view(index)"><i class="fas fa-eye"></i></button></td>
                        <td>{{comment.rate}}</td>
                        <td><timeago :datetime="comment.created_at" /></td>
                    </tr>
                </tbody>
                </table>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="comment_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
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
                        <img class="mr-3" :src="view_comment.avatar" alt="Generic placeholder image">
                        <div class="media-body p-1">
                            <h5 class="text-muted">{{view_comment.name}}</h5>
                            <h6 class="text-muted"><timeago   :converterOptions="{ includeSeconds: true }" :datetime="view_comment.created_at" /></h6>
                        </div>
                        </div>
                        <div class="py-2">
                            <button class="btn btn-secondary btn-xs"> <i class="fas fa-star text-warning fa-1x mr-2"></i><i class="fas fa-star text-warning fa-1x mr-2"></i><i class="fas fa-star text-warning fa-1x mr-2"></i>{{view_comment.rate}}</button>
                            <p class="py-3">{{view_comment.comment}}</p>
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
    props:['comments'],
    data(){
        return{
            comment:{},
            view_comment:{},
        }
    },
    methods:{
        load_comments(){
        },
        view(index){
            $("#comment_modal").modal("show");
            this.view_comment = this.comment[index];        
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