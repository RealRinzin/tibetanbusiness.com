<template>
<div>
    <div id="sidebar">
        <!-- Rents -->
        <div class="card p-3">
            <h6 class="py-2"> <span><i class="fas fa-bed fa-1x mr-2 text-dark"></i></span> Rents</h6>
            <div v-if="!loading" class="loading">
            </div>
            <div class="row" v-else>
                <div class="col-md-6 col-sm-6 col-xs-12" v-for="(event,index) in event" v-if="index <= 1">
                    <a v-bind:href="'/event/'+event.id">
                    <div class="banner" v-bind:style='{ backgroundImage: `url(/storage/Event/Banner/${event.banner})`}'></div>
                    <div class="rate" v-if="event.rate !=null"><span v-bind:class="event.rate_color" class="btn">{{event.rate}}</span></div>
                    </a>
                    <h6 class="text-dark pt-3">{{event.name}}</h6>
                    <p class="text-muted my-0">{{event.mobile_no}}</p>
                    <p class="text-muted my-0">{{event.location}}</p>
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
            event:[], // Restaurants Object
            rent_active:[],
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
            axios.get('/api/event/list/sidebar_ad')
            .then(response=>{
                this.isLoading = true; //Loading true
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
                            this.event = this.rent_active;
                            // loading
                            this.loading = true;
                        };
                }else{
                    axios.get('/api/event/list/all').then(response=>{
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
                            // Assigning to event
                            this.event = this.rent_active;
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