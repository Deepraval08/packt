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
                <form  @submit.prevent="saveBook" enctype="multipart/form-data">
                    <fieldset>
                        <div class="form-group">
                            <label for="" class="form-lable mt-4">Title</label>
                            <input type="text" class="form-control"  v-model="book.title" placeholder="Enter Title" name="title">

                        </div>
                        <div class="form-group">
                            <label for="" class="form-lable mt-4">Author</label>
                            <input type="text" class="form-control" v-model="book.author" placeholder="Enter Author" name="author">
                        </div>

                        <div class="form-group">
                            <label for="" class="form-lable mt-4">Genre</label>
                            <input type="text" class="form-control" v-model="book.genre" placeholder="Enter Genre" name="genre" 
                               >
                        </div>

                        <div class="form-group">
                            <label for="description" class="form-lable mt-4">Description</label>
                            <textarea class="form-control" id="description" rows="3"  v-model="book.description" name="description"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="ISBN" class="form-lable mt-4">ISBN</label>
                            <input type="text" class="form-control" placeholder="Enter ISBN"  v-model="book.isbn" name="isbn">
                        </div>

                        <div class="form-group">
                            <label for="description" class="form-lable mt-4">published</label> &nbsp; &nbsp;
                            <!-- <Datepicker v-model="book.published" format="dd-MM-yyyy" :enable-time-picker="false"></Datepicker> -->
                            <input type="date" v-model="book.published" name="published"  v-bind:max="currentDate">
                        </div>

                        <div class="form-group">
                            <label for="description" class="form-lable mt-4">Publisher</label>
                            <input type="text" class="form-control" v-model="book.publisher" placeholder="Enter publisher" name="publisher">
                        </div>

                        <div class="custom-file form-group" id="customFile" lang="es">
                            <label class="custom-file-label form-lable mt-4" for="exampleInputFile">
                             Select file...
                             </label>
                             <input type="file" class="custom-file-input form-control"   id="exampleInputFile" aria-describedby="fileHelp" v-on:change="onFileChange" name="image">
                            
                        </div>

                        <button class="btn btn-primary m-3" type="submit">Submit</button>
                    </fieldset>

                </form>
            </div>
        </div>
    </div>
</template>

<script>
    import Datepicker from '@vuepic/vue-datepicker';
    import '@vuepic/vue-datepicker/dist/main.css'
    import axios from 'axios';
    export default {
        components: { Datepicker },
        name: 'AddBook',
        data() {
            return {
                book: {
                    'title':'',
                    'author':'',
                    'genre':'',
                    'description':'',
                    'isbn':'',
                    'date':'',
                    'published':'',
                    'publisher':'',
                },
                currentDate:'',
                filename: '',
                image: '' ,
                errors: [],            
            }
        },
        methods: {

            async onFileChange(e) {
                this.filename = "Selected File: " + e.target.files[0].name;
                this.image = e.target.files[0];
            },
            
              async saveBook() {
                const config = {
                    headers: {
                    'content-type': 'multipart/form-data',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    }
                }
                     let formData  = new FormData();
                     formData.append('title', this.book.title);
                     formData.append('author', this.book.author);
                     formData.append('genre', this.book.genre);
                     formData.append('description', this.book.description);
                     formData.append('isbn', this.book.isbn);
                     formData.append('date', this.book.date);
                     formData.append('published', this.book.published);
                     formData.append('publisher', this.book.publisher);
                     formData.append('image', this.image);
                      let url = "http://127.0.0.1:8000/api/admin/book/store";
                     await  axios.post(url, formData, config).then(res =>{
                        this.errors.splice(0, this.errors.length); 
                            if(res.status == 200){
                                this.book.title="";
                                this.book.author="";
                                this.book.genre="";
                                this.book.description="";
                                this.book.isbn="";
                                this.book.date="";
                                this.book.published="";
                                this.book.publisher="";
                               
                                alert(res.data.message);
                                this.$router.push('/');
                            }
                     }).catch(error => {
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