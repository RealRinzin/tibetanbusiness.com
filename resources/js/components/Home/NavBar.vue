<template>
    <div>
    <a class="dropdown-item" href="/dashboard">Dashboard</a>
    <a class="dropdown-item" @click="logout()" v-bind:href="logout">logout</a>
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
                // Remove Token
                localStorage.removeItem('token');
                // Remove User Object
                localStorage.removeItem('user_name');
                localStorage.removeItem('user_avatar');
            })
        }
    },
    mounted(){
    }
}
</script>