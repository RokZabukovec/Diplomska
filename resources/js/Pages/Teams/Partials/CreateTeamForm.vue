<script setup>
import { useForm } from "@inertiajs/inertia-vue3";
import FormSection from "@/Components/FormSection.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";

const form = useForm({
    name: "",
});

const createTeam = () => {
    form.post(route("teams.store"), {
        errorBag: "createTeam",
        preserveScroll: true,
    });
};
</script>

<template>
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <!-- We've used 3xl here, but feel free to try other max-widths based on your needs -->
        <div class="mx-auto max-w-3xl">
            <form @submit.prevent="createTeam">
                <div class="col-span-6">
                    <InputLabel value="Team Owner" />

                    <div class="flex items-center mt-2">
                        <img class="object-cover w-12 h-12 rounded-full" :src="$page.props.auth.user.profile_photo_url" :alt="$page.props.auth.user.name" />

                        <div class="ml-4 leading-tight">
                            <div>{{ $page.props.auth.user.name }}</div>
                            <div class="text-sm text-gray-700">
                                {{ $page.props.auth.user.email }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="name" value="Team Name" />
                    <TextInput id="name" v-model="form.name" type="text" class="block w-full mt-1" autofocus />
                    <InputError :message="form.errors.name" class="mt-2" />
                </div>
                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing"> Create </PrimaryButton>
            </form>
        </div>
    </div>
</template>
