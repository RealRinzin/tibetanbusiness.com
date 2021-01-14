<template>
<div>
    <div id="carouselExampleSlidesOnly" class="carousel slide carousel-fade" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
            <img class="d-block w-100" src="/storage/Carousel/1.jpg" alt="First slide">
            </div>
            <div class="carousel-item">
            <img class="d-block w-100" src="/storage/Carousel/3.jpg" alt="First slide">
            </div>
            <div class="carousel-item">
            <img class="d-block w-100" src="/storage/Carousel/2.jpg" alt="First slide">
            </div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    asdfds
                </div>
            </div>
        </div>
        </div>

    </div>
</div>

</template>
<script>
import { Swiper, SwiperSlide } from 'vue-awesome-swiper';

export default {
          data(){
          return{
            locations:{},
            place:'',
            service:'',
            types:[
                {'name':'Events','img':'/img/event.png'},
                {'name':'Sales','img':'/img/sale.png'},
                {'name':'Rents','img':'/img/rent.png'},
                {'name':'Jobs','img':'/img/job.png'},
                {'name':'Services','img':'/img/service.png'},
                {'name':'Restaurants','img':'/img/restaurant.png'},
            ],
            sliders:'',
            // swiper setting
            carousel:{
                slidesPerView: 1,
                spaceBetween: 30,
                loop:true,
                effect: 'fade',
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false
                    }
                }
            }
      },
    components:{Swiper, SwiperSlide},
    mounted(){
        axios.get('/api/carousel')
        .then((response) => {
            this.sliders = response.data;
            console.log(response.data);
        }).catch((err) => {
            
        });
    }
}
</script>