<template>
    <div>
	<div id="map" style="height:200px">
    </div>
    </div>
</template>
<script>
export default {
    mounted(){
        console.log("this is good one");
        // https://atlas.mapmyindia.com/api/places/search/json?query=mcleod&client_id=Seqfg8twlRBo-3pSEMBvET4v8zcKrowBhTIaM6v9_QvyzFsDTZ1zOtItc9WmBWGBShpZmoAnspxMOXarLUeC-g==&client_secret=oGQdcwUsRjMuSIta137V70c3Vme0qoHR0UCEPkdUaiV9qNmuxO6T_f_YZDfaG-nqvzG-s9rVlwL4S41yx5DWF0TjnqSYvOJJ
        axios.get('https://atlas.mapmyindia.com/api/places/search/json?query=mcleod&client_id=Seqfg8twlRBo-3pSEMBvET4v8zcKrowBhTIaM6v9_QvyzFsDTZ1zOtItc9WmBWGBShpZmoAnspxMOXarLUeC-g==&client_secret=oGQdcwUsRjMuSIta137V70c3Vme0qoHR0UCEPkdUaiV9qNmuxO6T_f_YZDfaG-nqvzG-s9rVlwL4S41yx5DWF0TjnqSYvOJJ',{
            headers : { Authorization : 'bearer d1490890-c3d3-499b-b039-4abfc7ca07ef',
                                        "Access-Control-Allow-Origin": "*"
                    }
        })
        .then(response=>{
            console.log(response);
        })
    }
}
</script>