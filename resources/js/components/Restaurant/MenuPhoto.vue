<template>
    <div>
        <div class="row p-3">
            <div class="col-md-12">
                <h6 class="text-dark">Menu Photo (4)</h6>
            </div>
            <div class="col-md-3 col-sm-4 col-xs-6 py-2" v-for="(menu_photo,index) in photos">
            <div @click="photo_modal(index)" class="photo" v-bind:style='{ backgroundImage: `url(/img/${menu_photo.path})`}'></div></div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="menu_photo_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-body" v-if="modal_status">
                <img v-bind:src="'/img/'+single_photo.path" alt="" class="img-fluid">
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
            single_photo:{}, // single 
            // Modal status Off
            modal_status: false,
        }
    },
    methods:{
        /* Photos */
        loadPhotos(){
            this.photos = this.menu_photos;
        },
        /* Photo Modal */
        photo_modal($id){
            // Modal status On
            $("#menu_photo_modal").modal("show");
            this.modal_status = true;
            this.single_photo = this.photos[$id];
        }
    },
    mounted(){
        // Loading methods
        this.loadPhotos();
    }
    
}
</script>