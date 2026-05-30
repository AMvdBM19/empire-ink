// Empire Ink — remaining sections + app shell

const { useState: useStateB, useEffect: useEffectB, useRef: useRefB, useMemo: useMemoB } = React;

/* ---------- Portfolio ---------- */
// Stylised placeholder tattoo "image" cells - SVG-driven texture, no figurative art
function PortfolioCell({ piece, idx, t, real }) {
  // Use one of the real assets for a few cells
  const realSrcMap = {
    0: EMPIRE_ASSETS.heroBack,
    2: EMPIRE_ASSETS.studioAction,
    4: EMPIRE_ASSETS.bannerOverOns,
    6: EMPIRE_ASSETS.piercerAction,
  };
  const realSrc = realSrcMap[idx];

  // Asymmetric sizing - bento-ish
  const sizeMap = {
    0: { gridColumn: "span 6", gridRow: "span 2", h: 560 },
    1: { gridColumn: "span 3", gridRow: "span 1", h: 270 },
    2: { gridColumn: "span 3", gridRow: "span 1", h: 270 },
    3: { gridColumn: "span 3", gridRow: "span 1", h: 270 },
    4: { gridColumn: "span 3", gridRow: "span 1", h: 270 },
    5: { gridColumn: "span 4", gridRow: "span 1", h: 320 },
    6: { gridColumn: "span 4", gridRow: "span 1", h: 320 },
    7: { gridColumn: "span 4", gridRow: "span 1", h: 320 },
  };
  const s = sizeMap[idx] || { gridColumn: "span 3", gridRow: "span 1", h: 270 };

  return (
    <article style={{
      gridColumn: s.gridColumn,
      gridRow: s.gridRow,
      height: s.h,
      position: "relative",
      overflow: "hidden",
      background: "var(--ink-2)",
      cursor: "pointer",
    }} className="port-cell">
      {realSrc ? (
        <img src={realSrc} alt={piece.title} className="asset port-img"
          style={{ filter: "saturate(0.85) contrast(1.05)", transition: "transform .8s cubic-bezier(.2,.7,.2,1), filter .4s" }} />
      ) : (
        <div className="ph" data-label={`${piece.style} · ${piece.title}`} style={{ width: "100%", height: "100%" }}>
          {/* decorative number */}
          <div className="display" style={{
            position: "absolute", inset: 0,
            display: "flex", alignItems: "center", justifyContent: "center",
            fontSize: 160, color: "rgba(212,168,90,0.06)", fontWeight: 700, letterSpacing: "-0.02em",
          }}>0{idx+1}</div>
        </div>
      )}

      {/* Overlay */}
      <div className="port-overlay" style={{
        position: "absolute", inset: 0,
        background: "linear-gradient(180deg, transparent 40%, rgba(7,6,10,0.92) 100%)",
        display: "flex", flexDirection: "column", justifyContent: "flex-end",
        padding: 24,
        opacity: 1,
        transition: "opacity .35s",
      }}>
        <div style={{ display: "flex", justifyContent: "space-between", alignItems: "flex-end", gap: 16 }}>
          <div>
            <div className="label-mono" style={{ color: "var(--gold-3)", fontSize: 10, marginBottom: 6 }}>{piece.style}</div>
            <div className="display" style={{ fontSize: 22, fontWeight: 500, color: "var(--bone)" }}>{piece.title}</div>
            <div style={{ marginTop: 6, fontSize: 12, color: "var(--mute)" }}>by {piece.artist}</div>
          </div>
          <div className="port-arrow" style={{
            width: 40, height: 40, border: "1px solid var(--hair-strong)", borderRadius: "50%",
            display: "flex", alignItems: "center", justifyContent: "center", color: "var(--bone-dim)",
            transition: "all .3s",
            flexShrink: 0,
          }}>
            <Icon.arrow size={14} />
          </div>
        </div>
      </div>

      <style>{`
        .port-cell:hover .port-img { transform: scale(1.06); filter: saturate(1) contrast(1.1); }
        .port-cell:hover .port-arrow { border-color: var(--gold-2); color: var(--gold-3); background: rgba(212,168,90,0.08); }
      `}</style>
    </article>
  );
}

