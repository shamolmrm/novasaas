<?php
/**
 * Template Name: Pricing — NovaSaaS
 * Template Post Type: page
 *
 * @package NovaSaaS
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<style>
.novasaas-pricing-hero { padding-block:clamp(5rem,10vw,8rem); text-align:center; background:var(--novasaas-bg-dark); position:relative; overflow:hidden; }
.novasaas-pricing-hero::before { content:''; position:absolute; inset:0; background:radial-gradient(ellipse 80% 50% at 50% -10%,rgba(99,102,241,.15) 0,transparent 60%); pointer-events:none; }
.novasaas-pricing-hero__inner { position:relative; z-index:1; max-width:700px; margin:auto; display:flex; flex-direction:column; align-items:center; gap:var(--novasaas-space-5); }
.novasaas-feat-comp-table-wrap { overflow-x:auto; border-radius:var(--novasaas-radius-xl); border:1px solid var(--novasaas-border); }
.novasaas-feat-comp-table { width:100%; border-collapse:collapse; min-width:700px; }
.novasaas-feat-comp-table thead { background:rgba(99,102,241,.06); }
.novasaas-feat-comp-table th { padding:.875rem 1.25rem; text-align:left; font-size:var(--novasaas-text-sm); font-weight:700; border-bottom:1px solid var(--novasaas-border); color:var(--novasaas-text-muted); text-transform:uppercase; letter-spacing:.07em; }
.novasaas-feat-comp-table th:not(:first-child) { text-align:center; }
.novasaas-feat-comp-table td { padding:.8rem 1.25rem; font-size:var(--novasaas-text-sm); color:var(--novasaas-text-muted); border-bottom:1px solid var(--novasaas-border-subtle); }
.novasaas-feat-comp-table tbody tr:last-child td { border-bottom:none; }
.novasaas-feat-comp-table td:not(:first-child) { text-align:center; }
.novasaas-feat-comp-table td:first-child { color:var(--novasaas-text); font-weight:500; }
.novasaas-feat-comp-table tbody tr td:nth-child(3) { background:rgba(99,102,241,.04); }
.novasaas-feat-comp-table thead th:nth-child(3) { background:rgba(99,102,241,.08); color:var(--novasaas-primary-light); }
.novasaas-chk-y { color:var(--novasaas-success); }
.novasaas-chk-n { color:var(--novasaas-text-faint); }
.novasaas-feat-comp-table .novasaas-feat-comp-cat { font-size:var(--novasaas-text-xs); font-weight:700; text-transform:uppercase; letter-spacing:.1em; color:var(--novasaas-text-faint); background:var(--novasaas-bg-section); padding:.6rem 1.25rem; }
.novasaas-guarantee { display:flex; flex-direction:column; align-items:center; gap:var(--novasaas-space-4); text-align:center; padding:clamp(2.5rem,5vw,4rem); border-radius:var(--novasaas-radius-2xl); background:linear-gradient(135deg,rgba(16,185,129,.08) 0,rgba(99,102,241,.08) 100%); border:1px solid rgba(16,185,129,.2); }
.novasaas-guarantee__icon { font-size:3rem; }
.novasaas-guarantee__title { font-size:var(--novasaas-text-2xl); font-weight:800; margin:0; }
.novasaas-guarantee__text { color:var(--novasaas-text-muted); max-width:480px; margin:0; }
.novasaas-payment-logos { display:flex; flex-wrap:wrap; align-items:center; justify-content:center; gap:var(--novasaas-space-4); margin-top:var(--novasaas-space-6); }
.novasaas-payment-logo { display:inline-flex; align-items:center; justify-content:center; padding:.4rem 1rem; border-radius:var(--novasaas-radius-md); background:rgba(255,255,255,.05); border:1px solid var(--novasaas-border-subtle); font-size:var(--novasaas-text-sm); font-weight:700; color:var(--novasaas-text-muted); letter-spacing:.05em; }
.novasaas-enterprise-section { background:var(--novasaas-bg-section); }
.novasaas-enterprise__grid { display:grid; grid-template-columns:1fr; gap:clamp(2.5rem,5vw,4rem); align-items:center; }
@media(min-width:1024px){ .novasaas-enterprise__grid { grid-template-columns:1fr 1fr; } }
.novasaas-enterprise-form-wrap { padding:var(--novasaas-space-8); }
.novasaas-enterprise-form { display:flex; flex-direction:column; gap:var(--novasaas-space-4); }
.novasaas-form-group { display:flex; flex-direction:column; gap:var(--novasaas-space-2); }
.novasaas-form-label { font-size:var(--novasaas-text-sm); font-weight:600; color:var(--novasaas-text); }
</style>

<?php /* ── HERO ── */ ?>
<section class="novasaas-pricing-hero">
	<div class="novasaas-container">
		<div class="novasaas-pricing-hero__inner">
			<span class="novasaas-badge novasaas-badge--primary"><?php esc_html_e( 'Pricing', 'novasaas' ); ?></span>
			<h1 style="font-size:var(--novasaas-text-6xl);font-weight:800;letter-spacing:-.03em;margin:0;">
				<?php esc_html_e( 'Simple, transparent pricing', 'novasaas' ); ?>
			</h1>
			<p style="font-size:var(--novasaas-text-xl);color:var(--novasaas-text-muted);margin:0;">
				<?php esc_html_e( 'Start free. Scale as you grow. No hidden fees, ever.', 'novasaas' ); ?>
			</p>
		</div>
	</div>
