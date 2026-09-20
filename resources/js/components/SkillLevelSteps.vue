<template>
    <div class="skill-level" :class="`skill-level--${variant}`" role="meter" :aria-valuenow="step" aria-valuemin="1" :aria-valuemax="Levels.length" aria-label="Skill level">
        <template v-if="variant === 'track'">
            <div class="track" aria-hidden="true">
                <span v-for="(l, i) in Levels" :key="l" class="seg" :class="{'is-filled': i <= index}"/>
            </div>
            <p v-if="showLabel" class="caption">
                <span class="name">{{ label }}</span>
                <span v-if="showCount" class="count">{{ step }} of {{ Levels.length }}</span>
            </p>
        </template>
        <template v-else>
            <span class="bars" aria-hidden="true">
                <span v-for="(l,i) in Levels" :key="l" class="bar" :class="{'is-filled' : i <= index}" :style="{height: `${(i + 1) * 25}%`}"/>

            </span>
            <span v-if="showLabel" class="name">{{ label }}</span>
        </template>

    </div>
</template>

<script setup lang="ts">
import { computed } from 'vue';

const Levels = ['Beginner', 'Intermediate', 'Advanced', 'Expert'];

interface Props {
    level: number;
    variant: string;
    showLabel: boolean;
    showCount: boolean;
}

const props = defineProps<Props>();

const index = computed(()=> {
    return Math.min(Math.max(Math.round(props.level), 1), Levels.length) -1
})

const label = computed(()=> {
    return Levels[index.value]
})

const step = computed (() => index.value +1)
</script>

<style scoped>
    .skill-level {
               --skill-text: var(--on-surface);
        --skill-muted: var(--on-surface-variant);
        --color: var(--skill-text);
    }

    .skill-level--track {
        display: block;
        width: 100%;
        max-width: 16rem;
        background: var(--surface-container);
    }

    .track {
        display: flex;
        gap: 4px;
    }

    .seg {
        flex: 1;
        height: 8px;
        border-radius: 9999px;
        background:var(--primary-container);
        transition: background-color 0.3s ease;
    }

    caption { margin: 0.375rem 0 0; font-size: 0.875rem; line-height: 1.25; }
.name { font-weight: 600; }
.count { color: var(--skill-muted); }
 
/* Bars */
.skill-level--bars { display: inline-flex; align-items: center; gap: 0.5rem; font-size: 0.875rem; }
.bars { display: inline-flex; align-items: flex-end; gap: 2px; height: 1rem; }
.bar {
  width: 4px;
  border-radius: 1px;
  background: var(--skill-track);
  transition: background-color 0.3s ease;
}
 
.is-filled { background: var(--color-primary) }

</style>