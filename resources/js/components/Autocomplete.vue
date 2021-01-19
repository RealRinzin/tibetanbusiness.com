<template>
    <div>
  <input type="text" @keyup="check()" v-model="word">
  checking
  <ul>
    <li v-for="place in places">{{place.place_name}}</li>
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
    check(){
      if(this.word ==''){
        this.word = '';
        this.places ={};
      }else{
        if(this.word.length > 2){
        axios.get('https://api.mapbox.com/geocoding/v5/mapbox.places/'+this.word+'.json?access_token=pk.eyJ1IjoicmluemluMjAyMCIsImEiOiJja2szcm1iN3ExZHRiMm9wY3Z5OWx6dnZ4In0.4TuimSiBj9l5OKTybvcrAQ&cachebuster=1611047895214&autocomplete=true&country=in&worldview=in&limit=10')
          .then(response=>{
            this.places =  response.data.features;
            console.log(response.data);
          }) 
        }
  
      }
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