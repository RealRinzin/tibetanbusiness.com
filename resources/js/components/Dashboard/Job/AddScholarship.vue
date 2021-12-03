<template>
        <div class="modal fade add_edit_label" id="add_scholarship_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header bg-gradient-danger">
                    <h5 class="modal-title" id="exampleModalLongTitle">ADD NEW SCHOLARSHIP</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <form @submit.prevent="add_scholarship()"  data-vv-scope="scholarship_validate_add_form">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div v-if="bannerPreview" class="col-md-12" style="background-size: cover;height: 220px;background-position: center;" v-bind:style='{ backgroundImage: `url(${bannerPreview})`}'>
                                </div>
                                <div class="mt-1"><vue-progress-bar></vue-progress-bar></div>
                                <div class="row">
                                    <div class="col-md-4 col-sm-6">
                                        <div class="form-group">
                                            <label for="title">Name<span class="text-danger p-1">*</span></label>
                                            <input type="text" v-validate="'required|min:2|max:100'" v-model="scholarship.title" name="name" class="form-control" id="name" aria-describedby="emailHelp" placeholder="scholarship Name">
                                            <div class="valid-feedback"></div>
                                            <div v-if="errors.has('scholarship_validate_add_form.name')" class="invalid-feedback">
                                                <span v-for="error in errors.collect('scholarship_validate_add_form.name')">{{ error }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- course name -->
                                    <div class="col-md-4 col-sm-6">
                                        <div class="form-group">
                                            <label for="title">Course Name<span class="text-danger p-1">*</span></label>
                                            <input type="text" v-validate="'required|min:2|max:100'" v-model="scholarship.course_name" name="course_name" class="form-control" id="course_name" aria-describedby="emailHelp" placeholder="Course Name">
                                            <div class="valid-feedback"></div>
                                            <div v-if="errors.has('scholarship_validate_add_form.course_name')" class="invalid-feedback">
                                                <span v-for="error in errors.collect('scholarship_validate_add_form.course_name')">{{ error }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Degree -->
                                    <div class="col-md-4 col-sm-6">
                                        <div class="form-group">
                                            <label for="experience">Degree<span class="text-danger p-1">*</span></label>
                                            <select v-validate="'required'" v-model="scholarship.degree" name="degree" class="form-control" id="degree">
                                                <option value="" disabled selected>degree</option>
                                                <option value="Not Specified"> Not Specified</option>
                                                <option>Crossponding Course</option>
                                                <option>Under Graduate Degree</option>
                                                <option>Graduate Degree</option>
                                                <option>M.Phil</option>
                                                <option>PhD</option>
                                                <option>Doctorate</option>
                                            </select>
                                            <div class="valid-feedback"></div>
                                            <div v-if="errors.has('scholarship_validate_add_form.degree')" class="invalid-feedback">
                                                <span v-for="error in errors.collect('scholarship_validate_add_form.degree')">{{ error }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Duration -->
                                    <div class="col-md-4 col-sm-6">
                                        <div class="form-group">
                                            <label for="experience">Duration<span class="text-danger p-1">*</span></label>
                                            <select v-validate="'required'" v-model="scholarship.duration" name="duration" class="form-control" id="duration">
                                                <option value="" disabled selected>Duration</option>
                                                <option value="Not Specified"> Not Specified</option>
                                                <option value="6 Months"> 6 Months</option>
                                                <option value="1 Yrs"> 1 Years</option>
                                                <option value="2 Yrs"> 2 Years</option>
                                                <option value="3 Yrs"> 3 Years</option>
                                                <option value="4 Yrs"> 4 Years</option>
                                                <option value="5 Yrs"> 5 Years</option>
                                            </select>
                                            <div class="valid-feedback"></div>
                                            <div v-if="errors.has('scholarship_validate_add_form.duration')" class="invalid-feedback">
                                                <span v-for="error in errors.collect('scholarship_validate_add_form.duration')">{{ error }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Deadline -->
                                    <div class="col-md-4 col-sm-6">
                                        <div class="form-group">
                                            <label for="deadline">Application Deadline<span class="text-danger p-1">*</span></label>
                                            <input type="date" v-validate="'required'" v-model="scholarship.deadline" name="application_deadline" class="form-control" id="application_deadline" aria-describedby="emailHelp" placeholder="Application Deadline">
                                            <div class="valid-feedback"></div>
                                            <div v-if="errors.has('scholarship_validate_add_form.application_deadline')" class="invalid-feedback">
                                                <span v-for="error in errors.collect('scholarship_validate_add_form.application_deadline')">{{ error }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <!--  Country-->
                                    <div class="col-md-4 col-sm-6">
                                        <div class="form-group">
                                            <label for="experience">Country<span class="text-danger p-1">*</span></label>
                                            <select v-validate="'required'" v-model="scholarship.country"  name="country" class="form-control" id="country">
                                                <option value="" disabled selected>Country</option>
                                                <option v-for="(country,index) in countries">{{country.name}}</option>
                                            </select>
                                            <div class="valid-feedback"></div>
                                            <div v-if="errors.has('scholarship_validate_add_form.country')" class="invalid-feedback">
                                                <span v-for="error in errors.collect('scholarship_validate_add_form.country')">{{ error }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Email -->
                                    <div class="col-md-4 col-sm-6">
                                        <div class="form-group">
                                            <label for="deadline">Email<span class="text-danger p-1">*</span></label>
                                            <input type="text" v-validate="'required|min:10|max:100'" v-model="scholarship.email" name="email" class="form-control" id="s_email" aria-describedby="emailHelp" placeholder="Email">
                                            <div class="valid-feedback"></div>
                                            <div v-if="errors.has('scholarship_validate_add_form.email')" class="invalid-feedback">
                                                <span v-for="error in errors.collect('scholarship_validate_add_form.email')">{{ error }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Mobile No -->
                                    <div class="col-md-4 col-sm-6">
                                        <div class="form-group">
                                            <label for="mobile_no">Mobile no<small class="text-success p-1">(Optional)</small></label>
                                            <input type="text" v-validate="'numeric|max:10|min:10'" v-model="scholarship.mobile_no" name="mobile_no" class="form-control" id="s_mobile_no" aria-describedby="emailHelp" placeholder="Mobile No">
                                            <div class="valid-feedback"></div>
                                            <div v-if="errors.has('job_validate_add_form.mobile_no')" class="invalid-feedback">
                                                <span v-for="error in errors.collect('job_validate_add_form.mobile_no')">{{ error }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- BANNER -->
                                    <div class="col-md-4 col-sm-6">
                                        <div class="form-group">
                                            <label for="banner">Banner Image <span class="text-danger p-1">*</span><span class="small text-danger">(Less than 1MB)</span></label>
                                            <div class="custom-file">
                                            <label class="custom-file-label" for="banner">Choose file</label>
                                                <input type="file" v-validate="'required|image|ext:jpeg,jpg,png,gif|size:1000'" name="s_banner" @change="avatar" class="custom-file-input" id="s_banner" aria-describedby="emailHelp" placeholder="Website Address">
                                                <div class="valid-feedback"></div>
                                                <div v-if="errors.has('job_validate_add_form.s_banner')" class="invalid-feedback">
                                                    <span v-for="error in errors.collect('job_validate_add_form.s_banner')">{{ error }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Optionals -->
                                    <div class="col-12">
                                    <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#collapse_scholarshipp" aria-expanded="false" aria-controls="collapseExample">Optional Fields</button> <span class="text-danger small font-weight-bolder">You can fill the additional fields</span>
                                    </div>
                                    <div class="collapse" id="collapse_scholarshipp">
                                        <div class="row p-1">
                                            <div class="col-md-3 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="instagram">Instagram <small class="text-success">(optional)</small></label>
                                                        <input type="text" v-validate="'url'" v-model="scholarship.instagram" name="instagram" class="form-control" id="s_instagram" aria-describedby="emailHelp" placeholder="Instagram">
                                                        <div class="valid-feedback"></div>
                                                        <div v-if="errors.has('job_validate_add_form.instagram')" class="invalid-feedback">
                                                            <span v-for="error in errors.collect('job_validate_add_form.instagram')">{{ error }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="facebook">Facebook <small class="text-success">(optional)</small></label>
                                                        <input type="text" v-validate="'url'" v-model="scholarship.facebook" name="facebook" class="form-control" id="s_facebook" aria-describedby="emailHelp" placeholder="Facebook">
                                                        <div class="valid-feedback"></div>
                                                        <div v-if="errors.has('job_validate_add_form.facebook')" class="invalid-feedback">
                                                            <span v-for="error in errors.collect('job_validate_add_form.facebook')">{{ error }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="website">Website <small class="text-success">(optional)</small></label>
                                                        <input type="text" v-validate="'url'" v-model="scholarship.website" name="website" class="form-control" id="s_website" aria-describedby="emailHelp" placeholder="Facebook">
                                                        <div class="valid-feedback"></div>
                                                        <div v-if="errors.has('job_validate_add_form.website')" class="invalid-feedback">
                                                            <span v-for="error in errors.collect('job_validate_add_form.website')">{{ error }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="deadline">Address<small class="text-success p-1">(Optional)</small></label>
                                                        <textarea rows="5" cols="50" v-validate="'min:2|max:255'" v-model="scholarship.address" name="address" class="form-control" id="s_address" aria-describedby="emailHelp" placeholder="Address"></textarea>
                                                        <div class="valid-feedback"></div>
                                                        <div v-if="errors.has('job_validate_add_form.address')" class="invalid-feedback">
                                                            <span v-for="error in errors.collect('job_validate_add_form.address')">{{ error }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="description">Scholarship Description<small class="text-success p-1">(Optional)</small></label>
                                                        <textarea rows="5" cols="50" v-validate="'max:15000'" v-model="scholarship.description" name="description" class="form-control" id="s_description" aria-describedby="emailHelp" placeholder="Scholarship Descriptions" ></textarea>
                                                        <div class="valid-feedback"></div>
                                                        <div v-if="errors.has('job_validate_add_form.description')" class="invalid-feedback">
                                                            <span v-for="error in errors.collect('job_validate_add_form.description')">{{ error }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer d-flex justify-content-center">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
                            <button type="submit" class="btn btn-danger btn-md" placeholder="Write your comment">ADD</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</template>
<script>
import Document from '../../Job/Apply.vue';
export default {
    props:['load_job'],
    data(){
        return{
            // banner
            bannerPreview:'',
            scholarship:{
                'types':'2',
                'salary':0,
                'organization':'NULL',
                'profession':'NULL',
                'experience':'NULL',
                'nature':'NULL',
                'location' : 'NULL',
            },
            countries:{}, //Countries object
        }
    },
    // Methods
    methods:{
        add_scholarship(){
            // Setting the Longitude and Latitude
            this.$validator.validateAll('scholarship_validate_add_form').then((result) => {
                // Validations
                if(result){
                this.$Progress.start()
                    axios.post('/api/job',this.scholarship,{
                    headers : { Authorization : localStorage.getItem("token")}
                    })
                    .then(response=>{
                        // closing modal
                            $("#add_scholarship_modal").modal("hide");  
                            //  Flash Message  
                            toast.fire({
                                icon:'success',
                                title:'Updated',
                            });
                            // location.reload();
                            this.$emit('load_job');
                            // Progress
                        this.$Progress.finish()
                    })
                }
            })
        },
        // Country Detail
       /**
         * Banner Image 
         * File
         *  */ 
        avatar(event){
            let fileReader = new FileReader();
            if(event.target.files[0].size < 1000000){
                fileReader.onload = (event) =>{
                    this.bannerPreview = event.target.result
                    this.scholarship.banner = event.target.result
                }
                
            }else{
                alert("Image size should be less than 1MB")
            }
            // base64 data
            fileReader.readAsDataURL(event.target.files[0]);
        },
    },
    components:{Document},
    mounted(){
        // Countries API
            axios.get('https://restcountries.eu/rest/v2/all')
            .then(response => {
                this.countries = response.data;
            })
    }
}
</script>