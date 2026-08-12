<?php
/**
 * Interventional Psychiatry of Arizona — Landing Page
 * Single-file marketing page. Tailwind CSS (CDN) + vanilla JS.
 */
$PHONE_DISPLAY = '(602) 824-8404';
$PHONE_LINK    = '+16028248404';
$EMAIL         = 'admin@interpsychaz.com';
$ADDRESS_L1    = '2122 E. Highland Ave, Suite 335';
$ADDRESS_L2    = 'Phoenix, AZ 85016';
$YEAR          = date('Y');
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Interventional Psychiatry of Arizona | TMS, Spravato &amp; ECT in Phoenix</title>
<meta name="description" content="Advanced, evidence-based psychiatric care in Phoenix, AZ. TMS therapy, Spravato (esketamine), ECT and expert medication management for treatment-resistant depression, PTSD, anxiety and more. Most insurances accepted.">
<meta property="og:title" content="Interventional Psychiatry of Arizona">
<meta property="og:description" content="When medication alone hasn't worked, there is more we can do. TMS, Spravato and ECT in Phoenix, AZ.">
<meta property="og:type" content="website">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
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

  /* Scroll reveal */
  .reveal { opacity:0; transform:translateY(22px); transition:opacity .8s cubic-bezier(.2,.7,.2,1), transform .8s cubic-bezier(.2,.7,.2,1); }
  .reveal.in { opacity:1; transform:none; }

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
      <a href="mailto:<?= $EMAIL ?>" class="hover:text-white transition"><?= $EMAIL ?></a>
    </div>
  </div>
</div>

<!-- ══════════════════ NAV ══════════════════ -->
<header id="nav" class="sticky top-0 z-50 transition-all duration-300 bg-cream/80 backdrop-blur-xl border-b border-black/5">
  <nav class="mx-auto max-w-8xl px-6 lg:px-10">
    <div class="h-[72px] flex items-center justify-between gap-8">

      <a href="#top" class="flex items-center gap-3 shrink-0 group">
        <span class="relative grid place-items-center h-10 w-10 rounded-xl bg-brand-900 text-cream shadow-sm">
          <svg viewBox="0 0 24 24" fill="none" class="h-5 w-5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round">
            <path d="M9 3.5a2.5 2.5 0 0 0-2.5 2.5v.2A2.7 2.7 0 0 0 4 8.9c0 .9.4 1.7 1.1 2.2A2.7 2.7 0 0 0 4 13.3c0 1.2.8 2.2 1.9 2.6A2.5 2.5 0 0 0 9 20.5c1.1 0 2-.7 2.4-1.6"/>
            <path d="M15 3.5A2.5 2.5 0 0 1 17.5 6v.2a2.7 2.7 0 0 1 2.5 2.7c0 .9-.4 1.7-1.1 2.2a2.7 2.7 0 0 1 1.1 2.2c0 1.2-.8 2.2-1.9 2.6a2.5 2.5 0 0 1-3.1 3.9"/>
            <path d="M12 5v14" class="text-accent-400" stroke="currentColor"/>
          </svg>
        </span>
        <span class="leading-none">
          <span class="block font-display text-[17px] tracking-tightest text-brand-900">Interventional Psychiatry</span>
          <span class="block text-[11px] tracking-[0.22em] uppercase text-brand-700/60 mt-1">of Arizona</span>
        </span>
      </a>

      <div class="hidden lg:flex items-center gap-1 text-[15px] text-brand-900/75">
        <a href="#treatments" class="px-3.5 py-2 rounded-lg hover:bg-sand hover:text-brand-900 transition">Treatments</a>
        <a href="#conditions" class="px-3.5 py-2 rounded-lg hover:bg-sand hover:text-brand-900 transition">Conditions</a>
        <a href="#team"       class="px-3.5 py-2 rounded-lg hover:bg-sand hover:text-brand-900 transition">Our Team</a>
        <a href="#process"    class="px-3.5 py-2 rounded-lg hover:bg-sand hover:text-brand-900 transition">How It Works</a>
        <a href="#faq"        class="px-3.5 py-2 rounded-lg hover:bg-sand hover:text-brand-900 transition">FAQ</a>
      </div>

      <div class="flex items-center gap-3">
        <a href="tel:<?= $PHONE_LINK ?>" class="hidden sm:flex items-center gap-2 text-[15px] font-medium text-brand-900 hover:text-accent-600 transition">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" class="h-4 w-4"><path d="M4 5.5C4 4.7 4.7 4 5.5 4h2c.7 0 1.3.5 1.5 1.2l.6 2.4c.1.6-.1 1.2-.6 1.5l-1.2.9a12 12 0 0 0 5.2 5.2l.9-1.2c.4-.5 1-.7 1.5-.6l2.4.6c.7.2 1.2.8 1.2 1.5v2c0 .8-.7 1.5-1.5 1.5A15.5 15.5 0 0 1 4 5.5Z"/></svg>
          <?= $PHONE_DISPLAY ?>
        </a>
        <a href="#consult" class="inline-flex items-center gap-2 rounded-full bg-brand-900 px-5 py-2.5 text-[14.5px] font-medium text-cream hover:bg-brand-800 transition shadow-sm hover:shadow-md">
          Book a consult
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-3.5 w-3.5"><path d="M5 12h13M12 5l7 7-7 7"/></svg>
        </a>
        <button id="menuBtn" aria-label="Open menu" class="lg:hidden grid place-items-center h-10 w-10 rounded-lg border border-black/10 text-brand-900">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-5 w-5"><path d="M4 7h16M4 12h16M4 17h16"/></svg>
        </button>
      </div>
    </div>

    <!-- mobile drawer -->
    <div id="mobileMenu" class="lg:hidden hidden pb-5">
      <div class="grid gap-1 text-[16px] text-brand-900/80 border-t border-black/5 pt-4">
        <a href="#treatments" class="px-3 py-2.5 rounded-lg hover:bg-sand">Treatments</a>
        <a href="#conditions" class="px-3 py-2.5 rounded-lg hover:bg-sand">Conditions</a>
        <a href="#team"       class="px-3 py-2.5 rounded-lg hover:bg-sand">Our Team</a>
        <a href="#process"    class="px-3 py-2.5 rounded-lg hover:bg-sand">How It Works</a>
        <a href="#faq"        class="px-3 py-2.5 rounded-lg hover:bg-sand">FAQ</a>
        <a href="tel:<?= $PHONE_LINK ?>" class="px-3 py-2.5 rounded-lg font-medium text-accent-600"><?= $PHONE_DISPLAY ?></a>
      </div>
    </div>
  </nav>
