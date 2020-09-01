<template>
    <div style="min-height:80vh">
        <div class="container py-4">
            <div class="row">
                <div class="col-md-12 mx-auto">
                    <div class="row">
                        <!-- filter -->
                        <div class="col-md-3">
                            <div class="card p-3" style="padding-bottom:0px !important" id="dropdown_lists">
                                <form @submit.prevent="search_result()">
                                    <small class="text-muted" data-toggle="collapse"  data-target="#search_collapse" aria-expanded="false" aria-controls="collapseExample">Filter: <i class="fas fa-sliders-h mx-1"></i></small>
                                        <div class="collapse" id="search_collapse">
                                            <div class="row">
                                                <div class="col-md-12 py-1">
                                                <input type="text"  v-model="filter.name" class="form-control" placeholder="Name">
                                                </div>
                                                <div class="col-md-12 py-1">
                                                    <input type="text" @focusin="restaurant_location_dropdown()" v-model="filter.location" class="rounded form-control " readonly="readonly" placeholder="Location" aria-label="Location">
                                                        <ul id="restaurant_location_list" style="display:none;transition:1s;" class="position-absolute rounded height border">
                                                        <button type="button" @click="close()" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        <li v-for="location in locations" :value="location.name" @click="set_location(location.name)">{{location.name}}</li>
                                                    </ul>
                                                </div>
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
                                                </div>
                                            </div>
                                        </div>
                                </form>
                            </div>
                        </div>
                        <!-- Result -->
                        <div class="col-md-6 col-sm-6" id="search">
                            <div class="alert alert-danger p-2 small" role="alert">
                                Total Result : {{total}} {{empty_result}}
                            </div>
                            <div class="col-md-12 py-2">
                                <p class="small text-muted pb-0 mb-1">Search keywords:</p>
                                <small v-if="filter.name" class="badge badge-secondary">Name: {{filter.name}}</small>
                                <small v-if="filter.location" class="badge badge-secondary">Location: {{filter.location}}</small>
                                <small v-if="filter.rate" class="badge badge-secondary">Rate: {{filter.rate}} <small class="fas fa-star text-warning"></small></small>
                            </div>
                            <!-- Result -->
                            <div v-if="!loading" class="mx-auto bg-white text-center mx-3" style="height:100vh">
                            <img src="/img/loading-gray.svg" alt="" style="margin-top:50%;">
                            </div>
                            <div v-else>
                                <div class="row" id="result">
                                    <div class="col-md-12 col-sm-12 col-xs-12" v-for="(restaurant,index) in restaurants">
                                        <a v-bind:href="'/restaurant/'+restaurant.id">
                                            <div class="banner lazyload" :data-bgset="'/storage/Restaurant/Banner/'+restaurant.banner"  data-sizes="auto"></div>
                                        <div class="rate" v-if="restaurant.rate >0">
                                            <button class="btn btn-sm small" v-bind:class="restaurant.rate_color">
                                            <i class="fas fa-star text-white fa-1x mr-1"></i>{{restaurant.rate}}
                                            </button>
                                        </div>
                                        </a>
                                        <div class="card px-2">
                                            <h6 class="text-dark pt-3">{{restaurant.name}}</h6>
                                            <p class="text-muted my-0">{{restaurant.mobile_no}}</p>
                                            <p class="text-muted my-0">{{restaurant.location}}</p>
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
                        <div class="col-md-3 col-sm-6">
                            <sidebar></sidebar>
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
export default {
    props: ['location'],
    // Data
    data(){
        return{
            loading: false,
            load_more_button : false,
            total:'',
            empty_result:'',
            // restaurant:[], // Restaurants Object
            restaurants:{
                data:[],
                next_page_url:`/api/search/restaurants`,
                },
                nextPage:2,
                search_next_page:2,
                restaurant_active:[],
            // filter
            filter:{
                name:'',
                location:this.location,
                rate:''
            },
            // loading
            isLoading : false,//Lazy loading
            // lazy:false,
            locations:{},
        }
    },

    /**
     *  Methods
     *  */ 
    methods:{
        setRating: function(rating){
        this.rating= rating;
        },
        
        load_result(){
            if(this.location == null){
                this.filter.location = ""
            };
            // axios.get('/api/search/restaurants')
            axios.get('/api/search/restaurants?location='+this.filter.location)
             .then(response=>{ 
                this.restaurants = response.data.data;
                this.loading = true;
                this.total = response.data.total;
                // Looping to assign rating values
                for (let index = 0; index < this.restaurants.length; index++) {
                    if(this.restaurants[index].rate >= 0.0 && this.restaurants[index].rate <= 1.0){
                        this.restaurants[index].rate_color = 'bg-danger';
                    }else if(this.restaurants[index].rate >= 1.1 && this.restaurants[index].rate <= 2.0 ){
                        this.restaurants[index].rate_color = 'bg-warning';
                    }else if(this.restaurants[index].rate >= 2.1 && this.restaurants[index].rate <= 3.0 ){
                        this.restaurants[index].rate_color = 'bg-info';
                    }else if(this.restaurants[index].rate >= 3.1 && this.restaurants[index].rate <= 5.0 ){
                        this.restaurants[index].rate_color = 'bg-success';
                    }else{
                        this.restaurants[index].rate_color = 'bg-secondary';
                    }
                }
                // If not result at all
                if(response.data.total == 0){
                    this.empty_result="We don't found the search item";
                }
                // Load more button
                if (response.data.current_page == response.data.last_page) {
                    this.load_more_button = false;

                }else{
                    this.load_more_button = true;
                }
            })
        },
        // search result
        search_result(){
            // Desktop resize
            if(screen.width < 767){
                $("#search_collapse").removeClass("show");
            }
            this.loading = false;
            this.nextPage = 2;
            axios.get('/api/search/restaurants?name='+
            this.filter.name+'&location='+
            this.filter.location+
            '&rate='+this.filter.rate+
            '&page=1')
            .then((response)=>{ 
                this.restaurants = response.data.data;
                this.loading = true;
                this.total = response.data.total;
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
                for (let index = 0; index < this.restaurants.length; index++) {
                    if(this.restaurants[index].rate >= 0.0 && this.restaurants[index].rate <= 1.0){
                        this.restaurants[index].rate_color = 'bg-danger';
                    }else if(this.restaurants[index].rate >= 1.1 && this.restaurants[index].rate <= 2.0 ){
                        this.restaurants[index].rate_color = 'bg-warning';
                    }else if(this.restaurants[index].rate >= 2.1 && this.restaurants[index].rate <= 3.0 ){
                        this.restaurants[index].rate_color = 'bg-info';
                    }else if(this.restaurants[index].rate >= 3.1 && this.restaurants[index].rate <= 5.0 ){
                        this.restaurants[index].rate_color = 'bg-success';
                    }else{
                        this.restaurants[index].rate_color = 'bg-secondary';
                    }
                }
            })

        },
        // load more button
        
        load_more(nextPage){
                // this.loading = false;
            this.isLoading = true; //Loading true
            axios.get('/api/search/restaurants?name='+
            this.filter.name+
            '&location='+this.filter.location+
            '&rate='+this.filter.rate+
            '&page='+this.nextPage)
            // axios.get('/api/search/restaurants?page='+)
            .then(response=>{
                if(response.data.current_page <= response.data.last_page){
                    this.nextPage = response.data.current_page + 1;
                    this.isLoading = false; //Loading true
                    // this.lazy = true;
                    /**
                     * Comments 
                     * data Distribution
                     *  */  
                    this.restaurants = [
                        ...this.restaurants,
                        ...response.data.data
                    ]; 
                    // loadmore Button
                    if(response.data.current_page == response.data.last_page){
                        this.load_more_button = false; 
                    }else{
                        this.load_more_button = true; 
                    }
                    // Rate Background
                    for (let index = 0; index < this.restaurants.length; index++) {
                        if(this.restaurants[index].rate >= 0.0 && this.restaurants[index].rate <= 1.0){
                            this.restaurants[index].rate_color = 'bg-danger';
                        }else if(this.restaurants[index].rate >= 1.1 && this.restaurants[index].rate <= 2.0 ){
                            this.restaurants[index].rate_color = 'bg-warning';
                        }else if(this.restaurants[index].rate >= 2.1 && this.restaurants[index].rate <= 3.0 ){
                            this.restaurants[index].rate_color = 'bg-info';
                        }else if(this.restaurants[index].rate >= 3.1 && this.restaurants[index].rate <= 5.0 ){
                            this.restaurants[index].rate_color = 'bg-success';
                        }else{
                            this.restaurants[index].rate_color = 'bg-secondary';
                        }
                    }                
                }else{
                    // this.lazy = false;
                    this.isLoading = false; //Loading true
                    // this.load_more_button = false;
                }
            })
        },
        // Reset the search form
        reset(){
            this.empty_result = '';
            this.filter = {
                name:'',
                location:'',
                rate:'',
            };
            // Desktop resize
            if(screen.width < 767){
                $("#search_collapse").removeClass("show");
            }
            this.load_result();
        },
        /**
         * SEARCH LIST
         * DROPDOWN
         *  */ 
        restaurant_location_dropdown() {
            $("#restaurant_location_list").css("display", "block");
        },
        set_location(location){
            this.filter.location = location;
            $("#restaurant_location_list").css("display", "none");
        },
        close(){
            $("#restaurant_location_list").css("display", "none");
        },
    },

    // Components
    components:{Loading},
    // Mounted
    mounted(){
        this.load_result();
        // this.filter.location = this.location;
        axios.get('/api/location')
        .then(response => {
            this.locations = response.data;
        })
    }
}
</script>