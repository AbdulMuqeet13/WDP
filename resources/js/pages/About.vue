<script setup lang="ts">
import { Button } from "@/components/ui/button";
import { Card, CardContent, CardHeader, CardTitle } from "@/components/ui/card";
import GuestLayout from '../layouts/guest/GuestLayout.vue'

</script>

<template>
    <GuestLayout>
        <div class="min-h-screen w-11/12 mx-auto bg-background text-foreground transition-colors duration-300">
            <!-- Hero Section -->
            <section class="pt-24 pb-16 text-center">
                <h1 class="text-4xl font-bold mb-4">About World Digital Payment</h1>
                <p class="text-muted-foreground text-lg">
                    We are a global investment company committed to helping individuals and businesses
                    grow their wealth through smart, sustainable investment strategies.
                </p>
                <div class="mt-6 flex justify-center gap-3">
                    <Button>Get Started</Button>
                    <Button variant="outline">Contact Us</Button>
                </div>
            </section>

            <!-- Mission Section -->
            <section class="py-16 bg-muted/40 dark:bg-muted/10">
                <div class="mx-auto grid md:grid-cols-2 gap-10 items-center">
                    <div>
                        <h2 class="text-3xl font-semibold mb-4">Our Mission</h2>
                        <p class="text-muted-foreground leading-relaxed">
                            Our mission is to make investing accessible and profitable for everyone.
                            We strive to minimize financial risks and maximize returns by using advanced
                            technology, data analysis, and expert management strategies.
                        </p>
                    </div>
                    <div class="flex justify-center">
<!--                        <img-->
<!--                            src="/images/mission.svg"-->
<!--                            alt="Mission Illustration"-->
<!--                            class="w-80 h-auto"-->
<!--                        />-->
                    </div>
                </div>
            </section>

            <!-- Stats Section -->
            <section class="py-16 text-center">
                <h2 class="text-3xl font-semibold mb-10">Our Impact</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    <Card class="shadow-md">
                        <CardContent class="pt-6">
                            <h3 class="text-3xl font-bold">25K+</h3>
                            <p class="text-muted-foreground text-sm">Active Investors</p>
                        </CardContent>
                    </Card>
                    <Card class="shadow-md">
                        <CardContent class="pt-6">
                            <h3 class="text-3xl font-bold">$15M+</h3>
                            <p class="text-muted-foreground text-sm">Total Payouts</p>
                        </CardContent>
                    </Card>
                    <Card class="shadow-md">
                        <CardContent class="pt-6">
                            <h3 class="text-3xl font-bold">10+</h3>
                            <p class="text-muted-foreground text-sm">Countries Served</p>
                        </CardContent>
                    </Card>
                    <Card class="shadow-md">
                        <CardContent class="pt-6">
                            <h3 class="text-3xl font-bold">5 Years</h3>
                            <p class="text-muted-foreground text-sm">Industry Experience</p>
                        </CardContent>
                    </Card>
                </div>
            </section>

            <!-- Team Section -->
            <section class="py-16 bg-muted/40 dark:bg-muted/10">
                <div class="mx-auto text-center">
                    <h2 class="text-3xl font-semibold mb-12">Meet Our Leadership</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                        <Card class="shadow-lg">
                            <CardHeader>
<!--                                <img-->
<!--                                    src="/images/team1.jpg"-->
<!--                                    alt="Team Member"-->
<!--                                    class="rounded-full w-24 h-24 mx-auto mb-4 object-cover"-->
<!--                                />-->
                                <CardTitle>Sarah Mitchell</CardTitle>
                                <p class="text-muted-foreground text-sm">Chief Executive Officer</p>
                            </CardHeader>
                        </Card>
                        <Card class="shadow-lg">
                            <CardHeader>
<!--                                <img-->
<!--                                    src="/images/team2.jpg"-->
<!--                                    alt="Team Member"-->
<!--                                    class="rounded-full w-24 h-24 mx-auto mb-4 object-cover"-->
<!--                                />-->
                                <CardTitle>John Carter</CardTitle>
                                <p class="text-muted-foreground text-sm">Chief Investment Officer</p>
                            </CardHeader>
                        </Card>
                        <Card class="shadow-lg">
                            <CardHeader>
<!--                                <img-->
<!--                                    src="/images/team3.jpg"-->
<!--                                    alt="Team Member"-->
<!--                                    class="rounded-full w-24 h-24 mx-auto mb-4 object-cover"-->
<!--                                />-->
                                <CardTitle>Lisa Wong</CardTitle>
                                <p class="text-muted-foreground text-sm">Head of Partnerships</p>
                            </CardHeader>
                        </Card>
                    </div>
                </div>
            </section>

            <!-- CTA -->
            <section class="py-16 text-center">
                <h2 class="text-3xl font-semibold mb-4">Ready to Grow With Us?</h2>
                <p class="text-muted-foreground mb-6">
                    Join thousands of investors earning daily passive income through smart investments.
                </p>
                <Button>Get Started Today</Button>
            </section>
        </div>
    </GuestLayout>
</template>

<style scoped>
img {
    user-select: none;
}
</style>
