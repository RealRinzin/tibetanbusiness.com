<template>
    <div>
        Menu Photos
    </div>
</template>
<script>
export default {
    props:['overview'],
    data () {
    return {
        counter :this.overview
        }
    },
    mounted(){
        console.log(this.counter);
        
        // this.load();
    }
}
</script>