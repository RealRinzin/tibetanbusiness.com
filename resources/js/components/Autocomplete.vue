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
                  <ul class="w-100" id="myMap_location_dropdown" style="position: absolute;z-index:100">
                    <li style="list-style:none;cursor:pointer;"   class="py-2 text-dark border-bottom bg-light" v-for="(place,index) in places" @click="set_location(place.placeName,place.placeAddress)" v-if="index <= 5">
                        <span class="font-weight-bold text-dark" style="font-size:13px">{{place.placeName}}</span>
                        <span class="d-block text-muted" style="font-size:12px">{{place.placeAddress}}</span>
                      </li>
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
                          <li style="list-style:none;cursor:pointer" class="py-2 text-dark border-bottom bg-light" v-for="type in types" :value="type.name" @click="set_service(type.name)"><a href="#"><span class="mr-2"><img :src="type.img" alt="Tibetanbusiness.com - Images" width="25px" height="25px"></span>{{type.name}}</a></li>
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
                    <span class="d-inline p-2 text-white"><a class="text-white" v-bind:href="`/search/Events?location=${location.event}`"><i class="fas fa-calendar-alt"></i> EVENTS</a></span>
                    <span class="d-inline p-2 text-white"><a class="text-white" v-bind:href="`/search/Sales?location=${location.sale}`"><i class="fas fa-money-bill-alt"></i> SALES</a></span>
                    <span class="d-inline p-2 text-white"><a class="text-white" v-bind:href="`/search/Rents?location=${location.rent}`"><i class="fas fa-bed"></i> RENTS</a></span>
                    <span class="d-inline p-2 text-white"><a class="text-white" v-bind:href="`/search/Announcements?location=${location.job}`"><i class="fas fa-briefcase"></i> JOBS / ANNOUNCEMENTS</a></span>
                    <span class="d-inline p-2 text-white"><a class="text-white" v-bind:href="`/search/Services?location=${location.service}`"><i class="fas fa-tools"></i> SERVICES</a></span>
                    <span class="d-inline p-2 text-white"><a class="text-white" v-bind:href="`/search/Restaurants?location=${location.restaurant}`"><i class="fas fa-pizza-slice"></i> RESTAURANTS</a></span>
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
      locations:{},
      keyword_location:'', //selected place
      selected_location:'',
      service:'', //service
      hero_image:'',
      // Services types
      types:[
          {'name':'Events','img':'/img/event.png'},
          {'name':'Sales','img':'/img/sale.png'},
          {'name':'Rents','img':'/img/rent.png'},
          {'name':'Announcements','img':'/img/job.png'},
          {'name':'Services','img':'/img/service.png'},
          {'name':'Restaurants','img':'/img/restaurant.png'},
      ],
      // location
        location:{
            event:{},
            job:{},
            rent:{},
            restaurant:{},
            sale:{},
            service:{},
        }
    }
  },
  components:{Location},
  methods:{
    load_location(){
      let location = "\""+ this.keyword_location+  "\""
      if(this.keyword_location ==''){
        this.keyword_location = '';
        this.places ={};
      }else{
        if(this.keyword_location.length > 1){
        axios.get("/api/map?query="+location)
          .then(response=>{
            this.locations = JSON.parse(response.data.data);
            this.places = this.locations.suggestedLocations;
          }) 
        }
      }
    },
    // Set Location
    set_location(location){
      this.keyword_location = location;
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
  },
    mounted(){
      this.load_carousel();
      // Event Location
      axios.get('/api/location/event')
      .then(response =>{
        this.location.event = response.data[0].location;
      })
      // Rent
      axios.get('/api/location/rent')
      .then(response =>{
        this.location.rent = response.data[0].location;
      })
      // Job
      axios.get('/api/location/job')
      .then(response =>{
        this.location.job = response.data[0].location;
      })
      // Restaurant
      axios.get('/api/location/restaurant')
      .then(response =>{
        this.location.restaurant = response.data[0].location;
      })
      // Sale
      axios.get('/api/location/sale')
      .then(response =>{
        this.location.sale = response.data[0].location;
      })
      // Service
      axios.get('/api/location/service')
      .then(response =>{
        this.location.service = response.data[0].location;
      })
    }
}
</script>