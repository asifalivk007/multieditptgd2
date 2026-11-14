/**
 * DYNAMICALLY CORRECTED pGT Designer Tool 
 * This implementation calculates sequences for ANY input spacers based on exact text file methodology
 */

class PTGDesigner {
    constructor() {
        this.initializeSequenceLibrary();
        this.initializeEventListeners();
        this.populateDesignOptions();
        this.updateSpacerInputs();
    }

    initializeSequenceLibrary() {
        this.sequences = {
            // Core sequences from text files
            tRNA_core: "AACAAAGCACCAGTGGTCTAGTGGTAGAATAGTACCCTGCCACGGTACAGACCCGGGTTCGATTCCCGGCTGGTGCA",
            gRNA_core: "GTTTCAGAGCTATGCTGGAAACAGCATAGCAAGTTGAAATAAGGCTAGTCCGTTATCAACTTGAAAAAGTGGCACCGAGTCGGTGC",
            scaffold: "GTTTAAGAGCTATGCTGGAAAC",
            tRNA_tail: "TGCACCAGCCGGG",
            tRNA_f1: "AACAAAGCACCAGTGGTC",
            polyA: "AAAAAAAAAA",
            
            // GG_Cut sequences for each configuration (from CSV analysis)
            ggCuts: {
                2: {"F1": "ATTG", "R1": "ATGA", "F2": "TCAT", "R2": "TCGA", "F3": "TCGA", "R3": "AAAC"},
                3: {"F1": "ATTG", "R1": "ATGA", "F2": "TCAT", "R2": "TCGA", "F3": "TCGA", "R3": "AAAT", "F4": "ATTT", "R4": "AAAC"},
                4: {"F1": "ATTG", "R1": "ATGA", "F2": "TCAT", "R2": "TCGA", "F3": "TCGA", "R3": "AAAT", "F4": "ATTT", "R4": "TTCA", "F5": "TGAA", "R5": "AAAC"},
                5: {"F1": "ATTG", "R1": "ATGA", "F2": "TCAT", "R2": "TCGA", "F3": "TCGA", "R3": "AAAT", "F4": "ATTT", "R4": "TTCA", "F5": "TGAA", "R5": "CTAA", "F6": "TTAG", "R6": "AAAC"},
                6: {"F1": "ATTG", "R1": "ATGA", "F2": "TCAT", "R2": "TCGA", "F3": "TCGA", "R3": "AAAT", "F4": "ATTT", "R4": "TTCA", "F5": "TGAA", "R5": "CTAA", "F6": "TTAG", "R6": "GTCA", "F7": "TGAC", "R7": "AAAC"},
                7: {"F1": "ATTG", "R1": "ATGA", "F2": "TCAT", "R2": "TCGA", "F3": "TCGA", "R3": "AAAT", "F4": "ATTT", "R4": "TTCA", "F5": "TGAA", "R5": "CTAA", "F6": "TTAG", "R6": "GTCA", "F7": "TGAC", "R7": "AGGA", "F8": "TCCT", "R8": "AAAC"},
                8: {"F1": "ATTG", "R1": "ATGA", "F2": "TCAT", "R2": "TCGA", "F3": "TCGA", "R3": "AAAT", "F4": "ATTT", "R4": "TTCA", "F5": "TGAA", "R5": "CTAA", "F6": "TTAG", "R6": "GTCA", "F7": "TGAC", "R7": "AGGA", "F8": "TCCT", "R8": "ACCA", "F9": "TGGT", "R9": "AAAC"},
                9: {"F1": "ATTG", "R1": "ATGA", "F2": "TCAT", "R2": "TCGA", "F3": "TCGA", "R3": "AAAT", "F4": "ATTT", "R4": "TTCA", "F5": "TGAA", "R5": "CTAA", "F6": "TTAG", "R6": "GTCA", "F7": "TGAC", "R7": "AGGA", "F8": "TCCT", "R8": "ACCA", "F9": "TGGT", "R9": "GTGA", "F10": "TCAC", "R10": "AAAC"},
                10: {"F1": "ATTG", "R1": "ATGA", "F2": "TCAT", "R2": "TCGA", "F3": "TCGA", "R3": "AAAT", "F4": "ATTT", "R4": "TTCA", "F5": "TGAA", "R5": "CTAA", "F6": "TTAG", "R6": "GTCA", "F7": "TGAC", "R7": "AGGA", "F8": "TCCT", "R8": "ACCA", "F9": "TGGT", "R9": "GTGA", "F10": "TCAC", "R10": "CAGA", "F11": "TCTG", "R11": "AAAC"},
                11: {"F1": "ATTG", "R1": "ATGA", "F2": "TCAT", "R2": "TCGA", "F3": "TCGA", "R3": "AAAT", "F4": "ATTT", "R4": "TTCA", "F5": "TGAA", "R5": "CTAA", "F6": "TTAG", "R6": "GTCA", "F7": "TGAC", "R7": "AGGA", "F8": "TCCT", "R8": "ACCA", "F9": "TGGT", "R9": "GTGA", "F10": "TCAC", "R10": "CAGA", "F11": "TCTG", "R11": "GACA", "F12": "TGTC", "R12": "AAAC"},
                12: {"F1": "ATTG", "R1": "ATGA", "F2": "TCAT", "R2": "TCGA", "F3": "TCGA", "R3": "AAAT", "F4": "ATTT", "R4": "TTCA", "F5": "TGAA", "R5": "CTAA", "F6": "TTAG", "R6": "GTCA", "F7": "TGAC", "R7": "AGGA", "F8": "TCCT", "R8": "ACCA", "F9": "TGGT", "R9": "GTGA", "F10": "TCAC", "R10": "CAGA", "F11": "TCTG", "R11": "GACA", "F12": "TGTC", "R12": "CTGA", "F13": "TCAG", "R13": "AAAC"}
            }
        };

        // Scaffold options — verbatim from "Different scaffolds.docx".
        // `anchorLength` = how many 5' nt of the scaffold the forward primer uses as its 3' annealing region.
        this.SCAFFOLDS = {
            scaffold2: {
                label: "Scaffold 2 — engineered (86 nt)",
                length: 86,
                sequence: "GTTTCAGAGCTATGCTGGAAACAGCATAGCAAGTTGAAATAAGGCTAGTCCGTTATCAACTTGAAAAAGTGGCACCGAGTCGGTGC",
                anchorLength: 22
            },
            scaffold1: {
                label: "Scaffold 1 — native (76 nt)",
                length: 76,
                sequence: "GTTTTAGAGCTAGAAATAGCAAGTTAAAATAAGGCTAGTCCGTTATCAACTTGAAAAAGTGGCACCGAGTCGGTGC",
                anchorLength: 22
            }
        };

        // Type IIS restriction enzymes — verbatim from "Different restriction enzymes.docx".
        // cutTop / cutBottom = the (a/b) offsets downstream of the recognition site; every enzyme
        // leaves a 4-nt overhang (b - a = 4) and the buffer length equals the top-strand offset (a).
                this.ENZYMES = {
            BsaI:   { recognition: "GGTCTC",  cutTop: 1,  cutBottom: 5,  bufferTEFw: "C", bufferTERv: "C", bufferGGFw: "C", bufferGGRv: "A", temp: "37°C", activity37: "100%" },
            BbsI:   { recognition: "GAAGAC",  cutTop: 2,  cutBottom: 6,  bufferTEFw: "GA", bufferTERv: "GA", bufferGGFw: "GA", bufferGGRv: "GA", temp: "37°C", activity37: "100%" },
            Esp3I:  { recognition: "CGTCTC",  cutTop: 1,  cutBottom: 5,  bufferTEFw: "C", bufferTERv: "C", bufferGGFw: "C", bufferGGRv: "C", temp: "37°C", activity37: "100%" },
            BsmBI:  { recognition: "CGTCTC",  cutTop: 1,  cutBottom: 5,  bufferTEFw: "C", bufferTERv: "C", bufferGGFw: "C", bufferGGRv: "C", temp: "55°C", activity37: "10%"  },
            BtgZI:  { recognition: "GCGATG",  cutTop: 10, cutBottom: 14, bufferTEFw: "GATCATGCAG", bufferTERv: "GATCATGCAG", bufferGGFw: "GATCATGCAG", bufferGGRv: "GATCATGCAG", temp: "60°C", activity37: "50%"  },
            BspMI:  { recognition: "ACCTGC",  cutTop: 4,  cutBottom: 8,  bufferTEFw: "GATC", bufferTERv: "GATC", bufferGGFw: "GATC", bufferGGRv: "GATC", temp: "37°C", activity37: "100%" },
            FokI:   { recognition: "GGATG",   cutTop: 9,  cutBottom: 13, bufferTEFw: "GGCAGTCTG", bufferTERv: "AGCGACAGC", bufferGGFw: "GATCATGCA", bufferGGRv: "GATCATGCA", temp: "37°C", activity37: "100%" },
            PaqCI:  { recognition: "CACCTGC", cutTop: 4,  cutBottom: 8,  bufferTEFw: "GATC", bufferTERv: "GATC", bufferGGFw: "GATC", bufferGGRv: "GATC", temp: "37°C", activity37: "100%" },
            SfaNI:  { recognition: "GCATC",   cutTop: 5,  cutBottom: 9,  bufferTEFw: "GATCA", bufferTERv: "GATCA", bufferGGFw: "GATCA", bufferGGRv: "GATCA", temp: "37°C", activity37: "100%" },
            BbvI:   { recognition: "GCAGC",   cutTop: 8,  cutBottom: 12, bufferTEFw: "GATCATGC", bufferTERv: "GATCATGC", bufferGGFw: "GATCATGC", bufferGGRv: "GATCATGC", temp: "37°C", activity37: "100%" },
            BfuAI:  { recognition: "ACCTGC",  cutTop: 4,  cutBottom: 8,  bufferTEFw: "GATC", bufferTERv: "GATC", bufferGGFw: "GATC", bufferGGRv: "GATC", temp: "50°C", activity37: "50%"  },
            BsmFI:  { recognition: "GGGAC",   cutTop: 10, cutBottom: 14, bufferTEFw: "GATCATGCAG", bufferTERv: "GATCATGCAG", bufferGGFw: "GATCATGCAG", bufferGGRv: "GATCATGCAG", temp: "65°C", activity37: "100%" }
        };
    }

