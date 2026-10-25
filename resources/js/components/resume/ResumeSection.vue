<script setup lang="ts">
import { computed } from 'vue';

interface Props {
    id: string;
    /** Omit to render the section without a header; give a slotted heading `${id}-title`. */
    title?: string;
    /** The part of the title rendered in the accent colour. */
    highlight?: string;
    description?: string;
}

const props = defineProps<Props>();

const titleParts = computed(() => {
    const title = props.title ?? '';
    const at = props.highlight ? title.indexOf(props.highlight) : -1;

    if (at === -1) {
        return { before: title, accent: '', after: '' };
    }

    return {
        before: title.slice(0, at),
        accent: props.highlight!,
        after: title.slice(at + props.highlight!.length),
    };
});
</script>

<template>
    <section
        :id="id"
        :aria-labelledby="`${id}-title`"
        class="scroll-mt-28 border-b border-border py-12 last:border-b-0 lg:py-16"
    >
        <header v-if="title" class="mb-8">
            <h2
                :id="`${id}-title`"
                class="font-serif text-[clamp(1.75rem,3vw,2rem)] leading-tight font-semibold tracking-tight text-(--text-display)"
            >
                {{ titleParts.before
                }}<span class="text-primary">{{ titleParts.accent }}</span
                >{{ titleParts.after }}
            </h2>
            <div class="section-rule mt-3 h-0.5 w-12 rounded-full"></div>
            <p
                v-if="description"
                class="mt-4 max-w-[60ch] text-pretty text-(--text-muted)"
            >
                {{ description }}
            </p>
        </header>
        <slot />
    </section>
</template>

<style scoped>
.section-rule {
    background: linear-gradient(90deg, var(--primary), var(--secondary));
}
</style>
