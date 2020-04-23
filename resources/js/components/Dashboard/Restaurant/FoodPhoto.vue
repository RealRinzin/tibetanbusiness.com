<template>
  <div>
    <div class="row">
      <div class="col-md-12 py-3">
        <div class="d-flex flex-row">
          <div class="p-2"><button class="btn btn-outline-danger d-flex">Upload New photos</button></div>
          <div class="pt-3 px-2"><h6 class="text-muted">Total Photos ({{photos.length}})</h6></div>
        </div>
      </div>
    </div>
    <!-- Photo iterations -->
    <div class="row">
      <div class="col-md-2 col-sm-4 col-xs-6" v-for="(photo,index) in photos">
          <div class="card gallery_view" @click="photo_view(index)" data-toggle="modal" data-target="#food_photo_modal" v-bind:style='{ backgroundImage: `url(/img/${photo.path})`}'>
                <div class="overlay">
                  <div class="d-flex mt-auto ml-auto p-2">
                    <button class="btn btn-danger btn-sm" @click="remove(photo.id,index)"><i class="fas fa-trash-alt "></i></button>
                  </div>
                </div>
          </div>
      </div>
    </div>
    <!-- Modal and Carousel -->
    <div class="modal fade" id="food_photo_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal_top" role="document">
            <div class="modal-content">
                <div class="modal-body" v-if="modal_status">
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item animated fadeIn duration-1s" v-for="(photo,index) in photos" :class="{ active: index==active }">
                                <div class="slide" v-bind:style='{ backgroundImage: `url(/img/${photo.path})`}'></div>
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</template>
<script>
  export default {
    props:['food_photos'],
    // data
    data() {
      return {
        // Photos array object
        photos:{},
        modal_status: false, //modal status
        active:0,
      };
    },
    /**
     * Methods
     *  */ 
    methods:{
      // photo index
      photo_view(index){
        // status
            this.modal_status = true;
            // active class
            this.active = index;
      },
      /**
       * Removing Photo
       *  */
      remove(id,index){
        let confirmBox = confirm('Are you sure want to Delete!!!');
        if(confirmBox == true){
          axios.delete('/api/restaurant_food_photos/'+id,{
            headers : { Authorization : localStorage.getItem("token")}
          })
          .then(response=>{
            //  Flash Message  
            toast.fire({
                icon:'success',
                title:'Deleted Successfully',
            });
            this.$delete(this.photos,index);
          })
        }
      }
    },
    /**
     * Watch the 
     * Props Data
     *  */ 
      watch: {
        food_photos: function(data) { 
           this.photos = data
        }
      },
    // mounted
    mounted(){

    }
  }
</script> 