</section>

<?php /* ── PRICING CARDS (same logic, larger) ── */ ?>
<section class="novasaas-section" style="background:var(--novasaas-bg-dark);" aria-label="<?php esc_attr_e('Pricing plans','novasaas'); ?>">
	<div class="novasaas-container">

		<!-- Toggle -->
		<div style="display:flex;align-items:center;justify-content:center;gap:var(--novasaas-space-4);margin-bottom:clamp(2.5rem,5vw,4rem);">
			<span id="nsp-label-monthly" class="novasaas-pricing__toggle-label is-active"><?php esc_html_e('Monthly','novasaas'); ?></span>
			<button type="button" id="nsp-switch" class="novasaas-pricing__switch" role="switch" aria-checked="false" aria-label="<?php esc_attr_e('Toggle yearly billing','novasaas'); ?>"><span class="novasaas-pricing__switch-thumb"></span></button>
			<span id="nsp-label-yearly" class="novasaas-pricing__toggle-label"><?php esc_html_e('Yearly','novasaas'); ?></span>
			<span id="nsp-save" class="novasaas-pricing__save-badge" hidden><?php esc_html_e('Save 20%','novasaas'); ?></span>
		</div>

		<div class="novasaas-pricing__grid">
		<?php
		$plans = array(
			array( 'id'=>'starter','name'=>__('Starter','novasaas'),'tagline'=>__('Perfect for small teams just getting started.','novasaas'),'price_m'=>'9','price_y'=>'7','featured'=>false,'cta_text'=>__('Get Started Free','novasaas'),'cta_url'=>novasaas_get_option('cta_url','#'),
				'features'=>array(
					array('text'=>__('5 team members','novasaas'),'yes'=>true),array('text'=>__('10 projects','novasaas'),'yes'=>true),array('text'=>__('5 GB storage','novasaas'),'yes'=>true),array('text'=>__('Basic analytics','novasaas'),'yes'=>true),array('text'=>__('Email support','novasaas'),'yes'=>true),array('text'=>__('AI Assistant','novasaas'),'yes'=>false),array('text'=>__('API access','novasaas'),'yes'=>false),array('text'=>__('SSO / SAML','novasaas'),'yes'=>false),
				)),
			array( 'id'=>'pro','name'=>__('Pro','novasaas'),'tagline'=>__('For growing teams that need more power.','novasaas'),'price_m'=>'29','price_y'=>'23','featured'=>true,'cta_text'=>__('Start Free Trial','novasaas'),'cta_url'=>novasaas_get_option('cta_url','#'),
				'features'=>array(
					array('text'=>__('Unlimited members','novasaas'),'yes'=>true),array('text'=>__('Unlimited projects','novasaas'),'yes'=>true),array('text'=>__('100 GB storage','novasaas'),'yes'=>true),array('text'=>__('Advanced analytics','novasaas'),'yes'=>true),array('text'=>__('Priority support','novasaas'),'yes'=>true),array('text'=>__('AI Assistant','novasaas'),'yes'=>true),array('text'=>__('API access','novasaas'),'yes'=>true),array('text'=>__('SSO / SAML','novasaas'),'yes'=>false),
				)),
			array( 'id'=>'enterprise','name'=>__('Enterprise','novasaas'),'tagline'=>__('For large organisations with advanced requirements.','novasaas'),'price_m'=>'99','price_y'=>'79','featured'=>false,'cta_text'=>__('Contact Sales','novasaas'),'cta_url'=>'#enterprise',
				'features'=>array(
					array('text'=>__('Everything in Pro','novasaas'),'yes'=>true),array('text'=>__('Unlimited storage','novasaas'),'yes'=>true),array('text'=>__('Custom integrations','novasaas'),'yes'=>true),array('text'=>__('Dedicated support','novasaas'),'yes'=>true),array('text'=>__('99.99% SLA','novasaas'),'yes'=>true),array('text'=>__('AI Assistant','novasaas'),'yes'=>true),array('text'=>__('API access','novasaas'),'yes'=>true),array('text'=>__('SSO / SAML','novasaas'),'yes'=>true),
				)),
		);
		foreach ( $plans as $i => $plan ) : ?>
			<div class="novasaas-glass-card novasaas-plan-card<?php echo $plan['featured'] ? ' novasaas-plan-card--featured':'' ; ?> novasaas-reveal" style="--reveal-delay:<?php echo esc_attr($i*100); ?>ms">
				<div class="novasaas-plan-card__header">
					<div class="novasaas-plan-card__badge-row">
						<?php if($plan['featured']): ?><span class="novasaas-plan-card__popular">&#11088; <?php esc_html_e('Most Popular','novasaas'); ?></span><?php else: ?><span></span><?php endif; ?>
					</div>
					<h2 class="novasaas-plan-card__name"><?php echo esc_html($plan['name']); ?></h2>
					<p class="novasaas-plan-card__tagline"><?php echo esc_html($plan['tagline']); ?></p>
					<div class="novasaas-plan-card__price-row">
						<span class="novasaas-plan-card__currency" aria-hidden="true">$</span>
						<span class="novasaas-price__amount" data-monthly="<?php echo esc_attr($plan['price_m']); ?>" data-yearly="<?php echo esc_attr($plan['price_y']); ?>"><?php echo esc_html($plan['price_m']); ?></span>
						<span class="novasaas-plan-card__period">/<?php esc_html_e('mo','novasaas'); ?></span>
					</div>
					<span class="novasaas-plan-card__billed" data-monthly="" data-yearly="<?php esc_attr_e('Billed annually','novasaas'); ?>"></span>
				</div>
				<div class="novasaas-plan-card__body">
					<ul class="novasaas-plan-card__features" role="list">
						<?php foreach($plan['features'] as $feat): ?>
							<li class="novasaas-plan-card__feature">
								<span class="novasaas-plan-card__feature-icon novasaas-plan-card__feature-icon--<?php echo $feat['yes']?'yes':'no'; ?>" aria-hidden="true"><?php echo $feat['yes']?'&#10003;':'&#10007;'; ?></span>
								<span><?php echo esc_html($feat['text']); ?></span>
							</li>
						<?php endforeach; ?>
					</ul>
					<a href="<?php echo esc_url($plan['cta_url']); ?>" class="<?php echo $plan['featured']?'novasaas-btn novasaas-w-full':'novasaas-btn-outline novasaas-w-full'; ?>" style="justify-content:center;"><?php echo esc_html($plan['cta_text']); ?></a>
				</div>
			</div>
		<?php endforeach; ?>
		</div>

		<!-- Money-back guarantee + payment logos -->
		<div style="margin-top:clamp(2.5rem,5vw,4rem);" class="novasaas-reveal">
			<div class="novasaas-guarantee">
				<span class="novasaas-guarantee__icon" aria-hidden="true">&#128737;&#65039;</span>
				<h3 class="novasaas-guarantee__title"><?php esc_html_e('30-Day Money-Back Guarantee','novasaas'); ?></h3>
				<p class="novasaas-guarantee__text"><?php esc_html_e("If you're not 100% satisfied within your first 30 days, we'll give you a full refund — no questions asked, no hoops to jump through.",'novasaas'); ?></p>
			</div>
			<div class="novasaas-payment-logos" aria-label="<?php esc_attr_e('Accepted payment methods','novasaas'); ?>">
				<span class="novasaas-payment-logo">VISA</span>
				<span class="novasaas-payment-logo">MASTERCARD</span>
				<span class="novasaas-payment-logo">PAYPAL</span>
				<span class="novasaas-payment-logo">AMEX</span>
				<span class="novasaas-payment-logo">STRIPE</span>
			</div>
		</div>

	</div>
