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
                    <div class="col-md-4 py-1">
                        <div class="card">
                            <a v-bind:href="'restaurant/'+restaurant.id"><div class="list" v-bind:style='{ backgroundImage: `url(img/${restaurant.banner})`}'></div></a>
                            <div class="likes" v-if="restaurant.rate != null">
                                <p v-bind:class="restaurant.rate_color" class="btn"><i class="fas fa-star text-white fa-1x mr-1"></i>{{restaurant.rate}}</p>
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
                </div>
            </div>
        </div> 
        <business-list></business-list>
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
                // random test
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
                        if(this.restaurant.rate >= 0.0 && this.restaurant.rate <= 3.5){
                            this.restaurant.rate_color = 'bg-danger';
                        }else if(this.restaurant.rate >= 3.6 && this.restaurant.rate <= 5.5 ){
                            this.restaurant.rate_color = 'bg-warning';
                        }else if(this.restaurant.rate >= 5.6 && this.restaurant.rate <= 7.0 ){
                            this.restaurant.rate_color = 'bg-info';
                        }else if(this.restaurant.rate >= 7.1 && this.restaurant.rate <= 10.0 ){
                            this.restaurant.rate_color = 'bg-success';
                        }else{
                            this.restaurant.rate_color = 'bg-secondary';
                        }
                    // Else Part
                    }else{
                        axios.get('restaurants/list')
                        .then(response=>{
                            // Assign normal live status
                            response.data.dat.forEach(element => {
                                // if (element['status'] === 1) {
                                    this.restaurant = response.data.data[Math.floor(Math.random() *response.data.data.length)]
                                // } 
                            });
                            /**
                             * Rating Background
                             * Color
                             *  */  
                            if(this.restaurant.rate >= 0.0 && this.restaurant.rate <= 3.5){
                                this.restaurant.rate_color = 'bg-danger';
                            }else if(this.restaurant.rate >= 3.6 && this.restaurant.rate <= 5.5 ){
                                this.restaurant.rate_color = 'bg-warning';
                            }else if(this.restaurant.rate >= 5.6 && this.restaurant.rate <= 7.0 ){
                                this.restaurant.rate_color = 'bg-info';
                            }else if(this.restaurant.rate >= 7.1 && this.restaurant.rate <= 10.0 ){
                                this.restaurant.rate_color = 'bg-success';
                            }else{
                                this.restaurant.rate_color = 'bg-secondary';
                            }
                        })
                    }
                    // loading success
                    this.isLoading = false; //Loading true
                    this.load = true;
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
        },
    }
</script>
