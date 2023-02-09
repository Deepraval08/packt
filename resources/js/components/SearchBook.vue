<template>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="alert alert-danger mt-4 errorclass" v-if="errors.length">
                    <ul class="mb-0">
                        <li v-for="(error, index) in errors" :key="index">
                            {{ error }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <form @submit.prevent="searchbook">
            <fieldset>
                <div class="row mt-3">
                    <div class="form-group col-md-8">
                        <input type="text" class="form-control" v-model="search" placeholder="Enter value for search"
                            name="search">

                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </div>
            </fieldset>

        </form>

        <table class="table table-hover mt-4" v-if=books.data.length>
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Title</th>
                    <th scope="col">Author</th>
                    <th scope="col">Genre</th>
                    <th scope="col">DESIGNATION</th>
                    <th scope="col">ISBN</th>
                    <th scope="col">Published Date</th>
                    <th scope="col">publisher</th>
                    <th scope="col">Image</th>
                </tr>
            </thead>

            <tbody v-for="book in books.data" :key="book.id">
                <tr class="table-secondary">
                    <td scope="row">{{ book.id }}</td>
                    <td scope="row"><router-link
                            :to="{ name: 'ShowBook', params: { id: book.id } }">{{ book.title }}</router-link></td>
                    <td scope="row">{{ book.author }}</td>
                    <td scope="row">{{ book.genre }}</td>
                    <td scope="row">{{ book.description }}</td>
                    <td scope="row">{{ book.isbn }}</td>
                    <td scope="row">{{ book.published }}</td>
                    <td scope="row">{{ book.publisher }}</td>
                    <td scope="row"><img :src="'/images/' + book.image" alt="" height="50" width="50"></td>

                </tr>
            </tbody>

        </table>

        <div>
                <Bootstrap4Pagination
                :data="books"
                @pagination-change-page="searchbook"
                />
        </div>

    </div>
</template>


<script>
import axios from 'axios';
import { Bootstrap4Pagination } from 'laravel-vue-pagination';
export default {
    components: {
        Bootstrap4Pagination
    },
    data() {
        return {
            search: '',
            errors: [],
            books: {
                data:[],
            },
        }
    },

    methods: {
        async searchbook(page=1) {
            let formData = new FormData();
            formData.append('search', this.search);
            let url = "http://127.0.0.1:8000/api/search?page=" + page ;
            await axios.post(url, formData).then(res => {
                console.log(res.data.result);
                this.errors.splice(0, this.errors.length);
                if (res.status == 200) {
                    // this.search = ""
                    this.books = res.data.result;
                }
                else{
                    alert(res.data.message);
                }
            }).catch(error => {
                console.log(error);
                this.errors.splice(0, this.errors.length);
                let values = error.response.data.errors;
                Object.values(values).forEach(val => {
                    this.errors.push(val[0])
                });
            });
        }
    }
}
</script>
