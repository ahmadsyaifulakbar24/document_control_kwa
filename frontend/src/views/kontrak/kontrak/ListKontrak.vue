<template>
    <div>
        <div class="mb-3">
            <router-link :to="{ name: 'kontrak.create' }">
                <button class="btn btn-primary"> Tambah Kontrak </button>
            </router-link>
        </div>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th class="text-truncate">Nama</th>
                    <th class="text-truncate">Keterangan</th>
                    <th class="text-truncate">Amandemen</th>
                    <th class="text-truncate">Tanggal dibuat</th>
                    <th class="text-truncate">Actions</th>
                </tr>
            </thead>

            <tbody>
                <tr v-for="kontrak in kontraks" :key="kontrak.id">
                    <td class="text-truncate">
                        <router-link :to="{ name: 'amandemen', params: { kontrakID: kontrak.id }}">
                            {{ kontrak.name }}
                        </router-link>
                    </td>
                    <td class="text-truncate">{{ kontrak.keterangan }}</td>
                    <td class="text-truncate">
                        <template v-if="kontrak.amandemen !== null && kontrak.amandemen !== '' ">{{ fileName(kontrak.amandemen) }}</template>
                        <template v-else>Belum ada amandemen</template>
                    </td>
                    <td class="text-truncate">{{ kontrak.created_at }}</td>
                    <td class="text-truncate">
                        <div class="d-flex">
                            <router-link :to="{ name: 'kontrak.update', params:{ kontrakID:kontrak.id }}">
                                <i class="mdi mdi-pencil"><span>Edit</span></i>
                            </router-link>
                            <delete-kontrak :kontrakID="kontrak.id"/>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import axios from "axios"
import DeleteKontrak from "./DeleteKontrak";
export default {
    components: {
        DeleteKontrak
    },
    data() {
        return {
            kontraks: []
        }
    },
    mounted() {
        this.getKontraks()
    },
    methods: {
        async getKontraks() {
            await axios.get('kontrak/get')
            .then((response) => {
                this.kontraks = response.data.data
            })
        },
        fileName(fileURL) {
            let newFileName = fileURL.substring(fileURL.lastIndexOf('/')+1)
            return newFileName
        }
    }
} 
</script>

<style>

</style>