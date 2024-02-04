<template>
    <div class="flex">
        <h5 class="text-xs flex">
            <router-link to="/category">
                Categories
            </router-link> 
        <p class="ms-2">></p> 
        </h5>
        <h5 class="text-xs text-blue-800 ms-3">Add Categories</h5>
    </div>

    <div>
        <h3 class="bg-blue-100 my-4 py-2 ps-2 rounded-md text-black">Add Categories</h3>
        <form action="">
            <div class="mb-4">
                <label class="mb-2" for="">Category*</label>
                <input class="border mt-2 block w-[50%] ps-3 py-2 rounded-md text-base" type="text"
                    placeholder="Input Name">
            </div>
            <div class="relative mb-4">
                <label for="">Category Photo*</label>
                <span class="text-gray-400 block text-xs">Recommended Size 400 x 200</span>
                <input class="hidden" type="file" id="fileInput" />
                <label for="fileInput"
                    class="border mt-2 block w-[30%] h-48 place-items-center ps-3 py-2 rounded-md text-base cursor-pointer">
                    <div class="absolute bottom-0 top-16 text-xs left-32">
                        <div class="text-center">
                            <i class="fa-solid fa-cloud-arrow-up text-2xl"></i>
                        </div>
                        <span class="block">Drag and Drop here</span>
                        <span class="text-center block">or</span>
                        <span class="text-white block  bg-blue-800 text-xs p-2 rounded-md ">No file chosen</span>
                    </div>
                </label>
            </div>
            <div>
                <label for="">Status</label>
                <div class="flex">
                    <input class="block me-1" type="checkbox"><span class="text-xs">Publish</span>
                </div>
            </div>
            <div class="flex justify-end w-[50%]">
                <p class="me-6">cancel</p>
                <button class="w-20 h-6 text-white rounded-md bg-blue-800">save</button>
            </div>
        </form>
    </div>
</template>