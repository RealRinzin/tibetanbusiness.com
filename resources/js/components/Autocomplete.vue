<template>
<div class="bg-danger" style="min-height: auto;background-size:cover;background-position:center center" v-bind:style='{ backgroundImage: `url(/storage/Carousel/${hero_image})`}'>
  <section class="w-100 py-5" style="background:rgba(0,0,0,0.5)">
    <div class="container">
      <div class="row pt-5">
            <div class="col-md-12 mx-auto py-3">
                <h3 class="text-white text-center  d-none d-sm-block">Find the best Tibetan Restaurants,Rents, Events and Deals in India</h3>
                <h3 class="text-white text-center  d-block d-sm-none"> Find Rents,Jobs,Restaurants & Events and More - Tibetanbusiness.com</h3>
            </div>
        <!-- location  -->
          <div class="col-md-8 mb-5 col-11 mx-auto py-5" id="tb_search_dropdown">
            <div class="row">
              <div class="col-md-5 px-0 py-1 col-sm-5 col-12">
                  <div class="input-group input-group-lg" >
                      <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-map-pin text-muted"></i></span>
                      </div>
                      <input type="text" autocomplete="off" id="search_places"  class="form-control w-25" @keyup="load_location()" v-model="keyword_location" placeholder="Type location..">
                  </div>
                  <ul class="w-100" style="position: absolute;z-index:100">
                    <li style="list-style:none;cursor:pointer"  class="py-2 text-dark border-bottom bg-light" v-for="place in places" @click="set_location(place.text,place.context[0].text)"><i class="fas fa-map-marker mx-2 text-muted"></i> {{place.text}}, {{place.context[0].text}}</li>
                  </ul>
              </div>
              <!-- Services -->
              <div class="col-md-5 px-0 py-1 col-sm-5 col-12">
                  <div class="input-group input-group-lg">
                      <div class="input-group-prepend">
                          <span class="input-group-text">
                              <i class="fas fa-tools"></i>
                          </span>
                      </div>
                      <input type="text" id="service_search" @focusin="service_dropdown()" :keyup="service_selected()" v-model="service" class="form-control"  readonly="readonly" placeholder="Service" aria-label="service type" required>
                  </div>
                      <ul id="service_list" class="w-100" style="display:none;position:absolute;transition:1s;z-index:100">
                          <button type="button" id="service_close" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                          <li style="list-style:none;cursor:pointer" class="py-2 text-dark border-bottom bg-light" v-for="type in types" :value="type.name" @click="set_service(type.name)"><a href="#"><span class="mr-2"><img :src="type.img"></span>{{type.name}}</a></li>
                      </ul>
              </div>
              <!-- Search Button -->
              <div class="col-md-2 px-0 py-1 col-sm-2 col-12">
                  <div class="input-group-append">
                      <button  type="submit" @click="search" name="search" class="btn btn-danger w-75">
                          <i class="fas fa-search fa-2x"></i>
                      </button>
                  </div>
              </div>
              <div id="list" class="text-left small text-muted font-weight-bold py-3">
                    <span class="d-inline p-2 text-white"><a class="text-white" href="#"><i class="fas fa-calendar-alt"></i> EVENTS</a></span>
                    <span class="d-inline p-2 text-white"><a class="text-white" href="#"><i class="fas fa-money-bill-alt"></i> SALES</a></span>
                    <span class="d-inline p-2 text-white"><a class="text-white" href="#"><i class="fas fa-bed"></i> RENTS</a></span>
                    <span class="d-inline p-2 text-white"><a class="text-white" href="#"><i class="fas fa-briefcase"></i> JOBS</a></span>
                    <span class="d-inline p-2 text-white"><a class="text-white" href="#"><i class="fas fa-tools"></i> SERVICES</a></span>
                    <span class="d-inline p-2 text-white"><a class="text-white" href="#"><i class="fas fa-pizza-slice"></i> RESTAURANTS</a></span>
              </div>
            </div>
          </div>
      </div>
    </div>
  </section>
</div>
</template>
<script>
export default {
  data(){
    return{
      places:{},//searched places object
      keyword_location:'', //selected place
      selected_location:'',
      service:'', //service
      hero_image:'',
      // Services types
      types:[
          {'name':'Events','img':'/img/event.png'},
          {'name':'Sales','img':'/img/sale.png'},
          {'name':'Rents','img':'/img/rent.png'},
          {'name':'Jobs','img':'/img/job.png'},
          {'name':'Services','img':'/img/service.png'},
          {'name':'Restaurants','img':'/img/restaurant.png'},
      ],
    }
  },
  methods:{
    load_location(){
      if(this.keyword_location ==''){
        this.keyword_location = '';
        this.places ={};
      }else{
        if(this.keyword_location.length > 2){
        axios.get('https://api.mapbox.com/geocoding/v5/mapbox.places/'+this.keyword_location+'.json?access_token=pk.eyJ1IjoicmluemluMjAyMCIsImEiOiJja2szcm1iN3ExZHRiMm9wY3Z5OWx6dnZ4In0.4TuimSiBj9l5OKTybvcrAQ&cachebuster=1611047895214&autocomplete=true&types=place%2Clocality&country=in&worldview=in&limit=8')
          .then(response=>{
            this.places =  response.data.features;
          }) 
        }
      }
    },
    // Set Location
    set_location(location,city){
      this.keyword_location = location+', '+city;
      this.selected_location = location;
      this.places = {};
    },
    // Services
    // Functions
      service_dropdown(service){
          $("#service_list").css("display", "block");
          $("#location_list").css("display", "none");
      },
      set_service(type){
          this.service = type;
          $("#service_list").css("display", "none");
      },
      service_selected(){
          $("#service_search").removeClass("required");
      },
    // Search form
    search(){
      if(!this.keyword_location || !this.service ){
        if(this.keyword_location === ''){
          $("#search_places").addClass("border-danger");
          $("#search_places").attr("placeholder", "Select Location");
        }else{
          $("#search_places").removeClass("border-danger");
        }
        if(this.service === ''){
          $("#service_search").addClass("border-danger");
          $("#service_search").attr("placeholder", "Select Service");
        }else{
          $("#service_search").removeClass("border-danger");
        }
      }else{
        if(this.selected_location ===''){
          this.selected_location = this.keyword_location;
        }
        let url = '/search/'+this.service+'?_token='+window.Laravel.csrfToken+'&location='+this.keyword_location;
          window.location.href = url;
      }
    },
    // load carousel image
    load_carousel(){
        axios.get('/api/carousel')
        .then((response) => {
          this.hero_image = response.data[0].photo;
        })
    },
    // ready() {
    //     window.setInterval(() => {
    //         this.load_carousel();
    //     },2500);
    // },
  },
    mounted(){
      // this.hero_image = '/storage/Carousel/food10.jpg'
      this.load_carousel();
      // setInterval(this.load_carousel(), 1000);
        // axios.get('/api/carousel')
        // .then((response) => {
        //   console.log(response.data);
        //   this.hero_image = response.data[0].photo;
        // }).catch((err) => {
        // });
        // Interval for images
      // this.ready();

    }
}
</script>