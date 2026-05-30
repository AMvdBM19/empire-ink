<?php
/**
 * Template part: Services — two-column cards (Tattoo / Piercing).
 *
 * @package MonolietStarter
 */

$arrow_svg = '<svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M13 6l6 6-6 6"/></svg>';

$services = array(
    array(
        'id'        => 'tattoo',
        'kicker'    => __('Tattoo', 'monoliet-starter'),
        'body'      => __('Van fineline tot full sleeve. Intake, ontwerp en ink-tijd inbegrepen vanaf het eerste consult.', 'monoliet-starter'),
        'from'      => __('Vanaf', 'monoliet-starter'),
        'price'     => '€80',
        'priceMeta' => __('incl. intake + ink-tijd', 'monoliet-starter'),
        'points'    => array(
            __('Persoonlijk ontwerp', 'monoliet-starter'),
            __('Vrijblijvend consult', 'monoliet-starter'),
            __('Garantie op afwerking', 'monoliet-starter'),
        ),
        'cta'       => __('Plan intake', 'monoliet-starter'),
        'img'       => MONOLIET_THEME_URI . '/assets/img/studio-action.webp',
        'num'       => '01',
    ),
    array(
        'id'        => 'piercing',
        'kicker'    => __('Piercing', 'monoliet-starter'),
        'body'      => __('Drie ervaren piercers, dagelijks walk-in. Premium titanium en goud op voorraad, GGD-gecertificeerde hygiëne.', 'monoliet-starter'),
        'from'      => __('Walk-in', 'monoliet-starter'),
        'price'     => __('Dagelijks', 'monoliet-starter'),
        'priceMeta' => __('geen afspraak nodig', 'monoliet-starter'),
        'points'    => array(
            __('Premium titanium & 14K goud', 'monoliet-starter'),
            __('Direct terecht', 'monoliet-starter'),
            __('Nazorg inbegrepen', 'monoliet-starter'),
        ),
        'cta'       => __('Bekijk piercings', 'monoliet-starter'),
        'img'       => MONOLIET_THEME_URI . '/assets/img/piercer-action.webp',
        'num'       => '02',
    ),
);
?>

<section id="section-services" class="section-pad">
    <div class="wrap">
        <div class="section-head">
            <div>
                <div class="eyebrow" style="margin-bottom: 16px;"><?php esc_html_e('Diensten · 03', 'monoliet-starter'); ?></div>
                <h2 class="display title" style="margin: 0;">
                    <?php esc_html_e('Twee disciplines.', 'monoliet-starter'); ?><br>
                    <span class="serif-it gold-text"><?php esc_html_e('Eén standaard.', 'monoliet-starter'); ?></span>
                </h2>
            </div>
        </div>

        <div class="svc-grid">
            <?php foreach ($services as $i => $s) : ?>
                <article id="<?php echo esc_attr($s['id']); ?>" class="svc-card">
                    <div class="svc-card__image">
                        <img src="<?php echo esc_url($s['img']); ?>" alt="<?php echo esc_attr($s['kicker']); ?>" class="asset svc-img">
                        <div style="position: absolute; inset: 0; background: linear-gradient(180deg, transparent 40%, rgba(20,17,15,0.7) 100%);"></div>
                        <div class="svc-card__label label-mono">
                            <span style="color: var(--gold-3);"><?php echo esc_html($s['num']); ?></span>
                            <span style="color: var(--mute); margin: 0 10px;">/</span>
                            <span style="color: var(--bone-dim);"><?php echo esc_html($s['kicker']); ?></span>
                        </div>
                    </div>
                    <div class="svc-card__body">
                        <h3 class="display" style="margin: 0; font-size: 48px; font-weight: 500;"><?php echo esc_html($s['kicker']); ?></h3>
                        <p style="color: var(--bone-dim); font-size: 15px; line-height: 1.6; margin: 0;"><?php echo esc_html($s['body']); ?></p>

                        <div class="svc-card__price">
                            <div class="label-mono" style="color: var(--mute);"><?php echo esc_html($s['from']); ?></div>
                            <div class="display" style="font-size: 44px; font-weight: 600; color: var(--gold-3); line-height: 1;"><?php echo esc_html($s['price']); ?></div>
                            <div style="font-size: 12px; color: var(--mute); margin-left: auto;"><?php echo esc_html($s['priceMeta']); ?></div>
                        </div>

                        <ul class="svc-card__points">
                            <?php foreach ($s['points'] as $pt) : ?>
                                <li>
                                    <span class="svc-card__dot"></span>
                                    <?php echo esc_html($pt); ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>

                        <a href="#section-contact" class="btn btn-ghost btn-arrow" style="align-self: flex-start; margin-top: 8px;">
                            <?php echo esc_html($s['cta']); ?>
                            <?php echo $arrow_svg; ?>
                        </a>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<style>
.svc-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 24px;
}
.svc-card {
    background: var(--ink-2);
    border: 1px solid var(--hair);
    position: relative;
    overflow: hidden;
    display: grid;
    grid-template-rows: 320px 1fr;
}
.svc-card__image {
    position: relative;
    overflow: hidden;
}
.svc-card__image img {
    filter: saturate(0.9) contrast(1.1);
    transition: transform .6s;
}
.svc-card:hover .svc-card__image img {
    transform: scale(1.04);
}
.svc-card__label {
    position: absolute;
    top: 22px;
    left: 22px;
}
.svc-card__body {
    padding: 32px;
    display: flex;
    flex-direction: column;
    gap: 20px;
}
.svc-card__price {
    display: flex;
    align-items: baseline;
    gap: 14px;
    border-top: 1px solid var(--hair);
    border-bottom: 1px solid var(--hair);
    padding: 18px 0;
}
.svc-card__points {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    flex-direction: column;
    gap: 10px;
}
.svc-card__points li {
    display: flex;
    align-items: center;
    gap: 12px;
    font-size: 14px;
    color: var(--bone-dim);
}
.svc-card__dot {
    width: 6px;
    height: 6px;
    background: var(--gold-2);
    border-radius: 50%;
    flex-shrink: 0;
}
@media (max-width: 900px) {
    .svc-grid { grid-template-columns: 1fr; }
}
@media (max-width: 640px) {
    .svc-card { grid-template-rows: 240px 1fr; }
    .svc-card__body { padding: 24px; gap: 16px; }
    .svc-card__body h3 { font-size: 36px !important; }
}
</style>
