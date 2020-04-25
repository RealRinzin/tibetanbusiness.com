<template>
  <div>
<div id="preview" style="py-2"></div>
<div class="wrapper">
  <form @submit.prevent="status">
<input id="browse" type="file" @change="previewFiles()" multiple>
    <div class="custom-file-container" data-upload-id="myFirstImage">
      <label>Upload File <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">x</a></label>
      <label class="custom-file-container__custom-file">
        <input type="file" @change="check($event)"  class="custom-file-container__custom-file__custom-file-input" accept="*" multiple>
        <!-- <input type="hidden" name="MAX_FILE_SIZE" value="10485760" /> -->
        <span class="custom-file-container__custom-file__custom-file-control"></span>
      </label>
      <div class="custom-file-container__image-preview"></div>
    </div>
    <button type="submit" class="btn btn-danger">Upload</button>


  </form>
  </div>

  </div>
</template>
<script>
// using import
import FileUploadWithPreview from 'file-upload-with-preview'
import 'file-upload-with-preview/dist/file-upload-with-preview.min.css'
    export default {
      data(){
        return{
          // fileReader:{},
          photos:{},

          test:{
            data:{}
          },
          images:'',
             upload: null
        }
      },
      methods:{
        previewFiles() {

          // var preview = document.querySelector('#preview');
          // this.photos   = document.querySelector('input[type=file]').files;
          
          // function readAndPreview(file) {
            // Make sure `file.name` matches our extensions criteria
            // if ( /\.(jpe?g|png|gif)$/i.test(file.name) ) {
              // var reader = new FileReader();

              //         reader.onload = (event) =>{
              //             this.test.path = event.target.result
              //         }
            // reader.readAsDataURL(event.target.files[0]);
              // reader.addEventListener("load", function () {
              //   var image = new Image();
              //   image.height = 100;
              //   image.title = file.name;
              //   image.src = this.result;
              //   preview.appendChild( image );
              // }, false);

              // reader.readAsDataURL(file);
            // }

          // }

          // if (this.photos) {
          //   [].forEach.call(this.photos, readAndPreview);
          // }

        },


        check(event){
          for (let index = 0; index < event.target.files.length; index++) {
           var reader = new FileReader();
              reader.onload = (event) =>{
                  this.test.data[index] = event.target.result;
                  
              }
            reader.readAsDataURL(event.target.files[index]);
            // this.photos= reader.readAsDataURL(event.target.files[index]);
          }
// for (let k = 0; k < this.test.length; k++) {
//   console.log(k);
  
// }
            // console.log(this.photos);
            // console.log(this.photos.push(this.test));
          },
      //  fileReader.readAsDataURL(event);
          
        status () {
           console.log(this.upload.cachedFileArray)
          console.log(this.test);
          axios.post('/upload',this.test)
          .then(response=>{
            // console.log(this.photos);
            console.log(response);
          })
          
        }
      },
        mounted() {
          // this.status();
              this.upload = new FileUploadWithPreview('myFirstImage');

              
      }
    } 
</script>
    <style>
      img{
        padding:10px;
        border-radius:10%;
      }
    </style>