import axios from 'axios';
import { defineStore } from 'pinia'

export const useBookStore = defineStore('book',{
    state:()=>({
        contentOwners:[],
        publishers:[],
        bookLists:[],
        book:{},
        user:{},
        errors:{}
    }),
    actions:{
        async getUserData(){
            let res = await axios.get('/api/user');
            this.user = res;
        },

        async getContentOwners(){
            const data = await axios.get('/api/content-owners');
            this.contentOwners = data;
        },
        async getPublishers(){
            const data = await axios.get('/api/publishers');
            this.publishers = data;
        },
        async getBookLists(){
            const data = await axios.get('/api/book-lists');
            this.bookLists = data.data;
        },
        async getBook(idx){
            const data = await axios.get(`/api/books/${idx}/edit`);
            this.book = data;
        },
        async destroyBook(idx){
            await axios.delete(`/api/books/${idx}/destroy`);
        },
        async createUser(user){
            await axios.get('/sanctum/csrf-cookie');
            try{
                const res = await axios.post('/api/user/create',user);
                this.user = res;
                localStorage.setItem('user',JSON.stringify(this.user));
                return true;
            }catch(err){
                this.errors = err.response.data.errors;
                setTimeout(() => {
                    this.errors = {}
                }, 2000);
            }
        },
        async loginUser(user){
            await axios.get('/sanctum/csrf-cookie');
            try{
                const res = await axios.post('/api/user/login',user);
                this.user = res;
                localStorage.setItem('user',JSON.stringify(this.user));
                return true;
            }catch(err){
                this.errors = err.response.data.errors;
                setTimeout(() => {
                    this.errors = {}
                }, 2000);
            }
        },

        logoutUser(){
            axios.post('/api/user/logout');
            this.user = {};
            localStorage.removeItem('user');
        },

        async createBook(book){
            try{
                await axios.post('/api/book/store',book);
                return true;
            }catch(err){
                this.errors = err.response.data.errors;
                setTimeout(() => {
                    this.errors = {}
                }, 2000);
            }
        },
        async editBook(book,idx){
            try{
                await axios.post(`/api/book/${idx}/update`,book);
                return true;
            }catch(err){
                this.errors = err.response.data.errors;
                setTimeout(() => {
                    this.errors = {}
                }, 2000);
            }
        }
    }
});
