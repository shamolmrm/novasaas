<?php
/**
 * Template Name: Contact — NovaSaaS
 * Template Post Type: page
 *
 * @package NovaSaaS
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

get_header();

$contact_address = novasaas_get_option( 'contact_address', __( '123 Tech Street, San Francisco, CA 94105', 'novasaas' ) );
$contact_email   = novasaas_get_option( 'contact_email', 'hello@streamflow.com' );
$contact_phone   = novasaas_get_option( 'contact_phone', '+1 (555) 000-0000' );
?>

<style>
.novasaas-contact-hero{padding-block:clamp(4rem,8vw,7rem);background:var(--novasaas-bg-dark);text-align:center;position:relative;overflow:hidden;}
.novasaas-contact-hero::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse 70% 40% at 50% -10%,rgba(99,102,241,.15) 0,transparent 60%);pointer-events:none;}
.novasaas-contact-hero__inner{position:relative;z-index:1;max-width:600px;margin:auto;display:flex;flex-direction:column;align-items:center;gap:var(--novasaas-space-4);}
.novasaas-contact-section{background:var(--novasaas-bg-section);}
.novasaas-contact__grid{display:grid;grid-template-columns:1fr;gap:clamp(2.5rem,5vw,4rem);}
@media(min-width:1024px){.novasaas-contact__grid{grid-template-columns:1fr 1.6fr;}}
.novasaas-contact__info{display:flex;flex-direction:column;gap:var(--novasaas-space-6);}
.novasaas-contact-info-card{display:flex;align-items:flex-start;gap:var(--novasaas-space-4);padding:var(--novasaas-space-5) var(--novasaas-space-6);}
.novasaas-contact-info-card__icon{width:48px;height:48px;border-radius:var(--novasaas-radius-lg);background:rgba(99,102,241,.12);border:1px solid var(--novasaas-border);display:flex;align-items:center;justify-content:center;font-size:1.3rem;flex-shrink:0;}
.novasaas-contact-info-card__label{font-size:var(--novasaas-text-xs);font-weight:700;text-transform:uppercase;letter-spacing:.1em;color:var(--novasaas-text-faint);margin:0 0 .25rem;}
.novasaas-contact-info-card__value{font-size:var(--novasaas-text-base);color:var(--novasaas-text);font-weight:500;margin:0;}
.novasaas-contact-info-card__value a{color:var(--novasaas-primary-light);transition:color var(--novasaas-transition-fast);}
.novasaas-contact-info-card__value a:hover{color:var(--novasaas-primary);}
.novasaas-contact__response-badge{display:inline-flex;align-items:center;gap:.5rem;padding:.5em 1em;background:rgba(16,185,129,.1);border:1px solid rgba(16,185,129,.25);border-radius:var(--novasaas-radius-full);font-size:var(--novasaas-text-sm);font-weight:600;color:var(--novasaas-success);}
.novasaas-contact__social-links{display:flex;gap:var(--novasaas-space-3);}
.novasaas-contact__social-link{width:40px;height:40px;border-radius:var(--novasaas-radius-md);border:1px solid var(--novasaas-border);background:rgba(255,255,255,.04);display:flex;align-items:center;justify-content:center;color:var(--novasaas-text-muted);transition:color var(--novasaas-transition-fast),background var(--novasaas-transition-fast),border-color var(--novasaas-transition-fast),transform var(--novasaas-transition-fast);}
.novasaas-contact__social-link:hover{color:var(--novasaas-text);background:rgba(99,102,241,.12);border-color:var(--novasaas-border-hover);transform:translateY(-2px);}
.novasaas-contact__social-link svg{width:16px;height:16px;}
.novasaas-contact-form-wrap{padding:var(--novasaas-space-8);}
.novasaas-contact-form{display:flex;flex-direction:column;gap:var(--novasaas-space-5);}
.novasaas-contact-form__row{display:grid;grid-template-columns:1fr;gap:var(--novasaas-space-4);}
@media(min-width:640px){.novasaas-contact-form__row{grid-template-columns:1fr 1fr;}}
.novasaas-form-group{display:flex;flex-direction:column;gap:var(--novasaas-space-2);}
.novasaas-form-label{font-size:var(--novasaas-text-sm);font-weight:600;color:var(--novasaas-text);}
.novasaas-form-label span{color:var(--novasaas-secondary);}
.novasaas-input,textarea.novasaas-input,select.novasaas-input{width:100%;padding:.75em 1em;background:rgba(255,255,255,.05);border:1px solid var(--novasaas-border);border-radius:var(--novasaas-radius-md);color:var(--novasaas-text);font-size:var(--novasaas-text-base);font-family:inherit;transition:border-color var(--novasaas-transition-fast),box-shadow var(--novasaas-transition-fast);}
.novasaas-input::placeholder{color:var(--novasaas-text-faint);}
.novasaas-input:focus,textarea.novasaas-input:focus,select.novasaas-input:focus{outline:none;border-color:var(--novasaas-primary);box-shadow:0 0 0 3px rgba(99,102,241,.15);}
.novasaas-input.is-error{border-color:var(--novasaas-danger);}
select.novasaas-input{cursor:pointer;appearance:none;background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%2364748B' stroke-width='1.5' fill='none' stroke-linecap='round'/%3E%3C/svg%3E");background-repeat:no-repeat;background-position:right 1rem center;}
textarea.novasaas-input{resize:vertical;min-height:140px;}
.novasaas-contact-form__submit-row{display:flex;align-items:center;gap:var(--novasaas-space-4);}
.novasaas-contact-form__btn{flex-shrink:0;}
.novasaas-contact-form__btn.is-loading{opacity:.7;pointer-events:none;}
.novasaas-contact-form__msg{display:none;padding:.75em 1em;border-radius:var(--novasaas-radius-md);font-size:var(--novasaas-text-sm);font-weight:600;}
.novasaas-contact-form__msg.is-success{display:block;background:var(--novasaas-success-bg);border:1px solid rgba(16,185,129,.3);color:var(--novasaas-success);}
.novasaas-contact-form__msg.is-error{display:block;background:var(--novasaas-danger-bg);border:1px solid rgba(239,68,68,.3);color:var(--novasaas-danger);}
.novasaas-contact-map{background:var(--novasaas-bg-dark);}
.novasaas-contact-map__frame{width:100%;height:400px;border-radius:var(--novasaas-radius-xl);overflow:hidden;border:1px solid var(--novasaas-border);}
.novasaas-contact-map__frame iframe{display:block;width:100%;height:100%;filter:invert(.9) hue-rotate(185deg) saturate(0.6);}
</style>

<?php /* ── HERO ── */ ?>
<section class="novasaas-contact-hero" aria-labelledby="novasaas-contact-title">
	<div class="novasaas-container">
		<div class="novasaas-contact-hero__inner">
			<span class="novasaas-badge novasaas-badge--primary"><?php esc_html_e( 'Contact', 'novasaas' ); ?></span>
			<h1 id="novasaas-contact-title" style="font-size:var(--novasaas-text-6xl);font-weight:800;letter-spacing:-.03em;margin:0;">
				<?php esc_html_e( 'Get in', 'novasaas' ); ?> <span class="novasaas-gradient-text"><?php esc_html_e( 'touch', 'novasaas' ); ?></span>
			</h1>
			<p style="font-size:var(--novasaas-text-lg);color:var(--novasaas-text-muted);margin:0;">
				<?php esc_html_e( "Have a question or just want to say hello? We'd love to hear from you.", 'novasaas' ); ?>
			</p>
		</div>
	</div>
