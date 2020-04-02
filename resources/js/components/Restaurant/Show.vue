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
                                    <h6 class="pt-2 text-muted">{{restaurant.mobile_no}}</h6>
                                    <h6 class="pt-2 text-muted">{{restaurant.location}}</h6>
                                </div>
                            </div>
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