<template>
    <div class="row">
        <!-- Event -->
        <div class="col-md-10 mx-auto my-4" v-if="event_loading">
            <h6 class="small text-muted py-2 font-weight-bolder"><img src="/img/event.png" class="mr-2" alt="">POPULAR EVENTS</h6>
            <swiper class="row swiper" :options="settings">
                    <swiper-slide class="col-md-3 col-sm-6 col-6" v-for="(event,index) in events" :key="index">
                        <div class="card">
                            <a v-bind:href="'event/'+event.id">
                            <div class="banner rounded-top lazyload" :data-bgset="'/storage/event/Banner/'+event.banner"  data-sizes="auto"></div>
                            </a>
                            <div class="info p-2">
                                <h5>{{event.name}}</h5>
                                <h6 class="pt-1">{{event.mobile_no}}</h6>
                                <h6>{{event.location}}</h6>
                            </div>
                        </div>
                    </swiper-slide>
                    <div class="swiper-button-prev" slot="button-prev"></div>
                    <div class="swiper-button-next" slot="button-next"></div>
            </swiper>
        </div>
        <!-- Sales -->
        <div class="col-md-10 mx-auto my-4" v-if="sale_loading">
            <h6 class="small text-muted py-2 font-weight-bolder"><img src="/img/sale.png" class="mr-2" alt="">POPULAR SALES</h6>
            <swiper class="row swiper" :options="settings">
                <swiper-slide class="col-md-3 col-sm-6 col-6" v-for="(sale,index) in sales" :key="index">
                    <div class="card">
                        <a v-bind:href="'sale/'+sale.id">
                        <div class="banner rounded-top lazyload" :data-bgset="'/storage/Sale/Banner/'+sale.banner"  data-sizes="auto"></div>
                        </a>
                        <div class="info p-1">
                            <h5>{{sale.name}}</h5>
                            <h5 class="pt-1 text-muted"><i class="fas fa-rupee-sign"></i> {{sale.price}}</h5>
                            <h6>{{sale.mobile_no}}</h6>
                            <h6>{{sale.location}}</h6>
                        </div>
                    </div>
                </swiper-slide>
                    <div class="swiper-button-prev" slot="button-prev"></div>
                    <div class="swiper-button-next" slot="button-next"></div>
            </swiper>
        </div>
        <!-- Rents -->
        <div class="col-md-10 mx-auto my-4" v-if="rent_loading">
            <h6 class="small text-muted py-2 font-weight-bolder"><img src="/img/rent.png" class="mr-2" alt="">POPULAR RENTS</h6>
            <swiper class="row swiper" :options="settings" >
                <swiper-slide class="col-md-3 col-sm-6 col-6" v-for="(rent,index) in rents" :key="index">
                    <div class="card">
                        <a v-bind:href="'rent/'+rent.id">
                        <div class="banner rounded-top lazyload" :data-bgset="'/storage/Rent/Banner/'+rent.banner"  data-sizes="auto"></div>
                        </a>
                        <div class="info p-2">
                            <h5>{{rent.name}}</h5>
                            <h5 class="pt-1 text-muted"><i class="fas fa-rupee-sign"></i> {{rent.fare}}</h5>
                            <h6>{{rent.mobile_no}}</h6>
                            <h6>{{rent.location}}</h6>
                        </div>
                    </div>
                </swiper-slide>
                    <div class="swiper-button-prev" slot="button-prev"></div>
                    <div class="swiper-button-next" slot="button-next"></div>
            </swiper>
        </div>
        <!-- Jobs -->
        <div class="col-md-10 mx-auto my-4" v-if="job_loading">
            <h6 class="small text-muted py-2 font-weight-bolder"><img src="/img/job.png" class="mr-2" alt="">AVAILABLE JOBS</h6>
            <swiper class="row swiper" :options="settings">
                <swiper-slide class="col-md-3 col-sm-6 col-6" v-for="(job,index) in jobs" :key="index">
                    <div class="card">
                        <a v-bind:href="'job/'+job.id">
                        <div class="banner rounded-top lazyload" :data-bgset="'/storage/Job/Banner/'+job.banner"  data-sizes="auto"></div>
                        </a>
                        <div class="info p-1">
                            <h5>{{job.title}}</h5>
                            <h6 class="pt-1">{{job.mobile_no}}</h6>
                            <h6>{{job.location}}</h6>
                        </div>
                    </div>
                </swiper-slide>
                    <div class="swiper-button-prev" slot="button-prev"></div>
                    <div class="swiper-button-next" slot="button-next"></div>
            </swiper>
        </div>
        <!-- Services -->
        <div class="col-md-10 mx-auto my-4" v-if="service_loading">
            <h6 class="small text-muted py-2 font-weight-bolder"><img src="/img/service.png" class="mr-2" alt="">POPULAR SERVICES</h6>
            <swiper class="row swiper" :options="settings">
                <swiper-slide class="col-md-3 col-sm-6 col-6" v-for="(service,index) in services" :key="index">
                    <div class="card">
                        <a v-bind:href="'service/'+service.id">
                        <div class="banner rounded-top lazyload" :data-bgset="'/storage/Service/Banner/'+service.banner"  data-sizes="auto"></div>
                        </a>
                        <div class="info p-1">
                            <h5>{{service.name}}</h5>
                            <h6 class="pt-1">{{service.mobile_no}}</h6>
                            <h6>{{service.location}}</h6>
                        </div>
                    </div>
                </swiper-slide>
                    <div class="swiper-button-prev" slot="button-prev"></div>
                    <div class="swiper-button-next" slot="button-next"></div>
            </swiper>
        </div>
        <!-- Restaurants -->
        <div class="col-md-10 mx-auto my-4" v-if="restaurant_loading">
            <h6 class="small text-muted py-2 font-weight-bolder"><img src="/img/restaurant.png" class="mr-2" alt="">POPULAR RESTAURANTS</h6>
            <swiper class="row swiper" :options="settings">
                    <swiper-slide class="col-md-3 col-sm-6 col-6" v-for="(restaurant,index) in restaurants" :key="index">
                        <div class="card">
                            <a v-bind:href="'restaurant/'+restaurant.id">
                            <div class="banner rounded-top lazyload" :data-bgset="'/storage/Restaurant/Banner/'+restaurant.banner"  data-sizes="auto"></div>
                            </a>
                            <div class="info p-2">
                                <h5>{{restaurant.name}}</h5>
                                <h6 class="pt-1">{{restaurant.mobile_no}}</h6>
                                <h6>{{restaurant.location}}</h6>
                            </div>
                        </div>
                    </swiper-slide>
                    <div class="swiper-button-prev" slot="button-prev"></div>
                    <div class="swiper-button-next" slot="button-next"></div>
            </swiper>
        </div>
    </div>
