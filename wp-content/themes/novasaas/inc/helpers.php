<?php
/**
 * Theme Helper Functions
 *
 * @package NovaSaaS
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Return the active theme version string.
 *
 * @return string
 */
function novasaas_get_theme_version(): string {
	static $version = null;

	if ( null === $version ) {
		$theme   = wp_get_theme();
		$version = $theme->get( 'Version' );
	}

	return $version ?: '1.0.0';
}

/**
 * Retrieve a Customizer option with a fallback default.
 *
 * @param string $key     Option key as registered in the Customizer.
 * @param mixed  $default Fallback value when the option is not set.
 * @return mixed
 */
function novasaas_get_option( string $key, mixed $default = false ): mixed {
	$option = get_theme_mod( 'novasaas_' . $key, $default );

	/**
	 * Filter a retrieved theme option.
	 *
	 * @param mixed  $option  Retrieved (or default) value.
	 * @param string $key     Option key.
	 * @param mixed  $default Default value.
	 */
	return apply_filters( 'novasaas_get_option', $option, $key, $default );
}

/**
 * Generate an inline SVG avatar from initials.
 *
 * @param string $initials  1-2 characters to display (e.g. "SC" for Sarah Chen).
 * @param string $bg_color  Hex color for the avatar background (without #).
 * @return string           Safe SVG markup.
 */
function novasaas_get_svg_avatar( string $initials, string $bg_color = '6366F1' ): string {
	$initials = strtoupper( substr( sanitize_text_field( $initials ), 0, 2 ) );
	$bg_color = preg_replace( '/[^0-9A-Fa-f]/', '', $bg_color );
	$bg_color = $bg_color ?: '6366F1';

	ob_start();
	?>
	<svg xmlns="http://www.w3.org/2000/svg"
		 viewBox="0 0 48 48"
		 width="48"
		 height="48"
		 role="img"
		 aria-label="<?php echo esc_attr( $initials ); ?>"
		 class="novasaas-svg-avatar">
		<rect width="48" height="48" rx="24" fill="#<?php echo esc_attr( $bg_color ); ?>"/>
		<text
			x="50%"
			y="50%"
			dominant-baseline="central"
			text-anchor="middle"
			fill="#ffffff"
			font-size="18"
			font-weight="700"
			font-family="Plus Jakarta Sans, system-ui, sans-serif"
			letter-spacing="0.5"><?php echo esc_html( $initials ); ?></text>
	</svg>
	<?php
	return ob_get_clean();
}

/**
 * Calculate estimated reading time for a post.
 *
 * @param int $post_id WP post ID (0 uses the current post).
 * @return string      Localized string e.g. "4 min read".
 */
function novasaas_get_reading_time( int $post_id = 0 ): string {
	$post = get_post( $post_id ?: get_the_ID() );

	if ( ! $post instanceof WP_Post ) {
		return '';
	}

	$words_per_minute = (int) apply_filters( 'novasaas_reading_wpm', 200 );
	$content          = wp_strip_all_tags( $post->post_content );
	$word_count       = str_word_count( $content );
	$minutes          = (int) max( 1, ceil( $word_count / $words_per_minute ) );

	return sprintf(
		/* translators: %d: number of minutes */
		esc_html( _n( '%d min read', '%d min read', $minutes, 'novasaas' ) ),
		$minutes
	);
}

/**
 * Render a star-rating display as accessible HTML.
 *
 * @param float $rating Numeric rating between 0 and 5.
 * @param int   $max    Maximum stars (default 5).
 * @return string       HTML string of star icons.
 */
function novasaas_get_star_rating( float $rating, int $max = 5 ): string {
	$rating = max( 0.0, min( (float) $rating, (float) $max ) );
	$full   = (int) floor( $rating );
	$half   = ( $rating - $full ) >= 0.5 ? 1 : 0;
	$empty  = $max - $full - $half;

	$output  = '<span class="novasaas-star-rating" aria-label="';
	$output .= esc_attr(
		sprintf(
			/* translators: 1: rating value 2: max stars */
			__( '%1$s out of %2$s stars', 'novasaas' ),
			number_format( $rating, 1 ),
			$max
		)
	);
	$output .= '" role="img">';

	for ( $i = 0; $i < $full; $i++ ) {
		$output .= '<span class="novasaas-star novasaas-star--full" aria-hidden="true">&#9733;</span>';
	}

	if ( $half ) {
		$output .= '<span class="novasaas-star novasaas-star--half" aria-hidden="true">&#9734;</span>';
	}

	for ( $i = 0; $i < $empty; $i++ ) {
		$output .= '<span class="novasaas-star novasaas-star--empty" aria-hidden="true">&#9734;</span>';
	}

	$output .= '</span>';

	return $output;
}

/**
 * Render a breadcrumb trail for the current page.
 * Outputs escaped HTML directly.
 */
