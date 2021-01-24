<template>
    <div>
        <!-- Modal -->
        <div class="modal fade add_edit_label" id="rent_add_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header bg-gradient-danger">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add New Rent</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <form @submit.prevent="create_rent()"  data-vv-scope="rent_validate_add_form">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div v-if="bannerPreview" class="col-md-12" style="background-size: cover;height: 220px;background-position: center;" v-bind:style='{ backgroundImage: `url(${bannerPreview})`}'></div>
                                <div class="mt-1">
                                    <vue-progress-bar></vue-progress-bar>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-sm-6">
                                        <div class="form-group">
                                            <label for="name">Name<span class="text-danger p-1">*</span></label>
                                            <input type="text" v-validate="'required|min:2|max:40'" v-model="rent.name" name="name" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Name">
                                            <div class="valid-feedback"></div>
                                            <div v-if="errors.has('rent_validate_add_form.name')" class="invalid-feedback">
                                                <span v-for="error in errors.collect('rent_validate_add_form.name')">{{ error }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <div class="form-group">
                                            <label for="fare">Price<span class="text-danger p-1">*</span></label>
                                            <input type="text" v-validate="'required|numeric|max:6'" v-model="rent.fare" name="fare" class="form-control" id="fare" aria-describedby="emailHelp" placeholder="Monthly Rent">
                                            <div class="valid-feedback"></div>
                                            <div v-if="errors.has('rent_validate_add_form.fare')" class="invalid-feedback">
                                                <span v-for="error in errors.collect('rent_validate_add_form.fare')">{{ error }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <div class="form-group">
                                            <label for="location">Location<span class="text-danger p-1">*</span></label>
                                            <input type="text" name="location" v-validate="'required'" @keyup="load_location()"  v-model="rent.location" class="rounded form-control "  placeholder="Location" aria-label="Location">
                                            <ul class="w-100 pl-0" style="position: absolute;z-index:100">
                                                <li style="list-style:none;cursor:pointer"  class="py-2 text-dark border-bottom bg-light" v-for="(place,index) in places" @click="set_location(place.text,place.context[0].text,index)"><i class="fas fa-map-marker mx-2 text-muted"></i> {{place.text}}, {{place.context[0].text}}</li>
                                            </ul>
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
                                            <input type="number" min="1" v-validate="'required|numeric|max:5'" v-model="rent.accomodation_size" name="accomodation_size" class="form-control" id="accomodation_size" aria-describedby="emailHelp" placeholder="How many people can stay">
                                            <div class="valid-feedback"></div>
                                            <div v-if="errors.has('rent_validate_add_form.accomodation_size')" class="invalid-feedback">
                                                <span v-for="error in errors.collect('rent_validate_add_form.accomodation_size')">{{ error }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <div class="form-group">
                                            <label for="banner">Banner Image <span class="text-danger p-1">*</span><span class="small text-danger">(Less than 1MB)</span></label>
                                            <div class="custom-file">
                                                <label class="custom-file-label" for="banner">Choose file</label>
                                                <input type="file" v-validate="'required|image|ext:jpeg,jpg,png,gif|size:1000'" name="banner" @change="banner" class="custom-file-input" id="banner" aria-describedby="emailHelp" placeholder="Website Address">
                                                <div class="valid-feedback"></div>
                                                <div v-if="errors.has('rent_validate_add_form.banner')" class="invalid-feedback">
                                                    <span v-for="error in errors.collect('rent_validate_add_form.banner')">{{ error }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                   <div class="col-12">
                                    <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Optional Fields</button> <span class="text-muted small">You can fill the additional fields</span>
                                    </div>
                                    <div class="collapse" id="collapseExample">
                                        <div class="row p-1">
                                            <div class="col-md-4 col-sm-6">
                                                <div class="form-group">
                                                    <label for="email">Email<small class="text-success">(optional)</small></label>
                                                    <input type="text" v-validate="'max:100|email'" v-model="rent.email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Email">
                                                    <div class="valid-feedback"></div>
                                                    <div v-if="errors.has('rent_validate_add_form.email')" class="invalid-feedback">
                                                        <span v-for="error in errors.collect('rent_validate_add_form.email')">{{ error }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-6">
                                                <div class="form-group">
                                                    <label for="instagram">Instagram <small class="text-success">(optional)</small></label>
                                                    <input type="text" v-validate="'max:50|url'" v-model="rent.instagram" name="instagram" class="form-control" id="instagram" aria-describedby="emailHelp" placeholder="Instagram">
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
                                            <div class="col-md-6 col-sm-6">
                                                <div class="form-group">
                                                    <label for="address">Address <small class="text-success">(optional)</small></label>
                                                    <textarea rows="4" cols="50" v-validate="'max:150'" v-model="rent.address" name="address" class="form-control" id="address" aria-describedby="emailHelp" placeholder="Enter Address | less than 250 word" ></textarea>
                                                    <div class="valid-feedback"></div>
                                                    <div v-if="errors.has('rent_validate_add_form.address')" class="invalid-feedback">
                                                        <span v-for="error in errors.collect('rent_validate_add_form.address')">{{ error }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6">
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
                            </div>
                        </div>
                        <div class="modal-footer d-flex justify-content-center">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger btn-md" placeholder="Write your comment">Add Rent</button>
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
            places:{},
            // Restaurant Object
            rent:{},
            // operational days
            // Banner Preview
            bannerPreview:'',
        }
    },
    /**
     * Methods
     * Create
     *  */ 
    methods:{
        // load places
        load_location(){
            if(this.rent.location ==''){
                this.rent.location = '';
                this.places ={};
            }else{
                if(this.rent.location.length > 2){
                axios.get('https://api.mapbox.com/geocoding/v5/mapbox.places/'+this.rent.location+'.json?access_token=pk.eyJ1IjoicmluemluMjAyMCIsImEiOiJja2szcm1iN3ExZHRiMm9wY3Z5OWx6dnZ4In0.4TuimSiBj9l5OKTybvcrAQ&cachebuster=1611047895214&autocomplete=true&types=place%2Clocality&country=in&worldview=in&limit=8')
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
            this.rent.location = location+', '+city;;
            this.rent.address = this.places[index].place_name;
            this.places = {};
        },
        /**
         * Banner Image 
         * File
         *  */ 
        banner(event){
            let fileReader = new FileReader();
            if(event.target.files[0].size < 1000000){
                fileReader.onload = (event) =>{
                    this.bannerPreview = event.target.result
                    this.rent.banner = event.target.result
                }
            }else{
                alert("Image size should be less than 1MB")
            }
            // base64 data
            fileReader.readAsDataURL(event.target.files[0]);
        },
        // Create Restauratn
        create_rent(){
            this.$validator.validateAll('rent_validate_add_form').then((result) => {
                    if(result){
                    this.$Progress.start()
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
                            this.$emit('load_rent');
                            this.$Progress.finish()
                        })
                    }
                })
        }
    },
    mounted(){
    }
}
</script>