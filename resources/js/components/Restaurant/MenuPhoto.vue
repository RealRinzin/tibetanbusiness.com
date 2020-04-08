<template>
    <div>
        <div class="row p-3">
            <div class="col-md-12">
                <h6 class="text-dark">Menu Photo (4)</h6>
            </div>
            <!-- Single photos -->
            <div class="col-md-3 col-sm-4 col-xs-6 py-2" v-for="(menu_photo,index) in photos" v-if="index < 7">
                <div @click="photo_modal(index)" class="photo" v-bind:style='{ backgroundImage: `url(/img/${menu_photo.path})`}'></div>
            </div>
            <!-- More Photos -->
            <div class="col-md-3 col-sm-4 col-xs-6 py-2">
                <div @click="photo_modal()" class="photo text-center p-3">
                    <!-- <i class="fas fa-2x fa-plus text-muted py-2"></i> -->
                    <i class="far fa-images fa-2x text-muted py-2"></i>
                    <p> {{total_photos - 7}} Photos More</p>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="menu_photo_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal_top" role="document">
            <div class="modal-content">
                <div class="modal-body" v-if="modal_status">
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item animated fadeIn duration-1s" v-for="(photo,index) in photos" :class="{ active: index==0 }">
                                <div class="slide" v-bind:style='{ backgroundImage: `url(/img/${photo.path})`}'></div>
                                <!-- <img :src="'/img/'+photo.path" alt="" class="img-fluid"> -->
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
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
    props:['menu_photos'],
    data(){
        return {
            photos:{}, // photos object
            total_photos:0, // total photo count
            single_photo:{}, // single 
            // Modal status Off
            modal_status: false, //modal status
        }
    },
    methods:{
        /* Photos */
        loadPhotos(){
            this.photos = this.menu_photos;
            this.total_photos = this.photos.length;
        },
        /* Photo Modal */
        photo_modal($id){
            // Modal status On
            $("#menu_photo_modal").modal("show");
            this.modal_status = true;
            this.single_photo = this.photos[$id];
        },
        /* More Photo modal */
        more_photo_modal(){
            console.log("More");
        }
    },
    mounted(){
        // Loading methods
        this.loadPhotos();
        
    }
    
}
</script>