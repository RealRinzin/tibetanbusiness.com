<template>
    <div style="min-height:80vh">
        <div id="restaurant" style="min-height:100vh">
            <div v-if="!loading">
                <loading :active.sync="isLoading"></loading>
            </div>
            <div v-else>
                <div  class="container py-1" id="sale">
                    <div class="row">
                            <div class="col-md-8 col-sm-12">
                                <!-- basic -->
                                <div class="card">
                                    <div class="row">
                                        <!-- Banner -->
                                        <div class="col-md-12">
                                            <div class="banner lazyload" :data-bgset="'/storage/Sale/Banner/'+sale.banner" data-sizes="auto">
                                            <div class="overlay title">
                                                <h6 class="font-weight-bold position-absolute  btn btn-danger"> {{sale.name}}</h6>
                                                <button class="btn btn-warning position-absolute float-right font-weight-bolder" style="bottom:10px;right:10px">
                                                    Price:
                                                    <span v-if="sale.price > 0">&#x20B9 {{sale.price}}/-</span>
                                                    <span v-else> <i class="fas fa-phone-alt mr-1"></i> Call </span>
                                                </button>
                                            </div>
                                            </div>                                
                                        </div>
                                        <!-- Overview -->
                                        <div class="col-md-12">
                                            <div class="row p-3 overview">
                                                    <div class="col-md-6 col-sm-6">
                                                        <h6 class="text-dark py-1 font-weight-bolder"><i class="fas fa-calendar-alt mr-2"></i>{{sale.name}}</h6>
                                                        <h6 class="text-muted py-1"><i class="fas fa-phone-square-alt pr-2"></i>+91-{{sale.mobile_no}}</h6>
                                                        <h6 class="text-muted"><i class="fas  fa-map-pin mr-2"></i>{{sale.location}}</h6>
                                                        <h6 class="text-muted"><i class="fas fa-map-marked-alt mr-2"></i>{{sale.address}}</h6>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Info -->
                                <div class="card my-2">
                                    <div  v-if="sale.description != null">
                                        <div class="row p-3" v-if="sale.description.length > 250">
                                            <div class="col-md-12">
                                                <h5 class="text-dark">Description</h5>
                                                <p class="text-muted">
                                                    {{sale.description}}
                                                </p>
                                            </div>
                                            <div class="col-md-12"> 
                                                <map-location :longitude="sale.longitude" :latitude="sale.latitude"></map-location>
                                            </div>
                                        </div>
                                        <div class="row p-3" v-else>
                                            <div class="col-md-6">
                                                <h5 class="text-dark">Description</h5>
                                                <p class="text-muted">
                                                    {{sale.description}}
                                                </p>
                                            </div>
                                            <div class="col-md-6"> 
                                                <map-location :longitude="sale.longitude" :latitude="sale.latitude"></map-location>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row p-3" v-else>
                                            <div class="col-md-12"> 
                                                <map-location :longitude="sale.longitude" :latitude="sale.latitude"></map-location>
                                            </div>
                                    </div>
                                </div>
                                <!--  Photo -->
                                <div class="card my-2">
                                    <photo :sale_id="id"></photo>
                                </div>
                                <!-- Ad -->
                                <PopupAd></PopupAd>
                            </div>
                        <!-- Sidebar -->
                            <div class="col-md-4 col-sm-12" id="sidebar">
                                <sale-sidebar :location="location" :sale_id="id"></sale-sidebar>
                                <event-sidebar :location="location"></event-sidebar>
                                <job-sidebar :location="location"></job-sidebar>
                                <rent-sidebar :location="location"></rent-sidebar>
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
import Photo from './Photo.vue';
// Sidebars
import SaleSidebar  from '../Sidebar/Sale.vue';
import EventSidebar from '../Sidebar/event.vue';
import JobSidebar from '../Sidebar/job.vue';
import RentSidebar from '../Sidebar/rent.vue';
import RestaurantSidebar from '../Sidebar/restaurant.vue';
import ServiceSidebar from '../Sidebar/service.vue';
import PopupAd from '../PopupAd/Sale';
// Date
import {format } from 'date-fns';

export default {
    props:['sale_id'],
    data(){
        return{
            id:this.sale_id.id,
            sale:{}, //sale objects
            isLoading : false,//Lazy loading
            loading:false, //loading
            rating:0,
            location:'',
        }
    },
    methods:{
        load_sale(){
            this.isLoading = true;
            axios.get('/api/sale/view/'+this.id)
            .then(response=>{
                this.sale = response.data.data;
                this.isLoading = false;
                this.loading = true;
                this.location = this.sale.location;
            })
        },
    },
    // Filter
    filters:{
        date(str){
            return format(new Date(str), 'EE, MMM dd, yyyy');
        }
    },
    // Components
    components:{Loading,Photo,SaleSidebar,EventSidebar,JobSidebar,RentSidebar,RestaurantSidebar,ServiceSidebar,PopupAd},
    mounted(){
        this.load_sale();
    }
}
</script>