</section>

<?php /* ── FEATURE COMPARISON TABLE ── */ ?>
<section class="novasaas-section" style="background:var(--novasaas-bg-section);" aria-labelledby="nsp-fc-title">
	<div class="novasaas-container">
		<div class="novasaas-section__header novasaas-reveal">
			<h2 id="nsp-fc-title" class="novasaas-section__title"><?php esc_html_e('Compare all features','novasaas'); ?></h2>
		</div>
		<div class="novasaas-feat-comp-table-wrap novasaas-reveal">
			<table class="novasaas-feat-comp-table" role="table">
				<thead>
					<tr>
						<th scope="col"><?php esc_html_e('Feature','novasaas'); ?></th>
						<th scope="col"><?php esc_html_e('Starter','novasaas'); ?></th>
						<th scope="col"><?php esc_html_e('Pro','novasaas'); ?> &#11088;</th>
						<th scope="col"><?php esc_html_e('Enterprise','novasaas'); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php
					$fc_rows = array(
						'cat' => array(__('Workspace','novasaas'), array(
							array(__('Team members','novasaas'), '5', __('Unlimited','novasaas'), __('Unlimited','novasaas')),
							array(__('Projects','novasaas'), '10', __('Unlimited','novasaas'), __('Unlimited','novasaas')),
							array(__('Storage','novasaas'), '5 GB', '100 GB', __('Unlimited','novasaas')),
							array(__('File uploads','novasaas'), '25 MB', '100 MB', __('Unlimited','novasaas')),
						)),
						'cat2' => array(__('Features','novasaas'), array(
							array(__('Kanban boards','novasaas'), true, true, true),
							array(__('Gantt charts','novasaas'), false, true, true),
							array(__('Time tracking','novasaas'), false, true, true),
							array(__('AI Assistant','novasaas'), false, true, true),
							array(__('Custom workflows','novasaas'), false, true, true),
							array(__('API access','novasaas'), false, true, true),
						)),
						'cat3' => array(__('Security & Compliance','novasaas'), array(
							array(__('SSO / SAML','novasaas'), false, false, true),
							array(__('Audit logs','novasaas'), false, false, true),
							array(__('Custom contracts','novasaas'), false, false, true),
							array(__('99.99% SLA','novasaas'), false, false, true),
							array(__('Data residency','novasaas'), false, false, true),
						)),
						'cat4' => array(__('Support','novasaas'), array(
							array(__('Email support','novasaas'), true, true, true),
							array(__('Priority support','novasaas'), false, true, true),
							array(__('Dedicated manager','novasaas'), false, false, true),
							array(__('Onboarding help','novasaas'), false, true, true),
						)),
					);
					$render_cell = function($v) {
						if ( true === $v  ) return '<span class="novasaas-chk-y" aria-label="' . esc_attr__('Yes','novasaas') . '">&#10003;</span>';
						if ( false === $v ) return '<span class="novasaas-chk-n" aria-label="' . esc_attr__('No','novasaas') . '">&#10007;</span>';
						return esc_html($v);
					};
					foreach ( $fc_rows as $cat_key => $cat_data ) :
						list( $cat_name, $cat_rows ) = $cat_data;
						?>
						<tr><td class="novasaas-feat-comp-cat" colspan="4"><?php echo esc_html($cat_name); ?></td></tr>
						<?php foreach ( $cat_rows as $row ) : ?>
							<tr>
								<td><?php echo esc_html($row[0]); ?></td>
								<td><?php echo $render_cell($row[1]); ?></td>
								<td><?php echo $render_cell($row[2]); ?></td>
								<td><?php echo $render_cell($row[3]); ?></td>
							</tr>
						<?php endforeach; ?>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</section>

