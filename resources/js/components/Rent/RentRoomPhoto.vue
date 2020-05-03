<template>
    <div>
        <div class="row p-3">
            <div class="col-md-12">
                <h6 class="text-dark">Room Photos({{total_photos}})</h6>
            </div>
            <div class="col-md-3 col-sm-4 col-xs-6 py-2" v-for="(room_photo,index) in room_photos" v-if="index < 7">
                <div class="photo" @click="room_photo_modal(index)" v-bind:style='{ backgroundImage: `url(/storage/Rent/Room-Photos/${room_photo.path})`}'></div>
            </div>
            <!-- More Photos -->
            <div class="col-md-3 col-sm-4 col-xs-6 py-2" v-if="total_photos >7">
                <div @click="more_room_photo_modal()" class="photo text-center p-3">
                    <i class="far fa-images fa-2x text-muted py-2"></i>
                    <p> {{total_photos - 7}} Photos More</p>
                </div>
            </div>
        </div>
        <!-- More Photo Modal -->
        <div class="modal fade" id="more_room_photo_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal_top" role="document">
                <div class="modal-content">
                    <div class="modal-body" v-if="modal_status">
                        <div id="show_food_photo_carousel" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item animated fadeIn duration-1s" v-for="(photo,index) in room_photos" :class="{ active: index==0 }">
                                    <div class="slide" style="height:55vh" v-bind:style='{ backgroundImage: `url(/storage/Rent/Room-Photos/${photo.path})`}'></div>
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
        <div class="modal fade" id="room_photo_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal_top" role="document">
                <div class="modal-content">
                    <div class="modal-body carousel" v-if="modal_status">
                        <div class="slide" style="height:55vh" v-bind:style='{ backgroundImage: `url(/storage/Rent/Room-Photos/${single_photo.path})`}'></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props:['rent_room_photos'],
    data(){
        return{
            room_photos:this.rent_room_photos,
            total_photos:this.rent_room_photos.length, //Total photos
            single_photo:{}, //single photo
            modal_status: false, //modal status
        }
    },
    methods:{
        // Load Single Photo
        room_photo_modal($id){
            $("#room_photo_modal").modal("show");//show modal by click
            this.modal_status = true; // modal status
            this.single_photo = this.room_photos[$id]; // assigning object
        },
        // More photo modal
        more_room_photo_modal(){
            $("#more_room_photo_modal").modal("show");
            this.modal_status = true;
        },
    },
    mounted(){
        // this.load_photos();
    }
}
</script>