<template>
    <div class="row" v-if="loading">
        <div class="col-md-12 mx-auto">
            <h6 class="small text-muted py-2 font-weight-bolder"><img src="/img/event.png" class="mr-2" alt="">POPULAR EVENTS</h6>
            <swiper class="row swiper" :options="settings">
                    <swiper-slide class="col-md-3 col-sm-6 col-6" v-for="(event,index) in events" :key="index">
                        <div class="card">
                            <a v-bind:href="'event/'+event.id">
                            <div class="banner rounded-top lazyload" v-bind:style='{ backgroundImage: `url(storage/Event/Banner/${event.banner})`}'></div>
                            </a>
                            <div class="info p-2">
                                <h5>{{event.name}}</h5>
                                <h6 class="pt-1">{{event.mobile_no}}</h6>
                                <h6>{{event.location}}</h6>
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
            events:{},
            loading:false,
                // Swiper Carousel
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
        // events
        event_list(){
            // home advertisment
            axios.get('api/event/list/home_ad')
            .then(response=>{
                // this.isLoading = true; //Loading true
                this.events = response.data;
                if(response.data.length > 0){
                    this.loading = true;
                    this.events = response.data;

                }else{
                    axios.get('/api/event/list/all').then(response=>{
                        this.loading = true;
                        this.events = response.data;
                    })
                }
            })
        }
    },
    components: {Swiper,SwiperSlide},

    mounted(){
        this.event_list(); // Restaurant
    }
}
</script>