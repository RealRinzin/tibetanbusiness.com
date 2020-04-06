<template>
    <div>
        <div class="card" id="googleMap" style="width:100%;height:200px;"></div>
    </div>
</template>
<script>
export default {
    props:['longitude','latitude'],
    methods:{
        location_map(){
            const mapProp= {
                center:new google.maps.LatLng(this.latitude,this.longitude),
                zoom:8,
                };
            const map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
            }
        },
    mounted(){
        this.location_map();
        }
}
</script>