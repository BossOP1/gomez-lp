<?php
/**
 * Interventional Psychiatry of Arizona — Landing Page
 * Single-file marketing page. Tailwind CSS (CDN) + vanilla JS.
 */
$PHONE_DISPLAY = '(602) 824-8404';
$PHONE_LINK    = '+16028248404';
$ADDRESS_L1    = '2929 E Camelback Rd #119';
$ADDRESS_L2    = 'Phoenix, AZ 85016';
$YEAR          = date('Y');
$MAPS_QUERY    = urlencode($ADDRESS_L1 . ', ' . $ADDRESS_L2);
$GOOGLE_PROFILE = 'https://maps.app.goo.gl/4DGBt44Sru7zcEqH7';
$FORM_ENDPOINT  = 'https://app.formester.com/forms/RHUbxZYz6/submissions';

/* ─── IMAGERY ────────────────────────────────────────────────────────────────
 * Every photo slot on the page is declared once, here.
 *
 * Each entry falls back to a licensed stock placeholder, but as soon as a real
 * file exists at assets/img/<file> it is used instead — no markup changes
 * needed. Replace them with the practice's own photography when available.
 * See assets/img/README.md for the slot list and recommended dimensions.
 */
$IMG_DIR = 'assets/img';

/* Brand lockup. The supplied artwork is white, for dark backgrounds; the dark
   variant is the same lockup recoloured for the light nav. */
$asset = function (string $rel) use ($IMG_DIR): string {
  $p = $IMG_DIR . '/' . $rel;
  return is_file(__DIR__ . '/' . $p) ? $p . '?v=' . filemtime(__DIR__ . '/' . $p) : $p;
};
$LOGO_LIGHT = $asset('interpsychaz-logo.webp');       // white — dark backgrounds
$LOGO_DARK  = $asset('interpsychaz-logo-dark.webp');  // indigo — light backgrounds

$IMG = [
  'hero'      => ['file'=>'ambience/hero-bg-inter.webp', 'id'=>'photo-1524758631624-e2822e304c36', 'alt'=>'Illustration of neurons firing across a synapse'],
  'tms'       => ['file'=>'ambience/inter-a-2.webp', 'id'=>'photo-1666214280557-f1b5022eb634', 'alt'=>'Magstim TMS chair and stimulator in our treatment room'],
  'ketamine'  => ['file'=>'ambience/inter-a-1.webp', 'id'=>'photo-1512678080530-7760d81faba6', 'alt'=>'Our monitoring room, with recliners, vitals equipment and privacy screens'],
  'meds'      => ['file'=>'medication.jpg',  'id'=>'photo-1563213126-a4273aed2016', 'alt'=>'A weekly pill organiser being filled, one compartment at a time'],
  'therapy'   => ['file'=>'psychotherapy.jpg','id'=>'photo-1573497491208-6b1acb260507', 'alt'=>'Two people in conversation during a therapy session'],
  'care'      => ['file'=>'care.jpg',        'id'=>'photo-1584515933487-779824d29309', 'alt'=>'Two people holding hands in a moment of support'],
  'why'       => ['file'=>'ambience/why-patient-trust-us.webp', 'id'=>'photo-1519494026892-80bbd2d6fd0d', 'alt'=>'A clinician positioning the TMS coil for a patient during treatment'],
];

/** Resolve a slot to a URL — local file wins, stock placeholder otherwise. */
$img = function (string $key, int $w = 1200) use ($IMG, $IMG_DIR): string {
  if (!isset($IMG[$key])) return '';
  $local = $IMG_DIR . '/' . $IMG[$key]['file'];
  if (is_file(__DIR__ . '/' . $local)) return $local . '?v=' . filemtime(__DIR__ . '/' . $local);
  return 'https://images.unsplash.com/' . $IMG[$key]['id'] . '?auto=format&fit=crop&w=' . $w . '&q=70';
};
$alt = fn(string $key): string => $IMG[$key]['alt'] ?? '';


/** Absolute URL, for meta tags that scrapers can't resolve relatively. */
$absolute = function (string $path): string {
  if (str_starts_with($path, 'http')) return $path;
  $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
  $host   = $_SERVER['HTTP_HOST'] ?? 'interpsychaz.com';
  return $scheme . '://' . $host . '/' . ltrim($path, '/');
};

?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-7TQS8BS5C3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-7TQS8BS5C3');
  gtag('config', 'AW-11337249981');
</script>

<title>Interventional Psychiatry of Arizona | TMS &amp; Ketamine Therapy in Phoenix</title>
<meta name="description" content="Advanced, evidence-based psychiatric care in Phoenix, AZ. Medication management, TMS therapy, ketamine therapy and psychotherapy for treatment-resistant depression, PTSD, anxiety and more. Most insurances accepted.">
<meta property="og:title" content="Interventional Psychiatry of Arizona">
<meta property="og:description" content="When medication alone hasn't worked, there is more we can do. TMS and ketamine therapy in Phoenix, AZ.">
<meta property="og:type" content="website">
<meta property="og:image" content="<?= $absolute($img('hero', 1200)) ?>">
<meta name="twitter:card" content="summary_large_image">

<link rel="icon" type="image/png" sizes="32x32" href="<?= $asset('favicon-32.png') ?>">
<link rel="apple-touch-icon" href="<?= $asset('favicon-180.png') ?>">
<meta name="theme-color" content="#262858">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="preconnect" href="https://images.unsplash.com" crossorigin>
<link rel="preload" as="image" href="<?= $img('hero', 2000) ?>" fetchpriority="high">
<link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,300;9..144,400;9..144,500;9..144,600&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<script src="https://cdn.tailwindcss.com"></script>
<script>
tailwind.config = {
  theme: {
    extend: {
      colors: {
        ink:    '#1E1F42',
        /* Primary — #4B4D97 at 600, darker steps stay in the same indigo family */
        brand:  { 950:'#262858', 900:'#31336E', 800:'#3C3E84', 700:'#444690', 600:'#4B4D97', 500:'#7476BC', 200:'#C9CAE6' },
        /* Accent — built around #EF7136 */
        accent: { 50:'#FDF1E9', 200:'#FAD2B8', 400:'#F5975F', 500:'#EF7136', 600:'#C24E12' },
        cream:  '#FBF9F6',
        sand:   '#EFEDE7',
      },
      fontFamily: {
        display: ['Fraunces', 'ui-serif', 'Georgia', 'serif'],
        sans:    ['Inter', 'ui-sans-serif', 'system-ui', 'sans-serif'],
      },
      letterSpacing: { tightest: '-0.045em' },
      maxWidth: { '8xl': '88rem' },
    }
  }
}
</script>

