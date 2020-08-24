<template>
    <div class="row" v-if="loading">
        <div class="col-md-8 mx-auto">
            <h6 class="bg-danger btn">Restaurant</h6>
            <div class="row">
                <swiper class="swiper" :options="settings">
                    <swiper-slide class="col-md-6 col-6" v-for="(restaurants,index) in restaurants" :key="index">
                        <div class="card">
                            <div class="row">
                                <div class="col-12">
                                    <a v-bind:href="'restaurant/'+restaurants.id">
                                    <div class="banner lazyloaded" v-bind:style='{ backgroundImage: `url(storage/Restaurant/Banner/${restaurants.banner})`}'></div>
                                    </a>
                                </div>
                                <div class="info">
                                    <h5>{{restaurants.name}}</h5>
                                    <h6 class="pt-1">{{restaurants.mobile_no}}</h6>
                                    <h6>{{restaurants.location}}</h6>
                                </div>
                            </div>
                        </div>
                    </swiper-slide>
                    <div class="swiper-button-prev" slot="button-prev"></div>
                    <div class="swiper-button-next" slot="button-next"></div>
                </swiper>
            </div>
        </div>
    </div>
</template>
<script>
    import { Swiper, SwiperSlide } from 'vue-awesome-swiper';
export default {
    data(){
        return{
            loading:false,
            restaurants:[],
                    // slider 
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
                }
        }
    },
    // methods / Functions
    methods:{
        // restaurants
        restaurant_list(){
            // home advertisment
            axios.get('api/restaurant/list/home_ad')
            .then(response=>{
                // this.restaurants = response.data;
                this.loading = true;
                if(response.data.length > 0){
                    for (let index = 0; index < response.data.length; index++) {
                        this.restaurants.push(response.data[Math.floor(Math.random() *response.data.length)]);
                    }
                }else{
                    axios.get('/api/restaurant/list/all').then(response=>{
                        this.loading = true;
                        for (let index = 0; index < response.data.length; index++) {
                            this.restaurants.push(response.data[Math.floor(Math.random() *response.data.length)]);
                        }
                    })
                }
            })
        }
    },
    components: {Swiper,SwiperSlide},

    // mounted
    mounted(){
        this.restaurant_list(); // Restaurant
    }
}
</script>