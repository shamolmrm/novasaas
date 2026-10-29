<?php
/**
 * Template Name: About — NovaSaaS
 * Template Post Type: page
 *
 * @package NovaSaaS
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<style>
.novasaas-about-hero { min-height: 60vh; display:flex; align-items:center; background:var(--novasaas-bg-dark); position:relative; overflow:hidden; padding-block:clamp(5rem,10vw,9rem); text-align:center; }
.novasaas-about-hero::before { content:''; position:absolute; inset:0; background:radial-gradient(ellipse 70% 50% at 50% -10%, rgba(99,102,241,.18) 0, transparent 60%); pointer-events:none; }
.novasaas-about-hero__inner { position:relative; z-index:1; max-width:800px; margin:auto; }
.novasaas-story { background:var(--novasaas-bg-section); }
.novasaas-story__grid { display:grid; grid-template-columns:1fr; gap:clamp(2rem,5vw,5rem); align-items:center; }
@media(min-width:1024px){ .novasaas-story__grid { grid-template-columns:1fr 1fr; } }
.novasaas-story__text { display:flex; flex-direction:column; gap:var(--novasaas-space-5); }
.novasaas-story__text h2 { font-size:var(--novasaas-text-4xl); font-weight:800; letter-spacing:-.025em; margin:0; }
.novasaas-story__text p { color:var(--novasaas-text-muted); line-height:var(--novasaas-leading-relaxed); margin:0; }
.novasaas-story__image-placeholder { width:100%; aspect-ratio:4/3; border-radius:var(--novasaas-radius-xl); background:var(--novasaas-bg-card); border:1px solid var(--novasaas-border); display:flex; align-items:center; justify-content:center; flex-direction:column; gap:var(--novasaas-space-4); color:var(--novasaas-text-faint); }
.novasaas-values { background:var(--novasaas-bg-dark); }
.novasaas-values__grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(240px,1fr)); gap:var(--novasaas-space-6); }
.novasaas-value-card { padding:var(--novasaas-space-8); display:flex; flex-direction:column; gap:var(--novasaas-space-4); }
.novasaas-value-card__icon { font-size:2rem; }
.novasaas-value-card__title { font-size:var(--novasaas-text-xl); font-weight:700; margin:0; color:var(--novasaas-text); }
.novasaas-value-card__desc { color:var(--novasaas-text-muted); font-size:var(--novasaas-text-base); line-height:var(--novasaas-leading-relaxed); margin:0; }
.novasaas-about-stats { background:var(--novasaas-bg-section); }
.novasaas-about-stats__grid { display:grid; grid-template-columns:repeat(2,1fr); gap:1px; background:var(--novasaas-border-subtle); border-radius:var(--novasaas-radius-xl); overflow:hidden; }
@media(min-width:768px){ .novasaas-about-stats__grid { grid-template-columns:repeat(4,1fr); } }
.novasaas-about-stat { background:var(--novasaas-bg-card); padding:clamp(1.5rem,4vw,2.5rem); text-align:center; display:flex; flex-direction:column; align-items:center; gap:var(--novasaas-space-2); }
.novasaas-about-stat__num { font-family:var(--novasaas-font-heading); font-size:var(--novasaas-text-5xl); font-weight:800; letter-spacing:-.03em; background:var(--novasaas-gradient-primary); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text; }
.novasaas-about-stat__label { font-size:var(--novasaas-text-sm); color:var(--novasaas-text-muted); font-weight:500; }
.novasaas-team { background:var(--novasaas-bg-dark); }
.novasaas-team__grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(240px,1fr)); gap:var(--novasaas-space-6); }
.novasaas-team-card { display:flex; flex-direction:column; align-items:center; text-align:center; padding:var(--novasaas-space-8) var(--novasaas-space-6); gap:var(--novasaas-space-4); }
.novasaas-team-card__avatar .novasaas-svg-avatar { width:80px; height:80px; border-radius:50%; border:3px solid var(--novasaas-border-hover); }
.novasaas-team-card__name { font-size:var(--novasaas-text-xl); font-weight:700; color:var(--novasaas-text); margin:0; }
.novasaas-team-card__role { font-size:var(--novasaas-text-sm); color:var(--novasaas-primary-light); font-weight:600; margin:0; }
.novasaas-team-card__bio { font-size:var(--novasaas-text-sm); color:var(--novasaas-text-muted); margin:0; line-height:var(--novasaas-leading-relaxed); }
.novasaas-team-card__social { display:flex; gap:var(--novasaas-space-2); }
.novasaas-team-card__social a { width:36px; height:36px; border-radius:50%; border:1px solid var(--novasaas-border); display:flex; align-items:center; justify-content:center; color:var(--novasaas-text-muted); transition:color var(--novasaas-transition-fast),background var(--novasaas-transition-fast),border-color var(--novasaas-transition-fast); }
.novasaas-team-card__social a:hover { color:var(--novasaas-text); background:rgba(99,102,241,.12); border-color:var(--novasaas-border-hover); }
.novasaas-team-card__social svg { width:16px; height:16px; }
.novasaas-offices { background:var(--novasaas-bg-section); }
.novasaas-offices__grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(260px,1fr)); gap:var(--novasaas-space-6); }
.novasaas-office-card { display:flex; flex-direction:column; gap:0; overflow:hidden; padding:0; }
.novasaas-office-card__img { aspect-ratio:3/2; background:linear-gradient(135deg,var(--novasaas-bg-card) 0,#2D2545 100%); display:flex; align-items:center; justify-content:center; flex-direction:column; gap:var(--novasaas-space-2); color:var(--novasaas-text-faint); font-size:2rem; }
.novasaas-office-card__body { padding:var(--novasaas-space-5) var(--novasaas-space-6); }
.novasaas-office-card__city { font-size:var(--novasaas-text-lg); font-weight:700; color:var(--novasaas-text); margin:0 0 var(--novasaas-space-1); }
.novasaas-office-card__country { font-size:var(--novasaas-text-sm); color:var(--novasaas-text-muted); margin:0; }
.novasaas-hiring { background:var(--novasaas-bg-dark); text-align:center; }
.novasaas-hiring__inner { padding:clamp(3rem,6vw,5rem); border-radius:var(--novasaas-radius-2xl); background:linear-gradient(135deg,rgba(99,102,241,.08) 0,rgba(236,72,153,.08) 100%); border:1px solid var(--novasaas-border); display:flex; flex-direction:column; align-items:center; gap:var(--novasaas-space-6); }
</style>

<?php /* ── SECTION 1: HERO ── */ ?>
<section class="novasaas-about-hero" aria-labelledby="novasaas-about-title">
	<div class="novasaas-container">
		<div class="novasaas-about-hero__inner">
			<span class="novasaas-badge novasaas-badge--primary"><?php esc_html_e( 'Our Story', 'novasaas' ); ?></span>
			<h1 id="novasaas-about-title" class="novasaas-section__title" style="font-size:var(--novasaas-text-7xl);margin:var(--novasaas-space-4) 0;">
				<?php esc_html_e( "We're building the", 'novasaas' ); ?>
				<span class="novasaas-gradient-text"> <?php esc_html_e( 'future of work', 'novasaas' ); ?></span>
			</h1>
			<p style="font-size:var(--novasaas-text-xl);color:var(--novasaas-text-muted);max-width:640px;margin:0 auto;line-height:var(--novasaas-leading-relaxed);">
				<?php esc_html_e( 'StreamFlow was founded with a single mission: make collaboration effortless for every team on the planet.', 'novasaas' ); ?>
			</p>
		</div>
	</div>