<style>
  body { -webkit-font-smoothing: antialiased; }

  /* Soft film grain over the dark hero so the gradients don't band */
  .grain::after{
    content:''; position:absolute; inset:0; pointer-events:none; opacity:.22; mix-blend-mode:overlay;
    background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='240' height='240'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.85' numOctaves='3'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E");
  }

  /* ── Header ──────────────────────────────────────────────────────────────
     Transparent while it floats over the hero photo, solid cream once the page
     scrolls past it. Children recolour off the header's data-state so the
     markup stays free of duplicate class sets. */
  #nav{ transition: background-color .35s ease, border-color .35s ease, backdrop-filter .35s ease; }
  #nav[data-state="top"]{ background:transparent; border-color:transparent; backdrop-filter:none; box-shadow:none; }
  #nav[data-state="top"] .nav-link{ color:rgba(251,249,246,.80); }
  #nav[data-state="top"] .nav-link:hover{ background:rgba(255,255,255,.10); color:#FBF9F6; }
  #nav[data-state="top"] .nav-phone{ color:#FBF9F6; }
  #nav[data-state="top"] .nav-phone:hover{ color:#F5975F; }
  #nav[data-state="top"] .nav-cta{ background:#EF7136; color:#fff; }
  #nav[data-state="top"] .nav-cta:hover{ background:#C24E12; }
  #nav[data-state="top"] .nav-burger{ color:#FBF9F6; border-color:rgba(255,255,255,.28); }
  #nav[data-state="top"] .nav-drawer{ border-color:rgba(255,255,255,.15); }

  /* Logo lockups cross-fade with the header state */
  .nav-logo{ transition:opacity .35s ease; }
  #nav[data-state="top"] .nav-logo-dark{ opacity:0; }
  #nav[data-state="top"] .nav-logo-light{ opacity:1; }
  .nav-logo-light{ opacity:0; }

  /* Scroll reveal */
  .reveal { opacity:0; transform:translateY(22px); transition:opacity .8s cubic-bezier(.2,.7,.2,1), transform .8s cubic-bezier(.2,.7,.2,1); }
  .reveal.in { opacity:1; transform:none; }

  /* ── Glass consult card ──────────────────────────────────────────────────
     Frosted panel over the hero artwork: a light gradient sheet for the glass
     itself, a tinted base so type stays legible over the bright parts of the
     image, and an inset top highlight for the lit-edge look. */
  .glass{
    background: linear-gradient(160deg, rgba(255,255,255,.14), rgba(255,255,255,.05)), rgba(38,40,88,.50);
    backdrop-filter: blur(22px) saturate(150%);
    -webkit-backdrop-filter: blur(22px) saturate(150%);
    border: 1px solid rgba(255,255,255,.18);
    box-shadow: 0 30px 70px -25px rgba(8,10,35,.75), inset 0 1px 0 rgba(255,255,255,.25);
  }
  @supports not ((backdrop-filter: blur(1px)) or (-webkit-backdrop-filter: blur(1px))){
    .glass{ background: rgba(38,40,88,.92); }
  }

  .glass-field{
    background: rgba(255,255,255,.08);
    border: 1px solid rgba(255,255,255,.16);
    color: #FBF9F6;
    transition: background-color .2s, border-color .2s, box-shadow .2s;
  }
  .glass-field::placeholder{ color: rgba(251,249,246,.46); }
  .glass-field:hover{ border-color: rgba(255,255,255,.26); }
  .glass-field:focus{
    background: rgba(255,255,255,.13);
    border-color: #EF7136;
    box-shadow: 0 0 0 3px rgba(239,113,54,.22);
  }
  /* Native dropdown panels don't inherit the glass — set them explicitly or the
     options render cream-on-white. */
  .glass-field option{ color:#1E1F42; background:#FBF9F6; }
  /* Keep browser autofill from painting a solid block over the glass */
  .glass-field:-webkit-autofill,
  .glass-field:-webkit-autofill:focus{
    -webkit-text-fill-color: #FBF9F6;
    -webkit-box-shadow: 0 0 0 1000px rgba(72,74,120,.55) inset;
    transition: background-color 9999s ease-in-out 0s;
  }

  /* Testimonial slider */
  .slider{ scrollbar-width:none; -ms-overflow-style:none; }
  .slider::-webkit-scrollbar{ display:none; }
  .quote{ display:-webkit-box; -webkit-box-orient:vertical; -webkit-line-clamp:9; overflow:hidden; }
  .q-open .quote{ -webkit-line-clamp:unset; }
  .q-more{ display:none; }
  .q-clamped .q-more{ display:inline-flex; }

  /* FAQ accordion */
  .faq-body { display:grid; grid-template-rows:0fr; transition:grid-template-rows .35s cubic-bezier(.2,.7,.2,1); }
  .faq.open .faq-body { grid-template-rows:1fr; }
  .faq-body > div { overflow:hidden; }
  .faq.open .faq-icon { transform:rotate(45deg); }

  @media (prefers-reduced-motion: reduce){
    .reveal{opacity:1;transform:none;transition:none}
    .animate-ping{animation:none}
  }
</style>
</head>

<body class="bg-cream text-ink font-sans antialiased selection:bg-accent-200 selection:text-brand-900">

<!-- ══════════════════ TOP BAR ══════════════════ -->
<div class="hidden md:block bg-brand-950 text-brand-200/80 text-[13px]">
  <div class="mx-auto max-w-8xl px-6 lg:px-10 h-10 flex items-center justify-between">
    <p class="text-white/60">Now accepting new patients &amp; telehealth appointments across Arizona</p>
    <div class="flex items-center gap-6 text-white/60">
      <span>Mon–Fri · 8am–5pm</span>
      <span class="h-3 w-px bg-white/20"></span>
      <a href="tel:<?= $PHONE_LINK ?>" class="hover:text-white transition"><?= $PHONE_DISPLAY ?></a>
    </div>
  </div>
</div>

<!-- ══════════════════ NAV ══════════════════ -->
<header id="nav" data-state="top" class="sticky top-0 z-50 transition-all duration-300 bg-cream/80 backdrop-blur-xl border-b border-black/5">
  <nav class="mx-auto max-w-8xl px-6 lg:px-10">
    <div class="h-[72px] flex items-center justify-between gap-8">

      <a href="#top" class="relative block shrink-0 h-11 sm:h-[52px] aspect-[545/228]" aria-label="Interventional Psychiatry of Arizona — home">
        <img src="<?= $LOGO_DARK ?>" alt="Interventional Psychiatry of Arizona — Building Strong Minds"
             width="545" height="228" class="nav-logo nav-logo-dark absolute inset-0 h-full w-auto">
        <img src="<?= $LOGO_LIGHT ?>" alt="" aria-hidden="true"
             width="545" height="228" class="nav-logo nav-logo-light absolute inset-0 h-full w-auto">
      </a>

      <div class="hidden lg:flex items-center gap-0.5 xl:gap-1 whitespace-nowrap text-[15px] text-brand-900/75">
        <a href="#treatments" class="nav-link px-3 py-2 rounded-lg hover:bg-sand hover:text-brand-900 transition">Treatments</a>
        <a href="#insurance"  class="nav-link px-3 py-2 rounded-lg hover:bg-sand hover:text-brand-900 transition">Insurance</a>
        <a href="#conditions" class="nav-link px-3 py-2 rounded-lg hover:bg-sand hover:text-brand-900 transition">Conditions</a>
        <a href="#process"    class="nav-link px-3 py-2 rounded-lg hover:bg-sand hover:text-brand-900 transition">How It Works</a>
        <a href="#faq"        class="nav-link px-3 py-2 rounded-lg hover:bg-sand hover:text-brand-900 transition">FAQ</a>
      </div>

      <div class="flex items-center gap-3">
        <a href="tel:<?= $PHONE_LINK ?>" class="nav-phone hidden xl:flex items-center gap-2 whitespace-nowrap text-[15px] font-medium text-brand-900 hover:text-accent-600 transition">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" class="h-4 w-4"><path d="M4 5.5C4 4.7 4.7 4 5.5 4h2c.7 0 1.3.5 1.5 1.2l.6 2.4c.1.6-.1 1.2-.6 1.5l-1.2.9a12 12 0 0 0 5.2 5.2l.9-1.2c.4-.5 1-.7 1.5-.6l2.4.6c.7.2 1.2.8 1.2 1.5v2c0 .8-.7 1.5-1.5 1.5A15.5 15.5 0 0 1 4 5.5Z"/></svg>
          <?= $PHONE_DISPLAY ?>
        </a>
        <a href="#consult" class="nav-cta inline-flex items-center gap-2 whitespace-nowrap rounded-full bg-brand-900 px-5 py-2.5 text-[14.5px] font-medium text-cream hover:bg-brand-800 transition shadow-sm hover:shadow-md">
          Book a consultation
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-3.5 w-3.5"><path d="M5 12h13M12 5l7 7-7 7"/></svg>
        </a>
        <button id="menuBtn" aria-label="Open menu" class="nav-burger lg:hidden grid place-items-center h-10 w-10 rounded-lg border border-black/10 text-brand-900">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-5 w-5"><path d="M4 7h16M4 12h16M4 17h16"/></svg>
        </button>
      </div>
    </div>

    <!-- mobile drawer -->
    <div id="mobileMenu" class="lg:hidden hidden pb-5">
      <div class="nav-drawer grid gap-1 text-[16px] text-brand-900/80 border-t border-black/5 pt-4">
        <a href="#treatments" class="nav-link px-3 py-2.5 rounded-lg hover:bg-sand">Treatments</a>
        <a href="#insurance"  class="nav-link px-3 py-2.5 rounded-lg hover:bg-sand">Insurance</a>
        <a href="#conditions" class="nav-link px-3 py-2.5 rounded-lg hover:bg-sand">Conditions</a>
        <a href="#process"    class="nav-link px-3 py-2.5 rounded-lg hover:bg-sand">How It Works</a>
        <a href="#faq"        class="nav-link px-3 py-2.5 rounded-lg hover:bg-sand">FAQ</a>
        <a href="tel:<?= $PHONE_LINK ?>" class="nav-phone px-3 py-2.5 rounded-lg font-medium text-accent-600"><?= $PHONE_DISPLAY ?></a>
      </div>
    </div>
  </nav>
</header>

<!-- ══════════════════ HERO ══════════════════ -->
<section id="top" class="relative overflow-hidden bg-brand-950 -mt-[72px] pt-[72px]">
  <!-- photographic ground: the room patients actually walk into -->
  <img src="<?= $img('hero', 2000) ?>" alt="<?= $alt('hero') ?>" fetchpriority="high" decoding="async"
       class="js-photo pointer-events-none absolute inset-0 h-full w-full object-cover">
  <!-- flat, even tint — no gradient — just enough to hold the type against the image -->
  <div class="pointer-events-none absolute inset-0 bg-brand-950/45"></div>

  <div class="relative mx-auto max-w-8xl px-6 lg:px-10 pt-10 pb-16 lg:pt-12 lg:pb-20">
    <div class="grid lg:grid-cols-12 gap-10 lg:gap-10 items-center">

      <div class="lg:col-span-6 reveal">
        <div class="inline-flex items-center gap-2.5 rounded-full border border-white/15 bg-white/5 px-4 py-1.5 text-[13px] text-cream/80 backdrop-blur">
          <span class="relative flex h-2 w-2">
            <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-accent-400 opacity-75"></span>
            <span class="relative inline-flex h-2 w-2 rounded-full bg-accent-400"></span>
          </span>
          Board-certified psychiatry · Phoenix, Arizona
        </div>

        <h1 class="mt-7 font-display text-[2.6rem] leading-[1.06] sm:text-[3.4rem] lg:text-[3.5rem] xl:text-[3.9rem] tracking-tightest text-cream font-light">
          When medication<br class="hidden sm:block"> alone hasn't worked,<br class="hidden sm:block">
          <span class="italic text-accent-400">there is more we can do.</span>
        </h1>

        <p class="mt-6 max-w-lg text-[16.5px] lg:text-[17.5px] leading-relaxed text-cream/70 font-light">
          Interventional Psychiatry of Arizona brings advanced, evidence-based treatments —
          TMS, ketamine therapy, psychotherapy and expert medication management — to people
          living with depression, PTSD and other conditions that haven't responded to standard care.
        </p>

        <div class="mt-9 flex flex-col sm:flex-row gap-3.5">
          <a href="tel:<?= $PHONE_LINK ?>" class="group inline-flex items-center justify-center gap-2.5 rounded-full bg-accent-500 px-7 py-4 text-[15.5px] font-medium text-white hover:bg-accent-600 transition shadow-lg shadow-accent-500/20">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" class="h-4 w-4"><path d="M4 5.5C4 4.7 4.7 4 5.5 4h2c.7 0 1.3.5 1.5 1.2l.6 2.4c.1.6-.1 1.2-.6 1.5l-1.2.9a12 12 0 0 0 5.2 5.2l.9-1.2c.4-.5 1-.7 1.5-.6l2.4.6c.7.2 1.2.8 1.2 1.5v2c0 .8-.7 1.5-1.5 1.5A15.5 15.5 0 0 1 4 5.5Z"/></svg>
            Call <?= $PHONE_DISPLAY ?>
          </a>
          <a href="#treatments" class="inline-flex items-center justify-center gap-2 rounded-full border border-white/20 bg-white/5 px-7 py-4 text-[15.5px] font-medium text-cream hover:bg-white/10 transition backdrop-blur">
            Explore treatments
          </a>
        </div>

        <dl class="mt-9 grid grid-cols-3 gap-6 max-w-lg border-t border-white/10 pt-7">
          <div>
            <dt class="font-display text-3xl text-cream font-light">15+</dt>
            <dd class="mt-1.5 text-[13px] leading-snug text-cream/50">Years of psychiatric practice</dd>
          </div>
          <div>
            <dt class="font-display text-3xl text-cream font-light">4</dt>
            <dd class="mt-1.5 text-[13px] leading-snug text-cream/50">Core services under one roof</dd>
          </div>
          <div>
            <dt class="font-display text-3xl text-cream font-light">Most</dt>
            <dd class="mt-1.5 text-[13px] leading-snug text-cream/50">Insurance plans accepted</dd>
          </div>
        </dl>
      </div>

      <!-- hero form -->
      <div id="consult" class="lg:col-span-6 reveal scroll-mt-28" style="transition-delay:.15s">
        <div class="relative">
          <!-- subtle glow behind the card -->
          <div class="pointer-events-none absolute -inset-4 rounded-[36px] bg-gradient-to-br from-accent-400/20 via-transparent to-brand-500/20 blur-2xl"></div>

          <form id="contactForm" action="<?= $FORM_ENDPOINT ?>" method="POST" accept-charset="UTF-8"
                class="glass relative rounded-[28px] p-7 sm:p-8">

            <div class="flex items-start justify-between gap-4">
              <div>
                <h2 class="font-display text-[27px] leading-tight tracking-tight text-cream">Book a consultation</h2>
                <p class="mt-2 text-[14.5px] leading-relaxed text-cream/60">
                  Tell us a little about what you're facing. We'll reach out within one business day.
                </p>
              </div>
              <span class="hidden sm:grid place-items-center h-11 w-11 shrink-0 rounded-2xl bg-white/10 ring-1 ring-white/15 text-accent-400">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" class="h-5 w-5"><path d="M12 3l7.5 3v5.5c0 4.4-3.1 8.2-7.5 9.5-4.4-1.3-7.5-5.1-7.5-9.5V6L12 3Z"/><path d="M9.5 12l1.8 1.8L15 10"/></svg>
              </span>
            </div>

            <div class="mt-6 grid sm:grid-cols-2 gap-3.5">
              <div>
                <label for="fname" class="block text-[12.5px] font-medium text-cream/60 mb-1.5">First name</label>
                <input id="fname" name="First name" required class="glass-field w-full rounded-xl px-4 py-3 text-[15px] outline-none" placeholder="Jane">
              </div>
              <div>
                <label for="lname" class="block text-[12.5px] font-medium text-cream/60 mb-1.5">Last name</label>
                <input id="lname" name="Last name" required class="glass-field w-full rounded-xl px-4 py-3 text-[15px] outline-none" placeholder="Doe">
              </div>
              <div>
                <label for="email" class="block text-[12.5px] font-medium text-cream/60 mb-1.5">Email</label>
                <input id="email" name="Email" type="email" required class="glass-field w-full rounded-xl px-4 py-3 text-[15px] outline-none" placeholder="you@email.com">
              </div>
              <div>
                <label for="phone" class="block text-[12.5px] font-medium text-cream/60 mb-1.5">Phone</label>
                <input id="phone" name="Phone" type="tel" class="glass-field w-full rounded-xl px-4 py-3 text-[15px] outline-none" placeholder="(602) 000-0000">
              </div>
              <div class="sm:col-span-2">
                <label for="interest" class="block text-[12.5px] font-medium text-cream/60 mb-1.5">What are you interested in?</label>
                <select id="interest" name="Interested in" class="glass-field w-full appearance-none rounded-xl px-4 py-3 text-[15px] outline-none"
                        style="background-image:url(&quot;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='none' stroke='%23FBF9F6' stroke-opacity='.6' stroke-width='2'%3E%3Cpath d='m4 6 4 4 4-4'/%3E%3C/svg%3E&quot;);background-repeat:no-repeat;background-position:right 1rem center">
                  <?php foreach (['I’m not sure yet — help me decide','Medication management','TMS Therapy','Ketamine therapy','Psychotherapy'] as $opt): ?>
                  <option><?= $opt ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="sm:col-span-2">
                <label for="msg" class="block text-[12.5px] font-medium text-cream/60 mb-1.5">Anything you'd like us to know <span class="font-normal text-cream/35">(optional)</span></label>
                <textarea id="msg" name="Message" rows="2" class="glass-field w-full rounded-xl px-4 py-3 text-[15px] outline-none resize-none" placeholder="Briefly — what you've tried, and what you're hoping to change."></textarea>
              </div>
            </div>

            <!-- Spam trap: real people never see this, bots fill it in. -->
            <div class="hidden" aria-hidden="true">
              <label>Do not fill this in <input type="text" name="company" tabindex="-1" autocomplete="off"></label>
            </div>
            <input type="hidden" name="Source" value="Landing page">

            <button type="submit" class="group mt-6 w-full inline-flex items-center justify-center gap-2.5 rounded-full bg-cream px-8 py-4 text-[15.5px] font-medium text-brand-900 hover:bg-white transition shadow-lg shadow-black/25">
              Book a consultation
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-4 w-4 transition-transform group-hover:translate-x-1"><path d="M5 12h13M12 5l7 7-7 7"/></svg>
            </button>

            <p id="formNote" class="hidden mt-4 rounded-xl border border-accent-400/30 bg-accent-500/15 px-4 py-3 text-[14px] text-cream/85"></p>

            <div class="mt-5 flex items-start gap-2.5 text-[12px] leading-relaxed text-cream/55">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" class="h-4 w-4 shrink-0 mt-px"><rect x="4.5" y="10" width="15" height="10" rx="2"/><path d="M8 10V7.5a4 4 0 0 1 8 0V10"/></svg>
              <p>Please don't include sensitive medical details. This form is not for emergencies — in a crisis, call <a href="tel:988" class="font-semibold text-accent-400 hover:underline">988</a> or 911.</p>
            </div>
          </form>
        </div>
      </div>

    </div>
  </div>

  <div class="h-16 bg-gradient-to-b from-transparent to-cream/0"></div>
</section>

<!-- ══════════════════ TRUST STRIP ══════════════════ -->
<section class="border-b border-black/5 bg-cream">
  <div class="mx-auto max-w-8xl px-6 lg:px-10 py-8">
    <div class="grid grid-cols-2 md:grid-cols-4 gap-x-6 gap-y-7">
      <?php
      $trust = [
        ['Board-certified',   'Psychiatry & interventional care'],
        ['Insurance friendly','Most major Arizona plans accepted'],
        ['Telehealth ready',  'Statewide virtual appointments'],
        ['Adults & teens',    'Adolescent services now expanding'],
      ];
      foreach ($trust as [$t, $s]): ?>
      <div class="reveal flex items-start gap-3">
        <span class="mt-1 grid place-items-center h-5 w-5 rounded-full bg-brand-900/8 text-brand-700 shrink-0">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" class="h-3 w-3"><path d="M5 13l4 4L19 7"/></svg>
        </span>
        <div>
          <p class="text-[14.5px] font-semibold text-brand-900"><?= $t ?></p>
          <p class="text-[13.5px] text-brand-900/55 mt-0.5 leading-snug"><?= $s ?></p>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ══════════════════ TREATMENTS ══════════════════ -->
<section id="treatments" class="py-16 lg:py-24">
  <div class="mx-auto max-w-8xl px-6 lg:px-10">

    <div class="max-w-3xl reveal">
      <p class="text-[12px] uppercase tracking-[0.24em] text-accent-600 font-semibold">Treatments</p>
      <h2 class="mt-5 font-display text-4xl lg:text-[3.2rem] leading-[1.08] tracking-tightest text-brand-900 font-light">
        Care that goes beyond<br class="hidden sm:block"> the prescription pad.
      </h2>
      <p class="mt-6 text-[17px] leading-relaxed text-brand-900/60 font-light">
        Careful medication work, treatments that target the brain circuits behind mood directly,
        and therapy alongside both. For many patients, the combination is what finally moves the needle.
      </p>
    </div>

    <div class="mt-16 grid sm:grid-cols-2 gap-5 lg:gap-6">
      <?php
      $treatments = [
        [
          'Medication Management',
          'Precision psychopharmacology',
          'Thoughtful, unhurried medication care from clinicians who actually have time to listen. We simplify complicated regimens, address side effects, and adjust based on how you are really doing.',
          ['In-person or virtual', 'Ongoing follow-up', 'Second opinions'],
          'M10.5 3.5a5 5 0 0 1 7 7l-7 7a5 5 0 0 1-7-7l7-7ZM7 7l7 7',
          'meds',
        ],
        [
          'TMS Therapy',
          'Transcranial Magnetic Stimulation',
          'Gentle magnetic pulses stimulate the areas of the brain that regulate mood. No anesthesia, no sedation, no systemic side effects — most patients read or listen to music and drive themselves home afterward.',
          ['~20 minute sessions', 'FDA-cleared', 'Covered by most plans'],
          'M4 14a8 8 0 0 1 16 0M7.5 14a4.5 4.5 0 0 1 9 0M12 14v6M9 20h6',
          'tms',
        ],
        [
          'Ketamine Therapy',
          'Rapid-acting treatment',
          'For depression that has not responded to standard medication, ketamine can work in days rather than weeks. Treatment is given in our office under clinical monitoring, in a calm and private setting.',
          ['Rapid onset', 'Monitored in-office', 'Ride home needed'],
          'M12 3c3 3.5 5 6.4 5 9a5 5 0 0 1-10 0c0-2.6 2-5.5 5-9Z',
          'ketamine',
        ],
        [
          'Psychotherapy',
          'Talk therapy that works with your care',
          'Structured, goal-directed therapy for depression, anxiety and trauma — coordinated with your medication plan so both sides of your treatment are informed by the same picture.',
          ['Individual sessions', 'In-person or virtual', 'Coordinated care'],
          'M4 6.5A2.5 2.5 0 0 1 6.5 4h11A2.5 2.5 0 0 1 20 6.5v7a2.5 2.5 0 0 1-2.5 2.5H9l-5 4V6.5Z',
          'therapy',
        ],
      ];
      foreach ($treatments as $i => [$title, $sub, $body, $tags, $icon, $photo]): ?>
      <article class="reveal group relative flex flex-col overflow-hidden rounded-3xl border border-black/[0.07] bg-white transition duration-300 hover:-translate-y-1 hover:shadow-xl hover:shadow-brand-900/[0.07] hover:border-brand-900/15"
               style="transition-delay:<?= $i * 60 ?>ms">

        <div class="relative aspect-[16/10]">
          <div class="absolute inset-0 overflow-hidden bg-brand-900">
            <img src="<?= $img($photo, 900) ?>" alt="<?= $alt($photo) ?>" loading="lazy" decoding="async"
                 class="js-photo h-full w-full object-cover transition duration-700 group-hover:scale-[1.04]">
            <div class="absolute inset-0 bg-gradient-to-t from-brand-950/80 via-brand-950/15 to-transparent"></div>
          </div>
          <span class="absolute top-4 right-5 font-display text-[13px] text-white/60 tabular-nums">0<?= $i + 1 ?></span>
          <!-- badge straddles the image edge, so it sits outside the clipped frame -->
          <span class="absolute -bottom-6 left-7 grid place-items-center h-12 w-12 rounded-2xl bg-white text-brand-800 shadow-lg shadow-brand-900/15 ring-1 ring-black/5 group-hover:bg-brand-900 group-hover:text-cream transition duration-300">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" class="h-5.5 w-5.5"><path d="<?= $icon ?>"/></svg>
          </span>
        </div>

        <div class="flex flex-1 flex-col p-8 pt-10">
          <h3 class="font-display text-[26px] tracking-tight text-brand-900"><?= $title ?></h3>
          <p class="mt-1 text-[13px] uppercase tracking-[0.14em] text-accent-600/80"><?= $sub ?></p>
          <p class="mt-4 text-[15px] leading-relaxed text-brand-900/60"><?= $body ?></p>

          <ul class="mt-auto flex flex-wrap gap-2 pt-6">
            <?php foreach ($tags as $tag): ?>
            <li class="rounded-full bg-sand px-3 py-1 text-[12.5px] text-brand-900/70"><?= $tag ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
      </article>
      <?php endforeach; ?>
    </div>

    <div class="reveal mt-8 flex flex-col sm:flex-row items-center justify-between gap-5 rounded-2xl border border-black/[0.07] bg-white px-7 py-6">
      <p class="text-[16px] leading-relaxed text-brand-900/65 text-center sm:text-left">
        <span class="text-brand-900 font-medium">Not sure which of these fits?</span>
        That is exactly what the first call is for.
      </p>
      <div class="flex flex-wrap items-center justify-center gap-3 shrink-0">
        <a href="#consult" class="group inline-flex items-center gap-2 rounded-full bg-brand-900 px-6 py-3 text-[14.5px] font-medium text-cream hover:bg-brand-800 transition">
          Book a consultation
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-3.5 w-3.5 transition-transform group-hover:translate-x-0.5"><path d="M5 12h13M12 5l7 7-7 7"/></svg>
        </a>
        <a href="tel:<?= $PHONE_LINK ?>" class="inline-flex items-center gap-2 rounded-full border border-black/10 px-6 py-3 text-[14.5px] font-medium text-brand-900 hover:bg-sand transition">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-4 w-4"><path d="M4 5.5C4 4.7 4.7 4 5.5 4h2c.7 0 1.3.5 1.5 1.2l.6 2.4c.1.6-.1 1.2-.6 1.5l-1.2.9a12 12 0 0 0 5.2 5.2l.9-1.2c.4-.5 1-.7 1.5-.6l2.4.6c.7.2 1.2.8 1.2 1.5v2c0 .8-.7 1.5-1.5 1.5A15.5 15.5 0 0 1 4 5.5Z"/></svg>
          <?= $PHONE_DISPLAY ?>
        </a>
      </div>
    </div>
  </div>
</section>

<!-- ══════════════════ INSURANCE ══════════════════ -->
<section id="insurance" class="py-16 lg:py-20 bg-white border-y border-black/5">
  <div class="mx-auto max-w-8xl px-6 lg:px-10">

    <div class="grid lg:grid-cols-12 gap-10 lg:gap-16 items-end reveal">
      <div class="lg:col-span-7">
        <p class="text-[12px] uppercase tracking-[0.24em] text-accent-600 font-semibold">Insurance &amp; coverage</p>
        <h2 class="mt-5 font-display text-4xl lg:text-[3rem] leading-[1.08] tracking-tightest text-brand-900 font-light">
          Chances are, we take<br class="hidden sm:block"> your plan.
        </h2>
      </div>
      <div class="lg:col-span-5">
        <p class="text-[16px] leading-relaxed text-brand-900/60 font-light">
          We're in-network with most major Arizona plans — and our team verifies your
          benefits and handles prior authorizations before treatment begins, so you know
          what a course of care costs before it starts.
        </p>
      </div>
    </div>

    <div class="mt-14 grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-3 sm:gap-4">
      <?php
      /* Carrier logos live in assets/img/insurance/. A carrier without a logo file
         still renders — as a clean wordmark tile — so the wall stays complete. */
      $insurers = [
        ['Aetna',                             'aetna.webp'],
        ['Ambetter Health',                   'ambetter.png'],
        ['Arizona Complete Health',           'arizona-complete-health.png'],
        ['Blue Cross Blue Shield of Arizona', 'bcbs-arizona.png'],
        ['Care1st Health Plan Arizona',       'care1st.png'],
        ['Cigna Healthcare',                  'cigna.png'],
        ['Curative',                          'curative.png'],
        ['Health Net',                        'health-net.png'],
        ['Humana',                            'humana.png'],
        ['Medicare',                          'medicare.png'],
        ['Mercy Care',                        'mercy-care.png'],
        ['Optum',                             'optum.png'],
        ['SCAN Health Plan',                  'scan-health-plan.png'],
        ['TRICARE For Life',                  'tricare-for-life.png'],
        ['TriWest Healthcare Alliance',       'triwest.png'],
        ['UnitedHealthcare Community Plan',   'unitedhealthcare-community-plan.png'],
        ['Wellcare By Allwell',               'wellcare-allwell.png'],
      ];
      foreach ($insurers as $i => [$carrier, $file]):
        $path  = $IMG_DIR . '/insurance/' . $file;
        $exists = is_file(__DIR__ . '/' . $path);
      ?>
      <div class="reveal group grid place-items-center h-24 sm:h-28 rounded-2xl border border-black/[0.07] bg-white px-5 transition duration-300 hover:-translate-y-0.5 hover:border-brand-900/15 hover:shadow-lg hover:shadow-brand-900/[0.06]"
           style="transition-delay:<?= min($i, 9) * 40 ?>ms">
        <?php if ($exists): ?>
        <img src="<?= $path ?>?v=<?= filemtime(__DIR__ . '/' . $path) ?>" alt="<?= $carrier ?>" loading="lazy" decoding="async"
             class="js-photo max-h-11 sm:max-h-12 max-w-[85%] w-auto object-contain opacity-90 transition duration-300 group-hover:opacity-100">
        <?php else: ?>
        <span class="text-center font-display text-[19px] leading-tight tracking-tight text-brand-900/70"><?= $carrier ?></span>
        <?php endif; ?>
      </div>
      <?php endforeach; ?>
    </div>

    <div class="reveal mt-10 flex flex-col sm:flex-row sm:items-center justify-between gap-5 rounded-2xl bg-sand/70 px-6 py-5">
      <p class="text-[14px] leading-relaxed text-brand-900/55 max-w-2xl">
        Plan participation can change, and coverage varies by plan and by treatment. We'll confirm
        exactly what your policy covers — including any authorization requirements — before anything begins.
      </p>
      <a href="tel:<?= $PHONE_LINK ?>" class="group inline-flex items-center justify-center gap-2 rounded-full bg-brand-900 px-6 py-3 text-[14.5px] font-medium text-cream hover:bg-brand-800 transition shrink-0">
        Verify my coverage
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-3.5 w-3.5 transition-transform group-hover:translate-x-0.5"><path d="M5 12h13M12 5l7 7-7 7"/></svg>
      </a>
    </div>

    <p class="mt-6 text-[11.5px] leading-relaxed text-brand-900/30 max-w-4xl">
      All carrier names and logos are the property of their respective owners and are shown solely to
      indicate plans accepted at this practice. Their use does not imply endorsement or affiliation.
    </p>
  </div>
</section>

<!-- ══════════════════ CONDITIONS ══════════════════ -->
<section id="conditions" class="relative overflow-hidden bg-brand-900 text-cream grain">
  <div class="pointer-events-none absolute -right-40 -top-20 h-[30rem] w-[30rem] rounded-full bg-brand-600/45 blur-[110px]"></div>
  <div class="relative mx-auto max-w-8xl px-6 lg:px-10 py-16 lg:py-24">
    <div class="grid lg:grid-cols-12 gap-14">

      <div class="lg:col-span-5 reveal">
        <p class="text-[12px] uppercase tracking-[0.24em] text-accent-400 font-semibold">Conditions we treat</p>
        <h2 class="mt-5 font-display text-4xl lg:text-[3.1rem] leading-[1.08] tracking-tightest font-light">
          You have probably<br> already tried a lot.
        </h2>
        <p class="mt-6 text-[16.5px] leading-relaxed text-cream/65 font-light">
          Many of the people we see have been through several medications, several
          clinicians, and several years of not feeling like themselves. That history isn't a
          dead end — it's diagnostic information, and it shapes where we go next.
        </p>
        <div class="mt-9 flex flex-col sm:flex-row gap-3.5">
          <a href="#consult" class="group inline-flex items-center justify-center gap-2.5 rounded-full bg-accent-500 px-7 py-3.5 text-[15px] font-medium text-white hover:bg-accent-600 transition shadow-lg shadow-accent-500/20">
            Book a consultation
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-4 w-4 transition-transform group-hover:translate-x-1"><path d="M5 12h13M12 5l7 7-7 7"/></svg>
          </a>
          <a href="tel:<?= $PHONE_LINK ?>" class="inline-flex items-center justify-center gap-2 rounded-full border border-white/20 bg-white/5 px-7 py-3.5 text-[15px] font-medium text-cream hover:bg-white/10 transition backdrop-blur">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-4 w-4"><path d="M4 5.5C4 4.7 4.7 4 5.5 4h2c.7 0 1.3.5 1.5 1.2l.6 2.4c.1.6-.1 1.2-.6 1.5l-1.2.9a12 12 0 0 0 5.2 5.2l.9-1.2c.4-.5 1-.7 1.5-.6l2.4.6c.7.2 1.2.8 1.2 1.5v2c0 .8-.7 1.5-1.5 1.5A15.5 15.5 0 0 1 4 5.5Z"/></svg>
            <?= $PHONE_DISPLAY ?>
          </a>
        </div>

        <figure class="mt-12 relative overflow-hidden rounded-3xl ring-1 ring-white/15">
          <img src="<?= $img('care', 1000) ?>" alt="<?= $alt('care') ?>" loading="lazy" decoding="async"
               class="js-photo aspect-[4/3] w-full object-cover">
          <div class="absolute inset-0 bg-gradient-to-t from-brand-950/85 via-brand-950/20 to-transparent"></div>
          <figcaption class="absolute inset-x-0 bottom-0 p-6 text-[14.5px] leading-relaxed text-cream/85">
            No one is turned away for having a complicated history —
            <span class="text-cream">that history is where we start.</span>
          </figcaption>
        </figure>
      </div>

      <div class="lg:col-span-7 reveal" style="transition-delay:.1s">
        <div class="grid sm:grid-cols-2 gap-x-10 gap-y-0">
          <?php
          $conditions = [
            ['Treatment-Resistant Depression', 'When two or more medications haven’t brought relief'],
            ['PTSD & Trauma',                  'Including combat, medical and complex trauma'],
            ['Anxiety Disorders',              'Generalized anxiety, panic and social anxiety'],
            ['Bipolar Disorder',               'Mood stabilization and long-term maintenance'],
            ['Schizophrenia & Psychosis',      'Including long-acting injectable management'],
            ['OCD',                            'Obsessive-compulsive and related disorders'],
            ['Insomnia',                       'Sleep disturbance driving or worsening symptoms'],
            ['Substance Use & Addiction',      'Recovery-oriented, non-judgmental care'],
            ['ADHD',                           'Assessment and treatment for adults and teens'],
            ['Geriatric Psychiatry',           'Late-life depression, cognition and complexity'],
          ];
          foreach ($conditions as $c => [$name, $desc]): ?>
          <div class="group flex items-start gap-4 border-b border-white/10 py-5 hover:border-accent-400/50 transition">
            <span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-accent-400/60 group-hover:bg-accent-400 group-hover:scale-150 transition shrink-0"></span>
            <div>
              <p class="text-[16.5px] text-cream"><?= $name ?></p>
              <p class="text-[13.5px] text-cream/45 mt-1 leading-snug"><?= $desc ?></p>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- ══════════════════ WHY US ══════════════════ -->
<section class="py-16 lg:py-24 bg-sand/60">
  <div class="mx-auto max-w-8xl px-6 lg:px-10">
    <div class="grid lg:grid-cols-12 gap-14 lg:gap-16">

      <!-- photo collage -->
      <div class="reveal lg:col-span-5">
        <div class="relative h-full">
          <figure class="relative h-full min-h-[22rem] lg:min-h-[28rem] overflow-hidden rounded-[28px] shadow-xl shadow-brand-900/10 ring-1 ring-black/5">
            <img src="<?= $img('why', 1000) ?>" alt="<?= $alt('why') ?>" loading="lazy" decoding="async"
                 class="js-photo h-full w-full object-cover object-center">
          </figure>

          <div class="absolute -top-5 -left-3 sm:-left-6 rounded-2xl bg-brand-900 px-5 py-4 text-cream shadow-xl shadow-brand-900/25">
            <p class="font-display text-3xl font-light leading-none">15+</p>
            <p class="mt-1.5 text-[11.5px] uppercase tracking-[0.16em] text-cream/55">Years in practice</p>
          </div>
        </div>
      </div>

      <div class="lg:col-span-7 mt-10 lg:mt-0">
        <div class="reveal">
          <p class="text-[12px] uppercase tracking-[0.24em] text-accent-600 font-semibold">Why patients choose us</p>
          <h2 class="mt-5 font-display text-4xl lg:text-[2.9rem] leading-[1.1] tracking-tightest text-brand-900 font-light">
            A different kind of psychiatric practice.
          </h2>
          <p class="mt-6 text-[16.5px] leading-relaxed text-brand-900/60 font-light max-w-xl">
            We built this clinic around the patients who are hardest to help — and around
            the belief that complex cases deserve more time, not less.
          </p>
        </div>

        <div class="mt-12 grid sm:grid-cols-2 gap-x-12 gap-y-11">
        <?php
        $why = [
          ['Every option under one roof', 'Medication management, TMS, ketamine therapy and psychotherapy are coordinated by the same team — no referral maze, no starting over with a new clinician who doesn’t know your story.'],
          ['Time to actually be heard',   'Appointments are built for real conversation. We ask about sleep, work, relationships and side effects — not just a symptom checklist.'],
          ['Complex cases welcome',       'Serious mental illness, co-occurring substance use, geriatric complexity and prior treatment failures are the work we do every day.'],
          ['Insurance-forward',           'Most major insurance plans are accepted, and our team verifies your benefits and helps navigate prior authorizations before treatment begins.'],
        ];
        foreach ($why as $i => [$h, $p]): ?>
        <div class="reveal" style="transition-delay:<?= $i * 70 ?>ms">
          <div class="h-px w-10 bg-accent-500"></div>
          <h3 class="mt-5 font-display text-[23px] tracking-tight text-brand-900"><?= $h ?></h3>
          <p class="mt-3 text-[15px] leading-relaxed text-brand-900/60"><?= $p ?></p>
        </div>
        <?php endforeach; ?>
        </div>

        <div class="reveal mt-11 flex flex-wrap items-center gap-4 border-t border-black/10 pt-8">
          <a href="#consult" class="group inline-flex items-center gap-2 rounded-full bg-brand-900 px-7 py-3.5 text-[15px] font-medium text-cream hover:bg-brand-800 transition">
            Book a consultation
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-3.5 w-3.5 transition-transform group-hover:translate-x-0.5"><path d="M5 12h13M12 5l7 7-7 7"/></svg>
          </a>
          <p class="text-[14px] text-brand-900/50">
            One conversation, and an honest answer either way.
          </p>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- ══════════════════ PROCESS ══════════════════ -->
<section id="process" class="py-16 lg:py-24 bg-white border-y border-black/5">
  <div class="mx-auto max-w-8xl px-6 lg:px-10">

    <div class="max-w-2xl reveal">
      <p class="text-[12px] uppercase tracking-[0.24em] text-accent-600 font-semibold">How it works</p>
      <h2 class="mt-5 font-display text-4xl lg:text-[3.1rem] leading-[1.08] tracking-tightest text-brand-900 font-light">
        Four steps, no guesswork.
      </h2>
    </div>

    <div class="relative mt-16">
      <div class="hidden lg:block absolute top-7 left-0 right-0 h-px bg-gradient-to-r from-transparent via-black/10 to-transparent"></div>
      <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-10 lg:gap-8">
        <?php
        $steps = [
          ['An introductory call', 'Tell us briefly what you’ve tried and what isn’t working. We’ll say honestly whether we’re the right fit.'],
          ['Comprehensive eval',   'A full psychiatric evaluation — history, prior treatments, medical factors and goals — in person or via telehealth.'],
          ['Your treatment plan',  'We map the options together, explain what each involves, and handle insurance verification and prior authorization.'],
          ['Treatment & follow-up','Care begins, and we track your response closely — adjusting as we go rather than waiting months to reassess.'],
        ];
        foreach ($steps as $i => [$h, $p]): ?>
        <div class="reveal relative" style="transition-delay:<?= $i * 90 ?>ms">
          <span class="relative z-10 grid place-items-center h-14 w-14 rounded-2xl bg-brand-900 text-cream font-display text-xl font-light shadow-lg shadow-brand-900/15">
            <?= $i + 1 ?>
          </span>
          <h3 class="mt-6 font-display text-[24px] tracking-tight text-brand-900"><?= $h ?></h3>
          <p class="mt-3 text-[15px] leading-relaxed text-brand-900/60"><?= $p ?></p>
        </div>
        <?php endforeach; ?>
      </div>
    </div>

    <div class="reveal mt-14 text-center">
      <a href="#consult" class="group inline-flex items-center justify-center gap-2.5 rounded-full bg-accent-500 px-8 py-4 text-[15.5px] font-medium text-white hover:bg-accent-600 transition shadow-lg shadow-accent-500/20">
        Book a consultation
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-4 w-4 transition-transform group-hover:translate-x-1"><path d="M5 12h13M12 5l7 7-7 7"/></svg>
      </a>
      <p class="mt-4 text-[13.5px] text-brand-900/45">
        Or call <a href="tel:<?= $PHONE_LINK ?>" class="font-medium text-brand-900/70 hover:text-accent-600 transition"><?= $PHONE_DISPLAY ?></a> — we answer Monday to Friday, 8am–5pm.
      </p>
    </div>
  </div>
</section>

<!-- ══════════════════ TESTIMONIALS ══════════════════ -->
<section class="py-16 lg:py-24 overflow-hidden">
  <div class="mx-auto max-w-8xl px-6 lg:px-10">

    <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-8 reveal">
      <div class="max-w-2xl">
        <p class="text-[12px] uppercase tracking-[0.24em] text-accent-600 font-semibold">Patient experiences</p>
        <h2 class="mt-5 font-display text-4xl lg:text-[3rem] leading-[1.1] tracking-tightest text-brand-900 font-light">
          In their words.
        </h2>
        <p class="mt-5 text-[15.5px] leading-relaxed text-brand-900/55">
          Unedited reviews left by our patients on Google.
          <a href="<?= $GOOGLE_PROFILE ?>" target="_blank" rel="noopener"
             class="group inline-flex items-center gap-1.5 font-medium text-accent-600 hover:underline">
            Read them all
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-3.5 w-3.5"><path d="M7 17 17 7M9 7h8v8"/></svg>
          </a>
        </p>
      </div>

      <div class="flex items-center gap-2.5 shrink-0">
        <button id="tPrev" aria-label="Previous reviews" aria-controls="tTrack"
                class="grid place-items-center h-11 w-11 rounded-full border border-black/10 text-brand-900 transition hover:bg-brand-900 hover:text-cream hover:border-brand-900 disabled:opacity-30 disabled:pointer-events-none">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" class="h-4 w-4"><path d="M19 12H6M13 5l-7 7 7 7"/></svg>
        </button>
        <button id="tNext" aria-label="More reviews" aria-controls="tTrack"
                class="grid place-items-center h-11 w-11 rounded-full border border-black/10 text-brand-900 transition hover:bg-brand-900 hover:text-cream hover:border-brand-900 disabled:opacity-30 disabled:pointer-events-none">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" class="h-4 w-4"><path d="M5 12h13M12 5l7 7-7 7"/></svg>
        </button>
      </div>
    </div>

    <div class="reveal mt-12" role="region" aria-label="Patient reviews from Google">
      <div id="tTrack" tabindex="0"
           class="slider flex gap-5 overflow-x-auto snap-x snap-mandatory scroll-smooth -mx-6 px-6 lg:-mx-2 lg:px-2 pb-3 outline-none">
        <?php
        /* Verbatim Google reviews. Dates are the month each was posted, so they
           don't drift the way "2 months ago" would. */
        $reviews = [
          ['John Jakob', 'JJ', '4 reviews', 'July 2026', 'Jessica Cruz, NP',
           'My initial. appointment was with Nurse Practitioner Jessica Cruz. It was very worthwhile. NP Cruz is very welcoming yet very nonjudgemental and professional. She welcomes questions and thoroughly answers them. Her professional knowledge is very thorough. I was in the pharmaceutical industry for over 25 years and have dealt with many medical professionals in almost all specialties. NP Cruz impressed me as a top notch practitioner. At the end of that initial session I realized that my situation would be much improved with a bit of time and patience.'],
          ['Gary Johnson', 'GJ', '10 reviews', 'June 2026', 'Dr. Gomez',
           'Dr. Gomez is incredible. He took the time to really understand my situation, medical history, and what I was trying to accomplish. He was empathetic, caring, and listened without judgement. I highly recommend him and his staff.'],
          ['Michael Stella', 'MS', 'Local Guide · 26 reviews', 'May 2026', 'Jessica Cruz, NP',
           'The care I received her was far different past experiences with other providers, since Jessica took the time to hear all of my concerns, and fully took them into consideration as we developed a treatment plan. It was much appreciated!'],
          ['Sandra Bennewitz', 'SB', 'Local Guide · 25 reviews', 'June 2026', 'Dr. Gomez',
           'Dr. Gomez is SO kind, thoughtful and smart. He really listens and is so helpful. His office staff is competent and very caring. I highly recommend Dr. Gomez.'],
          ['Rick Young', 'RY', '3 reviews', 'May 2026', 'Jessica Cruz, NP',
           'Jessica was AMAZING!! She was exactly what I was looking for. Very professional, articulate and kind. Something I was horribly anxious about I\'m now looking forward to'],
          ['Logan', 'L', '7 reviews', 'April 2026', 'Our team',
           'I\'ve had a wonderful experience with all staff members. The whole office has been helpful, especially with handling any insurance issues that have surfaced. I\'m grateful to have found this office and its staff and I would highly recommend the facility to others!'],
          ['Anabella Ortega', 'AO', '1 review', 'July 2026', 'Our team',
           'I was felt very comfortable with the doctor I was with I feel if I was at my home he was just was listen what I told him. I felt welcomed I give him. And also before I forget the front desk people were friendly Nice to meet you Doctor'],
          ['Colton Moore', 'CM', 'Local Guide · 15 reviews', 'October 2025', 'Dr. Gomez',
           'Dr Gomez and his staff are amazing. Everyone is kind, professional, and makes you feel comfortable right away. Dr Gomez really listens, explains things clearly, and you can tell he truly cares about his patients. Overall a great experience and I\'m grateful to have found him.'],
          ['Benjamin Ernyei', 'BE', 'Local Guide · 13 reviews', 'November 2025', 'Dr. Gomez',
           'Dr Gomez and the staff at Interventional Psychiatry of AZ have been my best choice in care in the past couple years. Dr Gomez always listens to my issues and has made several recommendations in my care and treatment for my mental health best concerns. His staff is very supportive and I have always recommended Dr Gomez to anyone looking for an excellent, respectful, and supportive psychiatrist.'],
          ['Walker Eltife', 'WE', '5 reviews', 'September 2025', 'Dr. Gomez',
           'Dr. Gomez is an amazing man and doctor. He took me on when I moved to Arizona. I was patient of his for roughly 3 years he was always professional, compassionate, insightful and understanding. He played a huge part in helping me continue my sobriety while in Arizona. His staff is informative and kind as well and is always quick to lend a hand or answer any questions. I would send my own family Dr Gomez.'],
        ];
        foreach ($reviews as [$name, $initials, $meta, $when, $tag, $body]): ?>
        <figure class="t-card snap-start shrink-0 flex flex-col w-[86%] sm:w-[calc(50%-10px)] lg:w-[calc(33.333%-14px)] rounded-3xl border border-black/[0.07] bg-white p-8">
          <div class="flex items-start gap-3.5">
            <span class="grid place-items-center h-11 w-11 shrink-0 rounded-full bg-brand-900/[0.07] font-display text-[15px] text-brand-800"><?= $initials ?></span>
            <div class="min-w-0">
              <p class="text-[15.5px] font-medium text-brand-900 truncate"><?= $name ?></p>
              <p class="text-[12.5px] text-brand-900/45 mt-0.5"><?= $meta ?> · <?= $when ?></p>
            </div>
            <svg viewBox="0 0 24 24" class="ml-auto h-6 w-6 shrink-0 text-accent-400/50" fill="currentColor"><path d="M9.5 6C6.5 7.5 5 10.2 5 14v4h6v-6H8.2c.2-2 1.2-3.4 3-4.3L9.5 6Zm9 0C15.5 7.5 14 10.2 14 14v4h6v-6h-2.8c.2-2 1.2-3.4 3-4.3L18.5 6Z"/></svg>
          </div>

          <blockquote class="quote mt-5 text-[15.5px] leading-relaxed text-brand-900/70 font-light"><?= $body ?></blockquote>
          <button type="button" class="q-more mt-3 self-start text-[13.5px] font-medium text-accent-600 hover:underline">Read full review</button>

          <figcaption class="mt-auto pt-6 flex items-center justify-between gap-3">
            <span class="text-[12.5px] text-brand-900/40">Google review</span>
            <span class="rounded-full bg-sand px-2.5 py-1 text-[12px] text-brand-900/60 shrink-0"><?= $tag ?></span>
          </figcaption>
        </figure>
        <?php endforeach; ?>
      </div>

      <!-- scroll progress -->
      <div class="mt-7 h-[3px] w-full max-w-xs rounded-full bg-brand-900/10 overflow-hidden">
        <div id="tProgress" class="h-full w-1/3 rounded-full bg-brand-800 transition-[width,transform] duration-200"></div>
      </div>
    </div>

    <div class="reveal mt-12 flex flex-col sm:flex-row items-center justify-center gap-x-5 gap-y-4 text-center">
      <p class="font-display text-[22px] tracking-tight text-brand-900">Your first visit starts with a phone call.</p>
      <a href="#consult" class="group inline-flex items-center gap-2 rounded-full bg-accent-500 px-7 py-3.5 text-[15px] font-medium text-white hover:bg-accent-600 transition shadow-lg shadow-accent-500/20 shrink-0">
        Book a consultation
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-3.5 w-3.5 transition-transform group-hover:translate-x-0.5"><path d="M5 12h13M12 5l7 7-7 7"/></svg>
      </a>
    </div>

    <p class="mt-10 text-[12.5px] leading-relaxed text-brand-900/35 max-w-3xl">
      Reviews are reproduced as published by their authors on Google. Patient experiences vary;
      testimonials reflect individual results and are not a guarantee of outcome.
    </p>
  </div>
</section>

<!-- ══════════════════ FAQ ══════════════════ -->
<section id="faq" class="py-16 lg:py-24 bg-sand/60">
  <div class="mx-auto max-w-8xl px-6 lg:px-10">
    <div class="grid lg:grid-cols-12 gap-14">

      <div class="lg:col-span-4 reveal">
        <p class="text-[12px] uppercase tracking-[0.24em] text-accent-600 font-semibold">Questions</p>
        <h2 class="mt-5 font-display text-4xl lg:text-[2.9rem] leading-[1.1] tracking-tightest text-brand-900 font-light">
          Good to know before you call.
        </h2>
        <p class="mt-6 text-[15.5px] leading-relaxed text-brand-900/60">
          Still unsure? A short phone call answers most of it — no forms, no waiting room.
        </p>

        <div class="mt-8 rounded-2xl border border-black/[0.07] bg-white p-6">
          <p class="text-[12px] uppercase tracking-[0.16em] text-brand-900/40">Ask us directly</p>
          <a href="tel:<?= $PHONE_LINK ?>" class="mt-2 block font-display text-[26px] tracking-tight text-brand-900 hover:text-accent-600 transition"><?= $PHONE_DISPLAY ?></a>
          <p class="mt-1 text-[13.5px] text-brand-900/45">Monday to Friday, 8am–5pm</p>
          <a href="#consult" class="group mt-5 inline-flex items-center gap-2 rounded-full bg-brand-900 px-6 py-3 text-[14.5px] font-medium text-cream hover:bg-brand-800 transition">
            Book a consultation
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-3.5 w-3.5 transition-transform group-hover:translate-x-0.5"><path d="M5 12h13M12 5l7 7-7 7"/></svg>
          </a>
        </div>
      </div>

      <div class="lg:col-span-8 reveal" style="transition-delay:.1s">
        <?php
        $faqs = [
          ['Do you take my insurance?',
           'Most major insurance plans are accepted. Coverage details vary by plan and by treatment, so our team verifies your benefits before anything begins — and handles prior authorizations on your behalf, so there are no surprises once care starts.'],
          ['Does TMS hurt, and will I need time off?',
           'TMS is non-invasive and requires no sedation. Most people describe a tapping sensation on the scalp that fades after the first few sessions. You stay awake, sessions run about 20 minutes, and you can drive yourself to work or home immediately afterward.'],
          ['What is a ketamine treatment session like?',
           'You are with us for the dose and a monitoring period afterward, in a private room with a recliner. Vital signs are checked throughout, most people feel back to baseline before they leave, and you will need someone to drive you home.'],
          ['Can I do therapy and medication management here?',
           'Yes — and that is part of the point. When your therapist and your prescriber are in the same practice, your treatment plan is built from one shared picture rather than two half-views that never quite meet.'],
          ['Do I need a referral to be seen?',
           'No referral is required to schedule with us. If you are already working with a therapist or primary care provider, we are glad to coordinate care so everyone stays aligned.'],
          ['Do you see teens, or only adults?',
           'Our services are expanding to include teens and adolescents alongside adult and geriatric care. Call us to confirm current availability for a specific age and treatment.'],
          ['Can everything be done by telehealth?',
           'Evaluations, medication management, follow-up visits and psychotherapy can be done virtually anywhere in Arizona. TMS and ketamine therapy require in-person visits because they are delivered and monitored on site.'],
        ];
        foreach ($faqs as $i => [$q, $a]): ?>
        <div class="faq border-b border-black/10 <?= $i === 0 ? 'border-t' : '' ?>">
          <button class="faq-btn w-full flex items-start justify-between gap-6 py-6 text-left group">
            <span class="text-[17.5px] leading-snug text-brand-900 font-medium group-hover:text-accent-600 transition"><?= $q ?></span>
            <span class="faq-icon mt-1 grid place-items-center h-7 w-7 shrink-0 rounded-full border border-black/15 text-brand-900 transition-transform duration-300">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-3.5 w-3.5"><path d="M12 5v14M5 12h14"/></svg>
            </span>
          </button>
          <div class="faq-body">
            <div>
              <p class="pb-6 pr-14 text-[15.5px] leading-relaxed text-brand-900/60"><?= $a ?></p>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>

    </div>
  </div>
</section>

<!-- ══════════════════ CONTACT ══════════════════ -->
<section id="contact" class="relative overflow-hidden bg-brand-950 text-cream grain">
  <div class="pointer-events-none absolute -left-40 bottom-0 h-[30rem] w-[30rem] rounded-full bg-brand-600/40 blur-[120px]"></div>
  <div class="pointer-events-none absolute right-0 -top-24 h-[26rem] w-[26rem] rounded-full bg-accent-500/15 blur-[120px]"></div>

  <div class="relative mx-auto max-w-8xl px-6 lg:px-10 py-16 lg:py-20">
    <div class="grid lg:grid-cols-12 gap-10 lg:gap-16 items-center">

      <div class="lg:col-span-6 reveal">
        <p class="text-[12px] uppercase tracking-[0.24em] text-accent-400 font-semibold">Get started</p>
        <h2 class="mt-4 font-display text-4xl lg:text-[3rem] leading-[1.08] tracking-tightest font-light">
          Let's find what<br> finally works.
        </h2>
        <p class="mt-5 text-[16.5px] leading-relaxed text-cream/65 font-light max-w-md">
          It starts with a conversation — no commitment, no pressure.
        </p>

        <div class="mt-8 flex flex-col sm:flex-row gap-3.5">
          <a href="tel:<?= $PHONE_LINK ?>" class="inline-flex items-center justify-center gap-2.5 rounded-full bg-accent-500 px-7 py-4 text-[15.5px] font-medium text-white hover:bg-accent-600 transition shadow-lg shadow-accent-500/20">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" class="h-4 w-4"><path d="M4 5.5C4 4.7 4.7 4 5.5 4h2c.7 0 1.3.5 1.5 1.2l.6 2.4c.1.6-.1 1.2-.6 1.5l-1.2.9a12 12 0 0 0 5.2 5.2l.9-1.2c.4-.5 1-.7 1.5-.6l2.4.6c.7.2 1.2.8 1.2 1.5v2c0 .8-.7 1.5-1.5 1.5A15.5 15.5 0 0 1 4 5.5Z"/></svg>
            Call <?= $PHONE_DISPLAY ?>
          </a>
          <a href="#consult" class="group inline-flex items-center justify-center gap-2 rounded-full border border-white/20 bg-white/5 px-7 py-4 text-[15.5px] font-medium text-cream hover:bg-white/10 transition backdrop-blur">
            Book a consultation
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-4 w-4 transition-transform group-hover:-translate-y-0.5"><path d="M12 19V5M5 12l7-7 7 7"/></svg>
          </a>
        </div>

        <p class="mt-7 flex items-start gap-2.5 text-[13.5px] leading-relaxed text-cream/50">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" class="h-4 w-4 shrink-0 mt-0.5 text-accent-400"><path d="M12 8.5v4.5M12 16.5h.01"/><path d="M10.3 3.9 2.6 17.3A2 2 0 0 0 4.3 20.3h15.4a2 2 0 0 0 1.7-3L13.7 3.9a2 2 0 0 0-3.4 0Z"/></svg>
          <span><span class="text-cream/80 font-medium">In crisis?</span> Call 911, or call or text
            <a href="tel:988" class="font-semibold text-accent-400 hover:underline">988</a> for the 24/7 Suicide &amp; Crisis Lifeline.</span>
        </p>
      </div>

      <!-- where to find us -->
      <div class="lg:col-span-6 reveal" style="transition-delay:.12s">
        <div class="overflow-hidden rounded-2xl border border-white/12 bg-white/[0.04]">
          <iframe
            title="Map to Interventional Psychiatry of Arizona, <?= $ADDRESS_L1 ?>, <?= $ADDRESS_L2 ?>"
            src="https://www.google.com/maps?q=<?= $MAPS_QUERY ?>&output=embed"
            class="block h-64 w-full grayscale-[0.3] contrast-[1.05] transition duration-500 hover:grayscale-0"
            loading="lazy" referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe>
          <div class="flex flex-wrap items-center justify-between gap-3 px-6 py-5">
            <p class="text-[14.5px] leading-snug text-cream/70">
              <span class="text-cream"><?= $ADDRESS_L1 ?></span><br><?= $ADDRESS_L2 ?>
            </p>
            <a href="<?= $GOOGLE_PROFILE ?>" target="_blank" rel="noopener"
               class="group inline-flex items-center gap-2 text-[14.5px] font-medium text-accent-400 hover:text-accent-200 transition shrink-0">
              Get directions
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-4 w-4 transition-transform group-hover:translate-x-0.5"><path d="M5 12h13M12 5l7 7-7 7"/></svg>
            </a>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- ══════════════════ FOOTER ══════════════════ -->
<footer class="bg-brand-950 border-t border-white/10 text-cream/60">
  <div class="mx-auto max-w-8xl px-6 lg:px-10 py-14">
    <div class="grid md:grid-cols-12 gap-10">

      <div class="md:col-span-5">
        <img src="<?= $LOGO_LIGHT ?>" alt="Interventional Psychiatry of Arizona — Building Strong Minds"
             width="545" height="228" loading="lazy" class="h-16 w-auto">
        <p class="mt-6 text-[14.5px] leading-relaxed max-w-sm">
          Advanced psychiatric care for Phoenix and all of Arizona — medication management,
          TMS, ketamine therapy and psychotherapy, delivered by a team that stays with you.
        </p>
      </div>

      <div class="md:col-span-2">
        <p class="text-[12px] uppercase tracking-[0.18em] text-cream/35">Treatments</p>
        <ul class="mt-5 space-y-3 text-[14.5px]">
          <?php foreach (['Medication Management','TMS Therapy','Ketamine Therapy','Psychotherapy'] as $l): ?>
          <li><a href="#treatments" class="hover:text-accent-400 transition"><?= $l ?></a></li>
          <?php endforeach; ?>
        </ul>
      </div>

      <div class="md:col-span-2">
        <p class="text-[12px] uppercase tracking-[0.18em] text-cream/35">Practice</p>
        <ul class="mt-5 space-y-3 text-[14.5px]">
          <li><a href="#conditions" class="hover:text-accent-400 transition">Conditions</a></li>
          <li><a href="#process" class="hover:text-accent-400 transition">New Patients</a></li>
          <li><a href="#insurance" class="hover:text-accent-400 transition">Insurance Accepted</a></li>
          <li><a href="#faq" class="hover:text-accent-400 transition">FAQ</a></li>
          <li><a href="#contact" class="hover:text-accent-400 transition">Contact</a></li>
        </ul>
      </div>

      <div class="md:col-span-3">
        <p class="text-[12px] uppercase tracking-[0.18em] text-cream/35">Visit</p>
        <ul class="mt-5 space-y-3 text-[14.5px]">
          <li><?= $ADDRESS_L1 ?><br><?= $ADDRESS_L2 ?></li>
          <li><a href="tel:<?= $PHONE_LINK ?>" class="hover:text-accent-400 transition"><?= $PHONE_DISPLAY ?></a></li>
          <li class="text-cream/40">Mon–Fri · 8am–5pm</li>
        </ul>
      </div>
    </div>

    <div class="mt-12 pt-7 border-t border-white/10 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 text-[13px] text-cream/40">
      <p>&copy; <?= $YEAR ?> Interventional Psychiatry of Arizona. All rights reserved.</p>
      <div class="flex items-center gap-6">
        <a href="#" class="hover:text-cream transition">Privacy Policy</a>
        <a href="#" class="hover:text-cream transition">Notice of Privacy Practices</a>
        <a href="#" class="hover:text-cream transition">Accessibility</a>
      </div>
    </div>

    <p class="mt-8 text-[12px] leading-relaxed text-cream/25 max-w-4xl">
      The content on this website is for general informational purposes only and is not a substitute for
      professional medical advice, diagnosis or treatment. Always seek the guidance of a qualified health
      provider with questions about a medical condition.
    </p>
  </div>
</footer>

<script>
/* ---------- mobile menu ---------- */
const menuBtn = document.getElementById('menuBtn');
const mobileMenu = document.getElementById('mobileMenu');
const nav = document.getElementById('nav');

/* ---------- header state ----------
   Transparent over the hero photo, solid cream once scrolled past it — and
   always solid while the mobile drawer is open, so the links stay readable. */
const setNavState = () => {
  const solid = window.scrollY > 12 || !mobileMenu.classList.contains('hidden');
  nav.dataset.state = solid ? 'solid' : 'top';
  nav.classList.toggle('shadow-[0_1px_24px_rgba(10,28,27,0.08)]', solid);
};
setNavState();
window.addEventListener('scroll', setNavState, { passive: true });

menuBtn.addEventListener('click', () => { mobileMenu.classList.toggle('hidden'); setNavState(); });
mobileMenu.querySelectorAll('a').forEach(a => a.addEventListener('click', () => {
  mobileMenu.classList.add('hidden'); setNavState();
}));

/* ---------- scroll reveal ---------- */
const io = new IntersectionObserver((entries) => {
  entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('in'); io.unobserve(e.target); } });
}, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });
document.querySelectorAll('.reveal').forEach(el => io.observe(el));

