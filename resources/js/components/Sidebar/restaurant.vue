<template>
    <div class="card p-2 my-2" v-if="restaurants != ''">
        <h6 class="py-2 font-weight-bolder text-dark border-bottom"> <span><i class="fas fa-bed fa-1x mr-2 text-dark"></i></span> Restarants - {{restaurant_location}}</h6>
        <div class="row">
            <div class="col-6 py-2" v-for="(restaurant,index) in restaurants" v-if="index <= 3">
                <a v-bind:href="'/restaurant/'+restaurant.id">
                <div class="banner lazyload small" :data-bgset="'/storage/restaurant/Banner/'+restaurant.card"  data-sizes="auto">
                    <span  v-if="restaurant.rate > 0.0" v-bind:class="restaurant.rate_color" class="btn p-0 px-1 position-absolute" style="bottom:2px;right:2px"> <i class="fas fa-star text-white fa-1x mr-1 small" ></i>{{restaurant.rate}}</span>

                </div>
                </a>
                <h6 class="text-muted pt-3 font-weight-bolder">{{restaurant.name}}</h6>
                <p class="text-muted my-0">{{restaurant.mobile_no}}</p>
                <p class="text-muted my-0">{{restaurant.location}}</p>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props:['location'],
         data(){
        return{
            place:this.location,
            restaurants:[],
            restaurant_location:'other places'
        }
    },
    methods:{
        // Restaurant API
        restaurant(){
            axios.get('/api/restaurant/list/sidebar/'+this.location)
            .then(response=>{
                if(response.data.data.length > 0){
                    this.restaurants = response.data.data;
                    this.restaurant_location = this.location;
                }else{
                    axios.get('/api/restaurant/list/sidebar_ad')
                    .then(response=>{
                        if(response.data.length > 0){
                            this.restaurants = response.data;
                        }else{
                            axios.get('/api/restaurant/list/all').then(response=>{
                                this.restaurants = response.data;
                                for (let index = 0; index < response.data.length; index++) {
                                    if(this.restaurants[index].rate >=0.0 && this.restaurants[index].rate <= 2.5){
                                        this.restaurants[index].rate_color = 'btn-danger';
                                    }else if(this.restaurants[index].rate >= 2.6 && this.restaurants[index].rate <= 3.5 ){
                                        this.restaurants[index].rate_color = 'btn-warning';
                                    }else if(this.restaurants[index].rate >= 3.6 && this.restaurants[index].rate <= 4.0 ){
                                        this.restaurants[index].rate_color = 'btn-info';
                                    }else if(this.restaurants[index].rate >= 4.1 && this.restaurants[index].rate <= 5.0 ){
                                        this.restaurants[index].rate_color = 'btn-success';
                                    }
                                    else{
                                        this.restaurants[index].rate_color = 'btn-secondary';
                                    }
                                    // loading
                                }
                            })
                        }
                    })
                }
            })
        },
    },
    mounted(){
        this.restaurant();
    }
}
</script>