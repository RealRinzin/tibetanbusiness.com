<template>
    <div class="col-md-12">
        <div id="dropdown_lists">
            <div class="row">
                <div class="px-0 col-5" id="tb_location">
                    <div class="input-group mb-3 input-group-md">
                      <input type="text" style="font-size:14px" id="location_search"  class="form-control" @keyup="load_location()" v-model="keyword_location" placeholder="Type location..">
                        <ul class="w-100" style="position: absolute;z-index:100;height:auto">
                            <li style="list-style:none;cursor:pointer"  class="py-2 text-dark border-bottom bg-light" v-for="place in places" @click="set_location(place.text,place.context[0].text)"><i class="fas fa-map-marker mx-2 text-muted"></i> {{place.text}}, {{place.context[0].text}}</li>
                        </ul>
                    </div>
                </div>
                <div class="col-5 px-0" id="tb_type">
                    <div class="input-group mb-3 input-group-md">
                        <input type="text" id="service_search" @focusin="service_dropdown()" :keyup="service_selected()" v-model="service" class="rounded-0 form-control form-control-navbar" readonly="readonly" placeholder="Service" aria-label="service type" required>
                        <ul id="service_list" style="display:none;transition:1s" class="position-absolute rounded overflow-hidden">
                            <button type="button" id="service_close" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <li v-for="type in types" :value="type.name" @click="set_service(type.name)"><a href="#"><span class="mr-2"><img :src="type.img"></span>{{type.name}}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-2 px-0">
                    <div class="input-group-append">
                        <button  type="submit" @click="search" name="search" class="btn btn-light border-left rounded-0 w-75" style="padding:4.5px !important">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return{
            locations:{},
            place:'',
            keyword_location:'', //selected place
            places:'',
            service:'',
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
        //   load palces
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
        /**
         * SEARCH LIST
         * DROPDOWN
         *  */ 
        // Set Location
        set_location(location,city){
        this.keyword_location = location+', '+city;
        this.selected_location = location;
        this.places = {};
        },
        service_dropdown(){
            $("#service_list").css("display", "block");
        },
       set_service(type){
            this.service = type;
            $("#service_list").css("display", "none");
        },

        service_selected(){
            $("#service_search").removeClass("required");
        },
        // Submit search
        search(e){
            if (!this.service || !this.keyword_location) {
                // console.log("empty");
                if (this.service) {
                    // $("#service_search").removeClass("required");
                } else {
                    // Required Service
                    $("#service_search").addClass("required");
                    $("#service_search").attr("placeholder", "Select Service");
                }
                // location required
                if (this.keyword_location) {
                } else {
                    // Required Location
                    $("#location_search").addClass("required");
                    $("#location_search").attr("placeholder", "Select Location");
                }
                e.preventDefault();
            } else {
                let url = '/search/'+this.service+'?_token='+window.Laravel.csrfToken+'&location='+this.keyword_location;
                window.location.href = url;
            };
        }
      },
    mounted(){

    }
}
</script>