/* ---------- FAQ accordion ---------- */
document.querySelectorAll('.faq-btn').forEach(btn => {
  btn.addEventListener('click', () => {
    const item = btn.closest('.faq');
    const wasOpen = item.classList.contains('open');
    document.querySelectorAll('.faq').forEach(f => f.classList.remove('open'));
    if (!wasOpen) item.classList.add('open');
  });
});

/* ---------- testimonial slider ---------- */
(() => {
  const track = document.getElementById('tTrack');
  if (!track) return;
  const prev = document.getElementById('tPrev');
  const next = document.getElementById('tNext');
  const bar  = document.getElementById('tProgress');
  const gap  = 20;

  const step = () => (track.querySelector('.t-card')?.offsetWidth || 320) + gap;
  const maxScroll = () => track.scrollWidth - track.clientWidth;

  const sync = () => {
    const max = maxScroll();
    const at = track.scrollLeft;
    prev.disabled = at < 4;
    next.disabled = at > max - 4;
    /* the rail shows how much of the set is visible, and where you are in it */
    const visible = Math.min(1, track.clientWidth / track.scrollWidth);
    bar.style.width = (visible * 100) + '%';
    bar.style.transform = `translateX(${max > 0 ? (at / max) * ((1 / visible) - 1) * 100 : 0}%)`;
  };

  prev.addEventListener('click', () => track.scrollBy({ left: -step(), behavior: 'smooth' }));
  next.addEventListener('click', () => track.scrollBy({ left:  step(), behavior: 'smooth' }));
  track.addEventListener('scroll', sync, { passive: true });
  window.addEventListener('resize', sync);
  sync();

  /* Only offer "Read full review" on the reviews that are actually clipped. */
  track.querySelectorAll('.t-card').forEach(card => {
    const quote = card.querySelector('.quote');
    const more  = card.querySelector('.q-more');
    if (quote.scrollHeight > quote.clientHeight + 2) card.classList.add('q-clamped');
    more.addEventListener('click', () => {
      card.classList.toggle('q-open');
      more.textContent = card.classList.contains('q-open') ? 'Show less' : 'Read full review';
      sync();
    });
  });
})();

