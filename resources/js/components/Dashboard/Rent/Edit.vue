<template>
<div>
    {{rent_id}}
</div>
</template>
<script>
export default {
    props:['rent_id'],
    data(){
        return{
            id:this.rent_id['id']
        }
    },

    mounted(){
        console.log(this.id);
        
    }
}
</script>