</section>

<?php /* ── SECTION 2: STORY ── */ ?>
<section class="novasaas-section novasaas-story" aria-labelledby="novasaas-story-title">
	<div class="novasaas-container">
		<div class="novasaas-story__grid">
			<div class="novasaas-story__text novasaas-reveal">
				<span class="novasaas-section__eyebrow"><?php esc_html_e( 'How It Started', 'novasaas' ); ?></span>
				<h2 id="novasaas-story-title"><?php esc_html_e( 'Born out of frustration, built with passion', 'novasaas' ); ?></h2>
				<p><?php esc_html_e( "In 2020, our founders Sarah and Mark were leading a distributed team across three continents. They tried every project management tool out there — and found that each one required painful tradeoffs between power and simplicity.", 'novasaas' ); ?></p>
				<p><?php esc_html_e( "So they built StreamFlow: the tool they always wished existed. Fast, beautiful, and powerful enough for enterprise teams but intuitive enough that anyone can use it on day one. No training required.", 'novasaas' ); ?></p>
				<p><?php esc_html_e( "Today, StreamFlow is trusted by 10,000+ teams in 150+ countries. We're a remote-first company with team members in San Francisco, London, Berlin, and Singapore.", 'novasaas' ); ?></p>
				<a href="<?php echo esc_url( novasaas_get_option( 'cta_url', '#' ) ); ?>" class="novasaas-btn" style="width:fit-content;">
					<?php esc_html_e( 'Join Our Team', 'novasaas' ); ?>
				</a>
			</div>
			<div class="novasaas-story__image-placeholder novasaas-reveal novasaas-delay-2">
				<span aria-hidden="true" style="font-size:3rem;">&#128247;</span>
				<p style="margin:0;font-size:var(--novasaas-text-sm);"><?php esc_html_e( 'Team photo placeholder', 'novasaas' ); ?></p>
			</div>
		</div>
	</div>
