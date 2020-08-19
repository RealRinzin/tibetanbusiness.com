<template>
    <div style="min-height:80vh">
        <div id="restaurant">
            <div v-if="!loading">
                <loading :active.sync="isLoading"></loading>
            </div>
            <div v-else>
                <div  class="container py-4">
                    <div class="row">
                            <div class="col-md-8 col-sm-12">
                                <!-- <div class="d-flex justify-content-center">
                                    <button data-toggle="modal" data-target="#apply_job" class="btn btn-info btn-md w-25 position-fixed btn-flat" style="z-index:1000;bottom:20px">APPLY JOB</button>
                                </div> -->
                                <!-- basic -->
                                <div class="card">
                                    <div class="row">
                                        <!-- Banner -->
                                        <div class="col-md-5">
                                            <div class="banner" v-bind:style='{ backgroundImage: `url(/storage/Job/Banner/${job.banner})`}'>
                                            <div class="overlay">
                                                <div class="d-flex flex-row job">
                                                    <a v-if="job.facebook" :href="job.facebook" class="m-1"><i class="fab fa-facebook-square fa-1x btn-primary btn"></i></a>
                                                    <a v-if="job.instagram" :href="job.instagram" class="m-1"><i class="fab fa-instagram-square fa-1x btn-danger btn"></i></a>
                                                    <a v-if="job.website" :href="job.website" class="m-1"><i class="fab fa-internet-explorer  btn-secondary btn"></i></a>
                                                </div>
                                                <h5 class="font-weight-bold position-absolute btn btn-danger text-white btn-flat">{{job.organization}}</h5>
                                                <h6 class="font-weight-bold position-absolute btn text-white btn-danger btn-flat">{{job.title}}</h6>
                                            </div>
                                            </div>                                
                                        </div>
                                        <div class="col-sm-7 p-1">
                                            <div class="row p-2">
                                                <div class="col-md-3 col-6">
                                                    <h6 class="text-dark">Salary</h6>
                                                </div>
                                                <div class="col-md-9 col-6">
                                                    <h6 v-if="job.salary" class="text-muted text-left">: Rs <span class="font-weight-bold">{{job.salary}} /-</span></h6>
                                                    <h6 v-else class="text-muted text-left">Not Disclosed</h6>
                                                </div>
                                            </div>
                                            <div class="row p-2">
                                                <div class="col-md-3 col-6">
                                                    <h6 class="text-dark">Profession </h6>
                                                </div>
                                                <div class="col-md-9 col-6">
                                                    <h6 class="text-muted text-left">: {{job.profession}}</h6>
                                                </div>
                                            </div>
                                            <div class="row p-2">
                                                <div class="col-md-3 col-6">
                                                    <h6 class="text-dark">Nature </h6>
                                                </div>
                                                <div class="col-md-9 col-6">
                                                    <h6 class="text-muted text-left">: {{job.nature}}</h6>
                                                </div>
                                            </div>
                                            <div class="row p-2">
                                                <div class="col-md-3 col-6">
                                                    <h6 class="text-dark">Experience </h6>
                                                </div>
                                                <div class="col-md-9 col-6">
                                                    <h6 class="text-muted text-left">: {{job.experience}}</h6>
                                                </div>
                                            </div>
                                            <div class="row p-2">
                                                <div class="col-md-3 col-6">
                                                    <h6 class="text-dark">Mobile no </h6>
                                                </div>
                                                <div class="col-md-9 col-6">
                                                    <h6 class="text-muted text-left">: {{job.mobile_no}}</h6>
                                                </div>
                                            </div>
                                            <div class="row p-2">
                                                <div class="col-md-3 col-6">
                                                    <h6 class="text-dark">Location </h6>
                                                </div>
                                                <div class="col-md-9 col-6">
                                                    <h6 class="text-muted text-left">: {{job.location}}</h6>
                                                </div>
                                            </div>
                                            <div class="row p-2">
                                                <div class="col-md-3 col-6">
                                                    <h6 class="text-dark">Deadline </h6>
                                                </div>
                                                <div class="col-md-9 col-6">
                                                    <h6 class="text-muted font-weight-bold text-left">: {{job.deadline}}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Apply -->
                                <div class="row pb-3">
                                    <div class="col-12">
                                        <span v-if="is_logged"> 
                                                <button v-if="applied" class="btn btn-info btn-sm small my-1">You have Applied </button>
                                                <button v-else data-toggle="modal" @click="open_modal()" data-target="#apply_job" class="btn btn-info btn-sm small my-1">APPLY</button>
                                        </span>
                                        <button v-else class="btn btn-danger btn-sm small my-1" data-toggle="modal" data-target="#login">Login to apply</button>
                                        <button class="btn btn-success small btn-sm my-1"><i class="fas fa-check text-white fa-1x mr-1"></i>
                                        <span v-if="applied">You and {{job.applied -1}} others Applied</span>
                                        <span v-else>{{job.applied}} others Applied</span>
                                        </button>
                                        <button class="btn btn-secondary small btn-sm my-1">
                                            <span v-if="interested"><i class="fas fa-thumbs-up text-warning fa-1x mr-1" @click="thumbs_down(interested_id)"></i> You and {{job.interested -1}} others Interested</span>
                                            <span v-else><i class="fas fa-thumbs-up text-white fa-1x mr-1" @click="thumbs_up(job.id)"></i>{{job.interested}} Interested</span>
                                        </button>
                                    </div>
                                </div>
                                <!-- Info -->
                                <div class="card">
                                    <div class="row p-3">
                                        <div class="col-md-6">
                                            <h5 class="text-dark">Job Descriptions</h5>
                                            <p class="text-muted">
                                                {{job.description}}
                                            </p>
                                        </div>
                                        <div class="col-md-6"> 
                                            <h6>Address</h6>
                                            <!-- <geo-map></geo-map> -->
                                        </div>
                                    </div>
                                </div>
                                <!-- Question & Ansert -->
                                <job-question :job_uuid="job.id"></job-question>
                            </div>
                        <!-- Sidebar -->
                            <div class="col-md-4 col-sm-12">
                                <!-- sidebar -->
                                <sidebar></sidebar>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <apply :job_id="id" @close_modal="close_modal"></apply>
    </div>
