<template>
    <div>
        <div id="restaurant" style="min-height:80vh">
            <div v-if="!loading" style="min-height:500px">
                <loading :active.sync="isLoading"></loading>
            </div>
            <div v-else>
                <div class="container py-1">
                    <div class="row">
                            <div class="col-md-8 col-sm-12">
                                <!-- basic -->
                                <div class="card">
                                    <div class="row">
                                        <!-- Banner -->
                                        <div class="col-md-12">
                                            <div class="banner" v-bind:style='{ backgroundImage: `url(/storage/Restaurant/Banner/${restaurant.banner})`}'>
                                                <div class="overlay">
                                                    <h6 class="font-weight-bold position-absolute btn btn-danger">{{restaurant.name}}</h6>
                                                    <ul>
                                                        <li v-if="restaurant.rating > 0"><a class="btn-secondary btn text-white"><i class="fas fa-star pr-1 text-warning"></i>{{restaurant.rating}}</a></li>
                                                        <li v-if="restaurant.facebook"><a target="_blank" :href="restaurant.facebook"><i class="fab fa-facebook-square fa-2x btn-primary btn"></i></a></li>
                                                        <li v-if="restaurant.website"><a target="_blank" :href="restaurant.website"><i class="fab fa-internet-explorer fa-2x btn-secondary btn"></i></a></li>
                                                        <li v-if="restaurant.instagram"><a target="_blank" :href="restaurant.instagram"><i class="fab fa-instagram fa-2x btn-danger btn"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>                                
                                        </div>
                                        <!-- Overview -->
                                        <div class="col-md-12">
                                            <div class="row p-3 overview">
                                                <div class="col-md-6 col-sm-6 col-12">
                                                    <h6 class="text-muted py-1"><i class="fas fa-clock mr-2"></i>{{restaurant.opening_hour}}- {{restaurant.closing_hour}}</h6>
                                                    <h6 class="text-muted py-1"><i class="fas fa-phone-square-alt pr-2"></i>{{restaurant.mobile_no}}</h6>
                                                    <h6 class="text-muted"><i class="fas fa-map-marker-alt mr-2"></i>{{restaurant.location}}</h6>
                                                        <h6 class="text-muted"><i class="fas fa-map-marked-alt mr-2"></i>{{restaurant.address}}</h6>
                                                    
                                                    <h6 class="text-muted pt-1" v-if="restaurant.operation[0] != null">
                                                        <span v-if="restaurant.operation[0].monday == 1" class="text-success btn btn-outline-success" >Mon</span>
                                                        <span v-else class="text-danger btn btn-outline-danger">Mon</span>
                                                        <span v-if="restaurant.operation[0].tuesday == 1" class="text-success btn btn-outline-success" >Tues</span>
                                                        <span v-else class="text-danger btn btn-outline-danger">Tues</span>
                                                        <span v-if="restaurant.operation[0].wednesday == 1" class="text-success btn btn-outline-success">Wed</span>
                                                        <span v-else class="text-danger btn btn-outline-danger">Wed</span>
                                                        <span v-if="restaurant.operation[0].thursday == 1" class="text-success btn btn-outline-success">Thurs</span>
                                                        <span v-else class="text-danger btn btn-outline-danger">Thurs</span>
                                                        <span v-if="restaurant.operation[0].friday == 1" class="text-success btn btn-outline-success">Fri</span>
                                                        <span v-else class="text-danger btn btn-outline-danger">Fri</span>
                                                        <span v-if="restaurant.operation[0].saturday == 1" class="text-success btn btn-outline-success">Sat</span>
                                                        <span v-else class="text-danger btn btn-outline-danger">Sat</span>
                                                        <span v-if="restaurant.operation[0].sunday == 1" class="text-success btn btn-outline-success">Sun</span>
                                                        <span v-else class="text-danger btn btn-outline-danger">Sun</span>
                                                    </h6>
                                                </div>
                                                <div class="col-md-3 col-sm-6  col-6 facility" v-if="restaurant.facility[0] != null">
                                                    <h6 class="mb-3 text-muted">Facilities</h6>
                                                    <p class="text-success" v-if="restaurant.facility[0].home_delivery == 1"> <i class="fas fa-truck mr-1"></i> Home Delivery</p>
                                                    <p class="text-danger" v-else> <i class="fas fa-truck mr-1"></i> Home Delivery</p>
                                                    <p class="text-success" v-if="restaurant.facility[0].wifi == 1"> <i class="fas fa-wifi mr-1"></i> Wifi</p>
                                                    <p class="text-danger" v-else> <i class="fas fa-wifi mr-1"></i> Wifi</p>
                                                    <p class="text-success" v-if="restaurant.facility[0].card_payment == 1"> <i class="fab fa-cc-visa mr-1"></i>Card Payment</p>
                                                    <p class="text-danger" v-else> <i class="fab fa-cc-visa mr-1"></i>Card Payment</p>
                                                    <p class="text-success" v-if="restaurant.facility[0].party_booking == 1"><i class="fas fa-glass-cheers mr-1"></i>Party Booking</p>
                                                    <p class="text-danger" v-else><i class="fas fa-glass-cheers mr-1"></i>Party Booking</p>
                                                    <p class="text-success" v-if="restaurant.facility[0].ac == 1"> <i class="fas fa-fan mr-1"></i>AC</p>
                                                    <p class="text-danger" v-else> <i class="fas fa-fan mr-1"></i>AC</p>
                                                </div>
                                                <div class="col-md-3 col-sm-6 col-6 facility" v-if="restaurant.facility[0] != null">
                                                    <h6 class="mb-3 text-muted">More</h6>
                                                    <p class="text-success" v-if="restaurant.facility[0].roof_top == 1"><i class="fas fa-building mr-1"></i>Roof Top</p>
                                                    <p class="text-danger" v-else><i class="fas fa-building mr-1"></i>Roof Top</p>
                                                    <p class="text-success" v-if="restaurant.facility[0].veg == 1"> <i class="far fa-stop-circle mr-1"></i>Veg</p>
                                                    <p class="text-danger" v-else> <i class="far fa-stop-circle mr-1"></i>Veg</p>
                                                    <p class="text-success" v-if="restaurant.facility[0].none_veg == 1"> <i class="far fa-stop-circle mr-1"></i>Non Veg</p>
                                                    <p class="text-danger" v-else> <i class="far fa-stop-circle mr-1"></i>Non Veg</p>
                                                    <p class="text-success" v-if="restaurant.facility[0].parking_lot == 1"><i class="fas fa-car mr-1"></i>Parking Lot</p>
                                                    <p class="text-danger" v-else><i class="fas fa-car mr-1"></i>Parking Lot</p>
                                                    <p class="text-success" v-if="restaurant.facility[0].beverage == 1"> <i class="fas fa-beer mr-1"></i>Beverage</p>
                                                    <p class="text-danger" v-else> <i class="fas fa-beer mr-1"></i>Beverage</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Info -->
                                <div class="card my-2">
                                    <div  v-if="restaurant.description != null">
                                        <div class="row p-3" v-if="restaurant.description.length > 250">
                                            <div class="col-md-12">
                                                <h5 class="text-dark">Description</h5>
                                                <p class="text-muted">
                                                    {{restaurant.description}}
                                                </p>
                                            </div>
                                            <div class="col-md-12"> 
                                                <map-location :longitude="restaurant.longitude" :latitude="restaurant.latitude"></map-location>
                                            </div>
                                        </div>
                                        <div class="row p-3" v-else>
                                            <div class="col-md-6">
                                                <h5 class="text-dark">Description</h5>
                                                <p class="text-muted">
                                                    {{restaurant.description}}
                                                </p>
                                            </div>
                                            <div class="col-md-6"> 
                                                <map-location :longitude="restaurant.longitude" :latitude="restaurant.latitude"></map-location>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row p-3" v-else>
                                            <div class="col-md-12"> 
                                                <map-location :longitude="restaurant.longitude" :latitude="restaurant.latitude"></map-location>
                                            </div>
                                    </div>
                                </div>
                                <!-- Menu Photo -->
                                <div class="card my-2">
                                    <menu-photo v-bind:menu_photos="restaurant.menu_photos"></menu-photo>
                                </div>
                                <!-- Food Photo -->
                                <div class="card my-2">
                                    <food-photo v-bind:food_photos="restaurant.food_photos"></food-photo>
                                </div>
                                <!-- comments -->
                                <restaurant-comment v-bind:restaurant="restaurant.id" :avg_rate="restaurant.rating"></restaurant-comment>
                                <!-- ad -->
                                <PopupAd></PopupAd>
                            </div>
                        <!-- Sidebar -->
                            <div class="col-md-4 col-sm-12" id="sidebar">
                                <!-- <sidebar></sidebar> -->
                                <restaurant-sidebar :location="location" :id="restaurant.id"></restaurant-sidebar>
                                <rent-sidebar :location="location"></rent-sidebar>
                                <sale-sidebar :location="location"></sale-sidebar>
                                <event-sidebar :location="location"></event-sidebar>
                                <job-sidebar :location="location"></job-sidebar>
                                <service-sidebar :location="location"></service-sidebar>
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
    // Sidebars
    import SaleSidebar  from '../Sidebar/Sale.vue';
    import EventSidebar from '../Sidebar/event.vue';
    import JobSidebar from '../Sidebar/job.vue';
    import RentSidebar from '../Sidebar/rent.vue';
    import RestaurantSidebar from '../Sidebar/restaurant.vue';
    import ServiceSidebar from '../Sidebar/service.vue';
    import PopupAd from '../PopupAd/Restaurant';
    // Map
    export default {
            props:['restaurant_id'],
            /**
             * Data
             *  */ 
            data(){
                return{
                    rate:0,
                    // Loading
                    loading:false,
                    isLoading : false,//Lazy loading
                    // Object
                    restaurant:{}, //individual show
                    location:'',
                    id:this.restaurant_id.id,
                    // /**
                    //  * Comments
                    //  * Current Page 
                    //  * pagination
                    //  * last page
                    //  *  */ 
                    // comments:{},
                    // nextPage:2,
                    // load_more_button : true,
                    // total_comments:0,
                    // comments_lazy_load:false,
                    sharing: {
                        url: '',
                        title: '',
                        description: ''
                    },
                    networks: [
                            { network: 'facebook', name: 'Facebook', icon: 'fab fah fa-lg fa-facebook-f', color: '#1877f2' },
                        ]
                }
            },
            /**
             * 
             * Components
             *  */  
            components:{Loading,SaleSidebar,EventSidebar,JobSidebar,RentSidebar,RestaurantSidebar,ServiceSidebar,PopupAd},
            /**
             * Methods
             *  */ 
            methods:{
                show(){  
                    this.isLoading = true; //Loading true
                    axios.get('/api/restaurant/view/'+this.id)
                    .then(response=>{
                        this.restaurant = response.data.data;
                        // location
                        this.location = this.restaurant.location;
                        // loading
                        this.isLoading = false; //Loading true
                        this.loading = true;
                    })
                }
        },
        // Mounted
        mounted(){
            this.show();
        }
    }
</script>