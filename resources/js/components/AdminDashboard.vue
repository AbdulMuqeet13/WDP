<script setup lang="ts">
import {
    Card,
    CardDescription,
    CardHeader,
    CardTitle,
} from '@/components/ui/card';
import DataTable from '@/components/DataTable.vue';
import { useAppearance } from '@/composables/useAppearance';

defineProps({
    stats: Object,
    recent_users: Array,
    columns: Array,
})
const colors = {
    total_users: { light: "linear-gradient(135deg,#E0E7FF,#818CF8)", dark: "linear-gradient(135deg,#1E1B4B,#3730A3)" },
    total_ctos: { light: "linear-gradient(135deg,#F5F3FF,#C4B5FD)", dark: "linear-gradient(135deg,#2E1065,#6D28D9)" },
    total_business: { light: "linear-gradient(135deg,#FEF9C3,#FACC15)", dark: "linear-gradient(135deg,#422006,#854D0E)" },
    pending_deposits: { light: "linear-gradient(135deg,#FEF2F2,#F87171)", dark: "linear-gradient(135deg,#450A0A,#B91C1C)" },
    pending_withdrawals: { light: "linear-gradient(135deg,#FEE2E2,#F43F5E)", dark: "linear-gradient(135deg,#4C0519,#BE123C)" },
    total_withdrawals: { light: "linear-gradient(135deg,#E0F2FE,#38BDF8)", dark: "linear-gradient(135deg,#082F49,#0369A1)" },
    today_withdrawals: { light: "linear-gradient(135deg,#F0FDFA,#14B8A6)", dark: "linear-gradient(135deg,#042F2E,#0F766E)" },
    today_joined: { light: "linear-gradient(135deg,#ECFCCB,#84CC16)", dark: "linear-gradient(135deg,#1A2E05,#4D7C0F)" },
    today_active: { light: "linear-gradient(135deg,#F3E8FF,#C084FC)", dark: "linear-gradient(135deg,#3B0764,#7E22CE)" },
    today_roi: { light: "linear-gradient(135deg,#FDF2F8,#F472B6)", dark: "linear-gradient(135deg,#500724,#BE185D)" },
    total_sponsor_income: { light: "linear-gradient(135deg,#DCFCE7,#22C55E)", dark: "linear-gradient(135deg,#052E16,#15803D)" },
    total_cto_income: { light: "linear-gradient(135deg,#FFEDD5,#FB923C)", dark: "linear-gradient(135deg,#451A03,#C2410C)" },
};

const { appearance } = useAppearance();
const isDark = appearance.value === 'dark' //
</script>

<template>
    <div class="grid gap-4 md:grid-cols-4">
        <Card
            v-for="(value, key) in stats"
            :key="key"
            class="rounded-xl border border-border/60"
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

    <div class="rounded-xl border border-border/60 p-4">
        <h2 class="mb-4 text-lg font-semibold">Recent Users</h2>
        <DataTable :columns="columns" :table-data="recent_users" />
    </div>
</template>

<style scoped></style>
