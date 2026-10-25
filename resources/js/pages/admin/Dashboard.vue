<template>
    <section data-screen-label="Dashboard" class="flex flex-col gap-[28px]">
        <div class="flex flex-wrap items-end gap-[16px]">
            <div class="min-w-[260px] flex-1">
                <h1>Portfolio Admin</h1>
            </div>
        </div>
        <div class="flex flex-row gap-4">
            <Button @click="activeForm = 'project'">New Work Product</Button>
            <Button @click="activeForm = 'skill'">New Skill</Button>
            <Button
                :disabled="!props.resumeId"
                @click="activeForm = 'education'"
                >New Education</Button
            >
            <Button
                :disabled="!props.resumeId"
                @click="activeForm = 'experience'"
                >New Experience</Button
            >
        </div>

        <div class="flex w-full justify-center" v-if="activeForm">
            <AddProjectForm
                v-if="activeForm === 'project'"
                :tags="props.tags"
                @cancel="closeForm"
                @project-added="closeForm"
            />
            <AddSkillForm
                v-else-if="activeForm === 'skill'"
                :categories="props.categories"
                @cancel="closeForm"
                @saved="closeForm"
            />
            <AddEducationForm
                v-else-if="activeForm === 'education' && props.resumeId"
                :resumeId="props.resumeId"
                @close="closeForm"
            />
            <AddExperienceForm
                v-else-if="activeForm === 'experience' && props.resumeId"
                :resumeId="props.resumeId"
                @close="closeForm"
            />
        </div>
    </section>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import AddEducationForm from '@/components/AddEducationForm.vue';
import AddExperienceForm from '@/components/AddExperienceForm.vue';
import AddProjectForm from '@/components/AddProjectForm.vue';
import AddSkillForm from '@/components/AddSkillForm.vue';
import Button from '@/components/ui/button/Button.vue';
interface Props {
    tags: {
        id: number;
        name: string;
    }[];
    categories: {
        id: number;
        name: string;
    }[];
    resumeId: number | null;
}
const props = defineProps<Props>();

type FormType = 'project' | 'skill' | 'education' | 'experience';
const activeForm = ref<FormType | null>(null);

const closeForm = () => {
    activeForm.value = null;
};
</script>

<style scoped></style>
