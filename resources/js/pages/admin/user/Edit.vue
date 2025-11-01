<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { update } from '@/routes/admin/users';
import { Button } from '@/components/ui/button';
import {
    FormControl,
    FormField,
    FormItem,
    FormLabel,
} from '@/components/ui/form';

import { Input } from '@/components/ui/input';
import { router, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps<{
    user: Object;
}>();

const page = usePage();
const errors = computed(() => page.props?.errors);

const onSubmit = (event) => {
    event.preventDefault();
    router.put(update.url(props.user.id), props.user);
};

function formatDate(dateStr: string) {
    if (!dateStr) return '';
    return new Date(dateStr).toISOString().split('T')[0];
}
</script>

<template>
    <AppLayout>
        <div class="container mx-auto p-10">
            <h1 class="mb-6 text-2xl font-bold">Update User</h1>
            <form class="space-y-4" @submit="onSubmit">
            <FormField name="name">
                <FormItem>
                    <FormLabel>Name</FormLabel>
                    <FormControl>
                        <Input
                            type="text"
                            placeholder="Era Sachl"
                            v-model="user.name"
                        />
                    </FormControl>
                    <small
                        v-if="errors.name"
                        class="text-red-500"
                        >{{ errors.name }}</small
                    >
                </FormItem>
            </FormField>

            <FormField name="email">
                <FormItem>
                    <FormLabel>Email</FormLabel>
                    <FormControl>
                        <Input
                            type="email"
                            placeholder="email@wdigipay.com"
                            v-model="user.email"
                        />
                    </FormControl>
                    <small
                        v-if="errors.email"
                        class="text-red-500"
                        >{{ errors.email }}</small
                    >
                </FormItem>
            </FormField>

            <FormField name="email">
                <FormItem>
                    <FormLabel>Wallet Address</FormLabel>
                    <FormControl>
                        <Input
                            type="text"
                            placeholder="BC20 wallet address"
                            v-model="user.wallet_address"
                        />
                    </FormControl>
                    <small
                        v-if="errors.wallet_address"
                        class="text-red-500"
                        >{{ errors.wallet_address }}</small
                    >
                </FormItem>
            </FormField>

            <FormField name="referralCode">
                <FormItem>
                    <FormLabel>Referral Code</FormLabel>
                    <FormControl>
                        <Input
                            type="text"
                            placeholder="WDP12345"
                            v-model="user.referral_code"
                        />
                    </FormControl>
                    <small
                        v-if="errors.referral_code"
                        class="text-red-500"
                        >{{ errors.referral_code }}</small
                    >
                </FormItem>
            </FormField>

            <FormField name="joiningDate">
                <FormItem>
                    <FormLabel>Joining Date</FormLabel>
                    <FormControl>
                        <Input
                            type="date"
                            :defaultValue="formatDate(user.created_at)"
                            @input="user.created_at = $event.target.value"
                        />
                    </FormControl>
                    <small
                        v-if="errors.created_at"
                        class="text-red-500"
                        >{{ errors.created_at }}</small
                    >
                </FormItem>
            </FormField>

            <Button type="submit"> Submit </Button>
        </form>
        </div>
    </AppLayout>
</template>
