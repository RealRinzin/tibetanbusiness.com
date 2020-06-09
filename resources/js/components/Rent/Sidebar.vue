<template>
<div>
    <div id="sidebar">
        <!-- Rents -->
        <div class="card p-3">
            <h6 class="py-2"> <span><i class="fas fa-bed fa-1x mr-2 text-dark"></i></span> Rents</h6>
            <div v-if="!loading" class="loading">
            </div>
            <div class="row" v-else>
                <div class="col-md-6 col-sm-6 col-xs-12" v-for="(rent,index) in rent" v-if="index <= 1">
                    <a v-bind:href="'/rent/'+rent.id">
                    <div class="banner" v-bind:style='{ backgroundImage: `url(/storage/Rent/Banner/${rent.banner})`}'></div>
                    <div class="rate" v-if="rent.rate !=null"><span v-bind:class="rent.rate_color" class="btn">{{rent.rate}}</span></div>
                    </a>
                    <h6 class="text-dark pt-3">{{rent.name}}</h6>
                    <p class="text-muted my-0">{{rent.mobile_no}}</p>
                    <p class="text-muted my-0">{{rent.location}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
</template>
<script>
export default {
    // Data
    data(){
        return{
            loading: false,
            rent:[], // Restaurants Object
            rent_active:[],
        }
    },
    /**
     *  Methods
     *  */ 
    methods:{
        sidebar_rents(){
            /**
             * Restaurant Sidebar AD
             *  */ 
            axios.get('/api/rent/list/sidebar_ad')
            .then(response=>{
                if(response.data.length > 0){
                        for (let x = 0; x < response.data.length; x++) {
                            this.rent_active[x] = response.data[Math.floor(Math.random() *response.data.length)]
                            /**
                             * Rating Background
                             * Color
                             *  */  
                            if(this.rent_active[x].rate >= 0.0 && this.rent_active[x].rate <= 2.5){
                                this.rent_active[x].rate_color = 'bg-danger';
                            }else if(this.rent_active[x].rate >= 2.6 && this.rent_active[x].rate <= 3.5 ){
                                this.rent_active[x].rate_color = 'bg-warning';
                            }else if(this.rent_active[x].rate >= 3.6 && this.rent_active[x].rate <= 4.0 ){
                                this.rent_active[x].rate_color = 'bg-info';
                            }else if(this.rent_active[x].rate >= 4.1 && this.rent_active[x].rate <= 5.0 ){
                                this.rent_active[x].rate_color = 'bg-success';
                            }else{
                                this.rent_active[x].rate_color = 'bg-secondary';
                            }
                            // Assign to restarant
                            this.rent = this.rent_active;
                            // loading
                            this.loading = true;
                        };
                }else{
                    axios.get('/api/rent/list/all').then(response=>{
                        for (let x = 0; x < response.data.data.length; x++) {
                            this.rent_active[x] = response.data.data[Math.floor(Math.random() *response.data.data.length)]
                            /**
                             * Rating Background
                             * Color
                             *  */  
                            if(this.rent_active[x].rate >= 0.0 && this.rent_active[x].rate <= 2.5){
                                this.rent_active[x].rate_color = 'bg-danger';
                            }else if(this.rent_active[x].rate >= 2.6 && this.rent_active[x].rate <= 3.5 ){
                                this.rent_active[x].rate_color = 'bg-warning';
                            }else if(this.rent_active[x].rate >= 3.6 && this.rent_active[x].rate <= 4.0 ){
                                this.rent_active[x].rate_color = 'bg-info';
                            }else if(this.rent_active[x].rate >= 4.1 && this.rent_active[x].rate <= 5.0 ){
                                this.rent_active[x].rate_color = 'bg-success';
                            }else{
                                this.rent_active[x].rate_color = 'bg-secondary';
                            }
                            // Assigning to rent
                            this.rent = this.rent_active;
                            // loading
                            this.loading = true;
                        }
                    })
                }
            })
        }
    },
    // Components
    // Mounted
    mounted(){
        this.sidebar_rents();
    }
}
</script>