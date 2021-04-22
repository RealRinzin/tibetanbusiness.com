<template>
    <div style="z-index:1060;background:red">
        <div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container" style="margin-top: 30%;">
                            <div class="row">
                                <div class="col-10 mx-auto">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="px-0" id="tb_location">
                                                <div class="input-group mb-3 input-group-md">
                                                    <input type="text" @keyup="search()" v-model="keyword_location" name="location" style="font-size:14px;padding:25px" class="form-control" placeholder="Type location.." id="location">
                                                    <ul class="w-100" id="location_list" style="position: absolute;z-index:100;height:auto;display:none">
                                                        <li style="list-style:none;cursor:pointer" class="py-2 text-dark border-bottom bg-light">
                                                            <!-- <span class="font-weight-bold text-dark" style="font-size:13px"></span> -->
                                                            <!-- <span class="d-block text-muted" style="font-size:12px"></span> -->
                                                        </li>
                                                        <!-- <li>sadfasd</li> -->
                                                        <!-- <li>sadfasd</li> -->
                                                        <!-- <li>sadfasd</li> -->
                                                        <!-- <li>sadfasd</li> -->
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="px-0" id="tb_type">
                                                <div class="input-group mb-3 input-group-md">
                                                    <input type="text" id="service_search" style="padding:25px" class="rounded form-control form-control-navbar" readonly="readonly" placeholder="Service" aria-label="service type" required>
                                                    <ul id="service_list" style="display:none;transition:1s" class="position-absolute rounded overflow-hidden">
                                                        <button type="button" id="service_close" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>

                                                        <li><a href="#"><span class="mr-2"><img></span></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4 mx-auto">
                                            <div class="px-0">
                                                <div class="input-group-append">
                                                    <button type="submit" name="search" class="btn btn-light border-left rounded w-100" style="padding:0px !important">
                                                        <i class="fas fa-search"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
    data(){
        return{
            keyword_location:'',
            places:{},
        }
    },
    methods:{
        search(){
            let keyword_location = "\""+ this.keyword_location+  "\"";
            if(this.keyword_location ==''){
                this.keyword_location = '';
                this.places ={};
            }else{
                if(this.keyword_location.length > 4){
                axios.get("/api/map?query="+keyword_location)
                .then(response=>{
                    let locations = JSON.parse(response.data.data);
                    this.places = locations.suggestedLocations;
                    console.log(this.places);
                }) 
                }
            }
        }
    },
    mounted(){
        console.log("Mobile Search");
    }
}
</script>