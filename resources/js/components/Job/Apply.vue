<template>
    <div>
        <!-- Modal -->
        <div class="modal fade" id="apply_job" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Submit Document</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form @submit.prevent="apply_job()"  data-vv-scope="apply_validate_job_form">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label for="name">Name<span class="text-danger p-1">*</span></label>
                                    <input type="text" v-validate="'required|min:2|max:40'" v-model="apply.name" name="name" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Name">
                                    <div class="valid-feedback"></div>
                                    <div v-if="errors.has('apply_validate_job_form.name')" class="invalid-feedback">
                                        <span v-for="error in errors.collect('apply_validate_job_form.name')">{{ error }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label for="name">Mobile No<small class="text-success">(optional)</small></label>
                                    <input type="text" v-validate="'max:10|digits:10'" v-model="apply.mobile_no" name="mobile_no" class="form-control" id="mobile_no" aria-describedby="emailHelp" placeholder="Mobile Number">
                                    <div class="valid-feedback"></div>
                                    <div v-if="errors.has('apply_validate_job_form.mobile_no')" class="invalid-feedback">
                                        <span v-for="error in errors.collect('apply_validate_job_form.mobile_no')">{{ error }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label for="name">Email<small class="text-success">(optional)</small></label>
                                    <input type="text" v-validate="'|max:45|email'" v-model="apply.email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Email">
                                    <div class="valid-feedback"></div>
                                    <div v-if="errors.has('apply_validate_job_form.email')" class="invalid-feedback">
                                        <span v-for="error in errors.collect('apply_validate_job_form.email')">{{ error }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label for="name">CV<small class="text-danger p-1">* (must be document)</small></label>
                                    <input type="file" v-validate="'required|ext:pdf,docx,doc|size:1000'" @change="document()" name="cv" class="form-control" id="cv" aria-describedby="emailHelp" placeholder="Upload CV">
                                    <div class="valid-feedback"></div>
                                    <div v-if="errors.has('apply_validate_job_form.cv')" class="invalid-feedback">
                                        <span v-for="error in errors.collect('apply_validate_job_form.cv')">{{ error }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="button" class="btn btn-secondary w-25" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger btn-md w-25" placeholder="Write your comment">Submit</button>
                </div>
            </form>
            </div>
        </div>
        </div>
    </div>
</template>
<script>
export default {
    // Job id
    props:['job_id'],
    data(){
        return{
            apply:{},
            file:{},
            length:0,
        }
    },
    methods:{
        document(){
            let fileReader = new FileReader();
            if(event.target.files[0].size < 1000000){
                this.apply.file_name  = event.target.files[0].name
                fileReader.onload = (event) =>{
                    this.apply.cv = event.target.result;
                }
            }else{
                alert("Image size should be less than 1MB")
            }
            // base64 data
            fileReader.readAsDataURL(event.target.files[0]);
        },

        // Submit documents
        apply_job(){
            // Assign job id
            this.apply.job_basic_info_id = this.job_id;
            this.$validator.validateAll('apply_validate_job_form').then((result) => {
                if(result){
                    axios.post('/api/job_apply',this.apply,{
                    headers : { Authorization : localStorage.getItem("token")}
                    }).then(response=>{
                    console.log(response);

                    })
                }

            })
        }
    },
    mounted(){
        console.log("applications");
    }
}
</script>