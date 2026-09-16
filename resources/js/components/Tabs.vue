<template>
    <div class="overflow-hidden">
        <div class="flex border-b border-(--border-card)">
            <span
                v-for="(tab, index) in tabs"
                :key="tab.key ?? index"
                @click="active = index"
                class="cursor-pointer border-b-2 p-3 transition-colors"
                :class="
                    active === index
                        ? 'border-primary text-primary'
                        : 'border-transparent text-(--text-muted) hover:text-(--text-body)'
                "
            >
                {{ tab.props?.title }}
            </span>
        </div>
        <div
            class="flex transition-transform [&>*]:w-full [&>*]:shrink-0"
            :style="{ transform }"
        >
            <slot />
        </div>
    </div>
</template>

<script setup lang="ts">
import { ref, computed, useSlots, Fragment } from 'vue';
import type { VNode } from 'vue';

const active = ref(0);
const slotsApi = useSlots();

// v-for on <Tab> is the slot's only child, so Vue wraps it in a single
// Fragment vnode rather than handing back one vnode per Tab — flatten it.
function flattenTabs(nodes: VNode[]): VNode[] {
    const result: VNode[] = [];

    for (const node of nodes) {
        if (node.type === Fragment && Array.isArray(node.children)) {
            result.push(...flattenTabs(node.children as VNode[]));
        } else {
            result.push(node);
        }
    }

    return result;
}

const tabs = computed(() => flattenTabs(slotsApi.default?.() ?? []));
const transform = computed(() => `translate3d(-${active.value * 100}%, 0, 0)`);
</script>

<style scoped></style>
