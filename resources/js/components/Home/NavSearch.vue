<template>
    <div class="col-md-12">
        <div id="dropdown_lists">
            <div class="row">
                <div class="px-0 col-5" id="tb_location">
                    <div class="input-group mb-3 input-group-md">
                        <input type="text" style="border-radius:3px 0px 0px 3px"  id="location_search" @focusin="location_dropdown()"  v-model="place"  :keyup="location_selected()" class="form-control" readonly="readonly" placeholder="Location" aria-label="Location" required>
                        <ul id="location_list" style="display:none;transition:1s;min-height:250px" class="position-absolute" >
                            <button type="button" id="location_close" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <li v-for="location in locations" :value="location.name" @click="set_location(location.name)"><a href="#">{{location.name}}</a></li>
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
                        <button  type="submit" @click="search" name="search" class="btn btn-light border-left rounded-0 w-50" style="padding:4.5px !important">
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
    mounted(){
        // location
        axios.get('/api/location')
        .then((response) => {
            this.locations = response.data;
        }).catch((err) => {

        });
    }
}
</script>