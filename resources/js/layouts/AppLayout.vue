<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { useResizeObserver } from '@vueuse/core';
import { computed, onMounted, ref, watch } from 'vue';
import { useCurrentUrl } from '@/composables/useCurrentUrl';
import { home, work, resume, contact, skills } from '@/routes';

const navItems = [
    { label: 'Home', href: home(), exact: true },
    { label: 'Work', href: work(), exact: false },
    { label: 'Resume', href: resume(), exact: false },
    { label: 'Skills', href: skills(), exact: false },
    { label: 'Contact', href: contact(), exact: false },
];

const { isCurrentUrl, isCurrentOrParentUrl } = useCurrentUrl();

const activeIndex = computed(() =>
    navItems.findIndex((item) =>
        item.exact ? isCurrentUrl(item.href) : isCurrentOrParentUrl(item.href),
    ),
);

// The glider rests on the active page and follows the pointer / keyboard focus.
const hoveredIndex = ref(-1);
const targetIndex = computed(() =>
    hoveredIndex.value !== -1 ? hoveredIndex.value : activeIndex.value,
);

type Rect = { x: number; y: number; width: number; height: number };

const listRef = ref<HTMLElement | null>(null);
const itemRefs = ref<HTMLElement[]>([]);
const rects = ref<Rect[]>([]);

function measure() {
    rects.value = itemRefs.value.map((el) => ({
        x: el.offsetLeft,
        y: el.offsetTop,
        width: el.offsetWidth,
        height: el.offsetHeight,
    }));
}

// Position changes only animate once the glider is already on screen, so it
// fades in where it belongs instead of flying in from the corner.
const animate = ref(false);

function enableAnimationNextFrame() {
    requestAnimationFrame(() =>
        requestAnimationFrame(() => (animate.value = true)),
    );
}

watch(targetIndex, (_, previous) => {
    if (previous === -1) {
        animate.value = false;
        enableAnimationNextFrame();
    }
});

const gliderStyle = computed(() => {
    const rect = rects.value[targetIndex.value];

    if (!rect) {
        return { opacity: '0' };
    }

    return {
        opacity: '1',
        width: `${rect.width}px`,
        height: `${rect.height}px`,
        transform: `translate(${rect.x}px, ${rect.y}px)`,
    };
});

useResizeObserver(listRef, measure);

onMounted(() => {
    measure();
    enableAnimationNextFrame();
    document.fonts?.ready.then(measure);
});
</script>

<template>
    <div
        class="min-h-screen bg-background p-6 text-foreground lg:justify-center lg:p-8"
    >
        <header
            class="sticky top-4 z-40 mx-auto mb-6 flex w-full max-w-[1280px] flex-wrap items-center justify-between gap-x-6 gap-y-1 rounded-lg border border-border bg-(--glass-tint) px-4 py-2 backdrop-blur-md"
        >
            <Link
                :href="home()"
                class="rounded-sm font-serif text-lg font-semibold tracking-tight text-foreground transition-colors duration-200 hover:text-primary focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-ring"
            >
                Deverick Strand
            </Link>
            <nav aria-label="Main">
                <ul
                    ref="listRef"
                    class="relative -mx-2.5 flex flex-wrap items-center sm:mx-0"
                    @mouseleave="hoveredIndex = -1"
                    @focusout="hoveredIndex = -1"
                >
                    <li
                        aria-hidden="true"
                        class="nav-glider"
                        :class="{
                            'is-animated': animate,
                            'is-hovering': hoveredIndex !== -1,
                        }"
                        :style="gliderStyle"
                    >
                        <span class="nav-glider-pill"></span>
                        <span class="nav-glider-line"></span>
                    </li>
                    <li
                        v-for="(item, index) in navItems"
                        :key="item.label"
                        ref="itemRefs"
                        class="nav-item"
                        :style="{ '--nav-index': index }"
                    >
                        <Link
                            :href="item.href"
                            :aria-current="
                                index === activeIndex ? 'page' : undefined
                            "
                            class="relative block rounded-md px-2.5 py-2 text-sm font-medium transition-colors duration-200 focus-visible:outline-2 focus-visible:outline-ring sm:px-3"
                            :class="
                                index === targetIndex
                                    ? 'text-foreground'
                                    : 'text-muted-foreground'
                            "
                            @mouseenter="hoveredIndex = index"
                            @focus="hoveredIndex = index"
                        >
                            {{ item.label }}
                        </Link>
                    </li>
                </ul>
            </nav>
        </header>
        <slot></slot>
    </div>
</template>
<style scoped>
@reference '../../css/app.css';

.nav-glider {
    position: absolute;
    top: 0;
    left: 0;
    pointer-events: none;
    transition: opacity 0.2s ease-out;
}
.nav-glider.is-animated {
    transition:
        opacity 0.2s ease-out,
        transform 0.45s cubic-bezier(0.3, 1.35, 0.5, 1),
        width 0.45s cubic-bezier(0.3, 1.35, 0.5, 1),
        height 0.45s cubic-bezier(0.3, 1.35, 0.5, 1);
}
.nav-glider-pill {
    position: absolute;
    inset: 0;
    opacity: 0;
    transform: scale(0.92);
    transition:
        opacity 0.2s ease-out,
        transform 0.3s ease-out;
    @apply rounded-md bg-primary/12 ring-1 ring-primary/25 ring-inset;
}
.nav-glider.is-hovering .nav-glider-pill {
    opacity: 1;
    transform: scale(1);
}
.nav-glider-line {
    position: absolute;
    bottom: 0;
    height: 2px;
    border-radius: 2px;
    background: linear-gradient(90deg, var(--primary), var(--secondary));
    box-shadow: 0 0 12px 0 color-mix(in srgb, var(--secondary) 70%, transparent);
    @apply inset-x-2.5 sm:inset-x-3;
}

.nav-item {
    animation: nav-item-in 0.5s cubic-bezier(0.2, 0.8, 0.2, 1) backwards;
    animation-delay: calc(var(--nav-index) * 60ms + 80ms);
}
@keyframes nav-item-in {
    from {
        opacity: 0;
        transform: translateY(-8px);
    }
}

@media (prefers-reduced-motion: reduce) {
    .nav-glider.is-animated,
    .nav-glider-pill {
        transition: opacity 0.2s ease-out;
    }
    .nav-item {
        animation: none;
    }
}
</style>
