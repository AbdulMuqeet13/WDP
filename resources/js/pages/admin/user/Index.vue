<script setup lang="ts">
import DataTable from '@/components/DataTable.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Users',
        href: dashboard().url,
    },
];
const columns = [
    { accessorKey: 'name', header: 'Name' },
    { accessorKey: 'email', header: 'Email' },
    { accessorKey: 'role', header: 'Role' },
];
const data = ref([
    { name: 'Aniqa Ahmad', email: 'aniqa@example.com', role: 'Admin' },
    { name: 'Sara Khan', email: 'sara@example.com', role: 'User' },
    { name: 'Ali Raza', email: 'ali@example.com', role: 'Editor' },
    { name: 'Hina Malik', email: 'hina@example.com', role: 'Moderator' },
]);
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="container mx-auto p-10">
            <h1 class="mb-6 text-2xl font-bold">User Management</h1>
            <DataTable :columns="columns" :data="data" />
        </div>
    </AppLayout>
</template>
