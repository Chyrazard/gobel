<?php

/* Theme Support
---------------------------------------------------------- */

if ( ! function_exists( 'belctech_theme_setup' ) ) {
	function belctech_theme_setup() {

		/* Background Support */
		add_theme_support( 'custom-background', array( 'default-color' => 'ffffff', 'wp-head-callback' => 'belctech_change_custom_background' ) );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 80,
			'width'       => 200,
			'flex-width' => true,
		) );

		/* Post Formats */
		add_theme_support('post-formats', array('video', 'image', 'gallery'));

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );


		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		// Gutenberg: Color Pallete
		add_theme_support( 'editor-color-palette', array(
			array(
				'name' => esc_html__( 'White', 'belctech-ecommerce' ),
				'slug' => 'gutenberg-white',
				'color' => '#ffffff',
			),
			array(
				'name' => esc_html__( 'Shade', 'belctech-ecommerce' ),
				'slug' => 'gutenberg-shade',
				'color' => '#f8f8f8',
			),
			array(
				'name' => esc_html__( 'Gray', 'belctech-ecommerce' ),
				'slug' => 'gutenberg-gray',
				'color' => esc_html( get_theme_mod( 'main_font_color', '#777777' ) ),
			),
			array(
				'name' => esc_html__( 'Dark', 'belctech-ecommerce' ),
				'slug' => 'gutenberg-dark',
				'color' => esc_html( get_theme_mod( 'primary_buttons', '#282828' ) ),
			),
			array(
				'name' => esc_html__( 'Accent', 'belctech-ecommerce' ),
				'slug' => 'gutenberg-accent',
				'color' => esc_html( get_theme_mod( 'accent_color', '#b9a16b' ) ),
			),
		) );


		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'script',
				'style'
			)
		);


		/* Image Settings */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 150, 150, false );

		/* WooCommerce Support */
		add_theme_support( 'woocommerce');

		/* WooCommerce gallery */
		add_theme_support( 'wc-product-gallery-slider' );

		if ( get_theme_mod('product_image_lightbox', true) == true ) {
			add_theme_support( 'wc-product-gallery-lightbox' );
		}

		/* Disable WooCommerce wizard redirection */
		add_filter( 'woocommerce_prevent_automatic_wizard_redirect', '__return_true' );

		/* Register Menus */
		add_theme_support('nav-menus');
		register_nav_menus(
			array(
				'primary-menu'    => esc_html__( 'Main', 'belctech-ecommerce' ),
				'topbar-menu'     => esc_html__( 'Top Bar', 'belctech-ecommerce' ),
				'secondary-menu'  => esc_html__( 'Secondary', 'belctech-ecommerce' ),
				'fullscreen-menu' => esc_html__( 'Off-Canvas', 'belctech-ecommerce' ),
				'mobile-menu'     => esc_html__( 'Mobile', 'belctech-ecommerce' ),
				'footer-menu'     => esc_html__( 'Footer', 'belctech-ecommerce' )
			)
		);

	}
}

add_action( 'after_setup_theme', 'belctech_theme_setup' );



/* Load theme textdomain */

function belctech_load_textdomain() {
	load_theme_textdomain( 'belctech-ecommerce', get_template_directory() . '/languages' );

	// Loads wp-content/languages/themes/belctech-it_IT.mo.
	load_theme_textdomain( 'belctech-ecommerce', trailingslashit( WP_LANG_DIR ) . 'themes' );

	// Loads wp-content/themes/child-theme-name/languages/it_IT.mo.
	load_theme_textdomain( 'belctech-ecommerce', get_stylesheet_directory() . '/languages' );

	// Loads wp-content/themes/belctech/languages/it_IT.mo.
	load_theme_textdomain( 'belctech-ecommerce', get_template_directory() . '/languages' );

}

add_action( 'init', 'belctech_load_textdomain' );


/* Required Settings */
if ( ! isset( $content_width ) ) {
	$content_width = 1140; /* pixels */
}

