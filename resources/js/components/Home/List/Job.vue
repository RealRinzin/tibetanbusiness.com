<template>
    <div class="row" v-if="loading">
        <div class="col-md-10 mx-auto">
            <h6 class="btn-info btn btn-flat small"><img src="/img/job.png" class="mr-2" alt=""> Latest jobs</h6>
            <div class="row" >
                <div class="col-md-3 col-sm-6 col-6" v-for="(job,index) in jobs" :key="index" v-if="index <= 3">
                    <div class="card">
                        <a v-bind:href="'job/'+job.id">
                        <div class="banner" v-bind:style='{ backgroundImage: `url(storage/job/Banner/${job.banner})`}'></div>
                        </a>
                        <div class="info p-1">
                            <h5>{{job.name}}</h5>
                            <h6 class="pt-1">{{job.mobile_no}}</h6>
                            <h6>{{job.location}}</h6>
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
        job_list(){
            // home advertisment
            axios.get('api/job/list/home_ad')
            .then(response=>{
                this.loading = true;
                if(response.data.length > 0){
                    this.jobs = response.data;
                }else{
                    axios.get('/api/job/list/all').then(response=>{
                        this.jobs = response.data;
                        this.loading = true;
                    })
                }
            })
        }
    },

    mounted(){
        this.job_list(); // Restaurant
    }
}
</script>