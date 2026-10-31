<?php

/* Header Styles
---------------------------------------------------------- */

function belctech_header_styles() {
	global $wp_query;
	global $wp;

	/* Header Color Scheme */
	$classes[] = '';
	$header_color = '';
	$page_header_border = belctech_meta_config('page','header_border',true);

	$is_sale_page = $wp_query->is_sale_page;
	$is_latest_page = $wp_query->is_latest_page;

	if ($is_sale_page) {
		$classes[] = 'onsale-products-page';
	}
	if ($is_latest_page) {
		$classes[] = 'latest-products-page';
	}

	// Account forms must always start below an opaque, regular header. This also
	// avoids inheriting the shop's transparent-header mode on registration/login.
	if ( belctech_is_woocommerce() && function_exists( 'is_account_page' ) && is_account_page() ) {
		$header_mode  = 'regular';
		$header_color = get_theme_mod( 'header_regular_mode', 'dark' ) . '-title';
		$classes[]    = 'header-border-0';

	// All Woocommerce pages but product page
	} else if ( belctech_is_woocommerce() && (! is_product() ) ) {

		$shop_hero_title = belctech_meta_config('shop','hero_title','none');
		$shop_header_border = belctech_meta_config('shop','header_border',true);
		$header_mode = belctech_meta_config('shop','transparent_header', true) == true ? 'transparent' : 'regular';
		$header_color = '';

		//Color mode of the hero title
		if ( $shop_hero_title != 'none' ) {

			$hero_style = belctech_meta_config('shop','menu_color','dark-title');

			// Sale, Latest pages
			if ( ( $is_sale_page || $is_latest_page ) && $shop_hero_title != 'main-hero') {
				$header_style = get_post_meta(get_queried_object_id(), 'belctech_page_header_style', true);
				$hero_s = get_post_meta(get_queried_object_id(), 'belctech_page_hero_title_style', true);

				if ($hero_s && $hero_s != '') {
					$hero_style = $hero_s;
				}
				if ($header_style && $header_mode == 'transparent') {
					$header_color = $header_style;
				}

			// Tax
			} else if ( is_tax() && $shop_hero_title != 'main-hero') {
				$term = get_queried_object();
				$term_id = $term->term_id;
				$hero_s = get_term_meta( $term_id, 'shop_menu_color_cat', true );

				if ($hero_s && $hero_s != '') {
					$hero_style = $hero_s;
				}
				if ($hero_style && $header_mode == 'transparent') {
					$header_color = $hero_style;
			}

			// All pages
			} else if ( $shop_hero_title == 'all-hero' && is_page() ) {

			$request = explode( '/', $wp->request );

			// Override options per page
			$transparent_header = get_post_meta(get_queried_object_id(), 'belctech_page_transparent_header', true);
			$header_style = get_post_meta(get_queried_object_id(), 'belctech_page_header_style', true);
			$title_style = get_post_meta(get_queried_object_id(), 'belctech_page_title_style', true);
			$hero_style = get_post_meta(get_queried_object_id(), 'belctech_page_hero_title_style', true);

			if (!is_user_logged_in() && is_account_page() && end($request) !== 'lost-password') {
				$header_mode = 'regular';
				$classes[] = 'header-border-' . $page_header_border;
			} else {

				if ($title_style == 'hero') {
					$classes[] = 'hero-' . $hero_style;
				} else {
					$classes[] = 'hero-' . belctech_meta_config('shop','menu_color','dark-title');
				}

				if($transparent_header == 'transparent') {
					$header_color = $header_style;
				} else if ($header_mode == 'transparent') {
					$header_color = $header_color = belctech_meta_config('shop','menu_color','dark-title');
				}
			}

			// Search
			} else if ( is_shop() && is_search() && $shop_hero_title != 'main-hero') {
				$header_color = belctech_meta_config('shop','menu_color','dark-title');

			// Shop
			} else if ( is_shop() && !is_search() && !$is_sale_page && !$is_latest_page && $header_mode == 'transparent') {
				$header_color = belctech_meta_config('shop','menu_color','dark-title');

		} else {
			$classes[] = 'header-border-' . $shop_header_border;
			$header_mode = 'regular';
		}

			$classes[] = 'hero-' . $hero_style;

		} else {
			$classes[] = 'header-border-' . $shop_header_border;
			$header_mode = 'regular';
				}

	// Single product page
	} else if ( belctech_is_woocommerce() && ( is_product() ) ) {

		$product_layout = belctech_meta_config('product','layout_single','regular');
		$is_showcase = ($product_layout == 'showcase') ? true : false;
		$transparent_header = belctech_meta_config('product','transparent_header',false);

		// To override one product only on the demo site
		$transparent_header_ex = belctech_meta_config('product','transparent_header_ex',false);

		if ($transparent_header_ex == 'border') {
			$transparent_header = false;
		}
		if ($is_showcase) {
			$transparent_header = apply_filters( 'belctech_showcase_transparent_header', true );
		}

		$shop_header_border = belctech_meta_config('shop','header_border',true);

		if ( $transparent_header == true ) {
			$single_prod_header = get_post_meta(get_queried_object_id(), 'belctech_product_header_style', true);
			$single_prod_transparent = get_post_meta(get_queried_object_id(), 'belctech_product_transparent_header', true);
			$global_prod_header = get_theme_mod('product_header_color', 'dark-title');

			$header_mode = 'transparent';
			$header_color = ($single_prod_header && $single_prod_transparent) ? $single_prod_header : $global_prod_header;
		} else {
			$classes[] = 'header-border-' . $shop_header_border;
			$header_mode = 'regular';
		}

		/* Showcase Background */
		$showcase_text = belctech_meta_config('product','showcase_style','dark-text');
		$classes[] = 'product-showcase-' . $showcase_text;

		/* Sticky product bar */
		if ( get_theme_mod( 'product_sticky_bar', true ) == true ) {
			$classes[] = 'fixed-product-bar';
			$classes[] = 'fixed-product-bar-' . get_theme_mod('product_sticky_bar_position', 'top' );
			if ( get_theme_mod('product_sticky_bar_mobile', false ) == true ) {
				$classes[] = 'fixed-product-bar-mobile-1';
			}
		}

	// Other pages
	} else if ( is_page() ) {

		$transparent_header = get_post_meta(get_queried_object_id(), 'belctech_page_transparent_header', true);
		$header_style = get_post_meta(get_queried_object_id(), 'belctech_page_header_style', true);
		$title_style = get_post_meta(get_queried_object_id(), 'belctech_page_title_style', true);
		$hero_style = get_post_meta(get_queried_object_id(), 'belctech_page_hero_title_style', true);

		if($title_style != 'hide') {
			$classes[] = 'page-title-visible';
		}

		if ($title_style == 'hero') {
			$classes[] = 'hero-title-active hero-' . $hero_style;
		}

		if ( $transparent_header == 'transparent' ) {
			$header_mode = 'transparent';
			$header_color = $header_style;
		} else {
			$header_mode = 'regular';
			$classes[] = 'header-border-' . $page_header_border;
		}

	// Single portfolio
	} elseif ( is_singular('portfolio') ) {

		$title_style = belctech_meta_config('portfolio','title_style','parallax');
		$header_style = get_theme_mod('portfolio_header_style','dark-title');
		$transparent_header = belctech_meta_config('portfolio','transparent_header',false);

		$title_style_meta = get_post_meta(get_queried_object_id(), 'belctech_portfolio_title_style', true);
		$header_style_meta = get_post_meta(get_queried_object_id(), 'belctech_portfolio_header_style', true);
		$transparent_header_meta = get_post_meta(get_queried_object_id(), 'belctech_portfolio_transparent_header', true);

		$hero_title_style = ($title_style_meta == false ) ? get_theme_mod('portfolio_header_style', 'dark-title') : get_post_meta(get_queried_object_id(), 'belctech_portfolio_hero_title_style', true);


		if($title_style != 'hide') {
			$classes[] = 'page-title-visible';
		}

		if ($title_style == 'hero' || $title_style == 'parallax') {
			$classes[] = 'hero-title-active hero-'.$hero_title_style;
		}

		if ( $transparent_header == true && ($title_style == 'hero' || $title_style == 'parallax') ) {
			$header_mode = 'transparent';
			if ($transparent_header_meta == 'transparent') {
				$header_color = $header_style_meta;
			} else {
				$header_color = $header_style;
			}
		} else {
			$header_mode = 'regular';
			$classes[] = 'header-border-' . $page_header_border;
		}

	// Knowledge Base
	} elseif ( is_singular('ht_kb') || is_post_type_archive('ht_kb') || is_tax('ht_kb_category') || is_tax('ht_kb_tag') || array_key_exists('ht-kb-search', $_REQUEST) ) {
		$header_mode = 'transparent';
		$classes[] = 'header-border-0';

	// Single post
	} elseif ( is_single() ) {

		$format = get_post_format();
		$feat_gallery = belctech_meta_config('post','featured_image','below');
		$transparent_header = belctech_meta_config('post','transparent_header',false);
		$hero_title = belctech_meta_config('blog','hero_title',false);
		$hero_title = false;
		$tcolor = get_post_meta(get_queried_object_id(), 'belctech_post_header_style', true);
		$title_color = (!empty($tcolor)) ? $tcolor : belctech_meta_config('post','menu_color','dark-title');

		if ( $transparent_header == true && ( ( $feat_gallery == 'parallax' && $format != 'video' ) || ( $hero_title == true && $feat_gallery == 'regular' ) ) ) {
			$header_mode = 'transparent';
			$header_color = $title_color;
		} else {
			$header_mode = 'regular';
			$classes[] = 'header-border-' . $page_header_border;
		}
		$classes[] = 'hero-' . $title_color;

	// Blog
	} elseif ( belctech_is_blog() ) {

		$hero_title = belctech_meta_config('blog','hero_title',false);
		$hero_style = belctech_meta_config('blog','menu_color','dark-title');
		$transparent_header = get_theme_mod('blog_transparent_header',false);

		$term = get_queried_object();
		if ($term && isset($term->term_id)) {
		$term_id = $term->term_id;
			$hero_s = get_term_meta( $term_id, 'shop_menu_color_cat', true );
		if ($hero_s && $hero_s != '') {
			$hero_style = $hero_s;
		}
		}

		if ($hero_title == true) {
			$classes[] = 'hero-title-active hero-' . $hero_style;
		}

		if ( $transparent_header == 'transparent' && $hero_title == true && !is_front_page()  ) {
			$header_mode = 'transparent';
			$header_color = $hero_style;
		} else {
			$header_mode = 'regular';
			$classes[] = 'header-border-' . $page_header_border;
		}

	// Everything else
	} else {
		$header_mode = 'regular';
		$classes[] = 'header-border-' . $page_header_border;
	}

	if ($header_color == '') {
		$header_color = get_theme_mod('header_regular_mode', 'dark') . '-title';
	}

	/* Sticky Header Color Scheme */
	$classes[] = 'sticky-header-' . get_theme_mod('header_regular_mode', 'dark');

	// Transparent header on mobiles
	$header_transparent_mobiles = get_theme_mod('header_transparent_mobiles',true);
	$classes[] = ( $header_transparent_mobiles == true ) ? 'header-transparent-mobiles' : '';


	if( belctech_wc_active() ) {
		//Catalog Mode
		$classes[] = ( get_theme_mod( 'shop_catalog_mode', false ) == true ) ? 'shop-catalog-mode' : '';

		if (class_exists('argMC\WooCommerceCheckout')) {
			$classes[] = 'woocommerce-multistep';
		}
	}

	// Header Mode
	$classes[] = apply_filters('belctech_page_header_mode','page-header-' . $header_mode);

	// Title Color
	$main_header_color = post_password_required() ? false : $header_color;
	$classes[] = apply_filters('belctech_page_header_color', $main_header_color);

	return $classes;
}

