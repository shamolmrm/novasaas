<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="novasaas-skip-link" href="#novasaas-content">
	<?php esc_html_e( 'Skip to content', 'novasaas' ); ?>
</a>

<?php
$cta_url  = novasaas_get_option( 'cta_url', '#' );
$cta_text = novasaas_get_option( 'cta_text', __( 'Start Free Trial', 'novasaas' ) );
?>

<header id="novasaas-header" class="novasaas-header" role="banner">
	<div class="novasaas-header__inner novasaas-container">

		<!-- ── Logo ─────────────────────────────────────────────────────── -->
		<div class="novasaas-header__logo">
			<?php novasaas_the_logo( array( 'class' => 'novasaas-logo', 'width' => 160, 'height' => 50 ) ); ?>
		</div>

		<!-- ── Primary Navigation ───────────────────────────────────────── -->
		<nav id="novasaas-primary-nav"
			 class="novasaas-header__nav"
			 role="navigation"
			 aria-label="<?php esc_attr_e( 'Primary Navigation', 'novasaas' ); ?>">

			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary-menu',
					'menu_id'        => 'novasaas-menu-primary',
					'menu_class'     => 'novasaas-nav__list',
					'container'      => false,
					'walker'         => new NovaSaaS_Walker_Nav(),
					'fallback_cb'    => 'novasaas_nav_fallback',
					'items_wrap'     => '<ul id="%1$s" class="%2$s" role="menubar">%3$s</ul>',
					'depth'          => 3,
				)
			);
			?>
		</nav>

		<!-- ── Header Actions ───────────────────────────────────────────── -->
		<div class="novasaas-header__actions">
			<a href="<?php echo esc_url( $cta_url ); ?>"
			   class="novasaas-btn novasaas-btn--sm novasaas-header__cta"
			   data-novasaas-cta="header">
				<?php echo esc_html( $cta_text ); ?>
			</a>

			<!-- ── Hamburger ──────────────────────────────────────────── -->
			<button type="button"
					id="novasaas-menu-toggle"
					class="novasaas-hamburger"
					aria-expanded="false"
					aria-controls="novasaas-mobile-menu"
					aria-label="<?php esc_attr_e( 'Open mobile menu', 'novasaas' ); ?>">
				<span class="novasaas-hamburger__bar"></span>
				<span class="novasaas-hamburger__bar"></span>
				<span class="novasaas-hamburger__bar"></span>
				<span class="novasaas-sr-only"><?php esc_html_e( 'Menu', 'novasaas' ); ?></span>
			</button>
		</div>

	</div><!-- /.novasaas-header__inner -->
</header><!-- #novasaas-header -->

<!-- ── Mobile Menu Overlay ────────────────────────────────────────────── -->
<div id="novasaas-mobile-menu"
	 class="novasaas-mobile-menu"
	 role="dialog"
	 aria-modal="true"
	 aria-label="<?php esc_attr_e( 'Mobile Navigation', 'novasaas' ); ?>"
	 hidden>

	<div class="novasaas-mobile-menu__header">
		<div class="novasaas-mobile-menu__logo">
			<?php novasaas_the_logo( array( 'class' => 'novasaas-logo', 'width' => 140, 'height' => 44 ) ); ?>
		</div>
		<button type="button"
				id="novasaas-menu-close"
				class="novasaas-mobile-menu__close"
				aria-label="<?php esc_attr_e( 'Close mobile menu', 'novasaas' ); ?>">
			<svg width="20" height="20" viewBox="0 0 20 20" fill="none" aria-hidden="true">
				<path d="M15 5L5 15M5 5l10 10" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
			</svg>
		</button>
	</div>

	<nav class="novasaas-mobile-menu__nav"
		 aria-label="<?php esc_attr_e( 'Mobile Navigation', 'novasaas' ); ?>">
		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'mobile-menu',
				'menu_id'        => 'novasaas-menu-mobile',
				'menu_class'     => 'novasaas-mobile-nav__list',
				'container'      => false,
				'fallback_cb'    => 'novasaas_mobile_nav_fallback',
				'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
				'depth'          => 2,
			)
		);
		?>
	</nav>

	<div class="novasaas-mobile-menu__footer">
		<a href="<?php echo esc_url( $cta_url ); ?>"
		   class="novasaas-btn novasaas-w-full">
			<?php echo esc_html( $cta_text ); ?>
		</a>
	</div>
