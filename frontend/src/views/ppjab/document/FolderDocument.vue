<template>
    <div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th class="text-truncate">Group</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="folder in folders" :key="folder.id">
                    <td>
                        <router-link :to="{ name:'ppjab.document', params: { ppjabID: ppjabID, groupID: folder.id } }">
                            <i class="mdi mdi-folder"></i><span>{{ folder.group }}</span>
                        </router-link>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import axios from 'axios'
export default {
    data() {
        return {
            folders: [],
            ppjabID: this.$route.params.ppjabID
        }
    },
    mounted() {
        this.getFolder()
    }, 
    methods: {
        getFolder() {
            axios.get('ppjab/document_ppjab/list_group')
            .then((response) => {
                this.folders = response.data.data
            })
        }
    }
}
</script>

<style>

</style>