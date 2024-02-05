<script setup>
import { ref } from 'vue';

const isHelloVisible = ref(true);

const route = ref('example');
const isSidebarOpen = ref(false);

const toggleVisibility = (element) => {
  if (element === 'hello') {
    isHelloVisible.value = !isHelloVisible.value;
    console.log(isHelloVisible.value);
  }
};
const props = defineProps(['isSidebarOpen']);
console.log(props.isSidebarOpen);
</script>

<template>
    <h1
        :class="{ 'left-0': !isSidebarOpen, 'left-64': isSidebarOpen }"
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
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="px-4 justify-center py-4 font-medium flex text-gray-900 whitespace-nowrap dark:text-white">
                    <button class="bg-green-400 px-2 py-1 rounded-md"><i class="fa-solid fa-pen text-white"></i></button>
                    <button class="bg-red-400 px-2 py-1 rounded-md ms-5"><i class="fa-solid fa-trash text-white"></i></button>
                </th>
                <td class="px-4 py-4">
                    1
                </td>
                <td class="px-6 py-4">
                    Laptop
                </td>
                <td class="px-6 py-4">
                    <div class="bg-blue-800 flex w-24 py-2 rounded-xl justify-between px-2">
                        <!-- Use v-show to toggle visibility based on the 'isHelloVisible' data property -->
                        <div @click="toggleVisibility('hello')" class="rounded-full bg-white text-white cursor-pointer" :class="{ 'hidden': isHelloVisible }">Hello</div>
                        <p @click="toggleVisibility('hello')" class="text-white bg-white rounded-full cursor-pointer" :class="{ 'hidden': !isHelloVisible }">Hello</p>
                    </div>
                </td>
            </tr>

        </tbody>
    </table>
</div>

</div>
</template>