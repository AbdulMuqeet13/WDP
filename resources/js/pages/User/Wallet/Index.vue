<script setup>
import { Head } from '@inertiajs/vue3'
import { Card, CardHeader, CardContent, CardTitle } from '@/components/ui/card'
import { Table, TableHeader, TableHead, TableRow, TableCell, TableBody } from '@/components/ui/table'

defineProps({
    balance: Number,
    transactions: Array
})
</script>

<template>
    <Head title="My Wallet" />

    <div class="container mx-auto p-6 space-y-6">
        <Card class="shadow-md border rounded-2xl">
            <CardHeader>
                <CardTitle class="text-2xl font-bold">Wallet Overview</CardTitle>
            </CardHeader>
            <CardContent class="text-lg">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-gray-500">Current Balance</p>
                        <h2 class="text-4xl font-bold text-blue-600">${{ balance.toFixed(2) }}</h2>
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
                <Table>
                    <TableHeader>
                        <TableRow>
                            <TableHead>Type</TableHead>
                            <TableHead>Amount</TableHead>
                            <TableHead>Status</TableHead>
                            <TableHead>Date</TableHead>
                        </TableRow>
                    </TableHeader>
                    <TableBody>
                        <TableRow v-for="(t, i) in transactions" :key="i">
                            <TableCell>{{ t.meta?.type || 'General' }}</TableCell>
                            <TableCell class="font-medium">${{ t.amount }}</TableCell>
                            <TableCell>
                                <span
                                    :class="{
                                    'text-green-600': t.confirmed,
                                    'text-yellow-500': !t.confirmed
                                  }"
                                >
                                  {{ t.confirmed ? 'Confirmed' : 'Pending' }}
                                </span>
                            </TableCell>
                            <TableCell>{{ new Date(t.created_at).toLocaleString() }}</TableCell>
                        </TableRow>
                    </TableBody>
                </Table>
            </CardContent>
        </Card>
    </div>
</template>
