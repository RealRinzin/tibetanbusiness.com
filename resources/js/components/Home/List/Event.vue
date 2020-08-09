<template>
         <div class="container py-3">
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <h6 class="bg-danger btn">Upcoming Events</h6>
                    <div class="row">
                        <div class="col-md-6 col-6" v-for="(events,index) in events" v-if="index <= 1">
                            <div class="card">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6">
                                        <a v-bind:href="'event/'+events.id">
                                        <div class="banner" v-bind:style='{ backgroundImage: `url(storage/Event/Banner/${events.banner})`}'></div>
                                        </a>
                                    </div>
                                    <div class="col-md-6 col-sm-6 p-3 info">
                                        <h5>{{events.name}}</h5>
                                        <h6 class="pt-1">{{events.mobile_no}}</h6>
                                        <h6>{{events.location}}</h6>
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
    // Import component
    import Loading from 'vue-loading-overlay';
    // Import stylesheet
    import 'vue-loading-overlay/dist/vue-loading.css';
export default {
    data(){
        return{
            // loading:false,
            isLoading : false,//Lazy loading
            events:[],
            loading:false, //loading

        }
    },
    // methods / Functions
    methods:{
        // events
        event_list(){
            // home advertisment
            axios.get('api/event/list/home_ad')
            .then(response=>{
                // this.isLoading = true; //Loading true
                if(response.data.length > 0){
                    for (let index = 0; index < response.data.length; index++) {
                        this.events[index] = response.data[Math.floor(Math.random() *response.data.length)]
                    }
                    // this.isLoading = false; //Loading true
                    // this.loading = true;
                }else{
                    axios.get('/api/event/list/all').then(response=>{
                        // this.isLoading = true; //Loading true
                        for (let index = 0; index < response.data.length; index++) {
                            this.events[index] = response.data[Math.floor(Math.random() *response.data.length)]
                        }
                        // this.isLoading = false; //Loading true
                        // this.loading = true;
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
        this.event_list(); // Restaurant
    }
}
</script>