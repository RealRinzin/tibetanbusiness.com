<template>
<div>
    <div id="sidebar">
        <!-- Restaurant -->
        <div class="card p-3">
            <div v-if="!loading">
            <h6 class="py-2"> <span><i class="fas fa-utensils mr-2 text-danger"></i></span> Restaurant</h6>
            </div>
            <div class="row" v-else>
                <div class="col-md-6 col-sm-6 col-xs-12" v-for="(restaurant,index) in restaurant" v-if="index <= 1">
                    <a v-bind:href="'/restaurant/'+restaurant.id">
                    <div class="banner" v-bind:style='{ backgroundImage: `url(/storage/Restaurant/Banner/${restaurant.banner})`}'></div>
                    <div class="rate" v-if="restaurant.rate !=null"><span v-bind:class="restaurant.rate_color" class="btn">{{restaurant.rate}}</span></div>
                    </a>
                    <h6 class="text-dark pt-3">{{restaurant.name}}</h6>
                    <p class="text-muted my-0">{{restaurant.mobile_no}}</p>
                    <p class="text-muted my-0">{{restaurant.location}}</p>
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
            restaurant:[], // Restaurants Object
            restaurant_active:[],
        }
    },
    /**
     *  Methods
     *  */ 
    methods:{
        sidebar_restaurants(){
            /**
             * Restaurant Sidebar AD
             *  */ 
            axios.get('/api/restaurant/list/sidebar_ad')
            .then(response=>{
                this.isLoading = true; //Loading true
                if(response.data.length > 0){
                        for (let x = 0; x < response.data.length; x++) {
                            this.restaurant_active[x] = response.data[Math.floor(Math.random() *response.data.length)]
                            /**
                             * Rating Background
                             * Color
                             *  */  
                            if(this.restaurant_active[x].rate >= 0.0 && this.restaurant_active[x].rate <= 2.5){
                                this.restaurant_active[x].rate_color = 'bg-danger';
                            }else if(this.restaurant_active[x].rate >= 2.6 && this.restaurant_active[x].rate <= 3.5 ){
                                this.restaurant_active[x].rate_color = 'bg-warning';
                            }else if(this.restaurant_active[x].rate >= 3.6 && this.restaurant_active[x].rate <= 4.0 ){
                                this.restaurant_active[x].rate_color = 'bg-info';
                            }else if(this.restaurant_active[x].rate >= 4.1 && this.restaurant_active[x].rate <= 5.0 ){
                                this.restaurant_active[x].rate_color = 'bg-success';
                            }else{
                                this.restaurant_active[x].rate_color = 'bg-secondary';
                            }
                            // Assign to restarant
                            this.restaurant = this.restaurant_active;
                            // loading
                            this.loading = true;
                        }
                        // this.restaurant = this.event;
                }else{
                    axios.get('/restaurants/list').then(response=>{
                        for (let x = 0; x < response.data.data.length; x++) {
                            this.restaurant_active[x] = response.data.data[Math.floor(Math.random() *response.data.data.length)]
                            /**
                             * Rating Background
                             * Color
                             *  */  
                            if(this.restaurant_active[x].rate >= 0.0 && this.restaurant_active[x].rate <= 2.5){
                                this.restaurant_active[x].rate_color = 'bg-danger';
                            }else if(this.restaurant_active[x].rate >= 2.6 && this.restaurant_active[x].rate <= 3.5 ){
                                this.restaurant_active[x].rate_color = 'bg-warning';
                            }else if(this.restaurant_active[x].rate >= 3.6 && this.restaurant_active[x].rate <= 4.0 ){
                                this.restaurant_active[x].rate_color = 'bg-info';
                            }else if(this.restaurant_active[x].rate >= 4.1 && this.restaurant_active[x].rate <= 5.0 ){
                                this.restaurant_active[x].rate_color = 'bg-success';
                            }else{
                                this.restaurant_active[x].rate_color = 'bg-secondary';
                            }
                            // Assigning to restaurant
                            this.restaurant = this.restaurant_active;
                            // loading
                            this.loading = true;
                        }
                    })
                }
            })
        }
    },
    // Components
    // Mounted
    mounted(){
        this.sidebar_restaurants();
    }
}
</script>