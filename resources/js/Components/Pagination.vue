<script setup>
const { nextPage, page, prevPage, onSetPage } = defineProps({
    prevPage: { type: Number },
    nextPage: { type: Number },
    page: { type: Number, required: true },
    onSetPage: { type: Function, required: true },
});

const handleNextPage = () => {
    if (!nextPage) return;

    onSetPage(nextPage);
};

const handlePrevPage = () => {
    if (!prevPage) return;

    onSetPage(prevPage);
};
</script>

<template>
    <section class="flex justify-around bg-white p-3 rounded">
        <button
            @click="handlePrevPage"
            :class="!!prevPage ? '' : 'text-zinc-500'"
        >
            Previous Page
        </button>
        <p>{{ page }}</p>
        <button
            @click="handleNextPage"
            :class="!!nextPage ? '' : 'text-zinc-500'"
        >
            Next Page
        </button>
    </section>
</template>
