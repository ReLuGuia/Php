<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>ReLuGuia — Desenvolvedor Backend</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;1,9..40,300&display=swap" rel="stylesheet" />
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
      --bg: #080c10;
      --bg2: #0d1117;
      --surface: #111820;
      --surface2: #172030;
      --border: rgba(255,255,255,0.07);
      --accent: #3ee8a0;
      --accent-dim: rgba(62, 232, 160, 0.12);
      --accent-glow: rgba(62, 232, 160, 0.25);
      --text: #e8edf2;
      --text-muted: #7a8a9a;
      --text-dim: #4a5a6a;
      --php: #7b7fb5;
      --php-dim: rgba(123,127,181,0.15);
      --radius: 12px;
      --transition: 0.3s cubic-bezier(0.4,0,0.2,1);
    }

    html { scroll-behavior: smooth; }

    body {
      background: var(--bg);
      color: var(--text);
      font-family: 'DM Sans', sans-serif;
      font-size: 16px;
      line-height: 1.6;
      -webkit-font-smoothing: antialiased;
    }

    /* ─── NOISE TEXTURE OVERLAY ─── */
    body::before {
      content: '';
      position: fixed;
      inset: 0;
      background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.04'/%3E%3C/svg%3E");
      pointer-events: none;
      z-index: 0;
      opacity: 0.5;
    }

    /* ─── NAVBAR ─── */
    nav {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      z-index: 100;
      padding: 0 5%;
      height: 64px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      transition: background var(--transition), backdrop-filter var(--transition), border-color var(--transition);
      border-bottom: 1px solid transparent;
    }

    nav.scrolled {
      background: rgba(8, 12, 16, 0.85);
      backdrop-filter: blur(20px);
      -webkit-backdrop-filter: blur(20px);
      border-color: var(--border);
    }

    .nav-logo {
      font-family: 'Syne', sans-serif;
      font-weight: 800;
      font-size: 1.1rem;
      color: var(--text);
      text-decoration: none;
      letter-spacing: -0.02em;
    }

    .nav-logo span { color: var(--accent); }

    .nav-links {
      display: flex;
      gap: 2rem;
      list-style: none;
    }

    .nav-links a {
      color: var(--text-muted);
      text-decoration: none;
      font-size: 0.875rem;
      font-weight: 400;
      letter-spacing: 0.02em;
      transition: color var(--transition);
    }

    .nav-links a:hover { color: var(--text); }

    .nav-cta {
      background: var(--accent-dim);
      color: var(--accent) !important;
      padding: 0.4rem 1rem;
      border-radius: 6px;
      border: 1px solid rgba(62,232,160,0.2);
      font-size: 0.8rem !important;
      font-weight: 500 !important;
      transition: background var(--transition), border-color var(--transition) !important;
    }

    .nav-cta:hover {
      background: rgba(62,232,160,0.2) !important;
      border-color: rgba(62,232,160,0.4) !important;
      color: var(--accent) !important;
    }

    /* ─── HERO ─── */
    .hero {
      min-height: 100vh;
      display: flex;
      align-items: center;
      padding: 100px 5% 80px;
      position: relative;
      overflow: hidden;
    }

    /* Decorative grid background */
    .hero::after {
      content: '';
      position: absolute;
      inset: 0;
      background-image:
        linear-gradient(rgba(62,232,160,0.03) 1px, transparent 1px),
        linear-gradient(90deg, rgba(62,232,160,0.03) 1px, transparent 1px);
      background-size: 60px 60px;
      mask-image: radial-gradient(ellipse 80% 60% at 50% 40%, black 30%, transparent 80%);
      pointer-events: none;
    }

    /* Accent orb */
    .hero-orb {
      position: absolute;
      width: 600px;
      height: 600px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(62,232,160,0.06) 0%, transparent 70%);
      top: 50%;
      left: 60%;
      transform: translate(-50%, -50%);
      pointer-events: none;
    }

    .hero-inner {
      max-width: 800px;
      position: relative;
      z-index: 1;
    }

    .hero-label {
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      background: var(--accent-dim);
      border: 1px solid rgba(62,232,160,0.2);
      color: var(--accent);
      font-size: 0.75rem;
      font-weight: 500;
      letter-spacing: 0.08em;
      text-transform: uppercase;
      padding: 0.35rem 0.85rem;
      border-radius: 99px;
      margin-bottom: 2rem;
      opacity: 0;
      animation: fadeUp 0.7s 0.1s ease forwards;
    }

    .hero-label::before {
      content: '';
      width: 6px;
      height: 6px;
      border-radius: 50%;
      background: var(--accent);
      animation: pulse 2s ease infinite;
    }

    @keyframes pulse {
      0%, 100% { opacity: 1; transform: scale(1); }
      50% { opacity: 0.5; transform: scale(0.8); }
    }

    .hero h1 {
      font-family: 'Syne', sans-serif;
      font-weight: 800;
      font-size: clamp(2.8rem, 7vw, 5.5rem);
      line-height: 1.0;
      letter-spacing: -0.03em;
      color: var(--text);
      margin-bottom: 0.3rem;
      opacity: 0;
      animation: fadeUp 0.7s 0.2s ease forwards;
    }

    .hero h1 .name-accent {
      color: var(--accent);
    }

    .hero-title {
      font-family: 'Syne', sans-serif;
      font-size: clamp(1rem, 2.5vw, 1.4rem);
      font-weight: 400;
      color: var(--text-muted);
      margin-bottom: 1.8rem;
      letter-spacing: -0.01em;
      opacity: 0;
      animation: fadeUp 0.7s 0.3s ease forwards;
    }

    .hero-bio {
      font-size: 1.05rem;
      color: var(--text-muted);
      font-weight: 300;
      line-height: 1.75;
      max-width: 580px;
      margin-bottom: 2.5rem;
      opacity: 0;
      animation: fadeUp 0.7s 0.4s ease forwards;
    }

    .hero-bio strong { color: var(--text); font-weight: 500; }

    .hero-actions {
      display: flex;
      gap: 1rem;
      flex-wrap: wrap;
      opacity: 0;
      animation: fadeUp 0.7s 0.5s ease forwards;
    }

    .btn {
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      padding: 0.75rem 1.5rem;
      border-radius: 8px;
      font-size: 0.9rem;
      font-weight: 500;
      text-decoration: none;
      transition: all var(--transition);
      cursor: pointer;
      border: none;
    }

    .btn-primary {
      background: var(--accent);
      color: #05120b;
      font-weight: 600;
    }

    .btn-primary:hover {
      background: #5fffc0;
      transform: translateY(-2px);
      box-shadow: 0 8px 24px rgba(62,232,160,0.3);
    }

    .btn-secondary {
      background: transparent;
      color: var(--text-muted);
      border: 1px solid var(--border);
    }

    .btn-secondary:hover {
      border-color: rgba(255,255,255,0.15);
      color: var(--text);
      background: rgba(255,255,255,0.04);
    }

    /* ─── SCROLL INDICATOR ─── */
    .scroll-hint {
      position: absolute;
      bottom: 2.5rem;
      left: 5%;
      display: flex;
      align-items: center;
      gap: 0.75rem;
      color: var(--text-dim);
      font-size: 0.75rem;
      letter-spacing: 0.06em;
      text-transform: uppercase;
    }

    .scroll-line {
      width: 40px;
      height: 1px;
      background: var(--text-dim);
      position: relative;
      overflow: hidden;
    }

    .scroll-line::after {
      content: '';
      position: absolute;
      inset: 0;
      background: var(--accent);
      transform: translateX(-100%);
      animation: slideLine 2s ease infinite;
    }

    @keyframes slideLine {
      0% { transform: translateX(-100%); }
      100% { transform: translateX(100%); }
    }

    /* ─── SECTIONS ─── */
    section {
      padding: 7rem 5%;
      position: relative;
    }

    .section-header {
      margin-bottom: 4rem;
    }

    .section-tag {
      font-size: 0.72rem;
      font-weight: 500;
      letter-spacing: 0.12em;
      text-transform: uppercase;
      color: var(--accent);
      margin-bottom: 0.75rem;
      display: block;
    }

    .section-title {
      font-family: 'Syne', sans-serif;
      font-size: clamp(1.8rem, 4vw, 3rem);
      font-weight: 700;
      letter-spacing: -0.03em;
      color: var(--text);
      line-height: 1.1;
    }

    /* ─── ABOUT ─── */
    .about {
      background: var(--bg2);
      border-top: 1px solid var(--border);
      border-bottom: 1px solid var(--border);
    }

    .about-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 5rem;
      align-items: start;
    }

    .about-text {
      font-size: 1.05rem;
      color: var(--text-muted);
      font-weight: 300;
      line-height: 1.85;
    }

    .about-text p + p { margin-top: 1.2rem; }
    .about-text strong { color: var(--text); font-weight: 500; }

    .about-skills-label {
      font-size: 0.72rem;
      letter-spacing: 0.1em;
      text-transform: uppercase;
      color: var(--text-dim);
      margin-bottom: 1rem;
      font-weight: 500;
    }

    .skills-grid {
      display: flex;
      flex-wrap: wrap;
      gap: 0.5rem;
    }

    .skill-badge {
      display: inline-flex;
      align-items: center;
      gap: 0.4rem;
      padding: 0.4rem 0.85rem;
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: 6px;
      font-size: 0.8rem;
      color: var(--text-muted);
      transition: all var(--transition);
    }

    .skill-badge:hover {
      border-color: var(--accent);
      color: var(--accent);
      background: var(--accent-dim);
    }

    .skill-dot {
      width: 6px;
      height: 6px;
      border-radius: 50%;
      background: currentColor;
      opacity: 0.6;
    }

    /* ─── PROJECTS ─── */
    .projects-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
      gap: 1.5rem;
    }

    .project-card {
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: var(--radius);
      padding: 2rem;
      text-decoration: none;
      display: flex;
      flex-direction: column;
      gap: 1rem;
      position: relative;
      overflow: hidden;
      transition: transform var(--transition), border-color var(--transition), box-shadow var(--transition);
    }

    .project-card::before {
      content: '';
      position: absolute;
      inset: 0;
      background: linear-gradient(135deg, var(--accent-glow) 0%, transparent 60%);
      opacity: 0;
      transition: opacity var(--transition);
    }

    .project-card:hover {
      transform: translateY(-4px);
      border-color: rgba(62,232,160,0.25);
      box-shadow: 0 16px 48px rgba(0,0,0,0.4), 0 0 0 1px rgba(62,232,160,0.1);
    }

    .project-card:hover::before { opacity: 1; }

    .project-card-inner { position: relative; z-index: 1; }

    .project-lang {
      display: inline-flex;
      align-items: center;
      gap: 0.45rem;
      font-size: 0.72rem;
      font-weight: 500;
      letter-spacing: 0.06em;
      text-transform: uppercase;
    }

    .project-lang.php { color: var(--php); }
    .project-lang.js { color: #f0db4f; }
    .project-lang.python { color: #3572A5; }

    .lang-dot {
      width: 8px;
      height: 8px;
      border-radius: 50%;
      background: currentColor;
    }

    .project-name {
      font-family: 'Syne', sans-serif;
      font-size: 1.15rem;
      font-weight: 700;
      color: var(--text);
      letter-spacing: -0.02em;
      margin-top: 0.5rem;
    }

    .project-desc {
      font-size: 0.875rem;
      color: var(--text-muted);
      line-height: 1.65;
      font-weight: 300;
    }

    .project-tags {
      display: flex;
      flex-wrap: wrap;
      gap: 0.4rem;
      margin-top: auto;
    }

    .project-tag {
      font-size: 0.7rem;
      padding: 0.25rem 0.6rem;
      border-radius: 4px;
      font-weight: 500;
      letter-spacing: 0.04em;
    }

    .tag-php { background: var(--php-dim); color: var(--php); border: 1px solid rgba(123,127,181,0.2); }
    .tag-mysql { background: rgba(0,117,143,0.1); color: #00759f; border: 1px solid rgba(0,117,143,0.2); }
    .tag-html { background: rgba(228,77,38,0.1); color: #e44d26; border: 1px solid rgba(228,77,38,0.2); }
    .tag-css { background: rgba(38,77,228,0.1); color: #2649e4; border: 1px solid rgba(38,77,228,0.2); }
    .tag-js { background: rgba(240,219,79,0.1); color: #b09a00; border: 1px solid rgba(240,219,79,0.2); }
    .tag-generic { background: var(--surface2); color: var(--text-muted); border: 1px solid var(--border); }

    .project-arrow {
      position: absolute;
      top: 1.5rem;
      right: 1.5rem;
      width: 32px;
      height: 32px;
      border-radius: 8px;
      background: var(--surface2);
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--text-dim);
      transition: all var(--transition);
      z-index: 1;
    }

    .project-card:hover .project-arrow {
      background: var(--accent-dim);
      color: var(--accent);
      border-color: rgba(62,232,160,0.3);
    }

    /* ─── EXPERIENCE ─── */
    .experience { background: var(--bg2); border-top: 1px solid var(--border); border-bottom: 1px solid var(--border); }

    .timeline {
      position: relative;
      padding-left: 2rem;
    }

    .timeline::before {
      content: '';
      position: absolute;
      left: 0;
      top: 8px;
      bottom: 8px;
      width: 1px;
      background: linear-gradient(to bottom, var(--accent), transparent);
    }

    .timeline-item {
      position: relative;
      padding-bottom: 3rem;
      padding-left: 2rem;
    }

    .timeline-item:last-child { padding-bottom: 0; }

    .timeline-dot {
      position: absolute;
      left: -2.35rem;
      top: 0.35rem;
      width: 10px;
      height: 10px;
      border-radius: 50%;
      background: var(--accent);
      box-shadow: 0 0 12px var(--accent-glow);
    }

    .timeline-period {
      font-size: 0.72rem;
      font-weight: 500;
      letter-spacing: 0.08em;
      text-transform: uppercase;
      color: var(--accent);
      margin-bottom: 0.5rem;
    }

    .timeline-role {
      font-family: 'Syne', sans-serif;
      font-size: 1.1rem;
      font-weight: 700;
      color: var(--text);
      letter-spacing: -0.02em;
      margin-bottom: 0.2rem;
    }

    .timeline-company {
      font-size: 0.9rem;
      color: var(--text-muted);
      margin-bottom: 0.75rem;
    }

    .timeline-desc {
      font-size: 0.875rem;
      color: var(--text-muted);
      font-weight: 300;
      line-height: 1.65;
      max-width: 560px;
    }

    /* ─── CONTACT / FOOTER ─── */
    .contact {
      text-align: center;
      padding: 8rem 5%;
    }

    .contact-pre {
      font-size: 0.72rem;
      letter-spacing: 0.12em;
      text-transform: uppercase;
      color: var(--accent);
      margin-bottom: 1.5rem;
      display: block;
    }

    .contact h2 {
      font-family: 'Syne', sans-serif;
      font-size: clamp(2.5rem, 6vw, 4.5rem);
      font-weight: 800;
      letter-spacing: -0.04em;
      line-height: 1.0;
      color: var(--text);
      margin-bottom: 1.5rem;
    }

    .contact-sub {
      font-size: 1rem;
      color: var(--text-muted);
      font-weight: 300;
      max-width: 440px;
      margin: 0 auto 2.5rem;
      line-height: 1.7;
    }

    .contact-links {
      display: flex;
      justify-content: center;
      gap: 1rem;
      flex-wrap: wrap;
      margin-bottom: 5rem;
    }

    footer {
      border-top: 1px solid var(--border);
      padding: 2rem 5%;
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      gap: 1rem;
    }

    .footer-copy {
      font-size: 0.8rem;
      color: var(--text-dim);
    }

    .footer-links {
      display: flex;
      gap: 1.5rem;
    }

    .footer-links a {
      font-size: 0.8rem;
      color: var(--text-dim);
      text-decoration: none;
      transition: color var(--transition);
    }

    .footer-links a:hover { color: var(--text); }

    /* ─── ANIMATIONS ─── */
    @keyframes fadeUp {
      from { opacity: 0; transform: translateY(24px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .reveal {
      opacity: 0;
      transform: translateY(32px);
      transition: opacity 0.7s ease, transform 0.7s ease;
    }

    .reveal.visible {
      opacity: 1;
      transform: translateY(0);
    }

    .reveal-delay-1 { transition-delay: 0.1s; }
    .reveal-delay-2 { transition-delay: 0.2s; }
    .reveal-delay-3 { transition-delay: 0.3s; }
    .reveal-delay-4 { transition-delay: 0.4s; }

    /* ─── HAMBURGER MOBILE ─── */
    .hamburger {
      display: none;
      flex-direction: column;
      gap: 5px;
      cursor: pointer;
      padding: 4px;
    }

    .hamburger span {
      display: block;
      width: 22px;
      height: 2px;
      background: var(--text-muted);
      border-radius: 2px;
      transition: all var(--transition);
    }

    /* ─── DIVIDER ─── */
    .divider {
      width: 40px;
      height: 2px;
      background: var(--accent);
      border-radius: 2px;
      margin-bottom: 2rem;
    }

    /* ─── RESPONSIVE ─── */
    @media (max-width: 768px) {
      nav { padding: 0 4%; }
      .nav-links { display: none; }
      .hamburger { display: flex; }

      .hero { padding: 90px 4% 60px; }
      section { padding: 5rem 4%; }

      .about-grid { grid-template-columns: 1fr; gap: 3rem; }
      .projects-grid { grid-template-columns: 1fr; }

      footer { flex-direction: column; align-items: flex-start; }

      .contact h2 { font-size: 2.2rem; }
    }

    @media (max-width: 480px) {
      .hero-actions { flex-direction: column; }
      .btn { justify-content: center; }
    }
  </style>
</head>
<body>

  <!-- ═══════════════════════════════ NAV ═══════════════════════════════ -->
  <nav id="navbar">
    <a href="#" class="nav-logo">Re<span>Lu</span>Guia</a>
    <ul class="nav-links">
      <li><a href="#sobre">Sobre</a></li>
      <li><a href="#projetos">Projetos</a></li>
      <li><a href="#experiencia">Experiência</a></li>
      <li><a href="#contato" class="nav-cta">Contato</a></li>
    </ul>
    <div class="hamburger" onclick="toggleMenu(this)">
      <span></span><span></span><span></span>
    </div>
  </nav>

  <main>
    <!-- ═══════════════════════════════ HERO ═══════════════════════════════ -->
    <section class="hero" id="inicio">
      <div class="hero-orb"></div>

      <div class="hero-inner">
        <span class="hero-label">Disponível para oportunidades</span>

        <h1>
          <!-- ✏️ PERSONALIZE: substitua pelo seu nome completo -->
          <span class="name-accent">ReLuGuia</span><br />
          Backend Dev.
        </h1>

        <!-- ✏️ PERSONALIZE: ajuste o título/especialidade -->
        <p class="hero-title">Desenvolvedor Backend · PHP · MySQL · APIs REST</p>

        <!-- ✏️ PERSONALIZE: substitua pela sua bio real -->
        <p class="hero-bio">
          Desenvolvedor backend apaixonado por construir sistemas <strong>eficientes, escaláveis e bem estruturados</strong>.
          Experiência com PHP, bancos de dados relacionais e arquitetura de APIs REST.
          Comprometido com código limpo e soluções que realmente resolvem problemas.
        </p>

        <div class="hero-actions">
          <a href="#projetos" class="btn btn-primary">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/></svg>
            Ver Projetos
          </a>
          <a href="https://github.com/ReLuGuia" target="_blank" rel="noopener" class="btn btn-secondary">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12 0C5.37 0 0 5.37 0 12c0 5.3 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61C4.422 18.07 3.633 17.7 3.633 17.7c-1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.42.36.81 1.096.81 2.22 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 21.795 24 17.295 24 12c0-6.63-5.37-12-12-12"/></svg>
            GitHub
          </a>
          <!-- ✏️ PERSONALIZE: substitua pelo link do seu LinkedIn -->
          <a href="https://linkedin.com/in/SEU-LINKEDIN" target="_blank" rel="noopener" class="btn btn-secondary">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
            LinkedIn
          </a>
        </div>
      </div>

      <div class="scroll-hint">
        <div class="scroll-line"></div>
        scroll
      </div>
    </section>

    <!-- ═══════════════════════════════ SOBRE ═══════════════════════════════ -->
    <section class="about" id="sobre">
      <div class="section-header reveal">
        <span class="section-tag">Sobre mim</span>
        <h2 class="section-title">Quem sou eu</h2>
      </div>

      <div class="about-grid">
        <div class="reveal reveal-delay-1">
          <!-- ✏️ PERSONALIZE: substitua pelo seu texto real -->
          <div class="about-text">
            <p>
              Desenvolvedor backend focado em construir <strong>soluções web robustas e bem arquitetadas</strong>.
              Trabalho principalmente com PHP e ecossistema de desenvolvimento web, criando aplicações
              que combinam performance com manutenibilidade.
            </p>
            <p>
              Acredito que bom código é aquele que outros conseguem entender, manter e evoluir.
              Cada projeto é uma oportunidade de aprimorar minhas habilidades técnicas e
              <strong>contribuir com soluções que fazem diferença</strong>.
            </p>
            <p>
              Sempre buscando aprender novas tecnologias, arquiteturas e melhores práticas.
              Open source entusiast — o compartilhamento do conhecimento é o que move a comunidade dev para frente.
            </p>
          </div>
        </div>

        <div class="reveal reveal-delay-2">
          <p class="about-skills-label">Stack & Ferramentas</p>
          <div class="skills-grid">
            <!-- ✏️ PERSONALIZE: adicione/remova badges conforme suas skills reais -->
            <span class="skill-badge"><span class="skill-dot"></span>PHP</span>
            <span class="skill-badge"><span class="skill-dot"></span>MySQL</span>
            <span class="skill-badge"><span class="skill-dot"></span>HTML5</span>
            <span class="skill-badge"><span class="skill-dot"></span>CSS3</span>
            <span class="skill-badge"><span class="skill-dot"></span>JavaScript</span>
            <span class="skill-badge"><span class="skill-dot"></span>APIs REST</span>
            <span class="skill-badge"><span class="skill-dot"></span>Git</span>
            <span class="skill-badge"><span class="skill-dot"></span>Linux</span>
            <span class="skill-badge"><span class="skill-dot"></span>Apache</span>
            <span class="skill-badge"><span class="skill-dot"></span>NGINX</span>
            <span class="skill-badge"><span class="skill-dot"></span>SQL</span>
            <span class="skill-badge"><span class="skill-dot"></span>MVC</span>
          </div>
        </div>
      </div>
    </section>

    <!-- ═══════════════════════════════ PROJETOS ═══════════════════════════════ -->
    <section id="projetos">
      <div class="section-header reveal">
        <span class="section-tag">Portfólio</span>
        <h2 class="section-title">Projetos em destaque</h2>
      </div>

      <div class="projects-grid">

        <!-- PROJETO 1 — PHP repo -->
        <a href="https://github.com/ReLuGuia/Php" target="_blank" rel="noopener" class="project-card reveal reveal-delay-1">
          <div class="project-arrow">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M7 17L17 7M17 7H7M17 7v10"/></svg>
          </div>
          <div class="project-card-inner">
            <span class="project-lang php"><span class="lang-dot"></span>PHP</span>
            <h3 class="project-name">PHP — Estudos & Projetos</h3>
            <p class="project-desc">
              Repositório com projetos e experimentos em PHP, cobrindo desde fundamentos da linguagem até
              padrões de desenvolvimento backend como MVC, conexão com banco de dados, e construção de APIs.
            </p>
            <div class="project-tags">
              <span class="project-tag tag-php">PHP</span>
              <span class="project-tag tag-mysql">MySQL</span>
              <span class="project-tag tag-html">HTML</span>
              <span class="project-tag tag-css">CSS</span>
            </div>
          </div>
        </a>

        <!-- PROJETO 2 — Placeholder: substitua pelo seu repositório real -->
        <a href="https://github.com/ReLuGuia" target="_blank" rel="noopener" class="project-card reveal reveal-delay-2">
          <div class="project-arrow">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M7 17L17 7M17 7H7M17 7v10"/></svg>
          </div>
          <div class="project-card-inner">
            <!-- ✏️ PERSONALIZE: ajuste linguagem, nome, descrição e link -->
            <span class="project-lang php"><span class="lang-dot"></span>PHP</span>
            <h3 class="project-name">Projeto 2 ✏️</h3>
            <p class="project-desc">
              Substitua este card pelo seu segundo repositório. Adicione o link correto, nome real do projeto
              e uma descrição clara do que ele faz e qual problema resolve.
            </p>
            <div class="project-tags">
              <span class="project-tag tag-php">PHP</span>
              <span class="project-tag tag-generic">Backend</span>
            </div>
          </div>
        </a>

        <!-- PROJETO 3 — Placeholder: substitua pelo seu repositório real -->
        <a href="https://github.com/ReLuGuia" target="_blank" rel="noopener" class="project-card reveal reveal-delay-3">
          <div class="project-arrow">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M7 17L17 7M17 7H7M17 7v10"/></svg>
          </div>
          <div class="project-card-inner">
            <!-- ✏️ PERSONALIZE: ajuste linguagem, nome, descrição e link -->
            <span class="project-lang js"><span class="lang-dot"></span>JavaScript</span>
            <h3 class="project-name">Projeto 3 ✏️</h3>
            <p class="project-desc">
              Substitua este card pelo seu terceiro repositório. Você pode mudar a linguagem no topo,
              adicionar mais tags de tecnologia e descrever o impacto real do projeto.
            </p>
            <div class="project-tags">
              <span class="project-tag tag-js">JavaScript</span>
              <span class="project-tag tag-generic">Frontend</span>
            </div>
          </div>
        </a>

      </div>
    </section>

    <!-- ═══════════════════════════════ EXPERIÊNCIA ═══════════════════════════════ -->
    <section class="experience" id="experiencia">
      <div class="section-header reveal">
        <span class="section-tag">Trajetória</span>
        <h2 class="section-title">Experiência profissional</h2>
      </div>

      <div class="timeline">

        <!-- ✏️ PERSONALIZE: substitua com suas experiências reais do LinkedIn -->
        <div class="timeline-item reveal reveal-delay-1">
          <div class="timeline-dot"></div>
          <span class="timeline-period">2023 — Presente</span>
          <h3 class="timeline-role">Desenvolvedor Backend ✏️</h3>
          <p class="timeline-company">Nome da Empresa · Cidade, Estado</p>
          <p class="timeline-desc">
            Substitua com sua descrição real. Mencione responsabilidades, tecnologias usadas e
            impacto gerado (ex: "Desenvolvimento e manutenção de APIs REST em PHP, integração com MySQL,
            melhoria de performance que reduziu tempo de resposta em X%").
          </p>
        </div>

        <div class="timeline-item reveal reveal-delay-2">
          <div class="timeline-dot"></div>
          <span class="timeline-period">2021 — 2023</span>
          <h3 class="timeline-role">Cargo Anterior ✏️</h3>
          <p class="timeline-company">Nome da Empresa · Cidade, Estado</p>
          <p class="timeline-desc">
            Substitua com sua experiência anterior. Seja específico sobre conquistas e tecnologias.
            Resultados concretos e mensuráveis têm muito mais impacto do que descrições genéricas.
          </p>
        </div>

        <div class="timeline-item reveal reveal-delay-3">
          <div class="timeline-dot"></div>
          <span class="timeline-period">2019 — 2021</span>
          <h3 class="timeline-role">Primeiro Cargo / Estágio ✏️</h3>
          <p class="timeline-company">Nome da Empresa · Cidade, Estado</p>
          <p class="timeline-desc">
            Adicione ou remova itens de timeline conforme necessário. Você pode também incluir
            formação acadêmica aqui, como graduação ou cursos relevantes.
          </p>
        </div>

      </div>
    </section>

    <!-- ═══════════════════════════════ CONTATO ═══════════════════════════════ -->
    <section class="contact" id="contato">
      <span class="contact-pre reveal">Vamos trabalhar juntos</span>
      <h2 class="reveal reveal-delay-1">Pronto para<br />construir algo.</h2>
      <p class="contact-sub reveal reveal-delay-2">
        Aberto a novas oportunidades, projetos freelance e colaborações.
        Entre em contato e vamos conversar.
      </p>
      <div class="contact-links reveal reveal-delay-3">
        <!-- ✏️ PERSONALIZE: substitua pelo seu email real -->
        <a href="mailto:seuemail@exemplo.com" class="btn btn-primary">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="M22 7l-10 7L2 7"/></svg>
          seuemail@exemplo.com
        </a>
        <a href="https://github.com/ReLuGuia" target="_blank" rel="noopener" class="btn btn-secondary">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12 0C5.37 0 0 5.37 0 12c0 5.3 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61C4.422 18.07 3.633 17.7 3.633 17.7c-1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.42.36.81 1.096.81 2.22 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 21.795 24 17.295 24 12c0-6.63-5.37-12-12-12"/></svg>
          GitHub
        </a>
        <!-- ✏️ PERSONALIZE: adicione link LinkedIn real -->
        <a href="https://linkedin.com/in/SEU-LINKEDIN" target="_blank" rel="noopener" class="btn btn-secondary">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
          LinkedIn
        </a>
      </div>
    </section>
  </main>

  <!-- ═══════════════════════════════ FOOTER ═══════════════════════════════ -->
  <footer>
    <span class="footer-copy">© 2025 ReLuGuia · Construído com cuidado</span>
    <div class="footer-links">
      <a href="https://github.com/ReLuGuia" target="_blank" rel="noopener">GitHub</a>
      <a href="https://linkedin.com/in/SEU-LINKEDIN" target="_blank" rel="noopener">LinkedIn</a>
    </div>
  </footer>

  <script>
    // ─── NAVBAR scroll effect
    const navbar = document.getElementById('navbar');
    window.addEventListener('scroll', () => {
      navbar.classList.toggle('scrolled', window.scrollY > 20);
    });

    // ─── Hamburger menu
    function toggleMenu(btn) {
      const links = document.querySelector('.nav-links');
      const isOpen = links.style.display === 'flex';

      if (isOpen) {
        links.style.display = 'none';
        btn.classList.remove('open');
      } else {
        links.style.cssText = `
          display: flex;
          flex-direction: column;
          position: fixed;
          top: 64px;
          left: 0;
          right: 0;
          background: rgba(8,12,16,0.97);
          backdrop-filter: blur(20px);
          padding: 1.5rem 5% 2rem;
          border-bottom: 1px solid rgba(255,255,255,0.07);
          gap: 1rem;
          z-index: 99;
        `;
        btn.classList.add('open');
      }
    }

    // Close menu on link click
    document.querySelectorAll('.nav-links a').forEach(a => {
      a.addEventListener('click', () => {
        const links = document.querySelector('.nav-links');
        const btn = document.querySelector('.hamburger');
        links.removeAttribute('style');
        btn.classList.remove('open');
      });
    });

    // ─── IntersectionObserver — reveal on scroll
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('visible');
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.12 });

    document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

    // ─── Active nav link on scroll
    const sections = document.querySelectorAll('section[id]');
    const navLinks = document.querySelectorAll('.nav-links a');

    window.addEventListener('scroll', () => {
      let current = '';
      sections.forEach(section => {
        if (window.scrollY >= section.offsetTop - 120) {
          current = section.getAttribute('id');
        }
      });
      navLinks.forEach(link => {
        link.style.color = '';
        if (link.getAttribute('href') === `#${current}`) {
          link.style.color = 'var(--text)';
        }
      });
    });
  </script>
</body>
</html>
