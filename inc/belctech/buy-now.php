<?php
/** Buy-now modal backed by the store's real WooCommerce checkout. */

defined( 'ABSPATH' ) || exit;

function belctech_buy_now_popup_enabled() {
	return function_exists( 'WC' )
		&& (bool) get_theme_mod( 'product_single_buy_now', true )
		&& (bool) get_theme_mod( 'product_buy_now_popup', true );
}

function belctech_buy_now_popup_supported_product( $product ) {
	$supported = $product instanceof WC_Product && $product->is_type( array( 'simple', 'variable' ) );
	return (bool) apply_filters( 'belctech_buy_now_popup_supported_product', $supported, $product );
}

function belctech_buy_now_needs_assets() {
	if ( ! belctech_buy_now_popup_enabled() || is_admin() ) return false;
	if ( function_exists( 'is_checkout' ) && is_checkout() ) return false;
	if ( function_exists( 'belctech_needs_woocommerce_assets' ) ) return belctech_needs_woocommerce_assets();
	return function_exists( 'is_woocommerce' ) && ( is_woocommerce() || is_cart() );
}

function belctech_buy_now_enqueue_assets() {
	if ( ! belctech_buy_now_needs_assets() ) return;

	$relative = defined( 'BELCTECH_SCRIPT_DEBUG' ) && BELCTECH_SCRIPT_DEBUG
		? 'assets/js/belctech-buy-now.js'
		: 'assets/js/belctech-buy-now.min.js';
	$path = BELCTECH_THEME_DIR . '/' . $relative;
	$version = file_exists( $path ) ? (string) filemtime( $path ) : BELCTECH_THEME_VERSION;

	wp_enqueue_script(
		'belctech-buy-now',
		BELCTECH_THEME_URI . '/' . $relative,
		array( 'jquery' ),
		$version,
		true
	);

	wp_localize_script( 'belctech-buy-now', 'belctech_buy_now_vars', array(
		'nonce' => wp_create_nonce( 'belctech-add-to-cart' ),
		'l10n'  => array(
			'loading'   => __( 'Cargando checkout seguro...', 'belctech-ecommerce' ),
			'error'     => __( 'No pudimos preparar la compra. Revisa las opciones del producto e intenta nuevamente.', 'belctech-ecommerce' ),
		),
	) );
}
add_action( 'wp_enqueue_scripts', 'belctech_buy_now_enqueue_assets', 30 );

function belctech_buy_now_prevent_cart_redirect( $url ) {
	if ( isset( $_REQUEST['belctech_buy_now_popup'] ) ) return false;
	return $url;
}
add_filter( 'woocommerce_add_to_cart_redirect', 'belctech_buy_now_prevent_cart_redirect', 1 );

function belctech_buy_now_prepare_checkout() {
	if ( ! isset( $_REQUEST['belctech_buy_now_popup'] ) ) return;

	$nonce = isset( $_REQUEST['belctech_atc_nonce'] ) ? sanitize_text_field( wp_unslash( $_REQUEST['belctech_atc_nonce'] ) ) : '';
	if ( ! wp_verify_nonce( $nonce, 'belctech-add-to-cart' ) ) {
		wp_send_json_error( array( 'message' => __( 'La sesion expiro. Recarga la pagina e intenta nuevamente.', 'belctech-ecommerce' ) ), 403 );
	}

	$errors = function_exists( 'wc_get_notices' ) ? wc_get_notices( 'error' ) : array();
	$notices = function_exists( 'wc_print_notices' ) ? wc_print_notices( true ) : '';
	if ( ! empty( $errors ) ) {
		wp_send_json_error( array( 'notices' => $notices ), 422 );
	}

	$checkout_url = add_query_arg( 'belctech_checkout_modal', '1', wc_get_checkout_url() );
	wp_send_json_success( array(
		'checkout_url' => esc_url_raw( $checkout_url ),
		'cart_hash'    => WC()->cart ? WC()->cart->get_cart_hash() : '',
		'cart_count'   => WC()->cart ? WC()->cart->get_cart_contents_count() : 0,
		'notices'      => $notices,
	) );
}
add_action( 'wp', 'belctech_buy_now_prepare_checkout', 999 );

