<?php
/**
 * Template Name: Features — NovaSaaS
 * Template Post Type: page
 *
 * @package NovaSaaS
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<style>
/* ── Features page specifics ──────────────────────────────────────────── */
.novasaas-feat-hero { background: var(--novasaas-bg-dark); padding-block: clamp(5rem,10vw,9rem); text-align: center; position: relative; overflow: hidden; }
.novasaas-feat-hero::before { content:''; position:absolute; inset:0; background: radial-gradient(ellipse 80% 50% at 50% -20%, rgba(99,102,241,.18) 0, transparent 60%); }
.novasaas-feat-hero__inner { position:relative; z-index:1; max-width:780px; margin:auto; display:flex; flex-direction:column; align-items:center; gap:var(--novasaas-space-6); }

/* ── Category sections ────────────────────────────────────────────────── */
.novasaas-feat-cat { padding-block: clamp(3rem,7vw,6rem); }
.novasaas-feat-cat:nth-child(even) { background: var(--novasaas-bg-section); }
.novasaas-feat-cat__header { margin-bottom: clamp(2rem,5vw,4rem); }
.novasaas-feat-cat__label { display:inline-flex; align-items:center; gap:.5rem; font-size:var(--novasaas-text-sm); font-weight:700; text-transform:uppercase; letter-spacing:.1em; color:var(--novasaas-primary-light); margin-bottom:var(--novasaas-space-3); }
.novasaas-feat-cat__title { font-size:var(--novasaas-text-4xl); font-weight:800; margin:0 0 var(--novasaas-space-3); letter-spacing:-.025em; }
.novasaas-feat-cat__sub { font-size:var(--novasaas-text-lg); color:var(--novasaas-text-muted); max-width:600px; margin:0; }
.novasaas-feat-list { display:flex; flex-direction:column; gap:var(--novasaas-space-6); }
.novasaas-feat-item { display:grid; grid-template-columns:1fr; gap:var(--novasaas-space-5); padding:var(--novasaas-space-7); }
@media(min-width:640px){ .novasaas-feat-item { grid-template-columns: 80px 1fr; } }
.novasaas-feat-item__icon { width:64px; height:64px; border-radius:var(--novasaas-radius-lg); background:rgba(99,102,241,.12); border:1px solid var(--novasaas-border); display:flex; align-items:center; justify-content:center; font-size:1.75rem; flex-shrink:0; }
.novasaas-feat-item__content { display:flex; flex-direction:column; gap:var(--novasaas-space-2); }
.novasaas-feat-item__title { font-size:var(--novasaas-text-xl); font-weight:700; color:var(--novasaas-text); margin:0; }
.novasaas-feat-item__desc { font-size:var(--novasaas-text-base); color:var(--novasaas-text-muted); margin:0; line-height:var(--novasaas-leading-relaxed); }
.novasaas-feat-item__link { display:inline-flex; align-items:center; gap:.25rem; font-size:var(--novasaas-text-sm); font-weight:600; color:var(--novasaas-primary-light); margin-top:var(--novasaas-space-1); transition:gap var(--novasaas-transition-fast), color var(--novasaas-transition-fast); }
.novasaas-feat-item__link:hover { gap:var(--novasaas-space-2); color:var(--novasaas-primary); }

