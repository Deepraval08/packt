
import AddBook from '../components/AddBook.vue';
import BookList from '../components/BookList.vue';
import EditBook from '../components/EditBook.vue';
import SearchBook from '../components/SearchBook.vue';
import ShowBook from '../components/ShowBook.vue';
import { createRouter, createWebHistory } from 'vue-router';


const routes = [
    
    {
        name: 'BookList',
        path: '/',
        component: BookList
    },

    {
        name:'AddBook',
        path:'/add_book',
        component: AddBook
    },

    {
        name:'EditBook',
        path:'/edit/:id?',
        component: EditBook
    },

    {
        name:'SearchBook',
        path:'/search',
        component: SearchBook
    },

    {
        name:'ShowBook',
        path:'/show/:id?',
        component: ShowBook
    },

];

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router;