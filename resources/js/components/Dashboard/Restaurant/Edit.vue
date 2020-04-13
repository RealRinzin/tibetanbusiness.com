<template>
    <div id="restaurant">
        <div class="row">
            <div class="col-md-6">
                <!-- banner -->
                <div class="card">
                    <div class="banner" v-bind:style='{ backgroundImage: `url(/img/${restaurant.banner})`}'>
                        <div class="overlay">
                            <i class="fas fa-camera fa-5x text-white"></i>
                            <div class="break"></div>
                            <h5 class="text-white ml-2 mt-3">Update Banner Photo</h5>
                        </div>
                    </div>
                </div>
                <!-- Basic information -->
                <div class="py-2">
                <button class="btn btn-info btn-sm">Basic Information</button>
                </div>
                <div class="card">
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                            <th>Name</th>
                            <th>location</th>
                            <th>Address</th>
                            <th>Edit</th>
                            <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <td>{{restaurant.name}}</td>
                            <td>{{restaurant.location}}</td>
                            <td>{{restaurant.address}}</td>
                            <td><button class="btn btn-sm btn-info"><i class="fas fa-pencil-alt "></i></button></td>
                            <td><button class="btn btn-sm btn-danger"><i class="fas fa-trash-alt "></i></button></td>
                            </tr>

                        </tbody>
                        </table>
                    </div>
                </div>
                <!-- Operation day -->
                <div class="card facility p-3">
                    <div class="py-2">
                    <button class="btn btn-dark btn-md">Operating Days</button>
                    </div>
                    <ul>
                    <div class="row">
                        <div class="col-md-4 col-sm-6">
                            <li>
                                <span class="text-dark h6">Monday</span>
                                <label class="switch">
                                <input type="checkbox" v-model="operation.monday">
                                <span class="slider round"></span>
                                </label>
                            </li>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <li>
                                <span class="text-dark h6">Tuesday</span>
                                <label class="switch">
                                <input type="checkbox" v-model="operation.tuesday">
                                <span class="slider round"></span>
                                </label>
                            </li>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <li>
                                <span class="text-dark h6">Wednesday</span>
                                <label class="switch">
                                <input type="checkbox" v-model="operation.wednesday">
                                <span class="slider round"></span>
                                </label>
                            </li>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <li>
                                <span class="text-dark h6">Thursday</span>
                                <label class="switch">
                                <input type="checkbox" v-model="operation.thursday">
                                <span class="slider round"></span>
                                </label>
                            </li>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <li>
                                <span class="text-dark h6">Friday</span>
                                <label class="switch">
                                <input type="checkbox" v-model="operation.friday">
                                <span class="slider round"></span>
                                </label>
                            </li>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <li>
                                <span class="text-dark h6">Saturday</span>
                                <label class="switch">
                                <input type="checkbox" v-model="operation.saturday">
                                <span class="slider round"></span>
                                </label>
                            </li>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <li>
                                <span class="text-dark h6">Sunday</span>
                                <label class="switch">
                                <input type="checkbox" v-model="operation.sunday">
                                <span class="slider round"></span>
                                </label>
                            </li>
                        </div>
                    </div>
                    </ul>
                </div>
                <!-- Facilities day -->
                <div class="card facility p-3">
                    <div class="py-2">
                    <button class="btn btn-dark btn-md">Facilities</button>
                    </div>
                    <ul>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <li>
                                <span class="text-dark"><i class="fas fa-motorcycle fa-1x text-secondary mr-2"></i> Home Delivery </span>
                                <label class="switch">
                                <input type="checkbox" v-model="operation.wednesday">
                                <span class="slider round"></span>
                                </label>
                            </li>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <li>
                                <span class="text-dark"><i class="fas fa-wifi fa-1x text-secondary mr-2"></i> WiFi </span>
                                <label class="switch">
                                <input type="checkbox" v-model="operation.saturday">
                                <span class="slider round"></span>
                                </label>
                            </li>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <li>
                                <span class="text-dark"><i class="fab fa-cc-visa mr-1 fa-1x text-secondary mr-2"></i> Card Payment </span>
                                <label class="switch">
                                <input type="checkbox" v-model="operation.sunday">
                                <span class="slider round"></span>
                                </label>
                            </li>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <li>
                                <span class="text-dark"><i class="fa fa-fan mr-1 fa-1x text-secondary mr-2"></i> AC </span>
                                <label class="switch">
                                <input type="checkbox" v-model="operation.monday">
                                <span class="slider round"></span>
                                </label>
                            </li>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <li>
                                <span class="text-dark"><i class="fas fa-glass-cheers text-secondary mr-2"></i> Party Booking </span>
                                <label class="switch">
                                <input type="checkbox" v-model="operation.monday">
                                <span class="slider round"></span>
                                </label>
                            </li>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <li>
                                <span class="text-dark"><i class="far fa-stop-circle text-secondary mr-2"></i> Veg </span>
                                <label class="switch">
                                <input type="checkbox" v-model="operation.wednesday">
                                <span class="slider round"></span>
                                </label>
                            </li>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <li>
                                <span class="text-dark"><i class="far fa-stop-circle text-secondary mr-2"></i> Non-Veg </span>
                                <label class="switch">
                                <input type="checkbox" v-model="operation.wednesday">
                                <span class="slider round"></span>
                                </label>
                            </li>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <li>
                                <span class="text-dark"><i class="fas fa-car text-secondary mr-2"></i> Parking</span>
                                <label class="switch">
                                <input type="checkbox" v-model="operation.wednesday">
                                <span class="slider round"></span>
                                </label>
                            </li>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <li>
                                <span class="text-dark"><i class="fas fa-building text-secondary mr-2"></i> Roof Top</span>
                                <label class="switch">
                                <input type="checkbox" v-model="operation.saturday">
                                <span class="slider round"></span>
                                </label>
                            </li>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <li>
                                <span class="text-dark"><i class="fas fa-beer text-secondary mr-2"></i>Beverage</span>
                                <label class="switch">
                                <input type="checkbox" v-model="operation.saturday">
                                <span class="slider round"></span>
                                </label>
                            </li>
                        </div>
                    </div>
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <img src="/img/map.jpeg" alt="" height="250">
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props:['rest_id'],
    data(){
        return{
            id:this.rest_id.id,//Restaurant ID
            // Restaurant Object
            restaurant:{}, 
            operation: {
                monday:false,
                tuesday:true,
                wednesday:false,
                thursday:false,
                friday:true,
                saturday:true,
                sunday:true
            },
        }
    },
    //methods
    methods:{
        load(){
            axios.get('/api/restaurant/'+this.id,{
                headers : { Authorization : localStorage.getItem("token")}
            })
            .then(response=>{
                // Assigning Restaurant object
                this.restaurant = response.data.data;
                // Operation Day
                // this.operation = this.restaurant.operation;                
            })  
        }
    },
    mounted(){
        this.load();
    }
}
</script>