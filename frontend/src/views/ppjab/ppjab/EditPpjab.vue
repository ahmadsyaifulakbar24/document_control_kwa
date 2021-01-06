<template>
    <div>
        <div class="mb-5">
            <h4>Edit PPJAB</h4>
        </div>
        <form id="editPpjab" @submit.prevent="editPpjab">
            <form-ppjab  :formPpjab="formPpjab" :errors="errors" :btn="'Simpan PPJAB'" />
        </form>
    </div>
</template>

<script>
import axios from 'axios';
import FormPpjab from './FormPpjab';
export default {
    components: {
        FormPpjab
    },
    data() {
        return {
            formPpjab: {
                name: '',
                provinsi_id: '',
                kab_kota_id: '',
                kecamatan: '',
                keterangan: '',
            },
            errors: [],
            ppjabID: this.$route.params.ppjabID
        }
    },
    mounted() {
        this.getPpjab()
    },
    methods: {
        async getPpjab() {
            await axios.get(`ppjab/get/${this.ppjabID}`)
            .then((response) => {
                this.formPpjab = response.data.data
                this.formPpjab.provinsi_id = this.formPpjab.provinsi.id
                this.formPpjab.kab_kota_id = this.formPpjab.kab_kota.id
            })
        },

        editPpjab() {
            axios.patch(`ppjab/update/${this.ppjabID}`, this.formPpjab)
            .then(() => {
                this.$toasted.show('berhasil update ppjab', {
                    type: 'success',
                    duration: 3000
                })
                this.$router.push({ name: 'ppjab' })
            }).catch((error) => {
                this.errors = error.response.data
            })
        }
    }
}
</script>

<style>

</style>