<script setup lang="ts">
import {
    SidebarGroup,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
} from '@/components/ui/sidebar';
import { urlIsActive } from '@/lib/utils';
import { type NavItem } from '@/types';
import { Link, router, usePage } from '@inertiajs/vue3';
import { logout } from '@/routes';
import { LogOut, Settings } from 'lucide-vue-next';
import { edit } from '@/routes/profile';

defineProps<{
    items: NavItem[];
}>();

const handleLogout = () => {
    router.flushAll();
};

const page = usePage();
</script>

<template>
    <SidebarGroup class="px-2 py-0">
        <SidebarMenu>
            <template v-for="item in items" :key="item.title">
                <SidebarMenuItem
                    v-if="
                        page.props.auth.user.roles.some((role) =>
                            item.roles.includes(role.name),
                        )
                    "
                >
                    <SidebarMenuButton
                        as-child
                        :is-active="urlIsActive(item.href, page.url)"
                        :tooltip="item.title"
                    >
                        <Link prefetch :href="item.href">
                            <component :is="item.icon" />
                            <span>{{ item.title }}</span>
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </template>
            <SidebarMenuItem>
                <SidebarMenuButton as-child tooltip="Logout" :is-active="page.url.includes('settings')">
                    <Link
                        class="block w-full"
                        :href="edit()"
                        prefetch
                        as="button"
                    >
                        <Settings class="mr-2 h-4 w-4" />
                        Settings
                    </Link>
                </SidebarMenuButton>
            </SidebarMenuItem>
            <SidebarMenuItem>
                <SidebarMenuButton as-child tooltip="Logout">
                    <Link
                        class="block w-full"
                        :href="logout()"
                        @click="handleLogout"
                        as="button"
                        data-test="logout-button"
                    >
                        <LogOut class="mr-2 h-4 w-4" />
                        Log out
                    </Link>
                </SidebarMenuButton>
            </SidebarMenuItem>
        </SidebarMenu>
    </SidebarGroup>
</template>
