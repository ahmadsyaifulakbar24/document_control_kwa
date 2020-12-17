<template>
    <div>
        <div class="mb-5">
            <h4>Upload File Sub Project</h4>
        </div>


        <form @submit.prevent="uploadFileSubProject">
            <div class="input-group mb-3 row">
                <label for="uploadFile" class="col-lg-3">Upload File</label>
                <div class="col-lg-5 col-xl-5">
                    <div class="custom-file" id="uploadFile">
                        <input type="file" class="custom-file-input" id="uploadFile" ref="uploadFile" @change="handleFileUpload">
                        <label class="custom-file-label" for="uploadFile">{{ file.name }}</label>
                    </div>
                    <div v-if="errors.file" class="text-danger">{{ errors.file[0] }}</div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-3"></div>
                <div class="col-lg-5 col-xs-5"> 
                    <button type="submit" class="btn btn-primary btn-block">Upload File Sub Project</button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import axios from "axios";
export default {
    data() {
        return {
            file: [],
            projectID: this.$route.params.projectID,
            subProjectID: this.$route.params.subProjectID,
            errors:[]
        }
    },
    methods: {
        handleFileUpload() {
            this.file = this.$refs.uploadFile.files[0]
        },
        uploadFileSubProject() {
            let formData = new FormData()
            formData.append('file', this.file)
            
            axios.post(`document_flow/sub_project/upload_file/${this.subProjectID}`, formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then(() => {
                this.$toasted.show('berhasil upload file', {
                    type: 'success',
                    duration: 3000
                })
                this.$router.push({ name: 'subProject.listSubProject', params: { projectID:this.projectID } })
            }).catch((error) => {
                this.errors = error.response.data
            })
        }
    }
}
</script>

<style>

</style>