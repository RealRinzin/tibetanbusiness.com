<template>
    <div>
        <div id="map" class="card" style="width:100%;height:200px;"></div>
    </div>
</template>
<script>
export default {
    props:['longitude','latitude'],
    methods:{
        geo_map(){
            L.mapbox.accessToken = 'pk.eyJ1IjoicmluemluMjAyMCIsImEiOiJja2szcm1iN3ExZHRiMm9wY3Z5OWx6dnZ4In0.4TuimSiBj9l5OKTybvcrAQ';
            let map = L.mapbox.map('map')
            .setView([this.longitude, this.latitude], 18)
            .addLayer(L.mapbox.styleLayer('mapbox://styles/mapbox/streets-v11'));
            }
        },
    mounted(){
    this.geo_map();
    }
}
</script>