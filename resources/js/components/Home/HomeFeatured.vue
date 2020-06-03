<template>
    <div>
        <div v-if="!load">
            <loading :active.sync="isLoading"></loading>
        </div>
        <div v-else>
            <div class="container">
                <button class="btn btn-warning">Latest Featured </button>
                <div class="row py-3">
                    <!-- <div class="col-md-4 py-1" v-for="(restaurants,index) in restaurants" v-if="index <= 5"> -->
                    <!-- Restaurant -->
                    <div class="col-md-4 py-1" v-if="restaurant">
                        <div class="card">
                            <a v-bind:href="'restaurant/'+restaurant.id"><div class="list" v-bind:style='{ backgroundImage: `url(img/${restaurant.banner})`}'></div></a>
                            <div class="likes" v-if="restaurant.rate != null">
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
                    <div class="col-md-4 py-1" v-if="event">
                        <div class="card">
                            <a v-bind:href="'restaurant/'+event.id"><div class="list" v-bind:style='{ backgroundImage: `url(img/${event.banner})`}'></div></a>
                            <div class="likes" v-if="event.rate != null">
                                <p v-if="event" v-bind:class="event.rate_color" class="btn"><i class="fas fa-star text-white fa-1x mr-1"></i>{{event.rate}}</p>
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
                    <!-- <featured-rent></featured-rent> -->
                    <!-- <featured-job></featured-job> -->
                </div>
            </div>
        </div> 

        <!-- <business-list></business-list> -->
        <home-restaurant></home-restaurant>
        <home-rent></home-rent>
        <home-job></home-job>
    </div>
</template>

<script>
    // Import component
    import Loading from 'vue-loading-overlay';
    // Import stylesheet
    import 'vue-loading-overlay/dist/vue-loading.css';
    export default {
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
            }
        },
        /**
         * 
         * Methods
         *  */
        methods:{
            // Featured business
            load_restaurant(){
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
                        // loading success
                        this.isLoading = false; //Loading true
                        this.load = true;
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
                            this.isLoading = false; //Loading true
                            this.load = true;
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
                            this.isLoading = false; //Loading true
                    }else{
                        axios.get('/api/event/list/all')
                        .then(response=>{
                            console.log("all");
                            
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
                            this.isLoading = false; //Loading true
                        })
                    }        
                })


            },
        },
        /**
         * 
         * Components
         *  */  
        components:{Loading},
        /**
         * Mounted
         *  */ 
        mounted() {
            // Featured Restaurant
            this.load_restaurant();


            // API
            // axios.get('https://indian-cities-api-nocbegfhqg.now.sh/cities')
            // .then(response=>{
            //     console.log(response);
                
            // })
        },
    }
</script>
