<script setup lang="ts">
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import Title from "@/Components/Title.vue";
import useCreatePostForm from "@/hooks/use-create-post-form";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

const { form, errors, onSubmit } = useCreatePostForm();
</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <Title>Create Post</Title>
        </template>

        <section>
            <form
                class="flex flex-col flex-wrap gap-3"
                @submit.prevent="onSubmit"
            >
                <div>
                    <InputLabel>Title</InputLabel>
                    <TextInput class="w-full" v-model="form.title" />

                    <div v-if="'title' in errors" class="flex flex-col">
                        <InputError
                            v-for="msg in errors.title"
                            :message="msg"
                        />
                    </div>
                </div>

                <div>
                    <InputLabel>Content</InputLabel>
                    <textarea class="w-full" v-model="form.content"></textarea>

                    <div v-if="'content' in errors">
                        <InputError
                            v-for="msg in errors.content"
                            :message="msg"
                        />
                    </div>
                </div>

                <PrimaryButton>submit post</PrimaryButton>
            </form>
        </section>
    </AuthenticatedLayout>
</template>
