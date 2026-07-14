<?php

/**
 * Belctech Ecommerce functions and definitions.
 *
 * @link    https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Belctech_Ecommerce
 */

// Constants: Folder directories/uri's
define( 'GOYA_THEME_DIR', get_template_directory() );
define( 'GOYA_DIR', get_template_directory() . '/inc' );
define( 'GOYA_THEME_URI', get_template_directory_uri() );
define( 'GOYA_URI', get_template_directory_uri() . '/inc' );

// Constant: Framework namespace
define( 'GOYA_NAMESPACE', 'belctech-ecommerce' );

// Constant: Theme version
define( 'GOYA_THEME_VERSION', '1.0.35' );
define( 'BELCTECH_THEME_VERSION', GOYA_THEME_VERSION );
define( 'BELCTECH_DIR', GOYA_DIR . '/belctech' );


// Native feature layer. Legacy function and data keys remain for seamless migration.
require BELCTECH_DIR . '/compat.php';
require BELCTECH_DIR . '/customizer.php';
require BELCTECH_DIR . '/product-meta.php';
require BELCTECH_DIR . '/content-meta.php';
require BELCTECH_DIR . '/swatches.php';
require BELCTECH_DIR . '/shop-filters.php';
require BELCTECH_DIR . '/footer-blocks.php';
require BELCTECH_DIR . '/performance.php';

// Store-specific modules migrated from the previous site functions file.
require GOYA_DIR . '/vaam-custom.php';

// Frontend Functions
require GOYA_DIR .'/misc.php';
require GOYA_DIR .'/frontend/header.php';
require GOYA_DIR .'/frontend/footer.php';
require GOYA_DIR .'/frontend/panels.php';
require GOYA_DIR .'/frontend/entry.php';

// Script Calls
require GOYA_DIR .'/script-calls.php';

// Ajax
require GOYA_DIR .'/ajax.php';

// Add Menu Support
require GOYA_DIR .'/mega-menu.php';

// Enable Sidebars
require GOYA_DIR .'/sidebar.php';

// Language/Currency switchers
require GOYA_DIR .'/switchers.php';

// WooCommerce related functions
require GOYA_DIR .'/woocommerce/wc-functions.php';
require GOYA_DIR .'/woocommerce/wc-elements.php';
require GOYA_DIR .'/woocommerce/category-image.php';

// Gutenberg related functions
require GOYA_DIR .'/gutenberg.php';

// CSS Output of Theme Options
require GOYA_DIR .'/custom-styles.php';

// Built-in WPBakery elements keep existing Goya/VC page content renderable.
require GOYA_DIR . '/belctech-core/bootstrap.php';