<?php /* ── ENTERPRISE SECTION ── */ ?>
<section class="novasaas-section novasaas-enterprise-section" id="enterprise" aria-labelledby="nsp-ent-title">
	<div class="novasaas-container">
		<div class="novasaas-enterprise__grid">
			<div class="novasaas-reveal">
				<span class="novasaas-section__eyebrow"><?php esc_html_e('Enterprise','novasaas'); ?></span>
				<h2 id="nsp-ent-title" class="novasaas-section__title" style="font-size:var(--novasaas-text-4xl);text-align:left;"><?php esc_html_e('Need a custom plan?','novasaas'); ?></h2>
				<p style="color:var(--novasaas-text-muted);line-height:var(--novasaas-leading-relaxed);margin-bottom:var(--novasaas-space-6);"><?php esc_html_e("We work with companies of all sizes. If you need custom pricing, additional seats, a dedicated account manager, or special compliance requirements — let's talk.",'novasaas'); ?></p>
				<ul style="list-style:none;display:flex;flex-direction:column;gap:var(--novasaas-space-3);">
					<?php $perks = array(__('Dedicated customer success manager','novasaas'),__('Custom SLA and uptime guarantees','novasaas'),__('Flexible billing and invoicing','novasaas'),__('Security review and SSO setup','novasaas'),__('Priority onboarding and training','novasaas'));
					foreach($perks as $perk): ?>
						<li style="display:flex;align-items:center;gap:.75rem;font-size:var(--novasaas-text-sm);color:var(--novasaas-text-muted);">
							<span style="color:var(--novasaas-success);">&#10003;</span> <?php echo esc_html($perk); ?>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
			<div class="novasaas-glass-card novasaas-enterprise-form-wrap novasaas-reveal novasaas-delay-2">
				<h3 style="font-size:var(--novasaas-text-xl);font-weight:700;margin:0 0 var(--novasaas-space-5);"><?php esc_html_e("Talk to our sales team",'novasaas'); ?></h3>
				<form class="novasaas-enterprise-form" method="post" action="<?php echo esc_url(home_url('/')); ?>" novalidate>
					<?php wp_nonce_field('novasaas_enterprise_form','novasaas_enterprise_nonce'); ?>
					<div class="novasaas-form-group">
						<label class="novasaas-form-label" for="ent-name"><?php esc_html_e('Full Name *','novasaas'); ?></label>
						<input type="text" id="ent-name" name="novasaas_ent_name" class="novasaas-input" placeholder="<?php esc_attr_e('Sarah Chen','novasaas'); ?>" required>
					</div>
					<div class="novasaas-form-group">
						<label class="novasaas-form-label" for="ent-email"><?php esc_html_e('Work Email *','novasaas'); ?></label>
						<input type="email" id="ent-email" name="novasaas_ent_email" class="novasaas-input" placeholder="<?php esc_attr_e('sarah@company.com','novasaas'); ?>" required>
					</div>
					<div class="novasaas-form-group">
						<label class="novasaas-form-label" for="ent-company"><?php esc_html_e('Company Name','novasaas'); ?></label>
						<input type="text" id="ent-company" name="novasaas_ent_company" class="novasaas-input" placeholder="<?php esc_attr_e('Acme Corp','novasaas'); ?>">
					</div>
					<div class="novasaas-form-group">
						<label class="novasaas-form-label" for="ent-team-size"><?php esc_html_e('Team Size','novasaas'); ?></label>
						<select id="ent-team-size" name="novasaas_ent_team_size" class="novasaas-input">
							<option value=""><?php esc_html_e('Select team size','novasaas'); ?></option>
							<option value="50-100">50–100</option>
							<option value="100-500">100–500</option>
							<option value="500+">500+</option>
						</select>
					</div>
					<button type="submit" class="novasaas-btn" style="width:100%;justify-content:center;"><?php esc_html_e('Request a Demo','novasaas'); ?></button>
					<p style="font-size:var(--novasaas-text-xs);color:var(--novasaas-text-faint);text-align:center;margin:0;"><?php esc_html_e("We'll get back to you within one business day.",'novasaas'); ?></p>
				</form>
			</div>
		</div>
	</div>
