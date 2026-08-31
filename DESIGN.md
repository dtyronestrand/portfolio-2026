---
version: alpha
name: Marginalia
description: Portfolio and resume site for an instructional designer — case studies of courses and eLearning built, credentials, and a downloadable resume, read by hiring managers and L&D directors.

colors:
  primary: "#E16A60"
  secondary: "#8A968C"
  neutral: "#19251C"
  surface: "#0D160F"
  on-surface: "#EAE4D7"
  border: "#2B362D"
  error: "#DE6A71"
  subtle: "#2E1011"

typography:
  display:
    fontFamily: Fraunces
    fontSize: 88px
    fontWeight: 600
    lineHeight: 1.02
    letterSpacing: -0.03em
    fontVariation: "'opsz' 88, 'SOFT' 20, 'WONK' 1"
  headline-lg:
    fontFamily: Fraunces
    fontSize: 50px
    fontWeight: 600
    lineHeight: 1.08
    letterSpacing: -0.025em
    fontVariation: "'opsz' 48, 'WONK' 1"
  headline-md:
    fontFamily: Fraunces
    fontSize: 32px
    fontWeight: 600
    lineHeight: 1.15
    letterSpacing: -0.015em
    fontVariation: "'opsz' 32"
  headline-sm:
    fontFamily: Fraunces
    fontSize: 22px
    fontWeight: 600
    lineHeight: 1.25
    fontVariation: "'opsz' 22"
  body-lg:
    fontFamily: Fraunces
    fontSize: 19px
    fontWeight: 400
    lineHeight: 1.65
    fontVariation: "'opsz' 19"
    fontFeature: "'onum' 1"
  body-md:
    fontFamily: Fraunces
    fontSize: 17px
    fontWeight: 400
    lineHeight: 1.6
    fontVariation: "'opsz' 17"
    fontFeature: "'onum' 1"
  body-sm:
    fontFamily: Fraunces
    fontSize: 14px
    fontWeight: 400
    lineHeight: 1.55
    fontVariation: "'opsz' 14"
  label-caps:
    fontFamily: Public Sans
    fontSize: 11px
    fontWeight: 500
    lineHeight: 1.3
    letterSpacing: 0.12em
  label-md:
    fontFamily: Public Sans
    fontSize: 13px
    fontWeight: 500
    lineHeight: 1.4
    letterSpacing: 0.01em
  caption:
    fontFamily: Public Sans
    fontSize: 12px
    fontWeight: 400
    lineHeight: 1.45
    letterSpacing: 0.008em

rounded:
  none: 0px
  sm: 2px
  md: 3px
  full: 9999px

spacing:
  xs: 4px
  sm: 8px
  md: 16px
  lg: 32px
  xl: 64px
  gutter: 24px
  margin: 64px

components:
  page:
    backgroundColor: "{colors.surface}"
    textColor: "{colors.on-surface}"
    typography: "{typography.body-md}"
  divider:
    backgroundColor: "{colors.border}"
    height: 1px
  button-primary:
    backgroundColor: "{colors.primary}"
    textColor: "{colors.surface}"
    typography: "{typography.label-caps}"
    rounded: "{rounded.sm}"
    padding: "{spacing.md}"
  button-primary-hover:
    backgroundColor: "#A83538"
    textColor: "{colors.on-surface}"
  button-secondary:
    backgroundColor: "{colors.neutral}"
    textColor: "{colors.primary}"
    typography: "{typography.label-caps}"
    rounded: "{rounded.sm}"
    padding: "{spacing.md}"
  card:
    backgroundColor: "{colors.neutral}"
    textColor: "{colors.on-surface}"
    typography: "{typography.body-md}"
    rounded: "{rounded.md}"
    padding: "{spacing.lg}"
  text-meta:
    backgroundColor: "{colors.surface}"
    textColor: "{colors.secondary}"
    typography: "{typography.caption}"
  chip-skill:
    backgroundColor: "{colors.subtle}"
    textColor: "{colors.primary}"
    typography: "{typography.label-caps}"
    rounded: "{rounded.full}"
    padding: "{spacing.xs}"
  input:
    backgroundColor: "{colors.neutral}"
    textColor: "{colors.on-surface}"
    typography: "{typography.body-md}"
    rounded: "{rounded.sm}"
    padding: "{spacing.sm}"
  input-error:
    backgroundColor: "{colors.neutral}"
    textColor: "{colors.error}"
    typography: "{typography.body-sm}"
  tooltip:
    backgroundColor: "{colors.primary}"
    textColor: "{colors.surface}"
    typography: "{typography.caption}"
    rounded: "{rounded.sm}"
    padding: "{spacing.sm}"