    // Populate the scaffold / GG-enzyme / terminal-enzyme dropdowns from the data tables.
    // Defaults (Scaffold 2, BsaI, FokI) reproduce the current validated design.
    populateDesignOptions() {
        const scaffoldSel = document.getElementById('scaffoldType');
        if (scaffoldSel) {
            scaffoldSel.innerHTML = Object.entries(this.SCAFFOLDS)
                .map(([key, s]) => `<option value="${key}"${key === 'scaffold2' ? ' selected' : ''}>${s.label}</option>`)
                .join('');
        }

        const enzymeOptions = (defaultName) => Object.entries(this.ENZYMES)
            .map(([name, e]) => `<option value="${name}"${name === defaultName ? ' selected' : ''}>${name} — ${e.recognition} (${e.cutTop}/${e.cutBottom})</option>`)
            .join('');

        const ggSel = document.getElementById('ggEnzyme');
        if (ggSel) ggSel.innerHTML = enzymeOptions('BsaI');

        const terminalSel = document.getElementById('terminalEnzyme');
        if (terminalSel) terminalSel.innerHTML = enzymeOptions('FokI');
    }

    reverseComplement(sequence) {
        let reversed = "";
        for (let i = sequence.length - 1; i >= 0; i--) {
            reversed += sequence.charAt(i);
        }
        
        const complement = { 'A': 'T', 'T': 'A', 'G': 'C', 'C': 'G' };
        return reversed.split('').map(base => complement[base] || base).join('');
    }

    generateF1Primer(spacerType) {
        const filler1 = "CG";
        const recognition = (this.selectedTermEnzyme || this.ENZYMES["FokI"]).recognition;
        const filler2 = (this.selectedTermEnzyme || this.ENZYMES["FokI"]).bufferTEFw;
        
        let cut = this.sequences.ggCuts[spacerType]["F1"];
        const overhangSelect = document.getElementById('vectorOverhang');
        if (overhangSelect && overhangSelect.value === 'custom') {
            const customF1El = document.getElementById('customF1Overhang');
            if (customF1El && customF1El.value.trim().length > 0) {
                let customVal = customF1El.value.toUpperCase().replace(/[^ATGCN]/g, '');
                cut = customVal.padEnd(4, 'N');
            } else {
                cut = "NNNN";
            }
        }
        
        const primer5 = filler1 + recognition + filler2 + cut;
        const primer3 = this.sequences.tRNA_f1;
        
        return {
            name: "Fw1",
            type: `Forward (${document.getElementById('terminalEnzyme') ? document.getElementById('terminalEnzyme').value : "FokI"})`,
            enzyme: document.getElementById('terminalEnzyme') ? document.getElementById('terminalEnzyme').value : "FokI",
            sequence: primer5 + primer3,
            primer5: primer5,
            primer3: primer3,
            length: (primer5 + primer3).length
        };
    }

    generateR1Primer(gRNA1, spacerType) {
        const gRNA_12s = gRNA1.substring(0, 12);
        
        // CORRECTED: Use manual reverse, not split().reverse().join()
        let reversed = "";
        for (let i = gRNA_12s.length - 1; i >= 0; i--) {
            reversed += gRNA_12s.charAt(i);
        }
        
        const complement = { 'A': 'T', 'T': 'A', 'G': 'C', 'C': 'G' };
        const reverseComplement = reversed.split('').map(base => complement[base] || base).join('');
        
        const filler1 = "AT";
        const recognition = (this.selectedGGEnzyme || this.ENZYMES["BsaI"]).recognition; // Dynamic GG Enzyme
        const filler2 = (this.selectedGGEnzyme || this.ENZYMES["BsaI"]).bufferGGRv;
        
        // CORRECTED: No separate cut site - it's embedded in the reverse complement
        const primer5 = filler1 + recognition + filler2 + reverseComplement;
        const primer3 = this.sequences.tRNA_tail;
        
        return {
            name: "Rw1",
            type: `Reverse (${document.getElementById('ggEnzyme') ? document.getElementById('ggEnzyme').value : "BsaI"})`,
            enzyme: document.getElementById('ggEnzyme') ? document.getElementById('ggEnzyme').value : "BsaI",
            sequence: primer5 + primer3,
            primer5: primer5,
            primer3: primer3,
            gRNA_12s: gRNA_12s,
            reversed: reversed,
            revComp: reverseComplement,
            length: (primer5 + primer3).length
        };
    }

    generateForwardPrimer(gRNA, primerIndex, spacerType) {
        const primerName = `Fw${primerIndex}`;
        const gRNA_12e = gRNA.substring(gRNA.length - 12); // CORRECTED: RIGHT 12 bp, not (8,20)
        
        const filler1 = "TA";
        const recognition = (this.selectedGGEnzyme || this.ENZYMES["BsaI"]).recognition; // Dynamic GG Enzyme
        const filler2 = (this.selectedGGEnzyme || this.ENZYMES["BsaI"]).bufferGGFw;
        
        const primer5 = filler1 + recognition + filler2 + gRNA_12e;
        const primer3 = this.sequences.scaffold;
        
        return {
            name: primerName,
            type: `Forward (${document.getElementById('ggEnzyme') ? document.getElementById('ggEnzyme').value : "BsaI"})`,
            enzyme: document.getElementById('ggEnzyme') ? document.getElementById('ggEnzyme').value : "BsaI",
            sequence: primer5 + primer3,
            primer5: primer5,
            primer3: primer3,
            gRNA_12e: gRNA_12e,
            length: (primer5 + primer3).length
        };
    }

    generateReversePrimer(gRNA, primerIndex, spacerType, isLast = false) {
        const primerName = `Rw${primerIndex}`;
        
        if (isLast) {
            const filler1 = "AC";
            const recognition = (this.selectedTermEnzyme || this.ENZYMES["FokI"]).recognition; // Dynamic Terminal Enzyme
            const filler2 = (this.selectedTermEnzyme || this.ENZYMES["FokI"]).bufferTERv;
            
            let cut = this.sequences.ggCuts[spacerType][`R${primerIndex}`];
            const overhangSelect = document.getElementById('vectorOverhang');
            if (overhangSelect && overhangSelect.value === 'custom') {
                const customREl = document.getElementById('customRFinalOverhang');
                if (customREl && customREl.value.trim().length > 0) {
                    let customVal = customREl.value.toUpperCase().replace(/[^ATGCN]/g, '');
                    cut = customVal.padEnd(4, 'N');
                } else {
                    cut = "NNNN";
                }
            }
            
            const primer5 = filler1 + recognition + filler2 + cut + this.sequences.polyA;
            const primer3 = this.sequences.tRNA_tail;
            
            return {
                name: primerName,
                type: `Reverse (${document.getElementById('terminalEnzyme') ? document.getElementById('terminalEnzyme').value : "FokI"} - Final)`,
                enzyme: document.getElementById('terminalEnzyme') ? document.getElementById('terminalEnzyme').value : "FokI",
                sequence: primer5 + primer3,
                primer5: primer5,
                primer3: primer3,
                length: (primer5 + primer3).length
            };
        } else {
            const gRNA_12s = gRNA.substring(0, 12);
            
            const filler1 = "AT";
            const recognition = (this.selectedGGEnzyme || this.ENZYMES["BsaI"]).recognition; // Dynamic GG Enzyme
            const filler2 = (this.selectedGGEnzyme || this.ENZYMES["BsaI"]).bufferGGRv;
            
            // CORRECTED: Use manual reverse and no separate cut site
            let reversed = "";
            for (let i = gRNA_12s.length - 1; i >= 0; i--) {
                reversed += gRNA_12s.charAt(i);
            }
            
            const complement = { 'A': 'T', 'T': 'A', 'G': 'C', 'C': 'G' };
            const reverseComplement = reversed.split('').map(base => complement[base] || base).join('');
            
            const primer5 = filler1 + recognition + filler2 + reverseComplement;
            const primer3 = this.sequences.tRNA_tail;
            
            const ggName = document.getElementById('ggEnzyme') ? document.getElementById('ggEnzyme').value : "BsaI";
            return {
                name: primerName,
                type: `Reverse (${ggName})`,
                enzyme: ggName,
                sequence: primer5 + primer3,
                primer5: primer5,
                primer3: primer3,
                gRNA_12s: gRNA_12s,
                reversed: reversed,
                revComp: reverseComplement,
                length: (primer5 + primer3).length
            };
        }
    }

    generatePCRProduct(forwardPrimer, reversePrimer, pcrIndex, spacerType) {
        // Calculate PCR product based on module type
        let pcrSequence;
        
        if (pcrIndex === 1) {
            // Module 1: F1 5' + tRNA + reverse_complement(R1 5') (NO gRNA)
            pcrSequence = forwardPrimer.primer5 + 
                         this.sequences.tRNA_core + 
                         this.reverseComplement(reversePrimer.primer5);
        } else {
            // Other modules: F5' + gRNA + tRNA + reverse_complement(R5')
            pcrSequence = forwardPrimer.primer5 + 
                         this.sequences.gRNA_core + 
                         this.sequences.tRNA_core + 
                         this.reverseComplement(reversePrimer.primer5);
        }
        
        return {
            name: `PCR Product${pcrIndex}`,
            sequence: pcrSequence,
            length: pcrSequence.length,
            forwardPrimer: forwardPrimer.name,
            reversePrimer: reversePrimer.name
        };
    }

