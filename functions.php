<?php

/**
 * Belctech Ecommerce functions and definitions.
 *
 * @link    https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Belctech_Ecommerce
 */

// Constants: Folder directories/uri's
define( 'BELCTECH_THEME_DIR', get_template_directory() );
define( 'BELCTECH_INC_DIR', get_template_directory() . '/inc' );
define( 'BELCTECH_THEME_URI', get_template_directory_uri() );
define( 'BELCTECH_INC_URI', get_template_directory_uri() . '/inc' );

// Constant: Framework namespace
define( 'BELCTECH_NAMESPACE', 'belctech-ecommerce' );

// Constant: Theme version
define( 'BELCTECH_THEME_VERSION', '1.0.39' );
define( 'BELCTECH_FEATURES_DIR', BELCTECH_INC_DIR . '/belctech' );


// Native feature layer. Stored data is migrated before frontend templates render.
require BELCTECH_FEATURES_DIR . '/compat.php';
require BELCTECH_FEATURES_DIR . '/frontend-i18n.php';
require BELCTECH_FEATURES_DIR . '/customizer.php';
require BELCTECH_FEATURES_DIR . '/product-meta.php';
require BELCTECH_FEATURES_DIR . '/content-meta.php';
require BELCTECH_FEATURES_DIR . '/swatches.php';
require BELCTECH_FEATURES_DIR . '/shop-filters.php';
require BELCTECH_FEATURES_DIR . '/footer-blocks.php';
require BELCTECH_FEATURES_DIR . '/performance.php';

// Store-specific modules migrated from the previous site functions file.
require BELCTECH_INC_DIR . '/vaam-custom.php';

// Frontend Functions
require BELCTECH_INC_DIR .'/misc.php';
require BELCTECH_INC_DIR .'/frontend/header.php';
require BELCTECH_INC_DIR .'/frontend/footer.php';
require BELCTECH_INC_DIR .'/frontend/panels.php';
require BELCTECH_INC_DIR .'/frontend/entry.php';

// Script Calls
require BELCTECH_INC_DIR .'/script-calls.php';

// Ajax
require BELCTECH_INC_DIR .'/ajax.php';

// Add Menu Support
require BELCTECH_INC_DIR .'/mega-menu.php';

// Enable Sidebars
require BELCTECH_INC_DIR .'/sidebar.php';

// Language/Currency switchers
require BELCTECH_INC_DIR .'/switchers.php';

// WooCommerce related functions
require BELCTECH_INC_DIR .'/woocommerce/wc-functions.php';
require BELCTECH_INC_DIR .'/woocommerce/wc-elements.php';
require BELCTECH_INC_DIR .'/woocommerce/category-image.php';

// Gutenberg related functions
require BELCTECH_INC_DIR .'/gutenberg.php';

// CSS Output of Theme Options
require BELCTECH_INC_DIR .'/custom-styles.php';

// Built-in WPBakery elements keep existing Belctech/VC page content renderable.
require BELCTECH_INC_DIR . '/belctech-core/bootstrap.php';
