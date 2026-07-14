<?php

defined( 'ABSPATH' ) || exit;

/* =======================================================
 * AJAX: CHECK VARIATION STOCK (VERSIÓN PRO - STOCK REAL)
 * ======================================================= */

add_action('wp_ajax_check_variation_stock', 'belctech_bundle_check_variation_stock');
add_action('wp_ajax_nopriv_check_variation_stock', 'belctech_bundle_check_variation_stock');

function belctech_bundle_check_variation_stock() {
	check_ajax_referer( 'belctech_bundle', 'nonce' );

    if (!isset($_POST['pid']) || !isset($_POST['attrs'])) {
        wp_send_json(['success' => false, 'message' => 'Datos incompletos.']);
    }

    $product_id = intval($_POST['pid']);
	$attrs_raw = json_decode( wp_unslash( $_POST['attrs'] ), true );
	if ( ! is_array( $attrs_raw ) ) {
		wp_send_json( [ 'success' => false, 'message' => 'Atributos inválidos.' ] );
	}

    // WooCommerce requiere prefijo attribute_
    $attrs = [];
	foreach ( $attrs_raw as $key => $val ) {
		$attrs[ 'attribute_' . sanitize_key( $key ) ] = wc_clean( $val );
    }

    $product = wc_get_product($product_id);

    if (!$product || !$product->is_type('variable')) {
        wp_send_json(['success' => false, 'message' => 'Producto inválido.']);
    }

    $data_store   = WC_Data_Store::load('product');
    $variation_id = $data_store->find_matching_product_variation($product, $attrs);

    if (!$variation_id) {
        wp_send_json(['success' => false, 'message' => 'Variación no existe.']);
    }

    $variation = wc_get_product($variation_id);

	if ( ! $variation || ! $variation->is_purchasable() || ! $variation->is_in_stock() ) {
        wp_send_json([
            'success' => false,
            'variation_id' => $variation_id,
            'stock' => 0,
            'message' => 'Sin stock.'
        ]);
    }

    $stock = $variation->get_stock_quantity();

    wp_send_json([
        'success' => true,
        'variation_id' => $variation_id,
        'stock' => ($stock !== null ? intval($stock) : 9999)
    ]);
}


/* =======================================================
 * AJAX: AGREGAR PRODUCTO AL CARRITO (BUNDLE)
 * ======================================================= */

add_action("wp_ajax_add_custom_bundle", "belctech_add_custom_bundle");
add_action("wp_ajax_nopriv_add_custom_bundle", "belctech_add_custom_bundle");

function belctech_add_custom_bundle() {
	check_ajax_referer( 'belctech_bundle', 'nonce' );

    if (!isset($_POST['pid']) || !isset($_POST['attrs'])) {
		wp_send_json( [ 'success' => false, 'message' => 'error: missing data' ] );
    }

    $pid = intval($_POST["pid"]);
	$attrs_raw = json_decode( wp_unslash( $_POST['attrs'] ), true );
	if ( ! is_array( $attrs_raw ) ) {
		wp_send_json( [ 'success' => false, 'message' => 'error: invalid attributes' ] );
	}

    // Convertir atributos a formato WooCommerce
    $attrs = [];
	foreach ( $attrs_raw as $key => $val ) {
		$attrs[ 'attribute_' . sanitize_key( $key ) ] = wc_clean( $val );
    }

    $product = wc_get_product($pid);

    if (!$product || !$product->is_type('variable')) {
		wp_send_json( [ 'success' => false, 'message' => 'error: invalid product' ] );
    }

    $data_store   = WC_Data_Store::load('product');
    $variation_id = $data_store->find_matching_product_variation($product, $attrs);

    if (!$variation_id) {
		wp_send_json( [ 'success' => false, 'message' => 'error: no variation' ] );
    }

	$variation = wc_get_product( $variation_id );
	if ( ! $variation || ! $variation->is_purchasable() || ! $variation->is_in_stock() ) {
		wp_send_json( [ 'success' => false, 'message' => 'error: unavailable variation' ] );
	}

	$added = WC()->cart && WC()->cart->add_to_cart( $pid, 1, $variation_id, $attrs );
	if ( ! $added ) {
		wp_send_json( [ 'success' => false, 'message' => 'error: add to cart failed' ] );
	}

	wp_send_json( [ 'success' => true ] );
}
