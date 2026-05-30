<?php
/**
 * Footer template — Empire INK design.
 *
 * 5-column layout: brand + 3 link columns + newsletter/contact.
 *
 * @package MonolietStarter
 */

$business_name  = monoliet_get_setting('business_name') ?: get_bloginfo('name');
$business_phone = monoliet_get_setting('business_phone') ?: '010 33 353 53';
$business_email = monoliet_get_setting('business_email') ?: 'info@empire-ink.nl';
$business_addr  = monoliet_get_setting('business_address') ?: 'Van Meekerenstraat 162';
$business_city  = monoliet_get_setting('business_city') ?: 'Rotterdam';
$business_zip   = monoliet_get_setting('business_postal_code') ?: '3074 NP';
$footer_credit  = monoliet_get_setting('footer_credit') ?: __('Website door Monoliet.cloud', 'monoliet-starter');

$social_ig  = monoliet_get_setting('social_instagram');
$social_fb  = monoliet_get_setting('social_facebook');
$social_wa  = monoliet_get_setting('social_whatsapp');

$ig_svg = '<svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1" fill="currentColor"/></svg>';
$fb_svg = '<svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor"><path d="M13.5 21v-7.5h2.5l.5-3h-3V8.5c0-.9.3-1.5 1.6-1.5H17V4.2c-.3 0-1.3-.1-2.5-.1-2.5 0-4 1.5-4 4.2V10.5H8v3h2.5V21z"/></svg>';
$wa_svg = '<svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor"><path d="M12 2a10 10 0 00-8.6 15L2 22l5.1-1.3A10 10 0 1012 2zm5.6 14.4c-.2.7-1.4 1.3-2 1.4-.5.1-1.1.1-1.8-.1-.4-.1-1-.3-1.7-.6-3-1.3-5-4.3-5.1-4.5-.1-.2-1.2-1.7-1.2-3.2 0-1.5.8-2.3 1.1-2.6.3-.3.6-.4.8-.4h.6c.2 0 .5 0 .7.5l1 2.4c.1.2.2.4 0 .7-.1.2-.2.3-.4.5-.2.2-.4.4-.5.6-.2.2-.3.4-.1.7.2.4.9 1.5 2 2.4 1.4 1.2 2.5 1.6 2.9 1.7.4.1.6.1.8-.1.2-.2.9-1.1 1.2-1.4.2-.3.4-.3.7-.2.3.1 2 .9 2.3 1.1.3.2.6.3.7.4.1.2.1 1-.2 1.7z"/></svg>';

$footer_cols = array(
    array(
        'title' => __('Studio', 'monoliet-starter'),
        'items' => array(
            __('Tattoo Info', 'monoliet-starter'),
            __('Piercing Info', 'monoliet-starter'),
            __('Portfolio', 'monoliet-starter'),
            __('Artiesten', 'monoliet-starter'),
        ),
    ),
    array(
        'title' => __('Bezoek', 'monoliet-starter'),
        'items' => array(
            __('Over Ons', 'monoliet-starter'),
            __('Prijzen & Acties', 'monoliet-starter'),
            __('Contact', 'monoliet-starter'),
            __('Cadeaubonnen', 'monoliet-starter'),
        ),
    ),
    array(
        'title' => __('Legal', 'monoliet-starter'),
        'items' => array(
            __('Privacybeleid', 'monoliet-starter'),
            __('Algemene voorwaarden', 'monoliet-starter'),
            __('Huisregels', 'monoliet-starter'),
            __('Cookies', 'monoliet-starter'),
        ),
    ),
);
?>