/* Set default image-size options
---------------------------------------------------------- */

	if ( ! function_exists( 'belctech_woocommerce_set_image_dimensions' ) ) {
		function belctech_woocommerce_set_image_dimensions() {

			if( ! belctech_wc_active() ) {
				return;
			}

			if ( ! get_option( 'belctech_shop_image_sizes_set' ) ) {

				// Shop image sizes
				if ( defined( 'WC_VERSION' ) && version_compare( WC_VERSION, '3.3', '<' ) ) {
					// WooCommerce 3.2 and below: Set image-size options
					$catalog = array(
						'width'	=> '600',
						'height'	=> '',
						'crop'		=> ''
					);
					$single = array(
						'width'	=> '900',
						'height'	=> '',
						'crop'		=> ''
					);
					$thumbnail = array(
						'width'	=> '',
						'height'	=> '150',
						'crop'		=> ''
					);
					update_option( 'shop_catalog_image_size', $catalog );
					update_option( 'shop_single_image_size', $single );
					update_option( 'shop_thumbnail_image_size', $thumbnail );

				} else {
					// WooCommerce 3.3 and above: Set WP Customizer image-size options
					update_option( 'woocommerce_thumbnail_image_width', 600 );
					update_option( 'woocommerce_thumbnail_cropping', 'uncropped' );
					update_option( 'woocommerce_single_image_width', 900 );
				}

				// Set "image sizes set" option
				add_option( 'belctech_shop_image_sizes_set', '1' );
			}
		}
	}
	add_action( 'after_switch_theme', 'belctech_woocommerce_set_image_dimensions', 1 ); // Theme activation hook
	add_action( 'admin_init', 'belctech_woocommerce_set_image_dimensions', 1000 ); // Additional hook for when WooCommerce is activated after the theme


/* Body Classes
---------------------------------------------------------- */

function belctech_body_classes( $classes ) {

	// Blog ID on Multisite
	$classes[] = 'blog-id-' . get_current_blog_id();
	// Site Layout
	$site_layout = get_theme_mod('site_global_layout', 'regular');
	if ($site_layout != 'regular') {
		$classes[] = 'et-site-layout-' . $site_layout;
	}
	// WP Gallery Popup
	$classes[] = ( get_theme_mod('wp_gallery_popup', false) == true ) ? 'wp-gallery-popup' : '';
	// Campaign bar
	$cookie_campaign = isset($_COOKIE['et-global-campaign']) ? wp_unslash($_COOKIE['et-global-campaign']) : false;
	if(!$cookie_campaign) {
		$classes[] = get_theme_mod('campaign_bar', false) ? 'has-campaign-bar' : false;
	}
	// Top Bar
	$classes[] = ( belctech_meta_config('','top_bar',false) == true ) ? 'has-top-bar' : '';
	// Sticky header
	$header_sticky = get_theme_mod('header_sticky',true);
	$classes[] = ( $header_sticky == true ) ? 'header-sticky' : '';
	// Header full width
	$classes[] = ( get_theme_mod('header_full_width', false) == true ) ? 'header-full-width' : '';
	// Buttons, borders
	$border_style = get_theme_mod('elements_border_style','all');
	if ($border_style != 'all') {
		$classes[] = 'el-style-border-' . $border_style;
	}
	$border_width = get_theme_mod('elements_border_width', 2);
	if ($border_width != 2) {
		$classes[] = 'el-style-border-width-' . $border_width;
	}
	$theme_lazy = apply_filters('belctech_do_lazyload', get_theme_mod('lazy_load',false));
	if ($theme_lazy === true ) {
		$classes[] = 'belctech-lazyload';
	}
	// Labels
	$classes[] = ( get_theme_mod('elements_floating_labels',true) == true ) ? 'floating-labels' : '';
	// Page load transition
	$page_transition = belctech_meta_config('','page_transition',false);
	if ($page_transition == true) {
		$classes[] = 'et-page-load-transition-true';
		// CSS animations preload class
		$classes[] = 'et-preload';
	}
	// Distraction Free Checkout
	if ( belctech_wc_active() && is_checkout() && !is_wc_endpoint_url( 'order-pay' ) && !is_wc_endpoint_url( 'order-received' ) ) {
		$checkout_style = belctech_meta_config('','checkout_style','free');
		$classes[] = ( $checkout_style == 'regular' ) ? 'checkout-style-regular' : 'checkout-distraction-free';
	}
	// Login/Register two columns
	$classes[] = ( belctech_meta_config('','login_two_columns', false ) == true ) ? 'login-two-columns' : 'login-single-column';
	if ( belctech_wc_active() && !is_user_logged_in() && is_account_page() ) {
		$classes[] = 'et-woocommerce-account-login';
	}
	if ( belctech_wc_active() && !is_user_logged_in() && !is_account_page() && get_theme_mod( 'main_header_login_popup', false ) == true ) {
		$classes[] = 'et-login-popup';
	}

	// Add extra classes for header styles
	$body_classes = array_filter( array_merge($classes, belctech_header_styles() ) );

	return $body_classes;
}
add_filter( 'body_class', 'belctech_body_classes' );


