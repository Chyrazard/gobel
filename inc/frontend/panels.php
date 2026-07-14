<?php

/* Popup */
function belctech_popup_modal() {

	$popup_modal = belctech_meta_config('','popup_modal',false);

	$belctech_popup = apply_filters( 'belctech_popup_modal', $popup_modal );

	if ($popup_modal) {

		$classes[] = 'popup-layout-' . belctech_meta_config('','popup_layout','1-col');
		$classes[] = belctech_meta_config('','popup_color_style','');

		if(!is_admin() && $belctech_popup ) {
			$popup_content = get_theme_mod( 'popup_content', '' );
			$popup_image = get_theme_mod( 'popup_image', '' );
			$delay = belctech_meta_config('','popup_delay', 3 ) * 1000;
		?>
			<aside id="belctech-popup" rel="inline-auto" class="mfp-hide mfp-automatic belctech-popup <?php echo implode(' ', $classes); ?>" data-class="belctech-popup" data-delay="<?php echo esc_attr( $delay ); ?>">
				<div class="popup-wrapper">
					<?php
					if ( strlen( $popup_image ) > 0 ) {
						$popup_image = ( is_ssl() ) ? str_replace( 'http://', 'https://', $popup_image ) : $popup_image;
					} ?>
					<div class="popup-image">
						<div class="image-wrapper" style="background-image: url(<?php echo esc_attr($popup_image); ?>)"><img src="<?php echo esc_attr($popup_image); ?>" alt="belctech-popup"></div>
					</div>
					<div class="popup-content">
						<div class="content-wrapper">
							<?php if ($popup_content) { echo do_shortcode( wp_kses_post( $popup_content ) ); } ?>
						</div>
					</div>
				</div>
			</aside>
			<?php
		}
	}
}
add_action( 'wp_footer', 'belctech_popup_modal' );


/* Mobile/Side Menu Panel*/
function belctech_mobile_menu() {

	get_template_part( 'inc/templates/header/mobile-menu' );

}
add_action( 'wp_footer', 'belctech_mobile_menu' );


/* FullScreen Menu Panel */

function belctech_fullscreen_panel() {

	global $belctech;

	$mobile_override = get_theme_mod('menu_fullscreen_override',false);

	if ( empty( $belctech['panels'] ) || ! in_array( 'hamburger', $belctech['panels'] ) || $mobile_override == true ) {
		return;
	}

	get_template_part( 'inc/templates/header/fullscreen-menu' );

}
add_action( 'wp_footer', 'belctech_fullscreen_panel' );


/* Mini Cart Panel */
function belctech_quick_cart_panel() {
	global $belctech;

	if ( empty( $belctech['panels'] ) || ! in_array( 'cart', $belctech['panels'] ) ) {
		return;
	}

	if ( ! class_exists( 'WooCommerce' ) ) {
		return;
	}

	$classes[] = 'side-panel mini-cart';
	$classes[] = belctech_meta_config('header', 'cart_position', 'side');
	$classes[] = belctech_meta_config('header', 'cart_color', 'light');

	if ( !is_cart() ) {
	?>
		<nav id="side-cart" class="<?php echo implode(' ', $classes); ?>">
			<header>
				<div class="container">
					<div class="panel-header-inner">
					<div class="side-panel-title"><?php echo apply_filters('belctech_minicart_panel_title', esc_html__('Cart', 'belctech-ecommerce' )); ?> <?php echo belctech_minicart_items_count(); ?></div>
					<button class="et-close" aria-label="<?php esc_attr_e('Close', 'belctech-ecommerce'); ?>"></button>
					</div>
				</div>
			</header>
			<div class="side-panel-content container widget_shopping_cart">
				<div id="minicart-loader">
					<span class="et-loader"><?php esc_html_e( 'Updating&hellip;', 'belctech-ecommerce' );?></span>
				</div>
				<div class="widget_shopping_cart_content">
					<?php woocommerce_mini_cart(); ?>
				</div>
			</div>
		</nav>
	<?php
	}
}
add_action( 'wp_footer', 'belctech_quick_cart_panel',3 );


/* Quick Login Panel*/

function belctech_quick_login_panel() {

	global $belctech;

	if ( empty( $belctech['panels'] ) || ! in_array( 'account', $belctech['panels'] ) ) {
		return;
	}

	if ( ! class_exists( 'WooCommerce' ) ) {
		return;
	}

	if ( get_theme_mod('main_header_login_popup', false) && ! is_user_logged_in() && ! is_account_page() ) {
		?>
	 <div id="et-login-popup-wrap" class="et-login-popup-wrap mfp-hide">
		<?php wc_get_template( 'myaccount/form-login.php', array( 'is_popup' => true ) ); ?>
	 </div>
	<?php
	}
}
add_action( 'wp_footer', 'belctech_quick_login_panel' );


/* Search Panel */

function belctech_quick_search_panel() {

	global $belctech;

	if ( empty( $belctech['panels'] ) || ! in_array( 'search', $belctech['panels'] ) ) {
		return;
	}

	?>

	<nav class="search-panel side-panel">
		<header>
			<div class="container">
				<div class="panel-header-inner">
					<div class="side-panel-title"><?php esc_html_e('Search', 'belctech-ecommerce' ); ?></div>
					<button class="et-close" aria-label="<?php esc_attr_e('Close', 'belctech-ecommerce'); ?>"></button>
				</div>
			</div>
		</header>
		<div class="side-panel-content container">
			<div class="row justify-content-md-center">
				<div class="col-lg-10">
					<?php belctech_search_box(); ?>
				</div>
			</div>
		</div>
	</nav>
	<?php
}
add_action( 'wp_footer', 'belctech_quick_search_panel' );


/* Quick View Panel: placeholder */

function belctech_quick_view_panel() {

	if ( get_theme_mod('product_quickview', true) == false ) {
		return;
	}
	?>
	<div id="et-quickview" class="clearfix"></div>
	<?php
}

add_action( 'wp_footer', 'belctech_quick_view_panel' );

