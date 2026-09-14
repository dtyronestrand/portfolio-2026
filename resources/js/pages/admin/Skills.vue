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
            <Button>Add Skill</Button>
        </div>
        <div class="flex flex-wrap items-start gap-[20px]">
            <div
                class="flex-[1 1 420px] min-w-0 overflow-hidden rounded-[8px] border border-(--border-card) bg-(--surface-container)"
            >
                <Tabs>
                    <Tab
                        v-for="category in props.categories"
                        :key="category.id"
                        :title="category.name"
                    >
                        <div class="flex flex-col gap-[12px] p-[16px]">
                            <div
                                v-for="skill in category.skills"
                                :key="skill.id"
                                class="flex items-center justify-between gap-[12px]"
                            >
                                <span class="text-md text-(--text-primary)">{{
                                    skill.name
                                }}</span>
                                <span class="text-sm text-(--text-muted)"
                                    >{{ skill.proficiency }}%</span
                                >
                            </div>
                        </div>
                    </Tab>
                </Tabs>
            </div>
        </div>
    </section>
</template>

<script setup lang="ts">
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
            proficiency: number;
        }[];
    }[];
}

const props = defineProps<Props>();
</script>

<style scoped></style>
