<template>
    <div class="grid grid-cols-[236px_minmax(0,1fr)] min-height-[100vh] bg-background">
        <aside class="sticky top-0 self-start h-screen flex flex-col gap-[20px] p-[24px 14px]border-r border-r-(--outline-variant) bg-[var(--surface-container-lowest)] box-border">
            <div class="p-[0 10] flex flex-col gap-[4px]">
                <span class="text-[21px] font-weight-700 tracking-[0.2em] text-sidebar-foreground">Strand&#8202;/&#8202;ID</span>
                <span class="ds-label-sm text-xs text-muted">Portfolio Admin</span>
            </div>
            <nav class="flex flex-col gap-[2px]">
                <Link
                    v-for="item in navItems"
                    :key="item.href"
                    :href="item.href"
                    class="flex w-full items-center gap-2.5 rounded-md px-2.5 py-2 text-[14.5px] font-medium transition-colors duration-150"
                    :class="isActive(item.href)
                        ? 'bg-(--midnight-500) text-(--indigo-100) font-(--font-body) '
                        : ' hover:bg-(--midnight-700) text-(--text-body) hover:text-sidebar-foreground font-normal'"
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
            <div class="mt-auto flex flew-col gap-[14px]">
                <div class="p-[14px] border border-(--outline-variant) rounded-[8px] bg-(--surface-container-low) flex flex-col gap-[8px]">
                    <span class="ds-label-sm text-xs">Public Site</span>
                </div>
            </div>
        </aside>
<slot></slot>
    </div>
</template>

<script setup lang="ts">
import { Link, usePage } from '@inertiajs/vue3';
import { LayoutDashboard } from '@lucide/vue';
import type { LucideIcon } from '@lucide/vue';
import { dashboard as adminDashboard } from '@/routes/admin';

interface NavItem {
    label: string;
    icon: LucideIcon;
    href: string;
    count?: number;
}

const navItems: NavItem[] = [
    { label: 'Dashboard', icon: LayoutDashboard, href: adminDashboard().url },
];

const page = usePage();

function isActive(href: string) {
    return page.url === href || page.url.startsWith(`${href}/`);
}
</script>

<style scoped>
.ds-label-sm{font-family:var(--font-mono);font-size:var(--label-sm-size);line-height:var(--label-sm-line);font-weight:var(--label-sm-weight);letter-spacing:var(--label-sm-tracking);text-transform:uppercase;color:var(--text-muted)}
</style>