<template>
    <div style="min-height:80vh">
        <div class="container py-4">
            <div class="row">
                <div class="col-md-12 mx-auto">
                    <div class="row">
                        <div class="col-md-3 my-1">
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
                                                    <ul class="w-100" style="position: absolute;z-index:100;height:auto">
                                                        <li style="list-style:none;cursor:pointer"  class="py-2 text-dark border-bottom bg-light" v-for="place in places" @click="set_location(place.text,place.context[0].text)"><i class="fas fa-map-marker mx-2 text-muted"></i> {{place.text}}, {{place.context[0].text}}</li>
                                                    </ul>
                                                </div>
                                                <div class="col-md-12 col-sm-12 py-1">
                                                    <input type="text" @focusin="service_category_dropdown()" v-model="filter.type" class="rounded form-control " readonly="readonly" placeholder="Category" aria-label="Service type">
                                                        <ul id="service_category_list" style="display:none;transition:1s;" class="position-absolute rounded height border">
                                                        <button type="button" @click="close()" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        <li v-for="category in categories" :value="category.name" @click="set_category(category.name)">{{category.name}}</li>
                                                    </ul>
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
                                                <div class="col-md-12 py-2 text-center">
                                                    <button class="btn btn-danger btn-md w-25"><small class="fas fa-search"></small></button>
                                                    <button class="btn btn-secondary btn-md w-50" @click="reset()"><small>Reset</small></button>
                                                    <!-- <input type="submit" class="btn btn-danger btn-md" placeholder="Search"> -->
                                                </div>
                                            </div>
                                        </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-5" id="search">
                            <div class="alert alert-danger small p-2" role="alert">
                                Total Result : {{total}} {{empty_result}}
                            </div>
                            <div class="col-md-12 py-2">
                                <p class="small text-muted pb-0 mb-1">Search keywords:</p>
                                <small v-if="filter.name" class="badge badge-secondary">Name: {{filter.name}}</small>
                                <small v-if="filter.location" class="badge badge-secondary">Location: {{filter.location}}</small>
                                <small v-if="filter.type" class="badge badge-secondary">Type: {{filter.type}}</small>
                                <small v-if="filter.rate" class="badge badge-secondary">Rate: {{filter.rate}} <small class="fas fa-star text-warning"></small></small>
                            </div>
                            <!-- Result -->
                            <div class="col-12" v-if="loading_placeholder">
                                <lazy-loading></lazy-loading>
                                <lazy-loading></lazy-loading>
                                <lazy-loading></lazy-loading>
                            </div>
                            <div v-else>
                                <div class="row" id="result">
                                    <div class="col-md-12 col-sm-12 col-xs-12 info my-2" v-for="(service,index) in services">
                                        <a v-bind:href="'/service/'+service.id">
                                            <div class="banner lazyload" :data-bgset="'/storage/Service/Banner/'+service.card"  data-sizes="auto">
                                                <ul>
                                                    <li class="font-weight-bold btn btn-danger btn-md small">{{service.type}}</li>
                                                </ul>
                                            </div>
                                        <div class="rate" v-if="service.rate > 0.0"><span v-bind:class="service.rate_color" class="btn"><i class="fas fa-star text-white fa-1x mr-1"></i>{{service.rate}}</span></div>
                                        </a>
                                        <div class="card px-2">
                                            <h6 class="text-dark pt-3">{{service.name}}</h6>
                                            <p class="text-muted my-0">{{service.mobile_no}}</p>
                                            <p class="text-muted my-0">{{service.location}}</p>
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
                            <rent-sidebar :location="search_location"></rent-sidebar>
                            <event-sidebar :location="search_location"></event-sidebar>
                            <job-sidebar :location="search_location"></job-sidebar>
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
    // sidebar
    import SaleSidebar  from '../Search/Sale.vue';
    import JobSidebar from '../Search/Job.vue';
    import EventSidebar from '../Search/Event.vue';
    import RentSidebar from '../Search/Rent.vue';
    import RestaurantSidebar from '../Search/Restaurant.vue';
    export default {
        props:['location'],
        // Data
        data(){
            return{
                load_more_button : false,
                total:0,
                rating:0,
                places:'',
                empty_result:'',
                // service:[], // Restaurants Object
                services:{
                    data:[],
                    next_page_url:`/api/search/services`,
                    },
                    nextPage:2,
                    search_next_page:2,
                restaurant_active:[],
                // filter
                filter:{
                    name:'',
                    location:this.location,
                    rate:'',
                    type:'',
                },
                // loading
                loading_placeholder:true,
                isLoading : false,//Lazy loading
                // lazy:false,
                result:[],
                /**
                    * Dropdown List
                    * location
                    * profession
                    * nature
                    *  */  
                locations:{},
                search_location:'',
                categories:{},

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
                if(this.filter.location ==''){
                    this.filter.location = '';
                    this.places ={};
                }else{
                    if(this.filter.location.length > 2){
                    axios.get('https://api.mapbox.com/geocoding/v5/mapbox.places/'+this.filter.location+'.json?access_token=pk.eyJ1IjoicmluemluMjAyMCIsImEiOiJja2szcm1iN3ExZHRiMm9wY3Z5OWx6dnZ4In0.4TuimSiBj9l5OKTybvcrAQ&cachebuster=1611047895214&autocomplete=true&types=place%2Clocality&country=in&worldview=in&limit=8')
                    .then(response=>{
                        this.places =  response.data.features;
                    }) 
                    }
                }
            },
            // loading
            load_result(){
                if(this.location == null){
                    this.filter.location = ""
                };
                this.search_location = this.filter.location;
                // axios.get('/api/search/services')
                axios.get('/api/search/services?location='+this.filter.location)
                .then(response=>{ 
                    this.services = response.data.data;
                    this.total = response.data.total;
                    this.loading_placeholder = false;
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
                    // Rating values
                    for (let index = 0; index < this.services.length; index++) {
                        if(this.services[index].rate >= 0.0 && this.services[index].rate <= 1.0){
                            this.services[index].rate_color = 'btn-danger';
                        }else if(this.services[index].rate >= 1.1 && this.services[index].rate <= 2.0 ){
                            this.services[index].rate_color = 'btn-warning';
                        }else if(this.services[index].rate >= 2.1 && this.services[index].rate <= 3.0 ){
                            this.services[index].rate_color = 'btn-info';
                        }else if(this.services[index].rate >= 3.1 && this.services[index].rate <= 5.0 ){
                            this.services[index].rate_color = 'btn-success';
                        }else{
                            this.services[index].rate_color = 'btn-secondary';
                        }
                    }
                })
            },
            // search result
            search_result(){
                this.isLoading = true; //Loading true
                this.search_location = this.filter.location;

                // Desktop resize
                if(screen.width < 767){
                    $("#search_collapse").removeClass("show");
                }
                // 
                this.nextPage = 2;
                axios.get('/api/search/services?name='+this.filter.name+
                '&location='+this.filter.location+
                '&rate='+this.filter.rate+
                '&type='+this.filter.type+
                '&page=1')
                .then((response)=>{ 
                    this.services = response.data.data;
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
                    // rating values
                    for (let index = 0; index < this.services.length; index++) {
                        if(this.services[index].rate >= 0.0 && this.services[index].rate <= 1.0){
                            this.services[index].rate_color = 'btn-danger';
                        }else if(this.services[index].rate >= 1.1 && this.services[index].rate <= 2.0 ){
                            this.services[index].rate_color = 'btn-warning';
                        }else if(this.services[index].rate >= 2.1 && this.services[index].rate <= 3.0 ){
                            this.services[index].rate_color = 'btn-info';
                        }else if(this.services[index].rate >= 3.1 && this.services[index].rate <= 5.0 ){
                            this.services[index].rate_color = 'btn-success';
                        }else{
                            this.services[index].rate_color = 'btn-secondary';
                        }
                    }
                })

            },
            // load more button
            
            load_more(nextPage){
                    // this.loading = false;
                this.isLoading = true; //Loading true
                axios.get('/api/search/services?name='+this.filter.name+'&location='+this.filter.location+
                '&rate='+this.filter.rate+
                '&type='+this.filter.type+
                '&page='+this.nextPage)
                // axios.get('/api/search/services?page='+)
                .then(response=>{
                    if(response.data.current_page <= response.data.last_page){
                        this.nextPage = response.data.current_page + 1;
                        this.isLoading = false; //Loading true
                        // loadmore Button
                        if(response.data.current_page == response.data.last_page){
                            this.load_more_button = false; 
                        }else{
                            this.load_more_button = true; 
                        }
                        /**
                            * Comments 
                            * data Distribution
                            *  */  
                        this.services = [
                            ...this.services,
                            ...response.data.data
                        ];    
                        // Rate Background
                        for (let index = 0; index < this.services.length; index++) {
                            if(this.services[index].rate >= 0.0 && this.services[index].rate <= 1.0){
                                this.services[index].rate_color = 'btn-danger';
                            }else if(this.services[index].rate >= 1.1 && this.services[index].rate <= 2.0 ){
                                this.services[index].rate_color = 'btn-warning';
                            }else if(this.services[index].rate >= 2.1 && this.services[index].rate <= 3.0 ){
                                this.services[index].rate_color = 'btn-info';
                            }else if(this.services[index].rate >= 3.1 && this.services[index].rate <= 5.0 ){
                                this.services[index].rate_color = 'btn-success';
                            }else{
                                this.services[index].rate_color = 'btn-secondary';
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
                this.empty_result = '';
                // Reset filter
                this.filter ={
                    name:'',
                    location:'',
                    rate:'',
                    type:'',
                };
                if(screen.width < 767){
                    $("#search_collapse").removeClass("show");
                }
                this.search_location = '';
                this.load_result();
            },
            /**
             * Set Location
             *  */ 
            set_location(location,city){
                this.filter.location = location+', '+city;;
                this.places = {};
            },
            service_category_dropdown() {
                $("#service_category_list").css("display", "block");
            },
            set_category(type){
                this.filter.type = type;
                $("#service_category_list").css("display", "none");
            },
            close(){
                $("#service_category_list").css("display", "none");
            },
        },
        // Components
        components:{Loading,SaleSidebar,JobSidebar,EventSidebar,RentSidebar,RestaurantSidebar},
        // Mounted
        mounted(){
            this.load_result();
            // locations api
            axios.get('/api/location')
            .then(response => {
                this.locations = response.data;
            })
            // Profession
            axios.get('/api/service-categories')
            .then(response=>{
                this.categories = response.data;
            })
        }
    }
</script>