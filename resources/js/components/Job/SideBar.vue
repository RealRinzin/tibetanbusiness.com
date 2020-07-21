<template>
<div>
    <div id="sidebar">
        <!-- Rents -->
        <div class="card p-3">
            <h6 class="py-2"> <span><i class="fas fa-bed fa-1x mr-2 text-dark"></i></span> Jobs</h6>
            <div v-if="!loading" class="loading">
            </div>
            <div class="row" v-else>
                <div class="col-6" v-for="(job,index) in job" v-if="index <= 1">
                    <a v-bind:href="'/job/'+job.id">
                    <div class="banner" v-bind:style='{ backgroundImage: `url(/storage/Job/Banner/${job.banner})`}'></div>
                    </a>
                    <h6 class="text-dark pt-3">{{job.title}}</h6>
                    <p class="text-muted my-0">{{job.mobile_no}}</p>
                    <p class="text-muted my-0">{{job.location}}</p>
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
            job:[], // Restaurants Object
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
            axios.get('/api/job/list/sidebar_ad')
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
                            this.job = this.rent_active;
                            // loading
                            this.loading = true;

                        };
                }else{
                    axios.get('/api/job/list/all').then(response=>{
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
                            // Assigning to job
                            this.job = this.rent_active;
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