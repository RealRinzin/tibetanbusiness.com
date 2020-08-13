<template>
    <div class="row" v-if="loading">
        <div class="col-md-8 mx-auto">
            <h6 class="bg-danger btn">Service</h6>
            <div class="row">
                <div class="col-md-6 col-6" v-for="(services,index) in services" v-if="index <= 1">
                <!-- <div class="col-md-6"> -->
                    <div class="card">
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <a v-bind:href="'service/'+services.id"><div class="banner" v-bind:style='{ backgroundImage: `url(storage/Rent/Banner/${services.banner})`}'></div></a>
                            </div>
                            <div class="col-md-6 col-sm-6 p-3 info">
                                <h5>{{services.name}}</h5>
                                <h6 class="pt-1">{{services.mobile_no}}</h6>
                                <h6>{{services.location}}</h6>
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
            services:{},
            check:[]
        }
    },
    // methods / Functions
    methods:{
        // services
        rent_list(){
            // home advertisment
            axios.get('api/service/list/home_ad')
            .then(response=>{
                this.services = response.data;
                this.loading = true;
                if(response.data.length > 0){
                    for (let index = 0; index < response.data.length; index++) {
                        this.services[index] = response.data[Math.floor(Math.random() *response.data.length)]
                        // if(Math.floor(Math.random() *response.data.length) == Math.floor(Math.random() *response.data.length)){
                        //     console.log("Same");
                        //     console.log(Math.floor(Math.random() *response.data.length));
                        // }else{
                        //     console.log(Math.floor(Math.random() *response.data.length));

                        // }
                    }
                    // for (let i = 0; i < 2; i++) {
                    //     this.check = this.services;
                    //      console.log(this.check[i].name);
                    // }
                }else{
                    axios.get('/api/service/list/all').then(response=>{
                        this.services = response.data;
                        this.loading = true;
                        for (let index = 0; index < response.data.data.length; index++) {
                            this.services[index] = response.data.data[Math.floor(Math.random() *response.data.data.length)]
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