    generateGGDigest(pcrProduct, pcrIndex, totalModules, numSpacers) {
        let digestSequence = "";
        const pcrSeq = pcrProduct.sequence;
        const ggEnz = this.selectedGGEnzyme || this.ENZYMES['BsaI'];
        
        const fwdRecog = ggEnz.recognition;
        const revRecog = this.reverseComplement(ggEnz.recognition);
        
        let startIndex = 0;
        let endIndex = pcrSeq.length;
        
        // Left trim (for pcrIndex > 1)
        if (pcrIndex > 1) {
            const fwdIdx = pcrSeq.indexOf(fwdRecog);
            if (fwdIdx !== -1) {
                // The Forward primer structure: filler1 + recognition + buffer + overhang + sequence
                // For concatenation to work without duplicating the overhang, we skip the overhang on the left side of Module 2.
                // Left side skips: fwdIdx + recog length + buffer length + 4bp overhang
                startIndex = fwdIdx + fwdRecog.length + ggEnz.bufferGGFw.length;
            } else {
                startIndex = 9; // Fallback
            }
        }
        
        // Right trim (for pcrIndex < totalModules)
        if (pcrIndex < totalModules) {
            const revIdx = pcrSeq.lastIndexOf(revRecog);
            if (revIdx !== -1) {
                // The Reverse primer structure on top strand: [sequence] [overhang RC] [buffer RC] [recog RC]
                // We want to KEEP the overhang on Module 1's right side.
                // So we cut exactly AT [buffer RC].
                endIndex = revIdx - ggEnz.bufferGGRv.length - 4;
            } else {
                endIndex = pcrSeq.length - 13; // Fallback
            }
        }
        
        digestSequence = pcrSeq.substring(startIndex, endIndex);

        const ggEnzName = document.getElementById('ggEnzyme') ? document.getElementById('ggEnzyme').value : "BsaI";
        return {
            name: `${ggEnzName} Digest${pcrIndex}`,
            sequence: digestSequence,
            length: digestSequence.length,
            source: pcrProduct.name,
            extractionMethod: "Dynamic Motif Cut"
        };
    }

    performCalculations(spacers) {
        // Retrieve dynamic selections
        const scaffoldSel = document.getElementById('scaffoldType');
        const ggSel = document.getElementById('ggEnzyme');
        const termSel = document.getElementById('terminalEnzyme');
        
        const scaffoldId = scaffoldSel ? scaffoldSel.value : 'scaffold2';
        const ggId = ggSel ? ggSel.value : 'BsaI';
        const termId = termSel ? termSel.value : 'FokI';
        
        this.selectedScaffold = this.SCAFFOLDS[scaffoldId] || this.SCAFFOLDS['scaffold2'];
        this.selectedGGEnzyme = this.ENZYMES[ggId] || this.ENZYMES['BsaI'];
        this.selectedTermEnzyme = this.ENZYMES[termId] || this.ENZYMES['FokI'];
        this.selectedGGEnzymeName = ggId;
        this.selectedTermEnzymeName = termId;
        
        this.sequences.scaffold = this.selectedScaffold.sequence.substring(0, this.selectedScaffold.anchorLength);
        this.sequences.gRNA_core = this.selectedScaffold.sequence;

        // Store spacers for use in PCR product generation
        this.currentSpacers = spacers;
        
        // Assign unique colors to each spacer for tracking throughout the workflow
        this.spacerColors = this.assignSpacerColors(spacers);
        this._spacerFragments = null;
        
        const numSpacers = spacers.length;
        const totalModules = numSpacers + 1;
        
        let overhangType = "Default (ATTG / AAAC)";
        let ohF1 = this.sequences.ggCuts[numSpacers]["F1"];
        let ohR = this.sequences.ggCuts[numSpacers][`R${totalModules}`];
        
        const overhangSelect = document.getElementById('vectorOverhang');
        if (overhangSelect && overhangSelect.value === 'custom') {
            overhangType = "Custom (User Defined)";
            const customF1El = document.getElementById('customF1Overhang');
            if (customF1El && customF1El.value.trim().length > 0) {
                ohF1 = customF1El.value.toUpperCase().replace(/[^ATGCN]/g, '').padEnd(4, 'N');
            } else ohF1 = "NNNN";
            
            const customREl = document.getElementById('customRFinalOverhang');
            if (customREl && customREl.value.trim().length > 0) {
                ohR = customREl.value.toUpperCase().replace(/[^ATGCN]/g, '').padEnd(4, 'N');
            } else ohR = "NNNN";
        }
        
        const results = {
            config: {
                scaffoldId: scaffoldId,
                ggId: ggId,
                termId: termId,
                ggName: ggId,
                termName: termId,
                overhangType: overhangType,
                overhangF1: ohF1,
                overhangR: ohR
            },
            spacers: spacers,
            spacerCount: numSpacers,
            modules: [],
            finalAssembly: '',
            goldenGateAssembly: '',
            assemblyDetails: {}
        };

        const primers = [];
        const pcrProducts = [];
        const bsaIDigests = [];

        // Module 1: Fw (FokI) + Rw (BsaI with spacer1)
        const fw1 = this.generateF1Primer(numSpacers);
        const rw1 = this.generateR1Primer(spacers[0], numSpacers);
        const pcr1 = this.generatePCRProduct(fw1, rw1, 1, numSpacers);
        const digest1 = this.generateGGDigest(pcr1, 1, totalModules, numSpacers);

        primers.push(fw1, rw1);
        pcrProducts.push(pcr1);
        bsaIDigests.push(digest1);

        results.modules.push({
            moduleNumber: 1,
            forward: fw1,
            reverse: rw1,
            pcr: pcr1,
            digest: digest1
        });

        // Middle Modules
        for (let i = 2; i <= numSpacers; i++) {
            const forward = this.generateForwardPrimer(spacers[i-2], i, numSpacers);
            const reverse = this.generateReversePrimer(spacers[i-1], i, numSpacers);
            const pcr = this.generatePCRProduct(forward, reverse, i, numSpacers);
            const digest = this.generateGGDigest(pcr, i, totalModules, numSpacers);

            primers.push(forward, reverse);
            pcrProducts.push(pcr);
            bsaIDigests.push(digest);

            results.modules.push({
                moduleNumber: i,
                forward: forward,
                reverse: reverse,
                pcr: pcr,
                digest: digest
            });
        }

        // Final Module
        const finalModuleNum = totalModules;
        const finalForward = this.generateForwardPrimer(spacers[numSpacers - 1], finalModuleNum, numSpacers);
        const finalReverse = this.generateReversePrimer(null, finalModuleNum, numSpacers, true);
        const finalPCR = this.generatePCRProduct(finalForward, finalReverse, finalModuleNum, numSpacers);
        const finalDigest = this.generateGGDigest(finalPCR, finalModuleNum, totalModules, numSpacers);

        primers.push(finalForward, finalReverse);
        pcrProducts.push(finalPCR);
        bsaIDigests.push(finalDigest);

        results.modules.push({
            moduleNumber: finalModuleNum,
            forward: finalForward,
            reverse: finalReverse,
            pcr: finalPCR,
            digest: finalDigest
        });

        // Golden Gate Assembly - concatenation of all BsaI digests
        const digestSequences = bsaIDigests.map(d => d.sequence);
        results.finalAssembly = digestSequences.join('');
        results.goldenGateAssembly = results.finalAssembly;

        // Expected length, derived dynamically so the sanity check stays valid for any
        // scaffold + terminal enzyme. Per-spacer module = scaffold + tRNA (77) + 20 bp spacer.
        // The constant 99 is the fixed leader/poly-A/overhang scaffolding (validated against the
        // engine across all scaffold x terminal-enzyme x spacer-count combinations); the terminal
        // recognition site + buffer appear at both ends, hence x2. GG enzyme does not affect length.
        const termEnz = this.selectedTermEnzyme || this.ENZYMES['FokI'];
        const expectedLength = numSpacers * (this.sequences.gRNA_core.length + this.sequences.tRNA_core.length + 20)
            + 99 + (termEnz.recognition.length * 2) + termEnz.bufferTEFw.length + termEnz.bufferTERv.length;

        results.assemblyDetails = {
            totalLength: results.finalAssembly.length,
            expectedLength: expectedLength,
            moduleCount: totalModules,
            primerCount: primers.length,
            pcrCount: pcrProducts.length,
            digestCount: bsaIDigests.length,
            enzymesUsed: [`${ggId} (digestion)`, `${termId}`, 'T4 DNA Ligase (ligation)'],
            goldenGateProcess: `${ggId} digestion followed by T4 ligation`,
            finalAssemblyName: 'Final PTG Assembly',
            allPrimers: primers,
            allPCRs: pcrProducts,
            allDigests: bsaIDigests
        };

        return results;
    }

    // Assign unique colors to each spacer for consistent tracking throughout workflow
    assignSpacerColors(spacers) {
        const spacerColors = {};
        // Define a set of HIGH-CONTRAST colors for spacers (excellent readability on white background)
        const availableColors = [
            '#D32F2F', // Spacer 1 — Strong Red
            '#1976D2', // Spacer 2 — Strong Blue
            '#540b0e', // Spacer 3 — Dark Maroon
            '#F57C00', // Spacer 4 — Strong Orange
            '#390099', // Spacer 5 — Indigo
            '#9e0059', // Spacer 6 — Magenta
            '#00796B', // Spacer 7 — Strong Teal
            '#d9542e', // Spacer 8 — Coral (darker)
            '#455A64', // Spacer 9 — Blue Grey
            '#5f0f40', // Spacer 10 — Dark Plum
            '#dd2d4a', // Spacer 11 — Red Pink
            '#0353a4', // Spacer 12 — Navy Blue (lighter)
            '#4E342E', // Dark Brown (11.1:1 contrast)
            '#BF360C', // Dark Red (8.7:1 contrast)
            '#4A148C'  // Dark Purple (12.3:1 contrast)
        ];
        
        spacers.forEach((spacer, index) => {
            const colorIndex = index % availableColors.length;
            spacerColors[spacer] = availableColors[colorIndex];
        });
        
        return spacerColors;
    }

    // Get spacer fragments and their colors for tracking. Cached: this is called once per
    // rendered card (21x for a 4-spacer design), and the map only changes when the spacers do.
    getSpacerFragments() {
        if (this._spacerFragments) return this._spacerFragments;

        const fragments = {};

        if (!this.currentSpacers || !this.spacerColors) return fragments;
        
        this.currentSpacers.forEach(spacer => {
            const color = this.spacerColors[spacer];
            
            // Get fragments used in primers
            const s_gRNA = spacer.substring(0, 12); // First 12bp (used in reverse primers)
            const e_gRNA = spacer.substring(spacer.length - 12); // Last 12bp
            // First 8bp — the trailing remnant left in a Golden Gate digest after the 4 bp
            // junction overhang (spacer[8:12]) is carried by the NEXT module. Without this the
            // tail of each digest box would render uncoloured.
            const s_gRNA_8 = spacer.substring(0, 8);

            // Reverse complement of s_gRNA (used in reverse primers)
            const s_gRNA_rc = this.reverseComplement(s_gRNA);

            // Store fragments with their parent spacer color
            fragments[spacer] = color; // Full spacer
            fragments[s_gRNA] = color; // Start fragment (first 12bp)
            fragments[s_gRNA_8] = color; // First 8bp (digest tail remnant)
            fragments[e_gRNA] = color; // End fragment
            fragments[s_gRNA_rc] = color; // Reverse complement of start fragment
        });

        this._spacerFragments = fragments;
        return fragments;
    }



