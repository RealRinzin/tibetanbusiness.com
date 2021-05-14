<template> 
    <div class="card p-2 my-2" v-show="show">
            <h6 class="py-2 font-weight-bolder text-dark border-bottom"> <span><img src="/img/event.png" alt=""></span> Events
                <span class="text-muted" style="font-size:12px">- {{place}}</span>
            </h6>
        <div v-if="loading">
            <lazy-loading class="mb-0"></lazy-loading>
        </div>
        <div class="row">
            <div class="col-6 py-2" v-for="(event,index) in events" v-if="index <= 3">
                <a v-bind:href="'/event/'+event.id">
                <!-- <div class="banner" v-bind:style='{ backgroundImage: `url(/storage/Sale/Banner/${sale.banner})`}'></div> -->
                <div class="banner lazyload position-relative" :data-bgset="'/storage/Event/Banner/'+event.card"  data-sizes="auto">
                    <p v-if="event.entry_free" class="text-dark small position-absolute rounded bg-warning  price p-1 m-0 font-weight-bolder" style="bottom:5px;right:2px">Entry Free</p>
                    <p v-else class="text-white small position-absolute rounded bg-danger  price p-1 m-0 font-weight-bolder" style="bottom:5px;right:2px">Entry:&#x20B9 {{event.entry_fee}}</p>
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
export default{
    props:['location'],
    // data
    data(){
        return{
            events:[],
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
                axios.get('/api/event/list/sidebar_ad')
                .then(response=>{
                    if(response.data.length > 0){
                        this.events = response.data;
                        this.loading = false;
                    }else{
                    axios.get('/api/event/list/all').then(response=>{
                        this.events = response.data;
                        this.loading = false;
                        if(response.data.length==0){
                            this.show = false;
                        }
                    })}
                })
        // Else Part
            }else{
                axios.get('/api/event/list/sidebar/'+this.place)
                .then(response=>{
                    if(response.data.data.length >0){
                        this.events = response.data.data;
                        this.place = value;
                        this.loading = false;
                    }else{
                        this.place = 'Other Places';
                        axios.get('/api/event/list/sidebar_ad')
                        .then(response=>{
                            if(response.data.length > 0){
                                this.events = response.data;
                                this.loading = false;
                            }else{
                            axios.get('/api/event/list/all').then(response=>{
                                this.events = response.data;
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
        // this.load();
    }
}
</script>