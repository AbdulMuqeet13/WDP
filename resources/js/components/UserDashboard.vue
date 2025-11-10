<script setup lang="ts">
import {
    Card,
    CardContent,
    CardDescription,
    CardHeader,
    CardTitle,
} from '@/components/ui/card';
import DataTable from '@/components/DataTable.vue';
import Milestone from '@/components/Milestone.vue';
import { useAppearance } from '@/composables/useAppearance';

defineProps({
    stats: Object,
    recent_referrals: Array,
    columns: Array,
    milestones: Array,
})

// const data = [
//     { name: "Jan", total: 500, predicted: 700 },
//     { name: "Feb", total: 800, predicted: 950 },
//     { name: "Mar", total: 1200, predicted: 1000 },
//     { name: "Apr", total: 600, predicted: 750 },
//     { name: "May", total: 900, predicted: 1000 },
//     { name: "Jun", total: 1100, predicted: 1200 },
// ]

const colors = {
    CTO_income: {
        light: "linear-gradient(135deg, #FED7AA, #FDBA74)", // orange soft gradient
        dark: "linear-gradient(135deg, #7C2D12, #9A3412)",
    },
    daily_ROI: {
        light: "linear-gradient(135deg, #FBCFE8, #F472B6)", // pink gradient
        dark: "linear-gradient(135deg, #831843, #9D174D)",
    },
    network_income: {
        light: "linear-gradient(135deg, #C7D2FE, #818CF8)", // indigo gradient
        dark: "linear-gradient(135deg, #312E81, #3730A3)",
    },
    network_members: {
        light: "linear-gradient(135deg, #99F6E4, #2DD4BF)", // teal gradient
        dark: "linear-gradient(135deg, #115E59, #0D9488)",
    },
    sponsor_income: {
        light: "linear-gradient(135deg, #D1FAE5, #6EE7B7)", // emerald gradient
        dark: "linear-gradient(135deg, #064E3B, #047857)",
    },
    total_deposits: {
        light: "linear-gradient(135deg, #FDE68A, #F59E0B)", // amber gradient
        dark: "linear-gradient(135deg, #78350F, #92400E)",
    },
    total_withdrawals: {
        light: "linear-gradient(135deg, #FBCFE8, #EC4899)", // pink gradient
        dark: "linear-gradient(135deg, #831843, #9D174D)",
    },
    wallet_balance: {
        light: "linear-gradient(135deg, #A7F3D0, #10B981)", // green gradient
        dark: "linear-gradient(135deg, #065F46, #059669)",
    },
};

const { appearance } = useAppearance();
const isDark = appearance.value === 'dark' //
</script>

<template>
    <div class="grid gap-4 md:grid-cols-4">
        <Card
            v-for="(value, key) in stats"
            :key="key"
            :class="['rounded-xl border border-border/60']"
            :style="{
                background: isDark
                  ? colors[key]?.dark || '#1E293B'
                  : colors[key]?.light || '#CBD5E1',
              }"
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

    <section class="space-y-6">
        <h1 class="text-3xl font-bold text-foreground">Milestone</h1>
        <Milestone :milestones="milestones"/>
    </section>
</template>

<style scoped></style>
