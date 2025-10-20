<script setup lang="ts">
import { Head } from '@inertiajs/vue3'
import { Card, CardHeader, CardContent, CardTitle } from '@/components/ui/card'
import { Table, TableHeader, TableHead, TableRow, TableCell, TableBody } from '@/components/ui/table'
import { Button } from '@/components/ui/button/index.js';
import DataTable from '@/components/DataTable.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { index } from '@/routes/user/wallet';

defineProps({
    balance: Number,
    transactions: Array
})

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Wallet',
        href: index().url,
    },
];

const columns = [
    { accessorKey: 'meta?type', header: 'Type' },
    { accessorKey: 'confirmed', header: 'Amount' },
    { accessorKey: 'amount', header: 'Status' },
    { accessorKey: 'created_at', header: 'Date' },
]
</script>

<template>
    <Head title="My Wallet" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="container mx-auto p-10 space-y-6">
            <Card class="shadow-md border rounded-2xl">
                <CardHeader>
                    <CardTitle class="text-2xl font-bold">Wallet Overview</CardTitle>
                </CardHeader>
                <CardContent class="text-lg">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-gray-500">Current Balance</p>
                            <h2 class="text-4xl font-bold text-blue-600">${{ balance }}</h2>
                        </div>
                        <div class="flex gap-3">
                            <Button as="a" href="/deposits">Deposit</Button>
                            <Button as="a" href="/withdrawals" variant="outline">Withdraw</Button>
                        </div>
                    </div>
                </CardContent>
            </Card>

            <Card class="shadow-md border rounded-2xl">
                <CardHeader>
                    <CardTitle class="text-xl font-semibold">Recent Transactions</CardTitle>
                </CardHeader>
                <CardContent>
                    <DataTable :columns="columns" :data="transactions" />
                </CardContent>
            </Card>
        </div>
    </AppLayout>
</template>
