<template>
  <div>
    <div class="row">
      <div class="col-md-12">
        <LightGallery
          :images="images"
          :index="index"
          :disable-scroll="true"
          @close="index = null"
        />
        <ul>
          <li
            v-for="(thumb, thumbIndex) in [
              '/img/food1.jpg',
              '/img/food2.jpg',
            ]"
            :key="thumbIndex"
            @click="index = thumbIndex"
          >
            <img :src="thumb">
          </li>
        </ul>

      </div>
    </div>
  </div>
</template>
 
<script>
  import Vue from 'vue';
  import { LightGallery } from 'vue-light-gallery';
 
  export default {
    components: {
      LightGallery,
    },
    data() {
      return {
        images: [
          { title:'img 1', url: '/img/food1.jpg' },
          { title:'img 2', url: '/img/food2.jpg' },
        ],
        index: null,
      };
    },
  };
</script> 