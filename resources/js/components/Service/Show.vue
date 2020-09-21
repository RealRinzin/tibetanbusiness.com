<template>
    <div style="min-height:80vh">
        <vue-headful
        :title="service.name"
        :description="service.location"
        :image="service.banner"
        lang="langauge"
        url="https://tibetanbusiness.com"
        />
        <div id="restaurant">
            <div v-if="!loading">
                <loading :active.sync="isLoading"></loading>
            </div>
            <div v-else>
                <div  class="container py-4" id="service">
                    <div class="row">
                            <div class="col-md-8 col-sm-12">
                                <!-- basic -->
                                <div class="card">
                                    <div class="row">
                                        <!-- Banner -->
                                        <div class="col-md-12">
                                            <div class="banner lazyload" :data-bgset="'/storage/Service/Banner/'+service.banner" data-sizes="auto">
                                            <div class="overlay title">
                                                <h6 class="font-weight-bold position-absolute  btn btn-danger"> {{service.name}}</h6>
                                                <ul>
                                                    <li v-if="service.rating >0"><a class="btn-secondary btn text-white"><i class="fas fa-star pr-1 text-warning"></i>{{service.rating}}</a></li>
                                                    <li v-if="service.facebook != null"><a :href="'//'+service.facebook"><i class="fab fa-facebook-square fa-2x btn-primary btn"></i></a></li>
                                                    <li v-if="service.website != null"><a :href="'//'+service.website"><i class="fab fa-internet-explorer fa-2x btn-secondary btn"></i></a></li>
                                                    <li v-if="service.instagram != null"><a :href="'//'+service.instagram"><i class="fab fa-instagram fa-2x btn-danger btn"></i></a></li>
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
                                                        <h6 class="text-muted"><i class="fas  fa-map-pin mr-2"></i>{{service.location}}</h6>
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
                                <div class="card my-2" v-if="service.description !=null">
                                    <div class="row p-3">
                                        <div class="col-md-6">
                                            <h5 class="text-dark">Brief</h5>
                                            <p class="text-muted">
                                                {{service.description}}
                                            </p>
                                        </div>
                                        <div class="col-md-6"> 
                                            <h6>Location</h6>
                                            <!-- <geo-map></geo-map> -->
                                        </div>
                                    </div>
                                </div>
                                <!--  Photo -->
                                <div class="card my-2">
                                    <photo :service_id="id"></photo>
                                </div>
                                <!-- comments -->
                                <review :service_id="id" :rating="rating" :avg_rating="service.rating"></review>
                            </div>
                        <!-- Sidebar -->
                            <div class="col-md-4 col-sm-12">
                                <!-- sidebar -->
                                <sidebar></sidebar>
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
export default {
    props:['service_id'],
    data(){
        return{
            id:this.service_id.id,
            service:{}, //service objects
            isLoading : false,//Lazy loading
            loading:false, //loading
            rating:0,
            working_day:{},
        }
    },
    methods:{
        load_service(){
            this.isLoading = true;
            axios.get('/api/service/view/'+this.id)
            .then(response=>{
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
    components:{Loading,Photo,Review},
    mounted(){
        this.load_service();
        this.operation_day();

    }
}
</script>