<template>
    <div style="min-height:80vh">
        <div id="restaurant">
            <div v-if="!loading">
                <loading :active.sync="isLoading"></loading>
            </div>
            <div v-else>
                <div  class="container py-1" id="service">
                    <div class="row">
                            <div class="col-md-8 col-sm-12">
        
                                <div>
                                    <Adsense
                                    ins-style="display:inline-block;width:728px;height:90px !important"
                                data-ad-client="ca-pub-4861711653689806"
                                data-ad-slot="6351396218">
                            </Adsense>
                                        <!-- basic -->

                                </div>
                                <div class="card">
                                    <div class="row">
                                        <!-- Banner -->
                                        <div class="col-md-12">
                                            <div class="banner lazyload" :data-bgset="'/storage/Service/Banner/'+service.banner" data-sizes="auto">
                                            <div class="overlay title">
                                                <h6 class="font-weight-bold position-absolute  btn btn-danger"> {{service.name}}</h6>
                                                <ul>
                                                    <li v-if="service.rating >0"><a class="btn-secondary btn text-white"><i class="fas fa-star pr-1 text-warning"></i>{{service.rating}}</a></li>
                                                    <li v-if="service.facebook"><a target="_blank"  :href="service.facebook"><i class="fab fa-facebook-square fa-2x btn-primary btn"></i></a></li>
                                                    <li v-if="service.website"><a target="_blank"  :href="service.website"><i class="fab fa-internet-explorer fa-2x btn-secondary btn"></i></a></li>
                                                    <li v-if="service.instagram"><a target="_blank"  :href="service.instagram"><i class="fab fa-instagram fa-2x btn-danger btn"></i></a></li>
                                                </ul>
                                            </div>
                                            </div>                                
                                        </div>
                                        <!-- Overview -->
                                        <div class="col-md-12">
                                            <div class="row p-3 overview">
                                                    <div class="col-md-6 col-sm-6">
                                                        <h6 class="text-muted py-1"><i class="fas fa-calendar-alt mr-2"></i>{{service.name}}</h6>
                                                        <h6 class="text-muted py-1"><i class="fas fa-phone-square-alt pr-2"></i>+91-{{service.mobile_no}}</h6>
                                                        <h6 class="text-muted"><i class="fas fa-map-pin mr-2"></i>{{service.location}}</h6>
                                                        <h6 class="text-muted"><i class="fas fa-map-marked-alt mr-2"></i>{{service.address}}</h6>
                                                        <h6 class="text-muted pt-1" v-if="working_day != null">
                                                        <span v-if="working_day.monday" class="text-success btn btn-outline-success" >Mon</span>
                                                        <span v-else class="text-danger btn btn-outline-danger">Mon</span>
                                                        <span v-if="working_day.tuesday" class="text-success btn btn-outline-success" >Tues</span>
                                                        <span v-else class="text-danger btn btn-outline-danger">Tues</span>
                                                        <span v-if="working_day.wednesday" class="text-success btn btn-outline-success">Wed</span>
                                                        <span v-else class="text-danger btn btn-outline-danger">Wed</span>
                                                        <span v-if="working_day.thursday" class="text-success btn btn-outline-success">Thurs</span>
                                                        <span v-else class="text-danger btn btn-outline-danger">Thurs</span>
                                                        <span v-if="working_day.friday" class="text-success btn btn-outline-success">Fri</span>
                                                        <span v-else class="text-danger btn btn-outline-danger">Fri</span>
                                                        <span v-if="working_day.saturday" class="text-success btn btn-outline-success">Sat</span>
                                                        <span v-else class="text-danger btn btn-outline-danger">Sat</span>
                                                        <span v-if="working_day.sunday" class="text-success btn btn-outline-success">Sun</span>
                                                        <span v-else class="text-danger btn btn-outline-danger">Sun</span>
                                                    </h6>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Info -->
                                <div class="card my-2">
                                    <div  v-if="service.description != null">
                                        <div class="row p-3" v-if="service.description.length > 250">
                                            <div class="col-md-12">
                                                <h5 class="text-dark">Description</h5>
                                                <p class="text-muted">
                                                    {{service.description}}
                                                </p>
                                            </div>
                                            <div class="col-md-12"> 
                                                <map-location :longitude="service.longitude" :latitude="service.latitude"></map-location>
                                            </div>
                                        </div>
                                        <div class="row p-3" v-else>
                                            <div class="col-md-6">
                                                <h5 class="text-dark">Description</h5>
                                                <p class="text-muted">
                                                    {{service.description}}
                                                </p>
                                            </div>
                                            <div class="col-md-6"> 
                                                <map-location :longitude="service.longitude" :latitude="service.latitude"></map-location>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row p-3" v-else>
                                            <div class="col-md-12"> 
                                                <map-location :longitude="service.longitude" :latitude="service.latitude"></map-location>
                                            </div>
                                    </div>
                                </div>
                                <!--  Photo -->
                                <div class="card my-2">
                                    <photo :service_id="id"></photo>
                                </div>
                                <!-- comments -->
                                <review :service_id="id" :rating="rating" :avg_rating="service.rating"></review>
                                <!-- Ad -->
                                <PopupAd></PopupAd>
                            </div>
                        <!-- Sidebar -->
                            <div class="col-md-4 col-sm-12" id="sidebar">
                                <service-sidebar :location="location" :id="service.id"></service-sidebar>
                                <sale-sidebar :location="location"></sale-sidebar>
                                <event-sidebar :location="location"></event-sidebar>
                                <job-sidebar :location="location"></job-sidebar>
                                <rent-sidebar :location="location"></rent-sidebar>
                                <restaurant-sidebar :location="location"></restaurant-sidebar>
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
import Photo from './Photo.vue';
import Review from './Review.vue';
import format from 'date-fns/format';
// Sidebars
import SaleSidebar  from '../Sidebar/Sale.vue';
import EventSidebar from '../Sidebar/event.vue';
import JobSidebar from '../Sidebar/job.vue';
import RentSidebar from '../Sidebar/rent.vue';
import RestaurantSidebar from '../Sidebar/restaurant.vue';
import ServiceSidebar from '../Sidebar/service.vue';
import PopupAd from '../PopupAd/Service';
export default {
    props:['service_id'],
    data(){
        return{
            id:this.service_id.id,
            service:{}, //service objects
            isLoading : false,//Lazy loading
            loading:false, //loading
            location:'',
            rating:0,
            working_day:{},
        }
    },
    methods:{
        load_service(){
            this.isLoading = true;
            axios.get('/api/service/view/'+this.id)
            .then(response=>{
                this.location = response.data.data.location;
                this.service = response.data.data;
                this.isLoading = false;
                this.loading = true;
            })
        },
        operation_day(){
            axios.get('/api/service_working_day/'+this.id+'/working_day')
            .then(response=>{
                this.working_day = response.data[0];
            })
        },
    },
    // Filer
    filters:{
        date(str){
            return format(new Date(str), 'EE, MMM dd, yyyy');
        }
    },
    // Components
    components:{Loading,Photo,Review,SaleSidebar,EventSidebar,JobSidebar,RentSidebar,RestaurantSidebar,ServiceSidebar,PopupAd},
    mounted(){
        this.load_service();
        this.operation_day();

    }
}
</script>