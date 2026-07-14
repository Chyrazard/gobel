<?php
/**
 * Internal compatibility module for the existing WPBakery content contract.
 *
 * The public et_* shortcode names intentionally remain unchanged so switching
 * themes does not expose raw shortcodes in existing pages.
 */

defined( 'ABSPATH' ) || exit;

// Goya Core may still be active during a theme switch. In that case it owns
// these legacy symbols and already provides the compatible shortcodes.
$belctech_active_plugins = (array) get_option( 'active_plugins', array() );
$belctech_network_plugins = is_multisite() ? (array) get_site_option( 'active_sitewide_plugins', array() ) : array();
$belctech_goya_core_active = in_array( 'goya-core/goya-core.php', $belctech_active_plugins, true ) || isset( $belctech_network_plugins['goya-core/goya-core.php'] );

if ( $belctech_goya_core_active || class_exists( 'Goya_Core' ) || class_exists( 'Goya_Core_JS_Composer' ) ) {
	return;
}

if ( ! defined( 'GOYA_CORE_VER' ) ) define( 'GOYA_CORE_VER', BELCTECH_THEME_VERSION );
if ( ! defined( 'GOYA_VC_DIR' ) ) define( 'GOYA_VC_DIR', __DIR__ . '/js_composer/' );

require_once __DIR__ . '/functions.php';
require_once __DIR__ . '/shortcodes.php';
require_once __DIR__ . '/types/portfolio.php';
require_once __DIR__ . '/types/portfolio-functions.php';
require_once __DIR__ . '/widgets/widgets-init.php';
require_once GOYA_VC_DIR . 'js_composer.php';

if ( class_exists( 'Goya_Core_JS_Composer' ) ) {
	add_action( 'vc_after_init', array( 'Goya_Core_JS_Composer', 'init' ) );
	add_action( 'vc_after_init', array( 'Goya_Core_JS_Composer', 'customize_elements' ) );
	add_action( 'vc_after_init', array( 'Goya_Core_JS_Composer', 'map_shortcodes' ) );
	add_action( 'vc_after_init_base', array( 'Goya_Core_JS_Composer', 'add_templates' ) );
	add_action( 'init', array( 'Goya_Core_JS_Composer', 'init_shortcodes' ), 50 );
}
