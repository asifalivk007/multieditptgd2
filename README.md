# MultiEdit PTG Designer 2.0

Web-based design tool for **Polycistronic tRNA-gRNA (PTG)** constructs used in
CRISPR-Cas9 multiplex gene editing. It automates spacer-specific primer design,
module PCR product calculation, Golden Gate digestion, and full cassette assembly —
targeting up to **12 genes simultaneously** in a single construct.

Developed by **ICAR-IARI**, New Delhi and **ICAR-IASRI**, New Delhi.

🔗 **Live:** https://multieditptgd2.abrl.in

---

## Features

- **2–12 spacers** per polycistronic cassette
- **12 Type IIS restriction enzymes** — BsaI, BbsI, Esp3I, BsmBI, BtgZI, BspMI,
  FokI, PaqCI, SfaNI, BbvI, BfuAI, BsmFI
- **Two gRNA scaffolds** — native (76 nt) and engineered (86 nt), the latter with an
  extended tetraloop stem and removed premature-transcription poly-A stretch
- **Independent enzyme selection** — a terminal enzyme (default *FokI*) for the first
  and last modules, and a Golden Gate enzyme (default *BsaI*) joining internal modules
- **Configurable Cas9 vector overhangs** — default (ATTG / AAAC) or custom 4 bp
- **Internal recognition site detection** — flags enzyme sites that would misfire
  during assembly, outlined directly in the rendered sequence
- **Colour-tracked sequences** — each spacer keeps one colour across primers, PCR
  products, digests and the final assembly
- **Excel export** — multi-sheet workbook of primers, PCR products, digests and
  the complete assembly

## Usage

1. Open the **Tool** page and choose a spacer count (2–12)
2. Select the gRNA scaffold, terminal enzyme and Golden Gate enzyme
3. Configure the Cas9 plasmid vector overhang (default or custom)
4. Enter your 20 bp spacer sequences (A, T, G, C only)
5. Click **Generate Assembly** — results render on the results page
6. Export to Excel for synthesis

Use **Load Example** to explore a pre-filled design.

## Tech stack

Plain PHP includes with vanilla JavaScript — no framework, no build step.

## Citation

If you use this tool in published work, please cite:

"Paper to be published, v2"

## Licence

Copyright (c) 2026 ICAR-IARI, New Delhi and ICAR-IASRI, New Delhi.
Academic and non-commercial research use — see [`LICENSE`](LICENSE).

## Contact

For technical queries and collaborations: **jiqubal@gmail.com**
