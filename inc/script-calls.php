<?php

/* Enqueue Styles
---------------------------------------------------------- */

	define( 'BELCTECH_SCRIPT_DEBUG', apply_filters( 'belctech_script_debug', false ) );

	// Paths
	define( 'BELCTECH_ASSET_CSS', BELCTECH_THEME_URI . '/assets/css' );
	define( 'BELCTECH_ASSET_JS', BELCTECH_THEME_URI . '/assets/js' );
	define( 'BELCTECH_ASSET_ICON', BELCTECH_THEME_URI . '/assets/icons' );


	// Main Styles
	function belctech_styles() {
		global $post;

		// Typekit fonts
		if ( get_theme_mod('main_font_source', '1') === '2' && get_theme_mod('main_font_typekit_kit_id', '') != '' ) {
			wp_enqueue_style( 'belctech-typekit-main', '//use.typekit.net/' . esc_attr( get_theme_mod('main_font_typekit_kit_id', '') ) . '.css' );
		}
		if ( get_theme_mod('second_font_source', '1') === '2' && get_theme_mod('second_font_typekit_kit_id', '') != '' ) {
			wp_enqueue_style( 'belctech-typekit-second', '//use.typekit.net/' . esc_attr( get_theme_mod('second_font_typekit_kit_id', '') ) . '.css' );
		}

		//Theme Styles
		wp_enqueue_style( 'belctech-grid', BELCTECH_ASSET_CSS . '/grid.css', array(), BELCTECH_THEME_VERSION, 'all' );
		wp_enqueue_style( 'belctech-ecommerce', BELCTECH_ASSET_CSS . '/core.css', array(), BELCTECH_THEME_VERSION, 'all' );

		// Theme icon font
		wp_enqueue_style( 'belctech-icons', BELCTECH_ASSET_ICON . '/theme-icons/style.css', array(), BELCTECH_THEME_VERSION, 'all' );


		// WooCommerce
		if( belctech_wc_active() ) {
			wp_enqueue_style( 'belctech-shop', BELCTECH_ASSET_CSS . '/shop.css', array(), BELCTECH_THEME_VERSION, 'all' );
		}

		// Visual Composer elements
		if ( class_exists( 'WPBakeryVisualComposerAbstract' ) && belctech_needs_wpbakery_assets() ) {
			wp_enqueue_style( 'belctech-elements', BELCTECH_ASSET_CSS . '/vc-elements.css', array(), BELCTECH_THEME_VERSION, 'all' );
		}

		// Load RTL stylesheet if necessary
		if ( is_rtl() ) {
			wp_enqueue_style( 'belctech-rtl', BELCTECH_ASSET_CSS . '/rtl.css', array(), BELCTECH_THEME_VERSION, 'all' );
		}

		// Inline styles from the customizer
		wp_register_style('belctech-customizer-styles', false); // Register handle
		wp_enqueue_style('belctech-customizer-styles');
			wp_add_inline_style( 'belctech-customizer-styles', belctech_cached_custom_styles() );

	}

	add_action('wp_enqueue_scripts', 'belctech_styles', 10);



