<template>
    <div></div>
</template>

<script setup lang="ts">
interface Props {
    project: {
        id: number;
        name: string;
        problem: string;
        product: string;
        tags: string[];
        hero: string;
        attachments: string[];
    };
}
const props = defineProps<Props>();
</script>

<style scoped></style>
