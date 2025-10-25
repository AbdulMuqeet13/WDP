<script setup lang="ts">
import { Progress } from "@/components/ui/progress"

const steps = [
    {
        step: 1,
        title: "Total Team Promotion | CTO Reward",
        description: "If a user successfully brings 20 Referrals, and each referral invests $50, the user will be promoted to CTO.",
        progress: 40, // % complete
    },
    {
        step: 2,
        title: "CTO Royalty & Reward",
        description: "3% of the company’s total 24-hour income will be equally distributed among all CTOs as Daily Royalty Income.",
        progress: 70,
    },
    {
        step: 3,
        title: "Self Investment | Reward",
        description: "$2,000 Thailand tour (4 nights), $5,000 Dubai tour (5 days).",
        progress: 90,
    },
]
</script>

<template>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div
            v-for="step in steps"
            :key="step.step"
            class="p-6 bg-card rounded-2xl border shadow hover:shadow-lg transition"
        >
            <h3 class="text-lg font-bold mb-2">{{ step.title }}</h3>
            <p class="text-sm text-muted-foreground mb-4">{{ step.description }}</p>
            <Progress :value="step.progress" max="100" class="h-3 rounded-full" />
        </div>
    </div>
</template>











