<script setup lang="ts">
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import useCreatePost from "@/hooks/use-create-post";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { useForm } from "@inertiajs/vue3";

const { mutate } = useCreatePost();

const form = useForm({
    title: "",
    content: "",
});

const submit = () => {
    mutate({
        title: form.title,
        content: form.content,
    });
};
</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Create Post
            </h2>
        </template>

        <section>
            <form
                class="flex flex-col flex-wrap gap-2"
                @submit.prevent="submit"
            >
                <div>
                    <InputLabel>Title</InputLabel>
                    <TextInput class="w-full" v-model="form.title" />
                </div>

                <div>
                    <InputLabel>Content</InputLabel>
                    <textarea class="w-full" v-model="form.content"></textarea>
                </div>

                <PrimaryButton>submit post</PrimaryButton>
            </form>
        </section>
    </AuthenticatedLayout>
</template>
