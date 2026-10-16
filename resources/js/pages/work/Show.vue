<template>
    <div>{{ props.project.name }}</div>
</template>

<script setup lang="ts">
import type { Project } from '@/types';

interface Props {
    project: Project;
}
const props = defineProps<Props>();
</script>

<style scoped></style>