/* Register Scripts
---------------------------------------------------------- */

	function belctech_scripts() {

		// Script path and suffix setup (debug mode loads un-minified scripts)
		if ( defined( 'BELCTECH_SCRIPT_DEBUG' ) && BELCTECH_SCRIPT_DEBUG ) {
			$script_path = BELCTECH_ASSET_JS . '/dev/';
			$suffix = '';
		} else {
			$script_path = BELCTECH_ASSET_JS . '/';
			$suffix = '.min';
		}

		if (!is_admin()) {
			global $post;

			// Script loaded by WordPress
			if ( belctech_needs_carousel() || belctech_needs_masonry() || belctech_needs_woocommerce_assets() ) {
				wp_enqueue_script( 'imagesloaded' );
			}

			// Lazy loading
			if ( apply_filters('belctech_do_lazyload', get_theme_mod('lazy_load',false)) == true ) {
				wp_enqueue_script( 'lazy-sizes',  BELCTECH_ASSET_JS . '/vendor/lazysizes.min.js', array( 'jquery' ), '5.3.0', TRUE);
			}
			// Detect browser capabilites
			wp_enqueue_script( 'modernizr', BELCTECH_ASSET_JS . '/vendor/modernizr.min.js', array('jquery'), '2.8.3', TRUE);
				wp_enqueue_script( 'mobile-detect',  BELCTECH_ASSET_JS . '/vendor/mobile-detect-lite.js', array(), BELCTECH_THEME_VERSION, TRUE);
			wp_enqueue_script( 'in-viewport',  BELCTECH_ASSET_JS . '/vendor/isInViewport.min.js', array( 'jquery' ), '3.0.4', TRUE);
			// Autocomplete
			if ( get_theme_mod( 'ajax_search', true ) == true ) {
			wp_enqueue_script( 'autocomplete',  BELCTECH_ASSET_JS . '/vendor/jquery.autocomplete.min.js', array( 'jquery' ), '1.4.1', TRUE);
			}
			// Magnific Popup
				if ( belctech_needs_popup() ) {
					wp_enqueue_script( 'magnific-popup', BELCTECH_ASSET_JS . '/vendor/jquery.magnific-popup.min.js', array( 'jquery' ), '3.0.1', true );
				}
			// Sticky elements are only used by catalogs, product summaries and blog sidebars.
				if ( belctech_needs_woocommerce_assets() || is_home() || is_archive() || is_single() ) {
					wp_enqueue_script( 'sticky-kit', BELCTECH_ASSET_JS . '/vendor/sticky-kit.min.js', array( 'jquery' ), '1.1.3', true );
				}
			// Slick carousel
				if ( belctech_needs_carousel() ) {
					wp_enqueue_script( 'jquery-slick', BELCTECH_ASSET_JS . '/vendor/slick.min.js', array( 'jquery' ), '1.8.1', true );
				}
			// Masonry layouts
				if ( belctech_needs_masonry() ) {
					wp_enqueue_script( 'isotope-pk', BELCTECH_ASSET_JS . '/vendor/isotope.pkgd.min.js', array( 'jquery' ), '3.0.6', true );
					wp_enqueue_script( 'packery', BELCTECH_ASSET_JS . '/vendor/packery-mode.pkgd.min.js', array( 'jquery', 'isotope-pk' ), '2.0.1', true );
				}
			// Underscore
			wp_enqueue_script('underscore');

			// Manage cookies
			if ( (get_theme_mod('campaign_bar',false) == true && get_theme_mod('campaign_bar_dismissible',true) == true) || get_theme_mod('popup_modal',false) == true ) {
			wp_enqueue_script( 'cookie',  BELCTECH_ASSET_JS . '/vendor/jquery.cookie.min.js', array( 'jquery' ), '1.4.1');
			}
			// Check for new/deleted DOM elements
				if ( function_exists( 'is_woocommerce' ) && ( is_woocommerce() || is_cart() || is_checkout() ) ) {
					wp_enqueue_script( 'arrive', BELCTECH_ASSET_JS . '/vendor/arrive.min.js', array( 'jquery' ), '2.4.1', true );
				}
			// Mobile menu
			if ( get_theme_mod('mobile_menu_type', 'sliding') == 'sliding') {
				wp_enqueue_script( 'sliding-menu',  BELCTECH_ASSET_JS . '/vendor/sliding-menu.min.js', array( 'jquery' ), '0.2.1', TRUE);
			}
			// Comments
			if ( is_singular() AND comments_open() AND (get_option('thread_comments') == 1) ) {
				wp_enqueue_script('comment-reply');
			}
			// Theme Core Script
			if( belctech_wc_active() ) { // WooCommerce

				if ( belctech_needs_woocommerce_assets() ) {
					wp_enqueue_script( 'wc-cart-fragments' );
				}

				// Image zoom
				if ( belctech_meta_config('product','image_hover_zoom',false) == true && is_product() ) {
					wp_enqueue_script('easyzoom', BELCTECH_ASSET_JS . '/vendor/easyzoom.min.js', array('jquery'), '2.5.2', TRUE);
				}
				// Core App script
				$app_dependencies = array( 'jquery', 'underscore' );
				if ( belctech_needs_woocommerce_assets() ) $app_dependencies[] = 'wc-add-to-cart-variation';
				wp_enqueue_script('belctech-app', $script_path . 'belctech-app' . $suffix . '.js', $app_dependencies, BELCTECH_THEME_VERSION, TRUE);
			} else {
				// Core App script
				wp_enqueue_script('belctech-app', $script_path . 'belctech-app' . $suffix . '.js', array('jquery', 'underscore'), BELCTECH_THEME_VERSION, TRUE);
			}

			// Run animations when belctech-app is delayed
			if ( apply_filters('belctech_load_animations_script', false) == true ) {
				wp_enqueue_script('belctech-animations', BELCTECH_ASSET_JS . '/belctech-animations.min.js', '', BELCTECH_THEME_VERSION, TRUE);
			}

			// Theme variables
			$is_checkout = belctech_wc_active() ? belctech_is_real_checkout() : false;

			wp_localize_script( 'belctech-app', 'belctech_theme_vars', array(
				'ajaxUrl' => admin_url( 'admin-ajax.php' ),
				'l10n' => array (
					'back' => esc_html__( 'Volver', 'belctech-ecommerce' ),
					'view_cart' => esc_html__( 'Ver carrito', 'belctech-ecommerce' )
				),
				'icons' => array(
					'prev_arrow' => belctech_load_template_part('assets/img/svg/chevron-left.svg'),
					'next_arrow' => belctech_load_template_part('assets/img/svg/chevron-right.svg'),
				),
				'settings' => array (
					'current_url' => get_permalink(),
					'site_url' => site_url(),
					'pageLoadTransition' => belctech_meta_config('','page_transition',false),
					'ajaxSearchActive' => get_theme_mod( 'ajax_search', true ),
					'ajaxAddToCartSingle' => apply_filters('belctech_ajax_atc_single_product', get_theme_mod( 'product_single_ajax_addtocart', true )),
					'cart_icon' => get_theme_mod( 'header_cart_icon_function', 'mini-cart' ),
					'minicart_auto' => get_theme_mod( 'open_minicart_automatically', true ),
					'shop_infinite_load' => belctech_meta_config('shop','infinite_load','button'),
					'shop_update_url' => apply_filters( 'belctech_shop_ajax_update_url', false ),
					'ajaxWishlistCounter' => get_theme_mod( 'ajax_wishlist_counter', false ),
					'YITH_WCWL_Premium' => class_exists('YITH_WCWL_Premium') ? true : false,
					'posts_per_page' => get_option('posts_per_page'),
					'related_slider' => get_theme_mod( 'product_upsell_related_slider', true ),
					'popup_length' => get_theme_mod( 'popup_frequency', 1 ),
					'is_front_page' => is_front_page(),
					'is_blog'  => belctech_is_blog(),
					'is_cart'  => belctech_wc_active() ? is_cart() : false,
					'is_checkout' => $is_checkout,
					'checkoutTermsPopup' => get_theme_mod( 'checkout_terms_popup', true ),
					'single_atc_nonce' => wp_create_nonce( 'belctech-add-to-cart' ),
					'facebook4WC' => apply_filters( 'belctech_wc_facebook_ajax_atc', in_array('facebook-for-woocommerce/facebook-for-woocommerce.php', apply_filters('active_plugins', get_option('active_plugins'))) ),
				),
			) );
		}
	}
	add_action('wp_enqueue_scripts', 'belctech_scripts');

