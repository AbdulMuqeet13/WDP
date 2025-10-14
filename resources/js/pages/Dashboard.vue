<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { index } from '@/routes/admin/users';
import { type BreadcrumbItem } from '@/types';
import { Head, usePage } from '@inertiajs/vue3';
import PlaceholderPattern from '../components/PlaceholderPattern.vue';
import { ref } from 'vue';

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
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div
            class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4"
        >
            <div class="grid auto-rows-min gap-4 md:grid-cols-3">
                <div
                    class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border"
                >
                    <div class="p-6">
                        <h1 class="text-xl font-bold">
                            Welcome, {{ user.name }}
                        </h1>
                        <div class="mt-4 space-y-2">
                            <p>
                                <strong>Referral Code:</strong>
                                {{ user.referral_code }}
                            </p>
                            <p @click="copyReferralLink" class="cursor-copy">
                                <strong>Referral Link:</strong>
                                {{ user.referral_url }}
                                <small v-if="copied">✅ Copied!</small>
                            </p>
                            <p v-if="user.referred_by_name">
                                <strong>My Inviter:</strong>
                                {{ user.referred_by_name }}
                            </p>
                            <p>
                                <strong>Direct Referrals:</strong>
                                {{ user.direct_referrals_count }}
                            </p>
                        </div>
                    </div>
                    <!--                    <PlaceholderPattern />-->
                </div>
                <div
                    class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border"
                >
                    <PlaceholderPattern />
                </div>
                <div
                    class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border"
                >
                    <PlaceholderPattern />
                </div>
            </div>
            <div
                class="relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 md:min-h-min dark:border-sidebar-border"
            >
                <PlaceholderPattern />
            </div>
        </div>
    </AppLayout>
</template>
