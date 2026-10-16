## 2026-10-16 - Added ARIA label to icon-only buttons in FileUpload
**Learning:** When using custom templates for PrimeVue components (e.g., `<template #content>` in FileUpload), standard accessibility attributes might be lost. Explicitly adding `aria-label` to interactive elements like icon-only buttons (e.g. `<Times>`) placed inside these templates is crucial for screen readers.
**Action:** Always check interactive elements within custom component templates for proper ARIA labels, especially if they are icon-only.
