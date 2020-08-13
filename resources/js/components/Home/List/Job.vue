<template>
    <div>
        <div class="row" v-if="loading">
            <div class="col-md-8 mx-auto">
                <h6 class="bg-danger btn bt-xs">New Jobs</h6>
                <div class="row">
                    <div class="col-md-6 col-6" v-for="(jobs,index) in jobs" :key="index" v-if="index <= 1">
                    <!-- <div class="col-md-6"> -->
                        <div class="card">
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <a v-bind:href="'job/'+jobs.id">
                                    <div class="banner lazyload" v-bind:style='{ backgroundImage: `url(/storage/Job/Banner/${jobs.banner})`}'></div>
                                    <!-- <div class="banner lazyload" :data-bgset="'/storage/Job/Banner/'+job.banner"  data-sizes="auto"></div> -->
                                    </a>
                                </div>
                                <div class="col-md-6 col-sm-6 p-3 info">
                                    <h5>{{jobs.title}}</h5>
                                    <h6 class="pt-1">{{jobs.mobile_no}}</h6>
                                    <h6>{{jobs.location}}</h6>
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
export default {
    data(){
        return{
            loading:false,
            jobs:{},

        }
    },
    // methods / Functions
    methods:{
        // jobs
        rent_list(){
            // home advertisment
            axios.get('api/job/list/home_ad')
            .then(response=>{
                this.jobs = response.data;
                if(response.data.length > 0){
                    this.loading = true;
                    for (let index = 0; index < response.data.length; index++) {
                        this.jobs[index] = response.data[Math.floor(Math.random() *response.data.length)]
                    }
                }else{
                    axios.get('/api/job/list/all').then(response=>{
                        this.jobs = response.data;
                        this.loading = true;
                        for (let index = 0; index < response.data.length; index++) {
                            this.jobs[index] = response.data[Math.floor(Math.random() *response.data.length)]
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