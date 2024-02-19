<script setup>
import { ref } from 'vue';
import axios from 'axios';
// import { defineComponent } from 'vue';
import VuePaginate from 'vue-paginate';


const categories = ref([]);
const links = ref([]);
let currentPage = 1;
const itemsPerPage = 10;

const displayedItems = ref([]);

async function getCategories() {
    try {
        const response = await axios.get('categories');
        console.log(response.data);
        links.value = response.data.links;
        categories.value = response.data.data;
        console.log(categories.value.data);
        console.log(links);
    } catch (error) {
        console.error('Error fetching categories:', error);
    }
}

function updateDisplayedItems() {
    const startIndex = (currentPage - 1) * itemsPerPage;
    const endIndex = startIndex + itemsPerPage;
    displayedItems.value = categories.value.slice(startIndex, endIndex);
    console.log(displayedItems)
}

function nextPage() {
    if (currentPage < Math.ceil(categories.value.length / itemsPerPage)) {
        currentPage++;
        updateDisplayedItems();
    }
}

function previousPage() {
    if (currentPage > 1) {
        currentPage--;
        updateDisplayedItems();
    }
}

async function getPageRecipes(url){
    let pageNumber = url.split('page=')[1];
    const response = await axios.get('/categories/?page=' + pageNumber);
    console.log(response.data.data);
    categories.value = response.data.data;
    console.log(categories.value);
}

getCategories();
</script>


<template>
    <h1
        class="inline-flex items-center relative p-2 mt-2 ms-3 text-sm  rounded-lg md:block lg:block  focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600 text-blue-800">
        categories
    </h1>
    <div class=" flex justify-end my-3">
        <router-link to="/category/addcategory">
            <button class="bg-blue-700 py-2 px-2 text-white rounded-md">
                <i class="fa-solid fa-plus text-white me-2 "></i> Add Category
            </button>
        </router-link>

    </div>
    <div class=" flex my-4">
        <h5 class="pt-2">Show :</h5>

        <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown"
            class="  focus:ring-4 ms-6 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2 text-center inline-flex items-center border dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            type="button">Dropdown button <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 4 4 4-4" />
            </svg>
        </button>

        <!-- Dropdown menu -->
        <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                <li>
                    <a href="#"
                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Dashboard</a>
                </li>
                <li>
                    <a href="#"
                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Settings</a>
                </li>
                <li>
                    <a href="#"
                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Earnings</a>
                </li>
                <li>
                    <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Sign
                        out</a>
                </li>
            </ul>
        </div>


    </div>
    <div>


        <div class="relative overflow-x-auto">
            <table class="w-[80%] mx-auto text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-white uppercase  bg-blue-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                        <th scope="col" class="px-6 py-3">
                            No
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Categories
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Publish
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="category in categories" :key="category.id"
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row"
                            class="px-4 justify-center py-4 font-medium flex text-gray-900 whitespace-nowrap dark:text-white">
                            <button class="bg-green-400 px-2 py-1 rounded-md"><i
                                    class="fa-solid fa-pen text-white"></i></button>
                            <button class="bg-red-400 px-2 py-1 rounded-md ms-5"><i
                                    class="fa-solid fa-trash text-white"></i></button>
                        </th>
                        <td class="px-4 py-4">
                            {{ category.id }}
                        </td>
                        <td class="px-6 py-4">
                            {{ category.name }}
                        </td>
                        <td class="px-6 py-4">
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input disabled type="checkbox" value="" class="sr-only peer" v-if="category.status === 0" checked/>
                                <div
                                    class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                                </div>
                            </label>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div className="flex justify-end  lg:w-[85%] md:w-[85%] w-[95%] mx-auto mt-2">
                <nav aria-label="Page navigation example">
                    <ul class="flex items-center -space-x-px h-8 text-sm">
                        <li>
                            <a href="#" @click.prevent="previousPage"
                                class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                                :class="{ 'cursor-not-allowed': currentPage === 1 }">
                                <span class="sr-only">Previous</span>
                                <svg class="w-2.5 h-2.5 rtl:rotate-180" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M5 1 1 5l4 4" />
                                </svg>
                            </a>
                        </li>
                        <li v-for="link in links" :key="link.id">
                            <p v-if="link.url" @click.prevent="getPageRecipes(link.url)"
                                class="flex cursor-pointer items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                {{ link.label }}
                            </p>
                        </li>
                        <li>
                            <a href="#" @click.prevent="nextPage"
                                class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                                >
                                <span class="sr-only">Next</span>
                                <svg class="w-2.5 h-2.5 rtl:rotate-180" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 9 4-4-4-4" />
                                </svg>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

    </div>
</template>
<!-- create methods for add data -->