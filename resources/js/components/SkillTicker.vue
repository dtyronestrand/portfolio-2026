<template>
    <div class="overflow-hidden w-full bg-(--surface-tint) text-(--inverse-on-surface) py-[10px] mt-4 box-border">
        <div class="marquee flex w-max">

            <div class="marquee-group flex whitespace-nowrap pl-[20px]">
                <div v-for="item in tickerItems" :key="item.id" class="inline-flex items-center px-8 text-[0.95rem]">
                    {{ item.name }}
                </div>
            </div>
               <div class="marquee-group marquee-copy flex whitespace-nowrap pl-[20px]" aria-hidden="true">
                <div v-for="item in tickerItems" :key="item.id" class="inline-flex items-center px-8 text-[0.95rem]">
                    {{ item.name }}
                </div>
            </div>
        </div>

    </div>
</template>

<script setup lang="ts">
import {ref} from 'vue';
interface Skill {
    id: number;
    name: string;
    level: number;
}
interface Props {
    skills: Skill[];
}

const props = defineProps<Props>();
const tickerItems = ref([...props.skills]);
</script>

<style scoped>
.marquee {
    animation: marquee 25s linear infinite;
}
@media (prefers-reduced-motion: reduce) {
    .marquee {
        animation: none;
        width: 100%;
    }
    .marquee-group {
        flex-wrap: wrap;
        justify-content: center;
        row-gap: 0.5rem;
    }
    .marquee-copy {
        display: none;
    }
}
@keyframes marquee{
    0% { transform: translateX(0); }
    100% { transform: translateX(-50%); }
}
</style>