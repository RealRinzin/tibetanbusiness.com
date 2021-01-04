<template> 
    <div class="card p-2 my-2" v-if="sales != ''">
            <h6 class="py-2 font-weight-bolder text-dark border-bottom"> <span><img src="/img/sale.png" alt=""></span> Sales - {{place}}</h6>
        <div class="row">
            <div class="col-6 py-2" v-for="(sale,index) in sales" v-if="index <= 3">
                <a v-bind:href="'/sale/'+sale.id">
                <!-- <div class="banner" v-bind:style='{ backgroundImage: `url(/storage/Sale/Banner/${sale.banner})`}'></div> -->
                <div class="banner lazyload position-relative" :data-bgset="'/storage/Sale/Banner/'+sale.card"  data-sizes="auto">
                    <p v-if="sale.entry_free" class="text-dark small position-absolute rounded bg-warning  price p-1 m-0 font-weight-bolder" style="bottom:5px;right:2px">Sale</p>
                    <p v-else class="text-white small position-absolute rounded bg-danger  price p-1 m-0 font-weight-bolder" style="bottom:5px;right:2px">Sale:&#x20B9 {{sale.price}}</p>
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
export default{
    props:['location'],
    // data
    data(){
        return{
            sales:[],
            place:'',
        }  
    },
    // watch
    watch: { 
        location: function(value) {
            this.place = value;
            if(this.place ===''){
                this.place = 'Other Places';
                axios.get('/api/sale/list/sidebar_ad')
                .then(response=>{
                    if(response.data.length > 0){
                            this.sales = response.data
                    }else{
                    axios.get('/api/sale/list/all').then(response=>{
                            this.sales = response.data
                    })}
                })
        // Else Part
            }else{
                axios.get('/api/sale/list/sidebar/'+this.place)
                .then(response=>{
                    if(response.data.data.length >0){
                        this.sales = response.data.data;
                        this.place = value;
                    }else{
                        this.place = 'Other Places';
                        axios.get('/api/sale/list/sidebar_ad')
                        .then(response=>{
                            if(response.data.length > 0){
                                    this.sales = response.data
                            }else{
                            axios.get('/api/sale/list/all').then(response=>{
                                    this.sales = response.data
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