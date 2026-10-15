## 2024-10-15 - Missing aria-labels on PrimeVue FileUpload custom template remove buttons
**Learning:** When using custom templates for PrimeVue components like FileUpload (`<template #content>`), the standard accessibility attributes are lost. Any interactive elements added in these templates, such as icon-only remove buttons (`<Button><Times/></Button>`), must manually have `aria-label` attributes added.
**Action:** Always verify custom component templates for interactive elements and explicitly add `aria-label` when using icon-only components like `<Times>` or `<CloudUpload>`.
