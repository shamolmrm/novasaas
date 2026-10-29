<?php
/**
 * Single Post Template
 *
 * @package NovaSaaS
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

get_header();
the_post();

$author_id   = get_the_author_meta( 'ID' );
$author_name = get_the_author();
$author_bio  = get_the_author_meta( 'description' );
$author_init = strtoupper( substr( $author_name, 0, 2 ) );
$cats        = get_the_category();
$tags        = get_the_tags();
$read_time   = novasaas_get_reading_time( get_the_ID() );
?>

<style>
.novasaas-single-hero{position:relative;overflow:hidden;background:var(--novasaas-bg-dark);}
.novasaas-single-hero__img{width:100%;max-height:520px;object-fit:cover;display:block;}
.novasaas-single-hero__overlay{position:absolute;inset:0;background:linear-gradient(to top,rgba(15,10,30,.9) 0,rgba(15,10,30,.3) 60%,transparent 100%);}
.novasaas-single-hero__content{position:absolute;bottom:0;left:0;right:0;padding:clamp(2rem,5vw,4rem);}
.novasaas-single-hero--no-img{padding:clamp(4rem,8vw,6rem) 0;}
.novasaas-single-layout{display:grid;grid-template-columns:1fr;gap:var(--novasaas-space-10);}
@media(min-width:1100px){.novasaas-single-layout{grid-template-columns:1fr 300px;}}
.novasaas-single-content{max-width:780px;}
.novasaas-post-author-row{display:flex;align-items:center;gap:var(--novasaas-space-3);flex-wrap:wrap;margin-bottom:var(--novasaas-space-6);}
.novasaas-post-author-row .novasaas-svg-avatar{width:44px;height:44px;border-radius:50%;flex-shrink:0;}
.novasaas-post-author-row__name{font-size:var(--novasaas-text-sm);font-weight:600;color:var(--novasaas-text);}
.novasaas-post-author-row__meta{font-size:var(--novasaas-text-xs);color:var(--novasaas-text-faint);}
.novasaas-post-body{font-size:var(--novasaas-text-lg);line-height:var(--novasaas-leading-loose);color:var(--novasaas-text-muted);}
.novasaas-post-body h2,.novasaas-post-body h3,.novasaas-post-body h4{color:var(--novasaas-text);margin-top:2em;margin-bottom:.75em;}
.novasaas-post-body h2{font-size:var(--novasaas-text-3xl);}
.novasaas-post-body h3{font-size:var(--novasaas-text-2xl);}
.novasaas-post-body p{margin-bottom:1.5em;}
.novasaas-post-body a{color:var(--novasaas-primary-light);text-decoration:underline;text-underline-offset:3px;}
.novasaas-post-body a:hover{color:var(--novasaas-primary);}
.novasaas-post-body blockquote{border-left:3px solid var(--novasaas-primary);padding-left:1.5rem;margin:2em 0;color:var(--novasaas-text);font-size:var(--novasaas-text-xl);font-style:italic;}
.novasaas-post-body ul,.novasaas-post-body ol{padding-left:1.5rem;margin-bottom:1.5em;display:flex;flex-direction:column;gap:.5em;}
.novasaas-post-body li{list-style:disc;}
.novasaas-post-body ol li{list-style:decimal;}
.novasaas-post-body img{border-radius:var(--novasaas-radius-lg);margin-block:1.5em;}
.novasaas-post-body table{width:100%;border-collapse:collapse;margin-bottom:1.5em;}
.novasaas-post-body th,.novasaas-post-body td{padding:.75rem 1rem;border:1px solid var(--novasaas-border-subtle);font-size:var(--novasaas-text-sm);}
.novasaas-post-body th{background:rgba(99,102,241,.08);font-weight:700;color:var(--novasaas-text);}
.novasaas-post-tags{display:flex;flex-wrap:wrap;gap:var(--novasaas-space-2);margin:var(--novasaas-space-8) 0;}
.novasaas-share-row{display:flex;align-items:center;gap:var(--novasaas-space-3);flex-wrap:wrap;padding:var(--novasaas-space-6);border-radius:var(--novasaas-radius-lg);background:rgba(99,102,241,.06);border:1px solid var(--novasaas-border);margin-bottom:var(--novasaas-space-8);}
.novasaas-share-btn{display:inline-flex;align-items:center;gap:.5rem;padding:.5em 1.25em;border-radius:var(--novasaas-radius-full);font-size:var(--novasaas-text-sm);font-weight:600;cursor:pointer;border:1px solid;transition:all var(--novasaas-transition-fast);}
.novasaas-share-btn--twitter{color:#1D9BF0;border-color:rgba(29,155,240,.35);background:rgba(29,155,240,.08);}
.novasaas-share-btn--twitter:hover{background:rgba(29,155,240,.15);}
.novasaas-share-btn--linkedin{color:#0A66C2;border-color:rgba(10,102,194,.35);background:rgba(10,102,194,.08);}
.novasaas-share-btn--linkedin:hover{background:rgba(10,102,194,.15);}
.novasaas-share-btn--copy{color:var(--novasaas-text-muted);border-color:var(--novasaas-border);background:transparent;}
.novasaas-share-btn--copy:hover{color:var(--novasaas-text);background:rgba(255,255,255,.05);}
.novasaas-author-box{padding:var(--novasaas-space-8);display:flex;gap:var(--novasaas-space-5);margin-bottom:var(--novasaas-space-8);}
.novasaas-author-box .novasaas-svg-avatar{width:72px;height:72px;border-radius:50%;flex-shrink:0;}
.novasaas-author-box__name{font-size:var(--novasaas-text-xl);font-weight:700;color:var(--novasaas-text);margin:0 0 .25rem;}
.novasaas-author-box__bio{font-size:var(--novasaas-text-sm);color:var(--novasaas-text-muted);line-height:var(--novasaas-leading-relaxed);margin:0 0 var(--novasaas-space-3);}
.novasaas-related{margin-bottom:var(--novasaas-space-12);}
.novasaas-related__grid{display:grid;grid-template-columns:1fr;gap:var(--novasaas-space-5);}
@media(min-width:640px){.novasaas-related__grid{grid-template-columns:repeat(3,1fr);}}
.novasaas-related-card{display:flex;flex-direction:column;overflow:hidden;padding:0;}
.novasaas-related-card__thumb{aspect-ratio:16/9;overflow:hidden;background:var(--novasaas-bg-section);}
.novasaas-related-card__thumb img{width:100%;height:100%;object-fit:cover;transition:transform var(--novasaas-transition-slow);}
.novasaas-related-card:hover .novasaas-related-card__thumb img{transform:scale(1.05);}
.novasaas-related-card__body{padding:var(--novasaas-space-5);}
.novasaas-related-card__title{font-size:var(--novasaas-text-base);font-weight:700;color:var(--novasaas-text);margin:0 0 .5rem;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;}
.novasaas-related-card__date{font-size:var(--novasaas-text-xs);color:var(--novasaas-text-faint);}
/* Comments */
.novasaas-comments{padding:var(--novasaas-space-8);}
.novasaas-comments .comments-title{font-size:var(--novasaas-text-2xl);font-weight:700;margin:0 0 var(--novasaas-space-6);}
.novasaas-comments .comment-list{list-style:none;display:flex;flex-direction:column;gap:var(--novasaas-space-6);}
.novasaas-comments .comment{background:rgba(255,255,255,.03);border:1px solid var(--novasaas-border-subtle);border-radius:var(--novasaas-radius-lg);padding:var(--novasaas-space-5);}
.novasaas-comments .comment-author .avatar{border-radius:50%;width:40px;height:40px;}
.novasaas-comments .comment-meta{font-size:var(--novasaas-text-xs);color:var(--novasaas-text-faint);}
.novasaas-comments .comment-content p{font-size:var(--novasaas-text-base);color:var(--novasaas-text-muted);margin-bottom:.75em;}
.novasaas-comments .reply a{font-size:var(--novasaas-text-sm);color:var(--novasaas-primary-light);font-weight:600;}
.novasaas-comments .comment-respond{margin-top:var(--novasaas-space-8);}
.novasaas-comments .comment-reply-title{font-size:var(--novasaas-text-xl);font-weight:700;margin:0 0 var(--novasaas-space-5);}
.novasaas-comments .comment-form label{display:block;font-size:var(--novasaas-text-sm);font-weight:600;color:var(--novasaas-text);margin-bottom:.5rem;}
.novasaas-comments .comment-form input[type="text"],.novasaas-comments .comment-form input[type="email"],.novasaas-comments .comment-form textarea{width:100%;padding:.75em 1em;background:rgba(255,255,255,.05);border:1px solid var(--novasaas-border);border-radius:var(--novasaas-radius-md);color:var(--novasaas-text);font-size:var(--novasaas-text-base);font-family:inherit;margin-bottom:var(--novasaas-space-4);transition:border-color var(--novasaas-transition-fast);}
.novasaas-comments .comment-form input:focus,.novasaas-comments .comment-form textarea:focus{outline:none;border-color:var(--novasaas-primary);box-shadow:0 0 0 3px rgba(99,102,241,.15);}
.novasaas-comments .comment-form textarea{min-height:140px;resize:vertical;}
.novasaas-comments .form-submit .submit{padding:.75em 2em;border-radius:var(--novasaas-radius-full);background:var(--novasaas-gradient-primary);color:#fff;font-size:var(--novasaas-text-base);font-weight:600;border:none;cursor:pointer;transition:box-shadow var(--novasaas-transition-fast),transform var(--novasaas-transition-fast);}
.novasaas-comments .form-submit .submit:hover{transform:translateY(-2px);box-shadow:0 8px 25px rgba(99,102,241,.4);}
</style>

<?php /* ── Hero ── */ ?>
<?php if ( has_post_thumbnail() ) : ?>
	<section class="novasaas-single-hero" aria-hidden="true">
		<?php the_post_thumbnail( 'novasaas-hero', array( 'class' => 'novasaas-single-hero__img', 'loading' => 'eager', 'alt' => '' ) ); ?>
		<div class="novasaas-single-hero__overlay"></div>
	</section>
<?php endif; ?>

<section class="novasaas-section" style="background:var(--novasaas-bg-dark);" aria-label="<?php esc_attr_e( 'Article', 'novasaas' ); ?>">
	<div class="novasaas-container">
		<div class="novasaas-single-layout">

			<article class="novasaas-single-content" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<?php /* Breadcrumb */ ?>
				<?php novasaas_render_breadcrumb(); ?>

				<div style="display:flex;align-items:center;gap:var(--novasaas-space-3);flex-wrap:wrap;margin:var(--novasaas-space-5) 0;">
					<?php foreach ( (array) $cats as $cat ) : ?>
						<a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>" class="novasaas-badge novasaas-badge--primary">
							<?php echo esc_html( $cat->name ); ?>
						</a>
					<?php endforeach; ?>
					<?php if ( $read_time ) : ?>
						<span style="font-size:var(--novasaas-text-sm);color:var(--novasaas-text-faint);"><?php echo esc_html( $read_time ); ?></span>
					<?php endif; ?>
					<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>" style="font-size:var(--novasaas-text-sm);color:var(--novasaas-text-faint);">
						<?php echo esc_html( get_the_date() ); ?>
					</time>
				</div>

				<h1 style="font-size:var(--novasaas-text-5xl);font-weight:800;letter-spacing:-.03em;margin:0 0 var(--novasaas-space-6);line-height:1.1;">
					<?php the_title(); ?>
				</h1>

				<?php /* Author Row */ ?>
				<div class="novasaas-post-author-row">
					<?php echo novasaas_get_svg_avatar( $author_init, '6366F1' ); ?>
					<div>
						<div class="novasaas-post-author-row__name"><?php echo esc_html( $author_name ); ?></div>
						<?php if ( $author_bio ) : ?>
							<div class="novasaas-post-author-row__meta"><?php echo esc_html( novasaas_truncate( $author_bio, 80 ) ); ?></div>
						<?php endif; ?>
					</div>
				</div>

				<?php /* Post Content */ ?>
				<div class="novasaas-post-body">
					<?php the_content(); ?>
				</div>

				<?php wp_link_pages( array( 'before' => '<nav class="novasaas-page-links"><span>' . esc_html__( 'Pages:', 'novasaas' ) . '</span>', 'after' => '</nav>' ) ); ?>

				<?php /* Tags */ ?>
				<?php if ( $tags ) : ?>
					<div class="novasaas-post-tags" aria-label="<?php esc_attr_e( 'Post tags', 'novasaas' ); ?>">
						<span style="font-size:var(--novasaas-text-sm);font-weight:600;color:var(--novasaas-text-muted);margin-right:.5rem;"><?php esc_html_e( 'Tags:', 'novasaas' ); ?></span>
						<?php foreach ( $tags as $tag ) : ?>
							<a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>" class="novasaas-badge novasaas-badge--accent">
								<?php echo esc_html( $tag->name ); ?>
							</a>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>

				<?php /* Share */ ?>
				<div class="novasaas-share-row" aria-label="<?php esc_attr_e( 'Share this post', 'novasaas' ); ?>">
					<span style="font-size:var(--novasaas-text-sm);font-weight:600;color:var(--novasaas-text-muted);"><?php esc_html_e( 'Share:', 'novasaas' ); ?></span>
					<a href="https://twitter.com/intent/tweet?url=<?php echo rawurlencode( get_permalink() ); ?>&text=<?php echo rawurlencode( get_the_title() ); ?>"
					   target="_blank"
					   rel="noopener noreferrer"
					   class="novasaas-share-btn novasaas-share-btn--twitter"
					   aria-label="<?php esc_attr_e( 'Share on Twitter', 'novasaas' ); ?>">
						<svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.744l7.73-8.835L2.003 2.25h6.961l4.259 5.63 5.021-5.63Zm-1.161 17.52h1.833L7.084 4.126H5.117L17.083 19.77Z"/></svg>
						Twitter
					</a>
					<a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo rawurlencode( get_permalink() ); ?>"
					   target="_blank"
					   rel="noopener noreferrer"
					   class="novasaas-share-btn novasaas-share-btn--linkedin"
					   aria-label="<?php esc_attr_e( 'Share on LinkedIn', 'novasaas' ); ?>">
						<svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 0 1-2.063-2.065 2.064 2.064 0 1 1 2.063 2.065zm1.782 13.019H3.555V9h3.564v11.452z"/></svg>
						LinkedIn
					</a>
					<button type="button"
							id="novasaas-copy-link"
							class="novasaas-share-btn novasaas-share-btn--copy"
							data-url="<?php echo esc_attr( get_permalink() ); ?>"
							aria-label="<?php esc_attr_e( 'Copy link to clipboard', 'novasaas' ); ?>">
						&#128279; <span><?php esc_html_e( 'Copy Link', 'novasaas' ); ?></span>
					</button>
				</div>

				<?php /* Author Box */ ?>
				<div class="novasaas-glass-card novasaas-author-box">
					<?php echo novasaas_get_svg_avatar( $author_init, '6366F1' ); ?>
					<div>
						<h3 class="novasaas-author-box__name">
							<a href="<?php echo esc_url( get_author_posts_url( $author_id ) ); ?>" style="color:inherit;">
								<?php echo esc_html( $author_name ); ?>
							</a>
						</h3>
						<?php if ( $author_bio ) : ?>
							<p class="novasaas-author-box__bio"><?php echo esc_html( novasaas_truncate( $author_bio, 200 ) ); ?></p>
						<?php endif; ?>
						<a href="<?php echo esc_url( get_author_posts_url( $author_id ) ); ?>" class="novasaas-btn-outline novasaas-btn-outline--sm">
							<?php esc_html_e( 'View all posts', 'novasaas' ); ?> &rarr;
						</a>
					</div>
				</div>

				<?php /* Related Posts */ ?>
				<?php
				$related = new WP_Query( array(
					'category__in'        => wp_get_post_categories( get_the_ID() ),
					'post__not_in'        => array( get_the_ID() ),
					'posts_per_page'      => 3,
					'ignore_sticky_posts' => true,
					'no_found_rows'       => true,
					'orderby'             => 'rand',
				) );

				if ( $related->have_posts() ) :
				?>
					<div class="novasaas-related">
						<h2 style="font-size:var(--novasaas-text-2xl);font-weight:700;margin:0 0 var(--novasaas-space-6);"><?php esc_html_e( 'You might also like', 'novasaas' ); ?></h2>
						<div class="novasaas-related__grid">
							<?php while ( $related->have_posts() ) : $related->the_post(); ?>
								<a href="<?php the_permalink(); ?>" class="novasaas-glass-card novasaas-related-card" style="text-decoration:none;">
									<?php if ( has_post_thumbnail() ) : ?>
										<div class="novasaas-related-card__thumb">
											<?php the_post_thumbnail( 'novasaas-thumb', array( 'loading' => 'lazy', 'alt' => '' ) ); ?>
										</div>
									<?php endif; ?>
									<div class="novasaas-related-card__body">
										<h3 class="novasaas-related-card__title"><?php the_title(); ?></h3>
										<span class="novasaas-related-card__date"><?php echo esc_html( get_the_date() ); ?></span>
									</div>
								</a>
							<?php endwhile; wp_reset_postdata(); ?>
						</div>
					</div>
				<?php endif; ?>

				<?php /* Comments */ ?>
				<?php if ( comments_open() || get_comments_number() ) : ?>
					<div class="novasaas-glass-card novasaas-comments">
						<?php
						comments_template();
						?>
					</div>
				<?php endif; ?>

			</article>

			<?php /* Sidebar */ ?>
			<aside class="novasaas-blog-sidebar" aria-label="<?php esc_attr_e( 'Post sidebar', 'novasaas' ); ?>">
				<?php if ( is_active_sidebar( 'novasaas-sidebar' ) ) : ?>
					<?php dynamic_sidebar( 'novasaas-sidebar' ); ?>
				<?php endif; ?>
			</aside>

		</div>
	</div>
</section>

<script>
( function () {
	'use strict';
	const copyBtn = document.getElementById( 'novasaas-copy-link' );
	if ( copyBtn && navigator.clipboard ) {
		copyBtn.addEventListener( 'click', function () {
			const url = copyBtn.dataset.url;
			navigator.clipboard.writeText( url ).then( function () {
				const span = copyBtn.querySelector( 'span' );
				if ( span ) {
					const orig = span.textContent;
					span.textContent = '<?php echo esc_js( __( 'Copied!', 'novasaas' ) ); ?>';
					setTimeout( function () { span.textContent = orig; }, 2000 );
				}
			} ).catch( function () {} );
		} );
	}
}() );
</script>

<?php get_footer(); ?>
