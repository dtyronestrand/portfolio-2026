import type { Component } from 'vue';

export type ResumeExperience = {
    id: number;
    title: string;
    company: string;
    location: string;
    start_date: string;
    end_date: string | null;
    highlights: string[] | null;
};

export type ResumeEducation = {
    id: number;
    school: string;
    degree: string;
    field_of_study: string;
    start_date: string;
    end_date: string | null;
    description: string | null;
};

export type ResumePublication = {
    id: number;
    title: string;
    authors: string | null;
    publisher: string;
    published_at: string;
    url: string | null;
    description: string | null;
};

export type ResumeSkillCategory = {
    name: string;
    skills: { id: number; name: string; level: number }[];
};

export type PublicResume = {
    first_name: string;
    last_name: string;
    email: string;
    phone: string;
    location: string;
    summary: string;
    experiences: ResumeExperience[];
    educations: ResumeEducation[];
    publications: ResumePublication[];
    skill_categories: ResumeSkillCategory[];
};

export type ResumeNavItem = {
    id: string;
    label: string;
    icon: Component;
};
