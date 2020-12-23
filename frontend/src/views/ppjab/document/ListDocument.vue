<template>
    <div>
        <template v-if="subFolders.length">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="text-truncate">Group</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="subFolder in subFolders" :key="subFolder.id">
                        <td>
                            <router-link :to="{ name:'ppjab.document', params: { ppjabID: ppjabID, groupID: subFolder.id } }">
                                <i class="mdi mdi-folder"></i><span>{{ subFolder.group }}</span>
                            </router-link>
                        </td>
                    </tr>
                </tbody>
            </table>
        </template>
            <template v-else>
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
                                <div class="text-info">
                                    <a target="_blank" :href="document.file" :download="document.name">
                                        <i class="mdi mdi-download"> <span>Download File</span> </i>
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </template>
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
            subFolders: [],
            ppjabID: this.$route.params.ppjabID,
            groupID: '',
        }
    },
    mounted() {
        this.getDocument(this.$route.params.groupID)
        this.getSubFolder(this.$route.params.groupID)
    },
    beforeRouteUpdate (to, from, next) {
        this.getSubFolder(to.params.groupID);
        this.getDocument(to.params.groupID);
        next();
    },
    methods: {
        async getSubFolder(groupID) {
            this.groupID = groupID
            await axios.get(`ppjab/document_ppjab/list_sub_group/${this.groupID}`)
            .then((response) => {
                this.subFolders = response.data.data
            })
        },
        async getDocument(groupID) {
            await axios.get(`ppjab/document_ppjab/get_by_group/${this.ppjabID}/${groupID}`)
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