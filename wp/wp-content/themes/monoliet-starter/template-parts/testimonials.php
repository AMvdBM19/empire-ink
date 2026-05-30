<?php
/**
 * Template part: Reviews — crossfading testimonial carousel.
 *
 * Queries testimonial CPT; falls back to demo reviews.
 *
 * @package MonolietStarter
 */

$testimonials = new WP_Query(array(
    'post_type'      => 'testimonial',
    'posts_per_page' => 6,
    'orderby'        => 'date',
    'order'          => 'DESC',
));

$has_real = $testimonials->have_posts();

$fallback_reviews = array(
    array(
        'q'     => __('De rust waarmee Mees werkte was ongelooflijk. Acht uur in de stoel voelde als twee. Het resultaat is exact wat ik voor ogen had — alleen beter.', 'monoliet-starter'),
        'name'  => 'Sanne H.',
        'piece' => 'Realism sleeve · 8u',
        'rating' => 5,
    ),
    array(
        'q'     => __('Walk-in piercing op zondag, binnen 20 minuten geholpen, alles steriel en uitgelegd. Dit is gewoon hoe het hoort.', 'monoliet-starter'),
        'name'  => 'Daan K.',
        'piece' => 'Helix · walk-in',
        'rating' => 5,
    ),
    array(
        'q'     => __('Ik kwam voor een cover-up van iets waar ik tien jaar last van had. Joris heeft er kunst van gemaakt. Geen woorden voor.', 'monoliet-starter'),
        'name'  => 'Maria P.',
        'piece' => 'Cover-up bovenarm',
        'rating' => 5,
    ),
);

$reviews = array();
if ($has_real) {
    while ($testimonials->have_posts()) {
        $testimonials->the_post();
        $rating = function_exists('get_field') ? get_field('testimonial_rating') : 5;
        $source = function_exists('get_field') ? get_field('testimonial_source') : '';
        $reviews[] = array(
            'q'      => get_the_content(),
            'name'   => get_the_title(),
            'piece'  => $source,
            'rating' => $rating ?: 5,
        );
    }
    wp_reset_postdata();
} else {
    $reviews = $fallback_reviews;
}

$star_svg = '<svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor"><path d="M12 2l2.95 6.36L22 9.27l-5 4.87L18.18 22 12 18.27 5.82 22 7 14.14 2 9.27l7.05-.91L12 2z"/></svg>';
?>

<section id="section-testimonials" class="section-pad">
    <div class="wrap">
        <div class="section-head">
            <div>
                <div class="eyebrow" style="margin-bottom: 16px;"><?php esc_html_e('Reviews · 05', 'monoliet-starter'); ?></div>
                <h2 class="display title" style="margin: 0;"><?php esc_html_e('Wat klanten zeggen', 'monoliet-starter'); ?><span style="color: var(--gold-3);">.</span></h2>
                <p style="max-width: 520px; color: var(--bone-dim); margin-top: 18px; font-size: 16px;">
                    <?php esc_html_e('Gemiddeld 9.6 sterren over honderden reviews.', 'monoliet-starter'); ?>
                </p>
            </div>
            <div class="review-dots" style="display: flex; gap: 8px;">
                <?php foreach ($reviews as $idx => $r) : ?>
                    <button class="review-dot <?php echo $idx === 0 ? 'active' : ''; ?>" data-review="<?php echo $idx; ?>"></button>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="review-carousel" style="position: relative; min-height: 380px;">
            <?php foreach ($reviews as $idx => $r) : ?>
                <article class="review-slide <?php echo $idx === 0 ? 'is-active' : ''; ?>" data-review-idx="<?php echo $idx; ?>"
                    style="<?php echo $idx !== 0 ? 'position: absolute; top: 0; left: 0; right: 0;' : 'position: relative;'; ?>">
                    <div style="display: flex; gap: 4px; color: var(--gold-3); margin-bottom: 28px;">
                        <?php for ($s = 0; $s < $r['rating']; $s++) : ?>
                            <?php echo $star_svg; ?>
                        <?php endfor; ?>
                    </div>
                    <blockquote class="review-quote">
                        <span class="review-quote__mark display">"</span>
                        <?php echo esc_html($r['q']); ?>
                    </blockquote>
                    <div class="review-author">
                        <div class="review-author__avatar display"><?php echo esc_html($r['name'][0]); ?></div>
                        <div>
                            <div style="font-weight: 600; color: var(--bone);"><?php echo esc_html($r['name']); ?></div>
                            <div class="label-mono" style="color: var(--mute);"><?php echo esc_html($r['piece']); ?></div>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<style>
.review-slide {
    opacity: 0;
    transition: opacity .8s cubic-bezier(.2,.7,.2,1);
    pointer-events: none;
    max-width: 1000px;
    margin: 0 auto;
}
.review-slide.is-active {
    opacity: 1;
    pointer-events: auto;
}
.review-quote {
    margin: 0;
    font-family: var(--font-serif);
    font-style: italic;
    font-weight: 400;
    font-size: clamp(28px, 3vw, 44px);
    line-height: 1.25;
    color: var(--bone);
    text-transform: none;
}
.review-quote__mark {
    color: var(--gold-3);
    font-size: 80px;
    line-height: 0.3;
    vertical-align: -0.4em;
    margin-right: 6px;
}
.review-author {
    margin-top: 36px;
    display: flex;
    align-items: center;
    gap: 16px;
}
.review-author__avatar {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--ink-3), var(--ink-4));
    border: 1px solid var(--hair);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--gold-3);
    font-size: 18px;
    font-weight: 600;
}
.review-dot {
    width: 32px;
    height: 4px;
    background: var(--hair-strong);
    border: none;
    cursor: pointer;
    transition: background .3s;
    padding: 0;
}
.review-dot.active {
    background: var(--gold-2);
}
</style>
