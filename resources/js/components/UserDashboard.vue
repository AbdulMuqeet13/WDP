<script setup lang="ts">
import {
    Card,
    CardContent,
    CardDescription,
    CardHeader,
    CardTitle,
} from '@/components/ui/card';
import DataTable from '@/components/DataTable.vue';

defineProps({
    stats: Object,
    recent_referrals: Array,
    columns: Array,
})

// const data = [
//     { name: "Jan", total: 500, predicted: 700 },
//     { name: "Feb", total: 800, predicted: 950 },
//     { name: "Mar", total: 1200, predicted: 1000 },
//     { name: "Apr", total: 600, predicted: 750 },
//     { name: "May", total: 900, predicted: 1000 },
//     { name: "Jun", total: 1100, predicted: 1200 },
// ]
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

    <div class="flex flex-col gap-4 md:flex-row">
        <!--                    <div class="flex-1 border border-border/60 rounded-xl p-4">-->
        <!--                        <BarChart :data="-->
        <!--                        data" index="name" :categories="['total','predicted']" showLegend />-->
        <!--                    </div>-->
        <Card class="flex-1 overflow-hidden rounded-xl border border-border/60">
            <CardHeader><CardTitle>Recent Referrals</CardTitle></CardHeader>
            <CardContent class="p-0">
                <DataTable :columns="columns" :table-data="recent_referrals" />
            </CardContent>
        </Card>
    </div>
</template>

<style scoped></style>
