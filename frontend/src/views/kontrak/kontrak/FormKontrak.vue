<template>
    <div>
        <div class="form-group row">
            <label class="col-lg-3" for="name">Nama File</label>
            <div class="col-lg-5 col-xl-5">
                <input type="text" v-model="form.name" class="form-control" id="name" placeholder="Nama File"/>
                <div v-if="errors.name" class="mt-2 text-danger">{{ errors.name[0] }}</div>
            </div>
        </div>
        <div class="form-group row">
            <label for="keterangan" class="col-lg-3">Keterangan</label>
            <div class="col-lg-5 col-xl-5">
                <textarea v-model="form.keterangan" class="form-control" id="keterangan" rows="3" placeholder="Keterangan"></textarea>
                <div v-if="errors.keterangan" class="mt-2 text-danger">{{ errors.keterangan[0] }}</div>
            </div>
        </div>

        <div class="input-group mb-3 row">
            <label for="uploadAmandemen" class="col-lg-3">Upload Dokumen Induk</label>
            <div class="col-lg-5 col-xl-5 ml-2">
                <div class="custom-file" id="uploadAmandemen">
                    <input type="file" class="custom-file-input" id="uploadAmandemen" ref="uploadAmandemen" @change="handleFileUpload">
                    <label class="custom-file-label" for="uploadAmandemen">{{ form.amandemen.name }}</label>
                </div>
                <div v-if="errors.amandemen" class="text-danger">{{ errors.amandemen[0] }}</div>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-lg-3"></div>
            <div class="col-lg-5 col-xs-5"> 
                <button type="submit" class="btn btn-primary btn-block">{{ btn }}</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['form', 'errors', 'btn', ],
    methods: {
        handleFileUpload() {
            this.form.amandemen = this.$refs.uploadAmandemen.files[0]
        },
    }
}
</script>

<style>

</style>