import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import LoginView from '../views/auth/Login.vue'
import RegisterView from '../views/auth/Register.vue'
import CreateView from '../views/book/CreateView.vue'
import EditView from '../views/book/EditView.vue'

const user = JSON.parse(localStorage.getItem('user'));

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView,
      beforeEnter(from,to,next){
        if(!user){
            next('/login');
        }else{
          next();
        }
      }
    },
    {
      path: '/login',
      name: 'login',
      component: LoginView,
      beforeEnter(from,to,next){
        if(user){
            next('/');
        }else{
          next();
        }
      }
    },
    {
      path: '/register',
      name: 'register',
      component: RegisterView,
      beforeEnter(from,to,next){
        if(user){
            next('/');
        }else{
          next();
        }
      }
    },
    {
      path: '/book/create',
      name: 'create',
      component: CreateView,
      beforeEnter(from,to,next){
        if(!user){
            next('/login');
        }else{
          next();
        }
      }
    },
    {
      path: '/books/:idx/edit',
      name: 'edit',
      component: EditView,
      props:true,
      beforeEnter(from,to,next){
        if(!user){
            next('/login');
        }else{
          next();
        }
      }
    }
  ]
})

export default router
