<script setup lang="ts">
import { Progress } from '@/components/ui/progress';

defineProps({
    milestones: Array,
})
</script>

<template>
    <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
        <div
            v-for="(milestone, index) in milestones"
            :key="index"
            class="rounded-2xl border bg-card p-6 shadow transition hover:shadow-lg"
        >
            <h3 class="mb-2 text-lg font-bold">{{ milestone.title }}</h3>
            <p class="mb-4 min-h-18 text-sm text-muted-foreground">
                {{ milestone.description }}
            </p>
            <div class="flex flex-col items-end gap-3">
                <p class="text-sm text-muted-foreground">{{ milestone.progress }}%</p>
                <Progress
                    v-model="milestone.progress"
                    :max="100"
                    class="h-3 rounded-full"
                />
            </div>
        </div>
    </div>
</template>
