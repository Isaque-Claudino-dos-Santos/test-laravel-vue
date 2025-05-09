<script setup>
const { post } = defineProps(["post"]);

const createdAt = new Date(post.created_at);
</script>

<template>
    <div class="flex flex-col p-2 gap-1 bg-white rounded shadow-lg">
        <header class="flex justify-between">
            <h2
                class="text-xl font-bold first-letter:uppercase"
                :id="post.title"
            >
                <a :href="`#${post.title}`">{{ post.title }}</a>
            </h2>

            <p class="text-xs">
                {{
                    `${createdAt.toLocaleDateString()} ${createdAt.toLocaleTimeString()}`
                }}
            </p>
        </header>
        <main class="pl-2">
            <p>{{ post.content }}</p>
        </main>
    </div>
</template>