---

# Marginalia

## Overview

This is a working instructional designer's case-study archive, not a marketing site. The person reading it is a hiring manager or L&D director skimming a dozen portfolios in an afternoon; what earns a second minute is evidence of a real design process — the problem, the analysis, the storyboard, the outcome — written and shown plainly, without competing for attention against the site itself.

The register is **Editorial Print**, sourced from two objects specific to teaching rather than to software: a **chalkboard** and a **grading pen**. The default surface is not a "dark UI" in the SaaS sense — it's slate, the color of a used chalkboard, with body copy set the color of chalk dust. The single accent, a vermilion red, is the color of the ink instructors have used for a century to mark up drafts: it is the *only* color that means "look here, this is interactive or this needs attention," on links, primary actions, and the one tag color. A secondary paper-and-graphite palette (documented below) is the site's light mode, used identically in structure but inverted in material — chalk becomes pencil, slate becomes manila.

What this gives up, deliberately: **warmth-by-default and density**. Nothing here tries to look like a product. There is no dashboard chrome, no icon-in-a-tinted-square feature grid, and no attempt to look "modern" in the SaaS sense — it looks like a well-kept teaching notebook, because the audience for an instructional designer's portfolio already trusts that register more than it trusts a trendy one.

## Colors

Two colors carry the entire system, plus the neutrals needed to build a page out of them. Nothing is a stock semantic import — even the error state is drawn from the same red family as the accent, because in this domain a correction and a call to action are visually the same gesture: red ink in the margin.

