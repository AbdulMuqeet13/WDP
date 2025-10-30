<script setup lang="ts">
import DataTable from '@/components/DataTable.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import { type BreadcrumbItem } from '@/types';
import { Head, router } from '@inertiajs/vue3';
import { ref } from 'vue';
import { show } from '@/routes/admin/users';
import { update } from '@/routes/admin/transactions';
import * as url from 'node:url';

defineProps({
    users: [],
});
const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Users',
        href: dashboard().url,
    },
];
const columns = [
    { accessorKey: 'name', header: 'Name', dataType: 'text' },
    { accessorKey: 'email', header: 'Email', dataType: 'text' },
    { accessorKey: 'referral_code', header: 'Referral Code', dataType: 'text' },
    { accessorKey: 'wallet_balance', header: 'Wallet Balance', dataType: 'text' },
    { accessorKey: 'total_investment', header: 'Total Investment', dataType: 'text' },
    { accessorKey: 'total_referral_income', header: 'Total Referral Income', dataType: 'text' },
    { accessorKey: 'network_members', header: 'Network Members', dataType: 'text' },
    { accessorKey: 'joining_date', header: 'Joining Date' },
];
const edit = (id: number) => {
    router.visit(show(id))
};

const searchInput = ref('');
const pageNumber = ref(1);

const reloadData = () => {
    router.reload({
        only: ['users'],
        data: {
            page: pageNumber.value,
            search: searchInput.value
        },
    });
}
const changePage = (page) => {
    pageNumber.value = page.value
    reloadData();
};

const search = (input: string) => {
    searchInput.value = input;
    pageNumber.value = 1;
    reloadData();
}
const tableActions = [
    {
        title: "Edit",
        action: edit,
        key: 'edit',
    },

];

</script>

<template>
    <Head title="Users" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="container mx-auto p-10">
            <h1 class="mb-6 text-2xl font-bold">User Management</h1>
            <DataTable
                :columns="columns"
                :tableData="users.data"
                :meta="users.meta"
                @pageChange="changePage"
                @search="search"
                :enableSearch="true"
                :actions="tableActions"
            />
        </div>
    </AppLayout>
</template>
