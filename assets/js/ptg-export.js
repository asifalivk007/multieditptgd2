/**
 * MultiEdit PTG Designer — export & clipboard utilities.
 * Global functions referenced by onclick handlers in the generated results page
 * (copy buttons and the "Export to Excel" button). Loaded after ptg-designer.js.
 */

function copyToClipboard(element, textareaId = null) {
    let textToCopy;
    
    if (textareaId) {
        textToCopy = document.getElementById(textareaId).value;
    } else if (element.dataset.copy) {
        textToCopy = element.dataset.copy;
    } else {
        return;
    }
    
    navigator.clipboard.writeText(textToCopy).then(() => {
        const originalText = element.innerHTML;
        element.innerHTML = '<i class="fas fa-check"></i> Copied!';
        element.style.background = '#28a745';
        
        setTimeout(() => {
            element.innerHTML = originalText;
            element.style.background = '';
        }, 2000);
    }).catch(err => {
        console.error('Failed to copy: ', err);
        const textArea = document.createElement('textarea');
        textArea.value = textToCopy;
        document.body.appendChild(textArea);
        textArea.select();
        document.execCommand('copy');
        document.body.removeChild(textArea);
    });
}

// Export the current results (stored in localStorage by goToResultsPage) to a
// multi-sheet Excel workbook. Defined as a global so it works on the results page,
// which is rendered by replacing document.body.innerHTML (where injected <script>
// tags never execute). Requires the XLSX (SheetJS) library to be loaded on the page.
function exportToExcel(button) {
    try {
        if (typeof XLSX === 'undefined') {
            alert('Excel library (XLSX) is not loaded on this page.');
            return;
        }

        const stored = localStorage.getItem('ptg_results_data');
        if (!stored) {
            alert('No results available to export. Please generate an assembly first.');
            return;
        }
        const resultsData = JSON.parse(stored);
        const modules = Array.isArray(resultsData.modules) ? resultsData.modules : [];
        const details = resultsData.assemblyDetails || {};
        const ggName = (resultsData.config && (resultsData.config.ggName || resultsData.config.ggId)) || 'BsaI';

        const wb = XLSX.utils.book_new();

        // All Sequences
        const sequenceData = [['Type', 'Module', 'Name', 'DNA Sequence', 'Length']];
        modules.forEach((module, index) => {
            const label = 'Module ' + (module.moduleNumber || index + 1);
            if (module.forward?.sequence) sequenceData.push(['Forward Primer', label, module.forward.name || 'Fw', module.forward.sequence, module.forward.sequence.length]);
            if (module.reverse?.sequence) sequenceData.push(['Reverse Primer', label, module.reverse.name || 'Rw', module.reverse.sequence, module.reverse.sequence.length]);
            if (module.pcr?.sequence) sequenceData.push(['PCR Product', label, module.pcr.name || 'PCR', module.pcr.sequence, module.pcr.sequence.length]);
            if (module.digest?.sequence) sequenceData.push([`${ggName} Digest`, label, module.digest.name || 'Digest', module.digest.sequence, module.digest.sequence.length]);
        });
        const finalSeq = resultsData.finalAssembly || resultsData.goldenGateAssembly || '';
        if (finalSeq) sequenceData.push(['Final Assembly', 'ALL', 'Complete Assembly', finalSeq, finalSeq.length]);
        XLSX.utils.book_append_sheet(wb, XLSX.utils.aoa_to_sheet(sequenceData), 'All Sequences');

        // Summary
        const summaryData = [
            ['MultiEdit PTG Designer - Results'],
            ['Generated: ' + new Date().toLocaleString()],
            [''],
            ['Configuration', (resultsData.spacerCount || 0) + 'x Spacers'],
            ['Cas9 Vector Overhangs', `${resultsData.config?.overhangType || 'Default'} (F1: ${resultsData.config?.overhangF1 || 'ATTG'}, R_final: ${resultsData.config?.overhangR || 'AAAC'})`],
            ['Input Spacers', (resultsData.spacers || []).join(', ')],
            [''],
            ['Total Sequences Exported', sequenceData.length - 1],
            [''],
            ['Final Assembly Length', (finalSeq ? finalSeq.length : 0) + ' bp'],
            ['Expected Length', (details.expectedLength || 0) + ' bp']
        ];
        XLSX.utils.book_append_sheet(wb, XLSX.utils.aoa_to_sheet(summaryData), 'Summary');

        // All Primers
        const primerData = [['Module', 'Primer Name', 'Type', 'Enzyme', 'DNA Sequence', 'Length', 'Details']];
        modules.forEach(module => {
            const label = 'Module ' + module.moduleNumber;
            primerData.push([label, module.forward.name || '', module.forward.type || '', module.forward.enzyme || '', String(module.forward.sequence || ''), String(module.forward.length || 0), module.forward.gRNA_12e ? ('12e_gRNA: ' + module.forward.gRNA_12e) : 'Initial primer']);
            primerData.push([label, module.reverse.name || '', module.reverse.type || '', module.reverse.enzyme || '', String(module.reverse.sequence || ''), String(module.reverse.length || 0), module.reverse.gRNA_12s ? ('12s_gRNA: ' + module.reverse.gRNA_12s + ' → RevComp: ' + (module.reverse.revComp || '')) : 'Final primer']);
        });
        XLSX.utils.book_append_sheet(wb, XLSX.utils.aoa_to_sheet(primerData), 'All Primers');

        // PCR Products
        const pcrData = [['Module', 'PCR Name', 'PCR DNA Sequence', 'Length', 'Forward Primer', 'Reverse Primer']];
        modules.forEach(module => {
            pcrData.push(['Module ' + module.moduleNumber, module.pcr.name || '', String(module.pcr.sequence || ''), String(module.pcr.length || 0), module.pcr.forwardPrimer || '', module.pcr.reversePrimer || '']);
        });
        XLSX.utils.book_append_sheet(wb, XLSX.utils.aoa_to_sheet(pcrData), 'PCR Products');

        // Golden Gate digests (named after the selected GG enzyme)
        const digestData = [['Module', 'Digest Name', `${ggName} Digest Sequence`, 'Length', 'Extraction Method', 'Source PCR']];
        modules.forEach(module => {
            digestData.push(['Module ' + module.moduleNumber, module.digest.name || '', String(module.digest.sequence || ''), String(module.digest.length || 0), module.digest.extractionMethod || '', module.digest.source || module.pcr.name || '']);
        });
        XLSX.utils.book_append_sheet(wb, XLSX.utils.aoa_to_sheet(digestData), `${ggName} Digests`);

        // Complete Workflow
        const assemblyData = [['Step', 'Module', 'Component', 'Name', 'Complete DNA Sequence', 'Length']];
        modules.forEach(module => {
            const label = 'Module ' + module.moduleNumber;
            assemblyData.push(['1. Forward Primer', label, 'Primer', module.forward.name || '', String(module.forward.sequence || ''), String(module.forward.length || 0)]);
            assemblyData.push(['2. Reverse Primer', label, 'Primer', module.reverse.name || '', String(module.reverse.sequence || ''), String(module.reverse.length || 0)]);
            assemblyData.push(['3. PCR Product', label, 'PCR', module.pcr.name || '', String(module.pcr.sequence || ''), String(module.pcr.length || 0)]);
            assemblyData.push([`4. ${ggName} Digest`, label, 'Digest', module.digest.name || '', String(module.digest.sequence || ''), String(module.digest.length || 0)]);
            assemblyData.push(['', '', '', '', '', '']);
        });
        if (finalSeq) assemblyData.push(['5. Final Assembly', 'ALL MODULES', 'Complete', details.finalAssemblyName || '', String(finalSeq), String(details.totalLength || 0)]);
        XLSX.utils.book_append_sheet(wb, XLSX.utils.aoa_to_sheet(assemblyData), 'Complete Workflow');

        // Final Assembly
        const finalData = [
            ['Property', 'Value'],
            ['Configuration', (resultsData.spacerCount || 0) + 'x Spacers'],
            ['Cas9 Vector Overhangs', `${resultsData.config?.overhangType || 'Default'} (F1: ${resultsData.config?.overhangF1 || 'ATTG'}, R_final: ${resultsData.config?.overhangR || 'AAAC'})`],
            ['Input Spacers', (resultsData.spacers || []).join(', ')],
            ['Assembly Name', details.finalAssemblyName || ''],
            ['Total Length (bp)', String(details.totalLength || 0)],
            ['Expected Length (bp)', String(details.expectedLength || 0)],
            ['Length Match', details.totalLength === details.expectedLength ? 'YES ✓' : 'NO ⚠️'],
            [''],
            ['COMPLETE FINAL ASSEMBLY SEQUENCE'],
            [String(finalSeq || 'No final assembly sequence available')]
        ];
        XLSX.utils.book_append_sheet(wb, XLSX.utils.aoa_to_sheet(finalData), 'Final Assembly');

        const fileName = 'MultiEdit_PTG_Results_' + (resultsData.spacerCount || 'x') + 'x_' + new Date().toISOString().slice(0, 10) + '.xlsx';
        XLSX.writeFile(wb, fileName);

        if (button) {
            const originalText = button.innerHTML;
            button.innerHTML = '✓ Excel Downloaded!';
            // Text-only confirmation — no background change, so the CSS hover state stays intact.
            setTimeout(() => {
                button.innerHTML = originalText;
            }, 3000);
        }
    } catch (error) {
        console.error('Excel export failed:', error);
        alert('Error exporting to Excel: ' + error.message);
    }
}