/* ---------- photo fallback ----------
   If a photo fails to load, drop it so the brand gradient underneath shows
   through rather than leaving a broken-image frame in the layout. */
document.querySelectorAll('.js-photo').forEach(im => {
  im.addEventListener('error', () => im.remove(), { once: true });
});

/* ---------- consult form ----------
   Posts to Formester over fetch so the visitor stays on the page. If that call
   can't be confirmed — CORS, offline, an endpoint change — the form falls back
   to a normal browser POST, which always reaches Formester. */
(() => {
  const form = document.getElementById('contactForm');
  if (!form) return;
  const note = document.getElementById('formNote');
  const btn  = form.querySelector('button[type="submit"]');
  const btnLabel = btn.innerHTML;

  const say = (text, ok) => {
    note.textContent = text;
    note.classList.remove('hidden');
    note.classList.toggle('border-accent-400/30', ok);
    note.classList.toggle('bg-accent-500/15', ok);
    note.classList.toggle('border-red-400/40', !ok);
    note.classList.toggle('bg-red-500/15', !ok);
  };

  form.addEventListener('submit', async (e) => {
    e.preventDefault();

    /* Bots fill the hidden field; drop those without telling them why. */
    if (form.elements.company && form.elements.company.value) return;

    btn.disabled = true;
    btn.classList.add('opacity-70');
    btn.textContent = 'Sending…';

    try {
      const res = await fetch(form.action, {
        method: 'POST',
        body: new FormData(form),
        headers: { Accept: 'application/json' },
      });
      if (!res.ok) throw new Error('HTTP ' + res.status);

      form.reset();
      say('Thank you — your request has been received. A member of our team will reach out within one business day.', true);
      btn.innerHTML = btnLabel;
      btn.disabled = false;
      btn.classList.remove('opacity-70');
    } catch (err) {
      /* Couldn't confirm it landed — hand the submission to the browser, which
         posts it for real even when fetch is blocked. */
      form.submit();
    }
  });
})();
</script>
</body>
</html>
