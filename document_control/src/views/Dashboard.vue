<template>
	<div class="container">
		<h5>File Manager</h5>
		<div>
            <div class="border p-1 mb-3 row">
                <div class="mr-4">
                    <i class="mdi mdi-undo-variant pr-0 font-18"></i> <a href="#" class="font-18" @click="backFolder">Back</a>
                </div>
                <div class="mr-4">
                    <i class="mdi mdi-upload pr-0 font-18"></i> <router-link :to="{ name: 'file_manager.upload', params: { folder_path: folder_path } }" class="font-18">Upload</router-link>
                </div>
                <div class="mr-4">
                    <i class="mdi mdi-folder-plus pr-0 font-18"></i> <a data-toggle="modal" data-target="#modalCreateFolder" class="font-18">Create Folder</a>
                </div>
            </div>
			<table class="table">
                <thead>
                    <tr>
                        <td>Name</td>
                        <td>Size</td>
                        <td>Modified</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="file in files" :key="file.name">
                        <td>
                            <template v-if="file.is_dir == true">
                                <i class="mdi mdi-folder"></i>
                            </template>
                            <template v-else>
                                <i class="mdi mdi-file"></i>
                            </template>
                            <a href="#" @click="getFolder(file.path)" > {{ file.name }}</a>
                        </td>
                        <td>{{ formatFileSize(file.size) }}</td>
                        <td>{{ formatTimestamp(file.mtime) }}</td>
                        <td>
                            <template v-if="file.is_dir != true">
                                <a href="#" class="mr-3" @click="downloadFile(file.path)"> <i class="mdi mdi-download"></i> Download</a>
                            </template>
                            <a href="#" @click="deleteDirectory(file.is_dir, file.path)"> <i class="mdi mdi-delete"></i> Delete</a>
                        </td>
                    </tr>
                </tbody>
            </table>
		</div>
        <div class="modal fade" id="modalCreateFolder" ref="modalCreateFolder" tabindex="-1" role="dialog" aria-labelledby="modalCreateFolderCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalCreateFolderLongTitle">New Folder</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="#" method="post" @submit.prevent="createFolder">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>New Folder Name</label>
                                <input type="text" v-model="formCreateFolder.folderName" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>New Folder will be created in</label>
                                <input type="text" v-model="formCreateFolder.path" class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Create New Folder</button>
                            <button type="button" id="closeModalBtn" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
	</div>
</template>

<script>
import axios from "axios";
export default {
	data() {
		return {
            folder_path: "",
            files: [],
            formCreateFolder: {
                folderName: '',
                path: ''
            }
		};
	},

	mounted() {
        this.getFolder();
        this.createFolder()
	},

	methods: {
        async getFolder(folder_path) {
            if(folder_path == undefined) {
                this.folder_path = "";
            } else {
                this.folder_path = folder_path;
            }
            this.formCreateFolder.path = this.folder_path
            axios.post("storage/show_folder", { folder_path: this.folder_path }).then((respone) => {
                this.files = respone.data.data
            })
        },

        async createFolder() {
            let folderName = this.formCreateFolder.folderName
            let path = this.formCreateFolder.path
            let folder_path = path.concat('/',folderName)
            await axios.post("storage/create_folder", { folder_path: folder_path }).then((response) => {
                console.log(response)
                document.getElementById("closeModalBtn").click()
                this.getFolder(path)
                this.formCreateFolder.folderName = ""
            }).catch((error) => {
                let { response } = error
                console.log(response)
            })
        },

        deleteDirectory(is_dir, folder_path) {
            if(is_dir == true) {
                axios.post('storage/delete_folder', {
                    folder_path: folder_path
                }).then((response) => {
                    console.log(response);
                    this.getFolder(this.folder_path)
                }).catch((error) => {
                    let { response } = error
                    console.log(response)
                })
            } else {
                axios.post('storage/delete_file', {
                    file_path: folder_path
                }).then((response) => {
                    console.log(response)
                    this.getFolder(this.folder_path)
                }).catch((error) => {
                    let { response } = error
                    console.log(response.data)
                })
            }
        },

        downloadFile(file_path) {
            axios.post("storage/get_file", {
                file_path: file_path
            }).then((response) => {
                window.open(response.data.file, "_blank")
            }).catch((error) => {
                let { response } = error
                console.log(response)
            })
        },
        backFolder() {
            let folder_path = this.folder_path
            let path = folder_path.substring(0, folder_path.lastIndexOf("/"));
            this.getFolder(path)
        },

        formatFileSize(bytes) {
            var s = ['bytes', 'KB','MB','GB','TB','PB','EB'];
            for(var pos = 0;bytes >= 1000; pos++,bytes /= 1024);
            var d = Math.round(bytes*10);
            return pos ? [parseInt(d/10),".",d%10," ",s[pos]].join('') : bytes + ' bytes';
        },

        formatTimestamp(unix_timestamp) {
            var m = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
            var d = new Date(unix_timestamp*1000);
            return [m[d.getMonth()],' ',d.getDate(),', ',d.getFullYear()," ",
                (d.getHours() % 12 || 12),":",(d.getMinutes() < 10 ? '0' : '')+d.getMinutes(),
                " ",d.getHours() >= 12 ? 'PM' : 'AM'].join('');
        }
    },
};
</script>

<style>
</style>