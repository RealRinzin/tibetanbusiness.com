<template>
    <div id="restaurant">
        <div class="row">
            <div class="col-md-10 mx-auto">
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
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <img src="/img/map.jpeg" alt="" height="250">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12" id="nav-tab">
                        <div class="width-25">
                            <button class="btn btn-secondary btn-md"> <i class="fas fa-star text-warning fa-1x mr-2"></i><i class="fas fa-star text-warning fa-1x mr-2"></i><i class="fas fa-star text-warning fa-1x mr-2"></i>4.5</button>
                            <span>
                                                    <!-- <li> -->
                                                        <!-- <span class="text-dark"><i class="fas fa-motorcycle fa-1x text-secondary mr-2"></i> Home Delivery </span> -->
                                                        <label class="switch">
                                                        <input type="checkbox" v-model="facilities.home_delivery">
                                                        <span class="slider round"></span>
                                                        </label>
                                                    <!-- </li> -->
                            </span>
                        </div>
                        <ul class="nav nav-tabs mt-3" id="custom-content-below-tab" role="tablist">
                            <li class="nav-item pl-0">
                                <a class="nav-link active pl-0" id="custom-content-below-overview-tab" data-toggle="pill" href="#custom-content-below-overview" role="tab" aria-controls="custom-content-below-overview" aria-selected="true">Overview</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-content-below-profile-tab" data-toggle="pill" href="#custom-content-below-profile" role="tab" aria-controls="custom-content-below-profile" aria-selected="false">Menu Photos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-content-below-messages-tab" data-toggle="pill" href="#custom-content-below-messages" role="tab" aria-controls="custom-content-below-messages" aria-selected="false">Food Photos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-content-below-settings-tab" data-toggle="pill" href="#custom-content-below-settings" role="tab" aria-controls="custom-content-below-settings" aria-selected="false">Comments</a>
                            </li>
                        </ul>
                        <div class="tab-content py-3" id="custom-content-below-tabContent">
                            <div class="tab-pane fade show active" id="custom-content-below-overview" role="tabpanel" aria-labelledby="custom-content-below-overview-tab">
                                <div class="row">
                                    <div class="col-md-12">
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
                                                    <li class="d-flex">
                                                        <span class="text-dark h6 flex-grow-1">Monday</span>
                                                        <label class="switch">
                                                        <input type="checkbox" v-model="operation.monday">
                                                        <span class="slider round"></span>
                                                        </label>
                                                    </li>
                                                </div>
                                                <div class="col-md-4 col-sm-6">
                                                    <li class="d-flex">
                                                        <span class="text-dark h6 flex-grow-1">Tuesday</span>
                                                        <label class="switch">
                                                        <input type="checkbox" v-model="operation.tuesday">
                                                        <span class="slider round"></span>
                                                        </label>
                                                    </li>
                                                </div>
                                                <div class="col-md-4 col-sm-6">
                                                    <li class="d-flex">
                                                        <span class="text-dark h6 flex-grow-1">Wednesday</span>
                                                        <label class="switch">
                                                        <input type="checkbox" v-model="operation.wednesday">
                                                        <span class="slider round"></span>
                                                        </label>
                                                    </li>
                                                </div>
                                                <div class="col-md-4 col-sm-6">
                                                    <li class="d-flex">
                                                        <span class="text-dark h6 flex-grow-1">Thursday</span>
                                                        <label class="switch">
                                                        <input type="checkbox" v-model="operation.thursday">
                                                        <span class="slider round"></span>
                                                        </label>
                                                    </li>
                                                </div>
                                                <div class="col-md-4 col-sm-6">
                                                    <li class="d-flex">
                                                        <span class="text-dark h6 flex-grow-1">Friday</span>
                                                        <label class="switch">
                                                        <input type="checkbox" v-model="operation.friday">
                                                        <span class="slider round"></span>
                                                        </label>
                                                    </li>
                                                </div>
                                                <div class="col-md-4 col-sm-6">
                                                    <li class="d-flex">
                                                        <span class="text-dark h6 flex-grow-1">Saturday</span>
                                                        <label class="switch">
                                                        <input type="checkbox" v-model="operation.saturday">
                                                        <span class="slider round"></span>
                                                        </label>
                                                    </li>
                                                </div>
                                                <div class="col-md-4 col-sm-6">
                                                    <li class="d-flex">
                                                        <span class="text-dark h6 flex-grow-1">Sunday</span>
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
                                                        <input type="checkbox" v-model="operation.saturday">
                                                        <span class="slider round"></span>
                                                        </label>
                                                    </li>
                                                </div>
                                            </div>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="custom-content-below-profile" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">
                                Mauris tincidunt mi at erat gravida, eget tristique urna bibendum. Mauris pharetra purus ut ligula tempor, et vulputate metus facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Maecenas sollicitudin, nisi a luctus interdum, nisl ligula placerat mi, quis posuere purus ligula eu lectus. Donec nunc tellus, elementum sit amet ultricies at, posuere nec nunc. Nunc euismod pellentesque diam. 
                            </div>
                            <div class="tab-pane fade" id="custom-content-below-messages" role="tabpanel" aria-labelledby="custom-content-below-messages-tab">
                                Morbi turpis dolor, vulputate vitae felis non, tincidunt congue mauris. Phasellus volutpat augue id mi placerat mollis. Vivamus faucibus eu massa eget condimentum. Fusce nec hendrerit sem, ac tristique nulla. Integer vestibulum orci odio. Cras nec augue ipsum. Suspendisse ut velit condimentum, mattis urna a, malesuada nunc. Curabitur eleifend facilisis velit finibus tristique. Nam vulputate, eros non luctus efficitur, ipsum odio volutpat massa, sit amet sollicitudin est libero sed ipsum. Nulla lacinia, ex vitae gravida fermentum, lectus ipsum gravida arcu, id fermentum metus arcu vel metus. Curabitur eget sem eu risus tincidunt eleifend ac ornare magna. 
                            </div>
                            <div class="tab-pane fade" id="custom-content-below-settings" role="tabpanel" aria-labelledby="custom-content-below-settings-tab">
                                Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque magna, iaculis tempus turpis ac, ornare sodales tellus. Mauris eget blandit dolor. Quisque tincidunt venenatis vulputate. Morbi euismod molestie tristique. Vestibulum consectetur dolor a vestibulum pharetra. Donec interdum placerat urna nec pharetra. Etiam eget dapibus orci, eget aliquet urna. Nunc at consequat diam. Nunc et felis ut nisl commodo dignissim. In hac habitasse platea dictumst. Praesent imperdiet accumsan ex sit amet facilisis. 
                            </div>
                        </div>
                    </div>
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
            // operatin
            operation: {},
            //facilities
            facilities:{}
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
                this.operation = this.restaurant.operation[0];  
                this.facilities = this.restaurant.facility[0];             
            })  
        }
    },
    mounted(){
        this.load();
    }
}
</script>