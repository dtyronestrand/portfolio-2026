<template>
    <div></div>
</template>

<script setup lang="ts">
interface Props {
    project: {
        id: number;
        name: string;
        slug: string;
        summary: string;
        role: string;
        audience: string;
        completed_at: string;
        challenge: string;
        solution: string;
        modality: string;
        learning_objectives: string[];
        process: string;
        seat_time: string | null;
        design_rationale: string | null;
        demo_url: string | null;
        sort_order: number;
        reflections: string | null;
    };
}
const props = defineProps<Props>();
</script>

<style scoped></style>
