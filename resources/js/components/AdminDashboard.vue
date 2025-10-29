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
        <Card
            v-for="(value, key) in stats"
            :key="key"
            class="rounded-xl border border-border/60"
        >
            <CardHeader>
                <CardDescription class="capitalize">{{
                        key.replace('_', ' ')
                    }}</CardDescription>
                <CardTitle class="text-2xl font-bold">
                    {{ typeof value === 'number' ? value : `$${value}` }}
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
