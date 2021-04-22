<template>
    <div>
        <!-- Modal -->
        <div class="modal fade add_edit_label" id="restaurant_add_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header bg-gradient-danger">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add New Restaurant</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <form @submit.prevent="create_restaurant()"  data-vv-scope="validate_add_form">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="row">
                                    <div v-if="bannerPreview" class="col-md-12" style="background-size: cover;height: 220px;background-position: center;" v-bind:style='{ backgroundImage: `url(${bannerPreview})`}'>
                                        <!-- <img :src="bannerPreview" alt="" class="img-fluid"> -->
                                    </div>
                                    <div class="col-12 mt-1">
                                        <vue-progress-bar></vue-progress-bar>
                                    </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label for="name">Name<span class="text-danger p-1">*</span></label>
                                                <input type="text" v-validate="'required|min:2|max:40'" v-model="restaurant.name" name="name" class="form-control" id="name" aria-describedby="emailHelp" placeholder="name">
                                                <div class="valid-feedback"></div>
                                                <div v-if="errors.has('validate_add_form.name')" class="invalid-feedback">
                                                    <span v-for="error in errors.collect('validate_add_form.name')">{{ error }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label for="location">Location<span class="text-danger p-1">*</span></label>
                                                <input type="text" autocomplete="off" name="location" v-validate="'required'" @keyup="load_location()"  v-model="restaurant.location" class="rounded form-control "  placeholder="Location" aria-label="Location">
                                                <ul class="w-100 pl-0" style="position: absolute;z-index:100">
                                                    <li style="list-style:none;cursor:pointer"  class="py-2 text-dark border-bottom bg-light" v-for="(place,index) in places" @click="set_location(place.placeName,place.placeAddress,index)" v-if="index <= 5">
                                                        <span class="font-weight-bold text-dark" style="font-size:13px">{{place.placeName}}</span>
                                                        <span class="d-block text-muted" style="font-size:12px">{{place.placeAddress}}</span>
                                                    </li>
                                                </ul>
                                                <div class="valid-feedback"></div>
                                                <div v-if="errors.has('validate_add_form.location')" class="invalid-feedback">
                                                    <span v-for="error in errors.collect('validate_add_form.location')">{{ error }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label for="mobile">Mobile No<span class="text-danger p-1">*</span></label>
                                                <input type="text" maxlength="10" v-validate="'required|max:10|digits:10'" v-model="restaurant.mobile_no" name="mobile" class="form-control" id="mobile" aria-describedby="emailHelp" placeholder="Mobile No">
                                                <div class="valid-feedback"></div>
                                                <div v-if="errors.has('validate_add_form.mobile')" class="invalid-feedback">
                                                    <span v-for="error in errors.collect('validate_add_form.mobile')">{{ error }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label for="opening_hour">Opening Hour<span class="text-danger p-1">*</span></label>
                                                    <VueCtkDateTimePicker id="opening"
                                                    v-model="restaurant.opening_hour"
                                                    :color="'coral'"
                                                    :label="'Select Time'"
                                                    :only-time="true"
                                                    :format ="'hh:mm a'"
                                                    :formatted="'hh:mm a'"
                                                    >
                                                   </VueCtkDateTimePicker>
                                                <div class="valid-feedback"></div>
                                                <div v-if="errors.has('validate_add_form.closing_hour')" class="invalid-feedback">
                                                    <span v-for="error in errors.collect('validate_add_form.closing_hour')">{{ error }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label for="closing_hour">Closing Hour<span class="text-danger p-1">*</span></label>
                                                    <VueCtkDateTimePicker v-validate="'required'" name="closing_hour" id="closing_hour"
                                                    v-model="restaurant.closing_hour"
                                                    :color="'coral'"
                                                    :label="'Select Time'"
                                                    :only-time="true"
                                                    :format ="'hh:mm a'"
                                                    :formatted="'hh:mm a'"
                                                    >
                                                   </VueCtkDateTimePicker>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label for="banner">Banner Image <span class="text-danger p-1">*</span><span class="small text-danger">(Less than 1MB)</span></label>
                                                <div class="custom-file">
                                                    <input type="file" v-validate="'required|image|ext:jpeg,jpg,png,gif|size:1000'" name="banner" @change="banner" id="banner" aria-describedby="emailHelp" placeholder="Website Address" class="custom-file-input">
                                                    <label class="custom-file-label" for="banner">Choose file</label>
                                                    <div v-if="errors.has('validate_add_form.banner')" class="invalid-feedback">
                                                        <span v-for="error in errors.collect('validate_add_form.banner')">{{ error }}</span>
                                                    </div>
                                                </div>
                                                <!-- <input type="file" v-validate="'required|image|ext:jpeg,jpg,png,gif|size:1000'" name="banner" @change="banner" class="form-control" id="banner" aria-describedby="emailHelp" placeholder="Website Address"> -->
                                                <div class="valid-feedback"></div>
                                            </div>
                                        </div>
                                    <!-- Optional Fields -->
                                    <div class="col-12">
                                    <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Optional Fields</button> <span class="text-muted small">You can fill the additional fields</span>
                                    </div>
                                    <div class="collapse" id="collapseExample">
                                        <div class="row p-1">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Email<small class="text-success">(optional)</small></label>
                                                    <input type="text" v-validate="'max:100|email'" v-model="restaurant.email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Email">
                                                    <div class="valid-feedback"></div>
                                                    <div v-if="errors.has('validate_add_form.email')" class="invalid-feedback">
                                                        <span v-for="error in errors.collect('validate_add_form.email')">{{ error }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="instagram">Instagram <small class="text-success">(optional)</small></label>
                                                    <input type="text" v-validate="'max:100|url'" v-model="restaurant.instagram" name="instagram" class="form-control" id="instagram" aria-describedby="emailHelp" placeholder="Instagram Page">
                                                    <div class="valid-feedback"></div>
                                                    <div v-if="errors.has('validate_add_form.instagram')" class="invalid-feedback">
                                                        <span v-for="error in errors.collect('validate_add_form.instagram')">{{ error }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="facebook">Facebook <small class="text-success">(optional)</small></label>
                                                    <input type="text" v-validate="'max:100|url'" v-model="restaurant.facebook" name="facebook" class="form-control" id="facebook" aria-describedby="emailHelp" placeholder="Facebook Link">
                                                    <div class="valid-feedback"></div>
                                                    <div v-if="errors.has('validate_add_form.facebook')" class="invalid-feedback">
                                                        <span v-for="error in errors.collect('validate_add_form.facebook')">{{ error }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="website">Website <small class="text-success">(optional)</small></label>
                                                    <input type="text" v-validate="'max:100|url'" v-model="restaurant.website" name="website" class="form-control" id="website" aria-describedby="emailHelp" placeholder="Website Address">
                                                    <div class="valid-feedback"></div>
                                                    <div v-if="errors.has('validate_add_form.website')" class="invalid-feedback">
                                                        <span v-for="error in errors.collect('validate_add_form.website')">{{ error }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="address">Address <small class="text-success">(optional)</small></label>
                                                    <textarea rows="4" cols="50" v-validate="'max:255'" v-model="restaurant.address" name="address" class="form-control" id="address" aria-describedby="emailHelp" placeholder="Enter Address | less than 250 word" ></textarea>
                                                    <div class="valid-feedback"></div>
                                                    <div v-if="errors.has('validate_add_form.address')" class="invalid-feedback">
                                                        <span v-for="error in errors.collect('validate_add_form.address')">{{ error }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="address">Description <small class="text-success">(optional)</small></label>
                                                    <textarea rows="4" cols="50" v-validate="'max:150'" v-model="restaurant.description" name="description" class="form-control" id="description" aria-describedby="emailHelp" placeholder="Description | less than 250 word" ></textarea>
                                                    <div class="valid-feedback"></div>
                                                    <div v-if="errors.has('validate_add_form.description')" class="invalid-feedback">
                                                        <span v-for="error in errors.collect('validate_add_form.description')">{{ error }}</span>
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
                            <button type="submit" class="btn btn-danger btn-md" placeholder="Write your comment">Add Restaurant</button>
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
        name: 'load_restaurant',
      }
    },
    data(){
        return {
            // restaurant Id
            id:'',
            // Restaurant Object
            restaurant:{
                'longitude':20.96,
                'latitude':78.78
            },
            // operational days
            operation_days:{},
            // ADD facilities 
            facilities:{},
            // Banner Preview
            bannerPreview:'',
            // location
            places:{},
        }
    },
    /**
     * Methods
     * Create
     *  */ 
    methods:{
        // load places
        load_location(){
            let location = "\""+ this.restaurant.location+  "\"";
            if(this.restaurant.location ==''){
                this.restaurant.location = '';
                this.places ={};
            }else{
                if(this.restaurant.location.length > 2){
                // axios.get('https://api.mapbox.com/geocoding/v5/mapbox.places/'+this.restaurant.location+'.json?access_token=pk.eyJ1IjoicmluemluMjAyMCIsImEiOiJja2szcm1iN3ExZHRiMm9wY3Z5OWx6dnZ4In0.4TuimSiBj9l5OKTybvcrAQ&cachebuster=1611047895214&autocomplete=true&types=place%2Clocality&country=in&worldview=in&limit=8')
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
            this.restaurant.location = location;
            this.restaurant.address = this.places[index].placeAddress;
            //longitude
            this.restaurant.longitude = this.places[index].longitude;
            // latitude
            this.restaurant.latitude = this.places[index].latitude;
            // Reset location
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
                this.restaurant.banner = event.target.result
            }
            }else{
                alert("Image size should be less than 1MB")

            }
            // base64 data
            fileReader.readAsDataURL(event.target.files[0]);
        },
        // Create Restauratn
        create_restaurant(){
            if(this.restaurant.closing_hour === undefined || this.restaurant.opening_hour == undefined){
                alert("Please enter the opening or closing hour")
            }else{
                this.$validator.validateAll('validate_add_form').then((result) => {
                    if(result){
                        this.$Progress.start()
                        // post api
                        axios.post('/api/restaurant',this.restaurant,{
                        headers : { Authorization : localStorage.getItem("token")}
                        })
                        .then(response=>{
                            // assign id
                            this.id = response.data.id;
                            // closing modal
                                $("#restaurant_add_modal").modal("hide");  
                                //  Flash Message  
                                toast.fire({
                                    icon:'success',
                                    title:'Updated',
                                });
                                // operations day assign
                                this.operation_days ={
                                    monday : true,
                                    tuesday : true,
                                    wednesday : false,
                                    thursday : true,
                                    friday : false,
                                    saturday : false,
                                    sunday : true,
                                    restaurant_basic_info_id : this.id
                                }
                                // Facilities
                                this.facilities = {
                                    home_delivery : false,
                                    wifi:true,
                                    party_booking:false,
                                    roof_top:false,
                                    ac:true,
                                    veg:true,
                                    none_veg:true,
                                    beverage:true,
                                    parking_lot:false,
                                    card_payment:true,
                                    restaurant_basic_info_id : this.id
    
                                }
                        // Create Operation day
                            // axios.post('/api/restaurant_operation_days',this.operation_days,{
                            //     headers : { Authorization : localStorage.getItem("token")}
                            //     })
                            //     .then(response=>{
                            //     })
                        // Create facilities
                            // axios.post('/api/restaurant_facilities',this.facilities,{
                            //     headers : { Authorization : localStorage.getItem("token")}
                            //     })
                            //     .then(response=>{
                            //     })
                            this.$Progress.finish()
                                this.$emit('load_restaurant');
    
                        })
                    }
                })
            }

        }
    },
    mounted(){

    }
}
</script>