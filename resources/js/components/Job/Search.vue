<template>
    <div style="min-height:80vh">
        <div class="container py-4">
            <div class="row">
                <div class="col-md-12 mx-auto">
                    <div class="row">
                        <div class="col-md-3 my-1">
                            <div class="card p-3" style="padding-bottom:0px !important" id="dropdown_lists">
                                <form @submit.prevent="search_result()">
                                    <small class="text-muted font-weight-bolder" style="cursor:pointer" data-toggle="collapse" data-target="#search_collapse" aria-expanded="false" aria-controls="collapseExample">Filter: <i class="fas fa-sliders-h mx-1"></i></small>
                                    <div class="collapse" id="search_collapse">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 py-1">
                                            <input type="text"  v-model="filter.title" class="form-control" placeholder="Job Title">
                                            </div>
                                            <div class="col-md-12 col-sm-12 py-1">
                                            <input type="text" @keyup="load_location()"  v-model="filter.location" class="rounded form-control "  placeholder="Location" aria-label="Location">
                                            <ul class="w-100" style="position: absolute;z-index:100;height:auto">
                                                <!-- <li style="list-style:none;cursor:pointer"  class="py-2 text-dark border-bottom bg-light" v-for="place in places" @click="set_location(place.text,place.context[0].text)"><i class="fas fa-map-marker mx-2 text-muted"></i> {{place.text}}, {{place.context[0].text}}</li> -->
                                                <li style="list-style:none;cursor:pointer"  class="py-2 text-dark border-bottom bg-light" v-for="(place,index) in places" @click="set_location(place.placeName,place.placeAddress)" v-if="index <= 5">
                                                    <span class="font-weight-bold text-dark">{{place.placeName}}</span>
                                                    <span class="d-block text-muted" style="font-size:12px">{{place.placeAddress}}</span>
                                                </li>
                                            </ul>
                                            </div>
                                            <div class="col-md-12 col-sm-12 py-1">
                                               <input type="text" @focusin="job_profession_dropdown()" v-model="filter.profession" class="rounded form-control " readonly="readonly" placeholder="Profession" aria-label="Profession">
                                                <ul id="job_profession_list" style="display:none;transition:1s;z-index:100" class="position-absolute rounded height border">
                                                    <button type="button" @click="close"  class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    <li v-for="profession in professions" :value="profession.name" @click="set_profession(profession.name)">{{profession.name}}</li>
                                                </ul>
                                            </div>
                                            <div class="col-md-12 col-sm-12 py-1">
                                               <input type="text" @focusin="job_experience_dropdown()"  v-model="filter.experience" class="rounded form-control " readonly="readonly" placeholder="Experience" aria-label="Profession">
                                                <ul id="job_experience_list" style="display:none;transition:1s;z-index:100" class="position-absolute rounded border">
                                                    <button type="button" @click="close"  class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    <li value="no experience" @click="set_experience('Not Required')">Not Required</li>
                                                    <li value="6 Months" @click="set_experience('6 Months')">6 Months</li>
                                                    <li value="1 Yrs" @click="set_experience('1 Years')">1 Year</li>
                                                    <li value="2 Yrs" @click="set_experience('2 Years')">2 Years</li>
                                                    <li value="3 Yrs" @click="set_experience('3 Years')">3 Years</li>
                                                    <li value="4 Yrs" @click="set_experience('4 Years')">4 Years</li>
                                                    <li value="5 Yrs" @click="set_experience('5 Years')">5 Years</li>
                                                    <li value="6 Yrs above" @click="set_experience('6 Years above')">6 Years Above</li>
                                                </ul>
                                            </div>
                                            <div class="col-md-12 col-sm-12 py-1 position-relative">
                                                <input type="text" @focusin="job_nature_dropdown()"  v-model="filter.nature" class="rounded form-control " readonly="readonly" placeholder="Nature" aria-label="Service type">
                                                <ul id="job_nature_list" style="display:none;transition:1s;z-index:100" class="position-absolute rounded border">
                                                    <button type="button" @click="close" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    <li value="Full Time" @click="set_nature('Full Time')">Full Time</li>
                                                    <li value="Part Time" @click="set_nature('Part Time')">Part Time</li>
                                                    <li value="Contract" @click="set_nature('Contract')">Contract</li>
                                                    <li value="Internship" @click="set_nature('Internship')">Internship</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="row py-2">
                                            <div class="col-md-12 col-sm-12 py-2" id="range">
                                                <small class="text-muted">Salary:₹{{filter.min}} </small>
                                                <input type="text" id="salary" class="small text-muted my-2" readonly  style="border:0;">
                                                <div id="slider-range"></div>
                                            </div>
                                            <div class="col-md-12 py-2 text-center">
                                                <button class="btn btn-danger btn-md w-25"><small class="fas fa-search"></small></button>
                                                <button class="btn btn-secondary btn-md w-50" @click="reset()"><small>Reset</small></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-5" id="search">
                            <div class="alert alert-danger p-2 small" role="alert">
                                Total Result : {{total}} {{empty_result}}
                            </div>
                            <div class="py-2">
                                <p class="small text-muted pb-0 mb-1">Search keywords:</p>
                                <small v-if="filter.title" class="badge badge-secondary mb-1">Title: {{filter.title}}</small>
                                <small v-if="filter.location" class="badge badge-secondary mb-1">Location: {{filter.location}}</small>
                                <small v-if="filter.profession" class="badge badge-secondary mb-1">Profession: {{filter.profession}}</small>
                                <small v-if="filter.salary_min || filter.salary_max" class="badge badge-secondary mb-1">Salary:₹{{filter.salary_min}} - {{filter.salary_max}}</small>
                                <small v-if="filter.nature" class="badge badge-secondary mb-1">Nature: {{filter.nature}}</small>
                                <small v-if="filter.experience" class="badge badge-secondary mb-1">Experience: {{filter.experience}}</small>
                            </div>
                            <!-- Result -->
                            <div class="col-12" v-if="loading_placeholder">
                                <lazy-loading></lazy-loading>
                                <lazy-loading></lazy-loading>
                                <lazy-loading></lazy-loading>
                            </div>
                            <div v-else>
                                <div class="row" id="result">
                                    <div class="col-md-12 col-sm-12 col-xs-12 info my-2" v-for="(job,index) in jobs">
                                        <a v-bind:href="'/job/'+job.id">
                                        <!-- <div class="banner" v-bind:style='{ backgroundImage: `url(/storage/Job/Banner/${job.banner})`}'> -->
                                        <div class="banner lazyload" :data-bgset="'/storage/Job/Banner/'+job.card"  data-sizes="auto">
                                            <div class="position-absolute ml-2" style="bottom:10px">
                                                <button v-if="job.salary > 0" class="btn btn-danger btn-sm font-weight-bolder">Salary:₹ {{job.salary}}-/</button>
                                                <button v-else class="btn btn-warning btn-sm font-weight-bolder">Salary: Not disclosed</button>
                                                <button class="btn btn-danger btn-sm font-weight-bolder">{{job.nature}}</button>
                                                <button class="btn btn-danger btn-sm font-weight-bolder">Exp: {{job.experience}}</button>
                                            </div>
                                        </div>
                                        <div class="rate" v-if="job.rate !=null"><span v-bind:class="job.rate_color" class="btn">{{job.rate}}</span></div>
                                        </a>
                                        <div class="card px-2">
                                            <p class="my-1">
                                                <span class="btn btn-sm btn-success mr-1 small" v-if="job.applied >0"> <i class="fas fa-check text-white fa-1x mr-1"></i>{{job.applied}} Applied</span>
                                                <span class="btn btn-sm btn-secondary mr-1 small" v-if="job.interested > 0"> <i class="fas fa-thumbs-up text-warning fa-1x mr-1"></i>{{job.interested}} Interested</span>
                                            </p>
                                            <h6 class="text-dark font-weight-bolder">{{job.title}}</h6>
                                            <p class="text-muted my-0 font-weight-bolder">{{job.organization}}</p>
                                            <p class="text-muted my-0" v-if="job.mobile_no != null">{{job.mobile_no}}</p>
                                            <p class="text-muted my-0">{{job.location}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <loading :active.sync="isLoading"></loading>
                            <div class="row my-2" v-if="load_more_button">
                                <div class="col-md-12 text-center">
                                    <!-- <button class="btn btn-danger btn-sm">Load More</button> -->
                                    <button @click="load_more()" class="btn btn-danger btn-sm">Load more</button>

                                </div>
                            </div>
                        </div>
                        <!-- sidebar -->
                        <div class="col-md-4" id="sidebar">
                                <sale-sidebar :location="search_location"></sale-sidebar>
                                <event-sidebar :location="search_location"></event-sidebar>
                                <rent-sidebar :location="search_location"></rent-sidebar>
                                <service-sidebar :location="search_location"></service-sidebar>
                                <restaurant-sidebar :location="search_location"></restaurant-sidebar>
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
    // sidebar
    import SaleSidebar  from '../Search/Sale.vue';
    import EventSidebar from '../Search/Event.vue';
    import RentSidebar from '../Search/Rent.vue';
    import RestaurantSidebar from '../Search/Restaurant.vue';
    import ServiceSidebar from '../Search/Service.vue';
    export default {
        props:['location'],
        // Data
        data(){
            return{
                loading_placeholder:true,
                load_more_button : false,
                total:0,
                rating:0,
                places:'',
                empty_result:'',
                // job:[], // Restaurants Object
                jobs:{
                    data:[],
                    next_page_url:`/api/search/jobs`,
                    },
                    nextPage:2,
                    search_next_page:2,
                // filter
                filter:{
                    title:'',
                    location:this.location,
                    nature:'',
                    experience:'',
                    profession:'',
                    salary_min:0,
                    salary_max:5000000,
                },
                // loading
                isLoading : false,//Lazy loading
                // lazy:false,
                result:[],
                // Login status
                is_logged:false,
                /**
                 * Dropdown List
                 * location
                 *  */  
                locations:{},
                search_location:'',
                professions:{},
            }
        },
        /**
         *  Methods
         *  */ 
        methods:{
            // star
            setRating: function(rating){
            this.rating= rating;
            },
            // load places
            load_location(){
                let location = "\""+ this.filter.location+  "\"";
                if(this.filter.location ==''){
                    this.filter.location = '';
                    this.places ={};
                }else{
                    if(this.filter.location.length > 2){
                    axios.get("/api/map?query="+location)
                    .then(response=>{
                        this.locations = JSON.parse(response.data.data);
                        this.places = this.locations.suggestedLocations;
                    }) 
                    }
                }
            },
            /**
             * Set Location
             *  */ 
            set_location(location,city){
                this.filter.location = location;
                this.places = {};
            },
            // loading
            load_result(){
                if(this.location == null){
                    this.filter.location = ""
                };
                this.search_location = this.filter.location;
            // Login status
                axios.get('/login_status').then(response => {
                    if(response.data.status === true){
                        this.is_logged = true
                    }
                })
                // filter paramater
                // Slider Range
                $( function() {
                    $( "#slider-range" ).slider({
                    range: true,
                    min: 0,
                    max: 100000,
                    values: [ 0, 300000],
                    slide: function( event, ui ) {
                        $( "#salary" ).val( +ui.values[ 0 ] + "-" + ui.values[ 1 ] );
                    }
                    });
                    $( "#salary" ).val( + $( "#slider-range" ).slider( "values", 0 ) +
                    " - " + $( "#slider-range" ).slider( "values", 1 ) );
                        // console.log(this.number);
                } );
                // End Range
                // Get the result
                axios.get('/api/search/jobs?salary_min=0&salary_max=5000000&location='+this.filter.location)
                .then(response=>{ 
                    this.jobs = response.data.data;
                    this.loading_placeholder = false,
                    this.total = response.data.meta.total;
                    // Load more button
                    if(response.data.meta.total == 0){
                        this.empty_result="We don't found the search item";
                    }
                    // if response it there
                    if (response.data.meta.current_page == response.data.meta.last_page) {
                        this.load_more_button = false;
                    }else{
                        this.load_more_button = true;
                        // this.empty_result='';
                    }
                })
            },
            // search result
            search_result(){
                this.isLoading = true; //Loading true
                this.search_location = this.filter.location;
                // Salary Range
                var salary = document.getElementById("salary");
                this.number = salary.value.split("-");
                this.filter.salary_min = this.number[0];
                this.filter.salary_max = this.number[1];
                // Salary Range End
                this.loading = false;
                this.nextPage = 2;
                axios.get('/api/search/jobs?title='+this.filter.title+
                '&location='+this.filter.location+
                '&salary_min='+this.filter.salary_min+
                '&salary_max='+this.filter.salary_max+
                '&profession='+this.filter.profession+
                '&experience='+this.filter.experience+
                '&nature='+this.filter.nature+
                '&page=1')
                .then((response)=>{ 
                    this.jobs = response.data.data;
                    this.total = response.data.meta.total;
                    this.isLoading = false; //Loading true
                    // check for empty result
                    if(response.data.meta.total == 0){
                        this.empty_result = "We don't found the search item"
                    }
                    // Check the load more button
                    if(response.data.meta.current_page == response.data.meta.last_page){
                        this.load_more_button = false; 
                    }else{
                        this.load_more_button = true; 
                    }
                    // Desktop
                    if(screen.width < 767){
                        $("#search_collapse").removeClass("show");
                    }
                })

            },
            // load more button
            
            load_more(nextPage){
                    // this.loading = false;
                this.isLoading = true; //Loading true
                axios.get('/api/search/jobs?title='+this.filter.title+
                '&location='+this.filter.location+
                '&salary_min='+this.filter.salary_min+
                '&salary_max='+this.filter.salary_max+
                '&experience='+this.filter.experience+
                '&profession='+this.filter.profession+
                '&nature='+this.filter.nature+
                '&page='+this.nextPage)
                // axios.get('/api/search/jobs?page='+)
                .then(response=>{
                    if(response.data.meta.current_page <= response.data.meta.last_page){
                        this.nextPage = response.data.meta.current_page + 1;
                        this.isLoading = false; //Loading true
                        // loadmore Button
                        if(response.data.meta.current_page == response.data.meta.last_page){
                            this.load_more_button = false; 
                        }else{
                            this.load_more_button = true; 
                        }
                        // this.lazy = true;
                        /**
                         * Comments 
                         * data Distribution
                         *  */  
                        this.jobs = [
                            ...this.jobs,
                            ...response.data.data
                        ];    
                
                    }else{
                        // this.lazy = false;
                        this.isLoading = false; //Loading true
                    }
                })
            },
            // Reset the search form
            reset(){
                this.empty_result='';
                // Reset form
                this.filter ={
                    title:'',
                    location:'',
                    nature:'',
                    experience:'',
                    profession:'',
                    salary_min:'',
                    salary_max:'',
                    // fare:50000,
                    salary:200000,
                };
                // Desktop
                if(screen.width < 767){
                    $("#search_collapse").removeClass("show");
                }
                this.search_location = '';
                this.load_result();
            },

            close(){
                $("#job_profession_list").css("display", "none");
                $("#job_experience_list").css("display", "none");
                $("#job_nature_list").css("display", "none");
            },
            // profession
        job_profession_dropdown() {
                $("#job_profession_list").css("display", "block");
                $("#job_experience_list").css("display", "none");
                $("#job_nature_list").css("display", "none");
            },
            set_profession(profession){
                this.filter.profession = profession;
                $("#job_profession_list").css("display", "none");
            },
            // profession
        job_experience_dropdown() {
                $("#job_experience_list").css("display", "block");
                $("#job_location_list").css("display", "none");
                $("#job_profession_list").css("display", "none");
                $("#job_nature_list").css("display", "none");
            },
            set_experience(experience){
                this.filter.experience = experience;
                $("#job_experience_list").css("display", "none");
            },
            // Nature
            job_nature_dropdown(){
                $("#job_nature_list").css("display", "block");
                $("#job_experience_list").css("display", "none");
                $("#job_profession_list").css("display", "none");
            },
            set_nature(nature){
                this.filter.nature = nature;
                $("#job_nature_list").css("display", "none");
            }

        },
        // Components
        components:{Loading,SaleSidebar,EventSidebar,RentSidebar,RestaurantSidebar,ServiceSidebar},
        // Mounted
        mounted(){
            this.load_result();
            // location
                // locations api
                axios.get('/api/location')
                .then(response => {
                    this.locations = response.data;
                })
                // Profession
                axios.get('/api/occupations')
                .then(response=>{
                    this.professions = response.data;
                })
        }
    }
</script>