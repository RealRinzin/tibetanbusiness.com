<template>
    <div id="business_list">
        <div class="container">
            <div class="row">
                <!-- Restaurant -->
                <div v-if="!loading" class="col-md-12 loading"></div>
                <div v-else  class="col-md-8 mx-auto">
                    <h6 class="bg-danger btn">Upcoming Events</h6>
                    <div class="row">
                        <div class="col-md-6" v-for="(restaurants,index) in restaurants" v-if="index <= 1">
                        <!-- <div class="col-md-6"> -->
                            <div class="card">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6">
                                        <a v-bind:href="'restaurant/'+restaurants.id"><div class="banner" v-bind:style='{ backgroundImage: `url(img/${restaurants.banner})`}'></div></a>
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
            restaurants:[],
        }
    },
    // methods / Functions
    methods:{
        // restaurants
        restaurant_list(){
            // home advertisment
            axios.get('api/restaurant/list/home_ad')
            .then(response=>{
                if(response.data.length > 0){
                    for (let index = 0; index < response.data.length; index++) {
                        this.restaurants[index] = response.data[Math.floor(Math.random() *response.data.length)]
                    }
                    this.loading = true;
                }else{
                    axios.get('restaurants/list').then(response=>{
                        for (let index = 0; index < response.data.data.length; index++) {
                            this.restaurants[index] = response.data.data[Math.floor(Math.random() *response.data.data.length)]
                        }
                        // loading
                        this.loading = true;
                    })
                }
            })
        }
    },
    mounted(){
        this.restaurant_list(); // Restaurant
    }
}
</script>