function Portfolio({ t }) {
  const [active, setActive] = useStateB(0);
  const tabs = t.portfolio.tabs;
  const activeLabel = tabs[active];
  const allLabel = tabs[0]; // "Alles" or "All"

  const filtered = t.portfolio.pieces.filter((p) => {
    if (active === 0) return true;
    return p.style === activeLabel;
  });

  return (
    <section id="portfolio" className="section-pad">
      <div className="wrap">
        <div className="section-head">
          <div>
            <div className="eyebrow" style={{ marginBottom: 16 }}>{t.portfolio.eyebrow}</div>
            <h2 className="display title" style={{ margin: 0 }}>
              {t.portfolio.title}<span style={{ color: "var(--gold-3)" }}>.</span>
            </h2>
            <p style={{ maxWidth: 520, color: "var(--bone-dim)", marginTop: 18, fontSize: 16 }}>{t.portfolio.sub}</p>
          </div>
          <div style={{ display: "flex", flexWrap: "wrap", gap: 8, maxWidth: 600, justifyContent: "flex-end" }}>
            {tabs.map((tab, i) => (
              <button key={tab} className={`chip ${active === i ? "active" : ""}`} onClick={() => setActive(i)}>{tab}</button>
            ))}
          </div>
        </div>

        <div className="port-grid" style={{
          display: "grid",
          gridTemplateColumns: "repeat(12, 1fr)",
          gap: 12,
        }}>
          {filtered.map((p, i) => <PortfolioCell key={`${active}-${i}`} piece={p} idx={t.portfolio.pieces.indexOf(p)} t={t} />)}
        </div>

        <div style={{ marginTop: 56, display: "flex", justifyContent: "center" }}>
          <a href="#portfolio" className="btn btn-ghost btn-arrow">{t.portfolio.view}<Icon.arrow /></a>
        </div>
      </div>
      <style>{`
        @media (max-width: 1000px) {
          .port-grid { grid-template-columns: repeat(6, 1fr) !important; }
          .port-grid > article { grid-column: span 6 !important; height: 280px !important; }
          .port-grid > article:nth-child(1) { height: 380px !important; }
        }
        .section-head { grid-template-columns: 1fr auto; }
        @media (max-width: 900px) {
          .section-head { grid-template-columns: 1fr !important; align-items: flex-start !important; }
          .section-head > div:last-child { justify-content: flex-start !important; }
        }
      `}</style>
    </section>
  );
}

