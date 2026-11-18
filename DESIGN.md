# Design System & Visual Specification — ATELIER PEKALONGAN

This document defines the complete visual design system, spatial architecture, typography, color tokens, atmospheric studio lighting, and interactive component specifications for **Atelier Pekalongan** (Hand-Drawn Batik & Coastal Heritage). Inspired by minimalist European wellness/architectural editorials (specifically the *Fitosauna* layout paradigm), this design positions Indonesian heritage textile craftsmanship on a gallery-grade pedestal.

---

## 1. Design Philosophy & Aesthetic Direction

1. **Quiet Luxury & Artisanal Heritage**: Rather than cluttering the interface with traditional decorative borders, the UI remains ultra-clean and architectural. This ensures the intricate hand-drawn Pekalongan batik motifs (*Jlamprang*, *Buketan*, *Tujuh Rupa*), carved teak wood (*gawangan*), and brushed brass accents remain the undisputed visual centerpiece.
2. **Chiaroscuro & Dappled Studio Lighting**: The full-bleed background emulates a warm plaster and stone studio bathed in late-afternoon diagonal sunlight, casting soft, organic window and foliage shadows (*dappled light*) across the wall and pedestal floor.
3. **Perimeter Framing Architecture**: Navigation controls, display typography, editorial copy, and media triggers are anchored strictly to the outer perimeter of the viewport, leaving the central canvas unobstructed for the product sculpture.
4. **Hairline Precision & Glassmorphism**: Interactive triggers use crisp `1px` semi-transparent borders (`rgba(255, 255, 255, 0.25)` to `0.50`) paired with subtle `backdrop-filter: blur()` treatments, creating a tactile yet weightless modern interface.

---

## 2. Color Palette & Design Tokens

### A. Core Surface & Atmospheric Studio Tokens

| Token Name | Hex / Value | Role & Application |
| :--- | :--- | :--- |
| **Deep Earth Espresso** | `#1E1A17` / `#191512` | Base canvas background, bottom vignette gradient, and dark surface anchor. |
| **Drawer Obsidian** | `#1C1815` / `#211C18` | Background surface for the slide-out navigation drawer and modal dialogs. |
| **Warm Stone Taupe** | `#C4BCB2` | Mid-tone plaster wall color inside the radial studio backdrop. |
| **Sunlit Alabaster** | `#F8F9FB` | Primary light source highlight behind the central batik centerpiece. |
| **Mori Gallery White** | `#FFFFFF` | Crisp bleached *mori primisima* background surface for the curated collection section below the fold. |
| **Coastal Stone Surface** | `#F4F5F7` | Cool neutral stone surface for secondary sections and controls. |
| **Charcoal Umber** | `#1F2328` | Primary body and heading typography color on light surfaces. |

### B. Artisanal Accent & Material Tokens (Batik & Hardware)

| Token Name | Hex Range | Role & Application |
| :--- | :--- | :--- |
| **Sogan Gold (Primary Accent)** | `#A8763E` / `#D9A86C` | Eyebrow labels, text selection highlight, focus rings, and wax-resist motif details. |
| **Sogan Klasik (Colorway 01)** | `#382518` → `#8F5D34` | Silk base gradient for the classic Javanese *Sogan* batik theme. |
| **Indigo Pesisir (Colorway 02)** | `#172430` → `#385B75` | Silk base gradient for the coastal fermented *Indigo* batik theme. |
| **Buketan Gading (Colorway 03)** | `#8C7761` → `#DFCBB0` | Silk base gradient for the warm *Ivory Buketan* batik theme. |
| **Carved Teak Wood** | `#6E4427` → `#B67A4B` | Multi-stop linear gradient simulating polished Javanese teak wood stands. |
| **Brushed Brass Hardware** | `#5C4D3C` → `#C9B496` | Metallic hardware joints on the wooden stand and the copper *canting* pen. |

### C. Lighting Gradients & Surface Textures

* **Studio Wall Backdrop (`.studio-backdrop`)**:
  ```css
  background: radial-gradient(
    circle at 64% 38%,
    rgba(246, 242, 236, 0.92) 0%,
    rgba(196, 188, 178, 0.85) 42%,
    rgba(92, 83, 75, 0.95) 100%
  );
  ```

* **Studio Horizon Pedestal Floor (`.studio-floor`)**:
  Occupies the bottom `27%` of the `100vh` hero viewport with a subtle top border (`border-white/15`) and upward ambient shadow:
  ```css
  background: linear-gradient(
    180deg,
    rgba(114, 102, 91, 0.45) 0%,
    rgba(56, 48, 41, 0.92) 100%
  );
  ```

