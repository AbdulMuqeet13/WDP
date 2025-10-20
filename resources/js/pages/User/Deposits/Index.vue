<script setup>
import { router, Head } from '@inertiajs/vue3'
import { ref } from 'vue'
import { Button } from '@/components/ui/button'
import { Input } from '@/components/ui/input'
import { Card, CardHeader, CardContent, CardTitle } from '@/components/ui/card'
import { Table, TableHeader, TableHead, TableRow, TableCell, TableBody } from '@/components/ui/table'

defineProps({ transactions: Array })

const form = ref({ amount: '' })

function submit() {
    router.post('/user/deposits', form.value)
}
</script>

<template>
    <Head title="Deposits" />

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
                <Table>
                    <TableHeader>
                        <TableRow>
                            <TableHead>Amount</TableHead>
                            <TableHead>Status</TableHead>
                            <TableHead>Date</TableHead>
                        </TableRow>
                    </TableHeader>
                    <TableBody>
                        <TableRow v-for="t in transactions" :key="t.id">
                            <TableCell>${{ t.amount }}</TableCell>
                            <TableCell>
                <span
                    :class="{
                    'text-yellow-600': t.status === 'pending',
                    'text-green-600': t.status === 'approved',
                    'text-red-600': t.status === 'rejected'
                  }"
                >
                  {{ t.status }}
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
