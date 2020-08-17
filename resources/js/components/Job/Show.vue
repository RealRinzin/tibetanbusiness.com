<template>
    <div style="min-height:80vh">
        <vue-headful
        :title="job.title"
        :description="job.location"
        :image="job.banner"
        lang="langauge"
        :url="url"
        />
        <a :href="'https://www.facebook.com/sharer.php?u='+url" target="_blank">Share facebook</a>
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
                                    <div class="col-md-12" v-if="is_logged">
                                        <button data-toggle="modal" @click="open_modal()" data-target="#apply_job" class="btn btn-info btn-md w-25">APPLY JOB</button>
                                    </div>
                                    <div class="col-md-12" v-else>
                                    <p><a href="#" class="btn btn-danger btn-md" data-toggle="modal" data-target="#login">Login to apply</a></p>
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
            job:{}, //job objects
            isLoading : false,//Lazy loading
            loading:false, //loading
            is_logged:false,
            url:'',
        }
    },
    methods:{
        load_rent(){
            this.isLoading = true;
            axios.get('/api/job/view/'+this.id)
            .then(response=>{
                this.job = response.data.data;
                this.isLoading = false;
                this.loading = true;
                this.url ="https://tibetanbusiness.com:8890/job/"+this.job.title;
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
        this.load_rent();
        axios.get('/login_status').then(response => {
            if(response.data.status === true){
                this.is_logged = true
            }
        })
    }
}
</script>