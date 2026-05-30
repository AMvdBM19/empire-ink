<?php
/**
 * Template part: Closing CTA — full-width bg image, centered heading.
 *
 * @package MonolietStarter
 */

$heading     = get_field('cta_heading');
$subtext     = get_field('cta_subtext');
$button_text = get_field('cta_button_text');
$button_url  = get_field('cta_button_url');

$phone       = monoliet_get_setting('business_phone') ?: '010 33 353 53';
$phone_clean = preg_replace('/[^+0-9]/', '', $phone);

$arrow_svg = '<svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M13 6l6 6-6 6"/></svg>';
$phone_svg = '<svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M5 4h4l2 5-2.5 1.5a11 11 0 005 5L15 13l5 2v4a2 2 0 01-2 2A15 15 0 013 6a2 2 0 012-2z"/></svg>';
?>

<section id="section-cta" class="section-pad closing-cta">
    <!-- Background image -->
    <div class="closing-cta__bg">
        <img src="<?php echo esc_url(MONOLIET_THEME_URI . '/assets/img/banner-contact.webp'); ?>" alt="" class="asset" style="filter: saturate(0.7) brightness(0.5);">
        <div class="closing-cta__overlay"></div>
    </div>

    <div class="wrap closing-cta__content">
        <h2 class="display" style="margin: 0; font-size: clamp(56px, 9vw, 140px); font-weight: 500; line-height: 0.92;">
            <?php
            if ($heading) {
                echo esc_html($heading);
            } else {
                esc_html_e('Klaar voor je', 'monoliet-starter');
                echo '<br>';
                echo '<span class="serif-it gold-text">';
                esc_html_e('volgende stuk', 'monoliet-starter');
                echo '</span>?';
            }
            ?>
        </h2>
        <p style="color: var(--bone-dim); font-size: 17px; margin-top: 28px; max-width: 520px; margin-left: auto; margin-right: auto;">
            <?php
            if ($subtext) {
                echo esc_html($subtext);
            } else {
                esc_html_e('Plan een vrijblijvend consult of loop binnen. We zijn er — zeven dagen per week.', 'monoliet-starter');
            }
            ?>
        </p>
        <div style="display: flex; gap: 14px; justify-content: center; margin-top: 40px; flex-wrap: wrap;">
            <a href="<?php echo esc_url($button_url ?: '#section-contact'); ?>" class="btn btn-gold btn-arrow">
                <?php echo esc_html($button_text ?: __('Boek Nu', 'monoliet-starter')); ?>
                <?php echo $arrow_svg; ?>
            </a>
            <a href="tel:<?php echo esc_attr($phone_clean); ?>" class="btn btn-ghost btn-arrow">
                <?php echo $phone_svg; ?>
                <?php printf(esc_html__('Bel %s', 'monoliet-starter'), esc_html($phone)); ?>
            </a>
        </div>
    </div>
</section>

<style>
.closing-cta {
    position: relative;
    overflow: hidden;
}
.closing-cta__bg {
    position: absolute;
    inset: 0;
    z-index: 0;
}
.closing-cta__bg img {
    filter: saturate(0.7) brightness(0.5);
}
.closing-cta__overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(180deg, rgba(13,11,9,0.85), rgba(7,6,10,0.95));
}
.closing-cta__content {
    position: relative;
    z-index: 2;
    text-align: center;
}
</style>