/* ---------- Artists ---------- */
function Artists({ t }) {
  const scrollRef = useRefB(null);
  const scroll = (dir) => {
    if (!scrollRef.current) return;
    scrollRef.current.scrollBy({ left: dir * 360, behavior: "smooth" });
  };
  // Color tinted placeholder images
  const palette = ["#2a2521", "#1d1916", "#241b14", "#1a1614", "#22201c", "#171513", "#2a2018", "#1e1c19"];

  return (
    <section id="over" style={{ background: "var(--ink-0)", borderTop: "1px solid var(--hair)" }} className="section-pad">
      <div className="wrap">
        <div className="section-head">
          <div>
            <div className="eyebrow" style={{ marginBottom: 16 }}>{t.artists.eyebrow}</div>
            <h2 className="display title" style={{ margin: 0 }}>{t.artists.title}<span style={{ color: "var(--gold-3)" }}>.</span></h2>
            <p style={{ maxWidth: 520, color: "var(--bone-dim)", marginTop: 18, fontSize: 16 }}>{t.artists.sub}</p>
          </div>
          <div style={{ display: "flex", gap: 8 }}>
            <button onClick={() => scroll(-1)} className="arrow-btn"><Icon.chevL size={18} /></button>
            <button onClick={() => scroll(1)} className="arrow-btn"><Icon.chevR size={18} /></button>
          </div>
        </div>
      </div>

      <div ref={scrollRef} className="artist-scroller" style={{
        display: "flex",
        gap: 16,
        overflowX: "auto",
        scrollSnapType: "x mandatory",
        paddingLeft: "max(48px, calc((100vw - 1440px) / 2 + 48px))",
        paddingRight: "max(48px, calc((100vw - 1440px) / 2 + 48px))",
        paddingBottom: 16,
        scrollbarWidth: "none",
      }}>
        {t.artists.roster.map((a, i) => (
          <article key={i} style={{
            flex: "0 0 320px",
            scrollSnapAlign: "start",
            background: "var(--ink-2)",
            border: "1px solid var(--hair)",
            position: "relative",
            overflow: "hidden",
          }} className="artist-card">
            {/* Portrait placeholder */}
            <div style={{ height: 380, position: "relative", background: palette[i % palette.length], overflow: "hidden" }}>
              <div className="ph" data-label="ARTIST PORTRAIT" style={{ width: "100%", height: "100%" }} />
              {/* Initial overlay */}
              <div className="display" style={{
                position: "absolute", inset: 0,
                display: "flex", alignItems: "center", justifyContent: "center",
                fontSize: 200, color: "rgba(212,168,90,0.10)", fontWeight: 700, letterSpacing: "-0.04em",
                lineHeight: 1,
              }}>{a.name[0]}</div>
              {/* Years badge */}
              <div style={{
                position: "absolute", top: 16, right: 16,
                padding: "6px 10px",
                background: "rgba(7,6,10,0.7)",
                border: "1px solid var(--hair)",
                fontSize: 10, letterSpacing: "0.18em", textTransform: "uppercase",
                color: "var(--gold-3)",
                backdropFilter: "blur(6px)",
              }}>{a.years} yrs</div>
            </div>
            <div style={{ padding: "22px 22px 24px" }}>
              <div className="display" style={{ fontSize: 24, fontWeight: 500, marginBottom: 4 }}>{a.name}</div>
              <div style={{ fontSize: 12, letterSpacing: "0.14em", textTransform: "uppercase", color: "var(--mute)" }}>{a.styles}</div>
              <hr className="hair" style={{ margin: "16px 0" }} />
              <a href="#contact" className="artist-book" style={{
                display: "flex", alignItems: "center", justifyContent: "space-between",
                fontSize: 12, fontWeight: 600, letterSpacing: "0.18em", textTransform: "uppercase",
                color: "var(--bone-dim)",
                textDecoration: "none",
                transition: "color .25s",
              }}>
                <span>{t.artists.book} {a.name.split(" ")[0]}</span>
                <Icon.arrow size={14} />
              </a>
            </div>
          </article>
        ))}
        {/* End card */}
        <article style={{ flex: "0 0 320px", scrollSnapAlign: "start", display: "flex", alignItems: "center", justifyContent: "center", border: "1px solid var(--hair)", minHeight: 540 }}>
          <a href="#over" className="display" style={{ color: "var(--gold-3)", fontSize: 20, textDecoration: "none", textAlign: "center" }}>
            View all<br/>
            <Icon.arrow size={20} />
          </a>
        </article>
      </div>

      <style>{`
        .artist-scroller::-webkit-scrollbar { display: none; }
        .artist-card:hover .artist-book { color: var(--gold-3); }
        .arrow-btn {
          width: 44px; height: 44px; border-radius: 50%;
          background: transparent; border: 1px solid var(--hair-strong);
          color: var(--bone-dim);
          display: flex; align-items: center; justify-content: center;
          cursor: pointer;
          transition: all .25s;
        }
        .arrow-btn:hover { border-color: var(--gold-2); color: var(--gold-3); }
      `}</style>
    </section>
  );
}

