<template>
    <div style="min-height:80vh">

        <div class="container py-4">
            <div class="row">
                <div class="col-md-12 mx-auto">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card p-3" style="padding-bottom:0px !important">
                                <form @submit.prevent="search_result()">
                                    <small class="text-muted">Filter: <i class="fas fa-sliders-h mx-1"></i></small>
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
                                        <!-- <div class="col-md-6 col-sm-12 py-2">
                                            <small class="small text-muted">Price:₹ <span class="text-muted" id="demo"></span></small>
                                            <input type="range" v-model="filter.fare" style="width:100%" min="1000" max="50000" value="3000" id="myRange" placeholder="Size">
                                        </div> -->
                                        <div class="col-md-6 col-sm-12 py-2">
                                        <p>
                                            <small>Price:₹ {{filter.min}} </small>
                                        <input type="text" id="amount" readonly  style="border:0; color:#f6931f; font-weight:bold;">
                                        </p>
                                        <div id="slider-range"></div>
                                            <!-- <small class="small text-muted">Price:₹ <span class="text-muted" id="min"></span></small> -->
                                            <!-- <input type="range" v-model="filter.fare_min" style="width:100%" min="100" max="50000" value="3000" id="fare" placeholder="Size"> -->
                                        </div>
                                        <div class="col-md-12 py-2 text-center">
                                            <button class="btn btn-danger btn-lg w-25"><small class="fas fa-search"></small></button>
                                            <button class="btn btn-secondary btn-md w-50" @click="reset()"><small>Reset</small></button>
                                            <!-- <input type="submit" class="btn btn-danger btn-md" placeholder="Search"> -->
                                        </div>
                                        <div class="col-md-12 py-2">
                                            <p class="small text-muted pb-0 mb-1">Search keywords:</p>
                                            <a href="#" class="badge badge-secondary">{{filter.name}}</a>
                                            <a href="#" class="badge badge-secondary">{{filter.location}}</a>
                                            <a href="#" class="badge badge-secondary">{{filter.fare}}</a>
                                            <a href="#" class="badge badge-secondary">{{filter.rate}}</a>
                                            <a href="#" class="badge badge-secondary">{{filter.accomodation_size}}</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6" id="search">
                            <div class="alert alert-light" role="alert">
                                Total Result : {{total}}
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
    // Data
    data(){
        return{
            // check:'',
            range:0,
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
                location:'',
                rate:'',
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
            // reset form
            this.filter = {
                name:'',
                location:'',
                rate:'',
                fare_min:10000,
                fare:45000,
                accomodation_size:'',
            },
            // axios.get('/api/search/rents')
            axios.get('/api/search/rents?fare=50000&fare_min=100')
             .then(response=>{ 
                this.rents = response.data.data;
                this.loading = true;
                this.total = response.data.total;
                if (response.data.current_page <= response.data.last_page) {
                    this.load_more_button = true;
                }
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
            // Range
                var min = document.getElementById("amount");
                this.number = min.value.split("-");
                this.filter.fare_min = this.number[0];
                this.filter.fare = this.number[1];
            // End 
            this.loading = false;
            this.nextPage = 2;
            axios.get('/api/search/rents?name='+this.filter.name+
            '&location='+this.filter.location+
            '&rate='+this.filter.rate+
            '&fare='+this.filter.fare+
            '&fare_min='+this.filter.fare_min+
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
                if(response.data.current_page < response.data.last_page){
                    this.load_more_button = true; 
                }else{
                    this.load_more_button = false; 
                }
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
            axios.get('/api/search/rents?name='+this.filter.name+'&location='+this.filter.location+
            '&rate='+this.filter.rate+
            '&fare='+this.filter.fare+
            '&accomodation_size='+this.filter.accomodation_size+
            '&page='+this.nextPage)
            // axios.get('/api/search/rents?page='+)
            .then(response=>{
                if(response.data.current_page <= response.data.last_page){
                    this.nextPage = response.data.current_page + 1;
                    this.load_more_button = true; 
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
                    this.load_more_button = false;
                }
            })
        },
        // Reset the search form
        reset(){
            this.load_result();
        }
    },
    // Components
    components:{Loading},
    // Mounted
    mounted(){
        this.load_result();
        // var slider = document.getElementById("myRange");
        // var output = document.getElementById("demo");
        // output.innerHTML = slider.value;
        // slider.oninput = function() {
        // output.innerHTML = this.value;
        // }
        // Slider range
                   $( function() {
                        $( "#slider-range" ).slider({
                        range: true,
                        min: 0,
                        max: 500,
                        // values: [ 75, 300],
                        slide: function( event, ui ) {
                            $( "#amount" ).val( + ui.values[ 0 ] + "-" + ui.values[ 1 ] );
                        }
                        });
                        $( "#amount" ).val( + $( "#slider-range" ).slider( "values", 0 ) +
                        " - " + $( "#slider-range" ).slider( "values", 1 ) );
                            // console.log(this.number);
                    } );
    }
}

</script>

