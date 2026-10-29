<?php
/**
 * NovaSaaS Theme Functions
 *
 * @package NovaSaaS
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

// Theme version constant.
define( 'NOVASAAS_VERSION', wp_get_theme()->get( 'Version' ) );
define( 'NOVASAAS_DIR', get_template_directory() );
define( 'NOVASAAS_URI', get_template_directory_uri() );
define( 'NOVASAAS_INC', NOVASAAS_DIR . '/inc/' );

// Core includes.
require_once NOVASAAS_INC . 'helpers.php';
require_once NOVASAAS_INC . 'class-theme-setup.php';
require_once NOVASAAS_INC . 'class-assets.php';
require_once NOVASAAS_INC . 'class-customizer.php';
require_once NOVASAAS_INC . 'class-walker-nav.php';
require_once NOVASAAS_INC . 'class-ajax-handler.php';
require_once NOVASAAS_INC . 'class-demo-import.php';
require_once NOVASAAS_INC . 'template-tags.php';
require_once NOVASAAS_DIR . '/tgm/class-tgm-plugin-activation.php';

// Boot OOP classes.
NovaSaaS_Theme_Setup::init();
NovaSaaS_Assets::init();
NovaSaaS_Customizer::init();
NovaSaaS_Demo_Import::init();
new NovaSaaS_Ajax_Handler();

/**
 * Register required and recommended plugins via TGMPA.
 */
function novasaas_register_required_plugins() {
	$plugins = array(
		array(
			'name'     => 'Elementor',
			'slug'     => 'elementor',
			'required' => true,
		),
		array(
			'name'     => 'One Click Demo Import',
			'slug'     => 'one-click-demo-import',
			'required' => true,
		),
		array(
			'name'     => 'Contact Form 7',
			'slug'     => 'contact-form-7',
			'required' => false,
		),
		array(
			'name'     => 'WooCommerce',
			'slug'     => 'woocommerce',
			'required' => false,
		),
	);

	$config = array(
		'id'           => 'novasaas',
		'default_path' => '',
		'menu'         => 'tgmpa-install-plugins',
		'parent_slug'  => 'themes.php',
		'capability'   => 'edit_theme_options',
		'has_notices'  => true,
		'dismissable'  => true,
		'dismiss_msg'  => '',
		'is_automatic' => false,
		'message'      => '',
	);

	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'novasaas_register_required_plugins' );

/**
 * Theme setup — add_theme_support, nav menus, sidebars, image sizes.
 * Kept here as a thin bootstrap; full logic lives in NovaSaaS_Theme_Setup.
 */
function novasaas_setup() {
	load_theme_textdomain( 'novasaas', NOVASAAS_DIR . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'dark-editor-style' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
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
			'navigation-widgets',
		)
	);
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 60,
			'width'       => 200,
			'flex-height' => true,
			'flex-width'  => true,
			'header-text' => array( 'site-title', 'site-description' ),
		)
	);
	add_theme_support(
		'editor-color-palette',
		array(
			array(
				'name'  => esc_html__( 'Primary (Indigo)', 'novasaas' ),
				'slug'  => 'novasaas-primary',
				'color' => '#6366F1',
			),
			array(
				'name'  => esc_html__( 'Secondary (Pink)', 'novasaas' ),
				'slug'  => 'novasaas-secondary',
				'color' => '#EC4899',
			),
			array(
				'name'  => esc_html__( 'Accent (Cyan)', 'novasaas' ),
				'slug'  => 'novasaas-accent',
				'color' => '#06B6D4',
			),
			array(
				'name'  => esc_html__( 'Dark Background', 'novasaas' ),
				'slug'  => 'novasaas-dark',
				'color' => '#0F0A1E',
			),
			array(
				'name'  => esc_html__( 'Light Text', 'novasaas' ),
				'slug'  => 'novasaas-text',
				'color' => '#F8FAFC',
			),
		)
	);
	add_theme_support(
		'custom-header',
		array(
			'default-image' => '',
			'width'         => 1920,
			'height'        => 1080,
			'flex-width'    => true,
			'flex-height'   => true,
		)
	);
	add_theme_support( 'custom-background', array( 'default-color' => '0F0A1E' ) );
	add_theme_support( 'editor-styles' );
	add_editor_style( 'assets/css/editor-style.css' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'wp-block-styles' );

	register_nav_menus(
		array(
			'primary-menu' => esc_html__( 'Primary Menu', 'novasaas' ),
			'footer-menu'  => esc_html__( 'Footer Menu', 'novasaas' ),
			'mobile-menu'  => esc_html__( 'Mobile Menu', 'novasaas' ),
		)
	);

	// Custom image sizes.
	add_image_size( 'novasaas-hero',  1920, 1080, false );
	add_image_size( 'novasaas-blog',  800,  500,  true  );
	add_image_size( 'novasaas-team',  400,  400,  true  );
	add_image_size( 'novasaas-thumb', 600,  400,  true  );

	// Content width.
	if ( ! isset( $content_width ) ) {
		$GLOBALS['content_width'] = 1280;
	}
}
add_action( 'after_setup_theme', 'novasaas_setup' );

/**
 * Register widget areas / sidebars.
 */
