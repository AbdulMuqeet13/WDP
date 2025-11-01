s<script setup lang="ts">
import { router, Head, usePage } from '@inertiajs/vue3'
import { computed, ref } from 'vue'
import { Button } from '@/components/ui/button'
import { Input } from '@/components/ui/input'
import { Card, CardHeader, CardContent, CardTitle, CardDescription } from '@/components/ui/card'
import { type BreadcrumbItem } from '@/types';
import DataTable from '@/components/DataTable.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { index } from '@/routes/user/withdrawals';
import { Label } from '@/components/ui/label';

defineProps({ transactions: Array })

const page = usePage();
const errors = computed(() => page.props?.errors)
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
            <Card class="shadow-md border rounded-2xl sm:flex-row gap-3">
                <CardHeader class="w-full">
                    <CardTitle class="text-2xl font-bold">Withdraw Funds</CardTitle>
                    <CardDescription>
                        <p class="text-sm text-gray-600">
                            Withdraw and receive payment at following address.
                        </p>
                        <div
                            class="rounded-md bg-gray-100 px-3 py-2 font-mono text-sm break-all dark:bg-gray-800 w-fit"
                        >
                            {{ page.props.auth.user.wallet_address }}
                        </div>
                    </CardDescription>
                </CardHeader>
                <CardContent class="space-y-6 2xl:w-4/12 xl:w-6/12 lg:w-7/12 w-full">
                    <div class="flex flex-col gap-6 items-end justify-end w-full ml-auto">
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

                        <Button @click="submit">Request Withdrawal</Button>
                    </div>
                </CardContent>
            </Card>

            <h3 class="mb-6 text-xl font-semibold">My Withdrawals</h3>
            <DataTable :columns="columns" :tableData="transactions" />
        </div>
    </AppLayout>
</template>
