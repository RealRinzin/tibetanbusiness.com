<template>
    <div>
        Menu Photos
    </div>
</template>
<script>
export default {
    props:['menu_photo'],
    data () {
    return {
        counter :this.menu_photo
        }
    },
    mounted(){
        console.log(this.counter);
        
        // this.load();
    }
}
</script>