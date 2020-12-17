<template>
    <div>
        <div class="mb-3">
            <router-link :to="{ name: 'ppjab.uploadDocument', params: { ppjabID: ppjabID, groupID: groupID} }">
                <button class="btn btn-primary">Upload Document</button>
            </router-link>
        </div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th class="text-truncate">Document Name</th>
                    <th class="text-truncate">Keterangan</th>
                    <th class="text-truncate">File</th>
                    <th class="text-truncate">Tanggal dibuat</th>
                    <th class="text-truncate">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="document in documents" :key="document.id">
                    <td class="text-truncate">{{ document.name }}</td>
                    <td class="text-truncate">{{ document.keterangan }}</td>
                    <td class="text-truncate">{{ fileName(document.file) }}</td>
                    <td class="text-truncate">{{ document.created_at }}</td>
                    <td class="text-truncate">
                        <div class="d-flex">
                            <delete-document :documentID="document.id" />
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import axios from 'axios'
import DeleteDocument from './DeleteDocument.vue'
export default {
	components: { 
        DeleteDocument 
    },
    data() {
        return {
            documents: [],
            ppjabID: this.$route.params.ppjabID,
            groupID: this.$route.params.groupID,
        }
    },
    mounted() {
        this.getDocument()
    },

    methods: {
        async getDocument() {
            await axios.get(`ppjab/document_ppjab/get_by_group/${this.ppjabID}/${this.groupID}`)
            .then((response) => {
                this.documents = response.data.data
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