/* Header Classes
---------------------------------------------------------- */

function belctech_header_classes() {

	$header_layout = belctech_meta_config('','header_layout','prebuild');
	if ($header_layout != 'custom') {
		$version = belctech_meta_config('','header_version','v6');
		$header_layout = apply_filters( 'belctech_header_version_meta', $version );
	}

	$sticky_section = 'top';
	if (get_theme_mod('header_show_bottom', true) && $header_layout == 'custom') {
		$sticky_section = get_theme_mod('header_sticky_sections','top');
	}

	$classes[] = 'header site-header';
	$classes[] = 'header-'.$header_layout;
	$classes[] = 'sticky-display-' . $sticky_section;

	// Mega menu
	$classes[] = ( get_theme_mod('megamenu_fullwidth', true) == true ) ? 'megamenu-fullwidth' : '';
	$classes[] = ( get_theme_mod('megamenu_column_animation', false) == true ) ? 'megamenu-column-animation' : '';

	return $classes;
}

add_filter( 'belctech_header_class', 'belctech_header_classes' );


/* Site Logo
---------------------------------------------------------- */

/**
 * Return the VAAM wordmark bundled with the theme.
 *
 * Keeping this asset local makes every header preset safe on a fresh install
 * and avoids relying on the Media Library or an external URL for its fallback.
 */