/* ── Comparison table ─────────────────────────────────────────────────── */
.novasaas-comparison { background: var(--novasaas-bg-section); }
.novasaas-comparison__table-wrap { overflow-x: auto; -webkit-overflow-scrolling: touch; border-radius:var(--novasaas-radius-xl); border:1px solid var(--novasaas-border); }
.novasaas-comparison__table { width:100%; border-collapse:collapse; min-width:600px; }
.novasaas-comparison__table thead { background:rgba(99,102,241,.08); }
.novasaas-comparison__table th { padding:1rem 1.5rem; text-align:left; font-size:var(--novasaas-text-sm); font-weight:700; text-transform:uppercase; letter-spacing:.07em; color:var(--novasaas-text-muted); border-bottom:1px solid var(--novasaas-border); }
.novasaas-comparison__table th:not(:first-child) { text-align:center; }
.novasaas-comparison__table td { padding:.875rem 1.5rem; font-size:var(--novasaas-text-sm); color:var(--novasaas-text-muted); border-bottom:1px solid var(--novasaas-border-subtle); }
.novasaas-comparison__table tbody tr:last-child td { border-bottom:none; }
.novasaas-comparison__table tbody tr:hover { background:rgba(99,102,241,.04); }
.novasaas-comparison__table td:not(:first-child) { text-align:center; }
.novasaas-comparison__table td:first-child { font-weight:500; color:var(--novasaas-text); }
.novasaas-comparison__table th:nth-child(2),
.novasaas-comparison__table td:nth-child(2) { background:rgba(99,102,241,.05); font-weight:600; }
.novasaas-check-yes { color:var(--novasaas-success); font-size:1rem; }
.novasaas-check-no  { color:var(--novasaas-text-faint); font-size:1rem; }
.novasaas-check-note{ color:var(--novasaas-warning); font-size:var(--novasaas-text-xs); }
.novasaas-comparison__head-badge { display:inline-flex; align-items:center; gap:.25rem; padding:.15em .6em; background:var(--novasaas-gradient-primary); border-radius:var(--novasaas-radius-full); font-size:.65rem; color:#fff; font-weight:700; vertical-align:middle; margin-left:.25rem; }

/* ── Integrations ─────────────────────────────────────────────────────── */
.novasaas-integrations { background: var(--novasaas-bg-dark); }
.novasaas-integrations__grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(130px,1fr)); gap:var(--novasaas-space-4); }
.novasaas-integration-card { display:flex; flex-direction:column; align-items:center; justify-content:center; gap:var(--novasaas-space-3); padding:var(--novasaas-space-6) var(--novasaas-space-4); text-align:center; cursor:default; }
.novasaas-integration-card__logo { width:48px; height:48px; border-radius:var(--novasaas-radius-md); display:flex; align-items:center; justify-content:center; font-size:var(--novasaas-text-xl); font-weight:800; color:#fff; flex-shrink:0; }
.novasaas-integration-card__name { font-size:var(--novasaas-text-sm); font-weight:600; color:var(--novasaas-text-muted); }
</style>

<?php /* ── SECTION 1: HERO ── */ ?>
<section class="novasaas-feat-hero">
	<div class="novasaas-container">
		<div class="novasaas-feat-hero__inner">
			<span class="novasaas-badge novasaas-badge--primary"><?php esc_html_e( 'Features', 'novasaas' ); ?></span>
			<h1 class="novasaas-section__title" style="font-size:var(--novasaas-text-6xl);">
				<?php esc_html_e( 'Powerful features for', 'novasaas' ); ?>
				<span class="novasaas-gradient-text"> <?php esc_html_e( 'modern teams', 'novasaas' ); ?></span>
			</h1>
			<p style="font-size:var(--novasaas-text-lg);color:var(--novasaas-text-muted);max-width:580px;margin:0;text-align:center;line-height:var(--novasaas-leading-relaxed);">
				<?php esc_html_e( 'Everything you need to plan, build, and ship great products — beautifully designed and endlessly customizable.', 'novasaas' ); ?>
			</p>
			<div style="display:flex;flex-wrap:wrap;gap:var(--novasaas-space-3);justify-content:center;">
				<a href="<?php echo esc_url( novasaas_get_option( 'cta_url', '#' ) ); ?>" class="novasaas-btn novasaas-btn--lg">
					<?php esc_html_e( 'Start Free Trial', 'novasaas' ); ?>
				</a>
				<a href="<?php echo esc_url( '#comparison' ); ?>" class="novasaas-btn-outline novasaas-btn-outline--lg">
					<?php esc_html_e( 'Compare Plans', 'novasaas' ); ?>
				</a>
			</div>
		</div>
	</div>
</section>

<?php
$categories = array(
	array(
		'label' => __( 'Collaboration Tools', 'novasaas' ),
		'title' => __( 'Work better together, in real time', 'novasaas' ),
		'sub'   => __( 'Bring your team together with tools built for seamless real-time collaboration — no matter where everyone is.', 'novasaas' ),
		'features' => array(
			array( 'icon' => '&#9997;&#65039;', 'title' => __( 'Real-time Editing', 'novasaas' ), 'desc' => __( 'Multiple team members can edit the same document simultaneously. Live cursors and instant sync ensure everyone is always on the same page.', 'novasaas' ) ),
			array( 'icon' => '&#128172;', 'title' => __( 'Comments & Mentions', 'novasaas' ), 'desc' => __( 'Leave contextual comments on any task, document, or project. Tag teammates with @username for instant notifications and faster resolution.', 'novasaas' ) ),
			array( 'icon' => '&#128104;&#8205;&#128105;&#8205;&#128102;&#8205;&#128103;', 'title' => __( 'Team Channels', 'novasaas' ), 'desc' => __( 'Organise conversations into dedicated channels by project, team, or topic. Keep discussions focused and searchable forever.', 'novasaas' ) ),
			array( 'icon' => '&#127909;', 'title' => __( 'Video Meeting Integration', 'novasaas' ), 'desc' => __( 'Launch Zoom, Google Meet, or Microsoft Teams calls directly from any task or project. Automatically attach meeting recordings and notes.', 'novasaas' ) ),
		),
	),
	array(
		'label' => __( 'Project Management', 'novasaas' ),
		'title' => __( 'Every way to manage work', 'novasaas' ),
		'sub'   => __( 'Kanban, Gantt, list, timeline — switch views instantly. StreamFlow adapts to how your team thinks.', 'novasaas' ),
		'features' => array(
			array( 'icon' => '&#127922;', 'title' => __( 'Kanban Boards', 'novasaas' ), 'desc' => __( 'Visual drag-and-drop boards for tracking work in progress. Custom columns, WIP limits, and swimlanes for any workflow you can imagine.', 'novasaas' ) ),
			array( 'icon' => '&#128200;', 'title' => __( 'Gantt Charts', 'novasaas' ), 'desc' => __( 'Interactive timeline views for complex projects. Set dependencies, track milestones, and spot bottlenecks before they become blockers.', 'novasaas' ) ),
			array( 'icon' => '&#9201;&#65039;', 'title' => __( 'Time Tracking', 'novasaas' ), 'desc' => __( 'Built-in time tracker with one-click start/stop. Generate detailed timesheets, track budgets, and invoice clients accurately.', 'novasaas' ) ),
			array( 'icon' => '&#9881;&#65039;', 'title' => __( 'Custom Workflows', 'novasaas' ), 'desc' => __( 'Build automated workflows with a no-code rule builder. Trigger actions on status changes, due dates, or custom field updates.', 'novasaas' ) ),
		),
	),
	array(
		'label' => __( 'Analytics & Reporting', 'novasaas' ),
		'title' => __( 'Insights that drive better decisions', 'novasaas' ),
		'sub'   => __( 'Turn raw project data into clear, actionable insights with beautiful dashboards and flexible reporting tools.', 'novasaas' ),
		'features' => array(
			array( 'icon' => '&#128202;', 'title' => __( 'Real-time Dashboards', 'novasaas' ), 'desc' => __( 'Customisable dashboards with 20+ widget types. Track velocity, burndown, resource allocation, and team health all in one place.', 'novasaas' ) ),
			array( 'icon' => '&#128196;', 'title' => __( 'Custom Reports', 'novasaas' ), 'desc' => __( 'Build reports with a drag-and-drop report builder. Filter, group, and visualise any data point. Schedule automated delivery to stakeholders.', 'novasaas' ) ),
			array( 'icon' => '&#128190;', 'title' => __( 'Export to CSV / PDF', 'novasaas' ), 'desc' => __( 'Export any report, board, or dataset to CSV or beautifully formatted PDF with one click. Perfect for client presentations and audits.', 'novasaas' ) ),
			array( 'icon' => '&#127919;', 'title' => __( 'Goal Tracking', 'novasaas' ), 'desc' => __( 'Set OKRs and KPIs at the company, team, or individual level. Roll-up progress automatically from linked tasks and sub-goals.', 'novasaas' ) ),
		),
	),
);
?>

<?php foreach ( $categories as $ci => $cat ) : ?>
<section class="novasaas-feat-cat">
	<div class="novasaas-container">
		<div class="novasaas-feat-cat__header novasaas-reveal">
			<div class="novasaas-feat-cat__label"><?php echo esc_html( $cat['label'] ); ?></div>
			<h2 class="novasaas-feat-cat__title"><?php echo esc_html( $cat['title'] ); ?></h2>
			<p class="novasaas-feat-cat__sub"><?php echo esc_html( $cat['sub'] ); ?></p>
		</div>
		<div class="novasaas-feat-list">
			<?php foreach ( $cat['features'] as $fi => $feat ) : ?>
				<article class="novasaas-glass-card novasaas-feat-item novasaas-reveal" style="--reveal-delay:<?php echo esc_attr( $fi * 80 ); ?>ms">
					<div class="novasaas-feat-item__icon" aria-hidden="true"><?php echo $feat['icon']; ?></div>
					<div class="novasaas-feat-item__content">
						<h3 class="novasaas-feat-item__title"><?php echo esc_html( $feat['title'] ); ?></h3>
						<p class="novasaas-feat-item__desc"><?php echo esc_html( $feat['desc'] ); ?></p>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>"
						   class="novasaas-feat-item__link"
						   aria-label="<?php printf( esc_attr__( 'Learn more about %s', 'novasaas' ), esc_attr( $feat['title'] ) ); ?>">
							<?php esc_html_e( 'Learn more', 'novasaas' ); ?> &rarr;
						</a>
					</div>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<?php endforeach; ?>

<?php /* ── SECTION 3: COMPARISON TABLE ── */ ?>
<section class="novasaas-section novasaas-comparison" id="comparison" aria-labelledby="novasaas-comparison-title">
	<div class="novasaas-container">
		<div class="novasaas-section__header novasaas-reveal">
			<span class="novasaas-section__eyebrow"><?php esc_html_e( 'How We Compare', 'novasaas' ); ?></span>
			<h2 id="novasaas-comparison-title" class="novasaas-section__title"><?php esc_html_e( 'See why teams choose StreamFlow', 'novasaas' ); ?></h2>
		</div>
		<div class="novasaas-comparison__table-wrap novasaas-reveal">
			<table class="novasaas-comparison__table" role="table" aria-label="<?php esc_attr_e( 'Feature comparison table', 'novasaas' ); ?>">
				<thead>
					<tr>
						<th scope="col"><?php esc_html_e( 'Feature', 'novasaas' ); ?></th>
						<th scope="col">
							<?php esc_html_e( 'StreamFlow', 'novasaas' ); ?>
							<span class="novasaas-comparison__head-badge">&#11088;</span>
						</th>
						<th scope="col"><?php esc_html_e( 'Basic Tool', 'novasaas' ); ?></th>
						<th scope="col"><?php esc_html_e( 'Enterprise Tool', 'novasaas' ); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php
					$rows = array(
						array( __( 'Real-time collaboration', 'novasaas' ), true, true, true ),
						array( __( 'Unlimited projects', 'novasaas' ), true, false, true ),
						array( __( 'Advanced analytics', 'novasaas' ), true, false, 'note' ),
						array( __( 'API access', 'novasaas' ), true, false, true ),
						array( __( 'SSO / SAML', 'novasaas' ), true, false, true ),
						array( __( 'Custom integrations', 'novasaas' ), true, false, 'note' ),
						array( __( 'Priority support', 'novasaas' ), true, false, true ),
						array( __( 'SLA guarantee', 'novasaas' ), true, false, true ),
						array( __( 'Data export', 'novasaas' ), true, true, true ),
						array( __( 'Mobile apps', 'novasaas' ), true, true, true ),
					);

					foreach ( $rows as $row ) :
						$feature     = $row[0];
						$streamflow  = $row[1];
						$basic       = $row[2];
						$enterprise  = $row[3];

						$render = function ( $val ) {
							if ( true === $val ) {
								return '<span class="novasaas-check-yes" aria-label="' . esc_attr__( 'Yes', 'novasaas' ) . '">&#10003;</span>';
							} elseif ( false === $val ) {
								return '<span class="novasaas-check-no" aria-label="' . esc_attr__( 'No', 'novasaas' ) . '">&#10007;</span>';
							}
							return '<span class="novasaas-check-yes">&#10003;</span><br><span class="novasaas-check-note">' . esc_html__( 'Add-on cost', 'novasaas' ) . '</span>';
						};
						?>
						<tr>
							<td><?php echo esc_html( $feature ); ?></td>
							<td><?php echo $render( $streamflow ); ?></td>
							<td><?php echo $render( $basic ); ?></td>
							<td><?php echo $render( $enterprise ); ?></td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</section>

<?php /* ── SECTION 4: INTEGRATIONS ── */ ?>
<section class="novasaas-section novasaas-integrations" aria-labelledby="novasaas-integrations-title">
	<div class="novasaas-container">
		<div class="novasaas-section__header novasaas-reveal">
			<span class="novasaas-section__eyebrow"><?php esc_html_e( 'Integrations', 'novasaas' ); ?></span>
			<h2 id="novasaas-integrations-title" class="novasaas-section__title">
				<?php esc_html_e( 'Connects with your favourite tools', 'novasaas' ); ?>
			</h2>
			<p class="novasaas-section__subtitle"><?php esc_html_e( '200+ integrations. Works with the tools your team already loves.', 'novasaas' ); ?></p>
		</div>
		<div class="novasaas-integrations__grid">
			<?php
			$integrations = array(
				array( 'name' => 'Slack',        'abbr' => 'SL', 'bg' => '4A154B' ),
				array( 'name' => 'GitHub',       'abbr' => 'GH', 'bg' => '24292F' ),
				array( 'name' => 'Jira',         'abbr' => 'JI', 'bg' => '0052CC' ),
				array( 'name' => 'Figma',        'abbr' => 'FG', 'bg' => 'F24E1E' ),
				array( 'name' => 'Google Drive', 'abbr' => 'GD', 'bg' => '34A853' ),
				array( 'name' => 'Notion',       'abbr' => 'NO', 'bg' => '000000' ),
				array( 'name' => 'Zapier',       'abbr' => 'ZP', 'bg' => 'FF4A00' ),
				array( 'name' => 'Stripe',       'abbr' => 'ST', 'bg' => '6772E5' ),
				array( 'name' => 'HubSpot',      'abbr' => 'HS', 'bg' => 'FF7A59' ),
				array( 'name' => 'Salesforce',   'abbr' => 'SF', 'bg' => '00A1E0' ),
				array( 'name' => 'AWS',          'abbr' => 'AW', 'bg' => 'FF9900' ),
				array( 'name' => 'Zoom',         'abbr' => 'ZM', 'bg' => '2D8CFF' ),
			);
			foreach ( $integrations as $i => $int ) :
			?>
				<div class="novasaas-glass-card novasaas-integration-card novasaas-reveal" style="--reveal-delay:<?php echo esc_attr( $i * 50 ); ?>ms">
					<?php echo novasaas_get_svg_avatar( $int['abbr'], $int['bg'] ); ?>
					<span class="novasaas-integration-card__name"><?php echo esc_html( $int['name'] ); ?></span>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<?php /* ── SECTION 5: CTA ── */ ?>
<section class="novasaas-cta-banner" aria-labelledby="novasaas-feat-cta-title">
	<div class="novasaas-container">
		<div class="novasaas-cta-banner__inner">
			<h2 id="novasaas-feat-cta-title" class="novasaas-cta-banner__title novasaas-reveal">
				<?php esc_html_e( 'Ready to see it in action?', 'novasaas' ); ?>
			</h2>
			<p class="novasaas-cta-banner__subtitle novasaas-reveal novasaas-delay-1">
				<?php esc_html_e( 'Start your 14-day free trial. No credit card required.', 'novasaas' ); ?>
			</p>
			<div style="display:flex;flex-wrap:wrap;gap:var(--novasaas-space-3);justify-content:center;" class="novasaas-reveal novasaas-delay-2">
				<a href="<?php echo esc_url( novasaas_get_option( 'cta_url', '#' ) ); ?>"
				   class="novasaas-cta-banner__submit" style="text-decoration:none;">
					<?php esc_html_e( 'Start Free Trial', 'novasaas' ); ?>
				</a>
			</div>
			<div class="novasaas-cta-banner__trust novasaas-reveal novasaas-delay-3">
				<span class="novasaas-cta-banner__trust-item"><span class="novasaas-cta-banner__trust-check">&#10003;</span><?php esc_html_e( 'Free 14-day trial', 'novasaas' ); ?></span>
				<span class="novasaas-cta-banner__trust-item"><span class="novasaas-cta-banner__trust-check">&#10003;</span><?php esc_html_e( 'No credit card', 'novasaas' ); ?></span>
				<span class="novasaas-cta-banner__trust-item"><span class="novasaas-cta-banner__trust-check">&#10003;</span><?php esc_html_e( 'Cancel anytime', 'novasaas' ); ?></span>
			</div>
		</div>
	</div>
</section>

<script>
( function () {
	if ( 'IntersectionObserver' in window ) {
		const o = new IntersectionObserver( function ( entries ) {
			entries.forEach( function ( e ) {
				if ( e.isIntersecting ) {
					const d = parseInt( e.target.style.getPropertyValue('--reveal-delay') || '0', 10 );
					setTimeout( function() { e.target.classList.add('is-visible'); }, d );
					o.unobserve( e.target );
				}
			});
		}, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' } );
		document.querySelectorAll('.novasaas-reveal').forEach( function(el){ o.observe(el); } );
	} else {
		document.querySelectorAll('.novasaas-reveal').forEach( function(el){ el.classList.add('is-visible'); } );
	}

	document.querySelectorAll('a[href^="#"]').forEach( function(a) {
		a.addEventListener('click', function(e) {
			const id = a.getAttribute('href');
			if ( '#' === id ) return;
			const t = document.querySelector(id);
			if ( ! t ) return;
			e.preventDefault();
			const h = document.getElementById('novasaas-header');
			const offset = h ? h.offsetHeight + 16 : 80;
			window.scrollTo({ top: t.getBoundingClientRect().top + window.scrollY - offset, behavior: 'smooth' });
		});
	});
}() );
</script>

<?php get_footer(); ?>
