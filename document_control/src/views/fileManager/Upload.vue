<template>
    <div class="container">
        <div class="large-12 medium-12 small-12 cell">
            <label>File
                <input type="file" id="file" ref="file" v-on:change="handleFileUpload()"/>
            </label>
            <button v-on:click="submitFile()">Submit</button>
        </div>
        <div class="d-flex justify-content-center">
            <div class="mt-3">
                <button class="btn btn-primary btn-sm" @click="goBack()">Kembali Ke file manager</button>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
export default {
	data() {
		return {
            folder_path: "none",
            file: "",
            errors: []
		};
	},

	mounted() {
		this.submitFile();
	},

	methods: {
		handleFileUpload() {
             this.file = this.$refs.file.files[0];
        },

        async submitFile() {
            let formData = new FormData();
            this.folder_path = this.$route.params.folder_path;
            formData.append('file', this.file);
            formData.append('folder_path', this.folder_path);
            await axios.post('storage/upload_file', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then((response) => {
                console.log(response.data)
            }).catch((error) => {
                let { response } = error
                this.errors = response.data
                console.log(response.data)
            })
        },

        goBack() {
            window.history.back()
        }
	},
};
</script>

<style>
</style>