function belctech_default_header_logo() {
	return BELCTECH_THEME_URI . '/assets/img/vaam-logo.svg';
}

/**
 * Prevent the retired bundled logo from resurfacing through legacy theme mods.
 *
 * Older releases used logo-light.png and logo-dark.png as their fallback. A
 * saved URL can survive a theme update, so it must be resolved here as well as
 * replacing the physical assets. Explicitly selected non-retired logos remain
 * fully supported.
 */
function belctech_resolve_header_logo( $logo, $use_default = true ) {
	if ( empty( $logo ) ) {
		return $use_default ? belctech_default_header_logo() : '';
	}

	$logo_url = is_numeric( $logo ) ? wp_get_attachment_url( (int) $logo ) : (string) $logo;
	$logo_url = rawurldecode( (string) $logo_url );
	$logo_path = (string) wp_parse_url( $logo_url, PHP_URL_PATH );
	$filename = strtolower( wp_basename( $logo_path ) );
	$is_legacy_theme_logo = in_array( $filename, array( 'logo-light.png', 'logo-dark.png' ), true )
		&& false !== strpos( strtolower( $logo_path ), '/assets/img/' );
	$is_retired_brand = false !== strpos( strtolower( $logo_url ), 'goya' );

	if ( $is_legacy_theme_logo || $is_retired_brand ) {
		return belctech_default_header_logo();
	}

	return $logo;
}

