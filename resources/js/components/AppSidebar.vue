<script setup lang="ts">
import NavMain from '@/components/NavMain.vue';
import {
    Sidebar,
    SidebarContent,
    SidebarFooter,
    SidebarHeader,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
} from '@/components/ui/sidebar';
import { dashboard, home, reports } from '@/routes';
import { index } from '@/routes/user/users';
import { index as adminUsers} from '@/routes/admin/users';
import { index as userTransactions } from '@/routes/admin/user-transactions';
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
    FileChartColumnIncreasing,
} from 'lucide-vue-next';
import AppLogo from './AppLogo.vue';
import NavUser from '@/components/NavUser.vue';

const mainNavItems: NavItem[] = [
    {
        title: 'Dashboard',
        href: dashboard(),
        icon: LayoutGrid,
        roles: ['admin', 'user'],
    },
    {
        title: 'Our Team',
        href: index(),
        icon: LayoutGrid,
        roles: ['user'],
    },
    {
        title: 'Users',
        href: adminUsers(),
        icon: LayoutGrid,
        roles: ['admin'],
    },
    {
        title: 'Transactions Approval',
        href: transactions(),
        icon: ArrowLeftRight,
        roles: ['admin'],
    },
    {
        title: 'User Transaction',
        href: userTransactions(),
        icon: ArrowLeftRight,
        roles: ['admin'],
    },
    {
        title: 'My Earnings',
        href: wallets(),
        icon: Wallet,
        roles: ['user'],
    },
    {
        title: 'Topup',
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
    {
        title: 'Reports',
        href: reports(),
        icon: FileChartColumnIncreasing,
        roles: ['admin', 'user'],
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
