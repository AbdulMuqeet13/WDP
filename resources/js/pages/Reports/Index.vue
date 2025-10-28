<script setup lang="ts">
import { Head, router } from '@inertiajs/vue3'
import { Card, CardHeader, CardTitle, CardContent, CardDescription } from '@/components/ui/card'
import { Input } from '@/components/ui/input'
import { Select, SelectTrigger, SelectValue, SelectContent, SelectItem } from '@/components/ui/select'
import { Button } from '@/components/ui/button'
import AppLayout from '@/layouts/AppLayout.vue'
import { ref, watch } from 'vue'
import DataTable from '@/components/DataTable.vue'
import { type BreadcrumbItem } from '@/types'
import { Label } from '@/components/ui/label';

const props = defineProps({
    transactions: Object,
    summary: Object,
    filters: Object,
})

const filters = ref({
    type: props.filters.type || '',
    from: props.filters.from || '',
    to: props.filters.to || '',
})

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Reports', href: '/reports' },
]

function applyFilters() {
    router.reload({data: {
            ...filters.value
        }})
    // router.get(route('reports.index'), , { preserveState: true })
}

const columns = [
    { accessorKey: 'user.name', header: 'User' },
    { accessorKey: 'type', header: 'Type' },
    { accessorKey: 'amount', header: 'Amount' },
    { accessorKey: 'created_at', header: 'Date' },
]
</script>

<template>
    <Head title="Income Reports" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="container mx-auto space-y-6 p-6">
            <h1 class="text-3xl font-bold">Income Reports</h1>

            <!-- Filters -->
            <div class="flex flex-wrap gap-3 items-end justify-end">
                <div class="flex flex-col gap-3">
                    <Label>Report Type</Label>
                    <Select v-model="filters.type">
                        <SelectTrigger class="w-48">
                            <SelectValue placeholder="Select Type" />
                        </SelectTrigger>
                        <SelectContent>
                            <SelectItem value="ROI Credit">Daily ROI</SelectItem>
                            <SelectItem value="Level Income">Sponsor Income</SelectItem>
<!--                            <SelectItem value="level_income">Level Income</SelectItem>-->
                            <SelectItem value="CTO Royalty">CTO Income</SelectItem>
                        </SelectContent>
                    </Select>
                </div>
                <div class="flex flex-col gap-3">
                    <Label>Start Date</Label>
                    <Input v-model="filters.from" type="date" placeholder="From" />
                </div>
                <div class="flex flex-col gap-3">
                    <Label>End Date</Label>
                    <Input v-model="filters.to" type="date" placeholder="To" />
                </div>

                <Button @click="applyFilters">Filter</Button>
            </div>

            <!-- Summary Cards -->
<!--            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-4">-->
<!--                <Card>-->
<!--                    <CardHeader><CardTitle>Daily ROI</CardTitle></CardHeader>-->
<!--                    <CardContent>-->
<!--                        <p class="text-2xl font-bold text-green-600">${{ Number(props.summary.roi).toLocaleString() }}</p>-->
<!--                    </CardContent>-->
<!--                </Card>-->

<!--                <Card>-->
<!--                    <CardHeader><CardTitle>Sponsor Income</CardTitle></CardHeader>-->
<!--                    <CardContent>-->
<!--                        <p class="text-2xl font-bold text-blue-600">${{ Number(props.summary.sponsor).toLocaleString() }}</p>-->
<!--                    </CardContent>-->
<!--                </Card>-->

<!--                <Card>-->
<!--                    <CardHeader><CardTitle>Level Income</CardTitle></CardHeader>-->
<!--                    <CardContent>-->
<!--                        <p class="text-2xl font-bold text-orange-600">${{ Number(props.summary.level).toLocaleString() }}</p>-->
<!--                    </CardContent>-->
<!--                </Card>-->

<!--                <Card>-->
<!--                    <CardHeader><CardTitle>CTO Income</CardTitle></CardHeader>-->
<!--                    <CardContent>-->
<!--                        <p class="text-2xl font-bold text-yellow-600">${{ Number(props.summary.cto).toLocaleString() }}</p>-->
<!--                    </CardContent>-->
<!--                </Card>-->
<!--            </div>-->

            <!-- Table -->
            <CardTitle>Transactions</CardTitle>
            <CardDescription>Showing detailed income records</CardDescription>
            <DataTable :columns="columns" :tableData="props.transactions.data" />
        </div>
    </AppLayout>
</template>
