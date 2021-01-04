<template>
    <div>
        <template v-if="user.user_level_id == 100" class="mb-3">
            <router-link :to="{ name: 'ppjab.create' }">
                <button class="btn btn-primary"> Tambah PPJAB </button>
            </router-link>
        </template>
        <div v-if="pagination.last_page > 1" class="float-right row mb-3">
            <div class="mr-3"> Data ke {{ ppjabs.meta.from }} - {{ ppjabs.meta.to }} dari {{ ppjabs.meta.total }} data </div>
            <Pagination :last_page="pagination.last_page" :pagination="pagination" @paginate="getPpjab()"/>
        </div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th class="text-truncate">Nama PPJAB</th>
                    <th class="text-truncate">Keterangan</th>
                    <th class="text-truncate">Tanggal di buat</th>
                    <th v-if="user.user_level_id == 100" class="text-truncate">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="ppjab in ppjabs.data" :key="ppjab.id">
                    <th class="text-truncate">
                        <router-link :to="{ name: 'ppjab.folderDocument', params: { ppjabID:ppjab.id }}">
                            {{ ppjab.name }}
                        </router-link>
                    </th>
                    <th class="text-truncate">{{ ppjab.keterangan }}</th>
                    <th class="text-truncate">{{ ppjab.created_at }}</th>
                    <th v-if="user.user_level_id == 100" class="text-truncate">
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
import { mapGetters } from "vuex";
import DeletePpjab from "./DeletePpjab.vue";
import Pagination from '@/components/Pagination.vue'
export default {
    components: {
        DeletePpjab,
        Pagination
    },
    data() {
        return {
            ppjabs: {
                data: [],
                meta: {},
            },
            pagination: {
                last_page: '',
                current_page: 1
            }
        }
    },
    computed: {
        ...mapGetters({
            user: 'auth/user'
        })
    },
    mounted() {
        this.getPpjab()
    }, 
    methods: {
        async getPpjab() {
            await axios.get(`ppjab/get?page=${this.pagination.current_page}`)
            .then((response) => {
                this.ppjabs.data = response.data.data
                this.ppjabs.meta = response.data.meta
                this.pagination.last_page = response.data.meta.last_page
            })
        }
    }
}
</script>

<style>

</style>