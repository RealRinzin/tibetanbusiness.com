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
                                                <button class="btn btn-warning position-absolute float-right font-weight-bolder" style="bottom:10px;right:10px">Price:₹{{sale.price}}</button>
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
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Info -->
                                <div class="card my-2">
                                    <div class="row p-3">
                                        <div class="col-md-6" v-if="sale.description">
                                            <h5 class="text-dark">Brief</h5>
                                            <p class="text-muted">
                                                {{sale.description}}
                                            </p>
                                        </div>
                                        <div class="col-md-6"> 
                                            <h6>Location</h6>
                                            <map-location :longitude="sale.longitude" :latitude="sale.latitude"></map-location>
                                        </div>
                                    </div>
                                </div>
                                <!--  Photo -->
                                <div class="card my-2">
                                    <photo :sale_id="id"></photo>
                                </div>
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
// Date
import { compareAsc, format } from 'date-fns';
import Rent from '../Home/Featured/Rent.vue';

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
    // Meta
    // metaInfo() {
    //     return { 
    //         title: this.sale.name,
    //         meta: [
    //             {name: 'description', content:  this.sale.location+'Epiloge is about connecting in your field of interest. Our vision is to help people share their knowledge, work, projects, papers and ideas and build their network through what they do rather where they live, study or work.'},
    //             {property: 'og:title', content: this.sale.name},
    //             {property: 'og:url', content: 'https://'+window.location.hostname+'/sale/'+this.sale.id}, 
    //             {property: 'og:site_name', content: 'tibetanbusiness.com'},
    //             {property: 'og:type', content: 'website'}, 
    //             {property: 'og:image', content: 'https://'+window.location.hostname+'/storage/Sale/Banner/'+this.sale.banner},
    //             {property:'og:image:alt', content: this.sale.name},
    //             {property:'og:image:height', content: "400"},
    //             {property:'og:image:width', content: "600"}
    //         ]
    //     }
    // },
    // Components
    components:{Loading,Photo,SaleSidebar,EventSidebar,JobSidebar,RentSidebar,RestaurantSidebar,ServiceSidebar},
    mounted(){
        this.load_sale();
    }
}
</script>