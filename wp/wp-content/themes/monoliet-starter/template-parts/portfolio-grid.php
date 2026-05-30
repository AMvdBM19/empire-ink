<?php
/**
 * Template part: Portfolio — filterable bento grid with chip tabs.
 *
 * Queries portfolio_item CPT; falls back to demo data.
 *
 * @package MonolietStarter
 */

$portfolio = new WP_Query(array(
    'post_type'      => 'portfolio_item',
    'posts_per_page' => 8,
    'orderby'        => 'date',
    'order'          => 'DESC',
));

$has_real_data = $portfolio->have_posts();

$theme_uri = MONOLIET_THEME_URI;
$fallback_pieces = array(
    array('artist' => 'Mees', 'style' => 'Realism', 'title' => __('Portret · Onderarm', 'monoliet-starter'), 'img' => "$theme_uri/assets/img/hero-bg.webp"),
    array('artist' => 'Yara', 'style' => 'Blackwork', 'title' => __('Rug · Composiet', 'monoliet-starter'), 'img' => ''),
    array('artist' => 'Sem', 'style' => 'Dotwork', 'title' => __('Mandala · Borst', 'monoliet-starter'), 'img' => "$theme_uri/assets/img/studio-action.webp"),
    array('artist' => 'Lina', 'style' => 'Color', 'title' => __('Floral · Sleeve', 'monoliet-starter'), 'img' => ''),
    array('artist' => 'Joris', 'style' => 'Cover-ups', 'title' => __('Cover · Bovenarm', 'monoliet-starter'), 'img' => "$theme_uri/assets/img/banner-over-ons.webp"),
    array('artist' => 'Mees', 'style' => 'Realism', 'title' => __('Tijger · Dij', 'monoliet-starter'), 'img' => ''),
    array('artist' => 'Sem', 'style' => 'Dotwork', 'title' => __('Geometrisch · Hand', 'monoliet-starter'), 'img' => "$theme_uri/assets/img/piercer-action.webp"),
    array('artist' => 'Yara', 'style' => 'Blackwork', 'title' => __('Slang · Schouder', 'monoliet-starter'), 'img' => ''),
);

$tabs = array(
    __('Alles', 'monoliet-starter'),
    'Realism', 'Blackwork', 'Dotwork', 'Color', 'Cover-ups',
);

$arrow_svg = '<svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M13 6l6 6-6 6"/></svg>';
?>

