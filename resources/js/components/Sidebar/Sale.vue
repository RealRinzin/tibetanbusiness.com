<template>
    <div class="card p-2" v-if="sales != ''">
        <h6 class="py-2 font-weight-bolder text-dark border-bottom"> <span><i class="fas fa-bed fa-1x mr-2 text-dark"></i></span> Sales - {{place}}</h6>
        <div class="row">
            <div class="col-6 py-2" v-for="(sale,index) in sales" v-if="index <= 3">
                <a v-bind:href="'/sale/'+sale.id">
                <!-- <div class="banner" v-bind:style='{ backgroundImage: `url(/storage/Sale/Banner/${sale.banner})`}'></div> -->
                <div class="banner lazyload" :data-bgset="'/storage/Sale/Banner/'+sale.card"  data-sizes="auto">
                    <button class="btn btn-danger position-absolute btn-sm small py-0 px-1" style="bottom:2px;right:2px">Rs: {{sale.price}}</button>
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

        }
    },
    methods:{
        // Sales API
        sale(){
            axios.get('/api/sale/list/sidebar/'+this.place)
            .then(response=>{
                for (let index = 0; index < response.data.data.length; index++) {   
                    if(response.data.data[index].id != this.sale_id){
                        this.sales.push(response.data.data[index]);
                    }
                }
                if(this.sales.length ==0){
                    this.place = "Other Places";
                    axios.get('/api/sale/list/sidebar_ad')
                    .then(response=>{
                        if(response.data.length >0){
                            for (let index = 0; index < response.data.length; index++) {   
                                if(response.data[index].id != this.sale_id){
                                    this.sales.push(response.data[index]);
                                }
                            }
                        }else{
                            axios.get('/api/sale/list/all').then(response=>{
                                for (let index = 0; index < response.data.length; index++) {   
                                    if(response.data[index].id != this.sale_id){
                                        this.sales.push(response.data[index]);
                                    }
                                }
                            })
                        }
                    })
                }
            })
        },
    },
    mounted(){
        this.sale();
    }
}
</script>