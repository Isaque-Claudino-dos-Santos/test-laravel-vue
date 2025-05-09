<script setup type="ts">
import NavLink from "@/Components/NavLink.vue";
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

        <div class="flex flex-col gap-3">
            <div
                class="bg-white rounded shadow-md p-2"
                v-if="$page.props.auth.user.is_admin"
            >
                <NavLink
                    :href="route('posts.create')"
                    :active="route().current('posts.create')"
                    class="text-sm text-blue-800"
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
