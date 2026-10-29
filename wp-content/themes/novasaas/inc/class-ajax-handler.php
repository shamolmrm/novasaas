<?php
/**
 * AJAX Handler
 *
 * @package NovaSaaS
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Handles AJAX requests for the theme.
 */
class NovaSaaS_Ajax_Handler {

	/**
	 * Register hooks.
	 */
	public function __construct() {
		add_action( 'wp_ajax_novasaas_contact', array( $this, 'handle_contact_form' ) );
		add_action( 'wp_ajax_nopriv_novasaas_contact', array( $this, 'handle_contact_form' ) );
	}

	/**
	 * Process contact form submission.
	 */
	public function handle_contact_form(): void {
		check_ajax_referer( 'novasaas_contact_nonce', 'nonce' );

		$name    = isset( $_POST['name'] )    ? sanitize_text_field( wp_unslash( $_POST['name'] ) )    : '';
		$email   = isset( $_POST['email'] )   ? sanitize_email( wp_unslash( $_POST['email'] ) )        : '';
		$subject = isset( $_POST['subject'] ) ? sanitize_text_field( wp_unslash( $_POST['subject'] ) ) : '';
		$message = isset( $_POST['message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) : '';

		if ( empty( $name ) || empty( $email ) || empty( $message ) ) {
			wp_send_json_error( array(
				'message' => __( 'Please fill in all required fields.', 'novasaas' ),
			) );
		}

		if ( ! is_email( $email ) ) {
			wp_send_json_error( array(
				'message' => __( 'Please enter a valid email address.', 'novasaas' ),
			) );
		}

		if ( strlen( $name ) < 2 || strlen( $name ) > 100 ) {
			wp_send_json_error( array(
				'message' => __( 'Name must be between 2 and 100 characters.', 'novasaas' ),
			) );
		}

		if ( strlen( $message ) < 10 || strlen( $message ) > 5000 ) {
			wp_send_json_error( array(
				'message' => __( 'Message must be between 10 and 5000 characters.', 'novasaas' ),
			) );
		}

		// Rate limiting: max 3 submissions per IP per hour.
		$ip           = $this->get_client_ip();
		$transient_key = 'novasaas_contact_' . md5( $ip );
		$submissions  = (int) get_transient( $transient_key );

		if ( $submissions >= 3 ) {
			wp_send_json_error( array(
				'message' => __( 'Too many submissions. Please try again in an hour.', 'novasaas' ),
			) );
		}

		$admin_email = get_option( 'admin_email' );
		$site_name   = get_bloginfo( 'name' );

		$email_subject = sprintf(
			/* translators: 1: site name, 2: form subject */
			__( '[%1$s] New Contact Message: %2$s', 'novasaas' ),
			$site_name,
			$subject ?: __( 'General Inquiry', 'novasaas' )
		);

		$email_body  = sprintf( __( 'Name: %s', 'novasaas' ), $name ) . "\r\n";
		$email_body .= sprintf( __( 'Email: %s', 'novasaas' ), $email ) . "\r\n";
		$email_body .= sprintf( __( 'Subject: %s', 'novasaas' ), $subject ?: __( 'General Inquiry', 'novasaas' ) ) . "\r\n\r\n";
		$email_body .= sprintf( __( 'Message:', 'novasaas' ) ) . "\r\n" . $message . "\r\n";

		$headers = array(
			'Content-Type: text/plain; charset=UTF-8',
			sprintf( 'Reply-To: %s <%s>', $name, $email ),
		);

		$sent = wp_mail( $admin_email, $email_subject, $email_body, $headers );

		if ( ! $sent ) {
			wp_send_json_error( array(
				'message' => __( 'Failed to send message. Please try again or contact us directly.', 'novasaas' ),
			) );
		}

		set_transient( $transient_key, $submissions + 1, HOUR_IN_SECONDS );

		wp_send_json_success( array(
			'message' => __( 'Thank you! Your message has been sent. We\'ll be in touch within 24 hours.', 'novasaas' ),
		) );
	}

	/**
	 * Get the real client IP address.
	 */
	private function get_client_ip(): string {
		$headers = array(
			'HTTP_CF_CONNECTING_IP',
			'HTTP_X_FORWARDED_FOR',
			'HTTP_X_REAL_IP',
			'REMOTE_ADDR',
		);

		foreach ( $headers as $header ) {
			if ( ! empty( $_SERVER[ $header ] ) ) {
				$ip = sanitize_text_field( wp_unslash( $_SERVER[ $header ] ) );
				// Handle comma-separated IPs (X-Forwarded-For).
				if ( strpos( $ip, ',' ) !== false ) {
					$parts = explode( ',', $ip );
					$ip    = trim( $parts[0] );
				}
				if ( filter_var( $ip, FILTER_VALIDATE_IP ) ) {
					return $ip;
				}
			}
		}

		return '0.0.0.0';
	}
}
