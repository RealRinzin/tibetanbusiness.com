<template>
   <div class="row my-2" v-if="loading">
        <div class="col-md-12 mx-auto">
            <h6 class="small text-muted py-2 font-weight-bolder"><img src="/img/restaurant.png" class="mr-2" alt="">POPULAR RESTAURANTS</h6>
            <swiper class="row swiper" :options="settings">
                    <swiper-slide class="col-md-3 col-sm-6 col-6" v-for="(restaurant,index) in restaurants" :key="index">
                        <div class="card">
                            <a v-bind:href="'restaurant/'+restaurant.id">
                            <div class="banner rounded-top lazyload" v-bind:style='{ backgroundImage: `url(storage/restaurant/Banner/${restaurant.banner})`}'></div>
                            </a>
                            <div class="info p-2">
                                <h5>{{restaurant.name}}</h5>
                                <h6 class="pt-1">{{restaurant.mobile_no}}</h6>
                                <h6>{{restaurant.location}}</h6>
                            </div>
                        </div>
                    </swiper-slide>
                    <div class="swiper-button-prev" slot="button-prev"></div>
                    <div class="swiper-button-next" slot="button-next"></div>
            </swiper>
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
            settings:{
                // slidesPerView: 4,
                spaceBetween: 30,
                slidesPerGroup: 2,
                loop: true,
                breakpoints: {
                    1024: {
                    slidesPerView: 4,
                    spaceBetween: 30
                    },
                    768: {
                    slidesPerView: 3,
                    spaceBetween: 15
                    },
                    640: {
                    slidesPerView: 2,
                    spaceBetween: 15
                    },
                    320: {
                    slidesPerView: 1,
                    spaceBetween: 10,
                    slidesPerGroup: 1,
                    }
                },
                // loopFillGroupWithBlank: true,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev'
                }
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
                this.loading = true;
                if(response.data.length > 0){
                    this.restaurants = response.data;
                }else{
                    axios.get('/api/restaurant/list/all').then(response=>{
                        this.loading = true;
                        this.restaurants = response.data;
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