<template>
    <div>
        <div v-if="!loading">
            <loading :active.sync="isLoading"></loading>
        </div>
        <div class="row" v-else>
            <div class="col-md-12 mx-auto">
                <button class="btn btn-info btn-md my-3" @click="add_job()">Add New Event</button>
                <table class="table table-striped table-responsive">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">S.No</th>
                            <th scope="col">Banner</th>
                            <th scope="col">Name</th>
                            <th scope="col" class="sm-table-info-hide">Entry Fee</th>
                            <th scope="col" class="sm-table-info-hide">Date</th>
                            <th scope="col" class="sm-table-info-hide">Time</th>
                            <th scope="col" class="sm-table-info-hide">Location</th>
                            <th scope="col" class="sm-table-info-hide">Mobile</th>
                            <th scope="col">Status</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(event,index) in events">
                            <th scope="row">{{index +1}}</th>
                            <td><a v-if="event.banner !==''" :href="'/event/'+event.id"><img :src="'/storage/Event/Banner/'+event.thumb" class="img-circle" alt="" style="height:50px;width:50px"></a></td>
                            <td>{{event.name}}</td>
                            <td class="sm-table-info-hide"> <span v-if="event.entry_fee > 0">Rs: {{event.entry_fee}}</span> <span v-else class="text-success font-weight-bolder">Entry Free</span></td>
                            <td class="sm-table-info-hide">{{event.start_date}}</td>
                            <td class="sm-table-info-hide">{{event.start_time}}<span v-if="event.start_time"> a.m</span></td>
                            <td class="sm-table-info-hide">{{event.location}}</td>
                            <td class="sm-table-info-hide">{{event.mobile_no}}</td>
                            <td>
                                <toggle-button 
                                 :value="event.status"
                                @change="status_update(event.id,index)"
                                :color="{checked:'#28a745',unchecked:'#dc4245'}"
                                :labels="{checked: 'Live', unchecked: 'Off'}"/>
                            </td>
                            <td><a  :href="'/dashboard/event/edit/id='+event.id" class="btn btn-sm btn-info"><i class="fas fa-pencil-alt "></i></a></td>
                            <td><button class="btn btn-sm btn-danger" @click="destory(event.id,index)"><i class="fas fa-trash-alt "></i></button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <add-event @load_event="load_event"></add-event>
        </div>
    </div>
</template>
<script>
// Import component
import Loading from 'vue-loading-overlay';
// Import stylesheet
import 'vue-loading-overlay/dist/vue-loading.css';
import AddEvent from './AddNew.vue';
export default {
    data(){
        return{
            events:{}, //event object
            // loading:false, //loading
            isLoading : false,//Lazy loading
            loading:false,
            status:'',

        }
    },
    methods:{
        // Load events
        load_event(){
            this.isLoading = true,//Lazy loading
            axios.get('/api/user/events',{
                headers : { Authorization : localStorage.getItem("token")}
            }).then(response => {
                this.isLoading = false;//Lazy loading
                this.loading = true;
                // Import event object
                this.events = response.data;
                /**
                 * Reassigning
                 * Status to true and false string 
                 * insteat of  value 1 and 0
                 *  */ 
                for (let index = 0; index < this.events.length; index++) {
                    if(this.events[index].status == 1){
                        this.events[index].status = true
                    }else{
                        this.events[index].status = false
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
            this.status =! this.events[index].status;
            // Axios update
                axios({
                method: 'patch',
                url: '/api/event/status_update/'+id,
                data: {status: this.status},
                headers : { Authorization : localStorage.getItem("token")}
                }).then(response=>{
                    this.load_event();
                });
        },
        /**
         * ADD
         * Restaurant
         *  */ 
        add_job(){
            $("#event_add_modal").modal("show");  
        },
        /**
         * DELETE
         * Delete the
         * Restaurant with id
         *  */ 
        destory(id,index){
            let confirmBox = confirm('Are you sure want to Delete!!!');
            if(confirmBox == true){
                axios.delete('/api/event/'+id,{
                    headers : { Authorization : localStorage.getItem("token")}
                }).then(response=>{
                    this.load_event();
                    //  Flash Message  
                    toast.fire({
                        icon:'success',
                        title:'Successfully Deleted',
                    });
                    this.$delete(this.events,index);
                })
            }
        }
    },
    /**
     * Components
     *  */ 
    components:{Loading,AddEvent},
    mounted(){
        this.load_event();
    }
}
</script>