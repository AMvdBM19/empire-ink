<?php
/**
 * Front page template — Empire INK design.
 *
 * Section order matches the demo:
 * TopStrip → Nav → Hero → ProofStrip → Portfolio → Artists →
 * Services → Promo → Reviews → Studio → ClosingCTA → Footer
 *
 * @package MonolietStarter
 */

get_header();
?>

<main id="main" role="main">
    <?php
    get_template_part('template-parts/hero');
    get_template_part('template-parts/social-proof');
    get_template_part('template-parts/portfolio-grid');
    get_template_part('template-parts/team-grid');
    get_template_part('template-parts/services');
    get_template_part('template-parts/promotions');
    get_template_part('template-parts/testimonials');
    get_template_part('template-parts/contact');
    get_template_part('template-parts/cta-banner');
    ?>
</main>

<?php
get_footer();