* **Analog Film Grain Overlay (`.grain-overlay`)**:
  Full-viewport inline SVG noise filter (`feTurbulence` with `type="fractalNoise"`, `baseFrequency="0.85"`, `numOctaves="3"`, `opacity="0.06"`) to prevent gradient banding and evoke medium-format editorial photography.

---

## 3. Typography System

The typographic hierarchy pairs an expressive high-contrast editorial serif for brand authority with a crisp geometric sans-serif for the main hero statement and functional UI controls.

### A. Font Families

1. **Display & Editorial Serif**: `'Cormorant Garamond', Georgia, serif`
   * **Usage**: Center header brand wordmark (`ATELIER PEKALONGAN`), section headings, product titles, and navigation drawer links.
   * **Rationale**: High stroke contrast echoes the delicate wax lines drawn by a traditional copper *canting*.

2. **UI & Body Humanist Sans-Serif**: `'Source Sans 3', -apple-system, BlinkMacSystemFont, sans-serif`
   * **Usage**: Bordered buttons, UI labels, editorial paragraphs, and footer bar.
   * **Rationale**: Warm, highly legible humanist proportions designed for long-form reading and functional clarity without generic AI font clichés.

### B. Typographic Scale & Specifications

| Element | Font Family | Size (Mobile → Desktop) | Weight | Tracking & Line-Height | Case |
| :--- | :--- | :--- | :--- | :--- | :--- |
| **Brand Wordmark** | Cormorant Garamond | `18px` → `26px` | `500` (Medium) | `tracking-[0.18em]` / `leading-none` | Uppercase |
| **Hero Display Headline (`H1`)** | Cormorant Garamond | `36px` (`text-4xl`) → `68px` | `500` (Medium) | `tracking-[-0.015em]` / `leading-[1.06]` | Sentence case |
| **Section Heading (`H2`)** | Cormorant Garamond | `30px` (`text-3xl`) → `48px` (`text-5xl`) | `400` (Regular) | `tracking-tight` / `leading-[1.15]` | Title Case |
| **Drawer Navigation Links** | Cormorant Garamond | `30px` (`text-3xl`) | `400` (Regular) | `tracking-normal` / `leading-snug` | Title Case |
| **Editorial Body Copy** | Source Sans 3 | `14px` → `15.2px` | `400` (Regular) | `tracking-[0.01em]` / `leading-[1.65]` | Sentence case |
| **UI Buttons & Nav Controls** | Source Sans 3 | `12px` | `500` (Medium) | `tracking-[0.14em]` | Uppercase |
| **Footer & Eyebrow Copy** | Source Sans 3 | `13px` | `600` (SemiBold) | `tracking-[0.10em]` | Uppercase |

---

## 4. Layout Architecture & Spatial Grid

### A. Full-Bleed Hero Viewport (`100vh`)

The hero section is locked to `min-h-screen h-screen` with `overflow-hidden` and structured as a vertical Flexbox container (`flex-col justify-between`) divided into three spatial zones:

1. **Top Navigation Bar (`z-20`)**:
   * **Container**: `max-w-[1600px] mx-auto grid grid-cols-3 items-center`
   * **Horizontal Padding**: `px-5 sm:px-8 lg:px-12` | **Top Padding**: `pt-5 sm:pt-7`
   * **Left Cell**: Side-by-side `= MENU` button and `ID`/`EN` language toggle (`space-x-2`).
   * **Center Cell**: Centered `ATELIER PEKALONGAN` serif logo.
   * **Right Cell**: Right-aligned `KONSULTASI PESANAN →` (`GET A CONSULTATION →`) button.

2. **Main Content Perimeter Canvas (`z-10`, `flex-1`)**:
   * **Top-Left Quadrant**: Houses the 2-line display headline (`max-w-xl`), the dual-part outlined CTA button + circular arrow button (`mt-6 sm:mt-8`), and the interactive silk colorway switcher pill (`mt-5`).
   * **Center Visual Anchor (`z-0`)**: Absolutely centered container (`flex items-center justify-center`) housing the responsive SVG sculpture (`w-[310px]` on mobile up to `w-[470px]` on desktop, `h-[54vh]` to `h-[64vh]`).
   * **Bottom-Left Quadrant**: Houses the concise 3–4 line editorial description (`max-w-[330px] sm:max-w-[360px]`).
   * **Bottom-Right Quadrant**: Houses the floating glassmorphism media card (`LIHAT PROSES BATIK '26` / `DISCOVER OUR CRAFT '26`, `max-w-[270px] sm:max-w-[285px]`).

