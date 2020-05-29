<template>
    <div id="restaurant">
        <div v-if="!loading">
            <loading :active.sync="isLoading"></loading>
        </div>
        <div v-else>
            <div class="row">
                <div class="col-md-10 mx-auto">
                    <div class="row">
                        <div class="col-md-6">
                            <!-- banner -->
                            <div class="card text-center">
                                <div v-if="bannerPreview == null" class="banner" v-bind:style='{ backgroundImage: `url(/img/${job.banner})`}'>
                                    <div class="overlay">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <i class="fas fa-camera fa-5x text-white"></i>
                                            </div>
                                            <div class="col-md-12 py-4">
                                                <label  for="rent_banner" class="text-center btn btn-danger btn-md"><i class="fas fa-cloud-upload-alt mr-2"></i>Upload Image</label>
                                                <input type="file"  id="rent_banner" name="rent_banner" class="upload_browser" @change="banner_event">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div v-else class="banner" v-bind:style='{ backgroundImage: `url(${bannerPreview})`}'>
                                    <div class="overlay">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <button class="btn btn-info btn-md" @click="update_banner(job.id)">
                                                    <h5><i class="fas fa-cloud-upload-alt mr-2"></i></h5>
                                                    <p>Upload</p>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <img src="/img/map.jpeg" alt="" height="250">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" id="nav-tab">
                            <div class="width-25">
                                <button class="btn btn-secondary btn-md"> <i class="fas fa-star text-warning fa-1x mr-2"></i><i class="fas fa-star text-warning fa-1x mr-2"></i><i class="fas fa-star text-warning fa-1x mr-2"></i>{{job.rate}}</button>
                                <span>
                                    <label class="switch">
                                    <input type="checkbox" v-model="job.status">
                                    <span class="slider round"></span>
                                    </label>
                                </span>
                            </div>
                            <ul class="nav nav-tabs mt-3" id="custom-content-below-tab" role="tablist">
                                <li class="nav-item pl-0">
                                    <a class="nav-link active pl-0" id="custom-content-below-overview-tab" data-toggle="pill" href="#custom-content-below-overview" role="tab" aria-controls="custom-content-below-overview" aria-selected="true">Overview</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-content-below-profile-tab" data-toggle="pill" href="#custom-content-below-profile" role="tab" aria-controls="custom-content-below-profile" aria-selected="false">Applicants</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-content-below-messages-tab" data-toggle="pill" href="#custom-content-below-messages" role="tab" aria-controls="custom-content-below-messages" aria-selected="false">Questions</a>
                                </li>
                                <li class="nav-item">
                                    <a :href="'custom-content-below-settings-tab'" class="nav-link" id="custom-content-below-settings-tab" data-toggle="pill" href="#custom-content-below-settings" role="tab" aria-controls="custom-content-below-settings" aria-selected="false">Comments</a>
                                </li>
                            </ul>
                            <div class="tab-content py-3" id="custom-content-below-tabContent">
                                <div class="tab-pane fade show active" id="custom-content-below-overview" role="tabpanel" aria-labelledby="custom-content-below-overview-tab">
                                    <!-- <dashboard-job-overview :job="overview"  :facilities="facilities"></dashboard-job-overview> -->
                                    <overview :job="overview"></overview>
                                </div>
                                <div class="tab-pane fade" id="custom-content-below-profile" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">
                                    <!-- <dashboard-job-room-photo v-bind:room_photos="job.room_photos" :id="job.id" @rent_load="rent_load"></dashboard-job-room-photo> -->
                                </div>
                                <div class="tab-pane fade" id="custom-content-below-messages" role="tabpanel" aria-labelledby="custom-content-below-messages-tab">
                                    <!-- <dashboard-job-view-photo v-bind:view_photos="job.view_photos" :id="job.id" @rent_load="rent_load"></dashboard-job-view-photo> -->
                                    <question :questions="questions"></question>

                                </div>
                                <div class="tab-pane fade" id="custom-content-below-settings" role="tabpanel" aria-labelledby="custom-content-below-settings-tab">
                                    <!-- <dashboard-job-comment v-bind:comments="comments"></dashboard-job-comment> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
// Import component
import Loading from 'vue-loading-overlay';
// Import stylesheet
import 'vue-loading-overlay/dist/vue-loading.css';
import Overview from './Overview.vue';
import Question from './Question.vue';

export default {
    props:['job_id'],
    data(){
        return{
            // Lazy loading
            isLoading : false,//Lazy loading
            loading:false, //loading
            // restaurant ID
            id:this.job_id.id,//Restaurant ID
            // Restaurant Object
            job:{}, 
            // Overview
            overview:{},
            // operatin
            //facilities
            // facilities:{},
            // comments
            questions:{},
            // Bannser
            bannerPreview:null,
        }
    },
    //methods
    methods:{
        // loading Restaurant
        job_load(){
            this.isLoading = true;
            axios.get('/api/job/'+this.id,{
                headers : { Authorization : localStorage.getItem("token")}
            })
            .then(response=>{
                //Lazy loading            
                this.isLoading= false;
                this.loading = true;
                // Assigning Restaurant object
                this.job = response.data.data;
                // questions
                this.questions = this.job.questions;
            })  
            /**
             * Retrieveing Overview
             *  */  
            axios.get('/api/job/individual/'+this.id,{
                    headers : { Authorization : localStorage.getItem("token")}
            })
            .then(response=>{
                this.overview = response.data;
            })
        },
        /**
         * Update Banner
         *  */
        banner_event(event){
            const extension = event.target.files[0].type;
            const size = event.target.files[0].size;
            // Check extension
            if(extension === 'image/jpeg' || extension === 'image/png' || extension === 'image/gif'){
                if(size < 1000000){
                    let fileReader = new FileReader();
                    fileReader.onload = (event) =>{
                        this.bannerPreview = event.target.result
                        // this.restaurant.banner = event.target.result
                    },
                    // base64 data
                    fileReader.readAsDataURL(event.target.files[0]);
                }else{
                    alert("Upload less than 1MB ")
                }
            }else{
                alert("Please Upload Only Image")
            }
        },
        /**
         * Update
         * Operations
         *  */ 
        update_banner(id){
            axios({
                method: 'patch',
                url: '/api/job/banner_update/'+id,
                data: {banner: this.bannerPreview},
                headers : { Authorization : localStorage.getItem("token")}
                }).then(response=>{
                            this.job_load();
                            //  Flash Message  
                            toast.fire({
                                icon:'success',
                                title:'Successfully Uploaded!!',
                            });
                    // Reload
                });
        },

    },
    components:{Loading,Overview,Question},
    mounted(){
        this.job_load();
    }
}
</script>