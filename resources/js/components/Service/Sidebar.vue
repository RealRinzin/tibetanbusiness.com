<template>
<div>
    <div id="sidebar">
        <!-- Rents -->
        <div class="card p-3">
            <h6 class="py-2"> <span><i class="fas fa-bed fa-1x mr-2 text-dark"></i></span> Service</h6>
            <div v-if="!loading" class="loading">
            </div>
            <div class="row" v-else>
                <div class="col-6" v-for="(service,index) in service" v-if="index <= 1">
                    <a v-bind:href="'/service/'+service.id">
                    <!-- <div class="banner" v-bind:style='{ backgroundImage: `url(/storage/Service/Banner/${service.banner})`}'></div> -->
                    <div class="banner lazyload" :data-bgset="'/storage/Sale/Banner/'+service.banner"  data-sizes="auto"></div>
                    <div class="rate" v-if="service.rate !=null"><span v-bind:class="service.rate_color" class="btn">{{service.rate}}</span></div>
                    </a>
                    <h6 class="text-dark pt-3">{{service.name}}</h6>
                    <p class="text-muted my-0">{{service.mobile_no}}</p>
                    <p class="text-muted my-0">{{service.location}}</p>
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
    // Data
    data(){
        return{
            loading: false,
            service:[], // Restaurants Object
            service_active:[],
        }
    },
    /**
     *  Methods
     *  */ 
    methods:{
        sidebar_events(){
            /**
             * Restaurant Sidebar AD
             *  */ 
            axios.get('/api/service/list/sidebar_ad')
            .then(response=>{
                this.isLoading = true; //Loading true
                if(response.data.length > 0){
                        for (let x = 0; x < response.data.length; x++) {
                            this.service_active[x] = response.data[Math.floor(Math.random() *response.data.length)]
                            /**
                             * Rating Background
                             * Color
                             *  */  
                            if(this.service_active[x].rate >= 0.0 && this.service_active[x].rate <= 2.5){
                                this.service_active[x].rate_color = 'bg-danger';
                            }else if(this.service_active[x].rate >= 2.6 && this.service_active[x].rate <= 3.5 ){
                                this.service_active[x].rate_color = 'bg-warning';
                            }else if(this.service_active[x].rate >= 3.6 && this.service_active[x].rate <= 4.0 ){
                                this.service_active[x].rate_color = 'bg-info';
                            }else if(this.service_active[x].rate >= 4.1 && this.service_active[x].rate <= 5.0 ){
                                this.service_active[x].rate_color = 'bg-success';
                            }else{
                                this.service_active[x].rate_color = 'bg-secondary';
                            }
                            // Assign to restarant
                            this.service = this.service_active;
                            // loading
                            this.loading = true;
                        };
                }else{
                    axios.get('/api/service/list/all').then(response=>{
                        for (let x = 0; x < response.data.data.length; x++) {
                            this.service_active[x] = response.data.data[Math.floor(Math.random() *response.data.data.length)]
                            /**
                             * Rating Background
                             * Color
                             *  */  
                            if(this.service_active[x].rate >= 0.0 && this.service_active[x].rate <= 2.5){
                                this.service_active[x].rate_color = 'bg-danger';
                            }else if(this.service_active[x].rate >= 2.6 && this.service_active[x].rate <= 3.5 ){
                                this.service_active[x].rate_color = 'bg-warning';
                            }else if(this.service_active[x].rate >= 3.6 && this.service_active[x].rate <= 4.0 ){
                                this.service_active[x].rate_color = 'bg-info';
                            }else if(this.service_active[x].rate >= 4.1 && this.service_active[x].rate <= 5.0 ){
                                this.service_active[x].rate_color = 'bg-success';
                            }else{
                                this.service_active[x].rate_color = 'bg-secondary';
                            }
                            // Assigning to service
                            this.service = this.service_active;
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
        this.sidebar_events();
    }
}
</script>