<template>
    <div class="overflow-hidden">
        <span
            v-for="(slot, index) in slots"
            :key="slot.props?.title"
            @click="active = index"
            class="cursor-pointer"
        >
            {{ slot.props?.title }}
        </span>
        <div
            class="flex transition-transform [&>*]:w-full [&>*]:shrink-0"
            :style="{ transform }"
        >
            <slot />
        </div>
    </div>
</template>

<script setup lang="ts">
import { ref, computed } from 'vue';
import { useSlots } from 'vue';
const active = ref(0);
const slots = useSlots().default?.();
const transform = computed(() => `translate3d(-${active.value * 100}%, 0, 0)`);
</script>

<style scoped></style>
