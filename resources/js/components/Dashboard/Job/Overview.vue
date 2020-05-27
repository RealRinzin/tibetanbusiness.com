<template>
    <div>
        <div class="row">
            <div class="col-md-12 card py-3">
                <div class="p-2">
                    <div>
                        <button class="btn btn-info btn-sm ">Basic Information</button>
                        <button class="btn btn-warning btn-sm d-flex-justify-content-end" @click="edit()">Edit</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card-body">
                            <div class="row py-1">
                                <div class="col-md-6 col-sm-4">
                                    <h6 class="text-dark">Title:</h6>
                                </div>
                                <div class="col-md-6 col-sm-8">
                                    <h6 class="text-muted">{{job.title}}</h6>
                                </div>
                            </div>
                            <div class="row py-1">
                                <div class="col-md-6 col-sm-4">
                                    <h6 class="text-dark">Organization:</h6>
                                </div>
                                <div class="col-md-6 col-sm-8">
                                    <h6 class="text-muted">{{job.organization}}</h6>
                                </div>
                            </div>
                            <div class="row py-1">
                                <div class="col-md-6 col-sm-4">
                                    <h6 class="text-dark">Salary:</h6>
                                </div>
                                <div class="col-md-6 col-sm-8">
                                    <h6 class="text-muted font-weight-bold">Rs: {{job.salary}} /-</h6>
                                </div>
                            </div>
                            <div class="row py-1">
                                <div class="col-md-6 col-sm-4">
                                    <h6 class="text-dark">Profession:</h6>
                                </div>
                                <div class="col-md-6 col-sm-8">
                                    <h6 class="text-muted">{{job.profession}}</h6>
                                </div>
                            </div>
                            <div class="row py-1">
                                <div class="col-md-6 col-sm-4">
                                    <h6 class="text-dark">Nature:</h6>
                                </div>
                                <div class="col-md-6 col-sm-8">
                                    <h6 class="text-muted">{{job.nature}}</h6>
                                </div>
                            </div>
                            <div class="row py-1">
                                <div class="col-md-6 col-sm-4">
                                    <h6 class="text-dark">Experience:</h6>
                                </div>
                                <div class="col-md-6 col-sm-8">
                                    <h6 class="text-muted">{{job.experience}}</h6>
                                </div>
                            </div>
                           <div class="row py-1">
                                    <div class="col-md-6 col-sm-4">
                                        <h6 class="text-dark">Deadline:</h6>
                                    </div>
                                    <div class="col-md-6 col-sm-8">
                                        <h6 class="text-muted">{{job.deadline}}</h6>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card-body">
                                <div class="row py-1">
                                    <div class="col-md-4 col-sm-4">
                                        <h6 class="text-dark">Location:</h6>
                                    </div>
                                    <div class="col-md-8 col-sm-8">
                                        <h6 class="text-muted">{{job.location}}</h6>
                                    </div>
                                </div>
                                <div class="row py-1">
                                    <div class="col-md-4 col-sm-4">
                                        <h6 class="text-dark">Mobile:</h6>
                                    </div>
                                    <div class="col-md-8 col-sm-8">
                                        <h6 class="text-muted">{{job.mobile_no}}</h6>
                                    </div>
                                </div>
                                <div class="row py-1">
                                    <div class="col-md-4 col-sm-4">
                                        <h6 class="text-dark">Email:</h6>
                                    </div>
                                    <div class="col-md-8 col-sm-8">
                                        <h6 class="text-muted">{{job.email}} People</h6>
                                    </div>
                                </div>
    
                                <div class="row py-1" v-if="job.website">
                                    <div class="col-md-4 col-sm-4">
                                        <h6 class="text-dark">Website:</h6>
                                    </div>
                                    <div class="col-md-8 col-sm-8">
                                        <h6 class="text-muted">{{job.website}}</h6>
                                    </div>
                                </div>
                                <div class="row py-1" v-if="job.instagram">
                                    <div class="col-md-4 col-sm-4">
                                        <h6 class="text-dark">Instagram:</h6>
                                    </div>
                                    <div class="col-md-8 col-sm-8">
                                        <h6 class="text-muted">{{job.instagram}}</h6>
                                    </div>
                                </div>
                                <div class="row py-1" v-if="job.facebook">
                                    <div class="col-md-4 col-sm-4"><h6 class="text-dark">facebook:</h6>
                                    </div>
                                    <div class="col-md-8 col-sm-8">
                                        <a :href="job.facebook" class="text-primary">
                                            <h6 class="text-muted">{{job.facebook}}</h6>
                                        </a>
                                    </div>
                                </div>
                                <div class="row py-1">
                                    <div class="col-md-4 col-sm-4">
                                        <h6 class="text-dark">Address:</h6>
                                    </div>
                                    <div class="col-md-8 col-sm-8">
                                        <h6 class="text-muted">{{job.address}}</h6>
                                    </div>
                                </div>
                                <div class="row py-1">
                                    <div class="col-md-4 col-sm-4">
                                        <h6 class="text-dark">Description:</h6>
                                    </div>
                                    <div class="col-md-8 col-sm-8">
                                        <h6 class="text-muted">{{job.description}}</h6>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<!-- Modal -->
        <div class="modal fade" id="job_overview_update_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header bg-secondary text-white">
                    <h5 class="modal-title" id="exampleModalLongTitle">Update Job</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <form @submit.prevent="update_overview(job.id)"  data-vv-scope="job_validate_update_form">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="row">
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label for="title">Title<span class="text-danger p-1">*</span></label>
                                                <input type="text" v-validate="'required|min:2|max:40'" v-model="job.title" name="title" class="form-control" id="title" aria-describedby="emailHelp" placeholder="name">
                                                <div class="valid-feedback"></div>
                                                <div v-if="errors.has('job_validate_update_form.title')" class="invalid-feedback">
                                                    <span v-for="error in errors.collect('job_validate_update_form.title')">{{ error }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label for="organization">Organization<span class="text-danger p-1">*</span></label>
                                                <input type="text" v-validate="'required|min:2|max:40'" v-model="job.organization" name="organization" class="form-control" id="organization" aria-describedby="emailHelp" placeholder="name">
                                                <div class="valid-feedback"></div>
                                                <div v-if="errors.has('job_validate_update_form.organization')" class="invalid-feedback">
                                                    <span v-for="error in errors.collect('job_validate_update_form.organization')">{{ error }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label for="salary">Salary<span class="text-danger p-1">*</span></label>
                                                <input type="text" v-validate="'required|min:2|max:40'" v-model="job.salary" name="salary" class="form-control" id="salary" aria-describedby="emailHelp" placeholder="name">
                                                <div class="valid-feedback"></div>
                                                <div v-if="errors.has('job_validate_update_form.salary')" class="invalid-feedback">
                                                    <span v-for="error in errors.collect('job_validate_update_form.salary')">{{ error }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label for="profession">Profession<span class="text-danger p-1">*</span></label>
                                                <input type="text" v-validate="'required|min:2|max:40'" v-model="job.profession" name="profession" class="form-control" id="profession" aria-describedby="emailHelp" placeholder="name">
                                                <div class="valid-feedback"></div>
                                                <div v-if="errors.has('job_validate_update_form.profession')" class="invalid-feedback">
                                                    <span v-for="error in errors.collect('job_validate_update_form.profession')">{{ error }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label for="nature">Nature<span class="text-danger p-1">*</span></label>
                                                <input type="text" v-validate="'required|min:2|max:40'" v-model="job.nature" name="nature" class="form-control" id="nature" aria-describedby="emailHelp" placeholder="name">
                                                <div class="valid-feedback"></div>
                                                <div v-if="errors.has('job_validate_update_form.nature')" class="invalid-feedback">
                                                    <span v-for="error in errors.collect('job_validate_update_form.nature')">{{ error }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label for="experience">Experience<span class="text-danger p-1">*</span></label>
                                                <input type="text" v-validate="'required|min:2|max:40'" v-model="job.experience" name="experience" class="form-control" id="experience" aria-describedby="emailHelp" placeholder="name">
                                                <div class="valid-feedback"></div>
                                                <div v-if="errors.has('job_validate_update_form.experience')" class="invalid-feedback">
                                                    <span v-for="error in errors.collect('job_validate_update_form.experience')">{{ error }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label for="deadline">Deadline<span class="text-danger p-1">*</span></label>
                                                <input type="date" v-validate="'required|min:2|max:40'" v-model="job.deadline" name="deadline" class="form-control" id="deadline" aria-describedby="emailHelp" placeholder="name">
                                                <div class="valid-feedback"></div>
                                                <div v-if="errors.has('job_validate_update_form.deadline')" class="invalid-feedback">
                                                    <span v-for="error in errors.collect('job_validate_update_form.deadline')">{{ error }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label for="location">Location<span class="text-danger p-1">*</span></label>
                                                <input type="text" v-validate="'required|min:2|max:40'" v-model="job.location" name="location" class="form-control" id="location" aria-describedby="emailHelp" placeholder="name">
                                                <div class="valid-feedback"></div>
                                                <div v-if="errors.has('job_validate_update_form.location')" class="invalid-feedback">
                                                    <span v-for="error in errors.collect('job_validate_update_form.location')">{{ error }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label for="deadline">Mobile no<span class="text-danger p-1">*</span></label>
                                                <input type="text" v-validate="'required|min:10|max:40'" v-model="job.mobile_no" name="mobile_no" class="form-control" id="mobile_no" aria-describedby="emailHelp" placeholder="name">
                                                <div class="valid-feedback"></div>
                                                <div v-if="errors.has('job_validate_update_form.mobile_no')" class="invalid-feedback">
                                                    <span v-for="error in errors.collect('job_validate_update_form.mobile_no')">{{ error }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label for="deadline">Address<span class="text-danger p-1">*</span></label>
                                                <input type="text" v-validate="'required|min:2|max:40'" v-model="job.address" name="address" class="form-control" id="address" aria-describedby="emailHelp" placeholder="name">
                                                <div class="valid-feedback"></div>
                                                <div v-if="errors.has('job_validate_update_form.address')" class="invalid-feedback">
                                                    <span v-for="error in errors.collect('job_validate_update_form.address')">{{ error }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label for="instagram">Instagram <small class="text-success">(optional)</small></label>
                                                <input type="text" v-validate="'max:50|url'" v-model="job.instagram" name="instagram" class="form-control" id="instagram" aria-describedby="emailHelp" placeholder="name">
                                                <div class="valid-feedback"></div>
                                                <div v-if="errors.has('job_validate_update_form.instagram')" class="invalid-feedback">
                                                    <span v-for="error in errors.collect('job_validate_update_form.instagram')">{{ error }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label for="facebook">Facebook <small class="text-success">(optional)</small></label>
                                                <input type="text" v-validate="'max:50|url'" v-model="job.facebook" name="facebook" class="form-control" id="facebook" aria-describedby="emailHelp" placeholder="Facebook">
                                                <div class="valid-feedback"></div>
                                                <div v-if="errors.has('job_validate_update_form.facebook')" class="invalid-feedback">
                                                    <span v-for="error in errors.collect('job_validate_update_form.facebook')">{{ error }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label for="website">Website <small class="text-success">(optional)</small></label>
                                                <input type="text" v-validate="'max:50|url'" v-model="job.website" name="website" class="form-control" id="website" aria-describedby="emailHelp" placeholder="Facebook">
                                                <div class="valid-feedback"></div>
                                                <div v-if="errors.has('job_validate_update_form.website')" class="invalid-feedback">
                                                    <span v-for="error in errors.collect('job_validate_update_form.website')">{{ error }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label for="description">Job Description <span class="text-danger p-1">*</span></label>
                                                <textarea rows="4" cols="50" v-validate="'max:150'" v-model="job.description" name="description" class="form-control" id="description" aria-describedby="emailHelp" placeholder="Description | less than 250 word" ></textarea>
                                                <div class="valid-feedback"></div>
                                                <div v-if="errors.has('job_validate_update_form.description')" class="invalid-feedback">
                                                    <span v-for="error in errors.collect('job_validate_update_form.description')">{{ error }}</span>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer d-flex justify-content-center">
                            <button type="button" class="btn btn-secondary w-25" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger btn-md w-25" placeholder="Write your comment">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props:['job'],
    data(){
        return{
            // job:{},
        }
    },
    methods:{
        // modal
        edit(){
            $("#job_overview_update_modal").modal("show");           
        },
        // Update
        update_overview(id){
                this.$validator.validateAll('job_validate_update_form').then((result) => {
                    if (result) {
                        axios.patch('/api/job/'+id,this.job,{
                            headers : { Authorization : localStorage.getItem("token")}
                        })
                        .then(response=>{
                            this.$Progress.start();
                            // Close Modal
                            $("#job_overview_update_modal").modal("hide");  
                            //  Flash Message  
                            toast.fire({
                                icon:'success',
                                title:'Updated',
                            });
                            this.$Progress.finish();

                        })
                    }
                })
        },

    },
    mounted(){
    }
}
</script>