/* Admin Assets
---------------------------------------------------------- */

	/* Load admin assets */
	function belctech_admin_assets( $hook ) {
		$theme_screens = array( 'post.php', 'post-new.php', 'nav-menus.php', 'term.php', 'edit-tags.php', 'widgets.php', 'customize.php' );
		if ( in_array( $hook, $theme_screens, true ) ) {
			wp_enqueue_style( 'belctech-admin-css', BELCTECH_ASSET_CSS . '/admin/admin.min.css', null, BELCTECH_THEME_VERSION);
		}

		if ( in_array( $hook, array( 'post.php', 'post-new.php' ) ) ) {

			// Gutenberg styles
			wp_enqueue_style( 'belctech-gutenberg', BELCTECH_ASSET_CSS . '/admin/gutenberg.css', false, BELCTECH_THEME_VERSION, 'all' );
			wp_add_inline_style( 'belctech-gutenberg', belctech_gutenberg_styles() );

			wp_enqueue_style( 'wp-color-picker' );

			// WP Bakery styles
			if (class_exists('WPBakeryVisualComposerAbstract')) {
				wp_enqueue_style( 'belctech-admin-vc-css', BELCTECH_ASSET_CSS . '/admin/admin-vc.min.css', null, BELCTECH_THEME_VERSION);
				wp_enqueue_script( 'belctech-admin-vc', BELCTECH_ASSET_JS . '/admin/admin-vc.min.js', array('jquery'), BELCTECH_THEME_VERSION);
			}

		}

		if ( in_array( $hook, array( 'post.php', 'post-new.php', 'nav-menus.php', 'term.php' ) ) ) {

			// General JS scripts
			wp_enqueue_script( 'belctech-admin-general', BELCTECH_ASSET_JS . '/admin/admin-general.min.js', array( 'jquery', 'wp-color-picker' ), BELCTECH_THEME_VERSION, true );
		}

	}
	add_action( 'admin_enqueue_scripts', 'belctech_admin_assets' );


	/* Load assets on login page */
	function belctech_wp_login_assets( $hook ) {
		// Admin CSS
		wp_enqueue_style( 'belctech-admin-css', BELCTECH_ASSET_CSS . '/admin/admin.min.css', null, BELCTECH_THEME_VERSION);
		// Theme icon font
		wp_enqueue_style( 'belctech-icons', BELCTECH_ASSET_ICON . '/theme-icons/style.css', array(), BELCTECH_THEME_VERSION, 'all' );
	}
	add_action( 'login_enqueue_scripts', 'belctech_wp_login_assets' );


	/* WooCommerce */
	add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );


	/* Shortcode inline styles
	---------------------------------------------------------- */

	function belctech_enqueue_shortcodes_styles() {

		wp_register_style('belctech-shortcodes-styles', false); // Register handle
		wp_enqueue_style('belctech-shortcodes-styles');
		wp_add_inline_style('belctech-shortcodes-styles', Belctech_Layout::get_shortcodes_css_buffer(false));

	}

	add_action('wp_footer', 'belctech_enqueue_shortcodes_styles');


	class Belctech_Layout {

		static private $dynamic_shortcodes_css_buffer_code = array();

		// Show or return dynamic CSS code
		static function get_shortcodes_css_buffer( $print = false ) {
			if ( $print ) {
				echo implode( '', self::$dynamic_shortcodes_css_buffer_code );
				return true;
			} else {
				return implode( '', self::$dynamic_shortcodes_css_buffer_code );
			}
		}

		// Shortcodes dynamic CSS to buffer code
		static function append_to_shortcodes_css_buffer( $append_string = '' ) {
			$append_string = trim( $append_string );
			if ( strlen( $append_string ) == 0 ) { return false; }
			$append_array = preg_split( "/((\r?\n)|(\r\n?))/", $append_string );
			$new_append_string = '';
			foreach( $append_array as $index => $append_line ){
				$append_line = trim( $append_line );
				if ( strlen( $append_line ) == 0 ) { continue; }
				$new_append_string .= $append_line;
			}
			self::$dynamic_shortcodes_css_buffer_code[] = $new_append_string;
			return true;
		}

	}



	/* Default font
	---------------------------------------------------------- */

	function belctech_has_default_font() {

		$main_font_family = $second_font_family = '';

		if ( get_theme_mod('main_font_source', '1') == '1' ) {
			$main_font = get_theme_mod( 'main_font', array() );
			$main_font_family = isset($main_font['font-family']) ? $main_font['font-family'] : '';
		}
		if ( get_theme_mod('second_font_source', '0') == '1' ) {
			$second_font = get_theme_mod( 'second_font', array() );
			$second_font_family = isset($second_font['font-family']) ? $second_font['font-family'] : '';
		}

		if ($main_font_family == '' || $main_font_family == 'Jost, sans-serif' || $second_font_family == 'Jost, sans-serif') {
			return true;
		} else {
			return false;
		}

	}


	/* Clean CSS inline styles
	---------------------------------------------------------- */

		function belctech_clean_custom_css($styles) {

			// Remove comments
			$styles = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $styles);
			// Remove space after colons
			$styles = str_replace(': ', ':', $styles);
			// Remove whitespace
			$styles = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $styles);

			return $styles;

		}


	/* Deregister unnecessary styles
		---------------------------------------------------------- */

		function belctech_deregister_styles() {

			// From YITH Wishlist
			// It may cause a warning in Query Monitor because it has other dependencies.
			//wp_deregister_style( 'yith-wcwl-font-awesome' );


		}
		add_action( 'wp_print_styles', 'belctech_deregister_styles', 100 );

