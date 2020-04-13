<template>
    <div id="restaurant">
        <div class="row">
            <div class="col-md-6">
                <!-- banner -->
                <div class="card">
                    <div class="banner" v-bind:style='{ backgroundImage: `url(/img/${restaurant.banner})`}'>
                        <div class="overlay">
                            <i class="fas fa-camera fa-5x text-white"></i>
                            <div class="break"></div>
                            <h5 class="text-white ml-2 mt-3">Update Banner Photo</h5>
                        </div>
                    </div>
                </div>
                <!-- div info -->
                <div class="card">
                    <h5 class="btn btn-info">Basic Information</h5>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <img src="/img/map.jpeg" alt="" height="250">
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props:['rest_id'],
    data(){
        return{
            id:this.rest_id.id,//Restaurant ID
            // Restaurant Object
            restaurant:{},
        }
    },
    //methods
    methods:{
        load(){
            axios.get('/api/restaurant/'+this.id,{
                headers : { Authorization : localStorage.getItem("token")}
            })
            .then(response=>{
                // Assigning Restaurant object
                this.restaurant = response.data.data;
                
            })  
        }
    },
    mounted(){
        this.load();
    }
}
</script>