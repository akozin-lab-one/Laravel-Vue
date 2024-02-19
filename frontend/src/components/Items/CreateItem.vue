<script>
import axios from 'axios';

export default {
    data() {
        return {
            mapCenter: { lat: 16.8409, lng: 96.1735 },
            name: '',
            category: '',
            price: '',
            description: '',
            photo: '',
            status: null,
            categories:[],
            ownerName:'',
            ownerPhone:'',
            ownerAddress:'',
        };
    },
    methods: {
        async getcategories(){
            let res = await axios.get('categories');
            this.categories = res.data.data;
            console.log(this.categories);
        },
        async getFile(e) {
            console.log(e.target.value);
            if (e.target.value) {
                this.photo = e.target.files[0]; // Corrected to e.target.files[0]
                console.log(this.photo);
            }
            if (this.photo) {
                let formData = new FormData();
                formData.append('image', this.photo);

                try {
                    let res = await axios.post('item/upload', formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    });
                    console.log(res);
                    if (res) {
                        this.photo = res.data
                        console.log(this.photo)
                    }
                } catch (error) {
                    console.error(error);
                }
            }
        },

        async AddData() {
            console.log(this.photo.path);
            let formData = new FormData();
            formData.append('photo', this.photo.path);
            formData.append('name', this.name);
            formData.append('status', this.status ? 0 : 1);
            formData.append('userId', 2);
            formData.append('ownerId', 3);
            formData.append('description', this.description);
            formData.append('price',this.price);
            formData.append('categoryId',this.category);
            // console.log(photo.path);
            try {
                let res = await axios.post('createitem', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                });
                console.log(res);
            } catch (error) {
                console.error("Error occurred while adding data:", error);
            }

            let ownerData = new FormData();
            ownerData.append("name", this.ownerName);
            ownerData.append("phone", this.ownerPhone);
            ownerData.append("address", this.ownerAddress);
            ownerData.append("userId", 2);
            
            try {
                let res = await axios.post('createowner', ownerData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                });
                console.log(res);
            } catch (error) {
                console.error("Error occurred while adding data:", error);
            }
        }
    },
    mounted(){
        // this.getcategories(this.ownerAddress, this.ownerName,this.ownerPhone )

        const input = document.getElementById('pac-input');
        const options = {
            types: ['geocode']
        };
        const autocomplete = new google.maps.places.Autocomplete(input, options);
        autocomplete.addListener('place_changed', () => {
            const place = autocomplete.getPlace();
            if (!place.geometry) {
                console.log("Place details not found for the input: ", place);
                return;
            }
            this.mapCenter = place.geometry.location.toJSON();
        });
    }
};
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
                        <input v-model="name" class="border mt-2 block w-[50%] ps-3 py-2 rounded-md text-base" type="text"
                            placeholder="Input Name">
                    </div>
                    <div class="mb-4">
                        <label class="mb-2" for="">Select Category*</label>
                        <select v-model="category"   class="border mt-2 block w-[50%] ps-3 py-2 rounded-md text-base" name=""
                            id="">
                            <option class="text-xs me-3" value="">select category <i class="fa-solid fa-chevron-down "></i>
                            </option>
                            <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.name }}</option>
                        </select>
                        <!-- <input class="border mt-2 block w-[50%] ps-3 py-2 rounded-md text-base" type="text"
                    placeholder="Input Name"> -->
                    </div>
                    <div class="mb-4">
                        <label class="mb-2" for="">Price*</label>
                        <input v-model="price" class="border mt-2 block w-[50%] ps-3 py-2 rounded-md text-base" type="text"
                            placeholder="Enter Price">
                    </div>
                    <div class="mb-4">
                        <label class="mb-2" for="">Description*</label>
                        <!-- <Editor/> -->
                        <textarea v-model="description" class="border mt-2 block w-[50%] ps-3 py-2 rounded-md text-base"
                            name="" id="" cols="40" rows="10" placeholder="Enter Description"></textarea>
                        <!-- <input class="border mt-2 block w-[50%] ps-3 py-2 rounded-md text-base" type="text"
                    placeholder="Enter Price"> -->
                    </div>
                    <div @change="getFile" class="relative mb-4">
                        <label for="">Item Photo*</label>
                        <span class="text-gray-400 block text-xs">Recommended Size 400 x 200</span>
                        <input class="hidden" type="file" id="fileInput" accept="image/*" />
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
                            <input v-model="status" class="block me-1" type="checkbox"><span class="text-xs">Publish</span>
                        </div>
                    </div>
                </form>
            </div>
            <div class=" w-[50%]">
                <form action="">
                    <div class="mb-4">
                        <label class="mb-2" for="">Owner Name*</label>
                        <input v-model="ownerName" class="border mt-2 block w-[50%] ps-3 py-2 rounded-md text-base" type="text"
                            placeholder="Input Name">
                    </div>
                    <div class="mb-4">
                        <label class="mb-2" for="">Phone Number*</label>
                        <input v-model="ownerPhone" class="border mt-2 block w-[50%] ps-3 py-2 rounded-md text-base" type="text"
                            placeholder="Phone Number">
                    </div>
                    <div class="mb-4">
                        <label class="mb-2" for="">Address*</label>
                        <textarea v-model="ownerAddress" class="border mt-2 block w-[50%] ps-3 py-2 rounded-md text-base" name="" id="" cols="30"
                            rows="5" placeholder="Enter Address"></textarea>
                    </div>
                    <div class="mb-4 relative">
                        <input
                        className="absolute z-10 top-2 rounded-sm w-[200px] ps-2 h-[30px] left-6"
                            id="search-box"
                            type="text"
                            placeholder="Search places..."
                        />
                        <GMapMap :center="mapCenter" :zoom="10" map-type-id="terrain"
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
            <button @click.prevent="AddData" class="w-20 h-6 text-white rounded-md bg-blue-800">save</button>
        </div>
    </div>
</template>