/* ---------- Services ---------- */
function Services({ t }) {
  return (
    <section id="tattoo" className="section-pad">
      <div className="wrap">
        <div className="section-head">
          <div>
            <div className="eyebrow" style={{ marginBottom: 16 }}>{t.services.eyebrow}</div>
            <h2 className="display title" style={{ margin: 0 }}>
              {t.services.title}<br/>
              <span style={{
                fontFamily: "var(--font-serif)", fontStyle: "italic", fontWeight: 400, textTransform: "none",
                background: "var(--gold-grad)", WebkitBackgroundClip: "text", WebkitTextFillColor: "transparent",
              }}>{t.services.title2}</span>
            </h2>
          </div>
        </div>

        <div className="svc-grid" style={{ display: "grid", gridTemplateColumns: "1fr 1fr", gap: 24 }}>
          {[t.services.tattoo, t.services.piercing].map((s, i) => {
            const img = i === 0 ? EMPIRE_ASSETS.studioAction : EMPIRE_ASSETS.piercerAction;
            const anchor = i === 0 ? "tattoo" : "piercing";
            return (
              <article key={i} id={anchor} className="svc-card" style={{
                background: "var(--ink-2)",
                border: "1px solid var(--hair)",
                position: "relative",
                overflow: "hidden",
                display: "grid",
                gridTemplateRows: "320px 1fr",
              }}>
                <div style={{ position: "relative", overflow: "hidden" }}>
                  <img src={img} alt="" className="asset svc-img" style={{ filter: "saturate(0.9) contrast(1.1)", transition: "transform .6s" }} />
                  <div style={{ position: "absolute", inset: 0, background: "linear-gradient(180deg, transparent 40%, rgba(20,17,15,0.7) 100%)" }} />
                  <div style={{ position: "absolute", top: 22, left: 22 }} className="label-mono">
                    <span style={{ color: "var(--gold-3)" }}>0{i+1}</span>
                    <span style={{ color: "var(--mute)", margin: "0 10px" }}>/</span>
                    <span style={{ color: "var(--bone-dim)" }}>{s.kicker}</span>
                  </div>
                </div>
                <div style={{ padding: 32, display: "flex", flexDirection: "column", gap: 20 }}>
                  <h3 className="display" style={{ margin: 0, fontSize: 48, fontWeight: 500 }}>{s.kicker}</h3>
                  <p style={{ color: "var(--bone-dim)", fontSize: 15, lineHeight: 1.6, margin: 0 }}>{s.body}</p>

                  <div style={{ display: "flex", alignItems: "baseline", gap: 14, borderTop: "1px solid var(--hair)", borderBottom: "1px solid var(--hair)", padding: "18px 0" }}>
                    <div className="label-mono" style={{ color: "var(--mute)" }}>{s.from}</div>
                    <div className="display" style={{ fontSize: 44, fontWeight: 600, color: "var(--gold-3)", lineHeight: 1 }}>{s.price}</div>
                    <div style={{ fontSize: 12, color: "var(--mute)", marginLeft: "auto" }}>{s.priceMeta}</div>
                  </div>

                  <ul style={{ listStyle: "none", padding: 0, margin: 0, display: "flex", flexDirection: "column", gap: 10 }}>
                    {s.points.map((pt, j) => (
                      <li key={j} style={{ display: "flex", alignItems: "center", gap: 12, fontSize: 14, color: "var(--bone-dim)" }}>
                        <span style={{ width: 6, height: 6, background: "var(--gold-2)", borderRadius: "50%", flexShrink: 0 }} />
                        {pt}
                      </li>
                    ))}
                  </ul>

                  <a href="#contact" className="btn btn-ghost btn-arrow" style={{ alignSelf: "flex-start", marginTop: 8 }}>
                    {s.cta}<Icon.arrow />
                  </a>
                </div>
              </article>
            );
          })}
        </div>
      </div>
      <style>{`
        .svc-card:hover .svc-img { transform: scale(1.04); }
        @media (max-width: 900px) {
          .svc-grid { grid-template-columns: 1fr !important; }
        }
      `}</style>
    </section>
  );
}

