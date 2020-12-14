<template>
    <div>
        <div class="mb-5">
            <h4>Buat Sub Project</h4>
        </div>

        <form @submit.prevent="createSubProject">
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
                    <button type="submit" class="btn btn-primary btn-block">Buat Sub Project</button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import axios from "axios"
export default {
    data() {
        return {
            form: {
                project_id: this.$route.params.projectID,
                name: '',
                keterangan: ''
            },
            errors: []
        }
    },
    methods: {
        createSubProject() {
            axios.post('document_flow/sub_project/create', this.form)
            .then(() => {
                this.$toasted.show('berhasil buat sub project', {
                    type: 'success',
                    duration: 3000
                })
                this.$router.push({ name: 'subProject.listSubProject', params: { projectID:this.form.project_id } })
            }).catch((error) => {
                console.log(error.response.data)
                this.errors 
            })
        }
    }
}
</script>

<style>

</style>