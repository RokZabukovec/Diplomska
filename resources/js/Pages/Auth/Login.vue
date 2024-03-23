<script setup>
import { Link, useForm } from "@inertiajs/inertia-vue3";
import AuthenticationCard from "@/Components/AuthenticationCard.vue";
import AuthenticationCardLogo from "@/Components/AuthenticationCardLogo.vue";
import Checkbox from "@/Components/Checkbox.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import RegistrationLayout from "../../Layouts/RegistrationLayout.vue";
import GoogleSignIn from "../Redesign/GoogleSignIn.vue";

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const submit = () => {
    form.transform((data) => ({
        ...data,
        remember: form.remember ? "on" : "",
    })).post(route("login"), {
        onFinish: () => form.reset("password"),
    });
};
</script>

<template>

    <RegistrationLayout>
        <div>
            <AuthenticationCardLogo></AuthenticationCardLogo>
            <h2 class="mt-1 text-3xl font-thin tracking-tight text-gray-900">Sign in to your account</h2>
        </div>

        <AuthenticationCard>
            <template #logo>
                <AuthenticationCardLogo />
            </template>

            <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
                {{ status }}
            </div>

            <form @submit.prevent="submit">
                <div>
                    <InputLabel for="email" value="Email" />
                    <TextInput id="email" v-model="form.email" type="email" class="mt-1 block w-full" required autofocus />
                    <InputError class="mt-2" :message="form.errors.email" />
                </div>

                <div class="mt-4">
                    <InputLabel for="password" value="Password" />
                    <TextInput id="password" v-model="form.password" type="password" class="mt-1 block w-full" required autocomplete="current-password" />
                    <InputError class="mt-2" :message="form.errors.password" />
                </div>

                <div class="block mt-4">
                    <label class="flex items-center">
                        <Checkbox v-model:checked="form.remember" name="remember" />
                        <span class="ml-2 text-sm text-gray-600">Remember me</span>
                    </label>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <Link v-if="canResetPassword" :href="route('password.request')" class="underline text-sm text-gray-600 hover:text-gray-900"> Forgot your password? </Link>

                    <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing"> Log in </PrimaryButton>
                </div>
            </form>
        </AuthenticationCard>
        <div class="flex flex-col text-center mt-2">
            <h3>You don't have an account yet?</h3>
            <p>Sign up <Link href="/register" class="text-indigo-500 font-bold">here</Link>.</p>
        </div>
        <div class="flex flex-col text-center mt-2">
            <p class="mb-2 text-gray-500">Or</p>
            <GoogleSignIn></GoogleSignIn>
        </div>
    </RegistrationLayout>

</template>
