<template>
    <div class="card p-2 my-2" v-if="jobs != ''">
        <h6 class="py-2 font-weight-bolder text-dark border-bottom"> <span><i class="fas fa-bed fa-1x mr-2 text-dark"></i></span> Jobs - {{job_location}}</h6>
        <div class="row">
            <div class="col-6 py-2" v-for="(job,index) in jobs" v-if="index <= 3">
                <a v-bind:href="'/job/'+job.id">
                <div class="banner lazyload" :data-bgset="'/storage/job/Banner/'+job.card"  data-sizes="auto">
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
    props:['location'],
         data(){
        return{
            place:this.location,
            jobs:[],
            job_location:'other places'
        }
    },
    methods:{
        // Job API
        job(){
            axios.get('/api/job/list/sidebar/'+this.location)
            .then(response=>{
                if(response.data.data.length > 0){
                    this.jobs = response.data.data;
                    this.job_location = this.location;
                }else{
                    axios.get('/api/job/list/sidebar_ad')
                    .then(response=>{
                        if(response.data.length > 0){
                            this.jobs = response.data;
                        }else{
                            axios.get('/api/job/list/all').then(response=>{
                                this.jobs = response.data;
                            })
                        }
                    })
                }
            })
        },
    },
    mounted(){
        this.job();
    }
}
</script>