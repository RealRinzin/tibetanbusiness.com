<template>
    <div class="card p-2" v-show="show">
        <h6 class="py-2 font-weight-bolder text-dark border-bottom"> <span><img src="/img/sale.png" alt=""></span> 
        Sales 
        <span class="text-muted" style="font-size:12px">- {{sale_location}}</span>
        </h6>
        <lazy-loading class="mb-0" v-if="loading"></lazy-loading>
        <div class="row">
            <div class="col-6 py-2" v-for="(sale,index) in sales" v-if="index <= 3">
                <a v-bind:href="'/sale/'+sale.id">
                <!-- <div class="banner" v-bind:style='{ backgroundImage: `url(/storage/Sale/Banner/${sale.banner})`}'></div> -->
                <div class="banner lazyload" :data-bgset="'/storage/Sale/Banner/'+sale.card"  data-sizes="auto">
                    <button class="btn btn-danger position-absolute btn-sm small py-0 px-1" style="bottom:2px;right:2px">
                        Price:
                        <span v-if="sale.price > 0 ">&#x20B9 {{sale.price}}/-</span>
                        <span v-else> <i class="fas fa-phone-alt mr-1"></i> Call </span>
                    </button>
                </div>
                </a>
                <h6 class="text-muted pt-3 font-weight-bolder">{{sale.name}}</h6>
                <p class="text-muted my-0">{{sale.mobile_no}}</p>
                <p class="text-muted my-0">{{sale.location}}</p>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props:['sale_id','location'],
     data(){
        return{
            place:this.location,
            sales:[],
            sale_location:'Other Places',
            loading:true,
            show:true,

        }
    },
    methods:{
        // Sales API
        sale(){
            axios.get('/api/sale/list/sidebar/'+this.location)
            .then(response=>{
                if(this.sale_id !== undefined){
                    if(response.data.data.length > 1){
                        for (let i = 0; i < response.data.data.length; i++) {
                            if(response.data.data[i].id != this.sale_id){
                                this.sales.push(response.data.data[i]);
                                this.sale_location = this.location;
                            }
                        }
                    this.loading= false;
                    }else{
                        axios.get('/api/sale/list/sidebar_ad')
                        .then(response=>{
                            if(response.data.length > 0){
                                for (let i = 0; i < response.data.length; i++) {
                                    if(response.data[i].id != this.sale_id){
                                        this.sales.push(response.data[i]);
                                    }
                                }
                                this.loading= false;
                            }else{
                            axios.get('/api/sale/list/all').then(response=>{
                                for (let i = 0; i < response.data.length; i++) {
                                    if(response.data[i].id != this.sale_id){
                                        this.sales.push(response.data[i]);
                                    }else{
                                        this.show = false;
                                    }
                                }
                                this.loading= false;
                            })}
                        })
                    }
                // Else part for
                // other businesses
                }else{
                    if(response.data.data.length > 0){
                        for (let i = 0; i < response.data.data.length; i++) {
                            if(response.data.data[i].id != this.sale_id){
                                this.sales.push(response.data.data[i]);
                                this.sale_location = this.location;
                            }
                        }
                        this.loading= false;
                    }else{
                        axios.get('/api/sale/list/sidebar_ad')
                        .then(response=>{
                            if(response.data.length > 0){
                                for (let i = 0; i < response.data.length; i++) {
                                    if(response.data[i].id != this.sale_id){
                                        this.sales.push(response.data[i]);
                                    }
                                }
                                this.loading= false;
                            }else{
                                axios.get('/api/sale/list/all').then(response=>{
                                    if(response.data.length === 0){
                                        this.show = false;
                                    }
                                    for (let i = 0; i < response.data.length; i++) {
                                        if(response.data[i].id != this.sale_id){
                                            this.sales.push(response.data[i]);
                                        }else{
                                            this.show = false;
                                        }
                                    }
                                    this.loading= false;
                                })
                            }
                        })
                    }
                }
            })
        },
    },
    mounted(){
        this.sale();
    }
}
</script>