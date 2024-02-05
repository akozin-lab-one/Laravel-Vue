<script>

</script>

<template>
    <div class="flex">
        <h5 class="text-xs flex">
            <router-link to="/items">
                Items
            </router-link>
            <p class="ms-2">></p>
        </h5>
        <h5 class="text-xs text-blue-800 ms-3">
            Add Items
        </h5>
    </div>

    <div>
        <h3 class="bg-blue-100 my-4 py-2 ps-2 rounded-md text-black">Add Items</h3>
        <p class="text-base mb-3">item information</p>
        <div class="flex ">
            <div class="w-[60%]">
                <form action="">
                    <div class="mb-4">
                        <label class="mb-2" for="">Item Name*</label>
                        <input class="border mt-2 block w-[50%] ps-3 py-2 rounded-md text-base" type="text"
                            placeholder="Input Name">
                    </div>
                    <div class="mb-4">
                        <label class="mb-2" for="">Select Category*</label>
                        <select class="border mt-2 block w-[50%] ps-3 py-2 rounded-md text-base" name="" id="">
                            <option class="text-xs me-3" value="">select category <i class="fa-solid fa-chevron-down "></i>
                            </option>
                        </select>
                        <!-- <input class="border mt-2 block w-[50%] ps-3 py-2 rounded-md text-base" type="text"
                    placeholder="Input Name"> -->
                    </div>
                    <div class="mb-4">
                        <label class="mb-2" for="">Price*</label>
                        <input class="border mt-2 block w-[50%] ps-3 py-2 rounded-md text-base" type="text"
                            placeholder="Enter Price">
                    </div>
                    <div class="mb-4">
                        <label class="mb-2" for="">Description*</label>
                        <!-- <Editor/> -->
                        <textarea class="border mt-2 block w-[50%] ps-3 py-2 rounded-md text-base" name="" id="" cols="40"
                            rows="10" placeholder="Enter Description"></textarea>
                        <!-- <input class="border mt-2 block w-[50%] ps-3 py-2 rounded-md text-base" type="text"
                    placeholder="Enter Price"> -->
                    </div>
                    <div class="relative mb-4">
                        <label for="">Item Photo*</label>
                        <span class="text-gray-400 block text-xs">Recommended Size 400 x 200</span>
                        <input class="hidden" type="file" id="fileInput" />
                        <label for="fileInput"
                            class="border mt-2 block w-[50%] h-48 place-items-center ps-3 py-2 rounded-md text-base cursor-pointer">
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

                </form>
            </div>
            <div class=" w-[50%]">
                <form action="">
                    <div class="mb-4">
                        <label class="mb-2" for="">Owner Name*</label>
                        <input class="border mt-2 block w-[50%] ps-3 py-2 rounded-md text-base" type="text"
                            placeholder="Input Name">
                    </div>
                    <div class="mb-4">
                        <label class="mb-2" for="">Phone Number*</label>
                        <input class="border mt-2 block w-[50%] ps-3 py-2 rounded-md text-base" type="text"
                            placeholder="Phone Number">
                    </div>
                    <div class="mb-4">
                        <label class="mb-2" for="">Address*</label>
                        <textarea class="border mt-2 block w-[50%] ps-3 py-2 rounded-md text-base" name="" id="" cols="30"
                            rows="5" placeholder="Enter Address"></textarea>
                    </div>
                    <div class="mb-4">
                        <GMapMap :center="{ lat: 16.8409, lng: 96.1735 }" :zoom="10" map-type-id="terrain"
                            style="width: 26vw; height: 25rem" :options="{
                                zoomControl: true,
                                mapTypeControl: true,
                                scaleControl: true,
                                streetViewControl: true,
                                rotateControl: true,
                                fullscreenControl: true
                            }" />
                    </div>
                </form>
            </div>
        </div>
        <div class="flex justify-end w-[80%] my-4">
            <p class="me-6">cancel</p>
            <button class="w-20 h-6 text-white rounded-md bg-blue-800">save</button>
        </div>
    </div>
</template>

