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
                                <div v-if="bannerPreview == null" class="banner" v-bind:style='{ backgroundImage: `url(/storage/Rent/Banner/${rent.banner})`}'>
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
                                                <button class="btn btn-info btn-md" @click="update_banner(rent.id)">
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
                                <button class="btn btn-secondary btn-md"> <i class="fas fa-star text-warning fa-1x mr-2"></i><i class="fas fa-star text-warning fa-1x mr-2"></i><i class="fas fa-star text-warning fa-1x mr-2"></i>{{rent.rate}}</button>
                                <span>
                                    <label class="switch">
                                    <input type="checkbox" v-model="rent.status">
                                    <span class="slider round"></span>
                                    </label>
                                </span>
                            </div>
                            <ul class="nav nav-tabs mt-3" id="custom-content-below-tab" role="tablist">
                                <li class="nav-item pl-0">
                                    <a class="nav-link active pl-0" id="custom-content-below-overview-tab" data-toggle="pill" href="#custom-content-below-overview" role="tab" aria-controls="custom-content-below-overview" aria-selected="true">Overview</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-content-below-profile-tab" data-toggle="pill" href="#custom-content-below-profile" role="tab" aria-controls="custom-content-below-profile" aria-selected="false">Room Photos</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-content-below-messages-tab" data-toggle="pill" href="#custom-content-below-messages" role="tab" aria-controls="custom-content-below-messages" aria-selected="false">View Photos</a>
                                </li>
                                <li class="nav-item">
                                    <a :href="'custom-content-below-settings-tab'" class="nav-link" id="custom-content-below-settings-tab" data-toggle="pill" href="#custom-content-below-settings" role="tab" aria-controls="custom-content-below-settings" aria-selected="false">Comments</a>
                                </li>
                            </ul>
                            <div class="tab-content py-3" id="custom-content-below-tabContent">
                                <div class="tab-pane fade show active" id="custom-content-below-overview" role="tabpanel" aria-labelledby="custom-content-below-overview-tab">
                                    <dashboard-rent-overview :rent="overview"  :facilities="facilities"></dashboard-rent-overview>
                                </div>
                                <div class="tab-pane fade" id="custom-content-below-profile" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">
                                    <dashboard-rent-room-photo v-bind:room_photos="rent.room_photos" :id="rent.id" @rent_load="rent_load"></dashboard-rent-room-photo>
                                </div>
                                <div class="tab-pane fade" id="custom-content-below-messages" role="tabpanel" aria-labelledby="custom-content-below-messages-tab">
                                    <dashboard-rent-view-photo v-bind:view_photos="rent.view_photos" :id="rent.id" @rent_load="rent_load"></dashboard-rent-view-photo>
                                </div>
                                <div class="tab-pane fade" id="custom-content-below-settings" role="tabpanel" aria-labelledby="custom-content-below-settings-tab">
                                    <dashboard-rent-comment v-bind:comments="comments"></dashboard-rent-comment>
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
export default {
    props:['rent_id'],
    data(){
        return{
            // Lazy loading
            isLoading : false,//Lazy loading
            loading:false, //loading
            // restaurant ID
            id:this.rent_id.id,//Restaurant ID
            // Restaurant Object
            rent:{}, 
            // Overview
            overview:{},
            // operatin
            //facilities
            facilities:{},
            // comments
            comments:{},
            // Banner
            bannerPreview:null,
        }
    },
    //methods
    methods:{
        // loading Restaurant
        rent_load(){
            this.isLoading = true;
            axios.get('/api/rent/'+this.id,{
                headers : { Authorization : localStorage.getItem("token")}
            })
            .then(response=>{
                //Lazy loading            
                this.isLoading= false;
                this.loading = true;
                // Assigning Restaurant object
                this.rent = response.data.data;
                // facitilies
                this.facilities = this.rent.facility[0]; 
                // comments
                this.comments = this.rent.comments;

            })  
            /**
             * Retrieveing Overview
             *  */  
            axios.get('/api/rent/individual/'+this.id,{
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
                url: '/api/rent/banner_update/'+id,
                data: {banner: this.bannerPreview},
                headers : { Authorization : localStorage.getItem("token")}
                }).then(response=>{
                            location.reload();
                            //  Flash Message  
                            toast.fire({
                                icon:'success',
                                title:'Successfully Uploaded!!',
                            });
                    // Reload
                });
        },
        /**
         * Update
         * Facilities
         *  */  
        // update_facility(id){
        //     console.log(id);
            
        // }
    },
    components:{Loading},
    mounted(){
        this.rent_load();
    }
}
</script>