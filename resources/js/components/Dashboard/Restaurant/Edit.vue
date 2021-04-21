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
                            <div class="card text-center">
                                <div v-if="bannerPreview == null" class="banner" v-bind:style='{ backgroundImage: `url(/storage/Restaurant/Banner/${restaurant.banner})`}'>
                                    <div class="overlay">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <i class="fas fa-camera fa-5x text-white"></i>
                                            </div>
                                            <div class="col-md-12 py-4">
                                                <label  for="banner" class="text-center btn btn-danger btn-md"><i class="fas fa-cloud-upload-alt mr-2"></i>Upload Image</label>
                                                <input type="file"  id="banner" name="banner" class="upload_browser" @change="banner_event">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div v-else class="banner" v-bind:style='{ backgroundImage: `url(${bannerPreview})`}'>
                                    <div class="overlay">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <button class="btn btn-info btn-md" @click="update_banner(restaurant.id)">
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
                                <map-location :longitude="restaurant.longitude" :latitude="restaurant.latitude"></map-location>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" id="nav-tab">
                            <div class="width-25">
                                <button class="btn btn-secondary btn-md"> <i class="fas fa-star text-warning fa-1x mr-2"></i><i class="fas fa-star text-warning fa-1x mr-2"></i><i class="fas fa-star text-warning fa-1x mr-2"></i>{{restaurant.rate}}</button>
                                <span>
                                    <toggle-button 
                                        :value="restaurant.status"
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
                                    <a class="nav-link" id="custom-content-below-profile-tab" data-toggle="pill" href="#custom-content-below-profile" role="tab" aria-controls="custom-content-below-profile" aria-selected="false">Menu Photos</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-content-below-messages-tab" data-toggle="pill" href="#custom-content-below-messages" role="tab" aria-controls="custom-content-below-messages" aria-selected="false">Food Photos</a>
                                </li>
                                <li class="nav-item">
                                    <a :href="'custom-content-below-settings-tab'" class="nav-link" id="custom-content-below-settings-tab" data-toggle="pill" href="#custom-content-below-settings" role="tab" aria-controls="custom-content-below-settings" aria-selected="false">Comments</a>
                                </li>
                                <li class="nav-item">
                                    <a :href="'custom-content-below-settings-tab'" class="nav-link" id="custom-content-below-settings-tab" data-toggle="pill" href="#custom-content-below-banner" role="tab" aria-controls="custom-content-below-settings" aria-selected="false">Banner</a>
                                </li>
                            </ul>
                            <div class="tab-content py-3" id="custom-content-below-tabContent">
                                <div class="tab-pane fade show active" id="custom-content-below-overview" role="tabpanel" aria-labelledby="custom-content-below-overview-tab">
                                    <dashboard-restaurant-overview :restaurant="overview" :operation="operation" :facilities="facilities"></dashboard-restaurant-overview>
                                </div>
                                <div class="tab-pane fade" id="custom-content-below-profile" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">
                                    <dashboard-restaurant-menu-photo v-bind:menu_photos="restaurant.menu_photos" :id="restaurant.id" @load="load"></dashboard-restaurant-menu-photo>
                                </div>
                                <div class="tab-pane fade" id="custom-content-below-messages" role="tabpanel" aria-labelledby="custom-content-below-messages-tab">
                                    <dashboard-restaurant-food-photo v-bind:food_photos="restaurant.food_photos" :id="restaurant.id" @load="load"></dashboard-restaurant-food-photo>
                                </div>
                                <div class="tab-pane fade" id="custom-content-below-settings" role="tabpanel" aria-labelledby="custom-content-below-settings-tab">
                                    <dashboard-restaurant-comment v-bind:comments="comments"></dashboard-restaurant-comment>
                                </div>
                                <div class="tab-pane fade" id="custom-content-below-banner" role="tabpanel" aria-labelledby="custom-content-below-settings-tab">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="card text-center">
                                                <div v-if="bannerPreview == null" class="banner" v-bind:style='{ backgroundImage: `url(/storage/Restaurant/Banner/${restaurant.banner})`}'>
                                                    <div class="overlay">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <i class="fas fa-camera fa-5x text-white"></i>
                                                            </div>
                                                            <div class="col-md-12 py-4">
                                                                <label  for="banner" class="text-center btn btn-danger btn-md"><i class="fas fa-cloud-upload-alt mr-2"></i>Upload Image</label>
                                                                <input type="file"  id="banner" name="banner" class="upload_browser" @change="banner_event">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div v-else class="banner" v-bind:style='{ backgroundImage: `url(${bannerPreview})`}'>
                                                    <div class="overlay">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <button class="btn btn-info btn-md" @click="update_banner(restaurant.id)">
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
    props:['rest_id'],
    data(){
        return{
            // Lazy loading
            // Lazy loading
            isLoading : false,//Lazy loading
            loading:false, //loading
            // restaurant ID
            id:this.rest_id.id,//Restaurant ID
            // Restaurant Object
            restaurant:{}, 
            // Overview
            overview:{},
            // operatin
            operation: {},
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
        load(){
            this.isLoading = true;
            axios.get('/api/restaurant/'+this.id,{
                headers : { Authorization : localStorage.getItem("token")}
            })
            .then(response=>{
                //Lazy loading            
                this.isLoading= false;
                this.loading = true;
                // Assigning Restaurant object
                this.restaurant = response.data.data;
                // Operation Day
                this.operation = this.restaurant.operation[0];
                // this.restaurant.operation.forEach(element => {
                    if(this.operation != null){
                        // this.operation = element;
                        // monday
                        if(this.operation.monday == 1){
                            this.operation.monday = true;
                        }else{
                            this.operation.monday = false;
                        }
                        // wednesday
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
                        // wednesday
                        if(this.operation.thursday == 1){
                            this.operation.thursday = true;
                        }else{
                            this.operation.thursday = false;
                        }
                        // wednesday
                        if(this.operation.friday == 1){
                            this.operation.friday = true;
                        }else{
                            this.operation.friday = false;
                        }
                        // wednesday
                        if(this.operation.saturday == 1){
                            this.operation.saturday = true;
                        }else{
                            this.operation.saturday = false;
                        }
                        // wednesday
                        if(this.operation.sunday == 1){
                            this.operation.sunday = true;
                        }else{
                            this.operation.sunday = false;
                        }
                    }
                // });
                // facitilies
                this.facilities = this.restaurant.facility[0]; 
                    if(this.facilities != null){
                        // Home Delivery
                        if(this.facilities.home_delivery == 1){
                            this.facilities.home_delivery = true;
                        }else{
                            this.facilities.home_delivery = false;
                        }
                        // wifi
                        if(this.facilities.wifi == 1){
                            this.facilities.wifi = true;
                        }else{
                            this.facilities.wifi = false;
                        }
                        // party booking
                        if(this.facilities.party_booking == 1){
                            this.facilities.party_booking = true;
                        }else{
                            this.facilities.party_booking = false;
                        }
                        // Roof Top
                        if(this.facilities.roof_top == 1){
                            this.facilities.roof_top = true;
                        }else{
                            this.facilities.roof_top = false;
                        }
                        // AC
                        if(this.facilities.ac == 1){
                            this.facilities.ac = true;
                        }else{
                            this.facilities.ac = false;
                        }
                        // veg
                        if(this.facilities.veg == 1){
                            this.facilities.veg = true;
                        }else{
                            this.facilities.veg = false;
                        }
                        // none_veg
                        if(this.facilities.none_veg == 1){
                            this.facilities.none_veg = true;
                        }else{
                            this.facilities.none_veg = false;
                        }
                        // Beverage
                        if(this.facilities.beverage == 1){
                            this.facilities.beverage = true;
                        }else{
                            this.facilities.beverage = false;
                        }
                        // Parking Lot
                        if(this.facilities.parking_lot == 1){
                            this.facilities.parking_lot = true;
                        }else{
                            this.facilities.parking_lot = false;
                        }
                        // Credit Card
                        if(this.facilities.card_payment == 1){
                            this.facilities.card_payment = true;
                        }else{
                            this.facilities.card_payment = false;
                        }
                    }

                // comments
                this.comments = this.restaurant.comments;
            })  
            /**
             * Retrieveing Overview
             *  */  
            axios.get('/api/restaurant/individual/'+this.id,{
                    headers : { Authorization : localStorage.getItem("token")}
            })
            .then(response=>{
                this.overview = response.data;
                console.log(this.overview);
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
                url: '/api/restaurant/banner_update/'+id,
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
        this.load();
    }
}
</script>