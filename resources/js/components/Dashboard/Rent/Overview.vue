<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="p-2">
                                <div>
                                    <button class="btn btn-info btn-sm ">Basic Information</button>
                                    <button class="btn btn-warning btn-sm d-flex-justify-content-end" @click="edit()">Edit</button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row py-1">
                                    <div class="col-md-3 col-sm-4">
                                        <h6 class="text-dark">Name:</h6>
                                    </div>
                                    <div class="col-md-9 col-sm-8">
                                        <h6 class="text-muted">{{rent.name}}</h6>
                                    </div>
                                </div>
                                <div class="row py-1">
                                    <div class="col-md-3 col-sm-4">
                                        <h6 class="text-dark">Price:</h6>
                                    </div>
                                    <div class="col-md-9 col-sm-8">
                                        <h6 class="text-muted font-weight-bold">Rs: {{rent.fare}} /-</h6>
                                    </div>
                                </div>
                                <div class="row py-1">
                                    <div class="col-md-3 col-sm-4">
                                        <h6 class="text-dark">Location:</h6>
                                    </div>
                                    <div class="col-md-9 col-sm-8">
                                        <h6 class="text-muted">{{rent.location}}</h6>
                                    </div>
                                </div>
                                <div class="row py-1">
                                    <div class="col-md-3 col-sm-4">
                                        <h6 class="text-dark">Mobile:</h6>
                                    </div>
                                    <div class="col-md-9 col-sm-8">
                                        <h6 class="text-muted">{{rent.mobile_no}}</h6>
                                    </div>
                                </div>
                                <div class="row py-1">
                                    <div class="col-md-3 col-sm-4">
                                        <h6 class="text-dark">Space:</h6>
                                    </div>
                                    <div class="col-md-9 col-sm-8">
                                        <h6 class="text-muted">{{rent.accomodation_size}} People</h6>
                                    </div>
                                </div>
                                <div class="row py-1">
                                    <div class="col-md-3 col-sm-4">
                                        <h6 class="text-dark">Email:</h6>
                                    </div>
                                    <div class="col-md-9 col-sm-8">
                                        <h6 class="text-muted">{{rent.email}}</h6>
                                    </div>
                                </div>
                                <div class="row py-1" v-if="rent.website">
                                    <div class="col-md-3 col-sm-4">
                                        <h6 class="text-dark">Website:</h6>
                                    </div>
                                    <div class="col-md-9 col-sm-8">
                                        <h6 class="text-muted">{{rent.website}}</h6>
                                    </div>
                                </div>
                                <div class="row py-1" v-if="rent.instagram">
                                    <div class="col-md-3 col-sm-4">
                                        <h6 class="text-dark">Instagram:</h6>
                                    </div>
                                    <div class="col-md-9 col-sm-8">
                                        <h6 class="text-muted">{{rent.instagram}}</h6>
                                    </div>
                                </div>
                                <div class="row py-1" v-if="rent.facebook">
                                    <div class="col-md-3 col-sm-4"><h6 class="text-dark">facebook:</h6>
                                    </div>
                                    <div class="col-md-9 col-sm-8">
                                        <a :href="rent.facebook" class="text-primary">
                                            <h6 class="text-muted">{{rent.facebook}}</h6>
                                        </a>
                                    </div>
                                </div>
                                <div class="row py-1">
                                    <div class="col-md-3 col-sm-4">
                                        <h6 class="text-dark">Address:</h6>
                                    </div>
                                    <div class="col-md-9 col-sm-8">
                                        <h6 class="text-muted">{{rent.address}}</h6>
                                    </div>
                                </div>
                                <div class="row py-1">
                                    <div class="col-md-3 col-sm-4">
                                        <h6 class="text-dark">Description:</h6>
                                    </div>
                                    <div class="col-md-9 col-sm-8">
                                        <h6 class="text-muted">{{rent.description}}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- toggles -->
                    <div class="col-md-6">
                        <div class="row">
                            <add-facility v-if="facilities == null" :id="rent.id"></add-facility>
                            <!-- Facilities day -->
                                <div class="col-md-12" v-else>
                                    <div class="card facility">
                                    <div class="p-2">
                                    <button class="btn btn-info btn-sm">Facilities</button>
                                    </div>
                                    <div class="card-body">
                                        <!-- <ul> -->
                                        <div class="row">
                                            <div class="col-md-6 col-sm-6">
                                                <li class="d-flex">
                                                    <span class="text-dark flex-grow-1"><i class="fas fa-subway fa-1x text-secondary mr-2"></i> Geyser </span>
                                                    <toggle-button 
                                                        :value="facilities.geyser"
                                                        @change="facility_update('geyser',facilities.id)"
                                                        :v-model="facilities.geyser"
                                                        :color="{checked:'#28a745',unchecked:'#dc4245'}"
                                                        :labels="{checked: 'On', unchecked: 'Off'}"/>
                                                </li>
                                            </div>
                                            <div class="col-md-6 col-sm-6">
                                                <li class="d-flex">
                                                    <span class="text-dark flex-grow-1"><i class="fas fa-wifi fa-1x text-secondary mr-2"></i> WiFi </span>
                                                    <toggle-button 
                                                        :value="facilities.wifi"
                                                        :v-model="facilities.wifi"
                                                        @change="facility_update('wifi',facilities.id)"
                                                        :color="{checked:'#28a745',unchecked:'#dc4245'}"
                                                        :labels="{checked: 'On', unchecked: 'Off'}"/>
                                                </li>
                                            </div>
                                            <div class="col-md-6 col-sm-6">
                                                <li class="d-flex">
                                                    <span class="text-dark flex-grow-1"><i class="fas fa-fan fa-1x text-secondary mr-2"></i> AC </span>
                                                    <toggle-button 
                                                        :value="facilities.ac"
                                                        :v-model="facilities.ac"
                                                        @change="facility_update('ac',facilities.id)"
                                                        :color="{checked:'#28a745',unchecked:'#dc4245'}"
                                                        :labels="{checked: 'On', unchecked: 'Off'}"/>
                                                </li>
                                            </div>
                                            <div class="col-md-6 col-sm-6">
                                                <li class="d-flex">
                                                    <span class="text-dark flex-grow-1"><i class="fas fa-power-off text-secondary mr-2"></i> Washing Machine </span>
                                                    <toggle-button 
                                                        :value="facilities.washing_machine"
                                                        :v-model="facilities.washing_machine"
                                                        @change="facility_update('washing_machine',facilities.id)"
                                                        :color="{checked:'#28a745',unchecked:'#dc4245'}"
                                                        :labels="{checked: 'On', unchecked: 'Off'}"/>
                                                </li>
                                            </div>
                                            <div class="col-md-6 col-sm-6">
                                                <li class="d-flex">
                                                    <span class="text-dark flex-grow-1"><i class="fas fa-dumbbell text-secondary mr-2"></i> Gym </span>
                                                    <toggle-button 
                                                        :value="facilities.gym"
                                                        :v-model="facilities.gym"
                                                        @change="facility_update('gym',facilities.id)"
                                                        :color="{checked:'#28a745',unchecked:'#dc4245'}"
                                                        :labels="{checked: 'On', unchecked: 'Off'}"/>
                                                </li>
                                            </div>
                                            <div class="col-md-6 col-sm-6">
                                                <li class="d-flex">
                                                    <span class="text-dark flex-grow-1"><i class="fas fa-dog text-secondary mr-2"></i> Pet Allowed </span>
                                                    <toggle-button 
                                                        :value="facilities.pet_allowed"
                                                        :v-model="facilities.pet_allowed"
                                                        @change="facility_update('pet_allowed',facilities.id)"
                                                        :color="{checked:'#28a745',unchecked:'#dc4245'}"
                                                        :labels="{checked: 'On', unchecked: 'Off'}"/>
                                                </li>
                                            </div>
                                            <div class="col-md-6 col-sm-6">
                                                <li class="d-flex">
                                                    <span class="text-dark flex-grow-1"><i class="fas fa-bed text-secondary mr-2"></i> Single Room </span>
                                                    <toggle-button 
                                                        :value="facilities.single_room"
                                                        :v-model="facilities.single_room"
                                                        @change="facility_update('single_room',facilities.id)"
                                                        :color="{checked:'#28a745',unchecked:'#dc4245'}"
                                                        :labels="{checked: 'On', unchecked: 'Off'}"/>
                                                </li>
                                            </div>
                                            <div class="col-md-6 col-sm-6">
                                                <li class="d-flex">
                                                    <span class="text-dark flex-grow-1"><i class="fas fa-bed text-secondary mr-2"></i> Double Room</span>
                                                    <toggle-button 
                                                        :value="facilities.double_room"
                                                        :v-model="facilities.double_room"
                                                        @change="facility_update('double_room',facilities.id)"
                                                        :color="{checked:'#28a745',unchecked:'#dc4245'}"
                                                        :labels="{checked: 'On', unchecked: 'Off'}"/>
                                                </li>
                                            </div>
                                            <div class="col-md-6 col-sm-6">
                                                <li class="d-flex">
                                                    <span class="text-dark flex-grow-1"><i class="fas fa-box text-secondary mr-2"></i>Fridge</span>
                                                    <toggle-button 
                                                        :value="facilities.fridge"
                                                        :v-model="facilities.fridge"
                                                        @change="facility_update('fridge',facilities.id)"
                                                        :color="{checked:'#28a745',unchecked:'#dc4245'}"
                                                        :labels="{checked: 'On', unchecked: 'Off'}"/>
                                                </li>
                                            </div>
                                            <div class="col-md-6 col-sm-6">
                                                <li class="d-flex">
                                                    <span class="text-dark flex-grow-1"><i class="fas fa-tree text-secondary mr-2"></i>Garden</span>
                                                    <toggle-button 
                                                        :value="facilities.garden"
                                                        :v-model="facilities.garden"
                                                        @change="facility_update('garden',facilities.id)"
                                                        :color="{checked:'#28a745',unchecked:'#dc4245'}"
                                                        :labels="{checked: 'On', unchecked: 'Off'}"/>
                                                </li>
                                            </div>
                                            <div class="col-md-6 col-sm-6">
                                                <li class="d-flex">
                                                    <span class="text-dark flex-grow-1"><i class="fas fa-car text-secondary mr-2"></i>Parking Space</span>
                                                    <toggle-button 
                                                        :value="facilities.parking_space"
                                                        :v-model="facilities.parking_space"
                                                        @change="facility_update('parking_space',facilities.id)"
                                                        :color="{checked:'#28a745',unchecked:'#dc4245'}"
                                                        :labels="{checked: 'On', unchecked: 'Off'}"/>
                                                </li>
                                            </div>
                                            <div class="col-md-6 col-sm-6">
                                                <li class="d-flex">
                                                    <span class="text-dark flex-grow-1"><i class="fas fa-sink"></i> Bathroom Attached</span>
                                                    <toggle-button 
                                                        :value="facilities.bathroom_attached"
                                                        :v-model="facilities.bathroom_attached"
                                                        @change="facility_update('bathroom_attached',facilities.id)"
                                                        :color="{checked:'#28a745',unchecked:'#dc4245'}"
                                                        :labels="{checked: 'On', unchecked: 'Off'}"/>
                                                </li>
                                            </div>
                                        </div>
                                        <!-- </ul> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade add_edit_label" id="rent_overview_update_modal" tab0="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header bg-secondary text-white">
                    <h5 class="modal-title" id="exampleModalLongTitle">Update Rent</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <form @submit.prevent="update_overview(rent.id)"  data-vv-scope="rent_validate_update_form">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="row">
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label for="name">Name<span class="text-danger p-1">*</span></label>
                                                <input type="text" v-validate="'required|min:2|max:40'" v-model="rent.name" name="name" class="form-control" id="name" aria-describedby="emailHelp" placeholder="name">
                                                <div class="valid-feedback"></div>
                                                <div v-if="errors.has('rent_validate_update_form.name')" class="invalid-feedback">
                                                    <span v-for="error in errors.collect('rent_validate_update_form.name')">{{ error }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label for="fare">Price<span class="text-danger p-1">*</span></label>
                                                <input type="text" v-validate="'required|numeric|max:6'" v-model="rent.fare" name="fare" class="form-control" id="fare" aria-describedby="emailHelp" placeholder="Monthly Rent">
                                                <div class="valid-feedback"></div>
                                                <div v-if="errors.has('rent_validate_update_form.fare')" class="invalid-feedback">
                                                    <span v-for="error in errors.collect('rent_validate_update_form.fare')">{{ error }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label for="location">Location<span class="text-danger p-1">*</span></label>
                                                <input type="text" autocomplete="off" name="location" v-validate="'required'" @keyup="load_location()"  v-model="rent.location" class="rounded form-control "  placeholder="Location" aria-label="Location">
                                                <ul class="w-100 pl-0" style="position: absolute;z-index:100">
                                                    <li style="list-style:none;cursor:pointer"  class="p-2 text-dark border-bottom bg-light" v-for="(place,index) in places" @click="set_location(place.placeName,place.placeAddress,index)" v-if="index <= 5">
                                                        <span class="font-weight-bold text-dark" style="font-size:13px">{{place.placeName}}</span>
                                                        <span class="d-block text-muted" style="font-size:12px">{{place.placeAddress}}</span>
                                                    </li>
                                                </ul>
                                                <!-- <input type="text" v-validate="'required'" v-model="rent.location" name="location" class="form-control" id="location" aria-describedby="emailHelp" placeholder="Location"> -->
                                                <div class="valid-feedback"></div>
                                                <div v-if="errors.has('rent_validate_update_form.location')" class="invalid-feedback">
                                                    <span v-for="error in errors.collect('rent_validate_update_form.location')">{{ error }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label for="mobile">Mobile No<span class="text-danger p-1">*</span></label>
                                                <input type="text" v-validate="'required|max:10|digits:10'" v-model="rent.mobile_no" name="mobile_no" class="form-control" id="mobile_no" aria-describedby="emailHelp" placeholder="Mobile No">
                                                <div class="valid-feedback"></div>
                                                <div v-if="errors.has('rent_validate_update_form.mobile_no')" class="invalid-feedback">
                                                    <span v-for="error in errors.collect('rent_validate_update_form.mobile_no')">{{ error }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label for="accomodation_size">Accomodation Size<span class="text-danger p-1">*</span></label>
                                                <input type="number" v-validate="'required|numeric|max:5'" v-model="rent.accomodation_size" min="1" name="accomodation_size" class="form-control" id="accomodation_size" aria-describedby="emailHelp" placeholder="Mobile No">
                                                <div class="valid-feedback"></div>
                                                <div v-if="errors.has('rent_validate_update_form.accomodation_size')" class="invalid-feedback">
                                                    <span v-for="error in errors.collect('rent_validate_update_form.accomodation_size')">{{ error }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Email<small class="text-success">(optional)</small></label>
                                                <input type="text" v-validate="'max:45|email'" v-model="rent.email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Email">
                                                <div class="valid-feedback"></div>
                                                <div v-if="errors.has('rent_validate_update_form.email')" class="invalid-feedback">
                                                    <span v-for="error in errors.collect('rent_validate_update_form.email')">{{ error }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label for="instagram">Instagram <small class="text-success">(optional)</small></label>
                                                <input type="text" v-validate="'max:50|url'" v-model="rent.instagram" name="instagram" class="form-control" id="instagram" aria-describedby="emailHelp" placeholder="Instagram">
                                                <div class="valid-feedback"></div>
                                                <div v-if="errors.has('rent_validate_update_form.instagram')" class="invalid-feedback">
                                                    <span v-for="error in errors.collect('rent_validate_update_form.instagram')">{{ error }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label for="facebook">Facebook <small class="text-success">(optional)</small></label>
                                                <input type="text" v-validate="'max:50|url'" v-model="rent.facebook" name="facebook" class="form-control" id="facebook" aria-describedby="emailHelp" placeholder="Facebook">
                                                <div class="valid-feedback"></div>
                                                <div v-if="errors.has('rent_validate_update_form.facebook')" class="invalid-feedback">
                                                    <span v-for="error in errors.collect('rent_validate_update_form.facebook')">{{ error }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label for="address">Address <small class="text-success">(optional)</small></label>
                                                <textarea rows="4" cols="50" v-validate="'max:255'" v-model="rent.address" name="address" class="form-control" id="address" aria-describedby="emailHelp" placeholder="Enter Address | less than 250 word" ></textarea>
                                                <div class="valid-feedback"></div>
                                                <div v-if="errors.has('validate_add_form.address')" class="invalid-feedback">
                                                    <span v-for="error in errors.collect('validate_add_form.address')">{{ error }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-sm-6">
                                            <div class="form-group">
                                                <label for="address">Description <small class="text-success">(optional)</small></label>
                                                <textarea rows="4" cols="50" v-validate="'max:255'" v-model="rent.description" name="description" class="form-control" id="description" aria-describedby="emailHelp" placeholder="Description | less than 250 word" ></textarea>
                                                <div class="valid-feedback"></div>
                                                <div v-if="errors.has('validate_add_form.description')" class="invalid-feedback">
                                                    <span v-for="error in errors.collect('validate_add_form.description')">{{ error }}</span>
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
// Form validation
import { Validator } from 'vee-validate';
import AddFacility from './AddFacility.vue';
export default {
    // Data
    props:['rent','facilities'],
    data(){
        return {
            places:{},
        }
    },
    methods:{
        // load places
        load_location(){
            let location = "\""+ this.rent.location+  "\"";
            if(this.rent.location ==''){
                this.rent.location = '';
                this.places ={};
            }else{
                if(this.rent.location.length > 2){
                // axios.get('https://api.mapbox.com/geocoding/v5/mapbox.places/'+this.rent.location+'.json?access_token=pk.eyJ1IjoicmluemluMjAyMCIsImEiOiJja2szcm1iN3ExZHRiMm9wY3Z5OWx6dnZ4In0.4TuimSiBj9l5OKTybvcrAQ&cachebuster=1611047895214&autocomplete=true&types=place%2Clocality&country=in&worldview=in&limit=8')
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
            this.rent.location = location;
            this.rent.address = this.places[index].placeAddress;
            //longitude
            this.rent.longitude = this.places[index].longitude;
            // latitude
            this.rent.latitude = this.places[index].latitude;
            // Reset location
            this.places = {};
        },
        // Overview edit
        edit(){
            $("#rent_overview_update_modal").modal("show");           
        },
        // Overview update
        update_overview(id){
                this.$validator.validateAll('rent_validate_update_form').then((result) => {
                    if (result) {
                        axios.patch('/api/rent/'+id,this.rent,{
                            headers : { Authorization : localStorage.getItem("token")}
                        })
                        .then(response=>{
                            this.$Progress.start();
                            // Close Modal
                            $("#rent_overview_update_modal").modal("hide");  
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
        facility_update(facility,id){
            // Reverse the boolean
            this.facilities[facility] =! this.facilities[facility];
            // Update function
            axios.patch('/api/rent_facilities/'+id,this.facilities,{
                headers : { Authorization : localStorage.getItem("token")}
            }).then(response=>{})
        },
    },
    components:{AddFacility},
    mounted(){
    }
}
</script>