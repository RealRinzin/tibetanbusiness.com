<template>
    <div>
        <!-- <div id="geo-coordinator" class="card" style="width:100%;min-height:200px"></div> -->
        <div id="map-coordinator" class="card" style="width:100%;min-height:200px"></div>
    </div>
</template>
<style>
#map-coordinator .map-control{
    display: none;
}
#map-coordinator .leaflet-bottom{
    display: none;
}
</style>
<script>
export default {
    props:['longitude','latitude'],
    methods:{
        goe_map(){
            
            // // Maker
            // mapboxgl.accessToken = 'pk.eyJ1IjoicmluemluMjAyMCIsImEiOiJjazhtbWh3eG0wY3R3M2VvMjQwYjRsM2k0In0.D42dDtVsmpkG27aWZ8HTew';
            // let map_marker = new mapboxgl.Map({
            // container: 'geo-coordinator',
            // style: 'mapbox://styles/mapbox/streets-v11',
            // center: [this.longitude, this.latitude],
            // zoom: 13
            // });
            // let marker = new mapboxgl.Marker()
            // .setLngLat([this.longitude, this.latitude])
            // .addTo(map_marker);
            // // Default
            // // L.mapbox.accessToken = 'pk.eyJ1IjoicmluemluMjAyMCIsImEiOiJja2szcm1iN3ExZHRiMm9wY3Z5OWx6dnZ4In0.4TuimSiBj9l5OKTybvcrAQ';
            // // let map = L.mapbox.map('geo-coordinator')
            // // .setView([this.longitude, this.latitude], 14)
            // // .addLayer(L.mapbox.styleLayer('mapbox://styles/mapbox/streets-v11'));
            // // add marker
                    var map = new MapmyIndia.Map("map-coordinator", {
                        center: [this.latitude,this.longitude],
                        zoomControl: true,
                        hybrid: true
                    });
                    // marker
                    let marker = L.marker([this.latitude,this.longitude]).addTo(map);
                    // Add Circle
                    let circle = L.circle([this.latitude,this.longitude], {
                        color: 'red',
                        color: '#f03',
                        fillOpacity: '0.3',
                        radius: 100
                    }).addTo(map);
            }
        },
    mounted(){
    this.goe_map();
    }
}
</script>