- **Surface (#0D160F):** *Chalkboard slate.* The page background in the default (dark) mode. Deliberately green-grey, not navy or true black — an actual chalkboard is closer to slate than to ink. Nothing in this system is pure `#000000`.
- **Neutral (#19251C):** *Chalk-worn patch.* One step lighter than Surface — the tonal shift a chalkboard shows where it's been erased and rewritten many times. This is the entire elevation model: cards, inputs, and secondary buttons sit on Neutral rather than Surface, and nothing floats above that with a shadow.
- **On-surface (#EAE4D7):** *Chalk.* The primary text color — warm, dusty off-white, never pure white. This is what headlines and body copy are set in throughout the dark (default) mode.
- **Border (#2B362D):** *Chalk rail.* The thin ledge at the bottom of a chalkboard, tonally between Neutral and readable text. Used exclusively as a 1px hairline to divide sections — never as a box outline around a whole container.
- **Secondary (#8A968C):** *Eraser felt.* Muted grey-green for metadata: dates, durations, tool lists, byline text. It is legible but visibly recessive next to On-surface, which is the point — it should never compete with the writing.
- **Primary (#E16A60):** *Feedback red.* The color of the pen an instructor uses to annotate a draft in the margin. This is the sole accent in the system: every link, the primary button, and the one tag color use it, and nothing else does. It carries roughly one job across the whole site — "this is actionable, follow it" — and that job would be diluted if it also decorated headings or backgrounds.
- **Subtle (#2E1011):** *Red ink, dried.* A near-black wash of the accent, used only as the fill behind skill/tool tags so Primary-colored text has a quiet field to sit on without a second bright color entering the page.
- **Error (#DE6A71):** *Overwritten in red, twice.* A lighter, slightly more saturated step of the same ramp as Primary — not a stock alert red — reserved for form-validation states on the one contact form the site has.

**Light mode (secondary environment).** The site also ships a light theme — *notebook paper and pencil* — built as an independent design, not an inversion, per the usual rule that lightness cannot simply be flipped. Surface becomes a warm manila `#FAF4EB`, Neutral a deeper card stock `#F0E6DA`, Border `#D6CCC0`, On-surface a graphite ink `#221812`, Secondary a pencil grey `#645C53`. Primary darkens and gains chroma to `#A01E23` (red ink reads differently — and needs to be considerably darker — on cream paper than it does glowing against slate), and Error follows to `#860E2B`. Subtle becomes a pale wash `#FBD4CD`. Every pairing below was independently contrast-checked against this palette; none of it is a CSS filter over the dark tokens.

All neutrals in both modes carry a small trace of hue (chroma 0.014–0.024, never R=G=B) — chalkboard green in dark mode, paper warmth in light. Ramps were built in OKLCH with chroma tapering toward the extremes and hue bending 5–10° across each ramp, so the greys read as material rather than as a spreadsheet.

## Typography

Two families, split by job, and one of them does double duty by design.

**Fraunces** carries the entire editorial voice — display, headlines, and body copy alike — using its `opsz` axis to shift from a large, slightly loose display cut down to a tighter, more restrained text cut at 14–19px. This is a deliberate one-family decision: Fraunces has enough range (variable weight, optical size, and the `SOFT`/`WONK` axes) to carry a whole system, and using it for both display and reading text keeps the page reading as one written voice rather than a headline typeface glued onto a different body face. `WONK 1` is enabled only at display and headline-lg sizes — a slight, intentional irregularity in the letterforms that reads as *drawn*, echoing chalk-on-slate rather than a printed sans. Body sizes carry `'onum' 1` (oldstyle figures), which sit inside running prose the way a printed book's figures do, rather than the tabular, all-caps-height digits UI type normally uses. Fallback stack: `Fraunces, "Source Serif 4", Georgia, serif`. SIL Open Font License, self-hosted, Latin subset only.

**Public Sans** carries the apparatus — navigation, buttons, tags, captions, form labels, metadata — at a single weight (500) throughout the whole system. Hierarchy inside the apparatus layer comes entirely from size, case, and tracking, never from a second or third weight; this is what keeps the sans reading as quiet infrastructure under Fraunces' voice rather than competing with it. Chosen over the more common choice of Inter specifically for Public Sans' institutional, wayfinding register — appropriate for a resume-adjacent site read by people at universities and corporate L&D departments. Fallback stack: `"Public Sans", "Helvetica Neue", Arial, sans-serif`. SIL Open Font License, self-hosted.

Two weights total across the whole system — Fraunces 400/600, Public Sans 500 alone — spaced far enough apart that each one reads as a decision. The scale runs 11 → 88px on a ≈1.333 (perfect fourth) ratio through the middle of the range, hand-broken at the top: the generated ratio would put display around 61px, which read as timid for a hero headline, so it was pushed to 88px to create a real jump rather than a progression. Tracking runs from −0.03em at display to +0.12em on uppercase labels; line-height runs from 1.02 at display to 1.65 at body-lg, moving inversely with size at every step.

## Layout

A **12-column asymmetric grid**, 24px gutters, 64px outer margins on desktop, collapsing to a single column under 768px. Content — case-study prose, the resume, project write-ups — sits in an 8-column measure capped at **68 characters**; the remaining 4 columns on the right form a standing marginalia rail used for exactly one purpose: dates, tools, role, and duration for whatever case study is being read, set in `caption` and `label-caps`. This rail is the direct descendant of a teacher's red-pen note in a margin, and it is the only place `text-meta` styling appears outside a project index.

Nothing on the page is centered. Headlines, body copy, empty states, and the resume itself are flush-left against the grid, with the marginalia rail providing the visual counterweight that would otherwise come from centering. This is a system-level commitment, not a per-page choice.

Spacing runs on a strict **8px base** (`spacing.sm`), with a 4px half-step reserved for chip padding and inline label gaps. Density is intentionally uneven: the project index (a scannable list of case studies) runs tight, close to `label-caps` and `caption` type with 8px row spacing; an individual case-study page, once someone has clicked in, opens up to `body-lg` and generous 32–64px section spacing. The density shift is itself a signal — it tells a reader which kind of page they're on before they've read a word, exactly the way a table of contents differs from a chapter.

## Elevation & Depth

The system is flat. There are no drop shadows anywhere, including on the tooltip and the one dropdown menu the site has (language switch / theme toggle).

Depth is carried by two devices:

1. **Tonal layering** — the Surface → Neutral step (chalkboard → chalk-worn patch). A card is a different patch of the same board, not an object floating above it.
2. **Hairline rules** — 1px in `border`, used only to divide, never to box in a whole container. A case-study section ends with a rule below it; it does not get a rule on all four sides.

The one exception to "nothing floats" is the `tooltip` component, which intentionally uses `primary` as its fill rather than a neutral — it's modeled as a margin annotation, not a UI popover, and giving it the accent color rather than a grey is what sells that metaphor. It still carries no shadow; it's set apart by color alone, which is legitimate here because it never carries state (see Do's and Don'ts on color-alone signaling, which is about semantic state, not this decorative case).

## Shapes

Radius is small and hierarchical, never uniform. Inputs and buttons sit at `rounded.sm` (2px) — barely perceptible, present mostly so edges don't look cut with a blade. Cards sit one step softer at `rounded.md` (3px). `rounded.full` is reserved exclusively for skill/tool chips, where the pill shape marks them as a distinct class of object (a label, not a container) the same way `chip-skill` differs in role from `card`.

Borders are 1px solid `border` at rest; on focus, inputs switch to a 2px `primary` ring offset 2px from the field, which clears 3:1 against both Surface and Neutral. No component uses a radius above 3px except the chips — a `rounded-2xl` card would read as software; this system is trying to read as a notebook.

## Components

**Buttons.** Primary is a solid `primary` fill with `surface`-colored text (near-black ink on red — legible at 5.65:1, and a specific choice: white text on this red read too close to a generic "SaaS button" once tested). On hover the fill darkens toward `#A83538`, and text correspondingly flips to `on-surface` (chalk) rather than staying dark, since a darker fill needs a lighter foreground to hold contrast — this flip is an intentional detail, not a bug. Secondary is a `neutral` fill with `primary` text and no fill change on hover, just an underline; there is no tertiary or ghost button. If a screen wants a third action, it's given to the marginalia rail as a plain link instead.

**Chips (`chip-skill`).** Pill-shaped, `subtle` fill, `primary` text, always `label-caps`. Used only for tools and skills attached to a case study (e.g. "Storyline 360," "Needs Analysis," "UDL"). Never used as a generic status or category tag — if a non-skill tag is needed later, it should get its own component rather than borrowing this one's meaning.

**Cards (`card`).** `neutral` fill, 3px radius, 32px padding, no border and no shadow. Used only for the project index — one card per case study, title + one-line outcome + a `chip-skill` row. Never nested; a list of details inside a card is a plain list with hairline rules, not a card of cards.

**Inputs.** `neutral` fill, 1px `border` rule, 2px radius, set at full `body-md` size rather than a smaller UI size, since the only form on the site (contact) should read as continuous with the surrounding prose rather than as a distinct "app" moment. Error state swaps text to `error` and the rule to `error`; an inline message always accompanies it, never color alone.

**Tooltip.** `primary` fill, `surface` text, `caption` size, 150ms delay in and no delay out — used sparingly, for definitions of instructional-design jargon (ADDIE, SAM, UDL) a non-specialist reader might not know.

**Marginalia rail (text).** Not a boxed component — plain `text-meta` styling (`secondary` on `surface`, `caption` size) stacked in the right-hand rail described under Layout. It never gets a card or a border; its position in the grid is what signals its role.

## Do's and Don'ts

- **Do** keep `primary` (#E16A60) to links, the primary button, hover/focus rings, and `chip-skill` text. If a fifth use case comes up, that's a sign the design needs a new decision, not a reason to reach for the accent again.
- **Don't** introduce a second accent color for "variety." Case-study category badges, a second CTA, a highlight color for pull quotes — all of these should be solved with `on-surface`, weight, or the marginalia rail, not a new hue.
- **Don't** add a shadow anywhere, including on the tooltip or any dropdown. If something needs to look raised, use the Surface → Neutral step; if that's not visible enough, the fix is more space around it, not a shadow.
- **Do** set all body prose in Fraunces at `opsz` tuned for its size — never substitute Public Sans into a paragraph of case-study narrative. The apparatus face is for labels and metadata only.
- **Don't** add a third font weight to either family. Fraunces stays at 400/600, Public Sans stays at 500. A heading that isn't reading as a heading needs more size or space above it, not more weight.
- **Do** center nothing. Headlines, empty states, the resume download block — all flush-left. Centering here would erase the marginalia rail's job as visual counterweight.
- **Do** cap body measure at 68 characters, including inside cards. Case-study narrative is meant to be read, not skimmed past.
- **Don't** use pure `#FFFFFF` or `#000000` anywhere, including in exported PDF resume assets. Every neutral in both modes carries a trace of hue; an untinted value next to them will look like a rendering error, not a design choice.
- **Do** pair the `error` state with a written inline message on every form field. Color alone is not sufficient, and roughly 8% of readers can't reliably distinguish red from the surrounding neutrals by hue alone.
- **Don't** wrap the project index in a uniform three-column grid "for consistency." Density is allowed to differ between the index and an individual case-study page — that shift is a deliberate wayfinding signal, not an inconsistency to fix.
- **Do** limit motion to state changes only — button fill on hover, the focus ring, the tooltip's appearance — each at 150ms with a plain ease-out, matching the `tooltip` component's timing. **Don't** add scroll-triggered reveals, fade-ups, or any entrance animation to case-study content: content should be fully present the instant it's in the viewport, the same way text on a page doesn't animate in when you turn to it.
