<template>
<div>
    <div id="sidebar">
        <div class="card p-3" v-if="restaurants">
            <h6 class="py-2"> <span><i class="fas fa-utensils mr-2 text-danger"></i></span> Restaurant</h6>
            <div class="divider"></div>
            <div v-if="!loading" class="loading">
            </div>
            <div class="row" v-else>
                <swiper class="swiper" :options="settings">
                <!-- <h6 class="py-2"> <span><i class="fas fa-utensils mr-2 text-danger"></i></span> Restaurant</h6> -->
                        <swiper-slide  class="col-6" v-for="(restaurant,index) in restaurants" :key="index">
                            <a v-bind:href="'/restaurant/'+restaurant.id">
                            <div class="banner lazyload" :data-bgset="'/storage/Restaurant/Banner/'+restaurant.banner"  data-sizes="auto"></div>

                            <div class="rate" v-if="restaurant.rate !=null"><span v-bind:class="restaurant.rate_color" class="btn">{{restaurant.rate}}</span></div>
                            </a>
                            <h6 class="text-dark pt-3">{{restaurant.name}}</h6>
                            <p class="text-muted my-0">{{restaurant.mobile_no}}</p>
                            <p class="text-muted my-0">{{restaurant.location}}</p>
                        </swiper-slide>
                    <!-- <div class="swiper-pagination" slot="pagination"></div> -->
                    <div class="swiper-button-prev" slot="button-prev"></div>
                    <div class="swiper-button-next" slot="button-next"></div>
                </swiper>

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
    import { Swiper, SwiperSlide } from 'vue-awesome-swiper';

export default {
    // Data
    data(){
        return{
            loading: false,
            restaurants:[], // Restaurants Object
               settings:{
                    slidesPerView: 2,
                    spaceBetween: 30,
                    slidesPerGroup: 3,
                    loop: true,
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
    /**
     *  Methods
     *  */ 
    methods:{
        sidebar_restaurants(){
            /**
             * Restaurant Sidebar AD
             *  */ 
            axios.get('/api/restaurant/list/sidebar_ad')
            .then(response=>{
                this.isLoading = true; //Loading true
                if(response.data.length > 0){
                    for (let index = 0; index < response.data.length; index++) {
                        this.restaurants.push(response.data[Math.floor(Math.random() *response.data.length)]);
                        if(this.restaurants[index].rate >=0.0 && this.restaurants[index].rate <= 2.5){
                            this.restaurants[index].rate_color = 'bg-danger';
                        }else if(this.restaurants[index].rate >= 2.6 && this.restaurants[index].rate <= 3.5 ){
                            this.restaurants[index].rate_color = 'bg-warning';
                        }else if(this.restaurants[index].rate >= 3.6 && this.restaurants[index].rate <= 4.0 ){
                            this.restaurants[index].rate_color = 'bg-info';
                        }else if(this.restaurants[index].rate >= 4.1 && this.restaurants[index].rate <= 5.0 ){
                            this.restaurants[index].rate_color = 'bg-success';
                        }
                        else{
                            this.restaurants[index].rate_color = 'bg-secondary';
                        }
                        // loading
                        this.loading = true;
                    }
                        // this.restaurant = this.event;
                }else{
                    axios.get('/restaurants/list/all').then(response=>{
                    for (let index = 0; index < response.data.length; index++) {
                        this.restaurants.push(response.data[Math.floor(Math.random() *response.data.length)]);
                        if(this.restaurants[index].rate >=0.0 && this.restaurants[index].rate <= 2.5){
                            this.restaurants[index].rate_color = 'bg-danger';
                        }else if(this.restaurants[index].rate >= 2.6 && this.restaurants[index].rate <= 3.5 ){
                            this.restaurants[index].rate_color = 'bg-warning';
                        }else if(this.restaurants[index].rate >= 3.6 && this.restaurants[index].rate <= 4.0 ){
                            this.restaurants[index].rate_color = 'bg-info';
                        }else if(this.restaurants[index].rate >= 4.1 && this.restaurants[index].rate <= 5.0 ){
                            this.restaurants[index].rate_color = 'bg-success';
                        }
                        else{
                            this.restaurants[index].rate_color = 'bg-secondary';
                        }
                        // loading
                        this.loading = true;
                    }
                    })
                }
            })
        }
    },
    // Components
    components: {Swiper,SwiperSlide},

    // Mounted
    mounted(){
        this.sidebar_restaurants();
    }
}
</script>