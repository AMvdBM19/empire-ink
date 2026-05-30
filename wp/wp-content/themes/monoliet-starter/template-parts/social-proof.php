<?php
/**
 * Template part: Social Proof Strip — 4-column stats bar.
 *
 * @package MonolietStarter
 */

$score  = get_field('proof_rating_score');

$fallback_metrics = array(
    array('value' => '9.6', 'label' => __('Google rating', 'monoliet-starter'), 'icon' => 'star'),
    array('value' => '500m²', 'label' => __('Studio in Rotterdam-Zuid', 'monoliet-starter'), 'icon' => 'square'),
    array('value' => '7 / 7', 'label' => __('Dagen per week open', 'monoliet-starter'), 'icon' => 'clock'),
    array('value' => 'GGD', 'label' => __('Gecertificeerde hygiëne', 'monoliet-starter'), 'icon' => 'shield'),
);

$metrics = array();
if ($score) {
    $metrics[] = array('value' => $score, 'label' => get_field('proof_rating_source') ?: 'Google rating', 'icon' => 'star');
    for ($i = 1; $i <= 3; $i++) {
        $val   = get_field("proof_metric_{$i}_value");
        $label = get_field("proof_metric_{$i}_label");
        if ($val && $label) {
            $icons = array('square', 'clock', 'shield');
            $metrics[] = array('value' => $val, 'label' => $label, 'icon' => $icons[$i - 1]);
        }
    }
}

if (empty($metrics)) {
    $metrics = $fallback_metrics;
}

$icons_svg = array(
    'star'   => '<svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor"><path d="M12 2l2.95 6.36L22 9.27l-5 4.87L18.18 22 12 18.27 5.82 22 7 14.14 2 9.27l7.05-.91L12 2z"/></svg>',
    'square' => '<svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.6"><rect x="4" y="4" width="16" height="16"/><path d="M4 9h16M9 4v16"/></svg>',
    'clock'  => '<svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.6"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg>',
    'shield' => '<svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M12 3l8 3v6c0 5-4 8-8 9-4-1-8-4-8-9V6l8-3z"/><path d="M9 12l2 2 4-4"/></svg>',
);
?>

<section id="section-social-proof" class="proof-strip">
    <div class="wrap proof-strip__grid">
        <?php foreach ($metrics as $i => $m) : ?>
            <div class="proof-cell<?php echo $i === 0 ? '' : ' proof-cell--bordered'; ?>">
                <div class="proof-cell__icon"><?php echo $icons_svg[$m['icon']] ?? ''; ?></div>
                <div>
                    <div class="display proof-cell__value"><?php echo esc_html($m['value']); ?></div>
                    <div class="proof-cell__label"><?php echo esc_html($m['label']); ?></div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<style>
.proof-strip {
    background: var(--ink-0);
    border-top: 1px solid var(--hair);
    border-bottom: 1px solid var(--hair);
}
.proof-strip__grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 0;
}
.proof-cell {
    padding: 36px 32px;
    display: flex;
    align-items: center;
    gap: 18px;
}
.proof-cell--bordered {
    border-left: 1px solid var(--hair);
}
.proof-cell__icon {
    color: var(--gold-3);
    flex-shrink: 0;
}
.proof-cell__value {
    font-size: 28px;
    font-weight: 600;
    line-height: 1;
    color: var(--bone);
}
.proof-cell__label {
    font-size: 11px;
    letter-spacing: 0.18em;
    text-transform: uppercase;
    color: var(--mute);
    margin-top: 6px;
}
@media (max-width: 900px) {
    .proof-cell { padding: 22px 18px; }
    .proof-cell__value { font-size: 22px; }
}
@media (max-width: 640px) {
    .proof-strip__grid { grid-template-columns: repeat(2, 1fr); }
    .proof-cell:nth-child(2) { border-left: 1px solid var(--hair); }
    .proof-cell:nth-child(3) { border-left: none; border-top: 1px solid var(--hair); }
    .proof-cell:nth-child(4) { border-top: 1px solid var(--hair); }
}
</style>
