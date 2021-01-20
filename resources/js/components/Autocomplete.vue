<template>
    <div>
  <input type="text"  class="form-control" @keyup="load_location()" v-model="word">
  <ul class="p-0">
    <li style="list-style:none;"  class="py-1 text-muted" v-for="place in places" @click="set_location(place.text)">{{place.text}}, {{place.context[0].text}}</li>
  </ul>
    </div>
</template>
<script>
export default {
  data(){
    return{
      places:{},
      word:'',
    }
  },
  methods:{
    load_location(){
      if(this.word ==''){
        this.word = '';
        this.places ={};
      }else{
        if(this.word.length > 2){
        axios.get('https://api.mapbox.com/geocoding/v5/mapbox.places/'+this.word+'.json?access_token=pk.eyJ1IjoicmluemluMjAyMCIsImEiOiJja2szcm1iN3ExZHRiMm9wY3Z5OWx6dnZ4In0.4TuimSiBj9l5OKTybvcrAQ&cachebuster=1611047895214&autocomplete=true&country=in&worldview=in&limit=10')
          .then(response=>{
            this.places =  response.data.features;
          }) 
        }
      }
    },
    // Set Location
    set_location(location){
      this.word = location;
    }
  },
    mounted(){
      // axios.get('https://api.mapbox.com/geocoding/v5/mapbox.places/dharamsala.json?access_token=pk.eyJ1IjoicmluemluMjAyMCIsImEiOiJja2szcm1iN3ExZHRiMm9wY3Z5OWx6dnZ4In0.4TuimSiBj9l5OKTybvcrAQ&cachebuster=1611047895214&autocomplete=true&country=in&worldview=in&limit=10')
      // .then(response=>{
      //   this.places =  response.data.features[0].text;
      //   console.log(response.data.features);
      // })
    }
}
</script>