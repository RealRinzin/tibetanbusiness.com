<template>
    <div style="min-height:80vh">
        <vue-headful
        :title="sale.name"
        :description="sale.location"
        :image="sale.banner"
        lang="langauge"
        url="https://tibetanbusiness.com"
        />
        <div id="restaurant">
            <div v-if="!loading">
                <loading :active.sync="isLoading"></loading>
            </div>
            <div v-else>
                <div  class="container py-4" id="sale">
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
                                                <ul class="detail">
                                                    <li class="btn btn-danger btn-md">Price: <i class="fas fa-rupee-sign mr-1"></i>{{sale.price}}/</li>
                                                </ul>
                                            </div>
                                            </div>                                
                                        </div>
                                        <!-- Overview -->
                                        <div class="col-md-12">
                                            <div class="row p-3 overview">
                                                    <div class="col-md-6 col-sm-6">
                                                        <h6 class="text-muted py-1"><i class="fas fa-calendar-alt mr-2"></i>{{sale.name}}</h6>
                                                        <h6 class="text-muted py-1"><i class="fas fa-phone-square-alt pr-2"></i>+91-{{sale.mobile_no}}</h6>
                                                        <h6 class="text-muted"><i class="fas  fa-map-pin mr-2"></i>{{sale.location}}</h6>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Info -->
                                <div class="card">
                                    <div class="row p-3">
                                        <div class="col-md-6">
                                            <h5 class="text-dark">Brief</h5>
                                            <p class="text-muted">
                                                {{sale.description}}
                                            </p>
                                        </div>
                                        <div class="col-md-6"> 
                                            <h6>Location</h6>
                                            <!-- <geo-map></geo-map> -->
                                        </div>
                                    </div>
                                </div>
                                <!--  Photo -->
                                <div class="card">
                                    <photo :sale_id="id"></photo>
                                </div>
                            </div>
                        <!-- Sidebar -->
                            <div class="col-md-4 col-sm-12">
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
// import EventReview from './Review.vue';
// import format from 'date-fns/format';
import { compareAsc, format } from 'date-fns';

export default {
    props:['sale_id'],
    data(){
        return{
            id:this.sale_id.id,
            sale:{}, //sale objects
            isLoading : false,//Lazy loading
            loading:false, //loading
            rating:0,
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
    components:{Loading,Photo},
    mounted(){
        this.load_sale();
    }
}
</script>