/* WordPress checks
---------------------------------------------------------- */

/* Check if it's a Blog page */
function belctech_is_blog () {
	return ( is_archive() || is_author() || is_category() || is_home() || is_single() || is_tag()) && 'post' == get_post_type();
}

/* Check if WooCommerce is active */
function belctech_wc_active() {
	return class_exists( 'woocommerce' );
}

/*Check if it's a WooCommerce page*/
function belctech_is_woocommerce() {
	if (!belctech_wc_active()) {
		return false;
	}

	$woocommerce = false;

	if ( is_woocommerce() || is_cart() || is_checkout() || is_account_page() ) {
		$woocommerce = true;
	}

	return $woocommerce;

}


/* Menu Caching
---------------------------------------------------------- */

function belctech_get_cached_menu( $menuargs ) {

	if ( !isset( $menuargs['menu'] ) ) {
		$theme_locations = get_nav_menu_locations();
		$nav_menu_selected_id = $theme_locations[$menuargs['theme_location']];
		$termslug = get_term_by( 'id', $nav_menu_selected_id, 'nav_menu' );
		$transient = 'menu_' . $termslug->slug . '_transient';
	} else {
		$transient = 'menu_' . $menuargs['menu'] . '_transient';
	}

	if ( !get_transient( $transient ) ) { // check if the menu is already cached
		$menuargs['echo'] = '0'; // set the output to return
		$this_menu = wp_nav_menu( $menuargs ); // build the menu with the given $menuargs
		echo esc_attr( $this_menu ); // output the menu for this run
		set_transient( $transient, $this_menu ); // set the transient, where the build HTML is saved
	} else {
		echo get_transient( $transient ); // just output the cached version
	}

}


/* Custom Background Support
---------------------------------------------------------- */

function belctech_change_custom_background() {
	$background = get_background_image();
	$color = get_background_color();

	if ( ! $background && ! $color )
		return;

	$style = $color ? "background-color: #$color;" : '';

	if ( $background ) {
		$image = " background-image: url('".esc_html($background)."');";

		$repeat = get_theme_mod( 'background_repeat', 'repeat' );
		if ( ! in_array( $repeat, array( 'no-repeat', 'repeat-x', 'repeat-y', 'repeat' ) ) )
			$repeat = 'repeat';
		$repeat = " background-repeat: $repeat;";

		$position = get_theme_mod( 'background_position_x', 'left' );
		if ( ! in_array( $position, array( 'center', 'right', 'left' ) ) )
			$position = 'left';
		$position = " background-position: top $position;";

		$attachment = get_theme_mod( 'background_attachment', 'scroll' );
		if ( ! in_array( $attachment, array( 'fixed', 'scroll' ) ) )
			$attachment = 'scroll';
		$attachment = " background-attachment: $attachment;";

		$style .= $image . $repeat . $position . $attachment;
	}
?>
<style type="text/css">
body.custom-background #wrapper { <?php echo trim( $style ); ?> }
</style>
<?php
}


/* Gradient Generation */
function belctech_css_gradient( $color_start, $color_end, $angle = -32, $full = true ) {

	$return = 'linear-gradient( ' . str_replace( 'deg', '', $angle ) . 'deg,' . esc_attr( $color_end ) . ',' . esc_attr( $color_start ) . ' )';

	if ( $full == true ) {
		return 'background:' . $color_start . ';background:' . $return . ';';
	}

	return $return;
}

/* Utilities
---------------------------------------------------------- */

