<template>
    <div>
        <div id="restaurant">
            <div v-if="!loading">
                <loading :active.sync="isLoading"></loading>
            </div>
            <div v-else>
                <div  class="container py-1" id="event">
                    <div class="row">
                            <div class="col-md-8 col-sm-12">
                                <!-- basic -->
                                <div class="card my-2">
                                    <div class="row">
                                        <!-- Banner -->
                                        <div class="col-md-12">
                                            <div class="banner lazyload" :data-bgset="'/storage/Event/Banner/'+event.banner"  data-sizes="auto">
                                            <div class="overlay title">
                                                <!-- <share-it 
                                                class="bg-light p-0 rounded-1 float-right"
                                                :icons="true" 
                                                />  -->
                                                <h6 class="font-weight-bold position-absolute  btn btn-danger"> {{event.name}}</h6>
                                                <ul class="detail">
                                                    <li class="btn btn-danger btn-md"><i class="fas fa-calendar-alt mr-2"></i>{{event.start_date | date}}</li>
                                                    <li class="btn btn-danger btn-md mr-2" v-if="event.start_time"><i class="far fa-clock mr-2"></i>{{event.start_time}} <span v-if="event.start_time"> a.m </span>-{{event.end_time}} <span v-if="event.end_time"> p.m</span></li>
                                                    <li v-if="event.entry_free > 0" class="btn btn-success btn-md">Entry Free</li>
                                                    <li v-else class="btn btn-warning btn-md">Entry Fee:&#x20B9 {{event.entry_fee}}/</li>
                                                </ul>
                                            </div>
                                            </div>                                
                                        </div>
                                        <!-- Overview -->
                                        <div class="col-md-12">
                                            <div class="row p-3 overview">
                                                    <div class="col-6">
                                                        <h6 class="text-muted py-1"><i class="fas fa-calendar-alt mr-2"></i>{{event.name}}</h6>
                                                        <h6 class="text-muted py-1" v-if="event.mobile_no"><i class="fas fa-phone-square-alt pr-2"></i>+91-{{event.mobile_no}}</h6>
                                                        <h6 class="text-muted"><i class="fas  fa-map-pin mr-2"></i>{{event.location}}</h6>
                                                        <h6 class="text-muted"><i class="fas fa-map-marked-alt mr-2"></i>{{event.address}}</h6>
                                                    </div>
                                                    <div class="col-6 text-right text-muted text-bold interested">
                                                        <div v-if="is_logged">
                                                            <p class="small text-bold" v-if="liked"><i class="fas text-lg text-primary fa-thumbs-up mr-1" @click="thumbs_down(event.interested)"></i>You and {{event.interested -1}} People Interested</p>
                                                            <p class="small text-bold" v-else><i class="far text-lg fa-thumbs-up mr-1" @click="thumbs_up(event.interested)"></i>{{event.interested}} People Interested</p>
                                                        </div>
                                                        <div v-else>
                                                            <p class="small text-bold">
                                                            <a href=""  data-toggle="modal" data-target="#login"><i class="far text-lg text-muted fa-thumbs-up mr-1"></i> </a>
                                                                {{event.interested}} People Interested
                                                            </p>
                                                        </div>
                                                <div class="d-flex flex-row justify-content-end">
                                                    <a v-if="event.facebook" :href="event.facebook" class="m-1"><i class="fab fa-facebook-square fa-1x btn-primary p-1 rounded"></i></a>
                                                    <a v-if="event.instagram" :href="event.instagram" class="m-1"><i class="fab fa-instagram-square fa-1x btn-danger p-1 rounded"></i></a>
                                                    <a v-if="event.website" :href="event.website" class="m-1"><i class="fab fa-internet-explorer  btn-secondary p-1 rounded"></i></a>
                                                </div>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Info -->
                                <div class="card my-2">
                                    <div class="row p-3">
                                        <div class="col-md-6" v-if="event.description">
                                            <h5 class="text-dark">Brief</h5>
                                            <p class="text-muted">
                                                {{event.description}}
                                            </p>
                                        </div>
                                        <div class="col-md-6"> 
                                            <map-location :longitude="event.longitude" :latitude="event.latitude"></map-location>
                                        </div>
                                    </div>
                                </div>
                                <!--  Photo -->
                                <div class="card my-2">
                                    <photo :event_id="id"></photo>
                                </div>
                                <!-- comments -->
                                <event-review :event_id="id" :rating="rating" :avg_rating="event.rating"></event-review>
                            </div>
                        <!-- Sidebar -->
                            <div class="col-md-4 col-sm-12" id="sidebar">
                                <!-- sidebar -->
                                <event-sidebar :location="event.location" :id="event.id"></event-sidebar>
                               <sale-sidebar :location="event.location"></sale-sidebar>
                                <rent-sidebar :location="event.location"></rent-sidebar>
                                <job-sidebar :location="event.location"></job-sidebar>
                                <restaurant-sidebar :location="event.location"></restaurant-sidebar>
                                <service-sidebar :location="event.location"></service-sidebar>
                                <!-- <sidebar></sidebar> -->
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
// import shareIt from "vue-share-it";
// Sidebar
import SaleSidebar  from '../Sidebar/Sale.vue';
import EventSidebar from '../Sidebar/event.vue';
import JobSidebar from '../Sidebar/job.vue';
import RentSidebar from '../Sidebar/rent.vue';
import RestaurantSidebar from '../Sidebar/restaurant.vue';
import ServiceSidebar from '../Sidebar/service.vue';
// import format from 'date-fns/format';
import { compareAsc, format } from 'date-fns';
export default {
    props:['event_id'],
    data(){
        return{
            id:this.event_id.id,
            // user_id:localStorage.getItem('user_id'),
            user_id:'',
            event:{}, //event objects
            isLoading : false,//Lazy loading
            loading:false, //loading
            rating:0,
            // login status check
            is_logged:false,
            // participate like
            audience:{},
            liked:false,
            liked_id:'',
            // Social Share
        }
    },
    methods:{
        load_event(){
            // Load Events
            this.isLoading = true;
            axios.get('/api/event/view/'+this.id)
            .then(response=>{
                this.event = response.data.data;
                //Event interested record
                this.audience = this.event.event_interested;
                // loading 
                this.isLoading = false;
                this.loading = true;
                // Login status
                axios.get('/login_status').then(response => {
                    if(response.data.status == true){
                        this.is_logged = true,
                        this.user_id = response.data.user.id
                        // Check if liked
                        for (let index = 0; index < this.audience.length; index++) {
                            if(this.audience[index].user_id == this.user_id){
                                this.liked = true;
                                this.liked_id = this.audience[index].id
                                break;
                            }
                        }
                    }
                })
            })
        },
        // participate
        thumbs_up(count){
            this.liked = true;
            this.event_interested = count +1;
            axios.post('/api/event_interest',{id:this.id},{
                headers : { Authorization : localStorage.getItem("token")}
            })
            .then(repsone=>{
            // this.event_interested = count +1
            this.load_event();
            })
        },
        // Ignore event
        thumbs_down(count){
            this.liked = false;
            this.event_interested = count - 1;
            axios.delete('/api/event_interest/'+this.liked_id,{
                headers : { Authorization : localStorage.getItem("token")}
            })
            .then(repsone=>{
                // this.event_interested = count -1
                this.load_event();
            })
        }
    },
    // Filer
    filters:{
        date(str){
            return format(new Date(str), 'EE, MMM dd, yyyy');
        }
    },
    // Components
    components:{Loading,Photo,EventReview,SaleSidebar,EventSidebar,JobSidebar,RentSidebar,RestaurantSidebar,ServiceSidebar},
    mounted(){
        this.load_event();
    }
}
</script>