<?php
/**
 * Template part: Top Strip — info bar above navigation.
 *
 * @package MonolietStarter
 */

$phone = monoliet_get_setting('business_phone');
$address = monoliet_get_setting('business_address');
$city = monoliet_get_setting('business_city');
?>

<div class="top-strip">
    <div class="wrap top-strip__inner">
        <div class="top-strip__left">
            <span class="top-strip__status">
                <span class="top-strip__dot"></span>
                <?php esc_html_e('Open 7 dagen per week', 'monoliet-starter'); ?>
            </span>
            <span class="top-strip__item hide-sm"><?php esc_html_e('Walk-ins welkom', 'monoliet-starter'); ?></span>
            <?php if ($address) : ?>
                <span class="top-strip__item hide-sm" style="opacity: 0.5;"><?php echo esc_html($address); ?> · <?php echo esc_html($city); ?></span>
            <?php endif; ?>
        </div>
        <div class="top-strip__right">
            <svg viewBox="0 0 24 24" width="12" height="12" fill="currentColor"><path d="M12 2l2.95 6.36L22 9.27l-5 4.87L18.18 22 12 18.27 5.82 22 7 14.14 2 9.27l7.05-.91L12 2z"/></svg>
            <span><?php esc_html_e('9.6 op Google', 'monoliet-starter'); ?></span>
        </div>
    </div>
</div>

<style>
.top-strip {
    background: var(--ink-0);
    border-bottom: 1px solid var(--hair);
    position: relative;
    z-index: 50;
}
.top-strip__inner {
    height: 36px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    font-size: 11px;
    letter-spacing: 0.18em;
    text-transform: uppercase;
    color: var(--bone-dim);
}
.top-strip__left {
    display: flex;
    gap: 22px;
    align-items: center;
}
.top-strip__status {
    display: inline-flex;
    align-items: center;
    gap: 8px;
}
.top-strip__dot {
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: #7adf8b;
    box-shadow: 0 0 8px rgba(122, 223, 139, 0.6);
}
.top-strip__right {
    display: flex;
    align-items: center;
    gap: 8px;
    color: var(--gold-3);
}
@media (max-width: 760px) {
    .hide-sm { display: none !important; }
}
</style>