/* ---------- Promotion ---------- */
function Promo({ t }) {
  return (
    <section id="prijzen" style={{ background: "var(--ink-0)", borderTop: "1px solid var(--hair)", borderBottom: "1px solid var(--hair)" }} className="section-pad">
      <div className="wrap">
        <div className="promo-card" style={{
          display: "grid",
          gridTemplateColumns: "1.1fr 1fr",
          background: "linear-gradient(135deg, #14110f 0%, #0d0b09 100%)",
          border: "1px solid var(--hair-strong)",
          overflow: "hidden",
          position: "relative",
          minHeight: 540,
        }}>
          {/* Decorative gold corner */}
          <div style={{ position: "absolute", top: 0, right: 0, width: 240, height: 240, background: "radial-gradient(ellipse at top right, rgba(212,168,90,0.25), transparent 70%)", pointerEvents: "none" }} />

          <div className="promo-image-wrap" style={{ position: "relative", minHeight: 380 }}>
            <img src={EMPIRE_ASSETS.promoTrio} alt="" className="asset" style={{ filter: "saturate(0.95)" }} />
            <div style={{ position: "absolute", inset: 0, background: "linear-gradient(90deg, transparent 60%, rgba(13,11,9,0.4) 100%)" }} />
          </div>

          <div style={{ padding: "56px 56px 56px 64px", display: "flex", flexDirection: "column", justifyContent: "center", gap: 22 }} className="promo-body">
            <div style={{ display: "flex", alignItems: "center", gap: 12 }}>
              <span style={{
                fontSize: 10, letterSpacing: "0.3em", textTransform: "uppercase", fontWeight: 700,
                padding: "6px 12px",
                background: "var(--gold-grad)",
                color: "var(--ink-0)",
              }}>{t.promo.badge}</span>
              <span className="eyebrow">{t.promo.eyebrow}</span>
            </div>

            <h2 className="display" style={{ margin: 0, fontSize: "clamp(48px, 5vw, 76px)", fontWeight: 500, lineHeight: 0.95 }}>
              {t.promo.title.split(" ").map((w, i, arr) => (
                <span key={i}>{i === arr.length - 1 ? <span style={{
                  fontFamily: "var(--font-serif)", fontStyle: "italic", fontWeight: 400, textTransform: "none",
                  background: "var(--gold-grad)", WebkitBackgroundClip: "text", WebkitTextFillColor: "transparent",
                }}>{w}</span> : <span>{w} </span>}</span>
              ))}
            </h2>

            <p style={{ color: "var(--bone-dim)", margin: 0, fontSize: 16, maxWidth: 420 }}>{t.promo.hook}</p>

            <div style={{ display: "flex", alignItems: "baseline", gap: 16, marginTop: 4 }}>
              <span className="display" style={{ fontSize: 80, fontWeight: 600, color: "var(--gold-3)", lineHeight: 1, letterSpacing: "-0.02em" }}>{t.promo.price}</span>
              <span style={{ fontSize: 20, color: "var(--mute)", textDecoration: "line-through" }}>{t.promo.priceWas}</span>
            </div>

            <a href="#contact" className="btn btn-gold btn-arrow" style={{ alignSelf: "flex-start" }}>{t.promo.cta}<Icon.arrow /></a>
            <p style={{ fontSize: 11, color: "var(--mute)", margin: 0, maxWidth: 460, lineHeight: 1.6 }}>{t.promo.fine}</p>
          </div>
        </div>
      </div>
      <style>{`
        @media (max-width: 900px) {
          .promo-card { grid-template-columns: 1fr !important; }
          .promo-body { padding: 40px 28px !important; }
        }
      `}</style>
    </section>
  );
}

/* ---------- Reviews ---------- */
function Reviews({ t }) {
  const [i, setI] = useStateB(0);
  useEffectB(() => {
    const id = setInterval(() => setI((x) => (x + 1) % t.reviews.items.length), 7000);
    return () => clearInterval(id);
  }, [t.reviews.items.length]);

  return (
    <section className="section-pad">
      <div className="wrap">
        <div className="section-head">
          <div>
            <div className="eyebrow" style={{ marginBottom: 16 }}>{t.reviews.eyebrow}</div>
            <h2 className="display title" style={{ margin: 0 }}>{t.reviews.title}<span style={{ color: "var(--gold-3)" }}>.</span></h2>
            <p style={{ maxWidth: 520, color: "var(--bone-dim)", marginTop: 18, fontSize: 16 }}>{t.reviews.sub}</p>
          </div>
          <div style={{ display: "flex", gap: 8 }}>
            {t.reviews.items.map((_, idx) => (
              <button key={idx} onClick={() => setI(idx)} style={{
                width: 32, height: 4,
                background: idx === i ? "var(--gold-2)" : "var(--hair-strong)",
                border: "none", cursor: "pointer",
                transition: "background .3s",
              }} />
            ))}
          </div>
        </div>

        <div style={{ display: "grid", gridTemplateColumns: "1fr", gap: 0, position: "relative", minHeight: 380 }}>
          {t.reviews.items.map((r, idx) => (
            <article key={idx} style={{
              position: idx === 0 ? "relative" : "absolute",
              top: 0, left: 0, right: 0,
              opacity: idx === i ? 1 : 0,
              transition: "opacity .8s cubic-bezier(.2,.7,.2,1)",
              pointerEvents: idx === i ? "auto" : "none",
              maxWidth: 1000,
              margin: "0 auto",
            }}>
              <div style={{ display: "flex", gap: 4, color: "var(--gold-3)", marginBottom: 28 }}>
                {[...Array(r.rating)].map((_, s) => <Icon.star key={s} size={16} />)}
              </div>
              <blockquote style={{
                margin: 0,
                fontFamily: "var(--font-serif)",
                fontStyle: "italic",
                fontWeight: 400,
                fontSize: "clamp(28px, 3vw, 44px)",
                lineHeight: 1.25,
                color: "var(--bone)",
                textTransform: "none",
              }}>
                <span style={{ color: "var(--gold-3)", fontFamily: "var(--font-display)", fontSize: 80, lineHeight: 0.3, verticalAlign: "-0.4em", marginRight: 6 }}>"</span>
                {r.q}
              </blockquote>
              <div style={{ marginTop: 36, display: "flex", alignItems: "center", gap: 16 }}>
                <div style={{
                  width: 48, height: 48, borderRadius: "50%",
                  background: "linear-gradient(135deg, var(--ink-3), var(--ink-4))",
                  border: "1px solid var(--hair)",
                  display: "flex", alignItems: "center", justifyContent: "center",
                  color: "var(--gold-3)",
                  fontFamily: "var(--font-display)", fontSize: 18, fontWeight: 600,
                }}>{r.name[0]}</div>
                <div>
                  <div style={{ fontWeight: 600, color: "var(--bone)" }}>{r.name}</div>
                  <div className="label-mono" style={{ color: "var(--mute)" }}>{r.piece}</div>
                </div>
              </div>
            </article>
          ))}
        </div>
      </div>
    </section>
  );
}

