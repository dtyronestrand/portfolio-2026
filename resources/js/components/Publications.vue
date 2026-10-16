<template>
    <section data-screen-label="Publications" class="flex flex-col gap-6">
        <div class="flex flex-wrap items-end gap-9">
            <div class="min-w-260px flex-1">
                <h1 class="ds-headline-lg m-[0 0 6px]">Publications</h1>
                <p
                    class="text-md text-wrap-pretty m-0 max-w-[56ch] leading-3.5 text-(--text-muted)"
                ></p>
            </div>
            <Button @click="addPublication = true">Add Publication</Button>
        </div>
        <AddPublicationForm
            :resumeId="props.resumeId"
            v-if="addPublication"
            @close="addPublication = false"
        />
        <p
            v-if="!props.publications.length && !addPublication"
            class="text-md m-0 text-(--text-muted)"
        >
            No publications yet.
        </p>
        <template v-for="pub in props.publications" :key="pub.id">
            <AddPublicationForm
                v-if="editingId === pub.id"
                :resumeId="props.resumeId"
                :publication="pub"
                @close="editingId = null"
            />
            <div
                v-else
                class="group flex flex-col gap-2 rounded-md border border-input/50 p-4"
            >
                <div class="flex items-center justify-between gap-4">
                    <h3 class="ds-headline-sm m-0">{{ pub.title }}</h3>
                    <div class="flex items-center gap-2">
                        <div
                            class="flex gap-1 opacity-0 transition-opacity group-focus-within:opacity-100 group-hover:opacity-100 [@media(hover:none)]:opacity-100"
                        >
                            <Button
                                variant="ghost"
                                size="icon-sm"
                                :aria-label="`Edit ${pub.title}`"
                                @click="editingId = pub.id"
                            >
                                <Pencil />
                            </Button>
                            <Button
                                variant="ghost"
                                size="icon-sm"
                                class="text-destructive hover:text-destructive"
                                :aria-label="`Delete ${pub.title}`"
                                @click="deleting = pub"
                            >
                                <Trash2 />
                            </Button>
                        </div>
                        <p class="text-md m-0 text-(--text-muted)">
                            {{ pub.published_at }}
                        </p>
                    </div>
                </div>
                <p class="text-md m-0 text-(--text-muted)">
                    <template v-if="pub.authors">{{ pub.authors }} · </template
                    >{{ pub.publisher }}
                </p>
                <p v-if="pub.description" class="text-md m-0">
                    {{ pub.description }}
                </p>
                <a
                    v-if="pub.url"
                    :href="pub.url"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="text-md break-all underline"
                >
                    {{ pub.url }}
                </a>
            </div>
        </template>
        <Dialog
            :open="deleting !== null"
            @update:open="(open) => !open && (deleting = null)"
        >
            <DialogContent>
                <DialogHeader class="space-y-3">
                    <DialogTitle>Delete this publication?</DialogTitle>
                    <DialogDescription>
                        "{{ deleting?.title }}" will be permanently removed.
                    </DialogDescription>
                </DialogHeader>
                <DialogFooter class="gap-2">
                    <Button variant="secondary" @click="deleting = null"
                        >Cancel</Button
                    >
                    <Button
                        variant="destructive"
                        :disabled="deleteProcessing"
                        @click="deletePublication"
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
import { destroy } from '@/actions/App/Http/Controllers/PublicationController';
import AddPublicationForm from '@/components/AddPublicationForm.vue';
import Button from '@/components/ui/button/Button.vue';
import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
} from '@/components/ui/dialog';
interface Publication {
    id: number;
    title: string;
    authors: string | null;
    publisher: string;
    published_at: string;
    url: string | null;
    description: string | null;
}
interface Props {
    resumeId: number;
    publications: Publication[];
}
const props = defineProps<Props>();
const addPublication = ref(false);
const editingId = ref<number | null>(null);
const deleting = ref<Publication | null>(null);
const deleteProcessing = ref(false);

const deletePublication = () => {
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
