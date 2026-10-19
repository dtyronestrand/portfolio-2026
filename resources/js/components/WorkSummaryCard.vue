<template>
    <article
        class="group relative flex flex-col overflow-hidden rounded-lg border border-(--border-card) bg-(--surface-container) transition-[border-color,box-shadow] duration-200 focus-within:border-(--border-card-hover) focus-within:shadow-[0_10px_40px_rgba(79,70,229,0.22)] hover:border-(--border-card-hover) hover:shadow-[0_10px_40px_rgba(79,70,229,0.22)]"
        :class="{ 'sm:col-span-2 lg:grid lg:grid-cols-[1.15fr_1fr]': featured }"
    >
        <div
            class="relative aspect-16/10 overflow-hidden bg-(--surface-container-high)"
            :class="{ 'lg:aspect-auto': featured }"
        >
            <img
                v-if="project.hero"
                :src="project.hero"
                alt=""
                loading="lazy"
                class="absolute inset-0 size-full object-cover object-center transition-transform duration-300 group-hover:scale-[1.03] motion-reduce:transition-none"
            />
            <PlaceholderPattern v-else />
            <span
                v-if="featured"
                class="absolute top-4 left-4 rounded-sm bg-(--primary-container) px-2.5 py-1 font-mono text-xs font-semibold tracking-[0.05em] text-white uppercase"
            >
                Featured
            </span>
        </div>

        <div
            class="flex flex-1 flex-col gap-3 p-6"
            :class="{ 'lg:gap-4 lg:p-8': featured }"
        >
            <p
                v-if="meta.length"
                class="font-mono text-xs tracking-[0.05em] text-(--text-faint) uppercase"
            >
                {{ meta.join(' · ') }}
            </p>

            <h2
                class="font-serif text-2xl leading-8 font-semibold text-balance text-(--text-display)"
                :class="{ 'lg:text-[32px] lg:leading-10': featured }"
            >
                <Link
                    :href="show(project.slug)"
                    class="outline-none after:absolute after:inset-0 after:rounded-lg focus-visible:after:outline-2 focus-visible:after:outline-offset-2 focus-visible:after:outline-(--focus-ring)"
                >
                    {{ project.name }}
                </Link>
            </h2>

            <p
                class="text-[15px] leading-6 text-(--text-muted)"
                :class="featured ? 'line-clamp-4' : 'line-clamp-3'"
            >
                {{ project.summary }}
            </p>

            <ul
                v-if="visibleTags.length"
                aria-label="Tags"
                class="flex flex-wrap gap-2"
            >
                <li
                    v-for="tag in visibleTags"
                    :key="tag"
                    class="rounded-sm border border-secondary/30 bg-secondary/10 px-2.5 py-1 font-mono text-xs tracking-[0.05em] text-secondary"
                >
                    {{ tag }}
                </li>
                <li
                    v-if="hiddenTagCount"
                    class="rounded-sm border border-(--border-card) px-2.5 py-1 font-mono text-xs tracking-[0.05em] text-(--text-faint)"
                >
                    <span class="sr-only">and </span>+{{ hiddenTagCount }}
                    <span class="sr-only">more</span>
                </li>
            </ul>

            <span
                aria-hidden="true"
                class="mt-auto inline-flex items-center gap-2 pt-2 text-[15px] font-semibold text-primary underline-offset-4 group-hover:underline"
            >
                Read case study
                <ArrowRight class="size-4" />
            </span>
        </div>
    </article>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { ArrowRight } from '@lucide/vue';
import { computed } from 'vue';
import PlaceholderPattern from '@/components/PlaceholderPattern.vue';
import { show } from '@/routes/work';
import type { Project } from '@/types';

interface Props {
    project: Project;
}
const props = defineProps<Props>();

const MAX_TAGS = 3;

const featured = computed(() => props.project.featured);

const meta = computed(() => {
    const year = props.project.completed_at
        ? new Date(props.project.completed_at).getFullYear()
        : NaN;

    return [
        props.project.modality,
        props.project.seat_time,
        Number.isNaN(year) ? null : String(year),
    ].filter((item): item is string => Boolean(item));
});

const tags = computed(() => props.project.tags ?? []);
const visibleTags = computed(() => tags.value.slice(0, MAX_TAGS));
const hiddenTagCount = computed(() =>
    Math.max(tags.value.length - MAX_TAGS, 0),
);
</script>
