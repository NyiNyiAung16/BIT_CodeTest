<template>
  <div class="flex items-center justify-between px-5">
    <div class="flex items-center gap-3 mt-3">
        <router-link to="/" class="text-2xl font-bold mb-5 text-gray-500">Book Lists</router-link>
        <router-link to="/book/create" class="text-2xl font-bold mb-5 text-gray-500">Book Create</router-link>
    </div>
    <div v-if="user" class="flex items-center gap-2">
        <p class="font-bold">{{ user.data.email }}</p>
        <button class="bg-transparent hover:bg-gray-100 active:bg-gray-200 duration-150 font-semibold rounded border-2 px-2 py-1"
          @click="logoutAccount"
        >
          Logout
        </button>
    </div>
  </div>
</template>

<script setup>
import { onMounted, ref } from 'vue';
import { useBookStore } from '@/stores/book';
import { useRouter } from 'vue-router';

const store = useBookStore();
const router = useRouter();
const { logoutUser } = store;

const user = ref(null);

onMounted(()=>{
  user.value = JSON.parse(localStorage.getItem('user'));
});

const logoutAccount = () => {
    logoutUser();
    router.push('/login');
}

</script>

<style scoped>
a.router-link-active{
   color: #333;
   text-decoration: underline;
}
</style>