<template>
  <div id="dashboard_photo">
    <div class="row">
      <div class="col-md-12 py-3">
        <div class="d-flex flex-row">
          <div class="p-2"><button class="btn btn-outline-danger d-flex" @click="upload_documents_modal()">Upload New Photos</button></div>
          <div>
              <Photo :job_id="id" @load="load_document"/>
          </div>
          <div class="pt-3 px-2"><h6 class="text-muted">Total Photos ({{documents.length}})</h6></div>
        </div>
      </div>
    </div>
    <!-- Photo iterations -->
    <div class="row"> 
      <div class="col-md-2 col-sm-4 col-6" v-for="(document,index) in documents">
        <button class="btn btn-danger btn-xs delete_btn position-absolute" @click="remove(document.id,index)"><i class="fas fa-trash-alt "></i></button>
        <div v-if="document.extension == 'image'" class="card gallery_view lazyload" data-toggle="modal" data-target="#event_document" v-bind:style='{ backgroundImage: `url(/storage/Job/Documents/${document.thumb})`}' data-sizes="auto">
          <div class="overlay">
            <div class="d-flex mt-auto ml-auto p-2">
            </div>
          </div>
        </div>
        <div v-if="document.extension == 'docx'" class="lazyload">
              <i class="fas fa-file-word fa-5x text-center text-primary"></i>
        </div>
        <div v-if="document.extension == 'pdf'" class="lazyload">
              <i class="fas fa-file-pdf fa-5x text-center text-danger"></i>
        </div>
    </div>
  </div>
    <!-- More Photo Modal -->
    <div class="modal fade" id="event_document" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body" v-if="modal_status">
                    <div id="document" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">)
                            <div class="carousel-item animated fadeIn duration-1s" v-for="(document,index) in documents" :class="{ active: index==active }">
                                <div v-if="document.extension == 'image'" style="height:55vh" class="slide lazyload" :data-bgset="'/storage/Job/Documents/'+document.thumb"></div>
                                <div v-if="document.extension == 'docx'" style="height:55vh" class="slide lazyload">
                                  <i class="fas fa-file-pdf"></i>
                                </div>
                                <div v-if="document.extension === 'pdf'" style="height:55vh" class="slide lazyload">
                                  asd
                                  <i class="fas fa-file-pdf fa-3x"></i>
                                </div>
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#document" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#document" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Photo upload modal -->
    <div class="modal fade" id="upload_documents_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Photos</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="m-3">
                <vue-progress-bar></vue-progress-bar>
          </div>
          <div class="modal-body">
            <div id="image_upload"
                @dragenter="OnDragEnter"
                @dragleave="OnDragLeave"
                @dragover.prevent
                @drop="onDrop"
                :class="{ dragging: isDragging }">
                <div class="upload-control" v-show="images.length">
                    <button class="btn btn-warning btn-md" @click="clear_all()">Clear All</button>
                    <button class="btn btn-success btn-md" @click="upload(id)">Upload</button>
                </div>

                <div v-show="!images.length">
                    <i class="fa fa-cloud-upload"></i>
                    <p>Drag your images here</p>
                    <div>OR</div>
                    <div class="file-input">
                        <label for="rent_room_document">Select a file</label>
                        <input type="file"  id="rent_room_document" @change="onInputChange" multiple>
                    </div>
                </div>

                <div class="images-preview" v-show="images.length">
                    <div class="img-wrapper" v-for="(image, index) in images" :key="index">
                        <img :src="image" :alt="`Image Uplaoder ${index}`">
                        <div class="remove_item">
                                <i @click="destory(index)" class="fas fa-times-circle bg-danger p-2"></i>
                        </div>
                        <div class="details">
                            <span class="size" v-text="getFileSize(files[index].size)"></span>
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
import Photo from './Photo';
  export default {
    props:['job_id'],
    data() {
      return {
          id:this.job_id,
          documents:{},
        modal_status: false, //modal status
        active:0,
        // Image Upload datas
        isDragging: false,
        dragCount: 0,
        files: [],
        total_image:0,
        images: [],
        // End
        valid_image:[],
      };
    },
    // Methods
    methods:{
        load_document(){
            axios.get(`/api/job/${this.id}/documents`)
            .then(response=>{
                // data
                this.documents = response.data;
                // length
                this.total_documents = response.data.length;
            })
        },
      /**
       * Photo click
       * Function
       *  */ 
      document_view(index){
            this.modal_status = true;
            // active class
            this.active = index;   
      },
      /**
       * Removing Photo
       *  */
      remove(id,index){
        let confirmBox = confirm('Are you sure want to Delete!!!');
        if(confirmBox == true){
          axios.delete('/api/job_document/'+id,{
            headers : { Authorization : localStorage.getItem("token")}
          })
          .then(response=>{
            //  Flash Message  
            toast.fire({
                icon:'success',
                title:'Deleted Successfully',
            });
            this.$delete(this.documents,index);
          })
        }
      },
      // Menu modal
      upload_documents_modal(){
            $("#upload_documents_modal").modal("show");           
      },
      /**
       * Image Upload 
       * Methods
       * Function
       *  */ 
        OnDragEnter(e) {
            e.preventDefault();
            this.dragCount++;
            this.isDragging = true;
            return false;
        },
        OnDragLeave(e) {
            e.preventDefault();
            this.dragCount--;
            if (this.dragCount <= 0)
                this.isDragging = false;
        },
        onInputChange(e) {
            // Total Selected Image 
            this.total_image = e.target.files.length;
              const files = e.target.files;
                if (this.total_image <=5) {
                  for (let index = 0; index < e.target.files.length; index++) {
                    if(files[index].size < 1000000){
                      this.valid_image.push(files[index]);
                      }else{
                        alert("Your image size should be less than 1MB")
                      }
                  }
                  Array.from(this.valid_image).forEach(file => this.addImage(file));
                  
              }else{
                alert("select less than 5 documents");
              }
        },
        onDrop(e) {
            e.preventDefault();
            e.stopPropagation();
            this.isDragging = false;
            const files = e.dataTransfer.files;
            Array.from(files).forEach(file => this.addImage(file));
        },
        // Add Images
        addImage(file) {
            if (!file.type.match('image.*')) {
                alert("Please Upload Only Images")
                return;
            }
            this.files.push(file);
            const img = new Image(),
            reader = new FileReader();
            reader.onload = (e) => this.images.push(e.target.result);
            reader.readAsDataURL(file);
        },
        /* Check the size of image */
        getFileSize(size) {
            const fSExt = ['Bytes', 'KB', 'MB', 'GB'];
            let i = 0;
            while(size > 900) {
                size /= 1024;
                i++;
            }
            return `${(Math.round(size * 100) / 100)} ${fSExt[i]}`;
        },
        
        /* Remove image */
        destory(index){
            // Removing image
            this.$delete(this.images,index);
            this.$delete(this.valid_image,index);
            // Removing the image files
            this.$delete(this.files,index);
        },

        // Upload
        upload(id) {
            // Progress Bar
            this.$Progress.start();
            const formData = new FormData();
            this.files.forEach(file => {
                formData.append('images[]', file, file.name);
            // Append the ID of restaurant
                formData.append('id',id);
            });
            // Progress
            axios.post('/api/job_document', formData,{
              headers : { Authorization : localStorage.getItem("token")}
            })
              .then(response => {
                //  Flash Message  
                  toast.fire({
                    icon:'success',
                      title:'Updated',
                  });
                  this.images = [];
                  this.files = [];
                  this.valid_image = [];
                  $("#upload_documents_modal").modal("hide"); 
                //  loading
                this.load_document();
                // Progress finish
                this.$Progress.finish();
              })
        },
        // Clear all files
        clear_all(){
            this.images = [];
            this.files = [];
            this.valid_image =[]
        }
        
    },
    components:{Photo},
    // mounted
    mounted(){
        this.load_document();
    }
  };
</script> 