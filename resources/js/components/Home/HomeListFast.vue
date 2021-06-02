<template>
    <div class="row">
        <!-- Event -->
        <div class="col-md-10 mx-auto my-4" v-if="events !=''">
            <a v-bind:href="`/search/Events?location=${location.event}`">
                <h6 class="small text-muted py-2 font-weight-bolder">
                    <img src="/img/event.png" class="mr-2" height="25px" width="25px" alt="tibetanbusiness.com">POPULAR - UPCOMING EVENTS
                </h6>
            </a>
            <div class="row" style="min-height:100px">
                <div v-if="event_loading" class="col-12">
                    <div class="row">
                        <div class="col-md-3" v-for="x in 4">
                            <div class="card">
                                <lazy-loading class="mb-0"></lazy-loading>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-6 py-1" v-for="(event,index) in events" v-if="index <= 3">
                    <div class="card" >
                        <a v-bind:href="'event/'+event.id">
                        <div class="banner rounded-top lazyload" :data-bgset="'/storage/Event/Banner/'+event.thumb"   data-sizes="auto">
                            <p v-if="event.entry_free" class="text-dark small position-absolute rounded bg-warning  price p-1 m-0 ">Entry Free</p>
                            <p v-else class="text-white small position-absolute rounded bg-danger  price p-1 m-0 ">Entry:&#x20B9 {{event.entry_fee}}</p>
                        </div>
                        </a>
                        <div class="info p-2">
                            <h5>{{event.name}}</h5>
                            <h6 class="pt-1">{{event.mobile_no}}</h6>
                            <h6>{{event.location}}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sales -->
        <div class="col-md-10 mx-auto my-4" v-if="sales !=''">
            <a v-bind:href="`/search/Sales?location=${location.sale}`">
                <h6 class="small text-muted py-2 font-weight-bolder">
                    <img src="/img/sale.png" class="mr-2" height="25px" width="25px" alt="tibetanbusiness.com">POPULAR SALES
                </h6>
            </a>
            <div class="row">
                <div v-if="sale_loading" class="col-12">
                    <div class="row">
                        <div class="col-md-3" v-for="x in 4">
                            <div class="card">
                                <lazy-loading class="mb-0"></lazy-loading>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-6 py-1" v-for="(sale,index) in sales" :key="index" v-if="index <= 3">
                    <div class="card">
                        <a v-bind:href="'sale/'+sale.id">
                        <div class="banner rounded-top lazyload" :data-bgset="'/storage/Sale/Banner/'+sale.thumb"  data-sizes="auto">
                            <p class="text-white small position-absolute rounded bg-danger price p-1 m-0 ">Price:
                                <span v-if="sale.price > 0 ">&#x20B9 {{sale.price}}/-</span>
                                <span v-else> <i class="fas fa-phone-alt mr-1"></i> Call </span>
                            </p>
                        </div>
                        </a>
                        <div class="info p-1">
                            <h5>{{sale.name}}</h5>
                            <h6>{{sale.mobile_no}}</h6>
                            <h6>{{sale.location}}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Rents -->
        <div class="col-md-10 mx-auto my-4" v-if="rents !=''">
            <a v-bind:href="`/search/Rents?location=${location.rent}`">
                <h6 class="small text-muted py-2 font-weight-bolder">
                    <img src="/img/rent.png" class="mr-2" height="25px" width="25px" alt="tibetanbusiness.com">POPULAR RENTS
                </h6>
            </a>
            <div class="row">
                <div v-if="rent_loading" class="col-12">
                    <div class="row">
                        <div class="col-md-3" v-for="x in 4">
                            <div class="card">
                                <lazy-loading class="mb-0"></lazy-loading>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-6 py-1" v-for="(rent,index) in rents" :key="index" v-if="index <= 3">
                    <div class="card">
                        <a v-bind:href="'rent/'+rent.id">
                        <div class="banner rounded-top lazyload" :data-bgset="'/storage/Rent/Banner/'+rent.thumb+' 100w'"  data-sizes="auto">
                            <p v-if="rent.fare" class="text-white small position-absolute rounded bg-danger price p-1 m-0 ">Rent:&#x20B9 {{rent.fare}}</p>
                        </div>
                        </a>
                        <div class="info p-2">
                            <h5>{{rent.name}}</h5>
                            <h6>{{rent.mobile_no}}</h6>
                            <h6>{{rent.location}}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Jobs -->
        <div class="col-md-10 mx-auto my-4" v-if="jobs !=''">
            <a v-bind:href="`/search/Announcements?location=${location.job}`">
                <h6 class="small text-muted py-2 font-weight-bolder">
                    <img src="/img/job.png" class="mr-2" height="25px" width="25px" alt="tibetanbusiness.com">JOBS / ANNOUNCEMENTS
                </h6>
            </a>
            <div class="row">
                <div v-if="job_loading" class="col-12">
                    <div class="row">
                        <div class="col-md-3" v-for="x in 4">
                            <div class="card">
                                <lazy-loading class="mb-0"></lazy-loading>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-6 py-1" v-for="(job,index) in jobs" :key="index" v-if="index <= 3">
                    <div class="card">
                        <a v-bind:href="'/announcement/'+job.id">
                        <div class="banner rounded-top lazyload" :data-bgset="'/storage/Job/Banner/'+job.thumb"  data-sizes="auto">
                            <h6 v-if="job.types == 1" class="btn btn-success p-1 position-absolute mx-1" style="font-size:10px;bottom:0px">JOBS</h6>
                            <h6 v-if="job.types == 2" class="btn btn-success p-1 position-absolute mx-1" style="font-size:10px;bottom:0px">ANNOUNCEMENTS</h6>
                        </div>
                        </a>
                        <div class="info p-1" v-if="job.types == 1">
                            <h5>{{job.title}}</h5>
                            <h6 class="pt-1" v-if="job.mobile_no !=null">{{job.mobile_no}}</h6>
                            <h6>{{job.location}}</h6>
                        </div>
                        <div class="info p-1" v-if="job.types == 2">
                            <h5>{{job.title}}</h5>
                            <h6 class="pt-1" v-if="job.mobile_no">{{job.mobile_no}}</h6>
                            <h6>{{job.country}}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Services -->
        <div class="col-md-10 mx-auto my-4" v-if="services !=''">
            <a v-bind:href="`/search/Services?location=${location.service}`">
                <h6 class="small text-muted py-2 font-weight-bolder">
                    <img src="/img/service.png" class="mr-2" height="25px" width="25px" alt="tibetanbusiness.com">POPULAR SERVICES
                </h6>
            </a>
            <div class="row">
                <div v-if="service_loading" class="col-12">
                    <div class="row">
                        <div class="col-md-3" v-for="x in 4">
                            <div class="card">
                                <lazy-loading class="mb-0"></lazy-loading>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-6 py-1" v-for="(service,index) in services" :key="index" v-if="index <= 3">
                    <div class="card">
                        <a v-bind:href="'service/'+service.id">
                        <div class="banner rounded-top lazyload" :data-bgset="'/storage/Service/Banner/'+service.thumb"  data-sizes="auto">
                            <p v-if="service.rate > 0.0" v-bind:class="service.rate_color" class="btn btn-sm mt-1 mr-1 float-right"><i class="fas fa-star fa-1x mr-1"></i>{{service.rate}}</p>
                        </div>
                        </a>
                        <div class="info p-1">
                            <h5>{{service.name}}</h5>
                            <h6 class="pt-1">{{service.mobile_no}}</h6>
                            <h6>{{service.location}}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Restaurants -->
        <div class="col-md-10 mx-auto my-4" v-if="restaurants !=''">
            <a v-bind:href="`/search/Restaurants?location=${location.restaurant}`">
            <h6 class="small text-muted py-2 font-weight-bolder">
                <img src="/img/restaurant.png" class="mr-2" height="25px" width="25px" alt="tibetanbusiness.com">POPULAR RESTAURANTS
            </h6>
            </a>
            <div class="row">
                <div v-if="restaurant_loading" class="col-12">
                    <div class="row">
                        <div class="col-md-3" v-for="x in 4">
                            <div class="card">
                                <lazy-loading class="mb-0"></lazy-loading>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-6 py-1" v-for="(restaurant,index) in restaurants" :key="index" v-if="index <= 3">
                    <div class="card">
                        <a v-bind:href="'restaurant/'+restaurant.id">
                        <div class="banner rounded-top lazyload" :data-bgset="'/storage/Restaurant/Banner/'+restaurant.card"  data-sizes="auto">
                            <p v-if="restaurant.rate > 0.0" v-bind:class="restaurant.rate_color" class="btn btn-sm  small mt-1 mr-1 float-right"><i class="fas fa-star text-white fa-1x mr-1"></i>{{restaurant.rate}}</p>
                        </div>
                        </a>
                        <div class="info p-2">
                            <h5>{{restaurant.name}}</h5>
                            <h6 class="pt-1">{{restaurant.mobile_no}}</h6>
                            <h6>{{restaurant.location}}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>;