    // ... UI methods remain the same as previous version
    initializeEventListeners() {
        try {
            console.log('initializeEventListeners called');
            
            const spacerTypeEl = document.getElementById('spacerType');
            if (spacerTypeEl) {
                spacerTypeEl.addEventListener('change', () => {
                    this.updateSpacerInputs();
                });
                console.log('spacerType change listener added');
            } else {
                console.warn('spacerType element not found');
            }

            const vectorOverhangEl = document.getElementById('vectorOverhang');
            if (vectorOverhangEl) {
                vectorOverhangEl.addEventListener('change', (e) => {
                    const customContainer = document.getElementById('customOverhangContainer');
                    if (customContainer) {
                        if (e.target.value === 'custom') {
                            customContainer.style.display = 'flex';
                        } else {
                            customContainer.style.display = 'none';
                        }
                    }
                });
                
                // Add input formatting for custom overhangs
                ['customF1Overhang', 'customRFinalOverhang'].forEach(id => {
                    const el = document.getElementById(id);
                    if (el) {
                        el.addEventListener('input', (e) => {
                            let val = e.target.value.toUpperCase().replace(/[^ATGCN]/g, '');
                            e.target.value = val;
                        });
                        el.addEventListener('blur', (e) => {
                            let val = e.target.value.toUpperCase().replace(/[^ATGCN]/g, '');
                            if (val.length > 0 && val.length < 4) {
                                val = val.padEnd(4, 'N');
                            }
                            e.target.value = val;
                        });
                    }
                });
            }

            const calculateBtnEl = document.getElementById('calculateBtn');
            if (calculateBtnEl) {
                calculateBtnEl.addEventListener('click', () => {
                    this.calculatePTG();
                });
                console.log('calculateBtn click listener added');
            } else {
                console.warn('calculateBtn element not found');
            }

            const clearBtnEl = document.getElementById('clearBtn');
            if (clearBtnEl) {
                clearBtnEl.addEventListener('click', () => {
                    this.clearAll();
                });
                console.log('clearBtn click listener added');
            } else {
                console.warn('clearBtn element not found');
            }

            const exampleBtnEl = document.getElementById('exampleBtn');
            if (exampleBtnEl) {
                exampleBtnEl.addEventListener('click', () => {
                    this.loadExample();
                });
                console.log('exampleBtn click listener added');
            } else {
                console.warn('exampleBtn element not found');
            }

            const hamburger = document.querySelector('.hamburger');
            const navMenu = document.querySelector('.nav-menu');
            
            if (hamburger && navMenu) {
                hamburger.addEventListener('click', () => {
                    navMenu.classList.toggle('active');
                });
                console.log('hamburger menu listener added');
            }

            this.setupInputValidation();
            console.log('initializeEventListeners completed');
        } catch (error) {
            console.error('Error in initializeEventListeners:', error);
            throw error;
        }
    }

    setupInputValidation() {
        try {
            console.log('setupInputValidation called');
            const spacerInputs = document.querySelectorAll('.spacer-input');
            console.log('Found', spacerInputs.length, 'spacer inputs');
            spacerInputs.forEach((input, index) => {
                input.addEventListener('input', (e) => {
                    this.validateSpacerInput(e.target);
                });
                console.log('Added event listener to input', index + 1);
            });
            console.log('setupInputValidation completed');
        } catch (error) {
            console.error('Error in setupInputValidation:', error);
        }
    }

    validateSpacerInput(input) {
        let value = input.value.toUpperCase();
        value = value.replace(/[^ATGC]/g, '');
        input.value = value;

        if (value.length === 20) {
            input.classList.remove('error');
            input.classList.add('success');
        } else if (value.length > 0) {
            input.classList.remove('success', 'error');
        } else {
            input.classList.remove('success', 'error');
        }
    }

    updateSpacerInputs() {
        try {
            console.log('updateSpacerInputs called');
            const spacerTypeElement = document.getElementById('spacerType');
            const container = document.getElementById('spacerInputs');
            
            if (!spacerTypeElement) {
                console.warn('spacerType element not found, likely on results page');
                return;
            }
            if (!container) {
                console.warn('spacerInputs container element not found');
                return;
            }
            
            const spacerType = parseInt(spacerTypeElement.value);
            console.log('Spacer type:', spacerType);
            
            container.innerHTML = '';
            
            for (let i = 1; i <= spacerType; i++) {
                const spacerGroup = document.createElement('div');
                spacerGroup.className = 'spacer-group';
                spacerGroup.innerHTML = `
                    <label for="spacer${i}"><i class="fas fa-flask"></i> Guide RNA Spacer ${i}:</label>
                    <input type="text" id="spacer${i}" class="form-control spacer-input" 
                           maxlength="20" 
                           title="Enter exactly 20 base pairs using only A, T, G, C">
                `;
                container.appendChild(spacerGroup);
                console.log('Added spacer input', i);
            }
            
            this.setupInputValidation();
            console.log('updateSpacerInputs completed successfully');
        } catch (error) {
            console.error('Error in updateSpacerInputs:', error);
            throw error;
        }
    }

    loadExample() {
        const spacerType = parseInt(document.getElementById('spacerType').value);
        const defaultSpacers = {
            2: ["ACTTATCGTCATATCGTTGC", "GCTAACATTCGAAATCCTAG"],
            3: ["ACTTATCGTCATATCGTTGC", "GCTAACATTCGAAATCCTAG", "CATCATCTATTTAGCTATCA"],
            4: ["ACTTATCGTCATATCGTTGC", "GCTAACATTCGAAATCCTAG", "CATCATCTATTTAGCTATCA", "GATCCTTCTGAATGGAGACT"],
            5: ["ACTTATCGTCATATCGTTGC", "GCTAACATTCGAAATCCTAG", "CATCATCTATTTAGCTATCA", "GATCCTTCTGAATGGAGACT", "TCCTCCATTTAGGCTAACTT"],
            6: ["ACTTATCGTCATATCGTTGC", "GCTAACATTCGAAATCCTAG", "CATCATCTATTTAGCTATCA", "GATCCTTCTGAATGGAGACT", "TCCTCCATTTAGGCTAACTT", "TCCTGCAATGACATTTGTCA"],
            7: ["ACTTATCGTCATATCGTTGC", "GCTAACATTCGAAATCCTAG", "CATCATCTATTTAGCTATCA", "GATCCTTCTGAATGGAGACT", "TCCTCCATTTAGGCTAACTT", "TCCTGCAATGACATTTGTCA", "GCTGTCAAAATTACGCTAAA"],
            8: ["ACTTATCGTCATATCGTTGC", "GCTAACATTCGAAATCCTAG", "CATCATCTATTTAGCTATCA", "GATCCTTCTGAATGGAGACT", "TCCTCCATTTAGGCTAACTT", "TCCTGCAATGACATTTGTCA", "GCTGTCAAAATTACGCTAAA", "TCTCAAGATTTAAGCTGTCA"],
            9: ["ACTTATCGTCATATCGTTGC", "GCTAACATTCGAAATCCTAG", "CATCATCTATTTAGCTATCA", "GATCCTTCTGAATGGAGACT", "TCCTCCATTTAGGCTAACTT", "TCCTGCAATGACATTTGTCA", "GCTGTCAAAATTACGCTAAA", "TCTCAAGATTTAAGCTGTCA", "GGCTTCTTTGGCTTCACCCT"],
            10: ["ACTTATCGTCATATCGTTGC", "GCTAACATTCGAAATCCTAG", "CATCATCTATTTAGCTATCA", "GATCCTTCTGAATGGAGACT", "TCCTCCATTTAGGCTAACTT", "TCCTGCAATGACATTTGTCA", "GCTGTCAAAATTACGCTAAA", "TCTCAAGATTTAAGCTGTCA", "GGCTTCTTTGGCTTCACCCT", "CGGCAAGGATCAGGTGGTGG"],
            11: ["ACTTATCGTCATATCGTTGC", "GCTAACATTCGAAATCCTAG", "CATCATCTATTTAGCTATCA", "GATCCTTCTGAATGGAGACT", "TCCTCCATTTAGGCTAACTT", "TCCTGCAATGACATTTGTCA", "GCTGTCAAAATTACGCTAAA", "TCTCAAGATTTAAGCTGTCA", "GGCTTCTTTGGCTTCACCCT", "CGGCAAGGATCAGGTGGTGG", "TCGGCGAGGTCAAGAAGGAG"],
            12: ["ACTTATCGTCATATCGTTGC", "GCTAACATTCGAAATCCTAG", "CATCATCTATTTAGCTATCA", "GATCCTTCTGAATGGAGACT", "TCCTCCATTTAGGCTAACTT", "TCCTGCAATGACATTTGTCA", "GCTGTCAAAATTACGCTAAA", "TCTCAAGATTTAAGCTGTCA", "GGCTTCTTTGGCTTCACCCT", "CGGCAAGGATCAGGTGGTGG", "TCGGCGAGGTCAAGAAGGAG", "GTACCCGTGGAGCTACCACC"]
        };
        
        defaultSpacers[spacerType].forEach((spacer, index) => {
            const input = document.getElementById(`spacer${index + 1}`);
            if (input) {
                input.value = spacer;
                this.validateSpacerInput(input);
            }
        });
    }

    clearAll() {
        document.querySelectorAll('.spacer-input').forEach(input => {
            input.value = '';
            input.classList.remove('success', 'error');
        });
    }

    getSpacerSequences() {
        const spacerType = parseInt(document.getElementById('spacerType').value);
        const spacers = [];
        
        for (let i = 1; i <= spacerType; i++) {
            const input = document.getElementById(`spacer${i}`);
            if (input && input.value.length === 20) {
                spacers.push(input.value.toUpperCase());
            } else {
                throw new Error(`Spacer ${i} must be exactly 20 base pairs long`);
            }
        }
        
        return spacers;
    }

