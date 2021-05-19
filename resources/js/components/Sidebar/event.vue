<template>
    <div class="card p-2 my-2" v-show="show">
        <h6 class="py-2 font-weight-bolder text-dark border-bottom"> <span><img src="/img/event.png" alt=""></span> Events 
            <span class="text-muted" style="font-size:12px">- {{event_location}}</span>
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
            <div class="col-6 py-2" v-for="(event,index) in events" v-if="index <= 1">
                <a v-bind:href="'/event/'+event.id">
                <div class="banner lazyload" :data-bgset="'/storage/event/Banner/'+event.card"  data-sizes="auto">
                    <!-- <p class="text-danger small position-absolute rounded bg-light  price p-1 small m-0 font-weigxht-bolder" style="bottom:2px;right:2px">Rs: {{event.salary}}</p> -->
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
export default {
    props:['location','id'],
         data(){
        return{
            place:this.location,
            events:[],
            event_location:'other places',
            loading:true,
            show:true,
        }
    },
    methods:{
        // event API
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
                        this.loading = false;
                    }else{
                        axios.get('/api/event/list/sidebar_ad')
                        .then(response=>{
                            if(response.data.length > 0){
                                for (let i = 0; i < response.data.length; i++) {
                                    if(response.data[i].id != this.id){
                                        this.events.push(response.data[i]);
                                    }
                                }
                            this.loading = false;
                            }else{
                            axios.get('/api/event/list/all').then(response=>{
                                if (response.data.length<=1) {
                                    this.show = false;
                                }
                                for (let i = 0; i < response.data.length; i++) {
                                    if(response.data[i].id != this.id){
                                        this.events.push(response.data[i]);
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
                                this.events.push(response.data.data[i]);
                                this.event_location = this.location
                            }
                        }
                        this.loading = false;
                    }else{
                        axios.get('/api/event/list/sidebar_ad')
                        .then(response=>{
                            if(response.data.length > 0){
                                for (let i = 0; i < response.data.length; i++) {
                                    if(response.data[i].id != this.id){
                                        this.events.push(response.data[i]);
                                    }
                                }
                                this.loading = false;
                            }else{
                                axios.get('/api/event/list/all').then(response=>{
                                    if(response.data.length == 0){
                                        this.show = false;
                                    }
                                    for (let i = 0; i < response.data.length; i++) {
                                        if(response.data[i].id != this.id){
                                            this.events.push(response.data[i]);
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
        this.event();
    }
}
</script>