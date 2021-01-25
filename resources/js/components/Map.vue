<template>
    <div>
        <!-- <div id="geo-coordinator" class="card" style="width:100%;min-height:200px"></div> -->
        <div id="geo-coordinator" class="card" style="width:100%;min-height:200px"></div>
    </div>
</template>
<script>
export default {
    props:['longitude','latitude'],
    methods:{
        goe_map(){
            // Maker
            mapboxgl.accessToken = 'pk.eyJ1IjoicmluemluMjAyMCIsImEiOiJja2szcm1iN3ExZHRiMm9wY3Z5OWx6dnZ4In0.4TuimSiBj9l5OKTybvcrAQ';
            let map_marker = new mapboxgl.Map({
            container: 'geo-coordinator',
            style: 'mapbox://styles/mapbox/streets-v11',
            center: [this.longitude, this.latitude],
            zoom: 12
            });
            let marker = new mapboxgl.Marker()
            .setLngLat([this.longitude, this.latitude])
            .addTo(map_marker);
            // Default
            // L.mapbox.accessToken = 'pk.eyJ1IjoicmluemluMjAyMCIsImEiOiJja2szcm1iN3ExZHRiMm9wY3Z5OWx6dnZ4In0.4TuimSiBj9l5OKTybvcrAQ';
            // let map = L.mapbox.map('geo-coordinator')
            // .setView([this.longitude, this.latitude], 14)
            // .addLayer(L.mapbox.styleLayer('mapbox://styles/mapbox/streets-v11'));
            // add marker
            }
        },
    mounted(){
    this.goe_map();
    }
}
</script>