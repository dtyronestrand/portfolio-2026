<template>
    <Head title="Work" />
    <main class="mx-auto flex w-full max-w-[1280px] flex-col gap-10 pt-10">
        <h1
            class="font-serif text-[clamp(2.25rem,4vw,3rem)] leading-tight font-bold tracking-tight text-(--text-display)"
        >
            Selected work
        </h1>
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
            <WorkSummaryCard
                v-for="project in props.projects"
                :key="project.id"
                :project="project"
            />
        </div>
    </main>
</template>

<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import WorkSummaryCard from '@/components/WorkSummaryCard.vue';
import type { Project } from '@/types';

interface Props {
    projects: Project[];
}
const props = defineProps<Props>();
</script>