</section>

<?php /* ── PRICING FAQ ── */ ?>
<section class="novasaas-section" style="background:var(--novasaas-bg-dark);" aria-labelledby="nsp-faq-title">
	<div class="novasaas-container">
		<div class="novasaas-section__header novasaas-reveal">
			<h2 id="nsp-faq-title" class="novasaas-section__title"><?php esc_html_e('Billing questions','novasaas'); ?></h2>
		</div>
		<div class="novasaas-faq__list novasaas-reveal">
		<?php
		$faqs = array(
			array('q'=>__('When does my trial end?','novasaas'),'a'=>__("Your 14-day free trial starts the moment you sign up. You'll get a reminder email 3 days before it ends. No credit card is charged unless you choose to upgrade.",'novasaas')),
			array('q'=>__('Do you offer annual billing?','novasaas'),'a'=>__("Yes! Paying annually saves you 20% compared to monthly billing. You're billed once upfront for the full year. You can switch between monthly and annual at any time.",'novasaas')),
			array('q'=>__('Can I add or remove team members?','novasaas'),'a'=>__("On the Pro and Enterprise plans, adding team members is instant and pro-rated. Removing members takes effect at the next billing cycle.",'novasaas')),
			array('q'=>__('What if I exceed my storage limit?','novasaas'),'a'=>__("We'll notify you when you reach 80% of your storage limit. You can upgrade your plan or purchase additional storage add-ons at any time.",'novasaas')),
			array('q'=>__('Do prices include tax?','novasaas'),'a'=>__("All listed prices are exclusive of applicable taxes. Tax is calculated at checkout based on your billing address. For EU customers, VAT will be added where applicable.",'novasaas')),
			array('q'=>__('How does the 30-day refund work?','novasaas'),'a'=>__("If you're on a paid plan for less than 30 days and aren't satisfied, simply email us at billing@streamflow.com and we'll process your full refund within 5 business days.",'novasaas')),
		);
		foreach ( $faqs as $i => $faq ) :
			$faq_id = 'nsp-faq-' . ($i+1);
			$panel_id = $faq_id . '-panel';
		?>
			<div class="novasaas-faq__item" role="listitem">
				<button type="button" class="novasaas-faq__question" id="<?php echo esc_attr($faq_id); ?>" aria-expanded="false" aria-controls="<?php echo esc_attr($panel_id); ?>">
					<span><?php echo esc_html($faq['q']); ?></span>
					<span class="novasaas-faq__icon" aria-hidden="true"><svg width="14" height="14" viewBox="0 0 14 14" fill="none"><line x1="7" y1="1" x2="7" y2="13" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/><line x1="1" y1="7" x2="13" y2="7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg></span>
				</button>
				<div class="novasaas-faq__answer" id="<?php echo esc_attr($panel_id); ?>" role="region" aria-labelledby="<?php echo esc_attr($faq_id); ?>" hidden>
					<div class="novasaas-faq__answer-inner"><?php echo esc_html($faq['a']); ?></div>
				</div>
			</div>
		<?php endforeach; ?>
		</div>
	</div>
