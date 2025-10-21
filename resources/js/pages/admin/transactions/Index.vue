<script setup lang="ts">
import { Head, router } from '@inertiajs/vue3'
import AppLayout from '@/layouts/AppLayout.vue';
import DataTable from '@/components/DataTable.vue';
import { index, update } from '@/routes/admin/transactions';
defineProps({ transactions: Array })

const breadcrumbs = [
    {
        title: 'Transaction',
        href: index().url,
    },
];
const approve = (id: number) => {
    router.patch(update(id), {'status': 'approved'})
}

const reject = (id: number) => {
    router.patch(update(id), {'status': 'rejected'})
}


const columns = [
    { accessorKey: 'user.data.name', header: 'User' },
    { accessorKey: 'type', header: 'Type' },
    { accessorKey: 'amount', header: 'Amount' },
    { accessorKey: 'status', header: 'Status' },
];

const tableActions = [
    {
        title: "Approve",
        action: approve,
        key: 'approve',
    },
    {
        title: "Reject",
        action: reject,
        key: 'reject',
    },
];
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="container mx-auto p-10">
            <h1 class="mb-6 text-2xl font-bold">Transactions Management</h1>
            <DataTable :columns="columns" :data="transactions"  :actions="tableActions"/>
        </div>
    </AppLayout>
</template>
