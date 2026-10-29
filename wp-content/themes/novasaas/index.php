<?php
/**
 * Main index template — fallback for all views.
 *
 * WordPress falls back to this when no more specific template exists.
 * On a fresh install with no front-page set it shows the blog loop;
 * on a configured site it should rarely be reached.
 *
 * @package NovaSaaS
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<section class="novasaas-section novasaas-section--dark">
	<div class="novasaas-container">

		<?php if ( is_home() && ! is_front_page() ) : ?>
			<div class="novasaas-section__header">
				<h1 class="novasaas-section__title">
					<?php esc_html_e( 'Latest Posts', 'novasaas' ); ?>
				</h1>
			</div>
		<?php endif; ?>

		<?php if ( have_posts() ) : ?>

			<div class="novasaas-blog-grid novasaas-grid novasaas-grid--3">
				<?php
				while ( have_posts() ) :
					the_post();
					?>
					<article id="post-<?php the_ID(); ?>"
							 <?php post_class( 'novasaas-glass-card novasaas-post-card' ); ?>>

						<?php if ( has_post_thumbnail() ) : ?>
							<a href="<?php the_permalink(); ?>"
							   class="novasaas-post-card__thumb"
							   tabindex="-1"
							   aria-hidden="true">
								<?php
								the_post_thumbnail(
									'novasaas-blog',
									array(
										'class'   => 'novasaas-post-card__img',
										'loading' => 'lazy',
										'alt'     => esc_attr( get_the_title() ),
									)
								);
								?>
							</a>
						<?php endif; ?>

						<div class="novasaas-post-card__body">

							<?php
							$categories = get_the_category();
							if ( ! empty( $categories ) ) :
								?>
								<a href="<?php echo esc_url( get_category_link( $categories[0]->term_id ) ); ?>"
								   class="novasaas-badge novasaas-badge--primary novasaas-post-card__cat">
									<?php echo esc_html( $categories[0]->name ); ?>
								</a>
							<?php endif; ?>

							<h2 class="novasaas-post-card__title">
								<a href="<?php the_permalink(); ?>">
									<?php the_title(); ?>
								</a>
							</h2>

							<p class="novasaas-post-card__excerpt">
								<?php echo esc_html( novasaas_truncate( get_the_excerpt(), 120 ) ); ?>
							</p>

							<div class="novasaas-post-card__meta">
								<span class="novasaas-post-card__date">
									<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
										<?php echo esc_html( get_the_date() ); ?>
									</time>
								</span>
								<span class="novasaas-post-card__read-time">
									<?php echo esc_html( novasaas_get_reading_time( get_the_ID() ) ); ?>
								</span>
							</div>

						</div><!-- /.novasaas-post-card__body -->

					</article>
				<?php endwhile; ?>
			</div><!-- /.novasaas-blog-grid -->

			<?php
			the_posts_pagination(
				array(
					'mid_size'           => 2,
					'prev_text'          => esc_html__( '&larr; Previous', 'novasaas' ),
					'next_text'          => esc_html__( 'Next &rarr;', 'novasaas' ),
					'before_page_number' => '<span class="novasaas-sr-only">' . esc_html__( 'Page', 'novasaas' ) . ' </span>',
					'class'              => 'novasaas-pagination',
				)
			);
			?>

		<?php else : ?>

			<div class="novasaas-no-results">
				<div class="novasaas-no-results__inner novasaas-glass-card">
					<p class="novasaas-no-results__emoji" aria-hidden="true">&#128269;</p>
					<h2><?php esc_html_e( 'Nothing found', 'novasaas' ); ?></h2>
					<p><?php esc_html_e( 'It looks like nothing was found at this location.', 'novasaas' ); ?></p>
					<?php get_search_form(); ?>
				</div>
			</div>

		<?php endif; ?>

	</div><!-- /.novasaas-container -->
</section>

<style>
.novasaas-post-card {
	display: flex;
	flex-direction: column;
	overflow: hidden;
	padding: 0;
}

.novasaas-post-card__thumb {
	display: block;
	overflow: hidden;
	aspect-ratio: 16 / 9;
}

.novasaas-post-card__img {
	width: 100%;
	height: 100%;
	object-fit: cover;
	transition: transform var(--novasaas-transition-slow);
}

.novasaas-post-card:hover .novasaas-post-card__img {
	transform: scale(1.04);
}

.novasaas-post-card__body {
	display: flex;
	flex-direction: column;
	gap: var(--novasaas-space-3);
	padding: var(--novasaas-space-6);
	flex: 1;
}

.novasaas-post-card__title {
	font-size: var(--novasaas-text-xl);
	font-weight: var(--novasaas-weight-bold);
	line-height: var(--novasaas-leading-snug);
	margin: 0;
}

.novasaas-post-card__title a {
	color: var(--novasaas-text);
	transition: color var(--novasaas-transition-fast);
}

.novasaas-post-card__title a:hover {
	color: var(--novasaas-primary-light);
}

.novasaas-post-card__excerpt {
	font-size: var(--novasaas-text-sm);
	color: var(--novasaas-text-muted);
	margin: 0;
	flex: 1;
}

.novasaas-post-card__meta {
	display: flex;
	align-items: center;
	gap: var(--novasaas-space-4);
	font-size: var(--novasaas-text-xs);
	color: var(--novasaas-text-faint);
	padding-top: var(--novasaas-space-3);
	border-top: 1px solid var(--novasaas-border-subtle);
	margin-top: auto;
}

.novasaas-pagination {
	margin-top: var(--novasaas-space-12);
	display: flex;
	justify-content: center;
}

.novasaas-pagination .nav-links {
	display: flex;
	gap: var(--novasaas-space-2);
	align-items: center;
}

.novasaas-pagination .page-numbers {
	display: inline-flex;
	align-items: center;
	justify-content: center;
	min-width: 40px;
	height: 40px;
	padding-inline: var(--novasaas-space-3);
	border-radius: var(--novasaas-radius-md);
	font-size: var(--novasaas-text-sm);
	font-weight: var(--novasaas-weight-medium);
	color: var(--novasaas-text-muted);
	background: rgba(255, 255, 255, 0.04);
	border: 1px solid var(--novasaas-border-subtle);
	transition: color var(--novasaas-transition-fast),
	            background var(--novasaas-transition-fast),
	            border-color var(--novasaas-transition-fast);
}

.novasaas-pagination .page-numbers:hover,
.novasaas-pagination .page-numbers.current {
	color: var(--novasaas-text);
	background: rgba(99, 102, 241, 0.15);
	border-color: var(--novasaas-border-hover);
}

.novasaas-no-results {
	display: flex;
	justify-content: center;
	padding-block: var(--novasaas-space-16);
}

.novasaas-no-results__inner {
	max-width: 480px;
	width: 100%;
	padding: var(--novasaas-space-12);
	text-align: center;
	display: flex;
	flex-direction: column;
	gap: var(--novasaas-space-4);
}

.novasaas-no-results__emoji {
	font-size: 3rem;
	margin: 0;
	line-height: 1;
}
</style>

<?php get_footer(); ?>
