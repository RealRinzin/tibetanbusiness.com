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
                    <div class="col-md-6">
                        <div class="card-body">
                            <div class="row py-1">
                                <div class="col-md-6 col-sm-4">
                                    <h6 class="text-dark">Name:</h6>
                                </div>
                                <div class="col-md-6 col-sm-8">
                                    <h6 class="text-muted">{{event.name}}</h6>
                                </div>
                            </div>
                            <div class="row py-1">
                                <div class="col-md-6 col-sm-4">
                                    <h6 class="text-dark">Entry Fee:</h6>
                                </div>
                                <div class="col-md-6 col-sm-8">
                                    <h6 class="text-muted font-weight-bold" v-if="event.entry_fee > 0">Rs {{event.entry_fee}}/-</h6>
                                    <h6 class="text-muted font-weight-bold" v-else>Entry Free</h6>
                                </div>
                            </div>
                            <div class="row py-1">
                                <div class="col-md-6 col-sm-4">
                                    <h6 class="text-dark">category:</h6>
                                </div>
                                <div class="col-md-6 col-sm-8">
                                    <h6 class="text-muted">{{event.category}}</h6>
                                </div>
                            </div>
                            <div class="row py-1">
                                <div class="col-md-6 col-sm-4">
                                    <h6 class="text-dark">Date:</h6>
                                </div>
                                <div class="col-md-6 col-sm-8">
                                    <h6 class="text-muted">{{event.start_date | date}}</h6>
                                </div>
                            </div>

                            <div class="row py-1">
                                <div class="col-md-6 col-sm-4">
                                    <h6 class="text-dark">Timing:</h6>
                                </div>
                                <div class="col-md-6 col-sm-8">
                                    <h6 class="text-muted">{{event.start_time}}<span v-if="event.start_time"> a.m - </span> {{event.end_time}}  <span v-if="event.end_time"> p.m</span></h6>
                                </div>
                            </div>
                            <div class="row py-1">
                                <div class="col-md-6 col-sm-4">
                                    <h6 class="text-dark">End Date:</h6>
                                </div>
                                <div class="col-md-6 col-sm-8">
                                    <h6 class="text-muted">{{event.end_date | date}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card-body">
                                <div class="row py-1">
                                    <div class="col-md-4 col-sm-4">
                                        <h6 class="text-dark">Location:</h6>
                                    </div>
                                    <div class="col-md-8 col-sm-8">
                                        <h6 class="text-muted">{{event.location}}</h6>
                                    </div>
                                </div>
                                <div class="row py-1">
                                    <div class="col-md-4 col-sm-4">
                                        <h6 class="text-dark">Mobile:</h6>
                                    </div>
                                    <div class="col-md-8 col-sm-8">
                                        <h6 class="text-muted">{{event.mobile_no}}</h6>
                                    </div>
                                </div>
                                <div class="row py-1">
                                    <div class="col-md-4 col-sm-4">
                                        <h6 class="text-dark">Email:</h6>
                                    </div>
                                    <div class="col-md-8 col-sm-8">
                                        <h6 class="text-muted">{{event.email}} People</h6>
                                    </div>
                                </div>
    
                                <div class="row py-1" v-if="event.website">
                                    <div class="col-md-4 col-sm-4">
                                        <h6 class="text-dark">Website:</h6>
                                    </div>
                                    <div class="col-md-8 col-sm-8">
                                        <h6 class="text-muted">{{event.website}}</h6>
                                    </div>
                                </div>
                                <div class="row py-1" v-if="event.instagram">
                                    <div class="col-md-4 col-sm-4">
                                        <h6 class="text-dark">Instagram:</h6>
                                    </div>
                                    <div class="col-md-8 col-sm-8">
                                        <h6 class="text-muted">{{event.instagram}}</h6>
                                    </div>
                                </div>
                                <div class="row py-1" v-if="event.facebook">
                                    <div class="col-md-4 col-sm-4"><h6 class="text-dark">facebook:</h6>
                                    </div>
                                    <div class="col-md-8 col-sm-8">
                                        <a :href="event.facebook" class="text-primary">
                                            <h6 class="text-muted">{{event.facebook}}</h6>
                                        </a>
                                    </div>
                                </div>
                                <div class="row py-1">
                                    <div class="col-md-4 col-sm-4">
                                        <h6 class="text-dark">Address:</h6>
                                    </div>
                                    <div class="col-md-8 col-sm-8">
                                        <h6 class="text-muted">{{event.address}}</h6>
                                    </div>
                                </div>
                                <div class="row py-1">
                                    <div class="col-md-4 col-sm-4">
                                        <h6 class="text-dark">Description:</h6>
                                    </div>
                                    <div class="col-md-8 col-sm-8">
                                        <h6 class="text-muted">{{event.description}}</h6>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<!-- Modal -->
        <div class="modal fade add_edit_label" id="event_overview_update_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header bg-secondary text-white">
                    <h5 class="modal-title" id="exampleModalLongTitle">Update Event</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <form @submit.prevent="update_overview(event.id)"  data-vv-scope="event_validate_update_form">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-4 col-sm-6">
                                        <div class="form-group">
                                            <label for="name">Name<span class="text-danger p-1">*</span></label>
                                            <input type="text" v-validate="'required|min:2|max:40'" v-model="event.name" name="name" class="form-control" id="name" aria-describedby="emailHelp" placeholder="name">
                                            <div class="valid-feedback"></div>
                                            <div v-if="errors.has('event_validate_update_form.name')" class="invalid-feedback">
                                                <span v-for="error in errors.collect('event_validate_update_form.name')">{{ error }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <div class="form-group">
                                            <label for="category">Category<span class="text-danger p-1">*</span></label>
                                            <!-- <input type="text" v-validate="'required|min:2|max:40'" v-model="event.category" name="category" class="form-control" id="category" aria-describedby="emailHelp" placeholder="Select Category"> -->
                                                <select v-validate="'required'" v-model="event.category" name="category" class="form-control" id="category">
                                                    <option v-for="category in categories" :value="category.name">{{category.name}}</option>
                                                </select>
                                            <div class="valid-feedback"></div>
                                            <div v-if="errors.has('event_validate_update_form.category')" class="invalid-feedback">
                                                <span v-for="error in errors.collect('event_validate_update_form.category')">{{ error }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <div class="row">
                                            <div class="col-7" v-show="!event.entry_free">
                                                <div class="form-group">
                                                    <label for="entry_fee">Entry Fee<small class="text-success p-1">Optional</small></label>
                                                    <input type="number" min="0" v-validate="'numeric|max:6'" v-model="event.entry_fee" name="entry_fee" class="form-control" id="entry_fee" aria-describedby="emailHelp" placeholder="Entry Fee">
                                                    <div class="valid-feedback"></div>
                                                    <div v-if="errors.has('event_validate_update_form.entry_fee')" class="invalid-feedback">
                                                        <span v-for="error in errors.collect('event_validate_update_form.entry_fee')">{{ error }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-5 pt-4">
                                                <form class="was-validated">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="entry_free" v-model="event.entry_free">
                                                        <label class="custom-control-label text-muted" for="entry_free">Entry Free</label>
                                                        <div class="invalid-feedback"></div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <div class="form-group">
                                            <label for="location">Location<span class="text-danger p-1">*</span></label>
                                                <input type="text" autocomplete="off" name="location" v-validate="'required'" @keyup="load_location()"  v-model="event.location" class="rounded form-control "  placeholder="Location" aria-label="Location">
                                                <ul class="w-100 pl-0" style="position: absolute;z-index:100">
                                                <li style="list-style:none;cursor:pointer"  class="p-2 text-dark border-bottom bg-light" v-for="(place,index) in places" @click="set_location(place.placeName,place.placeAddress,index)" v-if="index <= 5">
                                                    <span class="font-weight-bold text-dark" style="font-size:13px">{{place.placeName}}</span>
                                                    <span class="d-block text-muted" style="font-size:12px">{{place.placeAddress}}</span>
                                                </li>
                                                </ul>
                                            <div class="valid-feedback"></div>
                                            <div v-if="errors.has('event_validate_update_form.location')" class="invalid-feedback">
                                                <span v-for="error in errors.collect('event_validate_update_form.location')">{{ error }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <div class="form-group">
                                            <label for="mobile">Mobile No<span class="text-danger p-1">*</span></label>
                                            <input type="text" v-validate="'max:10|digits:10'" v-model="event.mobile_no" name="mobile_no" class="form-control" id="mobile_no" aria-describedby="emailHelp" placeholder="Mobile No">
                                            <div class="valid-feedback"></div>
                                            <div v-if="errors.has('event_validate_update_form.mobile_no')" class="invalid-feedback">
                                                <span v-for="error in errors.collect('event_validate_update_form.mobile_no')">{{ error }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <div class="form-group">
                                            <label for="email">Email<small class="text-success p-1">(Optional)</small></label>
                                            <input type="text" v-validate="'max:45|email'" v-model="event.email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Email">
                                            <div class="valid-feedback"></div>
                                            <div v-if="errors.has('event_validate_update_form.email')" class="invalid-feedback">
                                                <span v-for="error in errors.collect('event_validate_update_form.email')">{{ error }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6">
                                        <div class="form-group">
                                            <label for="start_date">Starting Date<span class="text-danger p-1">*</span></label>
                                            <input type="date" v-validate="'required'" v-model="event.start_date" name="start_date" class="form-control" id="start_date" aria-describedby="emailHelp" placeholder="Starting Date">
                                            <div class="valid-feedback"></div>
                                            <div v-if="errors.has('event_validate_update_form.start_date')" class="invalid-feedback">
                                                <span v-for="error in errors.collect('event_validate_update_form.start_date')">{{ error }}</span>
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
                                                    <div v-if="errors.has('event_validate_update_form.start_time')" class="invalid-feedback">
                                                        <span v-for="error in errors.collect('event_validate_update_form.start_time')">{{ error }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="start_time"><small>Ends at</small><small class="text-success p-1"> Optional</small></label>
                                                    <input type="time"  v-model="event.end_time" name="end_time" class="form-control" id="end_time" aria-describedby="emailHelp" placeholder="Ending Time">
                                                    <div class="valid-feedback"></div>
                                                    <div v-if="errors.has('event_validate_update_form.end_time')" class="invalid-feedback">
                                                        <span v-for="error in errors.collect('event_validate_update_form.end_time')">{{ error }}</span>
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
                                            <div v-if="errors.has('event_validate_update_form.end_date')" class="invalid-feedback">
                                                <span v-for="error in errors.collect('event_validate_update_form.end_date')">{{ error }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label for="address">Address<small class="text-success p-1">(Optional)</small></label>
                                            <textarea rows="4" cols="50" v-validate="'max:150'" v-model="event.address" name="address" class="form-control" id="address" aria-describedby="emailHelp" placeholder="Address" ></textarea>
                                            <div class="valid-feedback"></div>
                                            <div v-if="errors.has('event_validate_update_form.address')" class="invalid-feedback">
                                                <span v-for="error in errors.collect('event_validate_update_form.address')">{{ error }}</span>
                                            </div>
                                        </div>
                                    </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="facebook">Facebook<small class="text-success p-1">(Optional)</small></label>
                                                    <input  v-validate="'max:255|url'" v-model="event.facebook" name="facebook" class="form-control" id="facebook" aria-describedby="emailHelp" placeholder="Facebook "/>
                                                    <div class="valid-feedback"></div>
                                                    <div v-if="errors.has('event_validate_add_form.facebook')" class="invalid-feedback">
                                                        <span v-for="error in errors.collect('event_validate_add_form.facebook')">{{ error }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="instagram">Instagram<small class="text-success p-1">(Optional)</small></label>
                                                    <input  v-validate="'max:255|url'" v-model="event.instagram" name="instagram" class="form-control" id="instagram" aria-describedby="emailHelp" placeholder="Instagram"/>
                                                    <div class="valid-feedback"></div>
                                                    <div v-if="errors.has('event_validate_add_form.instagram')" class="invalid-feedback">
                                                        <span v-for="error in errors.collect('event_validate_add_form.instagram')">{{ error }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="website">website<small class="text-success p-1">(Optional)</small></label>
                                                    <input  v-validate="'max:255|url'" v-model="event.website" name="website" class="form-control" id="website" aria-describedby="emailHelp" placeholder="Website"/>
                                                    <div class="valid-feedback"></div>
                                                    <div v-if="errors.has('event_validate_add_form.website')" class="invalid-feedback">
                                                        <span v-for="error in errors.collect('event_validate_add_form.website')">{{ error }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label for="description">Event Description <small class="text-success p-1">(Optional)</small></label>
                                            <textarea rows="5" cols="50" v-validate="'max:15000'" v-model="event.description" name="description" class="form-control" id="description" aria-describedby="emailHelp" placeholder="Description " ></textarea>
                                            <div class="valid-feedback"></div>
                                            <div v-if="errors.has('event_validate_update_form.description')" class="invalid-feedback">
                                                <span v-for="error in errors.collect('event_validate_update_form.description')">{{ error }}</span>
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
import format from 'date-fns/format';
export default {
    props:['event'],
    data(){
        return{
            // event:{},
            places:{},
            categories:{},
        }
    },
    methods:{
        load_location(){
            let location = "\""+ this.event.location+  "\"";
            if(this.event.location ==''){
                this.event.location = '';
                this.places ={};
            }else{
                if(this.event.location.length > 2){
                // axios.get('https://api.mapbox.com/geocoding/v5/mapbox.places/'+this.event.location+'.json?access_token=pk.eyJ1IjoicmluemluMjAyMCIsImEiOiJja2szcm1iN3ExZHRiMm9wY3Z5OWx6dnZ4In0.4TuimSiBj9l5OKTybvcrAQ&cachebuster=1611047895214&autocomplete=true&types=place%2Clocality&country=in&worldview=in&limit=8')
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
            this.event.location = location;
            this.event.address = this.places[index].placeAddress;
            //longitude
            this.event.longitude = this.places[index].longitude;
            // latitude
            this.event.latitude = this.places[index].latitude;
            // Reset location
            this.places = {};
        },
        // modal
        edit(){
            $("#event_overview_update_modal").modal("show");           
        },
        // Update
        update_overview(id){
            // Check the entry 
            // Free Status
            if(this.event.entry_free){
                this.event.entry_fee = 0;
            }
            // Update Information
            this.$validator.validateAll('event_validate_update_form').then((result) => {
                if (result) {
                    axios.patch('/api/event/'+id,this.event,{
                        headers : { Authorization : localStorage.getItem("token")}
                    })
                    .then(response=>{
                        this.$Progress.start();
                        // Close Modal
                        $("#event_overview_update_modal").modal("hide");  
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
    // Filters
    filters:{
        date(str){
            return format(new Date(str), 'EE, MMM dd, yyyy');
        }
    },
    mounted(){
        // Events
        axios.get('/api/event-categories')
        .then(response=>{
            this.categories = response.data;
        })
    }
}
</script>