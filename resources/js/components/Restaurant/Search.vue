<template>
    <div style="min-height:80vh" id="search">
        <div class="container py-4">
            <div class="row">
                <div class="col-md-10 mx-auto">
                    <div class="row">
                        <div class="col-md-7 col-sm-6">
                            <div class="card p-3">
                                <form @submit.prevent="search_result()">
                                    <small class="text-muted">Filter: <i class="fas fa-sliders-h mx-1"></i></small>
                                    <div class="row">
                                        <div class="col">
                                        <input type="text"  v-model="filter.name" class="form-control" placeholder="First name">
                                        </div>
                                        <div class="col">
                                        <input type="text" v-model="filter.location" class="form-control" placeholder="Last name">
                                        </div>
                                        <input type="submit" class="btn btn-danger btn-xs">
                                    </div>
                                </form>
                            </div>
                            <div class="alert alert-light" role="alert">
                                Total Result : {{total}} {{empty_result}}
                            </div>
                            <!-- Result -->
                            <div v-if="!loading" class="mx-auto bg-white text-center mx-3" style="height:100vh">
                            <img src="/img/loading-gray.svg" alt="" style="margin-top:50%;">
                            </div>
                            <div v-else>
                                <div class="row" id="result">
                                    <div class="col-md-12 col-sm-12 col-xs-12" v-for="(restaurant,index) in restaurants">
                                        <a v-bind:href="'/restaurant/'+restaurant.id">
                                        <div class="banner" v-bind:style='{ backgroundImage: `url(/storage/Restaurant/Banner/${restaurant.banner})`}'></div>
                                        <div class="rate" v-if="restaurant.rate !=null"><span v-bind:class="restaurant.rate_color" class="btn">{{restaurant.rate}}</span></div>
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
                        <div class="col-md-5 col-sm-6">
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
                location:''
            },
            // loading
            isLoading : false,//Lazy loading
            lazy:false,

        }
    },
    /**
     *  Methods
     *  */ 
    methods:{
        load_result(){
            // axios.get('/api/search/restaurants')
            axios.get('/api/search/restaurants')
             .then(response=>{ 
                this.restaurants = response.data.data;
                this.loading = true;
                this.total = response.data.total;
                if (response.data.current_page <= response.data.last_page) {
                    this.load_more_button = true;
                }
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
        // search result
        search_result(){
            this.loading = false;
            this.nextPage = 2;
            axios.get('/api/search/restaurants?name='+this.filter.name+'&location='+this.filter.location+'&page=1')
            .then((response)=>{ 
                this.restaurants = response.data.data;
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
            axios.get('/api/search/restaurants?name='+this.filter.name+'&location='+this.filter.location+'&page='+this.nextPage)
            // axios.get('/api/search/restaurants?page='+)
            .then(response=>{
                if(response.data.current_page <= response.data.last_page){
                    this.nextPage = response.data.current_page + 1;
                    this.load_more_button = true; 
                    this.isLoading = false; //Loading true
                    this.lazy = true;
                    // this.restaurants = response.data.data;
                    /**
                     * Comments 
                     * data Distribution
                     *  */  
                    this.restaurants = [
                        ...this.restaurants,
                        ...response.data.data
                    ];    
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
                    this.load_more_button = false;
                }
            })
        },
    },
    // Components
    components:{Loading},
    // Mounted
    mounted(){
        this.load_result();
    }
}
</script>