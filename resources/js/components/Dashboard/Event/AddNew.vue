<template>
    <div>
        <div class="modal fade" id="event_add_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header bg-secondary text-white">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add New Event</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <form @submit.prevent="add_event()"  data-vv-scope="job_validate_add_form">
                        <div class="modal-body">
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
import { Validator } from 'vee-validate';

export default {
    props:['load_event'],
    data(){
        return{
            job:{},
            bannerPreview:'',
            // today : 
        }
    },
    methods:{
        /**
         * Banner Image 
         * File
         *  */ 
        // avatar(event){
        //     let fileReader = new FileReader();
        //     if(event.target.files[0].size < 1000000){
        //         fileReader.onload = (event) =>{
        //             this.bannerPreview = event.target.result
        //             this.job.banner = event.target.result
        //         }
                
        //     }else{
        //         alert("Image size should be less than 1MB")
        //     }
        //     // base64 data
        //     fileReader.readAsDataURL(event.target.files[0]);
        // },

       add_event(){
    //         this.$validator.validateAll('job_validate_add_form').then((result) => {
    //             if(result){
    //                 axios.post('/api/job',this.job,{
    //                 headers : { Authorization : localStorage.getItem("token")}
    //                 })
    //                 .then(response=>{
    //                     // closing modal
    //                         $("#job_add_modal").modal("hide");  
    //                         //  Flash Message  
    //                         toast.fire({
    //                             icon:'success',
    //                             title:'Updated',
    //                         });
    //                         this.$emit('load_job');
    //                 })
    //             }
    //         })
        }
    },
    mounted(){
    }
}
</script>