<template>

    <div class="container mt-4">

        <div class="m-2">
            <button class="btn btn-primary"><router-link class="nav-link" to="/search">Go To Search Page</router-link></button>
        </div>
        <div class="row">
            <div class="col-md-6">
                <img :src="'/images/' +book.image" alt="" width="400" height="400">
            </div>
            <div class="col-md-6 p-4">
                 <p><b>Title</b>: {{ book.title }}</p>
                 <p><b>Author</b>: {{ book.author }}</p>
                 <p><b>Genre</b>: {{ book.genre }}</p>
                 <p><b>Description</b>: {{ book.description }}</p>
                 <p><b>ISBN</b>: {{ book.isbn }}</p>
                 <p><b>published</b>: {{ book.published }}</p>
                 <p><b>publisher</b>: {{ book.publisher }}</p>
            </div>
        </div>
    </div>
</template>


<script>
import axios from 'axios';
export default {
    data() {
        return {
            book: {},
        }
    },

    created() {
        this.getBookById();
    },

    methods: {
        async getBookById() {
            let url = `http://127.0.0.1:8000/api/admin/book/show/${this.$route.params.id}`;
            await axios.get(url).then(res => {
                this.book = res.data.book;
                console.log(this.book);
            });
        },
    }
}

</script>