3. **Bottom Hairline Footer Bar (`z-10`)**:
   * **Container**: Full-width with `border-t border-white/25`, `pt-3.5 pb-4 sm:pb-5`.
   * **Left**: `GULIR UNTUK MENJELAJAHI` (`SCROLL TO EXPLORE`) anchor link.
   * **Right**: White status dot (`w-1.5 h-1.5 rounded-full bg-white`) + `ATELIER PEKALONGAN` signature.

---

## 5. Component Specifications & Micro-Interactions

### 1. Outlined Header & Action Buttons
* **Resting State**: `border border-white/40` (or `white/50` for primary CTA), `bg-black/15`, `backdrop-blur-sm`, `text-white`.
* **Hover State**: Solid white fill (`hover:bg-white`), dark charcoal text (`hover:text-stone-900`), solid white border (`hover:border-white`), smooth `transition-all duration-300`.
* **Icon Motion**: Right-pointing arrows translate `+2px` to `+4px` along the X-axis on group hover (`group-hover:translate-x-1`), while the two-line hamburger icon expands its lower bar from `66%` to `100%` width.

### 2. Dual-Part Hero CTA Control
* Mirrors the reference design by pairing a rectangular bordered text button (`px-6 py-3.5`) directly beside a detached circular icon button (`w-11 h-11 rounded-full border border-white/50`) separated by `gap-2.5` (`10px`).

### 3. Interactive Silk Colorway Switcher Pill
* **Container**: Compact glassmorphic pill (`px-3 py-1.5 rounded-full bg-black/25 border border-white/15 backdrop-blur-md`).
* **Swatches**: Three `14px` (`w-3.5 h-3.5`) circular buttons representing *Sogan Klasik* (`#8F5D34`), *Indigo Pesisir* (`#284257`), and *Buketan Gading* (`#DFCBB0`).
* **Behavior**: Clicking a swatch dynamically updates the `fill` attribute of `#batik-fabric-base` inside the central SVG illustration and applies an active white offset ring (`ring-2 ring-white ring-offset-1 ring-offset-stone-900`).

### 4. Bottom-Right Floating Craft Media Card
* **Surface**: `border border-white/30 bg-stone-900/45 hover:bg-stone-900/65 backdrop-blur-md p-2.5 pr-4`.
* **Anatomy**:
  1. **Left Thumbnail (`64px × 48px`)**: Mini framed vector preview of the *Jlamprang* motif that scales to `1.10x` on hover (`duration-500`).
  2. **Center Metadata**: Primary uppercase title (`10px`, `tracking-[0.16em]`) + muted subtitle (`9px`, `text-white/65`).
  3. **Right Action Icon**: Solid white circular play button (`w-7 h-7 rounded-full bg-white text-stone-900`) that scales to `1.10x` on hover.

### 5. Central SVG Centerpiece (`#batik-centerpiece`)
* **ViewBox**: `0 0 460 560` with `drop-shadow(0 25px 35px rgba(28, 22, 17, 0.48))`.
* **Structural Layers**:
  1. **Floor Cast Shadow**: Blurred elliptical base shadow (`bg-stone-950/65 blur-xl`).
  2. **Carved Teak *Gawangan* Frame**: Vertical posts, curved Javanese crown bar, and plinth base rendered with `#teakWood` and `#brassMetal` gradients.
  3. **Draped Silk Path (`#batik-fabric-base`)**: Organic bezier curve silhouette filled with the active silk colorway gradient.
  4. **Pekalongan *Jlamprang* Pattern Overlay (`#jlamprangPattern`)**: Repeating `44×44` user-space pattern featuring geometric lotus stars, concentric *ceplok* rings, and *isen-isen cecek* (wax dots).
  5. **Traditional *Tumpal* Hem Border**: Row of isosceles triangles along the lower fabric hem (`fill="#E6C697" fill-opacity="0.65"`).
  6. **3D Drapery Fold Shading (`#drapeFolds`)**: Horizontal multi-stop black/white opacity gradient simulating vertical silk folds and diagonal sunlight glints.
  7. **Sculptural Copper *Canting* Accent**: Foreground wooden block and curved brass/copper *canting tulis* resting at the base of the stand.

