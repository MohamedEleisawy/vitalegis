<?php
class PDF_Viewer {
    public function init() {
        // Register hooks
        add_action('admin_menu', array($this, 'add_admin_menu'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
        add_shortcode('pdf_viewer', array($this, 'pdf_viewer_shortcode'));
    }

    public function add_admin_menu() {
        add_menu_page(
            'PDF Viewer',
            'PDF Viewer',
            'manage_options',
            'pdf-viewer',
            array($this, 'admin_page'),
            'dashicons-pdf'
        );
    }

    public function enqueue_scripts() {
        wp_enqueue_script('pdf-js', 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.6.347/pdf.min.js');
        wp_enqueue_style('pdf-viewer-style', WP_PDF_VIEWER_URL . 'assets/css/style.css');
    }

    public function pdf_viewer_shortcode($atts) {
        $atts = shortcode_atts(array(
            'url' => '',
        ), $atts);

        ob_start();
        include WP_PDF_VIEWER_PATH . 'templates/viewer.php';
        return ob_get_clean();
    }

    public function admin_page() {
        include WP_PDF_VIEWER_PATH . 'templates/admin.php';
    }
}