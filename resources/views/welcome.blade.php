<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
<title>{{ $settings->bride_name ?? 'Wifda' }} & {{ $settings->groom_name ?? 'Nama Anda' }} — The Wedding</title>
<meta name="description" content="Undangan Pernikahan Digital {{ $settings->bride_name ?? 'Wifda' }} & {{ $settings->groom_name ?? 'Nama Anda' }}">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,300;0,9..144,400;0,9..144,500;0,9..144,600;1,9..144,400;1,9..144,500;1,9..144,600&family=Manrope:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<style>
/* ============================================================
   0. ROOT TOKENS — LUXURY PALETTE (TERHUBUNG KE CMS)
   ============================================================ */
:root{
  --navy: #0B1220;
  --navy-light: #131C2E;
  --navy-glass: rgba(19, 28, 46, 0.55);
  
  /* WARNA BACKGROUND & TEKS DARI ADMIN CMS */
  --ivory: {{ $settings->theme_bg_color ?? '#FBF6EC' }};
  --charcoal: {{ $settings->theme_text_color ?? '#1E1C1A' }};
  
  --ivory-dark: #F2E9D8;
  --gold: #C9A24B;
  --gold-light: #E4C878;
  --gold-soft: rgba(201, 162, 75, 0.18);
  --bronze: #8C6B2F;
  --rose: #D9A9A0;
  --rose-soft: rgba(217, 169, 160, 0.16);

  --font-display: 'Fraunces', serif;
  --font-body: 'Manrope', sans-serif;

  --radius-lg: 28px;
  --radius-md: 18px;
  --radius-sm: 10px;

  --ease-lux: cubic-bezier(.22,1,.36,1);
  --dur-slow: 1.1s;
  --dur-med: .6s;
  --dur-fast: .3s;

  --shadow-gold: 0 8px 30px rgba(201,162,75,.25);
  --shadow-deep: 0 20px 60px rgba(0,0,0,.35);
}

*{ margin:0; padding:0; box-sizing:border-box; }
html{ scroll-behavior:smooth; }
body{
  font-family: var(--font-body);
  background: var(--ivory);
  color: var(--charcoal);
  overflow-x:hidden;
  -webkit-font-smoothing:antialiased;
  text-rendering:optimizeLegibility;
}
::selection{ background:var(--gold-soft); color:var(--bronze); }
::-webkit-scrollbar{ width:6px; }
::-webkit-scrollbar-thumb{ background:var(--gold); border-radius:10px; }
::-webkit-scrollbar-track{ background:var(--ivory-dark); }

img{ max-width:100%; display:block; }
button{ font-family:inherit; cursor:pointer; border:none; background:none; }
a{ text-decoration:none; color:inherit; }

/* reduced motion */
@media (prefers-reduced-motion: reduce){
  *, *::before, *::after{ animation-duration:.01ms !important; animation-iteration-count:1 !important; transition-duration:.01ms !important; scroll-behavior:auto !important; }
}

.container{ max-width:520px; margin:0 auto; padding:0 24px; position:relative; }
.section{ position:relative; padding:96px 0 88px; overflow:hidden; }
.eyebrow{
  font-family:var(--font-body); font-weight:700; letter-spacing:.28em; text-transform:uppercase;
  font-size:11px; color:var(--gold); display:flex; align-items:center; gap:10px; justify-content:center; margin-bottom:14px;
}
.eyebrow::before, .eyebrow::after{ content:''; width:22px; height:1px; background:var(--gold); opacity:.6; }
.section-title{
  font-family:var(--font-display); font-weight:500; font-size:clamp(30px,7vw,42px);
  text-align:center; color:var(--charcoal); line-height:1.15; margin-bottom:8px;
}
.section-title em{ font-style:italic; color:var(--bronze); font-weight:400; }
.section-sub{
  text-align:center; font-size:14.5px; color:#6b655c; max-width:340px; margin:0 auto 44px; line-height:1.7;
}
.divider-orn{ display:flex; align-items:center; justify-content:center; gap:12px; margin:0 auto 40px; }
.divider-orn span{ width:5px; height:5px; border-radius:50%; background:var(--gold); }
.divider-orn i{ width:60px; height:1px; background:linear-gradient(90deg, transparent, var(--gold), transparent); }

/* reveal-on-scroll */
.reveal{ opacity:0; transform:translateY(36px); transition: opacity var(--dur-slow) var(--ease-lux), transform var(--dur-slow) var(--ease-lux); }
.reveal.in-view{ opacity:1; transform:translateY(0); }
.reveal-scale{ opacity:0; transform:scale(.92); transition: opacity var(--dur-slow) var(--ease-lux), transform var(--dur-slow) var(--ease-lux); }
.reveal-scale.in-view{ opacity:1; transform:scale(1); }
.stagger > *{ transition-delay: calc(var(--i, 0) * 90ms); }

/* glass */
.glass{
  background: rgba(255,255,255,.55);
  backdrop-filter: blur(18px) saturate(140%);
  -webkit-backdrop-filter: blur(18px) saturate(140%);
  border:1px solid rgba(255,255,255,.6);
}
.glass-dark{
  background: var(--navy-glass);
  backdrop-filter: blur(18px) saturate(140%);
  -webkit-backdrop-filter: blur(18px) saturate(140%);
  border:1px solid rgba(255,255,255,.08);
}

/* buttons */
.btn{
  display:inline-flex; align-items:center; justify-content:center; gap:10px;
  padding:15px 30px; border-radius:100px; font-weight:600; font-size:14px; letter-spacing:.02em;
  transition: transform var(--dur-fast) var(--ease-lux), box-shadow var(--dur-fast) var(--ease-lux), background var(--dur-fast);
}
.btn:active{ transform:scale(.96); }
.btn-gold{ background:linear-gradient(135deg, var(--gold-light), var(--gold)); color:#241a08; box-shadow:var(--shadow-gold); }
.btn-gold:hover{ box-shadow:0 12px 36px rgba(201,162,75,.4); }
.btn-outline{ border:1.4px solid var(--gold); color:var(--bronze); background:transparent; }
.btn-outline:hover{ background:var(--gold-soft); }
.btn-ghost-dark{ background:rgba(255,255,255,.08); color:var(--ivory); border:1px solid rgba(255,255,255,.15); }
.btn-block{ width:100%; }

/* ============================================================
   1. COVER / HERO — ENVELOPE UNLOCK
   ============================================================ */
#cover{
  position:fixed; inset:0; z-index:999; background: radial-gradient(ellipse at top, #16223b, var(--navy) 60%);
  display:flex; flex-direction:column; align-items:center; justify-content:center;
  overflow:hidden; transition: opacity 1s var(--ease-lux), visibility 1s;
}
#cover.opened{ opacity:0; visibility:hidden; pointer-events:none; }
#cover .bg-photo{
  position:absolute; inset:0; background-size:cover; background-position:center;
  background-image:linear-gradient(180deg, rgba(11,18,32,.55), rgba(11,18,32,.92)), url('{{ $settings->cover_photo_url ?? "https://images.unsplash.com/photo-1519741497674-611481863552?q=80&w=1200&auto=format&fit=crop" }}');
  opacity:.55;
}
.gold-particles{ position:absolute; inset:0; pointer-events:none; }
.gold-particles span{
  position:absolute; width:3px; height:3px; border-radius:50%; background:var(--gold-light);
  opacity:.7; filter:blur(.3px); animation: floatUp linear infinite;
}
@keyframes floatUp{
  0%{ transform:translateY(0) translateX(0); opacity:0; }
  10%{ opacity:.8; }
  90%{ opacity:.4; }
  100%{ transform:translateY(-100vh) translateX(20px); opacity:0; }
}

