<template>
    <div>
        <div class="mb-5">
            <h4>Edit Sub Project</h4>
        </div>

        <form @submit.prevent="EditSubProject">
            <div class="form-group row">
                <label for="name" class="col-lg-3">Nama</label>
                <div class="col-lg-5 col-xl-5">
                    <input type="text" class="form-control" v-model="form.name" id="name" placeholder="Nama">
                    <div v-if="errors.name" class="text-danger mt-2">{{ errors.name[0] }}</div>
                </div>
            </div>

            <div class="form-group row">
                <label for="keterangan" class="col-lg-3">Keterangan</label>
                <div class="col-lg-5 col-xl-5">
                    <textarea v-model="form.keterangan" class="form-control" id="keterangan" rows="3" placeholder="Keterangan"></textarea>
                    <div v-if="errors.keterangan" class="mt-2 text-danger">{{ errors.keterangan[0] }}</div>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-lg-3"></div>
                <div class="col-lg-5 col-xs-5"> 
                    <button type="submit" class="btn btn-primary btn-block">Simpan Sub Project</button>
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
            form: {
                project_id: this.$route.params.projectID,
                name: '',
                keterangan: ''
            },
            subProjectID: this.$route.params.subProjectID,
            projectID: this.$route.params.projectID,
            errors: []
        }
    },
    mounted() {
        this.getSubProject()
    },

    methods: {
        async getSubProject() {
            await axios.get(`document_flow/sub_project/get/${this.subProjectID}`)
            .then((response) => {
                this.form = response.data.data
            })
        },
        async EditSubProject() {
            await axios.patch(`document_flow/sub_project/update/${this.subProjectID}`, this.form)
            .then(() => {
                this.$toasted.show('berhasil update sub project', {
                    type: 'success',
                    duration: 3000
                })
                this.$router.push({ name: 'subProject.listSubProject', params: {projectID: this.projectID} })
            }).catch((error) => {
                console.log(error.response.data)
                this.errors = error.response.data
            })
        }
    }
}
</script>

<style>

</style>