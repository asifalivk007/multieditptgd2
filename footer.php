<style>
  /* --- Contact email: hover shows a hint, click copies (footer.php) --- */
  .footer .copy-email {
    position: relative;
    background: none;
    border: none;
    padding: 0;
    font: inherit;           /* match the surrounding contact text exactly */
    color: var(--accent-color);
    cursor: pointer;
    transition: color 0.3s;
  }
  .footer .copy-email:hover {
    color: color-mix(in srgb, var(--accent-color), transparent 25%);
  }
  .footer .copy-email:focus-visible {
    outline: 2px solid var(--accent-color);
    outline-offset: 2px;
    border-radius: 3px;
  }

  /* Tooltip bubble — text comes from data-tip, which the handler swaps to
     "Copied!" on click. Hidden from AT (aria-label carries the same meaning). */
  .footer .copy-email::after {
    content: attr(data-tip);
    position: absolute;
    left: 50%;
    bottom: calc(100% + 8px);
    transform: translateX(-50%) translateY(3px);
    white-space: nowrap;
    background: #1a3d2b;
    color: #fff;
    font-size: 12px;
    font-weight: 500;
    line-height: 1.4;
    padding: 4px 10px;
    border-radius: 5px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.18);
    opacity: 0;
    visibility: hidden;
    pointer-events: none;
    transition: opacity 0.18s ease, transform 0.18s ease;
    z-index: 10;
  }
  /* Little arrow under the bubble */
  .footer .copy-email::before {
    content: "";
    position: absolute;
    left: 50%;
    bottom: calc(100% + 3px);
    transform: translateX(-50%) translateY(3px);
    border: 5px solid transparent;
    border-top-color: #1a3d2b;
    opacity: 0;
    visibility: hidden;
    pointer-events: none;
    transition: opacity 0.18s ease, transform 0.18s ease;
    z-index: 10;
  }
  .footer .copy-email:hover::after,
  .footer .copy-email:hover::before,
  .footer .copy-email:focus-visible::after,
  .footer .copy-email:focus-visible::before {
    opacity: 1;
    visibility: visible;
    transform: translateX(-50%) translateY(0);
  }
</style>

