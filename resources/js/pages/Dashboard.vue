<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { index } from '@/routes/admin/users';
import { type BreadcrumbItem } from '@/types';
import { Head, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';
import { BarChart } from "@/components/ui/chart-bar"
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { Users, DollarSign,Ticket, Mail } from "lucide-vue-next";
import { Button } from '@/components/ui/button'
import Milestone from '@/components/Milestone.vue'


const props = defineProps({
    user: Object,
    referral_url: String
});
const data = [
    { name: "Jan", total: Math.floor(Math.random() * 2000) + 500, predicted: Math.floor(Math.random() * 2000) + 500 },
    { name: "Feb", total: Math.floor(Math.random() * 2000) + 500, predicted: Math.floor(Math.random() * 2000) + 500 },
    { name: "Mar", total: Math.floor(Math.random() * 2000) + 500, predicted: Math.floor(Math.random() * 2000) + 500 },
    { name: "Apr", total: Math.floor(Math.random() * 2000) + 500, predicted: Math.floor(Math.random() * 2000) + 500 },
    { name: "May", total: Math.floor(Math.random() * 2000) + 500, predicted: Math.floor(Math.random() * 2000) + 500 },
    { name: "Jun", total: Math.floor(Math.random() * 2000) + 500, predicted: Math.floor(Math.random() * 2000) + 500 },
    { name: "Jul", total: Math.floor(Math.random() * 2000) + 500, predicted: Math.floor(Math.random() * 2000) + 500 },
]

const cards = [
    { icon: Users, title: props.user.data.network_members, desc: "Network Members", content: "6% referred by Admin" },
    { icon: DollarSign, title: "$57,765.00", desc: "Members Income", content: "0% Payout done" },
    { icon: Ticket, title: "9", desc: "Vouchers", content: "Vouchers In System" },
    { icon: Mail, title: "15", desc: "Items In Mail Box", content: "1 Unread Mail" },
];

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: index().url,
    },
];

const copied = ref(false)

const copyReferralLink = async () => {
    try {
        await navigator.clipboard.writeText(props.referral_url)
        copied.value = true
        setTimeout(() => (copied.value = false), 2000)
    } catch (error) {
        console.error("Failed to copy link:", error)
    }
}
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div
            class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4"
        >
            <div class="p-6 flex justify-between">
                <h1 class="text-xl font-bold">
                    Welcome, {{ user.data.name }}
                </h1>
                <div>
                <div class=" relative mt-4 space-y-2 flex items-center gap-6">
                    <p class="m-0">
                        <strong>Referral Code: </strong>
                        <span>{{ user.data.referral_code }}</span>
                    </p>


                    <Button size="sm" class="" variant="outline" @click="copyReferralLink">{{ copied ? "✅ Copied!" : "Copy Link" }}</Button>
                </div>

                </div>
            </div>

            <div class="grid gap-4 md:grid-cols-4">
                <!-- Card 1: Network Members -->
                <Card v-for="(card, index) in cards" :key="index" class="border border-border/60 rounded-xl transition-all hover:shadow-md hover:translate-y-0.5 duration-150">
                    <CardHeader class="flex flex-row items-center justify-between pb-1">
                        <div class="flex flex-col space-y-0.5">
                            <CardDescription class="text-sm">{{ card.desc }}</CardDescription>
                            <CardTitle class="text-2xl font-bold">{{ card.title }}</CardTitle>
                        </div>
                        <component :is="card.icon" class="h-6 w-6 text-muted-foreground"/>
                    </CardHeader>
                </Card>
            </div>





            <div class="flex flex-col md:flex-row gap-4">
                <!-- Left: Bar Chart -->
                <div class="flex-1 rounded-xl border border-border/60 p-4">
                    <BarChart
                        :data="data"
                        index="name"
                        :colors="['#249dd8', '#cfefff']"
                        :categories="['total', 'predicted']"
                        showLegend
                        :y-formatter="(tick) => {
                            return typeof tick === 'number'
                              ? `$ ${new Intl.NumberFormat('us').format(tick).toString()}`
                              : ''
                          }"
                    />
                </div>

                <!-- Right: Recent Referrals Table -->
                <Card class="flex-1 border border-border/60 rounded-xl overflow-hidden">
                    <CardHeader>
                        <CardTitle>Recent Referrals</CardTitle>
                        <!-- CardDescription removed as requested -->
                    </CardHeader>
                    <CardContent class="p-0">
                        <table class="w-full text-sm border-collapse">
                            <thead class="bg-muted text-muted-foreground">
                            <tr>
                                <th class="px-4 py-2 text-left font-medium">Name</th>
                                <th class="px-4 py-2 text-left font-medium">Email</th>
                                <th class="px-4 py-2 text-left font-medium">Joined Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="border-b last:border-b-0">
                                <td class="px-4 py-2">John Doe</td>
                                <td class="px-4 py-2">john@example.com</td>
                                <td class="px-4 py-2">2025-10-18</td>
                            </tr>
                            <tr class="border-b last:border-b-0">
                                <td class="px-4 py-2">Jane Smith</td>
                                <td class="px-4 py-2">jane@example.com</td>
                                <td class="px-4 py-2">2025-10-19</td>
                            </tr>
                            <tr class="border-b last:border-b-0">
                                <td class="px-4 py-2">Ali Khan</td>
                                <td class="px-4 py-2">ali@example.com</td>
                                <td class="px-4 py-2">2025-10-20</td>
                            </tr>
                            <tr>
                                <td class="px-4 py-2">Sara Ahmed</td>
                                <td class="px-4 py-2">sara@example.com</td>
                                <td class="px-4 py-2">2025-10-20</td>
                            </tr>
                            </tbody>
                        </table>
                    </CardContent>
                </Card>
            </div>
        </div>
        <section class="p-8 space-y-6">
            <h1 class="text-3xl font-bold text-foreground">Milestone</h1>
            <Milestone />
        </section>
    </AppLayout>
</template>
