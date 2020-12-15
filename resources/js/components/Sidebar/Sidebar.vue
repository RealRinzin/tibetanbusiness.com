<template>
<div id="sidebar" class="py-2" >
    <!-- sales -->
    <div class="card p-2" v-if="sales != ''">
        <h6 class="py-2 font-weight-bolder text-dark border-bottom"> <span><i class="fas fa-bed fa-1x mr-2 text-dark"></i></span> Sales - {{place}}</h6>
        <div class="row">
            <div class="col-6 py-2" v-for="(sale,index) in sales" v-if="index <= 3">
                <a v-bind:href="'/sale/'+sale.id">
                <!-- <div class="banner" v-bind:style='{ backgroundImage: `url(/storage/Sale/Banner/${sale.banner})`}'></div> -->
                <div class="banner lazyload" :data-bgset="'/storage/Sale/Banner/'+sale.card"  data-sizes="auto">
                    <button class="btn btn-danger position-absolute btn-sm small py-0 px-1" style="bottom:2px;right:2px">Rs: {{sale.price}}</button>
                </div>
                </a>
                <h6 class="text-muted pt-3 font-weight-bolder">{{sale.name}}</h6>
                <p class="text-muted my-0">{{sale.mobile_no}}</p>
                <p class="text-muted my-0">{{sale.location}}</p>
            </div>
        </div>
    </div>
    <!-- Events -->
    <div class="card p-2 my-2" v-if="events != ''">
        <h6 class="py-2 font-weight-bolder text-dark border-bottom"> <span><i class="fas fa-bed fa-1x mr-2 text-dark"></i></span> Event - {{event_location}}</h6>
        <div class="row">
            <div class="col-6 py-2" v-for="(event,index) in events" v-if="index <= 3">
                <a v-bind:href="'/event/'+event.id">
                <!-- <div class="banner" v-bind:style='{ backgroundImage: `url(/storage/Sale/Banner/${sale.banner})`}'></div> -->
                <div class="banner lazyload" :data-bgset="'/storage/Event/Banner/'+event.card"  data-sizes="auto">
                    <p v-if="event.entry_free" class="text-dark small position-absolute rounded bg-warning  price p-1 m-0 font-weight-bolder" style="bottom:2px;right:2px">Entry Free</p>
                    <p v-else class="text-white small position-absolute rounded bg-danger  price p-1 m-0 font-weight-bolder" style="bottom:2px;right:2px">Entry:&#x20B9 {{event.entry_fee}}</p>
                </div>
                </a>
                <h6 class="text-muted pt-3 font-weight-bolder">{{event.name}}</h6>
                <p class="text-muted my-0">{{event.mobile_no}}</p>
                <p class="text-muted my-0">{{event.location}}</p>
            </div>
        </div>
    </div>
    <!-- Rents -->
    <div class="card p-2 my-2" v-if="rents != ''">
        <h6 class="py-2 font-weight-bolder text-dark border-bottom"> <span><i class="fas fa-bed fa-1x mr-2 text-dark"></i></span> Rent - {{rent_location}}</h6>
        <div class="row">
            <div class="col-6 py-2" v-for="(rent,index) in rents" v-if="index <= 3">
                <a v-bind:href="'/rent/'+rent.id">
                <!-- <div class="banner" v-bind:style='{ backgroundImage: `url(/storage/Sale/Banner/${sale.banner})`}'></div> -->
                <div class="banner lazyload" :data-bgset="'/storage/Rent/Banner/'+rent.card"  data-sizes="auto">
                    <p class="text-danger small position-absolute rounded bg-light  price p-1 small m-0 font-weight-bolder" style="bottom:2px;right:2px">Rs: {{rent.fare}}</p>
                </div>
                </a>
                <h6 class="text-muted pt-3 font-weight-bolder">{{rent.name}}</h6>
                <p class="text-muted my-0">{{rent.mobile_no}}</p>
                <p class="text-muted my-0">{{rent.location}}</p>
            </div>
        </div>
    </div>
    <!-- Jobs -->
    <div class="card p-2 my-2" v-if="jobs != ''">
        <h6 class="py-2 font-weight-bolder text-dark border-bottom"> <span><i class="fas fa-bed fa-1x mr-2 text-dark"></i></span> job - {{job_location}}</h6>
        <div class="row">
            <div class="col-6 py-2" v-for="(job,index) in jobs" v-if="index <= 3">
                <a v-bind:href="'/job/'+job.id">
                <div class="banner lazyload" :data-bgset="'/storage/job/Banner/'+job.card"  data-sizes="auto">
                    <!-- <p class="text-danger small position-absolute rounded bg-light  price p-1 small m-0 font-weigxht-bolder" style="bottom:2px;right:2px">Rs: {{job.salary}}</p> -->
                </div>
                </a>
                <h6 class="text-muted pt-3 font-weight-bolder">{{job.title}}</h6>
                <p class="text-muted my-0">{{job.mobile_no}}</p>
                <p class="text-muted my-0">{{job.location}}</p>
            </div>
        </div>
    </div>
    <!-- Restaurant -->
    <div class="card p-2 my-2" v-if="restaurants != ''">
        <h6 class="py-2 font-weight-bolder text-dark border-bottom"> <span><i class="fas fa-bed fa-1x mr-2 text-dark"></i></span> restaurant - {{restaurant_location}}</h6>
        <div class="row">
            <div class="col-6 py-2" v-for="(restaurant,index) in restaurants" v-if="index <= 3">
                <a v-bind:href="'/restaurant/'+restaurant.id">
                <div class="banner lazyload small" :data-bgset="'/storage/restaurant/Banner/'+restaurant.card"  data-sizes="auto">
                    <span  v-if="restaurant.rate > 0.0" v-bind:class="restaurant.rate_color" class="btn p-0 px-1 position-absolute" style="bottom:2px;right:2px"> <i class="fas fa-star text-white fa-1x mr-1 small" ></i>{{restaurant.rate}}</span>

                </div>
                </a>
                <h6 class="text-muted pt-3 font-weight-bolder">{{restaurant.name}}</h6>
                <p class="text-muted my-0">{{restaurant.mobile_no}}</p>
                <p class="text-muted my-0">{{restaurant.location}}</p>
            </div>
        </div>
    </div>
    <!-- Service -->
    <div class="card p-2 my-2" v-if="services != ''">
        <h6 class="py-2 font-weight-bolder text-dark border-bottom"> <span><i class="fas fa-bed fa-1x mr-2 text-dark"></i></span> Services - {{service_location}}</h6>
        <div class="row">
            <div class="col-6 py-2" v-for="(service,index) in services" v-if="index <= 3">
                <a v-bind:href="'/service/'+service.id">
                <div class="banner lazyload small" :data-bgset="'/storage/Service/Banner/'+service.card"  data-sizes="auto">
                    <span  v-if="service.rate > 0.0" v-bind:class="service.rate_color" class="btn p-0 px-1 position-absolute" style="bottom:2px;right:2px"> <i class="fas fa-star text-white fa-1x mr-1 small" ></i>{{service.rate}}</span>

                </div>
                </a>
                <h6 class="text-muted pt-3 font-weight-bolder">{{service.name}}</h6>
                <p class="text-muted my-0">{{service.mobile_no}}</p>
                <p class="text-muted my-0">{{service.location}}</p>
            </div>
        </div>
    </div>
