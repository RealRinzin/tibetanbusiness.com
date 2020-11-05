<template>
<div>
    <div class="col-12 my-2">
        <button class="btn btn-danger btn-sm" @click="open_modal()"><i class="fas fa-plus mr-2"></i>Add Working Days</button>
    </div>
    <!-- Open Modal -->
    <div class="modal fade" id="addOperationDay" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
            <div class="modal-header btn-danger">
                <h5 class="modal-title" id="exampleModalLabel">Add Working Days</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <li class="d-flex">
                            <span class="text-dark h6 flex-grow-1">Monday</span>
                            <toggle-button 
                                :value="operation.monday"
                                @change="update_operation_days('monday')"
                                :v-model="operation.monday"
                                :color="{checked:'#28a745',unchecked:'#dc4245'}"
                                :labels="{checked: 'On', unchecked: 'Off'}"/>
                        </li>
                    </div>
                    <div class="col-12">
                        <li class="d-flex">
                            <span class="text-dark h6 flex-grow-1">Tuesday</span>
                            <toggle-button 
                                :value="operation.tuesday"
                                @change="update_operation_days('tuesday')"
                                :v-model="operation.tuesday"
                                :color="{checked:'#28a745',unchecked:'#dc4245'}"
                                :labels="{checked: 'On', unchecked: 'Off'}"/>
                        </li>
                    </div>
                    <div class="col-12">
                        <li class="d-flex">
                            <span class="text-dark h6 flex-grow-1">Wednesday</span>
                            <toggle-button 
                                :v-model="operation.wednesday"
                                :value="operation.wednesday"
                                @change="update_operation_days('wednesday')"
                                :color="{checked:'#28a745',unchecked:'#dc4245'}"
                                :labels="{checked: 'On', unchecked: 'Off'}"/>
                        </li>
                    </div>
                    <div class="col-12">
                        <li class="d-flex">
                            <span class="text-dark h6 flex-grow-1">Thursday</span>
                            <toggle-button 
                                :v-model="operation.thursday"
                                @change="update_operation_days('thursday')"
                                :value="operation.thursday"
                                :color="{checked:'#28a745',unchecked:'#dc4245'}"
                                :labels="{checked: 'On', unchecked: 'Off'}"/>
                        </li>
                    </div>
                    <div class="col-12">
                        <li class="d-flex">
                            <span class="text-dark h6 flex-grow-1">Friday</span>
                            <toggle-button 
                                :v-model="operation.friday"
                                :value="operation.friday"
                                @change="update_operation_days('friday')"
                                :color="{checked:'#28a745',unchecked:'#dc4245'}"
                                :labels="{checked: 'On', unchecked: 'Off'}"/>
                        </li>
                    </div>
                    <div class="col-12">
                        <li class="d-flex">
                            <span class="text-dark h6 flex-grow-1">Saturday</span>
                            <toggle-button 
                                :v-model="operation.saturday"
                                :value="operation.saturday"
                                @change="update_operation_days('saturday')"
                                :color="{checked:'#28a745',unchecked:'#dc4245'}"
                                :labels="{checked: 'On', unchecked: 'Off'}"/>
                        </li>
                    </div>
                    <div class="col-12">
                        <li class="d-flex">
                            <span class="text-dark h6 flex-grow-1">Sunday</span>
                            <toggle-button 
                                :v-model="operation.sunday"
                                @change="update_operation_days('sunday')"
                                :value="operation.sunday"
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
            operation:{
                restaurant_basic_info_id:'',
                monday:false,
                tuesday:false,
                wednesday:false,
                thursday:false,
                friday:false,
                saturday:false,
                sunday:false,
            },
        }
    },
    methods:{
        open_modal(){
            $("#addOperationDay").modal("show");  
        },
        // Update Each Facility
        update_operation_days(day){
            this.operation[day] =! this.operation[day];
        },

        // Create New Facility
        // For Restaurant
        create(){
            this.operation.restaurant_basic_info_id = this.id;
            console.log(this.operation);
            axios.post('/api/restaurant_operation_days',this.operation,{
                headers : { Authorization : localStorage.getItem("token")}
                })
                .then(response=>{
                    $("#addOperationDay").modal("hide");  
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