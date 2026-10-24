<template>
    <article
        class="group relative grid items-center gap-6 lg:grid-cols-[minmax(0,1.1fr)_minmax(0,1fr)] lg:gap-10"
    >
        <div
            class="relative aspect-16/10 overflow-hidden rounded-lg border border-(--border-card) bg-(--surface-container-high) transition-[border-color,box-shadow] duration-200 group-focus-within:border-(--border-card-hover) group-focus-within:shadow-[0_10px_40px_rgba(79,70,229,0.22)] group-hover:border-(--border-card-hover) group-hover:shadow-[0_10px_40px_rgba(79,70,229,0.22)]"
            :class="{ 'lg:order-2': reversed }"
        >
            <img
                v-if="project.hero"
                :src="project.hero"
                alt=""
                loading="lazy"
                class="absolute inset-0 size-full object-cover object-center transition-transform duration-300 group-hover:scale-[1.03] motion-reduce:transition-none"
            />
            <PlaceholderPattern v-else />
        </div>

        <div class="flex min-w-0 flex-col gap-4">
            <p
                v-if="meta.length"
                class="font-mono text-xs tracking-[0.05em] text-(--text-faint) uppercase"
            >
                {{ meta.join(' · ') }}
            </p>

            <h3
                class="font-serif text-2xl leading-8 font-semibold text-balance text-(--text-display) lg:text-[32px] lg:leading-10"
            >
                <Link
                    :href="show(project.slug)"
                    class="outline-none after:absolute after:inset-0 after:rounded-lg focus-visible:after:outline-2 focus-visible:after:outline-offset-4 focus-visible:after:outline-(--focus-ring)"
                >
                    {{ project.name }}
                </Link>
            </h3>

            <dl class="grid gap-4 sm:grid-cols-2">
                <div
                    v-if="project.challenge"
                    class="flex flex-col gap-1.5 border-l-2 border-(--border-card) pl-3.5"
                >
                    <dt
                        class="font-mono text-xs tracking-[0.05em] text-(--text-faint) uppercase"
                    >
                        Challenge
                    </dt>
                    <dd
                        class="line-clamp-3 text-[15px] leading-6 text-(--text-muted)"
                    >
                        {{ project.challenge }}
                    </dd>
                </div>
                <div
                    v-if="project.solution"
                    class="flex flex-col gap-1.5 border-l-2 border-secondary pl-3.5"
                >
                    <dt
                        class="font-mono text-xs tracking-[0.05em] text-(--text-faint) uppercase"
                    >
                        Solution
                    </dt>
                    <dd
                        class="line-clamp-3 text-[15px] leading-6 text-(--text-muted)"
                    >
                        {{ project.solution }}
                    </dd>
                </div>
            </dl>

            <ul
                v-if="stats.length"
                aria-label="Project details"
                class="flex flex-wrap gap-x-6 gap-y-2 font-mono text-xs tracking-[0.05em] text-(--text-faint) uppercase"
            >
                <li v-for="stat in stats" :key="stat.label">
                    {{ stat.label }}
                    <span class="text-(--text-body)">{{ stat.value }}</span>
                </li>
            </ul>

            <span
                aria-hidden="true"
                class="inline-flex items-center gap-2 pt-1 text-[15px] font-semibold text-primary underline-offset-4 group-hover:underline"
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
    reversed?: boolean;
}
const props = withDefaults(defineProps<Props>(), { reversed: false });

const meta = computed(() => {
    const year = props.project.completed_at
        ? new Date(props.project.completed_at).getFullYear()
        : NaN;

    return [
        props.project.modality,
        props.project.audience,
        Number.isNaN(year) ? null : String(year),
    ].filter((item): item is string => Boolean(item));
});

const stats = computed(() => {
    const objectives = props.project.learning_objectives?.length ?? 0;

    return [
        objectives ? { label: 'Objectives', value: String(objectives) } : null,
        props.project.seat_time
            ? { label: 'Seat time', value: props.project.seat_time }
            : null,
        props.project.role
            ? { label: 'Role', value: props.project.role }
            : null,
    ].filter((item): item is { label: string; value: string } => Boolean(item));
});
</script>
