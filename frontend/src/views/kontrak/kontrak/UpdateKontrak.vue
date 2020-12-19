<template>
    <div>
        <div class="mb-5">
            <h4>Edit Kontrak</h4>
        </div>
        <form id="createKontrak" @submit.prevent="updateKontrak">
            <form-kontrak :form="form" :errors="errors" :btn="'Simpan Kontrak'"/>
        </form>
    </div>
</template>

<script>
import axios from "axios";
import FormKontrak from "./FormKontrak"
export default {
    components: {
        FormKontrak
    },
    data() {
        return {
            form: {
                name: '',
                keterangan: '',
                amandemen: []
            },
            errors: []
        }
    },
    mounted() {
        this.getKontrak()
    },
    methods: {
        async getKontrak() {
            await axios.get(`/kontrak/get/${this.$route.params.kontrakID}`)
            .then((response) => {
                let data = response.data.data
                this.form.name = data.name
                this.form.keterangan = data.keterangan
            })
        },
        updateKontrak() {
            let formData = new FormData()
            formData.append('name', this.form.name)
            formData.append('keterangan', this.form.keterangan)
            if(this.form.amandemen.name) {
                formData.append('amandemen', this.form.amandemen)
            }
            axios.post(`kontrak/update/${this.$route.params.kontrakID}`, formData)
            .then(() => {
                this.$toasted.show('data berhasil di simpan', {
                    type: 'success',
                    duration: 3000
                })
                this.$router.push({ name: 'kontrak' })
            }).catch((error) => {
                this.errors = error.response.data
            })
        }
    }
}
</script>

<style>

</style>