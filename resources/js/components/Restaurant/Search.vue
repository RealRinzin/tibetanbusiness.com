<template>
    <div style="min-height:80vh" id="search">
        <div class="container py-4">
            <div class="row">
                <div class="col-md-8 mx-auto">
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
                            <!-- Result -->
                            <div  class="mx-auto bg-white text-center mx-3" style="height:100vh">
                            <img src="/img/loading-red.svg" alt="" style="margin:50%;">
                            </div>
                            <div v-if="!loading" class="mx-auto bg-white text-center mx-3" style="height:100vh">
                            <img src="/img/loading-red.svg" alt="" style="margin-top:50%;">
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
                            <div class="row">
                                <div class="col-md-12">
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
            load_more_button : true,
            restaurant:[], // Restaurants Object
            restaurants:{
                data:[],
                next_page_url:`/api/search/restaurants`,
                },
                nextPage:2,
            restaurant_active:[],
            // filter
            filter:{
                name:'',
                location:''
            },
            // loading
            isLoading : false,//Lazy loading
            add:[]

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
                // this.total_questions = response.data.total;
                // if(this.total_questions  == 0){
                //     this.load_more_button = false;
                // }
            })
        },
        // search result
        search_result(){
            this.loading = false;
            axios.get('/api/search/restaurants?name='+this.filter.name+'&location='+this.filter.location+'&page=1')
            .then((response)=>{ 
                this.restaurants = response.data.data;
                this.loading = true;
            })

        },
        // load more button
        
        load_more(nextPage){
                this.loading = false;
            axios.get('/api/search/restaurants?name='+this.filter.name+'&location='+this.filter.location+'&page='+this.nextPage)
            // axios.get('/api/search/restaurants?page='+)
            .then(response=>{
                if(response.data.current_page <= response.data.last_page){
                    this.nextPage = response.data.current_page + 1;
                    this.load_more_button = true; 
                    this.loading = true;
                    // this.restaurants = response.data.data;
                    /**
                     * Comments 
                     * data Distribution
                     *  */  
                    this.restaurants = [
                        ...this.restaurants,
                        ...response.data.data
                    ];                    
                }else{
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