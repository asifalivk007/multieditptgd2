<?php

$active_page = "tool";

$extra_scripts = '
  <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
        const spacerInputs = document.querySelectorAll(".spacer-input");
        spacerInputs.forEach(input => {
            input.addEventListener("focus", function() { this.parentElement.style.transform = "translateX(6px)"; });
            input.addEventListener("blur",  function() { this.parentElement.style.transform = "translateX(0)"; });
        });
    });
  </script>
  <script src="assets/js/ptg-designer.js?v=5.11"></script>
  <script src="assets/js/ptg-export.js?v=5.3"></script>
  <script src="assets/js/ptg-app.js?v=5.0"></script>
';

include 'header.php';
?>

<main class="main">
<!-- ======================================================
         Page Hero
    ====================================================== -->
    <section class="page-hero">
        <div class="container">
            <h1>PTG Assembly Designer</h1>
            <p>Design polycistronic tRNA-gRNA assemblies for CRISPR multiplex editing</p>
        </div>
    </section>

    <!-- ======================================================
         Tool Section
    ====================================================== -->
    <section class="tool-section section">
        <div class="container">
            <div class="row g-4 align-items-start">

                <!-- ---- LEFT: Instructions Card ---- -->
                <div class="col-lg-5 order-lg-1">
                    <div class="info-card h-100">
                        <h4>
                            <i class="fas fa-info-circle"></i>
                            How to Use
                        </h4>
                        <ol>
                            <li>Select the number of spacers for your assembly (2–12 spacers)</li>
                            <li>Choose the appropriate gRNA scaffold type for your plant system</li>
                            <li>Select the Terminal enzyme - used for first &amp; last module only (<em>FokI</em> is default, and supports 11 others)</li>
                            <li>Select the Golden Gate enzyme - joins all internal modules (<em>BsaI</em> is default, and supports 11 others)</li>
                            <li>Configure the Cas9 Plasmid Vector Overhang (default or custom 4-bp)</li>
                            <li>Enter your 20 bp spacer sequences (only A, T, G, C bases allowed)</li>
                            <li>Click <strong>Generate Assembly</strong> to compute primer and module designs</li>
                            <li>View the full results report on the results page</li>
                        </ol>

                        <!-- Tip Box -->
                        <div class="info-tip-box">
                            <i class="fas fa-lightbulb"></i>
                            <strong>Tip:</strong> Use the <em>Load Example</em> button to see sample sequences and explore a pre-filled assembly design.
                        </div>

                        <!-- Key Features -->
                        <ul class="feature-list mt-4">
                            <li>
                                <i class="fas fa-check-circle"></i>
                                Automated primer design for all modules
                            </li>
                            <li>
                                <i class="fas fa-check-circle"></i>
                                Enzymatic Golden Gate cloning with 12 IIs
                            </li>
                            <li>
                                <i class="fas fa-check-circle"></i>
                                Supports monocot &amp; dicot plant systems
                            </li>
                            <li>
                                <i class="fas fa-check-circle"></i>
                                Excel / CSV export ready results
                            </li>
                        </ul>
                    </div><!-- /info-card -->
                </div><!-- /col-lg-5 -->

                <!-- ---- RIGHT: Tool Configuration Card ---- -->
                <div class="col-lg-7 order-lg-2">
                    <div class="tool-card">
                        <h4>
                            <i class="fas fa-cog"></i>
                            Assembly Configuration
                        </h4>

                        <!-- Spacer Count -->
                        <div class="mb-3">
                            <label for="spacerType" class="form-label">
                                <i class="fas fa-dna" style="color:var(--accent-color);margin-right:5px;"></i>
                                Spacer Count:
                            </label>
                            <select id="spacerType" class="form-select">
                                <option value="2">2x Spacers</option>
                                <option value="3">3x Spacers</option>
                                <option value="4">4x Spacers</option>
                                <option value="5">5x Spacers</option>
                                <option value="6">6x Spacers</option>
                                <option value="7">7x Spacers</option>
                                <option value="8">8x Spacers</option>
                                <option value="9">9x Spacers</option>
                                <option value="10">10x Spacers</option>
                                <option value="11">11x Spacers</option>
                                <option value="12">12x Spacers</option>
                            </select>
                        </div>

                        <!-- gRNA Scaffold -->
                        <div class="mb-3">
                            <label for="scaffoldType" class="form-label">
                                <i class="fas fa-dna" style="color:var(--accent-color);margin-right:5px;"></i>
                                gRNA Scaffold:
                            </label>
                            <select id="scaffoldType" class="form-select">
                                <!-- Populated by ptg-designer.js -->
                            </select>
                        </div>

                        <!-- Enzyme Row -->
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="terminalEnzyme" class="form-label">
                                    <i class="fas fa-cut" style="color:var(--accent-color);margin-right:5px;"></i>
                                    Terminal Enzyme:
                                </label>
                                <select id="terminalEnzyme" class="form-select">
                                    <!-- Populated by ptg-designer.js -->
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="ggEnzyme" class="form-label">
                                    <i class="fas fa-cut" style="color:var(--accent-color);margin-right:5px;"></i>
                                    Golden Gate Enzyme:
                                </label>
                                <select id="ggEnzyme" class="form-select">
                                    <!-- Populated by ptg-designer.js -->
                                </select>
                            </div>
                        </div>

                        <!-- Cas9 Plasmid Vector Overhang -->
                        <div class="mb-3">
                            <label for="vectorOverhang" class="form-label">
                                <i class="fas fa-link" style="color:var(--accent-color);margin-right:5px;"></i>
                                Cas9 Plasmid Vector Overhang:
                            </label>
                            <select id="vectorOverhang" class="form-select">
                                <option value="default">Default (ATTG / AAAC)</option>
                                <option value="custom">Custom (User Defined)</option>
                            </select>
                        </div>
                        
                        <!-- Custom Overhang Inputs (Hidden by Default) -->
                        <div id="customOverhangContainer" class="row g-3 mb-3" style="display: none;">
                            <div class="col-md-6">
                                <label for="customF1Overhang" class="form-label">Forward Overhang:</label>
                                <input type="text" id="customF1Overhang" class="form-control" maxlength="4" placeholder="NNNN" style="font-family: monospace; background: #e2e8f0;">
                            </div>
                            <div class="col-md-6">
                                <label for="customRFinalOverhang" class="form-label">Reverse Overhang:</label>
                                <input type="text" id="customRFinalOverhang" class="form-control" maxlength="4" placeholder="NNNN" style="font-family: monospace; background: #e2e8f0;">
                            </div>
                        </div>

                        <!-- Spacer Inputs (initial 2; ptg-designer.js manages dynamic count) -->
                        <div class="spacer-inputs mt-3" id="spacerInputs">
                            <div class="spacer-group mb-3">
                                <label for="spacer1" class="form-label">
                                    <i class="fas fa-flask" style="color:var(--accent-color);margin-right:5px;"></i>
                                    Guide RNA Spacer 1:
                                </label>
                                <input type="text"
                                       id="spacer1"
                                       class="form-control spacer-input"
                                       maxlength="20"
                                       placeholder="Enter 20 bp sequence (A, T, G, C only)"
                                       title="Enter exactly 20 base pairs using only A, T, G, C">
                            </div>
                            <div class="spacer-group mb-3">
                                <label for="spacer2" class="form-label">
                                    <i class="fas fa-flask" style="color:var(--accent-color);margin-right:5px;"></i>
                                    Guide RNA Spacer 2:
                                </label>
                                <input type="text"
                                       id="spacer2"
                                       class="form-control spacer-input"
                                       maxlength="20"
                                       placeholder="Enter 20 bp sequence (A, T, G, C only)"
                                       title="Enter exactly 20 base pairs using only A, T, G, C">
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex gap-2 flex-wrap mt-4">
                            <button id="calculateBtn" class="btn-tool-primary">
                                <i class="fas fa-play-circle"></i>
                                Generate Assembly
                            </button>
                            <button id="clearBtn" class="btn-tool-secondary">
                                <i class="fas fa-trash"></i>
                                Clear
                            </button>
                            <button id="exampleBtn" class="btn-tool-info">
                                <i class="fas fa-lightbulb"></i>
                                Load Example
                            </button>
                        </div>

                    </div><!-- /tool-card -->

                </div><!-- /col-lg-7 -->

            </div><!-- /row -->
        </div><!-- /container -->
    </section>

    <!-- ======================================================
         Footer
    ====================================================== -->
</main>

<?php include 'footer.php'; ?>
