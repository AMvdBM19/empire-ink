<?php
/**
 * Template part: Promotion — split image/info card.
 *
 * Queries promotion CPT; falls back to demo data.
 *
 * @package MonolietStarter
 */

$today = date('Y-m-d');

$promos = new WP_Query(array(
    'post_type'      => 'promotion',
    'posts_per_page' => 1,
    'meta_query'     => array(
        'relation' => 'OR',
        array('key' => 'promo_valid_to', 'value' => $today, 'compare' => '>=', 'type' => 'DATE'),
        array('key' => 'promo_valid_to', 'compare' => 'NOT EXISTS'),
    ),
));

$has_real = $promos->have_posts();

if ($has_real) {
    $promos->the_post();
    $title      = get_the_title();
    $hook       = get_the_content();
    $price      = function_exists('get_field') ? get_field('promo_price') : '';
    $conditions = function_exists('get_field') ? get_field('promo_conditions') : '';
    $cta_text   = function_exists('get_field') ? get_field('promo_cta_text') : '';
    $cta_url    = function_exists('get_field') ? get_field('promo_cta_url') : '';
    $thumb      = get_the_post_thumbnail_url(get_the_ID(), 'large');
    wp_reset_postdata();
} else {
    $title      = __('Trio Piercing Set', 'monoliet-starter');
    $hook       = __('Drie premium piercings. Eén afspraak. Eén prijs.', 'monoliet-starter');
    $price      = '€99';
    $conditions = __('Aanbieding geldig t/m einde van de maand. Premium titanium inbegrepen. Op vertoon van legitimatie. Volg de huisregels voor minderjarigen.', 'monoliet-starter');
    $cta_text   = __('Claim deze deal', 'monoliet-starter');
    $cta_url    = '#section-contact';
    $thumb      = '';
}

$arrow_svg = '<svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M13 6l6 6-6 6"/></svg>';
?>

<section id="section-promotions" class="section-pad" style="background: var(--ink-0); border-top: 1px solid var(--hair); border-bottom: 1px solid var(--hair);">
    <div class="wrap">
        <div class="promo-card">
            <!-- Gold corner accent -->
            <div class="promo-card__accent"></div>

            <div class="promo-image-wrap">
                <?php if ($thumb) : ?>
                    <img src="<?php echo esc_url($thumb); ?>" alt="" class="asset" style="filter: saturate(0.95);">
                <?php else : ?>
                    <img src="<?php echo esc_url(MONOLIET_THEME_URI . '/assets/img/promo-trio.webp'); ?>" alt="" class="asset" style="filter: saturate(0.95);">
                <?php endif; ?>
                <div class="promo-image-wrap__fade"></div>
            </div>

            <div class="promo-body">
                <div style="display: flex; align-items: center; gap: 12px;">
                    <span class="promo-badge"><?php esc_html_e('Deze maand', 'monoliet-starter'); ?></span>
                    <span class="eyebrow"><?php esc_html_e('Lopende actie · 04', 'monoliet-starter'); ?></span>
                </div>

                <h2 class="display" style="margin: 0; font-size: clamp(48px, 5vw, 76px); font-weight: 500; line-height: 0.95;">
                    <?php
                    $words = explode(' ', $title);
                    $last = array_pop($words);
                    echo esc_html(implode(' ', $words)) . ' ';
                    ?>
                    <span class="serif-it gold-text"><?php echo esc_html($last); ?></span>
                </h2>

                <p style="color: var(--bone-dim); margin: 0; font-size: 16px; max-width: 420px;"><?php echo esc_html($hook); ?></p>

                <div class="promo-price">
                    <span class="display" style="font-size: 80px; font-weight: 600; color: var(--gold-3); line-height: 1; letter-spacing: -0.02em;"><?php echo esc_html($price); ?></span>
                    <span style="font-size: 20px; color: var(--mute); text-decoration: line-through;">€145</span>
                </div>

                <?php if ($cta_text) : ?>
                    <a href="<?php echo esc_url($cta_url ?: '#section-contact'); ?>" class="btn btn-gold btn-arrow" style="align-self: flex-start;">
                        <?php echo esc_html($cta_text); ?>
                        <?php echo $arrow_svg; ?>
                    </a>
                <?php endif; ?>

                <?php if ($conditions) : ?>
                    <p style="font-size: 11px; color: var(--mute); margin: 0; max-width: 460px; line-height: 1.6;"><?php echo esc_html($conditions); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<style>
.promo-card {
    display: grid;
    grid-template-columns: 1.1fr 1fr;
    background: linear-gradient(135deg, #14110f 0%, #0d0b09 100%);
    border: 1px solid var(--hair-strong);
    overflow: hidden;
    position: relative;
    min-height: 540px;
}
.promo-card__accent {
    position: absolute;
    top: 0;
    right: 0;
    width: 240px;
    height: 240px;
    background: radial-gradient(ellipse at top right, rgba(212,168,90,0.25), transparent 70%);
    pointer-events: none;
}
.promo-image-wrap {
    position: relative;
    min-height: 380px;
}
.promo-image-wrap__fade {
    position: absolute;
    inset: 0;
    background: linear-gradient(90deg, transparent 60%, rgba(13,11,9,0.4) 100%);
}
.promo-body {
    padding: 56px 56px 56px 64px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    gap: 22px;
}
.promo-badge {
    font-size: 10px;
    letter-spacing: 0.3em;
    text-transform: uppercase;
    font-weight: 700;
    padding: 6px 12px;
    background: var(--gold-grad);
    color: var(--ink-0);
}
.promo-price {
    display: flex;
    align-items: baseline;
    gap: 16px;
    margin-top: 4px;
}
@media (max-width: 900px) {
    .promo-card { grid-template-columns: 1fr; }
    .promo-body { padding: 40px 28px; }
    .promo-image-wrap { min-height: 300px; }
}
@media (max-width: 480px) {
    .promo-image-wrap { min-height: 240px; }
}
</style>
