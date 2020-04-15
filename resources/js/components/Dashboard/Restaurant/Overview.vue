<template>
    <div>
        {{restaurant.operation}}

    </div>
</template>
<script>
export default {
    // Data
    props:['restaurant'],
    data(){
        return {
        }
    },
    methods:{
        load(){
        }
    },
    mounted(){
        this.load();
        
    }
}
</script>