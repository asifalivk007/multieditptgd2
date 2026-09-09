<?php
/* --- Canonical / social URL -------------------------------------------------
   Hard-code the production host so every access variant (IP address, http,
   trailing slash, DO server name) consolidates to ONE canonical URL. */
$ptg_site   = 'https://multieditptgd2.abrl.in';
$ptg_script = basename($_SERVER['PHP_SELF'] ?? 'index.php');
$ptg_canon  = ($ptg_script === 'index.php' || $ptg_script === '' || $ptg_script === '/') ? $ptg_site . '/' : $ptg_site . '/' . $ptg_script;
$ptg_ogimg  = $ptg_site . '/assets/images/design_figure.jpg';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <!-- SEO Meta Tags -->
  <title>MultiEdit PTG Designer 2.0 | Free CRISPR Multiplex Gene Editing Tool | ICAR-IARI &amp; ICAR-IASRI</title>
  <meta name="description" content="Web-based CRISPR multiplex gene editing tool for designing Polycistronic tRNA-gRNA (PTG) assemblies using Golden Gate cloning strategy. Developed by ICAR-IARI and ICAR-IASRI">
  <meta name="robots" content="<?php echo htmlspecialchars($page_robots ?? 'index, follow'); ?>">
  <meta name="author" content="ICAR-IARI &amp; ICAR-IASRI">

  <!-- Canonical URL (consolidates duplicate/variant URLs for search engines) -->
  <link rel="canonical" href="<?php echo htmlspecialchars($ptg_canon); ?>">

  <!-- Open Graph -->
  <meta property="og:title" content="MultiEdit PTG Designer 2.0 | CRISPR Multiplex Gene Editing Tool">
  <meta property="og:description" content="Design Polycistronic tRNA-gRNA assemblies for CRISPR multiplex gene editing. Developed by ICAR-IARI &amp; ICAR-IASRI.">
  <meta property="og:type" content="website">
  <meta property="og:url" content="<?php echo htmlspecialchars($ptg_canon); ?>">
  <meta property="og:site_name" content="MultiEdit PTG Designer 2.0">
  <meta property="og:image" content="<?php echo htmlspecialchars($ptg_ogimg); ?>">
  <meta property="og:locale" content="en_US">

  <!-- Twitter / X card -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="MultiEdit PTG Designer 2.0 | CRISPR Multiplex Gene Editing Tool">
  <meta name="twitter:description" content="Design Polycistronic tRNA-gRNA assemblies for CRISPR multiplex gene editing. Developed by ICAR-IARI &amp; ICAR-IASRI.">
  <meta name="twitter:image" content="<?php echo htmlspecialchars($ptg_ogimg); ?>">

  <!-- Structured data: scientific web application (Schema.org) -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "SoftwareApplication",
    "name": "MultiEdit PTG Designer 2.0",
    "applicationCategory": "ScientificApplication",
    "operatingSystem": "Web browser",
    "url": "https://multieditptgd2.abrl.in/",
    "description": "Web-based CRISPR multiplex gene editing tool for designing Polycistronic tRNA-gRNA (PTG) assemblies using a Golden Gate cloning strategy. Developed by ICAR-IARI &amp; ICAR-IASRI.",
    "creator": { "@type": "Organization", "name": "ICAR-IARI & ICAR-IASRI" },
    "offers": { "@type": "Offer", "price": "0", "priceCurrency": "USD" }
  }
  </script>

  <!-- Favicons -->
  <link href="assets/images/tool_logo.jpg?v=2.1" rel="icon">
  <link href="assets/images/tool_logo.jpg?v=2.1" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@400;500;600&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/styles.css" rel="stylesheet">

  <style>


    /* ======================================
       BRANDING / HEADER
    ====================================== */
    .header .branding {
      background: #fff;
      border-bottom: 2px solid #e8f5e9;
      padding: 0;
    }
    .header .logo {
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .header .logo img {
      height: 73px;
      width: auto;
      object-fit: contain;
    }
    .header .logo h1 {
      font-size: 1.3rem;
      font-weight: 700;
      margin: 0;
      color: #1a3d2b;
      line-height: 1.2;
    }
    .header .logo h1 span {
      display: block;
      font-size: 0.75rem;
      font-weight: 400;
      color: #4a7c59;
      margin-top: 1px;
    }
    .cta-btn {
      background: #1a7a3c;
      color: #fff !important;
      padding: 8px 22px;
      border-radius: 4px;
      font-size: 0.88rem;
      font-weight: 600;
      text-decoration: none;
      transition: background 0.3s;
      white-space: nowrap;
    }
    .cta-btn:hover {
      background: #145e2e;
      color: #fff !important;
    }

    /* ======================================
       NAV MENU
    ====================================== */
    .navmenu ul {
      list-style: none;
      margin: 0;
      padding: 0;
      display: flex;
      gap: 4px;
    }
    .navmenu ul li a {
      color: #2c3e50;
      text-decoration: none;
      font-size: 0.9rem;
      font-weight: 500;
      padding: 6px 14px;
      border-radius: 4px;
      transition: all 0.3s;
      display: block;
    }
    .navmenu ul li a:hover,
    .navmenu ul li a.active {
      color: #1a7a3c;
      background: #e8f5e9;
    }

    /* Mobile nav toggle */
    .mobile-nav-toggle {
      font-size: 1.5rem;
      color: #1a3d2b;
      cursor: pointer;
      display: none;
    }
    @media (max-width: 1199px) {
      .mobile-nav-toggle {
        display: block;
      }
      .navmenu ul {
        display: none;
        flex-direction: column;
        position: absolute;
        /* Full inset reset so styles.css's `inset: 60px 20px 20px 20px` can't leak a bottom edge
           (which was stretching + clipping the menu to a thin strip). */
        inset: 100% 0 auto 0;
        margin: 0;
        padding: 10px 20px;
        background: #fff;
        border: none;
        border-top: 2px solid #e8f5e9;
        border-radius: 0;
        /* Override styles.css `overflow-y: auto`, which was clipping the collapsed menu. */
        overflow: visible;
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        z-index: 1000;
      }
      .mobile-nav-active .navmenu ul {
        display: flex;
      }
      .mobile-nav-active .navmenu {
        position: static !important;
        inset: auto !important;
        background: transparent !important;
      }
      .mobile-nav-active .mobile-nav-toggle {
        color: #1a3d2b !important;
        position: static !important;
        font-size: 1.5rem !important;
      }
    }

    /* ======================================
       HERO SECTION
    ====================================== */
    .hero {
      position: relative;
      overflow: hidden;
      min-height: 480px;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }
    .hero img.hero-bg {
      position: absolute;
      inset: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      z-index: 0;
      opacity: 0.18;
    }
    .hero .hero-overlay {
      position: absolute;
      inset: 0;
      background: linear-gradient(135deg, rgba(26,61,43,0.82) 0%, rgba(26,122,60,0.65) 100%);
      z-index: 1;
    }
    .hero .container {
      position: relative;
      z-index: 2;
    }
    .hero .welcome-box {
      color: #fff;
      padding: 40px 0 20px;
    }
    .hero .welcome-box h2 {
      font-size: 2.4rem;
      font-weight: 700;
      color: #fff;
      margin-bottom: 12px;
    }
    .hero .welcome-box p {
      font-size: 1.1rem;
      color: #d4edda;
      margin-bottom: 20px;
      max-width: 620px;
    }
    .hero .badge-row .badge {
      font-size: 0.82rem;
      padding: 6px 14px;
      border-radius: 20px;
      font-weight: 500;
      margin-right: 6px;
      margin-bottom: 6px;
    }
    .badge-icar  { background: #9a031e; color: #fff; }
    .badge-wet   { background: #0d6efd; color: #fff; }
    .badge-open  { background: #e36414; color: #fff; }
    .badge-recognition { background: #6b21a8; color: #fff; }

    .table-custom-striped {
      font-size: 0.9rem;
    }
    .table-custom-striped tbody tr:nth-of-type(odd) > * {
      background-color: #e8f5e9 !important;
      box-shadow: inset 0 0 0 9999px #e8f5e9;
    }

    /* Icon Boxes */
    .hero .icon-boxes {
      padding: 30px 0 40px;
    }
    .hero .icon-box {
      background: rgba(255,255,255,0.12);
      border: 1px solid rgba(255,255,255,0.25);
      border-radius: 10px;
      padding: 24px 20px;
      color: #fff;
      height: 100%;
      transition: transform 0.3s, background 0.3s;
    }
    .hero .icon-box:hover {
      background: rgba(255,255,255,0.2);
      transform: translateY(-4px);
    }
    .hero .icon-box i {
      font-size: 2rem;
      color: #81c784;
      margin-bottom: 12px;
      display: block;
    }
    .hero .icon-box h3 {
      font-size: 1rem;
      font-weight: 700;
      color: #fff;
      margin-bottom: 6px;
    }
    .hero .icon-box p {
      font-size: 0.84rem;
      color: #c8e6c9;
      margin: 0;
    }

    /* ======================================
       SECTION COMMON
    ====================================== */
    .section {
      padding: 60px 0;
    }
    .light-background {
      background: #f9fdf9;
    }
    .section-title {
      text-align: center;
      margin-bottom: 40px;
    }
    .section-title h2 {
      font-size: 2rem;
      font-weight: 700;
      color: #1a3d2b;
      position: relative;
      display: inline-block;
      padding-bottom: 10px;
    }
    .section-title h2::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 50%;
      transform: translateX(-50%);
      width: 60px;
      height: 3px;
      background: #1a7a3c;
      border-radius: 2px;
    }
    .section-title p {
      color: #666;
      margin-top: 10px;
      font-size: 1rem;
    }

    /* ======================================
       ABOUT SECTION
    ====================================== */
    .about .about-img img {
      width: 100%;
      border-radius: 12px;
      box-shadow: 0 8px 30px rgba(0,0,0,0.12);
    }
    .about .about-content h3 {
      font-size: 1.6rem;
      font-weight: 700;
      color: #1a3d2b;
      margin-bottom: 16px;
    }
    .about .about-content p {
      color: #555;
      font-size: 0.97rem;
      line-height: 1.75;
      margin-bottom: 20px;
    }
    .about .feature-list {
      list-style: none;
      padding: 0;
      margin: 0 0 28px;
    }
    .about .feature-list li {
      display: flex;
      align-items: flex-start;
      gap: 14px;
      margin-bottom: 18px;
    }
    .about .feature-list li .icon-wrap {
      background: #e8f5e9;
      color: #1a7a3c;
      width: 44px;
      height: 44px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.1rem;
      flex-shrink: 0;
    }
    .about .feature-list li .text h4 {
      font-size: 0.95rem;
      font-weight: 700;
      color: #1a3d2b;
      margin: 0 0 3px;
    }
    .about .feature-list li .text p {
      font-size: 0.85rem;
      color: #666;
      margin: 0;
    }
    .btn-accent {
      background: #1a7a3c;
      color: #fff;
      border: 2px solid #1a7a3c;
      padding: 10px 26px;
      border-radius: 5px;
      font-weight: 600;
      font-size: 0.92rem;
      text-decoration: none;
      transition: all 0.3s;
      display: inline-block;
      margin-right: 10px;
      margin-bottom: 8px;
    }
    .btn-accent:hover {
      background: #145e2e;
      border-color: #145e2e;
      color: #fff;
    }
    .btn-outline-accent {
      background: transparent;
      color: #1a7a3c;
      border: 2px solid #1a7a3c;
      padding: 10px 26px;
      border-radius: 5px;
      font-weight: 600;
      font-size: 0.92rem;
      text-decoration: none;
      transition: all 0.3s;
      display: inline-block;
      margin-bottom: 8px;
    }
    .btn-outline-accent:hover {
      background: #1a7a3c;
      color: #fff;
    }

    /* ======================================
       STATS SECTION
    ====================================== */
    .stats .stats-item {
      text-align: center;
      padding: 24px 10px;
    }
    .stats .stats-item i {
      font-size: 2.2rem;
      color: #1a7a3c;
      margin-bottom: 10px;
      display: block;
    }
    .stats .stats-item .purecounter {
      font-size: 2.8rem;
      font-weight: 800;
      color: #1a3d2b;
      display: block;
      line-height: 1;
    }
    .stats .stats-item p {
      font-size: 0.92rem;
      color: #555;
      margin: 6px 0 0;
      font-weight: 500;
    }

    /* ======================================
       SEQUENCES SECTION
    ====================================== */
    .seq-card {
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.08);
      padding: 26px 22px;
      height: 100%;
      transition: transform 0.3s, box-shadow 0.3s;
    }
    .seq-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 8px 30px rgba(0,0,0,0.14);
    }
    .seq-card .seq-card-header {
      display: flex;
      align-items: center;
      gap: 12px;
      margin-bottom: 16px;
    }
    .seq-card .seq-card-header i {
      font-size: 1.6rem;
      color: #1a7a3c;
    }
    .seq-card .seq-card-header h5 {
      font-size: 1rem;
      font-weight: 700;
      color: #1a3d2b;
      margin: 0;
    }
    .seq-card .seq-body {
      font-family: 'Fira Code', 'Courier New', Courier, monospace;
      font-size: 0.88rem;
      line-height: 1.7;
      word-break: break-all;
      background: #f4faf5;
      border: 1px solid #d4edda;
      border-radius: 6px;
      padding: 12px;
      color: #2c3e50;
    }
    .seq-prefix  { color: #7b1fa2; }
    .seq-grna    { color: #1565c0; font-weight: 600; }
    .seq-trna    { color: #e65100; font-weight: 600; }
    .seq-suffix  { color: #558b2f; }
    .seq-plain   { color: #1565c0; font-weight: 600; }

    /* ======================================
       FOOTER
    ====================================== */
    .footer {
      background: #f9fdf9;
      border-top: 5px solid #1a3d2b;
      padding: 0;
    }
    .footer .footer-top {
      padding: 50px 0 30px;
    }
    .footer .footer-logo {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-bottom: 14px;
    }
    .footer .footer-logo img {
      height: 42px;
    }
    .footer .footer-logo span {
      font-size: 1.05rem;
      font-weight: 700;
      color: #1a3d2b;
    }
    .footer .footer-about p {
      color: #666;
      font-size: 0.87rem;
      line-height: 1.7;
      margin-bottom: 16px;
    }
    .footer .social-links a {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 34px;
      height: 34px;
      background: #e8f5e9;
      color: #1a7a3c;
      border-radius: 50%;
      margin-right: 6px;
      font-size: 0.9rem;
      text-decoration: none;
      transition: all 0.3s;
    }
    .footer .social-links a:hover {
      background: #1a7a3c;
      color: #fff;
    }
    .footer h4 {
      font-size: 1rem;
      font-weight: 700;
      color: #1a3d2b;
      margin-bottom: 16px;
      position: relative;
      padding-bottom: 8px;
    }
    .footer h4::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 36px;
      height: 2px;
      background: #1a7a3c;
      border-radius: 2px;
    }
    .footer .footer-links ul {
      list-style: none;
      padding: 0;
      margin: 0;
    }
    .footer .footer-links ul li {
      margin-bottom: 8px;
    }
    .footer .footer-links ul li a {
      color: #555;
      font-size: 0.88rem;
      text-decoration: none;
      transition: color 0.3s;
      display: flex;
      align-items: center;
      gap: 6px;
    }
    .footer .footer-links ul li a::before {
      content: '\F285';
      font-family: 'Bootstrap Icons';
      color: #1a7a3c;
      font-size: 0.7rem;
    }
    .footer .footer-links ul li a:hover {
      color: #1a7a3c;
    }
    .footer .footer-contact p {
      color: #555;
      font-size: 0.88rem;
      margin-bottom: 8px;
      display: flex;
      align-items: flex-start;
      gap: 8px;
    }
    .footer .footer-contact p i {
      color: #1a7a3c;
      margin-top: 2px;
      flex-shrink: 0;
    }
    .footer .footer-contact a {
      color: #1a7a3c;
      text-decoration: none;
    }
    .footer .footer-contact a:hover {
      text-decoration: underline;
    }
    .footer .footer-bottom {
      background: #1a3d2b;
      color: #c8e6c9;
      text-align: center;
      padding: 14px 0;
      font-size: 0.84rem;
    }

    /* ======================================
       SCROLL TOP
    ====================================== */
    .scroll-top {
      position: fixed;
      bottom: 28px;
      right: 24px;
      width: 42px;
      height: 42px;
      background: #1a7a3c;
      color: #fff;
      border-radius: 50%;
      font-size: 1.4rem;
      z-index: 9999;
      opacity: 0;
      transition: all 0.4s;
      text-decoration: none;
      box-shadow: 0 4px 14px rgba(26,122,60,0.4);
    }
    .scroll-top:hover {
      background: #145e2e;
      color: #fff;
    }
    .scroll-top.active {
      opacity: 1;
    }

    /* ======================================
       PRELOADER
    ====================================== */
    #preloader {
      position: fixed;
      inset: 0;
      z-index: 99999;
      background: #fff;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: opacity 0.4s;
    }
    #preloader::after {
      content: '';
      width: 50px;
      height: 50px;
      border: 5px solid #e8f5e9;
      border-top-color: #1a7a3c;
      border-radius: 50%;
      animation: spin 0.8s linear infinite;
    }
    @keyframes spin {
      to { transform: rotate(360deg); }
    }
    #preloader.loaded {
      opacity: 0;
      pointer-events: none;
    }

    /* --- Image Zoom Overlay --- */
    .zoomable-img-container .zoom-overlay {
      background-color: rgba(0, 0, 0, 0.4);
      opacity: 0;
      transition: opacity 0.3s ease;
    }
    .zoomable-img-container:hover .zoom-overlay {
      opacity: 1;
    }
    .zoomable-img-container img {
      transition: transform 0.3s ease;
    }
    .zoomable-img-container:hover img {
      transform: scale(1.02);
    }
    
    /* Hover effects for zoom and close buttons */
    .zoomable-img-container .zoom-overlay i {
      color: #ffffff !important; /* Always white */
      transition: transform 0.3s ease;
    }
    .zoomable-img-container:hover .zoom-overlay i {
      transform: scale(1.1);
    }
    
    .zoom-close-btn {
      background-color: #1a7a3c !important; /* Light green initially */
      color: #ffffff !important;
      border: none !important;
      transition: all 0.3s ease !important;
    }
    .zoom-close-btn:hover {
      background-color: #000000 !important; /* Black on hover */
      color: #ffffff !important;
    }
  </style>

  <script defer src="https://website-analytics.abrl.in/script.js" data-website-id="27da9533-6a30-4462-8965-76282d1a44b4"></script>
</head>

<body class="index-page">

  <!-- ======================================
       HEADER
  ====================================== -->
  <header id="header" class="header sticky-top">



    <!-- Branding Bar -->
    <div class="branding">
      <div class="container-fluid px-3 px-xl-5 d-flex align-items-center justify-content-between py-1">

        <!-- Left Side: Logos and Title -->
        <div class="d-flex align-items-center">
          <!-- ICAR Logo on far left -->
          <a href="index.php" class="d-flex align-items-center text-decoration-none me-4 me-xl-5 pe-xl-4">
            <img src="assets/images/ICAR_logo.png" alt="ICAR Logo" style="height: 52px; width: auto; object-fit: contain;">
          </a>

          <!-- Tool Logo -->
          <a href="index.php" class="logo d-flex align-items-center text-decoration-none">
            <img src="assets/images/tool_logo.jpg?v=2.1" alt="MultiEdit PTG Designer Logo">
            <h1>MultiEdit PTG Designer 2.0
              <span>Polycistronic tRNA-gRNA System</span>
            </h1>
          </a>
        </div><!-- /Left Side -->

        <!-- Nav + CTA -->
        <div class="d-flex align-items-center gap-3">
          <nav id="navmenu" class="navmenu">
            <ul>
              <li><a href="index.php" class="<?php echo (isset($active_page) && $active_page == 'home') ? 'active' : ''; ?>">Home</a></li>
              <li><a href="tool.php" class="<?php echo (isset($active_page) && $active_page == 'tool') ? 'active' : ''; ?>">Tool</a></li>
              <li><a href="documentation.php" class="<?php echo (isset($active_page) && $active_page == 'docs') ? 'active' : ''; ?>">Documentation</a></li>
              <li><a href="team.php" class="<?php echo (isset($active_page) && $active_page == 'team') ? 'active' : ''; ?>">Research Team</a></li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
          </nav>
          <a class="cta-btn d-none d-sm-block" href="tool.php">Launch Tool</a>
        </div>

      </div>
    </div><!-- /Branding Bar -->

  </header><!-- /HEADER -->
