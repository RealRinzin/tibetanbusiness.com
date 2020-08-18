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
                    <div class="col-md-4 col-sm-6 py-1" v-if="restaurant">
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
                    </div>
                    <!-- Events -->
                    <div class="col-md-4 col-sm-6 py-1 info" v-if="event">
                        <div class="card">
                            <a v-bind:href="'event/'+event.id">
                                <!-- <div class="list" v-bind:style='{ backgroundImage: `url(/storage/Event/Banner/${event.banner})`}'> -->
                                <div class="list lazyload" :data-bgset="'/storage/Event/Banner/'+event.banner"  data-sizes="auto">
                                    <ul>
                                        <!-- <li class="ng-binding">{{event.start_date | date}}</li> -->
                                        <li class="ng-binding">{{event.start_date}}</li>
                                        <li class="ng-binding" v-if="event.start_time">{{event.start_time}}a.m</li>
                                        <li class="ng-binding">Entry Fee:₹{{event.entry_fee}}/-</li>
                                    </ul>
                                </div>
                            </a>
                            <div class="likes" v-if="event.rate != null">
                                <p v-if="event" v-bind:class="event.rate_color" class="btn"><i class="far fa-thumbs-up text-white  mr-1"></i>{{event.rate}} Interested</p>
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
                    </div>
                    <!-- Rents -->
                    <div  class="col-md-4 col-sm-6 py-1 info" v-if="rent">
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
                    </div>
                    <!-- Job -->
                    <div class="col-md-4 col-sm-6 py-1" v-if="job">
                        <div class="card">
                            <a v-bind:href="'job/'+job.id">
                            <!-- <div class="list" v-bind:style='{ backgroundImage: `url(/storage/Job/Banner/${job.banner})`}'></div> -->
                                <div class="list lazyload" :data-bgset="'/storage/Job/Banner/'+job.banner"  data-sizes="auto"></div>
                            </a>
                            <div class="likes">
                                <p v-if="job"  class="btn btn-warning"><i class="fas fa-thumbs-up text-white fa-1x mr-1"></i>59 Interested</p>
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
                    </div>
                    <!-- Sale -->
                    <div class="col-md-4 col-sm-6 py-1" v-if="sale">
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
                    </div>
                    <!-- Service -->
                    <div class="col-md-4 col-sm-6 py-1" v-if="service">
                        <div class="card">
                            <a v-bind:href="'service/'+service.id">
                            <!-- <div class="list" v-bind:style='{ backgroundImage: `url(/storage/Service/Banner/${service.banner})`}'></div> -->
                                <div class="list lazyload" :data-bgset="'/storage/Service/Banner/'+service.banner"  data-sizes="auto"></div>
                            </a>
                            <div class="likes" v-if="service.rate > 0">
                                <p v-if="rent" v-bind:class="rent.rate_color" class="btn"><i class="fas fa-star text-white fa-1x mr-1"></i>{{rent.rate}}</p>
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
                    </div>
                </div>
            </div>
        </div>

        <!-- Business Listing -->
        <div class="container py-3" id="business_list">
            <!-- <search></search> -->
            <event-list></event-list>
            <rent-list></rent-list>
            <job-list></job-list>
            <restaurant-list></restaurant-list>
            <sale-list></sale-list>
            <service-list></service-list>
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
    import { compareAsc, format } from 'date-fns'
    
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
                restaurant:{},
                online_restaurant:[],
                // random test
                event:{},
                rent:{},
                job:{},
                sale:{},
                service:{},
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
                        // Assign Featured restaurant
                        this.restaurant = response.data[Math.floor(Math.random() *response.data.length)]                        
                        /**
                         * Rating Background
                         * Color
                         *  */  
                        if(this.restaurant.rate >= 0.0 && this.restaurant.rate <= 2.5){
                            this.restaurant.rate_color = 'bg-danger';
                        }else if(this.restaurant.rate >= 2.6 && this.restaurant.rate <= 3.5 ){
                            this.restaurant.rate_color = 'bg-warning';
                        }else if(this.restaurant.rate >= 3.6 && this.restaurant.rate <= 4.0 ){
                            this.restaurant.rate_color = 'bg-info';
                        }else if(this.restaurant.rate >= 4.1 && this.restaurant.rate <= 5.0 ){
                            this.restaurant.rate_color = 'bg-success';
                        }else{
                            this.restaurant.rate_color = 'bg-secondary';
                        }
                        // // loading success
                        // this.isLoading = false; //Loading true
                        // this.load = true;
                    }else{
                    axios.get('/api/restaurant/list/all')
                        .then(response=>{
                            // Assign Featured retaurant
                            this.restaurant = response.data[Math.floor(Math.random() *response.data.length)]  
                            /**
                             * Rating Background
                             * Color
                             *  */  
                            if(this.restaurant.rate >= 0.0 && this.restaurant.rate <= 2.5){
                                this.restaurant.rate_color = 'bg-danger';
                            }else if(this.restaurant.rate >= 2.6 && this.restaurant.rate <= 3.5 ){
                                this.restaurant.rate_color = 'bg-warning';
                            }else if(this.restaurant.rate >= 3.6 && this.restaurant.rate <= 4.0 ){
                                this.restaurant.rate_color = 'bg-info';
                            }else if(this.restaurant.rate >= 4.1 && this.restaurant.rate <= 5.0 ){
                                this.restaurant.rate_color = 'bg-success';
                            }else{
                                this.restaurant.rate_color = 'bg-secondary';
                            }
            
                            // loading success
                            // this.isLoading = false; //Loading true
                            // this.load = true;
                        })
                    }
                })
                // Featured Event
                axios.get('/api/event/list/featured_ad')
                .then(response=>{
                    if (response.data.length > 0) {
                        this.event = response.data[Math.floor(Math.random() *response.data.length)];
                            /**
                             * Rating Background
                             * Color
                             *  */  
                            if(this.event.rate >= 0.0 && this.event.rate <= 2.5){
                                this.event.rate_color = 'bg-danger';
                            }else if(this.event.rate >= 2.6 && this.event.rate <= 3.5 ){
                                this.event.rate_color = 'bg-warning';
                            }else if(this.event.rate >= 3.6 && this.event.rate <= 4.0 ){
                                this.event.rate_color = 'bg-info';
                            }else if(this.event.rate >= 4.1 && this.event.rate <= 5.0 ){
                                this.event.rate_color = 'bg-success';
                            }else{
                                this.event.rate_color = 'bg-secondary';
                            }
                            // this.isLoading = false; //Loading true
                    }else{
                        axios.get('/api/event/list/all')
                        .then(response=>{
                            this.event = response.data[Math.floor(Math.random() *response.data.length)];
                            /**
                             * Rating Background
                             * Color
                             *  */  
                            if(this.event.rate >= 0.0 && this.event.rate <= 2.5){
                                this.event.rate_color = 'bg-danger';
                            }else if(this.event.rate >= 2.6 && this.event.rate <= 3.5 ){
                                this.event.rate_color = 'bg-warning';
                            }else if(this.event.rate >= 3.6 && this.event.rate <= 4.0 ){
                                this.event.rate_color = 'bg-info';
                            }else if(this.event.rate >= 4.1 && this.event.rate <= 5.0 ){
                                this.event.rate_color = 'bg-success';
                            }else{
                                this.event.rate_color = 'bg-secondary';
                            }
                            // this.isLoading = false; //Loading true
                        })
                    }        
                })
                // Featured Rent
                axios.get('/api/rent/list/featured_ad')
                .then(response=>{
                    if (response.data.length > 0) {
                        // Assign
                        this.rent = response.data[Math.floor(Math.random() *response.data.length)]
                            /**
                             * Rating Background
                             * Color
                             *  */  
                            if(this.rent.rate >= 0.0 && this.rent.rate <= 2.5){
                                this.rent.rate_color = 'bg-danger';
                            }else if(this.rent.rate >= 2.6 && this.rent.rate <= 3.5 ){
                                this.rent.rate_color = 'bg-warning';
                            }else if(this.rent.rate >= 3.6 && this.rent.rate <= 4.0 ){
                                this.rent.rate_color = 'bg-info';
                            }else if(this.rent.rate >= 4.1 && this.rent.rate <= 5.0 ){
                                this.rent.rate_color = 'bg-success';
                            }else{
                                this.rent.rate_color = 'bg-secondary';
                            }
                            // this.isLoading = false; //Loading true
                        }else{
                        axios.get('/api/rent/list/all')
                        .then(response => {
                            // Assign
                            this.rent = response.data[Math.floor(Math.random() *response.data.length)]
                            /**
                             * Rating Background
                             * Color
                             *  */  
                            if(this.rent.rate >= 0.0 && this.rent.rate <= 2.5){
                                this.rent.rate_color = 'bg-danger';
                            }else if(this.rent.rate >= 2.6 && this.rent.rate <= 3.5 ){
                                this.rent.rate_color = 'bg-warning';
                            }else if(this.rent.rate >= 3.6 && this.rent.rate <= 4.0 ){
                                this.rent.rate_color = 'bg-info';
                            }else if(this.rent.rate >= 4.1 && this.rent.rate <= 5.0 ){
                                this.rent.rate_color = 'bg-success';
                            }else{
                                this.rent.rate_color = 'bg-secondary';
                            }
                            // this.isLoading = false; //Loading true

                        })
                    }
                })
                // Featured Job
                axios.get('/api/job/list/featured_ad')
                .then(response=>{
                    if (response.data.length > 0) {
                        // Assign
                        this.job = response.data[Math.floor(Math.random() *response.data.length)]
                        // this.isLoading = false; //Loading true
                    }else{
                        axios.get('/api/job/list/all')
                        .then(response => {
                            // Assign
                            this.job = response.data[Math.floor(Math.random() *response.data.length)]
                            // this.isLoading = false; //Loading true

                        })
                    }
                })
                // Featured Sale
                axios.get('/api/sale/list/featured_ad')
                .then(response=>{
                    if (response.data.length > 0) {
                        // Assign
                        this.sale = response.data[Math.floor(Math.random() *response.data.length)]
                    }else{
                        axios.get('/api/sale/list/all')
                        .then(response => {
                            // Assign
                            this.sale = response.data[Math.floor(Math.random() *response.data.length)]
                        })
                    }
                })
                // Featured Service
                axios.get('/api/service/list/featured_ad')
                .then(response=>{
                    if (response.data.length > 0) {
                        // Assign
                        this.service = response.data[Math.floor(Math.random() *response.data.length)]
                       this.isLoading = false; //Loading true
                        this.load = true;
                    }else{
                        axios.get('/api/service/list/all')
                        .then(response => {
                            // Assign
                            this.service = response.data[Math.floor(Math.random() *response.data.length)]
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
        components:{Loading,EventList,RentList,JobList,RestaurantList,SaleList,ServiceList},
        /**
         * Mounted
         *  */ 
        mounted() {
            // Featured Restaurant
            this.load_business();
        },
    }
</script>
