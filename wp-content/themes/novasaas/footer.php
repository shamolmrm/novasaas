<?php
/**
 * Theme Footer Template
 *
 * @package NovaSaaS
 * @version 1.0.0
 */
?>
</main><!-- #novasaas-content -->

<?php
$copyright_text = novasaas_get_option(
	'footer_copyright',
	sprintf(
		/* translators: %s: current year */
		__( '&copy; %s StreamFlow. All rights reserved.', 'novasaas' ),
		esc_html( date( 'Y' ) )
	)
);

// Social links from Customizer.
$social_links = array(
	'twitter'  => array(
		'url'   => novasaas_get_option( 'social_twitter', '' ),
		'label' => __( 'Twitter / X', 'novasaas' ),
		'icon'  => '<svg viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.744l7.73-8.835L2.003 2.25h6.961l4.259 5.63 5.021-5.63Zm-1.161 17.52h1.833L7.084 4.126H5.117L17.083 19.77Z"/></svg>',
	),
	'linkedin' => array(
		'url'   => novasaas_get_option( 'social_linkedin', '' ),
		'label' => __( 'LinkedIn', 'novasaas' ),
		'icon'  => '<svg viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 0 1-2.063-2.065 2.064 2.064 0 1 1 2.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>',
	),
	'github'   => array(
		'url'   => novasaas_get_option( 'social_github', '' ),
		'label' => __( 'GitHub', 'novasaas' ),
		'icon'  => '<svg viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M12 .297c-6.63 0-12 5.373-12 12 0 5.303 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61C4.422 18.07 3.633 17.7 3.633 17.7c-1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.42.36.81 1.096.81 2.22 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 22.092 24 17.592 24 12.297c0-6.627-5.373-12-12-12"/></svg>',
	),
	'youtube'  => array(
		'url'   => novasaas_get_option( 'social_youtube', '' ),
		'label' => __( 'YouTube', 'novasaas' ),
		'icon'  => '<svg viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>',
	),
);
?>

<!-- ═══════════════════════════════════════════════════════════════════════
     SITE FOOTER
     ════════════════════════════════════════════════════════════════════ -->
<footer id="novasaas-footer" class="novasaas-footer" role="contentinfo">

	<!-- ── Footer Widget Row ──────────────────────────────────────────── -->
	<?php if ( is_active_sidebar( 'novasaas-footer-1' ) || is_active_sidebar( 'novasaas-footer-2' ) || is_active_sidebar( 'novasaas-footer-3' ) ) : ?>
		<div class="novasaas-footer__widgets">
			<div class="novasaas-container">
				<div class="novasaas-footer__widgets-grid">

					<?php if ( is_active_sidebar( 'novasaas-footer-1' ) ) : ?>
						<div class="novasaas-footer__col novasaas-footer__col--1">
							<?php dynamic_sidebar( 'novasaas-footer-1' ); ?>
						</div>
					<?php endif; ?>

					<?php if ( is_active_sidebar( 'novasaas-footer-2' ) ) : ?>
						<div class="novasaas-footer__col novasaas-footer__col--2">
							<?php dynamic_sidebar( 'novasaas-footer-2' ); ?>
						</div>
					<?php endif; ?>

					<?php if ( is_active_sidebar( 'novasaas-footer-3' ) ) : ?>
						<div class="novasaas-footer__col novasaas-footer__col--3">
							<?php dynamic_sidebar( 'novasaas-footer-3' ); ?>
						</div>
					<?php endif; ?>

				</div><!-- /.novasaas-footer__widgets-grid -->
			</div>
		</div><!-- /.novasaas-footer__widgets -->
	<?php endif; ?>

	<!-- ── Footer Bottom Bar ──────────────────────────────────────────── -->
	<div class="novasaas-footer__bottom">
		<div class="novasaas-container">
			<div class="novasaas-footer__bottom-inner">

				<!-- Copyright -->
				<p class="novasaas-footer__copyright">
					<?php echo wp_kses_post( $copyright_text ); ?>
				</p>

				<!-- Footer Nav -->
				<?php if ( has_nav_menu( 'footer-menu' ) ) : ?>
					<nav class="novasaas-footer__nav"
						 aria-label="<?php esc_attr_e( 'Footer Navigation', 'novasaas' ); ?>">
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'footer-menu',
								'menu_id'        => 'novasaas-menu-footer',
								'menu_class'     => 'novasaas-footer__nav-list',
								'container'      => false,
								'depth'          => 1,
								'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
								'fallback_cb'    => false,
							)
						);
						?>
					</nav>
				<?php endif; ?>

				<!-- Social Icons -->
				<div class="novasaas-footer__social" role="list" aria-label="<?php esc_attr_e( 'Social media links', 'novasaas' ); ?>">
					<?php foreach ( $social_links as $network => $data ) : ?>
						<?php if ( ! empty( $data['url'] ) ) : ?>
							<a href="<?php echo esc_url( $data['url'] ); ?>"
							   class="novasaas-footer__social-link novasaas-footer__social-link--<?php echo esc_attr( $network ); ?>"
							   target="_blank"
							   rel="noopener noreferrer"
							   role="listitem"
							   aria-label="<?php echo esc_attr( $data['label'] ); ?>">
								<?php echo $data['icon']; // SVG is hardcoded — no user input, safe to output. ?>
							</a>
						<?php endif; ?>
					<?php endforeach; ?>
				</div>

			</div><!-- /.novasaas-footer__bottom-inner -->
		</div>
	</div><!-- /.novasaas-footer__bottom -->