</header>

<!-- ══════════════════ HERO ══════════════════ -->
<section id="top" class="relative overflow-hidden bg-brand-950 grain">
  <!-- ambient light -->
  <div class="pointer-events-none absolute -top-40 -left-32 h-[38rem] w-[38rem] rounded-full bg-brand-600/45 blur-[120px]"></div>
  <div class="pointer-events-none absolute top-24 right-[-10rem] h-[34rem] w-[34rem] rounded-full bg-accent-500/20 blur-[130px]"></div>
  <div class="pointer-events-none absolute inset-0 opacity-[0.07]"
       style="background-image:linear-gradient(#fff 1px,transparent 1px),linear-gradient(90deg,#fff 1px,transparent 1px);background-size:72px 72px;mask-image:radial-gradient(ellipse 70% 60% at 50% 40%,#000,transparent)"></div>

  <div class="relative mx-auto max-w-8xl px-6 lg:px-10 pt-20 pb-24 lg:pt-28 lg:pb-32">
    <div class="grid lg:grid-cols-12 gap-14 lg:gap-10 items-center">

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
          TMS, Spravato and ECT — to people living with depression, PTSD and other
          conditions that haven't responded to standard care.
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

        <dl class="mt-12 grid grid-cols-3 gap-6 max-w-lg border-t border-white/10 pt-8">
          <div>
            <dt class="font-display text-3xl text-cream font-light">15+</dt>
            <dd class="mt-1.5 text-[13px] leading-snug text-cream/50">Years of psychiatric practice</dd>
          </div>
          <div>
            <dt class="font-display text-3xl text-cream font-light">4</dt>
            <dd class="mt-1.5 text-[13px] leading-snug text-cream/50">Interventional modalities offered</dd>
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

          <form id="contactForm" class="relative rounded-[28px] bg-cream shadow-2xl shadow-black/40 ring-1 ring-black/5 p-7 sm:p-9">

            <div class="flex items-start justify-between gap-4">
              <div>
                <h2 class="font-display text-[27px] leading-tight tracking-tight text-brand-900">Request a free 15-min consult</h2>
                <p class="mt-2 text-[14.5px] leading-relaxed text-brand-900/55">
                  Tell us a little about what you're facing. We'll reach out within one business day.
                </p>
              </div>
              <span class="hidden sm:grid place-items-center h-11 w-11 shrink-0 rounded-2xl bg-accent-50 text-accent-600">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" class="h-5 w-5"><path d="M12 3l7.5 3v5.5c0 4.4-3.1 8.2-7.5 9.5-4.4-1.3-7.5-5.1-7.5-9.5V6L12 3Z"/><path d="M9.5 12l1.8 1.8L15 10"/></svg>
              </span>
            </div>

            <div class="mt-7 grid sm:grid-cols-2 gap-4">
              <div>
                <label for="fname" class="block text-[12.5px] font-medium text-brand-900/60 mb-1.5">First name</label>
                <input id="fname" name="fname" required class="w-full rounded-xl border border-black/10 bg-white px-4 py-3 text-[15px] text-brand-900 placeholder-brand-900/25 outline-none focus:border-accent-500 focus:ring-2 focus:ring-accent-500/15 transition" placeholder="Jane">
              </div>
              <div>
                <label for="lname" class="block text-[12.5px] font-medium text-brand-900/60 mb-1.5">Last name</label>
                <input id="lname" name="lname" required class="w-full rounded-xl border border-black/10 bg-white px-4 py-3 text-[15px] text-brand-900 placeholder-brand-900/25 outline-none focus:border-accent-500 focus:ring-2 focus:ring-accent-500/15 transition" placeholder="Doe">
              </div>
              <div>
                <label for="email" class="block text-[12.5px] font-medium text-brand-900/60 mb-1.5">Email</label>
                <input id="email" name="email" type="email" required class="w-full rounded-xl border border-black/10 bg-white px-4 py-3 text-[15px] text-brand-900 placeholder-brand-900/25 outline-none focus:border-accent-500 focus:ring-2 focus:ring-accent-500/15 transition" placeholder="you@email.com">
              </div>
              <div>
                <label for="phone" class="block text-[12.5px] font-medium text-brand-900/60 mb-1.5">Phone</label>
                <input id="phone" name="phone" type="tel" class="w-full rounded-xl border border-black/10 bg-white px-4 py-3 text-[15px] text-brand-900 placeholder-brand-900/25 outline-none focus:border-accent-500 focus:ring-2 focus:ring-accent-500/15 transition" placeholder="(602) 000-0000">
              </div>
              <div class="sm:col-span-2">
                <label for="interest" class="block text-[12.5px] font-medium text-brand-900/60 mb-1.5">What are you interested in?</label>
                <select id="interest" name="interest" class="w-full appearance-none rounded-xl border border-black/10 bg-white px-4 py-3 text-[15px] text-brand-900 outline-none focus:border-accent-500 focus:ring-2 focus:ring-accent-500/15 transition"
                        style="background-image:url(&quot;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='none' stroke='%2331336E' stroke-opacity='.5' stroke-width='2'%3E%3Cpath d='m4 6 4 4 4-4'/%3E%3C/svg%3E&quot;);background-repeat:no-repeat;background-position:right 1rem center">
                  <?php foreach (['I’m not sure yet — help me decide','TMS Therapy','Spravato® (esketamine)','ECT','Medication management','ADHD assessment','Telepsychiatry'] as $opt): ?>
                  <option><?= $opt ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="sm:col-span-2">
                <label for="msg" class="block text-[12.5px] font-medium text-brand-900/60 mb-1.5">Anything you'd like us to know <span class="font-normal text-brand-900/35">(optional)</span></label>
                <textarea id="msg" name="msg" rows="3" class="w-full rounded-xl border border-black/10 bg-white px-4 py-3 text-[15px] text-brand-900 placeholder-brand-900/25 outline-none focus:border-accent-500 focus:ring-2 focus:ring-accent-500/15 transition resize-none" placeholder="Briefly — what you've tried, and what you're hoping to change."></textarea>
              </div>
            </div>

            <button type="submit" class="group mt-6 w-full inline-flex items-center justify-center gap-2.5 rounded-full bg-brand-900 px-8 py-4 text-[15.5px] font-medium text-cream hover:bg-brand-800 transition shadow-lg shadow-brand-900/20">
              Request my consult
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-4 w-4 transition-transform group-hover:translate-x-1"><path d="M5 12h13M12 5l7 7-7 7"/></svg>
            </button>

            <p id="formNote" class="hidden mt-4 rounded-xl border border-brand-500/25 bg-brand-500/10 px-4 py-3 text-[14px] text-brand-900/75"></p>

            <div class="mt-5 flex items-start gap-2.5 text-[12px] leading-relaxed text-brand-900/40">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" class="h-4 w-4 shrink-0 mt-px"><rect x="4.5" y="10" width="15" height="10" rx="2"/><path d="M8 10V7.5a4 4 0 0 1 8 0V10"/></svg>
              <p>Please don't include sensitive medical details. This form is not for emergencies — in a crisis, call <a href="tel:988" class="font-semibold text-accent-600 hover:underline">988</a> or 911.</p>
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
        ['Insurance friendly','Most plans accepted for TMS, Spravato & ECT'],
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
<section id="treatments" class="py-24 lg:py-32">
  <div class="mx-auto max-w-8xl px-6 lg:px-10">

    <div class="max-w-3xl reveal">
      <p class="text-[12px] uppercase tracking-[0.24em] text-accent-600 font-semibold">Treatments</p>
      <h2 class="mt-5 font-display text-4xl lg:text-[3.2rem] leading-[1.08] tracking-tightest text-brand-900 font-light">
        Care that goes beyond<br class="hidden sm:block"> the prescription pad.
      </h2>
      <p class="mt-6 text-[17px] leading-relaxed text-brand-900/60 font-light">
        Interventional psychiatry targets the brain circuits involved in mood and thought directly.
        For many patients, that means relief arrives faster — and lasts longer — than with medication alone.
      </p>
    </div>

    <div class="mt-16 grid md:grid-cols-2 lg:grid-cols-3 gap-5">
      <?php
      $treatments = [
        [
          'TMS Therapy',
          'Transcranial Magnetic Stimulation',
          'Gentle magnetic pulses stimulate the areas of the brain that regulate mood. No anesthesia, no sedation, no systemic side effects — most patients read or listen to music and drive themselves home afterward.',
          ['~20 minute sessions', 'FDA-cleared', 'Covered by most plans'],
          'M4 14a8 8 0 0 1 16 0M7.5 14a4.5 4.5 0 0 1 9 0M12 14v6M9 20h6',
        ],
        [
          'Spravato®',
          'Intranasal esketamine',
          'A rapid-acting option for treatment-resistant depression and depression with suicidal ideation. Administered in our REMS-certified office under clinical monitoring, in a calm and private setting.',
          ['Rapid onset', 'REMS-certified site', 'Monitored in-office'],
          'M12 3c3 3.5 5 6.4 5 9a5 5 0 0 1-10 0c0-2.6 2-5.5 5-9Z',
        ],
        [
          'ECT',
          'Electroconvulsive Therapy',
          'The most effective treatment available for severe, persistent depression and catatonia. Delivered in a hospital setting under anesthesia with modern protocols designed to protect memory and cognition.',
          ['Highest efficacy', 'Under anesthesia', 'Hospital-based'],
          'M13 2 4.5 13.5H11L10 22l8.5-11.5H12L13 2Z',
        ],
        [
          'Medication Management',
          'Precision psychopharmacology',
          'Thoughtful, unhurried medication care from clinicians who actually have time to listen. We simplify complicated regimens, address side effects, and adjust based on how you are really doing.',
          ['In-person or virtual', 'Ongoing follow-up', 'Second opinions'],
          'M10.5 3.5a5 5 0 0 1 7 7l-7 7a5 5 0 0 1-7-7l7-7ZM7 7l7 7',
        ],
        [
          'ADHD Assessment',
          'Structured diagnostic evaluation',
          'A careful, evidence-based evaluation for adult and adolescent ADHD — including rating scales, clinical interview and differential diagnosis — followed by a clear treatment plan you help shape.',
          ['Adults & teens', 'Clear written findings', 'Treatment planning'],
          'M4 6h16M4 12h10M4 18h7M17 15l2 2 4-4',
        ],
        [
          'Telepsychiatry',
          'Care from anywhere in Arizona',
          'Secure video visits for evaluation, medication management and follow-up care — so distance, work schedules and transportation never become the reason treatment stops.',
          ['Statewide', 'Secure & private', 'Same clinicians'],
          'M4 7a2 2 0 0 1 2-2h7a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V7ZM15 10l5-3v10l-5-3',
        ],
      ];
      foreach ($treatments as $i => [$title, $sub, $body, $tags, $icon]): ?>
      <article class="reveal group relative rounded-3xl border border-black/[0.07] bg-white p-8 transition duration-300 hover:-translate-y-1 hover:shadow-xl hover:shadow-brand-900/[0.07] hover:border-brand-900/15"
               style="transition-delay:<?= $i * 60 ?>ms">
        <div class="flex items-start justify-between">
          <span class="grid place-items-center h-12 w-12 rounded-2xl bg-brand-900/[0.06] text-brand-800 group-hover:bg-brand-900 group-hover:text-cream transition duration-300">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" class="h-5.5 w-5.5"><path d="<?= $icon ?>"/></svg>
          </span>
          <span class="font-display text-[13px] text-brand-900/20 tabular-nums">0<?= $i + 1 ?></span>
        </div>

        <h3 class="mt-6 font-display text-[26px] tracking-tight text-brand-900"><?= $title ?></h3>
        <p class="mt-1 text-[13px] uppercase tracking-[0.14em] text-accent-600/80"><?= $sub ?></p>
        <p class="mt-4 text-[15px] leading-relaxed text-brand-900/60"><?= $body ?></p>

        <ul class="mt-6 flex flex-wrap gap-2">
          <?php foreach ($tags as $tag): ?>
          <li class="rounded-full bg-sand px-3 py-1 text-[12.5px] text-brand-900/70"><?= $tag ?></li>
          <?php endforeach; ?>
        </ul>
      </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ══════════════════ CONDITIONS ══════════════════ -->
