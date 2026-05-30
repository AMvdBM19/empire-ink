<?php
/**
 * Header template — Empire INK design.
 *
 * Top strip + sticky nav with transparent→opaque scroll,
 * NL/EN toggle, gold gradient CTA, hamburger drawer < 1100px.
 *
 * @package MonolietStarter
 */

$phone       = monoliet_get_setting('business_phone');
$phone_clean = $phone ? preg_replace('/[^+0-9]/', '', $phone) : '';
$lang_switch = monoliet_get_setting('enable_lang_switcher');
$default_lang = monoliet_get_setting('default_language') ?: 'nl';
$logo_icon   = MONOLIET_THEME_URI . '/assets/img/logo-icon.png';
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php get_template_part('template-parts/top-strip'); ?>

<header class="site-header" role="banner" id="site-header">
    <div class="wrap nav-row">
        <!-- Logo -->
        <div class="nav-logo">
            <?php if (has_custom_logo()) : ?>
                <?php the_custom_logo(); ?>
            <?php else : ?>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="nav-logo__link" rel="home">
                    <div class="display nav-logo-word">EMPIRE <span style="color: var(--gold-3);">INK</span></div>
                    <div class="label-mono nav-logo-sub">ROTTERDAM · EST 2017</div>
                </a>
            <?php endif; ?>
        </div>

        <!-- Nav items (desktop) -->
        <nav class="nav-desktop hide-md" role="navigation" aria-label="<?php esc_attr_e('Primary Menu', 'monoliet-starter'); ?>">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'container'      => false,
                'menu_class'     => 'nav-desktop__list',
                'fallback_cb'    => false,
            ));
            ?>
        </nav>

        <!-- Right cluster -->
        <div class="nav-actions">
            <?php if ($lang_switch) : ?>
                <div class="lang-switcher hide-md">
                    <button onclick="window.location.search='?lang=nl'" class="lang-switcher__btn <?php echo ($default_lang === 'nl') ? 'is-active' : ''; ?>">NL</button>
                    <span class="lang-switcher__sep">|</span>
                    <button onclick="window.location.search='?lang=en'" class="lang-switcher__btn <?php echo ($default_lang === 'en') ? 'is-active' : ''; ?>">EN</button>
                </div>
            <?php endif; ?>

            <a href="#section-contact" class="btn btn-gold btn-arrow nav-cta">
                <?php esc_html_e('Boek Nu', 'monoliet-starter'); ?>
                <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
            </a>

            <button class="hamburger show-md" aria-label="<?php esc_attr_e('Open menu', 'monoliet-starter'); ?>" aria-expanded="false">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4 7h16M4 12h16M4 17h16"/></svg>
            </button>
        </div>
    </div>
</header>

