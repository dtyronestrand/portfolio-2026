<template>
    <div v-for="project in props.projects" :key="project.id">
        <WorkSummaryCard :project="project" />
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
            media: string[];
        }[];    
        }
    const props = defineProps<Props>();
</script>

<style scoped>

</style>