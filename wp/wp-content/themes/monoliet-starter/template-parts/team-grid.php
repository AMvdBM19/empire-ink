<?php
/**
 * Template part: Artists — horizontal scroll carousel.
 *
 * Queries team_member CPT; falls back to demo roster.
 *
 * @package MonolietStarter
 */

$team = new WP_Query(array(
    'post_type'      => 'team_member',
    'posts_per_page' => 12,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
));

$has_real_data = $team->have_posts();

$fallback_roster = array(
    array('name' => 'Mees van Dijk', 'styles' => 'Realism · Black & Grey', 'years' => 12),
    array('name' => 'Yara Bakker', 'styles' => 'Blackwork · Neo-Trad', 'years' => 9),
    array('name' => 'Sem El-Hassan', 'styles' => 'Dotwork · Mandala', 'years' => 7),
    array('name' => 'Lina Visser', 'styles' => 'Color · Illustrative', 'years' => 6),
    array('name' => 'Joris ten Velde', 'styles' => 'Cover-ups · Realism', 'years' => 14),
    array('name' => 'Nika Petrov', 'styles' => 'Fineline · Micro', 'years' => 5),
    array('name' => 'Daan Mulder', 'styles' => 'Japanese · Traditional', 'years' => 11),
    array('name' => 'Iris Kwint', 'styles' => 'Lettering · Script', 'years' => 8),
);

$palette = array('#2a2521', '#1d1916', '#241b14', '#1a1614', '#22201c', '#171513', '#2a2018', '#1e1c19');

$arrow_svg = '<svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M13 6l6 6-6 6"/></svg>';
$chev_l = '<svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M15 6l-6 6 6 6"/></svg>';
$chev_r = '<svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M9 6l6 6-6 6"/></svg>';
?>

<section id="section-team" class="section-pad" style="background: var(--ink-0); border-top: 1px solid var(--hair);">
    <div class="wrap">
        <div class="section-head">
            <div>
                <div class="eyebrow" style="margin-bottom: 16px;"><?php esc_html_e('De crew · 02', 'monoliet-starter'); ?></div>
                <h2 class="display title" style="margin: 0;"><?php esc_html_e('De artiesten', 'monoliet-starter'); ?><span style="color: var(--gold-3);">.</span></h2>
                <p style="max-width: 520px; color: var(--bone-dim); margin-top: 18px; font-size: 16px;">
                    <?php esc_html_e('Acht handen, acht handschriften. Boek direct bij wie bij jouw idee past.', 'monoliet-starter'); ?>
                </p>
            </div>
            <div style="display: flex; gap: 8px;">
                <button class="arrow-btn" data-scroll-dir="-1" data-scroll-target=".artist-scroller"><?php echo $chev_l; ?></button>
                <button class="arrow-btn" data-scroll-dir="1" data-scroll-target=".artist-scroller"><?php echo $chev_r; ?></button>
            </div>
        </div>
    </div>

    <div class="artist-scroller">
        <?php if ($has_real_data) : ?>
            <?php $i = 0; while ($team->have_posts()) : $team->the_post();
                $role = function_exists('get_field') ? get_field('member_role') : '';
                $specialties = function_exists('get_field') ? get_field('member_specialties') : '';
                $booking_url = function_exists('get_field') ? get_field('member_booking_url') : '';
                $thumb = get_the_post_thumbnail_url(get_the_ID(), 'medium_large');
                $name = get_the_title();
                $first_name = explode(' ', $name)[0];
            ?>
                <article class="artist-card">
                    <div class="artist-card__portrait" style="background: <?php echo $palette[$i % 8]; ?>;">
                        <?php if ($thumb) : ?>
                            <img src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr($name); ?>" class="asset">
                        <?php else : ?>
                            <div class="ph" data-label="ARTIST PORTRAIT" style="width: 100%; height: 100%;"></div>
                            <div class="display artist-card__initial"><?php echo esc_html($name[0]); ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="artist-card__info">
                        <div class="display" style="font-size: 24px; font-weight: 500; margin-bottom: 4px;"><?php echo esc_html($name); ?></div>
                        <div style="font-size: 12px; letter-spacing: 0.14em; text-transform: uppercase; color: var(--mute);"><?php echo esc_html($specialties ?: $role); ?></div>
                        <hr class="hair" style="margin: 16px 0;">
                        <a href="<?php echo esc_url($booking_url ?: '#section-contact'); ?>" class="artist-book">
                            <span><?php printf(esc_html__('Boek bij %s', 'monoliet-starter'), esc_html($first_name)); ?></span>
                            <?php echo $arrow_svg; ?>
                        </a>
                    </div>
                </article>
            <?php $i++; endwhile; wp_reset_postdata(); ?>
        <?php else : ?>
            <?php foreach ($fallback_roster as $i => $a) :
                $first_name = explode(' ', $a['name'])[0];
            ?>
                <article class="artist-card">
                    <div class="artist-card__portrait" style="background: <?php echo $palette[$i % 8]; ?>;">
                        <div class="ph" data-label="ARTIST PORTRAIT" style="width: 100%; height: 100%;"></div>
                        <div class="display artist-card__initial"><?php echo esc_html($a['name'][0]); ?></div>
                        <div class="artist-card__years"><?php echo esc_html($a['years']); ?> yrs</div>
                    </div>
                    <div class="artist-card__info">
                        <div class="display" style="font-size: 24px; font-weight: 500; margin-bottom: 4px;"><?php echo esc_html($a['name']); ?></div>
                        <div style="font-size: 12px; letter-spacing: 0.14em; text-transform: uppercase; color: var(--mute);"><?php echo esc_html($a['styles']); ?></div>
                        <hr class="hair" style="margin: 16px 0;">
                        <a href="#section-contact" class="artist-book">
                            <span><?php printf(esc_html__('Boek bij %s', 'monoliet-starter'), esc_html($first_name)); ?></span>
                            <?php echo $arrow_svg; ?>
                        </a>
                    </div>
                </article>
            <?php endforeach; ?>
        <?php endif; ?>

        <!-- End card -->
        <article class="artist-card artist-card--end">
            <a href="#section-team" class="display" style="color: var(--gold-3); font-size: 20px; text-decoration: none; text-align: center;">
                View all<br>
                <?php echo $arrow_svg; ?>
            </a>
        </article>
    </div>