<!-- Mobile drawer -->
<div class="mobile-drawer__overlay" aria-hidden="true"></div>
<aside class="mobile-drawer" aria-label="<?php esc_attr_e('Mobile menu', 'monoliet-starter'); ?>">
    <div class="mobile-drawer__header">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="mobile-drawer__logo">
            <div class="display" style="font-size: 18px; letter-spacing: 0.04em;">EMPIRE <span style="color: var(--gold-3);">INK</span></div>
        </a>
        <button class="mobile-drawer__close" aria-label="<?php esc_attr_e('Close menu', 'monoliet-starter'); ?>">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 6l12 12M18 6L6 18"/></svg>
        </button>
    </div>

    <?php
    wp_nav_menu(array(
        'theme_location' => 'primary',
        'container'      => false,
        'menu_class'     => 'mobile-drawer__nav',
        'fallback_cb'    => false,
    ));
    ?>

    <div class="mobile-drawer__footer">
        <?php if ($lang_switch) : ?>
            <div class="mobile-drawer__lang">
                <span class="label-mono" style="color: var(--mute); margin-right: 14px;">Lang</span>
                <button onclick="window.location.search='?lang=nl'" class="lang-switcher__btn <?php echo ($default_lang === 'nl') ? 'is-active' : ''; ?>">NL</button>
                <span style="color: var(--mute-2);">|</span>
                <button onclick="window.location.search='?lang=en'" class="lang-switcher__btn <?php echo ($default_lang === 'en') ? 'is-active' : ''; ?>">EN</button>
            </div>
        <?php endif; ?>

        <a href="#section-contact" class="btn btn-gold btn-arrow" style="justify-content: center; width: 100%;">
            <?php esc_html_e('Boek Nu', 'monoliet-starter'); ?>
            <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
        </a>

        <div class="mobile-drawer__contact">
            <div class="label-mono" style="color: var(--mute);"><?php esc_html_e('Adres', 'monoliet-starter'); ?></div>
            <div style="color: var(--bone-dim); font-size: 14px; line-height: 1.5; margin-top: 10px;">
                <?php echo esc_html(monoliet_get_setting('business_address')); ?><br>
                <?php echo esc_html(monoliet_get_setting('business_postal_code') . ' ' . monoliet_get_setting('business_city')); ?>
            </div>
            <?php if ($phone) : ?>
                <a href="tel:<?php echo esc_attr($phone_clean); ?>" style="color: var(--gold-3); text-decoration: none; font-size: 14px; margin-top: 8px; display: inline-flex; align-items: center; gap: 8px;">
                    <svg viewBox="0 0 24 24" width="13" height="13" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M5 4h4l2 5-2.5 1.5a11 11 0 005 5L15 13l5 2v4a2 2 0 01-2 2A15 15 0 013 6a2 2 0 012-2z"/></svg>
                    <?php echo esc_html($phone); ?>
                </a>
            <?php endif; ?>
        </div>
    </div>
</aside>

<style>
/* ── Nav ── */
.site-header {
    position: sticky;
    top: 0;
    z-index: 40;
    background: var(--header-bg);
    border-bottom: 1px solid transparent;
    transition: all .35s cubic-bezier(.2,.7,.2,1);
}
.site-header.is-scrolled {
    background: var(--header-bg-scrolled);
    backdrop-filter: blur(14px) saturate(140%);
    -webkit-backdrop-filter: blur(14px) saturate(140%);
    border-bottom-color: var(--hair);
}
.nav-row {
    display: grid;
    grid-template-columns: auto 1fr auto;
    align-items: center;
    gap: 24px;
    height: var(--header-height);
    transition: height .3s;
}
.site-header.is-scrolled .nav-row {
    height: var(--header-height-scrolled);
}
.nav-logo {
    display: flex;
    align-items: center;
    gap: 12px;
}
.nav-logo a {
    text-decoration: none;
    color: var(--bone);
    display: flex;
    align-items: center;
}
.nav-logo .custom-logo-link img,
.nav-logo .custom-logo {
    height: 40px;
    width: auto;
    max-width: 160px;
    object-fit: contain;
    filter: drop-shadow(0 0 8px rgba(212,168,90,0.15));
}
.nav-logo-word { font-size: 22px; letter-spacing: 0.04em; }
.nav-logo-sub { font-size: 9px; color: var(--mute); margin-top: 2px; }

/* Desktop nav links */
.nav-desktop { display: flex; justify-content: center; }
.nav-desktop__list {
    display: flex;
    align-items: center;
    gap: 28;
    list-style: none;
    margin: 0;
    padding: 0;
}
.nav-desktop__list li a {
    font-size: 12px;
    font-weight: 500;
    letter-spacing: 0.16em;
    text-transform: uppercase;
    color: var(--bone-dim);
    text-decoration: none;
    padding: 8px 0;
    white-space: nowrap;
    transition: color .25s;
}
.nav-desktop__list li a:hover { color: var(--gold-3); }

.nav-actions {
    display: flex;
    align-items: center;
    gap: 14px;
}

