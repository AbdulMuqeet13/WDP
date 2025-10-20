<script setup lang="ts">
import NavMain from '@/components/NavMain.vue';
import {
    Sidebar,
    SidebarContent,
    SidebarHeader,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
} from '@/components/ui/sidebar';
import { dashboard } from '@/routes';
import { index } from '@/routes/admin/users';
import { index as transactions } from '@/routes/admin/transactions';
import { index as wallets } from '@/routes/user/wallet';
import { index as deposits } from '@/routes/user/deposits';
import { index as withdrawals } from '@/routes/user/withdrawals';
import { type NavItem } from '@/types';
import { Link } from '@inertiajs/vue3';
import { LayoutGrid, ArrowLeftRight, Wallet, BookDown, BookUp } from 'lucide-vue-next';
import AppLogo from './AppLogo.vue';

const mainNavItems: NavItem[] = [
    {
        title: 'Dashboard',
        href: dashboard(),
        icon: LayoutGrid,
    },
    {
        title: 'Users',
        href: index(),
        icon: LayoutGrid,
    },
    {
        title: 'Transactions',
        href: transactions(),
        icon: ArrowLeftRight,
    },
    {
        title: 'Wallets',
        href: wallets(),
        icon: Wallet,
    },
    {
        title: 'Deposits',
        href: deposits(),
        icon: BookDown,
    },
    {
        title: 'Withdrawals',
        href: withdrawals(),
        icon: BookUp,
    }
];

</script>

<template>
    <Sidebar collapsible="icon" variant="inset">
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <Link :href="dashboard()">
                            <AppLogo />
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <SidebarContent>
            <NavMain :items="mainNavItems" />
        </SidebarContent>
    </Sidebar>
    <slot />
</template>
