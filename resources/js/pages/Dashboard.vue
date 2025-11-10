<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue'
import { Head } from '@inertiajs/vue3'
import { ref } from 'vue'
import { Button } from '@/components/ui/button'
import AdminDashboard from '@/components/AdminDashboard.vue';
import UserDashboard from '@/components/UserDashboard.vue';
import { Badge } from '@/components/ui/badge';

const props = defineProps({
    user: Object,
    referral_url: String,
    role: String,
    stats: Object,
    recent_users: Array,
    recent_referrals: Array,
    milestones: Array,
})

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

const columns = [
    { accessorKey: 'name', header: 'Name' },
    { accessorKey: 'email', header: 'Email' },
    { accessorKey: 'joining_date', header: 'Joining Date' },
];
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout>
        <div class="flex flex-col gap-6 p-6">
            <div class="flex justify-between items-center">
                <h1 class="text-xl font-bold flex items-end gap-3">
                    <span>Welcome, <span class="text-indigo-600 dark:text-indigo-400">{{ user.data.name }}</span></span>
                    <Badge v-if="role === 'user'" :variant="user.data.is_active ? '' : 'destructive'">
                        {{user.data.is_active ? 'Active' : 'Inactive'}}
                    </Badge>
                </h1>
                <div v-if="role === 'user'" class="flex items-center gap-4">
                    <p>
                        <strong>Referral Code:</strong>
                        <span class="font-mono text-sm bg-gray-200 dark:bg-gray-800 px-2 py-1 rounded">{{ user.data.referral_code }}</span>
                    </p>
                    <Button variant="outline" size="sm" @click="copyReferralLink">
                        {{ copied ? "✅ Copied!" : "Copy Link" }}
                    </Button>
                </div>
            </div>

            <!-- USER DASHBOARD -->
            <div v-if="role === 'user'" class="space-y-6">
                <UserDashboard :stats="stats" :recent_referrals="recent_referrals" :columns="columns" :milestones="milestones" />
            </div>

            <!-- ADMIN DASHBOARD -->
            <div v-if="role === 'admin'" class="space-y-6">
               <AdminDashboard :stats="stats" :recent_users="recent_users" :columns="columns" />
            </div>
        </div>
    </AppLayout>
</template>
