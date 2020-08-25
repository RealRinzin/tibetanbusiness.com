<template>
    <div>
        <div v-if="!load" style="min-height:400px">
            <loading :active.sync="isLoading"></loading>
        </div>
        <div v-else>
            <div class="container" id="featured">
                <button class="btn btn-warning">Latest Featured </button>
                <div class="row py-3" style="min-height:400px">
                    <!-- Restaurant -->
                    <swiper class="col-md-4 col-sm-6 col-12 swiper" :options="settings" v-if="restaurants">
                        <swiper-slide v-for="(restaurant,index) in restaurants" :key="index">
                            <div class="card">
                                <a v-bind:href="'restaurant/'+restaurant.id">
                                <!-- <div class="list" v-bind:style='{ backgroundImage: `url(/storage/Restaurant/Banner/${restaurant.banner})`}'></div> -->
                                    <div class="list lazyload" :data-bgset="'/storage/Restaurant/Banner/'+restaurant.banner"  data-sizes="auto">
                                    </div>
                                </a>
                                <div class="likes" v-if="restaurant.rate > 0">
                                    <p v-if="restaurant" v-bind:class="restaurant.rate_color" class="btn"><i class="fas fa-star text-white fa-1x mr-1"></i>{{restaurant.rate}}</p>
                                </div>
                                <div class="types">
                                    <button class="btn btn-outline-info btn-xs py-1"><i class="fas fa-mug-hot mx-1"></i>Restuarant</button>
                                </div>
                                <div class="card-body text-truncate">
                                    <h5>{{restaurant.name}}</h5>
                                    <h6>{{restaurant.mobile_no}}</h6>
                                    <h6>{{restaurant.location}}</h6>
                                </div>
                            </div>
                        </swiper-slide>
                        <div class="swiper-button-next" slot="button-next"></div>
                        <div class="swiper-button-prev" slot="button-prev"></div>
                    </swiper>
                    <!-- Events -->
                    <swiper class="col-md-4 col-sm-6 col-12 swiper info" :options="settings" v-if="events">
                        <swiper-slide v-for="(event,index) in events" :key="index">
                            <div class="card">
                                <a v-bind:href="'event/'+event.id">
                                    <!-- <div class="list" v-bind:style='{ backgroundImage: `url(/storage/Event/Banner/${event.banner})`}'> -->
                                    <div class="list lazyload" :data-bgset="'/storage/Event/Banner/'+event.banner"  data-sizes="auto">
                                        <ul>
                                            <!-- <li class="ng-binding">{{event.start_date | date}}</li> -->
                                            <li class="ng-binding">{{event.start_date | date}}</li>
                                            <li class="ng-binding" v-if="event.start_time">{{event.start_time}}a.m</li>
                                            <li class="ng-binding">Entry Fee:₹{{event.entry_fee}}/-</li>
                                        </ul>
                                    </div>
                                </a>
                                <div class="likes" v-if="event.interested >0">
                                    <p v-bind:class="event.rate_color" class="btn"><i class="far fa-thumbs-up text-white  mr-1"></i>{{event.interested}} Interested</p>
                                </div>
                                <div class="types">
                                    <button class="btn btn-outline-info btn-xs py-1"><i class="fas fa-mug-hot mx-1"></i>Event</button>
                                </div>
                                <div class="card-body text-truncate">
                                    <h5>{{event.name}}</h5>
                                    <h6>{{event.mobile_no}}</h6>
                                    <h6>{{event.location}}</h6>
                                </div>
                            </div>
                        </swiper-slide>
                        <div class="swiper-button-next" slot="button-next"></div>
                        <div class="swiper-button-prev" slot="button-prev"></div>
                    </swiper>
                    <!-- Rents -->
                    <swiper class="swiper col-md-4 col-sm-6 info" :options="settings" v-if="rents">
                        <swiper-slide v-for="(rent,index) in rents" :key="index">
                            <div class="card">
                                <a v-bind:href="'rent/'+rent.id">
                                    <!-- <div class="list" v-bind:style='{ backgroundImage: `url(/storage/Rent/Banner/${rent.banner})`}'> -->
                                    <div class="list lazyload" :data-bgset="'/storage/Rent/Banner/'+rent.banner"  data-sizes="auto">
                                        <ul>
                                            <li class="ng-binding">Rent:₹{{rent.fare}}/-</li>
                                            <li class="ng-binding">Size: {{rent.accomodation_size}} Person</li>
                                        </ul>
                                    </div>
                                </a>
                                <div class="likes" v-if="rent.rate >0">
                                    <p v-if="rent" v-bind:class="rent.rate_color" class="btn"><i class="fas fa-star text-white fa-1x mr-1"></i>{{rent.rate}}</p>
                                </div>
                                <div class="types">
                                    <button class="btn btn-outline-info btn-xs py-1"><i class="fas fa-mug-hot mx-1"></i>Rent</button>
                                </div>
                                <div class="card-body text-truncate">
                                    <h5>{{rent.name}}</h5>
                                    <h6>{{rent.mobile_no}}</h6>
                                    <h6>{{rent.location}}</h6>
                                </div>
                            </div>
                        </swiper-slide>
                        <div class="swiper-button-next" slot="button-next"></div>
                        <div class="swiper-button-prev" slot="button-prev"></div>
                    </swiper>
                    <!-- Job -->
                    <swiper class="col-md-4 col-sm-6 swiper" :options="settings" v-if="jobs">
                        <swiper-slide v-for="(job,index) in jobs" :key="index">
                            <div class="card">
                                <a v-bind:href="'job/'+job.id">
                                <!-- <div class="list" v-bind:style='{ backgroundImage: `url(/storage/Job/Banner/${job.banner})`}'></div> -->
                                    <div class="list lazyload" :data-bgset="'/storage/Job/Banner/'+job.banner"  data-sizes="auto"></div>
                                </a>
                                <div class="likes">
                                    <p v-if="job.interested > 0" class="btn btn-secondary btn-sm small"><i class="fas fa-thumbs-up text-white fa-1x mr-1"></i>{{job.interested}} Interested</p>
                                    <p v-if="job.applied>0" class="btn btn-success btn-sm small"><i class="fas fa-check text-white fa-1x mr-1"></i>{{job.applied}} Applied</p>
                                </div>
                                <div class="types">
                                    <button class="btn btn-outline-info btn-xs py-1"><i class="fas fa-mug-hot mx-1"></i>Job</button>
                                </div>
                                <div class="card-body text-truncate">
                                    <h5>{{job.title}}</h5>
                                    <h6>{{job.mobile_no}}</h6>
                                    <h6>{{job.location}}</h6>
                                </div>
                            </div>
                        </swiper-slide>
                        <div class="swiper-button-next" slot="button-next"></div>
                        <div class="swiper-button-prev" slot="button-prev"></div>
                    </swiper>
                    <!-- Sale -->
                    <swiper class="col-md-4 col-sm-6 swiper" :options="settings"  v-if="sales">
                        <swiper-slide v-for="(sale,index) in sales" :key="index">
                            <div class="card">
                                <a v-bind:href="'sale/'+sale.id">
                                <!-- <div class="list" v-bind:style='{ backgroundImage: `url(/storage/Sale/Banner/${sale.banner})`}'></div> -->
                                    <div class="list lazyload" :data-bgset="'/storage/Sale/Banner/'+sale.banner"  data-sizes="auto"></div>
                                </a>
                                <div class="types">
                                    <button class="btn btn-outline-info btn-xs py-1"><i class="fas fa-mug-hot mx-1"></i>Sale</button>
                                </div>
                                <div class="card-body text-truncate">
                                    <h5>{{sale.name}}</h5>
                                    <h6>{{sale.mobile_no}}</h6>
                                    <h6>{{sale.location}}</h6>
                                </div>
                            </div>
                        </swiper-slide>
                        <div class="swiper-button-next" slot="button-next"></div>
                        <div class="swiper-button-prev" slot="button-prev"></div>
                    </swiper>
                    <!-- Service -->
                    <swiper class="col-md-4 col-sm-6 swiper" :options="settings" v-if="services">
                        <swiper-slide v-for="(service,index) in services" :key="index">
                            <div class="card">
                                <a v-bind:href="'service/'+service.id">
                                <!-- <div class="list" v-bind:style='{ backgroundImage: `url(/storage/Service/Banner/${service.banner})`}'></div> -->
                                    <div class="list lazyload" :data-bgset="'/storage/Service/Banner/'+service.banner"  data-sizes="auto"></div>
                                </a>
                                <div class="likes" v-if="service.rate > 0">
                                    <p v-if="service" v-bind:class="service.rate_color" class="btn"><i class="fas fa-star text-white fa-1x mr-1"></i>{{service.rate}}</p>
                                </div>
                                <div class="types">
                                    <button class="btn btn-outline-info btn-xs py-1"><i class="fas fa-mug-hot mx-1"></i>Service</button>
                                </div>
                                <div class="card-body text-truncate">
                                    <h5>{{service.name}}</h5>
                                    <h6>{{service.mobile_no}}</h6>
                                    <h6>{{service.location}}</h6>
                                </div>
                            </div>
                        </swiper-slide>
                        <div class="swiper-button-next" slot="button-next"></div>
                        <div class="swiper-button-prev" slot="button-prev"></div>
                    </swiper>
                </div>
            </div>
        </div>
        <!-- Business Listing -->
        <div class="bg-white" style="min-height:140vh">
            <div class="container py-3" id="business_list">
                <!-- <search></search> -->
                <event-list></event-list>
                <sale-list></sale-list>
                <rent-list></rent-list>
                <job-list></job-list>
                <service-list></service-list>
                <restaurant-list></restaurant-list>
            </div>

        </div>

    </div>