<section id="conditions" class="relative overflow-hidden bg-brand-900 text-cream grain">
  <div class="pointer-events-none absolute -right-40 -top-20 h-[30rem] w-[30rem] rounded-full bg-brand-600/45 blur-[110px]"></div>
  <div class="relative mx-auto max-w-8xl px-6 lg:px-10 py-24 lg:py-32">
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
        <a href="#consult" class="mt-9 inline-flex items-center gap-2 text-[15.5px] font-medium text-accent-400 hover:text-accent-200 transition">
          Talk with our team
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-4 w-4"><path d="M5 12h13M12 5l7 7-7 7"/></svg>
        </a>
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
<section class="py-24 lg:py-32 bg-sand/60">
  <div class="mx-auto max-w-8xl px-6 lg:px-10">
    <div class="grid lg:grid-cols-3 gap-14 lg:gap-16">

      <div class="reveal">
        <p class="text-[12px] uppercase tracking-[0.24em] text-accent-600 font-semibold">Why patients choose us</p>
        <h2 class="mt-5 font-display text-4xl lg:text-[2.9rem] leading-[1.1] tracking-tightest text-brand-900 font-light">
          A different kind of psychiatric practice.
        </h2>
        <p class="mt-6 text-[16.5px] leading-relaxed text-brand-900/60 font-light">
          We built this clinic around the patients who are hardest to help — and around
          the belief that complex cases deserve more time, not less.
        </p>
      </div>

      <div class="lg:col-span-2 grid sm:grid-cols-2 gap-x-12 gap-y-11">
        <?php
        $why = [
          ['Every option under one roof', 'TMS, Spravato, ECT and medication management are coordinated by the same team — no referral maze, no starting over with a new clinician who doesn’t know your story.'],
          ['Time to actually be heard',   'Appointments are built for real conversation. We ask about sleep, work, relationships and side effects — not just a symptom checklist.'],
          ['Complex cases welcome',       'Serious mental illness, co-occurring substance use, geriatric complexity and prior treatment failures are the work we do every day.'],
          ['Insurance-forward',           'Most insurance plans are accepted for medication management, TMS, Spravato and ECT, and our team helps navigate prior authorizations.'],
        ];
        foreach ($why as $i => [$h, $p]): ?>
        <div class="reveal" style="transition-delay:<?= $i * 70 ?>ms">
          <div class="h-px w-10 bg-accent-500"></div>
          <h3 class="mt-5 font-display text-[23px] tracking-tight text-brand-900"><?= $h ?></h3>
          <p class="mt-3 text-[15px] leading-relaxed text-brand-900/60"><?= $p ?></p>
        </div>
        <?php endforeach; ?>
      </div>

    </div>
  </div>
