<template>
    <div>
        <div ref="deleteAmandemen" id="delete-amandemen" class="text-danger mr-1" @click="modalDelete = true">
            <i class="mdi mdi-delete pr-0"></i><span>Delete</span>
        </div>
        
        <modal v-if="modalDelete" @close="modalDelete = false">
            <div class="text-center">
                <div class="mb-2">
                    Apa anda yakin ingin menghapusnya ?
                </div>
                <button class="btn btn-sm btn-danger mr-2" style="width:70px" @click="deleteAmandemen">Ya</button>
                <button class="btn btn-sm btn-primary" style="width:70px" @click="modalDelete = false" >Batal</button>
            </div>
        </modal>
    </div>
</template>

<script>
import axios from 'axios';
import Modal from '@/components/Modal';
export default {
    props: ['amandemenID'],
    components: {
        Modal
    },
    data() {
        return {
            modalDelete: false
        }
    }, 
    methods: {
        deleteAmandemen() {
            axios.delete(`kontrak/amandemen/delete/${this.amandemenID}`)
            .then(() => {
                this.$toasted.show('berhasil hapus data', {
                    type: 'success',
                    duration: 3000
                })
                this.$refs.deleteAmandemen.parentNode.parentNode.parentNode.parentNode.remove()
                this.modalDelete = false
            })
        }
    }
}
</script>

<style>
    #delete-amandemen {
        cursor: pointer;
    }
</style>