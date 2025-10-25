<script setup lang="ts" generic="TData, TValue">
import type { ColumnDef } from '@tanstack/vue-table';
import { MoreHorizontal } from 'lucide-vue-next';
import { FlexRender, getCoreRowModel, useVueTable } from '@tanstack/vue-table';
import { debounce } from 'lodash';

import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/components/ui/table';
import {
    DropdownMenu,
    DropdownMenuTrigger,
    DropdownMenuContent,
    DropdownMenuLabel,
    DropdownMenuSeparator,
    DropdownMenuItem,
} from '@/components/ui/dropdown-menu';
import { Button } from '@/components/ui/button';
import {
    Pagination,
    PaginationContent,
    PaginationItem,
    PaginationPrevious,
} from '@/components/ui/pagination';
import { Input } from '@/components/ui/input';
import { Dialog, DialogFooter, DialogHeader } from '@/components/ui/dialog';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps<{
    columns: ColumnDef<TData, TValue>[];
    tableData: [];
    actions?: [];
    title?: String;
    meta?: Object;
    saveMethod?: () => {};
    updateMethod?: () => {};
    updateSuccess?: () => {};
    saveSuccess?: () => {};
    transformSubmittingData?: () => {};
    enableSearch?: Boolean;
}>();

const table = useVueTable({
    get data() {
        return props.tableData;
    },
    get columns() {
        return props.columns;
    },
    getCoreRowModel: getCoreRowModel(),
});
const openRecordForm = ref(false)
const emit = defineEmits(['pageChange', 'search', 'submit']);


const { data, post, put, processing, errors, transform, clearErrors, resetAndClearErrors } = useForm()

const saveNewRecord = () => {
    if (props.transformSubmittingData) {
        props.transformSubmittingData(transform)
    }
    post(props.saveMethod(), {
        onSuccess: () => {
            openRecordForm.value = false            // toast(`${title} created successfully`)
            resetAndClearErrors();
            props.saveSuccess?.();
        },
        onError: (error) => {
            console.log(error);
        }
    })
}

const updateRecord = () => {
    if (props.transformSubmittingData) {
        props.transformSubmittingData(transform, data)
    }
    put(props.updateMethod(data.id), {
        onSuccess: () => {
            openRecordForm.value = false            // toast(`${title} updated successfully`)
            resetAndClearErrors();
            props.updateSuccess?.()
        },
        onError: (error) => {
            console.log(error);
        }
    })
}

const submit = ()=> {
    if (data.id) {
        updateRecord();
    } else {
        saveNewRecord()
    }

}

const handleInput = debounce((event: Event) => {
    emit('search', (event.target as HTMLInputElement).value);
}, 300);

</script>

<template>
    <div v-if="enableSearch" class="flex items-center py-4">
        <Input
            class="max-w-sm"
            placeholder="Search here..."
            @input="handleInput"
        />
<!--        <Dialog v-model:open="openRecordForm">-->
<!--            <DialogContent>-->
<!--                <DialogHeader>-->
<!--                    <DialogTitle>-->
<!--                        {{ data.id ? 'Edit' : 'Add' }} {{ title }}-->
<!--                    </DialogTitle>-->

<!--                    <div-->
<!--                        v-for="column in table.getAllColumns()"-->
<!--                        :key="column.id"-->
<!--                        class="flex flex-col gap-1"-->
<!--                    >-->
<!--                        <template-->
<!--                            v-if="-->
<!--                                column.columnDef.dataType === 'text' ||-->
<!--                                column.columnDef.dataType === 'number' ||-->
<!--                                column.columnDef.dataType === 'email'-->
<!--                            "-->
<!--                        >-->
<!--                            <Label :for="column.id" class="gap-0">-->
<!--                                {{ column.columnDef.header }}-->
<!--                                <span v-if="column.columnDef.is_required"-->
<!--                                    >*</span-->
<!--                                >-->
<!--                            </Label>-->

