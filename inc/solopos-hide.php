<?php

defined( 'ABSPATH' ) || exit;

/* =======================================================
 * CHYRAZ — CONTROL PRODUCTOS "SOLOPOS"
 * - Redirección directa
 * - Ocultar en catálogo, búsqueda, widgets y relacionados
 * ======================================================= */


/* =======================================================
 * 1. REDIRECCIÓN SI ACCEDEN DIRECTO
 * ======================================================= */
add_action('template_redirect', function () {

    if (!is_singular('product')) return;

    global $post;

    if (has_term('solopos', 'product_cat', $post->ID)) {
		wp_safe_redirect( home_url( '/no-disponible/' ), 302 );
        exit;
    }

});


/* =======================================================
 * 2. OCULTAR EN TODAS LAS QUERIES (CATÁLOGO + SEARCH + ARCHIVOS)
 * ======================================================= */
add_action('pre_get_posts', function ($query) {

    if (is_admin() || !$query->is_main_query()) return;

    if (
        is_shop() ||
        is_product_category() ||
        is_product_tag() ||
        is_search() ||
        is_archive()
    ) {
        $tax_query = (array) $query->get('tax_query');

        $tax_query[] = [
            'taxonomy' => 'product_cat',
            'field'    => 'slug',
            'terms'    => ['solopos'],
            'operator' => 'NOT IN'
        ];

        $query->set('tax_query', $tax_query);
    }

});


/* =======================================================
 * 3. OCULTAR EN WIDGETS Y QUERIES PERSONALIZADAS
 * ======================================================= */
add_filter('woocommerce_product_query_tax_query', function ($tax_query) {

    if (is_admin()) return $tax_query;

    $tax_query[] = [
        'taxonomy' => 'product_cat',
        'field'    => 'slug',
        'terms'    => ['solopos'],
        'operator' => 'NOT IN'
    ];

    return $tax_query;

}, 10);


/* =======================================================
 * 4. OCULTAR EN PRODUCTOS RELACIONADOS
 * ======================================================= */
add_filter('woocommerce_related_products', function ($related_posts) {

    return array_filter($related_posts, function ($related_id) {
        return !has_term('solopos', 'product_cat', $related_id);
    });

}, 10);
