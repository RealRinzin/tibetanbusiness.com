<template>
    <div>
        <div v-if="!loading">
            <loading :active.sync="isLoading"></loading>
        </div>
        <div class="row" v-else>
            <div class="col-md-12 mx-auto">
                <button class="btn btn-info btn-md my-3" @click="add_restaurant()">Add New Restaurant</button>
                <table class="table table-striped table-responsive">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">S.No</th>
                            <th scope="col">Banner</th>
                            <th scope="col">Name</th>
                            <th scope="col">Address</th>
                            <th scope="col">Location</th>
                            <th scope="col">Email</th>
                            <th scope="col">Mobile</th>
                            <th scope="col">Added on</th>
                            <th scope="col">Status</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(restaurant,index) in restaurants">
                            <th scope="row">{{index +1}}</th>
                            <td><a v-if="restaurant.banner !==''" :href="'/restaurant/'+restaurant.id"><img :src="'/storage/Restaurant/Banner/'+restaurant.banner" class="img-circle" alt="" style="height:50px;width:50px"></a></td>
                            <td>{{restaurant.name}}</td>
                            <td>{{restaurant.address}}</td>
                            <td>{{restaurant.location}}</td>
                            <td>{{restaurant.email}}</td>
                            <td>{{restaurant.mobile_no}}</td>
                            <td><timeago :datetime="restaurant.created_at" /></td>
                            <td>
                                <label class="switch" @click="status_update(restaurant.id,index)">
                                <input type="checkbox" v-model="restaurant.status">
                                <span class="slider round"></span>
                                </label>
                            </td>
                            <td><a  :href="'/dashboard/restaurant/edit/id='+restaurant.id" class="btn btn-sm btn-info"><i class="fas fa-pencil-alt "></i></a></td>
                            <td><button class="btn btn-sm btn-danger" @click="destory(restaurant.id,index)"><i class="fas fa-trash-alt "></i></button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <dashboard-restaurant-add @load_restaurant="load_restaurant"></dashboard-restaurant-add>
        </div>
    </div>
</template>
<script>
// Import component
import Loading from 'vue-loading-overlay';
// Import stylesheet
import 'vue-loading-overlay/dist/vue-loading.css';
export default {
    data(){
        return{
            restaurants:{}, //restaurant object
            // loading:false, //loading
            isLoading : false,//Lazy loading
            loading:false,
            status:'',

        }
    },
    methods:{
        // Load restaurants
        load_restaurant(){
            this.isLoading = true,//Lazy loading
            axios.get('/api/user/restaurants',{
                headers : { Authorization : localStorage.getItem("token")}
            }).then(response => {
                this.isLoading = false;//Lazy loading
                this.loading = true;
                // Import restaurant object
                this.restaurants = response.data;
            })
        },
        /**
         * STATUS
         * update
         *  */ 
        
        status_update(id,index){
            // Status toggle true false
            this.status =! this.restaurants[index].status;
            // Axios update
                axios({
                method: 'patch',
                url: '/api/restaurant/status_update/'+id,
                data: {status: this.status},
                headers : { Authorization : localStorage.getItem("token")}
                }).then(response=>{
                });
        },
        /**
         * ADD
         * Restaurant
         *  */ 
        add_restaurant(){
            $("#restaurant_add_modal").modal("show");  
            console.log("add");
                      
        },
        /**
         * DELETE
         * Delete the
         * Restaurant with id
         *  */ 
        destory(id,index){
            let confirmBox = confirm('Are you sure want to Delete!!!');
            if(confirmBox == true){
                axios.delete('/api/restaurant/'+id,{
                    headers : { Authorization : localStorage.getItem("token")}
                }).then(response=>{
                    this.load_restaurant();
                    //  Flash Message  
                    toast.fire({
                        icon:'success',
                        title:'Successfully Deleted',
                    });
                    this.$delete(this.restaurants,index);
                })
            }
        }
    },
    /**
     * Components
     *  */ 
    components:{Loading},
    mounted(){
        this.load_restaurant();
    }
}
</script>