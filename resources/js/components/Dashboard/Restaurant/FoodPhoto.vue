<template>
  <div>
    <div class="row">
      <div class="col-md-2" v-for="(photo,index) in photos">
        <img :src="'/img/'+photo.path" alt="" class="img-responsive ">
      </div>
    </div>
  </div>
</template>
<script>
  import VueGallery from 'vue-gallery';
  export default {
    props:['food_photos'],
    // data
    data: function () {
      return {
        // Photos array object
        photos:{},
      };
    },
    // watching the data props
      watch: {
        food_photos: function(newVal) { 
           this.photos = newVal
        }
      },
    // mounted
    mounted(){

    }

  }
</script> 
