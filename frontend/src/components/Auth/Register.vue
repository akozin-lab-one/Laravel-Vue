<script setup>

</script>


<template>
    <Head title="Register" />
    <div class="grid place-items-center h-screen ">
        <div class="drop-shadow-md border w-96 h-[500px] py-12 px-3 rounded-md">
            <h1 class="text-center font-bold text-2xl">Register To Your Account</h1>
            <p class="text-center text-black text-xs">welcome back</p>
            <form class="mt-4" action="">
            <div class="mb-3  ">
                <label class="ms-20" for="">Name</label>
                <br>
                <input class="ms-20 w-44 h-8" type="text" >
            </div>
            <div class="mb-3  ">
                <label class="ms-20" for="">Email</label>
                <br>
                <input class="ms-20 w-44 h-8" type="text" >
            </div>
            <div class="mb-3  ">
                <label class="ms-20" for="">Password</label>
                <br>
                <input class="ms-20 w-44 h-8" type="text" >
            </div>
            <div class="mb-3  ">
                <label class="ms-20" for="">Confirm Password</label>
                <br>
                <input class="ms-20 w-44 h-8" type="text" >
            </div>

            <div>
                <button class="ms-20 w-44 h-8 bg-blue-800 text-white rounded-md">Register</button>
            </div>
        </form>
        </div>
    </div>
</template>
