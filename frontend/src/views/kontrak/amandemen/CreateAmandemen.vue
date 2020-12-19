<template>
    <div>
        <div class="mb-5">
            <h4>Buat Amandemen</h4>
        </div>
        <form id="createAmandemen" @submit.prevent="createAmandemen">
            <form-amandemen :form="form" :errors="errors" :btn="'Buat Amandemen'"/>
        </form>
    </div>
</template>

<script>
import axios from "axios"
import FormAmandemen from './FormAmandemen'
export default {
	components: { 
        FormAmandemen 
    },
    data() 
    {
        return {
            form: {
                name: '',
                keterangan: '',
                file: []
            },
            errors: []
        }
    },
    methods: {
        createAmandemen() {
            let formData = new FormData()
            formData.append('kontrak_project_id', this.$route.params.kontrakID)
            formData.append('name', this.form.name)
            formData.append('keterangan', this.form.keterangan)
            formData.append('file', this.form.file)
            axios.post('kontrak/amandemen/create', formData)
            .then(() => {
                this.$toasted.show('berhasil upload amandemen', {
                    type: 'success',
                    duration: 3000
                })
                this.$router.push({ name: 'amandemen', params: { kontrakID: this.$route.params.kontrakID }})
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