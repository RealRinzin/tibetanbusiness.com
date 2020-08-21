<template>
<div class="contain">
    <span v-for="list in active">{{list.name}}</span>
    <swiper class="swiper col-md-4 col-sm-6 col-12" :options="settings">
        <swiper-slide v-for="(events,index) in events" :key="index" >
                        <div class="card">
                            <a v-bind:href="'restaurant/'+events.id">
                            <!-- <div class="list" v-bind:style='{ backgroundImage: `url(/storage/events/Banner/${events.banner})`}'></div> -->
                                <div class="list lazyload" :data-bgset="'/storage/event/Banner/'+events.banner"  data-sizes="auto">
                                </div>
                            </a>
                            <div class="likes" v-if="events.rate > 0">
                                <p v-if="events" v-bind:class="events.rate_color" class="btn"><i class="fas fa-star text-white fa-1x mr-1"></i>{{events.rate}}</p>
                            </div>
                            <div class="types">
                                <button class="btn btn-outline-info btn-xs py-1"><i class="fas fa-mug-hot mx-1"></i>Restuarant</button>
                            </div>
                            <div class="card-body text-truncate">
                                <h5>{{events.name}}</h5>
                                <h6>{{events.mobile_no}}</h6>
                                <h6>{{events.location}}</h6>
                            </div>
                        </div>
        </swiper-slide>
        <!-- <div class="swiper-pagination" slot="pagination"></div> -->
        <div class="swiper-button-prev" slot="button-prev"></div>
        <div class="swiper-button-next" slot="button-next"></div>
    </swiper>
</div>
</template>

<script>
import { Swiper, SwiperSlide } from 'vue-awesome-swiper'
// import 'swiper/swiper-bundle.css';
import 'swiper/css/swiper.css'
  export default {
      data(){
          return{
              events:[],
              active:[],
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
                // BreakPoint
                // breakpoints: {
                //     1024: {
                //     slidesPerView: 1,
                //     spaceBetween: 30
                //     },
                //     768: {
                //     slidesPerView: 3,
                //     spaceBetween: 30
                //     },
                //     640: {
                //     slidesPerView: 2,
                //     spaceBetween: 20
                //     },
                //     320: {
                //     slidesPerView: 1,
                //     spaceBetween: 10
                //     }
                // },
                // pagination
                pagination: {
                    el: '.swiper-pagination'
                }
              }
          }
      },
    components: {Swiper,SwiperSlide},
    mounted(){

        axios.get('/api/event/list/featured_ad')
        .then(response=>{
            // this.events = response.data;
            for (let index = 0; index < response.data.length; index++) {
                // this.events.push(response.data[Math.floor(Math.random() * response.data.length)] = response.data[Math.floor(Math.random() *response.data.length)]);
                this.events.push(response.data[Math.floor(Math.random() *response.data.length)]);

                if(this.events[index].rate >=0.0 && this.events[index].rate <= 2.5){
                    this.events[index].rate_color = 'bg-danger';
                }else if(this.events[index].rate >= 2.6 && this.events[index].rate <= 3.5 ){
                    this.events[index].rate_color = 'bg-warning';
                }else if(this.events[index].rate >= 3.6 && this.events[index].rate <= 4.0 ){
                    this.events[index].rate_color = 'bg-info';
                }else if(this.events[index].rate >= 4.1 && this.events[index].rate <= 5.0 ){
                    this.events[index].rate_color = 'bg-success';
                }
                else{
                    this.events[index].rate_color = 'bg-secondary';

                }
                
            }
            // for (let index = 0; index < response.data.length; index++) {
            //     this.active.push(response.data[Math.floor(Math.random() *response.data.length)] = response.data[Math.floor(Math.random() *response.data.length)]);
            //             // this.active[Math.floor(Math.random() *response.data.length)] = response.data[Math.floor(Math.random() *response.data.length)]                        

            // }
            // console.log(this.active);
            //   if(this.events.rate >= 0.0 && this.events.rate <= 2.5){
            //         this.events.rate_color = 'bg-danger';
            //     }else if(this.events.rate >= 2.6 && this.events.rate <= 3.5 ){
            //         this.events.rate_color = 'bg-warning';
            //     }else if(this.events.rate >= 3.6 && this.events.rate <= 4.0 ){
            //         this.events.rate_color = 'bg-info';
            //     }else if(this.events.rate >= 4.1 && this.events.rate <= 5.0 ){
            //         this.events.rate_color = 'bg-success';
            //     }else{
            //         this.events.rate_color = 'bg-secondary';
            // }
        })

    }
}
</script>
