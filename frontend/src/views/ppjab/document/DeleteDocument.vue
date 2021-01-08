<template>
    <div>
        <div ref="deleteDocumentPpjab" id="delete-document-ppjab" class="text-danger" @click="modalDelete = true">
            <i class="mdi mdi-delete pr-0"></i><span>delete</span>
        </div>
        
        <modal v-if="modalDelete" @close="modalDelete = false">
            <div class="text-center">
                <div class="mb-2">
                    Apa anda yakin ingin menghapusnya ?
                </div>
                <button class="btn btn-sm btn-danger mr-2" style="width:70px" @click="deleteDocumentPpjab">Ya</button>
                <button class="btn btn-sm btn-primary" style="width:70px" @click="modalDelete = false" >Batal</button>
            </div>
        </modal>
    </div>
</template>

<script>
import axios from "axios";
import Modal from "@/components/Modal.vue";
export default {
    props: ['documentID'],
    components: {
        Modal
    },
    data() {
        return {
            modalDelete: ''
        }
    }, 
    methods: {
        deleteDocumentPpjab() {
            axios.delete(`ppjab/document_ppjab/delete/${this.documentID}`)
            .then(() => {
                this.$toasted.show('berhasil hapus data', {
                    type: 'success',
                    duration: 3000
                })
                this.$refs.deleteDocumentPpjab.parentNode.parentNode.parentNode.parentNode.remove()
                this.modalDelete = false
            }).catch((error) => {
                console.log(error.response.data)
            })
        }
    }
}
</script>

<style>
    #delete-document-ppjab {
        cursor: pointer;
    }
</style>