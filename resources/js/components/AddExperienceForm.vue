<template>
    <form
        @submit.prevent="submit"
        class="flex flex-col gap-4 rounded-md border border-input/50 p-4"
    >
        <div class="flex flex-col gap-2">
            <label :for="`company-${uid}`">Company</label>
            <Input type="text" :id="`company-${uid}`" v-model="form.company" />
            <InputError :message="form.errors.company" />
        </div>
        <div class="flex flex-col gap-2">
            <label :for="`location-${uid}`">Location</label>
            <Input
                type="text"
                :id="`location-${uid}`"
                v-model="form.location"
            />
            <InputError :message="form.errors.location" />
        </div>
        <div class="flex flex-col gap-2">
            <label :for="`title-${uid}`">Title</label>
            <Input type="text" :id="`title-${uid}`" v-model="form.title" />
            <InputError :message="form.errors.title" />
        </div>
        <div class="flex flex-col gap-2">
            <label :for="`start_date-${uid}`">Start Date</label>
            <Input
                type="date"
                :id="`start_date-${uid}`"
                v-model="form.start_date"
            />
            <InputError :message="form.errors.start_date" />
        </div>
        <div class="flex flex-col gap-2">
            <label :for="`end_date-${uid}`">End Date</label>
            <Input
                type="date"
                :id="`end_date-${uid}`"
                v-model="form.end_date"
            />
            <InputError :message="form.errors.end_date" />
        </div>
        <div class="flex flex-col gap-2">
            <label :for="`highlights-${uid}`">Highlights</label>
            <template v-for="(highlight, index) in form.highlights" :key="index">
                <div class="flex gap-2">
                    <Input
                        type="text"
                        :id="`highlights-${uid}-${index}`"
                        v-model="form.highlights[index]"
                    />
                    <Button
                        type="button"
                        variant="destructive"
                        @click="form.highlights.splice(index, 1)"
                    >
                        Remove
                    </Button>
                </div>
            </template>
            <Button
                type="button"
                @click="form.highlights.push('')"
            >
                Add Highlight
            </Button>
            <InputError :message="form.errors.highlights" />    
        </div>
        <div class="flex justify-end gap-2">
            <Button type="button" variant="destructive" @click="$emit('close')"
                >Cancel</Button
            >
            <Button type="submit" :disabled="form.processing">
                {{ props.experience ? 'Save Changes' : 'Add Experience' }}
            </Button>
        </div>
    </form>
</template>

<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import { useId } from 'vue';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
const props = defineProps<{
    resumeId: number;
    experience?: {
        id: number;
        company: string;
        location: string;
        highlights: string[];
        title: string;
        start_date: string;
        end_date: string | null;
    };
}>();
const emit = defineEmits(['close']);
const uid = useId();
const form = useForm({
    resume_id: props.resumeId,
    company: props.experience?.company ?? '',
    location: props.experience?.location ?? '',
    highlights: props.experience?.highlights ?? [],
    title: props.experience?.title ?? '',
    start_date: props.experience?.start_date ?? '',
    end_date: props.experience?.end_date ?? '',
});

const submit = () => {
    const options = {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
            emit('close');
        },
    };

    if (props.experience) {
        form.put(`/admin/experiences/${props.experience.id}`, options);
    } else {
        form.post('/admin/experiences', options);
    }
};
</script>

<style scoped></style>
