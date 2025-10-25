<script setup lang="ts">
import {
    Card,
    CardDescription,
    CardHeader,
    CardTitle,
} from '@/components/ui/card';
import DataTable from '@/components/DataTable.vue';

defineProps({
    stats: Object,
    recent_users: Array,
    columns: Array,
})
</script>

<template>
    <div class="grid gap-4 md:grid-cols-4">
        <Card class="rounded-xl border border-border/60">
            <CardHeader>
                <CardDescription>Total Users</CardDescription>
                <CardTitle class="text-2xl font-bold">{{
                    stats.total_users
                }}</CardTitle>
            </CardHeader>
        </Card>
        <Card class="rounded-xl border border-border/60">
            <CardHeader>
                <CardDescription>Total Income</CardDescription>
                <CardTitle class="text-2xl font-bold"
                    >${{ stats.total_income.toLocaleString() }}</CardTitle
                >
            </CardHeader>
        </Card>
        <Card class="rounded-xl border border-border/60">
            <CardHeader>
                <CardDescription>Pending Deposits</CardDescription>
                <CardTitle class="text-2xl font-bold">{{
                    stats.pending_deposits
                }}</CardTitle>
            </CardHeader>
        </Card>
        <Card class="rounded-xl border border-border/60">
            <CardHeader>
                <CardDescription>Pending Withdrawals</CardDescription>
                <CardTitle class="text-2xl font-bold">{{
                    stats.pending_withdrawals
                }}</CardTitle>
            </CardHeader>
        </Card>
    </div>

    <div class="rounded-xl border border-border/60 p-4">
        <h2 class="mb-4 text-lg font-semibold">Recent Users</h2>
        <DataTable :columns="columns" :table-data="recent_users" />
    </div>
</template>

<style scoped></style>
