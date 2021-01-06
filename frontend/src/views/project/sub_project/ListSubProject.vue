<template>
    <div>
        <template v-if="user.user_level_id == 100">
            <router-link :to="{ name: 'subProject.createSubProject', params: { projectID: project_id } }">
                <div class="mb-3">
                    <button class="btn btn-primary">Buat Dokumen</button>
                </div>
            </router-link>
        </template>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th class="text-truncate">Name</th>
                    <th class="text-truncate">Keterangan</th>
                    <th class="text-truncate">File</th>
                    <th class="text-truncate">Target</th>
                    <th class="text-truncate">Createad at</th>
                    <th class="text-truncate">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="subProject in subProjects" :key="subProject.id" :class="{ 'bg-light' :user.id !== subProject.user_id  }">
                    <th class="text-truncate">{{ subProject.name }}</th>
                    <th class="text-truncate">{{ subProject.keterangan }}</th>
                    <th class="text-truncate">
                        <template v-if="subProject.file !== ''"> {{ fileName(subProject.file) }} </template>
                        <template v-else> File belum di upload </template>   
                    </th>
                    <th class="text-truncate">{{ subProject.user.name }}</th>
                    <th class="text-truncate">{{ subProject.created_at }}</th>
                    <th class="text-truncate" >
                        <div class="d-flex">
                            <div v-if="user.user_level_id == 100" class="text-info">
                                <router-link :to="{ name: 'subProject.EditSubProject', params: { projectID: project_id, subProjectID: subProject.id } }">
                                    <i class="mdi mdi-pencil"><span>Edit</span></i>
                                </router-link>
                            </div>
                            <div class="text-info">
                                <template v-if="user.id == subProject.user_id">
                                    <router-link :to="{ name: 'subProject.UploadFileSubProject', params: { projectID: project_id, subProjectID: subProject.id } }">
                                            <i class="mdi mdi-file-upload">
                                                <template v-if="subProject.file !== ''">
                                                    <span>Update File</span>
                                                </template>
                                                <template v-else>
                                                    <span>Upload File</span>
                                                </template>
                                            </i>
                                    </router-link>
                                </template>
                            </div>
                            <div class="text-info" v-if="subProject.file">
                                <a target="_blank" :href="subProject.file" :download="subProject.name">
                                    <i class="mdi mdi-download"><span>Download</span></i>
                                </a>
                            </div>
                            <delete-sub-project v-if="user.user_level_id == 100" :projectID="project_id" :subProjectID="subProject.id" />
                        </div>
                    </th>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import axios from "axios";
import { mapGetters } from "vuex";
import DeleteSubProject from "./DeleteSubProject.vue";
export default {
    components: {
        DeleteSubProject
    },
    data() {
        return {
            project_id: this.$route.params.projectID,
            subProjects: []
        }
    },
    computed: {
        ...mapGetters({
            user: 'auth/user'
        })
    },

    mounted() {
        this.showAllSubProject()
    },
    methods: {
        async showAllSubProject() {
            await axios.get(`document_flow/sub_project/get_by_project/${this.project_id}`)
            .then((response) => {
                this.subProjects = response.data.data
            }).catch((error) => {
                console.log(error.response.data)
            })
        },
        fileName(fileURL) {
            let newFileName = fileURL.substring(fileURL.lastIndexOf('/')+1)
            return newFileName
        }
    }
}
</script>

<style>

</style>