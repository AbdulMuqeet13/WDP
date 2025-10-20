<script setup>
import { Head, router } from '@inertiajs/vue3'
import { Button } from '@/components/ui/button'
import { Card } from '@/components/ui/card'
import AppLayout from '@/layouts/AppLayout.vue';
import DataTable from '@/components/DataTable.vue';
import { dashboard } from '@/routes/index.js';
defineProps({ transactions: Array })

const breadcrumbs = [
    {
        title: 'Users',
        href: dashboard().url,
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
    <div class="p-8 space-y-6">
        <h1 class="text-3xl font-bold mb-6">Pending Transactions</h1>

        <Card class="p-4">
            <table class="min-w-full text-sm border-collapse">
                <thead>
                <tr class="bg-gray-100">
                    <th class="p-3 text-left">User</th>
                    <th class="p-3 text-left">Type</th>
                    <th class="p-3 text-left">Amount</th>
                    <th class="p-3 text-left">Status</th>
                    <th class="p-3 text-left">Action</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="tx in transactions" :key="tx.id" class="border-b">
                    <td class="p-3">{{ tx.user.name }}</td>
                    <td class="p-3 capitalize">{{ tx.type }}</td>
                    <td class="p-3">${{ tx.amount }}</td>
                    <td class="p-3 capitalize">{{ tx.status }}</td>
                    <td class="p-3 flex gap-2">
                        <Button variant="success" size="sm" @click="approve(tx.id)">Approve</Button>
                        <Button variant="destructive" size="sm" @click="reject(tx.id)">Reject</Button>
                    </td>
                </tr>
                </tbody>
            </table>
        </Card>
    </div>
</template>