</section>

<!-- ══════════════════ TEAM ══════════════════ -->
<section id="team" class="py-24 lg:py-32">
  <div class="mx-auto max-w-8xl px-6 lg:px-10">

    <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-8 reveal">
      <div class="max-w-2xl">
        <p class="text-[12px] uppercase tracking-[0.24em] text-accent-600 font-semibold">Our team</p>
        <h2 class="mt-5 font-display text-4xl lg:text-[3.2rem] leading-[1.08] tracking-tightest text-brand-900 font-light">
          Clinicians who stay<br class="hidden sm:block"> with you.
        </h2>
      </div>
      <p class="max-w-md text-[16px] leading-relaxed text-brand-900/60 font-light">
        You'll get to know the people treating you — and they'll get to know you. That
        continuity is part of what makes interventional care work.
      </p>
    </div>

    <div class="mt-16 grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
      <?php
      $team = [
        ['Gerhard Gomez', 'MD', 'GG', 'Founder & Psychiatrist',
         'Board-certified psychiatrist with expertise spanning interventional, geriatric, addiction, forensic and emergency psychiatry. Chief resident at Banner University Medical Center in Tucson; residency at the University of Arizona College of Medicine.'],
        ['Nina Gomez', 'DNP, PMHNP', 'NG', 'Psychiatric Nurse Practitioner',
         'Board-certified with 12+ years serving the Phoenix community and a Doctor of Nursing Practice from Arizona State University. Focused on serious mental illness, recovery-oriented care and geriatric psychiatry.'],
        ['Jessica Cruz', 'PMHNP', 'JC', 'Psychiatric Nurse Practitioner',
         'Provides thoughtful, personalized psychiatric care with an emphasis on building trust first. Works closely with patients navigating mood, anxiety and trauma-related conditions.'],
        ['Michael Jacobson', 'PA-C', 'MJ', 'Physician Associate',
         'Raised in the Phoenix metro and a summa cum laude graduate of Arizona State University in biochemistry. Brings a precise, science-forward approach to psychiatric evaluation and follow-up care.'],
      ];
      foreach ($team as $i => [$name, $cred, $initials, $role, $bio]): ?>
      <article class="reveal group rounded-3xl border border-black/[0.07] bg-white overflow-hidden transition duration-300 hover:-translate-y-1 hover:shadow-xl hover:shadow-brand-900/[0.07]"
               style="transition-delay:<?= $i * 70 ?>ms">
        <div class="relative h-44 bg-gradient-to-br from-brand-800 to-brand-950 grid place-items-center overflow-hidden">
          <div class="absolute inset-0 opacity-[0.14]" style="background-image:radial-gradient(circle at 30% 25%, #EF7136, transparent 58%)"></div>
          <span class="relative font-display text-4xl text-cream/90 font-light tracking-tight"><?= $initials ?></span>
          <div class="absolute bottom-0 inset-x-0 h-px bg-gradient-to-r from-transparent via-accent-400/50 to-transparent"></div>
        </div>
        <div class="p-6">
          <h3 class="font-display text-[22px] tracking-tight text-brand-900 leading-tight"><?= $name ?><span class="text-brand-900/40 text-[15px] font-sans">, <?= $cred ?></span></h3>
          <p class="mt-1.5 text-[12.5px] uppercase tracking-[0.14em] text-accent-600/85"><?= $role ?></p>
          <p class="mt-4 text-[14.5px] leading-relaxed text-brand-900/55"><?= $bio ?></p>
        </div>
      </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ══════════════════ PROCESS ══════════════════ -->
