<?php
/**
 * Search Results Template
 *
 * @package NovaSaaS
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

get_header();

$search_query = get_search_query();
$found_posts  = $GLOBALS['wp_query']->found_posts;
?>

<style>
.novasaas-search-hero{padding-block:clamp(4rem,8vw,6rem);background:var(--novasaas-bg-dark);position:relative;overflow:hidden;}
.novasaas-search-hero::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse 70% 50% at 30% 50%,rgba(99,102,241,.08) 0,transparent 60%);pointer-events:none;}
.novasaas-search-form-wrap{position:relative;max-width:640px;margin-top:var(--novasaas-space-6);}
.novasaas-search-form-wrap input[type="search"]{width:100%;padding:1rem 1.25rem 1rem 3.25rem;background:rgba(255,255,255,.06);border:1.5px solid var(--novasaas-border);border-radius:var(--novasaas-radius-full);color:var(--novasaas-text);font-size:var(--novasaas-text-base);font-family:inherit;transition:border-color var(--novasaas-transition-fast),box-shadow var(--novasaas-transition-fast);}
.novasaas-search-form-wrap input[type="search"]:focus{outline:none;border-color:var(--novasaas-primary);box-shadow:0 0 0 3px rgba(99,102,241,.15);}
.novasaas-search-form-wrap .novasaas-search-icon{position:absolute;left:1.1rem;top:50%;transform:translateY(-50%);color:var(--novasaas-text-faint);pointer-events:none;}
.novasaas-search-form-wrap button[type="submit"]{position:absolute;right:.375rem;top:50%;transform:translateY(-50%);padding:.5em 1.25em;border-radius:var(--novasaas-radius-full);background:var(--novasaas-gradient-primary);color:#fff;font-size:var(--novasaas-text-sm);font-weight:600;border:none;cursor:pointer;transition:box-shadow var(--novasaas-transition-fast);}
.novasaas-search-form-wrap button[type="submit"]:hover{box-shadow:0 4px 16px rgba(99,102,241,.4);}
.novasaas-search-results{display:flex;flex-direction:column;gap:var(--novasaas-space-5);}
.novasaas-search-item{display:grid;gap:var(--novasaas-space-4);padding:var(--novasaas-space-5);}
@media(min-width:640px){.novasaas-search-item{grid-template-columns:140px 1fr;}}
.novasaas-search-item__thumb{border-radius:var(--novasaas-radius-md);overflow:hidden;background:var(--novasaas-bg-section);aspect-ratio:3/2;}
.novasaas-search-item__thumb img{width:100%;height:100%;object-fit:cover;}
.novasaas-search-item__type{font-size:var(--novasaas-text-xs);font-weight:700;text-transform:uppercase;letter-spacing:.08em;color:var(--novasaas-primary-light);margin-bottom:.375rem;}
.novasaas-search-item__title{font-size:var(--novasaas-text-xl);font-weight:700;line-height:1.3;margin:0 0 .5rem;}
.novasaas-search-item__title a{color:var(--novasaas-text);transition:color var(--novasaas-transition-fast);}
.novasaas-search-item__title a:hover{color:var(--novasaas-primary-light);}
.novasaas-search-item__excerpt{font-size:var(--novasaas-text-sm);color:var(--novasaas-text-muted);line-height:var(--novasaas-leading-relaxed);}
.novasaas-search-item__meta{font-size:var(--novasaas-text-xs);color:var(--novasaas-text-faint);margin-top:.5rem;}
</style>

<?php /* ── Search Hero ── */ ?>
<section class="novasaas-search-hero" aria-labelledby="novasaas-search-title">
	<div class="novasaas-container">
		<div style="position:relative;z-index:1;">
			<h1 id="novasaas-search-title" style="font-size:var(--novasaas-text-4xl);font-weight:800;letter-spacing:-.03em;margin:0 0 var(--novasaas-space-3);">
				<?php
				if ( $search_query ) {
					printf(
						/* translators: %s: search query */
						esc_html__( 'Results for "%s"', 'novasaas' ),
						'<span class="novasaas-gradient-text">' . esc_html( $search_query ) . '</span>'
					);
				} else {
					esc_html_e( 'Search', 'novasaas' );
				}
				?>
			</h1>
			<?php if ( $search_query ) : ?>
				<p style="font-size:var(--novasaas-text-base);color:var(--novasaas-text-muted);">
					<?php
					printf(
						/* translators: %d: number of results found */
						esc_html( _n( '%d result found', '%d results found', $found_posts, 'novasaas' ) ),
						absint( $found_posts )
					);
					?>
				</p>
			<?php endif; ?>
			<div class="novasaas-search-form-wrap">
				<form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
					<label for="novasaas-search-field" class="novasaas-sr-only"><?php esc_html_e( 'Search', 'novasaas' ); ?></label>
					<svg class="novasaas-search-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
					<input type="search"
					       id="novasaas-search-field"
					       name="s"
					       value="<?php echo esc_attr( $search_query ); ?>"
					       placeholder="<?php esc_attr_e( 'Search posts, pages...', 'novasaas' ); ?>"
					       autocomplete="off" />
					<button type="submit"><?php esc_html_e( 'Search', 'novasaas' ); ?></button>
				</form>
			</div>
		</div>
	</div>
