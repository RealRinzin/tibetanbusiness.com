<template>
<div>
    <div class="col-12 my-2">
        <button class="btn btn-danger btn-sm" @click="open_modal()"><i class="fas fa-plus mr-2"></i>Add Facilities</button>
    </div>
    <!-- Open Modal -->
    <div class="modal fade" id="addFacility" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
            <div class="modal-header btn-danger">
                <h5 class="modal-title" id="exampleModalLabel">Add Facilities</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- Home Delivery -->
                    <div class="col-12">
                        <li class="d-flex">
                            <span class="text-dark flex-grow-1"><i class="fas fa-motorcycle fa-1x text-secondary mr-2"></i> Home Delivery </span>
                            <toggle-button 
                                :value="facilities.home_delivery"
                                :v-model="facilities.home_delivery"
                                @change="facility_update('home_delivery')"
                                :color="{checked:'#28a745',unchecked:'#dc4245'}"
                                :labels="{checked: 'On', unchecked: 'Off'}"/>
                        </li>
                    </div>
                    <!-- Wifi -->
                    <div class="col-12">
                        <li class="d-flex">
                            <span class="text-dark flex-grow-1"><i class="fas fa-wifi fa-1x text-secondary mr-2"></i> WiFi </span>
                            <toggle-button 
                                :value="facilities.wifi"
                                :v-model="facilities.wifi"
                                @change="facility_update('wifi')"
                                :color="{checked:'#28a745',unchecked:'#dc4245'}"
                                :labels="{checked: 'On', unchecked: 'Off'}"/>
                        </li>
                    </div>
                    <!-- Card Payment -->
                    <div class="col-12">
                        <li class="d-flex">
                            <span class="text-dark flex-grow-1"><i class="fab fa-cc-visa mr-1 fa-1x text-secondary mr-2"></i> Card Payment </span>
                            <toggle-button 
                                :value="facilities.card_payment"
                                :v-model="facilities.card_payment"
                                @change="facility_update('card_payment')"
                                :color="{checked:'#28a745',unchecked:'#dc4245'}"
                                :labels="{checked: 'On', unchecked: 'Off'}"/>
                        </li>
                    </div>
                    <!-- AC -->
                    <div class="col-12">
                        <li class="d-flex">
                            <span class="text-dark flex-grow-1"><i class="fa fa-fan mr-1 fa-1x text-secondary mr-2"></i> AC </span>
                            <toggle-button 
                                :value="facilities.ac"
                                :v-model="facilities.ac"
                                @change="facility_update('ac')"
                                :color="{checked:'#28a745',unchecked:'#dc4245'}"
                                :labels="{checked: 'On', unchecked: 'Off'}"/>
                        </li>
                    </div>
                    <!-- Party Booking -->
                    <div class="col-12">
                        <li class="d-flex">
                            <span class="text-dark flex-grow-1"><i class="fas fa-glass-cheers text-secondary mr-2"></i> Party Booking </span>
                            <toggle-button 
                                :value="facilities.party_booking"
                                :v-model="facilities.party_booking"
                                @change="facility_update('party_booking')"
                                :color="{checked:'#28a745',unchecked:'#dc4245'}"
                                :labels="{checked: 'On', unchecked: 'Off'}"/>
                        </li>
                    </div>
                    <!-- Veg Food -->
                    <div class="col-12">
                        <li class="d-flex">
                            <span class="text-dark flex-grow-1"><i class="far fa-stop-circle text-secondary mr-2"></i> Veg </span>
                            <toggle-button 
                                :value="facilities.veg"
                                :v-model="facilities.veg"
                                @change="facility_update('veg')"
                                :color="{checked:'#28a745',unchecked:'#dc4245'}"
                                :labels="{checked: 'On', unchecked: 'Off'}"/>
                        </li>
                    </div>
                    <!-- None Veg Food -->
                    <div class="col-12">
                        <li class="d-flex">
                            <span class="text-dark flex-grow-1"><i class="far fa-stop-circle text-secondary mr-2"></i> Non-Veg </span>
                            <toggle-button 
                                :value="facilities.none_veg"
                                :v-model="facilities.none_veg"
                                @change="facility_update('none_veg')"
                                :color="{checked:'#28a745',unchecked:'#dc4245'}"
                                :labels="{checked: 'On', unchecked: 'Off'}"/>
                        </li>
                    </div>
                    <!-- Parking Lot -->
                    <div class="col-12">
                        <li class="d-flex">
                            <span class="text-dark flex-grow-1"><i class="fas fa-car text-secondary mr-2"></i> Parking </span>
                            <toggle-button 
                                :value="facilities.parking_lot"
                                :v-model="facilities.parking_lot"
                                @change="facility_update('parking_lot')"
                                :color="{checked:'#28a745',unchecked:'#dc4245'}"
                                :labels="{checked: 'On', unchecked: 'Off'}"/>
                        </li>
                    </div>
                    <!-- Roof Top -->
                    <div class="col-12">
                        <li class="d-flex">
                            <span class="text-dark flex-grow-1"><i class="fas fa-building text-secondary mr-2"></i> Roof Top</span>
                            <toggle-button 
                                :value="facilities.roof_top"
                                :v-model="facilities.roof_top"
                                @change="facility_update('roof_top')"
                                :color="{checked:'#28a745',unchecked:'#dc4245'}"
                                :labels="{checked: 'On', unchecked: 'Off'}"/>
                        </li>
                    </div>
                    <!-- Beverage -->
                    <div class="col-12">
                        <li class="d-flex">
                            <span class="text-dark flex-grow-1"><i class="fas fa-beer text-secondary mr-2"></i>Beverage</span>
                            <toggle-button 
                                :value="facilities.beverage"
                                :v-model="facilities.beverage"
                                @change="facility_update('beverage')"
                                :color="{checked:'#28a745',unchecked:'#dc4245'}"
                                :labels="{checked: 'On', unchecked: 'Off'}"/>
                        </li>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-dark w-25" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger w-25" @click="create()">Add</button>
            </div>
            </div>
        </div>
    </div>
</div>
    <!-- Modal -->
</template>
<script>
export default {
    props:['restaurant_id'],
    data(){
        return{
            facilities:{
                restaurant_basic_info_id:'',
                home_delivery:false,
                wifi:false,
                party_booking:false,
                roof_top:false,
                ac:false,
                veg:false,
                none_veg:false,
                beverage:false,
                parking_lot:false,
                card_payment:false,
            },
        }
    },
    methods:{
        open_modal(){
            $("#addFacility").modal("show");  
        },
        // Update Each Facility
        facility_update(type){
            this.facilities[type] =! this.facilities[type];
        },
        // Create New Facility
        // For Restaurant
        create(){
            this.facilities.restaurant_basic_info_id = this.restaurant_id,
            axios.post('/api/restaurant_facilities',this.facilities,{
                headers : { Authorization : localStorage.getItem("token")}
                })
                .then(response=>{
                    $("#addFacility").modal("hide");  
                    // Flash Message
                    toast.fire({
                        icon:'success',
                        title:'Facility Added',
                    });
                    // reload
                    location.reload();
                })
        },
    },
    mounted(){
    }
}
</script>