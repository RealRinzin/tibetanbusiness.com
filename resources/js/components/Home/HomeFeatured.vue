<template>
    <div>
        <div v-if="!load">
            <loading :active.sync="isLoading"></loading>
        </div>
        <div v-else>
            <div class="container">
                <button class="btn btn-warning">Latest Featured </button>
                <div class="row py-3">
                    <div class="col-md-4 py-1" v-for="(restaurants,index) in restaurants" v-if="index <= 5">
                        <div class="card">
                            <a v-bind:href="'restaurant/'+restaurants.id"><div class="list" v-bind:style='{ backgroundImage: `url(img/${restaurants.banner})`}'></div></a>
                            <div class="likes">
                                <p v-bind:class="restaurants.rate_color" class="btn"><i class="fas fa-star text-white fa-1x mr-1"></i>{{restaurants.rate}}</p>
                            </div>
                            <div class="types">
                                <button class="btn btn-outline-info btn-xs py-1"><i class="fas fa-mug-hot mx-1"></i>Restuarant</button>
                            </div>
                            <div class="card-body text-truncate">
                                <h5>{{restaurants.name}}</h5>
                                <h6>{{restaurants.mobile_no}}</h6>
                                <h6>{{restaurants.location}}</h6>
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
                restaurants:{},
            }
        },
        /**
         * 
         * Methods
         *  */
        methods:{
            // Featured business
            featured_restaurant(){
                this.isLoading = true; //Loading true
                axios.get('api/restaurant').then(response=>{
                    response.data.forEach(element => {
                        this.restaurants = response.data; //data
                        this.isLoading = false; //Loading true
                        this.load = true;
                    });
                    /**
                     * Rate background color
                     *  */ 
                    for (let index = 0; index < this.restaurants.length; index++) {
                        if(this.restaurants[index].rate >= 0.0 && this.restaurants[index].rate <= 3.5){
                            this.restaurants[index].rate_color = 'bg-danger';
                        }else if(this.restaurants[index].rate >= 3.6 && this.restaurants[index].rate <= 5.5 ){
                            this.restaurants[index].rate_color = 'bg-warning';
                        }else if(this.restaurants[index].rate >= 5.6 && this.restaurants[index].rate <= 7.0 ){
                            this.restaurants[index].rate_color = 'bg-info';
                        }else if(this.restaurants[index].rate >= 7.1 && this.restaurants[index].rate <= 10.0 ){
                            this.restaurants[index].rate_color = 'bg-success';
                        }else{
                            this.restaurant.comments[index].rate_color = 'bg-secondary';
                        }
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
            this.featured_restaurant();
        },
    }
</script>
