<template>
    <div class="p-4 text-xs"><Link :href="work()"> All Projects</Link></div>
    <div class="px-4 pt-4 pb-2 text-sm">
        {{ props.project.completed_at }}
    </div>
    <section class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        <article class="lg:col-span-2">
            <h1 class="px-4 text-(length:--headline-lg-size)">
                {{ props.project.name }}
            </h1>
            <div class="mt-4 grid grid-cols-1 gap-4 md:grid-cols-2">
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
                <div class="flex flex-row flex-wrap items-start gap-4 px-4">
                    <Button v-if="props.project.demo_url" as-child>
                        <Link
                            :href="props.project.demo_url"
                            target="_blank"
                            rel="noopener noreferrer"
                        >
                            View Demo
                        </Link>
                    </Button>
                    <Button
                        v-if="props.project.video"
                        variant="outline"
                        as-child
                    >
                        <Link
                            href="#"
                            target="_blank"
                            rel="noopener noreferrer"
                        >
                            Watch Video
                        </Link>
                    </Button>
                </div>
            </div>
        </article>
        <figure class="mx-4 aspect-video bg-(--surface-container)">
            <img
                v-if="props.project.hero"
                :src="props.project.hero"
                class="aspect-video object-cover px-4"
            />
        </figure>
    </section>
    <section class="m-4">
        <Table>
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
    </section>
    <section
        class="mt-8 grid grid-cols-1 gap-8 lg:mx-4 lg:grid-cols-[auto_1fr_1fr] lg:gap-16"
    >
        <aside
            class="hidden bg-(--surface-container-low) p-4 lg:col-start-1 lg:col-end-2 lg:row-start-1 lg:row-end-3 lg:block"
        >
            <nav class="flex flex-col">
                <a href="#">Challenge & Solution</a>
                <a href="#">Process</a>
            </nav>
        </aside>
        <section
            class="grid grid-cols-1 gap-4 px-4 lg:col-start-2 lg:col-end-4 lg:row-start-1 lg:grid-cols-subgrid lg:p-4"
        >
            <h2 class="lg:col-span-2">Challenge & Solution</h2>
            <Card>
                <CardHeader>
                    <CardTitle>Challenge</CardTitle>
                </CardHeader>
                <CardContent>
                    <p>{{ props.project.challenge }}</p>
                </CardContent>
            </Card>
            <Card>
                <CardHeader>
                    <CardTitle>Solution</CardTitle>
                </CardHeader>
                <CardContent>
                    <p>{{ props.project.solution }}</p>
                </CardContent>
            </Card>
            <h2 class="lg:col-span-2">Process</h2>
            <Card class="lg:col-span-2">
                <CardContent>
                    {{ props.project.process }}
                </CardContent>
            </Card>
            <section
                class="mt-4 flex flex-row flex-wrap justify-evenly gap-4 lg:col-span-2"
            >
                <h2 class="w-full">Design Documents</h2>
                <template
                    v-for="doc in props.project.design_docs"
                    :key="doc.id"
                >
                    <Card class="min-w-48 flex-1">
                        <CardHeader>
                            <CardTitle class="text-center break-words">{{
                                doc.name
                            }}</CardTitle>
                        </CardHeader>
                        <CardContent>
                            <figure class="border border-border p-2">
                                <img
                                    class="aspect-square"
                                    :src="doc.preview_url"
                                    :alt="doc.name"
                                />
                            </figure>
                        </CardContent>
                    </Card>
                </template>
            </section>
            <section class="flex flex-col gap-2 lg:col-span-2">
                <h2>Gallery</h2>
                <!-- Padding leaves room for the prev/next buttons, which sit outside the carousel. -->
                <div class="px-12">
                    <Carousel class="mx-auto w-full max-w-lg">
                        <CarouselContent>
                            <CarouselItem
                                class="md:basis-1/2 lg:basis-1/4"
                                v-for="image in props.project.gallery"
                                :key="image.id"
                            >
                                <Card>
                                    <CardHeader>
                                        <h3>{{ image.name }}</h3>
                                    </CardHeader>
                                    <CardContent
                                        class="flex aspect-square items-center justify-center p-4"
                                    >
                                        <img
                                            :src="
                                                image.preview_url
                                                    ? image.preview_url
                                                    : image.original_url
                                            "
                                            :alt="image.name"
                                        />
                                    </CardContent>
                                </Card>
                            </CarouselItem>
                        </CarouselContent>
                        <CarouselPrevious />
                        <CarouselNext />
                    </Carousel>
                </div>
            </section>
        </section>
    </section>
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
import {
    Carousel,
    CarouselContent,
    CarouselItem,
    CarouselNext,
    CarouselPrevious,
} from '@/components/ui/carousel';
import { Card, CardContent, CardTitle, CardHeader } from '@/components/ui/card';
import { Link } from '@inertiajs/vue3';
import Tag from 'primevue/tag';
import { Button } from '@/components/ui/button/index';
import { work } from '@/routes';
interface Props {
    project: Project;
}
const props = defineProps<Props>();
</script>

<style scoped></style>
