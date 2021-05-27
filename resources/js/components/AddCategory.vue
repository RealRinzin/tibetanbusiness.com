<template>
    <div class="row">
        <!-- Product -->
        <div class="col-md-6 mx-auto">
            <div class="my-2">
                <form @submit.prevent="add_product()"  data-vv-scope="product_form">
                    <label >Add Product Category</label>
                    <div class="input-group mb-3">
                        <input type="text" v-validate="'required'" v-model="products.name" name="p_name" class="form-control" placeholder="Add Product Category" aria-label="Add Product Category" aria-describedby="button-addon2">
                            <div class="valid-feedback"></div>
                            <div v-if="errors.has('product_form.p_name')" class="invalid-feedback">
                                <span v-for="error in errors.collect('product_form.p_name')">{{ error }}</span>
                            </div>
                        <div class="input-group-append">
                            <button class="btn btn-outline-danger" type="submit" id="button-addon2">Button</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- Event -->
            <div class="my-2">
                <form @submit.prevent="add_event()"  data-vv-scope="event_form">
                    <label >Add Event Category</label>
                    <div class="input-group mb-3">
                        <input type="text" v-validate="'required'" v-model="events.name" name="e_name" class="form-control" placeholder="Add Product Category" aria-label="Add Event Category" aria-describedby="button-addon2">
                            <div class="valid-feedback"></div>
                            <div v-if="errors.has('event.e_name')" class="invalid-feedback">
                                <span v-for="error in errors.collect('event_form.e_name')">{{ error }}</span>
                            </div>
                        <div class="input-group-append">
                            <button class="btn btn-outline-danger" type="submit" id="button-addon2">Button</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- Service -->
            <div class="my-2">
                <form @submit.prevent="add_service()"  data-vv-scope="service_form">
                    <label >Add Services Category</label>
                    <div class="input-group mb-3">
                        <input type="text" v-validate="'required'" v-model="services.name" name="s_name" class="form-control" placeholder="Add Service types" aria-label="Add Service Category" aria-describedby="button-addon2">
                            <div class="valid-feedback"></div>
                            <div v-if="errors.has('service_form.s_name')" class="invalid-feedback">
                                <span v-for="error in errors.collect('service_form.s_name')">{{ error }}</span>
                            </div>
                        <div class="input-group-append">
                            <button class="btn btn-outline-danger" type="submit" id="button-addon2">Button</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- Image -->
            <div class="my-2">
                <form @submit.prevent="add_carousel()"  data-vv-scope="carousel_form">
                    <label >Carousel</label>
                    <div class="input-group mb-3">
                            <input type="file" v-validate="'required|image|ext:jpeg,jpg,png|size:1000'" name="c_name" @change="avatar" id="c_name" aria-describedby="emailHelp" placeholder="Website Address">
                            <div class="valid-feedback"></div>
                            <div v-if="errors.has('carousel_form.c_name')" class="invalid-feedback">
                                <span v-for="error in errors.collect('carousel_form.c_name')">{{ error }}</span>
                            </div>
                        <div class="input-group-append">
                            <button class="btn btn-outline-danger" type="submit" id="button-addon2">Button</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
import { Validator } from 'vee-validate';
export default {
    data(){
        return{
            products:{},
            events:{},
            services:{},
            carousels:{},
        }
    },
    methods:{
        // Add Product Categories
        add_product(){
            this.$validator.validateAll('product_form').then((result) => {                  
                if(result){
                    this.$Progress.start()
                    axios.post('/api/sale-categories',this.products,{
                    headers : { Authorization : localStorage.getItem("token")}
                    })
                    .then(response=>{
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
        // Add Product Categories
        add_event(){
            this.$validator.validateAll('event_form').then((result) => {                  
                if(result){
                    this.$Progress.start()
                    axios.post('/api/event-categories',this.events,{
                    headers : { Authorization : localStorage.getItem("token")}
                    })
                    .then(response=>{
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
        // Service
        add_service(){
            this.$validator.validateAll('service_form').then((result) => {                  
                if(result){
                    this.$Progress.start()
                    axios.post('/api/service-categories',this.services,{
                    headers : { Authorization : localStorage.getItem("token")}
                    })
                    .then(response=>{
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
        // 
        avatar(event){
            let fileReader = new FileReader();
            if(event.target.files[0].size < 1000000){
                fileReader.onload = (event) =>{
                    this.carousels.c_name = event.target.result
                }
                
            }else{
                alert("Image size should be less than 1MB")
            }
            // base64 data
            fileReader.readAsDataURL(event.target.files[0]);
        },
        // Hero Image
        add_carousel(){
            this.$validator.validateAll('carousel_form').then((result) => {                  
                if(result){
                    this.$Progress.start()
                    axios.post('/api/carousel',this.carousels,{
                    headers : { Authorization : localStorage.getItem("token")}
                    })
                    .then(response=>{
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
    mounted(){
        console.log("Rinzin");
    }
}
</script>