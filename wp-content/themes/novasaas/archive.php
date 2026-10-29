<?php
/**
 * Blog Archive Template
 *
 * @package NovaSaaS
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<style>
.novasaas-archive-hero{padding-block:clamp(4rem,8vw,6rem);background:var(--novasaas-bg-dark);position:relative;overflow:hidden;}
.novasaas-archive-hero::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse 70% 40% at 20% 50%,rgba(99,102,241,.1) 0,transparent 60%);pointer-events:none;}
.novasaas-archive-hero__inner{position:relative;z-index:1;}
.novasaas-archive-layout{display:grid;grid-template-columns:1fr;gap:var(--novasaas-space-10);}
@media(min-width:1024px){.novasaas-archive-layout{grid-template-columns:1fr 320px;}}
.novasaas-blog-grid{display:grid;grid-template-columns:1fr;gap:var(--novasaas-space-6);}
@media(min-width:640px){.novasaas-blog-grid{grid-template-columns:repeat(2,1fr);}}
@media(min-width:1024px){.novasaas-blog-grid{grid-template-columns:repeat(2,1fr);}}
.novasaas-post-card{display:flex;flex-direction:column;overflow:hidden;padding:0;}
.novasaas-post-card__thumb{display:block;overflow:hidden;aspect-ratio:16/9;background:var(--novasaas-bg-section);}
.novasaas-post-card__thumb img,.novasaas-post-card__thumb-placeholder{width:100%;height:100%;object-fit:cover;transition:transform var(--novasaas-transition-slow);}
.novasaas-post-card__thumb-placeholder{display:flex;align-items:center;justify-content:center;font-size:2.5rem;color:var(--novasaas-text-faint);}
.novasaas-post-card:hover .novasaas-post-card__thumb img{transform:scale(1.04);}
.novasaas-post-card__body{display:flex;flex-direction:column;gap:var(--novasaas-space-3);padding:var(--novasaas-space-6);flex:1;}
.novasaas-post-card__cat{font-size:var(--novasaas-text-xs);font-weight:700;text-transform:uppercase;letter-spacing:.1em;padding:.25em .75em;border-radius:var(--novasaas-radius-full);display:inline-flex;width:fit-content;}
.novasaas-post-card__title{font-size:var(--novasaas-text-xl);font-weight:700;line-height:var(--novasaas-leading-snug);margin:0;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;}
.novasaas-post-card__title a{color:var(--novasaas-text);transition:color var(--novasaas-transition-fast);}
.novasaas-post-card__title a:hover{color:var(--novasaas-primary-light);}
.novasaas-post-card__excerpt{font-size:var(--novasaas-text-sm);color:var(--novasaas-text-muted);margin:0;flex:1;line-height:var(--novasaas-leading-relaxed);}
.novasaas-post-card__meta{display:flex;align-items:center;gap:var(--novasaas-space-3);padding-top:var(--novasaas-space-3);border-top:1px solid var(--novasaas-border-subtle);margin-top:auto;flex-wrap:wrap;}
.novasaas-post-card__author{display:flex;align-items:center;gap:.5rem;}
.novasaas-post-card__author .novasaas-svg-avatar{width:28px;height:28px;border-radius:50%;}
.novasaas-post-card__author-name{font-size:var(--novasaas-text-xs);font-weight:600;color:var(--novasaas-text);}
.novasaas-post-card__date,.novasaas-post-card__time{font-size:var(--novasaas-text-xs);color:var(--novasaas-text-faint);}
.novasaas-post-card__sep{color:var(--novasaas-text-faint);font-size:.5rem;}
.novasaas-post-card__read-more{display:inline-flex;align-items:center;gap:.25rem;font-size:var(--novasaas-text-sm);font-weight:600;color:var(--novasaas-primary-light);margin-top:var(--novasaas-space-2);transition:gap var(--novasaas-transition-fast);}
.novasaas-post-card__read-more:hover{gap:.5rem;color:var(--novasaas-primary);}
/* Sidebar */
.novasaas-blog-sidebar{display:flex;flex-direction:column;gap:var(--novasaas-space-6);}
.novasaas-sidebar-widget{padding:var(--novasaas-space-6);}
.novasaas-sidebar-widget .widget-title{font-size:var(--novasaas-text-lg);font-weight:700;color:var(--novasaas-text);margin:0 0 var(--novasaas-space-4);padding-bottom:var(--novasaas-space-3);border-bottom:1px solid var(--novasaas-border-subtle);}
/* Pagination */
.novasaas-pagination{display:flex;justify-content:center;margin-top:var(--novasaas-space-12);}
.novasaas-pagination .nav-links{display:flex;gap:var(--novasaas-space-2);align-items:center;flex-wrap:wrap;}
.novasaas-pagination .page-numbers{display:inline-flex;align-items:center;justify-content:center;min-width:42px;height:42px;padding-inline:var(--novasaas-space-3);border-radius:var(--novasaas-radius-md);font-size:var(--novasaas-text-sm);font-weight:600;color:var(--novasaas-text-muted);background:rgba(255,255,255,.04);border:1px solid var(--novasaas-border-subtle);transition:color var(--novasaas-transition-fast),background var(--novasaas-transition-fast),border-color var(--novasaas-transition-fast);}
.novasaas-pagination .page-numbers:hover,.novasaas-pagination .page-numbers.current{color:var(--novasaas-text);background:rgba(99,102,241,.15);border-color:var(--novasaas-border-hover);}
</style>