function belctech_site_logo_dimensions( $logo ) {
	static $cache = array();
	if ( isset( $cache[ $logo ] ) ) return $cache[ $logo ];
	$dimensions    = array();
	$attachment_id = attachment_url_to_postid( $logo );
	if ( $attachment_id ) {
		$metadata = wp_get_attachment_metadata( $attachment_id );
		if ( ! empty( $metadata['width'] ) && ! empty( $metadata['height'] ) ) {
			$dimensions = array( (int) $metadata['width'], (int) $metadata['height'] );
		} else {
			$file = get_attached_file( $attachment_id );
			if ( $file && is_readable( $file ) && 'svg' === strtolower( pathinfo( $file, PATHINFO_EXTENSION ) ) ) {
				$svg = file_get_contents( $file, false, null, 0, 4096 );
				if ( preg_match( '/viewBox=["\']\s*[-\d.]+\s+[-\d.]+\s+([\d.]+)\s+([\d.]+)\s*["\']/i', (string) $svg, $viewbox ) ) {
					$dimensions = array( (int) round( (float) $viewbox[1] ), (int) round( (float) $viewbox[2] ) );
				}
			}
		}
	}
	return $cache[ $logo ] = $dimensions;
}

function belctech_site_logo($logo,$color) {
	$logo = belctech_resolve_header_logo( $logo );
	$class = 'skip-lazy logoimg bg--'. esc_attr($color);
	$site_name = get_bloginfo( 'name' );

	if(is_string($logo)) { // Logo stored as string
		$logo = ( is_ssl() ) ? str_replace( 'http://', 'https://', $logo ) : $logo;
		$dimensions = belctech_site_logo_dimensions( $logo );
		$size = $dimensions ? ' width="' . esc_attr( $dimensions[0] ) . '" height="' . esc_attr( $dimensions[1] ) . '"' : '';
	echo '<img src="' . esc_url($logo) . '" class="skip-lazy logoimg bg--'. esc_attr($color) .'" alt="'. esc_attr($site_name) .'"' . $size . ' loading="eager" fetchpriority="high" decoding="async"/>';
	} else {
		echo wp_get_attachment_image($logo, 'full', false, array( 'class' => $class, 'alt' => $site_name, 'loading' => 'eager', 'fetchpriority' => 'high', 'decoding' => 'async' ));
	}
}


/* Page Transition
---------------------------------------------------------- */

function belctech_page_transition() {
	if ( belctech_meta_config('','page_transition',false) == false ) {
		return;
	}

	$loader = get_theme_mod( 'page_transition_style', 'dot3-loader' ); ?>

	<div id="et-page-load-overlay" class="et-page-load-overlay">
		<span class="loader">
			<?php if ($loader == 'custom-loader') { ?>
				<img src="<?php echo esc_attr( get_theme_mod( 'page_transition_icon', '' ) ); ?>" class="custom-loader" />
			<?php } else { ?>
				<span class="<?php echo esc_attr( $loader ); ?>"></span>
			<?php } ?>
		</span>
	</div>

<?php }

