<template>
    <div>
        <div v-if="!loading">
            <loading :active.sync="isLoading"></loading>
        </div>
        <div class="row" v-else>
            <div class="col-md-12 mx-auto">
                <button class="btn btn-info btn-md my-3" @click="add_sale()">Add New Sale</button>
                <table class="table table-striped table-responsive">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">S.No</th>
                            <th scope="col">Banner</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Total Item</th>
                            <th scope="col">Location</th>
                            <th scope="col">Mobile</th>
                            <th scope="col">Status</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(sale,index) in sales">
                            <th scope="row">{{index +1}}</th>
                            <td><a v-if="sale.banner" :href="'/sale/'+sale.id"><img :src="'/storage/Sale/Banner/'+sale.banner" class="img-circle" alt="" style="height:50px;width:50px"></a></td>
                            <td>{{sale.name}}</td>
                            <td>Rs: {{sale.price}}</td>
                            <td>{{sale.total_item}}</td>
                            <td>{{sale.location}}</td>
                            <td>{{sale.mobile_no}}</td>
                            <td>
                                <label class="switch" @click="status_update(sale.id,index)">
                                <input type="checkbox" v-model="sale.status">
                                <span class="slider round"></span>
                                </label>
                            </td>
                            <td><a  :href="'/dashboard/sale/edit/id='+sale.id" class="btn btn-sm btn-info"><i class="fas fa-pencil-alt "></i></a></td>
                            <td><button class="btn btn-sm btn-danger" @click="destory(sale.id,index)"><i class="fas fa-trash-alt "></i></button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <add-sale @load_sale="load_sale"></add-sale>
        </div>
    </div>
</template>
<script>
// Import component
import Loading from 'vue-loading-overlay';
// Import stylesheet
import 'vue-loading-overlay/dist/vue-loading.css';
import AddSale from './AddNew.vue';
export default {
    data(){
        return{
            sales:{}, //sale object
            // loading:false, //loading
            isLoading : false,//Lazy loading
            loading:false,
            status:'',

        }
    },
    methods:{
        // Load sales
        load_sale(){
            this.isLoading = true,//Lazy loading
            axios.get('/api/user/sales',{
                headers : { Authorization : localStorage.getItem("token")}
            }).then(response => {
                this.isLoading = false;//Lazy loading
                this.loading = true;
                // Import sale object
                this.sales = response.data;
            })
        },
        /**
         * STATUS
         * update
         *  */ 
        
        status_update(id,index){
            // Status toggle true false
            this.status =! this.sales[index].status;
            // Axios update
                axios({
                method: 'patch',
                url: '/api/sale/status_update/'+id,
                data: {status: this.status},
                headers : { Authorization : localStorage.getItem("token")}
                }).then(response=>{
                });
        },
        /**
         * ADD
         * Restaurant
         *  */ 
        add_sale(){
            $("#sale_add_modal").modal("show");  
        },
        /**
         * DELETE
         * Delete the
         * Restaurant with id
         *  */ 
        destory(id,index){
            let confirmBox = confirm('Are you sure want to Delete!!!');
            if(confirmBox == true){
                axios.delete('/api/sale/'+id,{
                    headers : { Authorization : localStorage.getItem("token")}
                }).then(response=>{
                    this.load_sale();
                    //  Flash Message  
                    toast.fire({
                        icon:'success',
                        title:'Successfully Deleted',
                    });
                    this.$delete(this.sales,index);
                })
            }
        }
    },
    /**
     * Components
     *  */ 
    components:{Loading,AddSale},
    mounted(){
        this.load_sale();
    }
}
</script>