<footer class="site-footer" role="contentinfo">
    <div class="wrap">
        <div class="footer-top">
            <!-- Brand column -->
            <div class="footer-brand">
                <?php if (has_custom_logo()) : ?>
                    <div style="margin-bottom: 22px;">
                        <?php the_custom_logo(); ?>
                    </div>
                <?php else : ?>
                    <div class="display" style="font-size: 28px; margin-bottom: 22px;">EMPIRE <span style="color: var(--gold-3);">INK</span></div>
                <?php endif; ?>
                <p style="color: var(--bone-dim); max-width: 280px; font-size: 14px; line-height: 1.55;">
                    <?php esc_html_e('Premium tattoo & piercing studio. Rotterdam, sinds 2017.', 'monoliet-starter'); ?>
                </p>
                <div class="footer-social">
                    <?php if ($social_ig) : ?>
                        <a href="<?php echo esc_url($social_ig); ?>" class="social-link" target="_blank" rel="noopener noreferrer" aria-label="Instagram"><?php echo $ig_svg; ?></a>
                    <?php else : ?>
                        <a href="#" class="social-link" aria-label="Instagram"><?php echo $ig_svg; ?></a>
                    <?php endif; ?>
                    <?php if ($social_fb) : ?>
                        <a href="<?php echo esc_url($social_fb); ?>" class="social-link" target="_blank" rel="noopener noreferrer" aria-label="Facebook"><?php echo $fb_svg; ?></a>
                    <?php else : ?>
                        <a href="#" class="social-link" aria-label="Facebook"><?php echo $fb_svg; ?></a>
                    <?php endif; ?>
                    <?php if ($social_wa) : ?>
                        <a href="https://wa.me/<?php echo esc_attr(preg_replace('/[^0-9]/', '', $social_wa)); ?>" class="social-link" target="_blank" rel="noopener noreferrer" aria-label="WhatsApp"><?php echo $wa_svg; ?></a>
                    <?php else : ?>
                        <a href="#" class="social-link" aria-label="WhatsApp"><?php echo $wa_svg; ?></a>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Link columns -->
            <?php foreach ($footer_cols as $col) : ?>
                <div>
                    <div class="label-mono" style="color: var(--gold-3); margin-bottom: 22px;"><?php echo esc_html($col['title']); ?></div>
                    <ul class="footer-links">
                        <?php foreach ($col['items'] as $item) : ?>
                            <li><a href="#"><?php echo esc_html($item); ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endforeach; ?>

            <!-- Newsletter + contact -->
            <div>
                <div class="label-mono" style="color: var(--gold-3); margin-bottom: 22px;"><?php esc_html_e('Nieuwsbrief', 'monoliet-starter'); ?></div>
                <div class="footer-newsletter">
                    <input type="email" placeholder="<?php esc_attr_e('jouw@email.nl', 'monoliet-starter'); ?>" class="footer-newsletter__input">
                    <button class="footer-newsletter__btn"><?php esc_html_e('Aanmelden', 'monoliet-starter'); ?></button>
                </div>
                <div style="margin-top: 26px;">
                    <div class="label-mono" style="color: var(--gold-3); margin-bottom: 12px;">Contact</div>
                    <div style="color: var(--bone-dim); font-size: 13px; line-height: 1.7;">
                        <?php echo esc_html($business_addr); ?><br>
                        <?php echo esc_html($business_zip . ' ' . $business_city); ?><br>
                        <a href="tel:<?php echo esc_attr(preg_replace('/[^+0-9]/', '', $business_phone)); ?>" style="color: var(--bone-dim); text-decoration: none;">
                            <?php echo esc_html($business_phone); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <hr class="hair">

        <div class="footer-bottom">
            <div><?php echo esc_html('© ' . date('Y') . ' Empire INK · KvK 12345678'); ?></div>
            <div>
                <?php
                $credit_parts = explode('Monoliet.cloud', $footer_credit);
                echo esc_html($credit_parts[0]);
                ?>
                <a href="https://monoliet.cloud" style="color: var(--gold-3); text-decoration: none;">Monoliet.cloud</a>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>

<style>
.site-footer {
    background: var(--ink-0);
    border-top: 1px solid var(--hair);
    padding-top: 96px;
    padding-bottom: 32px;
    position: relative;
    z-index: 2;
}
.footer-top {
    display: grid;
    grid-template-columns: 2fr 1fr 1fr 1fr 1.4fr;
    gap: 48px;
    padding-bottom: 64px;
}
.footer-social {
    display: flex;
    gap: 12px;
    margin-top: 26px;
}
.footer-links {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    flex-direction: column;
    gap: 12px;
}
.footer-links a {
    color: var(--bone-dim);
    text-decoration: none;
    font-size: 14px;
    transition: color .25s;
}
.footer-links a:hover {
    color: var(--gold-3);
}
.footer-newsletter {
    display: flex;
    gap: 0;
    border: 1px solid var(--hair-strong);
}
.footer-newsletter__input {
    flex: 1;
    background: transparent;
    border: none;
    padding: 14px 16px;
    color: var(--bone);
    font-family: inherit;
    font-size: 13px;
    outline: none;
}
.footer-newsletter__btn {
    background: var(--gold-grad);
    border: none;
    color: var(--ink-0);
    font-family: inherit;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.18em;
    text-transform: uppercase;
    padding: 0 18px;
    cursor: pointer;
}
.footer-bottom {
    padding-top: 32px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 14px;
    font-size: 12px;
    color: var(--mute);
}
@media (max-width: 1100px) {
    .footer-top { grid-template-columns: 1fr 1fr; }
}
@media (max-width: 600px) {
    .footer-top { grid-template-columns: 1fr; }
}
</style>
