<script setup type="ts">
import NavLink from "@/Components/NavLink.vue";
import Post from "@/Components/Post.vue";
import Title from "@/Components/Title.vue";
import usePosts from "@/hooks/use-posts";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { usePage } from "@inertiajs/vue3";
import { reactive } from "vue";
import Pagination from "@/Components/Pagination.vue";

const page  = usePage()

const filters = reactive({
    userId: page.props.auth.user.id,
    page:1,
    limit: 12
})

const {data: pagination, isLoading, isError}= usePosts({filters})

const setPage = (page) => {
    filters.page = page
}
</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <Title>Posts</Title>
        </template>

        <div v-if="isLoading">
            <p>Loading Posts</p>
        </div>

        <section v-else-if="isError" class="w-full bg-white">
            <p class="p-6 text-gray-900">
                Unable to load posts, please try again later
            </p>
        </section>

        <div class="flex flex-col gap-3" v-else-if="pagination">
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

            <section v-if="!!pagination.total_data" class="flex flex-col gap-3">
                <Pagination
                    :page="filters.page"
                    :prev-page="pagination.prev_page"
                    :next-page="pagination.next_page"
                    @set-page="setPage"
                />

                <div>
                    <ul class="flex flex-col gap-3">
                        <li v-for="post in pagination.data">
                            <Post :post />
                        </li>
                    </ul>
                </div>

                <Pagination
                    :page="filters.page"
                    :prev-page="pagination.prev_page"
                    :next-page="pagination.next_page"
                    @set-page="setPage"
                />
            </section>

            <section v-else class="w-full bg-white">
                <p class="p-6 text-gray-900">
                    No posts have been made at the moment
                </p>
            </section>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped></style>
