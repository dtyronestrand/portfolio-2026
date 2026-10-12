<template>
    <form
        @submit.prevent="submit"
        class="flex flex-col gap-4 rounded-md border border-input/50 p-4"
    >
        <div class="flex flex-col gap-2">
            <label :for="`title-${uid}`">Title</label>
            <Input type="text" :id="`title-${uid}`" v-model="form.title" />
            <InputError :message="form.errors.title" />
        </div>
        <div class="flex flex-col gap-2">
            <label :for="`authors-${uid}`">Authors</label>
            <Input type="text" :id="`authors-${uid}`" v-model="form.authors" />
            <InputError :message="form.errors.authors" />
        </div>
        <div class="flex flex-col gap-2">
            <label :for="`publisher-${uid}`">Publisher</label>
            <Input
                type="text"
                :id="`publisher-${uid}`"
                v-model="form.publisher"
            />
            <InputError :message="form.errors.publisher" />
        </div>
        <div class="flex flex-col gap-2">
            <label :for="`published_at-${uid}`">Published</label>
            <Input
                type="date"
                :id="`published_at-${uid}`"
                v-model="form.published_at"
            />
            <InputError :message="form.errors.published_at" />
        </div>
        <div class="flex flex-col gap-2">
            <label :for="`url-${uid}`">URL</label>
            <Input
                type="url"
                :id="`url-${uid}`"
                v-model="form.url"
                placeholder="https://"
            />
            <InputError :message="form.errors.url" />
        </div>
        <div class="flex flex-col gap-2">
            <label :for="`description-${uid}`">Description</label>
            <Textarea
                :id="`description-${uid}`"
                v-model="form.description"
                rows="4"
            ></Textarea>
            <InputError :message="form.errors.description" />
        </div>
        <div class="flex justify-end gap-2">
            <Button type="button" variant="destructive" @click="emit('close')"
                >Cancel</Button
            >
            <Button type="submit" :disabled="form.processing">
                {{ props.publication ? 'Save Changes' : 'Add Publication' }}
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
} from '@/actions/App/Http/Controllers/PublicationController';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Textarea } from '@/components/ui/textarea';
const props = defineProps<{
    resumeId: number;
    publication?: {
        id: number;
        title: string;
        authors: string | null;
        publisher: string;
        published_at: string;
        url: string | null;
        description: string | null;
    };
}>();
const emit = defineEmits(['close']);
const uid = useId();

const form = useForm({
    resume_id: props.resumeId,
    title: props.publication?.title ?? '',
    authors: props.publication?.authors ?? '',
    publisher: props.publication?.publisher ?? '',
    published_at: props.publication?.published_at ?? '',
    url: props.publication?.url ?? '',
    description: props.publication?.description ?? '',
});

const submit = () => {
    const options = {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
            emit('close');
        },
    };

    if (props.publication) {
        form.put(update.url(props.publication.id), options);
    } else {
        form.post(store.url(), options);
    }
};
</script>

<style scoped></style>
