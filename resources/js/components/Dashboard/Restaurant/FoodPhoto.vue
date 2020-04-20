<template>
  <div>
    <div class="row">
      <div class="col-md-2 py-2" v-for="(photo,index) in photos">
        <img :src="'/img/'+photo.path" alt="" class="img-fluid">
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
      };
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
