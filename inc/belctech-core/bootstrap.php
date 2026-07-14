<?php
/**
 * Internal compatibility module for the existing WPBakery content contract.
 *
 * The public et_* shortcode names intentionally remain unchanged so switching
 * themes does not expose raw shortcodes in existing pages.
 */

defined( 'ABSPATH' ) || exit;

if ( ! defined( 'BELCTECH_CORE_VER' ) ) define( 'BELCTECH_CORE_VER', BELCTECH_THEME_VERSION );
if ( ! defined( 'BELCTECH_VC_DIR' ) ) define( 'BELCTECH_VC_DIR', __DIR__ . '/js_composer/' );

require_once __DIR__ . '/functions.php';
require_once __DIR__ . '/shortcodes.php';
require_once __DIR__ . '/types/portfolio.php';
require_once __DIR__ . '/types/portfolio-functions.php';
require_once __DIR__ . '/widgets/widgets-init.php';
require_once BELCTECH_VC_DIR . 'js_composer.php';

if ( class_exists( 'Belctech_Core_JS_Composer' ) ) {
	add_action( 'vc_after_init', array( 'Belctech_Core_JS_Composer', 'init' ) );
	add_action( 'vc_after_init', array( 'Belctech_Core_JS_Composer', 'customize_elements' ) );
	add_action( 'vc_after_init', array( 'Belctech_Core_JS_Composer', 'map_shortcodes' ) );
	add_action( 'vc_after_init_base', array( 'Belctech_Core_JS_Composer', 'add_templates' ) );
	add_action( 'init', array( 'Belctech_Core_JS_Composer', 'init_shortcodes' ), 50 );
}