</div>

<div id="novasaas-overlay"
	 class="novasaas-site-overlay"
	 aria-hidden="true"
	 tabindex="-1"></div>

<main id="novasaas-content" class="novasaas-main" tabindex="-1">

<?php
/**
 * Fallback for primary nav — shows a link to the WordPress menu admin.
 */
function novasaas_nav_fallback(): void {
	if ( current_user_can( 'edit_theme_options' ) ) {
		printf(
			'<ul class="novasaas-nav__list"><li class="nav-item"><a class="nav-link" href="%s">%s</a></li></ul>',
			esc_url( admin_url( 'nav-menus.php' ) ),
			esc_html__( 'Add a menu', 'novasaas' )
		);
	}
}

/**
 * Fallback for mobile nav — mirrors the primary menu.
 */
function novasaas_mobile_nav_fallback(): void {
	wp_nav_menu(
		array(
			'theme_location' => 'primary-menu',
			'menu_id'        => 'novasaas-menu-mobile-fallback',
			'menu_class'     => 'novasaas-mobile-nav__list',
			'container'      => false,
			'depth'          => 2,
		)
	);
}
?>

<style>
/* ── Header base ──────────────────────────────────────────────────────── */
.novasaas-header {
	position: fixed;
	top: 0;
	left: 0;
	right: 0;
	z-index: var(--novasaas-z-sticky);
	padding-block: 1.25rem;
	transition: background var(--novasaas-transition-base),
	            backdrop-filter var(--novasaas-transition-base),
	            padding var(--novasaas-transition-base),
	            box-shadow var(--novasaas-transition-base);
}

.novasaas-header.is-sticky {
	background: rgba(15, 10, 30, 0.92);
	backdrop-filter: blur(20px);
	-webkit-backdrop-filter: blur(20px);
	border-bottom: 1px solid var(--novasaas-border);
	padding-block: 0.875rem;
	box-shadow: 0 4px 24px rgba(0, 0, 0, 0.4);
}

.novasaas-header__inner {
	display: flex;
	align-items: center;
	gap: var(--novasaas-space-6);
}

/* ── Logo ─────────────────────────────────────────────────────────────── */
.novasaas-header__logo { flex-shrink: 0; }

.novasaas-logo--text {
	font-family: var(--novasaas-font-heading);
	font-size: var(--novasaas-text-xl);
	font-weight: var(--novasaas-weight-extrabold);
	letter-spacing: -0.02em;
}

/* ── Primary Nav ──────────────────────────────────────────────────────── */
.novasaas-header__nav {
	flex: 1;
	display: none;
}

@media (min-width: 1024px) {
	.novasaas-header__nav { display: flex; align-items: center; justify-content: center; }
}

.novasaas-nav__list {
	display: flex;
	align-items: center;
	gap: var(--novasaas-space-1);
	list-style: none;
}

.novasaas-nav__list .nav-item { position: relative; }

.novasaas-nav__list .nav-link {
	display: flex;
	align-items: center;
	gap: var(--novasaas-space-1);
	padding: 0.5rem 0.875rem;
	font-size: var(--novasaas-text-sm);
	font-weight: var(--novasaas-weight-medium);
	color: var(--novasaas-text-muted);
	border-radius: var(--novasaas-radius-md);
	transition: color var(--novasaas-transition-fast),
	            background var(--novasaas-transition-fast);
	white-space: nowrap;
}

.novasaas-nav__list .nav-link:hover,
.novasaas-nav__list .nav-link.active {
	color: var(--novasaas-text);
	background: rgba(99, 102, 241, 0.08);
}

.novasaas-nav__chevron {
	display: inline-flex;
	transition: transform var(--novasaas-transition-fast);
}

.nav-item.dropdown.is-open > .nav-link .novasaas-nav__chevron {
	transform: rotate(180deg);
}

