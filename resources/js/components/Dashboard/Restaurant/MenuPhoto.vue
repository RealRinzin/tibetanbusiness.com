<template>
  <div>
    <div class="row">
      <div class="col-md-2" v-for="(photo,index) in photos">
        <img :src="'/img/'+photo.path" alt="" class="img-fluid">
      </div>
    </div>
  </div>
</template>
 
<script>
  export default {
    props:['menu_photos'],
    data() {
      return {
        photos:{},
      };
    },
    // Methods
    methods:{

    },
    /**
     * 
     * Watch
     *  */ 
    watch:{
        menu_photos(data){
          this.photos = data
        }
    },
    // mounted
    mounted(){
      console.log("Menu Photo");
      
    }
  };
</script> 