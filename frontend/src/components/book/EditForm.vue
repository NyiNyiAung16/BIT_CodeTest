<template>
    <div class="mt-5">
        <form @submit.prevent="edit" class="w-[600px] mx-auto">
            <h3 class="text-2xl font-bold text-center mb-4">Edit a book</h3>
            <div class="space-y-4">
                <div>
                    <label class="mb-2 block text-gray-700" for="contentowner">Content Owner</label>
                    <select v-model="contentOwner_idx" class="w-full p-2 rounded bg-transparent border border-gray-300" 
                        id="contentowner"
                    >
                        <option value="default" selected disabled>Choose a content owner</option>
                        <option :value="owner.idx" v-for="owner in contentOwners.data" :key="owner.idx">{{ owner.name }}</option>
                    </select>
                    <p class="text-sm text-red-500 my-1" v-if="errors.co_id">{{ errors.co_id[0] }}</p>
                </div>
                <div>
                    <label class="mb-2 block text-gray-700" for="publisher">Publisher</label>
                    <select v-model="publisher_idx" class="w-full p-2 rounded bg-transparent border border-gray-300" 
                        id="publisher"
                    >
                        <option value="default" selected disabled>Choose a publisher</option>
                        <option :value="publisher.idx" v-for="publisher in publishers.data" :key="publisher.idx">
                            {{ publisher.name }}
                        </option>
                    </select>
                    <p class="text-sm text-red-500 my-1" v-if="errors.publisher_id">{{ errors.publisher_id[0] }}</p>
                </div>
                <div>
                    <label class="mb-2 block text-gray-700" for="name">Book Name</label>
                    <input type="text" v-model="name" id="name" 
                        class="w-full p-2 rounded bg-transparent border border-gray-300 focus:outline-blue-400"
                        placeholder="eg:ေအာင္ရဲ႕ေအာင္"
                    >
                    <p class="text-sm text-red-500 my-1" v-if="errors.bookname">{{ errors.bookname[0] }}</p>
                </div>
                <div>
                    <label class="mb-2 block text-gray-700" for="photo">Book Cover Photo</label>
                    <input type="file" id="photo" 
                        class="w-full p-2 rounded bg-transparent border border-gray-300 focus:outline-blue-400"
                        @change="getPhoto"
                    >
                    <p class="text-sm text-red-500 my-1" v-if="errors.cover_photo">{{ errors.cover_photo[0] }}</p>
                </div>
                <div>
                    <label class="mb-2 block text-gray-700" for="price">Book Price</label>
                    <input type="number" v-model="price" id="price" 
                        class="w-full p-2 rounded bg-transparent border border-gray-300 focus:outline-blue-400"
                        placeholder="eg:1000"
                    >
                    <p class="text-sm text-red-500 my-1" v-if="errors.price">{{ errors.price[0] }}</p>
                </div>
                <button 
                    class="w-full p-2 rounded bg-[#4f46e5] hover:bg-[#6A6ADE] duration-200 text-white font-medium"
                    type="submit"
                >
                    <span ref="span">Edit</span>
                </button>
            </div>
        </form>
    </div>
</template>

<script setup>
import { onMounted, ref } from 'vue';
import { useBookStore } from '@/stores/book'
import { storeToRefs } from 'pinia';
import { useRouter } from 'vue-router';

const router = useRouter();

const props = defineProps({
    idx:{
        type:String
    }
});

const contentOwner_idx = ref('default');
const publisher_idx = ref('default');
const name = ref('');
const price = ref(0);
const photo = ref(null);
const span = ref(null);

const store = useBookStore();
const { contentOwners, publishers, book, errors } = storeToRefs(store);
const { getContentOwners, getPublishers, getBook, editBook } = store;

onMounted(async()=>{
  await getContentOwners();
  await getPublishers();
  await getData(props.idx);
});

const getPhoto = (e) => {
    photo.value = e.target.files[0];
}

const edit = async() => {
    //add spinner 
    span.value.textContent = '';
    span.value.classList.add('spinner');

    try{
        const form = new FormData();
        form.append('co_id',contentOwner_idx.value);
        form.append('publisher_id',publisher_idx.value);
        form.append('bookname',name.value);
        form.append('cover_photo',photo.value);
        form.append('price',price.value);
        form.append('_method','PUT');
        console.log(form)
        let res = await editBook(form,book.value.data.book_uniq_idx);
        if(res){
            router.push('/');
        }
    }catch(err){
        console.log(err)
    }

    //remove spinner 
    span.value.textContent = 'Edit';
    span.value.classList.remove('spinner');
}

async function getData(idx){
    try{
        await getBook(idx);
        //add data
        contentOwner_idx.value = book.value.data.author.idx;
        publisher_idx.value = book.value.data.publisher.idx;
        name.value = book.value.data.bookname;
        price.value = book.value.data.price;
    }catch(err){
        console.log(err)
    }
}

</script>
