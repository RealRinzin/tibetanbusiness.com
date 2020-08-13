<template>
    <div class="row" v-if="loading">
        <div class="col-md-8 mx-auto">
            <h6 class="bg-danger btn">Upcoming Events</h6>
            <div class="row">
                <div class="col-md-6 col-6" v-for="(event,index) in events" :key="index" v-if="index <= 1">
                    <div class="card">
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <a v-bind:href="'event/'+event.id">
                                <div class="banner" v-bind:style='{ backgroundImage: `url(storage/Event/Banner/${event.banner})`}'></div>
                                </a>
                            </div>
                            <div class="col-md-6 col-sm-6 p-3 info">
                                <h5>{{event.name}}</h5>
                                <h6 class="pt-1">{{event.mobile_no}}</h6>
                                <h6>{{event.location}}</h6>
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
            events:{},
            loading:false,
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
                this.events = response.data;
                if(response.data.length > 0){
                    this.loading = true;
                    for (let index = 0; index < response.data.length; index++) {
                        this.events[index] = response.data[Math.floor(Math.random() *response.data.length)]
                    }

                }else{
                    axios.get('/api/event/list/all').then(response=>{
                        this.loading = true;
                        this.events = response.data;
                        for (let index = 0; index < response.data.length; index++) {
                            this.events[index] = response.data[Math.floor(Math.random() *response.data.length)]
                        }
                    })
                }
            })
        }
    },
    mounted(){
        this.event_list(); // Restaurant
    }
}
</script>