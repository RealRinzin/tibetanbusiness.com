<template>
    <div>
        <!-- Modal -->
        <div class="modal fade" id="rent_add_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mx-auto" id="exampleModalLongTitle">Add New Rent</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <form @submit.prevent="create_rent()"  data-vv-scope="rent_validate_add_form">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="row">
                                    <div v-if="bannerPreview" class="col-md-12" style="background-size: cover;height: 300px;background-position: center;" v-bind:style='{ backgroundImage: `url(${bannerPreview})`}'>
                                        <!-- <img :src="bannerPreview" alt="" class="img-fluid"> -->
                                    </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label for="name">Name<span class="text-danger p-1">*</span></label>
                                                <input type="text" v-validate="'required|min:2|max:40'" v-model="rent.name" name="name" class="form-control" id="name" aria-describedby="emailHelp" placeholder="name">
                                                <div class="valid-feedback"></div>
                                                <div v-if="errors.has('rent_validate_add_form.name')" class="invalid-feedback">
                                                    <span v-for="error in errors.collect('rent_validate_add_form.name')">{{ error }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label for="fare">Price<span class="text-danger p-1">*</span></label>
                                                <input type="text" v-validate="'required|numeric|max:6'" v-model="rent.fare" name="fare" class="form-control" id="fare" aria-describedby="emailHelp" placeholder="name">
                                                <div class="valid-feedback"></div>
                                                <div v-if="errors.has('rent_validate_add_form.fare')" class="invalid-feedback">
                                                    <span v-for="error in errors.collect('rent_validate_add_form.fare')">{{ error }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label for="location">Location<span class="text-danger p-1">*</span></label>
                                                <input type="text" v-validate="'required'" v-model="rent.location" name="location" class="form-control" id="location" aria-describedby="emailHelp" placeholder="Location">
                                                <div class="valid-feedback"></div>
                                                <div v-if="errors.has('rent_validate_add_form.location')" class="invalid-feedback">
                                                    <span v-for="error in errors.collect('rent_validate_add_form.location')">{{ error }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label for="mobile">Mobile No<span class="text-danger p-1">*</span></label>
                                                <input type="text" v-validate="'required|max:10|digits:10'" v-model="rent.mobile_no" name="mobile_no" class="form-control" id="mobile_no" aria-describedby="emailHelp" placeholder="Mobile No">
                                                <div class="valid-feedback"></div>
                                                <div v-if="errors.has('rent_validate_add_form.mobile_no')" class="invalid-feedback">
                                                    <span v-for="error in errors.collect('rent_validate_add_form.mobile_no')">{{ error }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label for="accomodation_size">Accomodation Size<span class="text-danger p-1">*</span></label>
                                                <input type="number" v-validate="'required|numeric|max:5'" v-model="rent.accomodation_size" name="accomodation_size" class="form-control" id="accomodation_size" aria-describedby="emailHelp" placeholder="How many people can stay">
                                                <div class="valid-feedback"></div>
                                                <div v-if="errors.has('rent_validate_add_form.accomodation_size')" class="invalid-feedback">
                                                    <span v-for="error in errors.collect('rent_validate_add_form.accomodation_size')">{{ error }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Email<span class="text-danger p-1">*</span></label>
                                                <input type="text" v-validate="'required|max:45|email'" v-model="rent.email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Email">
                                                <div class="valid-feedback"></div>
                                                <div v-if="errors.has('rent_validate_add_form.email')" class="invalid-feedback">
                                                    <span v-for="error in errors.collect('rent_validate_add_form.email')">{{ error }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label for="banner">Banner Image <span class="text-danger p-1">*</span></label>
                                                <input type="file" v-validate="'required|image|ext:jpeg,jpg,png,gif|size:10000'" name="banner" @change="banner" class="form-control" id="banner" aria-describedby="emailHelp" placeholder="Website Address">
                                                <div class="valid-feedback"></div>
                                                <div v-if="errors.has('rent_validate_add_form.banner')" class="invalid-feedback">
                                                    <span v-for="error in errors.collect('rent_validate_add_form.banner')">{{ error }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label for="instagram">Instagram <small class="text-success">(optional)</small></label>
                                                <input type="text" v-validate="'max:50|url'" v-model="rent.instagram" name="instagram" class="form-control" id="instagram" aria-describedby="emailHelp" placeholder="name">
                                                <div class="valid-feedback"></div>
                                                <div v-if="errors.has('rent_validate_add_form.instagram')" class="invalid-feedback">
                                                    <span v-for="error in errors.collect('rent_validate_add_form.instagram')">{{ error }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label for="facebook">Facebook <small class="text-success">(optional)</small></label>
                                                <input type="text" v-validate="'max:50|url'" v-model="rent.facebook" name="facebook" class="form-control" id="facebook" aria-describedby="emailHelp" placeholder="Facebook">
                                                <div class="valid-feedback"></div>
                                                <div v-if="errors.has('rent_validate_add_form.facebook')" class="invalid-feedback">
                                                    <span v-for="error in errors.collect('rent_validate_add_form.facebook')">{{ error }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label for="address">Address <small class="text-success">(optional)</small></label>
                                                <textarea rows="4" cols="50" v-validate="'max:150'" v-model="rent.address" name="address" class="form-control" id="address" aria-describedby="emailHelp" placeholder="Enter Address | less than 250 word" ></textarea>
                                                <div class="valid-feedback"></div>
                                                <div v-if="errors.has('rent_validate_add_form.address')" class="invalid-feedback">
                                                    <span v-for="error in errors.collect('rent_validate_add_form.address')">{{ error }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label for="address">Description <small class="text-success">(optional)</small></label>
                                                <textarea rows="4" cols="50" v-validate="'max:150'" v-model="rent.description" name="description" class="form-control" id="description" aria-describedby="emailHelp" placeholder="Description | less than 250 word" ></textarea>
                                                <div class="valid-feedback"></div>
                                                <div v-if="errors.has('rent_validate_add_form.description')" class="invalid-feedback">
                                                    <span v-for="error in errors.collect('rent_validate_add_form.description')">{{ error }}</span>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer d-flex justify-content-center">
                            <button type="button" class="btn btn-secondary w-25" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger btn-md w-25" placeholder="Write your comment">Add Restaurant</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
// Veevalidate
import { Validator } from 'vee-validate';

export default {
    props: {
      callback: {
        type: Function,
        name: 'load_rent',
      }
    },
    data(){
        return {
            // rent Id
            id:'',
            // Restaurant Object
            rent:{},
            // operational days
            operation_days:{},
            // ADD facilities 
            facilities:{},
            // Banner Preview
            bannerPreview:'',
        }
    },
    /**
     * Methods
     * Create
     *  */ 
    methods:{
        /**
         * Banner Image 
         * File
         *  */ 
        banner(event){
            let fileReader = new FileReader();
            fileReader.onload = (event) =>{
                this.bannerPreview = event.target.result
                this.rent.banner = event.target.result
            },
            // base64 data
            fileReader.readAsDataURL(event.target.files[0]);
        },
        // Create Restauratn
        create_rent(){
                this.$validator.validateAll('rent_validate_add_form').then((result) => {
                    if(result){
                        // post api
                        axios.post('/api/rent',this.rent,{
                        headers : { Authorization : localStorage.getItem("token")}
                        })
                        .then(response=>{
                                this.id = response.data.id;
                            // closing modal
                                $("#rent_add_modal").modal("hide");  
                                //  Flash Message  
                                toast.fire({
                                    icon:'success',
                                    title:'Updated',
                                });
    
                                // Facilities
                                this.facilities = {
                                    geyser : false,
                                    wifi:false,
                                    ac:false,
                                    washing_machine:false,
                                    single_room:true,
                                    double_room:true,
                                    bathroom_attached:true,
                                    fridge:true,
                                    pet_allowed:false,
                                    gym:true,
                                    garden:true,
                                    parking_space:true,
                                    rent_basic_info_id : this.id
    
                                }
                        // Create facilities
                            axios.post('/api/rent_facilities',this.facilities,{
                                headers : { Authorization : localStorage.getItem("token")}
                                })
                                .then(response=>{
                                })
                                this.$emit('load_rent');
    
                        })
                    }
                })
        }
    },
    mounted(){
    }
}
</script>