<!-- ======================================
       FOOTER
  ====================================== -->
  <footer id="footer" class="footer light-background">

    <div class="footer-top">
      <div class="container">
        <div class="row g-4">

          <!-- Col 1: About -->
          <div class="col-lg-4 col-md-6">
            <div class="footer-about d-flex flex-column justify-content-center h-100">
              <div class="d-flex flex-column flex-lg-row align-items-lg-center mb-3">
                <div class="footer-logo d-flex align-items-center mb-3 mb-lg-0">
                  <img src="assets/images/IARI_logo.png" alt="IARI Logo" style="height: 100px; margin-right: 20px;">
                  <img src="assets/images/iasri_logo.png" alt="IASRI Logo" style="height: 100px;">
                </div>
                <div class="social-links d-flex gap-2 ms-lg-4">
                  <a href="https://github.com/asifalivk007/multieditptgd2" title="GitHub" target="_blank" rel="noopener"><i class="bi bi-github"></i></a>
                  <!-- href is a placeholder until the v2 paper is published. -->
                  <a href="#" title="Publication" target="_blank" rel="noopener"><i class="bi bi-mortarboard-fill"></i></a>
                  <!-- Gmail compose endpoint rather than mailto: — a mailto: hands the address to the
                       OS default mail handler, which silently does nothing on machines with no desktop
                       mail client registered (and target="_blank" left a stray blank tab behind). -->
                  <a class="js-email" data-e="amlxdWJhbEBnbWFpbC5jb20=" data-e-gmail title="Email" target="_blank" rel="noopener"><i class="bi bi-envelope-fill"></i></a>
                </div>
              </div>
            </div>
          </div>



          <!-- Col 3: Developed By -->
          <div class="col-lg-3 col-md-6">
            <div class="footer-links">
              <h4>Developed By</h4>
              <div class="footer-contact">
                <p>
                  <i class="bi bi-building"></i>
                  ICAR-IARI, New Delhi – 110012
                </p>
                <p>
                  <i class="bi bi-building"></i>
                  ICAR-IASRI, New Delhi – 110012
                </p>
                <p class="mt-3">
                  <i class="bi bi-file-earmark-pdf"></i>
                  <a href="data/ICAR_Data_Use_Licence.pdf" target="_blank"><b>ICAR Data Use Licence</b></a>
                </p>
              </div>
            </div>
          </div>

          <!-- Col 4: Contact -->
          <div class="col-lg-3 col-md-6">
            <div class="footer-contact">
              <h4>Contact and Support</h4>
              <p>
                <i class="bi bi-envelope"></i>
                <button type="button" class="copy-email js-email" data-e="amlxdWJhbEBnbWFpbC5jb20=" data-e-text data-e-copy
                        data-tip="Copy email address" aria-label="Copy email address">Email us</button>
              </p>
              <p>
                <i class="bi bi-geo-alt"></i>
                ICAR-IARI, Library Avenue, Pusa,<br>New Delhi – 110012, India
              </p>
              <p>
                <i class="bi bi-info-circle"></i>
                For technical queries and collaborations, please reach out via email.
              </p>
            </div>
          </div>

          <!-- Col 5: Visitor Globe -->
          <div class="col-lg-2 col-md-6 d-flex align-items-center justify-content-center flex-column p-0">
            <div class="footer-map-section w-100 p-0">
              <!-- Load 3D Engine Dependencies with explicit versions and UMD paths -->
              <script src="https://unpkg.com/three@0.160.0/build/three.min.js"></script>
              <script src="https://unpkg.com/globe.gl@2.32.2/dist/globe.gl.min.js"></script>

              <!-- The visual placeholder frame for the footer -->
              <div id="trafficGlobe" style="width: 100%; height: 180px; border-radius: 8px; overflow: hidden; background: transparent; margin: 0 auto; display: flex; justify-content: center; align-items: center; text-align: center;"></div>
              <!-- Counter block directly under the globe -->
              <div id="visitCounter" style="color: #000000; border: 1px solid #000000; border-radius: 12px; padding: 3px 10px; font-size: 11px; margin: 5px auto 0 auto; font-family: monospace, sans-serif; text-align: center; display: block; width: -moz-fit-content; width: fit-content;">Visitors: ... || Visits: ... </div>

              <script>
                // Ensure absolute path from the current directory
                const dataUrl = '<?php echo rtrim(dirname($_SERVER["SCRIPT_NAME"]), "/\\"); ?>/globe-data.php';
                
                Promise.all([
                  fetch(dataUrl).then(async res => {
                    if (!res.ok) throw new Error(`HTTP ${res.status}: ${await res.text()}`);
                    return res.json();
                  }),
                  // Fetch GeoJSON for drawing the countries (landmass)
                  fetch('https://raw.githubusercontent.com/vasturiano/globe.gl/master/example/datasets/ne_110m_admin_0_countries.geojson')
                    .then(res => res.json())
                ])
                .then(([data, countries]) => {
                  if(data.error) {
                    throw new Error("API Error: " + data.error);
                  }
                  
                  if (typeof Globe === 'undefined') {
                    throw new Error("The globe.gl library failed to load (possibly blocked by an extension or network issue).");
                  }
                  
                  // Calculate and display total visits
                  
                  document.getElementById('visitCounter').innerHTML = `<strong>Visitors:</strong> ${(data.total_visitors || 0).toLocaleString()} <strong>||</strong> <strong>Visits:</strong> ${(data.total_visits || 0).toLocaleString()}`;
                  
                  const container = document.getElementById('trafficGlobe');
                  const gWidth = container.clientWidth || 200;
                  const gHeight = container.clientHeight || 180;
                  
                  const worldGlobe = Globe()
                    (container)
                    .width(gWidth)
                    .height(gHeight)
                    .backgroundColor('rgba(0,0,0,0)') 
                    .showGlobe(true)
                    .showAtmosphere(false)
                    // Draw landmass optimized (no heavy 3D walls)
                    .polygonsData(countries.features)
                    .polygonAltitude(0.01) 
                    .polygonCapColor(() => '#374d23') 
                    .polygonSideColor(() => 'transparent') 
                    .polygonStrokeColor(() => '#8a8a8a') 
                    // Draw traffic data as flat dots
                    .labelsData(data.globe || [])
                    .labelLat(d => d.lat)
                    .labelLng(d => d.lng)
                    .labelDotRadius(1.5) 
                    .labelColor(() => '#00ff62') 
                    .labelText(() => '') 
                    .labelAltitude(0.02) 
                    .labelLabel(d => `
                      <div style="background: rgba(10,10,10,0.9); padding: 4px 8px; border-radius: 4px; border: 1px solid #333; color: #fff; font-family: monospace, sans-serif; font-size: 8px;">
                        <strong></strong> ${d.label}<strong>:</strong> ${d.weight}
                      </div>
                    `)
                    .onGlobeClick(() => window.open('https://website-analytics.abrl.in/share/ghT01ZLNHpMNu2dt', '_blank'))
                    .onPolygonClick(() => window.open('https://website-analytics.abrl.in/share/ghT01ZLNHpMNu2dt', '_blank'))
                    .onLabelClick(() => window.open('https://website-analytics.abrl.in/share/ghT01ZLNHpMNu2dt', '_blank'))
                    .onLabelHover(label => {
                      if (label) {
                        worldGlobe.controls().autoRotateSpeed = 0; // Instantly freeze when hovered
                        if (window.globeHoverTimeout) clearTimeout(window.globeHoverTimeout);
                      } else {
                        // When mouse leaves, wait exactly 2 seconds before resuming rotation
                        if (window.globeHoverTimeout) clearTimeout(window.globeHoverTimeout);
                        window.globeHoverTimeout = setTimeout(() => {
                          worldGlobe.controls().autoRotateSpeed = 3;
                        }, 2000);
                      }
                    });
                    
                  // Set faint color via globeMaterial for the base
                  const globeMat = worldGlobe.globeMaterial();
                  globeMat.color.set('#374d23');
                  globeMat.transparent = true;
                  globeMat.opacity = 0.15;

                  // Apply flat lighting to remove shadows
                  const scene = worldGlobe.scene();
                  scene.children.forEach(c => {
                    if (c.type === 'AmbientLight') c.intensity = 6;
                    if (c.type === 'DirectionalLight') c.intensity = 0;
                  });
                    
                  worldGlobe.controls().autoRotate = true;
                  worldGlobe.controls().autoRotateSpeed = 3; 
                  worldGlobe.controls().enableZoom = false; 
                  worldGlobe.controls().enablePan = false; 
                  worldGlobe.pointOfView({ altitude: 1.7 }); 
                })
                .catch(err => {
                  console.error('Globe Error:', err);
                  document.getElementById('trafficGlobe').innerHTML = `<p style="color:#ff6b6b; font-size: 11px; word-break: break-all;">Error: ${err.message}</p>`;
                });
              </script>
            </div>
          </div>

        </div>
      </div>
    </div><!-- /footer-top -->

    <!-- Footer Bottom -->
    <div class="footer-bottom">
      <div class="container d-flex flex-wrap justify-content-center align-items-center gap-2">
        <span>&copy; 2026 <strong>MultiEdit PTG Designer 2.0</strong> &mdash; ICAR-IARI &amp; ICAR-IASRI. All rights reserved.</span>
      </div>
    </div><!-- /footer-bottom -->

  </footer><!-- /FOOTER -->

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center">
    <i class="bi bi-arrow-up-short"></i>
  </a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- ======================================
       SCRIPTS
  ====================================== -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/js/template-main.js"></script>

  <script>
    // ---- AOS Init ----
    AOS.init({
      duration: 600,
      easing: 'ease-in-out',
      once: true,
      mirror: false
    });

    // ---- PureCounter Init ----
    new PureCounter();

    // ---- Preloader ----
    window.addEventListener('load', function () {
      const preloader = document.getElementById('preloader');
      if (preloader) {
        preloader.classList.add('loaded');
        setTimeout(function () { preloader.remove(); }, 500);
      }
    });

    // ---- Scroll Top ----
    const scrollTop = document.getElementById('scroll-top');
    function toggleScrollTop() {
      if (scrollTop) {
        window.scrollY > 100 ? scrollTop.classList.add('active') : scrollTop.classList.remove('active');
      }
    }
    if (scrollTop) {
      scrollTop.addEventListener('click', function (e) {
        e.preventDefault();
        window.scrollTo({ top: 0, behavior: 'smooth' });
      });
    }
    window.addEventListener('scroll', toggleScrollTop);
    toggleScrollTop();

    // ---- Email address assembly ----
    // The address is never present in the served HTML. It is base64-encoded in
    // data-e and assembled at runtime, so regex-based address harvesters that
    // scrape raw markup (the overwhelming majority) find nothing to collect.
    //   data-e-text   -> write the address as the element's visible text
    //   data-e-copy   -> expose it to the copy-to-clipboard handler
    //   data-e-gmail  -> build a Gmail compose href
    document.querySelectorAll('.js-email[data-e]').forEach(function (el) {
      var addr;
      try { addr = atob(el.dataset.e); } catch (err) { return; }
      if (!addr) return;
      if (el.hasAttribute('data-e-text')) el.textContent = addr;
      if (el.hasAttribute('data-e-copy')) el.dataset.copy = addr;
      if (el.hasAttribute('data-e-gmail')) {
        el.href = 'https://mail.google.com/mail/?view=cm&fs=1&to=' + encodeURIComponent(addr);
      }
    });

    // ---- Contact email: click to copy ----
    // navigator.clipboard is unavailable on insecure origins (plain http) and in
    // some older browsers, so fall back to the execCommand textarea trick.
    document.querySelectorAll('.copy-email').forEach(function (el) {
      var IDLE = 'Copy email address';
      var timer = null;

      function flash(msg) {
        el.dataset.tip = msg;
        clearTimeout(timer);
        timer = setTimeout(function () { el.dataset.tip = IDLE; }, 2000);
      }

      function fallback() {
        var ta = document.createElement('textarea');
        ta.value = el.dataset.copy || '';
        ta.setAttribute('readonly', '');
        ta.style.position = 'fixed';
        ta.style.opacity = '0';
        document.body.appendChild(ta);
        ta.select();
        try {
          document.execCommand('copy');
          flash('Copied!');
        } catch (err) {
          console.error('Copy failed:', err);
          flash('Press Ctrl+C to copy');
        }
        document.body.removeChild(ta);
      }

      el.addEventListener('click', function () {
        var text = el.dataset.copy || '';
        if (!text) return;
        if (navigator.clipboard && window.isSecureContext) {
          navigator.clipboard.writeText(text).then(function () { flash('Copied!'); }).catch(fallback);
        } else {
          fallback();
        }
      });

      // Reset the bubble when the pointer leaves, so the next hover starts fresh.
      el.addEventListener('mouseleave', function () {
        clearTimeout(timer);
        el.dataset.tip = IDLE;
      });
    });

  </script>

  <?php if(isset($extra_scripts)) echo $extra_scripts; ?>
</body>

</html>