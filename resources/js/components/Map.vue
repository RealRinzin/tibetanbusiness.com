<template>
    <div>
        <!-- <div id="geo-coordinator" class="card" style="width:100%;min-height:200px"></div> -->
        <div id="map-coordinator" class="card" style="width:100%;min-height:200px;z-index:10"></div>
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