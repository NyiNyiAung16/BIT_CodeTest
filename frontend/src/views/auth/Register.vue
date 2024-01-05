<template>
    <div class="w-screen h-screen flex justify-center items-center">
        <div class="w-[550px] mx-auto space-y-4">
            <img src="/logo/logo.png" class="mx-auto" alt="logo" width="100">
            <h3 class="text-center text-2xl font-bold">Register to your account</h3>
            <form @submit.prevent="registerAccount" class="space-y-3">
                <div>
                    <label class="mb-2 block" for="name">Username</label>
                    <input type="text" v-model="name" id="name" class="w-full p-2 rounded bg-transparent border border-gray-300 focus:outline-blue-400">
                    <p class="text-sm text-red-500 my-1" v-if="errors.name">{{ errors.name[0] }}</p>
                </div>
                <div>
                    <label class="mb-2 block" for="email">Email address</label>
                    <input type="email" v-model="email" id="email" class="w-full p-2 rounded bg-transparent border border-gray-300 focus:outline-blue-400">
                    <p class="text-sm text-red-500 my-1" v-if="errors.email">{{ errors.email[0] }}</p>
                </div>
                <div>
                    <label class="mb-2 block" for="password">Password</label>
                    <input type="password" v-model="password" id="password" class="w-full p-2 rounded bg-transparent border border-gray-300 focus:outline-blue-400">
                </div>
                <div>
                    <label class="mb-2 block" for="confrim">Confrim Password</label>
                    <input type="password" v-model="password_confirmation" id="confrim" class="w-full p-2 rounded bg-transparent border border-gray-300 focus:outline-blue-400">
                    <p class="text-sm text-red-500 my-1" v-if="errors.password">{{ errors.password[0] }}</p>
                </div>
                <button type="submit" class="w-full p-2 rounded bg-[#4f46e5] hover:bg-[#6A6ADE] duration-200 text-white font-medium">
                    <span ref="span">Register</span>
                </button>
            </form>
            <p class="text-gray-700 font-medium text-sm">If you already have an account, please <router-link to="/login" class="font-semibold underline hover:text-gray-800 duration-150 cursor-pointer">login</router-link> here.</p>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import { useBookStore } from '@/stores/book';
import { storeToRefs } from 'pinia';
import { useRouter } from 'vue-router';

const store = useBookStore();
const { errors } = storeToRefs(store);
const { createUser } = store;

const router = useRouter();

const name = ref('');
const email = ref('');
const password = ref('');
const password_confirmation = ref('');
const span = ref(null);

const registerAccount = async() => {
    //add spinner 
    span.value.textContent = '';
    span.value.classList.add('spinner');

    const user = {
        name:name.value,
        email:email.value,
        password:password.value,
        password_confirmation:password_confirmation.value
    };
    let res = await createUser(user);
    name.value = '';
    email.value = '';
    password.value = '';
    password_confirmation.value = '';
    if(res){
        router.push('/');
    }

    //remove spinner 
    span.value.textContent = 'Register';
    span.value.classList.remove('spinner');
}

</script>
