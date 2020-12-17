<template>
    <div>
        <div class="mb-3">
            <router-link :to="{ name: 'ppjab.create' }">
                <button class="btn btn-primary"> Tambah PPJAB </button>
            </router-link>
        </div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th class="text-truncate">Nama PPJAB</th>
                    <th class="text-truncate">Keterangan</th>
                    <th class="text-truncate">Tanggal di buat</th>
                    <th class="text-truncate">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="ppjab in ppjabs" :key="ppjab.id">
                    <th class="text-truncate">
                        <router-link :to="{ name: 'ppjab.folderDocument', params: { ppjabID:ppjab.id }}">
                            {{ ppjab.name }}
                        </router-link>
                    </th>
                    <th class="text-truncate">{{ ppjab.keterangan }}</th>
                    <th class="text-truncate">{{ ppjab.created_at }}</th>
                    <th class="text-truncate">
                        <div class="d-flex">
                            <div class="text-info">
                                <router-link :to="{ name: 'ppjab.edit', params: { ppjabID: ppjab.id } }">
                                    <i class="mdi mdi-pencil"><span>Edit</span></i>
                                </router-link>
                            </div>
                            <delete-ppjab :ppjabID="ppjab.id" />
                        </div>
                    </th>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import axios from "axios";
import DeletePpjab from "./DeletePpjab.vue";
export default {
    components: {
        DeletePpjab
    },
    data() {
        return {
            ppjabs: []
        }
    },
    mounted() {
        this.getPpjab()
    }, 
    methods: {
        async getPpjab() {
            await axios.get('ppjab/get')
            .then((response) => {
                this.ppjabs = response.data.data
            })
        }
    }
}
</script>

<style>

</style>