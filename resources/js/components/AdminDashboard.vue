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
const colors = {
    total_users: "#3b82f6",
    active_users: "#10b981",
    inactive_users: "#f59e0b",
    total_sales: "#6366f1",
    pending_orders: "#f97316",
    completed_orders: "#14b8a6",
    total_revenue: "#f472b6",
    monthly_revenue: "#22c55e",
    new_signups: "#8b5cf6",
    referral_signups: "#ec4899",
    total_referrals: "#0ea5e9",
    pending_withdrawals: "#ef4444"
}
</script>

<template>
    <div class="grid gap-4 md:grid-cols-4">
        <Card
            v-for="(value, key) in stats"
            :key="key"
            class="rounded-xl border border-border/60"
            :style="{ backgroundColor: colors[key] || '#999' }"
        >
            <CardHeader>
                <CardDescription class="capitalize text-white">{{
                        key.replaceAll('_', ' ')
                    }}</CardDescription>
                <CardTitle class="text-2xl font-bold text-white">
                    {{ value }}
                </CardTitle>
            </CardHeader>
        </Card>
    </div>

    <div class="rounded-xl border border-border/60 p-4">
        <h2 class="mb-4 text-lg font-semibold">Recent Users</h2>
        <DataTable :columns="columns" :table-data="recent_users" />
    </div>
</template>

<style scoped></style>