</div>
</template>
<script>
export default {
    props:['sale_id','location'],
    data(){
        return{
            place:this.location,
            sales:[],
            events:[],
            rents:[],
            services:[],
            restaurants:[],
            jobs:[],
            //Location
            event_location:'Other Places',
            rent_location:'Other Places',
            service_location:'Other Places',
            restaurant_location:'Other Places',
            job_location:'Other Places',
            
        }
    },
    // methods
    methods:{
        // Sales API
        sale(){
            axios.get('/api/sale/list/sidebar/'+this.place)
            .then(response=>{
                for (let index = 0; index < response.data.data.length; index++) {   
                    if(response.data.data[index].id != this.sale_id){
                        this.sales.push(response.data.data[index]);
                    }
                }
                if(this.sales.length ==0){
                    this.place = "Other Places";
                    axios.get('/api/sale/list/sidebar_ad')
                    .then(response=>{
                        if(response.data.length >0){
                            for (let index = 0; index < response.data.length; index++) {   
                                if(response.data[index].id != this.sale_id){
                                    this.sales.push(response.data[index]);
                                }
                            }
                        }else{
                            axios.get('/api/sale/list/all').then(response=>{
                                for (let index = 0; index < response.data.length; index++) {   
                                    if(response.data[index].id != this.sale_id){
                                        this.sales.push(response.data[index]);
                                    }
                                }
                            })
                        }
                    })
                }
            })
        },
        // Events API
        event(){
            axios.get('/api/event/list/sidebar/'+this.location)
            .then(response=>{
                if(response.data.data.length > 0){
                    this.events = response.data.data;
                }else{
                    axios.get('/api/event/list/sidebar_ad')
                    .then(response=>{
                        if(response.data.length > 0){
                            this.events = response.data;
                        }else{
                            axios.get('/api/event/list/all').then(response=>{
                                this.events = response.data;
                            })
                        }
                    })
                }
            })
        },
        // Rent API
        rent(){
            axios.get('/api/rent/list/sidebar/'+this.location)
            .then(response=>{
                if(response.data.data.length > 0){
                    this.rents = response.data.data;
                    this.event_location = this.location;
                }else{
                    axios.get('/api/rent/list/sidebar_ad')
                    .then(response=>{
                        if(response.data.length > 0){
                            this.rents = response.data;
                        }else{
                            axios.get('/api/rent/list/all').then(response=>{
                                this.rents = response.data;
                            })
                        }
                    })
                }
            })
        },
        // Job API
        job(){
            axios.get('/api/job/list/sidebar/'+this.location)
            .then(response=>{
                if(response.data.data.length > 0){
                    this.jobs = response.data.data;
                    this.job_location = this.location;
                }else{
                    axios.get('/api/job/list/sidebar_ad')
                    .then(response=>{
                        if(response.data.length > 0){
                            this.jobs = response.data;
                        }else{
                            axios.get('/api/job/list/all').then(response=>{
                                this.jobs = response.data;
                            })
                        }
                    })
                }
            })
        },
        // Restaurant API
        restaurant(){
            axios.get('/api/restaurant/list/sidebar/'+this.location)
            .then(response=>{
                if(response.data.data.length > 0){
                    this.restaurants = response.data.data;
                    this.restaurant_location = this.location;
                }else{
                    axios.get('/api/restaurant/list/sidebar_ad')
                    .then(response=>{
                        if(response.data.length > 0){
                            this.restaurants = response.data;
                        }else{
                            axios.get('/api/restaurant/list/all').then(response=>{
                                this.restaurants = response.data;
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
                                    // loading
                                }
                            })
                        }
                    })
                }
            })
            console.log(this.restaurants);
        },
        // Service API
        service(){
            axios.get('/api/service/list/sidebar/'+this.location)
            .then(response=>{
                if(response.data.data.length > 0){
                    this.services = response.data.data;
                    this.service_location = this.location;
                }else{
                    axios.get('/api/service/list/sidebar_ad')
                    .then(response=>{
                        if(response.data.length > 0){
                            this.services = response.data;
                        }else{
                            axios.get('/api/service/list/all').then(response=>{
                                this.services = response.data;
                                for (let index = 0; index < response.data.length; index++) {
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
                                    // loading
                                }
                            })
                        }
                    })
                }
            })
        }

    },
    mounted(){
        this.sale();
        this.event();
        this.rent();
        this.job();
        this.restaurant();
        this.service();
    }
}
</script>