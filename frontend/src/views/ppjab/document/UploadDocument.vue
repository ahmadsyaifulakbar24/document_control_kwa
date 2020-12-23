<template>
    <div>
        <div class="mb-5">
            <h4>Upload Document</h4>
        </div>
        <form @submit.prevent="uploadDocument">
            <div class="form-group row">
                <label class="col-lg-3" for="name">Nama File</label>
                <div class="col-lg-5 col-xl-5">
                    <input type="text" v-model="form.name" class="form-control" id="name" placeholder="Nama File"/>
                    <div v-if="errors.name" class="mt-2 text-danger">{{ errors.name[0] }}</div>
                </div>
            </div>
            <div class="form-group row">
                <label for="keterangan" class="col-lg-3">Keterangan Document</label>
                <div class="col-lg-5 col-xl-5">
                    <textarea v-model="form.keterangan" class="form-control" id="keterangan" rows="3" placeholder="Keterangan Document"></textarea>
                    <div v-if="errors.keterangan" class="mt-2 text-danger">{{ errors.keterangan[0] }}</div>
                </div>
            </div>

            <div class="input-group mb-3 row">
                <label for="uploadFile" class="col-lg-3">Upload File</label>
                <div class="col-lg-5 col-xl-5 ml-2">
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
                    <button type="submit" class="btn btn-primary btn-block">Upload File</button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import axios from 'axios'
export default {
    data() {
        return {
            form: {
                name: '',
                keterangan: ''
            },
            file: [],
            errors: []
        }
    }, 
    methods: {
        handleFileUpload() {
            this.file = this.$refs.uploadFile.files[0]
        },
        
        uploadDocument() {
            let formData = new FormData()
            formData.append('ppjab_id', this.$route.params.ppjabID)
            formData.append('group_id', this.$route.params.groupID)
            formData.append('name', this.form.name)
            formData.append('keterangan', this.form.keterangan)
            formData.append('file', this.file)

            axios.post('ppjab/document_ppjab/create', formData)
            .then(() => {
                this.$toasted.show('berhasl upload data', {
                    type: 'success',
                    duration: 3000
                })
                this.$router.push({ name: 'ppjab.document', params: { ppjabID: this.$route.params.ppjabID, groupID: this.$route.params.groupID } })
            }).catch((error) => {
                this.errors = error.response.data
            })
        }
    }
}
</script>

<style>

</style>