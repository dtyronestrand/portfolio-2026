<template>
    <Tabs default-value="resume" class="w-full">
        <TabsList>
            <TabsTrigger value="resume">Resume</TabsTrigger>
            <TabsTrigger value="education">Education</TabsTrigger>
            <TabsTrigger value="experience">Experience</TabsTrigger>
            <TabsTrigger value="skills">Skills</TabsTrigger>
            <TabsTrigger value="publications">Publications</TabsTrigger>
        </TabsList>
        <TabsContent class="rounded-0 -mt-4" value="resume">
            <ResumeForm :resume="props.resume" />
        </TabsContent>
        <TabsContent value="education">
            <Education
                :resumeId="props.resume.id"
                :education="props.resume.educations"
            />
        </TabsContent>
        <TabsContent value="experience">
            <Experience
                :resumeId="props.resume.id"
                :experiences="props.resume.experiences"
            />
        </TabsContent>
    </Tabs>
</template>

<script setup lang="ts">
import Education from '@/components/Education.vue';
import Experience from '@/components/Experience.vue';
import ResumeForm from '@/components/ResumeForm.vue';
import { Tabs, TabsContent, TabsList, TabsTrigger } from '@/components/ui/tabs';
interface Props {
    resume: {
        id: number;
        first_name: string;
        last_name: string;
        email: string;
        phone: string;
        address: {
            street: string;
            city: string;
            state: string;
        };
        summary: string;
        educations: {
            id: number;
            school: string;
            degree: string;
            field_of_study: string;
            start_date: string;
            end_date: string;
        }[];
        experiences: {
            id: number;
            company: string;
            location: string;
            highlights: string[];
            title: string;
            start_date: string;
            end_date: string;
            description: string;
        }[];
        skills: {
            id: number;
            name: string;
            proficiency: string;
        }[];
        publications: {
            id: number;
            authors: string;
            title: string;
            publisher: string;
            published_at: string;
            url: string;
        }[];
    };
}

const props = defineProps<Props>();
</script>

<style scoped></style>
