<script setup lang="ts">
import { Head, router } from '@inertiajs/vue3'
import { Button } from '@/components/ui/button'
import { Card } from '@/components/ui/card'
import AppLayout from '@/layouts/AppLayout.vue';
import DataTable from '@/components/DataTable.vue';
import { index } from '@/routes/admin/transactions';
defineProps({ transactions: Array })

const breadcrumbs = [
    {
        title: 'Transaction',
        href: index().url,
    },
];
const approve = (id) => {
    router.post(`/admin/transactions/${id}/approve`)
}

const reject = (id) => {
    router.post(`/admin/transactions/${id}/reject`)
}

const columns = [
    { accessorKey: 'user.name', header: 'User' },
    { accessorKey: 'type', header: 'Type' },
    { accessorKey: 'amount', header: 'Amount' },
    { accessorKey: 'status', header: 'Status' },
];
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="container mx-auto p-10">
            <h1 class="mb-6 text-2xl font-bold">Transactions Management</h1>
            <DataTable :columns="columns" :data="transactions" />
        </div>
    </AppLayout>
</template>