<section id="process" class="py-24 lg:py-32 bg-white border-y border-black/5">
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
          ['Free 15-minute call',  'Tell us briefly what you’ve tried and what isn’t working. We’ll say honestly whether we’re the right fit.'],
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
  </div>
</section>

<!-- ══════════════════ TESTIMONIALS ══════════════════ -->
<section class="py-24 lg:py-32">
  <div class="mx-auto max-w-8xl px-6 lg:px-10">
    <div class="text-center max-w-2xl mx-auto reveal">
      <p class="text-[12px] uppercase tracking-[0.24em] text-accent-600 font-semibold">Patient experiences</p>
      <h2 class="mt-5 font-display text-4xl lg:text-[3rem] leading-[1.1] tracking-tightest text-brand-900 font-light">
        In their words.
      </h2>
    </div>

    <div class="mt-14 grid md:grid-cols-3 gap-5">
      <?php
      $quotes = [
        ['After years of trying different medications, TMS was the first thing that actually moved the needle. I felt like myself again by the fifth week.', 'Patient · Depression', 'TMS Therapy'],
        ['Dr. Gomez took the time to understand the whole picture instead of just adjusting a dose and sending me on my way. That alone changed things.', 'Patient · Medication Management', 'Evaluation'],
        ['The staff walked me through every step of the Spravato process and made a nerve-wracking treatment feel safe and routine.', 'Patient · Treatment-Resistant Depression', 'Spravato®'],
      ];
      foreach ($quotes as $i => [$q, $who, $tag]): ?>
      <figure class="reveal flex flex-col rounded-3xl border border-black/[0.07] bg-white p-8" style="transition-delay:<?= $i * 80 ?>ms">
        <svg viewBox="0 0 24 24" class="h-7 w-7 text-accent-400/60" fill="currentColor"><path d="M9.5 6C6.5 7.5 5 10.2 5 14v4h6v-6H8.2c.2-2 1.2-3.4 3-4.3L9.5 6Zm9 0C15.5 7.5 14 10.2 14 14v4h6v-6h-2.8c.2-2 1.2-3.4 3-4.3L18.5 6Z"/></svg>
        <blockquote class="mt-5 flex-1 text-[16.5px] leading-relaxed text-brand-900/75 font-light">“<?= $q ?>”</blockquote>
        <figcaption class="mt-7 pt-5 border-t border-black/[0.07] flex items-center justify-between">
          <span class="text-[13.5px] text-brand-900/50"><?= $who ?></span>
          <span class="rounded-full bg-sand px-2.5 py-1 text-[12px] text-brand-900/60"><?= $tag ?></span>
        </figcaption>
      </figure>
      <?php endforeach; ?>
    </div>

    <p class="mt-8 text-center text-[12.5px] text-brand-900/35 max-w-2xl mx-auto">
      Patient experiences vary. Testimonials reflect individual results and are not a guarantee of outcome.
    </p>
  </div>
