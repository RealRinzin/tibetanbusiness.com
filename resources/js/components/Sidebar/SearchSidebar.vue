<template> 
    <div class="card p-2" v-if="sales != ''">
        <h6 class="py-2 font-weight-bolder text-dark border-bottom"> <span><img src="/img/sale.png" alt=""></span> Sales- {{place}}</h6>
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
            axios.get('/api/sale/list/sidebar/'+this.place)
            .then(response=>{
                this.sales = response.data.data
            })
        },
    },
    // methods
    methods:{
        load(){
        }
    },
    mounted(){
        this.load();
    }
}
</script>