    calculatePTG() {
        try {
            const spacers = this.getSpacerSequences();
            
            document.getElementById('calculateBtn').innerHTML = '<span class="spinner"></span> Calculating...';
            document.getElementById('calculateBtn').disabled = true;
            
            setTimeout(() => {
                try {
                    const results = this.performCalculations(spacers);
                    this.displayResults(results);
                } catch (error) {
                    this.showError(error.message);
                } finally {
                    document.getElementById('calculateBtn').innerHTML = '<i class="bi bi-play-circle"></i> Generate Assembly';
                    document.getElementById('calculateBtn').disabled = false;
                }
            }, 500);
            
        } catch (error) {
            this.showError(error.message);
            document.getElementById('calculateBtn').innerHTML = '<i class="bi bi-play-circle"></i> Generate Assembly';
            document.getElementById('calculateBtn').disabled = false;
        }
    }

    displayResults(results) {
        this.goToResultsPage(results);
    }

    // Hand the computed results to results.php via localStorage, then navigate there
    // in the SAME tab. results.php reads ptg_results_data on DOMContentLoaded and
    // renders it through generateResultsHTML().
    goToResultsPage(results) {
        // Save results to localStorage for persistence
        localStorage.setItem('ptg_results_data', JSON.stringify(results));
        localStorage.setItem('ptg_results_timestamp', Date.now().toString());
        
        window.location.href = 'results.php';
    }

    // ---- Sequence colour coding -------------------------------------------------------------
    // Role attribution is POSITIONAL, not motif-based. Primers are built deterministically, so the
    // offset of every designed recognition site is exactly computable; the motif is used only to
    // validate. That is what lets the same enzyme serve as both the terminal and the Golden Gate
    // enzyme and still be coloured correctly in each role.
    //
    // `view` is one of: 'forward' | 'reverse' | 'pcr' | 'digest' | 'final'.

    // Resolve both enzyme roles (and their four motifs) once, with safe fallbacks.
    enzymeRoles() {
        const gg = this.selectedGGEnzyme || this.ENZYMES['BsaI'];
        const term = this.selectedTermEnzyme || this.ENZYMES['FokI'];
        return {
            gg, term,
            ggName: this.selectedGGEnzymeName || 'BsaI',
            termName: this.selectedTermEnzymeName || 'FokI',
            ggF: gg.recognition, ggR: this.reverseComplement(gg.recognition),
            tF: term.recognition, tR: this.reverseComplement(term.recognition),
            sharedMotif: gg.recognition === term.recognition
        };
    }

    findAllOccurrences(sequence, motif) {
        const idx = [];
        if (!sequence || !motif) return idx;
        let p = sequence.indexOf(motif);
        while (p !== -1) { idx.push(p); p = sequence.indexOf(motif, p + 1); }
        return idx;
    }

    // The 5'/3' anchor offsets shared by the terminal recognition site and the vector overhang.
    // filler1 is always 2 nt ("CG"/"AT"/"TA"/"AC"), hence the literal 2.
    terminalEndOffsets(n) {
        const { term } = this.enzymeRoles();
        const tL = term.recognition.length;
        const fwdSiteStart = 2;
        const revSiteStart = n - 2 - tL;
        return {
            tL,
            fwdSiteStart,
            fwdOverhangStart: fwdSiteStart + tL + term.bufferTEFw.length,
            revSiteStart,
            revOverhangStart: revSiteStart - term.bufferTERv.length - 4,
            // The final module's reverse PRIMER carries the overhang on its own strand.
            revPrimerOverhangStart: 2 + tL + term.bufferTERv.length
        };
    }

    // Geometry table: which role is played at which offset, per view. Pure arithmetic — no scanning.
    expectedEnzymeSites(view, modNum, totalMods, n) {
        const { gg, term } = this.enzymeRoles();
        const tL = term.recognition.length, gL = gg.recognition.length;
        const o = this.terminalEndOffsets(n);
        const E = [];
        const T = (start, orientation) => E.push({ start, len: tL, role: 'term', orientation });
        const G = (start, orientation) => E.push({ start, len: gL, role: 'gg', orientation });

        if (view === 'forward') {
            modNum === 1 ? T(2, 'fwd') : G(2, 'fwd');
        } else if (view === 'reverse') {
            // Written 5'->3' on the primer's own strand, so the motif appears literally (fwd).
            modNum === totalMods ? T(2, 'fwd') : G(2, 'fwd');
        } else if (view === 'pcr') {
            modNum === 1 ? T(2, 'fwd') : G(2, 'fwd');
            modNum === totalMods ? T(o.revSiteStart, 'rev') : G(n - 2 - gL, 'rev');
        } else if (view === 'digest') {
            // Two independent ifs so a single-module design keeps both ends.
            // Internal modules have both recognition sites trimmed off by generateGGDigest().
            if (modNum === 1) T(2, 'fwd');
            if (modNum === totalMods) T(o.revSiteStart, 'rev');
        } else if (view === 'final') {
            T(2, 'fwd');
            T(o.revSiteStart, 'rev');
        }
        return E;
    }

    motifFor(entry) {
        const r = this.enzymeRoles();
        if (entry.role === 'term') return entry.orientation === 'fwd' ? r.tF : r.tR;
        return entry.orientation === 'fwd' ? r.ggF : r.ggR;
    }

    // Accept a geometry entry only if the predicted motif is really there. Costs nothing and
    // degrades safely: if an offset ever shifts (over-long custom overhang, or generateGGDigest's
    // indexOf fallbacks firing) the entry is dropped and the occurrence is reported as unexpected
    // rather than silently mis-coloured.
    acceptedEnzymeSites(sequence, view, modNum, totalMods) {
        const n = sequence.length;
        return this.expectedEnzymeSites(view, modNum, totalMods, n).filter(e => {
            const motif = this.motifFor(e);
            const ok = e.start >= 0 && e.start + e.len <= n && sequence.substr(e.start, e.len) === motif;
            if (!ok) console.warn(`PTG: expected ${e.role} site not found at ${e.start} in ${view} (module ${modNum})`);
            return ok;
        });
    }

    // Every recognition-site occurrence, split into DESIGNED (expected position -> role colour) and
    // STRAY (anything else -> red internal-site box, no role colour).
    //
    // Which enzyme is checked for strays depends on the stage the view represents, because only one
    // enzyme is ever applied at a time:
    //   module views -> Golden Gate enzyme  (the only one in the tube during assembly)
    //   final        -> terminal enzyme     (GG sites are spent; this one cuts for vector cloning)
    // Nothing is missed: a stray terminal site inside a module carries through into the assembly,
    // where the terminal check catches it.
    enzymeSites(sequence, view = 'final', modNum = 0, totalMods = 0) {
        if (!sequence) return [];
        const r = this.enzymeRoles();
        const accepted = this.acceptedEnzymeSites(sequence, view, modNum, totalMods);

        const label = (role, orientation) => {
            const rev = orientation === 'rev' ? ' (rev)' : '';
            if (r.sharedMotif) return `Terminal Enzyme / Golden Gate Enzyme: ${r.termName}${rev}`;
            return role === 'term'
                ? `Terminal Enzyme: ${r.termName}${rev}`
                : `Golden Gate Enzyme: ${r.ggName}${rev}`;
        };

        const sites = accepted.map(e => ({
            start: e.start, len: e.len, role: e.role, orientation: e.orientation,
            expected: true, internal: false,
            className: e.role === 'term' ? 'seq-term-site' : 'seq-gg-site',
            type: label(e.role, e.orientation), motif: this.motifFor(e)
        }));

        // Stray scan, scoped to the stage's enzyme. Dedup by motif string so a shared recognition
        // (gg === term, Esp3I/BsmBI, BspMI/BfuAI) is not scanned twice.
        const stageRole = view === 'final' ? 'term' : 'gg';
        const stageMotifs = stageRole === 'term'
            ? [...new Set([r.tF, r.tR])]
            : [...new Set([r.ggF, r.ggR])];

        const seen = new Set(sites.map(s => `${s.start}:${s.len}`));
        stageMotifs.forEach(motif => {
            const orientation = (stageRole === 'term' ? motif === r.tF : motif === r.ggF) ? 'fwd' : 'rev';
            this.findAllOccurrences(sequence, motif).forEach(p => {
                // Absorbed if it lies wholly inside a designed site (identical, or a shorter motif
                // nested in a longer one at the same anchor).
                if (accepted.some(e => p >= e.start && p + motif.length <= e.start + e.len)) return;
                const key = `${p}:${motif.length}`;
                if (seen.has(key)) return;
                seen.add(key);
                sites.push({
                    start: p, len: motif.length, role: stageRole, orientation,
                    expected: false, internal: true,
                    className: stageRole === 'term' ? 'seq-term-site' : 'seq-gg-site',
                    type: label(stageRole, orientation), motif
                });
            });
        });

        return sites.sort((a, b) => a.start - b.start);
    }

    // Per-nucleotide feature annotation with explicit priority. Strictly-greater means the FIRST
    // writer wins at equal priority, which preserves longest-first behaviour inside the spacer
    // layer (a 20 bp spacer beats its own 12/8 bp sub-fragments) with no extra bookkeeping.
    sequenceLayers(sequence, view, modNum, totalMods) {
        const n = sequence.length;
        const annot = new Array(n).fill(null);
        const PRIORITY = { poly: 1, trna: 2, grna: 3, spacer: 4, enzyme: 5, overhang: 6 };
        const mark = (start, len, val) => {
            const prio = PRIORITY[val.kind];
            for (let k = start; k < start + len && k < n; k++) {
                if (k < 0) continue;
                if (prio > (annot[k] ? PRIORITY[annot[k].kind] : 0)) annot[k] = val;
            }
        };
        const each = (motif, val) => this.findAllOccurrences(sequence, motif)
            .forEach(p => mark(p, motif.length, val));

        // 1-3. structural elements
        ['AAAAAAAAAA', 'TTTTTTTTTT'].forEach(run => each(run, { kind: 'poly' }));
        [this.sequences.tRNA_core, this.sequences.tRNA_f1, this.sequences.tRNA_tail]
            .forEach(m => each(m, { kind: 'trna' }));
        [this.sequences.gRNA_core, this.sequences.scaffold]
            .forEach(m => each(m, { kind: 'grna' }));

        // 4. spacers, longest fragment first
        const frags = this.getSpacerFragments();
        Object.keys(frags).filter(Boolean).sort((a, b) => b.length - a.length)
            .forEach(f => each(f, { kind: 'spacer', color: frags[f] }));

        // 5. designed recognition sites only — strays are boxed, not filled, so the element
        //    underneath them stays visible.
        const es = this.enzymeSites(sequence, view, modNum, totalMods);
        es.filter(s => s.expected).forEach(s => mark(s.start, s.len, { kind: 'enzyme', className: s.className }));

        // 6. Cas9 vector overhangs, at exact offsets to avoid false positives
        const o = this.terminalEndOffsets(n);
        const atFwd = () => mark(o.fwdOverhangStart, 4, { kind: 'overhang' });
        const atRev = () => mark(o.revOverhangStart, 4, { kind: 'overhang' });
        if (view === 'final') { atFwd(); atRev(); }
        else if (view === 'digest') { if (modNum === 1) atFwd(); if (modNum === totalMods) atRev(); }
        else if (view === 'forward') { if (modNum === 1) atFwd(); }
        else if (view === 'pcr') { if (modNum === 1) atFwd(); if (modNum === totalMods) atRev(); }
        else if (view === 'reverse') {
            if (modNum === totalMods) mark(o.revPrimerOverhangStart, 4, { kind: 'overhang' });
        }

        // Stray sites become merged red-outline boxes laid OVER the base colouring.
        const boxes = [];
        es.filter(s => s.internal).sort((a, b) => a.start - b.start).forEach(s => {
            const last = boxes[boxes.length - 1];
            if (last && s.start <= last.end) last.end = Math.max(last.end, s.start + s.len);
            else boxes.push({ start: s.start, end: s.start + s.len, type: s.type, motif: s.motif });
        });

        return { annot, boxes, sites: es };
    }

