<?php
/**
 * Template part: Hero section — Empire INK design.
 *
 * Full-height background image, eyebrow, two-line heading with
 * serif-italic accent word, subtitle, two CTAs, scroll indicator.
 *
 * @package MonolietStarter
 */

$heading    = get_field('hero_heading') ?: __('Jouw verhaal, ons canvas', 'monoliet-starter');
$subheading = get_field('hero_subheading') ?: __('Acht artiesten. Drie piercers. Eén van de grootste studio\'s van Nederland. Premium werk, walk-ins welkom, zeven dagen per week.', 'monoliet-starter');
$cta_text   = get_field('hero_cta_text') ?: __('Maak een Afspraak', 'monoliet-starter');
$cta_url    = get_field('hero_cta_url') ?: '#section-contact';
$cta2_text  = get_field('hero_secondary_cta_text') ?: __('Bekijk Portfolio', 'monoliet-starter');
$cta2_url   = get_field('hero_secondary_cta_url') ?: '#section-portfolio';
$bg_image   = get_field('hero_background_image') ?: MONOLIET_THEME_URI . '/assets/img/hero-bg.webp';

$title_line1 = __('Jouw verhaal,', 'monoliet-starter');
$title_line2 = __('ons canvas', 'monoliet-starter');
$accent_word = __('verhaal', 'monoliet-starter');

$parts = explode($accent_word, $title_line1, 2);
?>

<section id="section-hero" class="hero">
    <!-- Background image -->
    <div class="hero__bg">
        <img src="<?php echo esc_url($bg_image); ?>" alt="" class="asset hero__bg-img">
        <div class="hero__overlay hero__overlay--gradient"></div>
        <div class="hero__overlay hero__overlay--side"></div>
        <div class="hero__overlay hero__overlay--vignette"></div>
    </div>

    <!-- Side rail -->
    <div class="hero__rail hide-sm">
        <span>Instagram</span>
        <span>·</span>
        <span>@empire.ink.rotterdam</span>
    </div>

    <div class="wrap reveal hero__content">
        <div class="eyebrow hero__eyebrow">
            <span class="hero__eyebrow-dash"></span>
            <?php esc_html_e('Rotterdam · Sinds 2017', 'monoliet-starter'); ?>
        </div>

        <h1 class="display hero__title">
            <?php echo esc_html($parts[0]); ?><span class="serif-it gold-text hero__accent"><?php echo esc_html($accent_word); ?></span><?php echo esc_html($parts[1] ?? ''); ?><br>
            <span style="color: var(--bone);"><?php echo esc_html($title_line2); ?></span>
        </h1>

        <p class="hero__sub"><?php echo esc_html($subheading); ?></p>

        <div class="hero__ctas">
            <?php if ($cta_text) : ?>
                <a href="<?php echo esc_url($cta_url); ?>" class="btn btn-gold btn-arrow">
                    <?php echo esc_html($cta_text); ?>
                    <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
                </a>
            <?php endif; ?>
            <?php if ($cta2_text) : ?>
                <a href="<?php echo esc_url($cta2_url); ?>" class="btn btn-ghost btn-arrow">
                    <?php echo esc_html($cta2_text); ?>
                    <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
                </a>
            <?php endif; ?>
        </div>
    </div>

    <!-- Scroll indicator -->
    <div class="hero__scroll hide-sm">
        <span class="hero__scroll-text"><?php esc_html_e('Scroll om te ontdekken', 'monoliet-starter'); ?></span>
        <span class="hero__scroll-line"></span>
    </div>
</section>

<style>
.hero {
    position: relative;
    min-height: var(--hero-min-height);
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    overflow: hidden;
}
.hero__bg {
    position: absolute;
    inset: 0;
    z-index: 0;
}
.hero__bg-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    animation: slowZoom 18s ease-out both;
    filter: saturate(0.85) contrast(1.05);
}
.hero__overlay {
    position: absolute;
    inset: 0;
}
.hero__overlay--gradient {
    background: linear-gradient(180deg, rgba(13,11,9,0.55) 0%, rgba(13,11,9,0.2) 35%, rgba(13,11,9,0.6) 75%, rgba(13,11,9,0.98) 100%);
}
.hero__overlay--side {
    background: linear-gradient(90deg, rgba(13,11,9,0.85) 0%, rgba(13,11,9,0.35) 45%, transparent 75%);
}
.hero__overlay--vignette {
    background: radial-gradient(ellipse 80% 60% at 50% 50%, transparent 40%, rgba(7,6,10,0.7) 100%);
}
.hero__rail {
    position: absolute;
    left: 24px;
    top: 50%;
    transform: translateY(-50%) rotate(-90deg);
    transform-origin: left center;
    z-index: 5;
    display: flex;
    gap: 18px;
    align-items: center;
    font-size: 10px;
    letter-spacing: 0.35em;
    color: var(--mute);
    text-transform: uppercase;
}
.hero__content {
    position: relative;
    z-index: 5;
    padding-bottom: clamp(50px, 7vw, 80px);
    padding-top: clamp(60px, 9vw, 100px);
}
.hero__eyebrow {
    margin-bottom: 28px;
    display: flex;
    align-items: center;
    gap: 14px;
}
.hero__eyebrow-dash {
    width: 28px;
    height: 1px;
    background: var(--gold-2);
}
.hero__title {
    font-size: clamp(64px, 11vw, 180px);
    margin: 0;
    font-weight: 500;
    letter-spacing: -0.015em;
    max-width: 1100px;
}
.hero__accent {
    padding-right: 8px;
}
.hero__sub {
    margin-top: 32px;
    max-width: 540px;
    font-size: 17px;
    line-height: 1.55;
    color: var(--bone-dim);
}
.hero__ctas {
    display: flex;
    gap: 14px;
    margin-top: 40px;
    flex-wrap: wrap;
}
.hero__scroll {
    position: absolute;
    bottom: 32px;
    right: 48px;
    z-index: 5;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 12px;
}
.hero__scroll-text {
    font-size: 10px;
    letter-spacing: 0.3em;
    color: var(--mute);
    text-transform: uppercase;
    writing-mode: vertical-rl;
}
.hero__scroll-line {
    width: 1px;
    height: 60px;
    background: linear-gradient(180deg, var(--gold-2), transparent);
}
@media (max-width: 640px) {
    .hero__sub { font-size: 15px; margin-top: 22px; max-width: 100%; }
    .hero__ctas { margin-top: 30px; gap: 10px; }
    .hero__ctas .btn { flex: 1 1 auto; justify-content: center; }
}
</style>
