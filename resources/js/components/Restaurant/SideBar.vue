<template>
    <div id="sidebar">
        <div class="card p-3">
            <h6 class="py-2"> <span><i class="fas fa-utensils mr-2 text-danger"></i></span> Restaurant</h6>
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-6" v-for="(restaurant,index) in restaurant" v-if="index <= 1">
                    <a href=""><div class="banner"></div></a>
                    <h6 class="text-dark pt-3">Hotel Manpin</h6>
                    <p class="text-muted my-0">2398729349</p>
                    <p class="text-muted my-0">Dharamsala</p>
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
                console.log(response.data);
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