add_action( 'belctech_before_site', 'belctech_page_transition' );


/* Site Global Layout
---------------------------------------------------------- */

function belctech_site_layout() {
	if ( get_theme_mod('site_global_layout','regular') != 'framed' ) {
		return;
	}

	echo '<span class="frame-spacer line-top"></span><span class="frame-spacer line-right"></span><span class="frame-spacer line-bottom"></span><span class="frame-spacer line-left"></span>';

}

add_action( 'belctech_before_site', 'belctech_site_layout' );


/* Campaign Bar
---------------------------------------------------------- */

function belctech_campaigns() {
	if ( belctech_meta_config('','campaign_bar',false) == false ) {
		return;
	}

	get_template_part( 'inc/templates/header-parts/campaigns' );


}

add_action( 'belctech_before_site', 'belctech_campaigns', 99 );



/* Top Bar
---------------------------------------------------------- */

function belctech_topbar() {
	if ( belctech_meta_config('','top_bar',false) == false ) {
		return;
	}

	get_template_part( 'inc/templates/header-parts/top-bar' );
}

add_action( 'belctech_before_header', 'belctech_topbar' );



/* Top Bar Items
---------------------------------------------------------- */

function belctech_topbar_elements( $item ) {
	global $belctech;

	switch ( $item ) {
		case 'menu':
			if ( has_nav_menu( 'topbar-menu' ) ) {
				wp_nav_menu( array(
					'theme_location' => 'topbar-menu',
					'depth' => 1,
					'container' => false,
					'menu_class' => 'et-top-menu'
				) );
			}
			break;

		case 'social':
			echo belctech_social_profiles( 'top-bar-social-icons' );
			break;

		case 'currency':
			do_action( 'belctech_currency_switcher' );
			break;

		case 'language':
			do_action( 'belctech_language_switcher' );
			break;

		case 'hamburger':
			do_action( 'belctech_hamburger', 'fullscreen' );
			$belctech['panels'][] = 'hamburger';
			break;

		case 'wishlist':
			do_action( 'belctech_quick_wishlist' );
			break;

		case 'account':
			do_action( 'belctech_get_myaccount_link', true );
			$belctech['panels'][] = 'account';
			break;

		case 'search':
			do_action( 'belctech_quick_search' );
			$belctech['panels'][] = 'search';
			break;

		case 'search-box':
			do_action( 'belctech_search_box' );
			$template = '';
			break;

		case 'cart':
			if ( ! class_exists( 'WooCommerce' ) ) {
				break;
			}
			do_action( 'belctech_quick_cart' );
			$belctech['panels'][] = 'cart';
			break;

		case 'text':
			echo '<div class="et-top-bar-text text-1">' . do_shortcode( wp_kses( get_theme_mod('top_bar_text', ''), 'essentials' ) ) .'</div>';
			break;

		case 'text2':
			echo '<div class="et-top-bar-text text-2">' . do_shortcode( wp_kses( get_theme_mod('top_bar_text2', ''), 'essentials' ) ) .'</div>';
			break;

		case 'text3':
			echo '<div class="et-top-bar-text text-3">' . do_shortcode( wp_kses( get_theme_mod('top_bar_text3', ''), 'essentials' ) ) .'</div>';
			break;

		default:
			do_action( 'belctech_topbar_main_item', $item );
			break;
	}
}

/* Hamburger Menu */
function belctech_hamburger($menu) {
?>
	<div class="hamburger-menu">
		<button class="menu-toggle <?php echo esc_attr( $menu ) ?>-toggle" data-target="<?php echo esc_attr( $menu ) ?>-menu" aria-label="<?php esc_attr_e( 'Menu', 'belctech-ecommerce' ); ?>"><span class="bars"><?php echo apply_filters( 'belctech_menu_icon', belctech_load_template_part('assets/img/svg/menu.svg') ); ?></span> <span class="name"><?php esc_attr_e( 'Menu', 'belctech-ecommerce' ); ?></span></button>
	</div>
<?php }

add_action( 'belctech_hamburger', 'belctech_hamburger' );


