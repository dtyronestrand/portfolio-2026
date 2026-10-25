<template>
    <form
        @submit.prevent="handleSubmit"
        class="flex max-w-180 min-w-0 flex-[1_1_300px] flex-col gap-6 rounded-lg border border-(--border-card) bg-(--surface-container-low) p-6"
    >
        <div class="flex flex-col gap-1">
            <span class="text-xs tracking-wider text-(--text-muted) uppercase"
                >New Project</span
            >
            <h2 class="m-0 text-xl font-semibold text-(--text-display)">
                Add Project
            </h2>
        </div>

        <section class="flex flex-col gap-4">
            <div class="flex flex-col gap-2">
                <Label for="name">Name</Label>
                <Input
                    type="text"
                    id="name"
                    v-model="form.name"
                    placeholder="Enter project name"
                />
            </div>
            <div class="flex flex-col gap-2">
                <Label for="slug">Slug</Label>
                <Input
                    type="text"
                    id="slug"
                    v-model="form.slug"
                    placeholder="Leave blank to generate from the name"
                />
            </div>
            <div class="flex flex-col gap-2">
                <Label for="summary">Summary</Label>
                <Input
                    type="text"
                    id="summary"
                    v-model="form.summary"
                    placeholder="One-sentence summary for the project card"
                />
            </div>
            <div class="flex flex-col gap-2">
                <Label>Hero Image</Label>
                <MediaUpload
                    name="hero"
                    accept="image/*"
                    @update:model-value="
                        (files) => (form.hero = files[0] ?? null)
                    "
                />
            </div>
        </section>

        <section class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div class="flex flex-col gap-2">
                <Label for="role">Role</Label>
                <Input
                    type="text"
                    id="role"
                    v-model="form.role"
                    placeholder="e.g. Instructional Designer"
                />
            </div>
            <div class="flex flex-col gap-2">
                <Label for="audience">Audience</Label>
                <Input
                    type="text"
                    id="audience"
                    v-model="form.audience"
                    placeholder="Who the project was built for"
                />
            </div>
            <div class="flex flex-col gap-2">
                <Label for="modality">Modality</Label>
                <Input
                    type="text"
                    id="modality"
                    v-model="form.modality"
                    placeholder="e.g. eLearning, Blended"
                />
            </div>
            <div class="flex flex-col gap-2">
                <Label for="completed_at">Completed</Label>
                <Input
                    type="text"
                    id="completed_at"
                    v-model="form.completed_at"
                    placeholder="e.g. March 2026"
                />
            </div>
            <div class="flex flex-col gap-2">
                <Label for="seat_time">Seat Time</Label>
                <Input
                    type="text"
                    id="seat_time"
                    v-model="form.seat_time"
                    placeholder="e.g. 30 minutes"
                />
            </div>
            <div class="flex flex-col gap-2">
                <Label for="demo_url">Demo URL</Label>
                <Input
                    type="url"
                    id="demo_url"
                    v-model="form.demo_url"
                    placeholder="https://"
                />
            </div>
        </section>

        <section class="flex flex-col gap-4">
            <div class="flex flex-col gap-2">
                <Label for="challenge">Challenge</Label>
              <TiptapEditor v-model="form.challenge"/>
            </div>
            <div class="flex flex-col gap-2">
                <Label for="solution">Solution</Label>
             <TiptapEditor v-model="form.solution"/>
            </div>
            <div class="flex flex-col gap-2">
                <Label for="learning_objectives">Learning Objectives</Label>
              <TiptapEditor v-model="form.learning_objectives"/>
            </div>
            <div class="flex flex-col gap-2">
                <Label for="process">Process</Label>
                <TiptapEditor v-model="form.process"/>
            </div>
            <div class="flex flex-col gap-2">
                <Label for="design_rationale">Design Rationale</Label>
                <TiptapEditor v-model="form.design_rationale"/>
            </div>
            <div class="flex flex-col gap-2">
                <Label for="reflection">Reflection</Label>
              <TiptapEditor v-model="form.reflection"/>
            </div>
            <div class="flex flex-col gap-2">
                <Label for="tags">Tags</Label>
                <select
                    id="tags"
                    v-model="form.tags"
                    multiple
                    class="h-9 w-full rounded-md border border-input bg-transparent px-3 py-1 text-sm text-(--text-body) shadow-xs outline-none focus-visible:border-ring focus-visible:ring-[3px] focus-visible:ring-ring/50"
                >
                    <option disabled value="">Select Tags</option>
                    <option
                        v-for="tag in props.tags"
                        :key="tag.id"
                        :value="tag.id"
                        class="bg-(--surface-container) text-(--text-body)"
                    >
                        {{ tag.name }}
                    </option>
                </select>
            </div>
            <div class="flex flex-col gap-2">
                <Label for="new_tags">New Tags</Label>
                <Input
                    type="text"
                    id="new_tags"
                    v-model="newTags"
                    placeholder="Comma-separated, e.g. Storyline, Accessibility"
                />
            </div>
        </section>

        <section class="flex flex-wrap items-end gap-6">
            <div class="flex flex-col gap-2">
                <Label for="sort_order">Sort Order</Label>
                <Input
                    type="number"
                    id="sort_order"
                    min="0"
                    v-model.number="form.sort_order"
                    class="w-28"
                />
            </div>
            <div class="flex items-center gap-2 pb-2">
                <Checkbox id="is_published" v-model="form.is_published" />
                <Label for="is_published">Published</Label>
            </div>
            <div class="flex items-center gap-2 pb-2">
                <Checkbox id="featured" v-model="form.featured" />
                <Label for="featured">Featured</Label>
            </div>
        </section>

        <section class="flex flex-col gap-4">
            <div class="flex flex-col gap-2">
                <Label>Gallery</Label>
                <MediaUpload
                    name="gallery"
                    accept="image/*"
                    multiple
                    v-model="form.gallery"
                />
            </div>
            <div class="flex flex-col gap-2">
                <Label>Storyboard</Label>
                <MediaUpload
                    name="storyboard"
                    multiple
                    v-model="form.storyboard"
                />
            </div>
            <div class="flex flex-col gap-2">
                <Label>Design Docs</Label>
                <MediaUpload
                    name="design_docs"
                    multiple
                    v-model="form.design_docs"
                />
            </div>
            <div class="flex flex-col gap-2">
                <Label>Video</Label>
                <MediaUpload
                    name="video"
                    accept="video/*"
                    multiple
                    v-model="form.video"
                />
            </div>
        </section>

        <Message
            v-if="Object.keys(form.errors).length"
            severity="error"
            size="small"
        >
            <ul class="m-0 list-disc pl-4">
                <li v-for="(error, field) in form.errors" :key="field">
                    {{ error }}
                </li>
            </ul>
        </Message>

        <div class="flex flex-row justify-end gap-3 pt-2">
            <Button
                type="button"
                variant="destructive"
                severity="secondary"
                size="sm"
                @click="handleCancel"
                >Cancel</Button
            >
            <Button type="submit" size="sm" :disabled="form.processing">{{
                form.processing ? 'Saving...' : 'Add Project'
            }}</Button>
        </div>
    </form>
