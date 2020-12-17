<template>
    <div>
        <div class="form-group row">
            <label class="col-lg-3" for="name">Nama Ppjab</label>
            <div class="col-lg-5 col-xl-5">
                <input type="text" v-model="formPpjab.name" class="form-control" id="name" placeholder="Nama Ppjab"/>
                <div v-if="errors.name" class="mt-2 text-danger">{{ errors.name[0] }}</div>
            </div>
        </div>

        <div class="form-group row">
            <label for="keterangan" class="col-lg-3">Keterangan Ppjab</label>
            <div class="col-lg-5 col-xl-5">
                <textarea v-model="formPpjab.keterangan" class="form-control" id="keterangan" rows="3" placeholder="Keterangan Ppjab"></textarea>
                <div v-if="errors.keterangan" class="mt-2 text-danger">{{ errors.keterangan[0] }}</div>
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
    props:['formPpjab', 'errors', 'btn']
}
</script>

<style>

</style>