</footer><!-- #novasaas-footer -->

<!-- ── Back to Top ────────────────────────────────────────────────────── -->
<button type="button"
		id="novasaas-back-to-top"
		class="novasaas-back-to-top"
		aria-label="<?php esc_attr_e( 'Back to top', 'novasaas' ); ?>"
		hidden>
	<svg width="20" height="20" viewBox="0 0 20 20" fill="none" aria-hidden="true">
		<path d="M10 15V5M10 5L5 10M10 5l5 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
	</svg>
</button>

<?php wp_footer(); ?>

<style>
/* ── Footer base ──────────────────────────────────────────────────────── */
.novasaas-footer {
	background: var(--novasaas-bg-dark);
	border-top: 1px solid var(--novasaas-border-subtle);
	position: relative;
}

.novasaas-footer::before {
	content: '';
	position: absolute;
	top: 0;
	left: 0;
	right: 0;
	height: 1px;
	background: var(--novasaas-gradient-primary);
	opacity: 0.4;
}

/* ── Widget row ───────────────────────────────────────────────────────── */
.novasaas-footer__widgets {
	padding-block: clamp(3rem, 7vw, 5rem);
	border-bottom: 1px solid var(--novasaas-border-subtle);
}

.novasaas-footer__widgets-grid {
	display: grid;
	gap: var(--novasaas-space-10);
	grid-template-columns: 1fr;
}

@media (min-width: 640px) {
	.novasaas-footer__widgets-grid { grid-template-columns: repeat(2, 1fr); }
}

@media (min-width: 1024px) {
	.novasaas-footer__widgets-grid { grid-template-columns: 2fr 1fr 1fr; }
}

.novasaas-footer__col .widget-title {
	font-family: var(--novasaas-font-heading);
	font-size: var(--novasaas-text-sm);
	font-weight: var(--novasaas-weight-semibold);
	text-transform: uppercase;
	letter-spacing: 0.1em;
	color: var(--novasaas-text-muted);
	margin-bottom: var(--novasaas-space-5);
}

.novasaas-footer__col .widget { background: none; border: none; box-shadow: none; padding: 0; }

/* ── Bottom bar ───────────────────────────────────────────────────────── */
.novasaas-footer__bottom {
	padding-block: var(--novasaas-space-6);
}

.novasaas-footer__bottom-inner {
	display: flex;
	flex-wrap: wrap;
	align-items: center;
	justify-content: center;
	gap: var(--novasaas-space-5);
	text-align: center;
}

@media (min-width: 768px) {
	.novasaas-footer__bottom-inner {
		justify-content: space-between;
		text-align: left;
	}
}

.novasaas-footer__copyright {
	font-size: var(--novasaas-text-sm);
	color: var(--novasaas-text-muted);
	margin: 0;
	line-height: 1.5;
}

/* ── Footer nav ───────────────────────────────────────────────────────── */
.novasaas-footer__nav-list {
	display: flex;
	flex-wrap: wrap;
	align-items: center;
	gap: var(--novasaas-space-1);
	list-style: none;
}