</section>

<script>
( function () {
	'use strict';
	/* Reveal */
	if('IntersectionObserver'in window){const o=new IntersectionObserver(function(entries){entries.forEach(function(e){if(e.isIntersecting){const d=parseInt(e.target.style.getPropertyValue('--reveal-delay')||'0',10);setTimeout(function(){e.target.classList.add('is-visible');},d);o.unobserve(e.target);}});},{threshold:0.1,rootMargin:'0px 0px -40px 0px'});document.querySelectorAll('.novasaas-reveal').forEach(function(el){o.observe(el);});}else{document.querySelectorAll('.novasaas-reveal').forEach(function(el){el.classList.add('is-visible');});}

	/* Pricing toggle */
	const sw=document.getElementById('nsp-switch'),lm=document.getElementById('nsp-label-monthly'),ly=document.getElementById('nsp-label-yearly'),sb=document.getElementById('nsp-save');
	let yearly=false;
	function setP(y){yearly=y;if(sw){sw.classList.toggle('is-yearly',y);sw.setAttribute('aria-checked',y?'true':'false');}if(lm)lm.classList.toggle('is-active',!y);if(ly)ly.classList.toggle('is-active',y);if(sb){if(y)sb.removeAttribute('hidden');else sb.setAttribute('hidden','');}
	document.querySelectorAll('.novasaas-price__amount').forEach(function(el){el.textContent=y?(el.dataset.yearly||el.dataset.monthly):el.dataset.monthly;});
	document.querySelectorAll('.novasaas-plan-card__billed').forEach(function(el){el.textContent=y?(el.dataset.yearly||''):'';}); }
	if(sw)sw.addEventListener('click',function(){setP(!yearly);});
	if(lm){lm.addEventListener('click',function(){setP(false);});lm.setAttribute('tabindex','0');lm.addEventListener('keydown',function(e){if(' '===e.key||'Enter'===e.key)setP(false);});}
	if(ly){ly.addEventListener('click',function(){setP(true);});ly.setAttribute('tabindex','0');ly.addEventListener('keydown',function(e){if(' '===e.key||'Enter'===e.key)setP(true);});}

	/* FAQ */
	document.querySelectorAll('.novasaas-faq__item').forEach(function(item){
		const btn=item.querySelector('.novasaas-faq__question'),panel=item.querySelector('.novasaas-faq__answer');
		if(!btn||!panel)return;
		btn.addEventListener('click',function(){
			const open=item.classList.contains('is-open');
			document.querySelectorAll('.novasaas-faq__item').forEach(function(o){const ob=o.querySelector('.novasaas-faq__question'),op=o.querySelector('.novasaas-faq__answer');o.classList.remove('is-open');if(ob)ob.setAttribute('aria-expanded','false');if(op){op.style.maxHeight='0';setTimeout(function(){op.setAttribute('hidden','');},400);}});
			if(!open){item.classList.add('is-open');btn.setAttribute('aria-expanded','true');panel.removeAttribute('hidden');panel.style.maxHeight='0';requestAnimationFrame(function(){panel.style.maxHeight=panel.scrollHeight+'px';});}
		});
	});

	/* Smooth scroll */
	document.querySelectorAll('a[href^="#"]').forEach(function(a){a.addEventListener('click',function(e){const id=a.getAttribute('href');if('#'===id)return;const t=document.querySelector(id);if(!t)return;e.preventDefault();const h=document.getElementById('novasaas-header');window.scrollTo({top:t.getBoundingClientRect().top+window.scrollY-(h?h.offsetHeight+16:80),behavior:'smooth'});});});
}() );
</script>

<?php get_footer(); ?>
