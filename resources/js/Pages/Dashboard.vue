<script setup>
import Title from "@/Components/Title.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <Title>Dashboard</Title>
        </template>

        <div class="p-6 bg-white text-gray-900">You're logged in!</div>
    </AuthenticatedLayout>
</template>