function novasaas_widgets_init() {
	$shared_args = array(
		'before_widget' => '<div id="%1$s" class="widget novasaas-glass-card %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title novasaas-gradient-text">',
		'after_title'   => '</h3>',
	);

	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name'        => esc_html__( 'Main Sidebar', 'novasaas' ),
				'id'          => 'novasaas-sidebar',
				'description' => esc_html__( 'Main sidebar widget area.', 'novasaas' ),
			)
		)
	);

	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name'        => esc_html__( 'Blog Sidebar', 'novasaas' ),
				'id'          => 'novasaas-blog-sidebar',
				'description' => esc_html__( 'Blog page sidebar widget area.', 'novasaas' ),
			)
		)
	);

	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name'        => esc_html__( 'Footer Column 1', 'novasaas' ),
				'id'          => 'novasaas-footer-1',
				'description' => esc_html__( 'Footer first column widget area.', 'novasaas' ),
			)
		)
	);

	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name'        => esc_html__( 'Footer Column 2', 'novasaas' ),
				'id'          => 'novasaas-footer-2',
				'description' => esc_html__( 'Footer second column widget area.', 'novasaas' ),
			)
		)
	);

	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name'        => esc_html__( 'Footer Column 3', 'novasaas' ),
				'id'          => 'novasaas-footer-3',
				'description' => esc_html__( 'Footer third column widget area.', 'novasaas' ),
			)
		)
	);
}
add_action( 'widgets_init', 'novasaas_widgets_init' );

/**
 * Enqueue front-end scripts and styles.
 * Full logic delegated to NovaSaaS_Assets.
 */
function novasaas_scripts() {
	// Google Fonts preconnect.
	wp_enqueue_style(
		'novasaas-fonts-preconnect',
		'https://fonts.googleapis.com',
		array(),
		null
	);
	wp_enqueue_style(
		'novasaas-fonts-preconnect-cross',
		'https://fonts.gstatic.com',
		array(),
		null
	);

	// Google Fonts stylesheet.
	wp_enqueue_style(
		'novasaas-google-fonts',
		add_query_arg(
			array(
				'family'  => 'Plus+Jakarta+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400&Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&display=swap',
				'display' => 'swap',
			),
			'https://fonts.googleapis.com/css2'
		),
		array( 'novasaas-fonts-preconnect' ),
		null
	);

	// Main theme stylesheet (style.css).
	wp_enqueue_style(
		'novasaas-style',
		get_stylesheet_uri(),
		array( 'novasaas-google-fonts' ),
		NOVASAAS_VERSION
	);

	// Main theme script.
	wp_enqueue_script(
		'novasaas-theme',
		NOVASAAS_URI . '/assets/js/theme.js',
		array(),
		NOVASAAS_VERSION,
		array(
			'strategy'  => 'defer',
			'in_footer' => true,
		)
	);

	wp_localize_script(
		'novasaas-theme',
		'novasaas_ajax',
		array(
			'ajax_url' => esc_url( admin_url( 'admin-ajax.php' ) ),
			'nonce'    => wp_create_nonce( 'novasaas_ajax_nonce' ),
			'is_home'  => is_front_page() ? '1' : '0',
			'site_url' => esc_url( home_url( '/' ) ),
		)
	);

	// Comment reply script.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'novasaas_scripts' );

/**
 * Add preconnect resource hints for Google Fonts in <head>.
 *
 * @param array  $urls          URLs to print for resource hints.
 * @param string $relation_type The relation type the URLs are printed for.
 * @return array
 */
function novasaas_resource_hints( array $urls, string $relation_type ): array {
	if ( 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href'        => 'https://fonts.googleapis.com',
			'crossorigin' => '',
		);
		$urls[] = array(
			'href'        => 'https://fonts.gstatic.com',
			'crossorigin' => 'anonymous',
		);
	}
	return $urls;
}
add_filter( 'wp_resource_hints', 'novasaas_resource_hints', 10, 2 );

/**
 * Add crossorigin attribute to Google Fonts link tags.
 *
 * @param string $tag    The link tag HTML.
 * @param string $handle The style handle.
 * @return string
 */
function novasaas_fonts_crossorigin( string $tag, string $handle ): string {
	if ( 'novasaas-fonts-preconnect-cross' === $handle ) {
		return str_replace( 'rel=', 'crossorigin rel=', $tag );
	}
	return $tag;
}
add_filter( 'style_loader_tag', 'novasaas_fonts_crossorigin', 10, 2 );

/**
 * Filter image sizes list in media library.
 *
 * @param array $sizes Default image size names.
 * @return array
 */
function novasaas_custom_image_sizes( array $sizes ): array {
	return array_merge(
		$sizes,
		array(
			'novasaas-hero'  => esc_html__( 'NovaSaaS Hero (1920×1080)', 'novasaas' ),
			'novasaas-blog'  => esc_html__( 'NovaSaaS Blog (800×500)', 'novasaas' ),
			'novasaas-team'  => esc_html__( 'NovaSaaS Team (400×400)', 'novasaas' ),
			'novasaas-thumb' => esc_html__( 'NovaSaaS Thumbnail (600×400)', 'novasaas' ),
		)
	);
}
add_filter( 'image_size_names_choose', 'novasaas_custom_image_sizes' );
