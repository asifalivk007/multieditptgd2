# MultiEdit PTG Designer 2.0

Web-based design tool for **Polycistronic tRNA-gRNA (PTG)** constructs used in
CRISPR-Cas9 multiplex gene editing. It automates spacer-specific primer design,
module PCR product calculation, Golden Gate digestion, and full cassette assembly —
targeting up to **12 genes simultaneously** in a single construct.

Developed at **ICAR-IASRI** in collaboration with **ICAR-IARI**, New Delhi.

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

| Path | Role |
|------|------|
| `index.php` | Landing page, template sequences |
| `tool.php` | Design input form |
| `results.php` | Renders results from `localStorage` |
| `documentation.php` | Methodology, enzyme and output reference |
| `team.php` | Research team and contact |
| `header.php` / `footer.php` | Shared layout, included by every page |
| `assets/js/ptg-designer.js` | Design engine — sequence library, primer/PCR/digest generation, colour coding |
| `assets/js/ptg-export.js` | Excel export (SheetJS) and clipboard helpers |
| `globe-data.php` | Umami analytics feed for the footer visitor globe |

Vendored front-end libraries (Bootstrap, Font Awesome, AOS, PureCounter) live in
`assets/vendor/` and are committed — there is no package manager step.

## Deployment

Apache with PHP and `mod_rewrite`, `mod_headers`, `mod_deflate`, `mod_expires`,
`mod_alias` enabled:

```bash
sudo a2enmod headers rewrite deflate expires alias && sudo systemctl reload apache2
```

Every directive in `.htaccess` is wrapped in `<IfModule>`, so a disabled module
degrades gracefully rather than returning a 500.

### Analytics configuration

The footer visitor globe needs Umami credentials, which are **not** in this
repository. On the server, create the config from the template:

```bash
cp assets/images/others/umami_config.example.php assets/images/others/umami_config.php
```

Then fill in the real values. This file is git-ignored and blocked from web access
by `.htaccess`. Never commit it.

`globe_cache.json` and `city_coords.json` are runtime caches written by
`globe-data.php`; they are git-ignored and regenerate automatically.

## Citation

If you use this tool in published work, please cite the reference in
[`LICENSE`](LICENSE).

## Licence

Copyright (c) 2026 ICAR-IARI and ICAR-IASRI, New Delhi.
Academic and non-commercial research use — see [`LICENSE`](LICENSE).
Data is subject to the [ICAR Data Use Licence](data/ICAR_Data_Use_Licence.pdf).

## Contact

For technical queries and collaborations: **jiqubal@gmail.com**
