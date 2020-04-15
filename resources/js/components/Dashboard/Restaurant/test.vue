<template>
<div>
  Rinzin TEst
</div>
</template>

<script>

export default {
  props:['overview'],
data() {
    return {
      restaurant:this.overview,
    };
  },
  methods:{
      // load(){
      //       axios.get('/api/restaurant/45b23840d3f646ad9b4b8754ff5f2706',{
      //           headers : { Authorization : localStorage.getItem("token")}
      //       })
      //       .then(response=>{
      //         this.restaurant = response.data.data;
              
      //       })
      //   }
  },

  mounted() {
this.load();
console.log(this.restaurant);

  }
}
</script>