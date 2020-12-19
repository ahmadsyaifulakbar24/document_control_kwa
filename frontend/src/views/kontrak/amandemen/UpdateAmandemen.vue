<template>
    <div>
        <div class="mb-5">
            <h4>Update Amandemen</h4>
        </div>
        <form id="udpateAmandemen" @submit.prevent="udpateAmandemen">
            <form-amandemen :form="form" :errors="errors" :btn="'Simpan Amandemen'"/>
        </form>
    </div>
</template>

<script>
import axios from 'axios'
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
    mounted() {
        this.getAmandemen()
    },
    methods: {
        async getAmandemen() {
            await axios.get(`kontrak/amandemen/get_by_id/${this.$route.params.amandemenID}`)
            .then((response) => {
                let data = response.data.data
                this.form.name = data.name
                this.form.keterangan = data.keterangan
            })
        },
        udpateAmandemen() {
            let formData = new FormData()
            let kontrakID = this.$route.params.kontrakID
            formData.append('kontrak_project_id', kontrakID)
            formData.append('name', this.form.name)
            formData.append('keterangan', this.form.keterangan)
            if(this.form.file.name) {
                formData.append('file', this.form.file)
            }
            axios.post(`kontrak/amandemen/update/${this.$route.params.amandemenID}`, formData)
            .then(() => {
                this.$toasted.show('data berhasil di simpan', {
                    type: 'success',
                    duration: 3000
                })
                this.$router.push({ name: 'amandemen', params: { kontrakID: kontrakID}})
            }).catch((error) => {   
                this.errors = error.response.data
            })
        }
    }
}
</script>

<style>

</style>