/* ── Dropdown ─────────────────────────────────────────────────────────── */
.dropdown-menu {
	position: absolute;
	top: calc(100% + 0.5rem);
	left: 50%;
	transform: translateX(-50%) translateY(-8px);
	min-width: 220px;
	background: var(--novasaas-bg-card);
	border: 1px solid var(--novasaas-border);
	border-radius: var(--novasaas-radius-lg);
	box-shadow: var(--novasaas-shadow-xl);
	padding: 0.5rem;
	list-style: none;
	opacity: 0;
	visibility: hidden;
	pointer-events: none;
	transition: opacity var(--novasaas-transition-base),
	            transform var(--novasaas-transition-base),
	            visibility var(--novasaas-transition-base);
	z-index: var(--novasaas-z-dropdown);
}

.nav-item.dropdown.is-open > .novasaas-dropdown__wrapper > .dropdown-menu {
	opacity: 1;
	visibility: visible;
	pointer-events: auto;
	transform: translateX(-50%) translateY(0);
}

.dropdown-menu .dropdown-item {
	display: block;
	padding: 0.55rem 0.875rem;
	font-size: var(--novasaas-text-sm);
	color: var(--novasaas-text-muted);
	border-radius: var(--novasaas-radius-md);
	transition: color var(--novasaas-transition-fast),
	            background var(--novasaas-transition-fast);
}

.dropdown-menu .dropdown-item:hover,
.dropdown-menu .dropdown-item.active {
	color: var(--novasaas-text);
	background: rgba(99, 102, 241, 0.1);
}

/* ── Header Actions ───────────────────────────────────────────────────── */
.novasaas-header__actions {
	display: flex;
	align-items: center;
	gap: var(--novasaas-space-3);
	margin-left: auto;
}

.novasaas-header__cta { display: none; }

@media (min-width: 768px) {
	.novasaas-header__cta { display: inline-flex; }
}

/* ── Hamburger ────────────────────────────────────────────────────────── */
.novasaas-hamburger {
	display: flex;
	flex-direction: column;
	justify-content: center;
	align-items: center;
	gap: 5px;
	width: 44px;
	height: 44px;
	border-radius: var(--novasaas-radius-md);
	background: rgba(99, 102, 241, 0.1);
	border: 1px solid var(--novasaas-border);
	cursor: pointer;
	transition: background var(--novasaas-transition-fast);
}

.novasaas-hamburger:hover {
	background: rgba(99, 102, 241, 0.2);
}

@media (min-width: 1024px) {
	.novasaas-hamburger { display: none; }
}

.novasaas-hamburger__bar {
	display: block;
	width: 20px;
	height: 2px;
	background: var(--novasaas-text);
	border-radius: 2px;
	transition: transform var(--novasaas-transition-base),
	            opacity var(--novasaas-transition-fast),
	            width var(--novasaas-transition-fast);
	transform-origin: center;
}

.novasaas-hamburger[aria-expanded="true"] .novasaas-hamburger__bar:nth-child(1) {
	transform: translateY(7px) rotate(45deg);
}

.novasaas-hamburger[aria-expanded="true"] .novasaas-hamburger__bar:nth-child(2) {
	opacity: 0;
	width: 0;
}

.novasaas-hamburger[aria-expanded="true"] .novasaas-hamburger__bar:nth-child(3) {
	transform: translateY(-7px) rotate(-45deg);
}

/* ── Mobile Menu ──────────────────────────────────────────────────────── */
.novasaas-mobile-menu {
	position: fixed;
	top: 0;
	right: 0;
	width: min(360px, 100vw);
	height: 100dvh;
	background: var(--novasaas-bg-card);
	border-left: 1px solid var(--novasaas-border);
	z-index: var(--novasaas-z-modal);
	display: flex;
	flex-direction: column;
	padding: var(--novasaas-space-6);
	gap: var(--novasaas-space-6);
	transform: translateX(100%);
	transition: transform var(--novasaas-transition-slow);
	overflow-y: auto;
}

.novasaas-mobile-menu:not([hidden]) {
	transform: translateX(0);
}

