<script setup lang="ts">
import NavMain from '@/components/NavMain.vue';
import { toast } from "vue-sonner"
import {
    Sidebar,
    SidebarContent,
    SidebarFooter,
    SidebarHeader,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
} from '@/components/ui/sidebar';
import { dashboard, home } from '@/routes';
import { index } from '@/routes/admin/users';
import { index as transactions } from '@/routes/admin/transactions';
import { index as wallets } from '@/routes/user/wallet';
import { index as deposits } from '@/routes/user/deposits';
import { index as withdrawals } from '@/routes/user/withdrawals';
import { type NavItem } from '@/types';
import { Link } from '@inertiajs/vue3';
import {
    LayoutGrid,
    ArrowLeftRight,
    Wallet,
    BookDown,
    BookUp,
} from 'lucide-vue-next';
import AppLogo from './AppLogo.vue';
import NavUser from '@/components/NavUser.vue';
import { Button } from '@/components/ui/button';

const mainNavItems: NavItem[] = [
    {
        title: 'Dashboard',
        href: dashboard(),
        icon: LayoutGrid,
        roles: ['admin', 'user'],
    },
    {
        title: 'Users',
        href: index(),
        icon: LayoutGrid,
        roles: ['user'],
    },
    {
        title: 'Transactions',
        href: transactions(),
        icon: ArrowLeftRight,
        roles: ['admin'],
    },
    {
        title: 'Wallets',
        href: wallets(),
        icon: Wallet,
        roles: ['user'],
    },
    {
        title: 'Deposits',
        href: deposits(),
        icon: BookDown,
        roles: ['user'],
    },
    {
        title: 'Withdrawals',
        href: withdrawals(),
        icon: BookUp,
        roles: ['user'],
    },
];
</script>

<template>
    <Sidebar collapsible="icon" variant="inset">
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <Link :href="home()">
                            <AppLogo />
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <SidebarContent>
            <NavMain :items="mainNavItems" />
        </SidebarContent>
        <SidebarFooter>
            <NavUser />
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>
