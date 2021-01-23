<template>
    <div style="min-height:80vh">
        <div class="container py-4">
            <div class="row">
                <div class="col-md-12 mx-auto">
                    <div class="row">
                        <div class="col-md-3 my-1" id="search_mobile">
                            <div class="card p-3" style="padding-bottom:0px !important" id="dropdown_lists">
                                <form @submit.prevent="search_result()">
                                    <small class="text-muted font-weight-bolder" style="cursor:pointer" data-toggle="collapse" data-target="#search_collapse" aria-expanded="false" aria-controls="collapseExample">Filter: <i class="fas fa-sliders-h mx-1 fa-1x"></i></small>
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
                                                    <input type="text" @focusin="sale_type_dropdown()" v-model="filter.type" class="rounded form-control " readonly="readonly" placeholder="Product Type" aria-label="Service type">
                                                        <ul id="sale_type_list" style="display:none;transition:1s;" class="position-absolute rounded height border">
                                                        <button type="button" @click="close()" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        <li v-for="category in categories" :value="category.name" @click="set_type(category.name)">{{category.name}}</li>
                                                    </ul>
                                                </div>

                                            </div>
                                            <div class="row py-2">
                                                <!-- Range Price -->
                                                <div class="col-md-12 col-sm-12 py-2" id="range">
                                                    <small class="text-muted">Price:₹ {{filter.min}} </small>
                                                    <input type="text" id="price" class="small text-muted my-2" readonly  style="border:0;">
                                                    <div id="slider-range"></div>
                                                </div>
                                                <div class="col-md-12 text-center">
                                                    <button class="btn btn-danger btn-md w-25" id="search"><small class="fas fa-search"></small></button>
                                                    <button class="btn btn-secondary btn-md w-50" @click="reset()" id="rest_form"><small>Reset</small></button>
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
                            <div class="col-md-12 py-2">
                                <p class="small text-muted pb-0 mb-1">Search keywords</p>
                                <small v-if="filter.name" class="badge badge-secondary mb-1">Name: {{filter.name}}</small>
                                <small v-if="filter.location" class="badge badge-secondary mb-1">Location: {{filter.location}}</small>
                                <small v-if="filter.type" class="badge badge-secondary mb-1">Type: {{filter.type}}</small>
                                <small v-if="filter.price_min || filter.price_max" class="badge badge-secondary mb-1">Price:₹ {{filter.price_min}} - {{filter.price_max}}</small>
                            </div>
                            <!-- Result -->
                            <div class="row" id="result">
                                <div class="col-12" v-if="loading_placeholder">
                                    <lazy-loading></lazy-loading>
                                    <lazy-loading></lazy-loading>
                                    <lazy-loading></lazy-loading>
                                </div>
                                <div v-else class="col-md-12 col-sm-12 col-xs-12 info my-2" v-for="(sale,index) in sales">
                                    <a v-bind:href="'/sale/'+sale.id">
                                        <div class="banner lazyload" :data-bgset="'/storage/Sale/Banner/'+sale.banner"  data-sizes="auto">
                                            <ul>
                                                <li class="ng-binding btn btn-danger btn-md small">Price:₹{{sale.price}}/-</li>
                                                <li class="ng-binding btn btn-danger btn-md small">Total items: {{sale.total_item}}</li>
                                                <li class="ng-binding btn btn-danger btn-md small">{{sale.type}}</li>
                                            </ul>
                                        </div>
                                    </a>
                                    <div class="card px-2">
                                        <h6 class="text-dark pt-3">{{sale.name}}</h6>
                                        <p class="text-muted my-0">{{sale.mobile_no}}</p>
                                        <p class="text-muted my-0">{{sale.location}}</p>
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
                                <event-sidebar :location="search_location"></event-sidebar>
                                <rent-sidebar :location="search_location"></rent-sidebar>
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
// Sidebars
// import SaleSidebar  from '../Search/Sale.vue';
import EventSidebar from '../Search/Event.vue';
import JobSidebar from '../Search/Job.vue';
import RentSidebar from '../Search/Rent.vue';
import RestaurantSidebar from '../Search/Restaurant.vue';
import ServiceSidebar from '../Search/Service.vue';
// 
export default {
    props:['location'],
    // Data
    data(){
        return{
            // loading: false,
            load_more_button : false,
            // loading
            isLoading : false,//Lazy loading
            loading_placeholder:true,
            total:0,
            empty_result:'',
            // sale:[], // Restaurants Object
            sales:{
                data:[],
                next_page_url:`/api/search/sales`,
                },
                nextPage:2,
                search_next_page:2,
            // filter
            filter:{
                name:'',
                location:this.location,
                type:'',
                price_min:0,
                price_max:10000000,
            },
            places:'',
            // lazy:false,
            result:[],
            /**
             * Dropdown List
             * location
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
                this.filter.location = "";
            };
            // Search location
            this.search_location = this.filter.location;
            // axios.get('/api/search/sales')
            axios.get('/api/search/sales?price_min=0&price_max=10000000&location='+this.filter.location)
             .then(response=>{ 
                this.loading_placeholder=false,
                this.sales = response.data.data;
                // this.loading = true;
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
                    this.empty_result='';
                }
            });
            // Slider Range
            $( function() {
                $( "#slider-range" ).slider({
                range: true,
                min:0,
                max:1000000,
                values: [0,10000000],
                slide: function( event, ui ) {
                    $("#price").val(+ui.values[0]+ "-"+ui.values[1] );
                }
                });
                $("#price").val(+$("#slider-range").slider("values",0) +
                " - "+$( "#slider-range").slider( "values",1));
            } );
        },
        // search result
        search_result(){
            this.search_location = this.filter.location;
            this.isLoading = true; //Loading true
            // hidding collapse after 
            // clicking the search button hit
            // Mobile screensize
            if(screen.width < 767){
                $("#search_collapse").removeClass("show");
            }
            // Range
            var price = document.getElementById("price");
            this.price = price.value.split("-");
            this.filter.price_min =parseInt(this.price[0]);
            this.filter.price_max =parseInt(this.price[1]);
            // Range
            // this.loading = false;
            this.nextPage = 2;
            axios.get('/api/search/sales?name='+this.filter.name+
            '&location='+this.filter.location+
            '&type='+this.filter.type+'&price_min='+this.filter.price_min+'&price_max='+this.filter.price_max+
            '&page=1')
            .then((response)=>{ 
                this.sales = response.data.data;
                this.loading = true;
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
            })

        },
        // load more button
        
        load_more(nextPage){
            this.isLoading = true; //Loading true
            axios.get('/api/search/sales?name='+this.filter.name+
            '&location='+this.filter.location+
            '&type='+this.filter.type+'&price_min='+this.filter.price_min+'&price_max='+this.filter.price_max+
            '&page='+this.nextPage)
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
                    // this.lazy = true;
                    /**
                     * Comments 
                     * data Distribution
                     *  */  
                    this.sales = [
                        ...this.sales,
                        ...response.data.data
                    ];                   
                }else{
                    // this.lazy = false;
                    this.isLoading = false; //Loading true
                }
            })
        },
        // Reset the search form
        reset(){
                this.empty_result = '';
            // hidding collapse after 
            // clicking the reset
            // Mobile screensize
                // Reset
                this.filter={
                    name:'',
                    location:'',
                    type:'',
                    // fare:50000,
                    price_min:0,
                    price_max:10000000,
                };
                this.search_location = '';
            if(screen.width < 767){
                $("#search_collapse").removeClass("show");
            }
            this.load_result();
        },
        /**
         * SEARCH LIST
         * DROPDOWN
         *  */ 
        set_location(location,city){
            this.filter.location = location+', '+city;;
            this.places = {};
        },
        // categoryu
        sale_type_dropdown() {
            $("#sale_type_list").css("display", "block");
        },
        set_type(category){
            this.filter.type = category;
            $("#sale_type_list").css("display", "none");
        },
        close(){
            $("#sale_type_list").css("display", "none");
        },
    },

    // Components
    components:{Loading,EventSidebar,JobSidebar,RentSidebar,RestaurantSidebar,ServiceSidebar},
    // Mounted
    mounted(){
        this.load_result();
        // locations api
        axios.get('/api/location')
        .then(response => {
            this.locations = response.data;
        })
        // Profession
        axios.get('/api/categories/sale')
        .then(response=>{
            this.categories = response.data;
        })
    }
}
</script>