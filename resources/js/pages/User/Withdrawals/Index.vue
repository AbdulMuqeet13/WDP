<script setup lang="ts">
import { router, Head } from '@inertiajs/vue3'
import { ref } from 'vue'
import { Button } from '@/components/ui/button'
import { Input } from '@/components/ui/input'
import { Card, CardHeader, CardContent, CardTitle } from '@/components/ui/card'
import { type BreadcrumbItem } from '@/types';
import DataTable from '@/components/DataTable.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { index } from '@/routes/user/withdrawals';

defineProps({ transactions: Array })

const form = ref({ amount: '' })

function submit() {
    router.post('/user/withdrawals', form.value)
}
const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Withdrawals',
        href: index().url,
    },
];

const columns = [
    { accessorKey: 'amount', header: 'Amount' },
    { accessorKey: 'status', header: 'Status' },
    { accessorKey: 'created_at', header: 'Date' },
    ]
</script>

<template>
    <Head title="Withdrawals" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="container mx-auto p-6 space-y-6">
            <Card class="shadow-md border rounded-2xl">
                <CardHeader>
                    <CardTitle class="text-2xl font-bold">Withdraw Funds</CardTitle>
                </CardHeader>
                <CardContent class="flex gap-3">
                    <Input
                        v-model="form.amount"
                        type="number"
                        placeholder="Enter amount"
                        min="10"
                        class="w-48"
                    />
                    <Button @click="submit">Request Withdrawal</Button>
                </CardContent>
            </Card>

            <h3 class="mb-6 text-xl font-semibold">My Withdrawls</h3>
            <DataTable :columns="columns" :tableData="transactions" />
        </div>
    </AppLayout>
</template>
