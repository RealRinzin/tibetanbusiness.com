<template>
    <div style="min-height:80vh">
        <div class="container py-4">
            <div class="row">
                <div class="col-md-12 mx-auto">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card p-3" style="padding-bottom:0px !important">
                                <form @submit.prevent="search_result()">
                                    <small class="text-muted" data-toggle="collapse" data-target="#search_collapse" aria-expanded="false" aria-controls="collapseExample">Filter: <i class="fas fa-sliders-h mx-1"></i></small>
                                        <div class="collapse" id="search_collapse">
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12 py-1">
                                                <input type="text"  v-model="filter.name" class="form-control" placeholder="Name">
                                                </div>
                                                <div class="col-md-12 col-sm-12 py-1">
                                                    <select name="location" v-model="filter.location" class="form-control">
                                                        <option value="">Choose Location..</option>
                                                        <option value="Dharamsala">Dharamsala</option>
                                                        <option value="Mussoorie">Mussoorie</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-12 col-sm-12 py-1">
                                                <select name="location" v-model="filter.type" class="form-control">
                                                        <option value="">Choose Category..</option>
                                                        <option value="Mobile">Mobile</option>
                                                        <option value="Title">Title</option>
                                                    </select>
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
                                                    <button class="btn btn-danger btn-lg w-25"><small class="fas fa-search"></small></button>
                                                    <button class="btn btn-secondary btn-md w-50" @click="reset()"><small>Reset</small></button>
                                                    <!-- <input type="submit" class="btn btn-danger btn-md" placeholder="Search"> -->
                                                </div>
                                                <div class="col-md-12 py-2">
                                                    <p class="small text-muted pb-0 mb-1">Search keywords</p>
                                                    <small v-if="filter.name" class="badge badge-secondary mb-1">Name: {{filter.name}}</small>
                                                    <small v-if="filter.location" class="badge badge-secondary mb-1">Location: {{filter.location}}</small>
                                                    <small v-if="filter.type" class="badge badge-secondary mb-1">Type: {{filter.type}}</small>
                                                    <small v-if="filter.price_min || filter.price_max" class="badge badge-secondary mb-1">Price:₹ {{filter.price_min}} - {{filter.price_max}}</small>
                                                </div>
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
                                    <div class="col-md-12 col-sm-12 col-xs-12 info" v-for="(sale,index) in sales">
                                        <a v-bind:href="'/sale/'+sale.id">
                                            <div class="banner" v-bind:style='{ backgroundImage: `url(/storage/Sale/Banner/${sale.banner})`}'>
                                                <ul>
                                                    <li class="ng-binding">Price:₹{{sale.price}}/-</li>
                                                    <li class="ng-binding">Total items: {{sale.total_item}}</li>
                                                    <li class="ng-binding">Category: {{sale.type}}</li>
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
            loading: false,
            load_more_button : false,
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
                location:'',
                type:'',
                price_min:0,
                price_max:10000000,
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
        // loading
        load_result(){
            // Reset
            this.filter={
                name:'',
                location:'',
                type:'',
                // fare:50000,
                price_min:'',
                price_max:'',
            }
            // axios.get('/api/search/sales')
            axios.get('/api/search/sales?price_min=0&price_max=50000')
             .then(response=>{ 
                this.sales = response.data.data;
                this.loading = true;
                this.total = response.data.total;
                if (response.data.current_page <= response.data.last_page) {
                    this.load_more_button = true;
                }
            });
            // Slider Range
            $( function() {
                $( "#slider-range" ).slider({
                range: true,
                min: 0,
                max: 100000,
                values: [ 0, 300000],
                slide: function( event, ui ) {
                    $( "#price" ).val( +ui.values[ 0 ] + "-" + ui.values[ 1 ] );
                }
                });
                $( "#price" ).val( + $( "#slider-range" ).slider( "values", 0 ) +
                " - " + $( "#slider-range" ).slider( "values", 1 ) );
            } );
        },
        // search result
        search_result(){
            // Range
            var price = document.getElementById("price");
            this.price = price.value.split("-");
            this.filter.price_min = this.price[0];
            this.filter.price_max = this.price[1];
            // Range
            this.loading = false;
            this.nextPage = 2;
            axios.get('/api/search/sales?name='+this.filter.name+
            '&location='+this.filter.location+
            '&type='+this.filter.type+
            '&price_min='+this.filter.price_min+
            '&price_max='+this.filter.price_max+
            '&page=1')
            .then((response)=>{ 
                this.sales = response.data.data;
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
            })

        },
        // load more button
        
        load_more(nextPage){
            this.isLoading = true; //Loading true
            axios.get('/api/search/sales?name='+this.filter.name+
            '&location='+this.filter.location+
            '&type='+this.filter.type+
            '&price_min='+this.filter.price_min+
            '&price_max='+this.filter.price_max+
            '&page='+this.nextPage)
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
                    this.sales = [
                        ...this.sales,
                        ...response.data.data
                    ];                   
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
    }
}
</script>