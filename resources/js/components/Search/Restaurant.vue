<template> 
    <div class="card p-2 my-2">
            <h6 class="py-2 font-weight-bolder text-dark border-bottom"> <span><img src="/img/restaurant.png" alt=""></span> Restaurants - {{place}}</h6>
        <div v-if="loading">
            <lazy-loading class="mb-0"></lazy-loading>
        </div>
        <div class="row">
            <div class="col-6 py-2" v-for="(restaurant,index) in restaurants" v-if="index <= 3">
                <a v-bind:href="'/restaurant/'+restaurant.id">
                <!-- <div class="banner" v-bind:style='{ backgroundImage: `url(/storage/Sale/Banner/${sale.banner})`}'></div> -->
                <div class="banner lazyload position-relative" :data-bgset="'/storage/Restaurant/Banner/'+restaurant.card"  data-sizes="auto">
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
export default{
    props:['location'],
    // data
    data(){
        return{
            restaurants:[],
            place:'',
        }  
    },
    // watch
    watch: { 
        location: function(value) {
            this.place = value;
            if(this.place ===''){
                this.place = 'Other Places';
                axios.get('/api/restaurant/list/sidebar_ad')
                .then(response=>{
                    if(response.data.length > 0){
                        for (let i = 0; i < response.data.length; i++) {
                            if(response.data[i].rate >=0.0 && response.data[i].rate <= 2.5){
                                response.data[i].rate_color = 'btn-danger';
                            }else if(response.data[i].rate >= 2.6 && response.data[i].rate <= 3.5 ){
                                response.data[i].rate_color = 'btn-warning';
                            }else if(response.data[i].rate >= 3.6 && response.data[i].rate <= 4.0 ){
                                response.data[i].rate_color = 'btn-info';
                            }else if(response.data[i].rate >= 4.1 && response.data[i].rate <= 5.0 ){
                                response.data[i].rate_color = 'btn-success';
                            }
                            else{
                                response.data[i].rate_color = 'btn-secondary';
                            } 
                        }
                            this.restaurants = response.data;
                            this.loading = false;
                    }else{
                    axios.get('/api/restaurant/list/all').then(response=>{
                        for (let i = 0; i < response.data.length; i++) {
                            if(response.data[i].rate >=0.0 && response.data[i].rate <= 2.5){
                                response.data[i].rate_color = 'btn-danger';
                            }else if(response.data[i].rate >= 2.6 && response.data[i].rate <= 3.5 ){
                                response.data[i].rate_color = 'btn-warning';
                            }else if(response.data[i].rate >= 3.6 && response.data[i].rate <= 4.0 ){
                                response.data[i].rate_color = 'btn-info';
                            }else if(response.data[i].rate >= 4.1 && response.data[i].rate <= 5.0 ){
                                response.data[i].rate_color = 'btn-success';
                            }
                            else{
                                response.data[i].rate_color = 'btn-secondary';
                            } 
                        }
                            this.restaurants = response.data;
                            this.loading = false;
                    })}
                })
        // Else Part
            }else{
                axios.get('/api/restaurant/list/sidebar/'+this.place)
                .then(response=>{
                    if(response.data.data.length >0){
                        for (let i = 0; i < response.data.data.length; i++) {
                            if(response.data.data[i].rate >=0.0 && response.data.data[i].rate <= 2.5){
                                response.data.data[i].rate_color = 'btn-danger';
                            }else if(response.data.data[i].rate >= 2.6 && response.data.data[i].rate <= 3.5 ){
                                response.data.data[i].rate_color = 'btn-warning';
                            }else if(response.data.data[i].rate >= 3.6 && response.data.data[i].rate <= 4.0 ){
                                response.data.data[i].rate_color = 'btn-info';
                            }else if(response.data.data[i].rate >= 4.1 && response.data.data[i].rate <= 5.0 ){
                                response.data.data[i].rate_color = 'btn-success';
                            }
                            else{
                                response.data.data[i].rate_color = 'btn-secondary';
                            } 
                        }
                        this.restaurants = response.data.data;
                        this.place = value;
                        this.loading = false;

                    }else{
                        this.place = 'Other Places';
                        axios.get('/api/restaurant/list/sidebar_ad')
                        .then(response=>{
                            if(response.data.length > 0){
                                for (let i = 0; i < response.data.length; i++) {
                                    if(response.data[i].rate >=0.0 && response.data[i].rate <= 2.5){
                                        response.data[i].rate_color = 'btn-danger';
                                    }else if(response.data[i].rate >= 2.6 && response.data[i].rate <= 3.5 ){
                                        response.data[i].rate_color = 'btn-warning';
                                    }else if(response.data[i].rate >= 3.6 && response.data[i].rate <= 4.0 ){
                                        response.data[i].rate_color = 'btn-info';
                                    }else if(response.data[i].rate >= 4.1 && response.data[i].rate <= 5.0 ){
                                        response.data[i].rate_color = 'btn-success';
                                    }
                                    else{
                                        response.data[i].rate_color = 'btn-secondary';
                                    } 
                                }
                                this.restaurants = response.data;
                                this.loading = false;

                            }else{
                            axios.get('/api/restaurant/list/all').then(response=>{
                                    for (let i = 0; i < response.data.length; i++) {
                                        if(response.data[i].rate >=0.0 && response.data[i].rate <= 2.5){
                                            response.data[i].rate_color = 'btn-danger';
                                        }else if(response.data[i].rate >= 2.6 && response.data[i].rate <= 3.5 ){
                                            response.data[i].rate_color = 'btn-warning';
                                        }else if(response.data[i].rate >= 3.6 && response.data[i].rate <= 4.0 ){
                                            response.data[i].rate_color = 'btn-info';
                                        }else if(response.data[i].rate >= 4.1 && response.data[i].rate <= 5.0 ){
                                            response.data[i].rate_color = 'btn-success';
                                        }
                                        else{
                                            response.data[i].rate_color = 'btn-secondary';
                                        } 
                                    }
                                this.restaurants = response.data;
                                this.loading = false;
                            })}
                        })
                    }
                })
            }
        },
    },
    // methods
    mounted(){
        // this.load();
    }
}
</script>