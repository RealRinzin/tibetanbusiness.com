<template>
    <div class="col-md-4 py-1" v-if="job">
    <loading :active.sync="isLoading"></loading>
        <div class="card">
            <a v-bind:href="'job/'+job.id"><div class="list" v-bind:style='{ backgroundImage: `url(/storage/Job/Banner/${job.banner})`}'></div></a>
            <div class="types">
                <button class="btn btn-outline-info btn-xs py-1"><i class="fas fa-mug-hot mx-1"></i>Job</button>
            </div>
            <div class="card-body text-truncate">
                <h5>{{job.title}}</h5>
                <h6>{{job.mobile_no}}</h6>
                <h6>{{job.location}}</h6>
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
    data(){
        return{
            isLoading : false,//Lazy loading
            job:{}, //Rent object
        }
    },
    methods:{
        load_job(){
            this.isLoading = true; //Loading true
            axios.get('/api/job/list/featured_ad')
            .then(response=>{
                if (response.data.length > 0) {
                    // Assign
                    this.job = response.data[Math.floor(Math.random() *response.data.length)]
                    this.isLoading = false; //Loading true
                }else{
                    axios.get('/api/job/list/all')
                    .then(response => {
                        // Assign
                        this.job = response.data[Math.floor(Math.random() *response.data.length)]
                        this.isLoading = false; //Loading true

                    })
                }
            })
        }
    },
        /**
         * 
         * Components
         *  */  
        components:{Loading},
    mounted(){
        // load
        this.load_job();
    }
}
</script>