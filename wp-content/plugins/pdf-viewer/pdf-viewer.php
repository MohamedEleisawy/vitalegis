<?php
/**
 * Plugin Name: PDF Viewer
 * Description: A plugin to view PDF files in an iframe.
 * Version: 1.0
 * Author: Your Name
 */

// Register the shortcode
function pdf_viewer_shortcode($atts) {
    $atts = shortcode_atts(
        array(
            'url' => '',
        ),
        $atts,
        'pdf_viewer'
    );

    if (empty($atts['url'])) {
        return '<p style="color: red;">Erreur : URL du PDF manquante</p>';
    }

    // Débogage
    error_log('PDF Viewer - URL: ' . $atts['url']);
    
    // Vérification plus détaillée du fichier
    $file_headers = @get_headers($atts['url']);
    if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
        return '<p style="color: red;">Erreur : Le fichier PDF n\'existe pas à cette URL</p>';
    }

    // Utilisation d'Object pour l'iframe avec taille réduite
    $output = sprintf(
        '<div class="pdf-viewer-wrapper">
            <object data="%1$s" type="application/pdf" width="100%%" height="100%%">
                <iframe src="%1$s" width="100%%" height="100%%" style="border: 1px solid #ddd;">
                    Ce navigateur ne supporte pas les PDF. Veuillez <a href="%1$s">télécharger le PDF</a> pour le visualiser.
                </iframe>
            </object>
        </div>',
        esc_url($atts['url'])
    );

    return $output;
}
add_shortcode('pdf_viewer', 'pdf_viewer_shortcode');

// Enqueue PDF.js
function pdf_viewer_enqueue_scripts() {
    wp_enqueue_script('pdfjs', 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js', array(), null, true);
    wp_enqueue_style('pdf_viewer_style', plugins_url('pdf-viewer.css', __FILE__));
}
add_action('wp_enqueue_scripts', 'pdf_viewer_enqueue_scripts');

