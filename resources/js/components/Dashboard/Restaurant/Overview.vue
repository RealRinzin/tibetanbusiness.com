<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="p-2">
                                <div>
                                    <button class="btn btn-dark btn-sm ">Basic Information</button>
                                    <button class="btn btn-warning btn-sm d-flex-justify-content-end" @click="edit()">Edit</button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row py-1">
                                    <div class="col-md-3 col-sm-4">
                                        <h6 class="text-dark">Name:</h6>
                                    </div>
                                    <div class="col-md-9 col-sm-8">
                                        <h6 class="text-muted">{{restaurant.name}}</h6>
                                    </div>
                                </div>
                                <div class="row py-1">
                                    <div class="col-md-3 col-sm-4">
                                        <h6 class="text-dark">Location:</h6>
                                    </div>
                                    <div class="col-md-9 col-sm-8">
                                        <h6 class="text-muted">{{restaurant.location}}</h6>
                                    </div>
                                </div>
                                <div class="row py-1">
                                    <div class="col-md-3 col-sm-4">
                                        <h6 class="text-dark">Mobile:</h6>
                                    </div>
                                    <div class="col-md-9 col-sm-8">
                                        <h6 class="text-muted">{{restaurant.mobile_no}}</h6>
                                    </div>
                                </div>
                                <div class="row py-1" v-if="restaurant.email">
                                    <div class="col-md-3 col-sm-4">
                                        <h6 class="text-dark">Email:</h6>
                                    </div>
                                    <div class="col-md-9 col-sm-8">
                                        <h6 class="text-muted">{{restaurant.email}}</h6>
                                    </div>
                                </div>
                                <div class="row py-1" v-if="restaurant.website">
                                    <div class="col-md-3 col-sm-4">
                                        <h6 class="text-dark">Website:</h6>
                                    </div>
                                    <div class="col-md-9 col-sm-8">
                                        <h6 class="text-muted">{{restaurant.website}}</h6>
                                    </div>
                                </div>
                                <div class="row py-1" v-if="restaurant.instagram">
                                    <div class="col-md-3 col-sm-4">
                                        <h6 class="text-dark">Instagram:</h6>
                                    </div>
                                    <div class="col-md-9 col-sm-8">
                                        <h6 class="text-muted">{{restaurant.instagram}}</h6>
                                    </div>
                                </div>
                                <div class="row py-1" v-if="restaurant.facebook">
                                    <div class="col-md-3 col-sm-4"><h6 class="text-dark">facebook:</h6>
                                    </div>
                                    <div class="col-md-9 col-sm-8">
                                        <a :href="restaurant.facebook" class="text-primary">
                                            <h6 class="text-muted">{{restaurant.facebook}}</h6>
                                        </a>
                                    </div>
                                </div>

                                <div class="row py-1" v-if="restaurant.address">
                                    <div class="col-md-3 col-sm-4">
                                        <h6 class="text-dark">Address:</h6>
                                    </div>
                                    <div class="col-md-9 col-sm-8">
                                        <h6 class="text-muted">{{restaurant.address}}</h6>
                                    </div>
                                </div>
                                <div class="row py-1" v-if="restaurant.description">
                                    <div class="col-md-3 col-sm-4">
                                        <h6 class="text-dark">Description:</h6>
                                    </div>
                                    <div class="col-md-9 col-sm-8">
                                        <h6 class="text-muted">{{restaurant.description}}</h6>
                                    </div>
                                </div>
                                <div class="row py-1">
                                    <div class="col-md-3 col-sm-4">
                                        <h6 class="text-dark">Operating Hour:</h6>
                                    </div>
                                    <div class="col-md-9 col-sm-8">
                                        <h6 class="text-muted">{{restaurant.opening_hour}} - {{restaurant.closing_hour}}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- toggles -->
                    <div class="col-md-6">
                        <div class="row">
                            <add-day v-if="operation == null" :id="restaurant.id"></add-day>
                            <div class="col-md-12" v-else>
                                <div class="card facility">
                                    <div class="p-2">
                                    <button class="btn btn-dark btn-sm">Operating Days</button>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4 col-sm-6">
                                                <li class="d-flex">
                                                    <span class="text-dark h6 flex-grow-1">Monday</span>
                                                    <toggle-button 
                                                        :value="operation.monday"
                                                        @change="update_operation_days('monday',operation.id)"
                                                        :v-model="operation.monday"
                                                        :color="{checked:'#28a745',unchecked:'#dc4245'}"
                                                        :labels="{checked: 'On', unchecked: 'Off'}"/>
                                                </li>
                                            </div>
                                            <div class="col-md-4 col-sm-6">
                                                <li class="d-flex">
                                                    <span class="text-dark h6 flex-grow-1">Tuesday</span>
                                                    <toggle-button 
                                                        :value="operation.tuesday"
                                                        :v-model="operation.tuesday"
                                                        @change="update_operation_days('tuesday',operation.id)"
                                                        :color="{checked:'#28a745',unchecked:'#dc4245'}"
                                                        :labels="{checked: 'On', unchecked: 'Off'}"/>
                                                </li>
                                            </div>
                                            <div class="col-md-4 col-sm-6">
                                                <li class="d-flex">
                                                    <span class="text-dark h6 flex-grow-1">Wednesday</span>
                                                    <toggle-button 
                                                        :v-model="operation.wednesday"
                                                        :value="operation.wednesday"
                                                        @change="update_operation_days('wednesday',operation.id)"
                                                        :color="{checked:'#28a745',unchecked:'#dc4245'}"
                                                        :labels="{checked: 'On', unchecked: 'Off'}"/>
                                                </li>
                                            </div>
                                            <div class="col-md-4 col-sm-6">
                                                <li class="d-flex">
                                                    <span class="text-dark h6 flex-grow-1">Thursday</span>
                                                    <toggle-button 
                                                        :v-model="operation.thursday"
                                                        @change="update_operation_days('thursday',operation.id)"
                                                        :value="operation.thursday"
                                                        :color="{checked:'#28a745',unchecked:'#dc4245'}"
                                                        :labels="{checked: 'On', unchecked: 'Off'}"/>
                                                </li>
                                            </div>
                                            <div class="col-md-4 col-sm-6">
                                                <li class="d-flex">
                                                    <span class="text-dark h6 flex-grow-1">Friday</span>
                                                    <toggle-button 
                                                        :v-model="operation.friday"
                                                        :value="operation.friday"
                                                        @change="update_operation_days('friday',operation.id)"
                                                        :color="{checked:'#28a745',unchecked:'#dc4245'}"
                                                        :labels="{checked: 'On', unchecked: 'Off'}"/>
                                                </li>
                                            </div>
                                            <div class="col-md-4 col-sm-6">
                                                <li class="d-flex">
                                                    <span class="text-dark h6 flex-grow-1">Saturday</span>
                                                    <toggle-button 
                                                        :v-model="operation.saturday"
                                                        :value="operation.saturday"
                                                        @change="update_operation_days('saturday',operation.id)"
                                                        :color="{checked:'#28a745',unchecked:'#dc4245'}"
                                                        :labels="{checked: 'On', unchecked: 'Off'}"/>
                                                </li>
                                            </div>
                                            <div class="col-md-4 col-sm-6">
                                                <li class="d-flex">
                                                    <span class="text-dark h6 flex-grow-1">Sunday</span>
                                                    <toggle-button 
                                                        :v-model="operation.sunday"
                                                        @change="update_operation_days('sunday',operation.id)"
                                                        :value="operation.sunday"
                                                        :color="{checked:'#28a745',unchecked:'#dc4245'}"
                                                        :labels="{checked: 'On', unchecked: 'Off'}"/>
                                                </li>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!-- Facilities day -->
                            <add-facility v-if="facilities == null" :restaurant_id="restaurant.id"></add-facility>
                            <!-- <div class="col-md-12" v-if="facilities != null"> -->
                            <div class="col-md-12" v-else>
                                <div class="card facility">
                                <div class="p-2">
                                <button class="btn btn-dark btn-sm">Facilities</button>
                                </div>
                                <div class="card-body">
                                    <!-- <ul> -->
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6">
                                            <li class="d-flex">
                                                <span class="text-dark flex-grow-1"><i class="fas fa-motorcycle fa-1x text-secondary mr-2"></i> Home Delivery </span>
                                                <toggle-button 
                                                    :value="facilities.home_delivery"
                                                    :v-model="facilities.home_delivery"
                                                    @change="update_facility('home_delivery',facilities.id)"
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
                                                    @change="update_facility('wifi',facilities.id)"
                                                    :color="{checked:'#28a745',unchecked:'#dc4245'}"
                                                    :labels="{checked: 'On', unchecked: 'Off'}"/>
                                            </li>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <li class="d-flex">
                                                <span class="text-dark flex-grow-1"><i class="fab fa-cc-visa mr-1 fa-1x text-secondary mr-2"></i> Card Payment </span>
                                                <toggle-button 
                                                    :value="facilities.card_payment"
                                                    :v-model="facilities.card_payment"
                                                    @change="update_facility('card_payment',facilities.id)"
                                                    :color="{checked:'#28a745',unchecked:'#dc4245'}"
                                                    :labels="{checked: 'On', unchecked: 'Off'}"/>
                                            </li>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <li class="d-flex">
                                                <span class="text-dark flex-grow-1"><i class="fa fa-fan mr-1 fa-1x text-secondary mr-2"></i> AC </span>
                                                <toggle-button 
                                                    :value="facilities.ac"
                                                    :v-model="facilities.ac"
                                                    @change="update_facility('ac',facilities.id)"
                                                    :color="{checked:'#28a745',unchecked:'#dc4245'}"
                                                    :labels="{checked: 'On', unchecked: 'Off'}"/>
                                            </li>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <li class="d-flex">
                                                <span class="text-dark flex-grow-1"><i class="fas fa-glass-cheers text-secondary mr-2"></i> Party Booking </span>
                                                <toggle-button 
                                                    :value="facilities.party_booking"
                                                    :v-model="facilities.party_booking"
                                                    @change="update_facility('party_booking',facilities.id)"
                                                    :color="{checked:'#28a745',unchecked:'#dc4245'}"
                                                    :labels="{checked: 'On', unchecked: 'Off'}"/>
                                            </li>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <li class="d-flex">
                                                <span class="text-dark flex-grow-1"><i class="far fa-stop-circle text-secondary mr-2"></i> Veg </span>
                                                <toggle-button 
                                                    :value="facilities.veg"
                                                    :v-model="facilities.veg"
                                                    @change="update_facility('veg',facilities.id)"
                                                    :color="{checked:'#28a745',unchecked:'#dc4245'}"
                                                    :labels="{checked: 'On', unchecked: 'Off'}"/>
                                            </li>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <li class="d-flex">
                                                <span class="text-dark flex-grow-1"><i class="far fa-stop-circle text-secondary mr-2"></i> Non-Veg </span>
                                                <toggle-button 
                                                    :value="facilities.none_veg"
                                                    :v-model="facilities.none_veg"
                                                    @change="update_facility('none_veg',facilities.id)"
                                                    :color="{checked:'#28a745',unchecked:'#dc4245'}"
                                                    :labels="{checked: 'On', unchecked: 'Off'}"/>
                                            </li>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <li class="d-flex">
                                                <span class="text-dark flex-grow-1"><i class="fas fa-car text-secondary mr-2"></i> Parking </span>
                                                <toggle-button 
                                                    :value="facilities.parking_lot"
                                                    :v-model="facilities.parking_lot"
                                                    @change="update_facility('parking_lot',facilities.id)"
                                                    :color="{checked:'#28a745',unchecked:'#dc4245'}"
                                                    :labels="{checked: 'On', unchecked: 'Off'}"/>
                                            </li>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <li class="d-flex">
                                                <span class="text-dark flex-grow-1"><i class="fas fa-building text-secondary mr-2"></i> Roof Top</span>
                                                <toggle-button 
                                                    :value="facilities.roof_top"
                                                    :v-model="facilities.roof_top"
                                                    @change="update_facility('roof_top',facilities.id)"
                                                    :color="{checked:'#28a745',unchecked:'#dc4245'}"
                                                    :labels="{checked: 'On', unchecked: 'Off'}"/>
                                            </li>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <li class="d-flex">
                                                <span class="text-dark flex-grow-1"><i class="fas fa-beer text-secondary mr-2"></i>Beverage</span>
                                                <toggle-button 
                                                    :value="facilities.beverage"
                                                    :v-model="facilities.beverage"
                                                    @change="update_facility('beverage',facilities.id)"
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
        <div class="modal fade add_edit_label" id="overview_update_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header bg-secondary text-white">
                    <h5 class="modal-title" id="exampleModalLongTitle">Update Restaurant</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <form @submit.prevent="update_overview(restaurant.id)"  data-vv-scope="validate_update_form">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="row">
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label for="name">Name<span class="text-danger p-1">*</span></label>
                                                <input type="text" v-validate="'required|min:2|max:40'" v-model="restaurant.name" name="name" class="form-control" id="name" aria-describedby="emailHelp" placeholder="name">
                                                <div class="valid-feedback"></div>
                                                <div v-if="errors.has('validate_update_form.name')" class="invalid-feedback">
                                                    <span v-for="error in errors.collect('validate_update_form.name')">{{ error }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label for="location">Location<span class="text-danger p-1">*</span></label>
                                                <input type="text" autocomplete="off" name="location" v-validate="'required'" @keyup="load_location()"  v-model="restaurant.location" class="rounded form-control "  placeholder="Location" aria-label="Location">
                                                <ul class="w-100 pl-0" style="position: absolute;z-index:100">
                                                    <li style="list-style:none;cursor:pointer"  class="py-2 text-dark border-bottom bg-light" v-for="(place,index) in places" @click="set_location(place.text,place.context[0].text,index)"><i class="fas fa-map-marker mx-2 text-muted"></i> {{place.text}}, {{place.context[0].text}}</li>
                                                </ul>
                                                <div class="valid-feedback"></div>
                                                <div v-if="errors.has('validate_update_form.location')" class="invalid-feedback">
                                                    <span v-for="error in errors.collect('validate_update_form.location')">{{ error }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label for="mobile">Mobile No<span class="text-danger p-1">*</span></label>
                                                <input type="text" v-validate="'required|max:10|digits:10'" v-model="restaurant.mobile_no" name="mobile" class="form-control" id="mobile" aria-describedby="emailHelp" placeholder="Mobile No">
                                                <div class="valid-feedback"></div>
                                                <div v-if="errors.has('validate_update_form.mobile')" class="invalid-feedback">
                                                    <span v-for="error in errors.collect('validate_update_form.mobile')">{{ error }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Opening Hour<span class="text-danger p-1">*</span></label>
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
                                                <div v-if="errors.has('validate_update_form.closing_hour')" class="invalid-feedback">
                                                    <span v-for="error in errors.collect('validate_update_form.closing_hour')">{{ error }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Closing Hour<span class="text-danger p-1">*</span></label>
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
                                                <label for="exampleInputEmail1">Email<small class="text-success p-1">(Optional)</small></label>
                                                <input type="text" v-validate="'max:45|email'" v-model="restaurant.email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Email">
                                                <div class="valid-feedback"></div>
                                                <div v-if="errors.has('validate_update_form.email')" class="invalid-feedback">
                                                    <span v-for="error in errors.collect('validate_update_form.email')">{{ error }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label for="instagram">Instagram <small class="text-success">(optional)</small></label>
                                                <input type="text" v-validate="'max:50|url'" v-model="restaurant.instagram" name="instagram" class="form-control" id="instagram" aria-describedby="emailHelp" placeholder="name">
                                                <div class="valid-feedback"></div>
                                                <div v-if="errors.has('validate_update_form.instagram')" class="invalid-feedback">
                                                    <span v-for="error in errors.collect('validate_update_form.instagram')">{{ error }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label for="facebook">Facebook <small class="text-success">(optional)</small></label>
                                                <input type="text" v-validate="'max:50|url'" v-model="restaurant.facebook" name="facebook" class="form-control" id="facebook" aria-describedby="emailHelp" placeholder="Facebook">
                                                <div class="valid-feedback"></div>
                                                <div v-if="errors.has('validate_update_form.facebook')" class="invalid-feedback">
                                                    <span v-for="error in errors.collect('validate_update_form.facebook')">{{ error }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label for="website">Website <small class="text-success">(optional)</small></label>
                                                <input type="text" v-validate="'max:50|url'" v-model="restaurant.website" name="website" class="form-control" id="website" aria-describedby="emailHelp" placeholder="website">
                                                <div class="valid-feedback"></div>
                                                <div v-if="errors.has('validate_update_form.website')" class="invalid-feedback">
                                                    <span v-for="error in errors.collect('validate_update_form.website')">{{ error }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label for="address">Address <small class="text-success">(optional)</small></label>
                                                <textarea rows="4" cols="50" v-validate="'max:150'" v-model="restaurant.address" name="address" class="form-control" id="address" aria-describedby="emailHelp" placeholder="Enter Address | less than 250 word" ></textarea>
                                                <div class="valid-feedback"></div>
                                                <div v-if="errors.has('validate_add_form.address')" class="invalid-feedback">
                                                    <span v-for="error in errors.collect('validate_add_form.address')">{{ error }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-sm-6">
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
// facility
import AddFacility from './AddFacility.vue';
// operation day
import AddDay from './AddDay.vue';
export default {
    // Data
    props:['restaurant','facilities','operation'],
    data(){
        return {
            places:{},
        }
    },

    methods:{
        // load places
        load_location(){
            if(this.restaurant.location ==''){
                this.restaurant.location = '';
                this.places ={};
            }else{
                if(this.restaurant.location.length > 2){
                axios.get('https://api.mapbox.com/geocoding/v5/mapbox.places/'+this.restaurant.location+'.json?access_token=pk.eyJ1IjoicmluemluMjAyMCIsImEiOiJja2szcm1iN3ExZHRiMm9wY3Z5OWx6dnZ4In0.4TuimSiBj9l5OKTybvcrAQ&cachebuster=1611047895214&autocomplete=true&types=place%2Clocality&country=in&worldview=in&limit=8')
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
            this.restaurant.location = location+', '+city;;
            this.restaurant.address = this.places[index].place_name;
            //longitude
            this.restaurant.longitude = this.places[index].center[0];
            // latitude
            this.restaurant.latitude = this.places[index].center[1];
            this.places = {};
        },
        // Overview edit
        edit(){
            $("#overview_update_modal").modal("show");           
        },
        // Overview update
        update_overview(id){
            if(this.restaurant.closing_hour === undefined || this.restaurant.opening_hour == null || this.restaurant.opening_hour === undefined || this.restaurant.closing_hour == null){
                alert("Please enter the opening or closing hour")
            }else{
                this.$validator.validateAll('validate_update_form').then((result) => {
                    if (result) {
                        axios.patch('/api/restaurant/'+id,this.restaurant,{
                            headers : { Authorization : localStorage.getItem("token")}
                        })
                        .then(response=>{
                            this.$Progress.start();
                            // Close Modal
                            $("#overview_update_modal").modal("hide");  
                            //  Flash Message  
                            toast.fire({
                                icon:'success',
                                title:'Updated',
                            });
                            this.$Progress.finish();

                        })
                    }
                })
            }
        },
        // update_operation_days
        update_operation_days(day,id){
            // Reverse binding
            this.operation[day] =! this.operation[day];
            // Update
            axios.patch('/api/restaurant_operation_days/'+this.operation.id,this.operation,{
                headers : { Authorization : localStorage.getItem("token")}
            })
            .then(response=>{})
        },
        // update_facility
        update_facility(type,id){
            // Reverse toggle
            this.facilities[type] =! this.facilities[type];
            // Update
            axios.patch('/api/restaurant_facilities/'+id,this.facilities,{
                headers : { Authorization : localStorage.getItem("token")}
            }).then(response=>{
            })
        }
    },
    components:{AddFacility,AddDay},
    // Mounted
    mounted(){
    }
}
</script>