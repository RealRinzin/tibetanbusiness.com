<template>
    <div class="w-100">
            <form @submit.prevent="search()">
                <div class="col-md-8 mx-auto">
                    <div class="row">
                        <div class="col-md-4 col-sm-4 p-0">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01"><i class="fas fa-mug-hot"></i></label>
                                </div>
                                <select class="custom-select input" v-model="keyword.category" id="inputGroupSelect01">
                                    <option selected>Choose Type</option>
                                    <option value="events">Event</option>
                                    <option value="jobs">Job</option>
                                    <option value="rents">Rent</option>
                                    <option value="sales">Sale</option>
                                    <option value="restaurants">Restaurant</option>
                                    <option value="services">Service</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-8 col-sm-8 p-0">
                            <div class="input-group mb-3">
                                <input type="text" v-model="keyword.location" class="form-control input" placeholder="Location" aria-label="Location" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
    </div>
</template>
<script>
export default {
    data(){
        return{
            keyword:{
                category:'',
                location:''
            }
        }
    },
    // Methods
    methods:{
        search(){
            window.location.href = "/search/"+this.keyword.category+'/'+this.keyword.location;
        }
    },
    mounted(){
    }
}
</script>