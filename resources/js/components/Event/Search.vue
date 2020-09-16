<template>
    <div style="min-height:80vh">
        <div class="container py-4">
            <div class="row">
                <div class="col-md-12 mx-auto">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card p-3" style="padding-bottom:0px !important" id="dropdown_lists">
                                <form @submit.prevent="search_result()">
                                    <small class="btn text-muted" data-toggle="collapse" data-target="#search_collapse" aria-expanded="false" aria-controls="collapseExample">
                                        Filter: <i class="fas fa-sliders-h mx-1"></i>
                                    </small>
                                    <div class="collapse" id="search_collapse">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 py-1">
                                        <input type="text"  v-model="filter.name" class="form-control" placeholder="Name">
                                        </div>
                                        <div class="col-md-12 col-sm-12 py-1">
                                            <input type="text" @focusin="event_location_dropdown()" v-model="filter.location" class="rounded form-control " readonly="readonly" placeholder="Location" aria-label="Service type">
                                                <ul id="event_location_list" style="display:none;transition:1s;" class="position-absolute rounded height border">
                                                <button type="button" @click="close()" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                <li v-for="location in locations" :value="location.name" @click="set_location(location.name)">{{location.name}}</li>
                                            </ul>
                                        </div>
                                        <div class="col-md-12 col-sm-12 py-1">
                                            <input type="text" @focusin="event_category_dropdown()" v-model="filter.category" class="rounded form-control " readonly="readonly" placeholder="Category" aria-label="Service type">
                                                <ul id="event_category_list" style="display:none;transition:1s;" class="position-absolute rounded height border">
                                                <button type="button" @click="close()" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                <li v-for="category in categories" :value="category.name" @click="set_category(category.name)">{{category.name}}</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="row py-2">
                                        <div class="col-md-12 col-sm-12 py-2">
                                            <div class="row">
                                                <div class="col-12"> 
                                                    <label for="from" class="small text-muted">From</label>
                                                    <input type="date" v-model="filter.from" class="form-control" id="from" name="from" value="2021-07-22">
                                                </div>
                                                <div class="col-12">
                                                    <label for="to" class="text-muted small">to</label>
                                                    <input type="date" v-model="filter.to"  class="form-control" id="to" name="to">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12 py-2" v-show="status">
                                            <small class="small text-muted">Entry Fee:₹ <span class="text-muted"></span></small>
                                            <input type="text"  id="entry_fee" class="small text-muted my-2" readonly  style="border:0;">
                                            <div id="slider-range"></div>
                                        </div>
                                        <div class="col-12 py-2">
                                            <form class="was-validated">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="entry_free" v-model="filter.entry_status" @change="entry_free_status(status)">
                                                    <label class="custom-control-label text-muted" for="entry_free">Entry Free</label>
                                                    <div class="invalid-feedback">Example invalid feedback text</div>
                                                </div>
                                            </form>
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
                            <div class="alert alert-light" role="alert">
                                Total Result : {{total}} {{empty_result}}
                            </div>
                            <div class="col-md-12 py-2">
                                <p class="small text-muted pb-0 mb-1">Search keywords:</p>
                                <small v-if="filter.name" class="badge badge-secondary mb-1">Name: {{filter.name}}</small>
                                <small v-if="filter.location" class="badge badge-secondary mb-1">Location: {{filter.location}}</small>
                                <small v-if="filter.entry_fee" class="badge badge-secondary mb-1">Entry Fee: {{filter.fee_min}}</small>
                                <small v-if="filter.category" class="badge badge-secondary mb-1">Category: {{filter.category}}</small>
                                <small v-if="filter.from || filter.to" class="badge badge-secondary mb-1">Date: {{filter.from}} - {{filter.to}}</small>
                            </div>
                            <!-- Result -->
                         <div class="col-12" v-if="loading_placeholder">
                                <lazy-loading></lazy-loading>
                                <lazy-loading></lazy-loading>
                                <lazy-loading></lazy-loading>
                            </div>
                            <div v-else>
                                <div class="row" id="result">
                                    <div class="col-md-12 col-sm-12 col-xs-12 info my-2" v-for="(event,index) in events">
                                        <a v-bind:href="'/event/'+event.id">
                                        <div class="banner lazyload" :data-bgset="'/storage/Event/Banner/'+event.card"  data-sizes="auto">
                                            <ul>
                                                <li class="btn btn-danger btn-md small" v-if="event.entry_fee > 0">Fee:&#x20B9 {{event.entry_fee}}/-</span></li>
                                                <li class="btn small btn-success btn-md " v-else>Free Entry</span></li>
                                                <li class="btn small btn-danger btn-md ">Date: {{event.start_date |date}}</li>
                                                <li class="btn small btn-danger btn-md ">Type:{{event.category}}</li>
                                            </ul>
                                        </div>
                                        <div class="rate btn btn-warning btn-sm small" v-if="event.interested >0"><span><i class="far fa-thumbs-up text-white  mr-1"></i>{{event.interested}} Interested</span></div>
                                        </a>
                                        <div class="card px-2">
                                            <h6 class="text-dark pt-3 font-weight-bolder">{{event.name}}</h6>
                                            <p class="text-muted my-0">{{event.mobile_no}}</p>
                                            <p class="text-muted my-0">{{event.location}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <loading :active.sync="isLoading"></loading>
                            <div class="row my-2" v-if="load_more_button">
                                <div class="col-md-12 text-center">
                                    <button @click="load_more()" class="btn btn-danger btn-sm">Load more</button>
                                </div>
                            </div>
                        </div>
                        <!-- sidebar -->
                        <div class="col-md-4">
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
    // date
    import format from 'date-fns/format';

export default {
    props: ['location'],
    // Data
    data(){
        return{
            load_more_button : false,
            loading_placeholder:true,
            total:0,
            rating:0,
            status:true,
            empty_result:'',
            // event:[], // Restaurants Object
            events:{
                data:[],
                next_page_url:`/api/search/events`,
                },
                nextPage:2,
                search_next_page:2,
            // filter
            filter:{
                name:'',
                location:this.location,
                category:'',
                entry_status:false,
                fee_min:0,
                fee_max:10000000,
                from:'',
                to:'2020-12-22'
            },
            // loading
            isLoading : false,//Lazy loading
            // lazy:false,
            result:[],
            /**
             * Dropdown List
             * location
             * profession
             * nature
             *  */  
            locations:{},
            categories:{},

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
        // Entry Free Chekc
        entry_free_status(status){
            if(status){
                this.status = false;
                this.search_result();
            }else{
                this.status = true
                this.search_result();
            }
        },
        // loading
        load_result(){
            if(this.location == null){
                this.filter.location = ""
            };
            let today = new Date();
            let from = format(new Date(today), 'yyyy-MM-dd');
            this.filter.from = from;
            // Slider Range
            $( function() {
                $( "#slider-range" ).slider({
                range: true,
                min: 0,
                max: 100000,
                values: [ 0, 100000],
                slide: function( event, ui ) {
                    $( "#entry_fee" ).val(+ui.values[0]+"-"+ui.values[ 1 ] );
                }
                });
                $( "#entry_fee" ).val( +$("#slider-range" ).slider( "values", 0 )+
                "-"+$("#slider-range").slider( "values", 1 ) );
                    // console.log(this.number);
            } );
            // Get the result
            axios.get('/api/search/events?from='
            +this.filter.from+
            '&to='+this.filter.to+
            '&fee_min='+this.filter.fee_min+
            '&fee_max='+this.filter.fee_max+
            '&entry_free='+this.filter.entry_status+
            '&location='+this.filter.location
            )
             .then(response=>{ 
                this.events = response.data.data;
                this.loading_placeholder = false,
                this.total = response.data.meta.total;
                // Load more button
                if(response.data.total == 0){
                    this.empty_result="We don't found the search item";
                }
                // if response it there
                if (response.data.meta.current_page == response.data.meta.last_page) {
                    this.load_more_button = false;
                }else{
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
            // Range
            this.isLoading = true; //Loading true
            // check
            var fee = document.getElementById("entry_fee");
            this.number = fee.value.split("-");
            this.filter.fee_min = this.number[0];
            this.filter.fee_max = this.number[1];
            //  variables
            this.nextPage = 2;
            axios.get('/api/search/events?name='+this.filter.name+
            '&location='+this.filter.location+
            '&category='+this.filter.category+
            '&from='+this.filter.from+
            '&to='+this.filter.to+
            '&entry_free='+this.filter.entry_status+
            '&fee_min='+this.filter.fee_min+
            '&fee_max='+this.filter.fee_max
            +'&page=1')
            .then((response)=>{ 
                this.events = response.data.data;
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

            })

        },
        // load more button
        
        load_more(nextPage){
                // this.loading = false;
            this.isLoading = true; //Loading true
            axios.get('/api/search/events?name='+this.filter.name+
            '&location='+this.filter.location+
            '&category='+this.filter.category+
            '&from='+this.filter.from+
            '&to='+this.filter.to+
            '&entry_free='+this.filter.entry_status+
            '&fee_min='+this.filter.fee_min+
            '&fee_max='+this.filter.fee_max+
            '&page='+this.nextPage)
            // axios.get('/api/search/events?page='+)
            .then(response=>{
                console.log(response.data);
                if(response.data.meta.current_page <= response.data.meta.last_page){
                    this.nextPage = response.data.meta.current_page + 1;
                    this.isLoading = false; //Loading true
                    // loadmore Button
                    if(response.data.meta.current_page == response.data.meta.last_page){
                        this.load_more_button = false; 
                    }else{
                        this.load_more_button = true; 
                    }
                    /**
                     * Comments 
                     * data Distribution
                     *  */  
                    this.events = [
                        ...this.events,
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
            let today = new Date();
            let from = format(new Date(today), 'yyyy-MM-dd');
            this.status = true;
            // Reset
            this.empty_result='';
            // filter paramater
            this.filter = {
                name:'',
                location:'',
                category:'',
                entry_status:false,
                fee_min:0,
                fee_max:1000000,
                from:from,
                to:'2022-10-20'
            };
            // Desktop
            if(screen.width < 767){
                $("#search_collapse").removeClass("show");
            }
            this.load_result();
        },
        /**
         * SEARCH LIST
         * DROPDOWN
         *  */ 
       event_location_dropdown() {
            $("#event_location_list").css("display", "block");
            $("#event_category_list").css("display", "none");
            // $("#job_profession_list").css("display", "none");
            // $("#job_experience_list").css("display", "none");
            // $("#job_nature_list").css("display", "none");
        },
        set_location(location){
            this.filter.location = location;
            $("#event_location_list").css("display", "none");
        },
        // categoryu
        event_category_dropdown() {
            $("#event_category_list").css("display", "block");
            $("#event_location_list").css("display", "none");
        },
        set_category(category){
            this.filter.category = category;
            $("#event_category_list").css("display", "none");
        },
        close(){
            $("#event_location_list").css("display", "none");
            $("#event_category_list").css("display", "none");
        },

    },
    // Components
    components:{Loading},
    /**
     * Filter
     *  */ 
    filters:{
        date(str){
            return format(new Date(str), 'EE, MMM dd, yyyy');
        }
    },
    // Mounted
    mounted(){
        this.load_result();
        // locations api
        axios.get('/api/location')
        .then(response => {
            this.locations = response.data;
        })
        // Profession
        axios.get('/api/categories/event')
        .then(response=>{
            this.categories = response.data;
        })
    }
}
</script>