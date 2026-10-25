import type { Media } from '@/types/media';

export type Project = {
    id: number;
    name: string;
    slug: string;
    summary: string;
    role: string;
    audience: string;
    completed_at: string;
    challenge: string;
    solution: string;
    modality: string;
    learning_objectives: string | null;
    process: string;
    seat_time: string | null;
    design_rationale: string;
    demo_url: string | null;
    sort_order: number;
    is_published: boolean;
    featured: boolean;
    reflection: string | null;
    tags: string[];
    hero: string | null;
    gallery: Media[];
    storyboard: Media[];
    design_docs: Media[];
    video: Media[];
};
