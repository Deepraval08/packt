<template>
    <div class="container">
        <table class="table table-hover">
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
                  <th scope="col">Edit</th>
                  <th scope="col">Delete</th>
                  
              </tr>
          </thead>

          <tbody v-for="book in books.data" :key="book.id">
              <tr class="table-secondary">
                   <td scope="row">{{book.id}}</td>
                   <td scope="row">{{book.title}}</td>
                   <td scope="row">{{ book.author }}</td>
                   <td scope="row">{{ book.genre }}</td>
                   <td scope="row">{{ book.description }}</td>
                   <td scope="row">{{ book.isbn }}</td>
                   <td scope="row">{{ book.published }}</td>
                   <td scope="row">{{ book.publisher }}</td>
                   <td scope="row"><img :src="'/images/' +book.image" alt="" height="50" width="50"></td>
                   <td scope="row"><router-link :to="{ name:'EditBook', params: {id:book.id} }" class="btn btn-primary btn-sm">EDIT</router-link></td>
                   <td scope="row"><button class="btn btn-danger btn-sm" @click.prevent="deleteContact(book.id)">DELETE</button></td>
                  
              </tr>
          </tbody>

        </table>
        <div>
                <Bootstrap4Pagination
                :data="books"
                @pagination-change-page="getContacts"
                />
        </div>
    </div>
  
</template>

<script>
import axios from 'axios';
import  {Bootstrap4Pagination}  from 'laravel-vue-pagination';
export default {
    name:'BookList',
    components: {  
        Bootstrap4Pagination
        },
    data(){
        return{
            books:{
            },                       
        }
    },

    created(){
          this.getContacts();
    },

    methods:{
        async getContacts(page=1){
            let url = 'http://127.0.0.1:8000/api/admin/book/index?page=' + page ;
            await axios.get(url).then(res => {
                   this.books = res.data.books; 
            }).catch(error => {
                console.log("errors" + error);
            });
        },

        async deleteContact(id){
            console.log(id);
            let url = `http://127.0.0.1:8000/api/admin/book/delete/${id}`;
            await axios.delete(url).then(res => {
                if(res.data.code==200){
                    alert(res.data.message);
                    this.getContacts();
                }
            }).catch(error => {
                console.log(error);
            });
        }
    },

}
</script>