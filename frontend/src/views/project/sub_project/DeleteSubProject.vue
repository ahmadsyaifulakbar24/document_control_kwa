<template>
    <div>
        <div ref="deleteSubProject" id="delete-sub-project" class="text-danger" @click="modalDelete = true">
            <i class="mdi mdi-delete"><span>delete</span></i>
        </div>
        <modal v-if="modalDelete" @close="modalDelete = false">
            <div class="text-center">
                <div class="mb-2">
                    Apa anda yakin ingin menghapusnya ?
                </div>
                <button class="btn btn-sm btn-danger mr-2" style="width:70px" @click="deleteSubProject">Ya</button>
                <button class="btn btn-sm btn-primary" style="width:70px" @click="modalDelete = false" >Batal</button>
            </div>
        </modal>
    </div>
</template>

<script>
import Modal from "@/components/Modal.vue";
import axios from "axios";
export default {
    props: ['projectID', 'subProjectID'],
    components: {
        Modal
    },
    data() {
        return {
            modalDelete: false
        }
    },
    methods: {
        deleteSubProject() {
            axios.delete(`document_flow/sub_project/delete/${this.subProjectID}`)
            .then(() => {
                this.$toasted.show('berhasil delete data', {
                    type: 'success',
                    duration: 3000
                })
                this.$refs.deleteSubProject.parentNode.parentNode.parentNode.parentNode.remove()
                this.modalDelete = false
            }).catch((error) => {
                console.log(error)
            })
        }
    }
}
</script>

<style>
    #delete-sub-project {
        cursor: pointer;
    }
</style>