</section>

<?php /* ── Results ── */ ?>
<section class="novasaas-section" style="background:var(--novasaas-bg-dark);" aria-label="<?php esc_attr_e( 'Search results', 'novasaas' ); ?>">
	<div class="novasaas-container" style="max-width:860px;">

		<?php if ( have_posts() ) : ?>
			<div class="novasaas-search-results">
				<?php
				while ( have_posts() ) :
					the_post();
					$post_type_obj = get_post_type_object( get_post_type() );
					$type_label    = $post_type_obj ? $post_type_obj->labels->singular_name : '';
				?>
					<article id="post-<?php the_ID(); ?>" <?php post_class( 'novasaas-glass-card novasaas-search-item novasaas-reveal' ); ?>>
						<?php if ( has_post_thumbnail() ) : ?>
							<a href="<?php the_permalink(); ?>" class="novasaas-search-item__thumb" tabindex="-1" aria-hidden="true">
								<?php the_post_thumbnail( 'novasaas-thumb', array( 'loading' => 'lazy', 'alt' => '' ) ); ?>
							</a>
						<?php endif; ?>
						<div>
							<?php if ( $type_label ) : ?>
								<div class="novasaas-search-item__type"><?php echo esc_html( $type_label ); ?></div>
							<?php endif; ?>
							<h2 class="novasaas-search-item__title">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h2>
							<p class="novasaas-search-item__excerpt">
								<?php echo esc_html( novasaas_truncate( get_the_excerpt(), 160 ) ); ?>
							</p>
							<div class="novasaas-search-item__meta">
								<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
								<?php if ( 'post' === get_post_type() ) : ?>
									&bull; <?php the_author(); ?>
								<?php endif; ?>
							</div>
						</div>
					</article>
				<?php endwhile; ?>
			</div>

			<?php
			the_posts_pagination( array(
				'mid_size'  => 2,
				'prev_text' => '&larr; ' . esc_html__( 'Previous', 'novasaas' ),
				'next_text' => esc_html__( 'Next', 'novasaas' ) . ' &rarr;',
				'class'     => 'novasaas-pagination',
			) );
			?>

		<?php else : ?>
			<div style="padding:var(--novasaas-space-16);text-align:center;">
				<p style="font-size:3rem;" aria-hidden="true">&#128269;</p>
				<h2 style="font-size:var(--novasaas-text-3xl);font-weight:700;margin:0 0 var(--novasaas-space-3);"><?php esc_html_e( 'No results found', 'novasaas' ); ?></h2>
				<p style="color:var(--novasaas-text-muted);font-size:var(--novasaas-text-lg);max-width:480px;margin:0 auto var(--novasaas-space-6);">
					<?php esc_html_e( 'Try a different search term or browse our latest posts below.', 'novasaas' ); ?>
				</p>
				<?php
				$recent = new WP_Query( array( 'posts_per_page' => 3, 'no_found_rows' => true, 'ignore_sticky_posts' => true ) );
				if ( $recent->have_posts() ) :
				?>
					<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:var(--novasaas-space-5);margin-top:var(--novasaas-space-8);text-align:left;">
						<?php while ( $recent->have_posts() ) : $recent->the_post(); ?>
							<a href="<?php the_permalink(); ?>" class="novasaas-glass-card" style="display:block;padding:var(--novasaas-space-5);text-decoration:none;">
								<div style="font-size:var(--novasaas-text-base);font-weight:600;color:var(--novasaas-text);margin-bottom:.5rem;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;"><?php the_title(); ?></div>
								<div style="font-size:var(--novasaas-text-xs);color:var(--novasaas-text-faint);"><?php echo esc_html( get_the_date() ); ?></div>
							</a>
						<?php endwhile; wp_reset_postdata(); ?>
					</div>
				<?php endif; ?>
			</div>
		<?php endif; ?>

	</div>
</section>

<script>
( function () {
	if('IntersectionObserver'in window){const o=new IntersectionObserver(function(e){e.forEach(function(i){if(i.isIntersecting){i.target.classList.add('is-visible');o.unobserve(i.target);}});},{threshold:0.1,rootMargin:'0px 0px -40px 0px'});document.querySelectorAll('.novasaas-reveal').forEach(function(el){o.observe(el);});}else{document.querySelectorAll('.novasaas-reveal').forEach(function(el){el.classList.add('is-visible');});}
}() );
</script>

<?php get_footer(); ?>
