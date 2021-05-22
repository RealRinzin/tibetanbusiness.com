<template>
<div>
    <div class="row" v-show="show_popup">
        <div  class="col-md-6 mx-auto" v-for="(popup,index) in popup" :key="index">
            <a v-bind:href="'/announcement/'+popup.id">
                <!-- Display for the Mobile -->
                <div class="position-fixed rounded w-75 d-block d-sm-none" style="bottom:10px;z-index:13">
                    <div class="alert alert-secondary alert-dismissible fade show m-1 rounded text-center w-100 p-0" role="alert" id="mobile_add_promote_link">
                        <div class="d-flex flex-row">
                            <div class="w-100 lazyload" :data-bgset="'/storage/job/Banner/'+popup.banner"  style="background-size:cover;height:auto" data-sizes="auto">
                            </div>
                            <div class="w-100 text-left px-1 py-0" style="font-size:10px">
                                <h6 class="m-0">{{popup.title}}</h6>
                                <p class="m-0" v-if="popup.types == 2">course Name : {{popup.course_name}}</p>
                                <p class="m-0">Deadline : {{popup.deadline | date}}</p>
                                <p class="m-0" v-if="popup.types == 1">{{popup.location}}</p>
                                <p class="m-0" v-if="popup.types == 2">{{popup.country}}</p>
                            </div>
                        </div>
                        <button type="button" class="close text-white bg-warning rounded p-1" data-dismiss="alert" aria-label="Close"
                        style="font-size:15px;top:-10px;right:-10px;opacity:1"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <!-- Display for the Desktop -->
                <div class="position-fixed rounded d-none d-sm-block" style="bottom:10px;z-index:13;width:35%">
                    <div class="alert alert-secondary alert-dismissible fade show m-1 rounded text-center w-100 p-0" role="alert" id="mobile_add_promote_link">
                        <div class="d-flex flex-row">
                            <div class="w-100 lazyload" :data-bgset="'/storage/job/Banner/'+popup.banner"  style="background-size:cover;height:auto" data-sizes="auto">
                            </div>
                            <div class="w-100 text-left p-1 font-weight-bold" style="font-size:12px">
                                <h6 class="m-0">{{popup.title}}</h6>
                                <p class="m-0" v-if="popup.types == 2">course Name : {{popup.course_name}}</p>
                                <p class="m-0">Deadline : {{popup.deadline | date}}</p>
                                <p class="m-0" v-if="popup.types == 1">{{popup.location}}</p>
                                <p class="m-0" v-if="popup.types == 2">{{popup.country}}</p>
                            </div>
                        </div>
                        <button type="button" class="close text-white bg-warning rounded p-1" data-dismiss="alert" aria-label="Close"
                        style="font-size:15px;top:-10px;right:-10px;opacity:1"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
</template>
<script>
import {format } from 'date-fns';

export default {
    data(){
        return{
            // Popup ad
            popup:{},
            show_popup:false,
        }
    },
    methods:{
        // Load the popup ad lists
        load_popup_ad(){
            axios.get('/api/job/list/popup_ad')
            .then(response => {
                this.popup = response.data;
                if(response.data.length > 0){
                    this.show_popup = true;
                }
            })
        },
    },
    // Filer
    filters:{
        date(str){
            return format(new Date(str), 'EE, MMM dd, yyyy');
        }
    },
    mounted(){
        this.load_popup_ad();
    }
}
</script>