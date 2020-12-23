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
                <label for="user_id" class="col-lg-3">Target</label>
                <div class="col-lg-5 col-xl-5">
                    <select v-model="form.user_id" id="user_id" class="form-control">
                        <option :value="userSelected.id" v-text="userSelected.name"></option>
                        <template v-for="userProject in userProjects">
                            <option v-if="userSelected.id !== userProject.id" :key="userProject.id" :value="userProject.id">
                                {{ userProject.name }}
                            </option>
                        </template>
                    </select>
                    <div v-if="errors.user_id" class="mt-2 text-danger">{{ errors.user_id[0] }}</div>
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
                keterangan: '',
                user_id: ''
            },
            userSelected:{},
            userProjects: [],
            subProjectID: this.$route.params.subProjectID,
            projectID: this.$route.params.projectID,
            errors: []
        }
    },
    mounted() {
        this.getSubProject()
        this.getUserProject()
    },

    methods: {
        async getSubProject() {
            await axios.get(`document_flow/sub_project/get/${this.subProjectID}`)
            .then((response) => {
                let data = response.data.data
                this.form = data
                this.userSelected = data.user
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
                this.errors = error.response.data
            })
        },
        async getUserProject() {
            await axios.get('user/get_user_project/')
            .then((response) => {
                this.userProjects = response.data.data
            })
        }
    }
}
</script>

<style>

</style>