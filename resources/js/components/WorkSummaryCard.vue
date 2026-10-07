<template>
    <div
        class="flex flex-col overflow-hidden rounded-lg border border-(--border-card) bg-(--surface-container) transition-colors hover:border-(--border-card-hover)"
    >
        <img
            v-if="props.project.hero"
            :src="props.project.hero"
            :alt="props.project.name"
            class="h-48 w-full object-cover object-center"
        />
        <div
            v-else
            class="relative flex h-48 w-full items-center justify-center overflow-hidden bg-(--surface-container-high)"
        >
            <PlaceholderPattern />
        </div>
        <div class="flex flex-1 flex-col justify-between p-6">
            <div>
                <h3
                    class="mb-3 inline-block border-b-2 border-primary text-xs font-bold text-(--text-display) capitalize"
                >
                    {{ props.project.name }}
                </h3>
                <p class="mb-4 text-sm text-(--text-muted)">
                    {{ props.project.problem }}
                </p>
            </div>
            <TextLink
                :href="`/work/${props.project.id}`"
                class="text-xs text-primary hover:underline"
            >
                View Project
            </TextLink>
        </div>
    </div>
</template>

<script setup lang="ts">
import PlaceholderPattern from '@/components/PlaceholderPattern.vue';
import TextLink from './TextLink.vue';

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