/* Lang switcher */
.lang-switcher {
    display: flex;
    align-items: center;
    font-size: 12px;
    font-weight: 500;
    letter-spacing: 0.18em;
    color: var(--mute);
    background: none;
    border: none;
    gap: 0;
}
.lang-switcher__btn {
    background: none;
    border: none;
    cursor: pointer;
    padding: 4px 6px;
    color: var(--mute);
    font-family: inherit;
    font-size: 12px;
    font-weight: 500;
    letter-spacing: 0.18em;
}
.lang-switcher__btn.is-active {
    color: var(--gold-3);
    font-weight: 700;
}
.lang-switcher__sep { color: var(--mute-2); }

/* Hamburger */
.hamburger {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    border: 1px solid var(--hair-strong);
    background: transparent;
    color: var(--bone);
    cursor: pointer;
    display: none;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    transition: border-color .25s, color .25s;
}
.hamburger:hover {
    border-color: var(--gold-2);
    color: var(--gold-3);
}

/* Responsive nav */
@media (max-width: 1100px) {
    .hide-md { display: none !important; }
    .show-md { display: flex !important; }
}
@media (max-width: 640px) {
    .nav-logo-sub { display: none; }
    .nav-logo-word { font-size: 18px !important; }
    .nav-logo .custom-logo-link img,
    .nav-logo .custom-logo { height: 30px !important; width: auto !important; max-width: 120px !important; }
    .nav-cta { padding: 11px 16px !important; font-size: 11px !important; letter-spacing: 0.14em !important; }
}
@media (max-width: 420px) {
    .nav-cta { display: none !important; }
}

/* ── Mobile drawer ── */
.mobile-drawer {
    position: fixed;
    top: 0;
    right: 0;
    bottom: 0;
    width: min(440px, 100vw);
    background: linear-gradient(180deg, var(--ink-1) 0%, var(--ink-0) 100%);
    border-left: 1px solid var(--hair-strong);
    transform: translateX(100%);
    transition: transform .5s cubic-bezier(.2,.8,.2,1);
    display: flex;
    flex-direction: column;
    padding: 28px 28px 36px;
    overflow-y: auto;
    box-shadow: -30px 0 60px -20px rgba(0,0,0,0.6);
    z-index: 1001;
}
.mobile-drawer.is-open {
    transform: translateX(0);
}
.mobile-drawer__overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(7,6,10,0.7);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    z-index: 1000;
}
.mobile-drawer__overlay.is-visible {
    display: block;
}
.mobile-drawer__header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 36px;
}
.mobile-drawer__logo {
    text-decoration: none;
    color: var(--bone);
    display: flex;
    align-items: center;
    gap: 12px;
}
.mobile-drawer__close {
    width: 42px;
    height: 42px;
    border-radius: 50%;
    border: 1px solid var(--hair-strong);
    background: transparent;
    color: var(--bone);
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
}
.mobile-drawer__nav {
    list-style: none;
    padding: 0;
    margin: 0;
    flex: 1;
}
.mobile-drawer__nav li a {
    display: flex;
    align-items: baseline;
    gap: 18px;
    padding: 16px 0;
    border-bottom: 1px solid var(--hair);
    text-decoration: none;
    color: var(--bone);
    font-family: var(--font-display);
    font-size: 28px;
    font-weight: 500;
    text-transform: uppercase;
    line-height: 1.1;
    transition: color .25s, transform .25s;
}
.mobile-drawer__nav li a:hover {
    color: var(--gold-3);
    transform: translateX(4px);
}
.mobile-drawer__footer {
    margin-top: 28px;
    display: flex;
    flex-direction: column;
    gap: 20px;
}
.mobile-drawer__lang {
    display: flex;
    align-items: center;
    gap: 4px;
}
.mobile-drawer__contact {
    margin-top: 8px;
    padding-top: 22px;
    border-top: 1px solid var(--hair);
    display: flex;
    flex-direction: column;
    gap: 4px;
}
</style>
