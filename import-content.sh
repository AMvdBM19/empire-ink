#!/bin/sh
# Empire INK — Content import script
# Run from the VPS after init.sh has completed:
#   docker exec wp-empire-ink sh /var/www/html/import-content.sh
# Or directly from the host:
#   docker exec wp-empire-ink bash -c "$(cat import-content.sh)"
set -e

WP="wp --allow-root"
CONTAINER="wp-empire-ink"

exec_wp() {
    docker exec "$CONTAINER" $WP "$@"
}

echo "==> Site settings..."
exec_wp option update blogname "Empire INK"
exec_wp option update blogdescription "Tattoo & Piercing Studio — Amsterdam"
exec_wp option update timezone_string "Europe/Amsterdam"
exec_wp option update WPLANG "nl_NL"

echo "==> Finding Site Settings page..."
SETTINGS_ID=$(exec_wp post list --post_type=page --post_status=publish --fields=ID,post_title --format=csv \
  | grep "Site Settings" | cut -d',' -f1)

if [ -z "$SETTINGS_ID" ]; then
    echo "    ERROR: Site Settings page not found. Run init.sh first."
    exit 1
fi

echo "    Site Settings page ID: $SETTINGS_ID"

echo "==> Hero section..."
exec_wp post meta update "$SETTINGS_ID" hero_heading "Jouw Verhaal. In Inkt."
exec_wp post meta update "$SETTINGS_ID" hero_subheading "Handgemaakt tatoeagewerk van de beste kunstenaars in Amsterdam. Van fijne lijnen tot full-sleeve — we vertalen jouw visie naar permanente kunst."
exec_wp post meta update "$SETTINGS_ID" hero_cta_primary_text "Boek een afspraak"
exec_wp post meta update "$SETTINGS_ID" hero_cta_primary_url "/contact"
exec_wp post meta update "$SETTINGS_ID" hero_cta_secondary_text "Bekijk ons werk"
exec_wp post meta update "$SETTINGS_ID" hero_cta_secondary_url "/portfolio"

echo "==> Team members (8 tattoo artists)..."

# Artist 1
ARTIST_1=$(exec_wp post create \
  --post_type=team_member \
  --post_title="Daan van der Berg" \
  --post_status=publish \
  --porcelain)
exec_wp post meta update "$ARTIST_1" role "Oprichter & Head Artist"
exec_wp post meta update "$ARTIST_1" specialization "Japans traditioneel, Neo-traditioneel"
exec_wp post meta update "$ARTIST_1" experience_years "14"
exec_wp post meta update "$ARTIST_1" bio "Daan richtte Empire INK op in 2010 na jaren studie in Osaka. Zijn werk combineert klassieke Japanse motieven met een moderne Europese sensibiliteit."
exec_wp post meta update "$ARTIST_1" instagram "@daanvanderberg.ink"
exec_wp post meta update "$ARTIST_1" booking_email "daan@empire-ink.nl"
echo "    Created: Daan van der Berg (ID $ARTIST_1)"

# Artist 2
ARTIST_2=$(exec_wp post create \
  --post_type=team_member \
  --post_title="Lotte de Vries" \
  --post_status=publish \
  --porcelain)
exec_wp post meta update "$ARTIST_2" role "Senior Artist"
exec_wp post meta update "$ARTIST_2" specialization "Fijne lijnen, Botanisch, Minimalisme"
exec_wp post meta update "$ARTIST_2" experience_years "9"
exec_wp post meta update "$ARTIST_2" bio "Lotte is gespecialiseerd in delicate fijne-lijnwerk en botanische illustraties. Haar lichte hand en oog voor detail maken haar een van de meest gevraagde artiesten van het studio."
exec_wp post meta update "$ARTIST_2" instagram "@lottedevries.tattoo"
exec_wp post meta update "$ARTIST_2" booking_email "lotte@empire-ink.nl"
echo "    Created: Lotte de Vries (ID $ARTIST_2)"

# Artist 3
ARTIST_3=$(exec_wp post create \
  --post_type=team_member \
  --post_title="Bram Janssen" \
  --post_status=publish \
  --porcelain)
