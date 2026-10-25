<template>
    <section data-screen-label="Education" class="flex flex-col gap-6">
        <div class="flex flex-wrap items-end gap-9">
            <div class="min-w-260px flex-1">
                <h2 class="m-[0 0 6px]">Education</h2>
                <p
                    class="text-md text-wrap-pretty m-0 max-w-[56ch] leading-3.5 text-(--text-muted)"
                ></p>
            </div>
            <Button @click="addEducation = true">Add Education</Button>
        </div>
        <template v-for="edu in props.education" :key="edu.id">
            <AddEducationForm
                v-if="editingId === edu.id"
                :resumeId="props.resumeId"
                :education="edu"
                @close="editingId = null"
            />
            <div
                v-else
                class="group flex flex-col gap-2 rounded-md border border-input/50 p-4"
            >
                <div class="flex items-center justify-between gap-4">
                    <h3 class="ds-headline-sm m-0">{{ edu.school }}</h3>
                    <div class="flex items-center gap-2">
                        <div
                            class="flex gap-1 opacity-0 transition-opacity group-focus-within:opacity-100 group-hover:opacity-100 [@media(hover:none)]:opacity-100"
                        >
                            <Button
                                variant="ghost"
                                size="icon-sm"
                                :aria-label="`Edit ${edu.school}`"
                                @click="editingId = edu.id"
                            >
                                <Pencil />
                            </Button>
                            <Button
                                variant="ghost"
                                size="icon-sm"
                                class="text-destructive hover:text-destructive"
                                :aria-label="`Delete ${edu.school}`"
                                @click="deleting = edu"
                            >
                                <Trash2 />
                            </Button>
                        </div>
                        <p class="text-md m-0 text-(--text-muted)">
                            {{ edu.start_date }} - {{ edu.end_date }}
                        </p>
                    </div>
                </div>
                <p class="text-md m-0 text-(--text-muted)">
                    {{ edu.degree }} in {{ edu.field_of_study }}
                </p>
            </div>
        </template>
        <AddEducationForm
            :resumeId="props.resumeId"
            v-if="addEducation"
            @close="addEducation = false"
        />
        <Dialog
            :open="deleting !== null"
            @update:open="(open) => !open && (deleting = null)"
        >
            <DialogContent>
                <DialogHeader class="space-y-3">
                    <DialogTitle>Delete this education entry?</DialogTitle>
                    <DialogDescription>
                        {{ deleting?.degree }} in
                        {{ deleting?.field_of_study }} at
                        {{ deleting?.school }} will be permanently removed.
                    </DialogDescription>
                </DialogHeader>
                <DialogFooter class="gap-2">
                    <Button variant="secondary" @click="deleting = null"
                        >Cancel</Button
                    >
                    <Button
                        variant="destructive"
                        :disabled="deleteProcessing"
                        @click="deleteEducation"
                    >
                        Delete
                    </Button>
                </DialogFooter>
            </DialogContent>
        </Dialog>
    </section>
</template>

<script setup lang="ts">
import { router } from '@inertiajs/vue3';
import { Pencil, Trash2 } from '@lucide/vue';
import { ref } from 'vue';
import { destroy } from '@/actions/App/Http/Controllers/EducationController';
import AddEducationForm from '@/components/AddEducationForm.vue';
import Button from '@/components/ui/button/Button.vue';
import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
} from '@/components/ui/dialog';
interface Education {
    id: number;
    school: string;
    degree: string;
    field_of_study: string;
    start_date: string;
    end_date: string;
}
interface Props {
    resumeId: number;
    education: Education[];
}
const props = defineProps<Props>();
const addEducation = ref(false);
const editingId = ref<number | null>(null);
const deleting = ref<Education | null>(null);
const deleteProcessing = ref(false);

const deleteEducation = () => {
    if (!deleting.value) {
        return;
    }

    router.delete(destroy.url(deleting.value.id), {
        preserveScroll: true,
        onStart: () => (deleteProcessing.value = true),
        onFinish: () => (deleteProcessing.value = false),
        onSuccess: () => (deleting.value = null),
    });
};
</script>

<style scoped></style>
