<?php

defined( 'ABSPATH' ) || exit;

/* =======================================================
 * CHYRAZ — TEXTO DE DISPONIBILIDAD PERSONALIZADO
 * ======================================================= */

add_filter('woocommerce_get_availability', function ($availability, $product) {

    if ($product->is_in_stock()) {
        $availability['availability'] = __('Disponible', 'woocommerce');
    } else {
        $availability['availability'] = __('No disponible', 'woocommerce');
    }

    return $availability;

}, 10, 2);


/* =======================================================
 * CHYRAZ — PERMITIR SKU REPETIDO EN VARIACIONES
 * ======================================================= */

add_filter('wc_product_has_unique_sku', '__return_false');
