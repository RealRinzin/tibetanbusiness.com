<template>
    <div class="row" v-show="show_popup">
        <div  class="col-md-6 mx-auto" v-for="(popup,index) in popup" :key="index">
            <a v-bind:href="'/sale/'+popup.id">
                <!-- Display for the Mobile -->
                <div class="position-fixed rounded w-75 d-block d-sm-none" style="bottom:10px;z-index:13">
                    <div class="alert alert-secondary alert-dismissible fade show m-1 rounded text-center w-100 p-0" role="alert" id="mobile_add_promote_link">
                        <div class="d-flex flex-row">
                            <div class="w-100 lazyload" :data-bgset="'/storage/sale/Banner/'+popup.banner"  style="background-size:cover;height:auto" data-sizes="auto">
                            </div>
                            <div class="w-100 text-left px-1 py-0" style="font-size:12px">
                                <h5 class="m-0">{{popup.name}}</h5>
                                <p class="m-0">
                                    <span class="text-danger font-weight-bold" v-if="popup.price > 0">Price : {{popup.price}}</span>
                                    <span v-else>Call : +91-{{popup.mobile_no}}</span>
                                </p>
                                <p class="m-0">{{popup.location}}</p>
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
                <div class="position-fixed rounded w-25 d-none d-sm-block" style="bottom:10px;z-index:13">
                    <div class="alert alert-secondary alert-dismissible fade show m-1 rounded text-center w-100 p-0" role="alert" id="mobile_add_promote_link">
                        <div class="d-flex flex-row">
                            <div class="w-100 lazyload" :data-bgset="'/storage/sale/Banner/'+popup.banner"  style="background-size:cover;height:auto" data-sizes="auto">
                            </div>
                            <div class="w-100 text-left p-1" style="font-size:12px">
                                <h5 class="m-0">{{popup.name}}</h5>
                                <p class="m-0">
                                    <span class="text-danger font-weight-bold" v-if="popup.price > 0">Price :&#x20B9 {{popup.price}}</span>
                                    <span v-else>Call : +91-{{popup.mobile_no}}</span>
                                </p>
                                <p class="m-0">{{popup.location}}</p>
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
            axios.get('/api/sale/list/popup_ad')
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