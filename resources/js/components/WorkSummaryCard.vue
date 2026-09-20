<template>
    <div class="w-full max-w-full mb-8 sm:w-1/2 px-4 lg:w-1/3 flex flex-col">
        <img src="props.hero" alt="" class="object-cover object-center w-full h-48"/>
        <div class="flex flex-grow">
            <div class="triangle">
                <div class="flex flex-col justify-between px-4 py-6 bg-[var(--surface-container)] border border-[var(--primary)]">
                    <div>
                        <h3 class="inline-block mb-4 text-xs font-bold capitalize border-b-2 border-[var(--color-primary)]">
                            {{ props.project.name }}
                        </h3>
                        <p class="mb-4 text-sm text-[var(--color-on-surface-container)]">
                            {{ props.project.problem }}
                        </p>
                    </div>
                    <TextLink :href="`/work/${props.project.id}`" class="text-xs text-[var(--color-accent)] hover:text-[var(--on-surface-container)]">View Project</TextLink>
                </div>
            </div>
        </div>

    </div>
</template>

<script setup lang="ts">
import TextLink from './TextLink.vue';
    interface Props {
        project: {
            id: number;
            name: string;
            problem: string;
            product: string;
            tags: string[];
            hero: string;
            media: string[];
        };
    }
    const props = defineProps<Props>();
    
</script>

<style scoped>

</style>