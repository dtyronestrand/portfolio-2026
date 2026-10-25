<script setup lang="ts" generic="T extends { id: number }">
import { Building2, Calendar, MapPin } from '@lucide/vue';
import type { Component } from 'vue';

interface Props {
    items: T[];
    icon: Component;
    title: (item: T) => string;
    institution: (item: T) => string;
    location?: (item: T) => string | null;
    dates: (item: T) => string;
}

defineProps<Props>();

defineSlots<{ default(props: { item: T }): unknown }>();
</script>

<template>
    <ol class="timeline relative">
        <li
            v-for="item in items"
            :key="item.id"
            class="relative flex gap-5 pb-10 sm:gap-6"
        >
            <div
                class="z-10 flex size-12 shrink-0 items-center justify-center rounded-full border-4 border-background bg-(--surface-container-high) text-primary ring-1 ring-border sm:size-14"
                aria-hidden="true"
            >
                <component :is="icon" class="size-5 sm:size-6" />
            </div>
            <article class="min-w-0 flex-1 pt-1.5 sm:pt-2.5">
                <div
                    class="flex flex-col gap-2 xl:flex-row xl:items-start xl:justify-between xl:gap-8"
                >
                    <div class="min-w-0">
                        <h3
                            class="font-serif text-xl leading-snug font-semibold text-foreground"
                        >
                            {{ title(item) }}
                        </h3>
                        <ul
                            class="mt-1.5 flex flex-wrap gap-x-4 gap-y-1 text-sm text-(--text-muted)"
                        >
                            <li class="flex items-center gap-1.5">
                                <Building2
                                    class="size-3.5 text-(--text-faint)"
                                    aria-hidden="true"
                                />
                                {{ institution(item) }}
                            </li>
                            <li
                                v-if="location?.(item)"
                                class="flex items-center gap-1.5"
                            >
                                <MapPin
                                    class="size-3.5 text-(--text-faint)"
                                    aria-hidden="true"
                                />
                                {{ location(item) }}
                            </li>
                        </ul>
                    </div>
                    <p
                        class="flex w-fit shrink-0 items-center gap-2 rounded-full border border-border bg-(--surface-container) px-3 py-1 font-mono text-xs font-medium tracking-[0.05em] whitespace-nowrap text-(--text-muted) uppercase"
                    >
                        <Calendar
                            class="size-3.5 text-secondary"
                            aria-hidden="true"
                        />
                        {{ dates(item) }}
                    </p>
                </div>
                <div class="mt-4 text-(--text-muted) empty:hidden">
                    <slot :item="item" />
                </div>
            </article>
        </li>
        <li
            aria-hidden="true"
            class="relative flex w-12 justify-center sm:w-14"
        >
            <span
                class="z-10 size-5 rounded-full border-4 border-background bg-(--surface-container-high) ring-1 ring-border"
            ></span>
        </li>
    </ol>
</template>

<style scoped>
/* The connecting line runs through the centre of the icon column. */
.timeline::before {
    content: '';
    position: absolute;
    top: 0;
    bottom: 0.625rem;
    left: calc(1.5rem - 1px);
    width: 2px;
    background: linear-gradient(
        to bottom,
        var(--outline-variant),
        color-mix(in srgb, var(--outline-variant) 30%, transparent)
    );
}
@media (min-width: 40rem) {
    .timeline::before {
        left: calc(1.75rem - 1px);
    }
}
</style>
