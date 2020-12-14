<template>
    <div>
        <div ref="deleteProject" id="delete-project" class="text-danger" @click="modalDelete = true">
            <i class="mdi mdi-delete"><span>delete</span></i>
        </div>
        <modal v-if="modalDelete" @close="modalDelete = false">
            <div class="text-center">
                <div class="mb-2">
                    Apa anda yakin ingin menghapusnya ?
                </div>
                <button class="btn btn-sm btn-danger mr-2" style="width:70px" @click="deleteProject">Ya</button>
                <button class="btn btn-sm btn-primary" style="width:70px" @click="modalDelete = false" >Batal</button>
            </div>
        </modal>
    </div>
</template>

<script>
import Modal from "@/components/Modal.vue";
import axios from 'axios';
export default {
    props: ['projectID'],
    components: {
        Modal
    },
    data() {
        return {
            modalDelete: ''
        }
    },
    methods: {
        async deleteProject() {
            await axios.delete(`document_flow/project/delete/${this.projectID}`)
            .then((response) => {
                console.log(response);
                this.$toasted.show('berhasil delete project', {
                    type: 'success',
                    duration: 3000
                })
                this.$refs.deleteProject.parentNode.parentNode.parentNode.parentNode.remove()
                this.modalDelete = false
            }).catch((error) => {
                console.log(error.response.data)
                this.$toasted.show('error delete project', {
                    type: 'danger',
                    duration: 3000
                })
            })
        }
    }
}
</script>

<style>
    #delete-project {
        cursor: pointer;
    }
</style>