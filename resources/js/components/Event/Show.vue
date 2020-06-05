<template>
    <div>
        <div id="restaurant">
            <div v-if="!loading">
                <loading :active.sync="isLoading"></loading>
            </div>
            <div v-else>
                <div  class="container py-4">
                    <div class="row">
                            <div class="col-md-8 col-sm-12">
                                <!-- basic -->
                                <div class="card">
                                    <div class="row">
                                        <!-- Banner -->
                                        <div class="col-md-12">
                                            <div class="banner" v-bind:style='{ backgroundImage: `url(/storage/Event/Banner/${event.banner})`}'>
                                            <div class="overlay">
                                                <h6 class="font-weight-bold position-absolute btn btn-danger">Rs: {{event.entry_fee}} /-</h6>
                                                <ul>
                                                    <li v-if="event.rating != null"><a class="btn-secondary btn text-white"><i class="fas fa-star pr-1 text-warning"></i>{{event.rating}}</a></li>
                                                    <li v-if="event.facebook != null"><a :href="event.facebook"><i class="fab fa-facebook-square fa-2x btn-primary btn"></i></a></li>
                                                    <li v-if="event.instagram != null"><a :href="event.instagram"><i class="fab fa-instagram fa-2x btn-danger btn"></i></a></li>
                                                </ul>
                                            </div>
                                            </div>                                
                                        </div>
                                        <!-- Overview -->
                                        <div class="col-md-12">
                                            <div class="row p-3 overview">
                                                    <div class="col-md-6 col-sm-6">
                                                        <h6 class="text-muted py-1"><i class="fas fa-home mr-2"></i>{{event.name}}</h6>
                                                        <h6 class="text-muted py-1"><i class="fas fa-phone-square-alt pr-2"></i>{{event.mobile_no}}</h6>
                                                        <h6 class="text-muted"><i class="fas  fa-map-pin mr-2"></i>{{event.location}}</h6>
                                                        <h6 class="text-muted"><i class="fas fa-users mr-2"></i>{{event.entry_fee}} </h6>
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
                                <!-- Room Photo -->
                                <div class="card">
                                    <!-- <event-room-photo v-bind:rent_room_photos="event.room_photos"></event-room-photo> -->
                                    <photo :event_id="id"></photo>
                                </div>
                                <!-- Room Photo -->
                                <div class="card">
                                    <!-- <event-view-photo v-bind:rent_view_photos="event.view_photos"></event-view-photo> -->
                                </div>
                                <!-- comments -->
                                    <!-- <event-comment v-bind:rent_uuid="event.id"></event-comment> -->
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
export default {
    props:['event_id'],
    data(){
        return{
            id:this.event_id.id,
            event:{}, //event objects
            isLoading : false,//Lazy loading
            loading:false, //loading
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
    // Components
    components:{Loading,Photo},
    mounted(){
        this.load_event();
    }
}
</script>