.cover-inner{ position:relative; z-index:2; text-align:center; color:var(--ivory); padding:0 30px; width:100%; }
.cover-eyebrow{
  font-size:11px; letter-spacing:.35em; text-transform:uppercase; color:var(--gold-light); font-weight:700; margin-bottom:22px;
  opacity:.9;
}
.cover-guest-label{ font-size:12px; color:rgba(251,246,236,.6); margin-bottom:6px; letter-spacing:.05em; }
.cover-guest-name{ font-family:var(--font-display); font-style:italic; font-size:19px; color:var(--gold-light); margin-bottom:34px; }

.seal-wrap{ position:relative; width:150px; height:150px; margin:0 auto 34px; }
.seal{
  width:150px; height:150px; border-radius:50%; display:flex; align-items:center; justify-content:center;
  background: radial-gradient(circle at 32% 28%, var(--gold-light), var(--gold) 55%, var(--bronze) 100%);
  box-shadow: 0 0 0 6px rgba(201,162,75,.12), 0 20px 50px rgba(0,0,0,.5), inset 0 2px 6px rgba(255,255,255,.4);
  cursor:pointer; transition: transform .6s var(--ease-lux);
  animation: sealBreath 3.4s ease-in-out infinite;
}
@keyframes sealBreath{ 0%,100%{ transform:scale(1); } 50%{ transform:scale(1.035); } }
.seal.cracking{ animation:none; transform:scale(1.12) rotate(4deg); }
.seal-monogram{ font-family:var(--font-display); font-style:italic; font-size:34px; color:#2a1c08; letter-spacing:1px; }
.seal-ring{
  position:absolute; inset:-14px; border:1px solid rgba(201,162,75,.4); border-radius:50%;
  animation: ringSpin 18s linear infinite;
}
.seal-ring::before, .seal-ring::after{ content:''; position:absolute; width:5px; height:5px; border-radius:50%; background:var(--gold-light); }
.seal-ring::before{ top:-2.5px; left:50%; }
.seal-ring::after{ bottom:-2.5px; left:50%; }
@keyframes ringSpin{ to{ transform:rotate(360deg); } }

.cover-title{ font-family:var(--font-display); font-weight:400; font-size:clamp(34px,9vw,50px); line-height:1.1; margin-bottom:6px; }
.cover-title em{ font-style:italic; color:var(--gold-light); display:block; font-size:0.95em; }
.cover-amp{ font-size:20px; color:var(--gold); margin:2px 0; font-style:italic; font-family:var(--font-display); }
.cover-date{ font-size:13.5px; letter-spacing:.12em; color:rgba(251,246,236,.75); margin:16px 0 36px; text-transform:uppercase; }

.btn-open{
  display:inline-flex; align-items:center; gap:12px; padding:16px 32px; border-radius:100px;
  background:linear-gradient(135deg, var(--gold-light), var(--gold));
  color:#241a08; font-weight:700; font-size:13.5px; letter-spacing:.08em; text-transform:uppercase;
  box-shadow: var(--shadow-gold);
  animation: pulseCta 2.6s ease-in-out infinite;
}
@keyframes pulseCta{ 0%,100%{ box-shadow:0 0 0 0 rgba(201,162,75,.5), var(--shadow-gold); } 50%{ box-shadow:0 0 0 10px rgba(201,162,75,0), var(--shadow-gold); } }
.btn-open svg{ width:16px; height:16px; }

/* ============================================================
   2. FLOATING BOTTOM NAV
   ============================================================ */
#bottom-nav{
  position:fixed; left:50%; bottom:20px; transform:translate(-50%, 120%);
  display:flex; gap:4px; padding:8px; border-radius:100px; z-index:500;
  transition: transform .7s var(--ease-lux);
  box-shadow: var(--shadow-deep);
}
#bottom-nav.show{ transform:translate(-50%, 0); }
.nav-item{
  display:flex; flex-direction:column; align-items:center; justify-content:center; gap:2px;
  width:52px; height:52px; border-radius:50%; color:rgba(251,246,236,.55);
  transition: color var(--dur-fast), background var(--dur-fast);
  position:relative;
}
.nav-item svg{ width:19px; height:19px; }
.nav-item span{ font-size:8.5px; letter-spacing:.03em; font-weight:600; }
.nav-item.active{ color:var(--gold-light); background:rgba(201,162,75,.16); }

/* ============================================================
   3. AMBIENT MUSIC TOGGLE
   ============================================================ */
#music-toggle{
  position:fixed; top:20px; right:20px; z-index:600; width:46px; height:46px; border-radius:50%;
  display:flex; align-items:center; justify-content:center; color:var(--gold-light);
  transform: translateY(-120%); transition: transform .7s var(--ease-lux);
  box-shadow: var(--shadow-deep);
}
#music-toggle.show{ transform:translateY(0); }
#music-toggle svg{ width:18px; height:18px; }
#music-toggle .disc{
  position:absolute; inset:0; border-radius:50%; border:1.5px dashed rgba(201,162,75,.4);
  animation: ringSpin 6s linear infinite;
}
#music-toggle.playing .disc{ animation-play-state:running; }
#music-toggle.paused .disc{ animation-play-state:paused; }

/* ============================================================
   4. WELCOME / QUOTE SECTION
   ============================================================ */
#welcome{ background: var(--ivory); text-align:center; }
.welcome-verse{
  font-family:var(--font-display); font-style:italic; font-size:clamp(18px,4.6vw,22px);
  line-height:1.85; color:#3a352c; max-width:380px; margin:0 auto 22px;
}
.welcome-ref{ font-size:12px; letter-spacing:.15em; color:var(--bronze); text-transform:uppercase; }

/* ============================================================
   5. COUPLE SECTION
   ============================================================ */
