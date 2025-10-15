<script setup lang="ts">
import { dashboard, login, register } from '@/routes';
import { Head, Link } from '@inertiajs/vue3';

const levels = [20, 15, 10, 10, 5, 3, 3, 3, 3, 3, 1.1, 1.1, 1.1, 1.1, 1.1]
const rewards = [
    { volume: 10000, bonus: "$250 Bonus" },
    { volume: 25000, bonus: "$750 Bonus" },
    { volume: 50000, bonus: "$1,500 Bonus" },
    { volume: 100000, bonus: "$3,000 Bonus" },
    { volume: 500000, bonus: "$7,500 Bonus" },
    { volume: 1000000, bonus: "$18,000 Bonus" },
]
</script>

<template>
    <Head title="Welcome">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>
    <div
        class="flex flex-col items-center bg-[#FDFDFC] text-[#1b1b18] lg:justify-center dark:bg-[#0a0a0a]"
    >
        <header
            class="mb-6 w-full text-sm not-has-[nav]:hidden"
        >
            <nav class="flex items-center justify-end gap-4">
                <Link
                    v-if="$page.props.auth.user"
                    :href="dashboard()"
                    class="inline-block rounded-sm border border-[#19140035] px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a] dark:border-[#3E3E3A] dark:text-[#EDEDEC] dark:hover:border-[#62605b]"
                >
                    Dashboard
                </Link>
                <template v-else>
                    <Link
                        :href="login()"
                        class="inline-block rounded-sm border border-transparent px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#19140035] dark:text-[#EDEDEC] dark:hover:border-[#3E3E3A]"
                    >
                        Log in
                    </Link>
                    <Link
                        :href="register()"
                        class="inline-block rounded-sm border border-[#19140035] px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a] dark:border-[#3E3E3A] dark:text-[#EDEDEC] dark:hover:border-[#62605b]"
                    >
                        Register
                    </Link>
                </template>
            </nav>
        </header>
        <div
            class="flex w-full items-center justify-center opacity-100 transition-opacity duration-750 lg:grow starting:opacity-0"
        >
            <main
                class="flex w-full flex-col-reverse overflow-hidden rounded-lg lg:flex-row"
            >
                <div class="bg-gray-50 text-gray-800 w-full">
                    <!-- Hero Section -->
                    <section class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white py-20">
                        <div class="max-w-6xl mx-auto text-center px-6">
                            <h1 class="text-4xl md:text-5xl font-extrabold mb-4">
                                Grow Your Wealth with <span class="text-yellow-300">World Digital Payment</span>
                            </h1>
                            <p class="text-lg mb-8 max-w-2xl mx-auto">
                                Earn daily ROI, unlock referral rewards, and achieve financial freedom with a transparent and automated platform.
                            </p>
                            <div class="flex justify-center gap-4">
                                <Link
                                    href="/register"
                                    class="bg-yellow-400 text-gray-900 px-6 py-3 rounded-xl font-semibold hover:bg-yellow-500 transition"
                                >
                                    Get Started
                                </Link>
                                <Link
                                    href="/login"
                                    class="bg-white/20 border border-white/40 px-6 py-3 rounded-xl font-semibold hover:bg-white/30 transition"
                                >
                                    Login
                                </Link>
                            </div>
                        </div>
                    </section>

                    <!-- Features Section -->
                    <section class="py-16">
                        <div class="max-w-6xl mx-auto px-6 text-center">
                            <h2 class="text-3xl font-bold mb-8">Why Choose Us?</h2>
                            <div class="grid md:grid-cols-3 gap-8">
                                <div class="p-6 bg-white rounded-2xl shadow hover:shadow-lg transition">
                                    <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" class="w-16 mx-auto mb-4" />
                                    <h3 class="font-semibold text-xl mb-2">Daily ROI</h3>
                                    <p>Earn 1.1%–1.5% returns daily (Mon–Fri) on your investments.</p>
                                </div>
                                <div class="p-6 bg-white rounded-2xl shadow hover:shadow-lg transition">
                                    <img src="https://cdn-icons-png.flaticon.com/512/1048/1048941.png" class="w-16 mx-auto mb-4" />
                                    <h3 class="font-semibold text-xl mb-2">Referral Income</h3>
                                    <p>Build your network and earn from up to 15 levels of referrals.</p>
                                </div>
                                <div class="p-6 bg-white rounded-2xl shadow hover:shadow-lg transition">
                                    <img src="https://cdn-icons-png.flaticon.com/512/2920/2920323.png" class="w-16 mx-auto mb-4" />
                                    <h3 class="font-semibold text-xl mb-2">Global Rewards</h3>
                                    <p>Unlock bonuses and luxury tours as your team grows.</p>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- ROI Plans -->
                    <section class="py-16 bg-blue-50">
                        <div class="max-w-6xl mx-auto px-6 text-center">
                            <h2 class="text-3xl font-bold mb-8">Investment Plans</h2>
                            <div class="grid md:grid-cols-3 gap-8">
                                <div class="bg-white p-6 rounded-2xl shadow">
                                    <h3 class="text-xl font-bold mb-2">Starter</h3>
                                    <p class="text-gray-600 mb-4">$50 – $4,000</p>
                                    <p class="text-3xl font-bold text-blue-600 mb-4">1.1% Daily</p>
                                    <Link href="/register" class="bg-blue-600 text-white px-6 py-2 rounded-xl hover:bg-blue-700 transition">
                                        Invest Now
                                    </Link>
                                </div>
                                <div class="bg-white p-6 rounded-2xl shadow">
                                    <h3 class="text-xl font-bold mb-2">Silver</h3>
                                    <p class="text-gray-600 mb-4">$5,000 – $9,000</p>
                                    <p class="text-3xl font-bold text-blue-600 mb-4">1.25% Daily</p>
                                    <Link href="/register" class="bg-blue-600 text-white px-6 py-2 rounded-xl hover:bg-blue-700 transition">
                                        Invest Now
                                    </Link>
                                </div>
                                <div class="bg-white p-6 rounded-2xl shadow">
                                    <h3 class="text-xl font-bold mb-2">Gold</h3>
                                    <p class="text-gray-600 mb-4">$10,000+</p>
                                    <p class="text-3xl font-bold text-blue-600 mb-4">1.5% Daily</p>
                                    <Link href="/register" class="bg-blue-600 text-white px-6 py-2 rounded-xl hover:bg-blue-700 transition">
                                        Invest Now
                                    </Link>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Referral Levels -->
                    <section class="py-16">
                        <div class="max-w-6xl mx-auto px-6 text-center">
                            <h2 class="text-3xl font-bold mb-8">Referral Income Levels</h2>
                            <p class="max-w-2xl mx-auto mb-6">
                                Earn passive income from your team's success. Receive level-based ROI commissions up to 15 levels.
                            </p>
                            <div class="grid md:grid-cols-5 gap-4 text-sm font-semibold text-gray-700">
                                <div v-for="(level, i) in levels" :key="i" class="p-3 bg-white rounded-xl shadow">
                                    Level {{ i + 1 }} — {{ level }}%
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Rewards Section -->
                    <section class="py-16 bg-gray-100">
                        <div class="max-w-6xl mx-auto px-6 text-center">
                            <h2 class="text-3xl font-bold mb-8">Exclusive Rewards</h2>
                            <div class="grid md:grid-cols-3 gap-8">
                                <div v-for="(reward, i) in rewards" :key="i" class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition">
                                    <h3 class="font-semibold text-lg mb-2">${{ reward.volume.toLocaleString() }} Team Volume</h3>
                                    <p class="text-blue-600 font-bold mb-1">{{ reward.bonus }}</p>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- CTA -->
                    <section class="py-16 bg-blue-700 text-white text-center">
                        <h2 class="text-3xl font-bold mb-4">Ready to Start Your Journey?</h2>
                        <p class="mb-8 text-lg">Join thousands of investors earning daily passive income.</p>
                        <Link
                            href="/register"
                            class="bg-yellow-400 text-gray-900 px-8 py-3 rounded-xl font-semibold hover:bg-yellow-500 transition"
                        >
                            Get Started Now
                        </Link>
                    </section>

                    <!-- Footer -->
                    <footer class="py-6 text-center text-gray-500 text-sm bg-gray-50">
                        © {{ new Date().getFullYear() }} World Digital Payment. All rights reserved.
                    </footer>
                </div>
            </main>
        </div>
        <div class="hidden h-14.5 lg:block"></div>
    </div>
</template>