/* Get config values */
function belctech_meta_config( $type, $param, $default ) {

	$type = ($type) ? $type . '_' : '';
	$value = get_theme_mod($type . $param, $default);

	$post_meta = get_post_meta(get_queried_object_id(), 'belctech_'. $type . $param, true);

	if ($post_meta) {
		$value = $post_meta;
	}

	$url_param = apply_filters( 'belctech_config_url_params', false );

	if ($url_param == true ) {
		if (isset($_GET[$param]) ) {
			$value = sanitize_key(wp_unslash($_GET[$param]));
		}
	}

	return $value;
}

/* Add Shortcode */
function belctech_add_short( $name, $call ) {
	$func = 'add' . '_shortcode';
	return $func( $name, $call );
}

/* Load Template */
function belctech_load_template_part($template_name) {
	ob_start();
	get_template_part($template_name);
	$var = ob_get_contents();
	ob_end_clean();
	return $var;
}

/* Encoding/Decoding */
function belctech_encode( $value ) {
	$func = 'base64' . '_encode';
	return $func( $value );
}

function belctech_decode( $value ) {
	$func = 'base64' . '_decode';
	return $func( $value );
}


/* Use custom context for wp_kses */
function belctech_prefix_kses_allowed_html($tags, $context) {

	switch($context) {

		case 'essentials':
			$tags = array(
				'a'      => array( 'style' => array(), 'class' => array(), 'href'  => array(), 'target'  => array(), 'rel'  => array(), 'title' => array() ),
				'b'      => array( 'style' => array() ),
				'strong' => array( 'style' => array() ),
				'em'     => array( 'style' => array() ),
				'p'      => array( 'style' => array() ),
				'h1'     => array( 'style' => array() ),
				'h2'     => array( 'style' => array() ),
				'h3'     => array( 'style' => array() ),
				'h4'     => array( 'style' => array() ),
				'h5'     => array( 'style' => array() ),
				'h6'     => array( 'style' => array() ),
				'small'  => array( 'style' => array() ),
				'i'      => array( 'style' => array(), 'class' => array() ),
				'span'   => array( 'style' => array(), 'class' => array() ),
				'ol'     => array( 'style' => array(), 'class' => array() ),
				'ul'     => array( 'style' => array(), 'class' => array() ),
				'li'     => array( 'style' => array() ),
				'img'    => array( 'src'   => array(), 'class' => array(), 'width' => array(), 'height' => array(), 'alt' => array() ),
				'code'   => array(),
				'br'     => array(),
			);
			return $tags;

		default:
			return $tags;
	}
}

add_filter( 'wp_kses_allowed_html', 'belctech_prefix_kses_allowed_html', 10, 2);


/* Search
---------------------------------------------------------- */

/* Header Search Box */
function belctech_quick_search() {
	do_action( 'belctech_quick_search_button' );
}
add_action( 'belctech_quick_search', 'belctech_quick_search' );


/* Search field */
function belctech_search_box() { ?>
	<div class="belctech-search">
		<?php if( belctech_wc_active() ) {
			if ( defined( 'YITH_WCAS' ) ) {
				// YITH WC Ajax Search plugin
				echo do_shortcode('[yith_woocommerce_ajax_search]');
			} else {
				get_product_search_form();
			}
		} else {
			get_search_form();
		} ?>
	</div>
<?php }

add_action( 'belctech_search_box', 'belctech_search_box' );

/* Search button */
function belctech_quick_search_button() {
	$search_popup = get_theme_mod('search_popup',true);
	$search_mobiles = get_theme_mod('search_mobiles','header_icon');
	?>
	<a href="#" class="quick_search icon popup-<?php echo esc_attr( $search_popup ); ?> search-<?php echo esc_attr( $search_mobiles ); ?>" aria-label="<?php esc_html_e('Search', 'belctech-ecommerce' ); ?>"><span class="text"><?php esc_html_e('Search', 'belctech-ecommerce' ); ?></span> <?php echo apply_filters( 'belctech_search_icon', belctech_load_template_part('assets/img/svg/search.svg') ); ?></a>
	<?php
}
add_action( 'belctech_quick_search_button', 'belctech_quick_search_button' );