/* Fullscreen menu check */
function belctech_load_menu_location($location) {

	if (has_nav_menu( $location )) {
		$menu = $location;
	} else if (has_nav_menu( 'primary-menu' )) {
		$menu = 'primary-menu';
	} else {
		$menu = false;
	}

	return $menu;
}


/* Header
---------------------------------------------------------- */


function belctech_header() {
	get_template_part( 'inc/templates/header/header-default' );
}

add_action( 'belctech_header', 'belctech_header' );


/* Header Layout
*/
function belctech_header_content() {
	if ( 'prebuild' == belctech_meta_config( '','header_layout','prebuild' ) ) {

		$version = belctech_meta_config( '','header_version','v6' );
		$header_version = apply_filters( 'belctech_header_version_meta', $version );

		$header_main = array();
		$header_bottom = array();

		switch ( $header_version ) {

			case 'v1':
				$elements   = array(
					'left'   => array('hamburger','menu-primary'),
					'center' => array('logo'),
					'right'  => array('account','search','wishlist','cart'),
				);
				break;

			case 'v2':
				$elements = array(
					'left'   => array('hamburger','search'),
					'center' => array('menu-primary','logo','menu-secondary'),
					'right'  => array('account','cart'),
				);
				break;

			case 'v3':
				$elements = array(
					'left'   => array('hamburger','search'),
					'center' => array('logo'),
					'right'  => array('account','cart'),
				);
				break;

			case 'v4':
				$elements = array(
					'left'  => array('hamburger','logo','menu-primary'),
					'right' => array('account','search','wishlist','cart'),
				);
				break;

			case 'v5':
				$elements = array(
					'left'  => array('hamburger','logo'),
					'right' => array('account','search','wishlist','cart'),
				);
				break;

			case 'v6':
				$elements = array(
					'left'   => array('hamburger','logo'),
					'center' => array('menu-primary'),
					'right'  => array('account','search','cart'),
				);
				break;

			case 'v7':
				$elements = array(
					'left'  => array('logo','menu-primary'),
					'right' => array('account','search','cart','hamburger'),
				);
				break;

			case 'v8':
				$elements = array(
					'left'  => array('logo','menu-primary'),
					'right' => array('account','search','cart'),
				);
				break;

			case 'v9':
				$elements = array(
					'left'   => array('hamburger','search'),
					'center' => array('logo'),
					'right'  => array('account','cart'),
				);
				$header_bottom = array(
					'center' => array(
						array( 'item' => 'menu-primary' ),
					),
				);
				break;

			default:
				break;
		}

		foreach($elements as $sec => $val) {
			unset($item);
			foreach($val as $el) {
				$item[] = array( 'item' => $el );
			}
			$header_main[$sec] = $item;
		}

	} else {

		$header_main = array(
			'left'   => belctech_meta_config( '','header_main_left','' ),
			'center' => belctech_meta_config( '','header_main_center','' ),
			'right'  => belctech_meta_config( '','header_main_right','' ),
		);

		$header_bottom = array(
			'left'   => belctech_meta_config( '','header_bottom_left','' ),
			'center' => belctech_meta_config( '','header_bottom_center','' ),
			'right'  => belctech_meta_config( '','header_bottom_right','' ),
		);

	}

	belctech_header_sections( apply_filters('belctech_header_elements_top', $header_main), 'header-main');
	if (!empty($header_bottom) && get_theme_mod('header_show_bottom', true)) {
		belctech_header_sections( apply_filters('belctech_header_elements_bottom', $header_bottom), 'header-bottom');
	}

}

add_action( 'belctech_header_inner', 'belctech_header_content' );


/* Header Contents
---------------------------------------------------------- */

function belctech_header_sections( $groups, $class ) {
	if ( false == array_filter( $groups ) ) {
		return;
	}

	$classes[] = $class;
	$classes[] = 'header-section';

	if ( empty( $groups['left'] ) && empty( $groups['right'] ) ) {
		unset( $groups['left'] );
		unset( $groups['right'] );
	}

	if ( ! empty( $groups['center'] ) ) {
		$center_items = wp_list_pluck( $groups['center'], 'item' );

		if ( in_array( 'menu-primary', $center_items ) || in_array( 'menu-secondary', $center_items ) ) {
			$classes[] = 'menu-center';
		}

		if ( in_array( 'logo', $center_items ) ) {
			$classes[] = 'logo-center';
		}

		if ( empty( $groups['left'] ) && empty( $groups['right'] ) ) {
			$classes[] = 'no-sides';
		}
	} else {
		$classes[] = 'no-center';
		unset( $groups['center'] );

		if ( empty( $groups['left'] ) ) {
			unset( $groups['left'] );
		}

		if ( empty( $groups['right'] ) ) {
			unset( $groups['right'] );
		}
	}

	?>
	<div class="<?php echo esc_attr( implode( ' ', $classes ) ) ?> ">
		<div class="header-contents container">
			<?php foreach ( $groups as $group => $items ) : ?>
				<div class="header-<?php echo esc_attr( $group ); ?>-items header-items">
					<?php belctech_header_items( $items ); ?>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
	<?php
}


