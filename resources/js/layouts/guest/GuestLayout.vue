<script setup lang="ts">
import { login, register, dashboard } from '@/routes';
import AppLogoIcon from '@/components/AppLogoIcon.vue';
import { Link, usePage } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';
import { Moon, Play, Sun } from 'lucide-vue-next';
import { NavigationMenu } from '@/components/ui/navigation-menu';
import { useAppearance } from '@/composables/useAppearance';

const { appearance, updateAppearance } = useAppearance();
const page = usePage();
// Theme management
const toggleTheme = () => {
    updateAppearance(appearance.value === "dark" ? "light" : "dark")
}
</script>
<template>
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

                    <!-- ✅ Conditional Auth Buttons / Dashboard -->
                    <template v-if="!$page.props.auth?.user">
                        <Link :href="login()">
                            <Button variant="outline">Login</Button>
                        </Link>
                        <Link :href="register()">
                            <Button class="bg-gradient-to-r from-[#249dd8] via-blue-400 to-[#249dd8] text-white hover:opacity-90">
                                Join Us
                            </Button>
                        </Link>
                    </template>

                    <template v-else>
                        <Link :href="dashboard()">
                            <Button variant="default" class="bg-gradient-to-r from-[#249dd8] via-blue-400 to-[#249dd8] text-white hover:opacity-90"  >Dashboard</Button>
                        </Link>
                    </template>
                </div>

            </nav>

            <!-- Hero Section -->
           <slot name="hero-section" />
        </header>


        <slot/>

        <footer class="bg-black text-gray-300 border-t border-gray-800">
            <div class="w-11/12 mx-auto py-12 grid grid-cols-1 md:grid-cols-4 gap-10">
                <!-- Logo and Description -->
                <div>
                    <div class="flex items-center gap-2 mb-3">
                        <AppLogoIcon class="w-8 h-8" />
                        <h3 class="text-xl font-semibold text-white">World Digital Payment</h3>
                    </div>
                    <p class="text-sm text-gray-400 leading-relaxed">
                        A worldwide investment platform helping you grow your wealth through
                        smart and secure strategies.
                    </p>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-white font-semibold mb-3">Quick Links</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="/" class="hover:text-blue-500">Home</a></li>
                        <li><a href="/about" class="hover:text-blue-500">About</a></li>
                        <li><a href="/invest" class="hover:text-blue-500">Invest</a></li>
                        <li><a href="/blog" class="hover:text-blue-500">Blog</a></li>
                        <li><a href="/contact" class="hover:text-blue-500">Contact</a></li>
                    </ul>
                </div>

                <!-- Support -->
                <div>
                    <h4 class="text-white font-semibold mb-3">Support</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="/faq" class="hover:text-blue-500">FAQ</a></li>
                        <li><a href="/privacy" class="hover:text-blue-500">Privacy Policy</a></li>
                        <li><a href="/terms" class="hover:text-blue-500">Terms & Conditions</a></li>
                    </ul>
                </div>

                <!-- Social Links -->
                <div>
                    <h4 class="text-white font-semibold mb-3">Follow Us</h4>
                    <div class="flex gap-3">
                        <a href="#" class="p-2 rounded-full bg-gray-800 hover:bg-blue-600 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 2H6a2 2 0 00-2 2v16a2 2 0 002 2h6v-7h-2v-3h2V9a4 4 0 014-4h3v3h-2a1 1 0 00-1 1v2h3l-1 3h-2v7h3a2 2 0 002-2V4a2 2 0 00-2-2z" />
                            </svg>
                        </a>
                        <a href="#" class="p-2 rounded-full bg-gray-800 hover:bg-blue-600 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23 3a10.9 10.9 0 01-3.14 1.53A4.48 4.48 0 0016 2a4.48 4.48 0 00-4.47 4.47c0 .35.04.7.11 1.03A12.94 12.94 0 013 4s-4 9 5 13a13.14 13.14 0 01-8 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- 👇 Ye hoga apka existing chhota footer -->
            <div class="border-t border-gray-800 text-center py-4 text-sm text-gray-500">
                © 2025 <span class="text-blue-500">World Digital Payment</span>. All rights reserved.
            </div>
        </footer>

<!--        <footer class="py-6 text-center text-sm text-muted-foreground border-t w-full">-->
<!--            © {{ new Date().getFullYear() }} World Digital Payment. All rights reserved.-->
<!--        </footer>-->
    </div>
</template>
