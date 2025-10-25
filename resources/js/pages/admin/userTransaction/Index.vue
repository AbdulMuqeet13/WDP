<script setup lang="ts">
import DataTable from '@/components/DataTable.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, router } from '@inertiajs/vue3';
import { ref, watch } from 'vue';
import { Table, TableCell, TableHeader, TableRow } from '@/components/ui/table';
import { Input } from '@/components/ui/input';
import { Popover } from '@/components/ui/popover';
import { Button } from '@/components/ui/button';
import { RangeCalendar } from '@/components/ui/range-calendar';
import { cn } from "@/lib/utils"
import {
    CalendarDate,
    DateFormatter,
    getLocalTimeZone,
} from "@internationalized/date"
import { Label } from '@/components/ui/label';

const df = new DateFormatter("en-US", {
    dateStyle: "medium",
})
defineProps({
    transactions: Object,
});

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Transactions', href: '' },
];

const columns = [
    { accessorKey: 'user.name', header: 'User' },
    { accessorKey: 'meta.type', header: 'Type' },
    { accessorKey: 'amount', header: 'Amount' },
    { accessorKey: 'created_at', header: 'Date' },
];

// Filters
const filters = ref({
    user: '',
    type: '',
    amount: '',
    start_date: '',
    end_date: '',
});

const pageNumber = ref(1);

const reloadData = () => {
    router.reload({
        only: ['transactions'],
        data: {
            page: pageNumber.value,
            ...filters.value,
        },
        preserveScroll: true,
    });
};

const changePage = (page) => {
    pageNumber.value = page.value;
    reloadData();
};

// Automatically reload when filters change (with debounce)
let timeout: ReturnType<typeof setTimeout>;
watch(filters, () => {
    clearTimeout(timeout);
    timeout = setTimeout(() => {
        pageNumber.value = 1;
        reloadData();
    }, 500);
}, { deep: true });

</script>

<template>
    <Head title="User Transactions" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="container mx-auto p-10 space-y-6">
            <h1 class="text-2xl font-bold">User Transactions</h1>

            <div>
                <Table>
                    <TableHeader>
                        <TableRow>
                            <TableCell >
                                <Label class="mb-3">User</Label>
                                <Input v-model="filters.user" type="text" placeholder="Search User"
                                       class="w-full border rounded-lg p-2" />
                            </TableCell>
                            <TableCell>
                                <Label class="mb-3">Type</Label>
                                <Input v-model="filters.type" type="text" placeholder="Search Type"
                                       class="w-full border rounded-lg p-2" />
                            </TableCell>
                            <TableCell>
                                <Label class="mb-3">Type</Label>
                                <Input v-model="filters.amount" type="number" placeholder="Search Amount"
                                       class="w-full border rounded-lg p-2" />
                            </TableCell>
                            <TableCell>
                                <Label class="mb-3">Start Date</Label>
                                <Input v-model="filters.start_date" type="date" placeholder="Start Date - End Date"
                                       class="w-full border rounded-lg p-2" />
                            </TableCell>
                            <TableCell>
                                <Label class="mb-3">End Date</Label>
                                <Input v-model="filters.end_date" type="date" placeholder="Start Date - End Date"
                                       class="w-full border rounded-lg p-2" />
                            </TableCell>
                        </TableRow>
                    </TableHeader>
                </Table>


                <!-- 📊 Data Table -->
                <DataTable
                    :columns="columns"
                    :tableData="transactions.data"
                    :meta="transactions.meta"
                    @pageChange="changePage"
                    :enableSearch="false"
                />
            </div>
        </div>
    </AppLayout>
</template>
