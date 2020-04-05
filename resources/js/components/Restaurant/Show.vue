<template>

    <div id="restaurant" style="min-height:80vh">
        <div v-if="!loading">
            <loading :active.sync="isLoading"></loading>
        </div>
        <div v-else>
            <div class="container py-4">
                <div class="row">
                        <div class="col-md-8 col-sm-6">
                            <div class="card">
                                <div class="row">
                                    <!-- Banner -->
                                    <div class="col-md-12">
                                        <div class="banner" v-bind:style='{ backgroundImage: `url(/img/${restaurant.banner})`}'>
                                        <div class="overlay">
                                            <h6 class="position-absolute btn btn-warning">{{restaurant.name}}</h6>
                                        </div>
                                        </div>                                
                                    </div>
                                    <!-- Overview -->
                                    <div class="col-md-12">
                                        <div class="overview p-3">
                                            <h5>{{restaurant.name}}</h5>
                                            <h6 class="pt-3 text-muted">{{restaurant.mobile_no}}</h6>
                                            <h6 class="text-muted">{{restaurant.location}}</h6>
                                            <h6 class="text-muted">{{restaurant.opening_hour}} - {{restaurant.closing_hour}}</h6>
                                            <h6 class="text-muted">
                                                <span v-if="restaurant.operation[0].monday == '1'" class="text-success btn btn-outline-success" >Mon</span>
                                                <span v-else class="text-danger btn btn-outline-danger">Mon</span>
                                                <span v-if="restaurant.operation[0].tuesday == '1'" class="text-success btn btn-outline-success" >Tues</span>
                                                <span v-else class="text-danger btn btn-outline-danger">Tues</span>
                                                <span v-if="restaurant.operation[0].wednesday == '1'" class="text-success btn btn-outline-success">Wed</span>
                                                <span v-else class="text-danger btn btn-outline-danger">Wed</span>
                                                <span v-if="restaurant.operation[0].thursday == '1'" class="text-success btn btn-outline-success">Thurs</span>
                                                <span v-else class="text-danger btn btn-outline-danger">Thurs</span>
                                                <span v-if="restaurant.operation[0].friday == '1'" class="text-success btn btn-outline-success">Fri</span>
                                                <span v-else class="text-danger btn btn-outline-danger">Fri</span>
                                                <span v-if="restaurant.operation[0].saturday == '1'" class="text-success btn btn-outline-success">Sat</span>
                                                <span v-else class="text-danger btn btn-outline-danger">Sat</span>
                                                <span v-if="restaurant.operation[0].sunday == '1'" class="text-success btn btn-outline-success">Sun</span>
                                                <span v-else class="text-danger btn btn-outline-danger">Sun</span>
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Info -->
                            <div class="card">
                                <div class="row p-3">
                                    <div class="col-md-6">
                                        <h5 class="text-dark">Brief</h5>
                                        <p class="text-muted">Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Quisque velit nisi, pretium ut lacinia in, elementum id enim.</p>
                                    </div>
                                    <div class="col-md-6"> 
                                        <h6>Location</h6>
                                        <img src="/img/map.jpeg" alt="" class="img-fluid img-thumbnail">
                                    </div>
                                </div>
                            </div>
                            <!-- Menu Photo -->
                            <div class="card">
                                <div class="row p-3">
                                    <div class="col-md-12">
                                        <h5 class="text-dark">Menu Photo (3)</h5>
                                    </div>
                                    <div class="col-md-3"><img src="/img/background.jpg" alt="" class="img-fluid img-thumbnail"></div>
                                    <div class="col-md-3"><img src="/img/background1.jpg" alt="" class="img-fluid img-thumbnail"></div>
                                    <div class="col-md-3"><img src="/img/background2.jpg" alt="" class="img-fluid img-thumbnail"></div>
                                    <div class="col-md-3"><img src="/img/background.jpg" alt="" class="img-fluid img-thumbnail"></div>
                                </div>
                            </div>
                            <!-- Food Photo -->
                            <div class="card">
                                <div class="row p-3">
                                    <div class="col-md-12">
                                        <h5 class="text-dark">Food Photo (4)</h5>
                                    </div>
                                    <div class="col-md-3"><img src="/img/background.jpg" alt="" class="img-fluid img-thumbnail"></div>
                                    <div class="col-md-3"><img src="/img/background1.jpg" alt="" class="img-fluid img-thumbnail"></div>
                                    <div class="col-md-3"><img src="/img/background2.jpg" alt="" class="img-fluid img-thumbnail"></div>
                                    <div class="col-md-3"><img src="/img/background.jpg" alt="" class="img-fluid img-thumbnail"></div>
                                </div>
                            </div>
                            <!-- comments -->
                            <div class="card">
                                <div class="row p-3">
                                    <div class="col-md-12">
                                        <h5>Write Reviews</h5>
                                        <div class="input-group input-group-sm">
                                            <input type="text" class="form-control">
                                            <span class="input-group-append">
                                                <button type="button" class="btn btn-danger btn-flat" placeholder="Write your comment">Post</button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Comment View -->
                            <div class="card p-3" v-if="restaurant.comments">
                                <div class="row">
                                    <h5>Reviews</h5>
                                    <div class="col-md-12 p-3" v-for="(comments,index) in restaurant.comments" v-if="index <4">
                                        <div class="media">
                                        <img class="mr-2 img-circle" src="https://lh3.googleusercontent.com/a-/AOh14Gi5f6dIu2Z7FCNpcwS2Pe5sGKiQz7pZDtvL5wFGWg" alt="Generic placeholder image" style="height:50px;width:50px">
                                        <div class="media-body">
                                            <h6 class="mt-0">{{comments.name}} 
                                                <!-- <small v-if="restaurant.rate < 9"> -->
                                                <small>
                                                <span  v-bind:class="comments.rate_color" class="p-1 rounded"><i class="fas fa-star pr-1"></i>{{comments.rate}}</span>
                                                </small>
                                                </h6>
                                            <p class="text-muted"><timeago :datetime="comments.created_at" /></p>
                                            <p class="text-muted">{{comments.comment}}</p>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <button @click="load_comments()" class="btn btn-danger btn-sm">Load more</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- Sidebar -->
                        <div class="col-md-4 col-sm-6">
                            <restaurant-sidebar></restaurant-sidebar>
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
    /**
     * Data
     *  */ 
    data(){
        return{
            // Loading
            loading:false,
            isLoading : false,//Lazy loading
            // Object
            restaurant:{}, //individual show
            restaurants:{}, // Restaurant objects
            
        }
    },
    /**
     * 
     * Components
     *  */  
    components:{Loading},
    /**
     * Methods
     *  */ 
    methods:{
        show(){   
            this.isLoading = true; //Loading true
            axios.get('/api'+window.location.pathname).then(response=>{
                this.restaurant = response.data.data;
                // loading
                this.isLoading = false; //Loading true
                this.loading = true;
                /**
                 * Rating background
                 * Danger, Warning, Info, Success
                 *  0-3 , 3-5, 5-7 , 7-3
                 *  */ 
                for (let index = 0; index < this.restaurant.comments.length; index++) {
                    if(this.restaurant.comments[index].rate >= 0.0 && this.restaurant.comments[index].rate <= 3.5){
                        this.restaurant.comments[index].rate_color = 'bg-danger';
                    }else if(this.restaurant.comments[index].rate >= 3.6 && this.restaurant.comments[index].rate <= 5.5 ){
                        this.restaurant.comments[index].rate_color = 'bg-warning';
                    }else if(this.restaurant.comments[index].rate >= 5.6 && this.restaurant.comments[index].rate <= 7.0 ){
                        this.restaurant.comments[index].rate_color = 'bg-info';
                    }else if(this.restaurant.comments[index].rate >= 7.1 && this.restaurant.comments[index].rate <= 10.0 ){
                        this.restaurant.comments[index].rate_color = 'bg-success';
                    }else{
                        this.restaurant.comments[index].rate_color = 'bg-secondary';
                    }
                }
                
            })
        },
        /**
         * 
         * Load Comments
         * Pagination
         *  */
        load_comments(){
            console.log("comments more");

        }
    },

mounted(){
    this.show();
}
}
</script>