</template>

<script>
    // Import component
    import Loading from 'vue-loading-overlay';
    // Import stylesheet
    import 'vue-loading-overlay/dist/vue-loading.css';
    import EventList from './List/Event.vue';
    import JobList from './List/Job.vue';
    import RentList from './List/Rent.vue';
    import RestaurantList from './List/Restaurant.vue';
    import SaleList from './List/Sale.vue';
    import ServiceList from './List/Service.vue';
    // import format from 'date-fns/format';
    import { compareAsc, format } from 'date-fns';
    import { Swiper, SwiperSlide } from 'vue-awesome-swiper';
    
    export default {
        /**
         * Filter
         *  */ 
        filters:{
            date(str){
                return format(new Date(str), 'EE, MMM dd, yyyy');
            },
            // trim string
            trim(str){
                return str.slice(0, 50) + "..."
            }
        },
        /**
         * 
         * Data Model
         *  */ 
        data(){
            return{
                load:false,
                isLoading : false,//Lazy loading
                // Objects
                restaurants:{total:0},
                events:{total:0},
                rents:{total:0},
                jobs:{total:0},
                sales:{total:0},
                services:{total:0},
                // total
                //  Swiper slider
                settings:{
                    slidesPerView: 1,
                    spaceBetween: 30,
                    loop:true,
                    effect: 'fade',
                    //  Arrow
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev'
                    },
                    // pagination
                    pagination: {
                        el: '.swiper-pagination'
                    }
                }
            }
        },
        /**
         * 
         * Methods
         *  */
        methods:{
            // Featured business
            load_business(){
                this.isLoading = true; //Loading true
                // Featured restaurant
                axios.get('/api/restaurant/list/featured_ad')
                .then(response=>{
                    if(response.data.length > 0){
                        this.restaurants = response.data;
                        // rate background
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
                        }
            
                    }else{
                    axios.get('/api/restaurant/list/all')
                        .then(response=>{
                            this.restaurants = response.data; 
                            // rate background
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
                            }
                        })
                    }
                })
                // Featured Event
                axios.get('/api/event/list/featured_ad')
                .then(response=>{
                    if (response.data.length > 0) {
                        this.events = response.data;
                        // Background color
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
                        this.events = response.data;
                        // Background color
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
                        })
                    }        
                })
                // Featured Rent
                axios.get('/api/rent/list/featured_ad')
                .then(response=>{
                    if (response.data.length > 0) {
                        this.rents = response.data;
                        // Background color
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
                            this.rents = response.data;
                            // Background color
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
                // Featured Job
                axios.get('/api/job/list/featured_ad')
                .then(response=>{
                    if (response.data.length > 0) {
                        this.jobs = response.data;
                        // Background color
                    }else{
                        axios.get('/api/job/list/all')
                        .then(response => {
                            this.jobs = response.data;
                        })
                    }
                })
                // Featured Sale
                axios.get('/api/sale/list/featured_ad')
                .then(response=>{
                    if (response.data.length > 0) {
                        this.sales = response.data;
                    }else{
                        axios.get('/api/sale/list/all')
                        .then(response => {
                            this.sales = response.data;
                        })
                    }
                })
                // Featured Service
                axios.get('/api/service/list/featured_ad')
                .then(response=>{
                    if (response.data.length > 0) {
                        this.services = response.data;
                        for (let index = 0; index < response.data.length; index++) {
                        // bg
                            if(this.services[index].rate >=0.0 && this.services[index].rate <= 2.5){
                                this.services[index].rate_color = 'bg-danger';
                            }else if(this.services[index].rate >= 2.6 && this.services[index].rate <= 3.5 ){
                                this.services[index].rate_color = 'bg-warning';
                            }else if(this.services[index].rate >= 3.6 && this.services[index].rate <= 4.0 ){
                                this.services[index].rate_color = 'bg-info';
                            }else if(this.services[index].rate >= 4.1 && this.services[index].rate <= 5.0 ){
                                this.services[index].rate_color = 'bg-success';
                            }
                            else{
                                this.services[index].rate_color = 'bg-secondary';
                            }
                        }
                    }else{
                        axios.get('/api/service/list/all')
                        .then(response => {
                        this.services = response.data;
                        for (let index = 0; index < response.data.length; index++) {
                            // bg
                                if(this.services[index].rate >=0.0 && this.services[index].rate <= 2.5){
                                    this.services[index].rate_color = 'bg-danger';
                                }else if(this.services[index].rate >= 2.6 && this.services[index].rate <= 3.5 ){
                                    this.services[index].rate_color = 'bg-warning';
                                }else if(this.services[index].rate >= 3.6 && this.services[index].rate <= 4.0 ){
                                    this.services[index].rate_color = 'bg-info';
                                }else if(this.services[index].rate >= 4.1 && this.services[index].rate <= 5.0 ){
                                    this.services[index].rate_color = 'bg-success';
                                }
                                else{
                                    this.services[index].rate_color = 'bg-secondary';
                                }
                            }
                        })
                    }
                    //  // loading success
                        this.isLoading = false; //Loading true
                        this.load = true;
                })
            },
        },
        /**
         * 
         * Components
         *  */  
        components:{Loading,EventList,RentList,JobList,RestaurantList,SaleList,ServiceList,Swiper,SwiperSlide},
    // components: {Swiper,SwiperSlide},

        /**
         * Mounted
         *  */ 
        mounted() {
            // Featured Restaurant
            this.load_business();
        },
    }
</script>
