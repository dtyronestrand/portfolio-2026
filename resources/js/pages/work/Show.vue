<template>
    <div class="p-4 text-xs"><Link href="work/"> All Projects</Link></div>
    <div class="px-4 pt-4 pb-2 text-sm">
        {{ props.project.modality }} &mdash; {{ props.project.completed_at }}
    </div>
    <h1 class="px-4 text-(length:--headline-lg-size)">
        {{ props.project.name }}
    </h1>
    <div class="items-between grid grid-cols-2">
        <div class="col-span-1">
            <p class="px-4 text-(length:--display-md-size)">
                {{ props.project.summary }}
            </p>
            <div class="flex flex-wrap gap-2 p-4">
                <Tag
                    v-for="tag in props.project.tags"
                    :key="tag"
                    class="bg-(--surface-container)"
                >
                    <span class="px-4 text-sm">{{ tag }}</span>
                </Tag>
            </div>
        </div>
        <div class="col-span-1 flex flex-row gap-4">
            <Button v-if="props.project.demo_url" as-child>
                <Link
                    :href="props.project.demo_url"
                    target="_blank"
                    rel="noopener noreferrer"
                >
                    View Demo
                </Link>
            </Button>
            <Button v-if="props.project.video" variant="outline" as-child>
                <Link
                    :href="props.project.video[0]"
                    target="_blank"
                    rel="noopener noreferrer"
                >
                    Watch Video
                </Link>
            </Button>
        </div>
    </div>
    <div class="mx-4 aspect-video bg-(--surface-container)">
        <img
            v-if="props.project.hero"
            :src="props.project.hero"
            class="aspect-video object-cover px-4"
        />
    </div>
    <Table class="mx-4">
        <TableHeader>
            <TableRow class="text-xs">
                <TableHead>Role</TableHead>
                <TableHead>Audience</TableHead>
                <TableHead>Modality</TableHead>
            </TableRow>
        </TableHeader>
        <TableBody>
            <TableRow class="text-sm">
                <TableCell>{{ props.project.role }}</TableCell>
                <TableCell>{{ props.project.audience }}</TableCell>
                <TableCell>{{ props.project.modality }}</TableCell>
            </TableRow>
        </TableBody>
    </Table>
</template>

<script setup lang="ts">
import type { Project } from '@/types';
import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/components/ui/table';
import { Link } from '@inertiajs/vue3';
import Tag from 'primevue/tag';
import { Button } from '@/components/ui/button/index';
interface Props {
    project: Project;
}
const props = defineProps<Props>();
</script>

<style scoped></style>
