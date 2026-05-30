# Design Skill — Empire INK

## Identity
Dark luxury tattoo studio. Premium, not edgy. Gold on black.
Not a generic template site — a crafted brand presence.
Reference: the Claude Design demo (React JSX files from content.jsx, sections.jsx)

## Color palette (from client.css)
--color-primary:        #D4A85A   (warm gold)
--color-primary-hover:  #B8962E   (darker gold)
--color-primary-light:  rgba(212, 168, 90, 0.15)
--color-bg:             #0D0B09   (near-black warm)
--color-bg-alt:         #141210   (slightly lighter)
--color-surface:        #1A1714   (card backgrounds)
--color-text:           #F5F0E8   (bone/cream)
--color-text-light:     #B8B0A4   (muted bone)
--color-text-inverse:   #0D0B09   (for text on gold buttons)
--color-border:         rgba(255, 255, 255, 0.06)
--color-border-light:   rgba(255, 255, 255, 0.12)

## Typography
Self-hosted (GDPR): Antonio (display), Cormorant Garamond (serif accents), Inter (body)
Font files: assets/fonts/ (woff2, latin + latin-ext subsets)

Display/Headings: Antonio, weight 500, uppercase, tight leading (0.92)
Serif accent: Cormorant Garamond italic, weight 400, gold gradient text
Body: Inter, regular (400)
Data/labels: Inter medium (500), small size

Scale:
  Hero heading:  3rem (5xl)
  Section title: 2.25rem (4xl)
  Card title:    1.25rem (xl)
  Body:          1rem (base)
  Small/meta:    0.875rem (sm)
  Tiny:          0.75rem (xs)

## Components

### Navigation (header.php)
Background: #0D0B09 (solid dark, not transparent)
Shadow: subtle gold line (0 1px 0 rgba(212, 168, 90, 0.1))
Logo: left, custom-logo or text in bone color
Nav links: bone color, gold on hover, gold underline animation
CTA button: gold bg, dark text, sharp corners
Mobile: hamburger → slide-out drawer

### Buttons
Primary: gold bg (#D4A85A), dark text (#0D0B09), sharp corners (radius-sm: 0.125rem)
Secondary: transparent bg, gold border, gold text → gold bg on hover
Accent: same as primary
White: used on hero overlays
ALL buttons: Oswald or Inter bold, no rounded corners

### Cards
Background: #1A1714 (surface)
Border: rgba(255, 255, 255, 0.06)
Shadow: subtle dark (rgba 0,0,0 heavy)
Radius: 0.375rem (slightly rounded, not pill-shaped)
Hover: elevated shadow, subtle lift

### Hero section
Min-height: 90vh
Background: image with dark overlay (rgba(13, 11, 9, 0.6))
Text: bone/cream on overlay
Two CTAs: primary (gold) + secondary (outline/white)
Heading: large, Oswald

### Social proof bar
Background: #141210 (bg-alt)
Border-bottom: subtle light border
Stars: gold (#D4A85A)
Score: large, bold, bone color
Labels: muted text

### Footer
Background: #0D0B09 (same as body)
Text: muted (#B8B0A4)
Headings: bone (#F5F0E8)
Links: dim (#6B6560) → gold on hover
Border-top: subtle gold (rgba(212, 168, 90, 0.15))
Credit: "Website door Monoliet.cloud"

## Spacing
Section vertical padding: 6rem (space-4xl)
Container max-width: 1200px
Card padding: 2rem (space-xl)
Component gap: 2rem (space-xl)

## Animations
Transitions: 150ms (fast), 250ms (base), 350ms (slow)
Card hover: shadow elevation + subtle translateY(-2px)
Image hover: scale(1.05) on portfolio/team cards
Nav underline: width 0 → 100% on hover
NO: bounce, wiggle, or playful effects

## Images
Use real Empire Ink images from their website where possible.
Hero background: tattoo close-up or studio shot.
Team: portrait aspect ratio (3:4)
Portfolio: landscape (4:3)
Placeholder strategy: dark solid color (#1A1714) when no image available

## FORBIDDEN
- Light/white backgrounds anywhere
- Rounded pill buttons
- Gradients (except subtle overlay on hero)
- Stock photography
- Saturated neon colors
- Comic Sans, Papyrus, or novelty fonts
- Centered paragraph text in content areas (left-align body text)

## Language
Default: Dutch (NL)
Secondary: English (EN)
Language switcher in nav (NL | EN toggle)
All template strings use __() / _e() for i18n
