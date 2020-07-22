<template>
    <div style="min-height:80vh">
        <div class="container py-4">
            <div class="row">
                <div class="col-md-12 mx-auto">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card p-3" style="padding-bottom:0px !important">
                                <form @submit.prevent="search_result()">
                                    <small class="text-muted">Filter: <i class="fas fa-sliders-h mx-1"></i></small>
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 py-1">
                                        <input type="text"  v-model="filter.name" class="form-control" placeholder="Name">
                                        </div>
                                        <div class="col-md-12 col-sm-12 py-1">
                                          <select name="location" v-model="filter.location" class="form-control">
                                                <option value="">Choose Location..</option>
                                                <option value="Dharamsala">Dharamsala</option>
                                                <option value="mussoorie">Mussoorie</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row py-2">
                                        <div class="col-md-12 col-sm-12 pt-1">
                                            <div class="row">
                                                <div class="col-12"> 
                                                    <label for="from" class="small text-muted">From</label>
                                                    <input type="date" v-model="filter.from" class="form-control" id="from" name="from">
                                                </div>
                                                <div class="col-12">
                                                    <label for="to" class="text-muted small">to</label>
                                                    <input type="date" v-model="filter.to"  class="form-control" id="to" name="to">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12 py-2">
                                            <small class="small text-muted">Salary:₹ <span class="text-muted" id="demo"></span></small>
                                            <input type="range" v-model="filter.entry_fee" style="width:100%" min="1000" max="50000" value="3000" id="myRange" placeholder="Size">
                                        </div>
                                        <div class="col-md-12 py-2 text-center">
                                            <button class="btn btn-danger btn-lg w-25"><small class="fas fa-search"></small></button>
                                            <button class="btn btn-secondary btn-md w-50" @click="reset()"><small>Reset</small></button>
                                            <!-- <input type="submit" class="btn btn-danger btn-md" placeholder="Search"> -->
                                        </div>
                                        <div class="col-md-12 py-2">
                                            <p class="small text-muted pb-0 mb-1">Search keywords:</p>
                                            <small v-if="filter.name" class="badge badge-secondary">Name: {{filter.name}}</small>
                                            <small v-if="filter.location" class="badge badge-secondary">Location: {{filter.location}}</small>
                                            <small v-if="filter.entry_fee" class="badge badge-secondary">Entry Fee: {{filter.entry_fee}}</small>
                                            <small v-if="filter.category" class="badge badge-secondary">Category: {{filter.category}}</small>
                                            <small v-if="filter.from" class="badge badge-secondary">From: {{filter.from}}</small>
                                            <small v-if="filter.to" class="badge badge-secondary">To: {{filter.to}}</small>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6" id="search">
                            <div class="alert alert-light" role="alert">
                                Total Result : {{total}}
                            </div>
                            <!-- Result -->
                            <div v-if="!loading" class="mx-auto bg-white text-center mx-3" style="height:100vh">
                            <img src="/img/loading-gray.svg" alt="" style="margin-top:50%;">
                            </div>
                            <div v-else>
                                <div class="row" id="result">
                                    <div class="col-md-12 col-sm-12 col-xs-12 info" v-for="(event,index) in events">
                                        <a v-bind:href="'/event/'+event.id">
                                        <div class="banner" v-bind:style='{ backgroundImage: `url(/storage/Job/Banner/${event.banner})`}'>
                                    <ul>
                                        <li class="btn">Entry Fee:₹{{event.entry_fee}}/-</li>
                                        <!-- <li class="btn">Nature: {{event.nature}}</li> -->
                                        <!-- <li class="btn">Experience: {{event.experience}}</li> -->
                                    </ul>
                                        </div>
                                        <div class="rate" v-if="event.rate !=null"><span v-bind:class="event.rate_color" class="btn">{{event.rate}}</span></div>
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
    // Data
    data(){
        return{
            loading: false,
            load_more_button : false,
            total:0,
            rating:0,
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
                location:'',
                category:'',
                entry_fee:'',
                from:'',
                to:'',
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
            // $( function() {
            //     var dateFormat = "mm/dd/yy",
            //     from = $( "#from" )
            //         .datepicker({
            //         defaultDate: "+1w",
            //         changeMonth: true,
            //         //   numberOfMonths: 3
            //         })
            //         .on( "change", function() {
            //         to.datepicker( "option","dateFormat","yy-mm-dd", "minDate", getDate( this ) );
            //         }),
            //     to = $( "#to" ).datepicker({
            //         defaultDate: "+1w",
            //         changeMonth: true,
            //         // numberOfMonths: 3
            //     })
            //     .on( "change", function() {
            //         from.datepicker( "option","dateFormat","yy-mm-dd", "maxDate", getDate( this ) );
            //     });
            
            //     function getDate( element ) {
            //     var date;
            //     try {
            //         date = $.datepicker.parseDate( dateFormat, element.value );
            //     } catch( error ) {
            //         date = null;
            //     }
            
            //     return date;
            //     }
            // } );
            // filter paramater
            this.filter = {
                name:'',
                location:'',
                category:'',
                entry_fee:'',
                from:'',
                to:'',
            },
            // Get the result
            axios.get('/api/search/events')
             .then(response=>{ 
                this.events = response.data.data;
                this.loading = true;
                this.total = response.data.total;
                if (response.data.current_page <= response.data.last_page) {
                    this.load_more_button = true;
                }
            })
        },
        // search result
        search_result(){
            console.log(this.filter);
            this.loading = false;
            this.nextPage = 2;
            axios.get('/api/search/events?name='+this.filter.name+
            '&location='+this.filter.location+
            '&category='+this.filter.category+
            '&page=1')
            .then((response)=>{ 
                this.events = response.data.data;
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
            axios.get('/api/search/events?name='+this.filter.name+
            '&location='+this.filter.location+
            '&category='+this.filter.category+
            '&page='+this.nextPage)
            // axios.get('/api/search/events?page='+)
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
                    this.events = [
                        ...this.events,
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
            this.load_result();
        }
    },
    // Components
    components:{Loading},
    // Mounted
    mounted(){
        this.load_result();
        // today date
        // var today = new Date();
        // console.log(today.format("YYYY-MM-DD"));
        var slider = document.getElementById("myRange");
        var output = document.getElementById("demo");
        output.innerHTML = slider.value;
        slider.oninput = function() {
        output.innerHTML = this.value;
        }
    // JQuery UI date
    }
}
</script>