<template>
    <div>
    <loading :active.sync="isLoading"></loading>
        <div class="container">
            <button class="btn btn-warning">Latest Featured </button>
            <div class="row py-3">
                <div class="col-md-4 py-1" v-for="(restaurants,index) in restaurants">
                    <div class="card">
                        <a v-bind:href="'restaurant/'+restaurants.id"><div class="list" v-bind:style='{ backgroundImage: `url(img/${restaurants.banner})`}'></div></a>
                        <div class="likes">
                            <p class="btn btn-danger"><i class="fas fa-star text-white"></i>{{restaurants.rate}}</p>
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
                isLoading : false,//Lazy loading
                restaurants:[],
            }
        },
        /**
         * 
         * Methods
         *  */
        methods:{
            featured_restaurant(){
                this.isLoading = true; //Loading true
                axios.get('api/restaurant').then(response=>{
                    response.data.forEach(element => {
                        this.restaurants = response.data; //data
                        this.isLoading = false; //Loading true
                        // if(element.status === '1'){
                        // this.restaurants = response.data[0];
                        // }else{
                        // this.restaurants = response.data[0];
                        // }
                    });
                })
            }
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
            this.featured_restaurant();
        },
    }
</script>
