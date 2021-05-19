<template>
    <div>
        <div v-if="!loading">
            <loading :active.sync="isLoading"></loading>
        </div>
        <div class="row" v-else>
            <div class="col-md-12 mx-auto">
                <button class="btn btn-info btn-md my-3" @click="add_job()">ADD NEW JOB</button>
                <button class="btn btn-warning btn-md my-3 mx-1" @click="add_scholarship()">ADD SCHOLARSHIP ANNOUNCEMENT</button>
                <table class="table table-striped table-responsive">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">S.No</th>
                            <th scope="col">Banner</th>
                            <th scope="col">Title</th>
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
                        <tr v-for="(job,index) in jobs">
                            <th scope="row">{{index +1}}</th>
                            <td><a v-if="job.banner !==''" :href="'/announcement/'+job.id"><img :src="'/storage/Job/Banner/'+job.thumb" class="img-circle" alt="" style="height:50px;width:50px"></a></td>
                            <td>{{job.title}}</td>
                            <td class="sm-table-info-hide">{{job.address}}</td>
                            <td class="sm-table-info-hide">{{job.location}}</td>
                            <td class="sm-table-info-hide">{{job.email}}</td>
                            <td class="sm-table-info-hide">{{job.mobile_no}}</td>
                            <td class="sm-table-info-hide"><timeago :datetime="job.created_at" /></td>
                            <td>
                                <toggle-button 
                                 :value="job.status"
                                @change="status_update(job.id,index)"
                                :color="{checked:'#28a745',unchecked:'#dc4245'}"
                                :labels="{checked: 'Live', unchecked: 'Off'}"/>
                            </td>
                            <td><a  :href="'/dashboard/announcement/edit/id='+job.id" class="btn btn-sm btn-info"><i class="fas fa-pencil-alt "></i></a></td>
                            <td><button class="btn btn-sm btn-danger" @click="destory(job.id,index)"><i class="fas fa-trash-alt "></i></button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <add-job @load_job="load_job"></add-job>
            <add-scholarship @load_job="load_job"></add-scholarship>
        </div>
    </div>
</template>
<script>
// Import component
import Loading from 'vue-loading-overlay';
// Import stylesheet
import 'vue-loading-overlay/dist/vue-loading.css';
import AddJob from './AddNew.vue';
import AddScholarship from './AddScholarship.vue';
export default {
    data(){
        return{
            jobs:{}, //job object
            // loading:false, //loading
            isLoading : false,//Lazy loading
            loading:false,
            status:'',
            countries:{},

        }
    },
    methods:{
        // Load jobs
        load_job(){
            this.isLoading = true,//Lazy loading
            axios.get('/api/user/jobs',{
                headers : { Authorization : localStorage.getItem("token")}
            }).then(response => {
                this.isLoading = false;//Lazy loading
                this.loading = true;
                // Import job object
                this.jobs = response.data;
                /**
                 * Reassigning
                 * Status to true and false string 
                 * insteat of  value 1 and 0
                 *  */ 
                for (let index = 0; index < this.jobs.length; index++) {
                    if(this.jobs[index].status == 1){
                        this.jobs[index].status = true
                    }else{
                        this.jobs[index].status = false
                    }
                }
            })
        },
        load_countries(){
        // Countries API
            axios.get('https://restcountries.eu/rest/v2/all')
            .then(response => {
                this.countries = response.data;
            })
        },
        /**
         * STATUS
         * update
         *  */ 
        
        status_update(id,index){
            // Status toggle true false
            this.status =! this.jobs[index].status;
            // Axios update
                axios({
                method: 'patch',
                url: '/api/job/status_update/'+id,
                data: {status: this.status},
                headers : { Authorization : localStorage.getItem("token")}
                }).then(response=>{
                    this.load_job();
                });
        },
        /**
         * ADD
         * Restaurant
         *  */ 
        add_job(){
            $("#job_add_modal").modal("show");  
        },
        // add scholarship
        add_scholarship(){
            $("#add_scholarship_modal").modal("show");  
        },
        /**
         * DELETE
         * Delete the
         * Restaurant with id
         *  */ 
        destory(id,index){
            let confirmBox = confirm('Are you sure want to Delete!!!');
            if(confirmBox == true){
                axios.delete('/api/job/'+id,{
                    headers : { Authorization : localStorage.getItem("token")}
                }).then(response=>{
                    this.load_job();
                    //  Flash Message  
                    toast.fire({
                        icon:'success',
                        title:'Successfully Deleted',
                    });
                    this.$delete(this.jobs,index);
                })
            }
        }
    },
    /**
     * Components
     *  */ 
    components:{Loading,AddJob,AddScholarship},
    mounted(){
        this.load_job();
        this.load_countries();
    }
}
</script>