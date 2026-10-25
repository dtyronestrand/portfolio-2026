import { onBeforeUnmount, onMounted, ref } from 'vue';
import type { Ref } from 'vue';

/**
 * Tracks which of the given section ids is currently in the reading band of
 * the viewport (a strip just above the vertical middle), so navigation can
 * highlight it.
 */
export function useScrollSpy(ids: Ref<string[]>) {
    const activeId = ref<string | null>(ids.value[0] ?? null);
    let observer: IntersectionObserver | null = null;

    onMounted(() => {
        observer = new IntersectionObserver(
            (entries) => {
                const visible = entries.find((entry) => entry.isIntersecting);

                if (visible) {
                    activeId.value = visible.target.id;
                }
            },
            { rootMargin: '-35% 0px -60% 0px' },
        );

        ids.value
            .map((id) => document.getElementById(id))
            .forEach((el) => el && observer?.observe(el));
    });

    onBeforeUnmount(() => observer?.disconnect());

    function scrollTo(id: string) {
        activeId.value = id;
        document.getElementById(id)?.scrollIntoView({ behavior: 'smooth' });
        history.replaceState(null, '', `#${id}`);
    }

    return { activeId, scrollTo };
}
