<template>
<div>
    <div id="sidebar">
        <!-- Sales -->
        <div class="card p-3" v-if="sales">
            <h6 class="small text-muted py-2 font-weight-bolder"><img src="/img/sale.png" class="mr-2" alt="">TRENDING SALES</h6>
            <div v-if="!sale_loading" class="text-center">
                <div class="spinner-border m-5" role="status">
                <span class="sr-only">Loading...</span>
                </div>
            </div>
            <div class="row" v-else>
                <swiper class="swiper" :options="settings">
                <!-- <h6 class="py-2"> <span><i class="fas fa-utensils mr-2 text-danger"></i></span> Restaurant</h6> -->
                        <swiper-slide  class="col-6" v-for="(sale,index) in sales" :key="index">
                            <a v-bind:href="'/sale/'+sale.id">
                            <div class="banner lazyload" :data-bgset="'/storage/Sale/Banner/'+sale.thumb"  data-sizes="auto"></div>

                            <div class="rate" v-if="sale.rate !=null"><span v-bind:class="sale.rate_color" class="btn">{{sale.rate}}</span></div>
                            </a>
                            <h6 class="text-dark pt-3">{{sale.name}}</h6>
                            <p class="text-muted my-0">{{sale.mobile_no}}</p>
                            <p class="text-muted my-0">{{sale.location}}</p>
                        </swiper-slide>
                    <!-- <div class="swiper-pagination" slot="pagination"></div> -->
                    <div class="swiper-button-prev" slot="button-prev"></div>
                    <div class="swiper-button-next" slot="button-next"></div>
                </swiper>

            </div>
        </div>
        <!-- Events -->
        <div class="card p-3" v-if="events">
            <h6 class="small text-muted py-2 font-weight-bolder"><img src="/img/event.png" class="mr-2" alt="">UPCOMING EVENTS</h6>
            <div v-if="!event_loading" class="text-center">
                    <div class="spinner-border m-5" role="status">
                    <span class="sr-only">Loading...</span>
                    </div>
                </div>
            <div class="row" v-else>
                <swiper class="swiper" :options="settings">
                        <swiper-slide  class="col-6" v-for="(event,index) in events" :key="index">
                            <a v-bind:href="'/event/'+event.id">
                            <div class="banner lazyload" :data-bgset="'/storage/Event/Banner/'+event.thumb"  data-sizes="auto"></div>

                            <div class="rate" v-if="event.rate !=null"><span v-bind:class="event.rate_color" class="btn">{{event.rate}}</span></div>
                            </a>
                            <h6 class="text-dark pt-3">{{event.name}}</h6>
                            <p class="text-muted my-0">{{event.mobile_no}}</p>
                            <p class="text-muted my-0">{{event.location}}</p>
                        </swiper-slide>
                    <div class="swiper-button-prev" slot="button-prev"></div>
                    <div class="swiper-button-next" slot="button-next"></div>
                </swiper>

            </div>
        </div>
        <!-- Rents -->
        <div class="card p-3" v-if="rents">
            <h6 class="small text-muted py-2 font-weight-bolder"><img src="/img/rent.png" class="mr-2" alt="">AVAILABE RENTS</h6>
            <div v-if="!rent_loading" class="text-center">
                    <div class="spinner-border m-5" role="status">
                    <span class="sr-only">Loading...</span>
                    </div>
                </div>
            <div class="row" v-else>
                <swiper class="swiper" :options="settings">
                <!-- <h6 class="py-2"> <span><i class="fas fa-utensils mr-2 text-danger"></i></span> Restaurant</h6> -->
                        <swiper-slide  class="col-6" v-for="(rent,index) in rents" :key="index">
                            <a v-bind:href="'/rent/'+rent.id">
                            <div class="banner lazyload" :data-bgset="'/storage/Rent/Banner/'+rent.banner"  data-sizes="auto"></div>

                            <div class="rate" v-if="rent.rate !=null"><span v-bind:class="rent.rate_color" class="btn">{{rent.rate}}</span></div>
                            </a>
                            <h6 class="text-dark pt-3">{{rent.name}}</h6>
                            <p class="text-muted my-0">{{rent.mobile_no}}</p>
                            <p class="text-muted my-0">{{rent.location}}</p>
                        </swiper-slide>
                    <div class="swiper-button-prev" slot="button-prev"></div>
                    <div class="swiper-button-next" slot="button-next"></div>
                </swiper>

            </div>
        </div>
        <!--Jobs  -->
        <div class="card p-3" v-if="jobs">
            <h6 class="small text-muted py-2 font-weight-bolder"><img src="/img/job.png" class="mr-2" alt="">TRENDING JOBS</h6>
            <div v-if="!job_loading" class="text-center">
                <div class="spinner-border m-5" role="status">
                <span class="sr-only">Loading...</span>
                </div>
            </div>
            <div class="row" v-else>
                <swiper class="swiper" :options="settings">
                <!-- <h6 class="py-2"> <span><i class="fas fa-utensils mr-2 text-danger"></i></span> job</h6> -->
                        <swiper-slide  class="col-6" v-for="(job,index) in jobs" :key="index">
                            <a v-bind:href="'/job/'+job.id">
                            <div class="banner lazyload" :data-bgset="'/storage/Job/Banner/'+job.banner"  data-sizes="auto"></div>

                            <div class="rate" v-if="job.rate !=null"><span v-bind:class="job.rate_color" class="btn">{{job.rate}}</span></div>
                            </a>
                            <h6 class="text-dark pt-3">{{job.name}}</h6>
                            <p class="text-muted my-0">{{job.mobile_no}}</p>
                            <p class="text-muted my-0">{{job.location}}</p>
                        </swiper-slide>
                    <!-- <div class="swiper-pagination" slot="pagination"></div> -->
                    <div class="swiper-button-prev" slot="button-prev"></div>
                    <div class="swiper-button-next" slot="button-next"></div>
                </swiper>
            </div>
        </div>
        <!-- Services -->
        <div class="card p-3" v-if="services">
            <h6 class="small text-muted py-2 font-weight-bolder"><img src="/img/service.png" class="mr-2" alt="">POPULAR SERVICES</h6>
            <div v-if="!service_loading" class="text-center">
                <div class="spinner-border m-5" role="status">
                <span class="sr-only">Loading...</span>
                </div>
            </div>
            <div class="row" v-else>
                <swiper class="swiper" :options="settings">
                        <swiper-slide  class="col-6" v-for="(service,index) in services" :key="index">
                            <a v-bind:href="'/service/'+service.id">
                            <div class="banner lazyload" :data-bgset="'/storage/Service/Banner/'+service.thumb"  data-sizes="auto"></div>

                            <div class="rate" v-if="service.rate !=null"><span v-bind:class="service.rate_color" class="btn">{{service.rate}}</span></div>
                            </a>
                            <h6 class="text-dark pt-3">{{service.name}}</h6>
                            <p class="text-muted my-0">{{service.mobile_no}}</p>
                            <p class="text-muted my-0">{{service.location}}</p>
                        </swiper-slide>
                    <div class="swiper-button-prev" slot="button-prev"></div>
                    <div class="swiper-button-next" slot="button-next"></div>
                </swiper>
            </div>
        </div>
        <!-- restaurant -->
        <div class="card p-3" v-if="restaurants">
            <h6 class="small text-muted py-2 font-weight-bolder"><img src="/img/restaurant.png" class="mr-2" alt="">TRENDING RESTAURANTS</h6>
            <div v-if="!restaurant_loading" class="text-center">
                <div class="spinner-border m-5" role="status">
                <span class="sr-only">Loading...</span>
                </div>
            </div>
            <div class="row" v-else>
                <swiper class="swiper" :options="settings">
                        <swiper-slide  class="col-6" v-for="(restaurant,index) in restaurants" :key="index">
                            <a v-bind:href="'/restaurant/'+restaurant.id">
                            <div class="banner lazyload" :data-bgset="'/storage/Restaurant/Banner/'+restaurant.banner"  data-sizes="auto"></div>
                            <div class="rate" v-if="restaurant.rate > 0"><span v-bind:class="restaurant.rate_color" class="btn">{{restaurant.rate}}</span></div>
                            </a>
                            <h6 class="text-dark pt-3">{{restaurant.name}}</h6>
                            <p class="text-muted my-0">{{restaurant.mobile_no}}</p>
                            <p class="text-muted my-0">{{restaurant.location}}</p>
                        </swiper-slide>
                    <div class="swiper-button-prev" slot="button-prev"></div>
                    <div class="swiper-button-next" slot="button-next"></div>
                </swiper>
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
    import { Swiper, SwiperSlide } from 'vue-awesome-swiper';

    export default {
        // Data
        data(){
            return{
                loading: false,
                restaurant_loading:false,
                event_loading:false,
                job_loading:false,
                sale_loading:false,
                service_loading:false,
                rent_loading:false,
                // Objects
                restaurants:{}, 
                events:{}, 
                jobs:{}, 
                rents:{}, 
                sales:{}, 
                services:{},
                // Swiper Carousel
                settings:{
                    slidesPerView: 2,
                    spaceBetween: 10,
                    slidesPerGroup: 3,
                    loop: true,
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
        /**
         *  Methods
         *  */ 
        methods:{
            sidebar(){
                /**
                 * Restaurant Sidebar AD
                 *  */ 
                axios.get('/api/restaurant/list/sidebar_ad')
                .then(response=>{
                    this.restaurant_loading = true; //Loading true
                    if(response.data.length > 0){
                        this.restaurants = response.data;
                        // background color
                        for (let index = 0; index < response.data.length; index++) {
                            if(this.restaurants[index].rate >=0.0 && this.restaurants[index].rate <= 2.5){
                                this.restaurants[index].rate_color = 'bg-danger';
                            }else if(this.restaurants[index].rate >= 2.6 && this.restaurants[index].rate <= 3.5 ){
                                this.restaurants[index].rate_color = 'bg-warning';
                            }else if(this.restaurants[index].rate >= 3.6 && this.restaurants[index].rate <= 4.0 ){
                                this.restaurants[index].rate_color = 'bg-info';
                            }else if(this.restaurants[index].rate >= 4.1 && this.restaurants[index].rate <= 5.0 ){
                                this.restaurants[index].rate_color = 'bg-success';
                            }
                            else{
                                this.restaurants[index].rate_color = 'bg-secondary';
                            }
                            // loading
                        }
                    }else{
                        axios.get('/restaurants/list/all').then(response=>{
                            this.restaurants = response.data;
                        for (let index = 0; index < response.data.length; index++) {
                            if(this.restaurants[index].rate >=0.0 && this.restaurants[index].rate <= 2.5){
                                this.restaurants[index].rate_color = 'bg-danger';
                            }else if(this.restaurants[index].rate >= 2.6 && this.restaurants[index].rate <= 3.5 ){
                                this.restaurants[index].rate_color = 'bg-warning';
                            }else if(this.restaurants[index].rate >= 3.6 && this.restaurants[index].rate <= 4.0 ){
                                this.restaurants[index].rate_color = 'bg-info';
                            }else if(this.restaurants[index].rate >= 4.1 && this.restaurants[index].rate <= 5.0 ){
                                this.restaurants[index].rate_color = 'bg-success';
                            }
                            else{
                                this.restaurants[index].rate_color = 'bg-secondary';
                            }
                            // loading
                            this.restaurant_loading = true;
                        }
                        })
                    }
                })
                /**
                 * Events
                 *  */ 
                axios.get('/api/event/list/sidebar_ad')
                .then(response=>{
                    this.event_loading = true; //Loading true
                    if (response.data.length > 0) {
                        this.events = response.data;
                        for (let index = 0; index < response.data.length; index++) {
                            // this.events.push(response.data[Math.floor(Math.random() *response.data.length)]);
                            // bg
                            if(this.events[index].rate >=0.0 && this.events[index].rate <= 2.5){
                                this.events[index].rate_color = 'bg-danger';
                            }else if(this.events[index].rate >= 2.6 && this.events[index].rate <= 3.5 ){
                                this.events[index].rate_color = 'bg-warning';
                            }else if(this.events[index].rate >= 3.6 && this.events[index].rate <= 4.0 ){
                                this.events[index].rate_color = 'bg-info';
                            }else if(this.events[index].rate >= 4.1 && this.events[index].rate <= 5.0 ){
                                this.events[index].rate_color = 'bg-success';
                            }
                            else{
                                this.events[index].rate_color = 'bg-secondary';
                            }
                        }
        
                    }else{
                        axios.get('/api/event/list/all')
                        .then(response=>{
                            this.event_loading = true; //Loading true
                            this.events = response.data;
                            for (let index = 0; index < response.data.length; index++) {
                                // bg
                                if(this.events[index].rate >=0.0 && this.events[index].rate <= 2.5){
                                    this.events[index].rate_color = 'bg-danger';
                                }else if(this.events[index].rate >= 2.6 && this.events[index].rate <= 3.5 ){
                                    this.events[index].rate_color = 'bg-warning';
                                }else if(this.events[index].rate >= 3.6 && this.events[index].rate <= 4.0 ){
                                    this.events[index].rate_color = 'bg-info';
                                }else if(this.events[index].rate >= 4.1 && this.events[index].rate <= 5.0 ){
                                    this.events[index].rate_color = 'bg-success';
                                }
                                else{
                                    this.events[index].rate_color = 'bg-secondary';
                                }
                            }
                        })
                    }        
                })
                /**
                 * Job 
                 * Objects
                 *  */ 
                axios.get('/api/job/list/sidebar_ad')
                .then(response=>{
                    this.job_loading = true; //Loading true
                    if (response.data.length > 0) {
                        this.jobs = response.data;
                    }else{
                        axios.get('/api/job/list/all')
                        .then(response => {
                            this.job_loading = true; //Loading true
                            this.jobs = response.data;
                        })
                    }
                })
                /**
                 * Rents
                 * Object
                 *  */ 
                axios.get('/api/rent/list/sidebar_ad')
                .then(response=>{
                    this.rent_loading = true; //Loading true
                    if (response.data.length > 0) {
                        this.rents = response.data;
                        for (let index = 0; index < response.data.length; index++) {
                            // bg
                            if(this.rents[index].rate >=0.0 && this.rents[index].rate <= 2.5){
                                this.rents[index].rate_color = 'bg-danger';
                            }else if(this.rents[index].rate >= 2.6 && this.rents[index].rate <= 3.5 ){
                                this.rents[index].rate_color = 'bg-warning';
                            }else if(this.rents[index].rate >= 3.6 && this.rents[index].rate <= 4.0 ){
                                this.rents[index].rate_color = 'bg-info';
                            }else if(this.rents[index].rate >= 4.1 && this.rents[index].rate <= 5.0 ){
                                this.rents[index].rate_color = 'bg-success';
                            }
                            else{
                                this.rents[index].rate_color = 'bg-secondary';
                            }
                        }
                    }else{
                        axios.get('/api/rent/list/all')
                        .then(response => {
                            this.rent_loading = true; //Loading true
                            this.rents = response.data;
                            for (let index = 0; index < response.data.length; index++) {
                                // bg
                                if(this.rents[index].rate >=0.0 && this.rents[index].rate <= 2.5){
                                    this.rents[index].rate_color = 'bg-danger';
                                }else if(this.rents[index].rate >= 2.6 && this.rents[index].rate <= 3.5 ){
                                    this.rents[index].rate_color = 'bg-warning';
                                }else if(this.rents[index].rate >= 3.6 && this.rents[index].rate <= 4.0 ){
                                    this.rents[index].rate_color = 'bg-info';
                                }else if(this.rents[index].rate >= 4.1 && this.rents[index].rate <= 5.0 ){
                                    this.rents[index].rate_color = 'bg-success';
                                }
                                else{
                                    this.rents[index].rate_color = 'bg-secondary';
                                }
                            }
                        })
                    }
                })
                /**
                 * Sales
                 *  */ 
                axios.get('/api/sale/list/sidebar_ad')
                .then(response=>{
                    this.sale_loading = true; //Loading true
                    this.sales = response.data;
                    if (response.data.length > 0) {
                    }else{
                        axios.get('/api/sale/list/all')
                        .then(response => {
                            this.sale_loading = true; //Loading true
                            this.sales = response.data;
                        })
                    }
                })
                /**
                 * Service
                 *  */ 
                axios.get('/api/service/list/sidebar_ad')
                .then(response=>{
                    this.service_loading = true; //Loading true
                    if (response.data.length > 0) {
                        this.services = response.data;
                        for (let index = 0; index < response.data.length; index++) {
                            // rate color
                            if(this.services[index].rate >= 0.0 && this.services[index].rate <= 2.5){
                                this.services[index].rate_color = 'bg-danger';
                            }else if(this.services[index].rate >= 2.6 && this.services[index].rate <= 3.5 ){
                                this.services[index].rate_color = 'bg-warning';
                            }else if(this.services[index].rate >= 3.6 && this.services[index].rate <= 4.0 ){
                                this.services[index].rate_color = 'bg-info';
                            }else if(this.services[index].rate >= 4.1 && this.services[index].rate <= 5.0 ){
                                this.services[index].rate_color = 'bg-success';
                            }else{
                                this.services[index].rate_color = 'bg-secondary';
                            }
                        }
                    }else{
                        axios.get('/api/service/list/all')
                        .then(response => {
                        this.service_loading = true; //Loading true
                        this.services = response.data;
                        for (let index = 0; index < response.data.length; index++) {
                                // rate color
                                if(this.services[index].rate >= 0.0 && this.services[index].rate <= 2.5){
                                    this.services[index].rate_color = 'bg-danger';
                                }else if(this.services[index].rate >= 2.6 && this.services[index].rate <= 3.5 ){
                                    this.services[index].rate_color = 'bg-warning';
                                }else if(this.services[index].rate >= 3.6 && this.services[index].rate <= 4.0 ){
                                    this.services[index].rate_color = 'bg-info';
                                }else if(this.services[index].rate >= 4.1 && this.services[index].rate <= 5.0 ){
                                    this.services[index].rate_color = 'bg-success';
                                }else{
                                    this.services[index].rate_color = 'bg-secondary';
                                }
                            }
                        })
                    }
                })
            }
        },
        // Components
        components: {Swiper,SwiperSlide},

        // Mounted
        mounted(){
            this.sidebar();
        }
    }
</script>