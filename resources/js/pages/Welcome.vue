<script setup lang="ts">
import AppLogoIcon from '@/components/AppLogoIcon.vue';
import { login, register } from '@/routes';
import { CheckCircle } from "lucide-vue-next";
import { Head, Link } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';
import {
    Card,
    CardContent,
    CardFooter,
    CardHeader,
} from '@/components/ui/card';
import { Sun, Moon, Play } from "lucide-vue-next"
import { useAppearance } from '@/composables/useAppearance';
import GuestLayout from '@/layouts/guest/GuestLayout.vue';

const levels = [20, 15, 10, 10, 5, 3, 3, 3, 3, 3];
const rewards = [
    { volume: 10000, bonus: '$250 Bonus' },
    { volume: 25000, bonus: '$750 Bonus' },
    { volume: 50000, bonus: '$1,500 Bonus' },
    { volume: 100000, bonus: '$3,000 Bonus' },
    { volume: 500000, bonus: '$7,500 Bonus' },
    { volume: 1000000, bonus: '$18,000 Bonus' },
];
</script>

<template>
    <Head title="World Digital Payment">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>

        <GuestLayout>
            <template #hero-section>
                <section
                    class=" flex flex-col-reverse md:flex-row items-center justify-between py-20 gap-12 min-h-[88vh]">
                    <!-- Text -->
                    <div class="flex-1 text-center md:text-left">
                        <h5 class="text-sm uppercase tracking-wide text-[#249dd8] font-semibold mb-2">
                            Get Ultimate Profit
                        </h5>
                        <h1 class="text-4xl md:text-5xl font-extrabold leading-tight mb-4">
                            Build Your Future <br />
                            <span class="text-primary">With Investments</span>
                        </h1>
                        <p class="text-muted-foreground max-w-md mb-6">
                            We are a worldwide investment company committed to maximizing revenue and reducing financial
                            risk — helping you grow with confidence.
                        </p>

                        <div class="flex justify-center md:justify-start gap-4">
                            <Button
                                class="bg-gradient-to-r from-[#249dd8] via-blue-400 to-[#249dd8] text-white hover:opacity-90">
                                Get Started
                            </Button>
                            <Button variant="outline" class="flex items-center gap-2">
                                <Play class="w-4 h-4" />
                                Watch Video
                            </Button>
                        </div>
                    </div>
                    <div class="flex-1 text-center md:text-left">
                        <img src="/assets/images/hero-image.png" alt="">
                    </div>
                </section>
            </template>
            <section class="py-20 w-11/12 text-center">
                <h2 class="text-3xl font-bold mb-8">Why Choose Us?</h2>
                <div class="grid gap-8 md:grid-cols-3 justify-center  ">
                    <Card>
                        <CardHeader>
                            <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" class="mx-auto mb-4 w-16" />
                        </CardHeader>
                        <CardContent>
                            <h3 class="text-xl font-semibold mb-2">Daily ROI</h3>
                            <p>Earn 1.1%–1.5% returns daily (Mon–Fri) on your investments.</p>
                        </CardContent>
                    </Card>

                    <Card>
                        <CardHeader>
                            <img src="https://cdn-icons-png.flaticon.com/512/1048/1048941.png" class="mx-auto mb-4 w-16" />
                        </CardHeader>
                        <CardContent>
                            <h3 class="text-xl font-semibold mb-2">Referral Income</h3>
                            <p>Build your network and earn from up to 10 levels of referrals.</p>
                        </CardContent>
                    </Card>

                    <Card>
                        <CardHeader>
                            <img src="https://cdn-icons-png.flaticon.com/512/2920/2920323.png" class="mx-auto mb-4 w-16" />
                        </CardHeader>
                        <CardContent>
                            <h3 class="text-xl font-semibold mb-2">Global Rewards</h3>
                            <p>Unlock bonuses and luxury tours as your team grows.</p>
                        </CardContent>
                    </Card>
                </div>
            </section>


            <!-- WDP Crypto Card Section -->
            <section class="py-20 w-full transition-colors duration-300">
                <div class="w-11/12 mx-auto flex flex-col md:flex-row items-center gap-12">
                    <!-- Left: Text -->
                    <div class="flex-1 text-center md:text-left space-y-6">
                        <h2 class="text-3xl md:text-4xl font-extrabold mb-4 text-black dark:text-white">
                            Experience Smart Payments with <span class="text-[#249dd8]">WDP Crypto Card</span>
                        </h2>
                        <p class="text-muted-foreground  mb-6">
                            Spend, shop, and pay bills anywhere in India with secure transactions, instant balance updates, and exclusive cashback rewards.
                        </p>

                        <ul class="space-y-4 text-left md:text-left">
                            <li class="flex items-center gap-3 text-base md:text-lg  text-gray-800 dark:text-gray-200">
                                <CheckCircle class="w-6 h-6 text-[#249dd8]"/>
                                Freedom to Pay Anywhere: Top up your wallet in seconds and pay at any store or online platform.
                            </li>
                            <li class="flex items-center gap-3 text-base md:text-lg  text-gray-800 dark:text-gray-200">
                                <CheckCircle class="w-6 h-6 text-[#249dd8]"/>
                                Earn While You Pay: Get exclusive discounts, cashback, and referral bonuses on every transaction.
                            </li>
                            <li class="flex items-center gap-3 text-base md:text-lg  text-gray-800 dark:text-gray-200">
                                <CheckCircle class="w-6 h-6 text-[#249dd8]"/>
                                One Card. Unlimited Possibilities: Shop, pay bills, and manage your money digitally with ease.
                            </li>
                            <li class="flex items-center gap-3 text-base md:text-lg  text-gray-800 dark:text-gray-200">
                                <CheckCircle class="w-6 h-6 text-[#249dd8]"/>
                                Your Money, Your Way: Top up, withdraw, or pay anytime, anywhere — fully under your control.
                            </li>
                            <li class="flex items-center gap-3 text-base md:text-lg  text-gray-800 dark:text-gray-200">
                                <CheckCircle class="w-6 h-6 text-[#249dd8]"/>
                                Shop More, Earn More: Every transaction brings you closer to exciting rewards and bonuses.
                            </li>
                        </ul>

                        <div class="mt-8">
                            <Link href="/register">
                                <Button class="bg-gradient-to-r from-[#249dd8] via-blue-400 to-[#249dd8] text-white hover:opacity-90">
                                    Get Your WDP Card
                                </Button>
                            </Link>
                        </div>
                    </div>

                    <!-- Right: Single Card Image with theme-based background -->
                    <div class="flex-1 text-center md:text-right">
                        <div class="inline-block p-4 rounded-xl bg-white dark:bg-black transition-colors duration-300">
                            <img src="/assets/images/crypto-card.png" class="w-72 md:w-[70%] mx-auto" alt="WDP Crypto Card">
                        </div>
                    </div>
                </div>
            </section>




            <!-- Investment Plans -->
            <section class="py-20 bg-muted w-full">
                <div class="w-11/12 text-center mx-auto">
                    <h2 class="text-3xl font-bold mb-8">Investment Plans</h2>
                    <div class="grid gap-8 md:grid-cols-3">
                        <!-- Starter Card -->
                        <Card class="p-6 space-y-4 text-center shadow-md rounded-2xl">
                            <CardHeader class="space-y-2">
                                <h3 class="text-2xl font-bold">Starter</h3>
                                <p class="text-gray-600 text-base">$50 – $4,000</p>
                            </CardHeader>

                            <CardContent class="pt-2 pb-4">
                                <p class="text-3xl font-bold text-[#249dd8]">1.0% Daily</p>
                            </CardContent>

                            <CardFooter class="flex justify-center pt-2">
                                <Link href="/register">
                                    <Button class="px-6 py-2 text-base">Invest Now</Button>
                                </Link>
                            </CardFooter>
                        </Card>

                        <!-- Silver Card -->
                        <Card class="p-6 space-y-4 text-center shadow-md rounded-2xl">
                            <CardHeader class="space-y-2">
                                <h3 class="text-2xl font-bold">Silver</h3>
                                <p class="text-gray-600 text-base">$5,000 – $9,000</p>
                            </CardHeader>

                            <CardContent class="pt-2 pb-4">
                                <p class="text-3xl font-bold text-[#249dd8]">1.25% Daily</p>
                            </CardContent>

                            <CardFooter class="flex justify-center pt-2">
                                <Link href="/register">
                                    <Button class="px-6 py-2 text-base">Invest Now</Button>
                                </Link>
                            </CardFooter>
                        </Card>

                        <!-- Gold Card -->
                        <Card class="p-6 space-y-4 text-center shadow-md rounded-2xl">
                            <CardHeader class="space-y-2">
                                <h3 class="text-2xl font-bold">Gold</h3>
                                <p class="text-gray-600 text-base">$10,000+</p>
                            </CardHeader>

                            <CardContent class="pt-2 pb-4">
                                <p class="text-3xl font-bold text-[#249dd8]">1.50% Daily</p>
                            </CardContent>

                            <CardFooter class="flex justify-center pt-2">
                                <Link href="/register">
                                    <Button class="px-6 py-2 text-base">Invest Now</Button>
                                </Link>
                            </CardFooter>
                        </Card>
                    </div>
                </div>
            </section>
            <!-- Referral Levels -->
            <section class="py-20 w-11/12 text-center">
                <h2 class="text-3xl font-bold mb-8">Referral Income Levels</h2>
                <p class="max-w-2xl mx-auto mb-6">
                    Earn passive income from your team's success. Receive level-based ROI commissions up to 10 levels.
                </p>
                <div class="grid gap-4 text-sm font-semibold text-muted-foreground md:grid-cols-5">
                    <div
                        v-for="(level, i) in levels"
                        :key="i"
                        class="rounded-xl border bg-card text-card-foreground p-3 shadow-sm"
                    >
                        Level {{ i + 1 }} — {{ level }}%
                    </div>
                </div>
            </section>

            <!-- Rewards -->
            <section class="py-20 bg-muted w-full">
                <div class="w-11/12 text-center mx-auto">
                    <h2 class="text-3xl font-bold mb-8">Exclusive Rewards</h2>
                    <div class="grid gap-8 md:grid-cols-3">
                        <Card
                            v-for="(reward, i) in rewards"
                            :key="i"
                            class="transition hover:shadow-md"
                        >
                            <CardContent>
                                <h3 class="mb-2 text-lg font-semibold">
                                    ${{ reward.volume.toLocaleString() }} Team Volume
                                </h3>
                                <p class="font-bold text-[#249dd8]">
                                    {{ reward.bonus }}
                                </p>
                            </CardContent>
                        </Card>
                    </div>
                </div>
            </section>

            <!-- CTA -->
            <section class="py-20 text-center w-full">
                <h2 class="text-3xl font-bold mb-4">Ready to Start Your Journey?</h2>
                <p class="mb-8 text-lg">
                    Join thousands of investors earning daily passive income.
                </p>
                <Link href="/register">
                    <Button variant="secondary" class=" font-semibold">
                        Get Started Now
                    </Button>
                </Link>
            </section>


        </GuestLayout>

        <!-- Features Section -->


</template>

<style scoped></style>
