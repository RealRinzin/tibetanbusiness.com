<template>
    <div>
    <a class="dropdown-item" @click="logout()" href="#">logout</a>

    </div>
</template>
<script>
export default {
    /**
     * Data
     *  */ 
    data(){
        return{
            is_logged:false,
        }
    },
    methods:{
        logout(){
            axios.post('/logout').then(response=>{
                location.reload();
                localStorage.removeItem('token');
            })
        }
    },
    mounted(){
    }
}
</script>