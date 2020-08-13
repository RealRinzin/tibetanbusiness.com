<template>
    <div class="row" v-if="loading">
        <div class="col-md-8 mx-auto">
            <h6 class="bg-danger btn">Restaurant</h6>
            <div class="row">
                <div class="col-md-6 col-6" v-for="(restaurants,index) in restaurants" :key="index" v-if="index <= 1">
                <!-- <div class="col-md-6"> -->
                    <div class="card">
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <a v-bind:href="'restaurant/'+restaurants.id">
                                <div class="banner lazyloaded" v-bind:style='{ backgroundImage: `url(storage/Restaurant/Banner/${restaurants.banner})`}'></div>
                                </a>
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
</template>
<script>
export default {
    data(){
        return{
            loading:false,
            restaurants:{},
        }
    },
    // methods / Functions
    methods:{
        // restaurants
        restaurant_list(){
            // home advertisment
            axios.get('api/restaurant/list/home_ad')
            .then(response=>{
                this.restaurants = response.data;
                this.loading = true;
                if(response.data.length > 0){
                    for (let index = 0; index < response.data.length; index++) {
                        this.restaurants[index] = response.data[Math.floor(Math.random() *response.data.length)]
                    }
                }else{
                    axios.get('/api/restaurant/list/all').then(response=>{
                        this.loading = true;
                        for (let index = 0; index < response.data.data.length; index++) {
                            this.restaurants[index] = response.data.data[Math.floor(Math.random() *response.data.data.length)]
                        }
                    })
                }
            })
        }
    },
    // mounted
    mounted(){
        this.restaurant_list(); // Restaurant
    }
}
</script>