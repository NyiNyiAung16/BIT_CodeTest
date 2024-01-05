<template>
    <div class="w-screen h-screen flex justify-center items-center">
        <div class="w-[550px] mx-auto space-y-4">
            <img src="/logo/logo.png" class="mx-auto" alt="logo" width="100">
            <h3 class="text-center text-2xl font-bold">Sign in to your account</h3>
            <form @submit.prevent="loginAccount" class="space-y-5">
                <div>
                    <label class="mb-2 block" for="email">Email address</label>
                    <input type="email" v-model="email" id="email" class="w-full p-2 rounded bg-transparent border border-gray-300 focus:outline-blue-400">
                    <p class="text-sm text-red-500 my-1" v-if="errors.email">{{ errors.email[0] }}</p>
                </div>
                <div>
                    <label class="mb-2 block" for="password">Password</label>
                    <input type="password" v-model="password" id="password" class="w-full p-2 rounded bg-transparent border border-gray-300 focus:outline-blue-400">
                    <p class="text-sm text-red-500 my-1" v-if="errors.password">{{ errors.password[0] }}</p>
                </div>
                <button type="submit" class="w-full p-2 rounded bg-[#4f46e5] hover:bg-[#6A6ADE] duration-200 text-white font-medium">
                    <span ref="span">Sign In</span>
                </button>
            </form>
            <p class="text-gray-700 font-medium text-sm">If you don't have an account, please <router-link to="/register" class="font-semibold underline hover:text-gray-800 duration-150 cursor-pointer">register</router-link> here.</p>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import { useBookStore } from '@/stores/book'
import { storeToRefs } from 'pinia';

const store = useBookStore();
const { errors } = storeToRefs(store);
const { loginUser } = store;

const router = useRouter();

const email = ref('');
const password = ref('');
const span = ref(null);

const loginAccount = async() => {
    //add spinner 
    span.value.textContent = '';
    span.value.classList.add('spinner');

    const user = {
        email:email.value,
        password:password.value
    };
    let res = await loginUser(user);
    email.value = '';
    password.value = '';
    if(res){
        router.push('/');
    }

    //remove spinner 
    span.value.textContent = 'Sign In';
    span.value.classList.remove('spinner');
}

</script>