/* ---------- Studio / Visit ---------- */
function Studio({ t }) {
  return (
    <section id="contact" style={{ background: "var(--ink-0)", borderTop: "1px solid var(--hair)" }} className="section-pad">
      <div className="wrap">
        <div className="studio-grid" style={{ display: "grid", gridTemplateColumns: "1fr 1fr", gap: 64, alignItems: "center" }}>
          <div>
            <div className="eyebrow" style={{ marginBottom: 16 }}>{t.studio.eyebrow}</div>
            <h2 className="display title" style={{ margin: 0, fontSize: "clamp(56px, 7vw, 110px)", lineHeight: 0.92 }}>
              {t.studio.title.split(" ")[0]}{" "}
              <span style={{
                fontFamily: "var(--font-serif)", fontStyle: "italic", fontWeight: 400, textTransform: "none",
                background: "var(--gold-grad)", WebkitBackgroundClip: "text", WebkitTextFillColor: "transparent",
              }}>{t.studio.title.split(" ").slice(1).join(" ")}</span>
            </h2>
            <p style={{ color: "var(--bone-dim)", marginTop: 22, fontSize: 17, maxWidth: 480 }}>{t.studio.sub}</p>

            <div className="studio-cols" style={{ marginTop: 48, display: "grid", gridTemplateColumns: "1fr 1fr", gap: 32 }}>
              <div>
                <div className="label-mono" style={{ color: "var(--mute)", marginBottom: 10 }}>{t.studio.addrLabel}</div>
                <div style={{ color: "var(--bone)", fontSize: 16, lineHeight: 1.45 }}>
                  Van Meekerenstraat 162<br/>3074 NP Rotterdam<br/>Nederland
                </div>
                <a href="#" style={{
                  marginTop: 14, display: "inline-flex", gap: 8, alignItems: "center",
                  fontSize: 12, letterSpacing: "0.18em", textTransform: "uppercase",
                  color: "var(--gold-3)", textDecoration: "none",
                  fontWeight: 600,
                }}>
                  <Icon.pin size={14} />{t.studio.directions}
                </a>
              </div>
              <div>
                <div className="label-mono" style={{ color: "var(--mute)", marginBottom: 10 }}>{t.studio.phoneLabel}</div>
                <a href="tel:+31103335353" style={{ color: "var(--bone)", fontSize: 16, textDecoration: "none", display: "block" }}>010 33 353 53</a>
                <a href="mailto:info@empire-ink.nl" style={{ color: "var(--bone-dim)", fontSize: 14, textDecoration: "none", marginTop: 6, display: "block" }}>info@empire-ink.nl</a>

                <div className="label-mono" style={{ color: "var(--mute)", marginTop: 28, marginBottom: 10 }}>{t.studio.hoursLabel}</div>
                {t.studio.hoursLines.map((h, k) => (
                  <div key={k} style={{ color: "var(--bone-dim)", fontSize: 14, lineHeight: 1.7 }}>{h}</div>
                ))}
              </div>
            </div>
          </div>

          {/* Studio image w/ "map" overlay */}
          <div className="studio-image-wrap" style={{ position: "relative", aspectRatio: "4 / 5", overflow: "hidden", border: "1px solid var(--hair)" }}>
            <img src={EMPIRE_ASSETS.studioInterior} alt="" className="asset" style={{ filter: "saturate(0.85) contrast(1.05)" }} />
            <div style={{ position: "absolute", inset: 0, background: "linear-gradient(180deg, transparent 60%, rgba(7,6,10,0.85) 100%)" }} />

            {/* Coords overlay */}
            <div style={{ position: "absolute", top: 24, left: 24, display: "flex", alignItems: "center", gap: 10 }}>
              <span style={{ width: 8, height: 8, borderRadius: "50%", background: "var(--gold-3)", boxShadow: "0 0 0 4px rgba(212,168,90,0.2)" }} />
              <span className="label-mono" style={{ color: "var(--bone)" }}>51.8954° N · 4.4983° E</span>
            </div>

            <div style={{ position: "absolute", bottom: 24, left: 24, right: 24, display: "flex", justifyContent: "space-between", alignItems: "flex-end" }}>
              <div>
                <div className="label-mono" style={{ color: "var(--gold-3)", marginBottom: 4 }}>The Studio</div>
                <div className="display" style={{ fontSize: 28, fontWeight: 500 }}>500m² · Rotterdam-Zuid</div>
              </div>
              <a href="#" className="arrow-btn" style={{ background: "rgba(7,6,10,0.6)" }}><Icon.arrow size={16} /></a>
            </div>
          </div>
        </div>
      </div>
      <style>{`
        @media (max-width: 1000px) {
          .studio-grid { grid-template-columns: 1fr !important; gap: 40px !important; }
        }
        @media (max-width: 560px) {
          .studio-cols { grid-template-columns: 1fr !important; }
        }
      `}</style>
    </section>
  );
}

