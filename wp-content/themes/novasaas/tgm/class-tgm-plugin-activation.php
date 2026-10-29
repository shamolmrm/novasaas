<?php
/**
 * TGM Plugin Activation — Stub / Placeholder
 *
 * The real TGM Plugin Activation library is NOT included in this theme
 * due to licensing constraints. You MUST download it separately.
 *
 * ─── HOW TO INSTALL ─────────────────────────────────────────────────────
 *
 * 1. Download the latest release from the official GitHub repository:
 *    https://github.com/TGMPA/TGM-Plugin-Activation/releases
 *
 * 2. From the downloaded zip, copy the single file:
 *    class-tgm-plugin-activation.php
 *
 * 3. Replace THIS stub file with that downloaded file:
 *    wp-content/themes/novasaas/tgm/class-tgm-plugin-activation.php
 *
 * 4. That's it — no other changes needed. The theme's functions.php
 *    already requires this path and calls tgmpa() on the
 *    'tgmpa_register' hook.
 *
 * ─── WHAT IT DOES ───────────────────────────────────────────────────────
 *
 * TGMPA shows an admin notice that guides users to install / activate
 * the required and recommended plugins for NovaSaaS:
 *
 *   Required:     Elementor, One Click Demo Import
 *   Recommended:  Contact Form 7, WooCommerce
 *
 * ─── LICENSE ────────────────────────────────────────────────────────────
 *
 * TGM Plugin Activation is released under GPL-2.0+.
 * Copyright (c) 2011, Thomas Griffin.
 *
 * @package NovaSaaS
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'tgmpa' ) ) {
	/**
	 * Stub tgmpa() so the theme does not fatal-error if the real library
	 * has not been installed yet. Replace this entire file with the real
	 * class-tgm-plugin-activation.php once downloaded.
	 *
	 * @param array $plugins Array of plugin config arrays.
	 * @param array $config  TGMPA configuration array.
	 */
	function tgmpa( array $plugins, array $config = array() ): void {
		// Intentionally empty stub.
		// Download the real library from: https://github.com/TGMPA/TGM-Plugin-Activation/releases
	}
}
