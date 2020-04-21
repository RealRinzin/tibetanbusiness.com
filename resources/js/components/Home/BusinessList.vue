<template>
    <div id="business_list">
        <div v-if="!loading">
            <loading :active.sync="isLoading"></loading>
        </div>
        <div v-else>
            <div class="container">
                <div class="row">
                    <!-- Event -->
                    <div class="col-md-8 mx-auto">
                        <h6 class="bg-danger btn">Upcoming Events</h6>
                        <div class="row">
                            <div class="col-md-6" v-for="(restaurants,index) in restaurants.slice(0,4)">
                                <div class="card">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6">
                                            <a href="#"><div class="banner" v-bind:style='{ backgroundImage: `url(img/${restaurants.banner})`}'></div></a>
                                        </div>
                                        <div class="col-md-6 col-sm-6 p-3 info">
                                            <h5>{{restaurants.name}}</h5>
                                            <h6 class="pt-1">{{restaurants.mobile_no}}</h6>
                                            <h6>{{restaurants.location}}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Rent -->
                    <div class="col-md-8 mx-auto">
                        <h6 class="bg-danger btn">Upcoming Events</h6>
                        <div class="row">
                            <div class="col-md-6" v-for="(restaurants,index) in restaurants.slice(2,6)">
                                <div class="card">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6">
                                            <a v-bind:href="'restaurant/'+restaurants.id"><div class="banner"></div></a>
                                        </div>
                                        <div class="col-md-6 col-sm-6 p-3 info">
                                            <h5>{{restaurants.name}}</h5>
                                            <h6 class="pt-1">{{restaurants.mobile_no}}</h6>
                                            <h6>{{restaurants.location}}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
export default {
    data(){
        return{
            loading:false,
            isLoading : false,//Lazy loading
            restaurants:[],
        }
    },
    // methods / Functions
    methods:{
        // restaurants
        restaurant_list(){
                this.isLoading = true; //Loading true
            axios.get('restaurants/list').then(response=>{
                this.restaurants = response.data.data;
                // loading
                this.isLoading = false; //Loading true
                this.loading = true;
            })
        }
    },
    /**
     * 
     * Components
     *  */  
    components:{Loading},
    mounted(){
        this.restaurant_list(); // Restaurant
    }
}
</script>