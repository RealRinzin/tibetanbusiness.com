<template> 
    <div class="card p-2 my-2">
        <h6 class="py-2 font-weight-bolder text-dark border-bottom"> <span><img src="/img/rent.png" alt=""></span> Rents
                <span class="text-muted" style="font-size:12px"> -{{place}}</span>

         </h6>
        <div v-if="loading">
            <lazy-loading class="mb-0"></lazy-loading>
        </div>
        <div class="row">
            <div class="col-6 py-2" v-for="(rent,index) in rents" v-if="index <= 3">
                <a v-bind:href="'/rent/'+rent.id">
                <!-- <div class="banner" v-bind:style='{ backgroundImage: `url(/storage/Sale/Banner/${sale.banner})`}'></div> -->
                <div class="banner lazyload position-relative" :data-bgset="'/storage/Rent/Banner/'+rent.card"  data-sizes="auto">
                    <p v-if="rent.entry_free" class="text-dark small position-absolute rounded bg-warning  price p-1 m-0 font-weight-bolder" style="bottom:5px;right:2px">Rent</p>
                    <p v-else class="text-white small position-absolute rounded bg-danger  price p-1 m-0 font-weight-bolder" style="bottom:5px;right:2px">Rent:&#x20B9 {{rent.fare}}</p>
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
export default{
    props:['location'],
    // data
    data(){
        return{
            rents:[],
            place:'',
            loading:true,
        }  
    },
    // watch
    watch: { 
        location: function(value) {
            this.place = value;
            if(this.place ===''){
                this.place = 'Other Places';
                axios.get('/api/rent/list/sidebar_ad')
                .then(response=>{
                    if(response.data.length > 0){
                        this.rents = response.data;
                        this.loading = false;
                    }else{
                    axios.get('/api/rent/list/all').then(response=>{
                        this.rents = response.data;
                        this.loading = false;
                    })}
                })
        // Else Part
            }else{
                axios.get('/api/rent/list/sidebar/'+this.place)
                .then(response=>{
                    if(response.data.data.length >0){
                        this.rents = response.data.data;
                        this.place = value;
                        this.loading = false;
                    }else{
                        this.place = 'Other Places';
                        axios.get('/api/rent/list/sidebar_ad')
                        .then(response=>{
                            if(response.data.length > 0){
                                this.rents = response.data;
                                this.loading = false;
                            }else{
                            axios.get('/api/rent/list/all').then(response=>{
                                this.rents = response.data;
                                this.loading = false;
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