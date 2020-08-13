<template>
    <div class="row" v-if="loading">
        <div class="col-md-8 mx-auto">
            <h6 class="bg-danger btn">Rents</h6>
            <div class="row">
                <div class="col-md-6 col-6" v-for="(rents,index) in rents" :key="index" v-if="index <= 1">
                <!-- <div class="col-md-6"> -->
                    <div class="card">
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <a v-bind:href="'rent/'+rents.id">
                                <div class="banner" v-bind:style='{ backgroundImage: `url(storage/Rent/Banner/${rents.banner})`}'></div>
                                <!-- <div class="banner lazyload" :data-bgset="'/storage/Rent/Banner/'+rent.banner"  data-sizes="auto"></div> -->
                                </a>
                            </div>
                            <div class="col-md-6 col-sm-6 p-3 info">
                                <h5>{{rents.name}}</h5>
                                <h6 class="pt-1">{{rents.mobile_no}}</h6>
                                <h6>{{rents.location}}</h6>
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
            rents:[],

        }
    },
    // methods / Functions
    methods:{
        // rents
        rent_list(){
            // home advertisment
            axios.get('api/rent/list/home_ad')
            .then(response=>{
                this.rents = response.data;
                this.loading = true;
                if(response.data.length > 0){
                    for (let index = 0; index < response.data.length; index++) {
                        this.rents[index] = response.data[Math.floor(Math.random() *response.data.length)]
                    }
                }else{
                    axios.get('/api/rent/list/all').then(response=>{
                        this.rents = response.data;
                        this.loading = true;
                        for (let index = 0; index < response.data.data.length; index++) {
                            this.rents[index] = response.data.data[Math.floor(Math.random() *response.data.data.length)]
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