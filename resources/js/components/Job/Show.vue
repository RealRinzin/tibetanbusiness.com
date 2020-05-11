<template>
    <div style="min-height:80vh">
        <vue-headful
        :title="job.title"
        :description="job.location"
        :image="job.banner"
        lang="langauge"
        url="https://tibetanbusiness.com"
        />
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
                                        <div class="col-md-5">
                                            <div class="banner" v-bind:style='{ backgroundImage: `url(/img/${job.banner})`}'>
                                            <div class="overlay">
                                                <div class="d-flex flex-row job">
                                                    <a :href="job.facebook" class="m-1"><i class="fab fa-facebook-square fa-1x btn-primary btn"></i></a>
                                                    <a :href="job.instagram" class="m-1"><i class="fab fa-instagram-square fa-1x btn-danger btn"></i></a>
                                                </div>
                                                <h5 class="font-weight-bold position-absolute btn btn-danger text-white btn-flat">{{job.organization}}</h5>
                                                <h6 class="font-weight-bold position-absolute btn text-white btn-danger btn-flat">{{job.title}}</h6>
                                                <!-- <ul clas="job">
                                                    <li v-if="job.rating != null"><a class="btn-secondary btn text-white"><i class="fas fa-star pr-1 text-warning"></i>{{job.rating}}</a></li>
                                                    <li v-if="job.facebook != null"><a :href="job.facebook"><i class="fab fa-facebook-square fa-2x btn-primary btn"></i></a></li>
                                                    <li v-if="job.instagram != null"><a :href="job.instagram"><i class="fab fa-instagram fa-2x btn-danger btn"></i></a></li>
                                                </ul> -->
                                            </div>
                                            </div>                                
                                        </div>
                                        <div class="col-sm-7 p-3">
                                            <div class="row p-1">
                                                <div class="col-md-3">
                                                    <h6 class="text-dark">Salary</h6>
                                                </div>
                                                <div class="col-md-9">
                                                    <h6 v-if="job.salary" class="text-muted text-left">: Rs <span class="font-weight-bold">{{job.salary}} /-</span></h6>
                                                    <h6 v-else class="text-muted text-left">Not Disclosed</h6>
                                                </div>
                                            </div>
                                            <div class="row p-1">
                                                <div class="col-md-3">
                                                    <h6 class="text-dark">Profession </h6>
                                                </div>
                                                <div class="col-md-9">
                                                    <h6 class="text-muted text-left">: {{job.profession}}</h6>
                                                </div>
                                            </div>
                                            <div class="row p-1">
                                                <div class="col-md-3">
                                                    <h6 class="text-dark">Nature </h6>
                                                </div>
                                                <div class="col-md-9">
                                                    <h6 class="text-muted text-left">: {{job.nature}}</h6>
                                                </div>
                                            </div>
                                            <div class="row p-1">
                                                <div class="col-md-3">
                                                    <h6 class="text-dark">Experience </h6>
                                                </div>
                                                <div class="col-md-9">
                                                    <h6 class="text-muted text-left">: {{job.experience}}</h6>
                                                </div>
                                            </div>
                                            <div class="row p-1">
                                                <div class="col-md-3">
                                                    <h6 class="text-dark">Mobile no </h6>
                                                </div>
                                                <div class="col-md-9">
                                                    <h6 class="text-muted text-left">: {{job.mobile_no}}</h6>
                                                </div>
                                            </div>
                                            <div class="row p-1">
                                                <div class="col-md-3">
                                                    <h6 class="text-dark">Location </h6>
                                                </div>
                                                <div class="col-md-9">
                                                    <h6 class="text-muted text-left">: {{job.location}}</h6>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Overview -->
                                        <!-- <div class="col-md-12">
                                            <div class="row p-3 overview">
                                                    <div class="col-md-6 col-sm-6">
                                                        <h6 class="text-muted py-1"><i class="fas fa-home mr-2"></i>{{job.title}}</h6>
                                                        <h6 class="text-muted py-1"><i class="fas fa-phone-square-alt pr-2"></i>{{job.mobile_no}}</h6>
                                                        <h6 class="text-muted"><i class="fas  fa-map-pin mr-2"></i>{{job.location}}</h6>
                                                        <h6 class="text-muted"><i class="fas fa-users mr-2"></i>{{job.accomodation_size}} people</h6>
                                                    </div>
                                                <div class="col-md-3 col-sm-6 facility" v-if="job.facility !=null">
                                                    <h6 class="mb-3 text-muted">Facilities</h6>
                                                    <p class="text-success" v-if="job.facility[0].geyser"> <i class="fas fa-subway mr-1"></i> Geyser</p>
                                                    <p class="text-danger" v-else> <i class="fas fa-subway mr-1"></i>Geyser</p>
                                                    <p class="text-success" v-if="job.facility[0].wifi"> <i class="fas fa-wifi mr-1"></i> Wifi</p>
                                                    <p class="text-danger" v-else> <i class="fas fa-wifi mr-1"></i> Wifi</p>
                                                    <p class="text-success" v-if="job.facility[0].ac"> <i class="fas fa-fan mr-1"></i>AC</p>
                                                    <p class="text-danger" v-else> <i class="fas fa-fan mr-1"></i>AC</p>
                                                    <p class="text-success" v-if="job.facility[0].washing_machine"><i class="fas fa-power-off mr-1"></i>Washing Machine</p>
                                                    <p class="text-danger" v-else><i class="fas fa-power-off mr-1"></i>Washing Machine</p>
                                                    <p class="text-success" v-if="job.facility[0].gym"> <i class="fas fa-dumbbell mr-1"></i>Gym</p>
                                                    <p class="text-danger" v-else> <i class="fas fa-dumbbell mr-1"></i>Gym</p>
                                                    <p class="text-success" v-if="job.facility[0].pet_allowed"> <i class="fas fa-dog mr-1"></i>Pet Allowed</p>
                                                    <p class="text-danger" v-else> <i class="fas fa-dog mr-1"></i>Pet Allowed</p>
                                                </div>
                                                <div class="col-md-3 col-sm-6 facility" v-if="job.facility !=null">
                                                    <h6 class="mb-3 text-muted">More</h6>
                                                    <p class="text-success" v-if="job.facility[0].single_room "><i class="fas fa-bed mr-1"></i>Single Room</p>
                                                    <p class="text-danger" v-else><i class="fas fa-bed mr-1"></i>Single Room</p>
                                                    <p class="text-success" v-if="job.facility[0].double_room "> <i class="fas fa-bed mr-1"></i>Double Room</p>
                                                    <p class="text-danger" v-else> <i class="fas fa-bed mr-1"></i>Double Room</p>
                                                    <p class="text-success" v-if="job.facility[0].fridge "> <i class="fas fa-box mr-1"></i> Fridge</p>
                                                    <p class="text-danger" v-else> <i class="fas fa-box mr-1"></i>Fridge</p>
                                                    <p class="text-success" v-if="job.facility[0].garden"><i class="fas fa-tree mr-1"></i>Garden</p>
                                                    <p class="text-danger" v-else><i class="fas fa-tree mr-1"></i> Garden</p>
                                                    <p class="text-success" v-if="job.facility[0].parking_space"> <i class="fas fa-car mr-1"></i>Parking Space</p>
                                                    <p class="text-danger" v-else> <i class="fas fa-car mr-1"></i>Parking Space</p>
                                                </div>
                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                                <!-- Info -->
                                <div class="card">
                                    <div class="row p-3">
                                        <div class="col-md-6">
                                            <h5 class="text-dark">Brief</h5>
                                            <p class="text-muted">
                                                {{job.description}}
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
                                    <job-room-photo v-bind:rent_room_photos="job.room_photos"></job-room-photo>
                                </div>
                                <!-- Room Photo -->
                                <div class="card">
                                    <job-view-photo v-bind:rent_view_photos="job.view_photos"></job-view-photo>
                                </div>
                                <!-- comments -->
                                    <job-comment v-bind:rent_uuid="job.id"></job-comment>
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
export default {
    props:['job_id'],
    data(){
        return{
            id:this.job_id['id'], //Rent Id
            job:{}, //job objects
            isLoading : false,//Lazy loading
            loading:false, //loading
        }
    },
    methods:{
        load_rent(){
            this.isLoading = true;
            axios.get('/api/job/view/'+this.id)
            .then(response=>{
                this.job = response.data.data;
                this.isLoading = false;
                this.loading = true;
            })
        }
    },
    /**
     * 
     * Components
     *  */  
    components:{Loading},
    mounted(){
        this.load_rent();
    }
}
</script>