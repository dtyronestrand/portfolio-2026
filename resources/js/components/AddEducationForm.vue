<template>
    <form
        @submit.prevent="submit"
        class="flex flex-col gap-4 rounded-md border border-input/50 p-4"
    >
        <div class="flex flex-col gap-2">
            <label :for="`school-${uid}`">School</label>
            <Input type="text" :id="`school-${uid}`" v-model="form.school" />
            <InputError :message="form.errors.school" />
        </div>
        <div class="flex flex-col gap-2">
            <label :for="`degree-${uid}`">Degree</label>
            <Input type="text" :id="`degree-${uid}`" v-model="form.degree" />
            <InputError :message="form.errors.degree" />
        </div>
        <div class="flex flex-col gap-2">
            <label :for="`field_of_study-${uid}`">Field of Study</label>
            <Input
                type="text"
                :id="`field_of_study-${uid}`"
                v-model="form.field_of_study"
            />
            <InputError :message="form.errors.field_of_study" />
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
        <div class="flex justify-end gap-2">
            <Button type="button" variant="destructive" @click="emit('close')"
                >Cancel</Button
            >
            <Button type="submit" :disabled="form.processing">
                {{ props.education ? 'Save Changes' : 'Add Education' }}
            </Button>
        </div>
    </form>
</template>

<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import { useId } from 'vue';
import {
    store,
    update,
} from '@/actions/App/Http/Controllers/EducationController';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
const props = defineProps<{
    resumeId: number;
    education?: {
        id: number;
        school: string;
        degree: string;
        field_of_study: string;
        start_date: string;
        end_date: string | null;
    };
}>();
const emit = defineEmits(['close']);
const uid = useId();

const form = useForm({
    resume_id: props.resumeId,
    school: props.education?.school ?? '',
    degree: props.education?.degree ?? '',
    field_of_study: props.education?.field_of_study ?? '',
    start_date: props.education?.start_date ?? '',
    end_date: props.education?.end_date ?? '',
});

const submit = () => {
    const options = {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
            emit('close');
        },
    };

    if (props.education) {
        form.put(update.url(props.education.id), options);
    } else {
        form.post(store.url(), options);
    }
};
</script>

<style scoped></style>
