<template>
    <div class="card p-2 my-2" v-if="events != ''">
            <h6 class="py-2 font-weight-bolder text-dark border-bottom"> <span><img src="/img/event.png" alt=""></span> Events - {{event_location}}</h6>

        <div class="row">
            <div class="col-6 py-2" v-for="(event,index) in events" v-if="index <= 3">
                <a v-bind:href="'/event/'+event.id">
                <!-- <div class="banner" v-bind:style='{ backgroundImage: `url(/storage/Sale/Banner/${sale.banner})`}'></div> -->
                <div class="banner lazyload" :data-bgset="'/storage/Event/Banner/'+event.card"  data-sizes="auto">
                    <p v-if="event.entry_free" class="text-dark small position-absolute rounded bg-warning  price p-1 m-0 font-weight-bolder" style="bottom:2px;right:2px">Entry Free</p>
                    <p v-else class="text-white small position-absolute rounded bg-danger  price p-1 m-0 font-weight-bolder" style="bottom:2px;right:2px">Entry:&#x20B9 {{event.entry_fee}}</p>
                </div>
                </a>
                <h6 class="text-muted pt-3 font-weight-bolder">{{event.name}}</h6>
                <p class="text-muted my-0">{{event.mobile_no}}</p>
                <p class="text-muted my-0">{{event.location}}</p>
            </div>
        </div>
    </div>
</template>
<script>
import { lastDayOfDecade } from 'date-fns';
export default {
    props:['location','id'],
     data(){
        return{
            place:this.location,
            events:[],
            event_location:"Other Places"
        }
    },
    methods:{
        // Events API
        event(){
            axios.get('/api/event/list/sidebar/'+this.location)
            .then(response=>{
                if(this.id !== undefined){
                    if(response.data.data.length > 1){
                        for (let i = 0; i < response.data.data.length; i++) {
                            if(response.data.data[i].id != this.id){
                                this.events.push(response.data.data[i]);
                                this.event_location = this.location
                            }
                        }
                    }else{
                        axios.get('/api/event/list/sidebar_ad')
                        .then(response=>{
                            if(response.data.length > 0){
                                for (let i = 0; i < response.data.length; i++) {
                                    if(response.data[i].id != this.id){
                                        this.events.push(response.data[i]);
                                    }
                            }}
                            else{
                            axios.get('/api/event/list/all').then(response=>{
                                for (let i = 0; i < response.data.length; i++) {
                                    if(response.data[i].id != this.id){
                                        this.events.push(response.data[i]);
                                    }
                                }
                            })}
                        })
                    }
                // Else part for
                // other businesses
                }else{
                    if(response.data.data.length > 1){
                        for (let i = 0; i < response.data.data.length; i++) {
                            if(response.data.data[i].id != this.id){
                                this.events.push(response.data.data[i]);
                            }
                        }
                
                    }else{
                        axios.get('/api/event/list/sidebar_ad')
                        .then(response=>{
                            if(response.data.length > 0){
                                for (let i = 0; i < response.data.length; i++) {
                                    if(response.data[i].id != this.id){
                                        this.events.push(response.data[i]);
                                    }
                                }
                            }
                            else{
                                axios.get('/api/event/list/all').then(response=>{
                                    for (let i = 0; i < response.data.length; i++) {
                                        if(response.data[i].id != this.id){
                                            this.events.push(response.data[i]);
                                        }
                                    }
                                })
                            }
                        })
                    }
                }
            })
        },
    },
    mounted(){
        this.event();
    }
}
</script>