/* Header Items
---------------------------------------------------------- */

function belctech_header_items( $items ) {
	global $belctech;

	if ( empty( $items ) ) {
		return;
	}

	foreach ( $items as $item ) {
		$item['item'] = $item['item'] ? $item['item'] : key( belctech_header_elements_list() );
		$template = $item['item'];

		switch ( $item['item'] ) {

			case 'hamburger':
				do_action( 'belctech_hamburger', 'fullscreen' );
				$template = '';
				$belctech['panels'][] = $item['item'];
				break;

			case 'account':
				do_action( 'belctech_get_myaccount_link', true );
				$template = '';
				$belctech['panels'][] = $item['item'];
				break;

			case 'wishlist':
				do_action( 'belctech_quick_wishlist' );
				$template = '';
				break;

			case 'search':
				do_action( 'belctech_quick_search' );
				$template = '';
				$belctech['panels'][] = $item['item'];
				break;

			case 'search-box':
				do_action( 'belctech_search_box' );
				$template = '';
				break;

			case 'cart':
				if ( ! class_exists( 'WooCommerce' ) ) {
					break;
				}
				do_action( 'belctech_quick_cart' );
				$template = '';
				$belctech['panels'][] = $item['item'];
				break;

			case 'text':
				echo '<div class="et-header-text text-1">' . do_shortcode( wp_kses( get_theme_mod('header_custom_text', ''), 'essentials' ) ) .'</div>';
				break;

			case 'text2':
				echo '<div class="et-header-text text-2">' . do_shortcode( wp_kses( get_theme_mod('header_custom_text2', ''), 'essentials' ) ) .'</div>';
				break;

			case 'text3':
				echo '<div class="et-header-text text-3">' . do_shortcode( wp_kses( get_theme_mod('header_custom_text3', ''), 'essentials' ) ) .'</div>';
				break;

			case 'social':
				echo belctech_social_profiles( 'header-social-icons' );
				break;

			case 'currency':
				do_action( 'belctech_currency_switcher' );
				break;

			case 'language':
				do_action( 'belctech_language_switcher' );
				break;

			default:
				do_action( 'belctech_header_items_action', $item['item'] );
				break;
		}

		if ( $template ) {
			get_template_part( 'inc/templates/header-parts/' . $template );
		}
	}
}


/* Vertical Panel Bar
---------------------------------------------------------- */

function belctech_vertical_panel_bar() {
	if ( belctech_meta_config('','vertical_bar',true) == true ) {

		$bar_mode = ( belctech_meta_config('','vertical_bar_mode', 'light') == 'dark' ) ? 'dark' : 'light';
		$bar_style = apply_filters( 'belctech_menu_style', $bar_mode );
		?>

		<div class="mobile-bar <?php echo esc_attr( $bar_style ) ?>">
			<button class="et-close" aria-label="<?php esc_attr_e('Close', 'belctech-ecommerce'); ?>"></button>

			<div class="action-icons">
				<?php do_action( 'belctech_vertical_bar_icons', 'vertical_bar' ); ?>
			</div>

		</div>

	<?php } else { ?>

		<header>
		<div class="container">
				<div class="panel-header-inner">
				<button class="et-close" aria-label="<?php esc_attr_e('Close', 'belctech-ecommerce'); ?>"></button>
				</div>
			</div>
		</header>

	<?php }

}

add_action( 'belctech_vertical_panel_bar', 'belctech_vertical_panel_bar', 99 );



/* Mobile Header
----------------------------------------------------------*/

/* Mobile Header/Vertical Bar  Icons */

