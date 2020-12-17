<template>
    <div>
        <div ref="deletePpjab" id="delete-ppjab" class="text-danger" @click="modalDelete = true">
            <i class="mdi mdi-delete"><span>delete</span></i>
        </div>
        
        <modal v-if="modalDelete" @close="modalDelete = false">
            <div class="text-center">
                <div class="mb-2">
                    Apa anda yakin ingin menghapusnya ?
                </div>
                <button class="btn btn-sm btn-danger mr-2" style="width:70px" @click="deletePpjab">Ya</button>
                <button class="btn btn-sm btn-primary" style="width:70px" @click="modalDelete = false" >Batal</button>
            </div>
        </modal>
    </div>
</template>

<script>
import axios from "axios";
import Modal from "@/components/Modal.vue";
export default {
    props:['ppjabID'],
    components: {
        Modal
    },
    data() {
        return {
            modalDelete: ''
        }
    },
    methods: {
        deletePpjab() {
            axios.delete(`ppjab/delete/${this.ppjabID}`)
            .then(() => {
                this.$toasted.show('berhasil delete ppjab', {
                    type: 'success',
                    duration: 3000
                })
                this.$refs.deletePpjab.parentNode.parentNode.parentNode.parentNode.remove()
                this.modalDelete = false
            }).catch((error) => {
                let message = error.response.data.message
                this.$toasted.show(message, {
                    type: 'error',
                    duration: 5000
                })
            })
        }
    }
}
</script>

<style>
    #delete-ppjab {
        cursor: pointer;
    }
</style>