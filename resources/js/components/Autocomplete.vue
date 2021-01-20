<template>
    <div class="row">
      <!-- location  -->
      <div class="col-md-5 pr-0 col-sm-5 col-12">
          <div class="input-group input-group-lg" >
              <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-map-pin text-muted"></i></span>
              </div>
              <input type="text" id="search_places"  class="form-control w-25" @keyup="load_location()" v-model="keyword_location">
          </div>
          <ul>
            <li style="list-style:none;cursor:pointer"  class="py-2 text-dark border-bottom bg-light" v-for="place in places" @click="set_location(place.text,place.context[0].text)"><i class="fas fa-map-marker mx-2 text-muted"></i> {{place.text}}, {{place.context[0].text}}</li>
          </ul>
      </div>
      <!-- Services -->
      <div class="col-md-5 px-0 col-sm-5 col-12">
          <div class="input-group input-group-lg">
              <div class="input-group-prepend">
                  <span class="input-group-text">
                      <i class="fas fa-tools"></i>
                  </span>
              </div>
              <input type="text" id="service_search" @focusin="service_dropdown()" :keyup="service_selected()" v-model="service" class="form-control"  placeholder="Service" aria-label="service type" required>
          </div>
              <ul id="service_list" style="display:none;transition:1s">
                  <button type="button" id="service_close" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
                  <li style="list-style:none;cursor:pointer" class="py-2 text-dark border-bottom bg-light" v-for="type in types" :value="type.name" @click="set_service(type.name)"><a href="#"><span class="mr-2"><img :src="type.img"></span>{{type.name}}</a></li>
              </ul>
      </div>
      <!-- Search Button -->
      <div class="col-md-2 px-0 col-sm-2 col-12">
          <div class="input-group-append">
              <button  type="submit" @click="search" name="search" class="btn btn-danger w-75">
                  <i class="fas fa-search fa-2x"></i>
              </button>
          </div>
      </div>
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
        axios.get('https://api.mapbox.com/geocoding/v5/mapbox.places/'+this.keyword_location+'.json?access_token=pk.eyJ1IjoicmluemluMjAyMCIsImEiOiJja2szcm1iN3ExZHRiMm9wY3Z5OWx6dnZ4In0.4TuimSiBj9l5OKTybvcrAQ&cachebuster=1611047895214&autocomplete=true&types=place%2Clocality&country=in&worldview=in&limit=30')
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
        let url = '/search/Rents?_token='+window.Laravel.csrfToken+'&location='+this.selected_location;
          window.location.href = url;
      }
    }
  },
    mounted(){
      // axios.get('https://api.mapbox.com/geocoding/v5/mapbox.places/dharamsala.json?access_token=pk.eyJ1IjoicmluemluMjAyMCIsImEiOiJja2szcm1iN3ExZHRiMm9wY3Z5OWx6dnZ4In0.4TuimSiBj9l5OKTybvcrAQ&cachebuster=1611047895214&autocomplete=true&country=in&worldview=in&limit=10')
      // .then(response=>{
      //   this.places =  response.data.features[0].text;
      //   console.log(response.data.features);
      // })
    }
}
</script>