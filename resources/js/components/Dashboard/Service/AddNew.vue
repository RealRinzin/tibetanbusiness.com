<template>
    <div>
        <div class="modal fade" id="service_add_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header bg-secondary text-white">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add New Job</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <form @submit.prevent="add_service()"  data-vv-scope="service_validate_add_form">
                        <div class="modal-body">
                            <div class="container-fluid">
                                    <div v-if="bannerPreview" class="col-md-12" style="background-size: cover;height: 300px;background-position: center;" v-bind:style='{ backgroundImage: `url(${bannerPreview})`}'>
                                        <!-- <img :src="bannerPreview" alt="" class="img-fluid"> -->
                                    </div>
                                <div class="row">
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label for="banner">Banner Image <span class="text-danger p-1">*</span></label>
                                                <input type="file" v-validate="'required|image|ext:jpeg,jpg,png,gif|size:1000'" name="banner" @change="avatar" class="form-control" id="banner" aria-describedby="emailHelp" placeholder="Website Address">
                                                <div class="valid-feedback"></div>
                                                <div v-if="errors.has('service_validate_add_form.banner')" class="invalid-feedback">
                                                    <span v-for="error in errors.collect('service_validate_add_form.banner')">{{ error }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label for="name">Name<span class="text-danger p-1">*</span></label>
                                                <input type="text" v-validate="'required|min:2|max:40'" v-model="service.name" name="name" class="form-control" id="name" aria-describedby="emailHelp" placeholder="name">
                                                <div class="valid-feedback"></div>
                                                <div v-if="errors.has('service_validate_add_form.name')" class="invalid-feedback">
                                                    <span v-for="error in errors.collect('service_validate_add_form.name')">{{ error }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label for="type">Type<span class="text-danger p-1">*</span></label>
                                                <input type="text" v-validate="'required|min:2|max:40'" v-model="service.type" name="type" class="form-control" id="type" aria-describedby="emailHelp" placeholder="name">
                                                <div class="valid-feedback"></div>
                                                <div v-if="errors.has('service_validate_add_form.type')" class="invalid-feedback">
                                                    <span v-for="error in errors.collect('service_validate_add_form.type')">{{ error }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label for="location">Location<span class="text-danger p-1">*</span></label>
                                                <input type="text" v-validate="'required|min:2|max:40'" v-model="service.location" name="location" class="form-control" id="location" aria-describedby="emailHelp" placeholder="name">
                                                <div class="valid-feedback"></div>
                                                <div v-if="errors.has('service_validate_add_form.location')" class="invalid-feedback">
                                                    <span v-for="error in errors.collect('service_validate_add_form.location')">{{ error }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label for="opening_hour">Opening hour<span class="text-danger p-1">*</span></label>
                                                <input type="time" v-validate="'required'" v-model="service.opening_hour" name="opening_hour" class="form-control" id="opening_hour" aria-describedby="emailHelp" placeholder="opening hour">
                                                <div class="valid-feedback"></div>
                                                <div v-if="errors.has('service_validate_add_form.opening_hour')" class="invalid-feedback">
                                                    <span v-for="error in errors.collect('service_validate_add_form.opening_hour')">{{ error }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label for="closing_hour">closing hour<span class="text-danger p-1">*</span></label>
                                                <input type="time" v-validate="'required'" v-model="service.closing_hour" name="closing_hour" class="form-control" id="closing_hour" aria-describedby="emailHelp" placeholder="closing hour">
                                                <div class="valid-feedback"></div>
                                                <div v-if="errors.has('service_validate_add_form.closing_hour')" class="invalid-feedback">
                                                    <span v-for="error in errors.collect('service_validate_add_form.closing_hour')">{{ error }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label for="deadline">Mobile no<span class="text-danger p-1">*</span></label>
                                                <input type="text" v-validate="'required|numeric|max:10|min:10'" v-model="service.mobile_no" name="mobile_no" class="form-control" id="mobile_no" aria-describedby="emailHelp" placeholder="name">
                                                <div class="valid-feedback"></div>
                                                <div v-if="errors.has('service_validate_add_form.mobile_no')" class="invalid-feedback">
                                                    <span v-for="error in errors.collect('service_validate_add_form.mobile_no')">{{ error }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label for="deadline">Email<span class="text-danger p-1">*</span></label>
                                                <input type="text" v-validate="'required|min:10|max:40'" v-model="service.email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="name">
                                                <div class="valid-feedback"></div>
                                                <div v-if="errors.has('service_validate_add_form.email')" class="invalid-feedback">
                                                    <span v-for="error in errors.collect('service_validate_add_form.email')">{{ error }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label for="deadline">Address<span class="text-danger p-1">*</span></label>
                                                <input type="text" v-validate="'required|min:2|max:40'" v-model="service.address" name="address" class="form-control" id="address" aria-describedby="emailHelp" placeholder="name">
                                                <div class="valid-feedback"></div>
                                                <div v-if="errors.has('service_validate_add_form.address')" class="invalid-feedback">
                                                    <span v-for="error in errors.collect('service_validate_add_form.address')">{{ error }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label for="instagram">Instagram <small class="text-success">(optional)</small></label>
                                                <input type="text" v-validate="'max:50|url'" v-model="service.instagram" name="instagram" class="form-control" id="instagram" aria-describedby="emailHelp" placeholder="name">
                                                <div class="valid-feedback"></div>
                                                <div v-if="errors.has('service_validate_add_form.instagram')" class="invalid-feedback">
                                                    <span v-for="error in errors.collect('service_validate_add_form.instagram')">{{ error }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label for="facebook">Facebook <small class="text-success">(optional)</small></label>
                                                <input type="text" v-validate="'max:50|url'" v-model="service.facebook" name="facebook" class="form-control" id="facebook" aria-describedby="emailHelp" placeholder="Facebook">
                                                <div class="valid-feedback"></div>
                                                <div v-if="errors.has('service_validate_add_form.facebook')" class="invalid-feedback">
                                                    <span v-for="error in errors.collect('service_validate_add_form.facebook')">{{ error }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label for="website">Website <small class="text-success">(optional)</small></label>
                                                <input type="text" v-validate="'max:50|url'" v-model="service.website" name="website" class="form-control" id="website" aria-describedby="emailHelp" placeholder="Facebook">
                                                <div class="valid-feedback"></div>
                                                <div v-if="errors.has('service_validate_add_form.website')" class="invalid-feedback">
                                                    <span v-for="error in errors.collect('service_validate_add_form.website')">{{ error }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <label for="description">Service Description <span class="text-danger p-1">*</span></label>
                                                <textarea rows="5" cols="50" v-validate="'max:150'" v-model="service.description" name="description" class="form-control" id="description" aria-describedby="emailHelp" placeholder="Description | less than 250 word" ></textarea>
                                                <div class="valid-feedback"></div>
                                                <div v-if="errors.has('service_validate_add_form.description')" class="invalid-feedback">
                                                    <span v-for="error in errors.collect('service_validate_add_form.description')">{{ error }}</span>
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
    props:['load_service'],
    data(){
        return{
            service:{},
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
                    this.service.banner = event.target.result
                }
                
            }else{
                alert("Image size should be less than 1MB")
            }
            // base64 data
            fileReader.readAsDataURL(event.target.files[0]);
        },

       add_service(){
               this.$validator.validateAll('service_validate_add_form').then((result) => {
                    if(result){
                     axios.post('/api/service',this.service,{
                        headers : { Authorization : localStorage.getItem("token")}
                        })
                        .then(response=>{
                            // closing modal
                                $("#service_add_modal").modal("hide");  
                                //  Flash Message  
                                toast.fire({
                                    icon:'success',
                                    title:'Updated',
                                });
                                this.$emit('load_service');
                        })
                    }
               })
        }
    },
    mounted(){
    }
}
</script>