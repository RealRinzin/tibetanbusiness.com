<template>
    <div id="restaurant">
        <vue-headful
        :title="event.name+' - Tibetanbusiness.com'"
        />
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
                                <div v-if="bannerPreview == null" class="banner lazyload" :data-bgset="'/storage/Event/Banner/'+event.card"  data-sizes="auto">
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
                                                <button class="btn btn-info btn-md" @click="update_banner(event.id)">
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
                            <map-location :longitude="event.longitude" :latitude="event.latitude"></map-location>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" id="nav-tab">
                            <div class="width-25">
                                <button class="btn btn-secondary btn-md"> <i class="fas fa-star text-warning fa-1x mr-2"></i><i class="fas fa-star text-warning fa-1x mr-2"></i><i class="fas fa-star text-warning fa-1x mr-2"></i>{{event.rate}}</button>
                                <span>
                                    <toggle-button 
                                        :value="event.status"
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
                                    <overview :event="event"></overview>
                                </div>
                                <div class="tab-pane fade" id="photos" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">
                                    <photo :event="event"></photo>
                                </div>
                                <div class="tab-pane fade" id="custom-content-below-profile" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">
                                    <review :event="event"></review>
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
    props:['event_id'],
    data(){
        return{
            // Lazy loading
            isLoading : false,//Lazy loading
            loading:false, //loading
            // restaurant ID
            id:this.event_id.id,//Event ID
            // Restaurant Object
            event:{}, 
            // comments
            events:{},
            // Bannser
            bannerPreview:null,
        }
    },
    //methods
    methods:{
        // loading Restaurant
        event_load(){
            this.isLoading = true;
            axios.get('/api/event/'+this.id,{
                headers : { Authorization : localStorage.getItem("token")}
            })
            .then(response=>{

                //Lazy loading            
                this.isLoading= false;
                this.loading = true;
                // Assigning Restaurant object
                this.event = response.data;
                // events
            })  
            /**
             * Retrieveing Overview
             *  */  
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
                url: '/api/event/banner_update/'+id,
                data: {banner: this.bannerPreview},
                headers : { Authorization : localStorage.getItem("token")}
                }).then(response=>{
                            this.event_load();
                            //  Flash Message  
                            toast.fire({
                                icon:'success',
                                title:'Successfully Uploaded!!',
                            });
                    // Reload
                });
        },

    },
    components:{Loading,Overview,Review,Photo},
    mounted(){
        this.event_load();
    }
}
</script>