<?php
/**
 * Plugin Name: WP PDF Viewer
 * Description: Plugin pour visualiser et générer des PDF
 * Version: 1.0.0
 * Author: Votre Nom
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Define plugin constants
define('WP_PDF_VIEWER_PATH', plugin_dir_path(__FILE__));
define('WP_PDF_VIEWER_URL', plugin_dir_url(__FILE__));

// Include required files
require_once WP_PDF_VIEWER_PATH . 'includes/class-pdf-viewer.php';

// Initialize the plugin
function wp_pdf_viewer_init() {
    $pdf_viewer = new PDF_Viewer();
    $pdf_viewer->init();
}
add_action('plugins_loaded', 'wp_pdf_viewer_init');