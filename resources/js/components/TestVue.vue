<template>
<div >
      <div v-if="commentIndex < reviews.length" v-for="(commentIndex,index) in commentsToShow" > 
    <div style="transition-delay:2s;transation-duration:2s">{{reviews[commentIndex].name}} says:</div>
    <i><div>{{reviews[commentIndex].id}}</div></i>
    <hr />
  </div>
  <div v-if="commentsToShow < reviews.length || reviews.length > commentsToShow">
    <button @click="commentsToShow += 3">show more reviews</button>
  </div>
</div>
</template>
<script>
export default {
data() {
    return {
        reviews:{},
      commentsToShow: 3,
      totalComments: 0
    };
  },
  methods:{
      load(){
          axios.get('/api/restaurant/1f3f951d64034e72a2936dae30f3f6e2').then(response=>{
              this.reviews = response.data.data.comments;
                this.totalComments = this.reviews.length;
                console.log(this.reviews.length)
          })
      }
  },
  mounted() {
this.load();
  }
}
</script>