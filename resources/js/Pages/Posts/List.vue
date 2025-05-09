<script setup type="ts">
import Post from "@/Components/Post.vue";
import usePosts from "@/hooks/use-posts";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

const {data,error,isLoading}= usePosts()
</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Posts
            </h2>
        </template>

        <div v-if="isLoading">
            <p>Carregando Posts</p>
        </div>

        <div>
            <ul class="flex flex-col gap-3">
                <li v-for="post in data">
                    <Post :post />
                </li>
            </ul>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped></style>