function belctech_is_modal_checkout_request() {
	return function_exists( 'is_checkout' )
		&& is_checkout()
		&& isset( $_GET['belctech_checkout_modal'] )
		&& '1' === sanitize_text_field( wp_unslash( $_GET['belctech_checkout_modal'] ) );
}

function belctech_buy_now_modal_body_class( $classes ) {
	if ( belctech_is_modal_checkout_request() ) $classes[] = 'belctech-checkout-modal-frame';
	return $classes;
}
add_filter( 'body_class', 'belctech_buy_now_modal_body_class' );

function belctech_buy_now_hide_frame_admin_bar( $show ) {
	return belctech_is_modal_checkout_request() ? false : $show;
}
add_filter( 'show_admin_bar', 'belctech_buy_now_hide_frame_admin_bar' );

function belctech_buy_now_preserve_checkout_url( $url ) {
	if ( belctech_is_modal_checkout_request() ) return add_query_arg( 'belctech_checkout_modal', '1', $url );
	return $url;
}
add_filter( 'woocommerce_get_checkout_url', 'belctech_buy_now_preserve_checkout_url' );

function belctech_buy_now_modal_checkout_marker() {
	static $printed = false;
	if ( ! $printed && belctech_is_modal_checkout_request() ) {
		$printed = true;
		echo '<input type="hidden" name="belctech_checkout_modal" value="1">';
	}
}
add_action( 'woocommerce_checkout_before_customer_details', 'belctech_buy_now_modal_checkout_marker', 1 );
add_action( 'woocommerce_checkout_before_order_review', 'belctech_buy_now_modal_checkout_marker', 1 );

function belctech_buy_now_preserve_return_url( $url ) {
	if ( isset( $_POST['belctech_checkout_modal'] ) && '1' === sanitize_text_field( wp_unslash( $_POST['belctech_checkout_modal'] ) ) ) {
		return add_query_arg( 'belctech_checkout_modal', '1', $url );
	}
	return $url;
}
add_filter( 'woocommerce_get_return_url', 'belctech_buy_now_preserve_return_url' );

function belctech_buy_now_modal_markup() {
	if ( ! wp_script_is( 'belctech-buy-now', 'enqueued' ) ) return;
	$checkout_url = add_query_arg( 'belctech_checkout_modal', '1', wc_get_checkout_url() );
	?>
	<div class="belctech-buy-now-modal" id="belctech-buy-now-modal" hidden aria-hidden="true">
		<div class="belctech-buy-now-modal__backdrop" data-belctech-buy-now-close></div>
		<section class="belctech-buy-now-modal__dialog" role="dialog" aria-modal="true" aria-labelledby="belctech-buy-now-title" tabindex="-1">
			<header class="belctech-buy-now-modal__header">
				<div>
					<span class="belctech-buy-now-modal__eyebrow"><?php esc_html_e( 'Compra segura', 'belctech-ecommerce' ); ?></span>
					<h2 id="belctech-buy-now-title"><?php esc_html_e( 'Finalizar compra', 'belctech-ecommerce' ); ?></h2>
				</div>
				<div class="belctech-buy-now-modal__actions">
					<a class="belctech-buy-now-modal__external" href="<?php echo esc_url( wc_get_checkout_url() ); ?>"><?php esc_html_e( 'Abrir checkout completo', 'belctech-ecommerce' ); ?></a>
					<button type="button" class="belctech-buy-now-modal__close" data-belctech-buy-now-close aria-label="<?php esc_attr_e( 'Cerrar checkout', 'belctech-ecommerce' ); ?>">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			</header>
			<div class="belctech-buy-now-modal__content">
				<div class="belctech-buy-now-modal__loader" role="status"><?php esc_html_e( 'Cargando checkout seguro...', 'belctech-ecommerce' ); ?></div>
				<iframe title="<?php esc_attr_e( 'Finalizar compra', 'belctech-ecommerce' ); ?>" data-checkout-url="<?php echo esc_url( $checkout_url ); ?>" loading="eager" allow="payment *" referrerpolicy="same-origin"></iframe>
			</div>
		</section>
	</div>
	<?php
}
add_action( 'wp_footer', 'belctech_buy_now_modal_markup', 40 );
