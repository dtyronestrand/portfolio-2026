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
        :class="{ 'bg-(--inverse-surface)': editor.isActive('italic') }"
        class="px-2 py-1 text-sm border rounded hover:bg-(--surface-container-low)"
      >
        Italic
      </button>

      
              <button
              type="button"
              @click="editor.chain().focus().toggleBulletList().run()"
              :class="{ 'bg-(--surface-container)': editor.isActive('bulletList') }"
              class="px-2 py-1 text-sm border rounded hover:bg-(--surface-container-low)"
              >
              Toggle bullet list
            </button>
            <button
            type="button"
            @click="editor.chain().focus().splitListItem('listItem').run()"
            :disabled="!editor.can().splitListItem('listItem')"
            >
            Split list item
        </button>
        <button
        type="button"
        @click="editor.chain().focus().sinkListItem('listItem').run()"
        :disabled="!editor.can().sinkListItem('listItem')"
        >
        Sink list item
    </button>
    <button
    type="button"
    @click="editor.chain().focus().liftListItem('listItem').run()"
    :disabled="!editor.can().liftListItem('listItem')"
    >
    Lift list item
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
:deep(.tiptap:focus) {
    outline: none;
}

:deep(.tiptap ul),
:deep(.tiptap ol) {
    padding: 0 1rem;
    margin: 1.25rem 1rem 1.25rem 0.4rem;
}

:deep(.tiptap ul) {
    list-style-type: disc;
}

:deep(.tiptap ol) {
    list-style-type: decimal;
}

:deep(.tiptap li p) {
    margin-top: 0.25em;
    margin-bottom: 0.25em;
}
</style>
