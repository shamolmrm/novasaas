<?php
/**
 * Asset Enqueuing Class
 *
 * @package NovaSaaS
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Manages all front-end and block-editor asset enqueueing.
 */
class NovaSaaS_Assets {

	/**
	 * Google Fonts URL components.
	 */
	private const FONTS_API      = 'https://fonts.googleapis.com/css2';
	private const FONTS_FAMILIES = 'Plus+Jakarta+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&display=swap';

	/**
	 * Register all hooks.
	 */
	public static function init(): void {
		add_action( 'wp_enqueue_scripts',    array( __CLASS__, 'enqueue_styles' ) );
		add_action( 'wp_enqueue_scripts',    array( __CLASS__, 'enqueue_scripts' ) );
		add_action( 'enqueue_block_editor_assets', array( __CLASS__, 'enqueue_editor_assets' ) );
		add_action( 'admin_enqueue_scripts', array( __CLASS__, 'enqueue_admin_assets' ) );
		add_filter( 'style_loader_tag',      array( __CLASS__, 'add_preconnect_crossorigin' ), 10, 2 );
		add_filter( 'wp_resource_hints',     array( __CLASS__, 'resource_hints' ), 10, 2 );
	}

	/**
	 * Get the current theme version.
	 *
	 * @return string
	 */
	private static function version(): string {
		return defined( 'NOVASAAS_VERSION' ) ? NOVASAAS_VERSION : '1.0.0';
	}

	/**
	 * Build the Google Fonts URL.
	 *
	 * @return string
	 */
	private static function google_fonts_url(): string {
		return add_query_arg(
			array( 'family' => self::FONTS_FAMILIES ),
			self::FONTS_API
		);
	}

	/**
	 * Enqueue front-end stylesheets.
	 */
	public static function enqueue_styles(): void {
		$ver = self::version();

		// ── Preconnect hint handles (no actual CSS, just for crossorigin attr) ──
		wp_register_style( 'novasaas-preconnect-gfonts', 'https://fonts.googleapis.com', array(), null );
		wp_register_style( 'novasaas-preconnect-gstatic', 'https://fonts.gstatic.com', array(), null );

		// ── Google Fonts ──────────────────────────────────────────────────────
		wp_enqueue_style(
			'novasaas-google-fonts',
			self::google_fonts_url(),
			array(),
			null
		);

		// ── Main theme stylesheet ─────────────────────────────────────────────
		wp_enqueue_style(
			'novasaas-style',
			get_stylesheet_uri(),
			array( 'novasaas-google-fonts' ),
			$ver
		);

		// ── Blog archive stylesheet (only on blog pages) ──────────────────────
		if ( is_home() || is_category() || is_tag() || is_archive() ) {
			wp_enqueue_style(
				'novasaas-blog',
				NOVASAAS_URI . '/assets/css/blog.css',
				array( 'novasaas-style' ),
				$ver
			);
		}

		// ── Single post stylesheet ────────────────────────────────────────────
		if ( is_singular( 'post' ) ) {
			wp_enqueue_style(
				'novasaas-single',
				NOVASAAS_URI . '/assets/css/single.css',
				array( 'novasaas-style' ),
				$ver
			);
		}

		// ── WooCommerce stylesheet ────────────────────────────────────────────
		if ( class_exists( 'WooCommerce' ) && ( is_woocommerce() || is_cart() || is_checkout() || is_account_page() ) ) {
			wp_enqueue_style(
				'novasaas-woocommerce',
				NOVASAAS_URI . '/assets/css/woocommerce.css',
				array( 'novasaas-style' ),
				$ver
			);
		}
	}

	/**
	 * Enqueue front-end scripts.
	 */
	public static function enqueue_scripts(): void {
		$ver = self::version();

		// ── Main theme script ─────────────────────────────────────────────────
		wp_enqueue_script(
			'novasaas-theme',
			NOVASAAS_URI . '/assets/js/theme.js',
			array(),
			$ver,
			array(
				'strategy'  => 'defer',
				'in_footer' => true,
			)
		);

		// ── Pass PHP data to JS ───────────────────────────────────────────────
		wp_localize_script(
			'novasaas-theme',
			'novasaas_ajax',
			array(
				'ajax_url' => esc_url( admin_url( 'admin-ajax.php' ) ),
				'nonce'    => wp_create_nonce( 'novasaas_ajax_nonce' ),
				'is_home'  => is_front_page() ? '1' : '0',
				'site_url' => esc_url( home_url( '/' ) ),
				'strings'  => array(
					'loading' => esc_html__( 'Loading…', 'novasaas' ),
					'error'   => esc_html__( 'Something went wrong. Please try again.', 'novasaas' ),
					'success' => esc_html__( 'Success!', 'novasaas' ),
				),
			)
		);

		// ── Navigation script ─────────────────────────────────────────────────
		wp_enqueue_script(
			'novasaas-nav',
			NOVASAAS_URI . '/assets/js/navigation.js',
			array(),
			$ver,
			array(
				'strategy'  => 'defer',
				'in_footer' => true,
			)
		);

		// ── Comment reply ─────────────────────────────────────────────────────
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}

	/**
	 * Enqueue block editor assets.
	 */
	public static function enqueue_editor_assets(): void {
		$ver = self::version();

		wp_enqueue_style(
			'novasaas-editor-fonts',
			self::google_fonts_url(),
			array(),
			null
		);

		wp_enqueue_style(
			'novasaas-editor-style',
			NOVASAAS_URI . '/assets/css/editor-style.css',
			array(),
			$ver
		);
	}

	/**
	 * Enqueue admin-area assets (used for theme admin pages).
	 *
	 * @param string $hook Current admin page hook.
	 */
	public static function enqueue_admin_assets( string $hook ): void {
		if ( ! in_array( $hook, array( 'appearance_page_novasaas-options', 'themes.php' ), true ) ) {
			return;
		}

		wp_enqueue_style(
			'novasaas-admin',
			NOVASAAS_URI . '/assets/css/admin.css',
			array(),
			self::version()
		);
	}

	/**
	 * Add crossorigin="anonymous" attribute to the gstatic preconnect link tag.
	 *
	 * @param string $tag    Full <link> HTML tag.
	 * @param string $handle Style handle.
	 * @return string
	 */
	public static function add_preconnect_crossorigin( string $tag, string $handle ): string {
		if ( 'novasaas-preconnect-gstatic' === $handle ) {
			return str_replace( "rel='stylesheet'", "rel='preconnect' crossorigin='anonymous'", $tag );
		}
		if ( 'novasaas-preconnect-gfonts' === $handle ) {
			return str_replace( "rel='stylesheet'", "rel='preconnect'", $tag );
		}
		return $tag;
	}

	/**
	 * Add preconnect resource hints for Google Fonts.
	 *
	 * @param array  $urls          URLs for the given relation type.
	 * @param string $relation_type Relation type (preconnect, dns-prefetch, etc.).
	 * @return array
	 */
	public static function resource_hints( array $urls, string $relation_type ): array {
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
}
