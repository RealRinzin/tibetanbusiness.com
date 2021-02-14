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
                                <div v-if="bannerPreview == null" class="banner" v-bind:style='{ backgroundImage: `url(/storage/Service/Banner/${service.banner})`}'>
                                    <div class="overlay">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <i class="fas fa-camera fa-5x text-white"></i>
                                            </div>
                                            <div class="col-md-12 py-4">
                                                <label  for="rent_banner" class="text-center btn btn-danger btn-md"><i class="fas fa-cloud-upload-alt mr-2"></i>Upload Image</label>
                                                <input type="file"  id="rent_banner" name="rent_banner" class="upload_browser" @change="banner_service">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div v-else class="banner" v-bind:style='{ backgroundImage: `url(${bannerPreview})`}'>
                                    <div class="overlay">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <button class="btn btn-info btn-md" @click="update_banner(service.id)">
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
                                <map-location :longitude="service.longitude" :latitude="service.latitude"></map-location>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" id="nav-tab">
                            <div class="width-25">
                                <button class="btn btn-secondary btn-md"> <i class="fas fa-star text-warning fa-1x mr-2"></i><i class="fas fa-star text-warning fa-1x mr-2"></i><i class="fas fa-star text-warning fa-1x mr-2"></i>{{service.rate}}</button>
                                <span>
                                    <toggle-button 
                                        :value="service.status"
                                        :disabled="true"
                                        :color="{checked:'#28a745',unchecked:'#dc4245'}"
                                        :labels="{checked: 'On', unchecked: 'Off'}"/>
                                </span>
                            </div>
                            <ul class="nav nav-tabs mt-3" id="custom-content-below-tab" role="tablist">
                                <li class="nav-item pl-0">
                                    <a class="nav-link active pl-0" id="custom-content-below-overview-tab" data-toggle="pill" href="#custom-content-below-overview" role="tab" aria-controls="custom-content-below-overview" aria-selected="true">Overview</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-content-below-messages-tab" data-toggle="pill" href="#photos" role="tab" aria-controls="custom-content-below-messages" aria-selected="false">Photos</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-content-below-profile-tab" data-toggle="pill" href="#custom-content-below-profile" role="tab" aria-controls="custom-content-below-profile" aria-selected="false">Reviews</a>
                                </li>

                            </ul>
                            <div class="tab-content py-3" id="custom-content-below-tabContent">
                                <div class="tab-pane fade show active" id="custom-content-below-overview" role="tabpanel" aria-labelledby="custom-content-below-overview-tab">
                                    <overview :service="service" :operation="operation"></overview>
                                </div>
                                <div class="tab-pane fade" id="photos" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">
                                    <photo :service="service"></photo>
                                </div>
                                <div class="tab-pane fade" id="custom-content-below-profile" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">
                                    <review :service="service"></review>
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
import Review from './Review.vue';
import Photo from './Photo.vue';
// import Applicant from './Applicant.vue';

export default {
    props:['service_id'],
    data(){
        return{
            // Lazy loading
            isLoading : false,//Lazy loading
            loading:false, //loading
            // restaurant ID
            id:this.service_id.id,//Event ID
            // Restaurant Object
            service:{}, 
            // comments
            operation:{},
            // Bannser
            bannerPreview:null,
        }
    },
    //methods
    methods:{
        // loading Restaurant
        service_load(){
            this.isLoading = true;
            axios.get('/api/service/'+this.id,{
                headers : { Authorization : localStorage.getItem("token")}
            })
            .then(response=>{
                //Lazy loading            
                this.isLoading= false;
                this.loading = true;
                // Assigning Restaurant object
                this.service = response.data;
                // services
            })  
            /**
             * Retrieving Operation days
             *  */  
            axios.get('/api/service_working_day/'+this.id+'/working_day')
            .then(response=>{
                this.operation = response.data[0];
                // monday
                if(this.operation.monday == 1){
                    this.operation.monday = true;
                }else{
                    this.operation.monday = false;
                }
                // tuesday
                if(this.operation.tuesday == 1){
                    this.operation.tuesday = true;
                }else{
                    this.operation.tuesday = false;
                }
                // wednesday
                if(this.operation.wednesday == 1){
                    this.operation.wednesday = true;
                }else{
                    this.operation.wednesday = false;
                }
                // thursday
                if(this.operation.thursday == 1){
                    this.operation.thursday = true;
                }else{
                    this.operation.thursday = false;
                }
                // friday
                if(this.operation.friday == 1){
                    this.operation.friday = true;
                }else{
                    this.operation.friday = false;
                }
                // saturday
                if(this.operation.saturday == 1){
                    this.operation.saturday = true;
                }else{
                    this.operation.saturday = false;
                }
                // sunday
                if(this.operation.sunday == 1){
                    this.operation.sunday = true;
                }else{
                    this.operation.sunday = false;
                }
            })
        },
        /**
         * Update Banner
         *  */
        banner_service(service){
            const extension = service.target.files[0].type;
            const size = service.target.files[0].size;
            // Check extension
            if(extension === 'image/jpeg' || extension === 'image/png' || extension === 'image/gif'){
                if(size < 1000000){
                    let fileReader = new FileReader();
                    fileReader.onload = (service) =>{
                        this.bannerPreview = service.target.result
                    },
                    // base64 data
                    fileReader.readAsDataURL(service.target.files[0]);
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
                url: '/api/service/banner_update/'+id,
                data: {banner: this.bannerPreview},
                headers : { Authorization : localStorage.getItem("token")}
                }).then(response=>{
                            this.service_load();
                            //  Flash Message  
                            toast.fire({
                                icon:'success',
                                title:'Successfully Uploaded!!',
                            });
                    // Reload
                });
        },

    },
    components:{Loading,Overview,Photo,Review},
    mounted(){
        this.service_load();
    }
}
</script>