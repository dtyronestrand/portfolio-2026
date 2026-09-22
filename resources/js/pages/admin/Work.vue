<template>
      <div class="flex flex-wrap items-end gap-[36px]">
            <div class="min-w-260px flex-1">
                <h1 class="ds-headline-lg m-[0 0 6px]">
                   Projects
                </h1>
                <p
                    class="text-md text-wrap-pretty m-0 max-w-[56ch] leading-[14px] text-(--text-muted)"
                ></p>
            </div>
            <Button @click="showAddProjectForm = true">Add Project</Button>
        </div>
        <div v-if="showAddProjectForm">
        <AddProjectForm  :tags="['tag1', 'tag2']" @cancel="showAddProjectForm = false" />
    </div>
    <div v-else v-for="project in props.projects" :key="project.id">
        <WorkSummaryCard :project="project" />
    </div>
</template>

<script setup lang="ts">
import Button from 'primevue/button';
import { ref } from 'vue';
import AddProjectForm from '@/components/AddProjectForm.vue';
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