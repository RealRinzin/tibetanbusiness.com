<template>
    <div id="business_list">
        <div v-if="!loading">
            <loading :active.sync="isLoading"></loading>
        </div>
        <!-- <loading :active.sync="isLoading"></loading> -->
        <div  v-else class="container py-3">
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <h6 class="bg-danger btn">New Sale</h6>
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
        </div>
    </div>
</template>
<script>
    // Import component
    import Loading from 'vue-loading-overlay';
    // Import stylesheet
    import 'vue-loading-overlay/dist/vue-loading.css';
export default {
    data(){
        return{
            // loading:false,
            isLoading : false,//Lazy loading
            sales:[],
            loading:false, //loading

        }
    },
    // methods / Functions
    methods:{
        // sales
        rent_list(){
            // home advertisment
            axios.get('api/sale/list/home_ad')
            .then(response=>{
                this.isLoading = true; //Loading true
                if(response.data.length > 0){
                    for (let index = 0; index < response.data.length; index++) {
                        this.sales[index] = response.data[Math.floor(Math.random() *response.data.length)]
                    }
                    this.isLoading = false; //Loading true
                    this.loading = true;
                }else{
                    axios.get('/api/sale/list/all').then(response=>{
                        this.isLoading = true; //Loading true
                        for (let index = 0; index < response.data.length; index++) {
                            this.sales[index] = response.data[Math.floor(Math.random() *response.data.length)]
                        }
                        this.isLoading = false; //Loading true
                        this.loading = true;
                    })
                }
            })
        }
    },
    /**
     * 
     * Components
     *  */  
    components:{Loading},
    mounted(){
        this.rent_list(); // Restaurant
    }
}
</script>