<?php /* ── Archive Hero ── */ ?>
<section class="novasaas-archive-hero" aria-labelledby="novasaas-archive-title">
	<div class="novasaas-container">
		<div class="novasaas-archive-hero__inner">
			<?php if ( is_home() && ! is_front_page() ) : ?>
				<h1 id="novasaas-archive-title" style="font-size:var(--novasaas-text-6xl);font-weight:800;letter-spacing:-.03em;margin:0 0 var(--novasaas-space-3);"><?php esc_html_e( 'Latest from our blog', 'novasaas' ); ?></h1>
				<p style="font-size:var(--novasaas-text-lg);color:var(--novasaas-text-muted);margin:0;max-width:560px;"><?php esc_html_e( 'Insights, tutorials, and product updates from the StreamFlow team.', 'novasaas' ); ?></p>
			<?php else : ?>
				<div style="margin-bottom:var(--novasaas-space-3);"><?php the_archive_title( '<h1 id="novasaas-archive-title" style="font-size:var(--novasaas-text-6xl);font-weight:800;letter-spacing:-.03em;margin:0;">', '</h1>' ); ?></div>
				<?php the_archive_description( '<p style="font-size:var(--novasaas-text-lg);color:var(--novasaas-text-muted);margin:0;max-width:560px;">', '</p>' ); ?>
			<?php endif; ?>
		</div>
	</div>
</section>