exec_wp post meta update "$ARTIST_3" role "Senior Artist"
exec_wp post meta update "$ARTIST_3" specialization "Blackwork, Geometrisch, Tribal"
exec_wp post meta update "$ARTIST_3" experience_years "11"
exec_wp post meta update "$ARTIST_3" bio "Bram's blackwork is instant herkenbaar — zwart als nacht, scherp als scheermessen. Zijn geometrische composities zijn stuk voor stuk architectonische meesterwerken op huid."
exec_wp post meta update "$ARTIST_3" instagram "@bramjanssen.black"
exec_wp post meta update "$ARTIST_3" booking_email "bram@empire-ink.nl"
echo "    Created: Bram Janssen (ID $ARTIST_3)"

# Artist 4
ARTIST_4=$(exec_wp post create \
  --post_type=team_member \
  --post_title="Noor Bakker" \
  --post_status=publish \
  --porcelain)
exec_wp post meta update "$ARTIST_4" role "Artist"
exec_wp post meta update "$ARTIST_4" specialization "Aquarel, Illustratief, Kleur"
exec_wp post meta update "$ARTIST_4" experience_years "6"
exec_wp post meta update "$ARTIST_4" bio "Noor brengt aquarelverf tot leven op huid. Haar kleurrijke, vloeiende stijl staat in schril contrast met de donkere studio-esthetiek — en dat is precies de bedoeling."
exec_wp post meta update "$ARTIST_4" instagram "@noorbakker.color"
exec_wp post meta update "$ARTIST_4" booking_email "noor@empire-ink.nl"
echo "    Created: Noor Bakker (ID $ARTIST_4)"

# Artist 5
ARTIST_5=$(exec_wp post create \
  --post_type=team_member \
  --post_title="Sven Mulder" \
  --post_status=publish \
  --porcelain)
exec_wp post meta update "$ARTIST_5" role "Artist"
exec_wp post meta update "$ARTIST_5" specialization "Realistisch, Portret, Zwart-grijs"
exec_wp post meta update "$ARTIST_5" experience_years "8"
exec_wp post meta update "$ARTIST_5" bio "Sven's realistische portretten en zwart-grijs werk zijn adembenemend. Zijn technische beheersing van grijstinten en diepte maken elk portret fotorealistisch."
exec_wp post meta update "$ARTIST_5" instagram "@svenmulder.realism"
exec_wp post meta update "$ARTIST_5" booking_email "sven@empire-ink.nl"
echo "    Created: Sven Mulder (ID $ARTIST_5)"

# Artist 6
ARTIST_6=$(exec_wp post create \
  --post_type=team_member \
  --post_title="Femke Visser" \
  --post_status=publish \
  --porcelain)
exec_wp post meta update "$ARTIST_6" role "Artist"
exec_wp post meta update "$ARTIST_6" specialization "Old School, Traditional American"
exec_wp post meta update "$ARTIST_6" experience_years "7"
exec_wp post meta update "$ARTIST_6" bio "Femke ademt old school. Dikke lijnen, heldere kleuren, klassieke motieven — haar werk is een ode aan de roots van het tatoeëren. Ankers, rozen en zeemeerminnen als nooit tevoren."
exec_wp post meta update "$ARTIST_6" instagram "@femkevisser.oldschool"
exec_wp post meta update "$ARTIST_6" booking_email "femke@empire-ink.nl"
echo "    Created: Femke Visser (ID $ARTIST_6)"

# Artist 7
ARTIST_7=$(exec_wp post create \
  --post_type=team_member \
  --post_title="Thijs Kok" \
  --post_status=publish \
  --porcelain)
exec_wp post meta update "$ARTIST_7" role "Artist"
exec_wp post meta update "$ARTIST_7" specialization "Neo-Traditioneel, Illustratief"
exec_wp post meta update "$ARTIST_7" experience_years "5"
exec_wp post meta update "$ARTIST_7" bio "Thijs is de jongste aanwinst van het team maar zijn neo-traditionele werk overtreft zijn leeftijd. Rijke kleuren, expressieve composities en een uitgesproken eigen stijl."
exec_wp post meta update "$ARTIST_7" instagram "@thijskok.neo"
exec_wp post meta update "$ARTIST_7" booking_email "thijs@empire-ink.nl"
echo "    Created: Thijs Kok (ID $ARTIST_7)"

# Artist 8
ARTIST_8=$(exec_wp post create \
  --post_type=team_member \
  --post_title="Roos Smit" \
  --post_status=publish \
  --porcelain)
