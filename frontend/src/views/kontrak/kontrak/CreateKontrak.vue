<template>
    <div>
        <div class="mb-5">
            <h4>Buat Kontrak</h4>
        </div>
        <form id="createKontrak" @submit.prevent="createKontrak">
            <form-kontrak :form="form" :errors="errors" :btn="'Buat Kontrak'"/>
        </form>
    </div>
</template>

<script>
import FormKontrak from "./FormKontrak"
import axios from "axios"
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
    methods: {
        createKontrak() {
            let formData = new FormData()
            formData.append('name', this.form.name)
            formData.append('keterangan', this.form.keterangan)
            formData.append('amandemen', this.form.amandemen)
            axios.post('kontrak/create', formData)
            .then(() => {
                this.$toasted.show('berhasil buat kontrak', {
                    type: 'success',
                    duratin: 3000
                })
                this.$router.push({ name: 'kontrak' })
            }).catch((error) => {
                this.errors =  error.response.data
            })
        }
    }
    
}
</script>

<style>

</style>