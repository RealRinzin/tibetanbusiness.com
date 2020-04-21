<template>
    <div id="restaurant">
            <loading :active.sync="isLoading"></loading>
        <div class="row">
            <div class="col-md-10 mx-auto">
                <div class="row">
                    <div class="col-md-6">
                        <!-- banner -->
                        <div class="card">
                            <div class="banner" v-bind:style='{ backgroundImage: `url(/img/${restaurant.banner})`}'>
                                <div class="overlay">
                                    <i class="fas fa-camera fa-5x text-white"></i>
                                    <div class="break"></div>
                                    <h5 class="text-white ml-2 mt-3">Update Banner Photo</h5>
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
                            <button class="btn btn-secondary btn-md"> <i class="fas fa-star text-warning fa-1x mr-2"></i><i class="fas fa-star text-warning fa-1x mr-2"></i><i class="fas fa-star text-warning fa-1x mr-2"></i>{{restaurant.rate}}</button>
                            <span>
                                <label class="switch">
                                <input type="checkbox" v-model="restaurant.status">
                                <span class="slider round"></span>
                                </label>
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
                        </ul>
                        <div class="tab-content py-3" id="custom-content-below-tabContent">
                            <div class="tab-pane fade show active" id="custom-content-below-overview" role="tabpanel" aria-labelledby="custom-content-below-overview-tab">
                                <dashboard-restaurant-overview :restaurant="overview" :operation="operation" :facilities="facilities"></dashboard-restaurant-overview>
                            </div>
                            <div class="tab-pane fade" id="custom-content-below-profile" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">
                                <dashboard-restaurant-menu-photo v-bind:menu_photos="restaurant.menu_photos"></dashboard-restaurant-menu-photo>
                            </div>
                            <div class="tab-pane fade" id="custom-content-below-messages" role="tabpanel" aria-labelledby="custom-content-below-messages-tab">
                                <dashboard-restaurant-food-photo v-bind:food_photos="restaurant.food_photos"></dashboard-restaurant-food-photo>
                            </div>
                            <div class="tab-pane fade" id="custom-content-below-settings" role="tabpanel" aria-labelledby="custom-content-below-settings-tab">
                                <dashboard-restaurant-comment v-bind:comments="comments"></dashboard-restaurant-comment>
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
            isLoading : false,//Lazy loading
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
                // Assigning Restaurant object
                this.restaurant = response.data.data;
                console.log(this.restaurant);
                // Operation Day
                this.operation = this.restaurant.operation[0];  
                // facitilies
                this.facilities = this.restaurant.facility[0]; 
                //Lazy loading            
                this.isLoading= false;
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
            })
        },
        /**
         * Update
         * Operations
         *  */ 
        update_operation_days(id){
            console.log(id);
        },
        /**
         * Update
         * Facilities
         *  */  
        update_facility(id){
            console.log(id);
            
        }
    },
    components:{Loading},
    mounted(){
        this.load();
    }
}
</script>