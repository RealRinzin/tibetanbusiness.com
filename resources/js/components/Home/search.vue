<template>
<div class="p-0">
    <div class="position-relative">
        <swiper class="swiper p-0" :options="carousel" style="height:70vh">
            <swiper-slide v-for="(event,index) in events" :key="index" v-bind:style="{ backgroundImage: 'url(' + event.bg + ')' }" style="background-size:cover;background-position:center center; background-repeat:no-repeat">{{event.bg}}</swiper-slide>
        <div>sdafsdaf</div>
        </swiper>
    </div>
</div>
</template>

<script>
import { Swiper, SwiperSlide } from 'vue-awesome-swiper'
// import 'swiper/swiper-bundle.css';
import 'swiper/css/swiper.css'
  export default {
      data(){
          return{
        events: [
                {
                "id": "9c24137e63f549d98ce3f3fceb3854d4",
                "user_id": "61665655374d492c863f8aaf770a52a5",
                "event_basic_info_id": "13bd031ecccb4b0d89856fa77f00cf04",
                "created_at": "2020-08-19 09:15:53",
                "updated_at": "2020-08-19 09:15:53",
                "bg":"/img/food2.jpg"
                },
                {
                "id": "cbfa54ac48244911a9cb81dfc1477033",
                "user_id": "ec7dbbe568bd4120833af0261141157b",
                "event_basic_info_id": "13bd031ecccb4b0d89856fa77f00cf04",
                "created_at": "2020-08-20 03:47:53",
                "updated_at": "2020-08-20 03:47:53",
                "bg":"/img/food4.jpg"
                },
                {
                "id": "sdljkasljksadfljsdjklfadsfjlsadflkfdsljk",
                "user_id": "ec7dbbe568bd4120833af0261141157b",
                "event_basic_info_id": "13bd031ecccb4b0d89856fa77f00cf04",
                "created_at": "2020-08-20 03:47:53",
                "updated_at": "2020-08-20 03:47:53",
                "bg":"/img/food6.jpg"
                },
                {
                "id": "sdfjklsdlkjfsalkfjlsad ",
                "user_id": "ec7dbbe568bd4120833af0261141157b",
                "event_basic_info_id": "13bd031ecccb4b0d89856fa77f00cf04",
                "created_at": "2020-08-20 03:47:53",
                "updated_at": "2020-08-20 03:47:53",
                "bg":"/img/food8.jpg"
                }
            ],
            carousel:{
                slidesPerView: 1,
                spaceBetween: 30,
                loop:true,
                effect: 'fade',
                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false
                },
            },
        settings:{
                slidesPerView: 1,
                spaceBetween: 30,
                loop:true,
                //  Arrow
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev'
                },
                // BreakPoint
                breakpoints: {
                    1024: {
                    slidesPerView: 2,
                    spaceBetween: 40
                    },
                    768: {
                    slidesPerView: 3,
                    spaceBetween: 30
                    },
                    640: {
                    slidesPerView: 2,
                    spaceBetween: 20
                    },
                    320: {
                    slidesPerView: 1,
                    spaceBetween: 10
                    }
                },
                // pagination
                pagination: {
                    el: '.swiper-pagination'
                }
              }
          }
      },
    components: {Swiper,SwiperSlide},
    mounted(){

    }
}
</script>
