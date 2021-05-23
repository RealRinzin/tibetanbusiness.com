<template>
    <div>
        <!-- Modal -->
            <form @submit.prevent="upload()"  data-vv-scope="apply_validate_job_form">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label for="name">Documents<small class="text-danger p-1 small">* (Must be PDF,DOC,IMAGE)</small></label>
                                    <input type="file" multiple="multiple" v-validate="'required|ext:pdf,docx,doc,jpeg,jpg,png|size:2000'" @change="onInputChange" name="cv" class="form-control" id="cv" aria-describedby="emailHelp" placeholder="Upload CV">
                                    <div class="valid-feedback"></div>
                                    <div v-if="errors.has('apply_validate_job_form.cv')" class="invalid-feedback">
                                        <span v-for="error in errors.collect('apply_validate_job_form.cv')">{{ error }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="button" class="btn btn-secondary w-25" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger btn-md w-25" placeholder="Write your comment">Submit</button>
                </div>
            </form>
    </div>
</template>
<script>
export default {
    // Job id
    props:['job_id'],
    data(){
        return{
            apply:{},
            /**
             * Check Login status
             *  */ 
            is_logged:false,

            // upload test
        files: [],
        total_image:0,
        images: [],
        // End
        valid_image:[],
        }
    },
    methods:{
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
                alert("select less than 5 photos");
              }
        },
        // Add Images
        addImage(file) {
            if (!file.type.match('.*')) {
                alert("Please Upload Only Images")
                return;
            }
            this.files.push(file);
            const img = new Image(),
            reader = new FileReader();
            reader.onload = (e) => this.images.push(e.target.result);
            reader.readAsDataURL(file);
        },
        document(){
            let fileReader = new FileReader();
            for (let index = 0; index < event.target.files.length; index++) {
                if(event.target.files[index].size < 2000000){
                    this.apply.file_name  = event.target.files[index].name;
                    fileReader.onload = (event) =>{
                        this.apply.cv[index] = event.target.result[index];
                    }
                }else{
                    alert("Image size should be less than 1MB")
                }
            }
            fileReader.readAsDataURL(event.target.files[0]);
            // base64 data
        },

        // Submit documents
        apply_job(){
            console.log(this.apply);
            // Assign job id
            this.apply.job_basic_info_id = this.job_id;
            this.$validator.validateAll('apply_validate_job_form').then((result) => {
                if(result){
                    axios.post('/api/job_apply',this.apply,{
                    headers : { Authorization : localStorage.getItem("token")}
                    }).then(response=>{
                        toast.fire({
                            icon:'success',
                            title:'Successfully Applied',
                        });
                        location.reload();
                    })
                }

            })
        },

        // upload
        upload(){
            const formData = new FormData();
            this.files.forEach(file => {
                formData.append('images[]', file, file.name);
            // Append the ID of restaurant
                // formData.append('id','dsafasdf');
            });
            console.log(formData);
            axios.post('/api/job_apply',formData,{
            headers : { Authorization : localStorage.getItem("token")}
            }).then(response=>{
                toast.fire({
                    icon:'success',
                    title:'Successfully Applied',
                });
                // location.reload();
            })

        }
    },
    mounted(){

    }
}
</script>