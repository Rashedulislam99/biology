<?php
$pdf = $_GET['file'] ?? '';

if (!$pdf) {
    die("PDF file not specified.");
}

// Sanitize file name
$pdf = basename($pdf);

// PDFs folder
 $pdf_folder = "http://rashedul.intelsofts.com/Biology/pdf";


// Full URL to PDF
$pdf_url = $pdf_folder . $pdf;

// Optional: check if file exists on server
$server_path = __DIR__ . "/pdf/" . $pdf;
if (!file_exists($server_path)) {
    die("PDF file not found.");
}
?>
<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="utf-8">
<title>PDF Viewer — <?= htmlspecialchars($pdf) ?></title>
<style>
  body { margin:0; overflow:hidden; }
  iframe { width:100%; height:100vh; border:none; }
</style>
</head>
<body>

<!-- Embed PDF using PDF.js viewer -->
<iframe 
    src="http://rashedul.intelsofts.com/Biology/pdf/=<?= urlencode($pdf_url) ?>&toolbar=0&navpanes=0&scrollbar=0" 
    allowfullscreen>
</iframe>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){

    // Disable right-click on the iframe
    $("iframe").on("contextmenu", function(e){
        alert("Download is disabled for this PDF!");
        return false;
    });

    // Disable Ctrl+S (save), Ctrl+P (print), Ctrl+Shift+S (save as) keys
    $(document).on("keydown", function(e){
        // Check for Ctrl+S, Ctrl+Shift+S, Ctrl+P
        if ((e.ctrlKey && (e.key === "s" || e.key === "S")) ||
            (e.ctrlKey && e.shiftKey && (e.key === "S")) ||
            (e.ctrlKey && (e.key === "p" || e.key === "P"))) {
            e.preventDefault();
            alert("Saving or printing the PDF is disabled!");
        }
    });

});
</script>

</body>
</html>
