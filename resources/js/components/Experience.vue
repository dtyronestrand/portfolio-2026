<template>
    <section data-screen-label="Experience" class="flex flex-col gap-6">
        <div class="flex flex-wrap items-end gap-9">
            <div class="min-w-260px flex-1">
                <h1 class="ds-headline-lg m-[0 0 6px]">Experience</h1>
                <p
                    class="text-md text-wrap-pretty m-0 max-w-[56ch] leading-3.5 text-(--text-muted)"
                ></p>
            </div>
            <Button @click="addExperience = true">Add Experience</Button>
        </div>
        <template v-for="exp in props.experiences" :key="exp.id">
            <AddExperienceForm
                v-if="editingId === exp.id"
                :resumeId="props.resumeId"
                :experience="exp"
                @close="editingId = null"
            />
            <div
                v-else
                class="group flex flex-col gap-2 rounded-md border border-input/50 p-4"
            >
                <div class="flex items-center justify-between gap-4">
                    <h3 class="ds-headline-sm m-0">{{ exp.company }}</h3>
                    <div class="flex items-center gap-2">
                        <p class="text-md m-0 text-(--text-muted)">
                            {{ exp.start_date }} - {{ exp.end_date }}
                        </p>
                        <div
                            class="flex gap-1 opacity-0 transition-opacity group-focus-within:opacity-100 group-hover:opacity-100 [@media(hover:none)]:opacity-100"
                        >
                            <Button
                                variant="ghost"
                                size="icon-sm"
                                :aria-label="`Edit ${exp.company}`"
                                @click="editingId = exp.id"
                            >
                                <Pencil />
                            </Button>
                            <Button
                                variant="ghost"
                                size="icon-sm"
                                class="text-destructive hover:text-destructive"
                                :aria-label="`Delete ${exp.company}`"
                                @click="deleting = exp"
                            >
                                <Trash2 />
                            </Button>
                        </div>
                    </div>
                </div>
                <p class="text-md m-0 text-(--text-muted)">{{ exp.title }}</p>
                <ul>
                    <li
                        v-for="highlight in exp.highlights"
                        :key="highlight"
                        class="text-md m-0 text-(--text-muted)"
                    >
                        {{ highlight }}
                    </li>
                </ul>
            </div>
        </template>
    </section>
    <AddExperienceForm
        :resumeId="props.resumeId"
        v-if="addExperience"
        @close="addExperience = false"
    />
</template>

<script setup lang="ts">
import { Pencil, Trash2 } from '@lucide/vue';
import { ref } from 'vue';
import AddExperienceForm from '@/components/AddExperienceForm.vue';
import Button from '@/components/ui/button/Button.vue';
interface Experience {
    id: number;
    title: string;
    location: string;
    highlights: string[];
    company: string;
    start_date: string;
    end_date: string | null;
}
interface Props {
    resumeId: number;
    experiences: Experience[];
}
const props = defineProps<Props>();
const addExperience = ref(false);
const editingId = ref<number | null>(null);
const deleting = ref<Experience | null>(null);
</script>

<style scoped>
ul {
    list-style: inside disc;
}
</style>