</section>

<style>
.artist-scroller {
    display: flex;
    gap: 16px;
    overflow-x: auto;
    scroll-snap-type: x mandatory;
    padding-left: max(48px, calc((100vw - 1440px) / 2 + 48px));
    padding-right: max(48px, calc((100vw - 1440px) / 2 + 48px));
    padding-bottom: 16px;
    scrollbar-width: none;
}
.artist-scroller::-webkit-scrollbar { display: none; }
.artist-card {
    flex: 0 0 320px;
    scroll-snap-align: start;
    background: var(--ink-2);
    border: 1px solid var(--hair);
    position: relative;
    overflow: hidden;
}
.artist-card--end {
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 540px;
}
.artist-card__portrait {
    height: 380px;
    position: relative;
    overflow: hidden;
}
.artist-card__initial {
    position: absolute;
    inset: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 200px;
    color: rgba(212,168,90,0.10);
    font-weight: 700;
    letter-spacing: -0.04em;
    line-height: 1;
}
.artist-card__years {
    position: absolute;
    top: 16px;
    right: 16px;
    padding: 6px 10px;
    background: rgba(7,6,10,0.7);
    border: 1px solid var(--hair);
    font-size: 10px;
    letter-spacing: 0.18em;
    text-transform: uppercase;
    color: var(--gold-3);
    backdrop-filter: blur(6px);
}
.artist-card__info {
    padding: 22px 22px 24px;
}
.artist-book {
    display: flex;
    align-items: center;
    justify-content: space-between;
    font-size: 12px;
    font-weight: 600;
    letter-spacing: 0.18em;
    text-transform: uppercase;
    color: var(--bone-dim);
    text-decoration: none;
    transition: color .25s;
}
.artist-card:hover .artist-book {
    color: var(--gold-3);
}
</style>
