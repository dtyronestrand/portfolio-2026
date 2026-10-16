<template>
    <FileUpload
        ref="upload"
        :name="props.name"
        :accept="props.accept"
        :multiple="props.multiple"
        :auto="false"
        :custom-upload="true"
        mode="advanced"
        @select="onSelect"
        @remove="onRemove"
        :pt="{
            root: {
                class: 'border! border-dashed! border-primary rounded-lg',
            },
            input: {
                class: 'hidden',
            },
            content: { class: 'p-6!' },
        }"
    >
        <template #header>
            <span class="hidden"></span>
        </template>
        <template #content="{ files, removeFileCallback, messages }">
            <div class="flex flex-col gap-4">
                <div v-if="messages?.length" class="flex flex-col gap-2">
                    <Message
                        v-for="msg of messages"
                        :key="msg"
                        severity="error"
                        >{{ msg }}</Message
                    >
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-(--text-muted)"
                        >{{ files.length }} file(s) selected</span
                    >
                    <Button
                        type="button"
                        variant="destructive"
                        size="sm"
                        @click="clear"
                        >{{ props.multiple ? 'Clear All' : 'Clear' }}</Button
                    >
                </div>
                <div v-if="files.length" class="flex flex-col gap-2">
                    <div
                        v-for="(file, index) of files"
                        :key="file.name + file.size"
                        class="flex items-center justify-between rounded-lg bg-(--surface-container) p-3"
                    >
                        <div class="flex items-center gap-3">
                            <CloudUpload class="shrink-0 text-primary" />
                            <div class="flex flex-col">
                                <span class="text-sm font-medium">{{
                                    file.name
                                }}</span>
                                <span class="text-sm text-(--text-muted)">{{
                                    formatSize(file.size)
                                }}</span>
                            </div>
                        </div>
                        <Button
                            type="button"
                            variant="ghost"
                            size="sm"
                            aria-label="Remove file"
                            @click="removeFileCallback(index)"
                            ><Times color="#ffa2a2"
                        /></Button>
                    </div>
                </div>
            </div>
        </template>
        <template #empty>
            <div
                class="flex cursor-pointer flex-col items-center justify-center gap-3 py-8"
                @click="upload?.choose()"
            >
                <CloudUpload :size="48" class="text-(--text-muted)" />
                <div class="text-center">
                    <p class="mt-0 mb-1 text-lg font-medium">Drop files here</p>
                    <p class="m-0 text-sm text-(--text-muted)">
                        or click to browse
                    </p>
                </div>
            </div>
        </template>
    </FileUpload>
</template>

<script setup lang="ts">
import CloudUpload from '@primeicons/vue/cloud-upload';
import Times from '@primeicons/vue/times';
import FileUpload from 'primevue/fileupload';
import type {
    FileUploadRemoveEvent,
    FileUploadSelectEvent,
} from 'primevue/fileupload';
import Message from 'primevue/message';
import { ref } from 'vue';
import Button from '@/components/ui/button/Button.vue';

interface Props {
    name: string;
    accept?: string;
    multiple?: boolean;
}
const props = withDefaults(defineProps<Props>(), {
    accept: undefined,
    multiple: false,
});

const files = defineModel<File[]>({ default: () => [] });
const upload = ref();

const onSelect = (event: FileUploadSelectEvent) => {
    files.value = [...event.files];
};
const onRemove = (event: FileUploadRemoveEvent) => {
    files.value = [...event.files];
};
const clear = () => {
    upload.value?.clear();
    files.value = [];
};

const formatSize = (bytes: number) => {
    if (bytes === 0) {
        return '0 B';
    }

    const k = 1024;
    const sizes = ['B', 'KB', 'MB', 'GB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));

    return parseFloat((bytes / Math.pow(k, i)).toFixed(1)) + ' ' + sizes[i];
};

defineExpose({ clear });
</script>

<style scoped>
:deep(input[type='file']) {
    display: none !important;
}
</style>
