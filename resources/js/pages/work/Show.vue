<template>
    <h1 class="text-(length:--headline-lg-size)">{{ props.project.name }}</h1>
</template>

<script setup lang="ts">
import type { Project } from '@/types';

interface Props {
    project: Project;
}
const props = defineProps<Props>();
</script>

<style scoped></style>
