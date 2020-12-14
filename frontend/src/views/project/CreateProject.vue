<template>
    <div>
        <div class="mb-5">
            <h4>Buat Project</h4>
        </div>
        <form id="createProject" @submit.prevent="createProject">
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
                    <button type="submit" class="btn btn-primary btn-block">Buat Project</button>
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

    methods: {
        createProject() {
            axios.post('document_flow/project/create', this.formProject)
            .then(() => {
                this.$toasted.show('berhasil buat project', {
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