#couple{
  background: linear-gradient(180deg, var(--ivory) 0%, var(--ivory-dark) 100%);
}
.couple-card{
  display:flex; flex-direction:column; align-items:center; text-align:center; margin-bottom:56px;
}
.couple-photo-wrap{
  width:180px; height:220px; border-radius:var(--radius-lg); overflow:hidden; margin-bottom:22px;
  position:relative; box-shadow: var(--shadow-gold);
  border:3px solid var(--ivory);
  outline: 1px solid var(--gold-soft);
}
.couple-photo-wrap img{ width:100%; height:100%; object-fit:cover; }
.couple-photo-wrap::after{
  content:''; position:absolute; inset:0; border:1px solid rgba(201,162,75,.5); border-radius:inherit;
}
.couple-name{ font-family:var(--font-display); font-style:italic; font-size:28px; color:var(--charcoal); margin-bottom:4px; }
.couple-fullname{ font-size:12.5px; color:#8a8375; letter-spacing:.04em; margin-bottom:14px; }
.couple-desc{ font-size:14px; line-height:1.8; color:#5c564b; max-width:300px; margin-bottom:16px; }
.couple-tag{
  display:inline-flex; align-items:center; gap:6px; font-size:11px; font-weight:700; letter-spacing:.1em;
  text-transform:uppercase; padding:6px 14px; border-radius:100px; margin-bottom:16px;
}
.tag-groom{ background:var(--gold-soft); color:var(--bronze); }
.tag-bride{ background:var(--rose-soft); color:#a5645a; }
.couple-social{ display:flex; gap:10px; }
.couple-social a{
  width:38px; height:38px; border-radius:50%; display:flex; align-items:center; justify-content:center;
  background:#fff; color:var(--bronze); box-shadow:0 6px 18px rgba(0,0,0,.08); transition:transform .25s;
}
.couple-social a:hover{ transform:translateY(-3px); color:var(--gold); }
.couple-social svg{ width:16px; height:16px; }

.amp-divider{
  display:flex; align-items:center; justify-content:center; gap:16px; margin:-8px 0 42px;
}
.amp-divider .amp-text{ font-family:var(--font-display); font-style:italic; font-size:30px; color:var(--gold); }
.amp-divider i{ width:40px; height:1px; background:var(--gold); opacity:.5; }

/* ============================================================
   6. EVENT / COUNTDOWN SECTION
   ============================================================ */
#event{
  background: var(--navy); color:var(--ivory); position:relative;
}
#event::before{
  content:''; position:absolute; inset:0; opacity:.06; pointer-events:none;
  background-image: radial-gradient(circle, var(--gold) 1px, transparent 1px);
  background-size:26px 26px;
}
#event .section-title, #event .eyebrow{ color:var(--ivory); }
#event .section-title em{ color:var(--gold-light); }
#event .section-sub{ color:rgba(251,246,236,.6); }

.countdown-grid{ display:grid; grid-template-columns:repeat(4,1fr); gap:10px; margin-bottom:48px; }
.cd-box{
  padding:16px 4px; border-radius:var(--radius-md); text-align:center;
}
.cd-num{ font-family:var(--font-display); font-size:28px; color:var(--gold-light); font-weight:500; }
.cd-label{ font-size:9.5px; letter-spacing:.1em; text-transform:uppercase; color:rgba(251,246,236,.55); margin-top:4px; }

.event-card{
  border-radius:var(--radius-lg); padding:28px 24px; margin-bottom:20px; position:relative;
}
.event-card-head{ display:flex; align-items:center; gap:12px; margin-bottom:16px; }
.event-icon{
  width:42px; height:42px; border-radius:50%; background:var(--gold-soft); display:flex; align-items:center; justify-content:center; flex-shrink:0;
}
.event-icon svg{ width:19px; height:19px; color:var(--gold-light); }
.event-card-title{ font-family:var(--font-display); font-size:19px; color:var(--gold-light); }
.event-detail-row{ font-size:13.5px; color:rgba(251,246,236,.8); line-height:1.7; margin-bottom:14px; }
.event-detail-row b{ color:var(--ivory); font-weight:600; }

/* ============================================================
   7. GALLERY (MASONRY) + STORY TIMELINE
   ============================================================ */
#gallery{ background:var(--ivory); }
.masonry{ display:grid; grid-template-columns:1fr 1fr; gap:10px; }
.masonry figure{ overflow:hidden; border-radius:var(--radius-md); position:relative; box-shadow:0 10px 26px rgba(0,0,0,.08); }
.masonry figure:nth-child(1){ grid-row: span 2; }
.masonry figure:nth-child(4){ grid-row: span 2; }
.masonry img{ width:100%; height:100%; object-fit:cover; transition:transform .6s var(--ease-lux); }
.masonry figure:hover img{ transform:scale(1.08); }
.masonry figure::after{ content:''; position:absolute; inset:0; border:1px solid rgba(201,162,75,.25); border-radius:inherit; pointer-events:none; }

#story{ background:linear-gradient(180deg, var(--ivory) 0%, #fff 100%); }
.timeline{ position:relative; padding-left:30px; }
.timeline::before{ content:''; position:absolute; left:6px; top:6px; bottom:6px; width:1px; background:linear-gradient(180deg, var(--gold), transparent); }
.timeline-item{ position:relative; padding-bottom:38px; }
.timeline-item:last-child{ padding-bottom:0; }
.timeline-dot{
  position:absolute; left:-30px; top:2px; width:13px; height:13px; border-radius:50%;
  background:var(--ivory); border:2px solid var(--gold); box-shadow:0 0 0 4px var(--ivory);
}
.timeline-year{ font-size:11px; font-weight:700; letter-spacing:.1em; color:var(--gold); text-transform:uppercase; margin-bottom:4px; }
.timeline-title{ font-family:var(--font-display); font-size:19px; margin-bottom:6px; color:var(--charcoal); }
.timeline-text{ font-size:13.5px; line-height:1.75; color:#6b655c; }

/* ============================================================
   8. DIGITAL ENVELOPE
   ============================================================ */
#envelope{ background:var(--navy); color:var(--ivory); }
#envelope .section-title, #envelope .eyebrow{ color:var(--ivory); }
#envelope .section-title em{ color:var(--gold-light); }
#envelope .section-sub{ color:rgba(251,246,236,.6); }

.wallet-card{
  border-radius:var(--radius-lg); padding:22px; margin-bottom:16px; display:flex; align-items:center; gap:16px;
}
.wallet-logo{
  width:50px; height:50px; border-radius:14px; background:var(--gold-soft); display:flex; align-items:center; justify-content:center;
  font-family:var(--font-display); font-weight:600; color:var(--gold-light); font-size:15px; flex-shrink:0;
}
.wallet-info{ flex:1; min-width:0; }
.wallet-bank{ font-size:11px; letter-spacing:.08em; text-transform:uppercase; color:rgba(251,246,236,.5); margin-bottom:3px; }
.wallet-number{ font-family:var(--font-display); font-size:18px; letter-spacing:.03em; color:var(--ivory); }
.wallet-owner{ font-size:12px; color:rgba(251,246,236,.55); margin-top:2px; }
.copy-btn{
  width:40px; height:40px; border-radius:50%; background:rgba(255,255,255,.08); display:flex; align-items:center; justify-content:center;
  color:var(--gold-light); flex-shrink:0; transition:background .25s, transform .25s;
}
.copy-btn:active{ transform:scale(.9); }
.copy-btn.copied{ background:var(--gold); color:#241a08; }
.copy-btn svg{ width:16px; height:16px; }

.qr-wrap{ text-align:center; margin-top:28px; }
.qr-box{
  width:170px; height:170px; margin:0 auto 12px; border-radius:var(--radius-md); background:#fff; padding:12px;
  box-shadow:var(--shadow-gold);
}
.qr-box img{ width:100%; height:100%; object-fit:contain; }
.qr-caption{ font-size:12px; color:rgba(251,246,236,.55); }

/* ============================================================
   9. RSVP & GUESTBOOK
   ============================================================ */
#rsvp{ background:var(--ivory); }
.rsvp-form{
  background:#fff; border-radius:var(--radius-lg); padding:26px 22px; box-shadow:0 16px 44px rgba(0,0,0,.06); margin-bottom:44px;
}
.form-group{ margin-bottom:16px; }
.form-label{ font-size:12px; font-weight:700; letter-spacing:.05em; text-transform:uppercase; color:var(--bronze); margin-bottom:8px; display:block; }
.form-input, .form-textarea{
  width:100%; padding:13px 16px; border-radius:var(--radius-sm); border:1.4px solid #e8e1d3; background:var(--ivory);
  font-family:var(--font-body); font-size:14px; color:var(--charcoal); transition:border-color .25s, box-shadow .25s;
}
.form-input:focus, .form-textarea:focus{ outline:none; border-color:var(--gold); box-shadow:0 0 0 4px var(--gold-soft); }
.form-textarea{ resize:vertical; min-height:90px; }
.attend-toggle{ display:flex; gap:10px; }
.attend-opt{
  flex:1; padding:13px; border-radius:var(--radius-sm); border:1.4px solid #e8e1d3; text-align:center; font-size:13.5px; font-weight:600;
  color:#8a8375; transition:all .25s;
}
.attend-opt.selected{ border-color:var(--gold); background:var(--gold-soft); color:var(--bronze); }
.reply-banner{
  display:none; align-items:center; justify-content:space-between; background:var(--gold-soft); border-radius:var(--radius-sm);
  padding:10px 14px; font-size:12.5px; color:var(--bronze); margin-bottom:14px;
}
.reply-banner.show{ display:flex; }
.reply-banner button{ color:var(--bronze); font-weight:700; }
.form-msg{ font-size:12.5px; text-align:center; margin-top:10px; min-height:16px; }
.form-msg.error{ color:#b5453a; }
.form-msg.success{ color:#3a7d5c; }

.guestbook-head{ display:flex; align-items:baseline; justify-content:space-between; margin-bottom:22px; }
.guestbook-count{ font-size:12.5px; color:var(--bronze); font-weight:600; }
#comment-list{ display:flex; flex-direction:column; gap:16px; }
.comment-card{
  background:#fff; border-radius:var(--radius-md); padding:18px; box-shadow:0 8px 24px rgba(0,0,0,.05);
}
.comment-head{ display:flex; align-items:center; gap:10px; margin-bottom:10px; }
.comment-avatar{
  width:38px; height:38px; border-radius:50%; background:linear-gradient(135deg, var(--gold-light), var(--gold));
  display:flex; align-items:center; justify-content:center; font-family:var(--font-display); font-weight:600; color:#241a08; font-size:15px; flex-shrink:0;
}
.comment-name-row{ display:flex; align-items:center; gap:6px; flex-wrap:wrap; }
.comment-name{ font-weight:700; font-size:14px; color:var(--charcoal); }
.badge-admin{ font-size:9px; font-weight:700; letter-spacing:.05em; text-transform:uppercase; background:var(--navy); color:var(--gold-light); padding:2px 7px; border-radius:100px; }
.badge-attend{ font-size:10px; font-weight:700; padding:2px 9px; border-radius:100px; }
.badge-attend.yes{ background:#e4f2ea; color:#3a7d5c; }
.badge-attend.no{ background:#f6e9e7; color:#b5453a; }
.comment-time{ font-size:11px; color:#a39d90; }
.comment-text{ font-size:13.8px; line-height:1.7; color:#3f3a32; margin-bottom:10px; word-break:break-word; }
.comment-actions{ display:flex; gap:16px; }
.comment-action-btn{ display:flex; align-items:center; gap:5px; font-size:12px; font-weight:600; color:#8a8375; transition:color .2s; }
.comment-action-btn svg{ width:14px; height:14px; }
.comment-action-btn.liked{ color:#b5453a; }
.comment-action-btn:hover{ color:var(--bronze); }
.comment-replies{ margin-top:14px; padding-left:18px; border-left:1.5px solid var(--gold-soft); display:flex; flex-direction:column; gap:12px; }
.comment-empty{ text-align:center; padding:30px 0; color:#a39d90; font-size:13.5px; }
.comment-loading{ text-align:center; padding:20px 0; color:#a39d90; font-size:13px; }
.load-more-wrap{ text-align:center; margin-top:20px; }

/* ============================================================
   10. FOOTER
   ============================================================ */
#footer{ background:var(--navy); color:rgba(251,246,236,.6); text-align:center; padding:64px 0 40px; }
.footer-monogram{ font-family:var(--font-display); font-style:italic; font-size:32px; color:var(--gold-light); margin-bottom:10px; }
.footer-text{ font-size:12.5px; line-height:1.8; max-width:280px; margin:0 auto 24px; }
.footer-credit{ font-size:11px; color:rgba(251,246,236,.35); }

/* ============================================================
   11. TOAST / CONFETTI CANVAS
   ============================================================ */
#confetti-canvas{ position:fixed; inset:0; z-index:1200; pointer-events:none; }
#toast{
  position:fixed; bottom:110px; left:50%; transform:translate(-50%, 20px); z-index:1100; opacity:0;
  background:var(--navy); color:var(--ivory); padding:13px 22px; border-radius:100px; font-size:13px; font-weight:600;
  box-shadow:var(--shadow-deep); transition:opacity .35s, transform .35s; pointer-events:none;
  display:flex; align-items:center; gap:8px;
}
#toast.show{ opacity:1; transform:translate(-50%, 0); }
#toast svg{ width:15px; height:15px; color:var(--gold-light); }

/* parallax helper */
.parallax-layer{ will-change: transform; }

@media (max-width:380px){
  .container{ padding:0 18px; }
  .countdown-grid{ gap:6px; }
}
</style>
</head>
<body>

<canvas id="confetti-canvas"></canvas>
<div id="toast">
  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 6L9 17l-5-5"/></svg>
  <span id="toast-text">Berhasil dikirim</span>
</div>

<div id="cover">
  <div class="bg-photo"></div>
  <div class="gold-particles" id="gold-particles"></div>

  <div class="cover-inner">
    <p class="cover-eyebrow">The Wedding Of</p>
    <p class="cover-guest-label">Kepada Bapak/Ibu/Saudara/i</p>
    <p class="cover-guest-name" id="guest-name">Tamu Undangan</p>

    <div class="seal-wrap">
      <div class="seal-ring"></div>
      <button class="seal" id="seal-btn" aria-label="Buka Undangan">
        <span class="seal-monogram">{{ substr($settings->bride_name ?? 'W', 0, 1) }}&{{ substr($settings->groom_name ?? 'N', 0, 1) }}</span>
      </button>
    </div>

    <h1 class="cover-title">{{ $settings->bride_name ?? 'Wifda' }} <em>& {{ $settings->groom_name ?? 'Nama Anda' }}</em></h1>
    <p class="cover-date">{{ \Carbon\Carbon::parse($settings->wedding_date ?? '2026-09-12')->format('d F Y') }}</p>

    <button class="btn-open" id="open-invitation-btn">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16v16H4z" opacity="0"/><path d="M3 8l9 6 9-6M3 8v10a1 1 0 001 1h16a1 1 0 001-1V8M3 8l9-4 9 4"/></svg>
      Buka Undangan
    </button>
  </div>
</div>

<audio id="bg-audio" loop preload="none">
  <source src="{{ $settings->music_url ?? 'https://cdn.pixabay.com/download/audio/2022/03/15/audio_c8e70c5867.mp3' }}" type="audio/mpeg">
</audio>

<button id="music-toggle" class="glass-dark">
  <span class="disc"></span>
  <svg id="music-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
    <path d="M9 18V5l12-2v13"/><circle cx="6" cy="18" r="3"/><circle cx="18" cy="16" r="3"/>
  </svg>
</button>

<main id="main-content">

  <section class="section" id="welcome">
    <div class="container">
      <p class="eyebrow reveal">Assalamu'alaikum</p>
      <p class="welcome-verse reveal">{{ $settings->welcome_quote ?? '"Dan di antara tanda-tanda kekuasaan-Nya ialah Dia menciptakan untukmu pasangan dari jenismu sendiri..."' }}</p>
      <p class="welcome-ref reveal">QS. Ar-Rum: 21</p>
    </div>
  </section>

  <section class="section" id="couple">
    <div class="container">
      <p class="eyebrow reveal">Mempelai</p>
      <h2 class="section-title reveal">Yang Berbahagia<br><em>Bertemu Takdirnya</em></h2>
      <p class="section-sub reveal">Dengan penuh syukur, kami mengundang Anda untuk turut merayakan hari istimewa ini.</p>

      <div class="couple-card reveal">
        <span class="couple-tag tag-bride">Mempelai Wanita</span>
        <div class="couple-photo-wrap">
          <img src="{{ $settings->bride_photo_url ?? 'https://images.unsplash.com/photo-1594736797933-d0501ba2fe65' }}" alt="{{ $settings->bride_name ?? 'Wifda' }}">
        </div>
        <h3 class="couple-name">{{ $settings->bride_name ?? 'Wifda' }}</h3>
        <p class="couple-fullname">Putri dari {{ $settings->bride_parents ?? 'Bapak & Ibu' }}</p>
        <p class="couple-desc">Putri bungsu yang membawa cahaya ke setiap ruangan yang ia masuki — jiwa muda yang hangat, penuh tawa, dan selalu punya cerita seru untuk dibagikan. Wifda mencintai senja, kopi hangat, dan petualangan kecil yang jadi kenangan besar. Bersama pasangannya, ia menulis babak baru dengan semangat yang sama menawannya seperti dirinya.</p>
        <div class="couple-social">
          <a href="https://instagram.com/" target="_blank" rel="noopener" aria-label="Instagram Wifda">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1"/></svg>
          </a>
        </div>
      </div>

      <div class="amp-divider reveal"><i></i><span class="amp-text">&</span><i></i></div>

      <div class="couple-card reveal">
        <span class="couple-tag tag-groom">Mempelai Pria</span>
        <div class="couple-photo-wrap">
          <img src="{{ $settings->groom_photo_url ?? 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab' }}" alt="{{ $settings->groom_name ?? 'Nama Anda' }}">
        </div>
        <h3 class="couple-name">{{ $settings->groom_name ?? 'Nama Anda' }}</h3>
        <p class="couple-fullname">Putra dari {{ $settings->groom_parents ?? 'Bapak & Ibu' }}</p>
        <p class="couple-desc">Tenang, hangat, dan selalu jadi tempat pulang yang paling nyaman. Ia percaya bahwa kebahagiaan sejati ada dalam hal-hal sederhana — secangkir kopi, obrolan panjang, dan seseorang yang tepat untuk dijalani bersama sepanjang hidup.</p>
        <div class="couple-social">
          <a href="https://instagram.com/" target="_blank" rel="noopener" aria-label="Instagram Nama Anda">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1"/></svg>
          </a>
        </div>
      </div>
    </div>
  </section>

  <section class="section" id="event">
    <div class="container">
      <p class="eyebrow reveal">Save The Date</p>
      <h2 class="section-title reveal">Hari Bahagia<br><em>Yang Kami Tunggu</em></h2>
      <p class="section-sub reveal">Kehadiran serta doa restu Anda menjadi kebahagiaan tersendiri bagi kami.</p>

      <div class="countdown-grid reveal" id="countdown">
        <div class="cd-box glass-dark"><div class="cd-num" id="cd-days">00</div><div class="cd-label">Hari</div></div>
        <div class="cd-box glass-dark"><div class="cd-num" id="cd-hours">00</div><div class="cd-label">Jam</div></div>
        <div class="cd-box glass-dark"><div class="cd-num" id="cd-mins">00</div><div class="cd-label">Menit</div></div>
        <div class="cd-box glass-dark"><div class="cd-num" id="cd-secs">00</div><div class="cd-label">Detik</div></div>
      </div>

      <div class="event-card glass-dark reveal">
        <div class="event-card-head">
          <div class="event-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="3"/><path d="M16 2v4M8 2v4M3 10h18"/></svg></div>
          <h3 class="event-card-title">Akad Nikah</h3>
        </div>
        <p class="event-detail-row"><b>{{ \Carbon\Carbon::parse($settings->wedding_date ?? '2026-09-12')->format('d F Y') }}</b><br>Pukul <b>{{ $settings->akad_time ?? '08:00 WIB' }}</b></p>
        <p class="event-detail-row">Lokasi:<br><b>{{ $settings->akad_location ?? 'Lokasi Akad' }}</b></p>
      </div>

      <div class="event-card glass-dark reveal">
        <div class="event-card-head">
          <div class="event-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2l2.5 6.5L21 9l-5 4.5L17.5 21 12 17l-5.5 4L8 13.5 3 9l6.5-.5z"/></svg></div>
          <h3 class="event-card-title">Resepsi</h3>
        </div>
        <p class="event-detail-row"><b>{{ \Carbon\Carbon::parse($settings->wedding_date ?? '2026-09-12')->format('d F Y') }}</b><br>Pukul <b>{{ $settings->reception_time ?? '11:00 WIB' }}</b></p>
        <p class="event-detail-row">Lokasi:<br><b>{{ $settings->reception_location ?? 'Lokasi Resepsi' }}</b></p>
        <a class="btn btn-gold btn-block" id="maps-btn" href="{{ $settings->google_maps_url ?? '#' }}" target="_blank" rel="noopener">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16"><path d="M21 10c0 7-9 12-9 12S3 17 3 10a9 9 0 1118 0z"/><circle cx="12" cy="10" r="3"/></svg>
          Buka di Google Maps
        </a>
      </div>
    </div>
  </section>

  <section class="section" id="gallery">
    <div class="container">
      <p class="eyebrow reveal">Momen</p>
      <h2 class="section-title reveal">Galeri <em>Kami</em></h2>
      <p class="section-sub reveal">Sepenggal cerita yang terekam dalam bingkai.</p>

      <div class="masonry reveal">
        <figure><img src="https://images.unsplash.com/photo-1583939003579-730e3918a45a?q=80&w=600&auto=format&fit=crop" alt="Galeri 1"></figure>
        <figure><img src="https://images.unsplash.com/photo-1519741497674-611481863552?q=80&w=600&auto=format&fit=crop" alt="Galeri 2"></figure>
        <figure><img src="https://images.unsplash.com/photo-1522673607200-164d1b6ce486?q=80&w=600&auto=format&fit=crop" alt="Galeri 3"></figure>
        <figure><img src="https://images.unsplash.com/photo-1465495976277-4387d4b0b4c6?q=80&w=600&auto=format&fit=crop" alt="Galeri 4"></figure>
        <figure><img src="https://images.unsplash.com/photo-1544078751-58fee2d8a03d?q=80&w=600&auto=format&fit=crop" alt="Galeri 5"></figure>
      </div>
    </div>
  </section>

  <section class="section" id="story">
    <div class="container">
      <p class="eyebrow reveal">Kisah Kami</p>
      <h2 class="section-title reveal">Love <em>Story</em></h2>
      <p class="section-sub reveal">Setiap kisah punya awal — inilah awal dari kisah kami.</p>

      <div class="timeline">
        <div class="timeline-item reveal">
          <span class="timeline-dot"></span>
          <p class="timeline-year">Catatan Perjalanan</p>
          <h4 class="timeline-title">Bagaimana Kami Bersatu</h4>
          <p class="timeline-text" style="white-space: pre-line;">{{ $settings->love_story ?? 'Kisah indah kami dimulai dari pertemuan yang tak pernah disangka...' }}</p>
        </div>
      </div>
    </div>
  </section>

  <section class="section" id="envelope">
    <div class="container">
      <p class="eyebrow reveal">Tanda Kasih</p>
      <h2 class="section-title reveal">Amplop <em>Digital</em></h2>
      <p class="section-sub reveal">Doa restu Anda adalah hadiah terbaik. Namun jika ingin memberi tanda kasih, kami sediakan amplop digital berikut.</p>

      <div class="wallet-card glass-dark reveal">
        <div class="wallet-logo">{{ substr($settings->bank_name ?? 'BCA', 0, 3) }}</div>
        <div class="wallet-info">
          <p class="wallet-bank">{{ $settings->bank_name ?? 'BCA' }}</p>
          <p class="wallet-number">{{ $settings->bank_account ?? '1234 5678 90' }}</p>
          <p class="wallet-owner">{{ $settings->bank_owner ?? 'a.n. Nama Anda' }}</p>
        </div>
        <button class="copy-btn" data-copy="{{ $settings->bank_account ?? '1234567890' }}" aria-label="Salin nomor rekening">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="12" height="12" rx="2"/><path d="M5 15H4a1 1 0 01-1-1V4a1 1 0 011-1h10a1 1 0 011 1v1"/></svg>
        </button>
      </div>

      <div class="qr-wrap reveal">
        <div class="qr-box">
          <img src="https://api.qrserver.com/v1/create-qr-code/?size=300x300&color=241a08&bgcolor=FFFFFF&data=wedding-gift-{{ Str::slug($settings->bride_name ?? 'Wifda') }}-{{ Str::slug($settings->groom_name ?? 'Nama') }}" alt="QR Code Amplop Digital">
        </div>
        <p class="qr-caption">Pindai untuk mengirim hadiah via QRIS</p>
      </div>
    </div>
  </section>

  <section class="section" id="rsvp">
    <div class="container">
      <p class="eyebrow reveal">Konfirmasi Kehadiran</p>
      <h2 class="section-title reveal">RSVP & <em>Ucapan</em></h2>
      <p class="section-sub reveal">Mohon konfirmasi kehadiran Anda dan tuliskan doa serta ucapan terbaik untuk kami.</p>

      <form id="rsvp-form" class="rsvp-form reveal" novalidate>
        <div class="reply-banner" id="reply-banner">
          <span>Membalas ucapan <b id="reply-target-name"></b></span>
          <button type="button" id="cancel-reply">Batal</button>
        </div>

        <div class="form-group">
          <label class="form-label" for="input-nama">Nama</label>
          <input class="form-input" id="input-nama" name="nama" type="text" placeholder="Tulis nama Anda" required maxlength="60">
        </div>

        <div class="form-group">
          <label class="form-label">Kehadiran</label>
          <div class="attend-toggle" id="attend-toggle">
            <button type="button" class="attend-opt" data-value="true">✓ Hadir</button>
            <button type="button" class="attend-opt" data-value="false">✕ Tidak Hadir</button>
          </div>
        </div>

        <div class="form-group">
          <label class="form-label" for="input-komentar">Ucapan & Doa</label>
          <textarea class="form-textarea" id="input-komentar" name="komentar" placeholder="Tulis ucapan dan doa terbaik Anda..." required maxlength="500"></textarea>
        </div>

        <button type="submit" class="btn btn-gold btn-block" id="submit-btn">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16"><path d="M22 2L11 13M22 2l-7 20-4-9-9-4z"/></svg>
          Kirim Ucapan
        </button>
        <p class="form-msg" id="form-msg"></p>
      </form>

      <div class="guestbook-head">
        <h3 class="section-title" style="font-size:22px;margin:0;text-align:left;">Ucapan Tamu</h3>
        <span class="guestbook-count" id="comment-count">0 ucapan</span>
      </div>

      <div id="comment-list"></div>
      <div class="load-more-wrap" id="load-more-wrap" style="display:none;">
        <button class="btn btn-outline" id="load-more-btn">Muat Lebih Banyak</button>
      </div>
    </div>
  </section>

  <footer id="footer">
    <div class="container">
      <p class="footer-monogram">{{ substr($settings->bride_name ?? 'W', 0, 1) }} & {{ substr($settings->groom_name ?? 'N', 0, 1) }}</p>
      <p class="footer-text">Terima kasih atas doa, restu, dan kehadiran Anda. Kehadiran Anda adalah kebahagiaan yang tak tergantikan bagi kami berdua.</p>
      <p class="footer-credit">{{ $settings->bride_name ?? 'Wifda' }} & {{ $settings->groom_name ?? 'Nama Anda' }} · {{ \Carbon\Carbon::parse($settings->wedding_date ?? '2026-09-12')->format('d.m.Y') }}</p>
    </div>
  </footer>
</main>

<nav id="bottom-nav" class="glass-dark">
  <a class="nav-item active" href="#welcome" data-section="welcome">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 12l9-9 9 9M5 10v10a1 1 0 001 1h4v-6h4v6h4a1 1 0 001-1V10"/></svg>
    <span>Home</span>
  </a>
  <a class="nav-item" href="#couple" data-section="couple">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.8 4.6a5.5 5.5 0 00-7.8 0L12 5.6l-1-1a5.5 5.5 0 10-7.8 7.8l1 1L12 21l7.8-7.8 1-1a5.5 5.5 0 000-7.8z"/></svg>
    <span>Couple</span>
  </a>
  <a class="nav-item" href="#event" data-section="event">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="3"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
    <span>Acara</span>
  </a>
  <a class="nav-item" href="#gallery" data-section="gallery">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="M21 15l-5-5L5 21"/></svg>
    <span>Galeri</span>
  </a>
  <a class="nav-item" href="#envelope" data-section="envelope">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="M3 7l9 6 9-6"/></svg>
    <span>Kado</span>
  </a>
  <a class="nav-item" href="#rsvp" data-section="rsvp">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
    <span>RSVP</span>
  </a>
</nav>

<script>
/* ============================================================
   MODULE: CONFIG & STATE (TERHUBUNG KE CMS UNTUK TANGGAL)
   ============================================================ */
const BASE_URL = '/api';
const WEDDING_DATE = new Date('{{ \Carbon\Carbon::parse($settings->wedding_date ?? "2026-09-12")->format("Y-m-d\TH:i:s") }}');

const AppState = {
  guestName: 'Tamu Undangan',
  accessKey: null,
  tenorKey: localStorage.getItem('wedding_tenor_key') || null,
  isConfettiEnabled: true,
  comments: [],
  page: 1,
  hasMore: true,
  attendValue: null,
  replyTo: null, 
  isMusicPlaying: false
};

/* ============================================================
   MODULE: UTILITIES
   ============================================================ */
function qs(sel, ctx = document){ return ctx.querySelector(sel); }
function qsa(sel, ctx = document){ return [...ctx.querySelectorAll(sel)]; }

function getGuestNameFromURL(){
  const params = new URLSearchParams(window.location.search);
  const to = params.get('to');
  AppState.accessKey = params.get('key') || params.get('access_key');
  return to ? decodeURIComponent(to.replace(/\+/g, ' ')) : null;
}

function showToast(message, isError = false){
  const toast = qs('#toast');
  const text = qs('#toast-text');
  text.textContent = message;
  toast.style.background = isError ? '#5a2a24' : 'var(--navy)';
  toast.classList.add('show');
  clearTimeout(showToast._t);
  showToast._t = setTimeout(() => toast.classList.remove('show'), 3200);
}

function timeAgo(dateStr){
  const diff = (Date.now() - new Date(dateStr).getTime()) / 1000;
  if (diff < 60) return 'baru saja';
  if (diff < 3600) return `${Math.floor(diff / 60)} menit lalu`;
  if (diff < 86400) return `${Math.floor(diff / 3600)} jam lalu`;
  if (diff < 2592000) return `${Math.floor(diff / 86400)} hari lalu`;
  return new Date(dateStr).toLocaleDateString('id-ID', { day:'numeric', month:'short', year:'numeric' });
}

function escapeHTML(str = ''){
  const div = document.createElement('div');
  div.textContent = str;
  return div.innerHTML;
}

function initials(name = '?'){
  return name.trim().charAt(0).toUpperCase();
}

/* ============================================================
   MODULE: COVER / ENVELOPE UNLOCK
   ============================================================ */
function initCover(){
  const guestName = getGuestNameFromURL();
  if (guestName){
    AppState.guestName = guestName;
    qs('#guest-name').textContent = guestName;
  }

  const particleWrap = qs('#gold-particles');
  for (let i = 0; i < 28; i++){
    const p = document.createElement('span');
    p.style.left = Math.random() * 100 + '%';
    p.style.bottom = -10 + 'px';
    p.style.animationDuration = (8 + Math.random() * 10) + 's';
    p.style.animationDelay = (Math.random() * 10) + 's';
    p.style.opacity = 0.3 + Math.random() * 0.5;
    particleWrap.appendChild(p);
  }

  const openInvitation = () => {
    const seal = qs('#seal-btn');
    seal.classList.add('cracking');
    const audio = qs('#bg-audio');

    audio.play().then(() => {
      AppState.isMusicPlaying = true;
      updateMusicIcon();
    }).catch(() => {
      showToast('Ketuk ikon musik untuk memutar lagu 🎵');
    });

    setTimeout(() => {
      qs('#cover').classList.add('opened');
      qs('#bottom-nav').classList.add('show');
      qs('#music-toggle').classList.add('show');
      document.body.style.overflow = 'auto';
      initScrollFeatures();
    }, 550);
  };

  qs('#seal-btn').addEventListener('click', openInvitation);
  qs('#open-invitation-btn').addEventListener('click', openInvitation);
  document.body.style.overflow = 'hidden';
}

/* ============================================================
   MODULE: MUSIC TOGGLE
   ============================================================ */
function updateMusicIcon(){
  const btn = qs('#music-toggle');
  btn.classList.toggle('playing', AppState.isMusicPlaying);
  btn.classList.toggle('paused', !AppState.isMusicPlaying);
}

function initMusicToggle(){
  qs('#music-toggle').addEventListener('click', () => {
    const audio = qs('#bg-audio');
    if (AppState.isMusicPlaying){
      audio.pause();
      AppState.isMusicPlaying = false;
    } else {
      audio.play().catch(() => showToast('Gagal memutar musik', true));
      AppState.isMusicPlaying = true;
    }
    updateMusicIcon();
  });
}

/* ============================================================
   MODULE: SCROLL FEATURES — REVEAL, PARALLAX, NAV ACTIVE STATE
   ============================================================ */
let scrollFeaturesInitialized = false;

function initScrollFeatures(){
  if (scrollFeaturesInitialized) return;
  scrollFeaturesInitialized = true;

  const revealEls = qsa('.reveal, .reveal-scale');
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting){
        entry.target.classList.add('in-view');
        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.15, rootMargin: '0px 0px -60px 0px' });
  revealEls.forEach(el => observer.observe(el));

  const sections = qsa('main > section, main > footer');
  const navItems = qsa('.nav-item');
  const navObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting){
        const id = entry.target.id;
        navItems.forEach(item => item.classList.toggle('active', item.dataset.section === id));
      }
    });
  }, { threshold: 0.5 });
  sections.forEach(sec => { if (sec.id) navObserver.observe(sec); });

  let lastY = window.scrollY;
  function onScroll(){
    lastY = window.scrollY;
    requestAnimationFrame(applyParallax);
  }
  function applyParallax(){
    const bg = qs('#cover .bg-photo');
    if (bg) bg.style.transform = `translateY(${lastY * 0.15}px)`;
  }
  window.addEventListener('scroll', onScroll, { passive: true });
}

/* ============================================================
   MODULE: COUNTDOWN TIMER
   ============================================================ */
function initCountdown(){
  function tick(){
    const now = new Date();
    let diff = WEDDING_DATE.getTime() - now.getTime();
    if (diff < 0) diff = 0;

    const days = Math.floor(diff / 86400000);
    const hours = Math.floor((diff % 86400000) / 3600000);
    const mins = Math.floor((diff % 3600000) / 60000);
    const secs = Math.floor((diff % 60000) / 1000);

    qs('#cd-days').textContent = String(days).padStart(2, '0');
    qs('#cd-hours').textContent = String(hours).padStart(2, '0');
    qs('#cd-mins').textContent = String(mins).padStart(2, '0');
    qs('#cd-secs').textContent = String(secs).padStart(2, '0');
  }
  tick();
  setInterval(tick, 1000);
}

/* ============================================================
   MODULE: COPY TO CLIPBOARD
   ============================================================ */
function initCopyButtons(){
  qsa('.copy-btn').forEach(btn => {
    btn.addEventListener('click', async () => {
      const value = btn.dataset.copy;
      try {
        if (navigator.clipboard && navigator.clipboard.writeText){
          await navigator.clipboard.writeText(value);
        } else {
          const temp = document.createElement('textarea');
          temp.value = value;
          document.body.appendChild(temp);
          temp.select();
          document.execCommand('copy');
          temp.remove();
        }
        btn.classList.add('copied');
        showToast('Nomor berhasil disalin ✓');
        setTimeout(() => btn.classList.remove('copied'), 1800);
      } catch (err){
        console.error('Copy failed:', err);
        showToast('Gagal menyalin, coba salin manual', true);
      }
    });
  });
}

/* ============================================================
   MODULE: API — FETCH HELPERS
   ============================================================ */
async function apiRequest(path, options = {}){
  const headers = { 'Content-Type': 'application/json', 'Accept': 'application/json', ...options.headers };
  if (AppState.tenorKey) headers['Authorization'] = `Bearer ${AppState.tenorKey}`;

  const response = await fetch(`${BASE_URL}${path}`, { ...options, headers });

  if (!response.ok){
    let message = `Request gagal (${response.status})`;
    try {
      const errBody = await response.json();
      message = errBody.message || message;
    } catch (_) { }
    throw new Error(message);
  }

  if (response.status === 204) return null;
  return response.json();
}

async function fetchComments(page = 1){
  try {
    const result = await apiRequest(`/comments?page=${page}&per_page=10`);
    const list = Array.isArray(result) ? result : (result.data || []);
    const meta = result.meta || {};
    return {
      list,
      hasMore: meta.hasMore ?? (list.length >= 10)
    };
  } catch (err){
    console.error('fetchComments error:', err);
    throw err;
  }
}

async function postComment(payload){
  try {
    return await apiRequest('/comments', {
      method: 'POST',
      body: JSON.stringify(payload)
    });
  } catch (err){
    console.error('postComment error:', err);
    throw err;
  }
}

async function postLike(commentUuid){
  try {
    return await apiRequest(`/comments/${commentUuid}/likes`, { method: 'POST' });
  } catch (err){
    console.error('postLike error:', err);
    throw err;
  }
}

async function fetchSettings(){
  try {
    const result = await apiRequest(`/settings${AppState.accessKey ? '?key=' + AppState.accessKey : ''}`);
    AppState.isConfettiEnabled = result?.is_confetti_animation ?? true;
    if (result?.tenor_key){
      AppState.tenorKey = result.tenor_key;
      localStorage.setItem('wedding_tenor_key', result.tenor_key);
    }
  } catch (err){
    console.warn('fetchSettings unavailable, using defaults:', err.message);
  }
}

/* ============================================================
   MODULE: GUESTBOOK RENDERING (NESTED COMMENTS)
   ============================================================ */
function buildCommentTree(flatList){
  const map = new Map();
  const roots = [];
  flatList.forEach(c => map.set(c.uuid, { ...c, replies: [] }));
  map.forEach(comment => {
    if (comment.parent_id && map.has(comment.parent_id)){
      map.get(comment.parent_id).replies.push(comment);
    } else {
      roots.push(comment);
    }
  });
  return roots;
}

function renderCommentNode(comment, depth = 0){
  const attendBadge = comment.hadir
    ? '<span class="badge-attend yes">Hadir</span>'
    : '<span class="badge-attend no">Tidak Hadir</span>';
  const adminBadge = comment.is_admin ? '<span class="badge-admin">Mempelai</span>' : '';
  const likeCount = comment.likes_count ?? comment.likes ?? 0;
  const liked = comment.liked_by_me ? 'liked' : '';

  const repliesHTML = (comment.replies && comment.replies.length)
    ? `<div class="comment-replies">${comment.replies.map(r => renderCommentNode(r, depth + 1)).join('')}</div>`
    : '';

  return `
    <div class="comment-card" data-uuid="${comment.uuid}">
      <div class="comment-head">
        <div class="comment-avatar">${escapeHTML(initials(comment.nama))}</div>
        <div style="flex:1;min-width:0;">
          <div class="comment-name-row">
            <span class="comment-name">${escapeHTML(comment.nama)}</span>
            ${adminBadge}
            ${attendBadge}
          </div>
          <span class="comment-time">${timeAgo(comment.created_at)}</span>
        </div>
      </div>
      <p class="comment-text">${escapeHTML(comment.komentar)}</p>
      <div class="comment-actions">
        <button class="comment-action-btn like-btn ${liked}" data-uuid="${comment.uuid}">
          <svg viewBox="0 0 24 24" fill="${comment.liked_by_me ? 'currentColor' : 'none'}" stroke="currentColor" stroke-width="2"><path d="M20.8 4.6a5.5 5.5 0 00-7.8 0L12 5.6l-1-1a5.5 5.5 0 10-7.8 7.8l1 1L12 21l7.8-7.8 1-1a5.5 5.5 0 000-7.8z"/></svg>
          <span class="like-count">${likeCount}</span>
        </button>
        <button class="comment-action-btn reply-btn" data-uuid="${comment.uuid}" data-nama="${escapeHTML(comment.nama)}">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 17l-5-5 5-5M4 12h11a5 5 0 015 5v1"/></svg>
          Balas
        </button>
      </div>
      ${repliesHTML}
    </div>
  `;
}

function renderCommentList(){
  const container = qs('#comment-list');
  const tree = buildCommentTree(AppState.comments);

  if (!tree.length){
    container.innerHTML = '<p class="comment-empty">Belum ada ucapan. Jadilah yang pertama mengirim doa ✨</p>';
  } else {
    container.innerHTML = tree.map(c => renderCommentNode(c)).join('');
  }

  qs('#comment-count').textContent = `${AppState.comments.length} ucapan`;
  bindCommentActions();
}

function bindCommentActions(){
  qsa('.like-btn').forEach(btn => {
    btn.addEventListener('click', () => handleLike(btn));
  });
  qsa('.reply-btn').forEach(btn => {
    btn.addEventListener('click', () => handleReplyStart(btn.dataset.uuid, btn.dataset.nama));
  });
}

async function handleLike(btn){
  const uuid = btn.dataset.uuid;
  const countEl = qs('.like-count', btn);
  const wasLiked = btn.classList.contains('liked');

  btn.classList.toggle('liked');
  countEl.textContent = Number(countEl.textContent) + (wasLiked ? -1 : 1);

  try {
    await postLike(uuid);
  } catch (err){
    btn.classList.toggle('liked');
    countEl.textContent = Number(countEl.textContent) + (wasLiked ? 1 : -1);
    showToast('Gagal menyukai ucapan, periksa koneksi ke server', true);
  }
}

function handleReplyStart(uuid, nama){
  AppState.replyTo = { uuid, nama };
  qs('#reply-target-name').textContent = nama;
  qs('#reply-banner').classList.add('show');
  qs('#rsvp-form').scrollIntoView({ behavior: 'smooth', block: 'center' });
  qs('#input-komentar').focus();
}

function handleReplyCancel(){
  AppState.replyTo = null;
  qs('#reply-banner').classList.remove('show');
}

/* ============================================================
   MODULE: LOAD COMMENTS (INITIAL + PAGINATION)
   ============================================================ */
async function loadComments(initial = true){
  const list = qs('#comment-list');
  const loadMoreBtn = qs('#load-more-btn');

  if (initial) list.innerHTML = '<p class="comment-loading">Memuat ucapan…</p>';
  if (loadMoreBtn) loadMoreBtn.textContent = 'Memuat…';

  try {
    const { list: newComments, hasMore } = await fetchComments(AppState.page);
    AppState.comments = initial ? newComments : [...AppState.comments, ...newComments];
    AppState.hasMore = hasMore;
    renderCommentList();
    qs('#load-more-wrap').style.display = hasMore ? 'block' : 'none';
  } catch (err){
    list.innerHTML = `<p class="comment-empty">Gagal memuat ucapan. Periksa apakah server backend berjalan di <b>${BASE_URL}</b>.</p>`;
  } finally {
    if (loadMoreBtn) loadMoreBtn.textContent = 'Muat Lebih Banyak';
  }
}

function initLoadMore(){
  qs('#load-more-btn').addEventListener('click', () => {
    AppState.page += 1;
    loadComments(false);
  });
}

/* ============================================================
   MODULE: RSVP FORM SUBMISSION
   ============================================================ */
function initAttendToggle(){
  qsa('.attend-opt').forEach(btn => {
    btn.addEventListener('click', () => {
      qsa('.attend-opt').forEach(b => b.classList.remove('selected'));
      btn.classList.add('selected');
      AppState.attendValue = btn.dataset.value === 'true';
    });
  });
}

function setFormMessage(text, isError = false){
  const msg = qs('#form-msg');
  msg.textContent = text;
  msg.className = `form-msg ${isError ? 'error' : 'success'}`;
}

async function handleRSVPSubmit(e){
  e.preventDefault();
  const submitBtn = qs('#submit-btn');
  const namaInput = qs('#input-nama');
  const komentarInput = qs('#input-komentar');

  const nama = namaInput.value.trim();
  const komentar = komentarInput.value.trim();

  if (!nama || !komentar){
    setFormMessage('Nama dan ucapan wajib diisi.', true);
    return;
  }
  if (AppState.attendValue === null){
    setFormMessage('Silakan pilih status kehadiran Anda.', true);
    return;
  }

  const payload = { nama, hadir: AppState.attendValue, komentar };
  if (AppState.replyTo) payload.parent_id = AppState.replyTo.uuid;

  submitBtn.disabled = true;
  const originalHTML = submitBtn.innerHTML;
  submitBtn.innerHTML = 'Mengirim…';

  try {
    const created = await postComment(payload);

    if (created && created.uuid){
      AppState.comments.unshift(created);
    } else {
      AppState.page = 1;
      await loadComments(true);
    }
    renderCommentList();

    setFormMessage('Ucapan berhasil dikirim. Terima kasih! 🤍', false);
    showToast('Ucapan berhasil dikirim ✓');
    if (AppState.isConfettiEnabled) fireConfetti();

    qs('#rsvp-form').reset();
    qsa('.attend-opt').forEach(b => b.classList.remove('selected'));
    AppState.attendValue = null;
    handleReplyCancel();

  } catch (err){
    setFormMessage(`Gagal mengirim: ${err.message}. Pastikan server backend aktif di ${BASE_URL}.`, true);
    showToast('Gagal mengirim ucapan', true);
  } finally {
    submitBtn.disabled = false;
    submitBtn.innerHTML = originalHTML;
  }
}

function initRSVPForm(){
  qs('#rsvp-form').addEventListener('submit', handleRSVPSubmit);
  qs('#cancel-reply').addEventListener('click', handleReplyCancel);
}

/* ============================================================
   MODULE: CONFETTI (VANILLA CANVAS)
   ============================================================ */
function fireConfetti(){
  const canvas = qs('#confetti-canvas');
  const ctx = canvas.getContext('2d');
  canvas.width = window.innerWidth;
  canvas.height = window.innerHeight;

  const colors = ['#C9A24B', '#E4C878', '#D9A9A0', '#FBF6EC', '#8C6B2F'];
  const pieces = Array.from({ length: 140 }, () => ({
    x: Math.random() * canvas.width,
    y: -20 - Math.random() * canvas.height * 0.3,
    size: 5 + Math.random() * 6,
    color: colors[Math.floor(Math.random() * colors.length)],
    speedY: 2 + Math.random() * 3,
    speedX: -1.5 + Math.random() * 3,
    rotation: Math.random() * 360,
    rotationSpeed: -6 + Math.random() * 12,
    shape: Math.random() > 0.5 ? 'circle' : 'rect'
  }));

  let frame = 0;
  const maxFrames = 220;

  function draw(){
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    pieces.forEach(p => {
      p.x += p.speedX;
      p.y += p.speedY;
      p.rotation += p.rotationSpeed;

      ctx.save();
      ctx.translate(p.x, p.y);
      ctx.rotate((p.rotation * Math.PI) / 180);
      ctx.fillStyle = p.color;
      if (p.shape === 'circle'){
        ctx.beginPath();
        ctx.arc(0, 0, p.size / 2, 0, Math.PI * 2);
        ctx.fill();
      } else {
        ctx.fillRect(-p.size / 2, -p.size / 4, p.size, p.size / 2);
      }
      ctx.restore();
    });

    frame++;
    if (frame < maxFrames){
      requestAnimationFrame(draw);
    } else {
      ctx.clearRect(0, 0, canvas.width, canvas.height);
    }
  }
  draw();
}

/* ============================================================
   MODULE: INIT / BOOTSTRAP
   ============================================================ */
document.addEventListener('DOMContentLoaded', async () => {
  initCover();
  initMusicToggle();
  initCountdown();
  initCopyButtons();
  initAttendToggle();
  initRSVPForm();
  initLoadMore();

  await fetchSettings();
  await loadComments(true);
});
</script>
</body>
</html>