exec_wp post meta update "$ARTIST_8" role "Piercing Specialist"
exec_wp post meta update "$ARTIST_8" specialization "Piercing, Implants, Surface Work"
exec_wp post meta update "$ARTIST_8" experience_years "10"
exec_wp post meta update "$ARTIST_8" bio "Roos is onze piercing-expert met een decennium ervaring. Van simpele oorpiercings tot complexe industrials en surface work — veiligheid, hygiëne en precisie staan altijd voorop."
exec_wp post meta update "$ARTIST_8" instagram "@roossmit.piercing"
exec_wp post meta update "$ARTIST_8" booking_email "roos@empire-ink.nl"
echo "    Created: Roos Smit (ID $ARTIST_8)"

echo "==> Promotion..."
PROMO_ID=$(exec_wp post create \
  --post_type=promotion \
  --post_title="Nieuw jaar, nieuw tattoo — 15% korting in januari" \
  --post_status=publish \
  --porcelain)
exec_wp post meta update "$PROMO_ID" promo_code "NIEUWJAAR25"
exec_wp post meta update "$PROMO_ID" discount_percentage "15"
exec_wp post meta update "$PROMO_ID" valid_until "2026-01-31"
exec_wp post meta update "$PROMO_ID" promo_description "Start het nieuwe jaar met een nieuw tattoo. Boek in januari en ontvang 15% korting op alle sessies van minimaal 2 uur. Gebruik code NIEUWJAAR25 bij je boeking."
exec_wp post meta update "$PROMO_ID" cta_text "Nu boeken"
exec_wp post meta update "$PROMO_ID" cta_url "/contact"
echo "    Created promotion (ID $PROMO_ID)"

echo "==> Testimonials (Dutch)..."

# Testimonial 1
T1=$(exec_wp post create \
  --post_type=review \
  --post_title="Review — Jasper H." \
  --post_status=publish \
  --porcelain)
exec_wp post meta update "$T1" reviewer_name "Jasper H."
exec_wp post meta update "$T1" rating "5"
exec_wp post meta update "$T1" review_source "Google"
exec_wp post meta update "$T1" review_date "2025-11-14"
exec_wp post meta update "$T1" review_text "Mijn full-sleeve is eindelijk af na 18 maanden werken met Daan. Het resultaat is ongelooflijk — elk detail klopt, de kleuren zijn levend en de compositie is perfect uitgebalanceerd. Empire INK is zonder twijfel het beste studio in Amsterdam. De sfeer, de professionaliteit, de hygiëne — alles topt."
echo "    Created: Jasper H."

# Testimonial 2
T2=$(exec_wp post create \
  --post_type=review \
  --post_title="Review — Mila K." \
  --post_status=publish \
  --porcelain)
exec_wp post meta update "$T2" reviewer_name "Mila K."
exec_wp post meta update "$T2" rating "5"
exec_wp post meta update "$T2" review_source "Google"
exec_wp post meta update "$T2" review_date "2025-10-02"
exec_wp post meta update "$T2" review_text "Lotte heeft mijn botanische sleeve gedaan en ik ben er helemaal verliefd op. Ze luistert echt naar wat je wilt en voegt haar eigen artistieke touch toe die het nóg mooier maakt. Het genezingsproces ging vlekkeloos dankzij haar goede naaldwerk. Ik ga zeker terug voor mijn volgende stuk."
echo "    Created: Mila K."

# Testimonial 3
T3=$(exec_wp post create \
  --post_type=review \
  --post_title="Review — Tom van D." \
  --post_status=publish \
  --porcelain)
exec_wp post meta update "$T3" reviewer_name "Tom van D."
exec_wp post meta update "$T3" rating "5"
exec_wp post meta update "$T3" review_source "Google"
exec_wp post meta update "$T3" review_date "2025-09-18"
exec_wp post meta update "$T3" review_text "Bram heeft mijn gehele rug gedaan met een geometrisch blackwork ontwerp. Het kostte drie sessies maar elke minuut was de moeite waard. Bram is rustig, professioneel en werkt ongelooflijk snel en precies. De lijnen zijn scherp als een mes. Iedereen die op mijn rug kijkt staat met zijn mond vol tanden."
echo "    Created: Tom van D."

echo ""
echo "========================================="
echo "  Empire INK content import complete"
echo "========================================="
echo "  Artists:      8"
echo "  Promotions:   1"
echo "  Testimonials: 3"
echo "========================================="