/* ---------- Closing CTA ---------- */
function ClosingCTA({ t }) {
  return (
    <section style={{ position: "relative", overflow: "hidden" }} className="section-pad">
      <div style={{ position: "absolute", inset: 0, zIndex: 0 }}>
        <img src={EMPIRE_ASSETS.bannerContact} alt="" className="asset" style={{ filter: "saturate(0.7) brightness(0.5)" }} />
        <div style={{ position: "absolute", inset: 0, background: "linear-gradient(180deg, rgba(13,11,9,0.85), rgba(7,6,10,0.95))" }} />
      </div>
      <div className="wrap" style={{ position: "relative", zIndex: 2, textAlign: "center" }}>
        <h2 className="display" style={{ margin: 0, fontSize: "clamp(56px, 9vw, 140px)", fontWeight: 500, lineHeight: 0.92 }}>
          {t.cta.title}<br/>
          <span style={{
            fontFamily: "var(--font-serif)", fontStyle: "italic", fontWeight: 400, textTransform: "none",
            background: "var(--gold-grad)", WebkitBackgroundClip: "text", WebkitTextFillColor: "transparent",
          }}>{t.cta.titleAccent}</span>{t.cta.title2}
        </h2>
        <p style={{ color: "var(--bone-dim)", fontSize: 17, marginTop: 28, maxWidth: 520, marginLeft: "auto", marginRight: "auto" }}>{t.cta.sub}</p>
        <div style={{ display: "flex", gap: 14, justifyContent: "center", marginTop: 40, flexWrap: "wrap" }}>
          <a href="#" className="btn btn-gold btn-arrow">{t.cta.primary}<Icon.arrow /></a>
          <a href="tel:+31103335353" className="btn btn-ghost btn-arrow"><Icon.phone size={14} />{t.cta.secondary}</a>
        </div>
      </div>
    </section>
  );
}

