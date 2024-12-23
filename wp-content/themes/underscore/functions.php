<?php
/**
 * underscore functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package underscore
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function underscore_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on underscore, use a find and replace
		* to change 'underscore' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'underscore', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'underscore' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'underscore_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'underscore_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function underscore_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'underscore_content_width', 640 );
}
add_action( 'after_setup_theme', 'underscore_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function underscore_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'underscore' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'underscore' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'underscore_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function underscore_scripts() {
	// wp_enqueue_style( 'underscore-style', get_stylesheet_uri(), array(), _S_VERSION );

	wp_enqueue_style('underscore-style', get_stylesheet_uri(), array(), _S_VERSION);
	wp_style_add_data( 'underscore-style', 'rtl', 'replace' );

	wp_enqueue_script( 'underscore-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'underscore_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}



function my_theme_add_editor_styles(): void {
    // Chargez le fichier CSS de l'éditeur
    add_editor_style(stylesheet: './style.css');
}
add_action(hook_name: 'admin_init', callback: 'my_theme_add_editor_styles');

function underscores_widgets_init() {
    register_sidebar(array(
        'name'          => __('Sidebar principale', 'underscores'),
        'id'            => 'sidebar-1',
        'description'   => __('Ajoutez des widgets ici.', 'underscores'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
}
add_action('widgets_init', 'underscores_widgets_init');


function register_index_template() {
    add_filter('theme_page_templates', function($templates) {
        $templates['index.php'] = 'index Page';
        return $templates;
    });
}
add_action('init', 'register_index_template');

function vitalegis_enqueue_assets() {
    // Tailwind via CDN
    wp_enqueue_script('tailwind', 'https://cdn.tailwindcss.com', [], null, true);

    // Autres styles et scripts
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Fredoka:wght@300..700&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap', [], null);
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css', [], null);
}
add_action('wp_enqueue_scripts', 'vitalegis_enqueue_assets');

// Permettre à l'administrateur de définir l'image de bannière via le Customizer :


// charger ce fichier js
function vitalegis_enqueue_scripts() {
    wp_enqueue_script(
        'custom-js',
        get_template_directory_uri() . '/assets/js/custom.js',
        [],
        false,
        true
    );
}
add_action('wp_enqueue_scripts', 'vitalegis_enqueue_scripts');


function vitalegis_custom_login_page() {
    // Utilisation d'un modèle personnalisé pour la page de connexion
    if( is_page('connexion') ) {
        include( get_template_directory() . '/page-connexion.php' ); // page-login.php doit être un fichier dans votre dossier thème
        exit;
    }
}
add_action('template_redirect', 'vitalegis_custom_login_page');


