<template>
    <div
        class="min-height-[100vh] grid grid-cols-[236px_minmax(0,1fr)] bg-background"
    >
        <aside
            class="p-[24px 14px] sticky top-0 box-border flex h-screen flex-col gap-[20px] self-start border-r border-r-(--outline-variant) bg-[var(--surface-container-lowest)]"
        >
            <div class="p-[0 10] flex flex-col gap-[4px]">
                <span
                    class="font-weight-700 text-[21px] tracking-[0.2em] text-sidebar-foreground"
                    >Strand&#8202;/&#8202;ID</span
                >
                <span class="ds-label-sm text-xs text-muted"
                    >Portfolio Admin</span
                >
            </div>
            <nav class="flex flex-col gap-[2px]">
                <Link
                    v-for="item in navItems"
                    :key="item.href"
                    :href="item.href"
                    class="flex w-full items-center gap-2.5 rounded-md px-2.5 py-2 text-[14.5px] font-medium transition-colors duration-150"
                    :class="
                        isActive(item.href)
                            ? 'bg-(--midnight-500) font-(--font-body) text-(--indigo-100)'
                            : 'font-normal text-(--text-body) hover:bg-(--midnight-700) hover:text-sidebar-foreground'
                    "
                >
                    <component :is="item.icon" :size="16" />
                    <span class="flex-1">{{ item.label }}</span>
                    <span
                        v-if="isActive(item.href)"
                        class="h-[5px] w-[5px] rounded-full bg-sidebar-primary"
                    />
                    <span
                        v-else-if="item.count"
                        class="text-xs text-muted-foreground/70"
                    >
                        {{ item.count }}
                    </span>
                </Link>
            </nav>
            <div class="flew-col mt-auto flex gap-[14px]">
                <div
                    class="flex flex-col gap-[8px] rounded-[8px] border border-(--outline-variant) bg-(--surface-container-low) p-[14px]"
                >
                    <Link :href="homeRoute" class="ds-label-sm text-xs"
                        >Public Site</Link
                    >
                </div>
            </div>
        </aside>
        <main class="flex min-w-0 flex-col">
            <div
                class="box-border flex max-w-[1280px] flex-col gap-[28px] p-[32px]"
            >
                <slot></slot>
            </div>
        </main>
    </div>
</template>

<script setup lang="ts">
import { Link, usePage } from '@inertiajs/vue3';
import { LayoutDashboard, FolderKanban, BadgeCheck } from '@lucide/vue';
import type { LucideIcon } from '@lucide/vue';
import {
    dashboard as adminDashboard,
    work,
    skills,
    resume,
} from '@/routes/admin';
import { home } from '@/routes';
interface NavItem {
    label: string;
    icon: LucideIcon;
    href: string;
    count?: number;
}
const homeRoute = home().url;
const navItems: NavItem[] = [
    { label: 'Dashboard', icon: LayoutDashboard, href: adminDashboard().url },
    { label: 'Projects', icon: FolderKanban, href: work().url },
    { label: 'Skills', icon: BadgeCheck, href: skills().url },
    { label: 'Resume', icon: BadgeCheck, href: resume().url },
];

const page = usePage();

function isActive(href: string) {
    return page.url === href || page.url.startsWith(`${href}/`);
}
</script>

<style scoped>
.label-sm {
    font-family: var(--font-mono);
    font-size: var(--label-sm-size);
    line-height: var(--label-sm-line);
    font-weight: var(--label-sm-weight);
    letter-spacing: var(--label-sm-tracking);
    text-transform: uppercase;
    color: var(--text-muted);
}
</style>