/* hidden attr support — override display:none so we can animate */
.novasaas-mobile-menu[hidden] {
	display: flex !important;
	transform: translateX(100%);
	visibility: hidden;
}

.novasaas-mobile-menu__header {
	display: flex;
	align-items: center;
	justify-content: space-between;
}

.novasaas-mobile-menu__close {
	display: flex;
	align-items: center;
	justify-content: center;
	width: 40px;
	height: 40px;
	border-radius: var(--novasaas-radius-full);
	background: rgba(255, 255, 255, 0.06);
	color: var(--novasaas-text-muted);
	border: 1px solid var(--novasaas-border);
	transition: color var(--novasaas-transition-fast),
	            background var(--novasaas-transition-fast);
}

.novasaas-mobile-menu__close:hover {
	color: var(--novasaas-text);
	background: rgba(99, 102, 241, 0.15);
}

.novasaas-mobile-menu__nav { flex: 1; }

.novasaas-mobile-nav__list {
	list-style: none;
	display: flex;
	flex-direction: column;
	gap: 2px;
}

.novasaas-mobile-nav__list .nav-item > a,
.novasaas-mobile-nav__list .nav-item > .nav-link {
	display: flex;
	align-items: center;
	padding: 0.75rem 1rem;
	font-size: var(--novasaas-text-base);
	font-weight: var(--novasaas-weight-medium);
	color: var(--novasaas-text-muted);
	border-radius: var(--novasaas-radius-md);
	transition: color var(--novasaas-transition-fast),
	            background var(--novasaas-transition-fast);
}

.novasaas-mobile-nav__list .nav-item > a:hover,
.novasaas-mobile-nav__list .nav-item.active > a {
	color: var(--novasaas-text);
	background: rgba(99, 102, 241, 0.1);
}

.novasaas-mobile-nav__list .dropdown-menu {
	position: static;
	transform: none;
	opacity: 1;
	visibility: visible;
	pointer-events: auto;
	background: transparent;
	border: none;
	box-shadow: none;
	padding-left: var(--novasaas-space-4);
	padding-top: var(--novasaas-space-1);
}

.novasaas-mobile-menu__footer {
	padding-top: var(--novasaas-space-4);
	border-top: 1px solid var(--novasaas-border-subtle);
}

/* ── Site overlay ─────────────────────────────────────────────────────── */
.novasaas-site-overlay {
	position: fixed;
	inset: 0;
	background: rgba(0, 0, 0, 0.6);
	backdrop-filter: blur(4px);
	z-index: calc(var(--novasaas-z-modal) - 1);
	opacity: 0;
	visibility: hidden;
	transition: opacity var(--novasaas-transition-slow),
	            visibility var(--novasaas-transition-slow);
}

.novasaas-site-overlay.is-active {
	opacity: 1;
	visibility: visible;
}

/* ── Offset content below fixed header ───────────────────────────────── */
.novasaas-main {
	padding-top: 80px;
}
</style>

