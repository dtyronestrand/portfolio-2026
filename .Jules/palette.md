## 2026-10-16 - Added ARIA label to icon-only buttons in FileUpload
**Learning:** When using custom templates for PrimeVue components (e.g., `<template #content>` in FileUpload), standard accessibility attributes might be lost. Explicitly adding `aria-label` to interactive elements like icon-only buttons (e.g. `<Times>`) placed inside these templates is crucial for screen readers.
**Action:** Always check interactive elements within custom component templates for proper ARIA labels, especially if they are icon-only.

## 2026-10-17 - Missing ARIA labels/screen reader text on icon-only buttons in navigation
**Learning:** Icon-only buttons used in the application's primary header (like Menu, Search, Avatar toggles) using lucide icons without textual labels or `<span class="sr-only">` are completely invisible to screen readers, making site navigation and essential interactions inaccessible.
**Action:** Always ensure icon-only buttons include visually hidden text (e.g. `<span class="sr-only">Text</span>`) or an `aria-label` attribute to properly expose their function to assistive technologies.
