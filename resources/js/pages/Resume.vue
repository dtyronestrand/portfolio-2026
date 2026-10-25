<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import {
    BookOpen,
    Briefcase,
    GraduationCap,
    Mail,
    MapPin,
    Phone,
    UserRound,
    Wrench,
} from '@lucide/vue';
import { computed } from 'vue';
import ResumeSection from '@/components/resume/ResumeSection.vue';
import ResumeSectionPills from '@/components/resume/ResumeSectionPills.vue';
import ResumeSidebar from '@/components/resume/ResumeSidebar.vue';
import ResumeSkills from '@/components/resume/ResumeSkills.vue';
import ResumeThread from '@/components/resume/ResumeThread.vue';
import ResumeTimeline from '@/components/resume/ResumeTimeline.vue';
import { useScrollSpy } from '@/composables/useScrollSpy';
import { formatMonthYear } from '@/lib/resumeDates';
import type {
    PublicResume,
    ResumeEducation,
    ResumeExperience,
    ResumeNavItem,
} from '@/types';

interface Props {
    resume: PublicResume | null;
}

const props = defineProps<Props>();

const role = 'Instructional Designer & LMS Admin';

const name = computed(() =>
    props.resume ? `${props.resume.first_name} ${props.resume.last_name}` : '',
);

const navItems = computed<ResumeNavItem[]>(() => {
    const resume = props.resume;

    if (!resume) {
        return [];
    }

    return [
        { id: 'about', label: 'About', icon: UserRound, show: true },
        {
            id: 'experience',
            label: 'Experience',
            icon: Briefcase,
            show: resume.experiences.length > 0,
        },
        {
            id: 'education',
            label: 'Education',
            icon: GraduationCap,
            show: resume.educations.length > 0,
        },
        {
            id: 'skills',
            label: 'Skills',
            icon: Wrench,
            show: resume.skill_categories.length > 0,
        },
        {
            id: 'publications',
            label: 'Publications',
            icon: BookOpen,
            show: resume.publications.length > 0,
        },
    ]
        .filter((item) => item.show)
        .map(({ id, label, icon }) => ({ id, label, icon }));
});

const { activeId, scrollTo } = useScrollSpy(
    computed(() => navItems.value.map((item) => item.id)),
);

const dateRange = (item: { start_date: string; end_date: string | null }) =>
    `${formatMonthYear(item.start_date)} → ${formatMonthYear(item.end_date)}`;
</script>

<template>
    <Head title="Resume" />
    <main v-if="resume" class="mx-auto w-full max-w-[1280px]">
        <div class="grid gap-10 lg:grid-cols-[280px_minmax(0,1fr)]">
            <div class="hidden lg:block">
                <ResumeSidebar
                    :name="name"
                    :role="role"
                    :items="navItems"
                    :active-id="activeId"
                    @select="scrollTo"
                />
            </div>

            <div class="min-w-0">
                <ResumeSectionPills
                    class="lg:hidden"
                    :items="navItems"
                    :active-id="activeId"
                    @select="scrollTo"
                />

                <ResumeSection id="about" class="pt-8 lg:pt-4">
                    <p
                        class="font-mono text-xs font-medium tracking-[0.05em] text-primary uppercase"
                    >
                        {{ role }}
                    </p>
                    <h1
                        id="about-title"
                        class="mt-3 font-serif text-[clamp(2.25rem,5vw,3rem)] leading-[1.1] font-bold tracking-tight text-(--text-display)"
                    >
                        {{ name }}
                    </h1>
                    <p
                        class="mt-6 max-w-[65ch] text-lg leading-relaxed text-pretty text-(--text-muted)"
                    >
                        {{ resume.summary }}
                    </p>
                    <ul
                        class="mt-8 flex flex-wrap gap-x-6 gap-y-3 text-sm"
                        aria-label="Contact details"
                    >
                        <li>
                            <a
                                :href="`mailto:${resume.email}`"
                                class="flex items-center gap-2 rounded-sm text-(--text-link) transition-colors hover:text-(--text-link-hover) focus-visible:outline-2 focus-visible:outline-ring"
                            >
                                <Mail class="size-4" aria-hidden="true" />
                                {{ resume.email }}
                            </a>
                        </li>
                        <li>
                            <a
                                :href="`tel:${resume.phone.replace(/[^\d+]/g, '')}`"
                                class="flex items-center gap-2 rounded-sm text-(--text-link) transition-colors hover:text-(--text-link-hover) focus-visible:outline-2 focus-visible:outline-ring"
                            >
                                <Phone class="size-4" aria-hidden="true" />
                                {{ resume.phone }}
                            </a>
                        </li>
                        <li
                            v-if="resume.location"
                            class="flex items-center gap-2 text-(--text-muted)"
                        >
                            <MapPin class="size-4" aria-hidden="true" />
                            {{ resume.location }}
                        </li>
                    </ul>
                </ResumeSection>

                <ResumeSection
                    v-if="resume.experiences.length"
                    id="experience"
                    title="Professional Experience"
                    highlight="Professional"
                    description="Where I've worked and what I delivered there."
                >
                    <ResumeTimeline
                        :items="resume.experiences"
                        :icon="Briefcase"
                        :title="(exp: ResumeExperience) => exp.title"
                        :institution="(exp: ResumeExperience) => exp.company"
                        :location="(exp: ResumeExperience) => exp.location"
                        :dates="dateRange"
                    >
                        <template #default="{ item }">
                            <ul
                                v-if="item.highlights?.length"
                                class="flex list-disc flex-col gap-1.5 pl-5 marker:text-secondary"
                            >
                                <li
                                    v-for="highlight in item.highlights"
                                    :key="highlight"
                                >
                                    {{ highlight }}
                                </li>
                            </ul>
                        </template>
                    </ResumeTimeline>
                </ResumeSection>

                <ResumeSection
                    v-if="resume.educations.length"
                    id="education"
                    title="Education Background"
                    highlight="Education"
                    description="My academic path and the credentials it led to."
                >
                    <ResumeTimeline
                        :items="resume.educations"
                        :icon="GraduationCap"
                        :title="
                            (edu: ResumeEducation) =>
                                `${edu.degree} in ${edu.field_of_study}`
                        "
                        :institution="(edu: ResumeEducation) => edu.school"
                        :dates="dateRange"
                    >
                        <template #default="{ item }">
                            <p v-if="item.description" class="max-w-[65ch]">
                                {{ item.description }}
                            </p>
                        </template>
                    </ResumeTimeline>
                </ResumeSection>

                <ResumeSection
                    v-if="resume.skill_categories.length"
                    id="skills"
                    title="Skill Set"
                    highlight="Skill"
                    description="The tools and disciplines I work with, and how deep each one goes."
                >
                    <ResumeSkills :categories="resume.skill_categories" />
                </ResumeSection>

                <ResumeSection
                    v-if="resume.publications.length"
                    id="publications"
                    title="Publications"
                    highlight="Publications"
                    description="Writing and research I've published."
                >
                    <ResumeThread :publications="resume.publications" />
                </ResumeSection>
            </div>
        </div>
    </main>
    <main
        v-else
        class="mx-auto flex w-full max-w-[1280px] flex-col gap-4 pt-10"
    >
        <h1
            class="font-serif text-[clamp(2.25rem,4vw,3rem)] leading-tight font-bold tracking-tight text-(--text-display)"
        >
            Resume
        </h1>
        <p class="text-(--text-muted)">
            This resume hasn't been published yet.
        </p>
    </main>
</template>
