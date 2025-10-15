<script setup lang="ts">
import AppLogoIcon from '@/components/AppLogoIcon.vue';
import { login, register } from '@/routes';
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
import { NavigationMenu } from '@/components/ui/navigation-menu';


const { appearance, updateAppearance } = useAppearance();

// Theme management
const toggleTheme = () => {
    console.log(appearance.value);
    updateAppearance(appearance.value === "dark" ? "light" : "dark")
}

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
    <div class="flex flex-col min-h-screen bg-background text-foreground items-center">
        <!-- Header -->
        <header class="border-b bg-background w-11/12">
            <!-- Main Navbar -->
            <nav class="flex items-center justify-between py-4">
                <!-- Logo -->
                <div class="flex items-center gap-2">
                    <AppLogoIcon class="w-10" />
                </div>

                <!-- Navigation Menu -->
                <NavigationMenu class="hidden md:flex gap-6">
                    <NavigationMenuItem>
                        <Link href="/" class="text-sm font-medium hover:text-primary transition">Home</Link>
                    </NavigationMenuItem>
                    <NavigationMenuItem>
                        <Link href="/about" class="text-sm font-medium hover:text-primary transition">About</Link>
                    </NavigationMenuItem>
                    <NavigationMenuItem>
                        <Link href="/invest" class="text-sm font-medium hover:text-primary transition">Invest</Link>
                    </NavigationMenuItem>
                    <NavigationMenuItem>
                        <Link href="/pages" class="text-sm font-medium hover:text-primary transition">Pages</Link>
                    </NavigationMenuItem>
                    <NavigationMenuItem>
                        <Link href="/blog" class="text-sm font-medium hover:text-primary transition">Blog</Link>
                    </NavigationMenuItem>
                    <NavigationMenuItem>
                        <Link href="/contact" class="text-sm font-medium hover:text-primary transition">Contact</Link>
                    </NavigationMenuItem>
                </NavigationMenu>

                <!-- Right Section -->
                <div class="flex items-center gap-3">
                    <!-- Theme Toggle -->
                    <Button variant="ghost" size="icon" @click="toggleTheme">
                        <Sun v-if="appearance === 'dark'" class="h-5 w-5" />
                        <Moon v-else class="h-5 w-5" />
                    </Button>

                    <!-- Auth Buttons -->
                    <Link :href="login()">
                        <Button variant="outline">Login</Button>
                    </Link>
                    <Link :href="register()">
                        <Button class="bg-gradient-to-r from-blue-600 to-purple-600 text-white hover:opacity-90">
                            Join Us
                        </Button>
                    </Link>
                </div>
            </nav>

            <!-- Hero Section -->
            <section class="container flex flex-col-reverse md:flex-row items-center justify-between py-20 gap-12 min-h-[88vh]">
                <!-- Text -->
                <div class="flex-1 text-center md:text-left">
                    <h5 class="text-sm uppercase tracking-wide text-orange-500 font-semibold mb-2">
                        Get Ultimate Profit
                    </h5>
                    <h1 class="text-4xl md:text-5xl font-extrabold leading-tight mb-4">
                        Build Your Future <br />
                        <span class="text-primary">With Investments</span>
                    </h1>
                    <p class="text-muted-foreground max-w-md mb-6">
                        We are a worldwide investment company committed to maximizing revenue and reducing financial risk — helping you grow with confidence.
                    </p>

                    <div class="flex justify-center md:justify-start gap-4">
                        <Button class="bg-gradient-to-r from-blue-600 to-purple-600 text-white hover:opacity-90">
                            Get Started
                        </Button>
                        <Button variant="outline" class="flex items-center gap-2">
                            <Play class="w-4 h-4" /> Watch Video
                        </Button>
                    </div>
                </div>
                <div class="flex-1 text-center md:text-left">
                    <img class="dark:hidden" src="/assets/images/hero-image.png" alt="">
                    <img class="hidden dark:block" src="/assets/images/hero-image-dark.png" alt="">
                </div>
            </section>
        </header>
        <!-- Features Section -->
        <section class="py-20 container text-center">
            <h2 class="text-3xl font-bold mb-8">Why Choose Us?</h2>
            <div class="grid gap-8 md:grid-cols-3 justify-center">
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

        <!-- Investment Plans -->
        <section class="py-20 bg-muted w-full">
            <div class="container text-center mx-auto">
                <h2 class="text-3xl font-bold mb-8">Investment Plans</h2>
                <div class="grid gap-8 md:grid-cols-3">
                    <Card>
                        <CardHeader>
                            <h3 class="text-xl font-bold">Starter</h3>
                            <p class="text-gray-600">$50 – $4,000</p>
                        </CardHeader>
                        <CardContent>
                            <p class="text-3xl font-bold text-blue-600">1.1% Daily</p>
                        </CardContent>
                        <CardFooter class="flex justify-center">
                            <Link href="/register">
                                <Button>Invest Now</Button>
                            </Link>
                        </CardFooter>
                    </Card>

                    <Card>
                        <CardHeader>
                            <h3 class="text-xl font-bold">Silver</h3>
                            <p class="text-gray-600">$5,000 – $9,000</p>
                        </CardHeader>
                        <CardContent>
                            <p class="text-3xl font-bold text-blue-600">1.25% Daily</p>
                        </CardContent>
                        <CardFooter class="flex justify-center">
                            <Link href="/register">
                                <Button>Invest Now</Button>
                            </Link>
                        </CardFooter>
                    </Card>

                    <Card>
                        <CardHeader>
                            <h3 class="text-xl font-bold">Gold</h3>
                            <p class="text-gray-600">$10,000+</p>
                        </CardHeader>
                        <CardContent>
                            <p class="text-3xl font-bold text-blue-600">1.5% Daily</p>
                        </CardContent>
                        <CardFooter class="flex justify-center">
                            <Link href="/register">
                                <Button>Invest Now</Button>
                            </Link>
                        </CardFooter>
                    </Card>
                </div>
            </div>
        </section>

        <!-- Referral Levels -->
        <section class="py-20 container text-center">
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
            <div class="container text-center mx-auto">
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
                            <p class="font-bold text-blue-600">
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

        <!-- Footer -->
        <footer class="py-6 text-center text-sm text-muted-foreground border-t w-full">
            © {{ new Date().getFullYear() }} World Digital Payment. All rights reserved.
        </footer>
    </div>
</template>

<style scoped></style>
