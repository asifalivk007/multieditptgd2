<?php

$active_page = "home";

include 'header.php';
?>

<main class="main">
<!-- HERO SECTION -->
    <section class="hero section light-background">

      <!-- Background image -->
      <img src="assets/images/design_figure.jpg" alt="PTG Design Figure" class="hero-bg" data-aos="fade-in">
      <div class="hero-overlay"></div>

      <div class="container">

        <!-- Welcome Box -->
        <div class="welcome-box" data-aos="fade-up" data-aos-delay="100">
          <h2>MultiEdit PTG Designer 2.0</h2>
          <p>Polycistronic tRNA-gRNA Assembly Platform for CRISPR Multiplex Gene Editing</p>
          <div class="badge-row">
            <span class="badge badge-icar"><i class="bi bi-award me-1"></i>Max 12x Spacers</span>
            <span class="badge badge-wet"><i class="bi bi-scissors me-1"></i>12 Different IIs Restriction Sites</span>
            <span class="badge badge-recognition"><i class="bi bi-search me-1"></i>Internal Recognition Site Flagging</span>
            <span class="badge badge-open"><i class="bi bi-unlock me-1"></i>Wet Lab Validated</span>
          </div>
        </div>

        <!-- Icon Boxes -->
        <div class="icon-boxes">
          <div class="row g-4">

            <div class="col-12 col-md-6 col-lg-4" data-aos="zoom-out" data-aos-delay="200">
              <div class="icon-box">
                <i class="bi bi-stack-overflow"></i>
                <h3>Golden Gate Assembly</h3>
                <p>BsaI &amp; FokI-based precision module (default, and 11 others) joining for seamless PTG construct design</p>
              </div>
            </div>

            <div class="col-12 col-md-6 col-lg-4" data-aos="zoom-out" data-aos-delay="350">
              <div class="icon-box">
                <i class="bi bi-diagram-3"></i>
                <h3>PTG Multiplexing</h3>
                <p>Design up to 12 simultaneous gene targets within a single polycistronic cassette</p>
              </div>
            </div>

            <div class="col-12 col-md-6 col-lg-4" data-aos="zoom-out" data-aos-delay="500">
              <div class="icon-box">
                <i class="bi bi-file-earmark-arrow-down"></i>
                <h3>Export Ready</h3>
                <p>Complete primers, modules &amp; assembly sequences ready for immediate synthesis</p>
              </div>
            </div>

          </div>
        </div>

      </div>
    </section><!-- /HERO SECTION -->

    <!-- ABOUT SECTION -->
    <section id="about" class="about section">
      <div class="container">
        
        <!-- About Content (Top) -->
        <div class="row justify-content-center mb-5">
          <div class="col-lg-10" data-aos="fade-up" data-aos-delay="100">
            <div class="about-content text-center">
              <h3 class="mb-4">About the Platform</h3>
              <p class="mb-5 text-justify">
                MultiEdit PTG Designer 2.0 is a web-based bioinformatics tool developed at ICAR-IASRI in collaboration with ICAR-IARI for the automated
                design of Polycistronic tRNA-gRNA (PTG) constructs used in CRISPR-Cas9 multiplex gene editing. The
                platform streamlines the process of designing multiple spacer sequences, generating module-specific
                primers, and assembling complete PTG cassettes using the Golden Gate cloning strategy — enabling
                researchers to target up to 12 genes simultaneously in a single construct.
              </p>

              <ul class="feature-list text-start d-inline-block w-100 mb-4">
                <li>
                  <div class="icon-wrap">
                    <i class="fa-solid fa-dna"></i>
                  </div>
                  <div class="text">
                    <h4>Golden Gate Assembly Design</h4>
                    <p>BsaI- and FokI-based precision module joining with automatically generated overhangs and primers for seamless ligation-independent cloning.</p>
                  </div>
                </li>
                <li>
                  <div class="icon-wrap">
                    <i class="fa-solid fa-microscope"></i>
                  </div>
                  <div class="text">
                    <h4>Wet Lab Validated</h4>
                    <p>All design rules and template sequences have been experimentally validated through bench-top CRISPR editing experiments, ensuring high construct fidelity.</p>
                  </div>
                </li>
                <li>
                  <div class="icon-wrap">
                    <i class="fa-solid fa-seedling"></i>
                  </div>
                  <div class="text">
                    <h4>Plant Compatible</h4>
                    <p>Optimised for both monocot (rice, wheat, maize) and dicot (tomato, soybean) plant species using established Arabidopsis tRNA spacer architecture.</p>
                  </div>
                </li>
              </ul>

              <div class="mt-4">
                <a href="tool.php" class="btn-accent"><i class="bi bi-play-circle me-1"></i>Launch Tool</a>
                <a href="documentation.php" class="btn-outline-accent"><i class="bi bi-book me-1"></i>Documentation</a>
              </div>
            </div>
          </div>
        </div>

        <!-- Figures (Bottom) -->
        <div class="row justify-content-center">
          
          <!-- First Image -->
          <div class="col-lg-12 text-center mb-5" data-aos="fade-up" data-aos-delay="200">
            <div class="d-inline-block text-center mx-auto" style="max-width: 100%;">
              <figure class="about-img position-relative zoomable-img-container rounded-3 overflow-hidden shadow-sm m-0" data-bs-toggle="modal" data-bs-target="#imageZoomModal" style="cursor: pointer;">
                <img src="assets/images/design_figure.jpg" alt="PTG System Design" class="img-fluid" style="width: auto;">
                <div class="zoom-overlay d-flex justify-content-center align-items-center position-absolute top-0 start-0 w-100 h-100">
                  <i class="bi bi-zoom-in text-white" style="font-size: 3rem;"></i>
                </div>
              </figure>
              <figcaption class="mt-2 text-muted text-justify" style="font-size: 0.95rem; width: 0; min-width: 100%; line-height: 1.6; white-space: normal;">
                <strong>Construction of tandemly arrayed polycistronic tRNA-gRNA (PTG) cassettes and their assembly is schematically depicted.</strong> This multiplex editing system utilizes the endogenous tRNA processing system. For PTG assembly construction, gRNA spacer-specific primers (reverse and forward primers anchor last and first 12 nucleotides of the 20 bp spacer, respectively) were designed with 4-bp overlap for Golden Gate (GG) assembly. Each module was PCR-amplified (from a plasmid template that contains plant tRNA sequence followed by 76 bp native or 86 bp engineered gRNA scaffold sequence) and BsaI-digested in order to create 4-bp overhangs that ligate all the modules together in correct orientation for producing the complete gRNA (spacer + scaffold) without any extra nucleotides. This software provides flexibility in choosing N number of spacers and 12 commonly used typeIIs restriction enzymes that provide recognition sequences for 4-bp overhang.
              </figcaption>
            </div>
          </div>

          <!-- Second Image -->
          <div class="col-lg-12 text-center" data-aos="fade-up" data-aos-delay="300">
            <div class="d-inline-block text-center mx-auto" style="max-width: 100%;">
              <figure class="about-img position-relative zoomable-img-container rounded-3 overflow-hidden shadow-sm m-0" data-bs-toggle="modal" data-bs-target="#imageZoomModal2" style="cursor: pointer;">
                <img src="assets/images/figure_2.jpg" alt="Secondary structure comparison" class="img-fluid" style="width: auto;">
                <div class="zoom-overlay d-flex justify-content-center align-items-center position-absolute top-0 start-0 w-100 h-100">
                  <i class="bi bi-zoom-in text-white" style="font-size: 3rem;"></i>
                </div>
              </figure>
              <figcaption class="mt-2 text-muted text-justify" style="font-size: 0.95rem; width: 0; min-width: 100%; line-height: 1.6; white-space: normal;">
                <strong>Secondary structure comparison of commonly used (referred as native) versus engineered sgRNA scaffold.</strong> Extending the stem of tetra-loop hairpin (by incorporating 10 nucleotides) provides increased stability of sgRNA: Cas9 complex. Removing the premature transcription sequence (by substituting A/T residue to C/G residue in the tetra loop poly-A stretch) reinforced the stable complex between Cas9 and sgRNA.
              </figcaption>
            </div>
          </div>
        </div>

      </div>
    </section><!-- /ABOUT SECTION -->

    <!-- STATS SECTION -->
    <section class="stats section light-background">
      <div class="container">
        <div class="row g-4 justify-content-center">

        </div>
      </div>
    </section><!-- /STATS SECTION -->

    <!-- SEQUENCES SECTION -->
    <section class="section light-background">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Template Sequences</h2>
          <p>Core nucleotide sequences used in PTG assembly</p>
        </div>

        <h4 class="mb-3 text-center" style="color: var(--heading-color);">Engineered Scaffold System (Scaffold 2)</h4>
        <div class="row g-4 mb-5">
          <!-- Card 1: Complete Template -->
          <div class="col-lg-12" data-aos="fade-up" data-aos-delay="100">
            <div class="seq-card">
              <div class="seq-card-header">
                <i class="bi bi-dna"></i>
                <h5>Complete Template (163 nt): 86 nt Scaffold + 77 nt tRNA</h5>
              </div>
              <div class="seq-body">
                <span class="seq-prefix">agcaatgcttttttataatgccaactttgtacaaaaaagcaggctccgcggccgcccccttcacc</span><span class="seq-grna">GTTTCAGAGCTATGCTGGAAACAGCATAGCAAGTTGAAATAAGGCTAGTCCGTTATCAACTTGAAAAAGTGGCACCGAGTCGGTGC</span><span class="seq-trna">AACAAAGCACCAGTGGTCTAGTGGTAGAATAGTACCCTGCCACGGTACAGACCCGGGTTCGATTCCCGGCTGGTGCA</span><span class="seq-suffix">tggcagaagggtgggcgcgccgacccagctttcttgtacaaagttggcattataagaaagcattgcttatcaatttgttgca</span>
              </div>
            </div>
          </div>

          <!-- Card 2: gRNA Scaffold -->
          <div class="col-12 col-lg-6" data-aos="fade-up" data-aos-delay="200">
            <div class="seq-card">
              <div class="seq-card-header">
                <i class="bi bi-scissors"></i>
                <h5>gRNA Scaffold 2 (86 nt)</h5>
              </div>
              <div class="seq-body">
                <span class="seq-plain">GTTTCAGAGCTATGCTGGAAACAGCATAGCAAGTTGAAATAAGGCTAGTCCGTTATCAACTTGAAAAAGTGGCACCGAGTCGGTGC</span>
              </div>
            </div>
          </div>

          <!-- Card 3: tRNA Sequence -->
          <div class="col-12 col-lg-6" data-aos="fade-up" data-aos-delay="300">
            <div class="seq-card">
              <div class="seq-card-header">
                <i class="bi bi-link"></i>
                <h5>tRNA Sequence (77 nt)</h5>
              </div>
              <div class="seq-body">
                <span class="seq-trna">AACAAAGCACCAGTGGTCTAGTGGTAGAATAGTACCCTGCCACGGTACAGACCCGGGTTCGATTCCCGGCTGGTGCA</span>
              </div>
            </div>
          </div>
        </div>

        <h4 class="mb-3 mt-5 text-center" style="color: var(--heading-color);">Native Scaffold System (Scaffold 1)</h4>
        <div class="row g-4">
          <!-- Card 1: Complete Template -->
          <div class="col-lg-12" data-aos="fade-up" data-aos-delay="100">
            <div class="seq-card">
              <div class="seq-card-header">
                <i class="bi bi-dna"></i>
                <h5>Complete Template (153 nt): 76 nt Scaffold + 77 nt tRNA</h5>
              </div>
              <div class="seq-body">
                <span class="seq-prefix">agcaatgcttttttataatgccaactttgtacaaaaaagcaggctccgcggccgcccccttcacc</span><span class="seq-grna">GTTTTAGAGCTAGAAATAGCAAGTTAAAATAAGGCTAGTCCGTTATCAACTTGAAAAAGTGGCACCGAGTCGGTGC</span><span class="seq-trna">AACAAAGCACCAGTGGTCTAGTGGTAGAATAGTACCCTGCCACGGTACAGACCCGGGTTCGATTCCCGGCTGGTGCA</span><span class="seq-suffix">tggcagaagggtgggcgcgccgacccagctttcttgtacaaagttggcattataagaaagcattgcttatcaatttgttgca</span>
              </div>
            </div>
          </div>

          <!-- Card 2: gRNA Scaffold -->
          <div class="col-12 col-lg-6" data-aos="fade-up" data-aos-delay="200">
            <div class="seq-card">
              <div class="seq-card-header">
                <i class="bi bi-scissors"></i>
                <h5>gRNA Scaffold 1 (76 nt)</h5>
              </div>
              <div class="seq-body">
                <span class="seq-plain">GTTTTAGAGCTAGAAATAGCAAGTTAAAATAAGGCTAGTCCGTTATCAACTTGAAAAAGTGGCACCGAGTCGGTGC</span>
              </div>
            </div>
          </div>

          <!-- Card 3: tRNA Sequence -->
          <div class="col-12 col-lg-6" data-aos="fade-up" data-aos-delay="300">
            <div class="seq-card">
              <div class="seq-card-header">
                <i class="bi bi-link"></i>
                <h5>tRNA Sequence (77 nt)</h5>
              </div>
              <div class="seq-body">
                <span class="seq-trna">AACAAAGCACCAGTGGTCTAGTGGTAGAATAGTACCCTGCCACGGTACAGACCCGGGTTCGATTCCCGGCTGGTGCA</span>
              </div>
            </div>
          </div>

        </div>
      </div>
    </section><!-- /SEQUENCES SECTION -->

    <!-- Image Zoom Modal 1 -->
    <div class="modal fade" id="imageZoomModal" tabindex="-1" aria-labelledby="imageZoomModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content bg-transparent border-0 d-flex flex-column align-items-center">
          <div class="modal-header border-0 pb-3 justify-content-center w-100 position-relative z-3">
            <button type="button" class="btn rounded-pill px-4 py-2 shadow zoom-close-btn" data-bs-dismiss="modal" style="font-weight: 500;">
              <i class="bi bi-x-lg me-1"></i> Close
            </button>
          </div>
          <div class="modal-body text-center position-relative w-100 bg-white rounded shadow-lg p-4">
            <img src="assets/images/design_figure.jpg" alt="PTG System Design Fullscreen" class="img-fluid rounded mb-3" style="max-height: 70vh; width: auto;">
            <p class="text-justify text-dark mb-0 mx-auto" style="font-size: 0.95rem; max-width: 1000px; line-height: 1.6;">
              <strong>Construction of tandemly arrayed polycistronic tRNA-gRNA (PTG) cassettes and their assembly is schematically depicted.</strong> This multiplex editing system utilizes the endogenous tRNA processing system. For PTG assembly construction, gRNA spacer-specific primers (reverse and forward primers anchor last and first 12 nucleotides of the 20 bp spacer, respectively) were designed with 4-bp overlap for Golden Gate (GG) assembly. Each module was PCR-amplified (from a plasmid template that contains plant tRNA sequence followed by 76 bp native or 86 bp engineered gRNA scaffold sequence) and BsaI-digested in order to create 4-bp overhangs that ligate all the modules together in correct orientation for producing the complete gRNA (spacer + scaffold) without any extra nucleotides. This software provides flexibility in choosing N number of spacers and 12 commonly used typeIIs restriction enzymes that provide recognition sequences for 4-bp overhang.
            </p>
          </div>
        </div>
      </div>
    </div>

    <!-- Image Zoom Modal 2 -->
    <div class="modal fade" id="imageZoomModal2" tabindex="-1" aria-labelledby="imageZoomModalLabel2" aria-hidden="true">
      <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content bg-transparent border-0 d-flex flex-column align-items-center">
          <div class="modal-header border-0 pb-3 justify-content-center w-100 position-relative z-3">
            <button type="button" class="btn rounded-pill px-4 py-2 shadow zoom-close-btn" data-bs-dismiss="modal" style="font-weight: 500;">
              <i class="bi bi-x-lg me-1"></i> Close
            </button>
          </div>
          <div class="modal-body text-center position-relative w-100 bg-white rounded shadow-lg p-4">
            <img src="assets/images/figure_2.jpg" alt="Secondary structure comparison Fullscreen" class="img-fluid rounded mb-3" style="max-height: 70vh; width: auto;">
            <p class="text-justify text-dark mb-0 mx-auto" style="font-size: 0.95rem; max-width: 1000px; line-height: 1.6;">
              <strong>Secondary structure comparison of commonly used (referred as native) versus engineered sgRNA scaffold.</strong> Extending the stem of tetra-loop hairpin (by incorporating 10 nucleotides) provides increased stability of sgRNA: Cas9 complex. Removing the premature transcription sequence (by substituting A/T residue to C/G residue in the tetra loop poly-A stretch) reinforced the stable complex between Cas9 and sgRNA.
            </p>
          </div>
        </div>
      </div>
    </div>
</main>

<?php include 'footer.php'; ?>