</section>

<?php /* ── CONTACT SECTION ── */ ?>
<section class="novasaas-section novasaas-contact-section" aria-label="<?php esc_attr_e( 'Contact information and form', 'novasaas' ); ?>">
	<div class="novasaas-container">
		<div class="novasaas-contact__grid">

			<!-- Left: Info -->
			<div class="novasaas-contact__info novasaas-reveal">

				<div class="novasaas-glass-card novasaas-contact-info-card">
					<div class="novasaas-contact-info-card__icon" aria-hidden="true">&#128205;</div>
					<div>
						<p class="novasaas-contact-info-card__label"><?php esc_html_e( 'Address', 'novasaas' ); ?></p>
						<p class="novasaas-contact-info-card__value"><?php echo esc_html( $contact_address ); ?></p>
					</div>
				</div>

				<div class="novasaas-glass-card novasaas-contact-info-card">
					<div class="novasaas-contact-info-card__icon" aria-hidden="true">&#128231;</div>
					<div>
						<p class="novasaas-contact-info-card__label"><?php esc_html_e( 'Email', 'novasaas' ); ?></p>
						<p class="novasaas-contact-info-card__value">
							<a href="mailto:<?php echo esc_attr( sanitize_email( $contact_email ) ); ?>">
								<?php echo esc_html( sanitize_email( $contact_email ) ); ?>
							</a>
						</p>
					</div>
				</div>

				<div class="novasaas-glass-card novasaas-contact-info-card">
					<div class="novasaas-contact-info-card__icon" aria-hidden="true">&#128222;</div>
					<div>
						<p class="novasaas-contact-info-card__label"><?php esc_html_e( 'Phone', 'novasaas' ); ?></p>
						<p class="novasaas-contact-info-card__value">
							<a href="tel:<?php echo esc_attr( sanitize_text_field( $contact_phone ) ); ?>">
								<?php echo esc_html( sanitize_text_field( $contact_phone ) ); ?>
							</a>
						</p>
					</div>
				</div>

				<div class="novasaas-contact__response-badge">
					<span aria-hidden="true">&#9201;&#65039;</span>
					<?php esc_html_e( 'Response within 24 hours', 'novasaas' ); ?>
				</div>

				<div>
					<p style="font-size:var(--novasaas-text-sm);color:var(--novasaas-text-muted);margin:0 0 var(--novasaas-space-3);"><?php esc_html_e( 'Follow us', 'novasaas' ); ?></p>
					<div class="novasaas-contact__social-links" aria-label="<?php esc_attr_e( 'Social media links', 'novasaas' ); ?>">
						<?php
						$socials = array(
							array( 'url' => novasaas_get_option( 'social_twitter', '#' ), 'label' => __( 'Twitter', 'novasaas' ), 'icon' => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.744l7.73-8.835L2.003 2.25h6.961l4.259 5.63 5.021-5.63Zm-1.161 17.52h1.833L7.084 4.126H5.117L17.083 19.77Z"/></svg>' ),
							array( 'url' => novasaas_get_option( 'social_linkedin', '#' ), 'label' => __( 'LinkedIn', 'novasaas' ), 'icon' => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 0 1-2.063-2.065 2.064 2.064 0 1 1 2.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>' ),
							array( 'url' => novasaas_get_option( 'social_github', '#' ),  'label' => __( 'GitHub', 'novasaas' ),  'icon' => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 .297c-6.63 0-12 5.373-12 12 0 5.303 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61C4.422 18.07 3.633 17.7 3.633 17.7c-1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.42.36.81 1.096.81 2.22 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 22.092 24 17.592 24 12.297c0-6.627-5.373-12-12-12"/></svg>' ),
						);
						foreach ( $socials as $s ) :
							if ( empty( $s['url'] ) || '#' === $s['url'] ) continue;
						?>
							<a href="<?php echo esc_url( $s['url'] ); ?>" target="_blank" rel="noopener noreferrer" class="novasaas-contact__social-link" aria-label="<?php echo esc_attr( $s['label'] ); ?>">
								<?php echo $s['icon']; ?>
							</a>
						<?php endforeach; ?>
					</div>
				</div>

			</div>

			<!-- Right: Form -->
			<div class="novasaas-glass-card novasaas-contact-form-wrap novasaas-reveal novasaas-delay-2">
				<h2 style="font-size:var(--novasaas-text-2xl);font-weight:700;margin:0 0 var(--novasaas-space-6);"><?php esc_html_e( 'Send us a message', 'novasaas' ); ?></h2>

				<form id="novasaas-contact-form"
					  class="novasaas-contact-form"
					  method="post"
					  action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>"
					  novalidate>

					<?php wp_nonce_field( 'novasaas_contact', 'novasaas_contact_nonce' ); ?>
					<input type="hidden" name="action" value="novasaas_contact">

					<div class="novasaas-contact-form__row">
						<div class="novasaas-form-group">
							<label class="novasaas-form-label" for="nc-name"><?php esc_html_e( 'Full Name', 'novasaas' ); ?> <span>*</span></label>
							<input type="text" id="nc-name" name="novasaas_name" class="novasaas-input" placeholder="<?php esc_attr_e( 'Sarah Chen', 'novasaas' ); ?>" required autocomplete="name">
						</div>
						<div class="novasaas-form-group">
							<label class="novasaas-form-label" for="nc-email"><?php esc_html_e( 'Email Address', 'novasaas' ); ?> <span>*</span></label>
							<input type="email" id="nc-email" name="novasaas_email" class="novasaas-input" placeholder="<?php esc_attr_e( 'sarah@company.com', 'novasaas' ); ?>" required autocomplete="email">
						</div>
					</div>

					<div class="novasaas-form-group">
						<label class="novasaas-form-label" for="nc-subject"><?php esc_html_e( 'Subject', 'novasaas' ); ?> <span>*</span></label>
						<select id="nc-subject" name="novasaas_subject" class="novasaas-input" required>
							<option value=""><?php esc_html_e( 'Select a topic', 'novasaas' ); ?></option>
							<option value="general"><?php esc_html_e( 'General Inquiry', 'novasaas' ); ?></option>
							<option value="sales"><?php esc_html_e( 'Sales', 'novasaas' ); ?></option>
							<option value="support"><?php esc_html_e( 'Technical Support', 'novasaas' ); ?></option>
							<option value="partnership"><?php esc_html_e( 'Partnership', 'novasaas' ); ?></option>
						</select>
					</div>

					<div class="novasaas-form-group">
						<label class="novasaas-form-label" for="nc-message"><?php esc_html_e( 'Message', 'novasaas' ); ?> <span>*</span></label>
						<textarea id="nc-message" name="novasaas_message" class="novasaas-input" placeholder="<?php esc_attr_e( 'Tell us how we can help you…', 'novasaas' ); ?>" required></textarea>
					</div>

					<div class="novasaas-contact-form__submit-row">
						<button type="submit" id="nc-submit" class="novasaas-btn novasaas-contact-form__btn">
							<span class="nc-btn-text"><?php esc_html_e( 'Send Message', 'novasaas' ); ?></span>
							<span class="nc-btn-loading" hidden aria-hidden="true">
								<svg width="18" height="18" viewBox="0 0 18 18" fill="none" style="animation:novasaas-spin .8s linear infinite;">
									<circle cx="9" cy="9" r="7" stroke="currentColor" stroke-width="2" stroke-dasharray="22 22" stroke-linecap="round"/>
								</svg>
								<?php esc_html_e( 'Sending…', 'novasaas' ); ?>
							</span>
						</button>
					</div>

					<div id="nc-msg" class="novasaas-contact-form__msg" role="alert" aria-live="polite"></div>

				</form>
			</div>

		</div>
	</div>
</section>

<?php /* ── MAP ── */ ?>
<section class="novasaas-section novasaas-contact-map" aria-label="<?php esc_attr_e( 'Office location map', 'novasaas' ); ?>">
	<div class="novasaas-container">
		<div class="novasaas-contact-map__frame">
			<iframe
				src="https://www.openstreetmap.org/export/embed.html?bbox=-122.431297%2C37.773972%2C-122.411297%2C37.783972&amp;layer=mapnik"
				title="<?php esc_attr_e( 'StreamFlow office location on OpenStreetMap', 'novasaas' ); ?>"
				loading="lazy"
				referrerpolicy="no-referrer-when-downgrade">
			</iframe>
		</div>
	</div>
</section>

<style>@keyframes novasaas-spin{from{stroke-dashoffset:44;}to{stroke-dashoffset:0;}}</style>

<script>
( function () {
	'use strict';
	if('IntersectionObserver'in window){const o=new IntersectionObserver(function(entries){entries.forEach(function(e){if(e.isIntersecting){const d=parseInt(e.target.style.getPropertyValue('--reveal-delay')||'0',10);setTimeout(function(){e.target.classList.add('is-visible');},d);o.unobserve(e.target);}});},{threshold:0.1,rootMargin:'0px 0px -40px 0px'});document.querySelectorAll('.novasaas-reveal').forEach(function(el){o.observe(el);});}else{document.querySelectorAll('.novasaas-reveal').forEach(function(el){el.classList.add('is-visible');});}
}() );
</script>

<?php get_footer(); ?>
