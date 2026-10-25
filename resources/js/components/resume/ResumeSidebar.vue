<script setup lang="ts">
import { computed } from 'vue';
import type { ResumeNavItem } from '@/types';

interface Props {
    name: string;
    role: string;
    items: ResumeNavItem[];
    activeId: string | null;
}

const props = defineProps<Props>();
const emit = defineEmits<{ select: [id: string] }>();

const initials = computed(() =>
    props.name
        .split(' ')
        .filter(Boolean)
        .map((part) => part[0])
        .slice(0, 2)
        .join(''),
);
</script>

<template>
    <aside
        class="sticky top-24 flex max-h-[calc(100dvh-7rem)] flex-col gap-8 overflow-y-auto rounded-lg border border-border bg-(--surface-container-low) px-6 py-8"
    >
        <div class="flex flex-col items-center text-center">
            <div class="avatar-ring rounded-full p-[3px]">
                <div
                    class="flex size-28 items-center justify-center rounded-full border-4 border-(--surface-container-low) bg-(--surface-container-high) font-serif text-4xl font-semibold tracking-tight text-foreground select-none"
                    aria-hidden="true"
                >
                    {{ initials }}
                </div>
            </div>
            <p
                class="mt-5 font-serif text-xl leading-tight font-semibold tracking-tight text-foreground"
            >
                {{ name }}
            </p>
            <p
                class="mt-2 font-mono text-xs font-medium tracking-[0.05em] text-primary uppercase"
            >
                {{ role }}
            </p>
        </div>

        <nav aria-label="Resume sections">
            <ul class="flex flex-col gap-1">
                <li v-for="item in items" :key="item.id">
                    <a
                        :href="`#${item.id}`"
                        :aria-current="
                            item.id === activeId ? 'location' : undefined
                        "
                        class="group flex items-center gap-3 rounded-md px-3 py-2 text-sm font-medium tracking-wide uppercase transition-colors duration-200 focus-visible:outline-2 focus-visible:outline-ring"
                        :class="
                            item.id === activeId
                                ? 'bg-primary/12 text-foreground ring-1 ring-primary/25 ring-inset'
                                : 'text-muted-foreground hover:text-foreground'
                        "
                        @click.prevent="emit('select', item.id)"
                    >
                        <component
                            :is="item.icon"
                            class="size-4 shrink-0 transition-colors duration-200"
                            :class="
                                item.id === activeId
                                    ? 'text-secondary'
                                    : 'text-(--text-faint) group-hover:text-primary'
                            "
                            aria-hidden="true"
                        />
                        {{ item.label }}
                    </a>
                </li>
            </ul>
        </nav>
    </aside>
</template>

<style scoped>
.avatar-ring {
    background: linear-gradient(135deg, var(--primary), var(--secondary));
}
</style>
