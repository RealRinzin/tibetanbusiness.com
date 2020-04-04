<template>
    <div id="sidebar">
        <!-- Restaurant -->
        <div class="card p-3">
            <h6 class="py-2"> <span><i class="fas fa-utensils mr-2 text-danger"></i></span> Restaurant</h6>
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-6" v-for="(restaurant,index) in restaurant" v-if="index <= 1">
                    <a v-bind:href="'/restaurant/'+restaurant.id"><div class="banner" v-bind:style='{ backgroundImage: `url(/img/${restaurant.banner})`}'></div></a>
                    <h6 class="text-dark pt-3">{{restaurant.name}}</h6>
                    <p class="text-muted my-0">{{restaurant.mobile_no}}</p>
                    <p class="text-muted my-0">{{restaurant.location}}</p>
                </div>
            </div>
        </div>
        <!-- Event -->
        <div class="card p-3">
            <h6 class="py-2"> <span><i class="fas fa-utensils mr-2 text-info"></i></span> Events</h6>
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-6" v-for="(restaurant,index) in restaurant" v-if="index <= 1">
                    <a v-bind:href="'/restaurant/'+restaurant.id"><div class="banner" v-bind:style='{ backgroundImage: `url(/img/${restaurant.banner})`}'></div></a>
                    <h6 class="text-dark pt-3">{{restaurant.name}}</h6>
                    <p class="text-muted my-0">{{restaurant.mobile_no}}</p>
                    <p class="text-muted my-0">{{restaurant.location}}</p>
                </div>
            </div>
        </div>
        <!-- Sales -->
        <div class="card p-3">
            <h6 class="py-2"> <span><i class="fas fa-utensils mr-2 text-warning"></i></span> Sales</h6>
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-6" v-for="(restaurant,index) in restaurant" v-if="index <= 1">
                    <a v-bind:href="'/restaurant/'+restaurant.id"><div class="banner" v-bind:style='{ backgroundImage: `url(/img/${restaurant.banner})`}'></div></a>
                    <h6 class="text-dark pt-3">{{restaurant.name}}</h6>
                    <p class="text-muted my-0">{{restaurant.mobile_no}}</p>
                    <p class="text-muted my-0">{{restaurant.location}}</p>
                </div>
            </div>
        </div>
        <!-- Hotel -->
        <div class="card p-3">
            <h6 class="py-2"> <span><i class="fas fa-utensils mr-2 text-secondary"></i></span> Hotels</h6>
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-6" v-for="(restaurant,index) in restaurant" v-if="index <= 1">
                    <a v-bind:href="'/restaurant/'+restaurant.id"><div class="banner" v-bind:style='{ backgroundImage: `url(/img/${restaurant.banner})`}'></div></a>
                    <h6 class="text-dark pt-3">{{restaurant.name}}</h6>
                    <p class="text-muted my-0">{{restaurant.mobile_no}}</p>
                    <p class="text-muted my-0">{{restaurant.location}}</p>
                </div>
            </div>
        </div>
        <!-- Rent -->
        <div class="card p-3">
            <h6 class="py-2"> <span><i class="fas fa-utensils mr-2 text-primary"></i></span> Rents</h6>
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-6" v-for="(restaurant,index) in restaurant" v-if="index <= 1">
                    <a v-bind:href="'/restaurant/'+restaurant.id"><div class="banner" v-bind:style='{ backgroundImage: `url(/img/${restaurant.banner})`}'></div></a>
                    <h6 class="text-dark pt-3">{{restaurant.name}}</h6>
                    <p class="text-muted my-0">{{restaurant.mobile_no}}</p>
                    <p class="text-muted my-0">{{restaurant.location}}</p>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    // Data
    data(){
        return{
            restaurant:{}, // Restaurants Object
            event:{},//Events object
            sale:{},//Sales Object
            hotel:{},//Hotels Object
            rent:{},//Rents Object
        }
    },
    /**
     *  Methods
     *  */ 
    methods:{
        restaurants(){
            axios.get('/api/restaurant').then(response=>{
                this.restaurant = response.data
            })
        }
    },
    // Mounted
    mounted(){
        this.restaurants();
        console.log("Sidebar");
    }
}
</script>