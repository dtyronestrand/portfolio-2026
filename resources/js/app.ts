import { createInertiaApp } from '@inertiajs/vue3';
import PrimeVue from 'primevue/config';
import { initializeTheme } from '@/composables/useAppearance';
import AdminLayout from '@/layouts/AdminLayout.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import AuthLayout from '@/layouts/AuthLayout.vue';
import SettingsLayout from '@/layouts/settings/Layout.vue';
import { initializeFlashToast } from '@/lib/flashToast';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => (title ? `${title} - ${appName}` : appName),
    withApp(app) {
        app.use(PrimeVue, {
         unstyled: true,
         pt: {
            textarea: {
                root: 'bg-(--surface-container-high) border border(--outline-variant))'
            }
         },
            license: 'eyJpZCI6IjQ3ZDQzMzRiLWI1ODUtNGQ3Ny1iZjE3LTdkMzJiNDg5ODdiYyIsInByb2R1Y3QiOiJwcmltZXVpIiwidGllciI6ImNvbW11bml0eSIsInR5cGUiOiJkZXYiLCJpYXQiOjE3ODk5NTg1OTMsImV4cCI6MTgyMTQ5NDU5M30.jS0TUpQql9xHyEI0WJX5D4gR5SHrU4g72KZ_cGsEvM-5ANO7SjE8EPI-MPfLQHDcVh-HDiEPdenOuz1yjurzBg'
        })
    },
    layout: (name) => {
        switch (true) {
            case name === 'Welcome':
                return null;
            case name.startsWith('auth/'):
                return AuthLayout;
            case name.startsWith('admin/'):
                return AdminLayout;
            case name.startsWith('settings/'):
                return [AppLayout, SettingsLayout];
            default:
                return AppLayout;
        }
    },
    progress: {
        color: '#4B5563',
    },
});

// This will set light / dark mode on page load...
initializeTheme();

// This will listen for flash toast data from the server...
initializeFlashToast();