</section>

<?php /* ── SECTION 3: VALUES ── */ ?>
<section class="novasaas-section novasaas-values" aria-labelledby="novasaas-values-title">
	<div class="novasaas-container">
		<div class="novasaas-section__header novasaas-reveal">
			<span class="novasaas-section__eyebrow"><?php esc_html_e( 'Our Values', 'novasaas' ); ?></span>
			<h2 id="novasaas-values-title" class="novasaas-section__title"><?php esc_html_e( 'What drives us every day', 'novasaas' ); ?></h2>
		</div>
		<div class="novasaas-values__grid">
			<?php
			$values = array(
				array( 'icon' => '&#128161;', 'title' => __( 'Innovation', 'novasaas' ), 'desc' => __( "We challenge the status quo every single day. If there's a better way to solve a problem, we'll find it — even if it means throwing out everything we built yesterday.", 'novasaas' ) ),
				array( 'icon' => '&#128269;', 'title' => __( 'Transparency', 'novasaas' ), 'desc' => __( 'Open by default. We share our roadmap, our mistakes, and our wins publicly. Our customers and team deserve to know exactly what we\'re building and why.', 'novasaas' ) ),
				array( 'icon' => '&#128155;', 'title' => __( 'Customer First', 'novasaas' ), 'desc' => __( 'Every decision starts with a question: does this make our customers\' lives better? Not our metrics, not our investors — our customers.', 'novasaas' ) ),
				array( 'icon' => '&#127775;', 'title' => __( 'Team First', 'novasaas' ), 'desc' => __( 'Great products are built by great teams. We invest heavily in our people — their growth, their happiness, and their ability to do the best work of their lives.', 'novasaas' ) ),
			);
			foreach ( $values as $i => $v ) : ?>
				<div class="novasaas-glass-card novasaas-value-card novasaas-reveal" style="--reveal-delay:<?php echo esc_attr( $i * 100 ); ?>ms">
					<div class="novasaas-value-card__icon" aria-hidden="true"><?php echo $v['icon']; ?></div>
					<h3 class="novasaas-value-card__title"><?php echo esc_html( $v['title'] ); ?></h3>
					<p class="novasaas-value-card__desc"><?php echo esc_html( $v['desc'] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<?php /* ── SECTION 4: STATS ── */ ?>
<section class="novasaas-section novasaas-about-stats" aria-label="<?php esc_attr_e( 'Company statistics', 'novasaas' ); ?>">
	<div class="novasaas-container">
		<div class="novasaas-about-stats__grid">
			<?php
			$stats = array(
				array( 'num' => '2020',  'label' => __( 'Founded', 'novasaas' ) ),
				array( 'num' => '45+',   'label' => __( 'Team Members', 'novasaas' ) ),
				array( 'num' => '30+',   'label' => __( 'Countries', 'novasaas' ) ),
				array( 'num' => '$12M',  'label' => __( 'Raised', 'novasaas' ) ),
			);
			foreach ( $stats as $i => $s ) : ?>
				<div class="novasaas-about-stat novasaas-reveal" style="--reveal-delay:<?php echo esc_attr( $i * 100 ); ?>ms">
					<span class="novasaas-about-stat__num"><?php echo esc_html( $s['num'] ); ?></span>
					<span class="novasaas-about-stat__label"><?php echo esc_html( $s['label'] ); ?></span>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<?php /* ── SECTION 5: TEAM ── */ ?>
<section class="novasaas-section novasaas-team" aria-labelledby="novasaas-team-title">
	<div class="novasaas-container">
		<div class="novasaas-section__header novasaas-reveal">
			<span class="novasaas-section__eyebrow"><?php esc_html_e( 'The Team', 'novasaas' ); ?></span>
			<h2 id="novasaas-team-title" class="novasaas-section__title"><?php esc_html_e( 'Meet the people behind StreamFlow', 'novasaas' ); ?></h2>
		</div>
		<div class="novasaas-team__grid">
			<?php
			$team = array(
				array( 'initials'=>'SC', 'bg'=>'6366F1', 'name'=>'Sarah Chen',  'role'=>__('CEO & Co-Founder','novasaas'), 'bio'=>__('Former VP at Salesforce. Passionate about building products that change how people work.','novasaas'), 'li'=>'#', 'tw'=>'#' ),
				array( 'initials'=>'MD', 'bg'=>'06B6D4', 'name'=>'Mark Davis',  'role'=>__('CTO & Co-Founder','novasaas'), 'bio'=>__('Ex-Google engineer. 15+ years scaling distributed systems. Loves clean architecture and great coffee.','novasaas'), 'li'=>'#', 'tw'=>'#' ),
				array( 'initials'=>'LP', 'bg'=>'EC4899', 'name'=>'Lisa Park',   'role'=>__('Head of Design','novasaas'),   'bio'=>__('Formerly at Figma and Airbnb. Believes that great design is invisible — until it\'s missing.','novasaas'), 'li'=>'#', 'tw'=>'#' ),
				array( 'initials'=>'TW', 'bg'=>'10B981', 'name'=>'Tom Wilson',  'role'=>__('Lead Developer','novasaas'),   'bio'=>__('Full-stack wizard. Open source contributor. Built StreamFlow\'s real-time sync engine from scratch.','novasaas'), 'li'=>'#', 'tw'=>'#' ),
			);
			foreach ( $team as $i => $m ) :
				$li_url = novasaas_get_option( 'team_' . strtolower( str_replace( ' ', '_', $m['name'] ) ) . '_linkedin', $m['li'] );
				$tw_url = novasaas_get_option( 'team_' . strtolower( str_replace( ' ', '_', $m['name'] ) ) . '_twitter', $m['tw'] );
			?>
				<div class="novasaas-glass-card novasaas-team-card novasaas-reveal" style="--reveal-delay:<?php echo esc_attr( $i * 100 ); ?>ms">
					<div class="novasaas-team-card__avatar">
						<?php echo novasaas_get_svg_avatar( $m['initials'], $m['bg'] ); ?>
					</div>
					<h3 class="novasaas-team-card__name"><?php echo esc_html( $m['name'] ); ?></h3>
					<p class="novasaas-team-card__role"><?php echo esc_html( $m['role'] ); ?></p>
					<p class="novasaas-team-card__bio"><?php echo esc_html( $m['bio'] ); ?></p>
					<div class="novasaas-team-card__social" aria-label="<?php printf( esc_attr__( '%s social links', 'novasaas' ), esc_attr( $m['name'] ) ); ?>">
						<a href="<?php echo esc_url( $li_url ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php printf( esc_attr__( '%s on LinkedIn', 'novasaas' ), esc_attr( $m['name'] ) ); ?>">
							<svg viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 0 1-2.063-2.065 2.064 2.064 0 1 1 2.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
						</a>
						<a href="<?php echo esc_url( $tw_url ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php printf( esc_attr__( '%s on Twitter', 'novasaas' ), esc_attr( $m['name'] ) ); ?>">
							<svg viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.744l7.73-8.835L2.003 2.25h6.961l4.259 5.63 5.021-5.63Zm-1.161 17.52h1.833L7.084 4.126H5.117L17.083 19.77Z"/></svg>
						</a>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<?php /* ── SECTION 6: OFFICES ── */ ?>
<section class="novasaas-section novasaas-offices" aria-labelledby="novasaas-offices-title">
	<div class="novasaas-container">
		<div class="novasaas-section__header novasaas-reveal">
			<span class="novasaas-section__eyebrow"><?php esc_html_e( 'Our Offices', 'novasaas' ); ?></span>
			<h2 id="novasaas-offices-title" class="novasaas-section__title"><?php esc_html_e( 'Remote-first, globally present', 'novasaas' ); ?></h2>
		</div>
		<div class="novasaas-offices__grid">
			<?php
			$offices = array(
				array( 'city' => __( 'San Francisco', 'novasaas' ), 'country' => __( 'United States — HQ', 'novasaas' ), 'icon' => '&#127968;' ),
				array( 'city' => __( 'London', 'novasaas' ),        'country' => __( 'United Kingdom', 'novasaas' ),    'icon' => '&#127981;' ),
				array( 'city' => __( 'Singapore', 'novasaas' ),     'country' => __( 'Asia Pacific Hub', 'novasaas' ),  'icon' => '&#127970;' ),
			);
			foreach ( $offices as $i => $office ) : ?>
				<div class="novasaas-glass-card novasaas-office-card novasaas-reveal" style="--reveal-delay:<?php echo esc_attr( $i * 100 ); ?>ms">
					<div class="novasaas-office-card__img" aria-hidden="true">
						<span><?php echo $office['icon']; ?></span>
						<span style="font-size:var(--novasaas-text-sm)"><?php esc_html_e( 'Office photo', 'novasaas' ); ?></span>
					</div>
					<div class="novasaas-office-card__body">
						<h3 class="novasaas-office-card__city"><?php echo esc_html( $office['city'] ); ?></h3>
						<p class="novasaas-office-card__country"><?php echo esc_html( $office['country'] ); ?></p>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<?php /* ── SECTION 7: HIRING CTA ── */ ?>
<section class="novasaas-section novasaas-hiring" aria-labelledby="novasaas-hiring-title">
	<div class="novasaas-container">
		<div class="novasaas-hiring__inner novasaas-reveal">
			<span class="novasaas-badge novasaas-badge--success">&#128205; <?php esc_html_e( "We're hiring", 'novasaas' ); ?></span>
			<h2 id="novasaas-hiring-title" class="novasaas-section__title">
				<?php esc_html_e( 'Come build the future with us', 'novasaas' ); ?>
			</h2>
			<p style="font-size:var(--novasaas-text-lg);color:var(--novasaas-text-muted);max-width:540px;margin:0;text-align:center;">
				<?php esc_html_e( "We're always looking for talented people who care deeply about craft, users, and doing their best work. Remote-friendly. Competitive compensation.", 'novasaas' ); ?>
			</p>
			<a href="<?php echo esc_url( novasaas_get_option( 'careers_url', home_url( '/careers' ) ) ); ?>" class="novasaas-btn novasaas-btn--lg">
				<?php esc_html_e( 'View Open Positions', 'novasaas' ); ?> &rarr;
			</a>
		</div>
	</div>
</section>

<script>
( function () {
	if ( 'IntersectionObserver' in window ) {
		const o = new IntersectionObserver( function(entries){ entries.forEach(function(e){ if(e.isIntersecting){ const d=parseInt(e.target.style.getPropertyValue('--reveal-delay')||'0',10); setTimeout(function(){e.target.classList.add('is-visible');},d); o.unobserve(e.target); } }); },{ threshold:0.1,rootMargin:'0px 0px -40px 0px' } );
		document.querySelectorAll('.novasaas-reveal').forEach(function(el){ o.observe(el); });
	} else { document.querySelectorAll('.novasaas-reveal').forEach(function(el){ el.classList.add('is-visible'); }); }
}() );
</script>

<?php get_footer(); ?>