</template>

<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import Message from 'primevue/message';
import TiptapEditor from './TiptapEditor.vue';
import { ref } from 'vue';
import MediaUpload from '@/components/MediaUpload.vue';
import Button from '@/components/ui/button/Button.vue';
import { Checkbox } from '@/components/ui/checkbox';
import Input from '@/components/ui/input/Input.vue';
import Label from '@/components/ui/label/Label.vue';


interface Props {
    tags: {
        id: number;
        name: string;
    }[];
}


// Edited as one objective per line, sent to the server as an array.
const learningObjectives = ref('');
// Tags that don't exist yet, typed as a comma-separated list and sent by name.
const newTags = ref('');

const form = useForm<{
    name: string;
    slug: string;
    summary: string;
    role: string;
    audience: string;
    completed_at: string;   
    challenge: string;
    solution: string;
    modality: string;
    learning_objectives: string;
    process: string;
    seat_time: string;
    design_rationale: string;
    demo_url: string;
    sort_order: number;
    is_published: boolean;
    featured: boolean;
    reflection: string;
    tags: number[];
    new_tags: string[];
    hero: File | null;
    gallery: File[];
    storyboard: File[];
    design_docs: File[];
    video: File[];
}>({
    name: '',
    slug: '',
    summary: '',
    role: '',
    audience: '',
    completed_at: '',
    challenge: '',
    solution: '',
    modality: '',
    learning_objectives: '',
    process: '',
    seat_time: '',
    design_rationale: '',
    demo_url: '',
    sort_order: 0,
    is_published: false,
    featured: false,
    reflection: '',
    tags: [],
    new_tags: [],
    hero: null,
    gallery: [],
    storyboard: [],
    design_docs: [],
    video: [],
});

const props = defineProps<Props>();
const emit = defineEmits(['cancel', 'projectAdded']);

const handleCancel = () => {
    emit('cancel');
};

function handleSubmit() {
    form.transform((data) => ({
        ...data,
        learning_objectives: learningObjectives.value
            .split('\n')
            .map((line) => line.trim())
            .filter(Boolean),
        new_tags: newTags.value
            .split(',')
            .map((name) => name.trim())
            .filter(Boolean),
        // FormData can't send real booleans; Laravel's boolean rule accepts 1/0.
        is_published: data.is_published ? 1 : 0,
        featured: data.featured ? 1 : 0,
    })).post('/admin/projects', {
        forceFormData: true,
        onSuccess: () => {
            form.reset();
            learningObjectives.value = '';
            newTags.value = '';
            emit('projectAdded');
        },
    });
}
</script>
