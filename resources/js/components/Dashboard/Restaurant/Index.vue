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
                            <th scope="col" class="sm-table-info-hide">Address</th>
                            <th scope="col" class="sm-table-info-hide">Location</th>
                            <th scope="col" class="sm-table-info-hide">Email</th>
                            <th scope="col" class="sm-table-info-hide">Mobile</th>
                            <th scope="col" class="sm-table-info-hide">Added on</th>
                            <th scope="col">Status</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(restaurant,index) in restaurants">
                            <th scope="row">{{index +1}}</th>
                            <td><a v-if="restaurant.banner !==''" :href="'/restaurant/'+restaurant.id"><img :src="'/storage/Restaurant/Banner/'+restaurant.thumb" class="img-circle" alt="" style="height:50px;width:50px"></a></td>
                            <td>{{restaurant.name}}</td>
                            <td class="sm-table-info-hide">{{restaurant.address}}</td>
                            <td class="sm-table-info-hide">{{restaurant.location}}</td>
                            <td class="sm-table-info-hide">{{restaurant.email}}</td>
                            <td class="sm-table-info-hide">{{restaurant.mobile_no}}</td>
                            <td class="sm-table-info-hide"><timeago :datetime="restaurant.created_at" /></td>
                            <td>
                                <toggle-button 
                                 :value="restaurant.status"
                                @change="status_update(restaurant.id,index)"
                                :color="{checked:'#28a745',unchecked:'#dc4245'}"
                                :labels="{checked: 'Live', unchecked: 'Off'}"/>
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
                /**
                 * Reassigning
                 * Status to true and false string 
                 * insteat of  value
                 * 
                 *  */ 
                for (let index = 0; index < this.restaurants.length; index++) {
                    if(this.restaurants[index].status == 1){
                        this.restaurants[index].status = true
                    }else{
                        this.restaurants[index].status = false
                    }
                }
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
                    this.load_restaurant();
                });
        },
        /**
         * ADD
         * Restaurant
         *  */ 
        add_restaurant(){
            $("#restaurant_add_modal").modal("show");   
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