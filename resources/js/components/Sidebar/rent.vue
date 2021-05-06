<template>
    <div class="card p-2 my-2" v-show="show">
        <h6 class="py-2 font-weight-bolder text-dark border-bottom"> <span><i class="fas fa-bed fa-1x mr-2 text-dark"></i></span> Rents
            <span class="text-muted" style="font-size:12px">- {{rent_location}}</span>
         </h6>
        <lazy-loading class="mb-0" v-if="loading"></lazy-loading>
        <div class="row">
            <div class="col-6 py-2" v-for="(rent,index) in rents" v-if="index <= 3">
                <a v-bind:href="'/rent/'+rent.id">
                <!-- <div class="banner" v-bind:style='{ backgroundImage: `url(/storage/Sale/Banner/${sale.banner})`}'></div> -->
                <div class="banner lazyload" :data-bgset="'/storage/Rent/Banner/'+rent.card"  data-sizes="auto">
                    <p class="text-danger small position-absolute rounded bg-light  price p-1 small m-0 font-weight-bolder" style="bottom:2px;right:2px">Rs: {{rent.fare}}</p>
                </div>
                </a>
                <h6 class="text-muted pt-3 font-weight-bolder">{{rent.name}}</h6>
                <p class="text-muted my-0">{{rent.mobile_no}}</p>
                <p class="text-muted my-0">{{rent.location}}</p>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props:['location','id'],
         data(){
        return{
            place:this.location,
            rents:[],
            rent_location:'other places',
            loading:true,
            show:true,
        }
    },
    methods:{
        // Rent API'
        rent(){
            axios.get('/api/rent/list/sidebar/'+this.location)
            .then(response=>{
                if(this.id !== undefined){
                    if(response.data.data.length > 1){
                        for (let i = 0; i < response.data.data.length; i++) {
                            if(response.data.data[i].id != this.id){
                                this.rents.push(response.data.data[i]);
                                this.rent_location = this.location;
                            }
                        }
                        this.loading= false;
                    }else{
                        axios.get('/api/rent/list/sidebar_ad')
                        .then(response=>{
                            if(response.data.length > 0){
                                for (let i = 0; i < response.data.length; i++) {
                                    if(response.data[i].id != this.id){
                                        this.rents.push(response.data[i]);
                                    }
                                }
                                this.loading= false;
                            }
                            else{
                            axios.get('/api/rent/list/all').then(response=>{
                                for (let i = 0; i < response.data.length; i++) {
                                    if(response.data[i].id != this.id){
                                        this.rents.push(response.data[i]);
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
                            if(response.data.data[i].id != this.id){
                                this.rents.push(response.data.data[i]);
                                this.rent_location = this.location;
                            }
                        }
                        this.loading= false;
                    }else{
                        axios.get('/api/rent/list/sidebar_ad')
                        .then(response=>{
                            if(response.data.length > 0){
                                for (let i = 0; i < response.data.length; i++) {
                                    if(response.data[i].id != this.id){
                                        this.rents.push(response.data[i]);
                                    }
                                }
                                this.loading= false;
                            }else{
                                axios.get('/api/rent/list/all').then(response=>{
                                    if(response.data.length == 0){
                                        this.show = false;
                                    }
                                    for (let i = 0; i < response.data.length; i++) {
                                        if(response.data[i].id != this.id){
                                            this.rents.push(response.data[i]);
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
        this.rent();
    }
}
</script>