</template>
<script>
// Import component
import Loading from 'vue-loading-overlay';
// Import stylesheet
import 'vue-loading-overlay/dist/vue-loading.css';
import Apply from './Apply.vue';
export default {
    props:['job_id'],
    data(){
        return{
            id:this.job_id['id'], //Rent Id
            user_id:'',
            job:{}, //job objects
            isLoading : false,//Lazy loading
            loading:false, //loading
            // status 
            is_logged:false,
            applied:false,
            applied_id:'',
            interested:false,
            interested_id:'',
        }
    },
    methods:{
        load_job(){
            // Job Object data
            this.isLoading = true;
            axios.get('/api/job/view/'+this.id)
            .then(response=>{
                this.job = response.data.data;
                this.isLoading = false;
                this.loading = true;
                // Check Login Status
                axios.get('/login_status').then(response => {
                    if(response.data.status == true){
                        this.is_logged = true;
                        this.user_id = response.data.user.id;
                        // Check if user
                        // Applied this Job
                        for (let index = 0; index < this.job.job_applied.length; index++) {
                            if(this.job.job_applied[index].user_id == this.user_id){
                                this.applied = true;
                                this.applied_id = this.job.job_applied[index].id
                                break;
                            }
                        }
                        // Check If user
                        // User is interested
                        for (let y = 0; y < this.job.job_interested.length; y++) {
                            if(this.job.job_interested[y].user_id == this.user_id){
                            // console.log(this.job.job_interested[y].id)
                                this.interested = true;
                                this.interested_id = this.job.job_interested[y].id
                                break;
                            }
                        }
                    }
                })
            })
        },
        // Interested
        thumbs_up(id){
            axios.post('/api/job_interest',{id:this.id},{
                headers : { Authorization : localStorage.getItem("token")}
            })
            .then(repsone=>{
                this.interested = true
            this.load_job();
            })
        },
        // Unliked
        thumbs_down(id){
            axios.delete('/api/job_interest/'+id,{
                headers : { Authorization : localStorage.getItem("token")}
            })
            .then(repsone=>{
                this.interested = false
            this.load_job();
            })
        },
        // open modal
        open_modal(){
            $("#job_apply").modal("show");
        },
        close_modal(){
            $("#job_apply").modal("hide");
        }
    },
    /**
     * 
     * Components
     *  */  
    components:{Loading,Apply},
    mounted(){
        this.load_job();
    }
}
</script>