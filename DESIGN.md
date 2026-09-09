---
name: Academic Creative Modern
colors:
  surface: '#0b1326'
  surface-dim: '#0b1326'
  surface-bright: '#31394d'
  surface-container-lowest: '#060e20'
  surface-container-low: '#131b2e'
  surface-container: '#171f33'
  surface-container-high: '#222a3d'
  surface-container-highest: '#2d3449'
  on-surface: '#dae2fd'
  on-surface-variant: '#c7c4d8'
  inverse-surface: '#dae2fd'
  inverse-on-surface: '#283044'
  outline: '#918fa1'
  outline-variant: '#464555'
  surface-tint: '#c3c0ff'
  primary: '#c3c0ff'
  on-primary: '#1d00a5'
  primary-container: '#4f46e5'
  on-primary-container: '#dad7ff'
  inverse-primary: '#4d44e3'
  secondary: '#6bd8cb'
  on-secondary: '#003732'
  secondary-container: '#29a195'
  on-secondary-container: '#00302b'
  tertiary: '#ffb2b7'
  on-tertiary: '#67001b'
  tertiary-container: '#bf0f3c'
  on-tertiary-container: '#ffd0d2'
  error: '#ffb4ab'
  on-error: '#690005'
  error-container: '#93000a'
  on-error-container: '#ffdad6'
  primary-fixed: '#e2dfff'
  primary-fixed-dim: '#c3c0ff'
  on-primary-fixed: '#0f0069'
  on-primary-fixed-variant: '#3323cc'
  secondary-fixed: '#89f5e7'
  secondary-fixed-dim: '#6bd8cb'
  on-secondary-fixed: '#00201d'
  on-secondary-fixed-variant: '#005049'
  tertiary-fixed: '#ffdadb'
  tertiary-fixed-dim: '#ffb2b7'
  on-tertiary-fixed: '#40000d'
  on-tertiary-fixed-variant: '#92002a'
  background: '#0b1326'
  on-background: '#dae2fd'
  surface-variant: '#2d3449'
typography:
  display-lg:
    fontFamily: Source Serif 4
    fontSize: 48px
    fontWeight: '700'
    lineHeight: 56px
    letterSpacing: -0.02em
  display-lg-mobile:
    fontFamily: Source Serif 4
    fontSize: 36px
    fontWeight: '700'
    lineHeight: 44px
    letterSpacing: -0.02em
  headline-lg:
    fontFamily: Source Serif 4
    fontSize: 32px
    fontWeight: '600'
    lineHeight: 40px
  headline-md:
    fontFamily: Source Serif 4
    fontSize: 24px
    fontWeight: '600'
    lineHeight: 32px
  body-lg:
    fontFamily: Hanken Grotesk
    fontSize: 18px
    fontWeight: '400'
    lineHeight: 28px
  body-md:
    fontFamily: Hanken Grotesk
    fontSize: 16px
    fontWeight: '400'
    lineHeight: 24px
  label-sm:
    fontFamily: JetBrains Mono
    fontSize: 12px
    fontWeight: '500'
    lineHeight: 16px
    letterSpacing: 0.05em
rounded:
  sm: 0.125rem
  DEFAULT: 0.25rem
  md: 0.375rem
  lg: 0.5rem
  xl: 0.75rem
  full: 9999px
spacing:
  base: 8px
  container-max: 1280px
  gutter: 24px
  margin-mobile: 16px
  margin-desktop: 40px
---

## Brand & Style

This design system evolves the "Academic Creative" narrative from a static, archival aesthetic into a high-energy, digitally-native environment for modern scholarship and creative research. It balances the intellectual rigor of traditional publishing with the vibrant pulse of a contemporary tech startup.

The style is **Modern Professional with High-Contrast Vitality**. It utilizes clean, expansive whitespace and sharp, high-contrast surfaces to frame deep, saturated accent colors in a sophisticated dark mode environment. The interface should evoke a sense of "Electric Intellect"—reliable and authoritative, yet forward-thinking and dynamic. Transitions should be snappy, and the UI should feel tactile and responsive, shedding the muted "slate" tones for a more luminous and energetic presence.

## Colors

