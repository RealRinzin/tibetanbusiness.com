<template>
    <div>
        <!-- <div v-for="(event,index) in events" :key="event.id" v-if="index <= 1">
            {{event.name}}
        </div> -->
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h6 class="bg-danger btn">Upcoming Events</h6>
                <div class="row">
                    <div class="col-md-6 col-6" v-for="(event,index) in active" :key="index">
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
    </div>
</template>
<script>
export default {

data(){
    return{
        events:{},
        active:[],
    }
},
methods:{
    load_events(){   
         axios.get('api/event/list/home_ad')
        .then(response=>{

                for (let index = 0; index < response.data.length; index++) {
                    this.events[index] = response.data[Math.floor(Math.random() *response.data.length)]   
                }
                this.active = this.events;
        })


    }
},

mounted(){
this.load_events();
}
}
</script>