/* ---------- Footer ---------- */
function Footer({ t }) {
  return (
    <footer style={{ background: "var(--ink-0)", borderTop: "1px solid var(--hair)", paddingTop: 96, paddingBottom: 32 }}>
      <div className="wrap">
        <div className="footer-top" style={{ display: "grid", gridTemplateColumns: "2fr 1fr 1fr 1fr 1.4fr", gap: 48, paddingBottom: 64 }}>
          <div>
            <img src={EMPIRE_ASSETS.logoIcon} alt="Empire INK" style={{ height: 56, width: 56, marginBottom: 22 }} />
            <p style={{ color: "var(--bone-dim)", maxWidth: 280, fontSize: 14, lineHeight: 1.55 }}>{t.footer.tag}</p>
            <div style={{ display: "flex", gap: 12, marginTop: 26 }}>
              {[Icon.ig, Icon.fb, Icon.ws].map((I, i) => (
                <a key={i} href="#" className="social-link" style={{
                  width: 40, height: 40, border: "1px solid var(--hair)", borderRadius: "50%",
                  display: "flex", alignItems: "center", justifyContent: "center",
                  color: "var(--bone-dim)", transition: "all .25s",
                }}><I size={16} /></a>
              ))}
            </div>
          </div>

          {t.footer.cols.map((col, i) => (
            <div key={i}>
              <div className="label-mono" style={{ color: "var(--gold-3)", marginBottom: 22 }}>{col.title}</div>
              <ul style={{ listStyle: "none", padding: 0, margin: 0, display: "flex", flexDirection: "column", gap: 12 }}>
                {col.items.map((it) => (
                  <li key={it}><a href="#" style={{ color: "var(--bone-dim)", textDecoration: "none", fontSize: 14, transition: "color .25s" }}
                    onMouseEnter={(e) => e.currentTarget.style.color = "var(--gold-3)"}
                    onMouseLeave={(e) => e.currentTarget.style.color = "var(--bone-dim)"}>{it}</a></li>
                ))}
              </ul>
            </div>
          ))}

          <div>
            <div className="label-mono" style={{ color: "var(--gold-3)", marginBottom: 22 }}>{t.footer.newsletter}</div>
            <div style={{ display: "flex", gap: 0, border: "1px solid var(--hair-strong)" }}>
              <input type="email" placeholder={t.footer.newsletterPh} style={{
                flex: 1,
                background: "transparent",
                border: "none",
                padding: "14px 16px",
                color: "var(--bone)",
                fontFamily: "inherit",
                fontSize: 13,
                outline: "none",
              }} />
              <button style={{
                background: "var(--gold-grad)",
                border: "none",
                color: "var(--ink-0)",
                fontFamily: "inherit",
                fontSize: 11,
                fontWeight: 700,
                letterSpacing: "0.18em",
                textTransform: "uppercase",
                padding: "0 18px",
                cursor: "pointer",
              }}>{t.footer.newsletterCta}</button>
            </div>
            <div style={{ marginTop: 26 }}>
              <div className="label-mono" style={{ color: "var(--gold-3)", marginBottom: 12 }}>Contact</div>
              <div style={{ color: "var(--bone-dim)", fontSize: 13, lineHeight: 1.7 }}>
                Van Meekerenstraat 162<br/>3074 NP Rotterdam<br/>
                <a href="tel:+31103335353" style={{ color: "var(--bone-dim)", textDecoration: "none" }}>010 33 353 53</a>
              </div>
            </div>
          </div>
        </div>

        <hr className="hair" />

        <div style={{ paddingTop: 32, display: "flex", justifyContent: "space-between", alignItems: "center", flexWrap: "wrap", gap: 14, fontSize: 12, color: "var(--mute)" }}>
          <div>{t.footer.rights}</div>
          <div>
            {t.footer.credit.split("Monoliet.cloud")[0]}
            <a href="https://monoliet.cloud" style={{ color: "var(--gold-3)", textDecoration: "none" }}>Monoliet.cloud</a>
          </div>
        </div>
      </div>
      <style>{`
        .social-link:hover { border-color: var(--gold-2); color: var(--gold-3); }
        @media (max-width: 1100px) {
          .footer-top { grid-template-columns: 1fr 1fr !important; }
        }
        @media (max-width: 600px) {
          .footer-top { grid-template-columns: 1fr !important; }
        }
      `}</style>
    </footer>
  );
}

Object.assign(window, { Portfolio, Artists, Services, Promo, Reviews, Studio, ClosingCTA, Footer });
