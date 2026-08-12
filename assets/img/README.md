# Image assets

Every image on the landing page is declared once, near the top of `index.php`.
Files are cache-busted by modification time, so replacing a file takes effect on the
next page load — no code change needed.

## Brand lockup

| File | Used for |
|---|---|
| `interpsychaz-logo.webp` | Supplied white lockup — footer, and the header while it floats transparent over the hero |
| `interpsychaz-logo-dark.webp` | Generated indigo (`#262858`) recolour of the same artwork — header once scrolled onto light backgrounds |
| `favicon-32.png`, `favicon-180.png` | Browser tab and iOS home-screen icon, cropped from the head mark |

The dark variant and favicons are generated from `interpsychaz-logo.webp`. If the logo
is ever replaced, regenerate them so all three stay in sync.

## Practice photography — `assets/img/ambience/`

Real photos of the practice. These take priority over any stock placeholder.

| File | Where it appears |
|---|---|
| `hero-bg-inter.webp` | Hero background — neuron/synapse render |
| `inter-a-1.webp` | Treatments — Ketamine Therapy card (monitoring room) |
| `inter-a-2.webp` | Treatments — TMS Therapy card (Magstim chair) |
| `why-patient-trust-us.webp` | Why-us section, main image — TMS treatment in progress |
| `inter-a-3.png` | *Currently unused* — front desk, kept in case you want it back |

**Worth re-exporting:** `hero-bg-inter.webp` is 680 × 453, which the full-bleed hero
scales up roughly 3×. It holds up better than a photograph would at that scale, but a
≥ 2000 px wide version would sharpen the most prominent image on the page.

## Stock placeholder slots — `assets/img/`

These slots still use licensed Unsplash placeholders. Drop a real file at the name
below and it replaces the placeholder automatically.

| File | Where it appears | Suggested subject | Min size |
|---|---|---|---|
| `medication.jpg` | Treatments — Medication Management card | Clinician reviewing a regimen with a patient | 900 × 560 |
| `psychotherapy.jpg` | Treatments — Psychotherapy card | A therapy session in conversation, no identifiable patient | 900 × 560 |
| `care.jpg` | Conditions section (dark band) | A warm, human moment — support, reassurance | 1000 × 750 |
| `hero.jpg` | Overrides the ambience hero image if present | Wide shot of the space | 2000 × 1200 |

Filenames must not contain spaces — a space in an asset path has to be URL-encoded and
trips up some servers and CDNs. Use hyphens.

## Insurance carrier logos — `assets/img/insurance/`

Trimmed and normalised from the existing interpsychaz.com media library. A carrier
listed in `$insurers` without a matching file still renders, as a plain wordmark tile,
so the wall never shows a gap.

`ambetter.png` · `arizona-complete-health.png` · `bcbs-arizona.png` · `care1st.png` ·
`cigna.png` · `curative.png` · `health-net.png` · `humana.png` · `medicare.png` ·
`mercy-care.png` · `optum.png` · `scan-health-plan.png` · `tricare-for-life.png` ·
`triwest.png` · `unitedhealthcare-community-plan.png` · `wellcare-allwell.png`

**Missing: `aetna.png`** — currently rendering as a wordmark tile.

Logos sit on white cards, so a white background in the file is seamless. Trim tight to
the artwork; the card supplies the padding.

## Notes

- Export photos at ~80% JPEG/WebP quality; aim for under ~250 KB each.
- Alt text lives beside each slot in the `$IMG` array in `index.php`. Update it when a
  photo's subject changes.
- Once every slot has a real photo, the page makes no external image request.
- Patient-facing photography should use models or consented photos — never an
  identifiable patient without written authorisation.
