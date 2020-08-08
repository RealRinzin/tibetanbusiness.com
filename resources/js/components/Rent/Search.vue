<template>
    <div style="min-height:80vh">

        <div class="container py-4">
            <div class="row">
                <div class="col-md-12 mx-auto">
                    <div class="row">
                        <div class="col-md-3" id="filter">
                            <div class="card p-3" style="padding-bottom:0px !important">
                                <form @submit.prevent="search_result()">
                                    <small class="text-muted" data-toggle="collapse" data-target="#search_collapse" aria-expanded="false" aria-controls="collapseExample">Filter: <i class="fas fa-sliders-h mx-1"></i></small>
                                    <div class="collapse" id="search_collapse">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 py-1">
                                            <input type="text"  v-model="filter.name" class="form-control" placeholder="Name">
                                            </div>
                                            <div class="col-md-12 col-sm-12 py-1">
                                            <input type="text" v-model="filter.location" class="form-control" placeholder="Location">
                                            </div>
                                            <div class="col-md-12 col-sm-12 py-1">
                                                <!-- <small for="" class="text-muted">Size</small> -->
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
                        <div class="col-md-6 col-sm-6" id="search">
                            <div class="alert alert-light" role="alert">
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
                            <div v-if="!loading" class="mx-auto bg-white text-center mx-3" style="height:100vh">
                            <img src="/img/loading-gray.svg" alt="" style="margin-top:50%;">
                            </div>
                            <div v-else>
                                <div class="row" id="result">
                                    <div class="col-md-12 col-sm-12 col-xs-12 info" v-for="(rent,index) in rents">
                                        <a v-bind:href="'/rent/'+rent.id">
                                        <div class="banner" v-bind:style='{ backgroundImage: `url(/storage/Rent/Banner/${rent.banner})`}'>
                                    <ul>
                                        <li class="ng-binding">Rent:₹{{rent.fare}}/-</li>
                                        <li class="ng-binding">Size: {{rent.accomodation_size}} Person</li>
                                    </ul>
                                        </div>
                                        <div class="rate" v-if="rent.rate !=null"><span v-bind:class="rent.rate_color" class="btn">{{rent.rate}}</span></div>
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
    props:['location'],
    // Data
    data(){
        return{
            max:50000,
            // min:'',
            loading: false,
            load_more_button : false,
            total:0,
            rating:0,
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
                rate:'',
                fare_max:'',
                fare_min:'',
                accomodation_size:'',
            },
            // loading
            isLoading : false,//Lazy loading
            // lazy:false,
            result:[],

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
        // loading
        load_result(){
            // Slider Range
            $( function() {
                $( "#slider-range" ).slider({
                range: true,
                min: 0,
                max: 100000,
                values: [ 0, 300000],
                slide: function( event, ui ) {
                    $( "#fare" ).val( +ui.values[ 0 ] + "-" + ui.values[ 1 ] );
                }
                });
                $( "#fare" ).val( + $( "#slider-range" ).slider( "values", 0 ) +
                " - " + $( "#slider-range" ).slider( "values", 1 ) );
                    // console.log(this.number);
            } );
            // End Range
            // axios.get('/api/search/rents')
            axios.get('/api/search/rents?fare_min=0&fare_max=5000000&location='+this.filter.location)
             .then(response=>{ 
                this.rents = response.data.data;
                this.loading = true;
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
                // rating values
                for (let index = 0; index < this.rents.length; index++) {
                    if(this.rents[index].rate >= 0.0 && this.rents[index].rate <= 1.0){
                        this.rents[index].rate_color = 'bg-danger';
                    }else if(this.rents[index].rate >= 1.1 && this.rents[index].rate <= 2.0 ){
                        this.rents[index].rate_color = 'bg-warning';
                    }else if(this.rents[index].rate >= 2.1 && this.rents[index].rate <= 3.0 ){
                        this.rents[index].rate_color = 'bg-info';
                    }else if(this.rents[index].rate >= 3.1 && this.rents[index].rate <= 5.0 ){
                        this.rents[index].rate_color = 'bg-success';
                    }else{
                        this.rents[index].rate_color = 'bg-secondary';
                    }
                }
            })
        },
        // search result
        search_result(){
            // Desktop
            if(screen.width < 767){
                $("#search_collapse").removeClass("show");
            }
            // Range
            var fare = document.getElementById("fare");
            this.number = fare.value.split("-");
            this.filter.fare_min = this.number[0];
            this.filter.fare_max = this.number[1];
            // End 
            this.loading = false;
            this.nextPage = 2;
            axios.get('/api/search/rents?name='+this.filter.name+
            '&location='+this.filter.location+
            '&rate='+this.filter.rate+
            '&fare_min='+this.filter.fare_min+
            '&fare_max='+this.filter.fare_max+
            '&accomodation_size='+this.filter.accomodation_size+
            '&page=1')
            .then((response)=>{ 
                this.rents = response.data.data;
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
                for (let index = 0; index < this.rents.length; index++) {
                    if(this.rents[index].rate >= 0.0 && this.rents[index].rate <= 1.0){
                        this.rents[index].rate_color = 'bg-danger';
                    }else if(this.rents[index].rate >= 1.1 && this.rents[index].rate <= 2.0 ){
                        this.rents[index].rate_color = 'bg-warning';
                    }else if(this.rents[index].rate >= 2.1 && this.rents[index].rate <= 3.0 ){
                        this.rents[index].rate_color = 'bg-info';
                    }else if(this.rents[index].rate >= 3.1 && this.rents[index].rate <= 5.0 ){
                        this.rents[index].rate_color = 'bg-success';
                    }else{
                        this.rents[index].rate_color = 'bg-secondary';
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
                            this.rents[index].rate_color = 'bg-danger';
                        }else if(this.rents[index].rate >= 1.1 && this.rents[index].rate <= 2.0 ){
                            this.rents[index].rate_color = 'bg-warning';
                        }else if(this.rents[index].rate >= 2.1 && this.rents[index].rate <= 3.0 ){
                            this.rents[index].rate_color = 'bg-info';
                        }else if(this.rents[index].rate >= 3.1 && this.rents[index].rate <= 5.0 ){
                            this.rents[index].rate_color = 'bg-success';
                        }else{
                            this.rents[index].rate_color = 'bg-secondary';
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
            // reset form
            this.filter = {
                name:'',
                location:'',
                rate:'',
                fare_min:0,
                fare_max:5000000,
                accomodation_size:'',
            };
            // Desktop size
            if(screen.width < 767){
                $("#search_collapse").removeClass("show");
            }
            this.load_result();
        }
    },
    // Components
    components:{Loading},
    // Mounted
    mounted(){
        this.load_result();

    }
}

</script>

