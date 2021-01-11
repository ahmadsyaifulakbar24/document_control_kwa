<template>
    <div>
        <div ref="deleteKontrak" id="delete-kontrak" class="text-danger mr-1" @click="modalDelete = true">
            <i class="mdi mdi-delete pr-0"></i><span>Delete</span>
        </div>
        
        <modal v-if="modalDelete" @close="modalDelete = false">
            <div class="text-center">
                <div class="mb-2">
                    Apa anda yakin ingin menghapusnya ?
                </div>
                <button class="btn btn-sm btn-danger mr-2" style="width:70px" @click="deleteKontrak">Ya</button>
                <button class="btn btn-sm btn-primary" style="width:70px" @click="modalDelete = false" >Batal</button>
            </div>
        </modal>
    </div>
</template>

<script>
import axios from "axios";
import Modal from "@/components/Modal";
export default {
    props: ['kontrakID'],
    components: {
        Modal
    },
    data() {
        return {
            modalDelete: ''
        }
    },
    methods: {
        async deleteKontrak() {
            await axios.delete(`kontrak/delete/${this.kontrakID}`)
            .then(() => {
                this.$toasted.show('berahasil delete data', {
                    type: 'success',
                    duration: 3000
                })
                this.$refs.deleteKontrak.parentNode.parentNode.parentNode.parentNode.remove()
                this.modalDelete = false
            }).catch((error) => {
                let message = error.response.data.message
                this.$toasted.show(message, {
                    type: 'error',
                    duration: 5000
                })
                this.modalDelete = false
            })
        }
    }
}
</script>

<style>
    #delete-kontrak {
        cursor: pointer;
    }
</style>