/* Social
---------------------------------------------------------- */

function belctech_social_share() {
	if ( function_exists( 'belctech_social_share_links' ) ) {?>
		<div class="post-share">
			<?php belctech_social_share_links(); // From plugin belctech-core  ?>
		</div>
	<?php }
}

add_action( 'belctech_social_share', 'belctech_social_share' );


/* Get social media profiles list */
function belctech_social_profiles( $wrapper_class = 'social-icons-default' ) {

	$socials = get_theme_mod('social_links', array());

	$output = '';
	foreach( $socials as $social ) {
		if (!empty ($social['name']) && !empty($social['url'])) {
			if ($social['name'] == 'twitter' && !apply_filters('belctech_use_twitter_bird_logo', false)) {
				$social['name'] = 'x';
			}
			$output .= '<li><a href="' . esc_url( $social['url'] ) . '" target="_blank" data-toggle="tooltip" data-placement="left" aria-label="' . esc_attr( ucfirst($social['name']) ) . '"><span class="et-icon et-' . esc_attr( $social['name'] ) . '"></span></a></li>';
		}
	}

	$output = apply_filters( 'social_icons_items', $output );

	return '<ul class="social-icons ' . $wrapper_class . '">' . $output . '</ul>';

}

/* Remove intrusive advertising
---------------------------------------------------------- */

add_filter( 'stop_gwp_live_feed', '__return_true' );


/* Disable Portfolio post type
---------------------------------------------------------- */

add_action('init','belctech_disable_portfolio');

function belctech_disable_portfolio(){
	$portfolio = get_theme_mod('portfolio_post_type', true);

	if ( apply_filters('belctech_disable_portfolio', false) == true ) {
		$portfolio = false;
	}

	if ( ! $portfolio == true ) {
		unregister_post_type( 'portfolio' );
	}

}


/* Password Protected Page
---------------------------------------------------------- */

function belctech_password_protected_page_wrapper($form) {
	$output = '<div class="container">
						<div class="product-header-spacer"></div>';
	$output .= $form;
	$output .= '</div>';

	return $output;
}
add_filter('the_password_form', 'belctech_password_protected_page_wrapper', 99);


/* WP Rocket compatibility
---------------------------------------------------------- */

// Add belctech-animations.min.js to list of exclusions
add_filter('rocket_delay_js_exclusions', 'belctech_add_delay_js_exclusions');
function belctech_add_delay_js_exclusions($exclusions) {
	$exclusions[] = 'belctech-animations.min.js';
	return $exclusions;
}

// Load animations.min.js
add_filter('belctech_load_animations_script', 'belctech_wprocket_exclude_animations');
function belctech_wprocket_exclude_animations($animations=false) {
	$wp_rocket_settings = get_option( 'wp_rocket_settings', [] );
	if (isset( $wp_rocket_settings['delay_js'] ) && 1 === (int) $wp_rocket_settings['delay_js']) {
		$animations = true;
	}
	return $animations;
}

// Disable theme lazyload if another method already exists
add_filter('belctech_do_lazyload', 'belctech_check_if_lazyload_exists');
function belctech_check_if_lazyload_exists($lazy) {
	$wp_rocket_settings = get_option( 'wp_rocket_settings', [] );
	if (class_exists( 'WP_Rocket_Requirements_Check' ) && isset( $wp_rocket_settings['lazyload'] ) && 1 === (int) $wp_rocket_settings['lazyload']) {
		$lazy = false;
	}
	if( class_exists( 'Jetpack' ) && in_array( 'lazy-images', Jetpack::get_active_modules() ) ) {
		$lazy = false;
	}
	if( class_exists( 'RevSliderFront' ) ) {
		$lazy = false;
	}
	return $lazy;
}

// Allow HTML in taxonomy term descriptions
foreach ( array( 'pre_term_description' ) as $filter ) {
	remove_filter( $filter, 'wp_filter_kses' );
	if ( ! current_user_can( 'unfiltered_html' ) ) {
		add_filter( $filter, 'wp_filter_post_kses' );
	}
}

foreach ( array( 'term_description' ) as $filter ) {
	remove_filter( $filter, 'wp_kses_data' );
}
