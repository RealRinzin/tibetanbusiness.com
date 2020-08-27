<template>
<div>
    <div class="w-100 bg-danger">
        <swiper class="swiper p-0" :options="carousel" style="height:70vh">
            <swiper-slide v-for="(event,index) in events" :key="index" v-bind:style="{ backgroundImage: 'url(/storage/Event/Banner/' + event.banner + ')' }" style="background-size:cover;background-position:center center; background-repeat:no-repeat"></swiper-slide>
            <!-- <swiper-slide v-for="(event,index) in events" :key="index" v-bind:style="{ backgroundImage: 'url(' + event.bg + ')' }" style="background-size:cover;background-position:center center; background-repeat:no-repeat"></swiper-slide> -->
            <!-- <div class="position-absolute" style="z-index: 200">
                <div id="home_search" class="container">
                    <div class="row py-5">
                        <div class="col-md-8 mx-auto py-4">
                            <h3 class="text-white text-center">Find the best Tibetan Restaurants,Food corner and cafe shop in India</h3>
                        </div>
                        <div class="col-md-9 mx-auto mb-5 col-11" id="tb_search_dropdown">
                            <form method="get" action="#">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-5 px-0 col-sm-5 col-12" id="tb_location">
                                        <div class="input-group mb-3 input-group-lg">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-map-pin text-muted"></i></span>
                                            </div>
                                            <input type="text" name="location" id="location_search" onfocusin="location_dropdown()" class="form-control" readonly="readonly" placeholder="Location" aria-label="Location" required>
                                            <ul id="location_list" style="display:none;transition:1s">
                                                <button type="button" id="location_close" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                <li value="Dharamsala"><a href="#">Dharamsala</a></li>
                                                <li value="Delhi"><a href="#">Delhi</a></li>
                                                <li value="Dehradun"><a href="#">Dehradun</a></li>
                                                <li value="Dharamsala"><a href="#">Dehradun</a></li>
                                                <li value="Dharamsala"><a href="#">Dharamsala</a></li>
                                                <li value="Delhi"><a href="#">Delhi</a></li>
                                                <li value="Dehradun"><a href="#">Dehradun</a></li>
                                                <li value="Dharamsala"><a href="#">Dehradun</a></li>
                                                <li value="Dharamsala"><a href="#">Dharamsala</a></li>
                                                <li value="Delhi"><a href="#">Delhi</a></li>
                                                <li value="Dehradun"><a href="#">Dehradun</a></li>
                                                <li value="Dharamsala"><a href="#">Dehradun</a></li>
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
                                            <input type="text" id="service_search" onfocusin="service_dropdown()" class="form-control" readonly="readonly" placeholder="Service" aria-label="service type" required>
                                            <ul id="service_list" style="display:none;transition:1s">
                                                <button type="button" id="service_close" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                <li value="Sales"><a href="#"> <span class="mr-2"><img src="img/money.png"></span> Sales</a></li>
                                                <li value="Rents"><a href="#"> <span class="mr-2"><img src="img/rent.png"></span> Rents</a></li>
                                                <li value="Events"><a href="#"> <span class="mr-2"><img src="img/birthday.png"></span> Events</a></li>
                                                <li value="Jobs"><a href="#"> <span class="mr-2"><img src="img/opportunity.png"></span> Jobs</a></li>
                                                <li value="Services"><a href="#"><span class="mr-2"><img src="img/mechanic.png"></span> Services</a></li>
                                                <li value="Restaurants"><a href="#"> <span class="mr-2"><img src="img/chef.png"></span> Restaurants</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-2 px-0 col-sm-2 col-12">
                                        <div class="input-group-append">
                                            <button id="link" type="submit" class="btn btn-danger w-75">
                                                <i class="fas fa-search fa-2x"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
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
            </div> -->
            <div class="position-absolute" style="z-index: 200">
                <div id="home_search" class="container">
                    <div class="row py-5">
                        <div class="col-md-8 mx-auto py-4">
                            <h3 class="text-white text-center">Find the best Tibetan Restaurants,Food corner and cafe shop in India</h3>
                        </div>
                        <div class="col-md-6 mb-5 col-11 mx-auto" id="tb_search_dropdown">
                            <form method="get" action="#">
                                <!-- {{ csrf_field() }} -->
                                <div class="row">
                                    <div class="col-md-5 px-0 col-sm-5 col-12" id="tb_location">
                                        <div class="input-group mb-3 input-group-lg">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-map-pin text-muted"></i></span>
                                            </div>
                                            <input type="text" name="location" id="location_search" onfocusin="location_dropdown()" class="form-control" readonly="readonly" placeholder="Location" aria-label="Location" required>
                                            <ul id="location_list" style="display:none;transition:1s">
                                                <button type="button" id="location_close" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                <li value="Dharamsala"><a href="#">Dharamsala</a></li>
                                                <li value="Delhi"><a href="#">Delhi</a></li>
                                                <li value="Dehradun"><a href="#">Dehradun</a></li>
                                                <li value="Dharamsala"><a href="#">Dehradun</a></li>
                                                <li value="Dharamsala"><a href="#">Dharamsala</a></li>
                                                <li value="Delhi"><a href="#">Delhi</a></li>
                                                <li value="Dehradun"><a href="#">Dehradun</a></li>
                                                <li value="Dharamsala"><a href="#">Dehradun</a></li>
                                                <li value="Dharamsala"><a href="#">Dharamsala</a></li>
                                                <li value="Delhi"><a href="#">Delhi</a></li>
                                                <li value="Dehradun"><a href="#">Dehradun</a></li>
                                                <li value="Dharamsala"><a href="#">Dehradun</a></li>
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
                                            <input type="text" id="service_search" onfocusin="service_dropdown()" class="form-control" readonly="readonly" placeholder="Service" aria-label="service type" required>
                                            <ul id="service_list" style="display:none;transition:1s">
                                                <button type="button" id="service_close" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                <li value="Sales"><a href="#"> <span class="mr-2"><img src="img/money.png"></span> Sales</a></li>
                                                <li value="Rents"><a href="#"> <span class="mr-2"><img src="img/rent.png"></span> Rents</a></li>
                                                <li value="Events"><a href="#"> <span class="mr-2"><img src="img/birthday.png"></span> Events</a></li>
                                                <li value="Jobs"><a href="#"> <span class="mr-2"><img src="img/opportunity.png"></span> Jobs</a></li>
                                                <li value="Services"><a href="#"><span class="mr-2"><img src="img/mechanic.png"></span> Services</a></li>
                                                <li value="Restaurants"><a href="#"> <span class="mr-2"><img src="img/chef.png"></span> Restaurants</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-2 px-0 col-sm-2 col-12">
                                        <div class="input-group-append">
                                            <button id="link" type="submit" class="btn btn-danger w-75">
                                                <i class="fas fa-search fa-2x"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
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
</div>
</template>