### 6. Slide-Out Navigation Drawer & Modal Dialogs
* **Navigation Drawer (`#menu-drawer`)**: Left-aligned off-canvas panel (`max-w-md`, `bg-[#1C1815]`, `border-r border-white/15`) featuring numbered serif navigation items (`01` to `04`) and Pekalongan gallery address metadata at the foot.
* **Bespoke Consultation Modal (`#consult-modal`)**: Centered dialog (`max-w-lg`, `bg-[#211C18]`, `border border-white/20`) with motif pre-selection support (`openConsultWithMotif()`) and an inline confirmation state (`#consult-success`).
* **Craft Process Showcase Modal (`#craft-modal`)**: Centered 3-column educational modal (`max-w-2xl`) detailing the three stages of Pekalongan batik making: *01 Nyoret & Canting*, *02 Medel & Nyoga*, and *03 Nglorod*.

---

## 6. Motion & Animation Specifications

| Animation / Transition | Target Element | Timing & Easing | Behavior |
| :--- | :--- | :--- | :--- |
| **`swayShadow` Keyframes** | `.shadow-dappled` (SVG Foliage Shadows) | `16s ease-in-out infinite` | Gently translates (`-12px, 8px`), scales (`1.02` → `1.04`), and rotates (`0.6deg`) the blurred botanical shadow layer to mimic a natural breeze outside the studio window. |
| **Button Fill Inversion** | Header, Hero CTA, & Modal Buttons | `300ms cubic-bezier(0.4, 0, 0.2, 1)` | Smoothly transitions background from `bg-black/15` to `#FFFFFF` and text/SVG stroke color to `#1C1917`. |
| **Drawer Slide Transition** | `#menu-panel` & `#menu-backdrop` | `300ms ease-out` | Slides drawer from `-translate-x-full` to `0` while fading backdrop opacity from `0` to `100%`. |
| **Card Image Zoom** | Craft Thumbnail & Collection Cards | `500ms cubic-bezier(0.4, 0, 0.2, 1)` | Scales preview graphic (`scale-110` or `scale-[1.03]`) on parent group hover. |

---

## 7. Responsive Breakpoint Strategy

* **Mobile (`< 640px`)**:
  * Header consultation button condenses label from `KONSULTASI PESANAN` to `KONSULTASI` (`CONSULT`).
  * Hero headline scales to `36px` (`text-4xl`); central batik sculpture scales to `w-[310px] h-[54vh]` so top and bottom text layers never collide.
  * Bottom editorial description and craft media card stack vertically (`flex-col gap-6`).
* **Tablet (`sm: 640px – 1023px`)**:
  * Hero headline scales to `48px–60px` (`text-5xl` / `text-6xl`); sculpture scales to `w-[370px]–w-[430px]`.
  * Bottom row switches to horizontal alignment (`sm:flex-row sm:items-end justify-between`).
* **Desktop (`lg: 1024px+`)**:
  * Full `64px` display headline, generous `48px` (`px-12`) horizontal perimeter padding, and `470px` central sculpture width within a `1600px` max-width frame.

---

## 8. Bilingual Localization Matrix (`ID` / `EN`)

All text nodes tagged with `[data-i18n]` switch instantaneously via the header `ID`/`EN` toggle button:

| Key (`data-i18n`) | Indonesian (`id` — Default) | English (`en`) |
| :--- | :--- | :--- |
| `nav_menu` | `MENU` | `MENU` |
| `nav_consult` | `KONSULTASI PESANAN` | `GET A CONSULTATION` |
| `hero_title_1` | `Warisan seni` | `Heritage art` |
| `hero_title_2` | `dalam balutan` | `draped in grace` |
| `hero_cta` | `JELAJAHI KOLEKSI` | `EXPLORE COLLECTION` |
| `swatch_label` | `Warna Kain:` | `Silk Tone:` |
| `hero_desc` | `Batik tulis Pekalongan dirancang untuk Anda yang menghargai ketelitian tangan pengrajin dan keindahan motif pesisir dalam setiap momen istimewa.` | `Hand-drawn Pekalongan batik is crafted for those who cherish artisanal precision and coastal heritage motifs during quiet, meaningful moments.` |
| `card_title` | `LIHAT PROSES BATIK '26` | `DISCOVER OUR CRAFT '26` |
| `card_sub` | `Canting & Pewarna Alam` | `Canting & Natural Dyes` |
| `footer_scroll` | `GULIR UNTUK MENJELAJAHI` | `SCROLL TO EXPLORE` |