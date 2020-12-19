<template>
    <div>
        <div class="mb-5">
            <h4>Buat PPJAB</h4>
        </div>
        <form id="createPpjab" @submit.prevent="createPpjab">
            <form-ppjab  :formPpjab="formPpjab" :errors="errors" :btn="'Buat PPJAB'"/>
        </form>
    </div>
</template>

<script>
import FormPpjab from './FormPpjab.vue';
import axios from 'axios';
export default {
    components: {
        FormPpjab
    },
    data() {
        return {
            formPpjab: {},
            errors: []
        }
    },
    methods: {
        createPpjab() {
            axios.post('ppjab/create', this.formPpjab)
            .then(() => {
                this.$toasted.show('berhasil buat ppjab', {
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