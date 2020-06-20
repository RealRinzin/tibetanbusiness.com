<template>
    <div>
        <div class="row p-3">
            <div class="col-md-12">
                <h6 class="text-dark">Event Photo ({{total_photos}})</h6>
            </div>
            <div class="col-md-3 col-sm-4 col-xs-6 py-2" v-for="(event_photo,index) in photos" v-if="index < 7">
                <div class="photo" @click="photo_modal(index)" v-bind:style='{ backgroundImage: `url(/storage/Service/Photos/${event_photo.path})`}'></div>
            </div>
            <!-- More Photos -->
            <div class="col-md-3 col-sm-4 col-xs-6 py-2" v-if="total_photos >7">
                <div @click="more_photo_modal()" class="photo text-center p-3">
                    <i class="far fa-images fa-2x text-muted py-2"></i>
                    <p> {{total_photos - 7}} Photos More</p>
                </div>
            </div>
        </div>
        <!-- Single Photo Modal -->
        <div class="modal fade" id="photo_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal_top" role="document">
                <div class="modal-content">
                    <div class="modal-body carousel" v-if="modal_status">
                        <div class="slide" style="height:55vh" v-bind:style='{ backgroundImage: `url(/storage/Service/Photos/${single_photo.path})`}'></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- More Photo Modal -->
        <div class="modal fade" id="more_photo_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal_top" role="document">
                <div class="modal-content">
                    <div class="modal-body" v-if="modal_status">
                        <div id="show_food_photo_carousel" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item animated fadeIn duration-1s" v-for="(photo,index) in photos" :class="{ active: index==0 }">
                                    <!-- <div class="slide" style="height:55vh" v-bind:style='{ backgroundImage: `url(/storage/Event/Photos/${photo.path})`}'></div> -->
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
    </div>
</template>
<script>
export default {
    props:['service_id'],
    data(){
        return{
            id:this.service_id,
            photos:{},
            total_photos:0,
            modal_status: false, //modal status
            single_photo:{}, //single photo
            
        }
    },
    // methods
    methods:{
        load_photo(){
            axios.get('/api/service/'+this.id+'/photos')
            .then(response=>{
                // data
                this.photos = response.data;
                // length
                this.total_photos = response.data.length;
            })
        },
        // Load Single Photo
        photo_modal($id){
            $("#photo_modal").modal("show");//show modal by click
            this.modal_status = true; // modal status
            this.single_photo = this.photos[$id]; // assigning object
        },
        // More photo modal
        more_photo_modal(){
            $("#more_photo_modal").modal("show");
            this.modal_status = true;
        },
    },
    mounted(){
        this.load_photo();
    }
}
</script>