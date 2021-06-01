<template>
    <div>
        <div class="modal fade add_edit_label" id="sale_add_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-gradient-danger">
                        <h5 class="modal-title" id="exampleModalLongTitle">Add New Sale</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="add_sale()"  data-vv-scope="sale_validate_add_form">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div v-if="bannerPreview" class="col-md-12" style="background-size: cover;height: 220px;background-position: center;" v-bind:style='{ backgroundImage: `url(${bannerPreview})`}'></div>
                                <div class="my-1">
                                    <vue-progress-bar></vue-progress-bar>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-sm-6">
                                        <div class="form-group">
                                            <label for="name">Name<span class="text-danger p-1">*</span></label>
                                            <input type="text" v-validate="'required|min:2|max:40'" v-model="sale.name" name="name" class="form-control" id="name" aria-describedby="emailHelp" placeholder="name">
                                            <div class="valid-feedback"></div>
                                            <div v-if="errors.has('sale_validate_add_form.name')" class="invalid-feedback">
                                                <span v-for="error in errors.collect('sale_validate_add_form.name')">{{ error }}</span>
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
                                            <div v-if="errors.has('sale_validate_add_form.type')" class="invalid-feedback">
                                                <span v-for="error in errors.collect('sale_validate_add_form.type')">{{ error }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <div class="form-group">
                                            <label for="entry_fee">Price<span class="text-danger p-1">*</span></label>
                                            <input type="text" v-validate="'numeric|max:6'" v-model="sale.price" name="price" class="form-control" id="price" aria-describedby="emailHelp" placeholder="Price">
                                            <div class="valid-feedback"></div>
                                            <div v-if="errors.has('sale_validate_add_form.price')" class="invalid-feedback">
                                                <span v-for="error in errors.collect('sale_validate_add_form.price')">{{ error }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <div class="form-group">
                                            <label for="entry_fee">Total Item<span class="text-danger p-1">*</span></label>
                                            <input type="number" min="1" v-validate="'required|numeric|max:6'" v-model="sale.total_item" name="total_item" class="form-control" id="total_item" aria-describedby="emailHelp" placeholder="Total Item">
                                            <div class="valid-feedback"></div>
                                            <div v-if="errors.has('sale_validate_add_form.total_item')" class="invalid-feedback">
                                                <span v-for="error in errors.collect('sale_validate_add_form.total_item')">{{ error }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <div class="form-group">
                                            <label for="location">Location<span class="text-danger p-1">*</span></label>
                                                 <input type="text" autocomplete="off" name="location" v-validate="'required'" @keyup="load_location()"  v-model="sale.location" class="rounded form-control "  placeholder="Location" aria-label="Location">
                                                <ul class="w-100 pl-0" style="position: absolute;z-index:100">
                                                    <li style="list-style:none;cursor:pointer"  class="p-2 text-dark border-bottom bg-light" v-for="(place,index) in places" @click="set_location(place.placeName,place.placeAddress,index)" v-if="index <= 5">
                                                        <span class="font-weight-bold text-dark" style="font-size:13px">{{place.placeName}}</span>
                                                        <span class="d-block text-muted" style="font-size:12px">{{place.placeAddress}}</span>
                                                    </li>
                                                </ul>
                                            <div class="valid-feedback"></div>
                                            <div v-if="errors.has('sale_validate_add_form.location')" class="invalid-feedback">
                                                <span v-for="error in errors.collect('sale_validate_add_form.location')">{{ error }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <div class="form-group">
                                            <label for="mobile">Mobile No<span class="text-danger p-1">*</span></label>
                                            <input type="text" v-validate="'required|max:10|digits:10'" v-model="sale.mobile_no" name="mobile_no" class="form-control" id="mobile_no" aria-describedby="emailHelp" placeholder="Mobile No">
                                            <div class="valid-feedback"></div>
                                            <div v-if="errors.has('sale_validate_add_form.mobile_no')" class="invalid-feedback">
                                                <span v-for="error in errors.collect('sale_validate_add_form.mobile_no')">{{ error }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <div class="form-group">
                                            <label for="banner">Banner Image <span class="text-danger p-1">*</span><span class="small text-danger">(Less than 1MB)</span></label>
                                            <div class="custom-file">
                                                <label class="custom-file-label" for="banner">Choose file</label>
                                                <input type="file" v-validate="'required|image|ext:jpeg,jpg,png,gif|size:1000'" name="banner" @change="avatar" class="custom-file-input" id="banner" aria-describedby="emailHelp" placeholder="Website Address">
                                                <div class="valid-feedback"></div>
                                                <div v-if="errors.has('sale_validate_add_form.banner')" class="invalid-feedback">
                                                    <span v-for="error in errors.collect('sale_validate_add_form.banner')">{{ error }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                   <div class="col-12">
                                    <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Optional Fields</button> <span class="text-muted small">You can fill the additional fields</span>
                                    </div>
                                    <div class="collapse" id="collapseExample">
                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="address">Address<small class="text-success p-1">(Optional)</small></label>
                                                    <textarea rows="4" cols="50" v-validate="'max:150'" v-model="sale.address" name="address" class="form-control" id="address" aria-describedby="emailHelp" placeholder="Address" ></textarea>
                                                    <div class="valid-feedback"></div>
                                                    <div v-if="errors.has('sale_validate_add_form.address')" class="invalid-feedback">
                                                        <span v-for="error in errors.collect('sale_validate_add_form.address')">{{ error }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="description">Sale Description <small class="text-success p-1">(Optional)</small></label>
                                                    <textarea rows="4" cols="50" v-validate="'max:5000'" v-model="sale.description" name="description" class="form-control" id="description" aria-describedby="emailHelp" placeholder="Descriptions" ></textarea>
                                                    <div class="valid-feedback"></div>
                                                    <div v-if="errors.has('sale_validate_add_form.description')" class="invalid-feedback">
                                                        <span v-for="error in errors.collect('sale_validate_add_form.description')">{{ error }}</span>
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
                            <button type="submit" class="btn btn-danger btn-md" placeholder="Write your comment">Create</button>
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
    props:['load_sale'],
    data(){
        return{
            sale:{
                'longitude':20.96,
                'latitude':78.78
            },
            bannerPreview:'',
            // today : 
            places:{},
            categories:{},
        }
    },
    methods:{
        // load places
        load_location(){
            let location = "\""+ this.sale.location+  "\"";
            if(this.sale.location ==''){
                this.sale.location = '';
                this.places ={};
            }else{
                if(this.sale.location.length > 2){
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
            this.sale.location = location;
            this.sale.address = this.places[index].placeAddress;
            //longitude
            this.sale.longitude = this.places[index].longitude;
            // latitude
            this.sale.latitude = this.places[index].latitude;
            // Reset location
            this.places = {};
        },
        /**
         * Banner Image 
         * File
         *  */ 
        avatar(sale){
            let fileReader = new FileReader();
            if(sale.target.files[0].size < 1000000){
                fileReader.onload = (sale) =>{
                    this.bannerPreview = sale.target.result
                    this.sale.banner = sale.target.result
                }
                
            }else{
                alert("Image size should be less than 1MB")
            }
            // base64 data
            fileReader.readAsDataURL(sale.target.files[0]);
        },

       add_sale(){ 

            this.$validator.validateAll('sale_validate_add_form').then((result) => {                  
                if(result){
                    this.$Progress.start()
                    axios.post('/api/sale',this.sale,{
                    headers : { Authorization : localStorage.getItem("token")}
                    })
                    .then(response=>{
                        // closing modal
                            $("#sale_add_modal").modal("hide");  
                            //  Flash Message  
                            toast.fire({
                                icon:'success',
                                title:'Updated',
                            });
                            this.$emit('load_sale');
                    this.$Progress.finish()
                    })
                }
            })
        }
    },
    mounted(){
        axios.get('/api/sale-categories')
        .then(response=>{
            this.categories = response.data;
        })
    }
}
</script>