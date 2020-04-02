<template>
    <div id="restaurant">
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
                                        <span>Mon</span><span>Tues</span>
                                        <span>Wed</span><span>Thurs</span>
                                        <span>Fri</span><span>Satur</span>
                                        <span>Sun</span>
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
                </div>
                <div class="col-md-4 col-sm-6">
                    Sidebar
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    /**
     * Data
     *  */ 
    data(){
        return{
            restaurant:[], //individual show
            restaurants:{}, // Restaurant objects
        }
    },
    /**
     * Methods
     *  */ 
    methods:{
        show(){    
            axios.get('/api'+window.location.pathname).then(response=>{
                this.restaurant = response.data.data;
            })
        }
    },

mounted(){
    this.show();
}
}
</script>