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
                    <div class="col-md-6" v-if="job.types == 1">
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
                                    <h6 v-if="job.salary > 0" class="text-muted font-weight-bold">Rs: {{job.salary}} /-</h6>
                                    <h6 v-else class="text-muted font-weight-bold">Not Disclosed</h6>
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
                    <div class="col-md-6" v-if="job.types == 2">
                        <div class="card-body">
                            <div class="row py-1">
                                <div class="col-md-6 col-sm-4">
                                    <h6 class="text-dark">Name:</h6>
                                </div>
                                <div class="col-md-6 col-sm-8">
                                    <h6 class="text-muted">{{job.title}}</h6>
                                </div>
                            </div>
                            <div class="row py-1">
                                <div class="col-md-6 col-sm-4">
                                    <h6 class="text-dark">Course Name:</h6>
                                </div>
                                <div class="col-md-6 col-sm-8">
                                    <h6 class="text-muted">{{job.course_name}}</h6>
                                </div>
                            </div>
                            <div class="row py-1">
                                <div class="col-md-6 col-sm-4">
                                    <h6 class="text-dark">Graduation:</h6>
                                </div>
                                <div class="col-md-6 col-sm-8">
                                    <h6 class="text-muted">{{job.graduation}}</h6>
                                </div>
                            </div>
                            <div class="row py-1">
                                <div class="col-md-6 col-sm-4">
                                    <h6 class="text-dark">Duration:</h6>
                                </div>
                                <div class="col-md-6 col-sm-8">
                                    <h6 class="text-muted">{{job.duration}}</h6>
                                </div>
                            </div>

                            <div class="row py-1">
                                <div class="col-md-6 col-sm-4">
                                    <h6 class="text-dark">Country :</h6>
                                </div>
                                <div class="col-md-6 col-sm-8">
                                    <h6 class="text-muted">{{job.country}}</h6>
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
                                <div class="row py-1" v-if="job.types == 1">
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
                                        <h6 class="text-muted">{{job.email}}</h6>
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
        <div class="modal fade add_edit_label" id="job_overview_update_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
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
                                <div class="row" v-if="job.types == 1">
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label for="title">Title<span class="text-danger p-1">*</span></label>
                                                <input type="text" v-validate="'required|min:2|max:40'" v-model="job.title" name="title" class="form-control" id="title" aria-describedby="emailHelp" placeholder="Job Title">
                                                <div class="valid-feedback"></div>
                                                <div v-if="errors.has('job_validate_update_form.title')" class="invalid-feedback">
                                                    <span v-for="error in errors.collect('job_validate_update_form.title')">{{ error }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label for="organization">Organization<span class="text-danger p-1">*</span></label>
                                                <input type="text" v-validate="'required|min:2|max:40'" v-model="job.organization" name="organization" class="form-control" id="organization" aria-describedby="emailHelp" placeholder="Organization">
                                                <div class="valid-feedback"></div>
                                                <div v-if="errors.has('job_validate_update_form.organization')" class="invalid-feedback">
                                                    <span v-for="error in errors.collect('job_validate_update_form.organization')">{{ error }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="row">
                                                <div class="col-6" v-show="status">
                                                    <div class="form-group">
                                                        <label for="salary">Salary<span class="text-danger p-1">*</span></label>
                                                        <input type="text" v-validate="'required|decimal:2|max:10'" v-model="job.salary" name="salary" class="form-control" id="salary" aria-describedby="emailHelp" placeholder="Salary">
                                                        <div class="valid-feedback"></div>
                                                        <div v-if="errors.has('job_validate_update_form.salary')" class="invalid-feedback">
                                                            <span v-for="error in errors.collect('job_validate_update_form.salary')">{{ error }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <form class="was-validated pt-4">
                                                        <div class="custom-control custom-checkbox pt-3">
                                                            <input type="checkbox" class="custom-control-input"  id="salary_status" @change="salary_disclose(status)">
                                                            <label class="custom-control-label text-muted small" for="salary_status">Not Disclose</label>
                                                            <div class="invalid-feedback"></div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label for="profession">Profession<span class="text-danger p-1">*</span></label>
                                                <select v-validate="'required'" v-model="job.profession" name="profession" class="form-control" id="profession" placeholder="Selected Profession">
                                                    <option value="" disabled selected>Select Profession</option>
                                                    <option v-for="profession in professions" :value="profession.name">{{profession.name}}</option>
                                                </select>
                                                <div class="valid-feedback"></div>
                                                <div v-if="errors.has('job_validate_update_form.profession')" class="invalid-feedback">
                                                    <span v-for="error in errors.collect('job_validate_update_form.profession')">{{ error }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label for="profession">Email<span class="text-danger p-1">*</span></label>
                                                <input type="text" v-validate="'required|min:2|max:40'" v-model="job.email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Email">
                                                <div class="valid-feedback"></div>
                                                <div v-if="errors.has('job_validate_update_form.email')" class="invalid-feedback">
                                                    <span v-for="error in errors.collect('job_validate_update_form.email')">{{ error }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
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
                                                <div v-if="errors.has('job_validate_update_form.nature')" class="invalid-feedback">
                                                    <span v-for="error in errors.collect('job_validate_update_form.nature')">{{ error }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label for="experience">Experience<span class="text-danger p-1">*</span></label>
                                                <select v-validate="'required'" v-model="job.experience" name="experience" class="form-control" id="experience">
                                                    <option value="" disabled selected>Select Experience</option>
                                                    <option value="Not Required"> Not Required</option>
                                                    <option value="Bachelor"> Bachelor Degree</option>
                                                    <option value="Master"> Master Degree</option>
                                                    <option value="6 Months"> 6 Months</option>
                                                    <option value="1 Yrs"> 1 Years</option>
                                                    <option value="2 Yrs"> 2 Years</option>
                                                    <option value="3 Yrs"> 3 Years</option>
                                                    <option value="4 Yrs"> 4 Years</option>
                                                    <option value="5 Yrs"> 5 Years</option>
                                                    <option value="6 Yrs above"> 6 Years Above</option>
                                                </select>
                                                <div class="valid-feedback"></div>
                                                <div v-if="errors.has('job_validate_update_form.experience')" class="invalid-feedback">
                                                    <span v-for="error in errors.collect('job_validate_update_form.experience')">{{ error }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label for="deadline">Deadline<span class="text-danger p-1">*</span></label>
                                                <input type="date" v-validate="'required|min:2|max:40'" v-model="job.deadline" name="deadline" class="form-control" id="deadline" aria-describedby="emailHelp" placeholder="Deadline">
                                                <div class="valid-feedback"></div>
                                                <div v-if="errors.has('job_validate_update_form.deadline')" class="invalid-feedback">
                                                    <span v-for="error in errors.collect('job_validate_update_form.deadline')">{{ error }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label for="location">Location<span class="text-danger p-1">*</span></label>
                                                <input type="text" autocomplete="off" name="location" v-validate="'required'" @keyup="load_location()"  v-model="job.location" class="rounded form-control "  placeholder="Location" aria-label="Location">
                                                <ul class="w-100 pl-0" style="position: absolute;z-index:100">
                                                    <!-- <li style="list-style:none;cursor:pointer"  class="py-2 text-dark border-bottom bg-light" v-for="(place,index) in places" @click="set_location(place.text,place.context[0].text,index)"><i class="fas fa-map-marker mx-2 text-muted"></i> {{place.text}}, {{place.context[0].text}}</li> -->
                                                    <li style="list-style:none;cursor:pointer"  class="p-2 text-dark border-bottom bg-light" v-for="(place,index) in places" @click="set_location(place.placeName,place.placeAddress,index)" v-if="index <= 5">
                                                        <span class="font-weight-bold text-dark" style="font-size:13px">{{place.placeName}}</span>
                                                        <span class="d-block text-muted" style="font-size:12px">{{place.placeAddress}}</span>
                                                    </li>
                                                </ul>
                                                <!-- <input type="text" v-validate="'required|min:2|max:40'" v-model="job.location" name="location" class="form-control" id="location" aria-describedby="emailHelp" placeholder="Location"> -->
                                                <div class="valid-feedback"></div>
                                                <div v-if="errors.has('job_validate_update_form.location')" class="invalid-feedback">
                                                    <span v-for="error in errors.collect('job_validate_update_form.location')">{{ error }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label for="deadline">Mobile no<small class="text-success">(optional)</small></label>
                                                <input type="text" v-validate="'numeric|max:10|min:10'" v-model="job.mobile_no" name="mobile_no" class="form-control" id="mobile_no" aria-describedby="emailHelp" placeholder="Mobile No">
                                                <div class="valid-feedback"></div>
                                                <div v-if="errors.has('job_validate_update_form.mobile_no')" class="invalid-feedback">
                                                    <span v-for="error in errors.collect('job_validate_update_form.mobile_no')">{{ error }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label for="deadline">Address<small class="text-success">(optional)</small></label>
                                                <input type="text" v-validate="'min:2|max:255'" v-model="job.address" name="address" class="form-control" id="address" aria-describedby="emailHelp" placeholder="Address">
                                                <div class="valid-feedback"></div>
                                                <div v-if="errors.has('job_validate_update_form.address')" class="invalid-feedback">
                                                    <span v-for="error in errors.collect('job_validate_update_form.address')">{{ error }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label for="instagram">Instagram <small class="text-success">(optional)</small></label>
                                                <input type="text" v-validate="'max:50|url'" v-model="job.instagram" name="instagram" class="form-control" id="instagram" aria-describedby="emailHelp" placeholder="Instagram">
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
                                        <div class="col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <label for="description">Job Description <small class="text-success">(optional)</small></label>
                                                <textarea rows="4" cols="50" v-validate="'max:15000'" v-model="job.description" name="description" class="form-control" id="description" aria-describedby="emailHelp" placeholder="Descriptions" ></textarea>
                                                <div class="valid-feedback"></div>
                                                <div v-if="errors.has('job_validate_update_form.description')" class="invalid-feedback">
                                                    <span v-for="error in errors.collect('job_validate_update_form.description')">{{ error }}</span>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                                <!-- scholarship -->
                                <div class="row" v-if="job.types == 2">
                                    <div class="col-md-4 col-sm-6">
                                        <div class="form-group">
                                            <label for="title">Name<span class="text-danger p-1">*</span></label>
                                            <input type="text" v-validate="'required|min:2|max:100'" v-model="job.title" name="name" class="form-control" id="name" aria-describedby="emailHelp" placeholder="job Name">
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
                                            <input type="text" v-validate="'required|min:2|max:100'" v-model="job.course_name" name="course_name" class="form-control" id="course_name" aria-describedby="emailHelp" placeholder="Course Name">
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
                                            <select v-validate="'required'" v-model="job.graduation" name="degree" class="form-control" id="degree">
                                                <option value="" disabled selected>degree</option>
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
                                            <select v-validate="'required'" v-model="job.duration" name="duration" class="form-control" id="duration">
                                                <option value="" disabled selected>Duration</option>
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
                                            <input type="date" v-validate="'required'" v-model="job.deadline" name="application_deadline" class="form-control" id="application_deadline" aria-describedby="emailHelp" placeholder="Application Deadline">
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
                                            <select v-validate="'required'" v-model="job.country"  name="country" class="form-control" id="country">
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
                                            <input type="text" v-validate="'required|min:10|max:100'" v-model="job.email" name="email" class="form-control" id="s_email" aria-describedby="emailHelp" placeholder="Email">
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
                                            <input type="text" v-validate="'numeric|max:10|min:10'" v-model="job.mobile_no" name="mobile_no" class="form-control" id="s_mobile_no" aria-describedby="emailHelp" placeholder="Mobile No">
                                            <div class="valid-feedback"></div>
                                            <div v-if="errors.has('job_validate_add_form.mobile_no')" class="invalid-feedback">
                                                <span v-for="error in errors.collect('job_validate_add_form.mobile_no')">{{ error }}</span>
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
                                                        <input type="text" v-validate="'max:50|url'" v-model="job.instagram" name="instagram" class="form-control" id="s_instagram" aria-describedby="emailHelp" placeholder="Instagram">
                                                        <div class="valid-feedback"></div>
                                                        <div v-if="errors.has('job_validate_add_form.instagram')" class="invalid-feedback">
                                                            <span v-for="error in errors.collect('job_validate_add_form.instagram')">{{ error }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="facebook">Facebook <small class="text-success">(optional)</small></label>
                                                        <input type="text" v-validate="'max:50|url'" v-model="job.facebook" name="facebook" class="form-control" id="s_facebook" aria-describedby="emailHelp" placeholder="Facebook">
                                                        <div class="valid-feedback"></div>
                                                        <div v-if="errors.has('job_validate_add_form.facebook')" class="invalid-feedback">
                                                            <span v-for="error in errors.collect('job_validate_add_form.facebook')">{{ error }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="website">Website <small class="text-success">(optional)</small></label>
                                                        <input type="text" v-validate="'max:50|url'" v-model="job.website" name="website" class="form-control" id="s_website" aria-describedby="emailHelp" placeholder="Facebook">
                                                        <div class="valid-feedback"></div>
                                                        <div v-if="errors.has('job_validate_add_form.website')" class="invalid-feedback">
                                                            <span v-for="error in errors.collect('job_validate_add_form.website')">{{ error }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="deadline">Address<small class="text-success p-1">(Optional)</small></label>
                                                        <textarea rows="5" cols="50" v-validate="'min:2|max:255'" v-model="job.address" name="address" class="form-control" id="s_address" aria-describedby="emailHelp" placeholder="Address"></textarea>
                                                        <div class="valid-feedback"></div>
                                                        <div v-if="errors.has('job_validate_add_form.address')" class="invalid-feedback">
                                                            <span v-for="error in errors.collect('job_validate_add_form.address')">{{ error }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="description">job Description<small class="text-success p-1">(Optional)</small></label>
                                                        <textarea rows="5" cols="50" v-validate="'max:150'" v-model="job.description" name="description" class="form-control" id="s_description" aria-describedby="emailHelp" placeholder="Description | less than 250 word" ></textarea>
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
            locations:{},
            places:{},
            professions:{},
            status:true,
            check:true,
            countries:{},
        }
    },
    methods:{
        // load places
        // load places
        load_location(){
            let location = "\""+ this.job.location+  "\"";
            if(this.job.location ==''){
                this.job.location = '';
                this.places ={};
            }else{
                if(this.job.location.length > 2){
                // axios.get('https://api.mapbox.com/geocoding/v5/mapbox.places/'+this.job.location+'.json?access_token=pk.eyJ1IjoicmluemluMjAyMCIsImEiOiJja2szcm1iN3ExZHRiMm9wY3Z5OWx6dnZ4In0.4TuimSiBj9l5OKTybvcrAQ&cachebuster=1611047895214&autocomplete=true&types=place%2Clocality&country=in&worldview=in&limit=8')
                axios.get("/api/map?query="+location)
                .then(response=>{
                    // this.places =  response.data.features;
                    this.locations = JSON.parse(response.data.data);
                    this.places = this.locations.suggestedLocations;
                }) 
                }
            }
        },
        /**
            * Set Location
            *  */ 
        set_location(location,city,index){
            this.job.location = location;
            this.job.address = this.places[index].placeAddress;
            //longitude
            this.job.longitude = this.places[index].longitude;
            // latitude
            this.job.latitude = this.places[index].latitude;
            // Reset location
            this.places = {};
        },
        // Salary Disclose
        salary_disclose(status){
            if(status){
                this.status = false;
            }else{
                this.status = true;
            }
        },
        // modal
        edit(){
            $("#job_overview_update_modal").modal("show");           
        },
        // Update
        update_overview(id){
            
                if(!this.status){
                    this.job.salary = 0;
                }
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

        // profession
        axios.get('/api/occupations')
        .then(response => {
            this.professions = response.data;
        })
        // Countries API
            axios.get('https://restcountries.eu/rest/v2/all')
            .then(response => {
                this.countries = response.data;
            })
    }
}
</script>