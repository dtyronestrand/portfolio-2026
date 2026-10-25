<template>
    <div v-if="editor" class="border border-(--border) rounded-md overflow-hidden">
        <div class="bg-(--surface-container-high) border-b border-(--border) p-2 flex gap-1 flex-wrap">
            <button type="button" @click="editor.chain().focus().toggleBold().run()" :disabled="!editor.can().chain().focus().toggleBold().run()" :class="{'bg-(--inverse-surface)' : editor.isActive('bold') }" class="px-2 py-1 text-sm border rounded hover:bg-(--surface-container-low)">
                Bold
            </button>
              <button 
        type="button"
        @click="editor.chain().focus().toggleItalic().run()" 
        :disabled="!editor.can().chain().focus().toggleItalic().run()" 
        :class="{ 'bg-gray-200': editor.isActive('italic') }"
        class="px-2 py-1 text-sm border rounded hover:bg-(--surface-container-low)"
      >
        Italic
      </button>
        </div>
  <editor-content :editor="editor" class="prose max-w-none p-4 min-h-[150px] focus:outline-none" />
  </div>
</template>
<script setup lang="ts">
import {useEditor, EditorContent} from '@tiptap/vue-3'
import StarterKit from '@tiptap/starter-kit'
import {watch} from 'vue'

const props = defineProps({
    modelValue: {
        type: String,
        default: '',
    },
})

const emit = defineEmits(['update:modelValue'])

const editor = useEditor({
    content: props.modelValue,
    extensions: [StarterKit],
    onUpdate:({editor}) => {
        emit('update:modelValue', editor.getHTML())
    },
})

watch(() => props.modelValue, (value) => {
    const isSame = editor.value?.getHTML() === value
   
    if (!isSame) {
        editor.value?.commands.setContent(value, { emitUpdate: false })
    }
})
</script>
<style scoped>
.tiptap:focus {
    outline: none;
}
</style>