<section id="section-portfolio" class="section-pad">
    <div class="wrap">
        <div class="section-head">
            <div>
                <div class="eyebrow" style="margin-bottom: 16px;"><?php esc_html_e('Portfolio · 01', 'monoliet-starter'); ?></div>
                <h2 class="display title" style="margin: 0;">
                    <?php esc_html_e('Het werk', 'monoliet-starter'); ?><span style="color: var(--gold-3);">.</span>
                </h2>
                <p style="max-width: 520px; color: var(--bone-dim); margin-top: 18px; font-size: 16px;">
                    <?php esc_html_e('Een selectie uit duizenden uren. Filter op stijl om te ontdekken welke artiest bij jouw idee past.', 'monoliet-starter'); ?>
                </p>
            </div>
            <div class="port-tabs" style="display: flex; flex-wrap: wrap; gap: 8px; max-width: 600px; justify-content: flex-end;">
                <?php foreach ($tabs as $i => $tab) : ?>
                    <button class="chip<?php echo $i === 0 ? ' active' : ''; ?>" data-filter="<?php echo $i === 0 ? 'all' : esc_attr($tab); ?>">
                        <?php echo esc_html($tab); ?>
                    </button>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="port-grid" id="portfolio-grid">
            <?php if ($has_real_data) : ?>
                <?php $idx = 0; while ($portfolio->have_posts()) : $portfolio->the_post();
                    $desc = function_exists('get_field') ? get_field('portfolio_description') : '';
                    $team_id = function_exists('get_field') ? get_field('portfolio_team_member') : 0;
                    $categories = get_the_terms(get_the_ID(), 'portfolio_category');
                    $style = ($categories && !is_wp_error($categories)) ? $categories[0]->name : '';
                    $artist = $team_id ? get_the_title($team_id) : '';
                    $thumb = get_the_post_thumbnail_url(get_the_ID(), 'large');
                ?>
                    <article class="port-cell" data-style="<?php echo esc_attr($style); ?>" data-idx="<?php echo $idx; ?>">
                        <?php if ($thumb) : ?>
                            <img src="<?php echo esc_url($thumb); ?>" alt="<?php the_title_attribute(); ?>" class="asset port-img">
                        <?php else : ?>
                            <div class="ph" data-label="<?php echo esc_attr($style . ' · ' . get_the_title()); ?>" style="width: 100%; height: 100%;"></div>
                        <?php endif; ?>
                        <div class="port-overlay">
                            <div class="port-overlay__inner">
                                <div>
                                    <div class="label-mono" style="color: var(--gold-3); font-size: 10px; margin-bottom: 6px;"><?php echo esc_html($style); ?></div>
                                    <div class="display" style="font-size: 22px; font-weight: 500; color: var(--bone);"><?php the_title(); ?></div>
                                    <?php if ($artist) : ?>
                                        <div style="margin-top: 6px; font-size: 12px; color: var(--mute);">by <?php echo esc_html($artist); ?></div>
                                    <?php endif; ?>
                                </div>
                                <div class="port-arrow"><?php echo $arrow_svg; ?></div>
                            </div>
                        </div>
                    </article>
                <?php $idx++; endwhile; wp_reset_postdata(); ?>
            <?php else : ?>
                <?php foreach ($fallback_pieces as $idx => $piece) : ?>
                    <article class="port-cell" data-style="<?php echo esc_attr($piece['style']); ?>" data-idx="<?php echo $idx; ?>">
                        <?php if (!empty($piece['img'])) : ?>
                            <img src="<?php echo esc_url($piece['img']); ?>" alt="<?php echo esc_attr($piece['title']); ?>" class="asset port-img" style="filter: saturate(0.85) contrast(1.05);">
                        <?php else : ?>
                        <div class="ph" data-label="<?php echo esc_attr($piece['style'] . ' · ' . $piece['title']); ?>" style="width: 100%; height: 100%;">
                            <div class="display" style="position: absolute; inset: 0; display: flex; align-items: center; justify-content: center; font-size: 160px; color: rgba(212,168,90,0.06); font-weight: 700; letter-spacing: -0.02em;">0<?php echo $idx + 1; ?></div>
                        </div>
                        <?php endif; ?>
                        <div class="port-overlay">
                            <div class="port-overlay__inner">
                                <div>
                                    <div class="label-mono" style="color: var(--gold-3); font-size: 10px; margin-bottom: 6px;"><?php echo esc_html($piece['style']); ?></div>
                                    <div class="display" style="font-size: 22px; font-weight: 500; color: var(--bone);"><?php echo esc_html($piece['title']); ?></div>
                                    <div style="margin-top: 6px; font-size: 12px; color: var(--mute);">by <?php echo esc_html($piece['artist']); ?></div>
                                </div>
                                <div class="port-arrow"><?php echo $arrow_svg; ?></div>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <div style="margin-top: 56px; display: flex; justify-content: center;">
            <a href="#section-portfolio" class="btn btn-ghost btn-arrow">
                <?php esc_html_e('Bekijk volledig portfolio', 'monoliet-starter'); ?>
                <?php echo $arrow_svg; ?>
            </a>
        </div>
    </div>
</section>

<style>
.port-grid {
    display: grid;
    grid-template-columns: repeat(12, 1fr);
    gap: 12px;
}
.port-cell {
    position: relative;
    overflow: hidden;
    background: var(--ink-2);
    cursor: pointer;
}
.port-cell:nth-child(1) { grid-column: span 6; grid-row: span 2; height: 560px; }
.port-cell:nth-child(2) { grid-column: span 3; height: 270px; }
.port-cell:nth-child(3) { grid-column: span 3; height: 270px; }
.port-cell:nth-child(4) { grid-column: span 3; height: 270px; }
.port-cell:nth-child(5) { grid-column: span 3; height: 270px; }
.port-cell:nth-child(6) { grid-column: span 4; height: 320px; }
.port-cell:nth-child(7) { grid-column: span 4; height: 320px; }
.port-cell:nth-child(8) { grid-column: span 4; height: 320px; }

.port-img {
    filter: saturate(0.85) contrast(1.05);
    transition: transform .8s cubic-bezier(.2,.7,.2,1), filter .4s;
}
.port-cell:hover .port-img {
    transform: scale(1.06);
    filter: saturate(1) contrast(1.1);
}
.port-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(180deg, transparent 40%, rgba(7,6,10,0.92) 100%);
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    padding: 24px;
    transition: opacity .35s;
}
.port-overlay__inner {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    gap: 16px;
}
.port-arrow {
    width: 40px;
    height: 40px;
    border: 1px solid var(--hair-strong);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--bone-dim);
    transition: all .3s;
    flex-shrink: 0;
}
.port-cell:hover .port-arrow {
    border-color: var(--gold-2);
    color: var(--gold-3);
    background: rgba(212,168,90,0.08);
}
.port-cell[hidden] { display: none; }

@media (max-width: 1000px) {
    .port-grid { grid-template-columns: repeat(6, 1fr); }
    .port-cell { grid-column: span 6 !important; height: 280px !important; }
    .port-cell:nth-child(1) { height: 380px !important; }
}
</style>
