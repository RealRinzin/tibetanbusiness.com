<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-md table-striped table-hover ">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">S.No</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Mobile No</th>
                    <th scope="col">CV / Resume</th>
                    <th scope="col">Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(applicant,index) in applicants">
                        <th scope="row">{{index + 1}}</th>

                        <td>{{applicant.name}}</td>
                        <td>{{applicant.email}}</td>
                        <td>{{applicant.mobile_no}}</td>
                        <td><a :href="'/storage/Job/'+applicant.document" class="btn btn-sm btn-danger"><i class="far fa-file-pdf"></i></a></td>
                        <!-- <td>{{applicant.document}}</td> -->
                        <td><timeago :datetime="applicant.created_at" /></td>
                    </tr>
                </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props:['job_id'],
    data(){
        return{
            applicants:{},
        }
    },
    methods:{
        load_applicants(){
            axios.get('/api/job_apply/'+this.job_id+'/applicant',{
                headers : { Authorization : localStorage.getItem("token")}
            })
            .then(response=>{
                this.applicants = response.data
            })
        }
    },
    mounted(){
        this.load_applicants();
    }
}
</script>