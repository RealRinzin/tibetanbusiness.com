<template>
    <div>
        <div class="modal fade add_edit_label" id="job_add_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header bg-gradient-danger">
                    <h5 class="modal-title" id="exampleModalLongTitle">ADD NEW JOB</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <form @submit.prevent="add_job()"  data-vv-scope="job_validate_add_form">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div v-if="bannerPreview" class="col-md-12" style="background-size: cover;height: 220px;background-position: center;" v-bind:style='{ backgroundImage: `url(${bannerPreview})`}'>
                                </div>
                                <div class="mt-1"><vue-progress-bar></vue-progress-bar></div>
                                <div class="row">
                                    <div class="col-md-4 col-sm-6">
                                        <div class="form-group">
                                            <label for="title">Title<span class="text-danger p-1">*</span></label>
                                            <input type="text" v-validate="'required|min:2|max:100'" v-model="job.title" name="title" class="form-control" id="title" aria-describedby="emailHelp" placeholder="Job Title">
                                            <div class="valid-feedback"></div>
                                            <div v-if="errors.has('job_validate_add_form.title')" class="invalid-feedback">
                                                <span v-for="error in errors.collect('job_validate_add_form.title')">{{ error }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <div class="form-group">
                                            <label for="organization">Organization<span class="text-danger p-1">*</span></label>
                                            <input type="text" v-validate="'required|min:2|max:100'" v-model="job.organization" name="organization" class="form-control" id="organization" aria-describedby="emailHelp" placeholder="Organization">
                                            <div class="valid-feedback"></div>
                                            <div v-if="errors.has('job_validate_add_form.organization')" class="invalid-feedback">
                                                <span v-for="error in errors.collect('job_validate_add_form.organization')">{{ error }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <div class="form-group">
                                            <label for="deadline">Email<span class="text-danger p-1">*</span></label>
                                            <input type="text" v-validate="'required|min:10|max:100'" v-model="job.email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Email">
                                            <div class="valid-feedback"></div>
                                            <div v-if="errors.has('job_validate_add_form.email')" class="invalid-feedback">
                                                <span v-for="error in errors.collect('job_validate_add_form.email')">{{ error }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6">
                                        <div class="form-group">
                                            <label for="profession">Profession<span class="text-danger p-1">*</span></label>
                                            <select v-validate="'required'" v-model="job.profession" name="profession" class="form-control" id="profession" placeholder="Selected Profession">
                                                <option value="" disabled selected>Select Profession</option>
                                                <option v-for="profession in professions" :value="profession.name">{{profession.name}}</option>
                                            </select>
                                            <div class="valid-feedback"></div>
                                            <div v-if="errors.has('job_validate_add_form.profession')" class="invalid-feedback">
                                                <span v-for="error in errors.collect('job_validate_add_form.profession')">{{ error }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6">
                                        <div class="form-group">
                                            <label for="nature">Nature<span class="text-danger p-1">*</span></label>
                                            <select v-validate="'required'" v-model="job.nature" name="nature" class="form-control" id="nature">
                                                <option value="" disabled selected>Select Nature</option>
                                                <option value="Full Time"> Full Time</option>
                                                <option value="Part Time"> Part Time</option>
                                                <option value="Contract"> Contract</option>
                                                <option value="Internship"> Internship</option>
                                            </select>
                                            <div class="valid-feedback"></div>
                                            <div v-if="errors.has('job_validate_add_form.nature')" class="invalid-feedback">
                                                <span v-for="error in errors.collect('job_validate_add_form.nature')">{{ error }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6">
                                        <div class="form-group">
                                            <label for="location">Location<span class="text-danger p-1">*</span></label>
                                            <input type="text" autocomplete="off" name="location"  v-validate="'required'" @keyup="load_location()"  v-model="job.location" class="rounded form-control "  placeholder="Location" aria-label="Location">
                                            <ul class="w-100 pl-0" style="position: absolute;z-index:100">
                                                <li style="list-style:none;cursor:pointer"  class="py-2 text-dark border-bottom bg-light" v-for="(place,index) in places" @click="set_location(place.text,place.context[0].text,index)"><i class="fas fa-map-marker mx-2 text-muted"></i> {{place.text}}, {{place.context[0].text}}</li>
                                            </ul>
                                            <div class="valid-feedback"></div>
                                            <div v-if="errors.has('job_validate_add_form.location')" class="invalid-feedback">
                                                <span v-for="error in errors.collect('job_validate_add_form.location')">{{ error }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6">
                                        <div class="form-group">
                                            <label for="experience">Experience<span class="text-danger p-1">*</span></label>
                                            <select v-validate="'required'" v-model="job.experience" name="experience" class="form-control" id="experience">
                                                <option value="" disabled selected>Select Experience</option>
                                                <option value="Not Required"> Not Required</option>
                                                <option value="6 Months"> 6 Months</option>
                                                <option value="1 Yrs"> 1 Years</option>
                                                <option value="2 Yrs"> 2 Years</option>
                                                <option value="3 Yrs"> 3 Years</option>
                                                <option value="4 Yrs"> 4 Years</option>
                                                <option value="5 Yrs"> 5 Years</option>
                                                <option value="6 Yrs above"> 6 Years Above</option>
                                            </select>
                                            <div class="valid-feedback"></div>
                                            <div v-if="errors.has('job_validate_add_form.experience')" class="invalid-feedback">
                                                <span v-for="error in errors.collect('job_validate_add_form.experience')">{{ error }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <div class="row">
                                            <div class="col-6" v-show="status">
                                                <div class="form-group">
                                                    <label for="salary">Salary<span class="text-danger p-1">*</span></label>
                                                    <input type="text" v-validate="'required|decimal:2|max:10'" v-model="job.salary" name="salary" class="form-control" id="salary" aria-describedby="emailHelp" placeholder="Salary">
                                                    <div class="valid-feedback"></div>
                                                    <div v-if="errors.has('job_validate_add_form.salary')" class="invalid-feedback">
                                                        <span v-for="error in errors.collect('job_validate_add_form.salary')">{{ error }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <form class="was-validated pt-4">
                                                    <div class="custom-control custom-checkbox pt-3">
                                                        <input type="checkbox" class="custom-control-input" id="entry_free"  @change="salary_disclose(status)">
                                                        <label class="custom-control-label text-muted" for="entry_free">Not Disclose</label>
                                                        <div class="invalid-feedback"></div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6">
                                        <div class="form-group">
                                            <label for="deadline">Deadline<span class="text-danger p-1">*</span></label>
                                            <input type="date" v-validate="'required|'" v-model="job.deadline" name="deadline" class="form-control" id="deadline" aria-describedby="emailHelp" placeholder="Deadline">
                                            <div class="valid-feedback"></div>
                                            <div v-if="errors.has('job_validate_add_form.deadline')" class="invalid-feedback">
                                                <span v-for="error in errors.collect('job_validate_add_form.deadline')">{{ error }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6">
                                        <div class="form-group">
                                            <label for="banner">Banner Image <span class="text-danger p-1">*</span><span class="small text-danger">(Less than 1MB)</span></label>
                                            <div class="custom-file">
                                            <label class="custom-file-label" for="banner">Choose file</label>
                                                <input type="file" v-validate="'required|image|ext:jpeg,jpg,png,gif|size:1000'" name="banner" @change="avatar" class="custom-file-input" id="banner" aria-describedby="emailHelp" placeholder="Website Address">
                                                <div class="valid-feedback"></div>
                                                <div v-if="errors.has('job_validate_add_form.banner')" class="invalid-feedback">
                                                    <span v-for="error in errors.collect('job_validate_add_form.banner')">{{ error }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                    <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Optional Fields</button> <span class="text-danger small font-weight-bolder">You can fill the additional fields</span>
                                    </div>
                                    <div class="collapse" id="collapseExample">
                                        <div class="row p-1">
                                            <div class="col-md-3 col-sm-6">
                                                <div class="form-group">
                                                    <label for="deadline">Mobile no<small class="text-success p-1">(Optional)</small></label>
                                                    <input type="text" v-validate="'numeric|max:10|min:10'" v-model="job.mobile_no" name="mobile_no" class="form-control" id="mobile_no" aria-describedby="emailHelp" placeholder="Mobile No">
                                                    <div class="valid-feedback"></div>
                                                    <div v-if="errors.has('job_validate_add_form.mobile_no')" class="invalid-feedback">
                                                        <span v-for="error in errors.collect('job_validate_add_form.mobile_no')">{{ error }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="instagram">Instagram <small class="text-success">(optional)</small></label>
                                                        <input type="text" v-validate="'max:50|url'" v-model="job.instagram" name="instagram" class="form-control" id="instagram" aria-describedby="emailHelp" placeholder="Instagram">
                                                        <div class="valid-feedback"></div>
                                                        <div v-if="errors.has('job_validate_add_form.instagram')" class="invalid-feedback">
                                                            <span v-for="error in errors.collect('job_validate_add_form.instagram')">{{ error }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="facebook">Facebook <small class="text-success">(optional)</small></label>
                                                        <input type="text" v-validate="'max:50|url'" v-model="job.facebook" name="facebook" class="form-control" id="facebook" aria-describedby="emailHelp" placeholder="Facebook">
                                                        <div class="valid-feedback"></div>
                                                        <div v-if="errors.has('job_validate_add_form.facebook')" class="invalid-feedback">
                                                            <span v-for="error in errors.collect('job_validate_add_form.facebook')">{{ error }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="website">Website <small class="text-success">(optional)</small></label>
                                                        <input type="text" v-validate="'max:50|url'" v-model="job.website" name="website" class="form-control" id="website" aria-describedby="emailHelp" placeholder="Facebook">
                                                        <div class="valid-feedback"></div>
                                                        <div v-if="errors.has('job_validate_add_form.website')" class="invalid-feedback">
                                                            <span v-for="error in errors.collect('job_validate_add_form.website')">{{ error }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="deadline">Address<small class="text-success p-1">(Optional)</small></label>
                                                        <textarea rows="5" cols="50" v-validate="'min:2|max:255'" v-model="job.address" name="address" class="form-control" id="address" aria-describedby="emailHelp" placeholder="Address"></textarea>
                                                        <div class="valid-feedback"></div>
                                                        <div v-if="errors.has('job_validate_add_form.address')" class="invalid-feedback">
                                                            <span v-for="error in errors.collect('job_validate_add_form.address')">{{ error }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="description">Job Description<small class="text-success p-1">(Optional)</small></label>
                                                        <textarea rows="5" cols="50" v-validate="'max:150'" v-model="job.description" name="description" class="form-control" id="description" aria-describedby="emailHelp" placeholder="Description | less than 250 word" ></textarea>
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
    </div>
</template>
<script>
import { Validator } from 'vee-validate';

export default {
    props:['load_job'],
    data(){
        return{
            job:{
                'longitude':20.96,
                'latitude':78.78
            },
            bannerPreview:'',
            places:{},
            // today : 
            locations:{},
            professions:{},
            // Salary Disclouse
            status:true,
        }
    },
    methods:{
        // load places
        load_location(){
            if(this.job.location ==''){
                this.job.location = '';
                this.places ={};
            }else{
                if(this.job.location.length > 2){
                axios.get('https://api.mapbox.com/geocoding/v5/mapbox.places/'+this.job.location+'.json?access_token=pk.eyJ1IjoicmluemluMjAyMCIsImEiOiJja2szcm1iN3ExZHRiMm9wY3Z5OWx6dnZ4In0.4TuimSiBj9l5OKTybvcrAQ&cachebuster=1611047895214&autocomplete=true&types=place%2Clocality&country=in&worldview=in&limit=8')
                .then(response=>{
                    this.places =  response.data.features;
                }) 
                }
            }
        },
        /**
            * Set Location
            *  */ 
        set_location(location,city,index){
            this.job.location = location+', '+city;
            // address
            this.job.address = this.places[index].place_name;
            //longitude
            this.job.longitude = this.places[index].center[0];
            // latitude
            this.job.latitude = this.places[index].center[1];
            this.places = {};
        },
        // Salary Disclose
        salary_disclose(status){
            if(status){
                this.status = false;
                this.job.salary = 0;
            }else{
                this.status = true;
            }
        },
        /**
         * Banner Image 
         * File
         *  */ 
        avatar(event){
            let fileReader = new FileReader();
            if(event.target.files[0].size < 1000000){
                fileReader.onload = (event) =>{
                    this.bannerPreview = event.target.result
                    this.job.banner = event.target.result
                }
                
            }else{
                alert("Image size should be less than 1MB")
            }
            // base64 data
            fileReader.readAsDataURL(event.target.files[0]);
        },
        // Add Job
       add_job(){
            this.$validator.validateAll('job_validate_add_form').then((result) => {
                if(result){
                this.$Progress.start()
                    axios.post('/api/job',this.job,{
                    headers : { Authorization : localStorage.getItem("token")}
                    })
                    .then(response=>{
                        // closing modal
                            $("#job_add_modal").modal("hide");  
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
        }
    },
    mounted(){
        // profession
        axios.get('/api/categories/job')
        .then(response => {
            this.professions = response.data;
        })
    }
}
</script>