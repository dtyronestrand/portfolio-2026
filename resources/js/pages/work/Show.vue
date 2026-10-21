<template>
    <div class="p-4 text-xs"><Link :href="work()"> All Projects</Link></div>
    <div class="px-4 pt-4 pb-2 text-sm">
        {{ props.project.completed_at }}
    </div>
    <section class="grid grid-cols-3">
        <article class="col-span-2">
            <h1 class="px-4 text-(length:--headline-lg-size)">
                {{ props.project.name }}
            </h1>
            <div class="items-between mt-4 grid grid-cols-2">
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
    <section class="grid-rows-auto mx-4 grid grid-cols-[auto_1fr_1fr] gap-32">
        <aside
            class="col-start-1 col-end-2 row-start-1 row-end-3 bg-(--surface-container-low) p-4"
        >
            <nav class="flex flex-col">
                <a href="#">Challenge & Solution</a>
                <a href="#">Process</a>
            </nav>
        </aside>
        <section
            class="col-start-2 col-end-4 row-start-1 grid grid-cols-subgrid gap-4 p-4"
        >
            <h2 class="col-span-2">Challenge & Solution</h2>
            <Card class="col-span-1">
                <CardHeader>
                    <CardTitle>Challenge</CardTitle>
                </CardHeader>
                <CardContent>
                    <p>{{ props.project.challenge }}</p>
                </CardContent>
            </Card>
            <Card class="col-span-1">
                <CardHeader>
                    <CardTitle>Solution</CardTitle>
                </CardHeader>
                <CardContent>
                    <p>{{ props.project.solution }}</p>
                </CardContent>
            </Card>
            <h2 class="col-span-2">Process</h2>
            <Card class="col-span-2">
                <CardContent>
                    {{ props.project.process }}
                </CardContent>
            </Card>
            <section
                class="col-span-2 mt-4 flex flex-row flex-wrap justify-evenly gap-4"
            >
                <h2 class="w-full">Design Documents</h2>
                <template
                    v-for="doc in props.project.design_docs"
                    :key="doc.id"
                >
                    <Card class="flex-basis-0 min-w-max flex-1">
                        <CardHeader>
                            <CardTitle class="text-center">{{
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
            <section class="col-span-2 flex flex-col gap-2">
                <h2>Gallery</h2>
                <Carousel class="w-full max-w-lg self-center">
                    <CarouselContent>
                        <CarouselItem
                            class="lg-basis-1/4 md:basis-1/2"
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
