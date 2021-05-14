<template>
    <div>

        <div v-if="!loading">
            <loading :active.sync="isLoading"></loading>
        </div>
        <div class="row" v-else>
            <div class="col-md-12 mx-auto">
                <button class="btn btn-info btn-md my-3" @click="add_rent()">Add New Rent</button>
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
                        <tr v-for="(rent,index) in rents">
                            <th scope="row">{{index +1}}</th>
                            <td><a v-if="rent.banner !==''" :href="'/rent/'+rent.id"><img :src="'/storage/Rent/Banner/'+rent.thumb" class="img-circle" alt="" style="height:50px;width:50px"></a></td>
                            <td>{{rent.name}}</td>
                            <td class="sm-table-info-hide">{{rent.address}}</td>
                            <td class="sm-table-info-hide">{{rent.location}}</td>
                            <td class="sm-table-info-hide">{{rent.email}}</td>
                            <td class="sm-table-info-hide">{{rent.mobile_no}}</td>
                            <td class="sm-table-info-hide"><timeago :datetime="rent.created_at" /></td>
                            <td>
                                <toggle-button 
                                 :value="rent.status"
                                @change="status_update(rent.id,index)"
                                :color="{checked:'#28a745',unchecked:'#dc4245'}"
                                :labels="{checked: 'Live', unchecked: 'Off'}"/>
                            </td>
                            <td><a  :href="'/dashboard/rent/edit/id='+rent.id" class="btn btn-sm btn-info"><i class="fas fa-pencil-alt "></i></a></td>
                            <td><button class="btn btn-sm btn-danger" @click="destory(rent.id,index)"><i class="fas fa-trash-alt "></i></button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <dashboard-rent-add @load_rent="load_rent"></dashboard-rent-add>
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
            rents:{}, //rent object
            // loading:false, //loading
            isLoading : false,//Lazy loading
            loading:false,
            status:'',

        }
    },
    methods:{
        // Load rents
        load_rent(){
            this.isLoading = true,//Lazy loading
            axios.get('/api/user/rents',{
                headers : { Authorization : localStorage.getItem("token")}
            }).then(response => {
                this.isLoading = false;//Lazy loading
                this.loading = true;
                // Import rent object
                this.rents = response.data;
                /**
                 * Reassigning
                 * Status to true and false string 
                 * insteat of  value 1 and 0
                 *  */ 
                for (let index = 0; index < this.rents.length; index++) {
                    if(this.rents[index].status == 1){
                        this.rents[index].status = true
                    }else{
                        this.rents[index].status = false
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
            this.status =! this.rents[index].status;
            // Axios update
                axios({
                method: 'patch',
                url: '/api/rent/status_update/'+id,
                data: {status: this.status},
                headers : { Authorization : localStorage.getItem("token")}
                }).then(response=>{
                    this.load_rent();
                });
        },
        /**
         * ADD
         * Restaurant
         *  */ 
        add_rent(){
            $("#rent_add_modal").modal("show");  
        },
        /**
         * DELETE
         * Delete the
         * Restaurant with id
         *  */ 
        destory(id,index){
            let confirmBox = confirm('Are you sure want to Delete!!!');
            if(confirmBox == true){
                axios.delete('/api/rent/'+id,{
                    headers : { Authorization : localStorage.getItem("token")}
                }).then(response=>{
                    this.load_rent();
                    //  Flash Message  
                    toast.fire({
                        icon:'success',
                        title:'Successfully Deleted',
                    });
                    this.$delete(this.rents,index);
                })
            }
        }
    },
    /**
     * Components
     *  */ 
    components:{Loading},
    mounted(){
        this.load_rent();
    }
}
</script>