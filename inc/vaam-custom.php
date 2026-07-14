<?php
/**
 * Store-specific functionality migrated from the previous site.
 *
 * @package Belctech_Ecommerce
 */

defined( 'ABSPATH' ) || exit;

require_once __DIR__ . '/preloader.php';
require_once __DIR__ . '/whatsapp.php';
require_once __DIR__ . '/pos-users.php';

if ( ! class_exists( 'WooCommerce' ) ) {
	return;
}

require_once __DIR__ . '/automatic-account.php';
require_once __DIR__ . '/backend-bundles.php';
require_once __DIR__ . '/pos-order-meta.php';
require_once __DIR__ . '/solopos-hide.php';
require_once __DIR__ . '/stock-available.php';
require_once __DIR__ . '/2-click-payu.php';

// Bundle pricing must also be registered on cart and checkout requests.
require_once __DIR__ . '/bundle1.php';
require_once __DIR__ . '/bundle2.php';
require_once __DIR__ . '/bundle3.php';
require_once __DIR__ . '/bundle4.php';