<?php /* ── Main + Sidebar ── */ ?>
<section class="novasaas-section" style="background:var(--novasaas-bg-dark);">
	<div class="novasaas-container">
		<div class="novasaas-archive-layout">

			<?php /* Posts */ ?>
			<main id="novasaas-blog-main" aria-label="<?php esc_attr_e( 'Blog posts', 'novasaas' ); ?>">
				<?php if ( have_posts() ) : ?>
					<div class="novasaas-blog-grid">
						<?php
						while ( have_posts() ) :
							the_post();
							$cats         = get_the_category();
							$cat_name     = ! empty( $cats ) ? $cats[0]->name : '';
							$cat_link     = ! empty( $cats ) ? get_category_link( $cats[0]->term_id ) : '';
							$author_id    = get_the_author_meta( 'ID' );
							$author_name  = get_the_author();
							$author_init  = strtoupper( substr( $author_name, 0, 2 ) );
							$read_time    = novasaas_get_reading_time( get_the_ID() );
						?>
						<article id="post-<?php the_ID(); ?>" <?php post_class( 'novasaas-glass-card novasaas-post-card novasaas-reveal' ); ?>>

							<a href="<?php the_permalink(); ?>" class="novasaas-post-card__thumb" tabindex="-1" aria-hidden="true">
								<?php if ( has_post_thumbnail() ) : ?>
									<?php the_post_thumbnail( 'novasaas-blog', array( 'loading' => 'lazy', 'alt' => '' ) ); ?>
								<?php else : ?>
									<div class="novasaas-post-card__thumb-placeholder" aria-hidden="true">&#128196;</div>
								<?php endif; ?>
							</a>

							<div class="novasaas-post-card__body">
								<?php if ( $cat_name ) : ?>
									<a href="<?php echo esc_url( $cat_link ); ?>" class="novasaas-badge novasaas-badge--primary novasaas-post-card__cat">
										<?php echo esc_html( $cat_name ); ?>
									</a>
								<?php endif; ?>

								<h2 class="novasaas-post-card__title">
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</h2>

								<p class="novasaas-post-card__excerpt">
									<?php echo esc_html( novasaas_truncate( get_the_excerpt(), 120 ) ); ?>
								</p>

								<div class="novasaas-post-card__meta">
									<div class="novasaas-post-card__author">
										<?php echo novasaas_get_svg_avatar( $author_init, '6366F1' ); ?>
										<span class="novasaas-post-card__author-name"><?php echo esc_html( $author_name ); ?></span>
									</div>
									<span class="novasaas-post-card__sep" aria-hidden="true">&#9679;</span>
									<time class="novasaas-post-card__date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
										<?php echo esc_html( get_the_date() ); ?>
									</time>
									<?php if ( $read_time ) : ?>
										<span class="novasaas-post-card__sep" aria-hidden="true">&#9679;</span>
										<span class="novasaas-post-card__time"><?php echo esc_html( $read_time ); ?></span>
									<?php endif; ?>
								</div>

								<a href="<?php the_permalink(); ?>" class="novasaas-post-card__read-more" aria-label="<?php printf( esc_attr__( 'Read more about %s', 'novasaas' ), esc_attr( get_the_title() ) ); ?>">
									<?php esc_html_e( 'Read More', 'novasaas' ); ?> &rarr;
								</a>
							</div>

						</article>
						<?php endwhile; ?>
					</div>

					<?php
					the_posts_pagination( array(
						'mid_size'           => 2,
						'prev_text'          => '&larr; ' . esc_html__( 'Previous', 'novasaas' ),
						'next_text'          => esc_html__( 'Next', 'novasaas' ) . ' &rarr;',
						'before_page_number' => '<span class="novasaas-sr-only">' . esc_html__( 'Page', 'novasaas' ) . ' </span>',
						'class'              => 'novasaas-pagination',
					) );
					?>

				<?php else : ?>
					<div style="padding:var(--novasaas-space-16);text-align:center;color:var(--novasaas-text-muted);">
						<p style="font-size:2rem;" aria-hidden="true">&#128196;</p>
						<h2><?php esc_html_e( 'No posts found', 'novasaas' ); ?></h2>
						<p><?php esc_html_e( 'Check back soon for new content.', 'novasaas' ); ?></p>
					</div>
				<?php endif; ?>
			</main>

			<?php /* Sidebar */ ?>
			<aside class="novasaas-blog-sidebar" aria-label="<?php esc_attr_e( 'Blog sidebar', 'novasaas' ); ?>">

				<?php /* Search */ ?>
				<div class="novasaas-glass-card novasaas-sidebar-widget">
					<h3 class="widget-title"><?php esc_html_e( 'Search', 'novasaas' ); ?></h3>
					<?php get_search_form(); ?>
				</div>

				<?php if ( is_active_sidebar( 'novasaas-blog-sidebar' ) ) : ?>
					<?php dynamic_sidebar( 'novasaas-blog-sidebar' ); ?>
				<?php else : ?>

					<?php /* Recent posts fallback */ ?>
					<div class="novasaas-glass-card novasaas-sidebar-widget">
						<h3 class="widget-title"><?php esc_html_e( 'Recent Posts', 'novasaas' ); ?></h3>
						<?php
						$recent = new WP_Query( array( 'posts_per_page' => 5, 'post_status' => 'publish', 'ignore_sticky_posts' => true, 'no_found_rows' => true ) );
						if ( $recent->have_posts() ) :
						?>
							<ul style="list-style:none;display:flex;flex-direction:column;gap:var(--novasaas-space-3);">
								<?php while ( $recent->have_posts() ) : $recent->the_post(); ?>
									<li style="padding-bottom:var(--novasaas-space-3);border-bottom:1px solid var(--novasaas-border-subtle);">
										<a href="<?php the_permalink(); ?>" style="font-size:var(--novasaas-text-sm);font-weight:500;color:var(--novasaas-text);line-height:var(--novasaas-leading-snug);display:block;margin-bottom:.25rem;transition:color var(--novasaas-transition-fast);" onmouseover="this.style.color='var(--novasaas-primary-light)'" onmouseout="this.style.color='var(--novasaas-text)'">
											<?php the_title(); ?>
										</a>
										<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>" style="font-size:var(--novasaas-text-xs);color:var(--novasaas-text-faint);">
											<?php echo esc_html( get_the_date() ); ?>
										</time>
									</li>
								<?php endwhile; wp_reset_postdata(); ?>
							</ul>
						<?php endif; ?>
					</div>

					<?php /* Categories fallback */ ?>
					<div class="novasaas-glass-card novasaas-sidebar-widget">
						<h3 class="widget-title"><?php esc_html_e( 'Categories', 'novasaas' ); ?></h3>
						<ul style="list-style:none;display:flex;flex-direction:column;gap:var(--novasaas-space-2);">
							<?php
							$cats = get_categories( array( 'hide_empty' => true ) );
							foreach ( $cats as $cat ) :
							?>
								<li>
									<a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>"
									   style="display:flex;justify-content:space-between;align-items:center;font-size:var(--novasaas-text-sm);color:var(--novasaas-text-muted);padding:.375rem 0;transition:color var(--novasaas-transition-fast);"
									   onmouseover="this.style.color='var(--novasaas-primary-light)'" onmouseout="this.style.color='var(--novasaas-text-muted)'">
										<span><?php echo esc_html( $cat->name ); ?></span>
										<span style="font-size:var(--novasaas-text-xs);background:rgba(99,102,241,.1);border-radius:var(--novasaas-radius-full);padding:.15em .6em;color:var(--novasaas-primary-light);"><?php echo absint( $cat->count ); ?></span>
									</a>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>

					<?php /* Tags fallback */ ?>
					<div class="novasaas-glass-card novasaas-sidebar-widget">
						<h3 class="widget-title"><?php esc_html_e( 'Tags', 'novasaas' ); ?></h3>
						<div style="display:flex;flex-wrap:wrap;gap:var(--novasaas-space-2);">
							<?php
							$tags = get_tags( array( 'hide_empty' => true, 'number' => 20 ) );
							foreach ( $tags as $tag ) :
							?>
								<a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>"
								   class="novasaas-badge novasaas-badge--primary" style="text-decoration:none;">
									<?php echo esc_html( $tag->name ); ?>
								</a>
							<?php endforeach; ?>
						</div>
					</div>

				<?php endif; ?>

			</aside>

		</div>
	</div>
</section>

<script>
( function () {
	if('IntersectionObserver'in window){const o=new IntersectionObserver(function(e){e.forEach(function(i){if(i.isIntersecting){i.target.classList.add('is-visible');o.unobserve(i.target);}});},{threshold:0.1,rootMargin:'0px 0px -40px 0px'});document.querySelectorAll('.novasaas-reveal').forEach(function(el){o.observe(el);});}else{document.querySelectorAll('.novasaas-reveal').forEach(function(el){el.classList.add('is-visible');});}
}() );
</script>

<?php get_footer(); ?>
