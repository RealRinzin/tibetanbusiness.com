<template>
    <div class="row" v-if="loading">
        <div class="col-md-8 mx-auto">
            <h6 class="bg-danger btn">Sale</h6>
            <div class="row">
                <div class="col-md-6 col-6" v-for="(sales,index) in sales" v-if="index <= 1">
                <!-- <div class="col-md-6"> -->
                    <div class="card">
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <a v-bind:href="'sale/'+sales.id"><div class="banner" v-bind:style='{ backgroundImage: `url(storage/Rent/Banner/${sales.banner})`}'></div></a>
                            </div>
                            <div class="col-md-6 col-sm-6 p-3 info">
                                <h5>{{sales.name}}</h5>
                                <h6 class="pt-1">{{sales.mobile_no}}</h6>
                                <h6>{{sales.location}}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return{
            loading:false,
            sales:{}
        }
    },
    // methods / Functions
    methods:{
        // sales
        rent_list(){
            // home advertisment
            axios.get('api/sale/list/home_ad')
            .then(response=>{
                this.sales = response.data;
                this.loading = true;
                if(response.data.length > 0){
                    for (let index = 0; index < response.data.length; index++) {
                        this.sales[index] = response.data[Math.floor(Math.random() *response.data.length)]
                    }
                }else{
                    axios.get('/api/sale/list/all').then(response=>{
                        this.sales = response.data;
                        this.loading = true;
                        for (let index = 0; index < response.data.length; index++) {
                            this.sales[index] = response.data[Math.floor(Math.random() *response.data.length)]
                        }
                    })
                }
            })
        }
    },
    mounted(){
        this.rent_list(); // Restaurant
    }
}
</script>