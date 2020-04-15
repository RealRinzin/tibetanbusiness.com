<template>
    <div>
        <div class="row">
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
                                <div class="row py-1">
                                    <div class="col-md-3 col-sm-4">
                                        <h6 class="text-dark">Website:</h6>
                                    </div>
                                    <div class="col-md-9 col-sm-8">
                                        <h6 class="text-muted">{{restaurant.website}}</h6>
                                    </div>
                                </div>
                                <div class="row py-1">
                                    <div class="col-md-3 col-sm-4">
                                        <h6 class="text-dark">Instagram:</h6>
                                    </div>
                                    <div class="col-md-9 col-sm-8">
                                        <h6 class="text-muted">{{restaurant.instagram}}</h6>
                                    </div>
                                </div>
                                <div class="row py-1">
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
                                        <h6 class="text-dark">facebook:</h6>
                                    </div>
                                    <div class="col-md-9 col-sm-8">
                                        <h6 class="text-muted">{{restaurant.facebook}}</h6>
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
                            <button @click="update_overview(restaurant.id)" class="btn btn-danger">Update</button>
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
                                            <!-- update -->
                                            <div class="col-md-12 border-top text-right pt-1">
                                                <button class="btn btn-danger btn-md" @click="update_operation_days(restaurant.id)">Update</button>
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
                                                <button class="btn btn-info" @click="update_facility(restaurant.id)">Update</button>
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
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <form @submit.prevent="update_overview(restaurant.id)">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Name</label>
                                        <input type="text" v-model="restaurant.name" name="name" class="form-control" id="name" aria-describedby="emailHelp" placeholder="name">
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger btn-md" placeholder="Write your comment">Post</button>

                </div>
                </form>
            </div>
        </div>
        </div>
    </div>
</template>
<script>
export default {
    // Data
    props:['restaurant','operation','facilities'],
    data(){
        return {
            // restaurant:{},
            // data:this.rest_id,
            test:{
                monday:1,
                tuesday:1,
                wednesday:0,
                thursday:1,
                friday:0,
                saturday:1,
                sunday:0,
            },
        }
    },
    methods:{
        // Overview edit
        edit(){
            $("#overview_update_modal").modal("show");            
        },
        // Overview update
        update_overview(id){
            axios.patch('/api/restaurant/'+id,this.restaurant)
            .then(response=>{
            })
        },
        // update_operation_days
        update_operation_days(id){
            axios.patch('/api/restaurant_operation_days/'+id,this.overview,{
                headers : { Authorization : localStorage.getItem("token")}
            })
            .then(response=>{
            })
        },
        // update_facility
        update_facility(id){
        }
    },
    mounted(){
    }
}
</script>