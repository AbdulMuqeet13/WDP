<script setup lang="ts">
import { router, Head, usePage } from '@inertiajs/vue3';
import { ref, onMounted, computed } from 'vue';
import QRCode from 'qrcode';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Card, CardHeader, CardContent, CardTitle } from '@/components/ui/card';
import { type BreadcrumbItem } from '@/types';
import DataTable from '@/components/DataTable.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { index, store } from '@/routes/user/deposits';
import { Label } from '@/components/ui/label';

defineProps({ transactions: Array });

const page = usePage();
const errors = computed(() => page.props?.errors);
// 🪙 Example wallet address
const walletAddress = ref('0x3787b0b52BB2984324aee3EBa7Cd36452dF324b6');
const qrCodeDataUrl = ref(
    'https://link.trustwallet.com/send?coin=20000714&address=0x3787b0b52BB2984324aee3EBa7Cd36452dF324b6',
);

// Deposit form data
const form = ref({
    amount: '',
    screenshot: null,
});

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Deposits',
        href: index().url,
    },
];

// Table columns
const columns = [
    { accessorKey: 'amount', header: 'Amount' },
    { accessorKey: 'status', header: 'Status' },
    { accessorKey: 'created_at', header: 'Date' },
];

// ✅ Generate QR code for wallet address
onMounted(async () => {
    qrCodeDataUrl.value = await QRCode.toDataURL(walletAddress.value, {
        width: 200,
        margin: 2,
    });
});

// ✅ Handle file upload
function handleFileChange(event: Event) {
    const file = (event.target as HTMLInputElement).files?.[0];
    if (file) form.value.screenshot = file;
}

// ✅ Submit deposit request
function submit() {
    const data = new FormData();
    data.append('amount', form.value.amount);
    if (form.value.screenshot) data.append('screenshot', form.value.screenshot);

    router.post(store(data));
}
</script>

<template>
    <Head title="Deposits" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="container mx-auto space-y-6 p-6">
            <Card class="rounded-2xl border shadow-md">
                <CardHeader>
                    <CardTitle class="text-2xl font-bold"
                        >Deposit Funds</CardTitle
                    >
                </CardHeader>

                <CardContent class="space-y-6">
                    <!-- QR Code + Wallet -->
                    <div class="flex items-end justify-between">
                        <div>
                            <img
                                v-if="qrCodeDataUrl"
                                :src="qrCodeDataUrl"
                                alt="Wallet QR"
                                class="mb-3 h-40 w-40 rounded-lg border bg-white p-2"
                            />
                            <p class="text-sm text-gray-600">
                                Scan this QR or copy wallet address below
                            </p>
                            <div
                                class="cursor-pointer rounded-md bg-gray-100 px-3 py-2 font-mono text-sm break-all dark:bg-gray-800"
                                @click="
                                    navigator.clipboard.writeText(walletAddress)
                                "
                            >
                                {{ walletAddress }}
                            </div>
                        </div>

                        <!-- Deposit Form -->
                        <div class="flex flex-col items-end gap-6">
                            <div class="flex w-full flex-col space-y-2">
                                <Label class="text-sm text-gray-700"
                                    >Enter Amount</Label
                                >
                                <Input
                                    v-model="form.amount"
                                    type="number"
                                    placeholder="Enter amount"
                                    min="10"
                                />
                                <small
                                    v-if="errors.amount"
                                    class="text-red-500"
                                    >{{ errors.amount }}</small
                                >
                            </div>

                            <div class="flex flex-col space-y-2">
                                <Label class="text-sm text-gray-700"
                                    >Upload Screenshot</Label
                                >
                                <Input
                                    type="file"
                                    accept="image/*"
                                    @change="handleFileChange"
                                />
                                <small
                                    v-if="errors.screenshot"
                                    class="text-red-500"
                                    >{{ errors.screenshot }}</small
                                >
                            </div>

                            <Button @click="submit">Request Deposit</Button>
                        </div>
                    </div>
                </CardContent>
            </Card>

            <!-- Deposit History -->
            <h3 class="mb-6 text-xl font-semibold">My Deposit Requests</h3>
            <DataTable :columns="columns" :tableData="transactions" />
        </div>
    </AppLayout>
</template>
