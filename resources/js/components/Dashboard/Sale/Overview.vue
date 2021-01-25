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
                                    <h6 class="text-muted">{{sale.name}}</h6>
                                </div>
                            </div>
                            <div class="row py-1">
                                <div class="col-md-6 col-sm-4">
                                    <h6 class="text-dark">price</h6>
                                </div>
                                <div class="col-md-6 col-sm-8">
                                    <h6 class="text-muted font-weight-bold">Rs {{sale.price}}/-</h6>
                                </div>
                            </div>
                            <div class="row py-1">
                                <div class="col-md-6 col-sm-4">
                                    <h6 class="text-dark">Total Item:</h6>
                                </div>
                                <div class="col-md-6 col-sm-8">
                                    <h6 class="text-muted">{{sale.total_item}}</h6>
                                </div>
                            </div>
                            <div class="row py-1">
                                <div class="col-md-6 col-sm-4">
                                    <h6 class="text-dark">Type</h6>
                                </div>
                                <div class="col-md-6 col-sm-8">
                                    <h6 class="text-muted">{{sale.type}}</h6>
                                </div>
                            </div>
                            <div class="row py-1">
                                <div class="col-md-6 col-sm-4">
                                    <h6 class="text-dark">Posted on:</h6>
                                </div>
                                <div class="col-md-6 col-sm-8">
                                    <h6 class="text-muted">{{sale.created_at | date}}</h6>
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
                                        <h6 class="text-muted">{{sale.location}}</h6>
                                    </div>
                                </div>
                                <div class="row py-1">
                                    <div class="col-md-4 col-sm-4">
                                        <h6 class="text-dark">Mobile:</h6>
                                    </div>
                                    <div class="col-md-8 col-sm-8">
                                        <h6 class="text-muted">{{sale.mobile_no}}</h6>
                                    </div>
                                </div>    
                                <div class="row py-1" v-if="sale.address">
                                    <div class="col-md-4 col-sm-4">
                                        <h6 class="text-dark">Address:</h6>
                                    </div>
                                    <div class="col-md-8 col-sm-8">
                                        <h6 class="text-muted">{{sale.address}}</h6>
                                    </div>
                                </div>
                                <div class="row py-1" v-if="sale.description">
                                    <div class="col-md-4 col-sm-4">
                                        <h6 class="text-dark">Description:</h6>
                                    </div>
                                    <div class="col-md-8 col-sm-8">
                                        <h6 class="text-muted">{{sale.description}}</h6>
                                    </div>
                                </div>
                                <div class="row py-1">
                                    <div class="col-md-4 col-sm-4">
                                        <h6 class="text-dark">Updated on:</h6>
                                    </div>
                                    <div class="col-md-8 col-sm-8">
                                        <h6 class="text-muted">{{sale.updated_at |date}}</h6>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<!-- Modal -->
        <div class="modal fade add_edit_label" id="sale_overview_update_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header bg-secondary text-white">
                    <h5 class="modal-title" id="exampleModalLongTitle">Update Sale</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <form @submit.prevent="update_overview(sale.id)"  data-vv-scope="sale_validate_update_form">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-4 col-sm-6">
                                        <div class="form-group">
                                            <label for="name">Name<span class="text-danger p-1">*</span></label>
                                            <input type="text" v-validate="'required|min:2|max:40'" v-model="sale.name" name="name" class="form-control" id="name" aria-describedby="emailHelp" placeholder="name">
                                            <div class="valid-feedback"></div>
                                            <div v-if="errors.has('sale_validate_update_form.name')" class="invalid-feedback">
                                                <span v-for="error in errors.collect('sale_validate_update_form.name')">{{ error }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <div class="form-group">
                                            <label for="name">Product Type<span class="text-danger p-1">*</span></label>
                                                <select v-validate="'required'" v-model="sale.type" name="type" class="form-control" id="type" placeholder="Selected Type">
                                                    <option value="" disabled selected>Product Type</option>
                                                    <option v-for="category in categories" :value="category.name">{{category.name}}</option>
                                                </select>
                                            <div class="valid-feedback"></div>
                                            <div v-if="errors.has('sale_validate_update_form.type')" class="invalid-feedback">
                                                <span v-for="error in errors.collect('sale_validate_update_form.type')">{{ error }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <div class="form-group">
                                            <label for="entry_fee">Price<span class="text-danger p-1">*</span></label>
                                            <input type="text" v-validate="'required|numeric|max:6'" v-model="sale.price" name="price" class="form-control" id="price" aria-describedby="emailHelp" placeholder="Price">
                                            <div class="valid-feedback"></div>
                                            <div v-if="errors.has('sale_validate_update_form.price')" class="invalid-feedback">
                                                <span v-for="error in errors.collect('sale_validate_update_form.price')">{{ error }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <div class="form-group">
                                            <label for="entry_fee">Total Item<span class="text-danger p-1">*</span></label>
                                            <input type="number"  min="1" v-validate="'required|numeric|max:6'" v-model="sale.total_item" name="total_item" class="form-control" id="total_item" aria-describedby="emailHelp" placeholder="Total Item">
                                            <div class="valid-feedback"></div>
                                            <div v-if="errors.has('sale_validate_update_form.total_item')" class="invalid-feedback">
                                                <span v-for="error in errors.collect('sale_validate_update_form.total_item')">{{ error }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <div class="form-group">
                                            <label for="location">Location<span class="text-danger p-1">*</span></label>
                                                 <input type="text" autocomplete="off" name="location" v-validate="'required'" @keyup="load_location()"  v-model="sale.location" class="rounded form-control "  placeholder="Location" aria-label="Location">
                                                <ul class="w-100 pl-0" style="position: absolute;z-index:100">
                                                    <li style="list-style:none;cursor:pointer"  class="py-2 text-dark border-bottom bg-light" v-for="(place,index) in places" @click="set_location(place.text,place.context[0].text,index)"><i class="fas fa-map-marker mx-2 text-muted"></i> {{place.text}}, {{place.context[0].text}}</li>
                                                </ul>
                                            <div class="valid-feedback"></div>
                                            <div v-if="errors.has('sale_validate_update_form.location')" class="invalid-feedback">
                                                <span v-for="error in errors.collect('sale_validate_update_form.location')">{{ error }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <div class="form-group">
                                            <label for="mobile">Mobile No<span class="text-danger p-1">*</span></label>
                                            <input type="text" v-validate="'required|max:10|digits:10'" v-model="sale.mobile_no" name="mobile_no" class="form-control" id="mobile_no" aria-describedby="emailHelp" placeholder="Mobile No">
                                            <div class="valid-feedback"></div>
                                            <div v-if="errors.has('sale_validate_update_form.mobile_no')" class="invalid-feedback">
                                                <span v-for="error in errors.collect('sale_validate_update_form.mobile_no')">{{ error }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12"></div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="address">Address<small class="text-success p-1">(Optional)</small></label>
                                            <textarea rows="4" cols="50" v-validate="'max:255'" v-model="sale.address" name="address" class="form-control" id="address" aria-describedby="emailHelp" placeholder="Address" ></textarea>
                                            <div class="valid-feedback"></div>
                                            <div v-if="errors.has('sale_validate_update_form.address')" class="invalid-feedback">
                                                <span v-for="error in errors.collect('sale_validate_update_form.address')">{{ error }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="description">Sale Description <small class="text-success p-1">(Optional)</small></label>
                                            <textarea rows="4" cols="50" v-validate="'max:255'" v-model="sale.description" name="description" class="form-control" id="description" aria-describedby="emailHelp" placeholder="Description | less than 250 word" ></textarea>
                                            <div class="valid-feedback"></div>
                                            <div v-if="errors.has('sale_validate_update_form.description')" class="invalid-feedback">
                                                <span v-for="error in errors.collect('sale_validate_update_form.description')">{{ error }}</span>
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
    props:['sale'],
    data(){
        return{
            // sale:{},
            places:{},
            categories:{},
        }
    },
    methods:{
        // load places
        load_location(){
            if(this.sale.location ==''){
                this.sale.location = '';
                this.places ={};
            }else{
                if(this.sale.location.length > 2){
                axios.get('https://api.mapbox.com/geocoding/v5/mapbox.places/'+this.sale.location+'.json?access_token=pk.eyJ1IjoicmluemluMjAyMCIsImEiOiJja2szcm1iN3ExZHRiMm9wY3Z5OWx6dnZ4In0.4TuimSiBj9l5OKTybvcrAQ&cachebuster=1611047895214&autocomplete=true&types=place%2Clocality&country=in&worldview=in&limit=8')
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
            this.sale.location = location+', '+city;;
            this.sale.address = this.places[index].place_name;
            //longitude
            this.sale.longitude = this.places[index].center[0];
            // latitude
            this.sale.latitude = this.places[index].center[1];
            this.places = {};
        },
        // modal
        edit(){
            $("#sale_overview_update_modal").modal("show");           
        },
        // Update
        update_overview(id){
                this.$validator.validateAll('sale_validate_update_form').then((result) => {
                    if (result) {
                        axios.patch('/api/sale/'+id,this.sale,{
                            headers : { Authorization : localStorage.getItem("token")}
                        })
                        .then(response=>{
                            this.$Progress.start();
                            // Close Modal
                            $("#sale_overview_update_modal").modal("hide");  
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
        // categories
        axios.get('/api/categories/sale')
        .then(response=>{
            this.categories = response.data;
        })
    }
}
</script>