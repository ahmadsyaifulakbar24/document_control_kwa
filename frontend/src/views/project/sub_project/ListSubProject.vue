<template>
    <div>
        <router-link :to="{ name: 'subProject.createSubProject', params: { projectID: project_id } }">
            <div class="mb-3">
                <button class="btn btn-primary">Buat Sub Project</button>
            </div>
        </router-link>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th class="text-truncate">Name</th>
                    <th class="text-truncate">Keterangan</th>
                    <th class="text-truncate">File</th>
                    <th class="text-truncate">Createad at</th>
                    <th class="text-truncate">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="subProject in subProjects" :key="subProject.id">
                    <th class="text-truncate">{{ subProject.name }}</th>
                    <th class="text-truncate">{{ subProject.keterangan }}</th>
                    <th class="text-truncate">
                        <template v-if="subProject.file !== ''"> {{ subProject.file }} </template>
                        <template v-else> File belum di upload </template>   
                    </th>
                    <th class="text-truncate">{{ subProject.created_at }}</th>
                    <th class="text-truncate">
                        <div class="d-flex">
                            <div class="text-info">
                                <router-link :to="{ name: 'subProject.EditSubProject', params: { projectID: project_id, subProjectID: subProject.id } }">
                                    <i class="mdi mdi-pencil"><span>Edit</span></i>
                                </router-link>
                            </div>
                            <delete-sub-project :projectID="project_id" :subProjectID="subProject.id" />
                        </div>
                    </th>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import axios from "axios";
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
        }
    }
}
</script>

<style>

</style>