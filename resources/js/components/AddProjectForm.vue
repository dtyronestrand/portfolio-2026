<template>
    <form @submit.prevent="handleSubmit" class="flex-[1_1_300px] min-w-0 max-w-[720px] p-6 border border-(--border-card) rounded-lg bg-(--surface-container-low) flex flex-col gap-6">
        <div class="flex flex-col gap-1">
            <span class="text-xs text-(--text-muted) tracking-wider uppercase">New Project</span>
            <h2 class="text-xl font-semibold m-0 text-(--text-display)">Add Project</h2>
        </div>

        <section class="flex flex-col gap-4">
            <div class="flex flex-col gap-2">
                <Label for="name">Name</Label>
                <Input type="text" id="name" v-model="form.name" placeholder="Enter project name" />
            </div>
            <div class="flex flex-col gap-2">
                <Label for="problem">Problem</Label>
                <Textarea rows="4" autoresize id="problem" v-model="form.problem" class="w-full rounded-md border border-input bg-transparent px-3 py-2 text-sm shadow-xs outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px]" placeholder="Describe the problem being solved..."></Textarea>
            </div>
            <div class="flex flex-col gap-2">
                <Label for="product">Product</Label>
                <Textarea rows="4" autoresize id="product" v-model="form.product" class="w-full rounded-md border border-input bg-transparent px-3 py-2 text-sm shadow-xs outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px]" placeholder="Describe the product or solution..."></Textarea>
            </div>
            <div class="flex flex-col gap-2">
                <Label for="tags">Tags</Label>
                <select id="tags" v-model="form.tags" class="h-9 w-full rounded-md border border-input bg-transparent px-3 py-1 text-sm shadow-xs outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] text-(--text-body)">
                    <option disabled value="">Select Tags</option>
                    <option v-for="tag in props.tags" :key="tag" :value="tag" class="bg-(--surface-container) text-(--text-body)">
                        {{ tag }}
                    </option>
                    <option value="new-tag" class="bg-(--surface-container) text-(--text-body)">Add New Tag</option>
                </select>
            </div>
        </section>

        <section class="flex flex-col gap-2">
            <Label>Attachments</Label>
            <FileUpload ref="attachments" name="attachments" url="/admin/work" mode="advanced" :pt="{
                root: {class: 'border! border-dashed! rounded-lg'},
                header: {class: 'hidden!'},
                content: {class: 'p-6!'}
            }"
             :multiple="true">
             <template #content="{files, removeFileCallback, messages}">
                <div class="flex flex-col gap-4">
                    <div v-if="messages?.length" class="flex flex-col gap-2">
                        <Message v-for="msg of messages" :key="msg" severity="error">{{ msg }}</Message>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-(--text-muted)">{{ files.length }} file(s) selected</span>
                        <div class="flex items-center gap-2">
                            <Button variant="text" size="small" @click="onUpload">Upload</Button>
                            <Button variant="text" size="small" severity="danger" @click="onClear">Clear All</Button>
                        </div>
                    </div>
                    <div v-if="files.length" class="flex flex-col gap-2">
                        <div v-for="(file, index) of files" :key="file.name + file.size" class="flex items-center justify-between p-3 rounded-lg bg-(--surface-container)">
                            <div class="flex items-center gap-3">
                                <CloudUpload class="text-(--primary) shrink-0"/>
                                <div class="flex flex-col">
                                    <span class="text-sm font-medium">{{ file.name }}</span>
                                    <span class="text-sm text-(--text-muted)">{{ formatSize(file) }}</span>
                                </div>
                            </div>
                            <Button type="button" iconOnly variant="text" severity="secondary" size="small" rounded @click="removeFileCallback(index)"><Times/></Button>
                        </div>
                    </div>
                </div>
            </template>
            <template #empty>
                <div class="flex flex-col items-center justify-center gap-3 py-8 cursor-pointer" @click="onChoose">
                    <CloudUpload :size="48" class="text-(--text-muted)"/>
                    <div class="text-center">
                        <p class="text-lg font-medium mt-0 mb-1">Drop files here</p>
                        <p class="text-sm text-(--text-muted) m-0">or click to browse</p> 
                    </div>
                </div>
            </template>
            </FileUpload>
        </section>

        <div class="flex flex-row justify-end gap-3 pt-2">
            <Button type="button" variant="text" severity="secondary" size="small" @click="handleCancel">Cancel</Button>
            <Button type="submit" size="small" :disabled="form.processing">{{ form.processing ? 'Saving...' : 'Add Project' }}</Button>
        </div>
    </form>
</template>

<script setup lang="ts">
import { useForm, router } from '@inertiajs/vue3';
import CloudUpload from '@primeicons/vue/cloud-upload';
import Times from '@primeicons/vue/times';
import Button from 'primevue/button';
import FileUpload from 'primevue/fileupload';
import Message from 'primevue/message';
import Textarea from 'primevue/textarea';
import {ref} from 'vue';
import Input from '@/components/ui/input/Input.vue';
import Label from '@/components/ui/label/Label.vue';

interface Props {
    tags: string[]
}
const attachments = ref()
const onChoose = () => {
    attachments.value.choose()
}
const onUpload = () => {
    attachments.value.upload()
}
const onClear = () => {
    attachments.value.clear()
}
const formatSize = (bytes: number)=>{
    if (bytes === 0) {
        return '0 B'
    }

;

        // Adding a blank line after the conditional statement

    const k = 1024
    const sizes = ['B', 'KB', 'MB'];
    const i = Math.floor(Math.log(bytes)/Math.log(k));

    return parseFloat((bytes / Math.pow(k, i)).toFixed(1)) + ' ' + sizes[i];
}
const props = defineProps<Props>()
const emit = defineEmits(['cancel', 'projectAdded'])

const handleCancel = () => {
    emit('cancel')
}

const form = useForm({
    name: '',
    problem: '',
    product: '',
    tags: [],
    media: null
})


function handleSubmit() {
    form.post('projects.store', {
        forceFormData: true,
        onSuccess: ()=>{
            router.get('admin.dashboard')
        }
    })
}
</script>

<style scoped>

</style>