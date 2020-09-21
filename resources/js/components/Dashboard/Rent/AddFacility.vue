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
                    <div class="col-12">
                        <li class="d-flex">
                            <span class="text-dark flex-grow-1"><i class="fas fa-subway fa-1x text-secondary mr-2"></i> Geyser </span>
                            <toggle-button 
                                :value="facilities.geyser"
                                @change="facility_update('geyser')"
                                :v-model="facilities.geyser"
                                :color="{checked:'#28a745',unchecked:'#dc4245'}"
                                :labels="{checked: 'On', unchecked: 'Off'}"/>
                        </li>
                    </div>
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
                    <div class="col-12">
                        <li class="d-flex">
                            <span class="text-dark flex-grow-1"><i class="fas fa-fan fa-1x text-secondary mr-2"></i> AC </span>
                            <toggle-button 
                                :value="facilities.ac"
                                :v-model="facilities.ac"
                                @change="facility_update('ac')"
                                :color="{checked:'#28a745',unchecked:'#dc4245'}"
                                :labels="{checked: 'On', unchecked: 'Off'}"/>
                        </li>
                    </div>
                    <div class="col-12">
                        <li class="d-flex">
                            <span class="text-dark flex-grow-1"><i class="fas fa-power-off text-secondary mr-2"></i> Washing Machine </span>
                            <toggle-button 
                                :value="facilities.washing_machine"
                                :v-model="facilities.washing_machine"
                                @change="facility_update('washing_machine')"
                                :color="{checked:'#28a745',unchecked:'#dc4245'}"
                                :labels="{checked: 'On', unchecked: 'Off'}"/>
                        </li>
                    </div>
                    <div class="col-12">
                        <li class="d-flex">
                            <span class="text-dark flex-grow-1"><i class="fas fa-dumbbell text-secondary mr-2"></i> Gym </span>
                            <toggle-button 
                                :value="facilities.gym"
                                :v-model="facilities.gym"
                                @change="facility_update('gym')"
                                :color="{checked:'#28a745',unchecked:'#dc4245'}"
                                :labels="{checked: 'On', unchecked: 'Off'}"/>
                        </li>
                    </div>
                    <div class="col-12">
                        <li class="d-flex">
                            <span class="text-dark flex-grow-1"><i class="fas fa-dog text-secondary mr-2"></i> Pet Allowed </span>
                            <toggle-button 
                                :value="facilities.pet_allowed"
                                :v-model="facilities.pet_allowed"
                                @change="facility_update('pet_allowed')"
                                :color="{checked:'#28a745',unchecked:'#dc4245'}"
                                :labels="{checked: 'On', unchecked: 'Off'}"/>
                        </li>
                    </div>
                    <div class="col-12">
                        <li class="d-flex">
                            <span class="text-dark flex-grow-1"><i class="fas fa-bed text-secondary mr-2"></i> Single Room </span>
                            <toggle-button 
                                :value="facilities.single_room"
                                :v-model="facilities.single_room"
                                @change="facility_update('single_room')"
                                :color="{checked:'#28a745',unchecked:'#dc4245'}"
                                :labels="{checked: 'On', unchecked: 'Off'}"/>
                        </li>
                    </div>
                    <div class="col-12">
                        <li class="d-flex">
                            <span class="text-dark flex-grow-1"><i class="fas fa-bed text-secondary mr-2"></i> Double Room</span>
                            <toggle-button 
                                :value="facilities.double_room"
                                :v-model="facilities.double_room"
                                @change="facility_update('double_room')"
                                :color="{checked:'#28a745',unchecked:'#dc4245'}"
                                :labels="{checked: 'On', unchecked: 'Off'}"/>
                        </li>
                    </div>
                    <div class="col-12">
                        <li class="d-flex">
                            <span class="text-dark flex-grow-1"><i class="fas fa-box text-secondary mr-2"></i>Fridge</span>
                            <toggle-button 
                                :value="facilities.fridge"
                                :v-model="facilities.fridge"
                                @change="facility_update('fridge')"
                                :color="{checked:'#28a745',unchecked:'#dc4245'}"
                                :labels="{checked: 'On', unchecked: 'Off'}"/>
                        </li>
                    </div>
                    <div class="col-12">
                        <li class="d-flex">
                            <span class="text-dark flex-grow-1"><i class="fas fa-tree text-secondary mr-2"></i>Garden</span>
                            <toggle-button 
                                :value="facilities.garden"
                                :v-model="facilities.garden"
                                @change="facility_update('garden')"
                                :color="{checked:'#28a745',unchecked:'#dc4245'}"
                                :labels="{checked: 'On', unchecked: 'Off'}"/>
                        </li>
                    </div>
                    <div class="col-12">
                        <li class="d-flex">
                            <span class="text-dark flex-grow-1"><i class="fas fa-car text-secondary mr-2"></i>Parking Space</span>
                            <toggle-button 
                                :value="facilities.parking_space"
                                :v-model="facilities.parking_space"
                                @change="facility_update('parking_space')"
                                :color="{checked:'#28a745',unchecked:'#dc4245'}"
                                :labels="{checked: 'On', unchecked: 'Off'}"/>
                        </li>
                    </div>
                    <div class="col-12">
                        <li class="d-flex">
                            <span class="text-dark flex-grow-1"><i class="fas fa-sink"></i> Bathroom Attached</span>
                            <toggle-button 
                                :value="facilities.bathroom_attached"
                                :v-model="facilities.bathroom_attached"
                                @change="facility_update('bathroom_attached')"
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
    props:['id'],
    data(){
        return{
            facilities:{
                rent_basic_info_id:this.id,
                wifi:false,
                geyser:false,
                ac:false,
                washing_machine:false,
                single_room:false,
                double_room:false,
                bathroom_attached:false,
                fridge:false,
                pet_allowed:false,
                gym:false,
                parking_space:false,
                garden:false,
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
            axios.post('/api/rent_facilities',this.facilities,{
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
                    // location.reload();
                })
        },
    },
    mounted(){
    }
}
</script>