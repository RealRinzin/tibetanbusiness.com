<template>
    <div class="card p-2 my-2" v-show="show">
        <h6 class="py-2 font-weight-bolder text-dark border-bottom"><span><img src="/img/job.png" alt=""></span> Jobs / Announcements
            <span class="text-muted" style="font-size:12px">- {{job_location}}</span>
        </h6>
        <div class="row">
            <div v-if="loading" class="col-12">
                <div class="row">
                    <div class="col-md-12" v-for="x in 1">
                        <div class="card">
                            <lazy-loading class="mb-0"></lazy-loading>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 py-2" v-for="(job,index) in jobs" v-if="index <= 1">
                <a v-bind:href="'/announcement/'+job.id">
                <div class="banner lazyload" :data-bgset="'/storage/Job/Banner/'+job.card"  data-sizes="auto">
                            <h6 v-if="job.types == 1" class="btn btn-success p-1 position-absolute mx-1" style="font-size:10px;bottom:0px">JOBS</h6>
                            <h6 v-if="job.types == 2" class="btn btn-success p-1 position-absolute mx-1" style="font-size:10px;bottom:0px">ANNOUNCEMENTS</h6>

                    <!-- <p class="text-danger small position-absolute rounded bg-light  price p-1 small m-0 font-weigxht-bolder" style="bottom:2px;right:2px">Rs: {{job.salary}}</p> -->
                </div>
                </a>
                <h6 class="text-muted pt-3 font-weight-bolder">{{job.title}}</h6>
                <p class="text-muted my-0">{{job.mobile_no}}</p>
                <p class="text-muted my-0" v-if="job.types == 1">{{job.location}}</p>
                <p class="text-muted my-0" v-if="job.types == 2">{{job.country}}</p>
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
            jobs:[],
            job_location:'other places',
            loading:true,
            show :true,
        }
    },
    methods:{
        // Job API
        job(){
            axios.get('/api/job/list/sidebar/'+this.location+'?id='+this.id)
            .then(response=>{
                if(this.id !== undefined){
                    if(response.data.data.length > 1){
                        for (let i = 0; i < response.data.data.length; i++) {
                            if(response.data.data[i].id != this.id){
                                this.jobs.push(response.data.data[i]);
                                this.job_location = this.location
                            }
                        }
                        this.loading = false;
                    }else{
                        axios.get('/api/job/list/sidebar_ad')
                        .then(response=>{
                            if(response.data.length > 0){
                                for (let i = 0; i < response.data.length; i++) {
                                    if(response.data[i].id != this.id){
                                        this.jobs.push(response.data[i]);
                                    }
                                }
                            this.loading = false;   
                            }else{
                            axios.get('/api/job/list/all').then(response=>{
                                if (response.data.length<=1) {
                                    this.show = false;
                                }
                                for (let i = 0; i < response.data.length; i++) {
                                    if(response.data[i].id != this.id){
                                        this.jobs.push(response.data[i]);
                                    }
                                }
                                this.loading = false;
                            })}

                        })
                    }
                // Else part for
                // other businesses
                }else{
                    if(response.data.data.length > 0){
                        for (let i = 0; i < response.data.data.length; i++) {
                            if(response.data.data[i].id != this.id){
                                this.jobs.push(response.data.data[i]);
                                    this.job_location = this.location
                            }
                            this.loading = false;
                        }
                    }else{
                        axios.get('/api/job/list/sidebar_ad')
                        .then(response=>{
                            if(response.data.length > 0){
                                for (let i = 0; i < response.data.length; i++) {
                                    if(response.data[i].id != this.id){
                                        this.jobs.push(response.data[i]);
                                    }
                                }
                                this.loading = false;
                            }else{
                                axios.get('/api/job/list/all').then(response=>{
                                    if(response.data.length == 0){
                                        this.show = false;
                                    }
                                    for (let i = 0; i < response.data.length; i++) {
                                        if(response.data[i].id != this.id){
                                            this.jobs.push(response.data[i]);
                                        }
                                    }
                                    this.loading = false;
                                })
                            }
                        })
                    }
                }
            })
        },
    },
    mounted(){
        this.job();
    }
}
</script>