export default {
    data(){
        return{
            total:4,
            // object
            events:{},
            rents:{},
            sales:{},
            jobs:{},
            services:{},
            restaurants:{},
            // loading
            event_loading:true,
            sale_loading:true,
            rent_loading:true,
            job_loading:true,
            service_loading:true,
            restaurant_loading:true,
        // location
            location:{
                event:{},
                job:{},
                rent:{},
                restaurant:{},
                sale:{},
                service:{},
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
                if(response.data.length > 0){
                    this.event_loading = false;
                    this.events = response.data;

                }else{
                    axios.get('/api/event/list/all').then(response=>{
                        this.event_loading = false;
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
                if(response.data.length > 0){
                    this.sale_loading = false;
                    this.sales = response.data;
                }else{
                    axios.get('/api/sale/list/all').then(response=>{
                        this.sale_loading = false;
                        this.sales = response.data;
                    })
                }
            })
        },
        rent_list(){
            // home advertisment
            axios.get('api/rent/list/home_ad')
            .then(response=>{
                if(response.data.length > 0){
                    this.rent_loading = false;
                    this.rents = response.data;
                }else{
                    axios.get('/api/rent/list/all').then(response=>{
                        this.rent_loading = false;
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
                    this.job_loading = false;
                    this.jobs = response.data;
                }else{
                    axios.get('/api/job/list/all').then(response=>{
                        this.jobs = response.data;
                        this.job_loading = false;
                    })
                }
            })
        },
        // Service
        service_list(){
            // home advertisment
            axios.get('api/service/list/home_ad')
            .then(response=>{
                if(response.data.length > 0){                    
                    this.service_loading = false;
                    this.services = response.data;

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
                    axios.get('/api/service/list/all').then(response=>{
                        this.service_loading = false;
                        this.services = response.data;

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
        // Restaurant
        restaurant_list(){
            // home advertisment
            axios.get('api/restaurant/list/home_ad')
            .then(response=>{
                if(response.data.length > 0){
                    console.log("home ad");
                    this.restaurants = response.data;
                    this.restaurant_loading = false;
                    //  rating
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
                    axios.get('/api/restaurant/list/all').then(response=>{
                        this.restaurant_loading = false;
                        this.restaurants = response.data;
                        // Star Rating
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
            })
        }
    },
    mounted(){
        this.event_list(); // Restaurant
        this.sale_list();
        this.rent_list();
        this.job_list();
        this.service_list();
        this.restaurant_list();
              // Event Location
      axios.get('/api/location/event')
      .then(response =>{
        this.location.event = response.data[0].location;
      })
      // Rent
      axios.get('/api/location/rent')
      .then(response =>{
        this.location.rent = response.data[0].location;
      })
      // Job
      axios.get('/api/location/job')
      .then(response =>{
        this.location.job = response.data[0].location;
      })
      // Restaurant
      axios.get('/api/location/restaurant')
      .then(response =>{
        this.location.restaurant = response.data[0].location;
      })
      // Sale
      axios.get('/api/location/sale')
      .then(response =>{
        this.location.sale = response.data[0].location;
      })
      // Service
      axios.get('/api/location/service')
      .then(response =>{
        this.location.service = response.data[0].location;
      })
    }
}
</script>