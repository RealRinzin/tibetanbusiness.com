<template>
    <div>
        <div class="row">
            <div class="col-md-8 card py-3">
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
                                <div class="col-md-4 col-sm-4">
                                    <h6 class="text-dark">Name:</h6>
                                </div>
                                <div class="col-md-8 col-sm-8">
                                    <h6 class="text-muted">{{service.name}}</h6>
                                </div>
                            </div>
                            <div class="row py-1">
                                <div class="col-md-4 col-sm-4">
                                    <h6 class="text-dark">type:</h6>
                                </div>
                                <div class="col-md-8 col-sm-8">
                                    <h6 class="text-muted">{{service.type}}</h6>
                                </div>
                            </div>
                            <div class="row py-1">
                                <div class="col-md-4 col-sm-4">
                                    <h6 class="text-dark">Opening hour:</h6>
                                </div>
                                <div class="col-md-8 col-sm-8">
                                    <h6 class="text-muted">{{service.opening_hour}} a.m</h6>
                                </div>
                            </div>
                            <div class="row py-1">
                                <div class="col-md-4 col-sm-4">
                                    <h6 class="text-dark">Closing hour:</h6>
                                </div>
                                <div class="col-md-8 col-sm-8">
                                    <h6 class="text-muted">{{service.closing_hour}} p.m</h6>
                                </div>
                            </div>
                            <div class="row py-1">
                                <div class="col-md-4 col-sm-4">
                                    <h6 class="text-dark">Location:</h6>
                                </div>
                                <div class="col-md-8 col-sm-8">
                                    <h6 class="text-muted">{{service.location}}</h6>
                                </div>
                            </div>
                            <div class="row py-1" v-if="service.address">
                                <div class="col-md-4 col-sm-4">
                                    <h6 class="text-dark">Address:</h6>
                                </div>
                                <div class="col-md-8 col-sm-8">
                                    <h6 class="text-muted">{{service.address}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card-body">
                            <div class="row py-1">
                                <div class="col-md-4 col-sm-4">
                                    <h6 class="text-dark">Mobile:</h6>
                                </div>
                                <div class="col-md-8 col-sm-8">
                                    <h6 class="text-muted">{{service.mobile_no}}</h6>
                                </div>
                            </div>
                            <div class="row py-1" v-if="service.email">
                                <div class="col-md-4 col-sm-4">
                                    <h6 class="text-dark">Email:</h6>
                                </div>
                                <div class="col-md-8 col-sm-8">
                                    <h6 class="text-muted">{{service.email}} People</h6>
                                </div>
                            </div>
                                <div class="row py-1" v-if="service.facebook">
                                    <div class="col-md-4 col-sm-4"><h6 class="text-dark">facebook:</h6>
                                    </div>
                                    <div class="col-md-8 col-sm-8">
                                        <a :href="service.facebook" class="text-primary">
                                            <h6 class="text-muted">{{service.facebook}}</h6>
                                        </a>
                                    </div>
                                </div>
                                <div class="row py-1" v-if="service.instagram">
                                    <div class="col-md-4 col-sm-4">
                                        <h6 class="text-dark">Instagram:</h6>
                                    </div>
                                    <div class="col-md-8 col-sm-8">
                                        <h6 class="text-muted">{{service.instagram}}</h6>
                                    </div>
                                </div>
                                <div class="row py-1" v-if="service.website">
                                    <div class="col-md-4 col-sm-4">
                                        <h6 class="text-dark">Website:</h6>
                                    </div>
                                    <div class="col-md-8 col-sm-8">
                                        <h6 class="text-muted">{{service.website}}</h6>
                                    </div>
                                </div>
                                <div class="row py-1" v-if="service.description">
                                    <div class="col-md-4 col-sm-4">
                                        <h6 class="text-dark">Description:</h6>
                                    </div>
                                    <div class="col-md-8 col-sm-8">
                                        <h6 class="text-muted">{{service.description}}</h6>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Working day -->
            <div class="col-md-4">
                <div class="row">
                    <!-- Operation day -->
                    <div class="col-md-12">
                        <div class="card facility">
                            <div class="p-2">
                            <button class="btn btn-info btn-sm">Operating Days</button>
                            </div>
                            <div class="card-body">
                                <!-- <ul> -->
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <li class="d-flex">
                                            <span class="text-dark h6 flex-grow-1">Monday</span>
                                            <toggle-button 
                                                :value="operation.monday"
                                                :v-model="operation.monday"
                                                @change="day_update('monday',operation.id)"
                                                :color="{checked:'#28a745',unchecked:'#dc4245'}"
                                                :labels="{checked: 'On', unchecked: 'Off'}"/>
                                        </li>
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                        <li class="d-flex">
                                            <span class="text-dark h6 flex-grow-1">Tuesday</span>
                                            <toggle-button 
                                                :value="operation.tuesday"
                                                :v-model="operation.tuesday"
                                                @change="day_update('tuesday',operation.id)"
                                                :color="{checked:'#28a745',unchecked:'#dc4245'}"
                                                :labels="{checked: 'On', unchecked: 'Off'}"/>
                                        </li>
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                        <li class="d-flex">
                                            <span class="text-dark h6 flex-grow-1">Wednesday</span>
                                            <toggle-button 
                                                :value="operation.wednesday"
                                                :v-model="operation.wednesday"
                                                @change="day_update('wednesday',operation.id)"
                                                :color="{checked:'#28a745',unchecked:'#dc4245'}"
                                                :labels="{checked: 'On', unchecked: 'Off'}"/>
                                        </li>
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                        <li class="d-flex">
                                            <span class="text-dark h6 flex-grow-1">Thursday</span>
                                            <toggle-button 
                                                :value="operation.thursday"
                                                :v-model="operation.thursday"
                                                @change="day_update('thursday',operation.id)"
                                                :color="{checked:'#28a745',unchecked:'#dc4245'}"
                                                :labels="{checked: 'On', unchecked: 'Off'}"/>
                                        </li>
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                        <li class="d-flex">
                                            <span class="text-dark h6 flex-grow-1">Friday</span>
                                            <toggle-button 
                                                :value="operation.friday"
                                                :v-model="operation.friday"
                                                @change="day_update('friday',operation.id)"
                                                :color="{checked:'#28a745',unchecked:'#dc4245'}"
                                                :labels="{checked: 'On', unchecked: 'Off'}"/>
                                        </li>
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                        <li class="d-flex">
                                            <span class="text-dark h6 flex-grow-1">Saturday</span>
                                            <toggle-button 
                                                :value="operation.saturday"
                                                :v-model="operation.saturday"
                                                @change="day_update('saturday',operation.id)"
                                                :color="{checked:'#28a745',unchecked:'#dc4245'}"
                                                :labels="{checked: 'On', unchecked: 'Off'}"/>
                                        </li>
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                        <li class="d-flex">
                                            <span class="text-dark h6 flex-grow-1">Sunday</span>
                                            <toggle-button 
                                                :value="operation.sunday"
                                                :v-model="operation.sunday"
                                                @change="day_update('sunday',operation.id)"
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
<!-- Modal -->
        <div class="modal fade add_edit_label" id="service_overview_update_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header bg-gradient-danger">
                    <h5 class="modal-title" id="exampleModalLongTitle">Update Service</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <form @submit.prevent="update_overview(service.id)"  data-vv-scope="service_validate_add_form">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="row">
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
                                                <select v-validate="'required'" v-model="service.type" name="type" class="form-control" id="type">
                                                    <option value="" selected disabled>Service Type</option>
                                                    <option v-for="category in categories" :value="category.name">{{category.name}}</option>
                                                </select>
                                                <div class="valid-feedback"></div>
                                                <div v-if="errors.has('service_validate_add_form.type')" class="invalid-feedback">
                                                    <span v-for="error in errors.collect('service_validate_add_form.type')">{{ error }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label for="location">Location<span class="text-danger p-1">*</span></label>
                                                 <input type="text" autocomplete="off" name="location" v-validate="'required'" @keyup="load_location()"  v-model="service.location" class="rounded form-control "  placeholder="Location" aria-label="Location">
                                                <ul class="w-100 pl-0" style="position: absolute;z-index:100">
                                                    <li style="list-style:none;cursor:pointer"  class="py-2 text-dark border-bottom bg-light" v-for="(place,index) in places" @click="set_location(place.text,place.context[0].text,index)"><i class="fas fa-map-marker mx-2 text-muted"></i> {{place.text}}, {{place.context[0].text}}</li>
                                                </ul>
                                                <!-- <input type="text" v-validate="'required|min:2|max:40'" v-model="service.location" name="location" class="form-control" id="location" aria-describedby="emailHelp" placeholder="name"> -->
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
                                                <label for="deadline">Email<small class="text-success">(optional)</small></label>
                                                <input type="text" v-validate="'min:10|max:40'" v-model="service.email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="name">
                                                <div class="valid-feedback"></div>
                                                <div v-if="errors.has('service_validate_add_form.email')" class="invalid-feedback">
                                                    <span v-for="error in errors.collect('service_validate_add_form.email')">{{ error }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label for="deadline">Address<small class="text-success">(optional)</small></label>
                                                <textarea row="5" cols="50" v-validate="'min:2|max:255'" v-model="service.address" name="address" class="form-control" id="address" aria-describedby="emailHelp" placeholder="name"></textarea>
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
                                                <label for="description">Service Description <small class="text-success">(optional)</small></label>
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
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger btn-md" placeholder="Write your comment">Update</button>
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
    props:['service','operation'],
    data(){
        return{
            id:this.service.id,
            places:{},
            categories:{},
        }
    },
    methods:{
            // load places
        load_location(){
            if(this.service.location ==''){
                this.service.location = '';
                this.places ={};
            }else{
                if(this.service.location.length > 2){
                axios.get('https://api.mapbox.com/geocoding/v5/mapbox.places/'+this.service.location+'.json?access_token=pk.eyJ1IjoicmluemluMjAyMCIsImEiOiJja2szcm1iN3ExZHRiMm9wY3Z5OWx6dnZ4In0.4TuimSiBj9l5OKTybvcrAQ&cachebuster=1611047895214&autocomplete=true&types=place%2Clocality&country=in&worldview=in&limit=8')
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
            this.service.location = location+', '+city;;
            this.service.address = this.places[index].place_name;
            //longitude
            this.service.longitude = this.places[index].center[0];
            // latitude
            this.service.latitude = this.places[index].center[1];
            this.places = {};
        },
        // editing
        edit(){
            $("#service_overview_update_modal").modal("show");           
        },
        // Update
        update_overview(id){
                this.$validator.validateAll('service_validate_add_form').then((result) => {
                    if (result) {
                        axios.patch('/api/service/'+id,this.service,{
                            headers : { Authorization : localStorage.getItem("token")}
                        })
                        .then(response=>{
                            this.$Progress.start();
                            // Close Modal
                            $("#service_overview_update_modal").modal("hide");  
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
        // Toggle day update
        day_update(day,id){
            console.log(day,id);
            // Day reverse toggle
            this.operation[day] =! this.operation[day];
            // Update function
            axios.patch('/api/service_working_day/'+id,this.operation,{
                headers : { Authorization : localStorage.getItem("token")}
            })
            .then(response=>{
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
        axios.get('/api/categories/service')
        .then(response=>{
            this.categories = response.data;
        })
    }
}
</script>