function belctech_panel_header_icons($position) {
	global $belctech;

	if ($position == 'mobile_header') {
		$icons = get_theme_mod('mobile_header_icons', array( array( 'item' => 'cart' ) ));
		$is_header = true;
	} else {
		$icons = get_theme_mod('vertical_bar_icons', array( 'account', 'wishlist' ));
		$is_header = false;
	}

	if ( empty( $icons ) ) {
		return;
	}

	foreach ( $icons as $icon ) {
		if ($position == 'mobile_header') {
			$this_icon = $icon['item'] ? $icon['item'] : key( belctech_mobile_header_elements_list() );
		} else {
			$this_icon = $icon ? $icon : key( belctech_mobile_header_elements_list() );
		}

		switch ( $this_icon ) {
			case 'cart':
				if ( ! class_exists( 'WooCommerce' ) ) {
					break;
				}
				do_action( 'belctech_quick_cart' );
				$belctech['panels'][] = 'cart';
				break;

			case'wishlist':
				do_action( 'belctech_quick_wishlist' );
				break;

			case 'search':
				do_action( 'belctech_quick_search' );
				$belctech['panels'][] = 'search';
				break;

			case 'account':
				do_action( 'belctech_get_myaccount_link', $is_header );
				$belctech['panels'][] = 'account';
				break;

			case 'language':
				do_action( 'belctech_language_switcher' );
				break;

			case 'currency':
				do_action( 'belctech_currency_switcher' );
				break;

			case 'text':
				echo '<div class="et-mobile-header-text text-1">' . do_shortcode( wp_kses( get_theme_mod('header_mobile_custom_text', ''), 'essentials' ) ) .'</div>';
				break;

			default:
				do_action( 'belctech_mobile_header_icon', $this_icon );
				break;
		}
	}
}

add_action( 'belctech_mobile_header_icons', 'belctech_panel_header_icons' );
add_action( 'belctech_vertical_bar_icons', 'belctech_panel_header_icons' );


/* Mobile header */

function belctech_mobile_header() {
	$classes[] = 'logo-' . get_theme_mod('mobile_logo_position', 'center');
	?>

	<div class="header-mobile <?php echo esc_attr( implode( ' ', $classes ) ); ?>">
		<div class="header-contents container">
			<?php get_template_part( 'inc/templates/header/header', 'mobile' ); ?>
		</div>
	</div>

	<?php
}

add_action( 'belctech_header_inner', 'belctech_mobile_header', 99 );


/* Mobile menu */

function belctech_mobile_menu_extras() {
	global $belctech;

	$items = get_theme_mod('menu_mobile_items', array('account', 'divider1', 'currency', 'language', 'divider2', 'social') );

	foreach ( $items as $indx => $item ) {
		switch ( $item ) {

			case 'cart':
				if ( ! class_exists( 'WooCommerce' ) ) {
					break;
				}
				do_action( 'belctech_quick_cart' );
				$belctech['panels'][] = 'cart';
				break;

			case 'wishlist':
				do_action( 'belctech_quick_wishlist' );
				break;

			case 'account':
				if ( ! class_exists( 'WooCommerce' ) ) {
					break;
				}
				do_action( 'belctech_quick_account' );
				$belctech['panels'][] = 'account';
				break;

			case 'language':
				do_action( 'belctech_language_switcher' );
				break;

			case 'currency':
				do_action( 'belctech_currency_switcher' );
				break;

			case 'social':
				echo belctech_social_profiles( 'mobile-social-icons' );
				break;

			case 'divider1':
			case 'divider2':
			case 'divider3':
			case 'divider4':
				echo '<div class="menu-divider"></div>';
				break;

			case 'text':
				echo '<div class="et-mobile-text text-1">' . do_shortcode( wp_kses( get_theme_mod('menu_mobile_custom_text', ''), 'essentials' ) ) .'</div>';
				break;

			case 'text2':
				echo '<div class="et-mobile-text text-2">' . do_shortcode( wp_kses( get_theme_mod('menu_mobile_custom_text2', ''), 'essentials' ) ) .'</div>';
				break;

			case 'text3':
				echo '<div class="et-mobile-text text-3">' . do_shortcode( wp_kses( get_theme_mod('menu_mobile_custom_text3', ''), 'essentials' ) ) .'</div>';
				break;

			default:
				do_action( 'belctech_mobile_menu_items', $item );
				break;
		}
	}
}

add_action( 'belctech_after_mobile_menu', 'belctech_mobile_menu_extras' );
