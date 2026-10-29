<?php
/**
 * Template Name: Home — NovaSaaS
 * Template Post Type: page
 *
 * @package NovaSaaS
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

get_header();

// Customizer options used across all sections.
$hero_subtitle  = novasaas_get_option( 'hero_subtitle', __( 'The all-in-one project management platform that helps modern teams plan, track, and deliver work — faster than ever before.', 'novasaas' ) );
$hero_cta_url   = novasaas_get_option( 'cta_url', '#pricing' );
$hero_demo_url  = novasaas_get_option( 'demo_url', '#' );
$hero_badge_txt = novasaas_get_option( 'hero_badge', __( 'New: AI-powered workflows', 'novasaas' ) );

$avatars = array(
	array( 'initials' => 'SC', 'bg' => '6366F1' ),
	array( 'initials' => 'MD', 'bg' => 'EC4899' ),
	array( 'initials' => 'LP', 'bg' => '06B6D4' ),
	array( 'initials' => 'TW', 'bg' => '10B981' ),
	array( 'initials' => 'AK', 'bg' => 'F59E0B' ),
);
?>

<?php /* ═══ ALL TEMPLATE CSS ═══════════════════════════════════════════════ */ ?>
<style>
/* ─── HERO ───────────────────────────────────────────────────────────────── */
.novasaas-hero {
	position: relative;
	min-height: 100dvh;
	display: flex;
	align-items: center;
	overflow: hidden;
	background-color: var(--novasaas-bg-dark);
}

/* animated gradient mesh */
.novasaas-hero::before {
	content: '';
	position: absolute;
	inset: 0;
	background:
		radial-gradient(ellipse 80% 60% at 10% 20%, rgba(99,102,241,.18) 0, transparent 60%),
		radial-gradient(ellipse 60% 50% at 80% 80%, rgba(236,72,153,.12) 0, transparent 60%),
		radial-gradient(ellipse 50% 40% at 50% 50%, rgba(6,182,212,.07) 0, transparent 70%);
	animation: novasaas-hero-pulse 8s ease-in-out infinite alternate;
	pointer-events: none;
	z-index: 0;
}

@keyframes novasaas-hero-pulse {
	0%   { opacity:.7; transform: scale(1)   translateY(0); }
	100% { opacity: 1; transform: scale(1.05) translateY(-12px); }
}

/* grid noise overlay */
.novasaas-hero::after {
	content: '';
	position: absolute;
	inset: 0;
	background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='40' height='40'%3E%3Ccircle cx='1' cy='1' r='0.5' fill='%23ffffff' opacity='0.04'/%3E%3C/svg%3E");
	background-size: 40px 40px;
	pointer-events: none;
	z-index: 0;
}

.novasaas-hero__inner {
	position: relative;
	z-index: 1;
	display: grid;
	grid-template-columns: 1fr;
	gap: clamp(3rem, 6vw, 5rem);
	align-items: center;
	padding-block: clamp(5rem, 12vw, 9rem);
}

@media (min-width: 1024px) {
	.novasaas-hero__inner { grid-template-columns: 1fr 1fr; }
}

/* ── Hero Left ── */
.novasaas-hero__content { display: flex; flex-direction: column; gap: var(--novasaas-space-6); }

.novasaas-hero__badge {
	display: inline-flex;
	align-items: center;
	gap: var(--novasaas-space-2);
	padding: .35em 1em .35em .6em;
	border-radius: var(--novasaas-radius-full);
	background: rgba(99,102,241,.12);
	border: 1px solid rgba(99,102,241,.3);
	font-size: var(--novasaas-text-sm);
	font-weight: var(--novasaas-weight-semibold);
	color: var(--novasaas-primary-light);
	width: fit-content;
	cursor: pointer;
	transition: background var(--novasaas-transition-fast), border-color var(--novasaas-transition-fast);
}

.novasaas-hero__badge:hover {
	background: rgba(99,102,241,.2);
	border-color: rgba(99,102,241,.5);
}

.novasaas-hero__badge-dot {
	width: 6px; height: 6px; border-radius: 50%;
	background: var(--novasaas-primary-light);
	animation: novasaas-hero-pulse-dot 1.8s ease-in-out infinite;
}

@keyframes novasaas-hero-pulse-dot {
	0%,100% { opacity:1; transform:scale(1); }
	50%      { opacity:.5; transform:scale(1.4); }
}

.novasaas-hero__title {
	font-size: var(--novasaas-text-7xl);
	font-weight: var(--novasaas-weight-extrabold);
	line-height: 1.06;
	letter-spacing: -.04em;
	color: var(--novasaas-text);
	margin: 0;
}

.novasaas-hero__title .novasaas-gradient-text {
	display: inline;
}

.novasaas-hero__subtitle {
	font-size: var(--novasaas-text-lg);
	color: var(--novasaas-text-muted);
	line-height: var(--novasaas-leading-relaxed);
	max-width: 520px;
	margin: 0;
}

.novasaas-hero__actions {
	display: flex;
	flex-wrap: wrap;
	gap: var(--novasaas-space-3);
	align-items: center;
}

.novasaas-hero__social-proof {
	display: flex;
	align-items: center;
	gap: var(--novasaas-space-3);
	padding-top: var(--novasaas-space-2);
}

.novasaas-hero__avatars {
	display: flex;
	align-items: center;
}

.novasaas-hero__avatars .novasaas-svg-avatar {
	width: 36px;
	height: 36px;
	border-radius: 50%;
	border: 2px solid var(--novasaas-bg-dark);
	margin-left: -10px;
	transition: transform var(--novasaas-transition-fast);
}

.novasaas-hero__avatars .novasaas-svg-avatar:first-child { margin-left: 0; }
.novasaas-hero__avatars:hover .novasaas-svg-avatar:hover  { transform: translateY(-4px) scale(1.1); z-index:1; }

.novasaas-hero__social-text {
	font-size: var(--novasaas-text-sm);
	color: var(--novasaas-text-muted);
	margin: 0;
}

.novasaas-hero__social-text strong {
	color: var(--novasaas-text);
	font-weight: var(--novasaas-weight-semibold);
}

/* ── Hero Right (Mockup) ── */
.novasaas-hero__visual {
	position: relative;
	display: flex;
	align-items: center;
	justify-content: center;
}

.novasaas-hero__mockup-wrap {
	position: relative;
	width: 100%;
	max-width: 580px;
	margin: auto;
}

.novasaas-hero__mockup {
	width: 100%;
	border-radius: var(--novasaas-radius-xl);
	box-shadow: var(--novasaas-shadow-2xl), 0 0 80px rgba(99,102,241,.2);
	animation: novasaas-float 5s ease-in-out infinite;
	border: 1px solid var(--novasaas-border);
}

/* floating stat cards */
.novasaas-hero__float-card {
	position: absolute;
	background: var(--novasaas-glass-bg);
	border: 1px solid var(--novasaas-glass-border);
	border-radius: var(--novasaas-radius-lg);
	backdrop-filter: var(--novasaas-glass-blur);
	-webkit-backdrop-filter: var(--novasaas-glass-blur);
	padding: .75rem 1rem;
	display: flex;
	align-items: center;
	gap: .625rem;
	box-shadow: var(--novasaas-shadow-lg);
	white-space: nowrap;
	z-index: 2;
}

.novasaas-hero__float-card--tl {
	top: 12%;
	left: -8%;
	animation: novasaas-float 4.5s ease-in-out infinite;
}

.novasaas-hero__float-card--br {
	bottom: 12%;
	right: -6%;
	animation: novasaas-float 5.5s ease-in-out 0.8s infinite;
}

.novasaas-hero__float-card--tr {
	top: 38%;
	right: -8%;
	animation: novasaas-float 4s ease-in-out 0.4s infinite;
}

.novasaas-hero__float-icon {
	width: 36px; height: 36px;
	border-radius: var(--novasaas-radius-md);
	display: flex; align-items: center; justify-content: center;
	flex-shrink: 0;
	font-size: 1rem;
}

.novasaas-hero__float-icon--green  { background: rgba(16,185,129,.15); }
.novasaas-hero__float-icon--indigo { background: rgba(99,102,241,.15); }
.novasaas-hero__float-icon--pink   { background: rgba(236,72,153,.15); }

.novasaas-hero__float-label {
	font-size: var(--novasaas-text-xs);
	color: var(--novasaas-text-muted);
	display: block;
	line-height: 1.2;
}

.novasaas-hero__float-value {
	font-size: var(--novasaas-text-base);
	font-weight: var(--novasaas-weight-bold);
	color: var(--novasaas-text);
	display: block;
	line-height: 1.2;
}

/* ── Trusted by ── */
.novasaas-hero__trusted {
	position: relative;
	z-index: 1;
	padding-block: var(--novasaas-space-10);
	border-top: 1px solid var(--novasaas-border-subtle);
}

.novasaas-hero__trusted-inner {
	display: flex;
	flex-wrap: wrap;
	align-items: center;
	gap: var(--novasaas-space-6);
	justify-content: center;
}

.novasaas-hero__trusted-label {
	font-size: var(--novasaas-text-sm);
	color: var(--novasaas-text-faint);
	text-transform: uppercase;
	letter-spacing: .1em;
	font-weight: var(--novasaas-weight-semibold);
	margin: 0;
	white-space: nowrap;
}

.novasaas-hero__trusted-logos {
	display: flex;
	flex-wrap: wrap;
	align-items: center;
	gap: clamp(1.5rem, 4vw, 3.5rem);
}

.novasaas-hero__trusted-name {
	font-size: var(--novasaas-text-base);
	font-weight: var(--novasaas-weight-bold);
	color: var(--novasaas-text-faint);
	letter-spacing: .06em;
	text-transform: uppercase;
	opacity: .5;
	transition: opacity var(--novasaas-transition-fast);
}

.novasaas-hero__trusted-name:hover { opacity: .8; }

/* ─── STATS ───────────────────────────────────────────────────────────────── */
.novasaas-stats { padding-block: 0; }

.novasaas-stats__bar {
	background: var(--novasaas-glass-bg);
	border-top: 1px solid var(--novasaas-border);
	border-bottom: 1px solid var(--novasaas-border);
	backdrop-filter: var(--novasaas-glass-blur);
	-webkit-backdrop-filter: var(--novasaas-glass-blur);
}

.novasaas-stats__grid {
	display: grid;
	grid-template-columns: repeat(2, 1fr);
}

@media (min-width: 768px) {
	.novasaas-stats__grid { grid-template-columns: repeat(4, 1fr); }
}

.novasaas-stats__item {
	display: flex;
	flex-direction: column;
	align-items: center;
	text-align: center;
	padding: clamp(1.75rem, 4vw, 2.5rem) var(--novasaas-space-6);
	position: relative;
}

.novasaas-stats__item + .novasaas-stats__item::before {
	content: '';
	position: absolute;
	left: 0;
	top: 20%;
	height: 60%;
	width: 1px;
	background: var(--novasaas-border-subtle);
}

.novasaas-stats__item:nth-child(1),
.novasaas-stats__item:nth-child(3) {
}

