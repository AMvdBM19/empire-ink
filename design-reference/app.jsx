// Empire Ink — main app composition
// Mounts <App /> into #app, manages lang + scroll state

const { useState: useStateA, useEffect: useEffectA } = React;

function App() {
  const [lang, setLang] = useStateA("nl");
  const [scrolled, setScrolled] = useStateA(false);

  useEffectA(() => {
    const onScroll = () => setScrolled(window.scrollY > 30);
    onScroll();
    window.addEventListener("scroll", onScroll, { passive: true });
    return () => window.removeEventListener("scroll", onScroll);
  }, []);

  useEffectA(() => {
    document.documentElement.lang = lang;
  }, [lang]);

  const t = COPY[lang];

  return (
    <React.Fragment>
      <TopStrip t={t} />
      <Nav t={t} lang={lang} setLang={setLang} scrolled={scrolled} />
      <main>
        <Hero t={t} />
        <ProofStrip t={t} />
        <Portfolio t={t} />
        <Artists t={t} />
        <Services t={t} />
        <Promo t={t} />
        <Reviews t={t} />
        <Studio t={t} />
        <ClosingCTA t={t} />
      </main>
      <Footer t={t} />
    </React.Fragment>
  );
}

const root = ReactDOM.createRoot(document.getElementById("app"));
root.render(<App />);
