<script setup lang="ts">
import { router, Head } from '@inertiajs/vue3'
import { ref } from 'vue'
import { Button } from '@/components/ui/button'
import { Input } from '@/components/ui/input'
import { Card, CardHeader, CardContent, CardTitle } from '@/components/ui/card'
import { Table, TableHeader, TableHead, TableRow, TableCell, TableBody } from '@/components/ui/table'
import DataTable from '@/components/DataTable.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { index } from '@/routes/user/deposits';

defineProps({ transactions: Array })

const form = ref({ amount: '' })

function submit() {
    router.post('/user/deposits', form.value)
}
const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Deposits',
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
    <Head title="Deposits" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="container mx-auto p-6 space-y-6">
            <Card class="shadow-md border rounded-2xl">
                <CardHeader>
                    <CardTitle class="text-2xl font-bold">Deposit Funds</CardTitle>
                </CardHeader>
                <CardContent class="flex gap-3">
                    <Input
                        v-model="form.amount"
                        type="number"
                        placeholder="Enter amount"
                        min="10"
                        class="w-48"
                    />
                    <Button @click="submit">Request Deposit</Button>
                </CardContent>
            </Card>

            <Card class="shadow-md border rounded-2xl">
                <CardHeader>
                    <CardTitle class="text-xl font-semibold">My Deposit Requests</CardTitle>
                </CardHeader>
                <CardContent>
                    <DataTable :columns="columns" :data="transactions" />
                </CardContent>
            </Card>
        </div>
    </AppLayout>
</template>
