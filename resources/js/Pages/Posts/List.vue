<script setup type="ts">
import NavLink from "@/Components/NavLink.vue";
import Post from "@/Components/Post.vue";
import Title from "@/Components/Title.vue";
import usePosts from "@/hooks/use-posts";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

const {data,isLoading}= usePosts()
</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <Title>Posts</Title>
        </template>

        <div v-if="isLoading">
            <p>Carregando Posts</p>
        </div>

        <div class="flex flex-col gap-3">
            <div
                class="bg-white rounded shadow-md p-2"
                v-if="$page.props.auth.user.is_admin"
            >
                <NavLink
                    :href="route('posts.create')"
                    :active="route().current('posts.create')"
                    class="text-sm text-blue-700"
                >
                    + Create Post
                </NavLink>
            </div>

            <section>
                <ul class="flex flex-col gap-3">
                    <li v-for="post in data">
                        <Post :post />
                    </li>
                </ul>
            </section>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped></style>
