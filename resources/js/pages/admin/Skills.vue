<template>
    <section data-screen-label="Skills" class="flex flex-col gap-[24px]">
       
        <div class="flex flex-wrap items-end gap-[36px]">
            <div class="min-w-260px flex-1">
                <h1 class="ds-headline-lg m-[0 0 6px]">
                    Skills &amp; Proficiency
                </h1>
                <p
                    class="text-md text-wrap-pretty m-0 max-w-[56ch] leading-[14px] text-(--text-muted)"
                ></p>
            </div>
            <Button @click="showAddSkillForm = true">Add Skill</Button>
        </div>
        <AddSkillForm v-if="showAddSkillForm" :categories="categoryNames" @skillAdded="handleSkillAdded" @cancel="showAddSkillForm = false" />
        <div v-else class="flex flex-wrap items-start gap-[20px]">
            <div
                class="flex-[1 1 420px] min-w-0 overflow-hidden rounded-[8px] border border-(--border-card) bg-(--surface-container)"
            >
            
            <div class="p-[16px 20px 0] overflow-auto">
            <Tabs>
                <Tab
                v-for="category in props.categories"
                :key="category.id"
                :title="category.name"
                >
                <div class="grid grid-cols-[max-content_1fr] gap-x-8 gap-y-3 p-4">
                    <div
                    v-for="skill in category.skills"
                    :key="skill.id"
                    class="col-span-2 grid grid-cols-subgrid items-center"
                        >
                        <div>

                            <span class="text-md text-(--text-primary)">{{
                                skill.name
                            }}</span>
                            </div>
                        <div class="self-end">
                            <SkillLevelSteps :level="skill.level" variant="track" :showLabel=true :showCount=false></SkillLevelSteps>
                        </div>    
                        </div>
                        </div>
                    </Tab>
                </Tabs>
            </div>
            </div>
        </div>
    </section>
</template>

<script setup lang="ts">

import { ref, computed } from 'vue';
import AddSkillForm from '@/components/AddSkillForm.vue';
import SkillLevelSteps from '@/components/SkillLevelSteps.vue';
import Tab from '@/components/Tab.vue';
import Tabs from '@/components/Tabs.vue';
import Button from '@/components/ui/button/Button.vue';
interface Props {
    categories: {
        id: number;
        name: string;
        skills: {
            id: number;
            name: string;
            level: number;
        }[];
    }[];
}

const props = defineProps<Props>();
const showAddSkillForm = ref(false);
const handleSkillAdded = () => {
    showAddSkillForm.value = false;
};
const categoryNames = computed(() => props.categories.map((category) => ({ id: category.id, name: category.name })));
</script>

<style scoped></style>