</section>

<!-- ══════════════════ FAQ ══════════════════ -->
<section id="faq" class="py-24 lg:py-32 bg-sand/60">
  <div class="mx-auto max-w-8xl px-6 lg:px-10">
    <div class="grid lg:grid-cols-12 gap-14">

      <div class="lg:col-span-4 reveal">
        <p class="text-[12px] uppercase tracking-[0.24em] text-accent-600 font-semibold">Questions</p>
        <h2 class="mt-5 font-display text-4xl lg:text-[2.9rem] leading-[1.1] tracking-tightest text-brand-900 font-light">
          Good to know before you call.
        </h2>
        <p class="mt-6 text-[15.5px] leading-relaxed text-brand-900/60">
          Still unsure? A short phone call answers most of it. Reach us at
          <a href="tel:<?= $PHONE_LINK ?>" class="text-accent-600 font-medium hover:underline"><?= $PHONE_DISPLAY ?></a>.
        </p>
      </div>

      <div class="lg:col-span-8 reveal" style="transition-delay:.1s">
        <?php
        $faqs = [
          ['Do you take my insurance?',
           'Most insurance plans are accepted for medication management, TMS, Spravato and ECT. Coverage details vary by plan and by treatment, so our team verifies your benefits before anything begins — and handles prior authorizations on your behalf.'],
          ['Does TMS hurt, and will I need time off?',
           'TMS is non-invasive and requires no sedation. Most people describe a tapping sensation on the scalp that fades after the first few sessions. You stay awake, sessions run about 20 minutes, and you can drive yourself to work or home immediately afterward.'],
          ['How is Spravato different from ketamine infusions?',
           'Spravato is FDA-approved intranasal esketamine, administered in a REMS-certified office under clinical monitoring — which also means it is far more likely to be covered by insurance than off-label IV ketamine. You remain with us for a monitoring period after each dose and will need a ride home.'],
          ['Is ECT still used, and is it safe?',
           'Yes. Modern ECT is performed under anesthesia with carefully targeted protocols, and it remains the most effective treatment available for severe, treatment-resistant depression and catatonia. We discuss the cognitive considerations openly so the decision is genuinely informed.'],
          ['Do I need a referral to be seen?',
           'No referral is required to schedule with us. If you are already working with a therapist or primary care provider, we are glad to coordinate care so everyone stays aligned.'],
          ['Do you see teens, or only adults?',
           'Our services are expanding to include teens and adolescents alongside adult and geriatric care. Call us to confirm current availability for a specific age and treatment.'],
          ['Can everything be done by telehealth?',
           'Evaluations, medication management and follow-up visits can be done virtually anywhere in Arizona. TMS, Spravato and ECT require in-person visits because they are delivered and monitored on site.'],
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
  <div class="pointer-events-none absolute -left-40 bottom-0 h-[32rem] w-[32rem] rounded-full bg-brand-600/45 blur-[120px]"></div>
  <div class="pointer-events-none absolute right-0 -top-24 h-[28rem] w-[28rem] rounded-full bg-accent-500/15 blur-[120px]"></div>

  <div class="relative mx-auto max-w-8xl px-6 lg:px-10 py-24 lg:py-32">
    <div class="grid lg:grid-cols-12 gap-12 lg:gap-16 items-center">

      <div class="lg:col-span-5 reveal">
        <p class="text-[12px] uppercase tracking-[0.24em] text-accent-400 font-semibold">Get started</p>
        <h2 class="mt-5 font-display text-4xl lg:text-[3.1rem] leading-[1.08] tracking-tightest font-light">
          Let's find what<br> finally works.
        </h2>
        <p class="mt-6 text-[16.5px] leading-relaxed text-cream/65 font-light max-w-md">
          Call us directly, or send a request from the top of the page. We'll start with a
          free 15-minute conversation — no commitment, no pressure.
        </p>

        <div class="mt-9 flex flex-col sm:flex-row gap-3.5">
          <a href="tel:<?= $PHONE_LINK ?>" class="inline-flex items-center justify-center gap-2.5 rounded-full bg-accent-500 px-7 py-4 text-[15.5px] font-medium text-white hover:bg-accent-600 transition shadow-lg shadow-accent-500/20">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" class="h-4 w-4"><path d="M4 5.5C4 4.7 4.7 4 5.5 4h2c.7 0 1.3.5 1.5 1.2l.6 2.4c.1.6-.1 1.2-.6 1.5l-1.2.9a12 12 0 0 0 5.2 5.2l.9-1.2c.4-.5 1-.7 1.5-.6l2.4.6c.7.2 1.2.8 1.2 1.5v2c0 .8-.7 1.5-1.5 1.5A15.5 15.5 0 0 1 4 5.5Z"/></svg>
            Call <?= $PHONE_DISPLAY ?>
          </a>
          <a href="#consult" class="group inline-flex items-center justify-center gap-2 rounded-full border border-white/20 bg-white/5 px-7 py-4 text-[15.5px] font-medium text-cream hover:bg-white/10 transition backdrop-blur">
            Request a consult
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-4 w-4 transition-transform group-hover:-translate-y-0.5"><path d="M12 19V5M5 12l7-7 7 7"/></svg>
          </a>
        </div>
      </div>

      <div class="lg:col-span-7 reveal" style="transition-delay:.12s">
        <div class="grid sm:grid-cols-2 gap-4">
          <?php
          $details = [
            ['Phone',  $PHONE_DISPLAY,                       'tel:' . $PHONE_LINK,   'M4 5.5C4 4.7 4.7 4 5.5 4h2c.7 0 1.3.5 1.5 1.2l.6 2.4c.1.6-.1 1.2-.6 1.5l-1.2.9a12 12 0 0 0 5.2 5.2l.9-1.2c.4-.5 1-.7 1.5-.6l2.4.6c.7.2 1.2.8 1.2 1.5v2c0 .8-.7 1.5-1.5 1.5A15.5 15.5 0 0 1 4 5.5Z'],
            ['Email',  $EMAIL,                                'mailto:' . $EMAIL,     'M3.5 7.5A2 2 0 0 1 5.5 6h13a2 2 0 0 1 2 1.5v9a2 2 0 0 1-2 2h-13a2 2 0 0 1-2-2v-9Zm.5-.5 8 6 8-6'],
            ['Office', $ADDRESS_L1 . '<br>' . $ADDRESS_L2,    null,                   'M12 21s7-5.6 7-11a7 7 0 1 0-14 0c0 5.4 7 11 7 11Z'],
            ['Hours',  'Monday – Friday<br>8:00am – 5:00pm',  null,                   'M12 3.5a8.5 8.5 0 1 0 0 17 8.5 8.5 0 0 0 0-17ZM12 7.5V12l3 2'],
          ];
          foreach ($details as $i => [$label, $value, $href, $icon]):
            $Tag = $href ? 'a' : 'div';
          ?>
          <<?= $Tag ?> <?= $href ? 'href="' . $href . '"' : '' ?> class="group rounded-2xl border border-white/12 bg-white/[0.04] p-6 <?= $href ? 'hover:bg-white/[0.08] hover:border-white/25' : '' ?> transition">
            <span class="grid place-items-center h-10 w-10 rounded-xl bg-white/8 text-accent-400">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5"><path d="<?= $icon ?>"/></svg>
            </span>
            <p class="mt-5 text-[12px] uppercase tracking-[0.16em] text-cream/40"><?= $label ?></p>
            <p class="mt-1.5 text-[16.5px] leading-snug text-cream <?= $href ? 'group-hover:text-accent-400 transition' : '' ?>"><?= $value ?></p>
          </<?= $Tag ?>>
          <?php endforeach; ?>
        </div>
      </div>

    </div>

    <!-- crisis notice -->
    <div class="reveal mt-12 rounded-2xl border border-accent-400/25 bg-accent-500/10 px-6 py-5 flex flex-col sm:flex-row sm:items-center gap-4">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" class="h-6 w-6 text-accent-400 shrink-0"><path d="M12 8.5v4.5M12 16.5h.01"/><path d="M10.3 3.9 2.6 17.3A2 2 0 0 0 4.3 20.3h15.4a2 2 0 0 0 1.7-3L13.7 3.9a2 2 0 0 0-3.4 0Z"/></svg>
      <p class="text-[14.5px] leading-relaxed text-cream/75">
        <span class="font-semibold text-cream">In crisis?</span> If you or someone you know is in immediate danger, call 911.
        For 24/7 support, call or text <a href="tel:988" class="font-semibold text-accent-400 hover:underline">988</a> — the Suicide &amp; Crisis Lifeline.
      </p>
    </div>
  </div>
</section>

<!-- ══════════════════ FOOTER ══════════════════ -->
<footer class="bg-brand-950 border-t border-white/10 text-cream/60">
  <div class="mx-auto max-w-8xl px-6 lg:px-10 py-14">
    <div class="grid md:grid-cols-12 gap-10">

      <div class="md:col-span-5">
        <div class="flex items-center gap-3">
          <span class="grid place-items-center h-10 w-10 rounded-xl bg-white/10 text-cream">
            <svg viewBox="0 0 24 24" fill="none" class="h-5 w-5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round">
              <path d="M9 3.5a2.5 2.5 0 0 0-2.5 2.5v.2A2.7 2.7 0 0 0 4 8.9c0 .9.4 1.7 1.1 2.2A2.7 2.7 0 0 0 4 13.3c0 1.2.8 2.2 1.9 2.6A2.5 2.5 0 0 0 9 20.5c1.1 0 2-.7 2.4-1.6"/>
              <path d="M15 3.5A2.5 2.5 0 0 1 17.5 6v.2a2.7 2.7 0 0 1 2.5 2.7c0 .9-.4 1.7-1.1 2.2a2.7 2.7 0 0 1 1.1 2.2c0 1.2-.8 2.2-1.9 2.6a2.5 2.5 0 0 1-3.1 3.9"/>
              <path d="M12 5v14"/>
            </svg>
          </span>
          <span class="leading-none">
            <span class="block font-display text-[17px] tracking-tightest text-cream">Interventional Psychiatry</span>
            <span class="block text-[11px] tracking-[0.22em] uppercase text-cream/40 mt-1">of Arizona</span>
          </span>
        </div>
        <p class="mt-6 text-[14.5px] leading-relaxed max-w-sm">
          Advanced psychiatric care for Phoenix and all of Arizona — TMS, Spravato, ECT
          and expert medication management, delivered by a team that stays with you.
        </p>
      </div>

      <div class="md:col-span-2">
        <p class="text-[12px] uppercase tracking-[0.18em] text-cream/35">Treatments</p>
        <ul class="mt-5 space-y-3 text-[14.5px]">
          <?php foreach (['TMS Therapy','Spravato®','ECT','Medication Management','ADHD Assessment'] as $l): ?>
          <li><a href="#treatments" class="hover:text-accent-400 transition"><?= $l ?></a></li>
          <?php endforeach; ?>
        </ul>
      </div>

      <div class="md:col-span-2">
        <p class="text-[12px] uppercase tracking-[0.18em] text-cream/35">Practice</p>
        <ul class="mt-5 space-y-3 text-[14.5px]">
          <li><a href="#team" class="hover:text-accent-400 transition">Our Team</a></li>
          <li><a href="#conditions" class="hover:text-accent-400 transition">Conditions</a></li>
          <li><a href="#process" class="hover:text-accent-400 transition">New Patients</a></li>
          <li><a href="#faq" class="hover:text-accent-400 transition">FAQ</a></li>
          <li><a href="#contact" class="hover:text-accent-400 transition">Contact</a></li>
        </ul>
      </div>

      <div class="md:col-span-3">
        <p class="text-[12px] uppercase tracking-[0.18em] text-cream/35">Visit</p>
        <ul class="mt-5 space-y-3 text-[14.5px]">
          <li><?= $ADDRESS_L1 ?><br><?= $ADDRESS_L2 ?></li>
          <li><a href="tel:<?= $PHONE_LINK ?>" class="hover:text-accent-400 transition"><?= $PHONE_DISPLAY ?></a></li>
          <li><a href="mailto:<?= $EMAIL ?>" class="hover:text-accent-400 transition"><?= $EMAIL ?></a></li>
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
      provider with questions about a medical condition. Spravato® is a registered trademark of its respective owner.
    </p>
  </div>
</footer>

<script>
/* ---------- mobile menu ---------- */
const menuBtn = document.getElementById('menuBtn');
const mobileMenu = document.getElementById('mobileMenu');
menuBtn.addEventListener('click', () => mobileMenu.classList.toggle('hidden'));
mobileMenu.querySelectorAll('a').forEach(a => a.addEventListener('click', () => mobileMenu.classList.add('hidden')));

/* ---------- nav shadow on scroll ---------- */
const nav = document.getElementById('nav');
const onScroll = () => nav.classList.toggle('shadow-[0_1px_24px_rgba(10,28,27,0.08)]', window.scrollY > 12);
onScroll();
window.addEventListener('scroll', onScroll, { passive: true });

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

/* ---------- contact form (front-end only for now) ---------- */
document.getElementById('contactForm').addEventListener('submit', (e) => {
  e.preventDefault();
  const note = document.getElementById('formNote');
  note.textContent = 'Thank you — your request has been received. A member of our team will reach out within one business day.';
  note.classList.remove('hidden');
  e.target.querySelectorAll('input, textarea').forEach(f => f.value = '');
});
</script>
</body>
</html>
