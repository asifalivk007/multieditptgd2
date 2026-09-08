<?php

$active_page = "tool";
// Results render purely from client-side data (empty when crawled) — keep it out of the index.
$page_robots = "noindex, follow";
$extra_scripts = '
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script src="assets/js/ptg-designer.js?v=5.11"></script>
<script src="assets/js/ptg-export.js?v=5.3"></script>
<script src="assets/js/ptg-app.js?v=5.0"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const resultsDataStr = localStorage.getItem("ptg_results_data");
        const resultsContainer = document.getElementById("resultsMainContainer");
        
        if (!resultsDataStr) {
            resultsContainer.innerHTML = \'<div class="container py-5 text-center"><div class="card border-0 shadow-sm p-5 mx-auto" style="max-width:500px; border-radius:16px;"><i class="bi bi-exclamation-triangle" style="font-size:3rem; color:#e67e22;"></i><h3 class="mt-3" style="font-family:Poppins,sans-serif; color:#1a3d2b;">No Results Found</h3><p class="text-muted" style="font-family:Roboto,sans-serif;">Please go back to the Tool page to generate an assembly.</p><a href="tool.php" class="btn mt-2" style="background:#1a7a3c; color:#fff; border-radius:8px; font-family:Poppins,sans-serif; font-weight:600; padding:10px 28px;"><i class="bi bi-arrow-left"></i> Back to Tool</a></div></div>\';
            return;
        }
        
        try {
            const results = JSON.parse(resultsDataStr);
            const designer = new PTGDesigner();
            const html = designer.generateResultsHTML(results);
            resultsContainer.innerHTML = html;
        } catch(e) {
            resultsContainer.innerHTML = \'<div class="container py-5 text-center"><div class="card border-0 shadow-sm p-5 mx-auto" style="max-width:500px; border-radius:16px;"><i class="bi bi-bug" style="font-size:3rem; color:#e74c3c;"></i><h3 class="mt-3" style="font-family:Poppins,sans-serif; color:#1a3d2b;">Error Loading Results</h3><p class="text-muted" style="font-family:Roboto,sans-serif;">\' + e.message + \'</p><a href="tool.php" class="btn mt-2" style="background:#1a7a3c; color:#fff; border-radius:8px; font-family:Poppins,sans-serif; font-weight:600; padding:10px 28px;"><i class="bi bi-arrow-left"></i> Back to Tool</a></div></div>\';
        }
    });
</script>
';
include 'header.php';
?>

<main class="main" style="padding: 16px 0 30px; background: #f0f7f4; min-height: 70vh;">
    <div id="resultsMainContainer">
        <div class="container text-center py-4">
            <div class="spinner-border" role="status" style="color: #1a7a3c; width: 2.5rem; height: 2.5rem;">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mt-2" style="font-family: 'Roboto', sans-serif; color: #555; font-size: 0.9em;">Loading assembly results...</p>
        </div>
    </div>
</main>

<?php include 'footer.php'; ?>
