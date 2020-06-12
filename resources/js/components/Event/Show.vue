<template>
    <div style="min-height:80vh">
        <vue-headful
        :title="event.name"
        :description="event.location"
        :image="event.banner"
        lang="langauge"
        url="https://tibetanbusiness.com"
        />
        <div id="restaurant">
            <div v-if="!loading">
                <loading :active.sync="isLoading"></loading>
            </div>
            <div v-else>
                <div  class="container py-4" id="event">
                    <div class="row">
                            <div class="col-md-8 col-sm-12">
                                <!-- basic -->
                                <div class="card">
                                    <div class="row">
                                        <!-- Banner -->
                                        <div class="col-md-12">
                                            <div class="banner" v-bind:style='{ backgroundImage: `url(/storage/Event/Banner/${event.banner})`}'>
                                            <div class="overlay title">
                                                <h6 class="font-weight-bold position-absolute  btn btn-danger"> {{event.name}}</h6>
                                                <ul class="detail">
                                                    <li class="btn btn-danger btn-md"><i class="fas fa-calendar-alt mr-2"></i>{{event.start_date | date}}</li>
                                                    <li class="btn btn-danger btn-md"><i class="far fa-clock mr-2"></i>{{event.start_time}} <span v-if="event.start_time"> a.m </span>-{{event.end_time}} <span v-if="event.end_time"> p.m</span></li>
                                                    <li class="btn btn-danger btn-md"><i class="fas fa-rupee-sign mr-2"></i>Entry Fee: Rs: {{event.entry_fee}}/</li>
                                                </ul>
                                            </div>
                                            </div>                                
                                        </div>
                                        <!-- Overview -->
                                        <div class="col-md-12">
                                            <div class="row p-3 overview">
                                                    <div class="col-md-6 col-sm-6">
                                                        <h6 class="text-muted py-1"><i class="fas fa-calendar-alt mr-2"></i>{{event.name}}</h6>
                                                        <h6 class="text-muted py-1"><i class="fas fa-phone-square-alt pr-2"></i>+91-{{event.mobile_no}}</h6>
                                                        <h6 class="text-muted"><i class="fas  fa-map-pin mr-2"></i>{{event.location}}</h6>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Info -->
                                <div class="card">
                                    <div class="row p-3">
                                        <div class="col-md-6">
                                            <h5 class="text-dark">Brief</h5>
                                            <p class="text-muted">
                                                {{event.description}}
                                            </p>
                                        </div>
                                        <div class="col-md-6"> 
                                            <h6>Location</h6>
                                            <geo-map></geo-map>
                                        </div>
                                    </div>
                                </div>
                                <!--  Photo -->
                                <div class="card">
                                    <photo :event_id="id"></photo>
                                </div>
                                <!-- comments -->
                                <event-review :event_id="id" :rating="rating"></event-review>
                            </div>
                        <!-- Sidebar -->
                            <div class="col-md-4 col-sm-12">
                                <!-- sidebar -->
                                <sidebar></sidebar>
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
import Photo from './Photo.vue';
import EventReview from './Review.vue';
import format from 'date-fns/format';
export default {
    props:['event_id'],
    data(){
        return{
            id:this.event_id.id,
            event:{}, //event objects
            isLoading : false,//Lazy loading
            loading:false, //loading
            rating:0,
        }
    },
    methods:{
        load_event(){
            this.isLoading = true;
            axios.get('/api/event/view/'+this.id)
            .then(response=>{
                this.event = response.data.data;
                this.isLoading = false;
                this.loading = true;
            })
        },
    },
    // Filer
    filters:{
        date(str){
            return format(new Date(str), 'EE, MMM dd, yyyy');
        }
    },
    // Components
    components:{Loading,Photo,EventReview},
    mounted(){
        this.load_event();
    }
}
</script>