<script setup lang="ts">
import { ExternalLink } from '@lucide/vue';
import { formatYear } from '@/lib/resumeDates';
import type { ResumePublication } from '@/types';

interface Props {
    publications: ResumePublication[];
}

defineProps<Props>();
</script>

<template>
    <ol class="thread relative">
        <li
            v-for="publication in publications"
            :key="publication.id"
            class="relative flex gap-4 pb-8 sm:gap-5"
        >
            <span
                class="z-10 mt-1 flex size-6 shrink-0 items-center justify-center rounded-full bg-(--surface-container-highest)"
                aria-hidden="true"
            >
                <span class="size-2.5 rounded-full bg-secondary"></span>
            </span>
            <article class="min-w-0 flex-1">
                <div class="flex items-start justify-between gap-6">
                    <h3
                        class="font-serif text-lg leading-snug font-semibold text-foreground"
                    >
                        <a
                            v-if="publication.url"
                            :href="publication.url"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="inline-flex items-baseline gap-1.5 rounded-sm transition-colors hover:text-primary focus-visible:outline-2 focus-visible:outline-ring"
                        >
                            {{ publication.title }}
                            <ExternalLink
                                class="size-3.5 shrink-0 self-center text-(--text-faint)"
                                aria-hidden="true"
                            />
                            <span class="sr-only">(opens in a new tab)</span>
                        </a>
                        <template v-else>{{ publication.title }}</template>
                    </h3>
                    <p
                        class="shrink-0 rounded-full border border-border bg-(--surface-container) px-3 py-1 font-mono text-xs font-medium tracking-[0.05em] text-(--text-muted)"
                    >
                        <time :datetime="publication.published_at">{{
                            formatYear(publication.published_at)
                        }}</time>
                    </p>
                </div>
                <p class="mt-1 text-sm text-(--text-muted)">
                    <span v-if="publication.authors"
                        >{{ publication.authors }} &middot; </span
                    ><span class="italic">{{ publication.publisher }}</span>
                </p>
                <p
                    v-if="publication.description"
                    class="mt-2 text-sm text-(--text-faint)"
                >
                    {{ publication.description }}
                </p>
            </article>
        </li>
    </ol>
</template>

<style scoped>
.thread::before {
    content: '';
    position: absolute;
    top: 0.25rem;
    bottom: 2rem;
    left: calc(0.75rem - 1px);
    width: 2px;
    background: var(--outline-variant);
}
</style>
