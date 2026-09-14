<script setup lang="ts">
import { Head } from '@inertiajs/vue3';

interface Props {
    skills: string[];
}
const props = defineProps<Props>();
</script>

<template>
    <Head title="Deverick Strand Instructional Designer" />
    <main
        class="mx-auto flex w-full max-w-[1280px] flex-col px-4 pt-16 pb-14 sm:px-10 sm:pt-21"
    >
        <div
            class="flex items-center gap-2.5 font-mono text-xs font-medium tracking-[0.05em] text-primary uppercase"
        >
            <span
                class="blink inline-block h-1.75 w-1.75 rounded-full bg-secondary"
            ></span>
            Instructional Design &mdash; LMS Administration
        </div>
        <h1
            class="max-w-15ch mt-5.5 font-serif text-[clamp(2.875rem,7.4vw,6.5rem)] leading-[1.02] font-bold tracking-tight text-pretty text-foreground"
        >
            Designing Innovative Learner Centered Learning Experiences
        </h1>
        <div
            class="align-start mt-[40px] grid grid-cols-[minmax(0,1.15fr)_minmax(0,1fr)] gap-[56px]"
        >
            <p class="m-0 max-w-[54ch] text-pretty">
                Twenty-five years in education, seven of them on the design
                side. I came out of the classroom, so I design with the
                learner's experience in mind first: clear structure, assessment
                that reflects the outcomes and a little custom code when the
                authoring tool needs help.
            </p>
            <div class="border-l border-foreground pl-[22px]">
                <div>ROLE &mdash; Instructional Designer &amp; LMS Admin</div>
                <div>
                    BUILT WITH &mdash; Articulate Storyline, Rise, Camtasia,
                    Adobe Creative Suite, HTML, CSS, JavaScript
                </div>
            </div>
        </div>
        <div
            class="overflow-hidden border-t border-b bg-foreground text-background"
        >
            <div class="drift text-uppercase p-[11px 0] flex w-[200%]">
                <div class="flex w-[50%] flex-none gap-[40px] pr-[40px]">
                    <span v-for="skill in props.skills">
                        <span>{{ skill }}</span>
                        <span class="text-secondary"> &x25C6</span>
                    </span>
                </div>
            </div>
        </div>
    </main>
</template>
<style scoped>
@reference '../../css/app.css';
.max-w-15ch {
    max-width: 15ch;
}
.blink {
    animation: blink 2.4s steps(1, end) infinite;
}
@keyframes blink {
    0%,
    55% {
        opacity: 1;
    }
    56%,
    100% {
        opacity: 0.15;
    }
}
</style>
