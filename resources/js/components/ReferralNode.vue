<script setup lang="ts">
import { ref } from 'vue'
import { CardHeader, CardTitle, CardContent } from '@/components/ui/card'
import { Button } from '@/components/ui/button'
import { ChevronDown, ChevronRight } from 'lucide-vue-next'

defineProps({
    user: Object,
    level: {
        type: Number,
        default: 1
    }
})

const expanded = ref(false)
</script>

<template>
    <div :class="`ml-${(level - 1) * 4}`" class="mt-2 relative">
            <CardHeader class="flex items-center justify-between p-3">
                <div class="flex items-center gap-2">
                    <Button size="icon" variant="ghost" @click="expanded = !expanded" v-if="user.referral_tree?.length">
                        <ChevronDown v-if="expanded" class="h-4 w-4" />
                        <ChevronRight v-else class="h-4 w-4" />
                    </Button>
                    <CardTitle class="text-sm font-semibold">

                        {{ user.name }} <span class="text-gray-500 text-xs">({{ user.email }})</span>
                    </CardTitle>
                </div>
                <div class="text-xs text-gray-600">
                    Network Members: {{ user.id }}
                </div>
            </CardHeader>
            <CardContent v-if="expanded" class="pl-5">
                <div v-if="user.referral_tree?.length">
                    <ReferralNode
                        v-for="child in user.referral_tree"
                        :key="child.id"
                        :user="child"
                        :level="level + 1"
                    />
                </div>
                <div v-else class="text-gray-500 text-xs">No referrals</div>
            </CardContent>
    </div>
</template>
