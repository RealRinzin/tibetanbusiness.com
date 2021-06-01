<template>
    <div style="z-index:1060;background:red">
        <div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container" style="margin-top: 30%;">
                            <div class="row">
                                <div class="col-10 mx-auto">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="px-0" id="tb_location">
                                                <div class="input-group mb-3 input-group-md">
                                                    <input type="text" style="font-size:14px;padding:25px" id="location_mobile_search"  autocomplete="off" class="form-control rounded" @keyup="load_location()" v-model="keyword_location" placeholder="Type location..">
                                                    <ul class="w-100" style="position: absolute;z-index:100;height:auto;top:100%;padding:0px 2px">
                                                        <li style="list-style:none;cursor:pointer"  class="p-2 text-dark border-bottom bg-light" v-for="(place,index) in places" @click="set_location(place.placeName,place.placeAddress)" v-if="index <= 4">
                                                            <span class="font-weight-bold text-dark" style="font-size:13px">{{place.placeName}}</span>
                                                            <span class="d-block text-muted" style="font-size:12px">{{place.placeAddress}}</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="px-0" id="tb_type">
                                                <div class="input-group mb-3 input-group-md">
                                                    <input type="text" id="mobile_service_mobile_search" readonly="readonly" style="padding:25px" @focusin="service_dropdown()" :keyup="service_selected()" v-model="service" class="rounded form-control form-control-navbar"  placeholder="Select Services" aria-label="service type" required>
                                                    <ul id="service_mobile_list" style="display:none;transition:1s;top:100%;z-index:10;list-style" class="position-absolute bg-white rounded overflow-hidden w-100 px-1 py-2">
                                                        <button type="button" @click="close()" class="close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        <li v-for="type in types" :value="type.name" @click="set_service(type.name)"><a href="#"><span class="mr-2"><img :src="type.img"></span>{{type.name}}</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 mx-auto">
                                            <div class="px-0">
                                                <div class="input-group-append">
                                                    <button type="submit" @click="search" name="search" class="btn btn-light border-left rounded w-100" style="padding:5px 8px  !important">
                                                        <i class="fas fa-search"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
            let keyword_location = "\""+ this.keyword_location+  "\""
            if(this.keyword_location ==''){
                this.keyword_location = '';
                this.places ={};
            }else{
                if(this.keyword_location.length > 2){
                // axios.get('https://api.mapbox.com/geocoding/v5/mapbox.places/'+this.keyword_location+'.json?access_token=pk.eyJ1IjoicmluemluMjAyMCIsImEiOiJja2szcm1iN3ExZHRiMm9wY3Z5OWx6dnZ4In0.4TuimSiBj9l5OKTybvcrAQ&cachebuster=1611047895214&autocomplete=true&types=place%2Clocality&country=in&worldview=in&limit=8')
                axios.get("/api/map?query="+keyword_location)
                .then(response=>{
                    let locations = JSON.parse(response.data.data);
                    this.places = locations.suggestedLocations;
                }) 
                }
            }
            },
            // Mobile Search Modal
            modalOpen(){
                $("#searchModal").modal("show");  
            },
        /**
         * SEARCH LIST
         * DROPDOWN
         *  */ 
        // Set Location
        set_location(location,city){
        this.keyword_location = location;
        this.selected_location = location;
        this.places = {};
        },
        service_dropdown(){
            $("#service_mobile_list").css("display", "block");
        },
       set_service(type){
            this.service = type;
            $("#service_mobile_list").css("display", "none");
        },

        service_selected(){
            $("#mobile_service_mobile_search").removeClass("required");
        },
        // 
        close(){
            $("#service_mobile_list").css("display", "none");

        },
        // Submit search
        search(e){
            if (!this.service || !this.keyword_location) {
                // console.log("empty");
                if (this.service) {
                    // $("#service_mobile_search").removeClass("required");
                } else {
                    // Required Service
                    $("#service_mobile_search").addClass("required");
                    $("#service_mobile_search").attr("placeholder", "Select Service");
                }
                // location required
                if (this.keyword_location) {
                } else {
                    // Required Location
                    $("#location_mobile_search").addClass("required");
                    $("#location_mobile_search").attr("placeholder", "Select Location");
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
// export default {
//     data(){
//         return{
//             keyword_location:'',
//             places:{},
//         }
//     },
//     methods:{
//         search(){
//             let keyword_location = "\""+ this.keyword_location+  "\"";
//             if(this.keyword_location ==''){
//                 this.keyword_location = '';
//                 this.places ={};
//             }else{
//                 if(this.keyword_location.length > 2){
//                 axios.get("/api/map?query="+keyword_location)
//                 .then(response=>{
//                     let locations = JSON.parse(response.data.data);
//                     this.places = locations.suggestedLocations;
//                     console.log(this.places);
//                 }) 
//                 }
//             }
//         }
//     },
//     mounted(){
//         console.log("Mobile Search");
//     }
// }
</script>