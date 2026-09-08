<?php

$active_page = "docs";

include 'header.php';
?>

<main class="main">
<!-- ═══════════════ MAIN ═══════════════ -->
    <main>

        <!-- PAGE HERO -->
        <section class="page-hero">
            <div class="container">
                <div data-aos="fade-up" data-aos-duration="600">
                    <h1><i class="bi bi-book-half me-2"></i>Documentation</h1>
                    <p>Complete User Guide for MultiEdit PTG Designer 2.0</p>
                </div>
            </div>
        </section>

        <!-- DOCS SECTION -->
        <section class="section">
            <div class="container">
                <div class="row g-4">

                    <!-- ── LEFT SIDEBAR ── -->
                    <div class="col-lg-3">
                        <div class="docs-sidebar sticky-top">
                            <div class="bg-white border rounded-3 overflow-hidden shadow-sm">
                                <div class="sidebar-heading">  <b>Contents</b></div>
                                <ul class="list-group list-group-flush" id="docNav">
                                    <li class="list-group-item list-group-item-action">
                                        <a href="#overview" class="text-decoration-none d-flex align-items-center stretched-link" style="color:inherit;">
                                            <i class="bi bi-info-circle me-2"></i> Platform Overview
                                        </a>
                                    </li>
                                    <li class="list-group-item list-group-item-action">
                                        <a href="#methodology" class="text-decoration-none d-flex align-items-center stretched-link" style="color:inherit;">
                                            <i class="bi bi-gear me-2"></i> Technical Methodology
                                        </a>
                                    </li>
                                    <li class="list-group-item list-group-item-action">
                                        <a href="#requirements" class="text-decoration-none d-flex align-items-center stretched-link" style="color:inherit;">
                                            <i class="bi bi-check-circle me-2"></i> Input Requirements
                                        </a>
                                    </li>
                                    <li class="list-group-item list-group-item-action">
                                        <a href="#outputs" class="text-decoration-none d-flex align-items-center stretched-link" style="color:inherit;">
                                            <i class="bi bi-file-earmark-text me-2"></i> Output Specifications
                                        </a>
                                    </li>
                                    <li class="list-group-item list-group-item-action">
                                        <a href="#validation" class="text-decoration-none d-flex align-items-center stretched-link" style="color:inherit;">
                                            <i class="bi bi-award me-2"></i> Development &amp; Validation
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- ── RIGHT CONTENT ── -->
                    <div class="col-lg-9">

                        <!-- Card 1: Platform Overview -->
                        <div class="doc-card" id="overview" data-aos="fade-up" data-aos-duration="600">
                            <h4><i class="bi bi-info-circle"></i>Platform Overview</h4>
                            <p>
                                MultiEdit PTG Designer 2.0 utilizes a polycistronic tRNA-gRNA (PTG)-based multiplex editing system, where the PTG assembly is efficiently and precisely processed into individual guide RNAs (gRNAs) that direct Cas9 to edit multiple chromosomal targets simultaneously. The platform automates the computational design steps that underpin the entire PTG workflow — from spacer input to final assembly sequence — dramatically reducing hands-on design time and minimizing the risk of manual errors.
                            </p>
                            <p>
                                The tool automates the design of gRNA spacer-specific primers carrying 4-bp overlaps for Golden Gate (GG) assembly. Each tRNA-gRNA (TG) module is constructed from a plasmid template that encodes a 77 bp tRNA processing signal followed by either a 76 bp native or an 86 bp engineered gRNA scaffold sequence. Following PCR amplification and digestion with the chosen Type IIS restriction enzyme (out of 12 available options), the resulting 4-bp overhangs direct all modules to ligate in the correct orientation, producing a complete and seamless PTG construct without any extraneous nucleotides. Terminal parts of the PTG assembly carry restriction sites that enable direct cloning of the finished PTG construct into a Cas9 editor plasmid via compatible cohesive ends. Users can choose between standard default vector overhangs (ATTG / AAAC) or specify custom 4-bp forward and reverse overhang sequences to ensure seamless integration into any destination Cas9 plasmid vector.
                            </p>
                        </div>

                        <!-- Card 2: Technical Methodology -->
                        <div class="doc-card" id="methodology" data-aos="fade-up" data-aos-duration="600" data-aos-delay="50">
                            <h4><i class="bi bi-gear"></i>Technical Methodology</h4>

                            <h5>Assembly Process</h5>
                            <ul>
                                <li><strong>Golden Gate Assembly:</strong> Provides flexibility in choosing from 12 commonly used Type IIS restriction enzymes to generate compatible 4-bp overhangs. This drives ordered, directional ligation of all TG modules in a single reaction.</li>
                                <li><strong>Primer Design:</strong> Forward primers anchor the first 12 nucleotides of the 20 bp spacer sequence, while reverse primers anchor the last 12 nucleotides, each extended with 4-bp overlapping tails that define the ligation junctions.</li>
                                <li><strong>Module Construction:</strong> Each individual module is PCR-amplified from the selected template plasmid using spacer-specific primers, yielding a discrete tRNA-gRNA amplicon that is then digested with the chosen restriction enzyme to expose its directional overhangs.</li>
                                <li><strong>Internal Recognition Site Identification:</strong> The software automatically identifies and flags any internal restriction enzyme recognition sites within the final assembly. This critical feature helps users make better decisions when selecting the appropriate Golden Gate Enzyme or Terminal Enzyme for the workflow, avoiding unwanted internal cleavage of the final assembly.</li>
                            </ul>

                            <h5 class="mt-4">Available Restriction Enzymes</h5>
                            <div class="table-responsive mb-4">
                                <table class="table table-bordered table-hover align-middle table-custom-striped">
                                    <thead class="table-light text-center">
                                        <tr>
                                            <th>Enzyme</th>
                                            <th>Reaction Temperature</th>
                                            <th>Activity at 37 &deg;C</th>
                                            <th>Recognition Sequence</th>
                                            <th>Recognition Length</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr><td>BsaI</td><td>37&deg;C</td><td>100%</td><td>GGTCTC(1/5)</td><td>6</td></tr>
                                        <tr><td>BbsI</td><td>37&deg;C</td><td>100%</td><td>GAAGAC(2/6)</td><td>6</td></tr>
                                        <tr><td>Esp3I</td><td>37&deg;C</td><td>100%</td><td>CGTCTC(1/5)</td><td>6</td></tr>
                                        <tr><td>BsmBI</td><td>55&deg;C</td><td>10%</td><td>CGTCTC(1/5)</td><td>6</td></tr>
                                        <tr><td>BtgZI</td><td>60&deg;C</td><td>50%</td><td>GCGATG(10/14)</td><td>6</td></tr>
                                        <tr><td>BspMI</td><td>37&deg;C</td><td>100%</td><td>ACCTGC(4/8)</td><td>6</td></tr>
                                        <tr><td>FokI</td><td>37&deg;C</td><td>100%</td><td>GGATG(9/13)</td><td>5</td></tr>
                                        <tr><td>PaqCI</td><td>37&deg;C</td><td>100%</td><td>CACCTGC(4/8)</td><td>7</td></tr>
                                        <tr><td>SfaNI</td><td>37&deg;C</td><td>100%</td><td>GCATC(5/9)</td><td>5</td></tr>
                                        <tr><td>BbvI</td><td>37&deg;C</td><td>100%</td><td>GCAGC(8/12)</td><td>5</td></tr>
                                        <tr><td>BfuAI</td><td>50&deg;C</td><td>50%</td><td>ACCTGC(4/8)</td><td>6</td></tr>
                                        <tr><td>BsmFI</td><td>65&deg;C</td><td>100%</td><td>GGGAC(10/14)</td><td>5</td></tr>
                                    </tbody>
                                </table>
                            </div>

                            <h5>Template Sequences</h5>
                            <ul>
                                <li><strong>Two Types of Templates:</strong> The platform supports two template options for module amplification: the Native Scaffold System and the Engineered Scaffold System.</li>
                                <li><strong>Native Scaffold System:</strong> Utilizes a 76 nt native gRNA scaffold. The complete template is 153 nt (76 nt Scaffold + 77 nt tRNA).</li>
                                <li><strong>Engineered Scaffold System:</strong> Utilizes an 86 nt engineered gRNA scaffold featuring an extended tetra-loop hairpin stem (for increased stability of the sgRNA:Cas9 complex) and removal of a premature transcription sequence. The complete template is 163 nt (86 nt Scaffold + 77 nt tRNA).</li>
                                <li><strong>tRNA (77 nt):</strong> A plant-endogenous tRNA-derived processing signal that is recognized and cleaved by endogenous RNase P and RNase Z, liberating individual gRNAs from the polycistronic transcript with high precision.</li>
                                <li><strong>Compatibility:</strong> Template sequences and assembly architecture have been validated for deployment in both monocot (e.g., rice) and dicot (e.g., <em>Arabidopsis</em>, tomato) plant systems.</li>
                            </ul>
                        </div>

                        <!-- Card 3: Input Requirements -->
                        <div class="doc-card" id="requirements" data-aos="fade-up" data-aos-duration="600" data-aos-delay="100">
                            <h4><i class="bi bi-check-circle"></i>Input Requirements</h4>

                            <h5>Sequence Rules</h5>
                            <ul>
                                <li><strong>Spacer length:</strong> Each gRNA spacer must be exactly <strong>20 base pairs</strong> in length — no more, no less.</li>
                                <li><strong>Maximum spacers:</strong> The platform supports a robust <strong>12x max spacer capacity</strong>, allowing you to combine up to 12 spacer sequences in a single PTG assembly for highly multiplexed editing.</li>
                                <li><strong>Allowed characters:</strong> Only standard DNA nucleotides are accepted — <strong>A, T, G, C</strong> (upper or lower case); ambiguity codes, gaps, or RNA characters will be rejected.</li>
                                <li><strong>Automatic validation:</strong> The tool performs real-time sequence validation, highlights invalid entries, and scans for internal restriction sites to guide your enzyme selection.</li>
                            </ul>

                            <h5>Recommended Workflow</h5>
                            <ol>
                                <li>Verify that each spacer sequence targets the intended genomic locus by BLAST or a genome-specific tool before entering sequences into the designer.</li>
                                <li>Check for potential off-target sites using dedicated CRISPR off-target prediction resources (e.g., CRISPOR, Cas-OFFinder) to select high-specificity spacers.</li>
                                <li>Generate all primer sequences and review them for secondary structures, GC content (&gt;40 %), and any unintended restriction sites prior to synthesis.</li>
                                <li>Export the complete results (primers, module sequences, final PTG assembly) for laboratory records, ordering, and team collaboration.</li>
                            </ol>
                        </div>

                        <!-- Card 4: Output Specifications -->
                        <div class="doc-card" id="outputs" data-aos="fade-up" data-aos-duration="600" data-aos-delay="150">
                            <h4><i class="bi bi-file-earmark-text"></i>Output Specifications</h4>
                            <p>MultiEdit PTG Designer 2.0 produces four categories of output for every design run, each ready for direct laboratory use or downstream bioinformatic analysis:</p>
                            <div class="table-responsive mt-3">
                                <table class="table table-bordered table-hover align-middle table-custom-striped">
                                    <thead>
                                        <tr>
                                            <th style="width:22%;">Output</th>
                                            <th>Description</th>
                                            <th style="width:20%;">Format</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><strong>Primer Sequences</strong></td>
                                            <td>Forward and reverse primer pair for each TG module, incorporating the spacer-anchoring region and the 4-bp GG overlap tail. Presented in 5′ → 3′ orientation, ready for direct synthesis submission.</td>
                                            <td>Text (plain / CSV)</td>
                                        </tr>
                                        <tr>
                                            <td><strong>PCR Products</strong></td>
                                            <td>Predicted amplicon sequences for each module generated by PCR from the common template plasmid using the designed primers. Useful for in-silico verification of amplicon size and sequence composition.</td>
                                            <td>Sequence (FASTA)</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Enzyme Digests</strong></td>
                                            <td>Post-digestion fragment sequences for each module, showing the exposed 4-bp cohesive overhangs that drive ordered Golden Gate ligation.</td>
                                            <td>Sequence (annotated)</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Final Assembly</strong></td>
                                            <td>Complete PTG construct sequence representing the fully ligated polycistronic tRNA-gRNA array. Includes total length in nucleotides and can be used directly to verify the cloning product after sequencing.</td>
                                            <td>Sequence + Length (bp)</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Card 5: Development & Validation -->
                        <div class="doc-card" id="validation" data-aos="fade-up" data-aos-duration="600" data-aos-delay="200">
                            <h4><i class="bi bi-award"></i>Development &amp; Validation</h4>
                            <p>
                                MultiEdit PTG Designer 2.0 was developed by researchers at the ICAR-Indian Agricultural Research Institute (ICAR-IARI) and the ICAR-Indian Agricultural Statistics Research Institute (ICAR-IASRI). The underlying methodology is grounded in established molecular biology protocols for polycistronic CRISPR-Cas9 multiplexing, extended and refined through iterative in-house experimental validation to ensure the computational outputs translate reliably to functional laboratory constructs.
                            </p>
                            <p>
                                The tool is designed for both fundamental research and practical applied applications in plant genome editing, providing researchers with a rapid, reproducible path to efficient multiplex CRISPR-Cas9 experiments across a wide range of plant species. Ongoing development efforts are focused on expanding compatibility with additional Cas effectors, broadening the template library for additional plant systems, and adding integrated off-target assessment features.
                            </p>
                            <div class="alert alert-success d-flex align-items-start gap-3 mt-3" role="alert">
                                <i class="bi bi-check-circle-fill fs-4 mt-1 flex-shrink-0"></i>
                                <div>
                                    <strong>Experimentally Verified:</strong> Wet lab validated for seamless assembly of multiple PTG modules in both monocot and dicot plants. Assembly fidelity was confirmed by Sanger sequencing of the final PTG constructs prior to plant transformation.
                                </div>
                            </div>
                        </div>

                    </div><!-- /col-lg-9 -->
                </div><!-- /row -->
            </div><!-- /container -->
        </section>
</main>

<?php include 'footer.php'; ?>
