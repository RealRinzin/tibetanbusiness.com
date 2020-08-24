<template>
    <div class="row" v-if="loading">
        <div class="col-md-10 mx-auto">
            <h6 class="bg-danger btn"><img src="/img/rent.png" class="mr-2" alt=""> Rents</h6>
            <div class="row" >
                <div class="col-md-3 col-sm-6 col-6" v-for="(rent,index) in rents" :key="index" v-if="index <= 3">
                    <div class="card">
                        <a v-bind:href="'rent/'+rent.id">
                        <div class="banner" v-bind:style='{ backgroundImage: `url(storage/rent/Banner/${rent.banner})`}'></div>
                        </a>
                        <div class="info p-2">
                            <h5>{{rent.name}}</h5>
                            <h6 class="pt-1">{{rent.mobile_no}}</h6>
                            <h6>{{rent.location}}</h6>
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
            rents:{},

        }
    },
    // methods / Functions
    methods:{
        // rents
        rent_list(){
            // home advertisment
            axios.get('api/rent/list/home_ad')
            .then(response=>{
                if(response.data.length > 0){
                    this.loading = true;
                    this.rents = response.data;
                }else{
                    axios.get('/api/rent/list/all').then(response=>{
                        this.loading = true;
                        this.rents = response.data;
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