<script>
import { Swiper, SwiperSlide } from 'vue-awesome-swiper'
// import 'swiper/swiper-bundle.css';
import 'swiper/css/swiper.css'
  export default {
      data(){
          return{
              loading:false,
              events:'',
        // events: [
        //         {
        //         "id": "9c24137e63f549d98ce3f3fceb3854d4",
        //         "user_id": "61665655374d492c863f8aaf770a52a5",
        //         "event_basic_info_id": "13bd031ecccb4b0d89856fa77f00cf04",
        //         "created_at": "2020-08-19 09:15:53",
        //         "updated_at": "2020-08-19 09:15:53",
        //         "bg":"/img/food2.jpg"
        //         },
        //         {
        //         "id": "cbfa54ac48244911a9cb81dfc1477033",
        //         "user_id": "ec7dbbe568bd4120833af0261141157b",
        //         "event_basic_info_id": "13bd031ecccb4b0d89856fa77f00cf04",
        //         "created_at": "2020-08-20 03:47:53",
        //         "updated_at": "2020-08-20 03:47:53",
        //         "bg":"/img/food4.jpg"
        //         },
        //         {
        //         "id": "sdljkasljksadfljsdjklfadsfjlsadflkfdsljk",
        //         "user_id": "ec7dbbe568bd4120833af0261141157b",
        //         "event_basic_info_id": "13bd031ecccb4b0d89856fa77f00cf04",
        //         "created_at": "2020-08-20 03:47:53",
        //         "updated_at": "2020-08-20 03:47:53",
        //         "bg":"/img/food6.jpg"
        //         },
        //         {
        //         "id": "sdfjklsdlkjfsalkfjlsad ",
        //         "user_id": "ec7dbbe568bd4120833af0261141157b",
        //         "event_basic_info_id": "13bd031ecccb4b0d89856fa77f00cf04",
        //         "created_at": "2020-08-20 03:47:53",
        //         "updated_at": "2020-08-20 03:47:53",
        //         "bg":"/img/food8.jpg"
        //         }
        //     ],
        carousel:{
            slidesPerView: 1,
            spaceBetween: 30,
            loop:true,
            effect: 'fade',
            autoplay: {
                delay: 3500,
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
        axios.get('/api/event/list/all')
        .then((response) => {
            this.events = response.data;
        }).catch((err) => {
            
        });

    }
}
</script>
