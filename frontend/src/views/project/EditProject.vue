<template>
    <div>
        <div class="mb-5">
            <h4>Edit Project</h4>
        </div>
        <form id="editProject" @submit.prevent="editProject">
            <div class="form-group row">
                <label class="col-lg-3" for="name">Nama Project</label>
                <div class="col-lg-5 col-xl-5">
                    <input type="text" v-model="formProject.name" class="form-control" id="name" placeholder="Nama Project"/>
                    <div v-if="errors.name" class="mt-2 text-danger">{{ errors.name[0] }}</div>
                </div>
            </div>

            <div class="form-group row">
                <label for="keterangan" class="col-lg-3">Keterangan Project</label>
                <div class="col-lg-5 col-xl-5">
                    <textarea v-model="formProject.keterangan" class="form-control" id="keterangan" rows="3" placeholder="Keterangan Project"></textarea>
                    <div v-if="errors.keterangan" class="mt-2 text-danger">{{ errors.keterangan[0] }}</div>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-lg-3"></div>
                <div class="col-lg-5 col-xs-5"> 
                    <button type="submit" class="btn btn-primary btn-block">Update Project</button>
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
            formProject: {
                name: '',
                keterangan: '',
            },
            errors: []
        }
    },
    mounted() {
        this.getProject()
    },
    methods: {
        async getProject() {
            await axios.get(`document_flow/project/get/${this.$route.params.projectID}`)
            .then((response) => {
                this.formProject = response.data.data
            }).catch((error) => {
                this.errors = error.response.data
            })
        },
        async editProject() {
            await axios.patch(`document_flow/project/update/${this.$route.params.projectID}`, this.formProject)
            .then(() => {
                this.$toasted.show('berhasil edit project', {
                    type: 'success',
                    duration: 3000
                })
                this.formProject.name = ''
                this.formProject.keterangan = ''
                this.$router.push({ name: 'project' })
            }).catch((error) => {
                this.errors = error.response.data
            })
        },
    }
}
</script>

<style>

</style>