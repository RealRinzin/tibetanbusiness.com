<template>
    <div>
        <div class="row p-3">
            <div class="col-md-12">
                <h6 class="text-dark">View Photos({{total_photos}})</h6>
            </div>
            <div class="col-md-3 col-sm-4 col-xs-6 py-2" v-for="(view_photo,index) in view_photos" v-if="index < 7">
                <div class="photo" @click="view_photo_modal(index)" v-bind:style='{ backgroundImage: `url(/storage/Rent/View-Photos/${view_photo.path})`}'></div>
            </div>
            <!-- More Photos -->
            <div class="col-md-3 col-sm-4 col-xs-6 py-2" v-if="total_photos >7">
                <div @click="more_view_photo_modal()" class="photo text-center p-3">
                    <i class="far fa-images fa-2x text-muted py-2"></i>
                    <p> {{total_photos - 7}} Photos More</p>
                </div>
            </div>
        </div>
        <!-- More Photo Modal -->
        <div class="modal fade" id="more_view_photo_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal_top" role="document">
                <div class="modal-content">
                    <div class="modal-body" v-if="modal_status">
                        <div id="show_food_photo_carousel" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item animated fadeIn duration-1s" v-for="(photo,index) in view_photos" :class="{ active: index==0 }">
                                    <div class="slide" style="height:55vh" v-bind:style='{ backgroundImage: `url(/storage/Rent/View-Photos/${photo.path})`}'></div>
                                    <!-- <img :src="'/img/'+photo.path" alt="" class="img-fluid"> -->
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#show_food_photo_carousel" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#show_food_photo_carousel" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Single Photo Modal -->
        <div class="modal fade" id="view_photo_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal_top" role="document">
                <div class="modal-content">
                    <div class="modal-body carousel" v-if="modal_status">
                        <div class="slide" style="height:55vh" v-bind:style='{ backgroundImage: `url(/storage/Rent/View-Photos/${single_photo.path})`}'></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props:['rent_view_photos'],
    data(){
        return{
            view_photos:{},
            total_photos:0, //Total photos
            single_photo:{}, //single photo
            modal_status: false, //modal status
        }
    },
    // methods
    methods:{
        // Load Single Photo
        view_photo_modal($id){
            $("#view_photo_modal").modal("show");//show modal by click
            this.modal_status = true; // modal status
            this.single_photo = this.view_photos[$id]; // assigning object
        },
        // More photo modal
        more_view_photo_modal(){
            $("#more_view_photo_modal").modal("show");
            this.modal_status = true;
        },
    },
// watch 
    watch: {
        rent_view_photos: function(data) { 
            this.view_photos = data;
            this.total_photos = data.length;
        }
    },
    mounted(){
        console.log("RentView");
    }
}
</script>