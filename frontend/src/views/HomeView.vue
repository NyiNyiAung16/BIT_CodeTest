<template>
  <Navbar/>
  <div class="max-w-7xl mx-auto mt-4">
    <Suspense>
      <template #default>
        <BookLists/>
      </template>
      <template #fallback>
          <span class="spinner bg-violet-300"></span>
      </template>
    </Suspense>
  </div>
</template>


<script setup>
import BookLists from '@/components/BookLists.vue';
import Navbar from '@/components/Navbar.vue';

</script>
