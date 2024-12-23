<div class="pdf-viewer-container">
    <div id="pdf-viewer"></div>
    <div class="pdf-controls">
        <button id="prev">Précédent</button>
        <button id="next">Suivant</button>
        <span>Page: <span id="page-num"></span> / <span id="page-count"></span></span>
    </div>
</div>

<script>
pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.6.347/pdf.worker.min.js';

// Code JavaScript pour charger et afficher le PDF
var url = '<?php echo esc_url($atts['url']); ?>';
var pdfDoc = null,
    pageNum = 1,
    pageRendering = false,
    pageNumPending = null,
    scale = 1.5,
    canvas = document.createElement('canvas'),
    ctx = canvas.getContext('2d');

document.getElementById('pdf-viewer').appendChild(canvas);
</script>