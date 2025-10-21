<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { index } from '@/routes/admin/users';
import { type BreadcrumbItem } from '@/types';
import { Head, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';
import { BarChart } from "@/components/ui/chart-bar"
import { Card, CardContent, CardDescription, CardFooter, CardHeader, CardTitle } from '@/components/ui/card';
import { Users, DollarSign,Ticket, Mail } from "lucide-vue-next";
import { Button } from '@/components/ui/button'

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
    { icon: Users, title: "655", desc: "Network Members", content: "6% referred by Admin" },
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
const { props } = usePage();
const user = props.auth.user;

const copied = ref(false)

const copyReferralLink = async () => {
    try {
        await navigator.clipboard.writeText(user.referral_url)
        copied.value = true
        setTimeout(() => (copied.value = false), 2000)
    } catch (error) {
        console.error("Failed to copy link:", error)
    }
}
const lineData = [
    {
        "year": 1970,
        "Export Growth Rate": 2.04,
        "Import Growth Rate": 1.53,
    },
    {
        "year": 1971,
        "Export Growth Rate": 1.96,
        "Import Growth Rate": 1.58,
    },
    {
        "year": 1972,
        "Export Growth Rate": 1.96,
        "Import Growth Rate": 1.61,
    },
    {
        "year": 1973,
        "Export Growth Rate": 1.93,
        "Import Growth Rate": 1.61,
    },
    {
        "year": 1974,
        "Export Growth Rate": 1.88,
        "Import Growth Rate": 1.67,
    },
    {
        "year": 1975,
        "Export Growth Rate": 1.79,
        "Import Growth Rate": 1.64,
    },
    {
        "year": 1976,
        "Export Growth Rate": 1.77,
        "Import Growth Rate": 1.62,
    },
    {
        "year": 1977,
        "Export Growth Rate": 1.74,
        "Import Growth Rate": 1.69,
    },
    {
        "year": 1978,
        "Export Growth Rate": 1.74,
        "Import Growth Rate": 1.7,
    },
    {
        "year": 1979,
        "Export Growth Rate": 1.77,
        "Import Growth Rate": 1.67,
    },
    {
        "year": 1980,
        "Export Growth Rate": 1.79,
        "Import Growth Rate": 1.7,
    },
    {
        "year": 1981,
        "Export Growth Rate": 1.81,
        "Import Growth Rate": 1.72,
    },
    {
        "year": 1982,
        "Export Growth Rate": 1.84,
        "Import Growth Rate": 1.73,
    },
    {
        "year": 1983,
        "Export Growth Rate": 1.77,
        "Import Growth Rate": 1.73,
    },
    {
        "year": 1984,
        "Export Growth Rate": 1.78,
        "Import Growth Rate": 1.78,
    },
    {
        "year": 1985,
        "Export Growth Rate": 1.78,
        "Import Growth Rate": 1.81,
    },
    {
        "year": 1986,
        "Export Growth Rate": 1.82,
        "Import Growth Rate": 1.89,
    },
    {
        "year": 1987,
        "Export Growth Rate": 1.82,
        "Import Growth Rate": 1.91,
    },
    {
        "year": 1988,
        "Export Growth Rate": 1.77,
        "Import Growth Rate": 1.94,
    },
    {
        "year": 1989,
        "Export Growth Rate": 1.76,
        "Import Growth Rate": 1.94,
    },
    {
        "year": 1990,
        "Export Growth Rate": 1.75,
        "Import Growth Rate": 1.97,
    },
    {
        "year": 1991,
        "Export Growth Rate": 1.62,
        "Import Growth Rate": 1.99,
    },
    {
        "year": 1992,
        "Export Growth Rate": 1.56,
        "Import Growth Rate": 2.12,
    },
    {
        "year": 1993,
        "Export Growth Rate": 1.5,
        "Import Growth Rate": 2.13,
    },
    {
        "year": 1994,
        "Export Growth Rate": 1.46,
        "Import Growth Rate": 2.15,
    },
    {
        "year": 1995,
        "Export Growth Rate": 1.43,
        "Import Growth Rate": 2.17,
    },
    {
        "year": 1996,
        "Export Growth Rate": 1.4,
        "Import Growth Rate": 2.2,
    },
    {
        "year": 1997,
        "Export Growth Rate": 1.37,
        "Import Growth Rate": 2.15,
    },
    {
        "year": 1998,
        "Export Growth Rate": 1.34,
        "Import Growth Rate": 2.07,
    },
    {
        "year": 1999,
        "Export Growth Rate": 1.32,
        "Import Growth Rate": 2.05,
    },
    {
        "year": 2000,
        "Export Growth Rate": 1.33,
        "Import Growth Rate": 2.07,
    },
    {
        "year": 2001,
        "Export Growth Rate": 1.31,
        "Import Growth Rate": 2.08,
    },
    {
        "year": 2002,
        "Export Growth Rate": 1.29,
        "Import Growth Rate": 2.1,
    },
    {
        "year": 2003,
        "Export Growth Rate": 1.27,
        "Import Growth Rate": 2.15,
    },
    {
        "year": 2004,
        "Export Growth Rate": 1.27,
        "Import Growth Rate": 2.21,
    },
    {
        "year": 2005,
        "Export Growth Rate": 1.26,
        "Import Growth Rate": 2.23,
    },
    {
        "year": 2006,
        "Export Growth Rate": 1.26,
        "Import Growth Rate": 2.29,
    },
    {
        "year": 2007,
        "Export Growth Rate": 1.27,
        "Import Growth Rate": 2.34,
    },
    {
        "year": 2008,
        "Export Growth Rate": 1.26,
        "Import Growth Rate": 2.36,
    },
    {
        "year": 2009,
        "Export Growth Rate": 1.26,
        "Import Growth Rate": 2.36,
    },
    {
        "year": 2010,
        "Export Growth Rate": 1.25,
        "Import Growth Rate": 2.35,
    },
    {
        "year": 2011,
        "Export Growth Rate": 1.24,
        "Import Growth Rate": 2.34,
    },
    {
        "year": 2012,
        "Export Growth Rate": 1.25,
        "Import Growth Rate": 2.39,
    },
    {
        "year": 2013,
        "Export Growth Rate": 1.22,
        "Import Growth Rate": 2.3,
    },
    {
        "year": 2014,
        "Export Growth Rate": 1.2,
        "Import Growth Rate": 2.35,
    },
    {
        "year": 2015,
        "Export Growth Rate": 1.17,
        "Import Growth Rate": 2.39,
    },
    {
        "year": 2016,
        "Export Growth Rate": 1.16,
        "Import Growth Rate": 2.41,
    },
    {
        "year": 2017,
        "Export Growth Rate": 1.13,
        "Import Growth Rate": 2.44,
    },
    {
        "year": 2018,
        "Export Growth Rate": 1.07,
        "Import Growth Rate": 2.45,
    },
    {
        "year": 2019,
        "Export Growth Rate": 1.03,
        "Import Growth Rate": 2.47,
    },
    {
        "year": 2020,
        "Export Growth Rate": 0.92,
        "Import Growth Rate": 2.48,
    },
    {
        "year": 2021,
        "Export Growth Rate": 0.82,
        "Import Growth Rate": 2.51,
    },
]
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div
            class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4"
        >
            <div class="p-6 flex justify-between">
                <h1 class="text-xl font-bold">
                    Welcome, {{ user.name }}
                </h1>
                <div>
                <div class=" relative mt-4 space-y-2 flex items-center gap-6">
                    <p class="m-0">
                        <strong>Referral Code: </strong>
                        <span>{{ user.referral_code }}</span>
                    </p>


                    <Button size="sm" class="" variant="outline" @click="copyReferralLink">{{ copied ? "✅ Copied!" : "Copy Link" }}</Button>
                </div>

                </div>
            </div>

                        <div class="grid gap-4 md:grid-cols-4">
                <!-- Card 1: Network Members -->
                <Card class="border border-border/60 rounded-xl transition-all hover:shadow-md hover:translate-y-0.5 duration-150">
                    <CardHeader class="flex flex-row items-center justify-between pb-1">
                        <div class="flex flex-col space-y-0.5">
                            <CardDescription class="text-sm">Network Members</CardDescription>
                            <CardTitle class="text-2xl font-bold">655</CardTitle>
                        </div>
                        <Users class="h-6 w-6 text-muted-foreground" />
                    </CardHeader>
                    <CardContent >
                        <p class="text-sm text-muted-foreground">6% referred by Admin</p>
                    </CardContent>
                </Card>

                <!-- Card 2: Members Income -->
                <Card class="border border-border/60 rounded-xl transition-all hover:shadow-md hover:translate-y-0.5 duration-150">
                    <CardHeader class="flex flex-row items-center justify-between pb-1">
                        <div class="flex flex-col space-y-0.5">
                            <CardDescription class="text-sm">Members Income</CardDescription>
                            <CardTitle class="text-2xl font-bold">$57,765.00</CardTitle>
                        </div>
                        <DollarSign class="h-6 w-6 text-muted-foreground" />
                    </CardHeader>
                    <CardContent class="pt-1">
                        <p class="text-sm text-muted-foreground">0% Payout done</p>
                    </CardContent>
                </Card>

                <!-- Card 3: Vouchers -->
                <Card class="border border-border/60 rounded-xl transition-all hover:shadow-md hover:translate-y-0.5 duration-150">
                    <CardHeader class="flex flex-row items-center justify-between pb-1">
                        <div class="flex flex-col space-y-0.5">
                            <CardDescription class="text-sm">Vouchers</CardDescription>
                            <CardTitle class="text-2xl font-bold">9</CardTitle>
                        </div>
                        <Ticket class="h-6 w-6 text-muted-foreground" />
                    </CardHeader>
                    <CardContent class="pt-1">
                        <p class="text-sm text-muted-foreground">Vouchers In System</p>
                    </CardContent>
                </Card>

                <!-- Card 4: Items In Mail Box -->
                <Card class="border border-border/60 rounded-xl transition-all hover:shadow-md hover:translate-y-0.5 duration-150">
                    <CardHeader class="flex flex-row items-center justify-between pb-1">
                        <div class="flex flex-col space-y-0.5">
                            <CardDescription class="text-sm">Items In Mail Box</CardDescription>
                            <CardTitle class="text-2xl font-bold">15</CardTitle>
                        </div>
                        <Mail class="h-6 w-6 text-muted-foreground" />
                    </CardHeader>
                    <CardContent class="pt-1">
                        <p class="text-sm text-muted-foreground">1 Unread Mail</p>
                    </CardContent>
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


            <!--            <div class="flex w-full gap-4 h-full">-->
<!--                <div-->
<!--                    class="relative w-6/12 min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 md:min-h-min dark:border-sidebar-border overflow-hidden"-->
<!--                >-->
<!--                    <AreaChart-->
<!--                        :data="data"-->
<!--                        index="name"-->
<!--                        :categories="['total', 'predicted']"-->
<!--                        :showXAxis="true"-->
<!--                        :showYAxis="true"-->
<!--                        yAxisWidth="40"-->
<!--                        xAxisHeight="40"-->
<!--                    />-->
<!--                    <PlaceholderPattern  />-->
<!--                </div>-->
<!--                <div-->
<!--                    class="relative w-6/12 min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 md:min-h-min dark:border-sidebar-border overflow-hidden"-->
<!--                >-->
<!--                    <LineChart-->
<!--                        :data="lineData"-->
<!--                        index="year"-->
<!--                        :categories="['Export Growth Rate', 'Import Growth Rate']"-->
<!--                        :y-formatter="(tick, i) => {-->
<!--      return typeof tick === 'number'-->
<!--        ? `$ ${new Intl.NumberFormat('us').format(tick).toString()}`-->
<!--        : ''-->
<!--    }"-->
<!--                    />-->
<!--                    <PlaceholderPattern  />-->
<!--                </div>-->
<!--            </div>-->




            <!--                        <div-->
<!--                class="relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 md:min-h-min dark:border-sidebar-border"-->
<!--            >-->
<!--                <PlaceholderPattern />-->
<!--            </div>-->
        </div>
    </AppLayout>
</template>
