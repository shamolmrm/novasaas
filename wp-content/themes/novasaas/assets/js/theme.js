/**
 * NovaSaaS — Main Theme JavaScript
 * No jQuery. ES5-compatible with modern API fallbacks.
 *
 * @package NovaSaaS
 */
( function () {
	'use strict';

	/* ── helpers ─────────────────────────────────────────────────────────── */
	function qs( sel, ctx ) { return ( ctx || document ).querySelector( sel ); }
	function qsa( sel, ctx ) { return Array.prototype.slice.call( ( ctx || document ).querySelectorAll( sel ) ); }
	function on( el, ev, fn, opts ) { if ( el ) el.addEventListener( ev, fn, opts || false ); }

	/* ── 1. Sticky Header ────────────────────────────────────────────────── */
	function initStickyHeader() {
		var header = qs( '#novasaas-header' );
		if ( ! header ) return;

		var sentinel = document.createElement( 'div' );
		sentinel.style.cssText = 'position:absolute;top:0;left:0;width:1px;height:1px;pointer-events:none;';
		document.body.insertBefore( sentinel, document.body.firstChild );

		if ( 'IntersectionObserver' in window ) {
			var obs = new IntersectionObserver( function ( entries ) {
				header.classList.toggle( 'is-sticky', ! entries[0].isIntersecting );
			}, { threshold: 0 } );
			obs.observe( sentinel );
		} else {
			var ticking = false;
			on( window, 'scroll', function () {
				if ( ticking ) return;
				ticking = true;
				requestAnimationFrame( function () {
					header.classList.toggle( 'is-sticky', window.pageYOffset > 10 );
					ticking = false;
				} );
			}, { passive: true } );
		}
	}

	/* ── 2. Mobile Menu ──────────────────────────────────────────────────── */
	function initMobileMenu() {
		var trigger  = qs( '#novasaas-hamburger' );
		var menu     = qs( '#novasaas-mobile-menu' );
		var overlay  = qs( '#novasaas-overlay' );
		var closeBtn = qs( '#novasaas-mobile-close' );
		if ( ! trigger || ! menu ) return;

		var focusable = 'a[href],button:not([disabled]),input,textarea,select,[tabindex]:not([tabindex="-1"])';
		var isOpen = false;

		function openMenu() {
			isOpen = true;
			menu.removeAttribute( 'hidden' );
			menu.setAttribute( 'aria-hidden', 'false' );
			trigger.setAttribute( 'aria-expanded', 'true' );
			document.body.style.overflow = 'hidden';
			if ( overlay ) overlay.classList.add( 'is-active' );
			// Move focus to first focusable element.
			var first = menu.querySelector( focusable );
			if ( first ) first.focus();
			trapFocus( menu );
		}

		function closeMenu() {
			isOpen = false;
			menu.setAttribute( 'hidden', '' );
			menu.setAttribute( 'aria-hidden', 'true' );
			trigger.setAttribute( 'aria-expanded', 'false' );
			document.body.style.overflow = '';
			if ( overlay ) overlay.classList.remove( 'is-active' );
			trigger.focus();
			document.removeEventListener( 'keydown', focusTrapHandler );
		}

		var focusTrapHandler;
		function trapFocus( container ) {
			var focusEls = container.querySelectorAll( focusable );
			var first = focusEls[0];
			var last  = focusEls[ focusEls.length - 1 ];
			focusTrapHandler = function ( e ) {
				if ( e.key === 'Escape' || e.keyCode === 27 ) { closeMenu(); return; }
				if ( e.key !== 'Tab' && e.keyCode !== 9 ) return;
				if ( e.shiftKey ) {
					if ( document.activeElement === first ) { e.preventDefault(); last.focus(); }
				} else {
					if ( document.activeElement === last ) { e.preventDefault(); first.focus(); }
				}
			};
			document.addEventListener( 'keydown', focusTrapHandler );
		}

		on( trigger, 'click', function () { isOpen ? closeMenu() : openMenu(); } );
		on( closeBtn, 'click', closeMenu );
		on( overlay, 'click', closeMenu );
	}

	/* ── 3. Scroll Reveal ────────────────────────────────────────────────── */
	function initScrollReveal() {
		var els = qsa( '.novasaas-reveal' );
		if ( ! els.length ) return;

		if ( 'IntersectionObserver' in window ) {
			var obs = new IntersectionObserver( function ( entries ) {
				entries.forEach( function ( entry ) {
					if ( entry.isIntersecting ) {
						entry.target.classList.add( 'is-visible' );
						obs.unobserve( entry.target );
					}
				} );
			}, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' } );
			els.forEach( function ( el ) { obs.observe( el ); } );
		} else {
			els.forEach( function ( el ) { el.classList.add( 'is-visible' ); } );
		}
	}

	/* ── 4. Count-Up Animation ───────────────────────────────────────────── */
	function initCountUp() {
		var els = qsa( '[data-target]' );
		if ( ! els.length || ! ( 'IntersectionObserver' in window ) ) return;

		function easeOut( t ) { return 1 - Math.pow( 1 - t, 3 ); }

		function animateCount( el ) {
			var target   = parseFloat( el.dataset.target );
			var suffix   = el.dataset.suffix  || '';
			var prefix   = el.dataset.prefix  || '';
			var decimals = el.dataset.decimal ? parseInt( el.dataset.decimal, 10 ) : 0;
			var duration = 2000;
			var start    = null;

			function step( ts ) {
				if ( ! start ) start = ts;
				var progress = Math.min( ( ts - start ) / duration, 1 );
				var current  = target * easeOut( progress );
				el.textContent = prefix + ( decimals ? current.toFixed( decimals ) : Math.floor( current ).toLocaleString() ) + suffix;
				if ( progress < 1 ) requestAnimationFrame( step );
			}

			requestAnimationFrame( step );
		}

		var obs = new IntersectionObserver( function ( entries ) {
			entries.forEach( function ( entry ) {
				if ( entry.isIntersecting ) {
					animateCount( entry.target );
					obs.unobserve( entry.target );
				}
			} );
		}, { threshold: 0.5 } );

		els.forEach( function ( el ) { obs.observe( el ); } );
	}

	/* ── 5. Pricing Toggle ───────────────────────────────────────────────── */
	function initPricingToggle() {
		var switches = qsa( '.novasaas-pricing-switch input[type="checkbox"]' );
		switches.forEach( function ( sw ) {
			on( sw, 'change', function () {
				var isYearly = sw.checked;
				var container = sw.closest( '.novasaas-pricing' ) || document;

				qsa( '[data-monthly]', container ).forEach( function ( el ) {
					el.textContent = isYearly ? ( el.dataset.yearly || el.dataset.monthly ) : el.dataset.monthly;
				} );

				var saveEl = qs( '.novasaas-pricing__save', container );
				if ( saveEl ) saveEl.hidden = ! isYearly;

				var labelMonthly = qs( '.novasaas-pricing__toggle-label--monthly', container );
				var labelYearly  = qs( '.novasaas-pricing__toggle-label--yearly', container );
				if ( labelMonthly ) labelMonthly.classList.toggle( 'is-active', ! isYearly );
				if ( labelYearly )  labelYearly.classList.toggle( 'is-active', isYearly );
			} );
		} );
	}

	/* ── 6. FAQ Accordion ────────────────────────────────────────────────── */
	function initFAQ() {
		var items = qsa( '.novasaas-faq-item' );
		items.forEach( function ( item ) {
			var trigger = qs( '.novasaas-faq-item__trigger', item );
			var body    = qs( '.novasaas-faq-item__body', item );
			if ( ! trigger || ! body ) return;

			on( trigger, 'click', function () {
				var isOpen = trigger.getAttribute( 'aria-expanded' ) === 'true';

				// Close all others.
				items.forEach( function ( other ) {
					var t = qs( '.novasaas-faq-item__trigger', other );
					var b = qs( '.novasaas-faq-item__body', other );
					if ( t && b && t !== trigger ) {
						t.setAttribute( 'aria-expanded', 'false' );
						b.style.maxHeight = '0';
					}
				} );

				if ( isOpen ) {
					trigger.setAttribute( 'aria-expanded', 'false' );
					body.style.maxHeight = '0';
				} else {
					trigger.setAttribute( 'aria-expanded', 'true' );
					body.style.maxHeight = body.scrollHeight + 'px';
				}
			} );

			on( trigger, 'keydown', function ( e ) {
				if ( e.key === 'Enter' || e.key === ' ' || e.keyCode === 13 || e.keyCode === 32 ) {
					e.preventDefault();
					trigger.click();
				}
			} );
		} );
	}

	/* ── 7. Smooth Scroll ────────────────────────────────────────────────── */
	function initSmoothScroll() {
		on( document, 'click', function ( e ) {
			var target = e.target.closest( 'a[href^="#"]' );
			if ( ! target ) return;
			var hash = target.getAttribute( 'href' );
			if ( hash === '#' || hash === '#!' ) return;
			var dest = qs( hash );
			if ( ! dest ) return;
			e.preventDefault();
			var offset = 80;
			var top = dest.getBoundingClientRect().top + window.pageYOffset - offset;
			window.scrollTo( { top: top, behavior: 'smooth' } );
			history.pushState( null, '', hash );
			dest.setAttribute( 'tabindex', '-1' );
			dest.focus( { preventScroll: true } );
		} );
	}

	/* ── 8. Back to Top ──────────────────────────────────────────────────── */
	function initBackToTop() {
		var btn = qs( '#novasaas-back-to-top' );
		if ( ! btn ) return;

		var ticking = false;
		on( window, 'scroll', function () {
			if ( ticking ) return;
			ticking = true;
			requestAnimationFrame( function () {
				btn.classList.toggle( 'is-visible', window.pageYOffset > 400 );
				ticking = false;
			} );
		}, { passive: true } );

		on( btn, 'click', function () {
			window.scrollTo( { top: 0, behavior: 'smooth' } );
		} );
	}

	/* ── 9. Lazy Load Images (native fallback) ───────────────────────────── */
	function initLazyLoad() {
		if ( 'loading' in HTMLImageElement.prototype ) return;
		var imgs = qsa( 'img[loading="lazy"]' );
		if ( ! imgs.length || ! ( 'IntersectionObserver' in window ) ) return;

		var obs = new IntersectionObserver( function ( entries ) {
			entries.forEach( function ( entry ) {
				if ( entry.isIntersecting ) {
					var img = entry.target;
					if ( img.dataset.src ) img.src = img.dataset.src;
					if ( img.dataset.srcset ) img.srcset = img.dataset.srcset;
					obs.unobserve( img );
				}
			} );
		} );
		imgs.forEach( function ( img ) { obs.observe( img ); } );
	}

	/* ── 10. Desktop Dropdown Keyboard Nav ───────────────────────────────── */
	function initDropdowns() {
		var dropdowns = qsa( '.menu-item.dropdown' );
		dropdowns.forEach( function ( item ) {
			var toggle = qs( '.dropdown-toggle', item );
			var menu   = qs( '.novasaas-dropdown', item );
			if ( ! toggle || ! menu ) return;

			on( toggle, 'click', function ( e ) {
				e.preventDefault();
				var expanded = toggle.getAttribute( 'aria-expanded' ) === 'true';
				// Close all.
				qsa( '.dropdown-toggle[aria-expanded="true"]' ).forEach( function ( t ) {
					t.setAttribute( 'aria-expanded', 'false' );
					var m = t.closest( '.menu-item' ) && qs( '.novasaas-dropdown', t.closest( '.menu-item' ) );
					if ( m ) m.classList.remove( 'is-open' );
				} );
				if ( ! expanded ) {
					toggle.setAttribute( 'aria-expanded', 'true' );
					menu.classList.add( 'is-open' );
					var first = menu.querySelector( 'a' );
					if ( first ) first.focus();
				}
			} );

			on( document, 'click', function ( e ) {
				if ( ! item.contains( e.target ) ) {
					toggle.setAttribute( 'aria-expanded', 'false' );
					menu.classList.remove( 'is-open' );
				}
			} );

			on( toggle, 'keydown', function ( e ) {
				if ( e.key === 'Escape' || e.keyCode === 27 ) {
					toggle.setAttribute( 'aria-expanded', 'false' );
					menu.classList.remove( 'is-open' );
					toggle.focus();
				}
			} );
		} );
	}

	/* ── 11. Copy Link Button ────────────────────────────────────────────── */
	function initCopyLink() {
		var btn = qs( '#novasaas-copy-link' );
		if ( ! btn || ! navigator.clipboard ) return;
		on( btn, 'click', function () {
			navigator.clipboard.writeText( btn.dataset.url || location.href ).then( function () {
				var span = btn.querySelector( 'span' );
				if ( span ) {
					var orig = span.textContent;
					span.textContent = 'Copied!';
					setTimeout( function () { span.textContent = orig; }, 2000 );
				}
			} ).catch( function () {} );
		} );
	}

	/* ── 12. Preloader ───────────────────────────────────────────────────── */
	function initPreloader() {
		var preloader = qs( '#novasaas-preloader' );
		if ( ! preloader ) return;
		window.addEventListener( 'load', function () {
			preloader.style.opacity = '0';
			setTimeout( function () { preloader.style.display = 'none'; }, 400 );
		} );
	}

	/* ── Boot ────────────────────────────────────────────────────────────── */
	function init() {
		initStickyHeader();
		initMobileMenu();
		initScrollReveal();
		initCountUp();
		initPricingToggle();
		initFAQ();
		initSmoothScroll();
		initBackToTop();
		initLazyLoad();
		initDropdowns();
		initCopyLink();
		initPreloader();
	}

	if ( document.readyState === 'loading' ) {
		document.addEventListener( 'DOMContentLoaded', init );
	} else {
		init();
	}
}() );