    // The one span emitter. Runs are merged STRUCTURALLY (not by object identity), so adjacent
    // nucleotides of the same feature collapse into a single span.
    renderAnnotations(sequence, annot, boxes) {
        const n = sequence.length;
        const ivOf = new Array(n).fill(-1);
        boxes.forEach((b, idx) => { for (let k = Math.max(0, b.start); k < b.end && k < n; k++) ivOf[k] = idx; });

        const same = (a, b) => {
            if (a === b) return true;
            if (!a || !b) return false;
            return a.kind === b.kind && a.color === b.color && a.className === b.className;
        };
        const wrap = (a, text) => {
            if (!a) return text;
            switch (a.kind) {
                case 'poly': return `<span class="seq-polyA">${text}</span>`;
                case 'trna': return `<span class="seq-tRNA">${text}</span>`;
                case 'grna': return `<span class="seq-gRNA-scaffold">${text}</span>`;
                case 'spacer': return `<span class="spacer-tracked" style="color: ${a.color};">${text}</span>`;
                case 'enzyme': return `<span class="${a.className}">${text}</span>`;
                case 'overhang': return `<span class="seq-overhang">${text}</span>`;
                default: return text;
            }
        };

        let out = '', i = 0, curBox = -1;
        while (i < n) {
            const box = ivOf[i];
            if (box !== curBox) {
                if (curBox !== -1) out += '</span>';
                curBox = box;
                if (box !== -1) {
                    const b = boxes[box];
                    out += `<span class="seq-internal-site" title="Internal ${b.motif} site (${b.type}) at ${b.start + 1}">`;
                }
            }
            let j = i + 1;
            while (j < n && same(annot[j], annot[i]) && ivOf[j] === box) j++;
            out += wrap(annot[i], sequence.substring(i, j));
            i = j;
        }
        if (curBox !== -1) out += '</span>';
        return out;
    }

    // Single public entry point for every sequence rendered on the results page.
    colorCodeSequence(sequence, sequenceType = 'final_assembly', modNum = 0, totalMods = 0, seqType = '') {
        if (!sequence) return '';
        const view = sequenceType === 'final_assembly' ? 'final'
                   : sequenceType === 'digest' ? 'digest'
                   : (seqType || 'pcr');
        const { annot, boxes } = this.sequenceLayers(sequence, view, modNum, totalMods);
        return this.renderAnnotations(sequence, annot, boxes);
    }

    // Stray TERMINAL-enzyme sites in the final assembly — drives the assembly status banner.
    findInternalSites(results) {
        if (!results || !results.finalAssembly) return [];
        return this.enzymeSites(results.finalAssembly, 'final')
            .filter(s => s.internal)
            .map(s => ({ type: s.type, motif: s.motif, pos: s.start }));
    }

    // Stray GOLDEN GATE sites across every module card — drives the module-stage warning block.
    findModuleInternalSites(results) {
        if (!results || !Array.isArray(results.modules)) return [];
        const total = results.modules.length;
        const found = [];
        results.modules.forEach(m => {
            [['forward', m.forward, 'forward'], ['reverse', m.reverse, 'reverse'],
             ['pcr', m.pcr, 'pcr'], ['digest', m.digest, 'digest']].forEach(([view, part]) => {
                if (!part || !part.sequence) return;
                this.enzymeSites(part.sequence, view, m.moduleNumber, total)
                    .filter(s => s.internal)
                    .forEach(s => found.push({
                        module: m.moduleNumber, part: part.name || view,
                        type: s.type, motif: s.motif, pos: s.start
                    }));
            });
        });
        return found;
    }