@media (max-width: 767px) {
	.novasaas-stats__item:nth-child(odd)::before { display:none; }
	.novasaas-stats__item:nth-child(3),
	.novasaas-stats__item:nth-child(4) {
		border-top: 1px solid var(--novasaas-border-subtle);
	}
}

.novasaas-stats__number {
	font-family: var(--novasaas-font-heading);
	font-size: var(--novasaas-text-5xl);
	font-weight: var(--novasaas-weight-extrabold);
	letter-spacing: -.03em;
	line-height: 1;
	margin-bottom: var(--novasaas-space-2);
	background: var(--novasaas-gradient-primary);
	-webkit-background-clip: text;
	-webkit-text-fill-color: transparent;
	background-clip: text;
}

.novasaas-stats__label {
	font-size: var(--novasaas-text-sm);
	color: var(--novasaas-text-muted);
	font-weight: var(--novasaas-weight-medium);
	margin: 0;
}

/* ─── FEATURES ────────────────────────────────────────────────────────────── */
.novasaas-features { background: var(--novasaas-bg-section); }

.novasaas-features__grid {
	display: grid;
	grid-template-columns: 1fr;
	gap: var(--novasaas-space-6);
}

@media (min-width: 640px) {
	.novasaas-features__grid { grid-template-columns: repeat(2, 1fr); }
}

@media (min-width: 1024px) {
	.novasaas-features__grid { grid-template-columns: repeat(3, 1fr); }
}

.novasaas-feature-card {
	padding: var(--novasaas-space-8);
	display: flex;
	flex-direction: column;
	gap: var(--novasaas-space-4);
}

.novasaas-feature-card__icon-wrap {
	width: 52px;
	height: 52px;
	border-radius: var(--novasaas-radius-lg);
	display: flex;
	align-items: center;
	justify-content: center;
	font-size: 1.5rem;
	flex-shrink: 0;
	position: relative;
	overflow: hidden;
}

.novasaas-feature-card__icon-wrap::before {
	content: '';
	position: absolute;
	inset: 0;
	background: var(--novasaas-gradient-primary);
	opacity: .15;
}

.novasaas-feature-card__title {
	font-size: var(--novasaas-text-xl);
	font-weight: var(--novasaas-weight-bold);
	color: var(--novasaas-text);
	margin: 0;
}

.novasaas-feature-card__desc {
	font-size: var(--novasaas-text-base);
	color: var(--novasaas-text-muted);
	line-height: var(--novasaas-leading-relaxed);
	margin: 0;
	flex: 1;
}

.novasaas-feature-card__link {
	display: inline-flex;
	align-items: center;
	gap: var(--novasaas-space-1);
	font-size: var(--novasaas-text-sm);
	font-weight: var(--novasaas-weight-semibold);
	color: var(--novasaas-primary-light);
	transition: gap var(--novasaas-transition-fast), color var(--novasaas-transition-fast);
	margin-top: auto;
}

.novasaas-feature-card__link:hover {
	gap: var(--novasaas-space-2);
	color: var(--novasaas-primary);
}

/* ─── HOW IT WORKS ────────────────────────────────────────────────────────── */
.novasaas-how { background: var(--novasaas-bg-dark); }

.novasaas-how__steps {
	display: flex;
	flex-direction: column;
	gap: 0;
	position: relative;
}

@media (min-width: 1024px) {
	.novasaas-how__steps {
		flex-direction: row;
		align-items: flex-start;
	}
}

/* connecting line */
.novasaas-how__steps::before {
	content: '';
	position: absolute;
	background: var(--novasaas-gradient-primary);
	opacity: .3;
}

@media (max-width: 1023px) {
	.novasaas-how__steps::before {
		left: 28px;
		top: 0;
		bottom: 0;
		width: 2px;
	}
}

@media (min-width: 1024px) {
	.novasaas-how__steps::before {
		top: 28px;
		left: 0;
		right: 0;
		height: 2px;
	}
}

.novasaas-how__step {
	flex: 1;
	display: flex;
	flex-direction: column;
	gap: var(--novasaas-space-5);
	padding: clamp(2rem, 5vw, 3rem);
	position: relative;
	z-index: 1;
}

@media (max-width: 1023px) {
	.novasaas-how__step { padding-left: 4.5rem; }
}

.novasaas-how__step-header {
	display: flex;
	align-items: center;
	gap: var(--novasaas-space-4);
}

.novasaas-how__step-num {
	width: 56px;
	height: 56px;
	border-radius: 50%;
	background: var(--novasaas-gradient-primary);
	display: flex;
	align-items: center;
	justify-content: center;
	font-family: var(--novasaas-font-heading);
	font-size: var(--novasaas-text-xl);
	font-weight: var(--novasaas-weight-extrabold);
	color: #fff;
	flex-shrink: 0;
	box-shadow: 0 0 0 6px rgba(99,102,241,.12), var(--novasaas-shadow-glow);
}

@media (max-width: 1023px) {
	.novasaas-how__step-num {
		position: absolute;
		left: 0;
		top: clamp(2rem, 5vw, 3rem);
	}
}

.novasaas-how__step-icon {
	width: 48px;
	height: 48px;
	border-radius: var(--novasaas-radius-lg);
	background: rgba(99,102,241,.1);
	border: 1px solid var(--novasaas-border);
	display: flex;
	align-items: center;
	justify-content: center;
	color: var(--novasaas-primary-light);
}

@media (max-width: 1023px) {
	.novasaas-how__step-icon { display:none; }
}

.novasaas-how__step-title {
	font-size: var(--novasaas-text-2xl);
	font-weight: var(--novasaas-weight-bold);
	color: var(--novasaas-text);
	margin: 0;
}

.novasaas-how__step-desc {
	font-size: var(--novasaas-text-base);
	color: var(--novasaas-text-muted);
	line-height: var(--novasaas-leading-relaxed);
	margin: 0;
}

/* ─── PRICING ─────────────────────────────────────────────────────────────── */
.novasaas-pricing { background: var(--novasaas-bg-section); }

.novasaas-pricing__toggle {
	display: flex;
	align-items: center;
	justify-content: center;
	gap: var(--novasaas-space-4);
	margin-bottom: clamp(2.5rem, 5vw, 4rem);
}

.novasaas-pricing__toggle-label {
	font-size: var(--novasaas-text-base);
	font-weight: var(--novasaas-weight-medium);
	color: var(--novasaas-text-muted);
	cursor: pointer;
	transition: color var(--novasaas-transition-fast);
}

.novasaas-pricing__toggle-label.is-active { color: var(--novasaas-text); }

.novasaas-pricing__switch {
	position: relative;
	width: 52px;
	height: 28px;
	background: rgba(99,102,241,.2);
	border: 1px solid var(--novasaas-border);
	border-radius: 14px;
	cursor: pointer;
	transition: background var(--novasaas-transition-base);
}

.novasaas-pricing__switch.is-yearly {
	background: var(--novasaas-primary);
	border-color: var(--novasaas-primary);
}

.novasaas-pricing__switch-thumb {
	position: absolute;
	top: 3px;
	left: 3px;
	width: 20px;
	height: 20px;
	border-radius: 50%;
	background: #fff;
	transition: transform var(--novasaas-transition-spring);
	box-shadow: 0 1px 4px rgba(0,0,0,.4);
}

.novasaas-pricing__switch.is-yearly .novasaas-pricing__switch-thumb {
	transform: translateX(24px);
}

.novasaas-pricing__save-badge {
	display: inline-flex;
	align-items: center;
	padding: .2em .6em;
	background: rgba(16,185,129,.15);
	border: 1px solid rgba(16,185,129,.3);
	border-radius: var(--novasaas-radius-full);
	font-size: var(--novasaas-text-xs);
	font-weight: var(--novasaas-weight-semibold);
	color: var(--novasaas-success);
	transition: opacity var(--novasaas-transition-base);
}

.novasaas-pricing__save-badge[hidden] {
	display:none;
}

.novasaas-pricing__grid {
	display: grid;
	grid-template-columns: 1fr;
	gap: var(--novasaas-space-6);
	align-items: stretch;
}

@media (min-width: 768px)  { .novasaas-pricing__grid { grid-template-columns: repeat(2, 1fr); } }
@media (min-width: 1024px) { .novasaas-pricing__grid { grid-template-columns: repeat(3, 1fr); } }

.novasaas-plan-card {
	display: flex;
	flex-direction: column;
	gap: 0;
	padding: 0;
	overflow: hidden;
}

.novasaas-plan-card--featured {
	border-color: var(--novasaas-primary);
	box-shadow: 0 0 0 1px var(--novasaas-primary), var(--novasaas-shadow-xl), var(--novasaas-shadow-glow);
	position: relative;
}

.novasaas-plan-card--featured::before {
	content: '';
	position: absolute;
	inset: 0;
	background: linear-gradient(135deg, rgba(99,102,241,.06) 0, transparent 60%);
	pointer-events: none;
	border-radius: inherit;
}

.novasaas-plan-card__header {
	padding: var(--novasaas-space-8);
	border-bottom: 1px solid var(--novasaas-border-subtle);
}

.novasaas-plan-card__badge-row {
	display: flex;
	align-items: center;
	justify-content: space-between;
	margin-bottom: var(--novasaas-space-4);
	min-height: 28px;
}

