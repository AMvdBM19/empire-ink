<?php
/**
 * Template part: Studio / Visit — two-column (info left, image right).
 *
 * @package MonolietStarter
 */

$phone   = monoliet_get_setting('business_phone') ?: '010 33 353 53';
$email   = monoliet_get_setting('business_email') ?: 'info@empire-ink.nl';
$address = monoliet_get_setting('business_address') ?: 'Van Meekerenstraat 162';
$city    = monoliet_get_setting('business_city') ?: 'Rotterdam';
$zip     = monoliet_get_setting('business_postal_code') ?: '3074 NP';
$phone_clean = preg_replace('/[^+0-9]/', '', $phone);

$pin_svg = '<svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M12 22s-7-7.5-7-12a7 7 0 1114 0c0 4.5-7 12-7 12z"/><circle cx="12" cy="10" r="2.5"/></svg>';
$arrow_svg = '<svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M13 6l6 6-6 6"/></svg>';
?>

<section id="section-contact" class="section-pad" style="background: var(--ink-0); border-top: 1px solid var(--hair);">
    <div class="wrap">
        <div class="studio-grid">
            <div>
                <div class="eyebrow" style="margin-bottom: 16px;"><?php esc_html_e('De studio · 06', 'monoliet-starter'); ?></div>
                <h2 class="display title" style="margin: 0; font-size: clamp(56px, 7vw, 110px); line-height: 0.92;">
                    <?php
                    $studio_title = __('Kom langs', 'monoliet-starter');
                    $words = explode(' ', $studio_title);
                    echo esc_html($words[0]) . ' ';
                    ?>
                    <span class="serif-it gold-text"><?php echo esc_html(implode(' ', array_slice($words, 1))); ?></span>
                </h2>
                <p style="color: var(--bone-dim); margin-top: 22px; font-size: 17px; max-width: 480px;">
                    <?php esc_html_e('500 vierkante meter. Acht kabines. Een aparte piercingsuite. Een wachtruimte waar je daadwerkelijk wilt wachten.', 'monoliet-starter'); ?>
                </p>

                <div class="studio-cols">
                    <div>
                        <div class="label-mono" style="color: var(--mute); margin-bottom: 10px;"><?php esc_html_e('Adres', 'monoliet-starter'); ?></div>
                        <div style="color: var(--bone); font-size: 16px; line-height: 1.45;">
                            <?php echo esc_html($address); ?><br>
                            <?php echo esc_html($zip . ' ' . $city); ?><br>
                            Nederland
                        </div>
                        <a href="#" style="margin-top: 14px; display: inline-flex; gap: 8px; align-items: center; font-size: 12px; letter-spacing: 0.18em; text-transform: uppercase; color: var(--gold-3); text-decoration: none; font-weight: 600;">
                            <?php echo $pin_svg; ?>
                            <?php esc_html_e('Routebeschrijving', 'monoliet-starter'); ?>
                        </a>
                    </div>
                    <div>
                        <div class="label-mono" style="color: var(--mute); margin-bottom: 10px;"><?php esc_html_e('Bel ons', 'monoliet-starter'); ?></div>
                        <a href="tel:<?php echo esc_attr($phone_clean); ?>" style="color: var(--bone); font-size: 16px; text-decoration: none; display: block;"><?php echo esc_html($phone); ?></a>
                        <a href="mailto:<?php echo esc_attr($email); ?>" style="color: var(--bone-dim); font-size: 14px; text-decoration: none; margin-top: 6px; display: block;"><?php echo esc_html($email); ?></a>

                        <div class="label-mono" style="color: var(--mute); margin-top: 28px; margin-bottom: 10px;"><?php esc_html_e('Openingstijden', 'monoliet-starter'); ?></div>
                        <div style="color: var(--bone-dim); font-size: 14px; line-height: 1.7;">
                            <?php esc_html_e('Ma — Vr · 11:00 — 21:00', 'monoliet-starter'); ?><br>
                            <?php esc_html_e('Za — Zo · 11:00 — 19:00', 'monoliet-starter'); ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Studio image -->
            <div class="studio-image-wrap">
                <img src="<?php echo esc_url(MONOLIET_THEME_URI . '/assets/img/studio-interior.webp'); ?>" alt="Empire INK Studio" class="asset" style="filter: saturate(0.85) contrast(1.05);">
                <div class="studio-image-wrap__fade"></div>

                <div class="studio-image-wrap__coords">
                    <span class="studio-coords-dot"></span>
                    <span class="label-mono" style="color: var(--bone);">51.8954° N · 4.4983° E</span>
                </div>

                <div class="studio-image-wrap__label">
                    <div>
                        <div class="label-mono" style="color: var(--gold-3); margin-bottom: 4px;">The Studio</div>
                        <div class="display" style="font-size: 28px; font-weight: 500;">500m² · Rotterdam-Zuid</div>
                    </div>
                    <a href="#" class="arrow-btn" style="background: rgba(7,6,10,0.6);"><?php echo $arrow_svg; ?></a>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.studio-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 64px;
    align-items: center;
}
.studio-cols {
    margin-top: 48px;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 32px;
}
.studio-image-wrap {
    position: relative;
    aspect-ratio: 4 / 5;
    overflow: hidden;
    border: 1px solid var(--hair);
}
.studio-image-wrap__fade {
    position: absolute;
    inset: 0;
    background: linear-gradient(180deg, transparent 60%, rgba(7,6,10,0.85) 100%);
}
.studio-image-wrap__coords {
    position: absolute;
    top: 24px;
    left: 24px;
    display: flex;
    align-items: center;
    gap: 10px;
}
.studio-coords-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: var(--gold-3);
    box-shadow: 0 0 0 4px rgba(212,168,90,0.2);
}
.studio-image-wrap__label {
    position: absolute;
    bottom: 24px;
    left: 24px;
    right: 24px;
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
}
@media (max-width: 1000px) {
    .studio-grid { grid-template-columns: 1fr; gap: 40px; }
    .studio-image-wrap { aspect-ratio: 4 / 3; }
}
@media (max-width: 560px) {
    .studio-cols { grid-template-columns: 1fr; }
}
</style>
