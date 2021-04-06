<template> 
    <div class="card p-2 my-2">
            <h6 class="py-2 font-weight-bolder text-dark border-bottom"> <span><img src="/img/job.png" alt=""></span> Jobs - {{place}}</h6>
        <div v-if="loading">
            <lazy-loading class="mb-0"></lazy-loading>
        </div>
        <div class="row">
            <div class="col-6 py-2" v-for="(job,index) in jobs" v-if="index <= 3">
                <a v-bind:href="'/job/'+job.id">
                <!-- <div class="banner" v-bind:style='{ backgroundImage: `url(/storage/Sale/Banner/${sale.banner})`}'></div> -->
                <div class="banner lazyload position-relative" :data-bgset="'/storage/Job/Banner/'+job.card"  data-sizes="auto">
                    <p v-if="job.salary > 0"  class="text-white small position-absolute rounded bg-danger  price p-1 m-0 font-weight-bolder" style="bottom:5px;right:2px">Salary:&#x20B9 {{job.salary}}</p>
                    <p v-else class="text-dark small position-absolute rounded bg-warning  price p-1 m-0 font-weight-bolder" style="bottom:5px;right:2px">Not Disclosed</p>
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
export default{
    props:['location'],
    // data
    data(){
        return{
            jobs:[],
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
                axios.get('/api/job/list/sidebar_ad')
                .then(response=>{
                    if(response.data.length > 0){
                        this.jobs = response.data;
                        this.loading = false;
                    }else{
                    axios.get('/api/job/list/all').then(response=>{
                        this.jobs = response.data;
                        this.loading = false;
                    })}
                })
        // Else Part
            }else{
                axios.get('/api/job/list/sidebar/'+this.place)
                .then(response=>{
                    if(response.data.data.length >0){
                        this.jobs = response.data.data;
                        this.place = value;
                        this.loading = false;
                    }else{
                        this.place = 'Other Places';
                        axios.get('/api/job/list/sidebar_ad')
                        .then(response=>{
                            if(response.data.length > 0){
                                this.jobs = response.data;
                                this.loading = false;
                            }else{
                            axios.get('/api/job/list/all').then(response=>{
                                this.jobs = response.data;
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
    }
}
</script>