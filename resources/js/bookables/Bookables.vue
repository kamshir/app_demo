<template>
    <div>
        <div v-if="loading">Data is loading...</div>
        <div v-else>
            <div class="d-flex justify-content-between">
                <h1 class="h1">{{ this.title }}</h1>
                <div class="buttons">
                    <button class="btn btn-secondary" @click.prevent="prevPage" :disabled="pageNumber == 0">
                        <i class="fas fa-angle-left"></i>
                    </button>
                    <button class="btn btn-secondary" @click.prevent="nextPage" :disabled="pageNumber >= pageCount-1">
                        <i class="fas fa-angle-right"></i>
                    </button>    
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-4" v-for="(bookable, index) in paginatedData" :key="'bookable_' + index">
                    <bookable-list-item v-bind="bookable"></bookable-list-item>
                </div>    
            </div>
            <!-- <div class="row mb-4" v-for="row in rows" :key="'row' + row">
                <div
                    class="col d-flex align-items-stretch"
                    v-for="(bookable, column) in bookablesInRow(row)"
                    :key="'row' + row + column"
                >
                    <bookable-list-item v-bind="bookable"></bookable-list-item>
                </div>
                <div
                    class="col"
                    v-for="p in placeholdersInRow(row)"
                    :key="'placeholder' + row + p"
                ></div>
            </div> -->
        </div>
    </div>
</template>

<script>
import BookableListItem from "./BookableListItem";

export default {
    components: {
        BookableListItem,
    },
    data() {
        return {
            bookables: null,
            loading: false,
            // columns: 3,
            title: "All bookables",
            pageNumber: 0
        };
    },
    computed: {
        // rows() {
        //     return this.bookables === null
        //         ? 0
        //         : Math.ceil(this.bookables.length / this.columns);
        // },
        pageCount(){
            let l = this.bookables.length,
                s = this.size;
            // редакция переводчика спасибо комментаторам
            return Math.ceil(l/s);
            // оригинал
            // return Math.floor(l/s);
        },
        paginatedData(){
            const start = this.pageNumber * this.size,
                end = start + this.size;
            return this.bookables.slice(start, end);
        }
    },
    methods: {
        // bookablesInRow(row) {
        //     return this.bookables.slice(
        //         (row - 1) * this.columns,
        //         row * this.columns
        //     );
        // },
        // placeholdersInRow(row) {
        //     return this.columns - this.bookablesInRow(row).length;
        // },
        nextPage(){
            this.pageNumber++;
        },
        prevPage(){
            this.pageNumber--;
        }
    },
    created() {
        this.loading = true;

        const request = axios.get("/api/bookables/").then((response) => {
            this.bookables = response.data.data;
            this.loading = false;
        });
    },
    props: {
        size:{
            type:Number,
            required:false,
            default: 15
        }
    }
};
</script>
