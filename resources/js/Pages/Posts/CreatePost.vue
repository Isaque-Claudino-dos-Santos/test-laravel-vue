<script setup lang="ts">
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import Title from "@/Components/Title.vue";
import useCreatePostForm from "@/hooks/use-create-post-form";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";

const { users } = defineProps(["users"]);

const { form, errors, onSubmit } = useCreatePostForm();
</script>

<template>
    <Head title="Create Post" />

    <AuthenticatedLayout>
        <template #header>
            <Title>Create Post</Title>
        </template>

        <section>
            <form
                class="flex flex-col flex-wrap gap-3 p-3"
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
                <div>
                    <InputLabel>Send To </InputLabel>
                    <TextInput list="userid" v-model="form.userId" />
                    <datalist id="userid">
                        <option
                            v-for="user of users"
                            :value="user.id"
                            :key="user.id"
                        >
                            {{ user.name }}
                        </option>
                    </datalist>

                    <div v-if="'userId' in errors">
                        <InputError
                            v-for="msg in errors.userId"
                            :message="msg"
                        />
                    </div>
                </div>

                <PrimaryButton>submit post</PrimaryButton>
            </form>
        </section>
    </AuthenticatedLayout>
</template>
