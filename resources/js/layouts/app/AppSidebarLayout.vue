<script setup lang="ts">
import AppContent from '@/components/AppContent.vue';
import AppShell from '@/components/AppShell.vue';
import AppSidebar from '@/components/AppSidebar.vue';
import AppSidebarHeader from '@/components/AppSidebarHeader.vue';
import type { BreadcrumbItemType } from '@/types';
import { toast, Toaster } from 'vue-sonner';
import 'vue-sonner/style.css'
import { Button } from '@/components/ui/button';
import { useAppearance } from '@/composables/useAppearance';

interface Props {
    breadcrumbs?: BreadcrumbItemType[];
}

withDefaults(defineProps<Props>(), {
    breadcrumbs: () => [],
});

const { appearance } = useAppearance();

</script>

<template>
    <AppShell variant="sidebar">
        <AppSidebar />
        <AppContent variant="sidebar" class="overflow-x-hidden">
            <AppSidebarHeader :breadcrumbs="breadcrumbs" />
            <Button
                variant="outline" @click="() => {
                  toast.error('Event has been created', {
                    description: 'Sunday, December 03, 2023 at 9:00 AM',
                  })
                }"
            >
                Show Toast
            </Button>
            <slot />
        </AppContent>
    </AppShell>
    <Toaster :data-sonner-theme="appearance"/>
</template>
