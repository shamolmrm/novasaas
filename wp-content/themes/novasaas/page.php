<?php
/**
 * Default Page Template
 *
 * @package NovaSaaS
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

get_header();
the_post();

$has_sidebar = is_active_sidebar( 'novasaas-sidebar' ) && ! is_front_page();
?>

<style>
.novasaas-page-layout{display:grid;grid-template-columns:1fr;gap:var(--novasaas-space-10);}
<?php if ( $has_sidebar ) : ?>
@media(min-width:1024px){.novasaas-page-layout{grid-template-columns:1fr 300px;}}
<?php endif; ?>
.novasaas-page-content{font-size:var(--novasaas-text-lg);line-height:var(--novasaas-leading-loose);color:var(--novasaas-text-muted);}
.novasaas-page-content h2,.novasaas-page-content h3,.novasaas-page-content h4{color:var(--novasaas-text);margin-top:1.75em;margin-bottom:.6em;}
.novasaas-page-content h2{font-size:var(--novasaas-text-3xl);}
.novasaas-page-content h3{font-size:var(--novasaas-text-2xl);}
.novasaas-page-content p{margin-bottom:1.5em;}
.novasaas-page-content a{color:var(--novasaas-primary-light);text-decoration:underline;text-underline-offset:3px;}
.novasaas-page-content blockquote{border-left:3px solid var(--novasaas-primary);padding-left:1.5rem;margin:2em 0;color:var(--novasaas-text);font-size:var(--novasaas-text-xl);font-style:italic;}
.novasaas-page-content ul,.novasaas-page-content ol{padding-left:1.5rem;margin-bottom:1.5em;display:flex;flex-direction:column;gap:.5em;}
.novasaas-page-content ul li{list-style:disc;}
.novasaas-page-content ol li{list-style:decimal;}
.novasaas-page-content img{border-radius:var(--novasaas-radius-lg);max-width:100%;height:auto;}
.novasaas-page-content table{width:100%;border-collapse:collapse;margin-bottom:1.5em;}
.novasaas-page-content th,.novasaas-page-content td{padding:.75rem 1rem;border:1px solid var(--novasaas-border-subtle);font-size:var(--novasaas-text-sm);}
.novasaas-page-content th{background:rgba(99,102,241,.08);font-weight:700;color:var(--novasaas-text);}
</style>

<section class="novasaas-section" style="background:var(--novasaas-bg-dark);">
	<div class="novasaas-container">

		<?php /* Breadcrumb */ ?>
		<?php novasaas_render_breadcrumb(); ?>

		<?php if ( has_post_thumbnail() ) : ?>
			<div style="margin-bottom:var(--novasaas-space-8);border-radius:var(--novasaas-radius-xl);overflow:hidden;">
				<?php the_post_thumbnail( 'novasaas-hero', array( 'style' => 'width:100%;max-height:480px;object-fit:cover;', 'loading' => 'eager' ) ); ?>
			</div>
		<?php endif; ?>

		<div class="novasaas-page-layout">

			<main id="novasaas-page-main" aria-label="<?php esc_attr_e( 'Page content', 'novasaas' ); ?>">

				<h1 style="font-size:var(--novasaas-text-5xl);font-weight:800;letter-spacing:-.03em;margin:0 0 var(--novasaas-space-8);line-height:1.1;">
					<?php the_title(); ?>
				</h1>

				<div class="novasaas-page-content">
					<?php the_content(); ?>
				</div>

				<?php wp_link_pages( array( 'before' => '<nav class="novasaas-page-links" style="margin-top:var(--novasaas-space-8)"><span style="font-weight:600;">' . esc_html__( 'Pages:', 'novasaas' ) . '</span>', 'after' => '</nav>' ) ); ?>

				<?php if ( comments_open() || get_comments_number() ) : ?>
					<div class="novasaas-glass-card novasaas-comments" style="margin-top:var(--novasaas-space-10);">
						<?php comments_template(); ?>
					</div>
				<?php endif; ?>

			</main>

			<?php if ( $has_sidebar ) : ?>
				<aside class="novasaas-blog-sidebar" aria-label="<?php esc_attr_e( 'Page sidebar', 'novasaas' ); ?>">
					<?php dynamic_sidebar( 'novasaas-sidebar' ); ?>
				</aside>
			<?php endif; ?>

		</div>

	</div>
</section>

<?php get_footer(); ?>