<!--                            <Input-->
<!--                                :id="column.id"-->
<!--                                :name="column.columnDef.accessorKey"-->
<!--                                :type="column.columnDef.dataType"-->
<!--                                v-model="data[column.columnDef.accessorKey]"-->
<!--                            />-->

<!--                            <small class="mt-1 text-xs text-red-500">-->
<!--                                {{ errors[column.columnDef.accessorKey] }}-->
<!--                            </small>-->
<!--                        </template>-->
<!--                    </div>-->
<!--                </DialogHeader>-->

<!--                <DialogFooter>-->
<!--                    <Button :disabled="processing">Cancel</Button>-->
<!--                    <Button-->
<!--                        :disabled="processing"-->
<!--                        @click.prevent="submit"-->
<!--                    >-->
<!--                        Continue-->
<!--                    </Button>-->
<!--                </DialogFooter>-->
<!--            </DialogContent>-->
<!--        </Dialog>-->
    </div>
    <div class="rounded-md border">
        <Table>
            <TableHeader>
                <TableRow
                    v-for="headerGroup in table.getHeaderGroups()"
                    :key="headerGroup.id"
                >
                    <TableHead
                        v-for="header in headerGroup.headers"
                        :key="header.id"
                    >
                        <FlexRender
                            v-if="!header.isPlaceholder"
                            :render="header.column.columnDef.header"
                            :props="header.getContext()"
                        />
                    </TableHead>
                </TableRow>
            </TableHeader>
            <TableBody>
                <template v-if="table.getRowModel().rows?.length">
                    <TableRow
                        v-for="row in table.getRowModel().rows"
                        :key="row.id"
                        :data-state="
                            row.getIsSelected() ? 'selected' : undefined
                        "
                    >
                        <TableCell
                            v-for="cell in row.getVisibleCells()"
                            :key="cell.id"
                        >
                            <FlexRender
                                :render="cell.column.columnDef.cell"
                                :props="cell.getContext()"
                            />
                        </TableCell>
                        <TableCell v-if="actions?.length">
                            <DropdownMenu>
                                <DropdownMenuTrigger as-child>
                                    <Button variant="ghost" class="h-8 w-8 p-0">
                                        <span class="sr-only">Open menu</span>
                                        <MoreHorizontal class="h-4 w-4" />
                                    </Button>
                                </DropdownMenuTrigger>
                                <DropdownMenuContent align="end">
                                    <DropdownMenuLabel
                                        >Actions</DropdownMenuLabel
                                    >
                                    <DropdownMenuSeparator />
                                    <DropdownMenuItem
                                        v-for="(action, index) in actions"
                                        :key="index"
                                        @click="action.action(row.original.id)"
                                        class="cursor-pointer"
                                    >
                                        {{ action.title }}
                                    </DropdownMenuItem>
                                </DropdownMenuContent>
                            </DropdownMenu>
                        </TableCell>
                    </TableRow>
                </template>
                <template v-else>
                    <TableRow>
                        <TableCell
                            :colspan="columns.length"
                            class="h-24 text-center"
                        >
                            No results.
                        </TableCell>
                    </TableRow>
                </template>
            </TableBody>
        </Table>
    </div>
    <Pagination
        v-if="meta && meta.total > meta.per_page"
        v-slot="{ page }"
        class="mt-4 justify-end"
        :items-per-page="meta.per_page"
        :total="meta.total"
        :default-page="1"
    >
        <PaginationContent v-slot="{ items }">
            <PaginationPrevious
                class="cursor-pointer"
                @click="emit('pageChange', meta.current_page - 1)"
            />

            <template v-for="(item, index) in items" :key="index">
                <PaginationItem
                    class="cursor-pointer"
                    v-if="item.type === 'page'"
                    :value="item.value"
                    :is-active="item.value === page"
                    @click="emit('pageChange', item)"
                >
                    {{ item.value }}
                </PaginationItem>
            </template>

            <PaginationEllipsis class="cursor-pointer" :index="4" />

            <PaginationNext
                @click="emit('pageChange', meta.current_page - 1)"
            />
        </PaginationContent>
    </Pagination>
</template>
