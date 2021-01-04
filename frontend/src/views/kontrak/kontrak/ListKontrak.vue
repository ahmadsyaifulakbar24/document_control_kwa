<template>
    <div>
        <template class="mb-3" v-if="user.user_level_id == 102">
            <router-link :to="{ name: 'kontrak.create' }">
                <button class="btn btn-primary"> Tambah Kontrak </button>
            </router-link>
        </template>
        <div v-if="pagination.last_page > 1" class="float-right row mb-3">
            <div class="mr-3"> Data ke {{ kontraks.meta.from }} - {{ kontraks.meta.to }} dari {{ kontraks.meta.total }} data </div>
            <Pagination :last_page="pagination.last_page" :pagination="pagination" @paginate="getKontraks()"/>
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
                <tr v-for="kontrak in kontraks.data" :key="kontrak.id">
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
                            <router-link :to="{ name: 'kontrak.update', params:{ kontrakID:kontrak.id }}" v-if="user.user_level_id == 102">
                                <i class="mdi mdi-pencil"><span>Edit</span></i>
                            </router-link>
                            <delete-kontrak :kontrakID="kontrak.id" v-if="user.user_level_id == 102"/>
                            <div class="text-info" v-if="kontrak.amandemen">
                                <a target="_blank" :href="kontrak.amandemen" :download="kontrak.name">
                                    <i class="mdi mdi-download"><span>Download</span></i>
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import axios from "axios"
import { mapGetters } from "vuex";
import DeleteKontrak from "./DeleteKontrak"
import Pagination from '@/components/Pagination.vue'
export default {
    components: {
        DeleteKontrak,
        Pagination
    },
    data() {
        return {
            kontraks: {
                data: [],
                meta: {}
            },
            pagination: {
                last_page: '',
                current_page: 1
            }
        }
    },
    computed: {
        ...mapGetters({
            user:'auth/user'
        })
    },
    mounted() {
        this.getKontraks()
    },
    methods: {
        async getKontraks() {
            await axios.get(`kontrak/get?page=${this.pagination.current_page}`)
            .then((response) => {
                this.kontraks.data = response.data.data
                this.kontraks.meta = response.data.meta
                this.pagination.last_page = response.data.meta.last_page
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