<?php
/**
 * globe_parameters.php
 * --------------------------------------------------------
 * Standalone tuning console for the footer.php visitor globe.
 * Adjust every visual/behavioural parameter on the left,
 * watch the live preview update, then hit "Export snippet"
 * at the bottom of the panel and paste the result straight
 * over the "Col 5: Visitor Globe" block in footer.php.
 *
 * Drop this file in the SAME directory as footer.php and
 * globe-data.php so it can pull real traffic data. If that
 * fetch fails (or you tick "Use sample data"), the console
 * falls back to generated sample telemetry so you can still
 * tune colors/motion without a live backend.
 * --------------------------------------------------------
 */
$dataScriptDir = rtrim(dirname($_SERVER["SCRIPT_NAME"]), "/\\");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Globe Parameter Console</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@400;500;600&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<style>
  :root{
    --bg-console:#10161a;
    --panel:#161f24;
    --panel-alt:#1c272d;
    --border:#293439;
    --border-soft:#232d32;
    --text-primary:#e7ece9;
    --text-muted:#8ba09a;
    --text-faint:#5c6e69;
    --signal:#00ff62;
    --signal-dim:#0f8f45;
    --olive:#5e7d43;
    --stage-bg:#eef1e8;
    --danger:#d9705a;
    --mono: 'IBM Plex Mono', ui-monospace, monospace;
    --sans: 'Inter', system-ui, sans-serif;
  }
  *{box-sizing:border-box;}
  html,body{margin:0;padding:0;}
  body{
    background:var(--bg-console);
    color:var(--text-primary);
    font-family:var(--sans);
    -webkit-font-smoothing:antialiased;
  }
  a{color:var(--signal);}

  .app{
    display:flex;
    min-height:100vh;
    align-items:stretch;
  }

  /* ---------------- Sidebar ---------------- */
  .sidebar{
    width:360px;
    flex-shrink:0;
    background:var(--panel);
    border-right:1px solid var(--border);
    display:flex;
    flex-direction:column;
    position:sticky;
    top:0;
    height:100vh;
  }
  .sidebar-head{
    padding:20px 20px 14px;
    border-bottom:1px solid var(--border-soft);
  }
  .sidebar-head .eyebrow{
    font-family:var(--mono);
    font-size:10.5px;
    letter-spacing:.12em;
    color:var(--signal);
    display:flex;
    align-items:center;
    gap:6px;
  }
  .sidebar-head .eyebrow .dot{
    width:6px;height:6px;border-radius:50%;
    background:var(--signal);
    box-shadow:0 0 6px var(--signal);
    animation:pulse 2.4s ease-in-out infinite;
  }
  @media (prefers-reduced-motion: reduce){
    .sidebar-head .eyebrow .dot{ animation:none; }
  }
  @keyframes pulse{
    0%,100%{opacity:1;} 50%{opacity:.35;}
  }
  .sidebar-head h1{
    margin:8px 0 4px;
    font-family:var(--mono);
    font-size:17px;
    font-weight:600;
    letter-spacing:-0.01em;
  }
  .sidebar-head p{
    margin:0;
    font-size:12px;
    line-height:1.5;
    color:var(--text-muted);
  }

  .sidebar-scroll{
    flex:1;
    overflow-y:auto;
    padding:6px 20px 24px;
  }
  .sidebar-scroll::-webkit-scrollbar{ width:8px; }
  .sidebar-scroll::-webkit-scrollbar-thumb{ background:var(--border); border-radius:8px; }
  .sidebar-scroll::-webkit-scrollbar-track{ background:transparent; }

  details.group{
    border-bottom:1px solid var(--border-soft);
    padding:14px 0;
  }
  details.group:last-child{ border-bottom:none; }
  details.group > summary{
    cursor:pointer;
    list-style:none;
    display:flex;
    align-items:center;
    justify-content:space-between;
    font-family:var(--mono);
    font-size:11.5px;
    letter-spacing:.06em;
    text-transform:uppercase;
    color:var(--text-primary);
  }
  details.group > summary::-webkit-details-marker{ display:none; }
  details.group > summary::after{
    content:'+';
    color:var(--text-faint);
    font-size:14px;
    transition:transform .15s ease;
  }
  details.group[open] > summary::after{ content:'–'; }
  details.group .group-body{
    padding-top:12px;
    display:flex;
    flex-direction:column;
    gap:12px;
  }

  .field{ display:flex; flex-direction:column; gap:5px; }
  .field-row{
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:8px;
  }
  .field label{
    font-size:11.5px;
    color:var(--text-muted);
  }
  .field .val{
    font-family:var(--mono);
    font-size:11px;
    color:var(--signal);
    min-width:44px;
    text-align:right;
  }

  input[type="range"]{
    -webkit-appearance:none;
    appearance:none;
    width:100%;
    height:4px;
    border-radius:2px;
    background:linear-gradient(90deg, var(--signal) var(--pct,50%), var(--border) var(--pct,50%));
    outline:none;
  }
  input[type="range"]::-webkit-slider-thumb{
    -webkit-appearance:none;
    width:13px;height:13px;border-radius:50%;
    background:var(--signal);
    border:2px solid #0a0f0d;
    box-shadow:0 0 0 1px var(--signal);
    cursor:pointer;
  }
  input[type="range"]::-moz-range-thumb{
    width:13px;height:13px;border-radius:50%;
    background:var(--signal);
    border:2px solid #0a0f0d;
    cursor:pointer;
  }

  input[type="color"]{
    -webkit-appearance:none;
    appearance:none;
    width:36px;height:26px;
    border:1px solid var(--border);
    border-radius:6px;
    background:none;
    padding:0;
    cursor:pointer;
  }
  input[type="color"]::-webkit-color-swatch-wrapper{ padding:2px; }
  input[type="color"]::-webkit-color-swatch{ border-radius:4px; border:none; }

  input[type="number"], input[type="text"]{
    background:var(--panel-alt);
    border:1px solid var(--border);
    color:var(--text-primary);
    font-family:var(--mono);
    font-size:11.5px;
    padding:6px 8px;
    border-radius:6px;
    width:100%;
  }
  input[type="number"]:focus, input[type="text"]:focus, input[type="range"]:focus-visible, input[type="color"]:focus-visible{
    outline:2px solid var(--signal);
    outline-offset:1px;
  }

  .color-row{ display:flex; align-items:center; gap:10px; }
  .color-row input[type="text"]{ width:auto; flex:1; }

  .toggle-row{
    display:flex;
    align-items:center;
    justify-content:space-between;
  }
  .toggle-row label{ font-size:11.5px; color:var(--text-muted); }
  .switch{
    position:relative;
    width:34px; height:19px;
    flex-shrink:0;
  }
  .switch input{ opacity:0; width:0; height:0; position:absolute; }
  .switch .track{
    position:absolute; inset:0;
    background:var(--border);
    border-radius:20px;
    transition:background .15s ease;
    cursor:pointer;
  }
  .switch .track::before{
    content:'';
    position:absolute;
    width:15px;height:15px;
    left:2px; top:2px;
    border-radius:50%;
    background:var(--text-faint);
    transition:transform .15s ease, background .15s ease;
  }
  .switch input:checked + .track{ background:rgba(0,255,98,0.18); }
  .switch input:checked + .track::before{
    transform:translateX(15px);
    background:var(--signal);
  }
  .switch input:focus-visible + .track{ outline:2px solid var(--signal); outline-offset:2px; }

  .hint{
    font-size:10.5px;
    color:var(--text-faint);
    line-height:1.4;
    margin:0;
  }

  .sidebar-foot{
    border-top:1px solid var(--border-soft);
    padding:14px 20px 18px;
    display:flex;
    gap:8px;
    background:var(--panel);
  }
  button{
    font-family:var(--mono);
    font-size:12px;
    letter-spacing:.03em;
    border-radius:8px;
    border:1px solid var(--border);
    padding:10px 14px;
    cursor:pointer;
    transition:transform .1s ease, border-color .15s ease, background .15s ease;
  }
  button:active{ transform:translateY(1px); }
  .btn-reset{
    background:transparent;
    color:var(--text-muted);
    flex:0 0 auto;
  }
  .btn-reset:hover{ border-color:var(--text-faint); color:var(--text-primary); }
  .btn-export{
    background:var(--signal);
    color:#04170b;
    border-color:var(--signal);
    flex:1;
    font-weight:600;
  }
  .btn-export:hover{ background:#33ff81; }
  .btn-export:focus-visible{ outline:2px solid #fff; outline-offset:2px; }

  /* ---------------- Main ---------------- */
  .main{
    flex:1;
    min-width:0;
    padding:28px 32px 60px;
    display:flex;
    flex-direction:column;
    gap:24px;
  }
  .main-head h2{
    margin:0 0 4px;
    font-family:var(--mono);
    font-size:14px;
    color:var(--text-muted);
    font-weight:500;
    letter-spacing:.02em;
  }
  .main-head p{
    margin:0;
    font-size:12.5px;
    color:var(--text-faint);
  }

  .stage-card{
    background:var(--stage-bg);
    border-radius:14px;
    padding:0;
    overflow:hidden;
    border:1px solid #d8ddce;
  }
  .stage-inner{
    padding:36px 24px 28px;
    display:flex;
    flex-direction:column;
    align-items:center;
    max-width:340px;
    margin:0 auto;
  }
  .status-line{
    font-family:var(--mono);
    font-size:10.5px;
    color:#5a6a55;
    margin:0 0 14px;
    display:flex;
    align-items:center;
    gap:6px;
  }
  .status-line .dot{ width:6px;height:6px;border-radius:50%;background:var(--signal-dim); }
  .status-line.live .dot{ background:#1a9b4a; }
  .status-line.sample .dot{ background:#c8a63e; }

  .export-card{
    background:var(--panel);
    border:1px solid var(--border);
    border-radius:14px;
    overflow:hidden;
  }
  .export-head{
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding:14px 18px;
    border-bottom:1px solid var(--border-soft);
    background:var(--panel-alt);
  }
  .export-head .title{
    font-family:var(--mono);
    font-size:11.5px;
    letter-spacing:.06em;
    color:var(--text-muted);
    text-transform:uppercase;
  }
  .copy-btn{
    background:transparent;
    border:1px solid var(--border);
    color:var(--text-primary);
    font-size:11px;
    padding:6px 12px;
  }
  .copy-btn:hover{ border-color:var(--signal); color:var(--signal); }
  .copy-btn.copied{ border-color:var(--signal); color:var(--signal); }

  #exportOutput{
    display:block;
    width:100%;
    min-height:220px;
    max-height:480px;
    resize:vertical;
    background:#0d1316;
    color:#c9d6cf;
    border:none;
    font-family:var(--mono);
    font-size:11.5px;
    line-height:1.6;
    padding:16px 18px;
    white-space:pre;
    overflow:auto;
  }
  #exportOutput:focus{ outline:none; }
  .export-empty{
    padding:28px 18px;
    color:var(--text-faint);
    font-size:12px;
    font-family:var(--mono);
  }

  @media (max-width: 860px){
    .app{ flex-direction:column; }
    .sidebar{ width:100%; height:auto; position:relative; }
    .sidebar-scroll{ max-height:60vh; }
  }
</style>
</head>
<body>

<div class="app">

  <!-- ================= SIDEBAR ================= -->
  <aside class="sidebar">
    <div class="sidebar-head">
      <div class="eyebrow"><span class="dot"></span>GLOBE CONSOLE</div>
      <h1>Parameter Tuning</h1>
      <p>Every control below maps 1:1 to a globe.gl option in your footer's visitor globe. Adjust, watch the stage update, then export.</p>
    </div>

    <div class="sidebar-scroll" id="controlPanel">

      <!-- Container -->
      <details class="group" open>
        <summary>Container</summary>
        <div class="group-body">
          <div class="field">
            <div class="field-row"><label for="globeHeight">Globe box height (px)</label><span class="val" id="globeHeight_val">180</span></div>
            <input type="range" id="globeHeight" min="120" max="320" step="5" value="180">
          </div>
        </div>
      </details>

      <!-- Globe base -->
      <details class="group" open>
        <summary>Globe Base</summary>
        <div class="group-body">
          <div class="toggle-row">
            <label for="bgTransparent">Transparent background</label>
            <label class="switch"><input type="checkbox" id="bgTransparent" checked><span class="track"></span></label>
          </div>
          <div class="field" id="bgColorField" style="display:none;">
            <label for="bgColor">Background color</label>
            <div class="color-row">
              <input type="color" id="bgColor" value="#000000">
              <input type="text" id="bgColor_hex" value="#000000">
            </div>
          </div>
          <div class="field">
            <label for="globeBaseColor">Globe material color</label>
            <div class="color-row">
              <input type="color" id="globeBaseColor" value="#374d23">
              <input type="text" id="globeBaseColor_hex" value="#374d23">
            </div>
          </div>
          <div class="field">
            <div class="field-row"><label for="globeOpacity">Globe material opacity</label><span class="val" id="globeOpacity_val">0.15</span></div>
            <input type="range" id="globeOpacity" min="0" max="1" step="0.01" value="0.15">
          </div>
          <div class="toggle-row">
            <label for="showAtmosphere">Show atmosphere glow</label>
            <label class="switch"><input type="checkbox" id="showAtmosphere"><span class="track"></span></label>
          </div>
        </div>
      </details>

      <!-- Landmass -->
      <details class="group">
        <summary>Landmass (Polygons)</summary>
        <div class="group-body">
          <div class="field">
            <div class="field-row"><label for="polygonAltitude">Polygon altitude</label><span class="val" id="polygonAltitude_val">0.010</span></div>
            <input type="range" id="polygonAltitude" min="0" max="0.1" step="0.001" value="0.01">
          </div>
          <div class="field">
            <label for="polygonCapColor">Cap (landmass) color</label>
            <div class="color-row">
              <input type="color" id="polygonCapColor" value="#374d23">
              <input type="text" id="polygonCapColor_hex" value="#374d23">
            </div>
          </div>
          <div class="toggle-row">
            <label for="polygonSideTransparent">Transparent sides</label>
            <label class="switch"><input type="checkbox" id="polygonSideTransparent" checked><span class="track"></span></label>
          </div>
          <div class="field" id="polygonSideColorField" style="display:none;">
            <label for="polygonSideColor">Side color</label>
            <div class="color-row">
              <input type="color" id="polygonSideColor" value="#000000">
              <input type="text" id="polygonSideColor_hex" value="#000000">
            </div>
          </div>
          <div class="field">
            <label for="polygonStrokeColor">Stroke (border) color</label>
            <div class="color-row">
              <input type="color" id="polygonStrokeColor" value="#8a8a8a">
              <input type="text" id="polygonStrokeColor_hex" value="#8a8a8a">
            </div>
          </div>
        </div>
      </details>

      <!-- Traffic dots -->
      <details class="group">
        <summary>Traffic Dots</summary>
        <div class="group-body">
          <div class="field">
            <div class="field-row"><label for="labelDotRadius">Dot radius</label><span class="val" id="labelDotRadius_val">1.5</span></div>
            <input type="range" id="labelDotRadius" min="0.3" max="6" step="0.1" value="1.5">
          </div>
          <div class="field">
            <label for="labelColor">Dot color</label>
            <div class="color-row">
              <input type="color" id="labelColor" value="#00ff62">
              <input type="text" id="labelColor_hex" value="#00ff62">
            </div>
          </div>
          <div class="field">
            <div class="field-row"><label for="labelAltitude">Dot altitude</label><span class="val" id="labelAltitude_val">0.020</span></div>
            <input type="range" id="labelAltitude" min="0" max="0.1" step="0.001" value="0.02">
          </div>
        </div>
      </details>

      <!-- Tooltip -->
      <details class="group">
        <summary>Hover Tooltip</summary>
        <div class="group-body">
          <div class="field">
            <label for="tooltipBgColor">Background color</label>
            <div class="color-row">
              <input type="color" id="tooltipBgColor" value="#0a0a0a">
              <input type="text" id="tooltipBgColor_hex" value="#0a0a0a">
            </div>
          </div>
          <div class="field">
            <div class="field-row"><label for="tooltipBgOpacity">Background opacity</label><span class="val" id="tooltipBgOpacity_val">0.9</span></div>
            <input type="range" id="tooltipBgOpacity" min="0" max="1" step="0.05" value="0.9">
          </div>
          <div class="field">
            <label for="tooltipBorder">Border color</label>
            <div class="color-row">
              <input type="color" id="tooltipBorder" value="#333333">
              <input type="text" id="tooltipBorder_hex" value="#333333">
            </div>
          </div>
          <div class="field">
            <label for="tooltipTextColor">Text color</label>
            <div class="color-row">
              <input type="color" id="tooltipTextColor" value="#ffffff">
              <input type="text" id="tooltipTextColor_hex" value="#ffffff">
            </div>
          </div>
          <div class="field">
            <div class="field-row"><label for="tooltipFontSize">Font size (px)</label><span class="val" id="tooltipFontSize_val">8</span></div>
            <input type="range" id="tooltipFontSize" min="6" max="14" step="1" value="8">
          </div>
        </div>
      </details>

      <!-- Lighting -->
      <details class="group">
        <summary>Lighting</summary>
        <div class="group-body">
          <div class="field">
            <div class="field-row"><label for="ambientIntensity">Ambient intensity</label><span class="val" id="ambientIntensity_val">6.0</span></div>
            <input type="range" id="ambientIntensity" min="0" max="10" step="0.1" value="6">
          </div>
          <div class="field">
            <div class="field-row"><label for="directionalIntensity">Directional intensity</label><span class="val" id="directionalIntensity_val">0.0</span></div>
            <input type="range" id="directionalIntensity" min="0" max="5" step="0.1" value="0">
          </div>
        </div>
      </details>

      <!-- Camera & controls -->
      <details class="group">
        <summary>Camera &amp; Controls</summary>
        <div class="group-body">
          <div class="field">
            <div class="field-row"><label for="povAltitude">Point-of-view altitude</label><span class="val" id="povAltitude_val">1.7</span></div>
            <input type="range" id="povAltitude" min="0.5" max="4" step="0.05" value="1.7">
          </div>
          <div class="toggle-row">
            <label for="autoRotate">Auto-rotate</label>
            <label class="switch"><input type="checkbox" id="autoRotate" checked><span class="track"></span></label>
          </div>
          <div class="field">
            <div class="field-row"><label for="autoRotateSpeed">Auto-rotate speed</label><span class="val" id="autoRotateSpeed_val">3.0</span></div>
            <input type="range" id="autoRotateSpeed" min="0" max="10" step="0.1" value="3">
          </div>
          <div class="toggle-row">
            <label for="enableZoom">Allow zoom</label>
            <label class="switch"><input type="checkbox" id="enableZoom"><span class="track"></span></label>
          </div>
          <div class="toggle-row">
            <label for="enablePan">Allow pan</label>
            <label class="switch"><input type="checkbox" id="enablePan"><span class="track"></span></label>
          </div>
        </div>
      </details>

      <!-- Interaction -->
      <details class="group">
        <summary>Interaction</summary>
        <div class="group-body">
          <div class="field">
            <div class="field-row"><label for="hoverResumeDelay">Hover-freeze resume (ms)</label><span class="val" id="hoverResumeDelay_val">2000</span></div>
            <input type="range" id="hoverResumeDelay" min="0" max="6000" step="100" value="2000">
          </div>
          <div class="field">
            <label for="clickUrl">Click-through URL</label>
            <input type="text" id="clickUrl" value="https://asifalivk7analytics.duckdns.org/share/x2dNpydLzTqQpfVu">
          </div>
        </div>
      </details>

      <!-- Visitor counter -->
      <details class="group">
        <summary>Visitor Counter</summary>
        <div class="group-body">
          <div class="field">
            <label for="counterTextColor">Text color</label>
            <div class="color-row">
              <input type="color" id="counterTextColor" value="#000000">
              <input type="text" id="counterTextColor_hex" value="#000000">
            </div>
          </div>
          <div class="field">
            <label for="counterBorderColor">Border color</label>
            <div class="color-row">
              <input type="color" id="counterBorderColor" value="#000000">
              <input type="text" id="counterBorderColor_hex" value="#000000">
            </div>
          </div>
          <div class="field">
            <div class="field-row"><label for="counterBorderRadius">Border radius (px)</label><span class="val" id="counterBorderRadius_val">12</span></div>
            <input type="range" id="counterBorderRadius" min="0" max="30" step="1" value="12">
          </div>
          <div class="field">
            <div class="field-row"><label for="counterFontSize">Font size (px)</label><span class="val" id="counterFontSize_val">11</span></div>
            <input type="range" id="counterFontSize" min="8" max="18" step="1" value="11">
          </div>
        </div>
      </details>

      <!-- Data source -->
      <details class="group">
        <summary>Data Source</summary>
        <div class="group-body">
          <div class="toggle-row">
            <label for="useMockData">Force sample telemetry</label>
            <label class="switch"><input type="checkbox" id="useMockData"><span class="track"></span></label>
          </div>
          <p class="hint">Left off, the console first tries <code>globe-data.php</code> in this same folder and only falls back to generated sample points if that fetch fails.</p>
          <button class="btn-reset" id="regenMock" style="width:100%;">Regenerate sample points</button>
        </div>
      </details>

    </div>

    <div class="sidebar-foot">
      <button class="btn-reset" id="resetBtn" title="Reset all parameters to the original footer.php defaults">Reset</button>
      <button class="btn-export" id="exportBtn">Export snippet ▸</button>
    </div>
  </aside>

  <!-- ================= MAIN ================= -->
  <main class="main">
    <div class="main-head">
      <h2>// LIVE PREVIEW</h2>
      <p>This mirrors the "Col 5: Visitor Globe" block from your footer, rendered at its real size against a light background.</p>
    </div>

    <div class="stage-card">
      <div class="stage-inner">
        <p class="status-line" id="statusLine"><span class="dot"></span>Connecting to data source…</p>
        <div id="trafficGlobe" style="width:100%; height:180px; border-radius:8px; overflow:hidden; background:transparent; margin:0 auto; display:flex; justify-content:center; align-items:center; text-align:center;"></div>
        <div id="visitCounter" style="color:#000000; border:1px solid #000000; border-radius:12px; padding:3px 10px; font-size:11px; margin:5px auto 0 auto; font-family:monospace, sans-serif; text-align:center; display:block; width:-moz-fit-content; width:fit-content;">Visitors: ... || Visits: ... </div>
      </div>
    </div>

    <div class="main-head" style="margin-top:4px;">
      <h2>// EXPORT</h2>
      <p>Click "Export snippet" in the sidebar. The block below is a drop-in replacement for the Col 5 div in footer.php.</p>
    </div>

    <div class="export-card">
      <div class="export-head">
        <span class="title">footer.php — Col 5 replacement</span>
        <button class="copy-btn" id="copyBtn">Copy</button>
      </div>
      <div id="exportWrap">
        <div class="export-empty" id="exportEmpty">Nothing exported yet — adjust parameters, then click "Export snippet".</div>
        <textarea id="exportOutput" style="display:none;" readonly spellcheck="false"></textarea>
      </div>
    </div>
  </main>

</div>

<!-- 3D engine (same versions as footer.php) -->
<script src="https://unpkg.com/three@0.160.0/build/three.min.js"></script>
<script src="https://unpkg.com/globe.gl@2.32.2/dist/globe.gl.min.js"></script>

<script>
(function(){

  var DEFAULTS = {
    globeHeight: 180,
    bgTransparent: true,
    bgColor: '#000000',
    globeBaseColor: '#374d23',
    globeOpacity: 0.15,
    showAtmosphere: false,
    polygonAltitude: 0.01,
    polygonCapColor: '#374d23',
    polygonSideTransparent: true,
    polygonSideColor: '#000000',
    polygonStrokeColor: '#8a8a8a',
    labelDotRadius: 1.5,
    labelColor: '#00ff62',
    labelAltitude: 0.02,
    tooltipBgColor: '#0a0a0a',
    tooltipBgOpacity: 0.9,
    tooltipBorder: '#333333',
    tooltipTextColor: '#ffffff',
    tooltipFontSize: 8,
    ambientIntensity: 6,
    directionalIntensity: 0,
    povAltitude: 1.7,
    autoRotate: true,
    autoRotateSpeed: 3,
    enableZoom: false,
    enablePan: false,
    hoverResumeDelay: 2000,
    clickUrl: 'https://asifalivk7analytics.duckdns.org/share/x2dNpydLzTqQpfVu',
    counterTextColor: '#000000',
    counterBorderColor: '#000000',
    counterBorderRadius: 12,
    counterFontSize: 11,
    useMockData: false
  };

  var params = Object.assign({}, DEFAULTS);
  var worldGlobe = null;
  var countriesData = null;
  var trafficData = null;

  var dataScriptDir = <?php echo json_encode($dataScriptDir); ?>;
  var dataUrl = dataScriptDir + '/globe-data.php';

  // ---------- sample telemetry ----------
  var SAMPLE_CITIES = [
    ['New Delhi',28.6,77.2],['Mumbai',19.1,72.9],['Bengaluru',12.97,77.6],
    ['London',51.5,-0.1],['New York',40.7,-74.0],['San Francisco',37.8,-122.4],
    ['Singapore',1.35,103.8],['Tokyo',35.7,139.7],['Sydney',-33.9,151.2],
    ['Berlin',52.5,13.4],['Toronto',43.7,-79.4],['São Paulo',-23.5,-46.6],
    ['Nairobi',-1.3,36.8],['Dubai',25.2,55.3],['Seoul',37.6,127.0],
    ['Amsterdam',52.4,4.9],['Paris',48.9,2.3],['Cape Town',-33.9,18.4]
  ];
  function generateMockData(){
    var globe = SAMPLE_CITIES.map(function(c){
      return { lat: c[1], lng: c[2], label: c[0], weight: 5 + Math.floor(Math.random()*95) };
    });
    var totalVisits = globe.reduce(function(a,b){ return a + b.weight; }, 0);
    return {
      total_visitors: Math.round(totalVisits * (0.5 + Math.random()*0.3)),
      total_visits: totalVisits,
      globe: globe
    };
  }

  function setStatus(mode, text){
    var el = document.getElementById('statusLine');
    el.className = 'status-line ' + mode;
    el.innerHTML = '<span class="dot"></span>' + text;
  }

  // ---------- data + geojson bootstrap ----------
  function loadCountries(){
    return fetch('https://raw.githubusercontent.com/vasturiano/globe.gl/master/example/datasets/ne_110m_admin_0_countries.geojson')
      .then(function(res){ return res.json(); });
  }

  function loadTraffic(){
    if (params.useMockData) {
      return Promise.resolve(generateMockData());
    }
    return fetch(dataUrl)
      .then(function(res){
        if (!res.ok) { throw new Error('HTTP ' + res.status); }
        return res.json();
      })
      .then(function(data){
        if (data.error) { throw new Error(data.error); }
        setStatus('live', 'Live data from globe-data.php');
        return data;
      })
      .catch(function(err){
        setStatus('sample', 'Live fetch failed (' + err.message + ') — showing sample telemetry');
        return generateMockData();
      });
  }

  function updateVisitCounter(data){
    document.getElementById('visitCounter').innerHTML =
      '<strong>Visitors:</strong> ' + (data.total_visitors || 0).toLocaleString() +
      ' <strong>||</strong> <strong>Visits:</strong> ' + (data.total_visits || 0).toLocaleString();
  }

  function buildGlobe(){
    var container = document.getElementById('trafficGlobe');
    container.innerHTML = '';
    var gWidth = container.clientWidth || 260;
    var gHeight = params.globeHeight;

    worldGlobe = Globe()
      (container)
      .width(gWidth)
      .height(gHeight)
      .showGlobe(true)
      .polygonsData(countriesData.features)
      .labelsData(trafficData.globe || [])
      .labelLat(function(d){ return d.lat; })
      .labelLng(function(d){ return d.lng; })
      .labelText(function(){ return ''; })
      .labelLabel(function(d){
        return '<div style="background:' + hexToRgba(params.tooltipBgColor, params.tooltipBgOpacity) +
          '; padding:4px 8px; border-radius:4px; border:1px solid ' + params.tooltipBorder +
          '; color:' + params.tooltipTextColor + '; font-family:monospace, sans-serif; font-size:' + params.tooltipFontSize + 'px;">' +
          '<strong></strong> ' + d.label + '<strong>:</strong> ' + d.weight + '</div>';
      })
      .onGlobeClick(function(){ window.open(params.clickUrl, '_blank'); })
      .onPolygonClick(function(){ window.open(params.clickUrl, '_blank'); })
      .onLabelClick(function(){ window.open(params.clickUrl, '_blank'); })
      .onLabelHover(function(label){
        if (label) {
          worldGlobe.controls().autoRotateSpeed = 0;
          if (window.globeHoverTimeout) clearTimeout(window.globeHoverTimeout);
        } else {
          if (window.globeHoverTimeout) clearTimeout(window.globeHoverTimeout);
          window.globeHoverTimeout = setTimeout(function(){
            worldGlobe.controls().autoRotateSpeed = params.autoRotateSpeed;
          }, params.hoverResumeDelay);
        }
      });

    applyParams();
  }

  function hexToRgba(hex, opacity){
    hex = hex.replace('#','');
    if (hex.length === 3) { hex = hex.split('').map(function(c){ return c+c; }).join(''); }
    var r = parseInt(hex.substring(0,2),16);
    var g = parseInt(hex.substring(2,4),16);
    var b = parseInt(hex.substring(4,6),16);
    return 'rgba(' + r + ',' + g + ',' + b + ',' + opacity + ')';
  }

  function applyParams(){
    if (!worldGlobe) return;

    var container = document.getElementById('trafficGlobe');
    container.style.height = params.globeHeight + 'px';

    worldGlobe
      .height(params.globeHeight)
      .backgroundColor(params.bgTransparent ? 'rgba(0,0,0,0)' : params.bgColor)
      .showAtmosphere(params.showAtmosphere)
      .polygonAltitude(params.polygonAltitude)
      .polygonCapColor(function(){ return params.polygonCapColor; })
      .polygonSideColor(function(){ return params.polygonSideTransparent ? 'transparent' : params.polygonSideColor; })
      .polygonStrokeColor(function(){ return params.polygonStrokeColor; })
      .labelDotRadius(params.labelDotRadius)
      .labelColor(function(){ return params.labelColor; })
      .labelAltitude(params.labelAltitude);

    var globeMat = worldGlobe.globeMaterial();
    globeMat.color.set(params.globeBaseColor);
    globeMat.transparent = true;
    globeMat.opacity = params.globeOpacity;

    var scene = worldGlobe.scene();
    scene.children.forEach(function(c){
      if (c.type === 'AmbientLight') c.intensity = params.ambientIntensity;
      if (c.type === 'DirectionalLight') c.intensity = params.directionalIntensity;
    });

    worldGlobe.controls().autoRotate = params.autoRotate;
    worldGlobe.controls().autoRotateSpeed = params.autoRotateSpeed;
    worldGlobe.controls().enableZoom = params.enableZoom;
    worldGlobe.controls().enablePan = params.enablePan;
    worldGlobe.pointOfView({ altitude: params.povAltitude });

    var vc = document.getElementById('visitCounter');
    vc.style.color = params.counterTextColor;
    vc.style.borderColor = params.counterBorderColor;
    vc.style.borderRadius = params.counterBorderRadius + 'px';
    vc.style.fontSize = params.counterFontSize + 'px';
  }

  function init(){
    setStatus('', 'Connecting to data source…');
    Promise.all([loadCountries(), loadTraffic()]).then(function(results){
      countriesData = results[0];
      trafficData = results[1];
      updateVisitCounter(trafficData);
      buildGlobe();
    }).catch(function(err){
      document.getElementById('trafficGlobe').innerHTML =
        '<p style="color:#c0392b; font-size:11px; padding:0 10px;">Error: ' + err.message + '</p>';
    });
  }

  function reloadTrafficOnly(){
    loadTraffic().then(function(data){
      trafficData = data;
      updateVisitCounter(data);
      if (worldGlobe) {
        worldGlobe.labelsData(trafficData.globe || []);
      }
    });
  }

  // ---------- control binding ----------
  function syncPct(rangeEl){
    var min = parseFloat(rangeEl.min), max = parseFloat(rangeEl.max), val = parseFloat(rangeEl.value);
    var pct = ((val - min) / (max - min)) * 100;
    rangeEl.style.setProperty('--pct', pct + '%');
  }

  var bindings = [
    ['globeHeight','range','number'],
    ['bgTransparent','checkbox'],
    ['bgColor','color'],
    ['globeBaseColor','color'],
    ['globeOpacity','range','number',2],
    ['showAtmosphere','checkbox'],
    ['polygonAltitude','range','number',3],
    ['polygonCapColor','color'],
    ['polygonSideTransparent','checkbox'],
    ['polygonSideColor','color'],
    ['polygonStrokeColor','color'],
    ['labelDotRadius','range','number',1],
    ['labelColor','color'],
    ['labelAltitude','range','number',3],
    ['tooltipBgColor','color'],
    ['tooltipBgOpacity','range','number',2],
    ['tooltipBorder','color'],
    ['tooltipTextColor','color'],
    ['tooltipFontSize','range','number'],
    ['ambientIntensity','range','number',1],
    ['directionalIntensity','range','number',1],
    ['povAltitude','range','number',2],
    ['autoRotate','checkbox'],
    ['autoRotateSpeed','range','number',1],
    ['enableZoom','checkbox'],
    ['enablePan','checkbox'],
    ['hoverResumeDelay','range','number'],
    ['clickUrl','text'],
    ['counterTextColor','color'],
    ['counterBorderColor','color'],
    ['counterBorderRadius','range','number'],
    ['counterFontSize','range','number'],
    ['useMockData','checkbox']
  ];

  function refreshDependentVisibility(){
    document.getElementById('bgColorField').style.display = params.bgTransparent ? 'none' : 'flex';
    document.getElementById('polygonSideColorField').style.display = params.polygonSideTransparent ? 'none' : 'flex';
  }

  function wireControls(){
    bindings.forEach(function(b){
      var id = b[0], type = b[1];
      var el = document.getElementById(id);
      if (!el) return;

      if (type === 'range') {
        var decimals = b[3] || 0;
        var valEl = document.getElementById(id + '_val');
        syncPct(el);
        el.addEventListener('input', function(){
          syncPct(el);
          var num = parseFloat(el.value);
          params[id] = num;
          if (valEl) valEl.textContent = decimals ? num.toFixed(decimals) : String(num);
          applyParams();
        });
      } else if (type === 'checkbox') {
        el.addEventListener('change', function(){
          params[id] = el.checked;
          refreshDependentVisibility();
          if (id === 'useMockData') { reloadTrafficOnly(); return; }
          applyParams();
        });
      } else if (type === 'color') {
        var hexEl = document.getElementById(id + '_hex');
        el.addEventListener('input', function(){
          params[id] = el.value;
          if (hexEl) hexEl.value = el.value;
          applyParams();
        });
        if (hexEl) {
          hexEl.addEventListener('change', function(){
            var v = hexEl.value.trim();
            if (/^#([0-9a-fA-F]{3}|[0-9a-fA-F]{6})$/.test(v)) {
              params[id] = v;
              el.value = v.length === 4
                ? '#' + v[1]+v[1]+v[2]+v[2]+v[3]+v[3]
                : v;
              applyParams();
            }
          });
        }
      } else if (type === 'text') {
        el.addEventListener('change', function(){
          params[id] = el.value.trim();
          applyParams();
        });
      }
    });
    refreshDependentVisibility();
  }

  function resetAll(){
    params = Object.assign({}, DEFAULTS);
    bindings.forEach(function(b){
      var id = b[0], type = b[1];
      var el = document.getElementById(id);
      if (!el) return;
      if (type === 'checkbox') {
        el.checked = params[id];
      } else {
        el.value = params[id];
        if (type === 'range') {
          syncPct(el);
          var valEl = document.getElementById(id + '_val');
          var decimals = b[3] || 0;
          if (valEl) valEl.textContent = decimals ? Number(params[id]).toFixed(decimals) : String(params[id]);
        }
        if (type === 'color') {
          var hexEl = document.getElementById(id + '_hex');
          if (hexEl) hexEl.value = params[id];
        }
      }
    });
    refreshDependentVisibility();
    applyParams();
  }

  // ---------- export ----------
  function buildExportCode(){
    var lines = [];
    var counterRadius = params.counterBorderRadius;
    var counterFont = params.counterFontSize;

    lines.push('<!-- Col 5: Visitor Globe -->');
    lines.push('<div class="col-lg-2 col-md-6 d-flex align-items-center justify-content-center flex-column p-0">');
    lines.push('  <div class="footer-map-section w-100 p-0">');
    lines.push('    <!-- Load 3D Engine Dependencies with explicit versions and UMD paths -->');
    lines.push('    <script src="https://unpkg.com/three@0.160.0/build/three.min.js"><\/script>');
    lines.push('    <script src="https://unpkg.com/globe.gl@2.32.2/dist/globe.gl.min.js"><\/script>');
    lines.push('');
    lines.push('    <!-- The visual placeholder frame for the footer -->');
    lines.push('    <div id="trafficGlobe" style="width: 100%; height: ' + params.globeHeight + 'px; border-radius: 8px; overflow: hidden; background: transparent; margin: 0 auto; display: flex; justify-content: center; align-items: center; text-align: center;"></div>');
    lines.push('    <!-- Counter block directly under the globe -->');
    lines.push('    <div id="visitCounter" style="color: ' + params.counterTextColor + '; border: 1px solid ' + params.counterBorderColor + '; border-radius: ' + counterRadius + 'px; padding: 3px 10px; font-size: ' + counterFont + 'px; margin: 5px auto 0 auto; font-family: monospace, sans-serif; text-align: center; display: block; width: -moz-fit-content; width: fit-content;">Visitors: ... || Visits: ... </div>');
    lines.push('');
    lines.push('    <script>');
    lines.push('      // Ensure absolute path from the current directory');
    lines.push('      const dataUrl = \'<' + '?php echo rtrim(dirname($_SERVER["SCRIPT_NAME"]), "/\\\\"); ?' + '>/globe-data.php\';');
    lines.push('');
    lines.push('      Promise.all([');
    lines.push('        fetch(dataUrl).then(async res => {');
    lines.push('          if (!res.ok) throw new Error(`HTTP ${res.status}: ${await res.text()}`);');
    lines.push('          return res.json();');
    lines.push('        }),');
    lines.push('        // Fetch GeoJSON for drawing the countries (landmass)');
    lines.push('        fetch(\'https://raw.githubusercontent.com/vasturiano/globe.gl/master/example/datasets/ne_110m_admin_0_countries.geojson\')');
    lines.push('          .then(res => res.json())');
    lines.push('      ])');
    lines.push('      .then(([data, countries]) => {');
    lines.push('        if(data.error) {');
    lines.push('          throw new Error("API Error: " + data.error);');
    lines.push('        }');
    lines.push('');
    lines.push('        if (typeof Globe === \'undefined\') {');
    lines.push('          throw new Error("The globe.gl library failed to load (possibly blocked by an extension or network issue).");');
    lines.push('        }');
    lines.push('');
    lines.push('        document.getElementById(\'visitCounter\').innerHTML = `<strong>Visitors:</strong> ${(data.total_visitors || 0).toLocaleString()} <strong>||</strong> <strong>Visits:</strong> ${(data.total_visits || 0).toLocaleString()}`;');
    lines.push('');
    lines.push('        const container = document.getElementById(\'trafficGlobe\');');
    lines.push('        const gWidth = container.clientWidth || 200;');
    lines.push('        const gHeight = container.clientHeight || ' + params.globeHeight + ';');
    lines.push('');
    lines.push('        const worldGlobe = Globe()');
    lines.push('          (container)');
    lines.push('          .width(gWidth)');
    lines.push('          .height(gHeight)');
    lines.push('          .backgroundColor(' + (params.bgTransparent ? "'rgba(0,0,0,0)'" : "'" + params.bgColor + "'") + ')');
    lines.push('          .showGlobe(true)');
    lines.push('          .showAtmosphere(' + params.showAtmosphere + ')');
    lines.push('          .polygonsData(countries.features)');
    lines.push('          .polygonAltitude(' + params.polygonAltitude + ')');
    lines.push('          .polygonCapColor(() => \'' + params.polygonCapColor + '\')');
    lines.push('          .polygonSideColor(() => \'' + (params.polygonSideTransparent ? 'transparent' : params.polygonSideColor) + '\')');
    lines.push('          .polygonStrokeColor(() => \'' + params.polygonStrokeColor + '\')');
    lines.push('          .labelsData(data.globe || [])');
    lines.push('          .labelLat(d => d.lat)');
    lines.push('          .labelLng(d => d.lng)');
    lines.push('          .labelDotRadius(' + params.labelDotRadius + ')');
    lines.push('          .labelColor(() => \'' + params.labelColor + '\')');
    lines.push('          .labelText(() => \'\')');
    lines.push('          .labelAltitude(' + params.labelAltitude + ')');
    lines.push('          .labelLabel(d => `');
    lines.push('            <div style="background: ' + hexToRgba(params.tooltipBgColor, params.tooltipBgOpacity) + '; padding: 4px 8px; border-radius: 4px; border: 1px solid ' + params.tooltipBorder + '; color: ' + params.tooltipTextColor + '; font-family: monospace, sans-serif; font-size: ' + params.tooltipFontSize + 'px;">');
    lines.push('              <strong></strong> ${d.label}<strong>:</strong> ${d.weight}');
    lines.push('            </div>');
    lines.push('          `)');
    lines.push('          .onGlobeClick(() => window.open(\'' + params.clickUrl + '\', \'_blank\'))');
    lines.push('          .onPolygonClick(() => window.open(\'' + params.clickUrl + '\', \'_blank\'))');
    lines.push('          .onLabelClick(() => window.open(\'' + params.clickUrl + '\', \'_blank\'))');
    lines.push('          .onLabelHover(label => {');
    lines.push('            if (label) {');
    lines.push('              worldGlobe.controls().autoRotateSpeed = 0; // Instantly freeze when hovered');
    lines.push('              if (window.globeHoverTimeout) clearTimeout(window.globeHoverTimeout);');
    lines.push('            } else {');
    lines.push('              // When mouse leaves, wait before resuming rotation');
    lines.push('              if (window.globeHoverTimeout) clearTimeout(window.globeHoverTimeout);');
    lines.push('              window.globeHoverTimeout = setTimeout(() => {');
    lines.push('                worldGlobe.controls().autoRotateSpeed = ' + params.autoRotateSpeed + ';');
    lines.push('              }, ' + params.hoverResumeDelay + ');');
    lines.push('            }');
    lines.push('          });');
    lines.push('');
    lines.push('        // Set faint color via globeMaterial for the base');
    lines.push('        const globeMat = worldGlobe.globeMaterial();');
    lines.push('        globeMat.color.set(\'' + params.globeBaseColor + '\');');
    lines.push('        globeMat.transparent = true;');
    lines.push('        globeMat.opacity = ' + params.globeOpacity + ';');
    lines.push('');
    lines.push('        // Apply flat lighting to remove shadows');
    lines.push('        const scene = worldGlobe.scene();');
    lines.push('        scene.children.forEach(c => {');
    lines.push('          if (c.type === \'AmbientLight\') c.intensity = ' + params.ambientIntensity + ';');
    lines.push('          if (c.type === \'DirectionalLight\') c.intensity = ' + params.directionalIntensity + ';');
    lines.push('        });');
    lines.push('');
    lines.push('        worldGlobe.controls().autoRotate = ' + params.autoRotate + ';');
    lines.push('        worldGlobe.controls().autoRotateSpeed = ' + params.autoRotateSpeed + ';');
    lines.push('        worldGlobe.controls().enableZoom = ' + params.enableZoom + ';');
    lines.push('        worldGlobe.controls().enablePan = ' + params.enablePan + ';');
    lines.push('        worldGlobe.pointOfView({ altitude: ' + params.povAltitude + ' });');
    lines.push('      })');
    lines.push('      .catch(err => {');
    lines.push('        console.error(\'Globe Error:\', err);');
    lines.push('        document.getElementById(\'trafficGlobe\').innerHTML = `<p style="color:#ff6b6b; font-size: 11px; word-break: break-all;">Error: ${err.message}</p>`;');
    lines.push('      });');
    lines.push('    <\/script>');
    lines.push('  </div>');
    lines.push('</div>');

    return lines.join('\n');
  }

  function doExport(){
    var code = buildExportCode();
    var ta = document.getElementById('exportOutput');
    var empty = document.getElementById('exportEmpty');
    ta.value = code;
    ta.style.display = 'block';
    empty.style.display = 'none';
    ta.scrollIntoView({ behavior: 'smooth', block: 'center' });
  }

  function doCopy(){
    var ta = document.getElementById('exportOutput');
    if (!ta.value) { doExport(); }
    var text = document.getElementById('exportOutput').value;
    var btn = document.getElementById('copyBtn');
    function flash(){
      btn.textContent = 'Copied ✓';
      btn.classList.add('copied');
      setTimeout(function(){ btn.textContent = 'Copy'; btn.classList.remove('copied'); }, 1600);
    }
    if (navigator.clipboard && navigator.clipboard.writeText) {
      navigator.clipboard.writeText(text).then(flash).catch(function(){ fallbackCopy(ta, flash); });
    } else {
      fallbackCopy(ta, flash);
    }
  }
  function fallbackCopy(ta, cb){
    ta.style.display = 'block';
    ta.focus();
    ta.select();
    try { document.execCommand('copy'); cb(); } catch(e){}
  }

  document.getElementById('exportBtn').addEventListener('click', doExport);
  document.getElementById('copyBtn').addEventListener('click', doCopy);
  document.getElementById('resetBtn').addEventListener('click', resetAll);
  document.getElementById('regenMock').addEventListener('click', function(){
    if (!params.useMockData) {
      params.useMockData = true;
      document.getElementById('useMockData').checked = true;
    }
    reloadTrafficOnly();
  });

  wireControls();
  init();

})();
</script>

</body>
</html>
