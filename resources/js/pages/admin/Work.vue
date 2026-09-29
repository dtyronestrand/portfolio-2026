<template>
    <section data-screen-label="Projects" class="flex flex-col gap-6">
        <div class="flex flex-wrap items-end gap-9">
            <div class="min-w-260px flex-1">
                <h1 class="ds-headline-lg m-[0 0 6px]">Projects</h1>
                <p
                    class="text-md text-wrap-pretty m-0 max-w-[56ch] leading-3.5 text-(--text-muted)"
                ></p>
            </div>
            <Button @click="showAddProjectForm = true">Add Project</Button>
        </div>

        <div v-if="showAddProjectForm">
            <AddProjectForm
                :tags="['tag1', 'tag2']"
                @cancel="showAddProjectForm = false"
            />
        </div>

        <div
            v-else
            class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3"
        >
            <WorkSummaryCard
                v-for="project in props.projects"
                :key="project.id"
                :project="project"
            />
        </div>
    </section>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import AddProjectForm from '@/components/AddProjectForm.vue';
import Button from '@/components/ui/button/Button.vue';
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

    const showAddProjectForm = ref(false);
</script>

<style scoped>

</style>