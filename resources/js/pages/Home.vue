<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { ArrowRight } from '@lucide/vue';
import FeaturedProjectStrip from '@/components/FeaturedProjectStrip.vue';
import SkillTicker from '@/components/SkillTicker.vue';
import { work } from '@/routes';
import type { Project } from '@/types';

interface Props {
    skills: {
        id: number;
        name: string;
        level: number;
    }[];
    projects: Project[];
}

const props = defineProps<Props>();
</script>

<template>
    <Head title="Deverick Strand Instructional Designer" />
    <main
        class="mx-auto flex w-full max-w-7xl flex-col px-4 pt-16 pb-14 sm:px-10 sm:pt-21"
    >
        <div
            class="flex items-center gap-2.5 font-mono text-xs font-medium tracking-wider text-primary uppercase"
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
            class="align-start mt-[40px] grid grid-cols-[minmax(0,1.15fr)_minmax(0,1fr)] gap-[32px]"
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
        <SkillTicker :skills="props.skills" />
        <section
            v-if="props.projects.length"
            aria-labelledby="featured-work-heading"
            class="mt-20 flex flex-col gap-10 sm:mt-24"
        >
            <div class="flex flex-wrap items-baseline justify-between gap-4">
                <h2
                    id="featured-work-heading"
                    class="font-serif text-[32px] leading-10 font-semibold text-(--text-display)"
                >
                    Featured work
                </h2>
                <Link
                    :href="work()"
                    class="inline-flex items-center gap-2 text-[15px] font-semibold text-primary underline-offset-4 hover:underline focus-visible:underline focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-(--focus-ring)"
                >
                    View all work
                    <ArrowRight class="size-4" aria-hidden="true" />
                </Link>
            </div>
            <div class="flex flex-col gap-16 lg:gap-20">
                <FeaturedProjectStrip
                    v-for="(project, index) in props.projects"
                    :key="project.id"
                    :project="project"
                    :reversed="index % 2 === 1"
                />
            </div>
        </section>
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
