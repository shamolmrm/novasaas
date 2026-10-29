<?php
/**
 * One Click Demo Import Integration
 *
 * @package NovaSaaS
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Registers demo import files and runs post-import setup.
 */
class NovaSaaS_Demo_Import {

	/**
	 * Bind hooks.
	 */
	public static function init(): void {
		$instance = new self();
		add_filter( 'ocdi/import_files', array( $instance, 'register_demo_files' ) );
		add_action( 'ocdi/after_import', array( $instance, 'after_import_setup' ) );
		add_filter( 'ocdi/plugin_intro_text', array( $instance, 'intro_text' ) );
	}

	/**
	 * Register demo import data files.
	 *
	 * @return array
	 */
	public function register_demo_files(): array {
		return array(
			array(
				'import_file_name'             => __( 'StreamFlow — Main Demo', 'novasaas' ),
				'import_file_url'              => NOVASAAS_URI . 'demo-data/demo-content.xml',
				'import_widget_file_url'       => NOVASAAS_URI . 'demo-data/widgets.wie',
				'import_customizer_file_url'   => NOVASAAS_URI . 'demo-data/customizer.dat',
				'import_preview_image_url'     => NOVASAAS_URI . 'demo-data/preview.jpg',
				'import_notice'                => __( 'This will import all demo pages, posts, menus, and customizer settings. Import may take 1–3 minutes.', 'novasaas' ),
				'preview_url'                  => 'https://novasaas.demo/',
			),
		);
	}

	/**
	 * Set up theme options after demo import completes.
	 *
	 * @param array $selected_import The import data array.
	 */
	public function after_import_setup( array $selected_import ): void {
		$this->assign_front_page();
		$this->assign_blog_page();
		$this->assign_menus();
		$this->set_reading_settings();
	}

	/**
	 * Set the front page to the imported "Home" page.
	 */
	private function assign_front_page(): void {
		$front_page = get_page_by_title( 'Home' );
		if ( $front_page instanceof WP_Post ) {
			update_option( 'page_on_front', $front_page->ID );
			update_option( 'show_on_front', 'page' );
		}
	}

	/**
	 * Set the posts page to the imported "Blog" page.
	 */
	private function assign_blog_page(): void {
		$blog_page = get_page_by_title( 'Blog' );
		if ( $blog_page instanceof WP_Post ) {
			update_option( 'page_for_posts', $blog_page->ID );
		}
	}

	/**
	 * Assign imported menus to their locations.
	 */
	private function assign_menus(): void {
		$locations = get_theme_mod( 'nav_menu_locations', array() );

		$primary = get_term_by( 'name', 'Primary Menu', 'nav_menu' );
		if ( $primary instanceof WP_Term ) {
			$locations['primary-menu'] = $primary->term_id;
		}

		$footer = get_term_by( 'name', 'Footer Menu', 'nav_menu' );
		if ( $footer instanceof WP_Term ) {
			$locations['footer-menu'] = $footer->term_id;
		}

		set_theme_mod( 'nav_menu_locations', $locations );
	}

	/**
	 * Configure reading settings.
	 */
	private function set_reading_settings(): void {
		update_option( 'posts_per_page', 9 );
	}

	/**
	 * Customize the OCDI intro text.
	 *
	 * @return string
	 */
	public function intro_text(): string {
		return wp_kses_post(
			'<div class="ocdi__intro-text">' .
			'<p>' . __( 'Import the NovaSaaS StreamFlow demo with one click to get all pages, menus, and customizer settings set up automatically.', 'novasaas' ) . '</p>' .
			'<p><strong>' . __( 'Before importing:', 'novasaas' ) . '</strong> ' . __( 'Make sure Elementor is installed and activated, then click the preview image below.', 'novasaas' ) . '</p>' .
			'</div>'
		);
	}
}
