<template>
    <div>
        <EditForm :idx="idx"/>
    </div>
</template>

<script setup>
import EditForm from '@/components/book/EditForm.vue';

defineProps({
    idx:{
        type:String
    }
});

</script>