    generateResultsHTML(results) {
        // Restore config if available
        let ggName = 'BsaI';
        let termName = 'FokI';
        let ggId = 'BsaI';
        let termId = 'FokI';
        
        if (results.config) {
            this.selectedScaffold = this.SCAFFOLDS[results.config.scaffoldId] || this.SCAFFOLDS['scaffold2'];
            this.selectedGGEnzyme = this.ENZYMES[results.config.ggId] || this.ENZYMES['BsaI'];
            this.selectedTermEnzyme = this.ENZYMES[results.config.termId] || this.ENZYMES['FokI'];
            this.selectedGGEnzymeName = results.config.ggId || 'BsaI';
            this.selectedTermEnzymeName = results.config.termId || 'FokI';
            this.sequences.scaffold = this.selectedScaffold.sequence.substring(0, this.selectedScaffold.anchorLength);
            this.sequences.gRNA_core = this.selectedScaffold.sequence;
            // A payload stored before `ggName` existed would otherwise render "undefined".
            ggName = results.config.ggName || results.config.ggId || 'BsaI';
            termName = results.config.termName || results.config.termId || 'FokI';
            ggId = results.config.ggId || 'BsaI';
            termId = results.config.termId || 'FokI';
        } else {
            // Set all five fields symmetrically, or enzymeSites() falls back to the
            // 'BsaI'/'FokI' literals and mislabels the alert list.
            this.selectedScaffold = this.SCAFFOLDS['scaffold2'];
            this.selectedGGEnzyme = this.ENZYMES['BsaI'];
            this.selectedTermEnzyme = this.ENZYMES['FokI'];
            this.selectedGGEnzymeName = 'BsaI';
            this.selectedTermEnzymeName = 'FokI';
        }

        
        if (results.spacers && results.spacers.length > 0) {
            this.currentSpacers = results.spacers;
            this.spacerColors = this.assignSpacerColors(results.spacers);
            this._spacerFragments = null;
        }

        const scaffoldLabel = (this.selectedScaffold && this.selectedScaffold.label) || 'Scaffold 2 — engineered (86 nt)';

        // Recognition sequences (forward / reverse-complement) for the legend chips.
        const ggRecog = (this.selectedGGEnzyme || this.ENZYMES['BsaI']).recognition;
        const ggRecogRC = this.reverseComplement(ggRecog);
        const termRecog = (this.selectedTermEnzyme || this.ENZYMES['FokI']).recognition;
        const termRecogRC = this.reverseComplement(termRecog);

        // Per-spacer legend chips — one per selected spacer, in its own palette colour.
        const spacerLegendChips = (results.spacers || []).map((s, i) =>
            `<span class="legend-chip" style="background: ${this.spacerColors[s]}; color: #fff;"><i class="bi bi-circle-fill"></i> Spacer ${i + 1}</span>`
        ).join('');

        // Assembly scope: stray TERMINAL sites only (the GG enzyme is spent by this stage).
        const internalSites = this.findInternalSites(results);
        const hasInternal = internalSites.length > 0;
        // Module scope: stray GOLDEN GATE sites only (the only enzyme applied at that stage).
        const moduleSites = this.findModuleInternalSites(results);
        
        let titleStatus = '';
        if (hasInternal) {
            titleStatus = `<span style="color: #991b1b; font-size: 0.85em; margin-left: 10px;"><i class="bi bi-x-circle-fill"></i> Internal ${termName} (Terminal Enzyme) recognition sites identified</span>`;
        } else {
            titleStatus = `<span style="color: #166534; font-size: 0.85em; margin-left: 10px;"><i class="bi bi-check-circle-fill"></i> No internal ${termName} (Terminal Enzyme) recognition sites identified</span>`;
        }
            
        let internalSitesHtml = '';
        if (hasInternal) {
            internalSitesHtml = `
            <div class="internal-sites-alert" style="margin-top: 12px; background: #fef2f2; border: 1px solid #fca5a5; padding: 10px 16px; border-radius: 8px; color: #991b1b; font-size: 0.85em; font-family: 'Roboto', sans-serif;">
                <strong style="display: block; margin-bottom: 6px;"><i class="bi bi-exclamation-triangle-fill" style="color: #ef4444;"></i> Internal ${termName} (Terminal Enzyme) sites in the assembly &mdash; these would cut the cassette during vector cloning:</strong>
                <ul style="margin: 0; padding-left: 20px; line-height: 1.5;">
                    ${internalSites.map(s => `<li>${s.type} at position ${s.pos + 1} (${s.motif})</li>`).join('')}
                </ul>
            </div>`;
        }

        const lengthMatch = results.assemblyDetails.totalLength === results.assemblyDetails.expectedLength ? "✔️" : "⚠️";

        // Module-stage warning block, shown with the module analysis rather than inside the
        // assembly card, so each warning sits beside the stage it concerns.
        let moduleSitesHtml = '';
        if (moduleSites.length > 0) {
            moduleSitesHtml = `
            <div class="internal-sites-alert" style="margin-bottom: 16px; background: #fef2f2; border: 1px solid #fca5a5; padding: 10px 16px; border-radius: 8px; color: #991b1b; font-size: 0.85em; font-family: 'Roboto', sans-serif;">
                <strong style="display: block; margin-bottom: 6px;"><i class="bi bi-exclamation-triangle-fill" style="color: #ef4444;"></i> Internal ${ggName} (Golden Gate Enzyme) sites in ${moduleSites.length} module sequence${moduleSites.length === 1 ? '' : 's'} &mdash; these would mis-digest during assembly:</strong>
                <ul style="margin: 0; padding-left: 20px; line-height: 1.5;">
                    ${moduleSites.map(s => `<li>Module ${s.module} &mdash; ${s.part} at position ${s.pos + 1} (${s.motif})</li>`).join('')}
                </ul>
            </div>`;
        }
        
        let modulesHTML = '';
        results.modules.forEach(module => {
            modulesHTML += `
                <div class="lab-module">
                    <div class="module-title-bar">
                        <div class="module-number">Module ${module.moduleNumber}</div>
                        <div class="module-workflow">Primer Design → PCR → Golden Gate</div>
                    </div>
                    
                    <div class="sequence-panel">
                        <div class="sequences-row">
                            <div class="sequence-card forward-seq">
                                <div class="seq-header">
                                    <span class="seq-type">${module.forward.name}</span>
                                    <span class="seq-length">${module.forward.length} bp</span>
                                </div>
                                <div class="seq-display">
                                    <code class="dna-sequence">${this.colorCodeSequence(module.forward.sequence, 'standard', module.moduleNumber, results.modules.length, 'forward')}</code>
                                </div>
                            </div>
                            
                            <div class="sequence-card reverse-seq">
                                <div class="seq-header">
                                    <span class="seq-type">${module.reverse.name}</span>
                                    <span class="seq-length">${module.reverse.length} bp</span>
                                </div>
                                <div class="seq-display">
                                    <code class="dna-sequence">${this.colorCodeSequence(module.reverse.sequence, 'standard', module.moduleNumber, results.modules.length, 'reverse')}</code>
                                </div>
                            </div>
                            
                            <div class="sequence-card pcr-seq">
                                <div class="seq-header">
                                    <span class="seq-type">${module.pcr.name}</span>
                                    <span class="seq-length">${module.pcr.length} bp</span>
                                </div>
                                <div class="seq-display">
                                    <code class="dna-sequence">${this.colorCodeSequence(module.pcr.sequence, 'standard', module.moduleNumber, results.modules.length, 'pcr')}</code>
                                </div>
                            </div>
                            
                            <div class="sequence-card digest-seq">
                                <div class="seq-header">
                                    <span class="seq-type">${module.digest.name}</span>
                                    <span class="seq-length">${module.digest.length} bp</span>
                                </div>
                                <div class="seq-display">
                                    <code class="dna-sequence">${this.colorCodeSequence(module.digest.sequence, 'digest', module.moduleNumber, results.modules.length, 'digest')}</code>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        });

        return `<style>
        /* ===== Results Page — Redesigned to match site theme ===== */
        .results-container {
            max-width: 100%;
            margin: 0;
            background: transparent;
        }

        /* --- Compact Header --- */
        .results-header {
            background: #1a3d2b;
            color: #fff;
            padding: 16px 24px;
            border-radius: 12px;
            margin-bottom: 16px;
            box-shadow: 0 4px 16px rgba(26,61,43,0.18);
        }
        .results-header h1 {
            margin: 0 0 2px 0;
            font-family: 'Poppins', sans-serif;
            font-size: 1.35em;
            font-weight: 700;
            color: #fff;
            letter-spacing: -0.3px;
        }
        .results-header p {
            margin: 0;
            color: #c8e6c9;
            font-family: 'Roboto', sans-serif;
            font-size: 0.88em;
            font-weight: 400;
        }

        /* --- Configuration Pill Bar --- */
        .configuration-info {
            background: #1a3d2b;
            color: #fff;
            padding: 14px 18px;
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-start;
            align-items: center;
            gap: 10px;
            font-family: 'Roboto', sans-serif;
            font-size: 0.9em;
            border: none;
            border-radius: 12px;
            margin-bottom: 16px;
            box-shadow: 0 3px 12px rgba(26,61,43,0.25);
        }
        .configuration-info .config-title {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            font-size: 0.95em;
            color: #fff;
            letter-spacing: 0.3px;
            margin-right: 4px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .configuration-info .config-chip {
            background: rgba(255,255,255,0.14);
            border: 1px solid rgba(255,255,255,0.22);
            border-radius: 20px;
            padding: 5px 14px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: #eafff1;
        }
        .configuration-info .config-key {
            font-weight: 700;
            color: #b9f5cf;
            text-transform: uppercase;
            font-size: 0.72em;
            letter-spacing: 0.5px;
        }
        .configuration-info .config-val {
            font-weight: 600;
            color: #fff;
        }

        /* --- Export to Excel button --- */
        .export-excel-btn {
            background: #1a3d2b;
            color: #fff;
            border: 1.5px solid #1a3d2b;
            padding: 10px 22px;
            border-radius: 8px;
            font-size: 0.9em;
            cursor: pointer;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            transition: background 0.18s ease, color 0.18s ease, border-color 0.18s ease;
        }
        .export-excel-btn:hover {
            background: #e8f5ee;
            color: #1a3d2b;
            border-color: #2e6b45;
        }

        /* --- Final Assembly Card --- */
        .final-assembly {
            background: #fff;
            color: #2D3748;
            padding: 18px 22px;
            border: 1px solid #e0e7ee;
            border-radius: 12px;
            margin-bottom: 16px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        }
        .final-assembly h2 {
            margin: 0 0 10px 0;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            font-size: 1.15em;
            color: #1a3d2b;
            text-shadow: none;
        }
        .assembly-sequence {
            background: #f4faf5;
            padding: 14px;
            border-radius: 10px;
            font-family: 'Fira Code', 'Menlo', 'Monaco', monospace;
            word-break: break-all;
            font-size: 0.82em;
            margin-bottom: 10px;
            border: 1px solid #d4edda;
            color: #1E293B;
            line-height: 1.6;
        }
        .assembly-stats {
            font-family: 'Roboto', sans-serif;
            font-size: 0.9em;
            font-weight: 500;
            color: #1a3d2b;
            background: #e8f5e9;
            padding: 6px 14px;
            border-radius: 20px;
            display: inline-block;
        }

        /* --- Controls / Export Bar --- */
        .content {
            padding: 0;
            background: transparent;
        }
        .controls {
            margin-bottom: 16px;
            padding: 14px 20px;
            background: #fff;
            border-radius: 12px;
            border: 1px solid #e0e7ee;
            box-shadow: 0 2px 6px rgba(0,0,0,0.03);
        }
        .controls .btn-primary {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            font-size: 0.88em;
            border-radius: 8px;
            transition: all 0.3s;
        }
        .controls .btn-primary:hover {
            filter: brightness(1.1);
            box-shadow: 0 2px 10px rgba(37,99,235,0.25);
        }

        /* --- Color Legend --- */
        .color-legend-box {
            background: #1a3d2b;
            padding: 16px 22px;
            border-radius: 14px;
            margin-bottom: 20px;
            border: none;
            box-shadow: 0 4px 16px rgba(26,61,43,0.18);
        }
        .color-legend-box h3 {
            margin: 0 0 10px 0;
            color: #c8e6c9;
            font-family: 'Poppins', sans-serif;
            font-size: 0.9em;
            font-weight: 600;
            letter-spacing: 0.3px;
        }
        .color-legend-box p {
            font-family: 'Roboto', sans-serif;
            color: rgba(255,255,255,0.5) !important;
        }
        .color-legend-box .legend-chip {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 14px;
            border-radius: 20px;
            font-family: 'Poppins', sans-serif;
            font-size: 0.78em;
            font-weight: 500;
            letter-spacing: 0.2px;
            transition: transform 0.2s, box-shadow 0.2s;
            cursor: default;
        }
        .color-legend-box .legend-chip:hover {
            transform: translateY(-1px);
            box-shadow: 0 3px 10px rgba(0,0,0,0.25);
        }
        .legend-chip.chip-trna      { background: #16a34a; color: #fff; }
        .legend-chip.chip-grna      { background: #9333ea; color: #fff; }
        .legend-chip.chip-gg-site   { background: #0ea5e9; color: #fff; border: 1px solid rgba(255,255,255,0.3); }
        .legend-chip.chip-term-site { background: #eab308; color: #1a202c; border: 1px solid rgba(255,255,255,0.3); }
        .legend-chip.chip-internal-site { background: transparent; color: #991b1b; border: 3px solid #ef4444; }
        .legend-chip.chip-polya     { background: #f15bb5; color: #fff; }
        .legend-chip i { font-size: 0.7em; }

        /* --- Section Heading --- */
        .results-container h2.section-heading {
            color: #1a3d2b;
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            margin: 8px 0 16px 0;
            font-size: 1.25em;
            text-shadow: none;
            border-bottom: 2px solid #d4edda;
            padding-bottom: 8px;
            display: inline-block;
        }

        /* --- Module Cards --- */
        .lab-module {
            margin-bottom: 18px;
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #e0e7ee;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            transition: box-shadow 0.3s;
        }
        .lab-module:hover {
            box-shadow: 0 4px 18px rgba(0,0,0,0.09);
        }

        .module-title-bar {
            background: #1a3d2b;
            color: white;
            padding: 10px 18px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: none;
        }

        .module-number {
            font-family: 'Poppins', sans-serif;
            font-size: 0.95em;
            font-weight: 600;
            background: rgba(255,255,255,0.18);
            padding: 3px 12px;
            border-radius: 20px;
            color: white;
        }

        .module-workflow {
            font-family: 'Roboto', sans-serif;
            font-size: 0.82em;
            font-weight: 400;
            color: rgba(255,255,255,0.85);
            letter-spacing: 0.2px;
        }

        .sequence-panel {
            padding: 14px;
            background: #fafcfd;
        }

        .sequences-row {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr 1fr;
            gap: 10px;
        }

        .sequence-card {
            background: #fff;
            border-radius: 10px;
            padding: 10px 12px;
            border: 1px solid #e0e7ee;
            min-width: 0;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .sequence-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.07);
        }

        .forward-seq  { border-left: 4px solid #4A90A4; }
        .reverse-seq  { border-left: 4px solid #5A6B73; }
        .pcr-seq      { border-left: 4px solid #A0AEC0; }
        .digest-seq   { border-left: 4px solid #718096; }

        .seq-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 6px;
            padding-bottom: 5px;
            border-bottom: 1px solid #edf2f7;
        }

        .seq-type {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            font-size: 0.78em;
            color: #1a3d2b;
        }

        .seq-length {
            background: #e2e8f0;
            color: #475569;
            padding: 1px 7px;
            border-radius: 12px;
            font-family: 'Roboto', sans-serif;
            font-size: 0.68em;
            font-weight: 500;
        }

        .seq-display {
            margin-bottom: 2px;
        }

        .dna-sequence {
            background: #f8fafb;
            padding: 8px 10px;
            border-radius: 8px;
            font-family: 'Fira Code', 'Menlo', 'Monaco', monospace;
            font-size: 0.68em;
            color: #1A202C;
            border: 1px solid #edf2f7;
            word-break: break-all;
            display: block;
            width: 100%;
            letter-spacing: 0.5px;
            line-height: 1.55;
            max-height: 110px;
            overflow-y: auto;
        }

        /* --- Primer cards (unused in current layout but kept) --- */
        .module-section  { margin-bottom: 20px; background: #fff; border-radius: 12px; border: 1px solid #e0e7ee; overflow: hidden; }
        .module-header   { background: #4A90A4; color: #fff; padding: 14px 20px; }
        .module-header h3 { margin: 0 0 4px; font-family: 'Poppins', sans-serif; font-size: 1.1em; font-weight: 600; color: #fff; }
        .module-info     { color: rgba(255,255,255,0.9); font-size: 0.85em; }
        .primers-row     { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; padding: 16px; background: #fafcfd; }
        .primer-card     { background: #fff; border: 1px solid #e0e7ee; border-radius: 10px; padding: 14px; }
        .primer-header   { display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px; padding-bottom: 6px; border-bottom: 1px solid #edf2f7; }
        .primer-name     { font-family: 'Poppins', sans-serif; font-weight: 600; color: #1a3d2b; font-size: 0.92em; }
        .primer-type     { color: #6A89A7; font-size: 0.82em; font-family: 'Roboto', sans-serif; }
        .enzyme-badge    { background: #e2e8f0; color: #475569; padding: 2px 8px; border-radius: 12px; font-size: 0.72em; font-weight: 500; }
        .primer-sequence { background: #f8fafb; padding: 10px; border-radius: 8px; font-family: 'Fira Code', 'Menlo', monospace; font-size: 0.8em; word-break: break-all; margin-bottom: 8px; border: 1px solid #edf2f7; color: #2D3748; }
        .primer-info     { font-size: 0.82em; color: #6A89A7; font-family: 'Roboto', sans-serif; }
        .pcr-section     { padding: 16px; background: #fafcfd; }
        .process-card    { margin-bottom: 12px; padding: 14px; background: #fff; border-radius: 10px; border: 1px solid #e0e7ee; }
        .process-card h4 { margin: 0 0 10px; font-family: 'Poppins', sans-serif; color: #1a3d2b; font-weight: 600; font-size: 0.95em; }
        .sequence-display { background: #f8fafb; padding: 12px; border-radius: 8px; font-family: 'Fira Code', 'Menlo', monospace; font-size: 0.82em; word-break: break-all; margin-bottom: 10px; border: 1px solid #edf2f7; color: #1a3d2b; }
        .process-info    { font-size: 0.82em; color: #6A89A7; font-family: 'Roboto', sans-serif; }

        /* --- PTG Sequence Color Coding — Modern Pill Style --- */
        .seq-tRNA { background-color: #16a34a; color: #fff; font-weight: 600; padding: 1px 4px; border-radius: 4px; font-family: 'Fira Code', monospace; }
        .seq-gRNA-scaffold { background-color: #9333ea; color: #fff; font-weight: 600; padding: 1px 4px; border-radius: 4px; font-family: 'Fira Code', monospace; }
        /* Role-based, not enzyme-based: either of the 12 selectable enzymes can hold either role,
           and one enzyme can hold both at once (coloured per role, per position). */
        .seq-gg-site { background-color: #0ea5e9 !important; color: #fff !important; font-weight: 600; padding: 2px 5px; border-radius: 4px; border: 1.5px solid #0284c7 !important; z-index: 15 !important; position: relative; font-family: 'Fira Code', monospace; }
        .seq-term-site { background-color: #eab308 !important; color: #1a202c !important; font-weight: 600; padding: 2px 5px; border-radius: 4px; border: 1.5px solid #ca8a04 !important; z-index: 15 !important; position: relative; font-family: 'Fira Code', monospace; }
        .seq-overhang { color: #0d00a4; font-weight: bold; font-family: 'Fira Code', monospace; }
        /* Internal recognition site: a plain square outline in red
           colour (border-color is set inline per site). It only draws a box around the problem area —
           background and text colour are left untouched so every underlying element stays visible. */
        .seq-internal-site { border: 3px solid #ef4444; border-radius: 0; padding: 1px 0; }
        .seq-polyA { color: #f15bb5; font-weight: 600; font-family: 'Fira Code', monospace; }
        .spacer-tracked { font-weight: bold; font-family: 'Fira Code', monospace; }

        /* --- Responsive --- */
        @media (max-width: 1200px) {
            .sequences-row { grid-template-columns: 1fr 1fr; gap: 10px; }
            .dna-sequence   { font-size: 0.62em; max-height: 100px; }
        }
        @media (max-width: 768px) {
            .sequences-row   { grid-template-columns: 1fr; gap: 10px; }
            .configuration-info { flex-direction: column; gap: 6px; }
            .results-header  { padding: 14px 16px; }
            .final-assembly  { padding: 14px 16px; }
            .sequence-panel  { padding: 10px; }
            .module-title-bar { flex-direction: column; gap: 6px; text-align: center; padding: 12px 16px; }
            .dna-sequence    { font-size: 0.72em; max-height: 140px; }
            .sequence-card   { padding: 8px; }
            .primers-row     { grid-template-columns: 1fr; }
        }
    </style>
    <div class="container-fluid px-md-5">
        <div class="results-container">

        <!-- Compact Header -->
        <div class="results-header">
            <h1><i class="bi bi-diagram-3"></i> Assembly Results — ${results.spacerCount}x Spacer</h1>
            <p>MultiEdit PTG Designer 2.0 &middot; Generated ${new Date().toLocaleDateString('en-GB', { day:'numeric', month:'short', year:'numeric' })}</p>
        </div>

        <!-- Config Info Pill -->
        <div class="configuration-info">
            <span class="config-title"><i class="bi bi-sliders"></i> Design Configuration</span>
            <span class="config-chip"><i class="bi bi-dna"></i> <span class="config-key">Scaffold</span> <span class="config-val">${scaffoldLabel}</span></span>
            <span class="config-chip"><i class="bi bi-scissors"></i> <span class="config-key">Terminal Enzyme</span> <span class="config-val">${termName}</span></span>
            <span class="config-chip"><i class="bi bi-scissors"></i> <span class="config-key">Golden Gate Enzyme</span> <span class="config-val">${ggName}</span></span>

        </div>

        <!-- Final Assembly -->
        <div class="final-assembly">
            <h2><i class="bi bi-layers"></i> ${results.assemblyDetails.finalAssemblyName || 'Final PTG Assembly'} - ${titleStatus}</h2>
            <div class="assembly-sequence">${this.colorCodeSequence(results.finalAssembly, 'final_assembly')}</div>
            <div class="assembly-stats">
                Computed length: ${results.assemblyDetails.totalLength} bp &nbsp;|&nbsp; Expected length: ${results.assemblyDetails.expectedLength} bp &nbsp;${lengthMatch}
            </div>
            ${internalSitesHtml}
        </div>

        <!-- Export + Legend -->
        <div class="content">
            <div class="controls" style="display: flex; gap: 12px; flex-wrap: wrap; align-items: center;">
                <button class="export-excel-btn" onclick="exportToExcel(this)">
                    <i class="bi bi-file-earmark-spreadsheet"></i> Export to Excel
                </button>

                <span style="color: #64748B; font-size: 0.82em; font-family: 'Roboto', sans-serif;">Download primers, PCR products, digests & final assembly as a multi-sheet workbook.</span>
            </div>

            <div class="color-legend-box">
                <h3><i class="bi bi-palette"></i> Sequence Color Legend</h3>
                <div style="display: flex; flex-wrap: wrap; gap: 8px; align-items: center;">
                    <span class="legend-chip chip-trna"><i class="bi bi-circle-fill"></i> tRNA</span>
                    <span class="legend-chip chip-grna"><i class="bi bi-circle-fill"></i> gRNA Scaffold</span>
                    ${spacerLegendChips}
                    <span class="legend-chip chip-term-site"><i class="bi bi-circle-fill"></i> Terminal enzyme &mdash; ${termName} (${termRecog}/${termRecogRC})</span>
                    <span class="legend-chip chip-gg-site"><i class="bi bi-circle-fill"></i> Golden Gate junction &mdash; ${ggName} (${ggRecog}/${ggRecogRC})</span>
                    <span class="legend-chip chip-internal-site"><i class="bi bi-exclamation-triangle-fill"></i> Internal recognition site (error)</span>
                    <span class="legend-chip chip-polya"><i class="bi bi-circle-fill"></i> Poly-A/T Tail</span>
                    <span class="legend-chip" style="background: #0d00a4; color: #fff;"><i class="bi bi-circle-fill"></i> Cas9 Vector Overhang</span>
                </div>
            </div>

            <h2 class="section-heading"><i class="bi bi-grid-3x3-gap"></i> Module Analysis</h2>
            ${moduleSitesHtml}
            ${modulesHTML}
        </div>
    </div>
    
    </div>`;
    }

    showError(message) {
        let errorDiv = document.getElementById('errorMessage');
        if (!errorDiv) {
            errorDiv = document.createElement('div');
            errorDiv.id = 'errorMessage';
            errorDiv.className = 'error-message';
            document.querySelector('.tool-card').appendChild(errorDiv); console.error(message);
        }
        
        errorDiv.innerHTML = `<i class="fas fa-exclamation-triangle"></i> ${message}`;
        errorDiv.style.display = 'flex';
        
        setTimeout(() => {
            errorDiv.style.display = 'none';
        }, 5000);
    }
}

// Export the PTGDesigner class for Node/CommonJS test harnesses (no-op in the browser).
if (typeof module !== "undefined" && module.exports) {
    module.exports = PTGDesigner;
}
