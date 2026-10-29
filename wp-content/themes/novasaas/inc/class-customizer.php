<?php
/**
 * WordPress Customizer Integration
 *
 * @package NovaSaaS
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Registers all Customizer panels, sections, settings, and controls.
 */
class NovaSaaS_Customizer {

	/**
	 * Bind hooks.
	 */
	public static function init(): void {
		$instance = new self();
		add_action( 'customize_register', array( $instance, 'register' ) );
		add_action( 'wp_head', array( $instance, 'output_css' ), 99 );
	}

	/**
	 * Register all customizer settings.
	 *
	 * @param WP_Customize_Manager $wp_customize Customizer instance.
	 */
	public function register( WP_Customize_Manager $wp_customize ): void {

		// ── Panel ─────────────────────────────────────────────────────────────
		$wp_customize->add_panel( 'novasaas_panel', array(
			'title'       => __( 'NovaSaaS Theme', 'novasaas' ),
			'description' => __( 'Customize the NovaSaaS theme settings.', 'novasaas' ),
			'priority'    => 25,
		) );

		// ── 1. General ────────────────────────────────────────────────────────
		$wp_customize->add_section( 'novasaas_general', array(
			'title'    => __( 'General', 'novasaas' ),
			'panel'    => 'novasaas_panel',
			'priority' => 10,
		) );

		$this->add_setting_control( $wp_customize, 'preloader_enable', 'novasaas_general', array(
			'label'     => __( 'Enable Preloader', 'novasaas' ),
			'type'      => 'checkbox',
			'default'   => true,
			'transport' => 'refresh',
		) );

		$this->add_setting_control( $wp_customize, 'custom_css_note', 'novasaas_general', array(
			'label'       => __( 'Custom CSS', 'novasaas' ),
			'description' => __( 'Use Appearance → Customize → Additional CSS for custom styles.', 'novasaas' ),
			'type'        => 'hidden',
			'default'     => '',
			'transport'   => 'refresh',
		) );

		// ── 2. Colors ─────────────────────────────────────────────────────────
		$wp_customize->add_section( 'novasaas_colors', array(
			'title'    => __( 'Colors', 'novasaas' ),
			'panel'    => 'novasaas_panel',
			'priority' => 20,
		) );

		$color_settings = array(
			'primary_color'   => array( 'label' => __( 'Primary Color', 'novasaas' ),   'default' => '#6366F1' ),
			'secondary_color' => array( 'label' => __( 'Secondary Color', 'novasaas' ), 'default' => '#EC4899' ),
			'accent_color'    => array( 'label' => __( 'Accent Color', 'novasaas' ),    'default' => '#06B6D4' ),
			'bg_color'        => array( 'label' => __( 'Background Color', 'novasaas' ), 'default' => '#0F0A1E' ),
			'text_color'      => array( 'label' => __( 'Text Color', 'novasaas' ),      'default' => '#F8FAFC' ),
		);

		foreach ( $color_settings as $key => $args ) {
			$wp_customize->add_setting( 'novasaas_' . $key, array(
				'default'           => $args['default'],
				'sanitize_callback' => 'sanitize_hex_color',
				'transport'         => 'postMessage',
			) );
			$wp_customize->add_control( new WP_Customize_Color_Control(
				$wp_customize,
				'novasaas_' . $key,
				array(
					'label'   => $args['label'],
					'section' => 'novasaas_colors',
				)
			) );
		}

		// ── 3. Typography ─────────────────────────────────────────────────────
		$wp_customize->add_section( 'novasaas_typography', array(
			'title'    => __( 'Typography', 'novasaas' ),
			'panel'    => 'novasaas_panel',
			'priority' => 30,
		) );

		$google_fonts = array(
			'Plus Jakarta Sans' => 'Plus Jakarta Sans',
			'Inter'             => 'Inter',
			'Poppins'           => 'Poppins',
			'DM Sans'           => 'DM Sans',
			'Outfit'            => 'Outfit',
			'Manrope'           => 'Manrope',
			'Raleway'           => 'Raleway',
			'Space Grotesk'     => 'Space Grotesk',
		);

		$wp_customize->add_setting( 'novasaas_heading_font', array(
			'default'           => 'Plus Jakarta Sans',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'refresh',
		) );
		$wp_customize->add_control( 'novasaas_heading_font', array(
			'label'   => __( 'Heading Font', 'novasaas' ),
			'section' => 'novasaas_typography',
			'type'    => 'select',
			'choices' => $google_fonts,
		) );

		$wp_customize->add_setting( 'novasaas_body_font', array(
			'default'           => 'Inter',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'refresh',
		) );
		$wp_customize->add_control( 'novasaas_body_font', array(
			'label'   => __( 'Body Font', 'novasaas' ),
			'section' => 'novasaas_typography',
			'type'    => 'select',
			'choices' => $google_fonts,
		) );

		$wp_customize->add_setting( 'novasaas_base_font_size', array(
			'default'           => 16,
			'sanitize_callback' => 'absint',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( 'novasaas_base_font_size', array(
			'label'       => __( 'Base Font Size (px)', 'novasaas' ),
			'description' => __( 'Range: 14–20px', 'novasaas' ),
			'section'     => 'novasaas_typography',
			'type'        => 'range',
			'input_attrs' => array( 'min' => 14, 'max' => 20, 'step' => 1 ),
		) );

		// ── 4. Header ─────────────────────────────────────────────────────────
		$wp_customize->add_section( 'novasaas_header', array(
			'title'    => __( 'Header', 'novasaas' ),
			'panel'    => 'novasaas_panel',
			'priority' => 40,
		) );

		$this->add_setting_control( $wp_customize, 'cta_text', 'novasaas_header', array(
			'label'   => __( 'CTA Button Text', 'novasaas' ),
			'default' => __( 'Start Free Trial', 'novasaas' ),
			'type'    => 'text',
		) );

		$this->add_setting_control( $wp_customize, 'cta_url', 'novasaas_header', array(
			'label'             => __( 'CTA Button URL', 'novasaas' ),
			'default'           => '#pricing',
			'type'              => 'url',
			'sanitize_callback' => 'esc_url_raw',
		) );

		$this->add_setting_control( $wp_customize, 'transparent_header', 'novasaas_header', array(
			'label'   => __( 'Transparent Header on Front Page', 'novasaas' ),
			'default' => true,
			'type'    => 'checkbox',
		) );

		$this->add_setting_control( $wp_customize, 'sticky_header', 'novasaas_header', array(
			'label'   => __( 'Sticky Header on Scroll', 'novasaas' ),
			'default' => true,
			'type'    => 'checkbox',
		) );

		// ── 5. Hero ───────────────────────────────────────────────────────────
		$wp_customize->add_section( 'novasaas_hero', array(
			'title'    => __( 'Hero Section', 'novasaas' ),
			'panel'    => 'novasaas_panel',
			'priority' => 50,
		) );

		$hero_controls = array(
			'hero_headline'    => array( 'label' => __( 'Headline', 'novasaas' ),               'default' => __( 'Ship faster. Collaborate smarter.', 'novasaas' ) ),
			'hero_subheading'  => array( 'label' => __( 'Subheading', 'novasaas' ),             'default' => __( 'The all-in-one project management platform trusted by 10,000+ teams worldwide.', 'novasaas' ) ),
			'hero_cta1_text'   => array( 'label' => __( 'Primary CTA Text', 'novasaas' ),       'default' => __( 'Start for Free', 'novasaas' ) ),
			'hero_cta1_url'    => array( 'label' => __( 'Primary CTA URL', 'novasaas' ),        'default' => '#pricing', 'sanitize_callback' => 'esc_url_raw' ),
			'hero_cta2_text'   => array( 'label' => __( 'Secondary CTA Text', 'novasaas' ),     'default' => __( 'Watch Demo', 'novasaas' ) ),
			'hero_cta2_url'    => array( 'label' => __( 'Secondary CTA URL', 'novasaas' ),      'default' => '#demo', 'sanitize_callback' => 'esc_url_raw' ),
		);

		foreach ( $hero_controls as $key => $args ) {
			$sanitize = isset( $args['sanitize_callback'] ) ? $args['sanitize_callback'] : 'sanitize_text_field';
			$wp_customize->add_setting( 'novasaas_' . $key, array(
				'default'           => $args['default'],
				'sanitize_callback' => $sanitize,
				'transport'         => 'postMessage',
			) );
			$wp_customize->add_control( 'novasaas_' . $key, array(
				'label'   => $args['label'],
				'section' => 'novasaas_hero',
				'type'    => ( strpos( $key, '_url' ) !== false ) ? 'url' : 'text',
			) );
		}

		// ── 6. Footer ─────────────────────────────────────────────────────────
		$wp_customize->add_section( 'novasaas_footer', array(
			'title'    => __( 'Footer', 'novasaas' ),
			'panel'    => 'novasaas_panel',
			'priority' => 60,
		) );

		$this->add_setting_control( $wp_customize, 'footer_copyright', 'novasaas_footer', array(
			'label'   => __( 'Copyright Text', 'novasaas' ),
			'default' => sprintf( '&copy; %d StreamFlow, Inc. All rights reserved.', gmdate( 'Y' ) ),
			'type'    => 'text',
		) );

		$this->add_setting_control( $wp_customize, 'footer_social_icons', 'novasaas_footer', array(
			'label'   => __( 'Show Social Icons', 'novasaas' ),
			'default' => true,
			'type'    => 'checkbox',
		) );

		$social_links = array(
			'social_twitter'   => __( 'Twitter / X URL', 'novasaas' ),
			'social_linkedin'  => __( 'LinkedIn URL', 'novasaas' ),
			'social_github'    => __( 'GitHub URL', 'novasaas' ),
			'social_youtube'   => __( 'YouTube URL', 'novasaas' ),
		);

		foreach ( $social_links as $key => $label ) {
			$wp_customize->add_setting( 'novasaas_' . $key, array(
				'default'           => '',
				'sanitize_callback' => 'esc_url_raw',
				'transport'         => 'refresh',
			) );
			$wp_customize->add_control( 'novasaas_' . $key, array(
				'label'   => $label,
				'section' => 'novasaas_footer',
				'type'    => 'url',
			) );
		}

		// ── 7. Blog ───────────────────────────────────────────────────────────
		$wp_customize->add_section( 'novasaas_blog', array(
			'title'    => __( 'Blog', 'novasaas' ),
			'panel'    => 'novasaas_panel',
			'priority' => 70,
		) );

		$wp_customize->add_setting( 'novasaas_posts_per_page', array(
			'default'           => 9,
			'sanitize_callback' => 'absint',
			'transport'         => 'refresh',
		) );
		$wp_customize->add_control( 'novasaas_posts_per_page', array(
			'label'       => __( 'Posts Per Page', 'novasaas' ),
			'section'     => 'novasaas_blog',
			'type'        => 'number',
			'input_attrs' => array( 'min' => 1, 'max' => 50 ),
		) );

		$this->add_setting_control( $wp_customize, 'show_reading_time', 'novasaas_blog', array(
			'label'   => __( 'Show Reading Time', 'novasaas' ),
			'default' => true,
			'type'    => 'checkbox',
		) );

		$this->add_setting_control( $wp_customize, 'show_author', 'novasaas_blog', array(
			'label'   => __( 'Show Author on Post Cards', 'novasaas' ),
			'default' => true,
			'type'    => 'checkbox',
		) );
	}

	/**
	 * Output dynamic CSS variables to <head>.
	 */
	public function output_css(): void {
		$primary   = get_theme_mod( 'novasaas_primary_color',   '#6366F1' );
		$secondary = get_theme_mod( 'novasaas_secondary_color', '#EC4899' );
		$accent    = get_theme_mod( 'novasaas_accent_color',    '#06B6D4' );
		$bg        = get_theme_mod( 'novasaas_bg_color',        '#0F0A1E' );
		$text      = get_theme_mod( 'novasaas_text_color',      '#F8FAFC' );
		$font_size = absint( get_theme_mod( 'novasaas_base_font_size', 16 ) );

		$primary   = sanitize_hex_color( $primary )   ?: '#6366F1';
		$secondary = sanitize_hex_color( $secondary ) ?: '#EC4899';
		$accent    = sanitize_hex_color( $accent )    ?: '#06B6D4';
		$bg        = sanitize_hex_color( $bg )        ?: '#0F0A1E';
		$text      = sanitize_hex_color( $text )      ?: '#F8FAFC';
		$font_size = max( 14, min( 20, $font_size ) );

		// Only output if values differ from defaults.
		$defaults_only = (
			$primary   === '#6366F1' &&
			$secondary === '#EC4899' &&
			$accent    === '#06B6D4' &&
			$bg        === '#0F0A1E' &&
			$text      === '#F8FAFC' &&
			$font_size === 16
		);

		if ( $defaults_only ) {
			return;
		}

		echo '<style id="novasaas-customizer-css">:root{';
		echo '--novasaas-primary:' . esc_html( $primary ) . ';';
		echo '--novasaas-secondary:' . esc_html( $secondary ) . ';';
		echo '--novasaas-accent:' . esc_html( $accent ) . ';';
		echo '--novasaas-bg-dark:' . esc_html( $bg ) . ';';
		echo '--novasaas-text:' . esc_html( $text ) . ';';
		if ( $font_size !== 16 ) {
			echo 'font-size:' . absint( $font_size ) . 'px;';
		}
		echo '}</style>' . "\n";
	}

	/**
	 * Helper: add a setting + control in one call.
	 *
	 * @param WP_Customize_Manager $wp_customize Customizer instance.
	 * @param string               $key          Setting key (without prefix).
	 * @param string               $section      Section ID.
	 * @param array                $args         Control arguments.
	 */
	private function add_setting_control(
		WP_Customize_Manager $wp_customize,
		string $key,
		string $section,
		array $args
	): void {
		$setting_id = 'novasaas_' . $key;
		$default    = isset( $args['default'] ) ? $args['default'] : '';
		$transport  = isset( $args['transport'] ) ? $args['transport'] : 'postMessage';

		$sanitize = 'sanitize_text_field';
		if ( isset( $args['sanitize_callback'] ) ) {
			$sanitize = $args['sanitize_callback'];
		} elseif ( $args['type'] === 'checkbox' ) {
			$sanitize = array( $this, 'sanitize_checkbox' );
		} elseif ( $args['type'] === 'url' ) {
			$sanitize = 'esc_url_raw';
		}

		$wp_customize->add_setting( $setting_id, array(
			'default'           => $default,
			'sanitize_callback' => $sanitize,
			'transport'         => $transport,
		) );

		$control_args = array(
			'label'   => isset( $args['label'] )       ? $args['label']       : '',
			'section' => $section,
			'type'    => $args['type'],
		);

		if ( isset( $args['description'] ) ) {
			$control_args['description'] = $args['description'];
		}
		if ( isset( $args['choices'] ) ) {
			$control_args['choices'] = $args['choices'];
		}
		if ( isset( $args['input_attrs'] ) ) {
			$control_args['input_attrs'] = $args['input_attrs'];
		}

		$wp_customize->add_control( $setting_id, $control_args );
	}

	/**
	 * Sanitize checkbox values.
	 *
	 * @param mixed $value Raw value.
	 * @return bool
	 */
	public function sanitize_checkbox( $value ): bool {
		return (bool) $value;
	}
}
