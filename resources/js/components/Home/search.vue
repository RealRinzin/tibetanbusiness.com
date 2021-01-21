<template>
    <div class="w-100 bg-danger">
        <swiper class="swiper p-0" :options="carousel" style="height:70vh;width:100%">
            <swiper-slide class="lazyload" v-for="(slider,index) in sliders"  v-bind:style='{ backgroundImage: `url(/storage/Carousel/${slider.link})`}' data-sizes="auto"
            :key="index"  style="background-size:cover;background-position:center center; background-repeat:no-repeat"></swiper-slide>
            <div class="position-absolute w-100" style="z-index: 200">
                <div id="home_search" class="container">
                    <div class="row py-1">
                        <div class="col-md-8 mx-auto py-4">
                            <h3 class="text-white text-center">Find the best Tibetan Restaurants,Food corner and cafe shop in India</h3>
                        </div>
                        <div class="col-md-8 mb-5 col-11 mx-auto" id="tb_search_dropdown">
                        <auto-complete></auto-complete>
                                <!-- <div class="row"> -->
                                    <!-- <div class="col-md-5 px-0 col-sm-5 col-12" id="tb_location">
                                        <div class="input-group mb-3 input-group-lg">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-map-pin text-muted"></i></span>
                                            </div>
                                            <input type="text" id="location_search" @focusin="location_dropdown()"  v-model="place"  :keyup="location_selected()" class="form-control" readonly="readonly" placeholder="Location" aria-label="Location" required>
                                            <ul id="location_list" style="display:none;transition:1s">
                                                <button type="button" id="location_close" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                <li v-for="location in locations"  :value="location.name" @click="set_location(location.name)"><a href="#">{{location.name}}</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-5 px-0 col-sm-5 col-12" id="tb_type">
                                        <div class="input-group mb-3 input-group-lg">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="fas fa-tools"></i>
                                                </span>
                                            </div>
                                            <input type="text" id="service_search" @focusin="service_dropdown()" :keyup="service_selected()" v-model="service" class="form-control" readonly="readonly" placeholder="Service" aria-label="service type" required>
                                            <ul id="service_list" style="display:none;transition:1s">
                                                <button type="button" id="service_close" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                <li v-for="type in types" :value="type.name" @click="set_service(type.name)"><a href="#"><span class="mr-2"><img :src="type.img"></span>{{type.name}}</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-2 px-0 col-sm-2 col-12">
                                        <div class="input-group-append">
                                            <button  type="submit" @click="search" name="search" class="btn btn-danger w-75">
                                                <i class="fas fa-search fa-2x"></i>
                                            </button>
                                        </div>
                                    </div> -->
                                <!-- </div> -->
                            <div id="list" class="text-left small text-muted font-weight-bold py-2">
                                <span class="d-inline p-2 text-white"><a href="search/Events"><i class="fas fa-calendar-alt"></i> EVENTS</a></span>
                                <span class="d-inline p-2 text-white"><a href="search/Sales"><i class="fas fa-money-bill-alt"></i> SALES</a></span>
                                <span class="d-inline p-2 text-white"><a href="search/Rents"><i class="fas fa-bed"></i> RENTS</a></span>
                                <span class="d-inline p-2 text-white"><a href="search/Jobs"><i class="fas fa-briefcase"></i> JOBS</a></span>
                                <span class="d-inline p-2 text-white"><a href="search/Services"><i class="fas fa-tools"></i> SERVICES</a></span>
                                <span class="d-inline p-2 text-white"><a href="search/Restaurants"><i class="fas fa-pizza-slice"></i> RESTAURANTS</a></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </swiper>
    </div>
</template>

<script>
import { Swiper, SwiperSlide } from 'vue-awesome-swiper'
// import 'swiper/swiper-bundle.css';
// import SearchTest from '/SearchTest.vue';
import 'swiper/css/swiper.css'
import SearchTest from './SearchTest.vue';
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
      methods:{
        /**
         * SEARCH LIST
         * DROPDOWN
         *  */ 
        location_dropdown() {
            $("#location_list").css("display", "block");
            $("#service_list").css("display", "none");
        },
       set_location(place){
            this.place = place;
            $("#location_list").css("display", "none");
        },
        service_dropdown(service){
            $("#service_list").css("display", "block");
            $("#location_list").css("display", "none");
        },
       set_service(type){
            this.service = type;
            $("#service_list").css("display", "none");
        },
        // check field 
        // empty
        location_selected(){
            $("#location_search").removeClass("required");
            // $("#location_search").css("border",'solid 1px green');
        },
        service_selected(){
            $("#service_search").removeClass("required");
        },
        // Submit search
        search(e){
            if (!this.service || !this.place) {
                // console.log("empty");
                if (this.service) {
                    // $("#service_search").removeClass("required");
                } else {
                    // Required Service
                    $("#service_search").addClass("required");
                    $("#service_search").attr("placeholder", "Select Service");
                }
                // location required
                if (this.place) {
                    // $("#location_search").removeClass("required");
                } else {
                    // Required Location
                    $("#location_search").addClass("required");
                    $("#location_search").attr("placeholder", "Select Location");
                }
                e.preventDefault();
            } else {
                let url = '/search/'+this.service+'?_token='+window.Laravel.csrfToken+'&location='+this.place;
                window.location.href = url;
            };
        }
      },
    //   Components
    components: {Swiper,SwiperSlide,SearchTest},
    // Mounted
    mounted(){

        // Location
        axios.get('/api/location')
        .then((response) => {
            this.locations = response.data;
        }).catch((err) => {

        });
        // Slider
        axios.get('/api/carousel')
        .then((response) => {
            this.sliders = response.data;
            console.log(response.data);
        }).catch((err) => {
            
        });

    }
}
</script>
