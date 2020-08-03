<template>
    <div style="min-height:80vh">
        <div class="container py-4">
            <div class="row">
                <div class="col-md-12 mx-auto">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card p-3" style="padding-bottom:0px !important">
                                <form @submit.prevent="search_result()">
                                    <small class="text-muted" data-toggle="collapse" data-target="#search_collapse" aria-expanded="false" aria-controls="collapseExample">Filter: <i class="fas fa-sliders-h mx-1"></i></small>
                                    <div class="collapse" id="search_collapse">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 py-1">
                                            <input type="text"  v-model="filter.title" class="form-control" placeholder="Job Title">
                                            </div>
                                            <div class="col-md-12 col-sm-12 py-1">
                                            <select name="location" v-model="filter.location" class="form-control">
                                                    <option value="">Choose Location..</option>
                                                    <option value="Dharamsala">Dharamsala</option>
                                                    <option value="mussoorie">Mussoorie</option>
                                                </select>
                                            </div>
                                            <div class="col-md-12 col-sm-12 py-1">
                                            <select name="location" v-model="filter.profession" class="form-control">
                                                    <option value="">Choose Profession..</option>
                                                    <option value="Dharamsala">Dharamsala</option>
                                                    <option value="BA">Mussoorie</option>
                                                </select>
                                            </div>
                                            <div class="col-md-12 col-sm-12 py-1">
                                            <select name="location" v-model="filter.experience" class="form-control">
                                                    <option value="">Choose Experience..</option>
                                                    <option value="1">1 Years</option>
                                                    <option value="2">2 Years</option>
                                                    <option value="3">3 Years</option>
                                                </select>
                                            </div>
                                            <div class="col-md-12 col-sm-12 py-1">
                                            <select name="location" v-model="filter.nature" class="form-control">
                                                    <option value="">Choose Full Time/Part..</option>
                                                    <option value="full time">Full Time</option>
                                                    <option value="part time">Part Time</option>
                                                    <option value="internship">Internship</option>
                                                </select>
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
                                            <div class="col-md-12 py-2">
                                                <p class="small text-muted pb-0 mb-1">Search keywords:</p>
                                                <small v-if="filter.title" class="badge badge-secondary mb-1">Title: {{filter.title}}</small>
                                                <small v-if="filter.location" class="badge badge-secondary mb-1">Location: {{filter.location}}</small>
                                                <small v-if="filter.profession" class="badge badge-secondary mb-1">Profession: {{filter.profession}}</small>
                                                <small v-if="filter.salary_min || filter.salary_max" class="badge badge-secondary mb-1">Salary:₹{{filter.salary_min}} - {{filter.salary_max}}</small>
                                                <small v-if="filter.nature" class="badge badge-secondary mb-1">Nature: {{filter.nature}}</small>
                                                <small v-if="filter.experience" class="badge badge-secondary mb-1">Experience: {{filter.experience}}</small>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6" id="search">
                            <div class="alert alert-light" role="alert">
                                Total Result : {{total}}
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
                            <div v-if="!loading" class="mx-auto bg-white text-center mx-3" style="height:100vh">
                            <img src="/img/loading-gray.svg" alt="" style="margin-top:50%;">
                            </div>
                            <div v-else>
                                <div class="row" id="result">
                                    <div class="col-md-12 col-sm-12 col-xs-12 info" v-for="(job,index) in jobs">
                                        <a v-bind:href="'/job/'+job.id">
                                        <div class="banner" v-bind:style='{ backgroundImage: `url(/storage/Job/Banner/${job.banner})`}'>
                                    <ul>
                                        <li class="btn">Salary:₹{{job.salary}}/-</li>
                                        <li class="btn">Nature: {{job.nature}}</li>
                                        <li class="btn">Experience: {{job.experience}}</li>
                                    </ul>
                                        </div>
                                        <div class="rate" v-if="job.rate !=null"><span v-bind:class="job.rate_color" class="btn">{{job.rate}}</span></div>
                                        </a>
                                        <div class="card px-2">
                                            <h6 class="text-dark pt-3 font-weight-bolder">{{job.title}}</h6>
                                            <p class="text-muted my-0">{{job.mobile_no}}</p>
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
                        <div class="col-md-3 col-sm-6">
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
    props:['location'],
    // Data
    data(){
        return{
            loading: false,
            load_more_button : false,
            total:0,
            rating:0,
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
                salary_min:'',
                salary_max:'',
                // fare:50000,
                salary:200000,
            },
            // loading
            isLoading : false,//Lazy loading
            // lazy:false,
            result:[],

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
        // loading
        load_result(){
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
                this.loading = true;
                this.total = response.data.total;
                if (response.data.current_page <= response.data.last_page) {
                    this.load_more_button = true;
                }
            })
        },
        // search result
        search_result(){
            // Desktop
            if(screen.width < 767){
                $("#search_collapse").removeClass("show");
            }
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
                this.loading = true;
                this.total = response.data.total;
                // check for empty result
                if(response.data.total == 0){
                    this.empty_result = "We don't found the search item"
                }
                // Check the load more button
                if(response.data.current_page < response.data.last_page){
                    this.load_more_button = true; 
                }else{
                    this.load_more_button = false; 
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
                if(response.data.current_page <= response.data.last_page){
                    this.nextPage = response.data.current_page + 1;
                    this.load_more_button = true; 
                    this.isLoading = false; //Loading true
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
                    this.load_more_button = false;
                }
            })
        },
        // Reset the search form
        reset(){
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
            this.load_result();
        }
    },
    // Components
    components:{Loading},
    // Mounted
    mounted(){
        this.load_result();
        // var slider = document.getElementById("myRange");
        // var output = document.getElementById("demo");
        // output.innerHTML = slider.value;
        // slider.oninput = function() {
        // output.innerHTML = this.value;
        // }
    }
}
</script>