<script setup lang="ts">
import { router, Head, usePage } from '@inertiajs/vue3'
import { computed, ref } from 'vue'
import { Button } from '@/components/ui/button'
import { Input } from '@/components/ui/input'
import { Card, CardHeader, CardContent, CardTitle } from '@/components/ui/card'
import { type BreadcrumbItem } from '@/types';
import DataTable from '@/components/DataTable.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { index } from '@/routes/user/withdrawals';
import { Label } from '@/components/ui/label';

defineProps({ transactions: Array })

const page = usePage();
const errors = computed(() => page.props?.errors)
const form = ref({ amount: '', wallet_address: "" })

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
                <CardContent class="space-y-6">
                    <div class="flex flex-col gap-6 items-end justify-end lg:w-4/12 w-full ml-auto">
                        <div class="flex flex-col space-y-2 w-full">
                            <Label class="text-sm text-gray-700">Enter Amount</Label>
                            <Input
                                v-model="form.amount"
                                type="number"
                                placeholder="Enter amount"
                                min="10"
                            />
                            <small v-if="errors.amount" class="text-red-500">{{errors.amount}}</small>
                        </div>

                        <div class="flex flex-col space-y-2 w-full">
                            <Label class="text-sm text-gray-700">Wallet Address</Label>
                            <Input
                                type="text"
                                v-model="form.wallet_address"
                            />
                            <small v-if="errors.wallet_address" class="text-red-500">{{errors.wallet_address}}</small>
                        </div>

                        <Button @click="submit">Request Withdrawal</Button>
                    </div>
                </CardContent>
            </Card>

            <h3 class="mb-6 text-xl font-semibold">My Withdrawals</h3>
            <DataTable :columns="columns" :tableData="transactions" />
        </div>
    </AppLayout>
</template>
