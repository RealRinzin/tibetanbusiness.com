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
                                            <select name="location" v-model="filter.location" class="form-control">
                                                <option value="">Choose Location..</option>
                                                <option value="Dharamsala">Dharamsala</option>
                                                <option value="Mussoorie">Mussoorie</option>
                                            </select>
                                        <!-- <input type="text" v-model="filter.location" class="form-control" placeholder="Location"> -->
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
                                        <div class="col-md-12 col-sm-12 py-2">
                                            <small class="small text-muted">Price:₹ <span class="text-muted" id="demo"></span></small>
                                            <input type="range" v-model="filter.price" style="width:100%" min="500" max="50000" value="3000" id="myRange" placeholder="Size">
                                        </div>
                                        <div class="col-md-12 text-center">
                                            <button class="btn btn-danger btn-lg w-25"><small class="fas fa-search"></small></button>
                                            <button class="btn btn-secondary btn-md w-50" @click.prevent="reset()"><small>Reset</small></button>
                                            <!-- <input type="submit" class="btn btn-danger btn-md" placeholder="Search"> -->
                                        </div>
                                        <div class="col-md-12 py-2">
                                            <p class="small text-muted pb-0 mb-1">Search keywords</p>
                                            <a href="#" class="badge badge-secondary">{{filter.name}}</a>
                                            <a href="#" class="badge badge-secondary">{{filter.location}}</a>
                                            <a href="#" class="badge badge-secondary">{{filter.price}}</a>
                                            <a href="#" class="badge badge-secondary">{{filter.type}}</a>
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
                price:'200000'
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
            // axios.get('/api/search/sales')
            axios.get('/api/search/sales?price=50000')
             .then(response=>{ 
                this.sales = response.data.data;
                this.loading = true;
                this.total = response.data.total;
                if (response.data.current_page <= response.data.last_page) {
                    this.load_more_button = true;
                }
            })
        },
        // search result
        search_result(){
            this.loading = false;
            this.nextPage = 2;
            axios.get('/api/search/sales?name='+this.filter.name+
            '&location='+this.filter.location+
            '&type='+this.filter.type+
            '&price='+this.filter.price+
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
                // this.loading = false;
            this.isLoading = true; //Loading true
            axios.get('/api/search/sales?name='+this.filter.name+'&location='+this.filter.location+
            '&type='+this.filter.type+
            '&price='+this.filter.price+
            '&page='+this.nextPage)
            // axios.get('/api/search/sales?page='+)
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

            filter:{
                name=''; 
                location='';
                type='';
                // fare:50000,
                price=45000;
            }
        }
    },
    // Components
    components:{Loading},
    // Mounted
    mounted(){
        this.load_result();
        var slider = document.getElementById("myRange");
        var output = document.getElementById("demo");
        output.innerHTML = slider.value;

        slider.oninput = function() {
        output.innerHTML = this.value;
        }
    }
}
</script>