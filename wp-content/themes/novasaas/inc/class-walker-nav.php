<?php
/**
 * Custom Nav Walker — Bootstrap 5 compatible dropdown markup
 *
 * @package NovaSaaS
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Renders the primary navigation with dropdown support.
 * Outputs Bootstrap 5 data-bs-* attributes so the same markup
 * works whether Bootstrap JS or the theme's own vanilla JS handles dropdowns.
 */
class NovaSaaS_Walker_Nav extends Walker_Nav_Menu {

	/**
	 * Unique ID counter for generating aria-controls values.
	 *
	 * @var int
	 */
	private static int $dropdown_counter = 0;

	/**
	 * Open a sub-menu list (<ul class="dropdown-menu ...">).
	 *
	 * @param string   $output Passed by reference.
	 * @param int      $depth  Depth of menu item.
	 * @param stdClass $args   Walker args object.
	 */
	public function start_lvl( &$output, $depth = 0, $args = null ): void {
		$indent  = str_repeat( "\t", $depth );
		$classes = array( 'dropdown-menu', 'novasaas-dropdown' );

		if ( $depth > 0 ) {
			$classes[] = 'dropdown-menu--nested';
		}

		$class_str = implode( ' ', array_map( 'sanitize_html_class', $classes ) );
		$output   .= "\n{$indent}<ul class=\"{$class_str}\" role=\"menu\">\n";
	}

	/**
	 * Close a sub-menu list.
	 *
	 * @param string   $output Passed by reference.
	 * @param int      $depth  Depth of menu item.
	 * @param stdClass $args   Walker args object.
	 */
	public function end_lvl( &$output, $depth = 0, $args = null ): void {
		$indent  = str_repeat( "\t", $depth );
		$output .= "{$indent}</ul>\n";
	}

	/**
	 * Open a menu item (<li>) and render its anchor.
	 *
	 * @param string   $output Passed by reference.
	 * @param WP_Post  $item   Menu item data object.
	 * @param int      $depth  Depth of menu item.
	 * @param stdClass $args   Walker args object.
	 * @param int      $id     Current item/object ID.
	 */
	public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ): void {
		$indent       = str_repeat( "\t", $depth );
		$has_children = in_array( 'menu-item-has-children', (array) $item->classes, true );
		$is_active    = in_array( 'current-menu-item', (array) $item->classes, true )
		             || in_array( 'current-menu-ancestor', (array) $item->classes, true )
		             || in_array( 'current_page_item', (array) $item->classes, true )
		             || in_array( 'current_page_ancestor', (array) $item->classes, true );

		// ── Build <li> classes ────────────────────────────────────────────────
		$li_classes = array( 'nav-item' );

		if ( $has_children ) {
			$li_classes[] = 'dropdown';
		}

		if ( $is_active ) {
			$li_classes[] = 'active';
		}

		if ( $depth > 0 ) {
			$li_classes[] = 'dropdown__item';
		}

		// Merge any classes already on the menu item.
		$item_classes = array_filter(
			(array) $item->classes,
			static function ( string $c ): bool {
				return ! in_array(
					$c,
					array(
						'menu-item',
						'menu-item-has-children',
						'current-menu-item',
						'current-menu-ancestor',
						'current_page_item',
						'current_page_ancestor',
						'page_item',
						'page_item_has_children',
					),
					true
				);
			}
		);
		$li_classes = array_merge( $li_classes, $item_classes );
		$li_class_str = esc_attr( implode( ' ', array_unique( array_filter( $li_classes ) ) ) );

		// ── Build <li> attributes ─────────────────────────────────────────────
		$li_atts  = '';
		$li_id    = apply_filters( 'nav_menu_item_id', 'menu-item-' . absint( $item->ID ), $item, $args, $depth );
		if ( $li_id ) {
			$li_atts .= ' id="' . esc_attr( $li_id ) . '"';
		}

		$output .= "\n{$indent}<li class=\"{$li_class_str}\"{$li_atts}>\n";

		// ── Build anchor attributes ───────────────────────────────────────────
		$a_classes = array( 0 === $depth ? 'nav-link' : 'dropdown-item' );

		if ( $has_children ) {
			$a_classes[] = 'dropdown-toggle';
		}

		if ( $is_active ) {
			$a_classes[] = 'active';
		}

		$a_class_str = esc_attr( implode( ' ', $a_classes ) );
		$title       = apply_filters( 'the_title', $item->title, $item->ID );
		$title       = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );
		$description = $item->description ? apply_filters( 'nav_menu_item_description', $item->description, $item, $args, $depth ) : '';

		// Dropdown ID for aria-controls.
		$dropdown_id = '';
		if ( $has_children ) {
			++self::$dropdown_counter;
			$dropdown_id = 'novasaas-dropdown-' . self::$dropdown_counter;
		}

		// Target and rel.
		$target = ! empty( $item->target ) && '_blank' === $item->target ? ' target="_blank" rel="noopener noreferrer"' : '';
		$xfn    = ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) . '"' : '';

		// Build aria attributes.
		$aria = '';
		if ( $is_active && ! $has_children ) {
			$aria .= ' aria-current="page"';
		}
		if ( $has_children ) {
			$aria .= ' aria-expanded="false"';
			if ( $dropdown_id ) {
				$aria .= ' aria-controls="' . esc_attr( $dropdown_id ) . '"';
				$aria .= ' data-bs-toggle="dropdown"';
				$aria .= ' data-novasaas-toggle="dropdown"';
			}
		}

		// Anchor href — top-level dropdowns may have # as href.
		$href = ! empty( $item->url ) ? esc_url( $item->url ) : '#';

		$output .= "{$indent}\t<a href=\"{$href}\" class=\"{$a_class_str}\"{$aria}{$target}{$xfn}>";
		$output .= esc_html( $title );

		// Chevron icon for dropdowns.
		if ( $has_children ) {
			$output .= '<span class="novasaas-nav__chevron" aria-hidden="true">'
			         . '<svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">'
			         . '<path d="M2 4L6 8L10 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>'
			         . '</svg></span>';
		}

		if ( $description ) {
			$output .= '<span class="novasaas-nav__desc">' . esc_html( $description ) . '</span>';
		}

		$output .= "</a>\n";

		// Open the dropdown wrapper div if this item has children.
		if ( $has_children && $dropdown_id ) {
			$output .= "{$indent}\t<div class=\"novasaas-dropdown__wrapper\" id=\"" . esc_attr( $dropdown_id ) . "\">\n";
		}
	}

	/**
	 * Close a menu item </li>.
	 *
	 * @param string   $output Passed by reference.
	 * @param WP_Post  $item   Menu item data object.
	 * @param int      $depth  Depth of menu item.
	 * @param stdClass $args   Walker args object.
	 */
	public function end_el( &$output, $item, $depth = 0, $args = null ): void {
		$indent       = str_repeat( "\t", $depth );
		$has_children = in_array( 'menu-item-has-children', (array) $item->classes, true );

		if ( $has_children ) {
			$output .= "{$indent}\t</div><!-- /.novasaas-dropdown__wrapper -->\n";
		}

		$output .= "{$indent}</li>\n";
	}
}
