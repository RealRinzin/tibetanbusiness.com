<template>
    <div>
        <div class="row" id="toggle">
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
                                <div class="row py-1">
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

                                <div class="row py-1">
                                    <div class="col-md-3 col-sm-4">
                                        <h6 class="text-dark">Address:</h6>
                                    </div>
                                    <div class="col-md-9 col-sm-8">
                                        <h6 class="text-muted">{{restaurant.address}}</h6>
                                    </div>
                                </div>
                                <div class="row py-1">
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
                            <!-- Operation day -->
                            <div class="col-md-12">
                                <div class="card facility">
                                    <div class="p-2">
                                    <button class="btn btn-info btn-sm">Operating Days</button>
                                    </div>
                                    <div class="card-body">
                                        <!-- <ul> -->
                                        <div class="row">
                                            <div class="col-md-4 col-sm-6">
                                                <li class="d-flex">
                                                    <span class="text-dark h6 flex-grow-1">Monday</span>
                                                        <input type="checkbox" id="monday" v-model="operation.monday"><label for="monday"></label>
                                                </li>
                                            </div>
                                            <div class="col-md-4 col-sm-6">
                                                <li class="d-flex">
                                                    <span class="text-dark h6 flex-grow-1">Tuesday</span>
                                                    <input type="checkbox" id="tuesday" v-model="operation.tuesday"><label for="tuesday"></label>
                                                </li>
                                            </div>
                                            <div class="col-md-4 col-sm-6">
                                                <li class="d-flex">
                                                    <span class="text-dark h6 flex-grow-1">Wednesday</span>
                                                    <input type="checkbox" id="wednesday" v-model="operation.wednesday"><label for="wednesday"></label>
                                                </li>
                                            </div>
                                            <div class="col-md-4 col-sm-6">
                                                <li class="d-flex">
                                                    <span class="text-dark h6 flex-grow-1">Thursday</span>
                                                        <input type="checkbox" id="thursday" v-model="operation.thursday"><label for="thursday"></label>

                                                </li>
                                            </div>
                                            <div class="col-md-4 col-sm-6">
                                                <li class="d-flex">
                                                    <span class="text-dark h6 flex-grow-1">Friday</span>
                                                    <input type="checkbox" id="friday" v-model="operation.friday"><label for="friday"></label>
                                                </li>
                                            </div>
                                            <div class="col-md-4 col-sm-6">
                                                <li class="d-flex">
                                                    <span class="text-dark h6 flex-grow-1">Saturday</span>
                                                        <input type="checkbox" id="saturday" v-model="operation.saturday"><label for="saturday"></label>
                                                </li>
                                            </div>
                                            <div class="col-md-4 col-sm-6">
                                                <li class="d-flex">
                                                    <span class="text-dark h6 flex-grow-1">Sunday</span>
                                                        <input type="checkbox" id="sunday" v-model="operation.sunday"><label for="sunday"></label>
                                                </li>
                                            </div>
                                            <!-- update -->
                                            <div class="col-md-12 border-top text-right pt-1">
                                                <button class="btn btn-danger btn-md" @click="update_operation_days(operation.id)">Update</button>
                                            </div>
                                        </div>
                                        <!-- </ul> -->
                                    </div>
                                </div>
                            </div>
                            <!-- Facilities day -->
                                <div class="col-md-12">
                                    <div class="card facility">
                                    <div class="p-2">
                                    <button class="btn btn-info btn-sm">Facilities</button>
                                    </div>
                                    <div class="card-body">
                                        <!-- <ul> -->
                                        <div class="row">
                                            <div class="col-md-6 col-sm-6">
                                                <li class="d-flex">
                                                    <span class="text-dark flex-grow-1"><i class="fas fa-motorcycle fa-1x text-secondary mr-2"></i> Home Delivery </span>
                                                    <label class="switch">
                                                    <input type="checkbox" v-model="facilities.home_delivery">
                                                    <span class="slider round"></span>
                                                    </label>
                                                </li>
                                            </div>
                                            <div class="col-md-6 col-sm-6">
                                                <li class="d-flex">
                                                    <span class="text-dark flex-grow-1"><i class="fas fa-wifi fa-1x text-secondary mr-2"></i> WiFi </span>
                                                    <label class="switch">
                                                    <input type="checkbox" v-model="facilities.wifi">
                                                    <span class="slider round"></span>
                                                    </label>
                                                </li>
                                            </div>
                                            <div class="col-md-6 col-sm-6">
                                                <li class="d-flex">
                                                    <span class="text-dark flex-grow-1"><i class="fab fa-cc-visa mr-1 fa-1x text-secondary mr-2"></i> Card Payment </span>
                                                    <label class="switch">
                                                    <input type="checkbox" v-model="facilities.card_payment">
                                                    <span class="slider round"></span>
                                                    </label>
                                                </li>
                                            </div>
                                            <div class="col-md-6 col-sm-6">
                                                <li class="d-flex">
                                                    <span class="text-dark flex-grow-1"><i class="fa fa-fan mr-1 fa-1x text-secondary mr-2"></i> AC </span>
                                                    <label class="switch">
                                                    <input type="checkbox" v-model="facilities.ac">
                                                    <span class="slider round"></span>
                                                    </label>
                                                </li>
                                            </div>
                                            <div class="col-md-6 col-sm-6">
                                                <li class="d-flex">
                                                    <span class="text-dark flex-grow-1"><i class="fas fa-glass-cheers text-secondary mr-2"></i> Party Booking </span>
                                                    <label class="switch">
                                                    <input type="checkbox" v-model="facilities.party_booking">
                                                    <span class="slider round"></span>
                                                    </label>
                                                </li>
                                            </div>
                                            <div class="col-md-6 col-sm-6">
                                                <li class="d-flex">
                                                    <span class="text-dark flex-grow-1"><i class="far fa-stop-circle text-secondary mr-2"></i> Veg </span>
                                                    <label class="switch">
                                                    <input type="checkbox" v-model="facilities.veg">
                                                    <span class="slider round"></span>
                                                    </label>
                                                </li>
                                            </div>
                                            <div class="col-md-6 col-sm-6">
                                                <li class="d-flex">
                                                    <span class="text-dark flex-grow-1"><i class="far fa-stop-circle text-secondary mr-2"></i> Non-Veg </span>
                                                    <label class="switch">
                                                    <input type="checkbox" v-model="facilities.none_veg">
                                                    <span class="slider round"></span>
                                                    </label>
                                                </li>
                                            </div>
                                            <div class="col-md-6 col-sm-6">
                                                <li class="d-flex">
                                                    <span class="text-dark flex-grow-1"><i class="fas fa-car text-secondary mr-2"></i> Parking </span>
                                                    <label class="switch">
                                                    <input type="checkbox" v-model="facilities.parking_lot">
                                                    <span class="slider round"></span>
                                                    </label>
                                                </li>
                                            </div>
                                            <div class="col-md-6 col-sm-6">
                                                <li class="d-flex">
                                                    <span class="text-dark flex-grow-1"><i class="fas fa-building text-secondary mr-2"></i> Roof Top</span>
                                                    <label class="switch">
                                                    <input type="checkbox" v-model="facilities.roof_top">
                                                    <span class="slider round"></span>
                                                    </label>
                                                </li>
                                            </div>
                                            <div class="col-md-6 col-sm-6">
                                                <li class="d-flex">
                                                    <span class="text-dark flex-grow-1"><i class="fas fa-beer text-secondary mr-2"></i>Beverage</span>
                                                    <label class="switch">
                                                    <input type="checkbox" v-model="facilities.beverage">
                                                    <span class="slider round"></span>
                                                    </label>
                                                </li>
                                            </div>
                                            <!-- update -->
                                            <div class="col-md-12 border-top text-right pt-1">
                                                <button class="btn btn-info" @click="update_facility(facilities.id)">Update</button>
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
        <div class="modal fade" id="overview_update_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
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
                                                <select v-validate="'required'" v-model="restaurant.location" name="location" class="form-control" id="location">
                                                    <option :value="restaurant.location" selected>{{restaurant.location}}</option>
                                                    <option v-for="location in locations" :value="location.name">{{location.name}}</option>
                                                </select>
                                                <!-- <input type="text" v-validate="'required'" v-model="restaurant.location" name="location" class="form-control" id="location" aria-describedby="emailHelp" placeholder="Location"> -->
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
                                                <label for="exampleInputEmail1">Email<span class="text-danger p-1">*</span></label>
                                                <input type="text" v-validate="'required|max:45|email'" v-model="restaurant.email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Email">
                                                <div class="valid-feedback"></div>
                                                <div v-if="errors.has('validate_update_form.email')" class="invalid-feedback">
                                                    <span v-for="error in errors.collect('validate_update_form.email')">{{ error }}</span>
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
export default {
    // Data
    props:['restaurant','operation','facilities'],
    data(){
        return {
            locations:{},
        }
    },
    methods:{
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
        update_operation_days(id){
            axios.patch('/api/restaurant_operation_days/'+id,this.operation,{
                headers : { Authorization : localStorage.getItem("token")}
            })
            .then(response=>{
                        //  Flash Message  
                        toast.fire({
                            icon:'success',
                            title:'Updated Successfully',
                        });
            })
        },
        // update_facility
        update_facility(id){
            axios.patch('/api/restaurant_facilities/'+id,this.facilities,{
                headers : { Authorization : localStorage.getItem("token")}
            }).then(response=>{
                //  Flash Message  
                toast.fire({
                    icon:'success',
                    title:'Facilities Updated',
                });
            })
        }
    },
    mounted(){
        // locations api
        axios.get('/api/location')
        .then(response=>{
            this.locations = response.data;
        })
    }
}
</script>