.novasaas-plan-card__popular {
	display: inline-flex;
	align-items: center;
	gap: var(--novasaas-space-1);
	padding: .25em .75em;
	background: linear-gradient(135deg, #6366F1, #EC4899);
	border-radius: var(--novasaas-radius-full);
	font-size: var(--novasaas-text-xs);
	font-weight: var(--novasaas-weight-bold);
	color: #fff;
	text-transform: uppercase;
	letter-spacing: .05em;
}

.novasaas-plan-card__name {
	font-size: var(--novasaas-text-xl);
	font-weight: var(--novasaas-weight-bold);
	color: var(--novasaas-text);
	margin: 0 0 var(--novasaas-space-2);
}

.novasaas-plan-card__tagline {
	font-size: var(--novasaas-text-sm);
	color: var(--novasaas-text-muted);
	margin: 0 0 var(--novasaas-space-6);
}

.novasaas-plan-card__price-row {
	display: flex;
	align-items: flex-end;
	gap: var(--novasaas-space-1);
}

.novasaas-plan-card__currency {
	font-size: var(--novasaas-text-2xl);
	font-weight: var(--novasaas-weight-bold);
	color: var(--novasaas-text-muted);
	padding-bottom: .35em;
}

.novasaas-price__amount {
	font-family: var(--novasaas-font-heading);
	font-size: var(--novasaas-text-7xl);
	font-weight: var(--novasaas-weight-extrabold);
	letter-spacing: -.04em;
	line-height: 1;
	color: var(--novasaas-text);
}

.novasaas-plan-card__period {
	font-size: var(--novasaas-text-sm);
	color: var(--novasaas-text-muted);
	padding-bottom: .5em;
}

.novasaas-plan-card__billed {
	display: block;
	font-size: var(--novasaas-text-xs);
	color: var(--novasaas-text-faint);
	margin-top: var(--novasaas-space-2);
	min-height: 1.2em;
}

.novasaas-plan-card__body {
	padding: var(--novasaas-space-8);
	flex: 1;
	display: flex;
	flex-direction: column;
	gap: var(--novasaas-space-6);
}

.novasaas-plan-card__features {
	list-style: none;
	display: flex;
	flex-direction: column;
	gap: var(--novasaas-space-3);
	flex: 1;
}

.novasaas-plan-card__feature {
	display: flex;
	align-items: flex-start;
	gap: var(--novasaas-space-3);
	font-size: var(--novasaas-text-sm);
	color: var(--novasaas-text-muted);
}

.novasaas-plan-card__feature-icon {
	width: 18px;
	height: 18px;
	border-radius: 50%;
	display: flex;
	align-items: center;
	justify-content: center;
	flex-shrink: 0;
	margin-top: 1px;
	font-size: .65rem;
	font-weight: 700;
}

.novasaas-plan-card__feature-icon--yes {
	background: var(--novasaas-success-bg);
	color: var(--novasaas-success);
}

.novasaas-plan-card__feature-icon--no {
	background: rgba(255,255,255,.04);
	color: var(--novasaas-text-faint);
}

.novasaas-pricing__note {
	text-align: center;
	margin-top: var(--novasaas-space-8);
	font-size: var(--novasaas-text-sm);
	color: var(--novasaas-text-faint);
}

/* ─── TESTIMONIALS ────────────────────────────────────────────────────────── */
.novasaas-testimonials { background: var(--novasaas-bg-dark); }

.novasaas-testimonials__grid {
	display: grid;
	grid-template-columns: 1fr;
	gap: var(--novasaas-space-6);
}

@media (min-width: 768px)  { .novasaas-testimonials__grid { grid-template-columns: repeat(2, 1fr); } }
@media (min-width: 1024px) { .novasaas-testimonials__grid { grid-template-columns: repeat(3, 1fr); } }

.novasaas-testimonial-card {
	display: flex;
	flex-direction: column;
	gap: var(--novasaas-space-5);
	padding: var(--novasaas-space-8);
}

.novasaas-testimonial-card__quote-icon {
	color: var(--novasaas-primary);
	opacity: .5;
}

.novasaas-testimonial-card__text {
	font-size: var(--novasaas-text-base);
	color: var(--novasaas-text);
	line-height: var(--novasaas-leading-relaxed);
	margin: 0;
	flex: 1;
	font-style: italic;
}

.novasaas-testimonial-card__author {
	display: flex;
	align-items: center;
	gap: var(--novasaas-space-3);
	padding-top: var(--novasaas-space-4);
	border-top: 1px solid var(--novasaas-border-subtle);
}

.novasaas-testimonial-card__author .novasaas-svg-avatar {
	width: 44px;
	height: 44px;
	border-radius: 50%;
	flex-shrink: 0;
}

.novasaas-testimonial-card__name {
	font-size: var(--novasaas-text-sm);
	font-weight: var(--novasaas-weight-semibold);
	color: var(--novasaas-text);
}

.novasaas-testimonial-card__role {
	font-size: var(--novasaas-text-xs);
	color: var(--novasaas-text-muted);
}

.novasaas-testimonial-card__stars {
	margin-left: auto;
	color: #F59E0B;
	font-size: .875rem;
	line-height: 1;
}

/* ─── FAQ ─────────────────────────────────────────────────────────────────── */
.novasaas-faq { background: var(--novasaas-bg-section); }

.novasaas-faq__list {
	max-width: 800px;
	margin-inline: auto;
	display: flex;
	flex-direction: column;
	gap: var(--novasaas-space-3);
}

.novasaas-faq__item {
	background: var(--novasaas-glass-bg);
	border: 1px solid var(--novasaas-border);
	border-radius: var(--novasaas-radius-lg);
	overflow: hidden;
	transition: border-color var(--novasaas-transition-base);
}

.novasaas-faq__item.is-open {
	border-color: var(--novasaas-border-hover);
}

.novasaas-faq__question {
	display: flex;
	align-items: center;
	justify-content: space-between;
	gap: var(--novasaas-space-4);
	width: 100%;
	padding: var(--novasaas-space-5) var(--novasaas-space-6);
	font-size: var(--novasaas-text-base);
	font-weight: var(--novasaas-weight-semibold);
	color: var(--novasaas-text);
	text-align: left;
	cursor: pointer;
	background: none;
	border: none;
	transition: color var(--novasaas-transition-fast);
}

.novasaas-faq__question:hover { color: var(--novasaas-primary-light); }

.novasaas-faq__icon {
	width: 28px;
	height: 28px;
	border-radius: 50%;
	background: rgba(99,102,241,.1);
	border: 1px solid var(--novasaas-border);
	display: flex;
	align-items: center;
	justify-content: center;
	flex-shrink: 0;
	transition: background var(--novasaas-transition-fast),
	            transform var(--novasaas-transition-base);
	color: var(--novasaas-primary-light);
}

.novasaas-faq__item.is-open .novasaas-faq__icon {
	background: rgba(99,102,241,.2);
	transform: rotate(45deg);
}

.novasaas-faq__answer {
	max-height: 0;
	overflow: hidden;
	transition: max-height var(--novasaas-transition-slow);
}

.novasaas-faq__answer-inner {
	padding: 0 var(--novasaas-space-6) var(--novasaas-space-6);
	font-size: var(--novasaas-text-base);
	color: var(--novasaas-text-muted);
	line-height: var(--novasaas-leading-relaxed);
}

/* ─── CTA BANNER ──────────────────────────────────────────────────────────── */
.novasaas-cta-banner {
	position: relative;
	overflow: hidden;
	background: var(--novasaas-gradient-primary);
	padding-block: clamp(4rem, 10vw, 7rem);
}

.novasaas-cta-banner::before {
	content: '';
	position: absolute;
	inset: 0;
	background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='40' height='40'%3E%3Ccircle cx='1' cy='1' r='0.6' fill='%23ffffff' opacity='0.08'/%3E%3C/svg%3E");
	background-size: 40px 40px;
}

.novasaas-cta-banner::after {
	content: '';
	position: absolute;
	width: 600px;
	height: 600px;
	border-radius: 50%;
	background: rgba(255,255,255,.08);
	top: -200px;
	right: -200px;
	pointer-events: none;
}

.novasaas-cta-banner__inner {
	position: relative;
	z-index: 1;
	text-align: center;
	display: flex;
	flex-direction: column;
	align-items: center;
	gap: var(--novasaas-space-6);
}

.novasaas-cta-banner__title {
	font-size: var(--novasaas-text-6xl);
	font-weight: var(--novasaas-weight-extrabold);
	color: #fff;
	letter-spacing: -.03em;
	line-height: 1.08;
	margin: 0;
}

.novasaas-cta-banner__subtitle {
	font-size: var(--novasaas-text-lg);
	color: rgba(255,255,255,.8);
	margin: 0;
}

.novasaas-cta-banner__form {
	display: flex;
	flex-wrap: wrap;
	gap: var(--novasaas-space-3);
	justify-content: center;
	width: 100%;
	max-width: 520px;
}

.novasaas-cta-banner__email {
	flex: 1 1 260px;
	padding: .8em 1.25em;
	border-radius: var(--novasaas-radius-full);
	border: 2px solid rgba(255,255,255,.25);
	background: rgba(255,255,255,.12);
	color: #fff;
	font-size: var(--novasaas-text-base);
	backdrop-filter: blur(8px);
	transition: border-color var(--novasaas-transition-fast),
	            background var(--novasaas-transition-fast);
}

.novasaas-cta-banner__email::placeholder { color: rgba(255,255,255,.6); }

.novasaas-cta-banner__email:focus {
	outline: none;
	border-color: rgba(255,255,255,.6);
	background: rgba(255,255,255,.18);
}

.novasaas-cta-banner__submit {
	padding: .8em 2em;
	border-radius: var(--novasaas-radius-full);
	background: #fff;
	color: var(--novasaas-primary-dark);
	font-size: var(--novasaas-text-base);
	font-weight: var(--novasaas-weight-bold);
	border: none;
	cursor: pointer;
	white-space: nowrap;
	transition: transform var(--novasaas-transition-fast),
	            box-shadow var(--novasaas-transition-fast);
	box-shadow: 0 4px 20px rgba(0,0,0,.2);
}

.novasaas-cta-banner__submit:hover {
	transform: translateY(-2px);
	box-shadow: 0 8px 28px rgba(0,0,0,.3);
}

.novasaas-cta-banner__trust {
	display: flex;
	flex-wrap: wrap;
	justify-content: center;
	gap: clamp(.75rem, 3vw, 2rem);
}

.novasaas-cta-banner__trust-item {
	display: flex;
	align-items: center;
	gap: var(--novasaas-space-2);
	font-size: var(--novasaas-text-sm);
	color: rgba(255,255,255,.85);
	font-weight: var(--novasaas-weight-medium);
}

.novasaas-cta-banner__trust-check {
	width: 20px;
	height: 20px;
	border-radius: 50%;
	background: rgba(255,255,255,.2);
	display: flex;
	align-items: center;
	justify-content: center;
	font-size: .7rem;
	color: #fff;
	flex-shrink: 0;
}
</style>

<?php /* ═══ SECTION 1: HERO ══════════════════════════════════════════════════ */ ?>
<section class="novasaas-hero" aria-label="<?php esc_attr_e( 'Hero', 'novasaas' ); ?>">
	<div class="novasaas-container">
		<div class="novasaas-hero__inner">

			<!-- ── Left: Content ──────────────────────────────────────── -->
			<div class="novasaas-hero__content novasaas-reveal">

				<a href="<?php echo esc_url( novasaas_get_option( 'badge_url', '#' ) ); ?>"
				   class="novasaas-hero__badge"
				   tabindex="0">
					<span class="novasaas-hero__badge-dot" aria-hidden="true"></span>
					&#128640; <?php echo esc_html( $hero_badge_txt ); ?>
					<span aria-hidden="true">&rarr;</span>
				</a>

				<h1 class="novasaas-hero__title">
					<?php esc_html_e( 'Scale Your Business with', 'novasaas' ); ?>
					<span class="novasaas-gradient-text"><?php esc_html_e( 'StreamFlow', 'novasaas' ); ?></span>
				</h1>

				<p class="novasaas-hero__subtitle">
					<?php echo esc_html( $hero_subtitle ); ?>
				</p>

				<div class="novasaas-hero__actions">
					<a href="<?php echo esc_url( $hero_cta_url ); ?>"
					   class="novasaas-btn novasaas-btn--lg">
						<?php esc_html_e( "Start Free Trial — It's Free", 'novasaas' ); ?>
					</a>
					<a href="<?php echo esc_url( $hero_demo_url ); ?>"
					   class="novasaas-btn-outline novasaas-btn-outline--lg">
						&#9654; <?php esc_html_e( 'Watch Demo', 'novasaas' ); ?>
					</a>
				</div>

				<div class="novasaas-hero__social-proof">
					<div class="novasaas-hero__avatars" aria-hidden="true">
						<?php foreach ( $avatars as $a ) : ?>
							<?php echo novasaas_get_svg_avatar( $a['initials'], $a['bg'] ); ?>
						<?php endforeach; ?>
					</div>
					<p class="novasaas-hero__social-text">
						<strong><?php esc_html_e( 'Join 10,000+ teams', 'novasaas' ); ?></strong>
						<?php esc_html_e( 'already using StreamFlow', 'novasaas' ); ?>
					</p>
				</div>

			</div><!-- /.novasaas-hero__content -->

			<!-- ── Right: Visual Mockup ───────────────────────────────── -->
			<div class="novasaas-hero__visual novasaas-reveal novasaas-delay-2">

				<div class="novasaas-hero__mockup-wrap">

					<!-- Floating card: Active Users -->
					<div class="novasaas-hero__float-card novasaas-hero__float-card--tl">
						<div class="novasaas-hero__float-icon novasaas-hero__float-icon--green" aria-hidden="true">&#128200;</div>
						<div>
							<span class="novasaas-hero__float-label"><?php esc_html_e( 'Active Users', 'novasaas' ); ?></span>
							<span class="novasaas-hero__float-value">10,234</span>
						</div>
					</div>

					<!-- Floating card: Tasks Done -->
					<div class="novasaas-hero__float-card novasaas-hero__float-card--tr">
						<div class="novasaas-hero__float-icon novasaas-hero__float-icon--indigo" aria-hidden="true">&#9989;</div>
						<div>
							<span class="novasaas-hero__float-label"><?php esc_html_e( 'Tasks Done', 'novasaas' ); ?></span>
							<span class="novasaas-hero__float-value">94%</span>
						</div>
					</div>

					<!-- Floating card: Uptime -->
					<div class="novasaas-hero__float-card novasaas-hero__float-card--br">
						<div class="novasaas-hero__float-icon novasaas-hero__float-icon--pink" aria-hidden="true">&#128736;</div>
						<div>
							<span class="novasaas-hero__float-label"><?php esc_html_e( 'Uptime SLA', 'novasaas' ); ?></span>
							<span class="novasaas-hero__float-value">99.9%</span>
						</div>
					</div>

					<!-- Dashboard SVG Mockup -->
					<svg class="novasaas-hero__mockup"
						 viewBox="0 0 580 400"
						 xmlns="http://www.w3.org/2000/svg"
						 role="img"
						 aria-label="<?php esc_attr_e( 'StreamFlow dashboard preview', 'novasaas' ); ?>">
						<defs>
							<linearGradient id="sf-chart-area" x1="0" y1="0" x2="0" y2="1">
								<stop offset="0%" stop-color="#6366F1" stop-opacity=".35"/>
								<stop offset="100%" stop-color="#6366F1" stop-opacity="0"/>
							</linearGradient>
							<linearGradient id="sf-chart-area2" x1="0" y1="0" x2="0" y2="1">
								<stop offset="0%" stop-color="#06B6D4" stop-opacity=".2"/>
								<stop offset="100%" stop-color="#06B6D4" stop-opacity="0"/>
							</linearGradient>
							<linearGradient id="sf-header-grad" x1="0" y1="0" x2="1" y2="0">
								<stop offset="0%" stop-color="#0F0A1E"/>
								<stop offset="100%" stop-color="#120E28"/>
							</linearGradient>
							<clipPath id="sf-window-clip">
								<rect width="580" height="400" rx="16"/>
							</clipPath>
						</defs>

						<!-- Window frame -->
						<rect width="580" height="400" rx="16" fill="#0F0A1E" clip-path="url(#sf-window-clip)"/>

						<!-- Title bar -->
						<rect width="580" height="38" fill="url(#sf-header-grad)" clip-path="url(#sf-window-clip)"/>
						<!-- Traffic lights -->
						<circle cx="18" cy="19" r="5" fill="#EF4444" opacity=".85"/>
						<circle cx="34" cy="19" r="5" fill="#F59E0B" opacity=".85"/>
						<circle cx="50" cy="19" r="5" fill="#10B981" opacity=".85"/>
						<!-- Window title -->
						<text x="290" y="24" fill="#64748B" font-size="9" text-anchor="middle" font-family="Inter,system-ui,sans-serif" letter-spacing="1.5">STREAMFLOW — DASHBOARD</text>

						<!-- Sidebar -->
						<rect x="0" y="38" width="148" height="362" fill="#120E28" clip-path="url(#sf-window-clip)"/>

						<!-- Sidebar logo -->
						<rect x="14" y="52" width="32" height="32" rx="8" fill="#6366F1"/>
						<text x="30" y="72" fill="#fff" font-size="12" font-weight="700" text-anchor="middle" font-family="Inter,system-ui,sans-serif">SF</text>
						<text x="56" y="66" fill="#F8FAFC" font-size="11" font-weight="600" font-family="Inter,system-ui,sans-serif">StreamFlow</text>
						<text x="56" y="79" fill="#64748B" font-size="9" font-family="Inter,system-ui,sans-serif">v2.1.0</text>

						<!-- Sidebar nav items -->
						<rect x="10" y="104" width="128" height="28" rx="6" fill="#6366F1" opacity=".18"/>
						<rect x="18" y="113" width="9" height="9" rx="2" fill="#6366F1"/>
						<text x="34" y="122" fill="#F8FAFC" font-size="10" font-family="Inter,system-ui,sans-serif">Dashboard</text>

						<rect x="18" y="143" width="9" height="9" rx="2" fill="#64748B" opacity=".6"/>
						<text x="34" y="152" fill="#94A3B8" font-size="10" font-family="Inter,system-ui,sans-serif">Projects</text>

						<rect x="18" y="165" width="9" height="9" rx="2" fill="#64748B" opacity=".6"/>
						<text x="34" y="174" fill="#94A3B8" font-size="10" font-family="Inter,system-ui,sans-serif">Team</text>

						<rect x="18" y="187" width="9" height="9" rx="2" fill="#64748B" opacity=".6"/>
						<text x="34" y="196" fill="#94A3B8" font-size="10" font-family="Inter,system-ui,sans-serif">Analytics</text>

						<rect x="18" y="209" width="9" height="9" rx="2" fill="#64748B" opacity=".6"/>
						<text x="34" y="218" fill="#94A3B8" font-size="10" font-family="Inter,system-ui,sans-serif">Workflows</text>

						<rect x="18" y="231" width="9" height="9" rx="2" fill="#64748B" opacity=".6"/>
						<text x="34" y="240" fill="#94A3B8" font-size="10" font-family="Inter,system-ui,sans-serif">Settings</text>

						<!-- Sidebar user avatar -->
						<circle cx="30" cy="370" r="16" fill="#1A1530" stroke="#6366F1" stroke-width="1.5" opacity=".5"/>
						<text x="30" y="374" fill="#F8FAFC" font-size="9" text-anchor="middle" font-family="Inter,system-ui,sans-serif">SC</text>
						<text x="54" y="367" fill="#F8FAFC" font-size="9" font-family="Inter,system-ui,sans-serif">Sarah Chen</text>
						<text x="54" y="378" fill="#64748B" font-size="8" font-family="Inter,system-ui,sans-serif">CEO</text>

						<!-- Main content area -->
						<!-- Page heading -->
						<text x="164" y="60" fill="#F8FAFC" font-size="13" font-weight="700" font-family="Inter,system-ui,sans-serif">Dashboard Overview</text>
						<text x="164" y="73" fill="#64748B" font-size="8.5" font-family="Inter,system-ui,sans-serif">Last 30 days &bull; Updated just now</text>

						<!-- Avatar top right -->
						<circle cx="548" cy="57" r="14" fill="#EC4899" opacity=".8"/>
						<text x="548" y="62" fill="#fff" font-size="9" font-weight="700" text-anchor="middle" font-family="Inter,system-ui,sans-serif">SC</text>

						<!-- Notification bell -->
						<rect x="518" y="46" width="24" height="24" rx="6" fill="#1A1530" stroke="#2D2545" stroke-width="1"/>
						<text x="530" y="62" fill="#94A3B8" font-size="12" text-anchor="middle">&#128276;</text>
						<circle cx="540" cy="48" r="4" fill="#EC4899"/>

						<!-- KPI CARDS -->
						<!-- Card 1 -->
						<rect x="160" y="86" width="116" height="76" rx="8" fill="#1A1530" stroke="#6366F1" stroke-width=".5" stroke-opacity=".4"/>
						<text x="170" y="103" fill="#94A3B8" font-size="8.5" font-family="Inter,system-ui,sans-serif">Total Users</text>
						<text x="170" y="126" fill="#F8FAFC" font-size="18" font-weight="700" font-family="Inter,system-ui,sans-serif">10.2K</text>
						<rect x="170" y="140" width="36" height="14" rx="7" fill="#10B981" fill-opacity=".18"/>
						<text x="175" y="150" fill="#10B981" font-size="8" font-family="Inter,system-ui,sans-serif">&#8593; 12.4%</text>

						<!-- Card 2 -->
						<rect x="288" y="86" width="116" height="76" rx="8" fill="#1A1530" stroke="#EC4899" stroke-width=".5" stroke-opacity=".4"/>
						<text x="298" y="103" fill="#94A3B8" font-size="8.5" font-family="Inter,system-ui,sans-serif">Revenue</text>
						<text x="298" y="126" fill="#F8FAFC" font-size="18" font-weight="700" font-family="Inter,system-ui,sans-serif">$42.8K</text>
						<rect x="298" y="140" width="40" height="14" rx="7" fill="#10B981" fill-opacity=".18"/>
						<text x="303" y="150" fill="#10B981" font-size="8" font-family="Inter,system-ui,sans-serif">&#8593; 23.5%</text>

						<!-- Card 3 -->
						<rect x="416" y="86" width="116" height="76" rx="8" fill="#1A1530" stroke="#06B6D4" stroke-width=".5" stroke-opacity=".4"/>
						<text x="426" y="103" fill="#94A3B8" font-size="8.5" font-family="Inter,system-ui,sans-serif">Active Tasks</text>
						<text x="426" y="126" fill="#F8FAFC" font-size="18" font-weight="700" font-family="Inter,system-ui,sans-serif">1,847</text>
						<rect x="426" y="140" width="36" height="14" rx="7" fill="#10B981" fill-opacity=".18"/>
						<text x="431" y="150" fill="#10B981" font-size="8" font-family="Inter,system-ui,sans-serif">&#8593; 8.1%</text>

						<!-- CHART -->
						<rect x="160" y="174" width="284" height="130" rx="8" fill="#1A1530"/>
						<text x="172" y="191" fill="#F8FAFC" font-size="10" font-weight="600" font-family="Inter,system-ui,sans-serif">Growth Trend</text>
						<text x="172" y="201" fill="#64748B" font-size="7.5" font-family="Inter,system-ui,sans-serif">Users over time</text>

						<!-- Grid lines -->
						<line x1="172" y1="218" x2="432" y2="218" stroke="#F8FAFC" stroke-width=".3" stroke-opacity=".08"/>
						<line x1="172" y1="235" x2="432" y2="235" stroke="#F8FAFC" stroke-width=".3" stroke-opacity=".08"/>
						<line x1="172" y1="252" x2="432" y2="252" stroke="#F8FAFC" stroke-width=".3" stroke-opacity=".08"/>
						<line x1="172" y1="270" x2="432" y2="270" stroke="#F8FAFC" stroke-width=".3" stroke-opacity=".08"/>
						<line x1="172" y1="287" x2="432" y2="287" stroke="#F8FAFC" stroke-width=".3" stroke-opacity=".08"/>

						<!-- Area fill (indigo) -->
						<path d="M172,285 C195,282 210,278 230,270 C250,262 265,255 285,245 C305,235 320,228 340,222 C360,216 380,212 400,210 C415,208 425,209 432,208 L432,295 L172,295 Z"
							  fill="url(#sf-chart-area)"/>
						<!-- Area fill (cyan secondary) -->
						<path d="M172,290 C200,287 215,284 240,278 C260,272 278,267 298,260 C318,253 335,248 355,244 C375,240 398,238 432,236 L432,295 L172,295 Z"
							  fill="url(#sf-chart-area2)"/>

						<!-- Line (indigo) -->
						<polyline
							points="172,285 195,278 220,270 245,260 270,250 295,242 320,234 345,224 370,216 395,212 420,210 432,208"
							fill="none" stroke="#6366F1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
						<!-- Line (cyan) -->
						<polyline
							points="172,290 200,286 225,280 250,273 275,266 300,259 325,253 350,248 375,244 400,240 425,237 432,236"
							fill="none" stroke="#06B6D4" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" stroke-dasharray="3,2"/>

						<!-- Chart dots -->
						<circle cx="432" cy="208" r="4" fill="#6366F1" stroke="#0F0A1E" stroke-width="2"/>
						<circle cx="432" cy="236" r="3" fill="#06B6D4" stroke="#0F0A1E" stroke-width="2"/>

						<!-- Legend -->
						<rect x="320" y="186" width="8" height="8" rx="2" fill="#6366F1"/>
						<text x="332" y="194" fill="#94A3B8" font-size="7.5" font-family="Inter,system-ui,sans-serif">Users</text>
						<rect x="360" y="186" width="8" height="8" rx="2" fill="#06B6D4"/>
						<text x="372" y="194" fill="#94A3B8" font-size="7.5" font-family="Inter,system-ui,sans-serif">Sessions</text>

						<!-- X-axis labels -->
						<text x="172" y="305" fill="#64748B" font-size="7.5" font-family="Inter,system-ui,sans-serif">Jan</text>
						<text x="215" y="305" fill="#64748B" font-size="7.5" font-family="Inter,system-ui,sans-serif">Feb</text>
						<text x="258" y="305" fill="#64748B" font-size="7.5" font-family="Inter,system-ui,sans-serif">Mar</text>
						<text x="302" y="305" fill="#64748B" font-size="7.5" font-family="Inter,system-ui,sans-serif">Apr</text>
						<text x="345" y="305" fill="#64748B" font-size="7.5" font-family="Inter,system-ui,sans-serif">May</text>
						<text x="390" y="305" fill="#64748B" font-size="7.5" font-family="Inter,system-ui,sans-serif">Jun</text>

						<!-- Mini bar chart -->
						<rect x="456" y="174" width="100" height="130" rx="8" fill="#1A1530"/>
						<text x="466" y="191" fill="#F8FAFC" font-size="10" font-weight="600" font-family="Inter,system-ui,sans-serif">By Plan</text>
						<text x="466" y="201" fill="#64748B" font-size="7.5" font-family="Inter,system-ui,sans-serif">This month</text>

						<!-- Bars -->
						<rect x="466" y="265" width="14" height="36" rx="3" fill="#6366F1" opacity=".9"/>
						<rect x="484" y="248" width="14" height="53" rx="3" fill="#EC4899" opacity=".9"/>
						<rect x="502" y="255" width="14" height="46" rx="3" fill="#06B6D4" opacity=".9"/>
						<rect x="520" y="270" width="14" height="31" rx="3" fill="#6366F1" opacity=".5"/>

						<text x="466" y="309" fill="#64748B" font-size="6.5" font-family="Inter,system-ui,sans-serif">Free</text>
						<text x="482" y="309" fill="#64748B" font-size="6.5" font-family="Inter,system-ui,sans-serif">Pro</text>
						<text x="498" y="309" fill="#64748B" font-size="6.5" font-family="Inter,system-ui,sans-serif">Biz</text>
						<text x="516" y="309" fill="#64748B" font-size="6.5" font-family="Inter,system-ui,sans-serif">Ent</text>

						<!-- Activity row -->
						<rect x="160" y="316" width="396" height="68" rx="8" fill="#1A1530"/>
						<text x="172" y="333" fill="#F8FAFC" font-size="10" font-weight="600" font-family="Inter,system-ui,sans-serif">Recent Activity</text>

						<circle cx="178" cy="352" r="5" fill="#10B981"/>
						<text x="190" y="356" fill="#94A3B8" font-size="8.5" font-family="Inter,system-ui,sans-serif">Q4 marketing campaign launched — 2 min ago</text>

						<circle cx="178" cy="372" r="5" fill="#F59E0B"/>
						<text x="190" y="376" fill="#94A3B8" font-size="8.5" font-family="Inter,system-ui,sans-serif">Sprint review scheduled for Friday — 8 min ago</text>

						<!-- Scan line shimmer -->
						<rect width="580" height="400" fill="rgba(255,255,255,0.015)" clip-path="url(#sf-window-clip)"/>
					</svg>

				</div><!-- /.novasaas-hero__mockup-wrap -->
			</div><!-- /.novasaas-hero__visual -->

		</div><!-- /.novasaas-hero__inner -->

		<!-- ── Trusted by ──────────────────────────────────────────────── -->
		<div class="novasaas-hero__trusted">
			<div class="novasaas-hero__trusted-inner">
				<p class="novasaas-hero__trusted-label"><?php esc_html_e( 'Trusted by teams at', 'novasaas' ); ?></p>
				<div class="novasaas-hero__trusted-logos">
					<span class="novasaas-hero__trusted-name">TechCorp</span>
					<span class="novasaas-hero__trusted-name">GrowthCo</span>
					<span class="novasaas-hero__trusted-name">CloudBase</span>
					<span class="novasaas-hero__trusted-name">Startup.io</span>
					<span class="novasaas-hero__trusted-name">DevHub</span>
				</div>
			</div>
		</div>

	</div><!-- /.novasaas-container -->
</section>

<?php /* ═══ SECTION 2: STATS BAR ═════════════════════════════════════════════ */ ?>
<section class="novasaas-stats" aria-label="<?php esc_attr_e( 'Key statistics', 'novasaas' ); ?>">
	<div class="novasaas-stats__bar">
		<div class="novasaas-container">
			<div class="novasaas-stats__grid">

				<div class="novasaas-stats__item novasaas-reveal">
					<span class="novasaas-stats__number novasaas-count-up"
						  data-target="10000"
						  data-suffix="+"
						  aria-label="<?php esc_attr_e( '10,000+ Users', 'novasaas' ); ?>">0</span>
					<p class="novasaas-stats__label"><?php esc_html_e( 'Users Worldwide', 'novasaas' ); ?></p>
				</div>

				<div class="novasaas-stats__item novasaas-reveal novasaas-delay-1">
					<span class="novasaas-stats__number novasaas-count-up"
						  data-target="99.9"
						  data-suffix="%"
						  data-decimal="1"
						  aria-label="<?php esc_attr_e( '99.9% Uptime', 'novasaas' ); ?>">0</span>
					<p class="novasaas-stats__label"><?php esc_html_e( 'Guaranteed Uptime', 'novasaas' ); ?></p>
				</div>

				<div class="novasaas-stats__item novasaas-reveal novasaas-delay-2">
					<span class="novasaas-stats__number novasaas-count-up"
						  data-target="150"
						  data-suffix="+"
						  aria-label="<?php esc_attr_e( '150+ Countries', 'novasaas' ); ?>">0</span>
					<p class="novasaas-stats__label"><?php esc_html_e( 'Countries Served', 'novasaas' ); ?></p>
				</div>

				<div class="novasaas-stats__item novasaas-reveal novasaas-delay-3">
					<span class="novasaas-stats__number novasaas-count-up"
						  data-target="4.9"
						  data-suffix="/5"
						  data-decimal="1"
						  aria-label="<?php esc_attr_e( '4.9 out of 5 Rating', 'novasaas' ); ?>">0</span>
					<p class="novasaas-stats__label"><?php esc_html_e( 'Average Rating', 'novasaas' ); ?></p>
				</div>

			</div>
		</div>
	</div>
</section>

<?php /* ═══ SECTION 3: FEATURES ═════════════════════════════════════════════ */ ?>
<section class="novasaas-section novasaas-features"
		 aria-labelledby="novasaas-features-title">
	<div class="novasaas-container">

		<div class="novasaas-section__header novasaas-reveal">
			<span class="novasaas-section__eyebrow"><?php esc_html_e( 'Features', 'novasaas' ); ?></span>
			<h2 id="novasaas-features-title" class="novasaas-section__title">
				<?php esc_html_e( 'Everything you need to scale', 'novasaas' ); ?>
			</h2>
			<p class="novasaas-section__subtitle">
				<?php esc_html_e( 'Powerful tools built for modern teams. From solo freelancers to Fortune 500 companies — StreamFlow grows with you.', 'novasaas' ); ?>
			</p>
		</div>

		<div class="novasaas-features__grid">

			<?php
			$features = array(
				array(
					'icon'  => '&#9889;',
					'title' => __( 'Real-time Collaboration', 'novasaas' ),
					'desc'  => __( 'Work together seamlessly with live cursors, instant comments, and real-time updates across all your projects.', 'novasaas' ),
				),
				array(
					'icon'  => '&#128202;',
					'title' => __( 'Advanced Analytics', 'novasaas' ),
					'desc'  => __( 'Make data-driven decisions with powerful dashboards, custom reports, and team performance insights.', 'novasaas' ),
				),
				array(
					'icon'  => '&#128274;',
					'title' => __( 'Enterprise Security', 'novasaas' ),
					'desc'  => __( 'SOC2 Type II certified with end-to-end encryption, SSO, audit logs, and role-based access control.', 'novasaas' ),
				),
				array(
					'icon'  => '&#128260;',
					'title' => __( 'Workflow Automation', 'novasaas' ),
					'desc'  => __( 'Automate repetitive tasks with powerful rules, triggers, and integrations with 200+ tools in your stack.', 'novasaas' ),
				),
				array(
					'icon'  => '&#127760;',
					'title' => __( 'Global CDN', 'novasaas' ),
					'desc'  => __( 'Lightning-fast performance for every team member, no matter where they are — delivered from 50+ edge locations.', 'novasaas' ),
				),
				array(
					'icon'  => '&#129302;',
					'title' => __( 'AI Assistant', 'novasaas' ),
					'desc'  => __( 'Smart AI-powered suggestions for task prioritization, deadline predictions, and automated meeting summaries.', 'novasaas' ),
				),
			);
			?>

			<?php foreach ( $features as $i => $feature ) : ?>
				<article class="novasaas-glass-card novasaas-feature-card novasaas-reveal"
						 style="--reveal-delay: <?php echo esc_attr( $i * 80 ); ?>ms;">
					<div class="novasaas-feature-card__icon-wrap" aria-hidden="true">
						<span><?php echo $feature['icon']; ?></span>
					</div>
					<h3 class="novasaas-feature-card__title"><?php echo esc_html( $feature['title'] ); ?></h3>
					<p class="novasaas-feature-card__desc"><?php echo esc_html( $feature['desc'] ); ?></p>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>#"
					   class="novasaas-feature-card__link"
					   aria-label="<?php printf( esc_attr__( 'Learn more about %s', 'novasaas' ), esc_attr( $feature['title'] ) ); ?>">
						<?php esc_html_e( 'Learn more', 'novasaas' ); ?> &rarr;
					</a>
				</article>
			<?php endforeach; ?>

		</div><!-- /.novasaas-features__grid -->
	</div>
</section>

<?php /* ═══ SECTION 4: HOW IT WORKS ════════════════════════════════════════ */ ?>
<section class="novasaas-section novasaas-how"
		 aria-labelledby="novasaas-how-title">
	<div class="novasaas-container">

		<div class="novasaas-section__header novasaas-reveal">
			<span class="novasaas-section__eyebrow"><?php esc_html_e( 'How It Works', 'novasaas' ); ?></span>
			<h2 id="novasaas-how-title" class="novasaas-section__title">
				<?php esc_html_e( 'Get started in 3 simple steps', 'novasaas' ); ?>
			</h2>
			<p class="novasaas-section__subtitle">
				<?php esc_html_e( 'From sign-up to full team productivity in under 10 minutes. No complicated setup. No training needed.', 'novasaas' ); ?>
			</p>
		</div>

		<div class="novasaas-how__steps">

			<?php
			$steps = array(
				array(
					'num'   => '01',
					'icon'  => '<svg width="22" height="22" viewBox="0 0 22 22" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2M9 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8ZM19 8v6M22 11h-6"/></svg>',
					'title' => __( 'Create Your Account', 'novasaas' ),
					'desc'  => __( 'Sign up in seconds with your email or Google account. No credit card required. Your workspace is ready instantly.', 'novasaas' ),
				),
				array(
					'num'   => '02',
					'icon'  => '<svg width="22" height="22" viewBox="0 0 22 22" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="11" cy="11" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 2.83-2.83l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 2.83l-.06.06A1.65 1.65 0 0 0 19.4 9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1Z"/></svg>',
					'title' => __( 'Set Up Your Workspace', 'novasaas' ),
					'desc'  => __( 'Choose from 50+ templates, customize your boards, and connect your favorite tools — Slack, GitHub, Jira, and more.', 'novasaas' ),
				),
				array(
					'num'   => '03',
					'icon'  => '<svg width="22" height="22" viewBox="0 0 22 22" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/></svg>',
					'title' => __( 'Invite Your Team', 'novasaas' ),
					'desc'  => __( 'Send invites in one click, assign roles and permissions, and watch your team hit the ground running from day one.', 'novasaas' ),
				),
			);
			?>

			<?php foreach ( $steps as $i => $step ) : ?>
				<div class="novasaas-how__step novasaas-reveal" style="--reveal-delay:<?php echo esc_attr( $i * 120 ); ?>ms">
					<div class="novasaas-how__step-header">
						<div class="novasaas-how__step-num" aria-hidden="true"><?php echo esc_html( $step['num'] ); ?></div>
						<div class="novasaas-how__step-icon" aria-hidden="true">
							<?php echo $step['icon']; ?>
						</div>
					</div>
					<h3 class="novasaas-how__step-title"><?php echo esc_html( $step['title'] ); ?></h3>
					<p class="novasaas-how__step-desc"><?php echo esc_html( $step['desc'] ); ?></p>
				</div>
			<?php endforeach; ?>

		</div><!-- /.novasaas-how__steps -->
	</div>
</section>

<?php /* ═══ SECTION 5: PRICING ═════════════════════════════════════════════ */ ?>
<section class="novasaas-section novasaas-pricing" id="pricing"
		 aria-labelledby="novasaas-pricing-title">
	<div class="novasaas-container">

		<div class="novasaas-section__header novasaas-reveal">
			<span class="novasaas-section__eyebrow"><?php esc_html_e( 'Pricing', 'novasaas' ); ?></span>
			<h2 id="novasaas-pricing-title" class="novasaas-section__title">
				<?php esc_html_e( 'Simple, transparent pricing', 'novasaas' ); ?>
			</h2>
			<p class="novasaas-section__subtitle">
				<?php esc_html_e( 'Start free. Scale as you grow. No hidden fees, no surprises.', 'novasaas' ); ?>
			</p>
		</div>

		<!-- ── Toggle ──────────────────────────────────────────────── -->
		<div class="novasaas-pricing__toggle" role="group" aria-label="<?php esc_attr_e( 'Billing period', 'novasaas' ); ?>">
			<span id="novasaas-billing-monthly"
				  class="novasaas-pricing__toggle-label is-active"
				  aria-label="<?php esc_attr_e( 'Monthly billing', 'novasaas' ); ?>">
				<?php esc_html_e( 'Monthly', 'novasaas' ); ?>
			</span>

			<button type="button"
					id="novasaas-billing-switch"
					class="novasaas-pricing__switch"
					role="switch"
					aria-checked="false"
					aria-label="<?php esc_attr_e( 'Toggle yearly billing', 'novasaas' ); ?>">
				<span class="novasaas-pricing__switch-thumb"></span>
			</button>

			<span id="novasaas-billing-yearly"
				  class="novasaas-pricing__toggle-label"
				  aria-label="<?php esc_attr_e( 'Yearly billing', 'novasaas' ); ?>">
				<?php esc_html_e( 'Yearly', 'novasaas' ); ?>
			</span>

			<span class="novasaas-pricing__save-badge" id="novasaas-save-badge" hidden>
				<?php esc_html_e( 'Save 20%', 'novasaas' ); ?>
			</span>
		</div>

		<div class="novasaas-pricing__grid">

			<?php
			$plans = array(
				array(
					'id'       => 'starter',
					'name'     => __( 'Starter', 'novasaas' ),
					'tagline'  => __( 'Perfect for small teams just getting started.', 'novasaas' ),
					'price_m'  => '9',
					'price_y'  => '7',
					'featured' => false,
					'cta_text' => __( 'Get Started', 'novasaas' ),
					'cta_url'  => novasaas_get_option( 'cta_url', '#' ),
					'features' => array(
						array( 'text' => __( '5 team members', 'novasaas' ), 'yes' => true ),
						array( 'text' => __( '10 projects', 'novasaas' ), 'yes' => true ),
						array( 'text' => __( '5 GB storage', 'novasaas' ), 'yes' => true ),
						array( 'text' => __( 'Basic analytics', 'novasaas' ), 'yes' => true ),
						array( 'text' => __( 'Email support', 'novasaas' ), 'yes' => true ),
						array( 'text' => __( 'AI Assistant', 'novasaas' ), 'yes' => false ),
						array( 'text' => __( 'Custom integrations', 'novasaas' ), 'yes' => false ),
						array( 'text' => __( 'SSO & Audit logs', 'novasaas' ), 'yes' => false ),
					),
				),
				array(
					'id'       => 'pro',
					'name'     => __( 'Pro', 'novasaas' ),
					'tagline'  => __( 'For growing teams that need more power.', 'novasaas' ),
					'price_m'  => '29',
					'price_y'  => '23',
					'featured' => true,
					'cta_text' => __( 'Start Free Trial', 'novasaas' ),
					'cta_url'  => novasaas_get_option( 'cta_url', '#' ),
					'features' => array(
						array( 'text' => __( 'Unlimited members', 'novasaas' ), 'yes' => true ),
						array( 'text' => __( 'Unlimited projects', 'novasaas' ), 'yes' => true ),
						array( 'text' => __( '100 GB storage', 'novasaas' ), 'yes' => true ),
						array( 'text' => __( 'Advanced analytics', 'novasaas' ), 'yes' => true ),
						array( 'text' => __( 'Priority support', 'novasaas' ), 'yes' => true ),
						array( 'text' => __( 'AI Assistant', 'novasaas' ), 'yes' => true ),
						array( 'text' => __( 'Custom integrations', 'novasaas' ), 'yes' => false ),
						array( 'text' => __( 'SSO & Audit logs', 'novasaas' ), 'yes' => false ),
					),
				),
				array(
					'id'       => 'enterprise',
					'name'     => __( 'Enterprise', 'novasaas' ),
					'tagline'  => __( 'For large orgs with advanced requirements.', 'novasaas' ),
					'price_m'  => '99',
					'price_y'  => '79',
					'featured' => false,
					'cta_text' => __( 'Contact Sales', 'novasaas' ),
					'cta_url'  => novasaas_get_option( 'contact_url', '#' ),
					'features' => array(
						array( 'text' => __( 'Everything in Pro', 'novasaas' ), 'yes' => true ),
						array( 'text' => __( 'Dedicated support', 'novasaas' ), 'yes' => true ),
						array( 'text' => __( '99.99% SLA', 'novasaas' ), 'yes' => true ),
						array( 'text' => __( 'Advanced analytics', 'novasaas' ), 'yes' => true ),
						array( 'text' => __( 'Custom integrations', 'novasaas' ), 'yes' => true ),
						array( 'text' => __( 'AI Assistant', 'novasaas' ), 'yes' => true ),
						array( 'text' => __( 'SSO & Audit logs', 'novasaas' ), 'yes' => true ),
						array( 'text' => __( 'Custom contracts', 'novasaas' ), 'yes' => true ),
					),
				),
			);
			?>

			<?php foreach ( $plans as $i => $plan ) : ?>
				<div class="novasaas-glass-card novasaas-plan-card<?php echo $plan['featured'] ? ' novasaas-plan-card--featured' : ''; ?> novasaas-reveal"
					 style="--reveal-delay:<?php echo esc_attr( $i * 100 ); ?>ms">

					<div class="novasaas-plan-card__header">
						<div class="novasaas-plan-card__badge-row">
							<?php if ( $plan['featured'] ) : ?>
								<span class="novasaas-plan-card__popular">
									&#11088; <?php esc_html_e( 'Most Popular', 'novasaas' ); ?>
								</span>
							<?php else : ?>
								<span></span>
							<?php endif; ?>
						</div>

						<h3 class="novasaas-plan-card__name"><?php echo esc_html( $plan['name'] ); ?></h3>
						<p class="novasaas-plan-card__tagline"><?php echo esc_html( $plan['tagline'] ); ?></p>

						<div class="novasaas-plan-card__price-row">
							<span class="novasaas-plan-card__currency" aria-hidden="true">$</span>
							<span class="novasaas-price__amount"
								  data-monthly="<?php echo esc_attr( $plan['price_m'] ); ?>"
								  data-yearly="<?php echo esc_attr( $plan['price_y'] ); ?>">
								<?php echo esc_html( $plan['price_m'] ); ?>
							</span>
							<span class="novasaas-plan-card__period">/<?php esc_html_e( 'mo', 'novasaas' ); ?></span>
						</div>
						<span class="novasaas-plan-card__billed" data-monthly="" data-yearly="<?php esc_attr_e( 'Billed annually', 'novasaas' ); ?>"></span>
					</div>

					<div class="novasaas-plan-card__body">
						<ul class="novasaas-plan-card__features" role="list">
							<?php foreach ( $plan['features'] as $feature ) : ?>
								<li class="novasaas-plan-card__feature">
									<span class="novasaas-plan-card__feature-icon novasaas-plan-card__feature-icon--<?php echo $feature['yes'] ? 'yes' : 'no'; ?>"
										  aria-hidden="true">
										<?php echo $feature['yes'] ? '&#10003;' : '&#10007;'; ?>
									</span>
									<span><?php echo esc_html( $feature['text'] ); ?></span>
								</li>
							<?php endforeach; ?>
						</ul>

						<a href="<?php echo esc_url( $plan['cta_url'] ); ?>"
						   class="<?php echo $plan['featured'] ? 'novasaas-btn novasaas-w-full' : 'novasaas-btn-outline novasaas-w-full'; ?>"
						   style="justify-content: center;">
							<?php echo esc_html( $plan['cta_text'] ); ?>
						</a>
					</div>

				</div>
			<?php endforeach; ?>

		</div><!-- /.novasaas-pricing__grid -->

		<p class="novasaas-pricing__note novasaas-reveal">
			<?php esc_html_e( 'All plans include a 14-day free trial. No credit card required.', 'novasaas' ); ?>
		</p>

	</div>
</section>

<?php /* ═══ SECTION 6: TESTIMONIALS ══════════════════════════════════════ */ ?>
<section class="novasaas-section novasaas-testimonials"
		 aria-labelledby="novasaas-testimonials-title">
	<div class="novasaas-container">

		<div class="novasaas-section__header novasaas-reveal">
			<span class="novasaas-section__eyebrow"><?php esc_html_e( 'Testimonials', 'novasaas' ); ?></span>
			<h2 id="novasaas-testimonials-title" class="novasaas-section__title">
				<?php esc_html_e( 'Loved by 10,000+ teams worldwide', 'novasaas' ); ?>
			</h2>
		</div>

		<div class="novasaas-testimonials__grid">

			<?php
			$testimonials = array(
				array(
					'text'     => __( '"StreamFlow completely transformed how our team works together. We shipped 3x faster within the first month. I can\'t imagine going back to how we used to work."', 'novasaas' ),
					'name'     => 'Sarah M.',
					'role'     => __( 'Product Manager at TechCorp', 'novasaas' ),
					'initials' => 'SM',
					'bg'       => '6366F1',
					'rating'   => 5,
				),
				array(
					'text'     => __( '"The best project management tool we\'ve ever used. The interface is clean, intuitive, and the AI suggestions save us hours every week. Simply powerful."', 'novasaas' ),
					'name'     => 'James K.',
					'role'     => __( 'CTO at StartupXYZ', 'novasaas' ),
					'initials' => 'JK',
					'bg'       => '06B6D4',
					'rating'   => 5,
				),
				array(
					'text'     => __( '"Outstanding support team and constant product improvements. The enterprise plan gives us everything we need. It\'s worth every single penny."', 'novasaas' ),
					'name'     => 'Emma L.',
					'role'     => __( 'CEO at GrowthCo', 'novasaas' ),
					'initials' => 'EL',
					'bg'       => 'EC4899',
					'rating'   => 5,
				),
			);
			?>

			<?php foreach ( $testimonials as $i => $t ) : ?>
				<article class="novasaas-glass-card novasaas-testimonial-card novasaas-reveal"
						 style="--reveal-delay:<?php echo esc_attr( $i * 120 ); ?>ms">

					<div class="novasaas-testimonial-card__quote-icon" aria-hidden="true">
						<svg width="32" height="28" viewBox="0 0 32 28" fill="currentColor">
							<path d="M0 28V17.818C0 11.636 2.182 6.636 6.545 2.818L9.091 0l2.546 2.545C8.91 5.09 7.273 7.727 6.727 10.545H13V28H0Zm19 0V17.818c0-6.182 2.182-11.182 6.545-15L28.09 0l2.546 2.545C27.91 5.09 26.273 7.727 25.727 10.545H32V28H19Z" fill-opacity=".6"/>
						</svg>
					</div>

					<p class="novasaas-testimonial-card__text"><?php echo esc_html( $t['text'] ); ?></p>

					<div class="novasaas-testimonial-card__author">
						<?php echo novasaas_get_svg_avatar( $t['initials'], $t['bg'] ); ?>
						<div>
							<div class="novasaas-testimonial-card__name"><?php echo esc_html( $t['name'] ); ?></div>
							<div class="novasaas-testimonial-card__role"><?php echo esc_html( $t['role'] ); ?></div>
						</div>
						<div class="novasaas-testimonial-card__stars" aria-label="<?php esc_attr_e( '5 out of 5 stars', 'novasaas' ); ?>">
							<?php echo str_repeat( '&#9733;', (int) $t['rating'] ); ?>
						</div>
					</div>

				</article>
			<?php endforeach; ?>

		</div>
	</div>
</section>

<?php /* ═══ SECTION 7: FAQ ══════════════════════════════════════════════════ */ ?>
<section class="novasaas-section novasaas-faq"
		 aria-labelledby="novasaas-faq-title">
	<div class="novasaas-container">

		<div class="novasaas-section__header novasaas-reveal">
			<span class="novasaas-section__eyebrow"><?php esc_html_e( 'FAQ', 'novasaas' ); ?></span>
			<h2 id="novasaas-faq-title" class="novasaas-section__title">
				<?php esc_html_e( 'Frequently asked questions', 'novasaas' ); ?>
			</h2>
		</div>

		<div class="novasaas-faq__list novasaas-reveal" role="list">

			<?php
			$faqs = array(
				array(
					'q' => __( 'Is there a free trial?', 'novasaas' ),
					'a' => __( 'Yes! Every plan comes with a 14-day free trial — no credit card required. You get access to all Pro features so you can evaluate StreamFlow with zero risk. If you love it, pick a plan. If not, just walk away.', 'novasaas' ),
				),
				array(
					'q' => __( 'Can I cancel anytime?', 'novasaas' ),
					'a' => __( 'Absolutely. You can cancel your subscription at any time with a single click from your account settings. There are no cancellation fees and no questions asked. Your data remains accessible until the end of your billing period.', 'novasaas' ),
				),
				array(
					'q' => __( 'What payment methods do you accept?', 'novasaas' ),
					'a' => __( 'We accept all major credit cards (Visa, Mastercard, American Express), PayPal, and bank wire transfers for Enterprise plans. All payments are processed securely through Stripe.', 'novasaas' ),
				),
				array(
					'q' => __( 'Is my data secure?', 'novasaas' ),
					'a' => __( 'Security is our top priority. StreamFlow is SOC2 Type II certified and we use end-to-end encryption for all data. Your data is backed up daily across multiple geographic regions and we maintain 99.9% uptime SLA. We never sell your data.', 'novasaas' ),
				),
				array(
					'q' => __( 'Can I change plans later?', 'novasaas' ),
					'a' => __( 'Yes, you can upgrade or downgrade your plan at any time. When upgrading, you\'ll be charged the prorated difference immediately. When downgrading, the change takes effect at the start of your next billing cycle.', 'novasaas' ),
				),
				array(
					'q' => __( 'Do you offer discounts for startups?', 'novasaas' ),
					'a' => __( 'Yes! We have a special startup program offering 50% off for 12 months for companies that are less than 2 years old and have raised less than $1M in funding. We also offer discounts for nonprofits, educational institutions, and open-source projects.', 'novasaas' ),
				),
				array(
					'q' => __( 'How does billing work?', 'novasaas' ),
					'a' => __( 'For monthly plans, you\'re billed every 30 days from your signup date. For yearly plans, you\'re billed once upfront for the full year (saving 20%). You\'ll receive an invoice via email before each billing cycle. All prices are in USD.', 'novasaas' ),
				),
				array(
					'q' => __( 'Do you offer refunds?', 'novasaas' ),
					'a' => __( 'We offer a 30-day money-back guarantee. If you\'re not completely satisfied within your first 30 days of a paid plan, contact our support team and we\'ll issue a full refund — no questions asked.', 'novasaas' ),
				),
			);
			?>

			<?php foreach ( $faqs as $i => $faq ) :
				$faq_id = 'novasaas-faq-' . ( $i + 1 );
				$panel_id = $faq_id . '-panel';
				?>
				<div class="novasaas-faq__item" role="listitem">
					<button type="button"
							class="novasaas-faq__question"
							id="<?php echo esc_attr( $faq_id ); ?>"
							aria-expanded="false"
							aria-controls="<?php echo esc_attr( $panel_id ); ?>">
						<span><?php echo esc_html( $faq['q'] ); ?></span>
						<span class="novasaas-faq__icon" aria-hidden="true">
							<svg width="14" height="14" viewBox="0 0 14 14" fill="none">
								<line x1="7" y1="1" x2="7" y2="13" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
								<line x1="1" y1="7" x2="13" y2="7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
							</svg>
						</span>
					</button>
					<div class="novasaas-faq__answer"
						 id="<?php echo esc_attr( $panel_id ); ?>"
						 role="region"
						 aria-labelledby="<?php echo esc_attr( $faq_id ); ?>"
						 hidden>
						<div class="novasaas-faq__answer-inner">
							<?php echo esc_html( $faq['a'] ); ?>
						</div>
					</div>
				</div>
			<?php endforeach; ?>

		</div><!-- /.novasaas-faq__list -->
	</div>
</section>

<?php /* ═══ SECTION 8: CTA BANNER ══════════════════════════════════════════ */ ?>
<section class="novasaas-cta-banner"
		 aria-labelledby="novasaas-cta-title">
	<div class="novasaas-container">
		<div class="novasaas-cta-banner__inner">

			<h2 id="novasaas-cta-title" class="novasaas-cta-banner__title novasaas-reveal">
				<?php esc_html_e( 'Start your free trial today', 'novasaas' ); ?>
			</h2>

			<p class="novasaas-cta-banner__subtitle novasaas-reveal novasaas-delay-1">
				<?php esc_html_e( 'Join 10,000+ teams. No credit card required.', 'novasaas' ); ?>
			</p>

			<form class="novasaas-cta-banner__form novasaas-reveal novasaas-delay-2"
				  id="novasaas-cta-form"
				  method="post"
				  action="<?php echo esc_url( home_url( '/' ) ); ?>"
				  novalidate>
				<?php wp_nonce_field( 'novasaas_cta_form', 'novasaas_cta_nonce' ); ?>

				<label class="novasaas-sr-only" for="novasaas-cta-email">
					<?php esc_html_e( 'Work email address', 'novasaas' ); ?>
				</label>
				<input type="email"
					   id="novasaas-cta-email"
					   name="novasaas_cta_email"
					   class="novasaas-cta-banner__email"
					   placeholder="<?php esc_attr_e( 'Enter your work email', 'novasaas' ); ?>"
					   autocomplete="email"
					   required>
				<button type="submit" class="novasaas-cta-banner__submit">
					<?php esc_html_e( 'Get Started Free', 'novasaas' ); ?>
				</button>
			</form>

			<div class="novasaas-cta-banner__trust novasaas-reveal novasaas-delay-3">
				<span class="novasaas-cta-banner__trust-item">
					<span class="novasaas-cta-banner__trust-check" aria-hidden="true">&#10003;</span>
					<?php esc_html_e( 'Free 14-day trial', 'novasaas' ); ?>
				</span>
				<span class="novasaas-cta-banner__trust-item">
					<span class="novasaas-cta-banner__trust-check" aria-hidden="true">&#10003;</span>
					<?php esc_html_e( 'No credit card required', 'novasaas' ); ?>
				</span>
				<span class="novasaas-cta-banner__trust-item">
					<span class="novasaas-cta-banner__trust-check" aria-hidden="true">&#10003;</span>
					<?php esc_html_e( 'Cancel anytime', 'novasaas' ); ?>
				</span>
			</div>

		</div>
	</div>
</section>

<?php /* ═══ ALL TEMPLATE JAVASCRIPT ══════════════════════════════════════════ */ ?>
<script>
( function () {
	'use strict';

	/* ──────────────────────────────────────────────────────────────────────
	   1. SCROLL REVEAL (IntersectionObserver for .novasaas-reveal)
	   ────────────────────────────────────────────────────────────────────── */
	if ( 'IntersectionObserver' in window ) {
		const revealObserver = new IntersectionObserver(
			function ( entries ) {
				entries.forEach( function ( entry ) {
					if ( entry.isIntersecting ) {
						const el    = entry.target;
						const delay = el.style.getPropertyValue( '--reveal-delay' ) || '0ms';
						setTimeout( function () {
							el.classList.add( 'is-visible' );
						}, parseInt( delay, 10 ) || 0 );
						revealObserver.unobserve( el );
					}
				} );
			},
			{ threshold: 0.12, rootMargin: '0px 0px -40px 0px' }
		);

		document.querySelectorAll( '.novasaas-reveal' ).forEach( function ( el ) {
			revealObserver.observe( el );
		} );
	} else {
		// Fallback: show all immediately.
		document.querySelectorAll( '.novasaas-reveal' ).forEach( function ( el ) {
			el.classList.add( 'is-visible' );
		} );
	}

	/* ──────────────────────────────────────────────────────────────────────
	   2. COUNT-UP ANIMATION (IntersectionObserver + requestAnimationFrame)
	   ────────────────────────────────────────────────────────────────────── */
	if ( 'IntersectionObserver' in window ) {
		const countObserver = new IntersectionObserver(
			function ( entries ) {
				entries.forEach( function ( entry ) {
					if ( ! entry.isIntersecting ) { return; }

					const el      = entry.target;
					const target  = parseFloat( el.dataset.target  || '0' );
					const suffix  = el.dataset.suffix  || '';
					const decimal = parseInt( el.dataset.decimal || '0', 10 );
					const duration = 1800;
					const start   = performance.now();

					function easeOut( t ) {
						return 1 - Math.pow( 1 - t, 3 );
					}

					function tick( now ) {
						const elapsed  = now - start;
						const progress = Math.min( elapsed / duration, 1 );
						const current  = target * easeOut( progress );
						el.textContent = ( decimal > 0
							? current.toFixed( decimal )
							: Math.floor( current ).toLocaleString() ) + suffix;

						if ( progress < 1 ) {
							requestAnimationFrame( tick );
						} else {
							el.textContent = ( decimal > 0
								? target.toFixed( decimal )
								: target.toLocaleString() ) + suffix;
						}
					}

					requestAnimationFrame( tick );
					countObserver.unobserve( el );
				} );
			},
			{ threshold: 0.6 }
		);

		document.querySelectorAll( '.novasaas-count-up' ).forEach( function ( el ) {
			countObserver.observe( el );
		} );
	}

	/* ──────────────────────────────────────────────────────────────────────
	   3. PRICING TOGGLE (Monthly ↔ Yearly)
	   ────────────────────────────────────────────────────────────────────── */
	const billingSwitch   = document.getElementById( 'novasaas-billing-switch' );
	const labelMonthly    = document.getElementById( 'novasaas-billing-monthly' );
	const labelYearly     = document.getElementById( 'novasaas-billing-yearly' );
	const saveBadge       = document.getElementById( 'novasaas-save-badge' );
	const priceAmounts    = document.querySelectorAll( '.novasaas-price__amount' );
	const billedLabels    = document.querySelectorAll( '.novasaas-plan-card__billed' );
	let   isYearly        = false;

	function setPricing( yearly ) {
		isYearly = yearly;

		billingSwitch.classList.toggle( 'is-yearly', yearly );
		billingSwitch.setAttribute( 'aria-checked', yearly ? 'true' : 'false' );

		if ( labelMonthly ) { labelMonthly.classList.toggle( 'is-active', ! yearly ); }
		if ( labelYearly  ) { labelYearly.classList.toggle( 'is-active',   yearly ); }

		if ( saveBadge ) {
			if ( yearly ) {
				saveBadge.removeAttribute( 'hidden' );
			} else {
				saveBadge.setAttribute( 'hidden', '' );
			}
		}

		priceAmounts.forEach( function ( el ) {
			el.textContent = yearly ? ( el.dataset.yearly || el.dataset.monthly ) : el.dataset.monthly;
		} );

		billedLabels.forEach( function ( el ) {
			el.textContent = yearly ? ( el.dataset.yearly || '' ) : ( el.dataset.monthly || '' );
		} );
	}

	if ( billingSwitch ) {
		billingSwitch.addEventListener( 'click', function () {
			setPricing( ! isYearly );
		} );

		// Keyboard support.
		billingSwitch.addEventListener( 'keydown', function ( e ) {
			if ( ' ' === e.key || 'Enter' === e.key ) {
				e.preventDefault();
				setPricing( ! isYearly );
			}
		} );
	}

	// Also toggle when clicking labels.
	if ( labelMonthly ) {
		labelMonthly.addEventListener( 'click', function () { setPricing( false ); } );
		labelMonthly.setAttribute( 'tabindex', '0' );
		labelMonthly.addEventListener( 'keydown', function ( e ) {
			if ( ' ' === e.key || 'Enter' === e.key ) { setPricing( false ); }
		} );
	}

	if ( labelYearly ) {
		labelYearly.addEventListener( 'click', function () { setPricing( true ); } );
		labelYearly.setAttribute( 'tabindex', '0' );
		labelYearly.addEventListener( 'keydown', function ( e ) {
			if ( ' ' === e.key || 'Enter' === e.key ) { setPricing( true ); }
		} );
	}

	/* ──────────────────────────────────────────────────────────────────────
	   4. FAQ ACCORDION
	   ────────────────────────────────────────────────────────────────────── */
	const faqItems = document.querySelectorAll( '.novasaas-faq__item' );

	faqItems.forEach( function ( item ) {
		const btn   = item.querySelector( '.novasaas-faq__question' );
		const panel = item.querySelector( '.novasaas-faq__answer' );

		if ( ! btn || ! panel ) { return; }

		btn.addEventListener( 'click', function () {
			const isOpen = item.classList.contains( 'is-open' );

			// Close all.
			faqItems.forEach( function ( other ) {
				if ( other === item ) { return; }
				const otherBtn   = other.querySelector( '.novasaas-faq__question' );
				const otherPanel = other.querySelector( '.novasaas-faq__answer' );
				other.classList.remove( 'is-open' );
				if ( otherBtn   ) { otherBtn.setAttribute( 'aria-expanded', 'false' ); }
				if ( otherPanel ) {
					otherPanel.style.maxHeight = '0';
					setTimeout( function () { otherPanel.setAttribute( 'hidden', '' ); }, 400 );
				}
			} );

			// Toggle current.
			if ( isOpen ) {
				item.classList.remove( 'is-open' );
				btn.setAttribute( 'aria-expanded', 'false' );
				panel.style.maxHeight = '0';
				setTimeout( function () { panel.setAttribute( 'hidden', '' ); }, 400 );
			} else {
				item.classList.add( 'is-open' );
				btn.setAttribute( 'aria-expanded', 'true' );
				panel.removeAttribute( 'hidden' );
				// Force reflow, then animate.
				panel.style.maxHeight = '0';
				requestAnimationFrame( function () {
					panel.style.maxHeight = panel.scrollHeight + 'px';
				} );
			}
		} );

		// Keyboard: arrow keys to navigate between items.
		btn.addEventListener( 'keydown', function ( e ) {
			const items  = Array.from( document.querySelectorAll( '.novasaas-faq__question' ) );
			const idx    = items.indexOf( btn );

			if ( 'ArrowDown' === e.key && idx < items.length - 1 ) {
				e.preventDefault();
				items[ idx + 1 ].focus();
			} else if ( 'ArrowUp' === e.key && idx > 0 ) {
				e.preventDefault();
				items[ idx - 1 ].focus();
			} else if ( 'Home' === e.key ) {
				e.preventDefault();
				items[ 0 ].focus();
			} else if ( 'End' === e.key ) {
				e.preventDefault();
				items[ items.length - 1 ].focus();
			}
		} );
	} );

	/* ──────────────────────────────────────────────────────────────────────
	   5. SMOOTH SCROLL for anchor links
	   ────────────────────────────────────────────────────────────────────── */
	document.querySelectorAll( 'a[href^="#"]' ).forEach( function ( link ) {
		link.addEventListener( 'click', function ( e ) {
			const targetId = link.getAttribute( 'href' );
			if ( '#' === targetId || '#' === targetId.trim() ) { return; }

			const target = document.querySelector( targetId );
			if ( ! target ) { return; }

			e.preventDefault();

			const header = document.getElementById( 'novasaas-header' );
			const offset = header ? header.offsetHeight + 16 : 80;
			const top    = target.getBoundingClientRect().top + window.scrollY - offset;

			window.scrollTo( { top: top, behavior: 'smooth' } );

			// Update URL without reloading.
			if ( history.pushState ) {
				history.pushState( null, '', targetId );
			}

			// Move focus for accessibility.
			target.setAttribute( 'tabindex', '-1' );
			target.focus( { preventScroll: true } );
		} );
	} );

	/* ──────────────────────────────────────────────────────────────────────
	   6. CTA FORM — client-side email validation (demo only)
	   ────────────────────────────────────────────────────────────────────── */
	const ctaForm = document.getElementById( 'novasaas-cta-form' );

	if ( ctaForm ) {
		ctaForm.addEventListener( 'submit', function ( e ) {
			e.preventDefault();
			const emailInput = document.getElementById( 'novasaas-cta-email' );
			const val        = emailInput ? emailInput.value.trim() : '';
			const emailRe    = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

			if ( ! emailRe.test( val ) ) {
				if ( emailInput ) {
					emailInput.style.borderColor = '#EF4444';
					emailInput.focus();
					setTimeout( function () { emailInput.style.borderColor = ''; }, 2500 );
				}
				return;
			}

			// In a real implementation this would POST to admin-ajax.php.
			// For demo, redirect to the signup URL.
			const signupUrl = ( typeof novasaas_ajax !== 'undefined' && novasaas_ajax.site_url )
				? novasaas_ajax.site_url
				: window.location.origin + '/';
			window.location.href = signupUrl + '?email=' + encodeURIComponent( val );
		} );
	}

} () );
</script>

<?php get_footer(); ?>