function novasaas_render_breadcrumb(): void {
	// Yoast SEO breadcrumbs take priority.
	if ( function_exists( 'yoast_breadcrumb' ) ) {
		yoast_breadcrumb(
			'<nav class="novasaas-breadcrumb" aria-label="' . esc_attr__( 'Breadcrumb', 'novasaas' ) . '">',
			'</nav>'
		);
		return;
	}

	$crumbs = array();

	// Home.
	$crumbs[] = sprintf(
		'<a href="%s">%s</a>',
		esc_url( home_url( '/' ) ),
		esc_html__( 'Home', 'novasaas' )
	);

	if ( is_singular() ) {
		// Category for posts.
		if ( is_singular( 'post' ) ) {
			$categories = get_the_category();
			if ( ! empty( $categories ) ) {
				$cat      = $categories[0];
				$crumbs[] = sprintf(
					'<a href="%s">%s</a>',
					esc_url( get_category_link( $cat->term_id ) ),
					esc_html( $cat->name )
				);
			}
		}

		// Custom post type archive.
		$post_type = get_post_type();
		if ( $post_type && 'post' !== $post_type && 'page' !== $post_type ) {
			$pto = get_post_type_object( $post_type );
			if ( $pto && $pto->has_archive ) {
				$crumbs[] = sprintf(
					'<a href="%s">%s</a>',
					esc_url( get_post_type_archive_link( $post_type ) ),
					esc_html( $pto->labels->name )
				);
			}
		}

		$crumbs[] = '<span aria-current="page">' . esc_html( get_the_title() ) . '</span>';

	} elseif ( is_category() || is_tag() || is_tax() ) {
		$crumbs[] = '<span aria-current="page">' . esc_html( single_term_title( '', false ) ) . '</span>';

	} elseif ( is_archive() ) {
		$crumbs[] = '<span aria-current="page">' . esc_html( get_the_archive_title() ) . '</span>';

	} elseif ( is_search() ) {
		$crumbs[] = sprintf(
			'<span aria-current="page">%s &ldquo;%s&rdquo;</span>',
			esc_html__( 'Search results for:', 'novasaas' ),
			esc_html( get_search_query() )
		);

	} elseif ( is_404() ) {
		$crumbs[] = '<span aria-current="page">' . esc_html__( '404 – Not Found', 'novasaas' ) . '</span>';
	}

	if ( count( $crumbs ) <= 1 ) {
		return;
	}

	echo '<nav class="novasaas-breadcrumb" aria-label="' . esc_attr__( 'Breadcrumb', 'novasaas' ) . '">';
	echo '<ol class="novasaas-breadcrumb__list" itemscope itemtype="https://schema.org/BreadcrumbList">';

	foreach ( $crumbs as $index => $crumb ) {
		$is_last = ( $index === count( $crumbs ) - 1 );
		$pos     = $index + 1;

		echo '<li class="novasaas-breadcrumb__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
		echo '<span itemprop="name">' . wp_kses_post( $crumb ) . '</span>';
		echo '<meta itemprop="position" content="' . esc_attr( (string) $pos ) . '">';
		echo '</li>';

		if ( ! $is_last ) {
			echo '<li class="novasaas-breadcrumb__separator" aria-hidden="true">&#8250;</li>';
		}
	}

	echo '</ol>';
	echo '</nav>';
}

/**
 * Truncate a string to a maximum character length, appending an ellipsis.
 *
 * @param string $text   The text to truncate.
 * @param int    $length Maximum character length.
 * @return string        Truncated (or original) string.
 */
function novasaas_truncate( string $text, int $length = 120 ): string {
	$text = wp_strip_all_tags( $text );

	if ( mb_strlen( $text ) <= $length ) {
		return $text;
	}

	$truncated = mb_substr( $text, 0, $length );

	// Avoid cutting in the middle of a word.
	$last_space = mb_strrpos( $truncated, ' ' );
	if ( false !== $last_space ) {
		$truncated = mb_substr( $truncated, 0, $last_space );
	}

	return rtrim( $truncated ) . '&hellip;';
}

/**
 * Get a post's featured image URL at a given size, with a fallback placeholder.
 *
 * @param int    $post_id   Post ID.
 * @param string $size      Registered image size slug.
 * @param string $fallback  Fallback URL if no thumbnail is set.
 * @return string           Escaped image URL.
 */
function novasaas_get_thumbnail_url( int $post_id = 0, string $size = 'novasaas-blog', string $fallback = '' ): string {
	$post_id = $post_id ?: get_the_ID();

	if ( has_post_thumbnail( $post_id ) ) {
		$src = get_the_post_thumbnail_url( $post_id, $size );
		if ( $src ) {
			return esc_url( $src );
		}
	}

	if ( $fallback ) {
		return esc_url( $fallback );
	}

	return esc_url( NOVASAAS_URI . '/assets/images/placeholder.jpg' );
}

/**
 * Render the site logo or site name as a linked fallback.
 *
 * @param array $args Optional args: class, width, height.
 */
function novasaas_the_logo( array $args = array() ): void {
	$defaults = array(
		'class'  => 'novasaas-logo',
		'width'  => 160,
		'height' => 50,
	);
	$args = wp_parse_args( $args, $defaults );

	if ( has_custom_logo() ) {
		$logo_id  = get_theme_mod( 'custom_logo' );
		$logo_url = wp_get_attachment_image_url( $logo_id, 'full' );

		printf(
			'<a href="%s" class="%s" rel="home" aria-label="%s"><img src="%s" alt="%s" width="%d" height="%d" loading="eager"></a>',
			esc_url( home_url( '/' ) ),
			esc_attr( $args['class'] ),
			esc_attr( get_bloginfo( 'name' ) ),
			esc_url( $logo_url ),
			esc_attr( get_bloginfo( 'name' ) ),
			absint( $args['width'] ),
			absint( $args['height'] )
		);
	} else {
		printf(
			'<a href="%s" class="%s novasaas-logo--text novasaas-gradient-text" rel="home">%s</a>',
			esc_url( home_url( '/' ) ),
			esc_attr( $args['class'] ),
			esc_html( get_bloginfo( 'name' ) )
		);
	}
}
