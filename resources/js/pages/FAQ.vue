<script setup lang="ts">
import GuestLayout from '@/layouts/guest/GuestLayout.vue'
</script>

<template>
    <GuestLayout>
        <section class="max-w-5xl mx-auto py-20 px-6">
            <h1 class="text-4xl font-bold text-center mb-4">Frequently Asked Questions</h1>
            <p class="text-muted-foreground text-center max-w-2xl mx-auto mb-12">
                Find quick answers to some of the most common questions about our platform and services.
            </p>

            <div class="space-y-6">
                <div class="p-6 rounded-2xl border bg-card shadow-sm hover:shadow-md transition">
                    <h3 class="text-lg font-semibold mb-2">How does World Digital Payment work?</h3>
                    <p class="text-muted-foreground">
                        We connect users to a smart investment platform where you can grow your income
                        through verified opportunities with transparent payout systems.
                    </p>
                </div>

                <div class="p-6 rounded-2xl border bg-card shadow-sm hover:shadow-md transition">
                    <h3 class="text-lg font-semibold mb-2">Are my payments secure?</h3>
                    <p class="text-muted-foreground">
                        Absolutely! We use modern encryption technologies to ensure every transaction is safe
                        and your funds are protected.
                    </p>
                </div>

                <div class="p-6 rounded-2xl border bg-card shadow-sm hover:shadow-md transition">
                    <h3 class="text-lg font-semibold mb-2">Can I withdraw funds anytime?</h3>
                    <p class="text-muted-foreground">
                        Yes, withdrawals are processed daily and can be requested anytime through your account dashboard.
                    </p>
                </div>
            </div>
        </section>
    </GuestLayout>
</template>
