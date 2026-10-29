<?php
/**
 * 404 Error Page Template
 *
 * @package NovaSaaS
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<section class="novasaas-404 novasaas-section novasaas-section--lg">

	<!-- Decorative background glows -->
	<div class="novasaas-404__glow novasaas-404__glow--left"  aria-hidden="true"></div>
	<div class="novasaas-404__glow novasaas-404__glow--right" aria-hidden="true"></div>

	<div class="novasaas-container">
		<div class="novasaas-404__inner">

			<!-- ── Big 404 ────────────────────────────────────────────── -->
			<div class="novasaas-404__number novasaas-gradient-text novasaas-reveal"
				 aria-hidden="true">
				404
			</div>

			<!-- ── Headline ───────────────────────────────────────────── -->
			<h1 class="novasaas-404__title novasaas-reveal novasaas-delay-1">
				<?php esc_html_e( 'Page not found', 'novasaas' ); ?>
			</h1>

			<!-- ── Subtext ────────────────────────────────────────────── -->
			<p class="novasaas-404__desc novasaas-reveal novasaas-delay-2">
				<?php
				esc_html_e(
					'Oops! The page you\'re looking for has been moved, deleted, or never existed. Let\'s get you back on track.',
					'novasaas'
				);
				?>
			</p>

			<!-- ── Search ─────────────────────────────────────────────── -->
			<div class="novasaas-404__search novasaas-reveal novasaas-delay-3">
				<p class="novasaas-404__search-label">
					<?php esc_html_e( 'Try searching for what you need:', 'novasaas' ); ?>
				</p>

				<form role="search"
					  method="get"
					  class="novasaas-404__search-form"
					  action="<?php echo esc_url( home_url( '/' ) ); ?>">

					<label class="novasaas-sr-only" for="novasaas-404-search">
						<?php esc_html_e( 'Search for:', 'novasaas' ); ?>
					</label>

					<div class="novasaas-404__search-wrap">
						<input type="search"
							   id="novasaas-404-search"
							   class="novasaas-input novasaas-404__search-input"
							   name="s"
							   placeholder="<?php esc_attr_e( 'Search StreamFlow docs, features…', 'novasaas' ); ?>"
							   value="<?php echo esc_attr( get_search_query() ); ?>"
							   autocomplete="off"
							   spellcheck="false">

						<button type="submit" class="novasaas-404__search-btn novasaas-btn" aria-label="<?php esc_attr_e( 'Search', 'novasaas' ); ?>">
							<svg width="18" height="18" viewBox="0 0 18 18" fill="none" aria-hidden="true">
								<path d="M8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12ZM16 16l-3.5-3.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>
							<span><?php esc_html_e( 'Search', 'novasaas' ); ?></span>
						</button>
					</div>

				</form>
			</div>

			<!-- ── Suggested links ────────────────────────────────────── -->
			<div class="novasaas-404__suggestions novasaas-reveal novasaas-delay-4">
				<p class="novasaas-404__suggestions-label">
					<?php esc_html_e( 'Or explore these pages:', 'novasaas' ); ?>
				</p>
				<div class="novasaas-404__suggestions-links">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>"
					   class="novasaas-btn novasaas-btn--lg">
						<svg width="18" height="18" viewBox="0 0 18 18" fill="none" aria-hidden="true">
							<path d="M1 9L9 2l8 7M3 7.5V16h4v-4h4v4h4V7.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>
						<?php esc_html_e( 'Back to Home', 'novasaas' ); ?>
					</a>

					<?php if ( has_nav_menu( 'primary-menu' ) ) : ?>
						<a href="<?php echo esc_url( home_url( '/#pricing' ) ); ?>"
						   class="novasaas-btn-outline novasaas-btn-outline--lg">
							<?php esc_html_e( 'View Pricing', 'novasaas' ); ?>
						</a>
					<?php endif; ?>
				</div>
			</div>

			<!-- ── Popular posts widget area ──────────────────────────── -->
			<?php if ( is_active_sidebar( 'novasaas-404-popular' ) ) : ?>
				<div class="novasaas-404__popular novasaas-reveal novasaas-delay-5">
					<h2 class="novasaas-404__popular-title">
						<?php esc_html_e( 'Popular Articles', 'novasaas' ); ?>
					</h2>
					<div class="novasaas-glass-card novasaas-glass-card--no-hover novasaas-404__popular-widget">
						<?php dynamic_sidebar( 'novasaas-404-popular' ); ?>
					</div>
				</div>
			<?php else : ?>
				<?php
				// Fallback — show last 3 posts.
				$recent = new WP_Query(
					array(
						'post_type'           => 'post',
						'posts_per_page'      => 3,
						'post_status'         => 'publish',
						'ignore_sticky_posts' => true,
						'no_found_rows'       => true,
					)
				);

				if ( $recent->have_posts() ) :
					?>
					<div class="novasaas-404__popular novasaas-reveal novasaas-delay-5">
						<h2 class="novasaas-404__popular-title">
							<?php esc_html_e( 'Latest Articles', 'novasaas' ); ?>
						</h2>
						<div class="novasaas-404__popular-grid">
							<?php
							while ( $recent->have_posts() ) :
								$recent->the_post();
								?>
								<a href="<?php the_permalink(); ?>"
								   class="novasaas-404__popular-item novasaas-glass-card">

									<?php if ( has_post_thumbnail() ) : ?>
										<div class="novasaas-404__popular-thumb">
											<?php
											the_post_thumbnail(
												'novasaas-thumb',
												array(
													'loading' => 'lazy',
													'alt'     => esc_attr( get_the_title() ),
												)
											);
											?>
										</div>
									<?php endif; ?>

									<div class="novasaas-404__popular-text">
										<span class="novasaas-404__popular-item-title">
											<?php the_title(); ?>
										</span>
										<span class="novasaas-404__popular-date">
											<?php echo esc_html( get_the_date() ); ?>
										</span>
									</div>

								</a>
							<?php endwhile; ?>
							<?php wp_reset_postdata(); ?>
						</div>
					</div>
				<?php endif; ?>
			<?php endif; ?>

		</div><!-- /.novasaas-404__inner -->
	</div><!-- /.novasaas-container -->
</section>

<style>
/* ── 404 Page ─────────────────────────────────────────────────────────── */
.novasaas-404 {
	min-height: calc(100dvh - 80px);
	display: flex;
	align-items: center;
}

