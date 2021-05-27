<template>
    <div class="card py-3">
        <div class="row px-2">
            <div class="col-md-12" >
                <h5 class="text-muted">Document Downloads</h5>
            </div>
            <div class="col-3 py-2" v-for="(file,index) in files" v-if="file.extension == 'image'">
                <a :href="'/storage/Job/Documents/'+file.path" v-if="file.extension  == 'image'" download>
                    <div class="photo lazyload" :data-bgset="'/storage/Job/Documents/'+file.thumb"  data-sizes="auto">
                        <i class="fas fa-download text-dark position-absolute" style="bottom:15px;"></i>
                    </div>
                </a>
            </div>

            <div class="col-2 py-2" v-for="(file,index) in files" v-if="file.extension == 'pdf'">
                <a :href="'/storage/Job/Documents/'+file.path" v-if="file.extension  == 'pdf'" download="">
                    <i class="fas fa-file-word fa-6x text-center text-danger">
                            <i class="fas fa-download text-dark position-absolute" style="font-size:15px;bottom:15px;left:15px"></i>
                    </i>
                </a>
            </div>
            <div class="col-2 py-2" v-for="(file,index) in files" v-if="file.extension == 'docx'">
                <a :href="'/storage/Job/Documents/'+file.path" v-if="file.extension  == 'docx'" download="">
                    <i class="fas fa-file-pdf fa-6x text-center text-primary">
                        <i class="fas fa-download text-dark position-absolute" style="font-size:15px;bottom:15px;left:15px"></i>
                    </i>
                </a>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props:['file'],
    data(){
        return{
            files:this.file
        }
    },
    mounted(){
    }
}
</script>