</template>
<script>
import { Swiper, SwiperSlide } from 'vue-awesome-swiper';
export default {
    data(){
        return{
            // object
            events:{},
            rents:{},
            sales:{},
            jobs:{},
            services:{},
            restaurants:{},
            // loading
            event_loading:false,
            sale_loading:false,
            rent_loading:false,
            job_loading:false,
            service_loading:false,
            restaurant_loading:false,
            // Swiper Carousel
            settings:{
                // slidesPerView: 4,
                spaceBetween: 10,
                slidesPerGroup: 2,
                loop: true,
                breakpoints: {
                    1024: {
                    slidesPerView: 4,
                    spaceBetween: 10
                    },
                    768: {
                    slidesPerView: 3,
                    spaceBetween: 10
                    },
                    640: {
                    slidesPerView: 2,
                    spaceBetween: 10
                    },
                    320: {
                    slidesPerView: 1,
                    spaceBetween: 5,
                    slidesPerGroup: 1,
                    }
                },
                // loopFillGroupWithBlank: true,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev'
                }
            }
        }
    },
    // methods / Functions
    methods:{
        // events
        event_list(){
            // home advertisment
            axios.get('api/event/list/home_ad')
            .then(response=>{
                // this.isLoading = true; //Loading true
                this.events = response.data;
                if(response.data.length > 0){
                    this.event_loading = true;
                    this.events = response.data;

                }else{
                    axios.get('/api/event/list/all').then(response=>{
                        this.event_loading = true;
                        this.events = response.data;
                    })
                }
            })
        },
        // Sales
        sale_list(){
            // home advertisment
            axios.get('api/sale/list/home_ad')
            .then(response=>{
                this.sale_loading = true;
                if(response.data.length > 0){
                    this.sales = response.data;
                }else{
                    axios.get('/api/sale/list/all').then(response=>{
                        this.sales = response.data;
                        this.sale_loading = true;
                    })
                }
            })
        },
        rent_list(){
            // home advertisment
            axios.get('api/rent/list/home_ad')
            .then(response=>{
                if(response.data.length > 0){
                    this.rent_loading = true;
                    this.rents = response.data;
                }else{
                    axios.get('/api/rent/list/all').then(response=>{
                        this.rent_loading = true;
                        this.rents = response.data;
                    })
                }
            })
        },
        // Jobs
        job_list(){
            // home advertisment
            axios.get('api/job/list/home_ad')
            .then(response=>{
                if(response.data.length > 0){
                    this.job_loading = true;
                    this.jobs = response.data;
                }else{
                    axios.get('/api/job/list/all').then(response=>{
                        this.jobs = response.data;
                        this.job_loading = true;
                    })
                }
            })
        },
        service_list(){
            // home advertisment
            axios.get('api/service/list/home_ad')
            .then(response=>{
                if(response.data.length > 0){                    
                    this.service_loading = true;
                    this.services = response.data;
                }else{
                    axios.get('/api/service/list/all').then(response=>{
                        this.service_loading = true;
                        this.services = response.data;
                    })
                }
            })
        },
        restaurant_list(){
            // home advertisment
            axios.get('api/restaurant/list/home_ad')
            .then(response=>{
                if(response.data.length > 0){
                    this.restaurants = response.data;
                    this.restaurant_loading = true;
                }else{
                    axios.get('/api/restaurant/list/all').then(response=>{
                        this.restaurant_loading = true;
                        this.restaurants = response.data;
                    })
                }
            })
        }
    },
    components: {Swiper,SwiperSlide},
    mounted(){
        this.event_list(); // Restaurant
        this.sale_list();
        this.rent_list();
        this.job_list();
        this.service_list();
        this.restaurant_list();
    }
}
</script>