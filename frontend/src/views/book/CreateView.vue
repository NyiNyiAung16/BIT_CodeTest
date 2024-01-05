<template>
    <div>
        <Navbar/>
        <CreateForm :edit="edit"/>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import CreateForm from '../../components/book/CreateForm.vue';
import Navbar from '@/components/Navbar.vue';

const edit = ref(false);

</script>
