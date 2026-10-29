<?php
/**
 * Theme Setup Class
 *
 * @package NovaSaaS
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Handles core theme setup: supports, menus, sidebars, image sizes.
 */
class NovaSaaS_Theme_Setup {

	/**
	 * Bootstrap all hooks — call once from functions.php.
	 */
	public static function init(): void {
		add_action( 'after_setup_theme', array( __CLASS__, 'add_theme_supports' ), 5 );
		add_action( 'after_setup_theme', array( __CLASS__, 'register_nav_menus' ), 5 );
		add_action( 'after_setup_theme', array( __CLASS__, 'add_image_sizes' ), 5 );
		add_action( 'widgets_init',      array( __CLASS__, 'register_sidebars' ) );
		add_filter( 'body_class',        array( __CLASS__, 'body_classes' ) );
		add_filter( 'excerpt_length',    array( __CLASS__, 'excerpt_length' ), 99 );
		add_filter( 'excerpt_more',      array( __CLASS__, 'excerpt_more' ) );
	}

	/**
	 * Register all add_theme_support() declarations.
	 */
	public static function add_theme_supports(): void {
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'dark-editor-style' );
		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'align-wide' );
		add_theme_support( 'wp-block-styles' );
		add_theme_support( 'editor-styles' );
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
			'custom-header',
			array(
				'default-image' => '',
				'width'         => 1920,
				'height'        => 1080,
				'flex-width'    => true,
				'flex-height'   => true,
			)
		);

		add_theme_support(
			'custom-background',
			array( 'default-color' => '0F0A1E' )
		);

		add_theme_support(
			'editor-color-palette',
			array(
				array(
					'name'  => esc_html__( 'Primary Indigo', 'novasaas' ),
					'slug'  => 'novasaas-primary',
					'color' => '#6366F1',
				),
				array(
					'name'  => esc_html__( 'Secondary Pink', 'novasaas' ),
					'slug'  => 'novasaas-secondary',
					'color' => '#EC4899',
				),
				array(
					'name'  => esc_html__( 'Accent Cyan', 'novasaas' ),
					'slug'  => 'novasaas-accent',
					'color' => '#06B6D4',
				),
				array(
					'name'  => esc_html__( 'Dark Background', 'novasaas' ),
					'slug'  => 'novasaas-dark',
					'color' => '#0F0A1E',
				),
				array(
					'name'  => esc_html__( 'Card Background', 'novasaas' ),
					'slug'  => 'novasaas-card',
					'color' => '#1A1530',
				),
				array(
					'name'  => esc_html__( 'Light Text', 'novasaas' ),
					'slug'  => 'novasaas-text',
					'color' => '#F8FAFC',
				),
				array(
					'name'  => esc_html__( 'Muted Text', 'novasaas' ),
					'slug'  => 'novasaas-muted',
					'color' => '#94A3B8',
				),
				array(
					'name'  => esc_html__( 'Success Green', 'novasaas' ),
					'slug'  => 'novasaas-success',
					'color' => '#10B981',
				),
			)
		);

		add_theme_support(
			'editor-font-sizes',
			array(
				array(
					'name' => esc_html__( 'Small', 'novasaas' ),
					'size' => 13,
					'slug' => 'small',
				),
				array(
					'name' => esc_html__( 'Normal', 'novasaas' ),
					'size' => 16,
					'slug' => 'normal',
				),
				array(
					'name' => esc_html__( 'Large', 'novasaas' ),
					'size' => 20,
					'slug' => 'large',
				),
				array(
					'name' => esc_html__( 'Huge', 'novasaas' ),
					'size' => 28,
					'slug' => 'huge',
				),
			)
		);

		// Load text domain.
		load_theme_textdomain( 'novasaas', NOVASAAS_DIR . '/languages' );

		// Set global content width.
		if ( ! isset( $GLOBALS['content_width'] ) ) {
			$GLOBALS['content_width'] = 1280;
		}
	}

	/**
	 * Register navigation menu locations.
	 */
	public static function register_nav_menus(): void {
		\register_nav_menus(
			array(
				'primary-menu' => esc_html__( 'Primary Navigation', 'novasaas' ),
				'footer-menu'  => esc_html__( 'Footer Navigation', 'novasaas' ),
				'mobile-menu'  => esc_html__( 'Mobile Navigation', 'novasaas' ),
			)
		);
	}

	/**
	 * Register custom image sizes.
	 */
	public static function add_image_sizes(): void {
		add_image_size( 'novasaas-hero',  1920, 1080, false );
		add_image_size( 'novasaas-blog',  800,  500,  true  );
		add_image_size( 'novasaas-team',  400,  400,  true  );
		add_image_size( 'novasaas-thumb', 600,  400,  true  );
	}

	/**
	 * Register widget sidebar areas.
	 */
	public static function register_sidebars(): void {
		$shared = array(
			'before_widget' => '<div id="%1$s" class="widget novasaas-glass-card novasaas-widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		);

		$areas = array(
			array(
				'name'        => esc_html__( 'Main Sidebar', 'novasaas' ),
				'id'          => 'novasaas-sidebar',
				'description' => esc_html__( 'Primary sidebar widget area, appears on pages with a sidebar layout.', 'novasaas' ),
			),
			array(
				'name'        => esc_html__( 'Blog Sidebar', 'novasaas' ),
				'id'          => 'novasaas-blog-sidebar',
				'description' => esc_html__( 'Sidebar for the blog archive and single post pages.', 'novasaas' ),
			),
			array(
				'name'        => esc_html__( 'Footer Column 1', 'novasaas' ),
				'id'          => 'novasaas-footer-1',
				'description' => esc_html__( 'First footer column widget area.', 'novasaas' ),
			),
			array(
				'name'        => esc_html__( 'Footer Column 2', 'novasaas' ),
				'id'          => 'novasaas-footer-2',
				'description' => esc_html__( 'Second footer column widget area.', 'novasaas' ),
			),
			array(
				'name'        => esc_html__( 'Footer Column 3', 'novasaas' ),
				'id'          => 'novasaas-footer-3',
				'description' => esc_html__( 'Third footer column widget area.', 'novasaas' ),
			),
		);

		foreach ( $areas as $area ) {
			register_sidebar( array_merge( $shared, $area ) );
		}
	}

	/**
	 * Add custom CSS classes to <body>.
	 *
	 * @param array $classes Existing body classes.
	 * @return array
	 */
	public static function body_classes( array $classes ): array {
		// Always add theme slug.
		$classes[] = 'novasaas-theme';

		// Elementor detection.
		if ( did_action( 'elementor/loaded' ) ) {
			$classes[] = 'novasaas-has-elementor';
		}

		// Sidebar presence.
		if ( is_active_sidebar( 'novasaas-sidebar' ) && ! is_page_template( 'templates/template-full-width.php' ) ) {
			$classes[] = 'novasaas-has-sidebar';
		} else {
			$classes[] = 'novasaas-no-sidebar';
		}

		// Single post.
		if ( is_singular( 'post' ) ) {
			$classes[] = 'novasaas-single-post';
		}

		// Front page.
		if ( is_front_page() ) {
			$classes[] = 'novasaas-front-page';
		}

		return array_unique( $classes );
	}

	/**
	 * Set custom excerpt word length.
	 *
	 * @param int $length Default excerpt length.
	 * @return int
	 */
	public static function excerpt_length( int $length ): int {
		return 30;
	}

	/**
	 * Replace default excerpt "more" string.
	 *
	 * @param string $more Default more string.
	 * @return string
	 */
	public static function excerpt_more( string $more ): string {
		return '&hellip;';
	}
}
