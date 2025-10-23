<script setup lang="ts">
import AppContent from '@/components/AppContent.vue';
import AppShell from '@/components/AppShell.vue';
import AppSidebar from '@/components/AppSidebar.vue';
import AppSidebarHeader from '@/components/AppSidebarHeader.vue';
import type { BreadcrumbItemType } from '@/types';
import { toast, Toaster } from 'vue-sonner';
import 'vue-sonner/style.css'
import { useAppearance } from '@/composables/useAppearance';
import { usePage } from '@inertiajs/vue3';
import { watch } from 'vue';

interface Props {
    breadcrumbs?: BreadcrumbItemType[];
}

withDefaults(defineProps<Props>(), {
    breadcrumbs: () => [],
});

const { appearance } = useAppearance();
const { flash } = usePage().props;

watch(() => flash,
    () =>{
        if (flash?.success) {
            toast.success('Success', {
                description: flash.success,
            });
        }
        if (flash?.error) {
            toast.error('Error', {
                description: flash.error,
            });
        }
    })
</script>

<template>

    <AppShell variant="sidebar">
        <AppSidebar />
        <AppContent variant="sidebar" class="overflow-x-hidden">
            <AppSidebarHeader :breadcrumbs="breadcrumbs" />
            <slot />
        </AppContent>
    </AppShell>
    <Toaster :data-sonner-theme="appearance"/>
</template>
