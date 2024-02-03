<script setup>

</script>

<template>
    <Head title="Login" />
    <div class="grid place-items-center h-screen ">
        <div class="drop-shadow-md border w-96 h-[500px] py-12 px-3 rounded-md">
            <h1 class="text-center font-bold text-2xl">Login Again</h1>
            <form class="mt-4" action="">
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

            <div>
                <button class="ms-20 w-44 h-8 bg-blue-800 text-white rounded-md">Login</button>
            </div>
        </form>
        </div>
    </div>
</template>
