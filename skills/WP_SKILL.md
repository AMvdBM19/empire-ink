# WordPress Skill — Empire INK (empire-ink.monoliet.cloud)

## Environment
- WP container: wp-empire-ink
- DB: wp_empire_ink @ shared-mariadb
- WP CLI: docker exec wp-empire-ink wp [command] --allow-root
- Theme location (VPS): /opt/docker/clients/empire-ink/wp/wp-content/themes/monoliet-starter/
- Plugins location (VPS): /opt/docker/wp-factory/shared-plugins/ (read-only mount)

## Active plugins (never delete)
- advanced-custom-fields: ACTIVE — ACF Free, field groups registered via PHP
- monoliet-core: ACTIVE — booking shortcode, reviews, hours, health API, admin branding
- wordpress-seo: ACTIVE — Yoast Free, SEO meta
- autoptimize: ACTIVE — CSS/JS minification
- wp-super-cache: ACTIVE — page caching
- redirection: ACTIVE — 301 redirects
- wordfence: ACTIVE — security
- wp-mail-smtp: ACTIVE — email deliverability

## Theme
- Active: monoliet-starter (custom theme, NOT a child theme)
- Volume-mounted: editing files on VPS disk = instant live change
- CSS: all visual identity in assets/css/client.css (custom properties)
- Base styles: assets/css/base.css + assets/css/components.css (shared, rarely edited)
- JS: assets/js/main.js (mobile nav, scroll, smooth scroll)

## ACF Field Groups (registered in PHP, inc/acf-fields.php)
- Homepage Hero: hero_heading, hero_subheading, hero_cta_text, hero_cta_url, hero_secondary_cta_text, hero_secondary_cta_url, hero_background_image
- Social Proof Bar: proof_rating_score, proof_rating_source, proof_metric_[1-3]_value, proof_metric_[1-3]_label
- CTA Banner: cta_heading, cta_subtext, cta_button_text, cta_button_url
- Site Settings (page template): business_name, business_tagline, business_phone, business_email, business_address, business_city, business_postal_code, business_maps_embed, hours_[monday-sunday], social_instagram, social_facebook, social_tiktok, social_whatsapp, footer_credit, enable_lang_switcher, default_language
- Team Member: member_role, member_specialties, member_booking_url
- Promotion: promo_price, promo_valid_from, promo_valid_to, promo_cta_url, promo_cta_text, promo_conditions
- Testimonial: testimonial_rating, testimonial_source, testimonial_date
- Portfolio Item: portfolio_description, portfolio_team_member

## Custom Post Types
- team_member (Team Members)
- promotion (Promotions)
- testimonial (Testimonials)
- portfolio_item (Portfolio)

## Template Parts (in template-parts/)
- hero.php — full-height hero with bg image, heading, two CTAs
- social-proof.php — rating + 3 metrics bar
- team-grid.php — 3-column team member cards
- services.php — renders Services page content
- promotions.php — promo cards with price, validity, CTA
- testimonials.php — review cards with stars
- portfolio-grid.php — portfolio items with category badges
- contact.php — phone, email, address, map, WhatsApp button
- cta-banner.php — full-width CTA section

## How to make changes

### Content changes (WP-CLI)
docker exec wp-empire-ink wp --allow-root post meta update <ID> <field> "<value>"
docker exec wp-empire-ink wp --allow-root option update <option> "<value>"

### Design changes (edit files on VPS)
Edit files directly at /opt/docker/clients/empire-ink/wp/wp-content/themes/monoliet-starter/
Changes take effect immediately (volume mount).

### After any change, flush cache
docker exec wp-empire-ink wp --allow-root cache flush

### Media uploads via WP-CLI
docker exec wp-empire-ink wp --allow-root media import <url> --title="<title>"

## Deployment (for git-tracked changes)
Local: edit files → git commit → git push
VPS: cd /opt/docker/clients/empire-ink && git pull
Or: /deploy-to-vps empire-ink (standard deploy for updates)

## Protected zones
- /opt/docker/wp-factory/shared-plugins/ — NEVER edit directly
- shared-mariadb — NEVER rebuild
- Other clients' directories — NEVER cross-modify
