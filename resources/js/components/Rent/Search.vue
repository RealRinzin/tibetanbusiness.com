<template>
    <div style="min-height:80vh">
        <div class="container py-4">
            <div class="row">
                <div class="col-md-12 mx-auto">
                    <div class="row">
                        <div class="col-md-3 my-1" id="filter">
                            <div class="card p-3" style="padding-bottom:0px !important" id="dropdown_lists">
                                <form @submit.prevent="search_result()">
                                    <small class="text-muted font-weight-bolder" style="cursor:pointer" data-toggle="collapse" data-target="#search_collapse" aria-expanded="false" aria-controls="collapseExample">Filter: <i class="fas fa-sliders-h mx-1"></i></small>
                                    <div class="collapse" id="search_collapse">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 py-1">
                                            <input type="text"  v-model="filter.name" class="form-control" placeholder="Name">
                                            </div>
                                            <div class="col-md-12 col-sm-12 py-1">
                                            <input type="text" @keyup="load_location()"  v-model="filter.location" class="rounded form-control "  placeholder="Location" aria-label="Location">
                                            <ul class="w-100" id="myMap_location_dropdown" style="position: absolute;z-index:100;height:auto;font-size:12px">
                                                <li style="list-style:none;cursor:pointer"  class="py-2 text-dark border-bottom bg-light" v-for="(place,index) in places" @click="set_location(place.placeName,place.placeAddress)" v-if="index <= 5">
                                                    <span class="font-weight-bold text-dark">{{place.placeName}}</span>
                                                    <span class="d-block text-muted" style="font-size:12px">{{place.placeAddress}}</span>
                                                </li>
                                            </ul>
                                            </div>
                                            <div class="col-md-12 col-sm-12 py-1">
                                                <input type="number" v-model="filter.accomodation_size" class="form-control" min="1" placeholder="Accomodation Size">
                                            </div>
                                        </div>
                                        <div class="row py-2">
                                            <div class="col-md-12 col-sm-12 pt-1">
                                                <small class="text-warning">Rating</small>
                                                <star-rating v-model="filter.rate"
                                                            v-bind:increment="1"
                                                            v-bind:max-rating="5"
                                                            border-color="#33373a"
                                                            inactive-color="#dcdcdc"
                                                            active-color="#f9c132"
                                                            v-bind:star-size="25"
                                                            @rating-selected ="setRating"
                                                ></star-rating>
                                            </div>
                                            <!-- Range Price -->
                                            <div class="col-md-12 col-sm-12 py-2" id="range">
                                                <small class="text-muted">Price:₹{{filter.min}} </small>
                                                <input type="text" id="fare" class="small text-muted my-2" readonly  style="border:0;">
                                                <div id="slider-range"></div>
                                            </div>
                                            <div class="col-md-12 py-2 text-center">
                                                <button class="btn btn-danger btn-md w-25"><small class="fas fa-search"></small></button>
                                                <button class="btn btn-secondary btn-md w-50" @click="reset()"><small>Reset</small></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-5" id="search">
                            <div class="alert alert-danger p-2 small" role="alert">
                                Total Result : {{total}} {{empty_result}}
                            </div>
                            <div class="py-2">
                                <p class="small text-muted pb-0 mb-1">Search keywords:</p>
                                <small v-if="filter.name" class="badge badge-secondary mb-1"> Name: {{filter.name}}</small>
                                <small v-if="filter.location" class="badge badge-secondary mb-1">Location: {{filter.location}}</small>
                                <small v-if="filter.rate" class="badge badge-secondary mb-1">Rate: {{filter.rate}} <small class="fas fa-star text-warning"></small></small>
                                <small v-if="filter.accomodation_size" class="badge badge-secondary mb-1">Accomodation Size:{{filter.accomodation_size}}</small>
                                <small v-if="filter.fare_min || filter.fare_min" class="badge badge-secondary mb-1">Price:₹ {{filter.fare_min}} - {{filter.fare_max}}</small>
                            </div>
                            <!-- Result -->
                            <div class="col-12" v-if="loading_placeholder">
                                <lazy-loading></lazy-loading>
                                <lazy-loading></lazy-loading>
                                <lazy-loading></lazy-loading>
                            </div>
                            <div v-else>
                                <div class="row" id="result">
                                    <div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12 info my-2" v-for="(rent,index) in rents">
                                        <a v-bind:href="'/rent/'+rent.id">
                                            <div class="banner" v-bind:style='{ backgroundImage: `url(/storage/Rent/Banner/${rent.banner})`}'>
                                                <ul>
                                                    <li class="ng-binding btn btn-danger btn-md small">Rent:₹{{rent.fare}}/-</li>
                                                    <li class="ng-binding btn btn-danger btn-md small">Size: {{rent.accomodation_size}} Person</li>
                                                </ul>
                                            </div>
                                            <div class="rate" v-if="rent.rate > 0.0"><span v-bind:class="rent.rate_color" class="btn"><i class="fas fa-star text-white fa-1x mr-1"></i>{{rent.rate}}</span></div>
                                        </a>
                                        <div class="card px-2">
                                            <h6 class="text-dark pt-3">{{rent.name}}</h6>
                                            <p class="text-muted my-0">{{rent.mobile_no}}</p>
                                            <p class="text-muted my-0">{{rent.location}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <loading :active.sync="isLoading"></loading>
                            <div class="row my-2" v-if="load_more_button">
                                <div class="col-md-12 text-center">
                                    <!-- <button class="btn btn-danger btn-sm">Load More</button> -->
                                    <button @click="load_more()" class="btn btn-danger btn-sm">Load more</button>

                                </div>
                            </div>
                        </div>
                        <!-- sidebar -->
                        <div class="col-md-4" id="sidebar">
                            <sale-sidebar :location="search_location"></sale-sidebar>
                            <event-sidebar :location="search_location"></event-sidebar>
                            <job-sidebar :location="search_location"></job-sidebar>
                            <service-sidebar :location="search_location"></service-sidebar>
                            <restaurant-sidebar :location="search_location"></restaurant-sidebar>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    // Import component
    import Loading from 'vue-loading-overlay';
    // Import stylesheet
    import 'vue-loading-overlay/dist/vue-loading.css';
    // Sidebar
    import SaleSidebar  from '../Search/Sale.vue';
    import JobSidebar from '../Search/Job.vue';
    import EventSidebar from '../Search/Event.vue';
    import RestaurantSidebar from '../Search/Restaurant.vue';
    import ServiceSidebar from '../Search/Service.vue';
    import min from 'date-fns/min';
    export default {
        props:['location'],
        // Data
        data(){
            return{
                // min:'',
                loading_placeholder:true,
                load_more_button : false,
                total:0,
                rating:0,
                places:'',
                empty_result:'',
                // rent:[], // Restaurants Object
                rents:{
                    data:[],
                    next_page_url:`/api/search/rents`,
                    },
                    nextPage:2,
                    search_next_page:2,
                restaurant_active:[],
                // filter
                filter:{
                    name:'',
                    location:this.location,
                    rate:0,
                    fare_min:0,
                    fare_max:0,
                    accomodation_size:'',
                },
                // loading
                isLoading : false,//Lazy loading
                // lazy:false,
                result:[],
                // Dropdown list
                locations:{},
                // Max and Min
                search_location:'',
                fare_max:{},
                fare:0,
            }
        },
        /**
         *  Methods
         *  */ 
        methods:{
            // star
            setRating: function(rating){
            this.rating= rating;
            },
            // load places
            load_location(){
                let location = "\""+ this.filter.location+  "\"";
                if(this.filter.location ==''){
                    this.filter.location = '';
                    this.places ={};
                }else{
                    if(this.filter.location.length > 2){
                    axios.get("/api/map?query="+location)
                    .then(response=>{
                        this.locations = JSON.parse(response.data.data);
                        this.places = this.locations.suggestedLocations;
                    }) 
                    }
                }
            },
            /**
             * Set Location
             *  */ 
            set_location(location,city){
                this.filter.location = location;
                this.places = {};
            },

            // loading
            load_result(){
                // location set
                if(this.location == null){
                    this.filter.location = ""
                };
                this.search_location = this.filter.location;
                // Slider Range
                $( function() {
                    axios.get('/api/rent/list/max_fare').then(response=>{
                    const max_fare = response.data;;
                    // Range setting
                    $( "#slider-range" ).slider({
                    range: true,
                    min: 0,
                    max:max_fare,
                    values: [0, max_fare ],
                    slide: function( event, ui ) {
                        $( "#fare" ).val( +ui.values[ 0 ] + "-" + ui.values[ 1 ] );
                        console.log(ui.values);
                    }
                    });
                    $( "#fare" ).val( + $( "#slider-range" ).slider( "values", 0 ) +
                    " - " + $( "#slider-range" ).slider( "values", 1 ) );
                    })

                } );
                // Loading the Maximum Fare
                axios.get('/api/rent/list/max_fare').then(response=>{
                    this.fare = response.data;
                // End Range
                    axios.get(`/api/search/rents?fare_min=0&fare_max=${this.fare}&location=${this.filter.location}`)
                    .then(response=>{ 
                        this.rents = response.data.data;
                        this.loading_placeholder = false,
                        this.total = response.data.total;
                        // Load more button
                        if(response.data.total == 0){
                            this.empty_result="We don't found the search item";
                        }
                        // if response it there
                        if (response.data.current_page == response.data.last_page) {
                            this.load_more_button = false;
                        }else{
                            this.load_more_button = true;
                        }
                        // rating values
                        for (let index = 0; index < this.rents.length; index++) {
                            if(this.rents[index].rate >= 0.0 && this.rents[index].rate <= 1.0){
                                this.rents[index].rate_color = 'btn-danger';
                            }else if(this.rents[index].rate >= 1.1 && this.rents[index].rate <= 2.0 ){
                                this.rents[index].rate_color = 'btn-warning';
                            }else if(this.rents[index].rate >= 2.1 && this.rents[index].rate <= 3.0 ){
                                this.rents[index].rate_color = 'btn-info';
                            }else if(this.rents[index].rate >= 3.1 && this.rents[index].rate <= 5.0 ){
                                this.rents[index].rate_color = 'btn-success';
                            }else{
                                this.rents[index].rate_color = 'btn-secondary';
                            }
                        }
                    })
                })
            },
            // search result
            search_result(){
                this.isLoading = true; //Loading true
                this.search_location = this.filter.location;
                // Desktop
                if(screen.width < 767){
                    $("#search_collapse").removeClass("show");
                }
                // Range
                var fare = document.getElementById("fare");
                this.number = fare.value.split("-");
                this.filter.fare_min = parseInt(this.number[0]);
                this.filter.fare_max = parseInt(this.number[1]);
                // End 
                this.nextPage = 2;
                axios.get('/api/search/rents?name='+this.filter.name+
                '&location='+this.filter.location+
                '&rate='+this.filter.rate+
                '&fare_min='+this.filter.fare_min+
                '&fare_max='+this.filter.fare_max+
                '&accomodation_size='+this.filter.accomodation_size+
                '&page=1')
                .then((response)=>{ 
                    // this.rents = response.data.data;
                        this.rents = [
                            // ...this.rents,
                            ...response.data.data
                        ]; 
                    this.total = response.data.total;
                    this.isLoading = false; //Loading true
                    // check for empty result
                    if(response.data.total == 0){
                        this.empty_result = "We don't found the search item"
                    }
                    // Check the load more button
                    if(response.data.current_page == response.data.last_page){
                        this.load_more_button = false; 
                    }else{
                        this.load_more_button = true; 
                    }
                    // Rating values
                    for (let index = 0; index < this.rents.length; index++) {
                        if(this.rents[index].rate >= 0.0 && this.rents[index].rate <= 1.0){
                            this.rents[index].rate_color = 'btn-danger';
                        }else if(this.rents[index].rate >= 1.1 && this.rents[index].rate <= 2.0 ){
                            this.rents[index].rate_color = 'btn-warning';
                        }else if(this.rents[index].rate >= 2.1 && this.rents[index].rate <= 3.0 ){
                            this.rents[index].rate_color = 'btn-info';
                        }else if(this.rents[index].rate >= 3.1 && this.rents[index].rate <= 5.0 ){
                            this.rents[index].rate_color = 'btn-success';
                        }else{
                            this.rents[index].rate_color = 'btn-secondary';
                        }
                    }
                })

            },
            // load more button
            
            load_more(nextPage){
                    // this.loading = false;
                this.isLoading = true; //Loading true
                axios.get('/api/search/rents?name='+this.filter.name+
                '&location='+this.filter.location+
                '&rate='+this.filter.rate+
                '&fare_min='+this.filter.fare_min+
                '&fare_max='+this.filter.fare_max+
                '&accomodation_size='+this.filter.accomodation_size+
                '&page='+this.nextPage)
                // axios.get('/api/search/rents?page='+)
                .then(response=>{
                    if(response.data.current_page <= response.data.last_page){
                        this.nextPage = response.data.current_page + 1;
                        // loadmore Button
                        if(response.data.current_page == response.data.last_page){
                            this.load_more_button = false; 
                        }else{
                            this.load_more_button = true; 
                        }
                        this.isLoading = false; //Loading true
                        // this.lazy = true;
                        /**
                         * Comments 
                         * data Distribution
                         *  */  
                        this.rents = [
                            ...this.rents,
                            ...response.data.data
                        ];    
                        // Rate Background
                        for (let index = 0; index < this.rents.length; index++) {
                            if(this.rents[index].rate >= 0.0 && this.rents[index].rate <= 1.0){
                                this.rents[index].rate_color = 'btn-danger';
                            }else if(this.rents[index].rate >= 1.1 && this.rents[index].rate <= 2.0 ){
                                this.rents[index].rate_color = 'btn-warning';
                            }else if(this.rents[index].rate >= 2.1 && this.rents[index].rate <= 3.0 ){
                                this.rents[index].rate_color = 'btn-info';
                            }else if(this.rents[index].rate >= 3.1 && this.rents[index].rate <= 5.0 ){
                                this.rents[index].rate_color = 'btn-success';
                            }else{
                                this.rents[index].rate_color = 'btn-secondary';
                            }
                        }                
                    }else{
                        // this.lazy = false;
                        this.isLoading = false; //Loading true
                    }
                })
            },
            // Reset the search form
            reset(){
                this.empty_result='';
                // reset form
                this.filter = {
                    name:'',
                    location:'',
                    rate:0,
                    fare_min:0,
                    fare_max:0,
                    accomodation_size:'',
                };
                // Desktop size
                if(screen.width < 767){
                    $("#search_collapse").removeClass("show");
                }
                this.search_location = '';
                this.load_result();
            },
        },

        // 
        // Components
        components:{Loading,SaleSidebar,JobSidebar,EventSidebar,RestaurantSidebar,ServiceSidebar},
        // Mounted
        mounted(){
            // this.load_fares();
            this.load_result();
        }
    }

</script>