The palette shifts from dusty tones to a high-saturation, high-vibrancy set tailored for a dark mode experience that demands attention.

- **Primary (Electric Indigo):** The core brand color, used for primary actions, active states, and key brand moments. It provides a deep, digital-first energy.
- **Secondary (Teal Accent):** A crisp, fresh counterpart to the indigo. Used for success states, secondary highlights, and data visualization.
- **Tertiary (Electric Rose):** Used sparingly for critical alerts, high-priority notifications, or specific "creative" accents that need to break the cool color profile.
- **Neutral:** A deep "Midnight" instead of standard black, paired with a series of ultra-clean dark surfaces to maintain maximum contrast and clarity.

Surface colors should remain deep and immersive to allow the saturated accents to pop without creating visual muddying.

## Typography

The typography system pairs authoritative academic serif with high-precision modern grotesk and technical monospaced fonts.

- **Headlines:** Use **Source Serif 4**. It provides the necessary "Academic" weight and literary credibility. Bold weights should be used for large displays to create a strong editorial hierarchy.
- **Body:** Use **Hanken Grotesk**. This font brings the "Modern" aspect to the system—it is exceptionally clean, contemporary, and highly legible for long-form research papers or creative briefs.
- **Data & Labels:** Use **JetBrains Mono**. This adds a layer of "Creative Technology" and precision, perfect for metadata, citations, and small technical labels.

## Layout & Spacing

The layout philosophy follows a **Fixed-Fluid Hybrid**. Content is centered within a maximum container width of 1280px to ensure readability of academic texts, while background elements and headers can bleed to the edges of the screen.

- **Grid:** A 12-column grid system is used for desktop, collapsing to 4 columns on mobile.
- **Rhythm:** An 8px base unit drives all spatial decisions. Larger gaps (40px+) should be used between major sections to emphasize the "Minimalist" and "Modern" aesthetic.
- **Density:** Maintain a medium density. Academic content requires room to breathe, but the "Modern" energy is sustained by tight, purposeful groupings of related metadata and controls.

## Elevation & Depth

This design system utilizes **Tonal Layers** and **Low-Contrast Outlines** rather than heavy shadows to maintain a crisp, modern feel in dark mode.

- **Surfaces:** Use subtle shifts in background color (e.g., Midnight to an ultra-light Dark Gray) to define areas.
- **Outlines:** Instead of shadows, use 1px solid borders in a very light neutral tint to define cards and containers.
- **Active Elevation:** When an element is hovered or active, use a subtle, highly diffused "Ambient Shadow" tinted with the primary Indigo color to create a sense of digital glow rather than physical weight.
- **Glassmorphism:** Use sparingly for floating navigation bars or overlays. A `backdrop-filter: blur(12px)` with a dark translucent tint keeps the UI feeling airy and light.

## Shapes

The shape language is **Soft yet Structured**. 

A `0.25rem` (4px) radius is the standard for functional elements like input fields and small buttons. This provides a precise, professional look. Larger components like cards or featured imagery can use `0.5rem` (8px) to feel more approachable. Avoid pill-shaped buttons; rectangular shapes with soft corners better reflect the "Academic" foundation of the system.

## Components

- **Buttons:** Primary buttons use a solid Electric Indigo background with white text. Secondary buttons use a Teal outline with Teal text. Tertiary buttons are text-only with a heavy underline on hover.
- **Cards:** High-contrast dark surfaces with a 1px border. On hover, the border transitions to Electric Indigo and a subtle Indigo-tinted shadow appears.
- **Input Fields:** Use Hanken Grotesk for input text. Labels use JetBrains Mono in a smaller size above the field. The focus state is a 2px solid Electric Indigo ring.
- **Chips/Tags:** Use the JetBrains Mono font. Tags for "Categories" use a light Teal wash, while "Status" tags use high-saturation backgrounds.
- **Lists:** Academic citations or bibliographies should be set in Source Serif 4, while the associated metadata (date, views, tags) should be in JetBrains Mono to clearly distinguish content from data.
- **Navigation:** The top navigation should be minimalist, using Hanken Grotesk in medium weight, with a clear, saturated underline for the active state.