<script>
( function () {
	'use strict';

	/* ── Sticky header on scroll ───────────────────────────────────────── */
	const header  = document.getElementById( 'novasaas-header' );
	const STICKY_THRESHOLD = 60;

	if ( header ) {
		let ticking = false;

		const onScroll = function () {
			if ( ! ticking ) {
				window.requestAnimationFrame( function () {
					if ( window.scrollY > STICKY_THRESHOLD ) {
						header.classList.add( 'is-sticky' );
					} else {
						header.classList.remove( 'is-sticky' );
					}
					ticking = false;
				} );
				ticking = true;
			}
		};

		window.addEventListener( 'scroll', onScroll, { passive: true } );
		onScroll();
	}

	/* ── Mobile menu toggle ────────────────────────────────────────────── */
	const mobileMenu    = document.getElementById( 'novasaas-mobile-menu' );
	const menuToggle    = document.getElementById( 'novasaas-menu-toggle' );
	const menuClose     = document.getElementById( 'novasaas-menu-close' );
	const siteOverlay   = document.getElementById( 'novasaas-overlay' );
	const FOCUSABLE_SEL = 'a[href], button:not([disabled]), [tabindex]:not([tabindex="-1"])';

	function openMenu() {
		if ( ! mobileMenu || ! menuToggle ) { return; }
		mobileMenu.removeAttribute( 'hidden' );
		mobileMenu.style.visibility = '';
		menuToggle.setAttribute( 'aria-expanded', 'true' );
		if ( siteOverlay ) { siteOverlay.classList.add( 'is-active' ); }
		document.body.style.overflow = 'hidden';

		const firstFocusable = mobileMenu.querySelector( FOCUSABLE_SEL );
		if ( firstFocusable ) { firstFocusable.focus(); }
	}

	function closeMenu() {
		if ( ! mobileMenu || ! menuToggle ) { return; }
		mobileMenu.setAttribute( 'hidden', '' );
		menuToggle.setAttribute( 'aria-expanded', 'false' );
		if ( siteOverlay ) { siteOverlay.classList.remove( 'is-active' ); }
		document.body.style.overflow = '';
		menuToggle.focus();
	}

	if ( menuToggle )  { menuToggle.addEventListener( 'click', openMenu ); }
	if ( menuClose )   { menuClose.addEventListener( 'click', closeMenu ); }
	if ( siteOverlay ) { siteOverlay.addEventListener( 'click', closeMenu ); }

	// Trap focus inside mobile menu.
	if ( mobileMenu ) {
		mobileMenu.addEventListener( 'keydown', function ( e ) {
			if ( 'Escape' === e.key ) { closeMenu(); return; }
			if ( 'Tab' !== e.key )    { return; }

			const focusable = Array.from( mobileMenu.querySelectorAll( FOCUSABLE_SEL ) );
			const first     = focusable[ 0 ];
			const last      = focusable[ focusable.length - 1 ];

			if ( e.shiftKey ) {
				if ( document.activeElement === first ) { e.preventDefault(); last.focus(); }
			} else {
				if ( document.activeElement === last )  { e.preventDefault(); first.focus(); }
			}
		} );
	}

	/* ── Desktop dropdown keyboard + hover ─────────────────────────────── */
	const dropdowns = document.querySelectorAll( '.novasaas-nav__list .dropdown' );

	dropdowns.forEach( function ( item ) {
		const trigger = item.querySelector( '[data-novasaas-toggle="dropdown"]' );
		if ( ! trigger ) { return; }

		// Hover open/close.
		item.addEventListener( 'mouseenter', function () {
			item.classList.add( 'is-open' );
		} );
		item.addEventListener( 'mouseleave', function () {
			item.classList.remove( 'is-open' );
		} );

		// Keyboard toggle.
		trigger.addEventListener( 'keydown', function ( e ) {
			if ( ' ' === e.key || 'Enter' === e.key || 'ArrowDown' === e.key ) {
				e.preventDefault();
				const isOpen = item.classList.contains( 'is-open' );
				if ( isOpen ) {
					item.classList.remove( 'is-open' );
					trigger.setAttribute( 'aria-expanded', 'false' );
				} else {
					dropdowns.forEach( function ( d ) {
						d.classList.remove( 'is-open' );
						const t = d.querySelector( '[data-novasaas-toggle="dropdown"]' );
						if ( t ) { t.setAttribute( 'aria-expanded', 'false' ); }
					} );
					item.classList.add( 'is-open' );
					trigger.setAttribute( 'aria-expanded', 'true' );
				}
			}
			if ( 'Escape' === e.key ) {
				item.classList.remove( 'is-open' );
				trigger.setAttribute( 'aria-expanded', 'false' );
				trigger.focus();
			}
		} );
	} );

	// Close dropdowns on outside click.
	document.addEventListener( 'click', function ( e ) {
		dropdowns.forEach( function ( item ) {
			if ( ! item.contains( e.target ) ) {
				item.classList.remove( 'is-open' );
				const t = item.querySelector( '[data-novasaas-toggle="dropdown"]' );
				if ( t ) { t.setAttribute( 'aria-expanded', 'false' ); }
			}
		} );
	} );

} () );
</script>
