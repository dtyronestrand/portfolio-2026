<template>
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
        <WorkSummaryCard
            v-for="project in props.projects"
            :key="project.id"
            :project="project"
        />
    </div>
</template>

<script setup lang="ts">
import WorkSummaryCard from '@/components/WorkSummaryCard.vue';

interface Props {
    projects: {
        id: number;
        name: string;
        problem: string;
        product: string;
        tags: string[];
        hero: string;
        attachments: string[];
    }[];
}
const props = defineProps<Props>();
</script>

<style scoped></style>
