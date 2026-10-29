/**
 * Contact Form — Vanilla JS AJAX handler
 *
 * @package NovaSaaS
 */
( function () {
	'use strict';

	const EMAIL_RE = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/;

	function getForm() {
		return document.getElementById( 'novasaas-contact-form' );
	}

	function getMsgEl() {
		return document.getElementById( 'nc-msg' );
	}

	function showMsg( text, isError ) {
		const el = getMsgEl();
		if ( ! el ) return;
		el.textContent = text;
		el.className   = isError ? 'nc-msg nc-msg--error' : 'nc-msg nc-msg--success';
		el.hidden      = false;
		el.scrollIntoView( { behavior: 'smooth', block: 'nearest' } );
	}

	function clearMsg() {
		const el = getMsgEl();
		if ( el ) {
			el.hidden    = true;
			el.textContent = '';
			el.className = 'nc-msg';
		}
	}

	function setLoading( form, loading ) {
		const btnText    = form.querySelector( '.nc-btn-text' );
		const btnLoading = form.querySelector( '.nc-btn-loading' );
		const submitBtn  = form.querySelector( 'button[type="submit"]' );
		if ( submitBtn ) submitBtn.disabled = loading;
		if ( btnText )    btnText.hidden    = loading;
		if ( btnLoading ) btnLoading.hidden = ! loading;
	}

	function validateField( field ) {
		const val = field.value.trim();
		let error = '';

		switch ( field.name ) {
			case 'name':
				if ( ! val )               error = 'Name is required.';
				else if ( val.length < 2 ) error = 'Name must be at least 2 characters.';
				break;
			case 'email':
				if ( ! val )                  error = 'Email address is required.';
				else if ( ! EMAIL_RE.test( val ) ) error = 'Please enter a valid email address.';
				break;
			case 'message':
				if ( ! val )                error = 'Message is required.';
				else if ( val.length < 10 ) error = 'Message must be at least 10 characters.';
				break;
		}

		const errorEl = document.getElementById( 'nc-error-' + field.name );
		if ( errorEl ) {
			errorEl.textContent = error;
			errorEl.hidden      = ! error;
		}
		field.setAttribute( 'aria-invalid', error ? 'true' : 'false' );

		return ! error;
	}

	function validateForm( form ) {
		let valid = true;
		const fields = form.querySelectorAll( 'input[required], textarea[required]' );
		fields.forEach( function ( f ) {
			if ( ! validateField( f ) ) valid = false;
		} );
		return valid;
	}

	function handleSubmit( e ) {
		e.preventDefault();
		clearMsg();

		const form = e.currentTarget;
		if ( ! validateForm( form ) ) return;

		setLoading( form, true );

		const data     = new FormData( form );
		const ajax_url = ( window.novasaas_ajax && window.novasaas_ajax.ajax_url )
			? window.novasaas_ajax.ajax_url
			: '/wp-admin/admin-ajax.php';

		fetch( ajax_url, {
			method      : 'POST',
			credentials : 'same-origin',
			body        : data,
		} )
			.then( function ( res ) {
				if ( ! res.ok ) throw new Error( 'Network error (' + res.status + ')' );
				return res.json();
			} )
			.then( function ( json ) {
				setLoading( form, false );
				if ( json.success ) {
					showMsg( json.data.message, false );
					form.reset();
					form.querySelectorAll( '[aria-invalid]' ).forEach( function ( f ) {
						f.removeAttribute( 'aria-invalid' );
					} );
				} else {
					showMsg( ( json.data && json.data.message ) ? json.data.message : 'Something went wrong.', true );
				}
			} )
			.catch( function ( err ) {
				setLoading( form, false );
				showMsg( 'Could not send message. Please check your connection and try again.', true );
				if ( window.console ) console.error( '[NovaSaaS] contact-form error:', err );
			} );
	}

	function init() {
		const form = getForm();
		if ( ! form ) return;

		form.addEventListener( 'submit', handleSubmit );

		// Inline validation on blur.
		form.querySelectorAll( 'input, textarea' ).forEach( function ( field ) {
			field.addEventListener( 'blur', function () {
				if ( field.required ) validateField( field );
			} );
		} );
	}

	if ( document.readyState === 'loading' ) {
		document.addEventListener( 'DOMContentLoaded', init );
	} else {
		init();
	}
}() );
