// Empire Ink — section components
// Reads from window.COPY[lang] and window.EMPIRE_ASSETS

const { useState, useEffect, useRef, useMemo } = React;

/* ---------- Icons (inline SVG, minimal) ---------- */
const Icon = {
  star: (p) => (<svg viewBox="0 0 24 24" width={p.size||14} height={p.size||14} fill="currentColor"><path d="M12 2l2.95 6.36L22 9.27l-5 4.87L18.18 22 12 18.27 5.82 22 7 14.14 2 9.27l7.05-.91L12 2z"/></svg>),
  arrow: (p) => (<svg viewBox="0 0 24 24" width={p.size||14} height={p.size||14} fill="none" stroke="currentColor" strokeWidth="2"><path d="M5 12h14M13 6l6 6-6 6"/></svg>),
  chevR: (p) => (<svg viewBox="0 0 24 24" width={p.size||16} height={p.size||16} fill="none" stroke="currentColor" strokeWidth="1.8"><path d="M9 6l6 6-6 6"/></svg>),
  chevL: (p) => (<svg viewBox="0 0 24 24" width={p.size||16} height={p.size||16} fill="none" stroke="currentColor" strokeWidth="1.8"><path d="M15 6l-6 6 6 6"/></svg>),
  clock: (p) => (<svg viewBox="0 0 24 24" width={p.size||16} height={p.size||16} fill="none" stroke="currentColor" strokeWidth="1.6"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg>),
  shield: (p) => (<svg viewBox="0 0 24 24" width={p.size||16} height={p.size||16} fill="none" stroke="currentColor" strokeWidth="1.6"><path d="M12 3l8 3v6c0 5-4 8-8 9-4-1-8-4-8-9V6l8-3z"/><path d="M9 12l2 2 4-4"/></svg>),
  square: (p) => (<svg viewBox="0 0 24 24" width={p.size||16} height={p.size||16} fill="none" stroke="currentColor" strokeWidth="1.6"><rect x="4" y="4" width="16" height="16"/><path d="M4 9h16M9 4v16"/></svg>),
  phone: (p) => (<svg viewBox="0 0 24 24" width={p.size||16} height={p.size||16} fill="none" stroke="currentColor" strokeWidth="1.6"><path d="M5 4h4l2 5-2.5 1.5a11 11 0 005 5L15 13l5 2v4a2 2 0 01-2 2A15 15 0 013 6a2 2 0 012-2z"/></svg>),
  pin: (p) => (<svg viewBox="0 0 24 24" width={p.size||16} height={p.size||16} fill="none" stroke="currentColor" strokeWidth="1.6"><path d="M12 22s-7-7.5-7-12a7 7 0 1114 0c0 4.5-7 12-7 12z"/><circle cx="12" cy="10" r="2.5"/></svg>),
  ig: (p) => (<svg viewBox="0 0 24 24" width={p.size||18} height={p.size||18} fill="none" stroke="currentColor" strokeWidth="1.5"><rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1" fill="currentColor"/></svg>),
  fb: (p) => (<svg viewBox="0 0 24 24" width={p.size||18} height={p.size||18} fill="currentColor"><path d="M13.5 21v-7.5h2.5l.5-3h-3V8.5c0-.9.3-1.5 1.6-1.5H17V4.2c-.3 0-1.3-.1-2.5-.1-2.5 0-4 1.5-4 4.2V10.5H8v3h2.5V21z"/></svg>),
  ws: (p) => (<svg viewBox="0 0 24 24" width={p.size||18} height={p.size||18} fill="currentColor"><path d="M12 2a10 10 0 00-8.6 15L2 22l5.1-1.3A10 10 0 1012 2zm5.6 14.4c-.2.7-1.4 1.3-2 1.4-.5.1-1.1.1-1.8-.1-.4-.1-1-.3-1.7-.6-3-1.3-5-4.3-5.1-4.5-.1-.2-1.2-1.7-1.2-3.2 0-1.5.8-2.3 1.1-2.6.3-.3.6-.4.8-.4h.6c.2 0 .5 0 .7.5l1 2.4c.1.2.2.4 0 .7-.1.2-.2.3-.4.5-.2.2-.4.4-.5.6-.2.2-.3.4-.1.7.2.4.9 1.5 2 2.4 1.4 1.2 2.5 1.6 2.9 1.7.4.1.6.1.8-.1.2-.2.9-1.1 1.2-1.4.2-.3.4-.3.7-.2.3.1 2 .9 2.3 1.1.3.2.6.3.7.4.1.2.1 1-.2 1.7z"/></svg>),
};

/* ---------- Top Strip ---------- */
function TopStrip({ t }) {
  return (
    <div style={{ background: "var(--ink-0)", borderBottom: "1px solid var(--hair)", position: "relative", zIndex: 50 }}>
      <div className="wrap" style={{ height: 36, display: "flex", alignItems: "center", justifyContent: "space-between", fontSize: 11, letterSpacing: "0.18em", textTransform: "uppercase", color: "var(--bone-dim)" }}>
        <div style={{ display: "flex", gap: 22, alignItems: "center" }}>
          <span style={{ display: "inline-flex", alignItems: "center", gap: 8 }}>
            <span style={{ width: 6, height: 6, borderRadius: "50%", background: "#7adf8b", boxShadow: "0 0 8px rgba(122,223,139,0.6)" }} />
            {t.topStrip.open}
          </span>
          <span className="hide-sm">{t.topStrip.walkin}</span>
          <span className="hide-sm" style={{ opacity: 0.5 }}>{t.topStrip.addr}</span>
        </div>
        <div style={{ display: "flex", alignItems: "center", gap: 8, color: "var(--gold-3)" }}>
          <Icon.star size={12} />
          <span>{t.topStrip.rating}</span>
        </div>
      </div>
      <style>{`@media (max-width: 760px) { .hide-sm { display: none !important; } }`}</style>
    </div>
  );
}

/* ---------- Mobile menu drawer ---------- */
function MobileMenu({ open, onClose, t, lang, setLang }) {
  useEffect(() => {
    if (open) document.body.style.overflow = "hidden";
    else document.body.style.overflow = "";
    return () => { document.body.style.overflow = ""; };
  }, [open]);

  return (
    <div style={{
      position: "fixed", inset: 0, zIndex: 100,
      pointerEvents: open ? "auto" : "none",
    }}>
      {/* Scrim */}
      <div onClick={onClose} style={{
        position: "absolute", inset: 0,
        background: "rgba(7,6,10,0.7)",
        backdropFilter: "blur(10px)",
        WebkitBackdropFilter: "blur(10px)",
        opacity: open ? 1 : 0,
        transition: "opacity .35s",
      }} />
      {/* Panel */}
      <aside style={{
        position: "absolute", top: 0, right: 0, bottom: 0,
        width: "min(440px, 100vw)",
        background: "linear-gradient(180deg, var(--ink-1) 0%, var(--ink-0) 100%)",
        borderLeft: "1px solid var(--hair-strong)",
        transform: open ? "translateX(0)" : "translateX(100%)",
        transition: "transform .5s cubic-bezier(.2,.8,.2,1)",
        display: "flex", flexDirection: "column",
        padding: "28px 28px 36px",
        overflowY: "auto",
        boxShadow: "-30px 0 60px -20px rgba(0,0,0,0.6)",
      }}>
        <div style={{ display: "flex", justifyContent: "space-between", alignItems: "center", marginBottom: 36 }}>
          <a href="#top" onClick={onClose} style={{ display: "flex", alignItems: "center", gap: 12, textDecoration: "none", color: "var(--bone)" }}>
            <img src={EMPIRE_ASSETS.logoIcon} alt="" style={{ height: 30, width: 30 }} />
            <div className="display" style={{ fontSize: 18, letterSpacing: "0.04em" }}>EMPIRE <span style={{ color: "var(--gold-3)" }}>INK</span></div>
          </a>
          <button onClick={onClose} aria-label="Close menu" style={{
            width: 42, height: 42, borderRadius: "50%",
            border: "1px solid var(--hair-strong)",
            background: "transparent", color: "var(--bone)",
            cursor: "pointer", display: "flex", alignItems: "center", justifyContent: "center",
          }}>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2"><path d="M6 6l12 12M18 6L6 18"/></svg>
          </button>
        </div>

        <nav style={{ display: "flex", flexDirection: "column", flex: 1 }}>
          {t.nav.items.map((it, i) => (
            <a key={it.id} href={`#${it.id}`} onClick={onClose} style={{
              display: "flex", alignItems: "baseline", gap: 18,
              padding: "16px 0",
              borderBottom: "1px solid var(--hair)",
              textDecoration: "none",
              color: "var(--bone)",
              transition: "color .25s, transform .25s",
            }}
            onMouseEnter={(e) => { e.currentTarget.style.color = "var(--gold-3)"; e.currentTarget.style.transform = "translateX(4px)"; }}
            onMouseLeave={(e) => { e.currentTarget.style.color = "var(--bone)"; e.currentTarget.style.transform = "translateX(0)"; }}>
              <span className="label-mono" style={{ color: "var(--gold-3)", fontSize: 10, width: 22, flexShrink: 0 }}>0{i+1}</span>
              <span className="display" style={{ fontSize: 28, fontWeight: 500, lineHeight: 1.1 }}>{it.label}</span>
            </a>
          ))}
        </nav>

        <div style={{ marginTop: 28, display: "flex", flexDirection: "column", gap: 20 }}>
          <div style={{ display: "flex", alignItems: "center", gap: 4 }}>
            <span className="label-mono" style={{ color: "var(--mute)", marginRight: 14 }}>Lang</span>
            <button onClick={() => setLang("nl")} style={{ background: "none", border: "none", cursor: "pointer", padding: "6px 10px", color: lang === "nl" ? "var(--gold-3)" : "var(--mute)", fontWeight: lang === "nl" ? 700 : 500, fontFamily: "inherit", letterSpacing: "0.18em", fontSize: 12 }}>NL</button>
            <span style={{ color: "var(--mute-2)" }}>|</span>
            <button onClick={() => setLang("en")} style={{ background: "none", border: "none", cursor: "pointer", padding: "6px 10px", color: lang === "en" ? "var(--gold-3)" : "var(--mute)", fontWeight: lang === "en" ? 700 : 500, fontFamily: "inherit", letterSpacing: "0.18em", fontSize: 12 }}>EN</button>
          </div>
          <a href="#contact" onClick={onClose} className="btn btn-gold btn-arrow" style={{ justifyContent: "center" }}>{t.nav.cta}<Icon.arrow /></a>
          <div style={{ marginTop: 8, paddingTop: 22, borderTop: "1px solid var(--hair)", display: "flex", flexDirection: "column", gap: 10 }}>
            <div className="label-mono" style={{ color: "var(--mute)" }}>{t.studio.addrLabel}</div>
            <div style={{ color: "var(--bone-dim)", fontSize: 14, lineHeight: 1.5 }}>Van Meekerenstraat 162<br/>3074 NP Rotterdam</div>
            <a href="tel:+31103335353" style={{ color: "var(--gold-3)", textDecoration: "none", fontSize: 14, marginTop: 4, display: "inline-flex", alignItems: "center", gap: 8 }}>
              <Icon.phone size={13} />010 33 353 53
            </a>
          </div>
        </div>
      </aside>
    </div>
  );
}

/* ---------- Nav ---------- */
function Nav({ t, lang, setLang, scrolled }) {
  const [menuOpen, setMenuOpen] = useState(false);

  return (
    <header style={{
      position: "sticky",
      top: 0,
      zIndex: 40,
      background: scrolled ? "rgba(13,11,9,0.85)" : "rgba(13,11,9,0.0)",
      backdropFilter: scrolled ? "blur(14px) saturate(140%)" : "none",
      WebkitBackdropFilter: scrolled ? "blur(14px) saturate(140%)" : "none",
      borderBottom: scrolled ? "1px solid var(--hair)" : "1px solid transparent",
      transition: "all .35s cubic-bezier(.2,.7,.2,1)",
    }}>
      <div className="wrap nav-row" style={{
        display: "grid",
        gridTemplateColumns: "auto 1fr auto",
        alignItems: "center",
        gap: 24,
        height: scrolled ? 68 : 84,
        transition: "height .3s",
      }}>
        {/* Logo */}
        <a href="#top" style={{ display: "flex", alignItems: "center", gap: 12, textDecoration: "none", color: "var(--bone)" }}>
          <img src={EMPIRE_ASSETS.logoIcon} alt="Empire INK" className="nav-logo-img"
            style={{ height: 36, width: 36, objectFit: "contain", filter: "drop-shadow(0 0 8px rgba(212,168,90,0.15))" }} />
          <div style={{ lineHeight: 1 }}>
            <div className="display nav-logo-word" style={{ fontSize: 22, letterSpacing: "0.04em" }}>EMPIRE <span style={{ color: "var(--gold-3)" }}>INK</span></div>
            <div className="label-mono nav-logo-sub" style={{ fontSize: 9, color: "var(--mute)", marginTop: 2 }}>ROTTERDAM · EST 2017</div>
          </div>
        </a>

        {/* Nav items - desktop only */}
        <nav className="hide-md" style={{ display: "flex", justifyContent: "center", gap: 28, flexWrap: "nowrap" }}>
          {t.nav.items.map((it) => (
            <a key={it.id} href={`#${it.id}`} style={{
              fontSize: 12,
              fontWeight: 500,
              letterSpacing: "0.16em",
              textTransform: "uppercase",
              color: "var(--bone-dim)",
              textDecoration: "none",
              padding: "8px 0",
              whiteSpace: "nowrap",
              transition: "color .25s",
            }}
            onMouseEnter={(e) => e.currentTarget.style.color = "var(--gold-3)"}
            onMouseLeave={(e) => e.currentTarget.style.color = "var(--bone-dim)"}
            >{it.label}</a>
          ))}
        </nav>

        {/* Right cluster: desktop = lang + CTA, mobile = CTA + hamburger */}
        <div style={{ display: "flex", alignItems: "center", gap: 14 }}>
          <div className="hide-md" style={{ display: "flex", alignItems: "center", fontSize: 12, fontWeight: 500, letterSpacing: "0.18em", color: "var(--mute)" }}>
            <button onClick={() => setLang("nl")} style={{ background: "none", border: "none", cursor: "pointer", padding: "4px 6px", color: lang === "nl" ? "var(--gold-3)" : "var(--mute)", fontFamily: "inherit", fontSize: "inherit", fontWeight: lang === "nl" ? 700 : 500, letterSpacing: "inherit" }}>NL</button>
            <span style={{ color: "var(--mute-2)" }}>|</span>
            <button onClick={() => setLang("en")} style={{ background: "none", border: "none", cursor: "pointer", padding: "4px 6px", color: lang === "en" ? "var(--gold-3)" : "var(--mute)", fontFamily: "inherit", fontSize: "inherit", fontWeight: lang === "en" ? 700 : 500, letterSpacing: "inherit" }}>EN</button>
          </div>
          <a href="#contact" className="btn btn-gold nav-cta">{t.nav.cta}<Icon.arrow /></a>
          <button onClick={() => setMenuOpen(true)} aria-label="Open menu" className="hamburger show-md" style={{
            width: 44, height: 44, borderRadius: "50%",
            border: "1px solid var(--hair-strong)",
            background: "transparent", color: "var(--bone)",
            cursor: "pointer", display: "none",
            alignItems: "center", justifyContent: "center",
            flexShrink: 0,
            transition: "border-color .25s, color .25s",
          }}
          onMouseEnter={(e) => { e.currentTarget.style.borderColor = "var(--gold-2)"; e.currentTarget.style.color = "var(--gold-3)"; }}
          onMouseLeave={(e) => { e.currentTarget.style.borderColor = "var(--hair-strong)"; e.currentTarget.style.color = "var(--bone)"; }}>
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.8"><path d="M4 7h16M4 12h16M4 17h16"/></svg>
          </button>
        </div>
      </div>

      <MobileMenu open={menuOpen} onClose={() => setMenuOpen(false)} t={t} lang={lang} setLang={setLang} />

      <style>{`
        @media (max-width: 1100px) {
          .hide-md { display: none !important; }
          .show-md { display: flex !important; }
        }
        @media (max-width: 640px) {
          .nav-logo-sub { display: none; }
          .nav-logo-word { font-size: 18px !important; }
          .nav-logo-img { height: 30px !important; width: 30px !important; }
          .nav-cta { padding: 11px 16px !important; font-size: 11px !important; letter-spacing: 0.14em !important; }
        }
        @media (max-width: 420px) {
          .nav-cta { display: none !important; }
        }
      `}</style>
    </header>
  );
}

/* ---------- Hero ---------- */
function Hero({ t }) {
  return (
    <section id="top" style={{ position: "relative", minHeight: "min(92vh, 860px)", display: "flex", flexDirection: "column", justifyContent: "flex-end", overflow: "hidden" }}>
      {/* Background image */}
      <div style={{ position: "absolute", inset: 0, zIndex: 0 }}>
        <img src={EMPIRE_ASSETS.heroBack} alt="" className="asset"
          style={{ width: "100%", height: "100%", objectFit: "cover", animation: "slowZoom 18s ease-out both", filter: "saturate(0.85) contrast(1.05)" }} />
        {/* Gradient overlays */}
        <div style={{ position: "absolute", inset: 0, background: "linear-gradient(180deg, rgba(13,11,9,0.55) 0%, rgba(13,11,9,0.2) 35%, rgba(13,11,9,0.6) 75%, rgba(13,11,9,0.98) 100%)" }} />
        <div style={{ position: "absolute", inset: 0, background: "linear-gradient(90deg, rgba(13,11,9,0.85) 0%, rgba(13,11,9,0.35) 45%, transparent 75%)" }} />
        {/* Vignette */}
        <div style={{ position: "absolute", inset: 0, background: "radial-gradient(ellipse 80% 60% at 50% 50%, transparent 40%, rgba(7,6,10,0.7) 100%)" }} />
      </div>

      {/* Side rail */}
      <div className="hide-sm" style={{ position: "absolute", left: 24, top: "50%", transform: "translateY(-50%) rotate(-90deg)", transformOrigin: "left center", zIndex: 5, display: "flex", gap: 18, alignItems: "center", fontSize: 10, letterSpacing: "0.35em", color: "var(--mute)", textTransform: "uppercase" }}>
        <span>Instagram</span>
        <span>·</span>
        <span>@empire.ink.rotterdam</span>
      </div>

      <div className="wrap reveal" style={{ position: "relative", zIndex: 5, paddingBottom: "clamp(50px, 7vw, 80px)", paddingTop: "clamp(60px, 9vw, 100px)" }}>
        <div className="eyebrow" style={{ marginBottom: 28, display: "flex", alignItems: "center", gap: 14 }}>
          <span style={{ width: 28, height: 1, background: "var(--gold-2)" }} />
          {t.hero.eyebrow}
        </div>

        <h1 className="display" style={{
          fontSize: "clamp(64px, 11vw, 180px)",
          margin: 0,
          fontWeight: 500,
          letterSpacing: "-0.015em",
          maxWidth: 1100,
        }}>
          {(() => {
            // title1 has the accent word, wrap it in serif italic gold
            const parts = t.hero.title1.split(t.hero.titleAccent);
            return (
              <>
                {parts[0]}
                <span style={{
                  fontFamily: "var(--font-serif)",
                  fontStyle: "italic",
                  fontWeight: 400,
                  textTransform: "none",
                  background: "var(--gold-grad)",
                  WebkitBackgroundClip: "text",
                  WebkitTextFillColor: "transparent",
                  backgroundClip: "text",
                  paddingRight: 8,
                }}>{t.hero.titleAccent}</span>
                {parts[1] || ""}
              </>
            );
          })()}<br/>
          <span style={{ color: "var(--bone)" }}>{t.hero.title2}</span>
        </h1>

        <p className="hero-sub" style={{ marginTop: 32, maxWidth: 540, fontSize: 17, lineHeight: 1.55, color: "var(--bone-dim)" }}>
          {t.hero.sub}
        </p>

        <div className="hero-ctas" style={{ display: "flex", gap: 14, marginTop: 40, flexWrap: "wrap" }}>
          <a href="#contact" className="btn btn-gold btn-arrow">{t.hero.primary}<Icon.arrow /></a>
          <a href="#portfolio" className="btn btn-ghost btn-arrow">{t.hero.secondary}<Icon.arrow /></a>
        </div>
      </div>

      {/* Scroll indicator */}
      <div style={{ position: "absolute", bottom: 32, right: 48, zIndex: 5, display: "flex", flexDirection: "column", alignItems: "center", gap: 12 }} className="hide-sm">
        <span style={{ fontSize: 10, letterSpacing: "0.3em", color: "var(--mute)", textTransform: "uppercase", writingMode: "vertical-rl" }}>{t.hero.scroll}</span>
        <span style={{ width: 1, height: 60, background: "linear-gradient(180deg, var(--gold-2), transparent)" }} />
      </div>
    </section>
  );
}

/* ---------- Social proof strip ---------- */
function ProofStrip({ t }) {
  const iconMap = { star: <Icon.star size={18} />, square: <Icon.square size={18} />, clock: <Icon.clock size={18} />, shield: <Icon.shield size={18} /> };
  return (
    <section style={{ background: "var(--ink-0)", borderTop: "1px solid var(--hair)", borderBottom: "1px solid var(--hair)" }}>
      <div className="wrap" style={{ display: "grid", gridTemplateColumns: "repeat(4, 1fr)", gap: 0 }}>
        {t.proof.map((p, i) => (
          <div key={i} style={{
            padding: "36px 32px",
            borderLeft: i === 0 ? "none" : "1px solid var(--hair)",
            display: "flex",
            alignItems: "center",
            gap: 18,
          }} className="proof-cell">
            <div style={{ color: "var(--gold-3)", flexShrink: 0 }}>{iconMap[p.icon]}</div>
            <div>
              <div className="display" style={{ fontSize: 28, fontWeight: 600, lineHeight: 1, color: "var(--bone)" }}>{p.v}</div>
              <div style={{ fontSize: 11, letterSpacing: "0.18em", textTransform: "uppercase", color: "var(--mute)", marginTop: 6 }}>{p.l}</div>
            </div>
          </div>
        ))}
      </div>
      <style>{`
        @media (max-width: 900px) {
          .proof-cell { padding: 22px 18px !important; }
          .proof-cell .display { font-size: 22px !important; }
        }
        @media (max-width: 640px) {
          section > .wrap { grid-template-columns: repeat(2, 1fr) !important; }
          .proof-cell:nth-child(2) { border-left: 1px solid var(--hair) !important; }
          .proof-cell:nth-child(3) { border-left: none !important; border-top: 1px solid var(--hair) !important; }
          .proof-cell:nth-child(4) { border-top: 1px solid var(--hair) !important; }
        }
      `}</style>
    </section>
  );
}

Object.assign(window, { Icon, TopStrip, Nav, Hero, ProofStrip });
