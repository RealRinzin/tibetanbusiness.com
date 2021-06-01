<template>
    <div>
        <div v-if="!load" style="min-height:400px" class="text-center">
            <div class="spinner-border text-secondary spinner-border-md" style="margin-top:160px" role="status">
                    <span class="sr-only">Loading...</span>
            </div>
        </div>
         <div v-else>
            <!-- <div> -->
            <div class="container" id="featured">
                <button class="btn btn-warning">Latest Featured </button>
                <div class="row py-3">
                    <div class="col-md-4 col-sm-6 info my-2" v-if="sales!= ''">
                        <div v-for="(sale,index) in sales" :key="index" v-if="index <= 0">
                            <div class="card">
                                <a v-bind:href="'sale/'+sale.id" role="button">
                                    <div class="list lazyload" :data-bgset="'/storage/Sale/Banner/'+sale.card"  data-sizes="auto">
                                        <div class="detail position-absolute ml-2" style="bottom:5px">
                                            <p class="btn btn-sm btn-danger small my-0 ">Price:
                                                <span v-if="sale.price > 0 ">₹{{sale.price}}/-</span>
                                                <span v-else> <i class="fas fa-phone-alt mr-1"></i> Call </span>
                                            </p>
                                            <p class="btn btn-sm btn-danger small my-0 ">{{sale.type}}</p>
                                        </div>
                                    </div>
                                </a>
                                <div class="types">
                                    <a href="/search/Sales">
                                        <p class="alert alert-success p-1 small" role="alert"><i class="fas fa-tags mx-1"></i> Deals</p>
                                    </a>
                                </div>
                                <div class="card-body text-truncate">
                                    <h5>{{sale.name}}</h5>
                                    <h6>{{sale.mobile_no}}</h6>
                                    <h6>{{sale.location}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Events -->
                    <div class="col-md-4 my-2 col-sm-6 col-12 info" v-if="events !=''">
                        <div v-for="(event,index) in events" :key="index"  v-if="index <= 0">
                            <div class="card">
                                <a v-bind:href="'event/'+event.id" role="button">
                                    <div class="list lazyload" :data-bgset="'/storage/Event/Banner/'+event.card +' 100w'"  data-sizes="auto">
                                        <div class="detail position-absolute ml-2" style="bottom:5px">
                                            <p class="btn btn-sm btn-danger small my-0 ">{{event.start_date | date}}</p>
                                            <p class="btn btn-sm bg-warning small my-0  text-dark" v-if="event.entry_free">Entry Fee</p>
                                            <p class="btn btn-sm btn-danger small my-0 " v-else>Entry Fee:₹{{event.entry_fee}}/-</p>
                                        </div>
                                    </div>
                                </a>
                                <div class="likes" v-if="event.interested >0">
                                    <p  class="btn btn-warning btn-sm"><i class="far fa-thumbs-up  mr-1"></i>{{event.interested}} Interested</p>
                                </div>
                                <div class="types">
                                    <a href="/search/Events">
                                        <p class="alert alert-success p-1 small" role="alert"><i class="fas fa-calendar-alt mx-1"></i> Events</p>
                                    </a>
                                </div>
                                <div class="card-body text-truncate">
                                    <h5>{{event.name}}</h5>
                                    <h6>{{event.mobile_no}}</h6>
                                    <h6>{{event.location}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Rents -->
                    <div class="my-2 col-md-4 col-sm-6 info" v-if="rents !=''">
                        <div v-for="(rent,index) in rents" :key="index" v-if="index <= 0">
                            <div class="card">
                                <a v-bind:href="'rent/'+rent.id">
                                    <!-- <div class="list" v-bind:style='{ backgroundImage: `url(/storage/Rent/Banner/${rent.banner})`}'> -->
                                    <div class="list lazyload" :data-bgset="'/storage/Rent/Banner/'+rent.card"  data-sizes="auto">
                                        <div class="detail position-absolute ml-2" style="bottom:5px">
                                            <p class="btn btn-sm btn-danger small my-0 ">Rent:₹{{rent.fare}}/-</p>
                                            <p class="btn btn-sm btn-danger small my-0 ">Size: {{rent.accomodation_size}} Person</p>
                                        </div>
                                    </div>
                                </a>
                                <div class="likes" v-if="rent.rate > 0.0">
                                    <p v-if="rent" v-bind:class="rent.rate_color" class="btn"><i class="fas fa-star text-white fa-1x mr-1"></i>{{rent.rate}}</p>
                                </div>
                                <div class="types">
                                    <a href="/search/Rents">
                                        <p class="alert alert-success p-1 small" role="alert"><i class="fas fa-bed mx-1"></i> Rents</p>
                                    </a>
                                </div>
                                <div class="card-body text-truncate">
                                    <h5>{{rent.name}}</h5>
                                    <h6>{{rent.mobile_no}}</h6>
                                    <h6>{{rent.location}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Job -->
                    <div  class="col-md-4 my-2 col-sm-6 info" v-if="jobs !=''">
                        <div v-for="(job,index) in jobs" :key="index" v-if="index <= 0">
                            <div class="card">
                                <a v-bind:href="'/announcement/'+job.id">
                                <!-- <div class="list" v-bind:style='{ backgroundImage: `url(/storage/Job/Banner/${job.banner})`}'></div> -->
                                    <div class="list lazyload" :data-bgset="'/storage/Job/Banner/'+job.card"  data-sizes="auto">
                                        <div class="detail position-absolute ml-2" style="bottom:5px" v-if="job.types == 1">
                                            <li v-if="job.salary >0" class="btn btn-sm btn-danger small my-0 ">Salary:₹{{job.salary}}/-</li>
                                            <li v-else class="btn btn-sm btn-warning small text-dark my-0 ">Salary: Not Disclosed</li>
                                            <li class="btn btn-sm btn-danger small my-0 ">{{job.profession}}</li>
                                        </div>
                                        <div class="detail position-absolute ml-2" style="bottom:5px" v-if="job.types == 2">
                                            <li class="btn btn-sm btn-secondary small my-0 ">Scholarship Announcements</li>
                                        </div>
                                    </div>
                                </a>
                                <div class="likes" v-if="job.types == 1">
                                    <p v-if="job.interested > 0" class="btn btn-secondary btn-sm small"><i class="fas fa-thumbs-up text-white fa-1x mr-1"></i>{{job.interested}} Interested</p>
                                    <p v-if="job.applied>0" class="btn btn-success btn-sm small"><i class="fas fa-check text-white fa-1x mr-1"></i>{{job.applied}} Applied</p>
                                </div>
                                <div class="types">
                                    <a href="/search/Jobs">
                                        <p class="alert alert-warning p-1 small" role="alert" v-if="job.types == 1"><i class="fas fa-briefcase mx-1"></i> Jobs</p>
                                        <p class="alert alert-warning p-1 small" role="alert" v-if="job.types == 2"><i class="fas fa-briefcase mx-1"></i> Announcements</p>
                                    </a>
                                </div>
                                <div class="card-body text-truncate">
                                    <h5>{{job.title}}</h5>
                                    <h6>{{job.mobile_no}}</h6>
                                    <h6  v-if="job.types == 1">{{job.location}}</h6>
                                    <h6  v-if="job.types == 2">{{job.country}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Service -->
                    <div  class="col-md-4 my-2 col-sm-6" v-if="services !=''">
                        <div v-for="(service,index) in services" :key="index" v-if="index <= 0">
                            <div class="card">
                                <a v-bind:href="'service/'+service.id">
                                    <div class="list lazyload" :data-bgset="'/storage/Service/Banner/'+service.card"  data-sizes="auto"></div>
                                </a>
                                <div class="likes" v-if="service.rate > 0.0">
                                    <p v-bind:class="service.rate_color" class="btn"><i class="fas fa-star text-white fa-1x mr-1"></i>{{service.rate}}</p>
                                </div>
                                <div class="types">
                                    <a href="/search/Services">
                                        <p class="alert alert-warning p-1 small" role="alert"><i class="fas fa-tools mx-1"></i> Services</p>
                                    </a>
                                </div>
                                <div class="card-body text-truncate">
                                    <h5>{{service.name}}</h5>
                                    <h6>{{service.mobile_no}}</h6>
                                    <h6>{{service.location}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Restaurant -->
                    <div class="col-md-4 my-2 col-sm-6 col-12" v-if="restaurants !=''">
                            <div class="card" v-for="(restaurant,index) in restaurants" :key="index" v-if="index <= 0">
                                <a v-bind:href="'restaurant/'+restaurant.id">
                                <!-- <div class="list" v-bind:style='{ backgroundImage: `url(/storage/Restaurant/Banner/${restaurant.banner})`}'></div> -->
                                    <div class="list lazyload" :data-bgset="'/storage/Restaurant/Banner/'+restaurant.card"  data-sizes="auto">
                                    </div>
                                </a>
                                <div class="likes" v-if="restaurant.rate > 0">
                                    <p v-if="restaurant" v-bind:class="restaurant.rate_color" class="btn"><i class="fas fa-star text-white fa-1x mr-1"></i>{{restaurant.rate}}</p>
                                </div>
                                <div class="types">
                                    <a href="/search/Restaurants">
                                        <p class="alert alert-warning p-1 small" role="alert"><i class="fas fa-pizza-slice mx-1"></i> Restaurants</p>
                                    </a>
                                </div>
                                <div class="card-body text-truncate">
                                    <h5>{{restaurant.name}}</h5>
                                    <h6>{{restaurant.mobile_no}}</h6>
                                    <h6>{{restaurant.location}}</h6>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Business Listing -->
        <div class="bg-white" style="min-height:140vh">
            <div class="container py-3" id="business_list">
                <home-list-fast></home-list-fast>
            </div>

        </div>

    </div>
</template>

<script>
    // Import component
    import Loading from 'vue-loading-overlay';
    // Import stylesheet
    import 'vue-loading-overlay/dist/vue-loading.css';
    // import format from 'date-fns/format';
    import { compareAsc, format } from 'date-fns';
    // Map Autocomplete Test
    import AutoComplete from '../Autocomplete.vue';
    
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
                // restaurants:{total:0},
                restaurants:[],
                events:[],
                rents:[],
                jobs:[],
                // sales:{total:0},
                sales:[],
                services:[],
                // total
                // Loading
                event_loading:true,
                sale_loading:true,
                job_loading:true,
                rent_loading:true,
                service_loading:true,
                restaurant_loading:true,
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
                        this.restaurants.total = response.data.total;
                        this.restaurant_loading = false;
                        // rate background
                        for (let index = 0; index < response.data.length; index++) {
                            if(this.restaurants[index].rate >=0.0 && this.restaurants[index].rate <= 2.5){
                                this.restaurants[index].rate_color = 'btn-danger';
                            }else if(this.restaurants[index].rate >= 2.6 && this.restaurants[index].rate <= 3.5 ){
                                this.restaurants[index].rate_color = 'btn-warning';
                            }else if(this.restaurants[index].rate >= 3.6 && this.restaurants[index].rate <= 4.0 ){
                                this.restaurants[index].rate_color = 'btn-info';
                            }else if(this.restaurants[index].rate >= 4.1 && this.restaurants[index].rate <= 5.0 ){
                                this.restaurants[index].rate_color = 'btn-success';
                            }
                            else{
                                this.restaurants[index].rate_color = 'btn-secondary';
                            }
                        }
            
                    }else{
                    axios.get('/api/restaurant/list/all')
                        .then(response=>{
                            this.restaurants = response.data; 
                            this.restaurants.total = response.data.total;
                            this.restaurant_loading = false;
                            // rate background
                            for (let index = 0; index < response.data.length; index++) {
                                if(this.restaurants[index].rate >=0.0 && this.restaurants[index].rate <= 2.5){
                                    this.restaurants[index].rate_color = 'btn-danger';
                                }else if(this.restaurants[index].rate >= 2.6 && this.restaurants[index].rate <= 3.5 ){
                                    this.restaurants[index].rate_color = 'btn-warning';
                                }else if(this.restaurants[index].rate >= 3.6 && this.restaurants[index].rate <= 4.0 ){
                                    this.restaurants[index].rate_color = 'btn-info';
                                }else if(this.restaurants[index].rate >= 4.1 && this.restaurants[index].rate <= 5.0 ){
                                    this.restaurants[index].rate_color = 'btn-success';
                                }
                                else{
                                    this.restaurants[index].rate_color = 'btn-secondary';
                                }
                            }
                        })
                    }
                        this.isLoading = false; //Loading true
                        this.load = true;
                })
                // Featured Event
                axios.get('/api/event/list/featured_ad')
                .then(response=>{
                    if (response.data.length > 0) {
                        this.event_loading = false;
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
                        this.event_loading = false;
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
                        this.rent_loading =false;
                        // Background color
                        for (let index = 0; index < response.data.length; index++) {
                            // bg
                            if(this.rents[index].rate >=0.0 && this.rents[index].rate <= 2.5){
                                this.rents[index].rate_color = 'btn-danger';
                            }else if(this.rents[index].rate >= 2.6 && this.rents[index].rate <= 3.5 ){
                                this.rents[index].rate_color = 'btn-warning';
                            }else if(this.rents[index].rate >= 3.6 && this.rents[index].rate <= 4.0 ){
                                this.rents[index].rate_color = 'btn-info';
                            }else if(this.rents[index].rate >= 4.1 && this.rents[index].rate <= 5.0 ){
                                this.rents[index].rate_color = 'btn-success';
                            }
                            else{
                                this.rents[index].rate_color = 'btn-secondary';
                            }
                        }
                    }else{
                        axios.get('/api/rent/list/all')
                        .then(response => {
                            this.rents = response.data;
                            this.rent_loading =false;
                            // Background color
                            for (let index = 0; index < response.data.length; index++) {
                                // bg
                                if(this.rents[index].rate >=0.0 && this.rents[index].rate <= 2.5){
                                    this.rents[index].rate_color = 'btn-danger';
                                }else if(this.rents[index].rate >= 2.6 && this.rents[index].rate <= 3.5 ){
                                    this.rents[index].rate_color = 'btn-warning';
                                }else if(this.rents[index].rate >= 3.6 && this.rents[index].rate <= 4.0 ){
                                    this.rents[index].rate_color = 'btn-info';
                                }else if(this.rents[index].rate >= 4.1 && this.rents[index].rate <= 5.0 ){
                                    this.rents[index].rate_color = 'btn-success';
                                }
                                else{
                                    this.rents[index].rate_color = 'btn-secondary';
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
                        this.job_loading =false;
                        // Background color
                    }else{
                        axios.get('/api/job/list/all')
                        .then(response => {
                            this.jobs = response.data;
                            this.job_loading =false;
                        })
                    }
                })
                // Featured Sale
                axios.get('/api/sale/list/featured_ad')
                .then(response=>{
                    if (response.data.length > 0) {
                        this.sale_loading =false,
                        this.sales = response.data;
                    this.placeholder = false;
                    }else{
                        axios.get('/api/sale/list/all')
                        .then(response => {
                        this.sale_loading=false,
                        this.sales = response.data;
                        })
                    }
                })
                // Featured Service
                axios.get('/api/service/list/featured_ad')
                .then(response=>{
                    if (response.data.length > 0) {
                        this.services = response.data;
                        this.service_loading =false;

                        for (let index = 0; index < response.data.length; index++) {
                        // bg
                            if(this.services[index].rate >=0.0 && this.services[index].rate <= 2.5){
                                this.services[index].rate_color = 'btn-danger';
                            }else if(this.services[index].rate >= 2.6 && this.services[index].rate <= 3.5 ){
                                this.services[index].rate_color = 'btn-warning';
                            }else if(this.services[index].rate >= 3.6 && this.services[index].rate <= 4.0 ){
                                this.services[index].rate_color = 'btn-info';
                            }else if(this.services[index].rate >= 4.1 && this.services[index].rate <= 5.0 ){
                                this.services[index].rate_color = 'btn-success';
                            }
                            else{
                                this.services[index].rate_color = 'btn-secondary';
                            }
                        }
                    }else{
                        axios.get('/api/service/list/all')
                        .then(response => {
                        this.services = response.data;
                        this.service_loading =false;
                        for (let index = 0; index < response.data.length; index++) {
                            // bg
                                if(this.services[index].rate >=0.0 && this.services[index].rate <= 2.5){
                                    this.services[index].rate_color = 'btn-danger';
                                }else if(this.services[index].rate >= 2.6 && this.services[index].rate <= 3.5 ){
                                    this.services[index].rate_color = 'btn-warning';
                                }else if(this.services[index].rate >= 3.6 && this.services[index].rate <= 4.0 ){
                                    this.services[index].rate_color = 'btn-info';
                                }else if(this.services[index].rate >= 4.1 && this.services[index].rate <= 5.0 ){
                                    this.services[index].rate_color = 'btn-success';
                                }
                                else{
                                    this.services[index].rate_color = 'btn-secondary';
                                }
                            }
                        })
                    }
                })
            },
        },
        /**
         * 
         * Components
         *  */  
        // components:{Loading,EventList,RentList,JobList,RestaurantList,SaleList,ServiceList,Swiper,SwiperSlide},
    components: {Loading,AutoComplete},
        /**
         * Mounted
         *  */ 
        async mounted() {
            // Featured Restaurant
            this.load_business();
        },
    }
</script>
