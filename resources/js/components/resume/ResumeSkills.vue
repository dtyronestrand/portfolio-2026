<script setup lang="ts">
import type { ResumeSkillCategory } from '@/types';

interface Props {
    categories: ResumeSkillCategory[];
}

defineProps<Props>();

const levels = ['Beginner', 'Intermediate', 'Advanced', 'Expert'];

const levelIndex = (level: number) =>
    Math.min(Math.max(Math.round(level), 1), levels.length) - 1;
</script>

<template>
    <div class="grid gap-6 md:grid-cols-2">
        <div
            v-for="category in categories"
            :key="category.name"
            class="rounded-lg border border-border bg-card p-6"
        >
            <h3
                class="font-mono text-xs font-medium tracking-[0.05em] text-primary uppercase"
            >
                {{ category.name }}
            </h3>
            <ul class="mt-5 flex flex-col gap-4">
                <li v-for="skill in category.skills" :key="skill.id">
                    <div class="flex items-baseline justify-between gap-4">
                        <span class="font-semibold text-foreground">{{
                            skill.name
                        }}</span>
                        <span class="text-sm text-(--text-faint)">{{
                            levels[levelIndex(skill.level)]
                        }}</span>
                    </div>
                    <div
                        class="mt-2 flex gap-1"
                        role="meter"
                        :aria-label="`${skill.name} proficiency`"
                        :aria-valuenow="levelIndex(skill.level) + 1"
                        aria-valuemin="1"
                        :aria-valuemax="levels.length"
                        :aria-valuetext="levels[levelIndex(skill.level)]"
                    >
                        <span
                            v-for="(level, i) in levels"
                            :key="level"
                            class="h-1.5 flex-1 rounded-full"
                            :class="
                                i <= levelIndex(skill.level)
                                    ? 'bg-primary'
                                    : 'bg-(--surface-container-highest)'
                            "
                        ></span>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</template>
