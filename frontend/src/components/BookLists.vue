<template>
    <div>
        <table class="w-full">
            <thead>
                <tr class="border border-gray-300">
                    <th class="py-3 border-l">No</th>
                    <th class="py-3 border-l">Idx</th>
                    <th class="py-3 border-l">Book Name</th>
                    <th class="py-3 border-l">Content Owner Name</th>
                    <th class="py-3 border-l">Publisher Name</th>
                    <th class="py-3 border-l">Created Date</th>
                    <th class="py-3 border-l">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border border-gray-300" v-for="(book,index) in bookLists.data" :key="book.idx">
                    <td class="py-3 border-l text-center">{{ index }}</td>
                    <td class="py-3 border-l text-center">{{ book.idx }}</td>
                    <td class="py-3 border-l text-center">{{ book.name }}</td>
                    <td class="py-3 border-l text-center">{{ book.content_owner_name }}</td>
                    <td class="py-3 border-l text-center">{{ book.publisher_name }}</td>
                    <td class="py-3 border-l text-center">{{new Date(book.created_date).toLocaleString()}}</td>
                    <td class="py-3 border-l text-center">
                        <router-link :to="`/books/${book.idx}/edit`" 
                            class="text-sm text-blue-500 font-semibold hover:underline me-2"
                        >
                            Edit
                        </router-link>

                        <button
                            class="text-sm text-red-500 font-semibold hover:underline"
                            @click="deleteBook(book.idx)"
                        >
                            Delete
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script setup>
import { useBookStore } from '@/stores/book';
import { storeToRefs } from 'pinia';

const store = useBookStore();
const { bookLists } = storeToRefs(store);
const { getBookLists, destroyBook } = store;

await getBookLists();

const deleteBook = async(idx) => {
    await destroyBook(idx);
    bookLists.value.data = bookLists.value.data.filter((book)=>{
        return book.idx !== idx;
    });
}

</script>
