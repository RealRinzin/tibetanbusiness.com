<template>
<div>
    <div class="p-2"><button class="btn btn-outline-warning d-flex" @click="upload_photos_modal()" >Upload New Documents</button></div>
<!-- Photo upload modal -->
    <div class="modal fade" id="upload_photos_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm" role="photo">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Documents</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="m-3">
                <vue-progress-bar></vue-progress-bar>
          </div>
          <div class="modal-body">
              <form @submit.prevent="upload()"  data-vv-scope="validate_document_form">
                  <div class="form-group">
                      <label for="name">Documents<small class="text-danger p-1 small">* (Must be PDF,DOC)</small></label>
                      <input type="file"  v-validate="'required|ext:pdf,docx,doc|size:2000'" @change="document()" name="cv" class="form-control" id="cv" aria-describedby="emailHelp" placeholder="Upload CV">
                      <div class="valid-feedback"></div>
                      <div v-if="errors.has('validate_document_form.cv')" class="invalid-feedback">
                          <span v-for="error in errors.collect('validate_document_form.cv')">{{ error }}</span>
                      </div>
                  </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="button" class="btn btn-secondary w-25" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger btn-md w-25" placeholder="Write your comment">Submit</button>
                </div>
              </form>
          </div>
        </div>
      </div>
    </div>
</div>

</template>
 
<script>
  export default {
    props:['job_id','load'],
    data() {
      return {
          id:this.job_id,

          file:{},
        // Image Upload datas
      };
    },
    // Methods
    methods:{
      // Open modal
      upload_photos_modal(){
            $("#upload_photos_modal").modal("show");           
      },
      // On Change
      document(){
          let fileReader = new FileReader();
          if(event.target.files[0].size < 2000000){
              this.file.file_name  = event.target.files[0].name
              fileReader.onload = (event) =>{
                  this.file.cv = event.target.result;
              }
          }else{
              alert("Image size should be less than 1MB")
          }
          // base64 data
          fileReader.readAsDataURL(event.target.files[0]);
      },
        // Submit documents
        upload(){
            // Assign job id
            this.file.job_basic_info_id = this.job_id;
            this.$validator.validateAll('validate_document_form').then((result) => {
                if(result){
                    axios.post('/api/job_documents/file',this.file,{
                    headers : { Authorization : localStorage.getItem("token")}
                    }).then(response=>{
                            this.$emit('load');
                        $("#upload_photos_modal").modal("hide");           
                    })
                }
            })
        }

    },
    // mounted
    mounted(){
    }
  };
</script> 