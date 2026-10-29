<?php
/**
 * Template Tags
 * Additional template helper functions used across templates.
 *
 * @package NovaSaaS
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Output posted-on date with Schema.org markup.
 */
function novasaas_posted_on(): void {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s" style="display:none;">%4$s</time>';
	}

	$time_string = sprintf(
		$time_string,
		esc_attr( get_the_date( DATE_W3C ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( DATE_W3C ) ),
		esc_html( get_the_modified_date() )
	);

	echo '<span class="posted-on">' . $time_string . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput
}

/**
 * Output post author with link.
 */
function novasaas_posted_by(): void {
	echo '<span class="byline">' .
		'<span class="author vcard">' .
		'<a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' .
		esc_html( get_the_author() ) .
		'</a></span></span>';
}

/**
 * Output post categories as badge links.
 */
function novasaas_post_categories(): void {
	$cats = get_the_category();
	if ( empty( $cats ) ) return;
	foreach ( $cats as $cat ) {
		echo '<a href="' . esc_url( get_category_link( $cat->term_id ) ) . '" class="novasaas-badge novasaas-badge--primary">' .
			esc_html( $cat->name ) .
			'</a> ';
	}
}

/**
 * Display an edit post link for logged-in users.
 */
function novasaas_edit_post_link(): void {
	edit_post_link(
		sprintf(
			wp_kses(
				/* translators: %s: post title */
				__( 'Edit <span class="novasaas-sr-only">"%s"</span>', 'novasaas' ),
				array( 'span' => array( 'class' => array() ) )
			),
			wp_kses_post( get_the_title() )
		),
		'<span class="edit-link" style="font-size:var(--novasaas-text-xs);margin-left:auto;">',
		'</span>'
	);
}
