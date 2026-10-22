<script setup lang="ts">
import type { ResumeNavItem } from '@/types';

interface Props {
    items: ResumeNavItem[];
    activeId: string | null;
}

defineProps<Props>();
const emit = defineEmits<{ select: [id: string] }>();
</script>

<template>
    <nav
        aria-label="Resume sections"
        class="sticky top-20 z-30 -mx-1 [scrollbar-width:none] overflow-x-auto rounded-lg border border-border bg-(--glass-tint) p-1 backdrop-blur-md [&::-webkit-scrollbar]:hidden"
    >
        <ul class="flex w-max gap-1">
            <li v-for="item in items" :key="item.id">
                <a
                    :href="`#${item.id}`"
                    :aria-current="
                        item.id === activeId ? 'location' : undefined
                    "
                    class="flex items-center gap-2 rounded-md px-3 py-1.5 text-xs font-medium tracking-wide whitespace-nowrap uppercase transition-colors duration-200 focus-visible:outline-2 focus-visible:outline-ring"
                    :class="
                        item.id === activeId
                            ? 'bg-primary/12 text-foreground ring-1 ring-primary/25 ring-inset'
                            : 'text-muted-foreground hover:text-foreground'
                    "
                    @click.prevent="emit('select', item.id)"
                >
                    <component
                        :is="item.icon"
                        class="size-3.5"
                        :class="item.id === activeId ? 'text-secondary' : ''"
                        aria-hidden="true"
                    />
                    {{ item.label }}
                </a>
            </li>
        </ul>
    </nav>
</template>
