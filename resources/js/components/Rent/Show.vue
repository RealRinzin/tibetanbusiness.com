<template>
    <div style="min-height:80vh">
        <div id="restaurant">
            <div v-if="!loading">
                <loading :active.sync="isLoading"></loading>
            </div>
            <div v-else>
                <div  class="container py-1">
                    <div class="row">
                            <div class="col-md-8 col-sm-12">
                                <!-- basic -->
                                <div class="card">
                                    <div class="row">
                                        <!-- Banner -->
                                        <div class="col-md-12">
                                            <div class="banner" v-bind:style='{ backgroundImage: `url(/storage/Rent/Banner/${rent.banner})`}'>
                                            <div class="overlay">
                                                <h6 class="font-weight-bold position-absolute btn btn-danger">Rs: {{rent.fare}} /-</h6>
                                                <ul>
                                                    <li v-if="rent.rating >0"><a class="btn-secondary btn text-white"><i class="fas fa-star pr-1 text-warning"></i>{{rent.rating}}</a></li>
                                                    <li v-if="rent.facebook != null"><a :href="rent.facebook"><i class="fab fa-facebook-square fa-2x btn-primary btn"></i></a></li>
                                                    <li v-if="rent.instagram != null"><a :href="rent.instagram"><i class="fab fa-instagram fa-2x btn-danger btn"></i></a></li>
                                                </ul>
                                            </div>
                                            </div>                                
                                        </div>
                                        <!-- Overview -->
                                        <div class="col-md-12">
                                            <div class="row p-3 overview">
                                                    <div class="col-md-12 col-12">
                                                        <h6 class="text-muted py-1"><i class="fas fa-home mr-2"></i>{{rent.name}}</h6>
                                                        <h6 class="text-muted py-1"><i class="fas fa-phone-square-alt pr-2"></i>{{rent.mobile_no}}</h6>
                                                        <h6 class="text-muted"><i class="fas  fa-map-pin mr-2"></i>{{rent.location}}</h6>
                                                        <h6 class="text-muted"><i class="fas fa-users mr-2"></i>{{rent.accomodation_size}} people</h6>
                                                    </div>
                                                <div class="col-md-3 col-sm-4 col-4 facility" v-if="rent.facility[0]!= null">
                                                    <h6 class="mb-3 text-muted">Facilities</h6>
                                                    <p class="text-success" v-if="rent.facility[0].geyser == 1"> <i class="fas fa-subway mr-1"></i> Geyser</p>
                                                    <p class="text-danger" v-else> <i class="fas fa-subway mr-1"></i>Geyser</p>
                                                    <p class="text-success" v-if="rent.facility[0].wifi == 1"> <i class="fas fa-wifi mr-1"></i> Wifi</p>
                                                    <p class="text-danger" v-else> <i class="fas fa-wifi mr-1"></i> Wifi</p>
                                                    <p class="text-success" v-if="rent.facility[0].ac == 1"> <i class="fas fa-fan mr-1"></i>AC</p>
                                                    <p class="text-danger" v-else> <i class="fas fa-fan mr-1"></i>AC</p>
                                                    <p class="text-success" v-if="rent.facility[0].washing_machine == 1"><i class="fas fa-power-off mr-1"></i>Washing Machine</p>
                                                    <p class="text-danger" v-else><i class="fas fa-power-off mr-1"></i>Washing Machine</p>
                                                    <p class="text-success" v-if="rent.facility[0].gym == 1"> <i class="fas fa-dumbbell mr-1"></i>Gym</p>
                                                    <p class="text-danger" v-else> <i class="fas fa-dumbbell mr-1"></i>Gym</p>
                                                    <p class="text-success" v-if="rent.facility[0].pet_allowed == 1"> <i class="fas fa-dog mr-1"></i>Pet Allowed</p>
                                                    <p class="text-danger" v-else> <i class="fas fa-dog mr-1"></i>Pet Allowed</p>
                                                </div>
                                                <div class="col-md-3 col-sm-4 col-4 facility" v-if="rent.facility[0] != null">
                                                    <h6 class="mb-3 text-muted">More</h6>
                                                    <p class="text-success" v-if="rent.facility[0].single_room  == 1"><i class="fas fa-bed mr-1"></i>Single Room</p>
                                                    <p class="text-danger" v-else><i class="fas fa-bed mr-1"></i>Single Room</p>
                                                    <p class="text-success" v-if="rent.facility[0].double_room  == 1"> <i class="fas fa-bed mr-1"></i>Double Room</p>
                                                    <p class="text-danger" v-else> <i class="fas fa-bed mr-1"></i>Double Room</p>
                                                    <p class="text-success" v-if="rent.facility[0].fridge  == 1"> <i class="fas fa-box mr-1"></i> Fridge</p>
                                                    <p class="text-danger" v-else> <i class="fas fa-box mr-1"></i>Fridge</p>
                                                    <p class="text-success" v-if="rent.facility[0].garden == 1"><i class="fas fa-tree mr-1"></i>Garden</p>
                                                    <p class="text-danger" v-else><i class="fas fa-tree mr-1"></i> Garden</p>
                                                    <p class="text-success" v-if="rent.facility[0].parking_space == 1"> <i class="fas fa-car mr-1"></i>Parking Space</p>
                                                    <p class="text-danger" v-else> <i class="fas fa-car mr-1"></i>Parking Space</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Info -->
                                <div class="card my-2">
                                    <div class="row p-3">
                                        <div class="col-md-6" v-if="rent.description">
                                            <h5 class="text-dark">Brief</h5>
                                            <p class="text-muted">
                                                {{rent.description}}
                                            </p>
                                        </div>
                                        <div class="col-md-6"> 
                                            <h6>Location</h6>
                                            <map-location :longitude="rent.longitude" :latitude="rent.latitude"></map-location>
                                        </div>
                                    </div>
                                </div>
                                <!-- Room Photo -->
                                <div class="card my-2">
                                    <rent-room-photo v-bind:rent_room_photos="rent.room_photos"></rent-room-photo>
                                </div>
                                <!-- Room Photo -->
                                <div class="card my-2">
                                    <rent-view-photo v-bind:rent_view_photos="rent.view_photos"></rent-view-photo>
                                </div>
                                <!-- comments -->
                                    <rent-comment v-bind:rent_uuid="rent.id" :avg_rating="rent.rating"></rent-comment>
                            </div>
                        <!-- Sidebar -->
                            <div class="col-md-4 col-sm-12" id="sidebar">
                                <rent-sidebar :location="location" :id="id"></rent-sidebar>
                                <sale-sidebar :location="location"></sale-sidebar>
                                <event-sidebar :location="location"></event-sidebar>
                                <job-sidebar :location="location"></job-sidebar>
                                <restaurant-sidebar :location="location"></restaurant-sidebar>
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
export default {
    props:['rent_id'],
    data(){
        return{
            id:this.rent_id['id'], //Rent Id
            rent:{}, //rent objects
            isLoading : false,//Lazy loading
            loading:false, //loading
            location:''
        }
    },
    methods:{
        load_rent(){
            this.isLoading = true;
            axios.get('/api/rent/view/'+this.id)
            .then(response=>{
                this.rent = response.data.data;
                this.isLoading = false;
                this.loading = true;
                this.location = this.rent.location;

            })
        }
    },
    // Components 
    components:{Loading,SaleSidebar,EventSidebar,JobSidebar,RentSidebar,RestaurantSidebar,ServiceSidebar},
    mounted(){
        this.load_rent();
    }
}
</script>