.novasaas-footer__nav-list li a {
	font-size: var(--novasaas-text-sm);
	color: var(--novasaas-text-muted);
	padding: 0.25rem 0.625rem;
	border-radius: var(--novasaas-radius-sm);
	transition: color var(--novasaas-transition-fast),
	            background var(--novasaas-transition-fast);
}

.novasaas-footer__nav-list li a:hover {
	color: var(--novasaas-text);
	background: rgba(99, 102, 241, 0.08);
}

/* ── Social icons ─────────────────────────────────────────────────────── */
.novasaas-footer__social {
	display: flex;
	align-items: center;
	gap: var(--novasaas-space-2);
}

.novasaas-footer__social-link {
	display: flex;
	align-items: center;
	justify-content: center;
	width: 38px;
	height: 38px;
	border-radius: var(--novasaas-radius-md);
	background: rgba(255, 255, 255, 0.05);
	border: 1px solid var(--novasaas-border-subtle);
	color: var(--novasaas-text-muted);
	transition: color var(--novasaas-transition-fast),
	            background var(--novasaas-transition-fast),
	            border-color var(--novasaas-transition-fast),
	            transform var(--novasaas-transition-fast);
}

.novasaas-footer__social-link svg {
	width: 16px;
	height: 16px;
}

.novasaas-footer__social-link:hover {
	color: var(--novasaas-text);
	background: rgba(99, 102, 241, 0.15);
	border-color: var(--novasaas-border-hover);
	transform: translateY(-2px);
}

.novasaas-footer__social-link--twitter:hover  { color: #1D9BF0; border-color: rgba(29, 155, 240, 0.4); }
.novasaas-footer__social-link--linkedin:hover { color: #0A66C2; border-color: rgba(10, 102, 194, 0.4); }
.novasaas-footer__social-link--github:hover   { color: #f0f6fc; border-color: rgba(240, 246, 252, 0.3); }
.novasaas-footer__social-link--youtube:hover  { color: #FF0000; border-color: rgba(255, 0, 0, 0.4); }

/* ── Back to top ──────────────────────────────────────────────────────── */
.novasaas-back-to-top {
	position: fixed;
	bottom: var(--novasaas-space-8);
	right: var(--novasaas-space-8);
	width: 48px;
	height: 48px;
	border-radius: var(--novasaas-radius-full);
	background: var(--novasaas-gradient-primary);
	color: #fff;
	display: flex;
	align-items: center;
	justify-content: center;
	box-shadow: 0 4px 20px rgba(99, 102, 241, 0.4);
	z-index: var(--novasaas-z-raised);
	transition: opacity var(--novasaas-transition-base),
	            transform var(--novasaas-transition-spring),
	            box-shadow var(--novasaas-transition-fast);
	opacity: 0;
	transform: translateY(16px) scale(0.8);
}

.novasaas-back-to-top:not([hidden]) {
	opacity: 1;
	transform: translateY(0) scale(1);
}

.novasaas-back-to-top[hidden] {
	display: flex !important;
	opacity: 0;
	pointer-events: none;
	transform: translateY(16px) scale(0.8);
}

.novasaas-back-to-top:hover {
	box-shadow: 0 8px 30px rgba(99, 102, 241, 0.55);
	transform: translateY(-3px) scale(1.05);
}
</style>

<script>
( function () {
	'use strict';

	/* ── Back to top ───────────────────────────────────────────────────── */
	const btn            = document.getElementById( 'novasaas-back-to-top' );
	const SHOW_THRESHOLD = 400;

	if ( ! btn ) { return; }

	let ticking = false;

	const toggleBtn = function () {
		if ( ! ticking ) {
			window.requestAnimationFrame( function () {
				if ( window.scrollY > SHOW_THRESHOLD ) {
					btn.removeAttribute( 'hidden' );
				} else {
					btn.setAttribute( 'hidden', '' );
				}
				ticking = false;
			} );
			ticking = true;
		}
	};

	window.addEventListener( 'scroll', toggleBtn, { passive: true } );
	toggleBtn();

	btn.addEventListener( 'click', function () {
		window.scrollTo( { top: 0, behavior: 'smooth' } );
	} );

} () );
</script>

</body>
</html>
