<template>
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item" :class="{'disabled':meta.current_page===1}">
                <a class="page-link" href="#" aria-label="Previous" @click.prevent="changePage(meta.current_page-1)">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <li class="page-item" :class="{'actice':meta.current_page===p}" v-for="p in meta.last_page">
                    <a class="page-link" href="#" @click.prevent="changePage(p)">{{p}}</a>
            </li>
            <li class="page-item" :class="{'disabled':meta.current_page===meta.last_page}">
                <a class="page-link" href="#" aria-label="Next" @click.prevent="changePage(meta.current_page+1)">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
</template>

<script>
export default {
    props: ['meta'],
    data(){
        return {

        }
    },
    methods: {
        changePage(page){
            this.$emit('pagination',page)
        }
    },

}
</script>
