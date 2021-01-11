<template>
    <div>
        <div class="mb-3" v-if="user.user_level_id == 102">
            <router-link :to="{ name: 'amandemen.create', params: { kontrakID: kontrakID} }">
                <button class="btn btn-primary">Upload Amandemen</button>
            </router-link>
        </div>
        <div v-if="loading" class="d-flex justify-content-center">
            Loading...
        </div>
        <table class="table table-hover">
            <thead v-if="!loading">
                <tr>
                    <th class="text-truncate">Nama</th>
                    <th class="text-truncate">Keterangan</th>
                    <th class="text-truncate">File</th>
                    <th class="text-truncate">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="amandemen in amandemens" :key="amandemen.id">
                    <td class="text-truncate">{{ amandemen.name }}</td>
                    <td class="text-truncate">{{ amandemen.keterangan }}</td>
                    <td class="text-truncate">{{ fileName(amandemen.file) }}</td>
                    <td class="text-truncate">
                        <div class="d-flex">
                            <router-link :to="{ name: 'amandemen.update', params:{ kontrakID: kontrakID, amandemenID: amandemen.id } }" v-if="user.user_level_id == 102">
                                <i class="mdi mdi-pencil pr-0"></i><span class="mr-1">Edit</span>
                            </router-link>
                            <delete-amandemen :amandemenID="amandemen.id" v-if="user.user_level_id == 102" />
                            <div class="text-info">
                                <a target="_blank" :href="amandemen.file" :download="amandemen.name">
                                    <i class="mdi mdi-download pr-0"></i><span>Download</span>
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
import axios from "axios";
import { mapGetters } from "vuex";
import DeleteAmandemen from './DeleteAmandemen';
export default {
    components: {
        DeleteAmandemen
    },
    data() {
        return {
            kontrakID: this.$route.params.kontrakID,
            amandemens: [],
            loading: false
        }
    },
    computed: {
        ...mapGetters({
            user: 'auth/user'
        })
    },
    mounted() {
        this.getAmandems()
    },
    methods: {
        async getAmandems() {
            this.loading = true
            await axios.get(`kontrak/amandemen/get/${this.kontrakID}`)
            .then((response) => {
                this.amandemens = response.data.data
                this.loading = false
            }).catch(() => {
                this.loading = true
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