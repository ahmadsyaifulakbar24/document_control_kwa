<template> 
    <div>
        <div class="d-flex">
            <button v-if="numberPage != 1" class="btn btn-light btn-sm mr-1" @click="nextPrevPage(numberPage - 1)">
                <i class="mdi mdi-menu-left"></i>
            </button> 
            
            <select v-model="numberPage" class="form-control mr-1" @change="changePage()">
                <option v-for="(page, index) in pages" :key="index" :value="page">{{ page }}</option>
            </select>
            <button v-if="numberPage != last_page" class="btn btn-light btn-sm" @click="nextPrevPage(numberPage + 1)">
                <i class="mdi mdi-menu-right"></i>
            </button>
        </div>
    </div>
</template>

<script>
export default {
    props: ['last_page', 'pagination'],
    data() {
        return {
            numberPage: 1,
        }
    },
    methods: {
        nextPrevPage(page) {
            this.pagination.current_page = page
            this.numberPage = page
            this.$emit('paginate')
        },
        changePage() {
            this.pagination.current_page = this.numberPage
            this.$emit('paginate')
        }
    },
    computed: {
        pages() {
            let pages = []
            let from = 1
            let to = this.last_page
            while ( from <= to ) {
                pages.push(from)
                from++
            }

            return pages
        }
    }
    
}
</script>