<template>
    <div>
        <div class="modal fade" id="event_add_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header bg-secondary text-white">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add New Event</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <form @submit.prevent="add_event()"  data-vv-scope="event_validate_add_form">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div v-if="bannerPreview" class="col-md-12" style="background-size: cover;height: 250px;background-position: center;" v-bind:style='{ backgroundImage: `url(${bannerPreview})`}'></div>
                                <div class="row">
                                    <div class="col-md-4 col-sm-6">
                                        <div class="form-group">
                                            <label for="name">Name<span class="text-danger p-1">*</span></label>
                                            <input type="text" v-validate="'required|min:2|max:40'" v-model="event.name" name="name" class="form-control" id="name" aria-describedby="emailHelp" placeholder="name">
                                            <div class="valid-feedback"></div>
                                            <div v-if="errors.has('event_validate_add_form.name')" class="invalid-feedback">
                                                <span v-for="error in errors.collect('event_validate_add_form.name')">{{ error }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <div class="form-group">
                                            <label for="category">Category<span class="text-danger p-1">*</span></label>
                                            <input type="text" v-validate="'required|min:2|max:40'" v-model="event.category" name="category" class="form-control" id="category" aria-describedby="emailHelp" placeholder="Select Category">
                                            <div class="valid-feedback"></div>
                                            <div v-if="errors.has('event_validate_add_form.category')" class="invalid-feedback">
                                                <span v-for="error in errors.collect('event_validate_add_form.category')">{{ error }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <div class="form-group">
                                            <label for="entry_fee">Entry Fee<small class="text-success p-1">Optional</small></label>
                                            <input type="text" v-validate="'numeric|max:6'" v-model="event.entry_fee" name="entry_fee" class="form-control" id="entry_fee" aria-describedby="emailHelp" placeholder="Entry Fee">
                                            <div class="valid-feedback"></div>
                                            <div v-if="errors.has('event_validate_add_form.entry_fee')" class="invalid-feedback">
                                                <span v-for="error in errors.collect('event_validate_add_form.entry_fee')">{{ error }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <div class="form-group">
                                            <label for="location">Location<span class="text-danger p-1">*</span></label>
                                            <input type="text" v-validate="'required'" v-model="event.location" name="location" class="form-control" id="location" aria-describedby="emailHelp" placeholder="Location">
                                            <div class="valid-feedback"></div>
                                            <div v-if="errors.has('event_validate_add_form.location')" class="invalid-feedback">
                                                <span v-for="error in errors.collect('event_validate_add_form.location')">{{ error }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <div class="form-group">
                                            <label for="mobile">Mobile No<span class="text-danger p-1">*</span></label>
                                            <input type="text" v-validate="'required|max:10|digits:10'" v-model="event.mobile_no" name="mobile_no" class="form-control" id="mobile_no" aria-describedby="emailHelp" placeholder="Mobile No">
                                            <div class="valid-feedback"></div>
                                            <div v-if="errors.has('event_validate_add_form.mobile_no')" class="invalid-feedback">
                                                <span v-for="error in errors.collect('event_validate_add_form.mobile_no')">{{ error }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <div class="form-group">
                                            <label for="email">Email<span class="text-danger p-1">*</span></label>
                                            <input type="text" v-validate="'required|max:45|email'" v-model="event.email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Email">
                                            <div class="valid-feedback"></div>
                                            <div v-if="errors.has('event_validate_add_form.email')" class="invalid-feedback">
                                                <span v-for="error in errors.collect('event_validate_add_form.email')">{{ error }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6">
                                        <div class="form-group">
                                            <label for="start_date">Starting Date<span class="text-danger p-1">*</span></label>
                                            <input type="date" v-validate="'required'" v-model="event.start_date" name="start_date" class="form-control" id="start_date" aria-describedby="emailHelp" placeholder="Starting Date">
                                            <div class="valid-feedback"></div>
                                            <div v-if="errors.has('event_validate_add_form.start_date')" class="invalid-feedback">
                                                <span v-for="error in errors.collect('event_validate_add_form.start_date')">{{ error }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="start_time"><small>Starts at </small><small class="text-success p-1">Optional</small></label>
                                                    <input type="time"  v-model="event.start_time" name="start_time" class="form-control" id="start_time" aria-describedby="emailHelp" placeholder="Starting Date">
                                                    <div class="valid-feedback"></div>
                                                    <div v-if="errors.has('event_validate_add_form.start_time')" class="invalid-feedback">
                                                        <span v-for="error in errors.collect('event_validate_add_form.start_time')">{{ error }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="start_time"><small>Ends at</small><small class="text-success p-1"> Optional</small></label>
                                                    <input type="time"  v-model="event.end_time" name="end_time" class="form-control" id="end_time" aria-describedby="emailHelp" placeholder="Ending Time">
                                                    <div class="valid-feedback"></div>
                                                    <div v-if="errors.has('event_validate_add_form.end_time')" class="invalid-feedback">
                                                        <span v-for="error in errors.collect('event_validate_add_form.end_time')">{{ error }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6">
                                        <div class="form-group">
                                            <label for="end_date">End Date<small class="text-success p-1">Optional</small></label>
                                            <input type="date" v-validate="''" v-model="event.end_date" name="end_date" class="form-control" id="end_date" aria-describedby="emailHelp" placeholder="Starting Date">
                                            <div class="valid-feedback"></div>
                                            <div v-if="errors.has('event_validate_add_form.end_date')" class="invalid-feedback">
                                                <span v-for="error in errors.collect('event_validate_add_form.end_date')">{{ error }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label for="banner">Banner Image <span class="text-danger p-1">*</span></label>
                                                <input type="file" v-validate="'required|image|ext:jpeg,jpg,png,gif|size:1000'" name="banner" @change="avatar" class="form-control" id="banner" aria-describedby="emailHelp" placeholder="Website Address">
                                                <div class="valid-feedback"></div>
                                                <div v-if="errors.has('event_validate_add_form.banner')" class="invalid-feedback">
                                                    <span v-for="error in errors.collect('event_validate_add_form.banner')">{{ error }}</span>
                                                </div>
                                            </div>
                                        </div>

                                    <div class="col-md-4 col-sm-6">
                                        <div class="form-group">
                                            <label for="address">Address<span class="text-danger p-1">*</span></label>
                                            <textarea rows="4" cols="50" v-validate="'required|max:150'" v-model="event.address" name="address" class="form-control" id="address" aria-describedby="emailHelp" placeholder="Address" ></textarea>
                                            <div class="valid-feedback"></div>
                                            <div v-if="errors.has('event_validate_add_form.address')" class="invalid-feedback">
                                                <span v-for="error in errors.collect('event_validate_add_form.address')">{{ error }}</span>
                                            </div>
                                        </div>
                                    </div>
                                        <div class="col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <label for="description">Event Description <span class="text-danger p-1">*</span></label>
                                                <textarea rows="4" cols="50" v-validate="'max:150'" v-model="event.description" name="description" class="form-control" id="description" aria-describedby="emailHelp" placeholder="Description | less than 250 word" ></textarea>
                                                <div class="valid-feedback"></div>
                                                <div v-if="errors.has('event_validate_add_form.description')" class="invalid-feedback">
                                                    <span v-for="error in errors.collect('event_validate_add_form.description')">{{ error }}</span>
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
import { Validator } from 'vee-validate';

export default {
    props:['load_event'],
    data(){
        return{
            event:{},
            bannerPreview:'',
            // today : 
        }
    },
    methods:{
        /**
         * Banner Image 
         * File
         *  */ 
        avatar(event){
            let fileReader = new FileReader();
            if(event.target.files[0].size < 1000000){
                fileReader.onload = (event) =>{
                    this.bannerPreview = event.target.result
                    this.event.banner = event.target.result
                }
                
            }else{
                alert("Image size should be less than 1MB")
            }
            // base64 data
            fileReader.readAsDataURL(event.target.files[0]);
        },

       add_event(){           
            this.$validator.validateAll('event_validate_add_form').then((result) => {                  
                if(result){
                    axios.post('/api/event',this.event,{
                    headers : { Authorization : localStorage.getItem("token")}
                    })
                    .then(response=>{
                        // closing modal
                            $("#event_add_modal").modal("hide");  
                            //  Flash Message  
                            toast.fire({
                                icon:'success',
                                title:'Updated',
                            });
                            this.$emit('load_event');
                    })
                }
            })
        }
    },
    mounted(){
    }
}
</script>