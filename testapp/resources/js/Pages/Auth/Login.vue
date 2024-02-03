<script setup>

</script>

<template>
    <div class="grid place-items-center h-screen">
        <div class="drop-shadow-md border w-96 h-[350px] py-12 px-3 rounded-md">
            <div class="text-center bg-green-500 hidden">
                <AuthenticationCardLogo class="text-center"/>
            </div>
            <h1 class="text-2xl font-extrabold text-center text-black">Log in to your account</h1>
            <h6 class="text-xs text-center">Welcome Back!</h6>
            <form class="mt-3" @submit.prevent="submit">
                <div class="mb-2">
                    <InputLabel for="email" value="Email" />
                    <TextInput
                        id="email"
                        v-model="form.email"
                        type="email"
                        class="mt-1 block w-full"
                        required
                        autofocus
                        autocomplete="username"
                    />
                    <InputError class="mt-2" :message="form.errors.email" />
                </div>

                <div class="mb-4 relative">
                    <InputLabel for="password" value="Password" />
                    <TextInput
                        id="password"
                        :type="form.showPassword ? 'text' : 'password'"
                        v-model="form.password"
                        class="mt-1 block w-full"
                        required
                        autocomplete="current-password"
                    />
                    <span class="absolute top-[50%] right-[10px] cursor-pointer">
                        <i class="toggle-icon" @click="togglePasswordVisibility">
                            <span v-if="form.showPassword" class="fas fa-eye"></span>
                            <span v-else class="fas fa-eye-slash"></span>
                        </i>
                    </span>
                    <InputError class="mt-2" :message="form.errors.password" />
                </div>
                <div class="mb-5">
                    <div>
                        <button class="w-full py-2 rounded-md bg-blue-800 text-white text-xs" type="submit">Sign In</button>
                    </div>

                    <Link v-if="canResetPassword" :href="route('password.request')" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Forgot your password?
                    </Link>
                </div>
            </form>
        </div>
    </div>
</template>
