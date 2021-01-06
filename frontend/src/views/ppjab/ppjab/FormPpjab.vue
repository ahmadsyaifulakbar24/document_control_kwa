<template>
    <div>
        <div class="form-group row">
            <label class="col-lg-3" for="name">Nama Site/Project</label>
            <div class="col-lg-5 col-xl-5">
                <input type="text" v-model="formPpjab.name" class="form-control" id="name" placeholder="Nama Site/Project"/>
                <div v-if="errors.name" class="mt-2 text-danger">{{ errors.name[0] }}</div>
            </div>
        </div>
        <div class="form-group row">
            <label for="provinsi_id" class="col-lg-3">Provinsi</label>
            <div class="col-lg-5 col-xl-5">
                <select v-model="formPpjab.provinsi_id" id="provinsi_id" class="form-control" @change="handleProvinsiChange()">
                    <option value="" disabled>Pilih Provinsi</option>
                    <option v-for="provinsi in provinsis" :key="provinsi.id" :value="provinsi.id">
                        {{ provinsi.provinsi }}
                    </option>
                </select>
                <div v-if="errors.provinsi_id" class="mt-2 text-danger">{{ errors.provinsi_id[0] }}</div>
            </div>
        </div>
        <div v-if="kabKotas.length != 0 || formPpjab.kab_kota_id != 0" class="form-group row">
            <label for="kab_kota_id" class="col-lg-3">Kabupatan/Kota</label>
            <div class="col-lg-5 col-xl-5">
                <select v-model="formPpjab.kab_kota_id" id="provinsi_id" class="form-control">
                    <option v-for="kabKota in kabKotas" :key="kabKota.id" :value="kabKota.id">
                        {{ kabKota.kab_kota }}
                    </option>
                </select>
                <div v-if="errors.kab_kota_id" class="mt-2 text-danger">{{ errors.kab_kota_id[0] }}</div>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-3" for="name">Kecamatan</label>
            <div class="col-lg-5 col-xl-5">
                <input type="text" v-model="formPpjab.kecamatan" class="form-control" id="kecamatan" placeholder="Kecamatan"/>
                <div v-if="errors.kecamatan" class="mt-2 text-danger">{{ errors.kecamatan[0] }}</div>
            </div>
        </div>

        <div class="form-group row">
            <label for="keterangan" class="col-lg-3">Keterangan PPJAB</label>
            <div class="col-lg-5 col-xl-5">
                <textarea v-model="formPpjab.keterangan" class="form-control" id="keterangan" rows="3" placeholder="Keterangan PPJAB"></textarea>
                <div v-if="errors.keterangan" class="mt-2 text-danger">{{ errors.keterangan[0] }}</div>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-lg-3"></div>
            <div class="col-lg-5 col-xs-5"> 
                <button type="submit" class="btn btn-primary btn-block">{{ btn }}</button>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
export default {
    props:['formPpjab', 'errors', 'btn'],
    data() {
        return {
            provinsis: [],
            kabKotas: [],
        }
    },
    mounted() {
        this.getProvinsi()
    },
    watch: {
        formPpjab() {
            this.getKabKota(this.formPpjab.provinsi_id)
        }
    },
    methods: {
        async handleProvinsiChange() {
            await axios.get(`kab_kota/get/${this.formPpjab.provinsi_id}`)
            .then((response) => {
                this.kabKotas = response.data.data
                this.formPpjab.kab_kota_id = this.kabKotas[0].id
            })
        },

        async getProvinsi() {
            await axios.get('provinsi/get').
            then((response) => {
                this.provinsis = response.data.data
            })
        },

        async getKabKota(provinsi_id) {
            await axios.get(`kab_kota/get/${provinsi_id}`)
            .then((response) => {
                this.kabKotas = response.data.data
            })
        }
    }
}
</script>

<style>

</style>