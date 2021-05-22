<template> 
    <div class="card p-2 my-2" v-show="show">
            <h6 class="py-2 font-weight-bolder text-dark border-bottom"> <span><img src="/img/job.png" alt=""></span> Jobs 
                <span class="text-muted" style="font-size:12px"> - {{place}}</span>
            </h6>
        <div v-if="loading">
            <lazy-loading class="mb-0"></lazy-loading>
        </div>
        <div class="row">
            <div class="col-6 py-2" v-for="(job,index) in jobs" v-if="index <= 1">
                <a v-bind:href="'/announcement/'+job.id">
                <!-- <div class="banner" v-bind:style='{ backgroundImage: `url(/storage/Sale/Banner/${sale.banner})`}'></div> -->
                <div class="banner lazyload position-relative" :data-bgset="'/storage/Job/Banner/'+job.card"  data-sizes="auto">
                        <p  v-if="job.types == 1" class="text-white small position-absolute rounded bg-secondary  price p-1 m-0 font-weight-bolder" style="bottom:5px;right:2px">Jobs</p>
                        <p  v-if="job.types == 2" class="text-white small position-absolute rounded bg-success  price p-1 m-0 font-weight-bolder" style="bottom:5px;right:2px">Announcements</p>
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
export default{
    props:['location'],
    // data
    data(){
        return{
            jobs:[],
            place:'',
            loading:true,
            show:true,
            
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
                        if(response.data.length==0){
                            this.show = false;
                        }
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
                                if(response.data.length==0){
                                    this.show = false;
                                }
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