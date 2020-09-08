<template>
    <div>
        <div v-if="!loading">
            <loading :active.sync="isLoading"></loading>
        </div>
        <div class="row" v-else>
            <div class="col-md-12 mx-auto">
                <button class="btn btn-info btn-md my-3" @click="add_job()">Add New Service</button>
                <table class="table table-striped table-responsive">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">S.No</th>
                            <th scope="col">Banner</th>
                            <th scope="col">Name</th>
                            <th scope="col">Type</th>
                            <th scope="col">Location</th>
                            <th scope="col">Mobile</th>
                            <th scope="col">Status</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(service,index) in services">
                            <th scope="row">{{index +1}}</th>
                            <td><a v-if="service.banner !==''" :href="'/service/'+service.id"><img :src="'/storage/Service/Banner/'+service.thumb" class="img-circle" alt="" style="height:50px;width:50px"></a></td>
                            <td>{{service.name}}</td>
                            <td>{{service.type}}</td>
                            <td>{{service.location}}</td>
                            <td>{{service.mobile_no}}</td>
                            <td>
                                <toggle-button 
                                 :value="service.status"
                                @change="status_update(service.id,index)"
                                :color="{checked:'#28a745',unchecked:'#dc4245'}"
                                :labels="{checked: 'Live', unchecked: 'Off'}"/>
                            </td>
                            <td><a  :href="'/dashboard/service/edit/id='+service.id" class="btn btn-sm btn-info"><i class="fas fa-pencil-alt "></i></a></td>
                            <td><button class="btn btn-sm btn-danger" @click="destory(service.id,index)"><i class="fas fa-trash-alt "></i></button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <add-service @load_service="load_service"></add-service>
        </div>
    </div>
</template>
<script>
// Import component
import Loading from 'vue-loading-overlay';
// Import stylesheet
import 'vue-loading-overlay/dist/vue-loading.css';
import AddService from './AddNew.vue';
export default {
    data(){
        return{
            services:{}, //service object
            // loading:false, //loading
            isLoading : false,//Lazy loading
            loading:false,
            status:'',

        }
    },
    methods:{
        // Load services
        load_service(){
            this.isLoading = true,//Lazy loading
            axios.get('/api/user/services',{
                headers : { Authorization : localStorage.getItem("token")}
            }).then(response => {
                this.isLoading = false;//Lazy loading
                this.loading = true;
                // Import service object
                this.services = response.data;
                /**
                 * Reassigning
                 * Status to true and false string 
                 * insteat of  value 1 and 0
                 *  */ 
                for (let index = 0; index < this.services.length; index++) {
                    if(this.services[index].status == 1){
                        this.services[index].status = true
                    }else{
                        this.services[index].status = false
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
            this.status =! this.services[index].status;
            // Axios update
                axios({
                method: 'patch',
                url: '/api/service/status_update/'+id,
                data: {status: this.status},
                headers : { Authorization : localStorage.getItem("token")}
                }).then(response=>{
                });
        },
        /**
         * ADD
         * Restaurant
         *  */ 
        add_job(){
            $("#service_add_modal").modal("show");  
        },
        /**
         * DELETE
         * Delete the
         * Restaurant with id
         *  */ 
        destory(id,index){
            let confirmBox = confirm('Are you sure want to Delete!!!');
            if(confirmBox == true){
                axios.delete('/api/service/'+id,{
                    headers : { Authorization : localStorage.getItem("token")}
                }).then(response=>{
                    this.load_service();
                    //  Flash Message  
                    toast.fire({
                        icon:'success',
                        title:'Successfully Deleted',
                    });
                    this.$delete(this.services,index);
                })
            }
        }
    },
    /**
     * Components
     *  */ 
    components:{Loading,AddService},
    mounted(){
        this.load_service();
    }
}
</script>