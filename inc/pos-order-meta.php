<?php
/**
 * WePOS cashier metadata exposed to WooCommerce REST order responses.
 *
 * @package Belctech_Ecommerce
 */

defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'my_get_wepos_cashier_name' ) ) {
	function my_get_wepos_cashier_name( $order ) {
		if ( is_numeric( $order ) ) {
			$order = wc_get_order( absint( $order ) );
		}

		if ( ! $order instanceof WC_Order ) {
			return '';
		}

		$name = (string) $order->get_meta( '_wepos_cashier_name', true );
		if ( '' !== $name ) {
			return $name;
		}

		$user_id = (int) $order->get_meta( '_wepos_cashier_id', true );
		if ( $user_id <= 0 ) {
			$user_id = (int) $order->get_meta( '_woopos_cashier', true );
		}

		$user = $user_id > 0 ? get_user_by( 'id', $user_id ) : false;
		return $user ? (string) $user->display_name : '';
	}
}

if ( ! function_exists( 'my_is_wholesale_order' ) ) {
	function my_is_wholesale_order( $order ) {
		if ( is_numeric( $order ) ) {
			$order = wc_get_order( absint( $order ) );
		}

		if ( ! $order instanceof WC_Order ) {
			return false;
		}

		$order_type = sanitize_key( (string) $order->get_meta( '_woopos_order_type', true ) );
		$order_kind = sanitize_key( (string) $order->get_meta( 'woopos_pedido', true ) );

		if ( 'mayorista' === $order_type || 'mayorista' === $order_kind ) {
			return true;
		}

		foreach ( $order->get_items( 'line_item' ) as $item ) {
			if ( 'wholesale' === sanitize_key( (string) $item->get_meta( '_woopos_pricing_mode', true ) ) ) {
				return true;
			}
		}

		return false;
	}
}

add_filter(
	'woocommerce_rest_prepare_shop_order_object',
	function ( $response, $order ) {
		if ( ! $response instanceof WP_REST_Response || ! $order instanceof WC_Order || empty( $response->data['number'] ) ) {
			return $response;
		}

		$number  = trim( (string) $response->data['number'] );
		$number  = preg_replace( '/\s*(?:\||-)\s*Cajero POS:.*$/iu', '', $number );
		$cashier = my_get_wepos_cashier_name( $order );

		if ( '' === $cashier ) {
			return $response;
		}

		$response->data['number'] = $number . ' | Cajero POS: ' . $cashier . ( my_is_wholesale_order( $order ) ? ' | M |' : ' |' );
		return $response;
	},
	10,
	2
);

add_action(
	'woocommerce_new_order',
	function ( $order_id ) {
		$order = wc_get_order( $order_id );
		if ( ! $order ) {
			return;
		}

		$created_via   = method_exists( $order, 'get_created_via' ) ? $order->get_created_via() : '';
		$payment_method = (string) $order->get_payment_method();
		$is_wepos       = 'wepos' === $created_via || 0 === strpos( $payment_method, 'wepos_' );

		if ( ! $is_wepos && ! $order->get_meta( '_wepos' ) && ! $order->get_meta( '_wepos_order' ) ) {
			return;
		}

		$user_id = get_current_user_id();
		if ( ! $user_id ) {
			$user_id = (int) $order->get_meta( '_wepos_user_id' );
		}
		if ( ! $user_id ) {
			$user_id = (int) $order->get_meta( '_wepos_cashier' );
		}

		if ( ! $user_id ) {
			return;
		}

		$user = get_user_by( 'id', $user_id );
		$order->update_meta_data( '_wepos_cashier_id', $user_id );
		if ( $user ) {
			$order->update_meta_data( '_wepos_cashier_name', $user->display_name );
		}
		$order->save();
	},
	20
);