.novasaas-404__inner {
	display: flex;
	flex-direction: column;
	align-items: center;
	text-align: center;
	gap: var(--novasaas-space-8);
	position: relative;
	z-index: 1;
}

/* ── 404 number ───────────────────────────────────────────────────────── */
.novasaas-404__number {
	font-family: var(--novasaas-font-heading);
	font-size: clamp(6rem, 20vw, 14rem);
	font-weight: var(--novasaas-weight-extrabold);
	line-height: 1;
	letter-spacing: -0.04em;
	user-select: none;
	filter: drop-shadow(0 0 60px rgba(99, 102, 241, 0.3));
}

/* ── Headline ─────────────────────────────────────────────────────────── */
.novasaas-404__title {
	font-size: var(--novasaas-text-5xl);
	font-weight: var(--novasaas-weight-extrabold);
	margin: 0;
}

/* ── Description ──────────────────────────────────────────────────────── */
.novasaas-404__desc {
	max-width: 500px;
	font-size: var(--novasaas-text-lg);
	color: var(--novasaas-text-muted);
	margin: 0;
}

/* ── Search ───────────────────────────────────────────────────────────── */
.novasaas-404__search {
	width: 100%;
	max-width: 560px;
	display: flex;
	flex-direction: column;
	gap: var(--novasaas-space-3);
}

.novasaas-404__search-label {
	font-size: var(--novasaas-text-sm);
	color: var(--novasaas-text-muted);
	margin: 0;
}

.novasaas-404__search-wrap {
	display: flex;
	gap: var(--novasaas-space-2);
}

.novasaas-404__search-input {
	flex: 1;
	border-radius: var(--novasaas-radius-full);
}

.novasaas-404__search-btn {
	flex-shrink: 0;
	white-space: nowrap;
}

/* ── Suggestion links ─────────────────────────────────────────────────── */
.novasaas-404__suggestions {
	display: flex;
	flex-direction: column;
	align-items: center;
	gap: var(--novasaas-space-4);
}

.novasaas-404__suggestions-label {
	font-size: var(--novasaas-text-sm);
	color: var(--novasaas-text-muted);
	margin: 0;
}

.novasaas-404__suggestions-links {
	display: flex;
	flex-wrap: wrap;
	gap: var(--novasaas-space-3);
	justify-content: center;
}

/* ── Popular posts ────────────────────────────────────────────────────── */
.novasaas-404__popular {
	width: 100%;
	max-width: 800px;
	display: flex;
	flex-direction: column;
	gap: var(--novasaas-space-5);
}

.novasaas-404__popular-title {
	font-size: var(--novasaas-text-xl);
	font-weight: var(--novasaas-weight-bold);
	color: var(--novasaas-text);
	margin: 0;
}

.novasaas-404__popular-widget {
	padding: var(--novasaas-space-6);
	text-align: left;
}

.novasaas-404__popular-grid {
	display: grid;
	gap: var(--novasaas-space-4);
	grid-template-columns: 1fr;
}

@media (min-width: 640px) {
	.novasaas-404__popular-grid { grid-template-columns: repeat(3, 1fr); }
}

.novasaas-404__popular-item {
	display: flex;
	flex-direction: column;
	gap: 0;
	padding: 0;
	overflow: hidden;
	text-align: left;
	transition: transform var(--novasaas-transition-base),
	            box-shadow var(--novasaas-transition-base);
}

.novasaas-404__popular-thumb {
	aspect-ratio: 16 / 9;
	overflow: hidden;
}

.novasaas-404__popular-thumb img {
	width: 100%;
	height: 100%;
	object-fit: cover;
	transition: transform var(--novasaas-transition-slow);
}

.novasaas-404__popular-item:hover .novasaas-404__popular-thumb img {
	transform: scale(1.05);
}

.novasaas-404__popular-text {
	display: flex;
	flex-direction: column;
	gap: var(--novasaas-space-2);
	padding: var(--novasaas-space-4);
}

.novasaas-404__popular-item-title {
	font-size: var(--novasaas-text-sm);
	font-weight: var(--novasaas-weight-semibold);
	color: var(--novasaas-text);
	line-height: var(--novasaas-leading-snug);
	display: -webkit-box;
	-webkit-line-clamp: 2;
	-webkit-box-orient: vertical;
	overflow: hidden;
}

.novasaas-404__popular-date {
	font-size: var(--novasaas-text-xs);
	color: var(--novasaas-text-faint);
}

/* ── Background glows ─────────────────────────────────────────────────── */
.novasaas-404__glow {
	position: absolute;
	width: 500px;
	height: 500px;
	border-radius: 50%;
	pointer-events: none;
	z-index: 0;
}

.novasaas-404__glow--left {
	background: radial-gradient(circle, rgba(99, 102, 241, 0.12) 0%, transparent 70%);
	top: 10%;
	left: -15%;
}

.novasaas-404__glow--right {
	background: radial-gradient(circle, rgba(236, 72, 153, 0.1) 0%, transparent 70%);
	bottom: 10%;
	right: -15%;
}
</style>

<?php get_footer(); ?>
