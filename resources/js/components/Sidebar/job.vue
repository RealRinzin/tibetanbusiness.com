<template>
    <div class="card p-2 my-2">
        <h6 class="py-2 font-weight-bolder text-dark border-bottom"> <span><i class="fas fa-bed fa-1x mr-2 text-dark"></i></span> Jobs - {{job_location}}</h6>
        <lazy-loading class="mb-0" v-if="loading"></lazy-loading>

        <div class="row">
            <div class="col-6 py-2" v-for="(job,index) in jobs" v-if="index <= 3">
                <a v-bind:href="'/job/'+job.id">
                <div class="banner lazyload" :data-bgset="'/storage/Job/Banner/'+job.card"  data-sizes="auto">
                    <!-- <p class="text-danger small position-absolute rounded bg-light  price p-1 small m-0 font-weigxht-bolder" style="bottom:2px;right:2px">Rs: {{job.salary}}</p> -->
                </div>
                </a>
                <h6 class="text-muted pt-3 font-weight-bolder">{{job.title}}</h6>
                <p class="text-muted my-0">{{job.mobile_no}}</p>
                <p class="text-muted my-0">{{job.location}}</p>
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
        }
    },
    methods:{
        // Job API
        job(){
            axios.get('/api/job/list/sidebar/'+this.location)
            .then(response=>{
                if(this.id !== undefined){
                    if(response.data.data.length > 1){
                        for (let i = 0; i < response.data.data.length; i++) {
                            if(response.data.data[i].id != this.id){
                                this.jobs.push(response.data.data[i]);
                                this.job_location = this.location
                        this.loading = false;
                            }
                        }
                    }else{
                        axios.get('/api/job/list/sidebar_ad')
                        .then(response=>{
                            if(response.data.length > 0){
                                for (let i = 0; i < response.data.length; i++) {
                                    if(response.data[i].id != this.id){
                                        this.jobs.push(response.data[i]);
                        this.loading = false;
                                    }
                                }
                                
                            }
                            else{
                            axios.get('/api/job/list/all').then(response=>{
                                for (let i = 0; i < response.data.length; i++) {
                                    if(response.data[i].id != this.id){
                                        this.jobs.push(response.data[i]);
                                this.loading = false;
                                    }
                                }
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
                                    this.loading = false;
                            }
                        }
                    }else{
                        axios.get('/api/job/list/sidebar_ad')
                        .then(response=>{
                            if(response.data.length > 0){
                                for (let i = 0; i < response.data.length; i++) {
                                    if(response.data[i].id != this.id){
                                        this.jobs.push(response.data[i]);
                                        this.loading = false;
                                    }
                                }
                            }
                            else{
                                axios.get('/api/job/list/all').then(response=>{
                                    for (let i = 0; i < response.data.length; i++) {
                                        if(response.data[i].id != this.id){
                                            this.jobs.push(response.data[i]);
                                            this.loading = false;
                                        }
                                    }
                                })
                            }
                        })
                        this.loading = false;
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