<?php
defined( 'ABSPATH' ) || exit;

/**
 * BLOQUEO ADMIN SEGURO — BODEGA / BODEGA2
 * Solo permite:
 * - WooPOS
 * - Pedidos WooCommerce
 */

/* =======================================================
 * USUARIOS BLOQUEADOS
 * ======================================================= */
function belctech_pos_is_locked_user() {
    $user = wp_get_current_user();
    return ($user instanceof WP_User) && in_array($user->user_login, ['bodega', 'bodega2'], true);
}


/* =======================================================
 * URL PEDIDOS (HPOS / LEGACY)
 * ======================================================= */
function belctech_pos_orders_admin_url() {
    if (class_exists('\Automattic\WooCommerce\Utilities\OrderUtil')) {
        $is_hpos = \Automattic\WooCommerce\Utilities\OrderUtil::custom_orders_table_usage_is_enabled();
        if (!$is_hpos) {
            return admin_url('edit.php?post_type=shop_order');
        }
    }
    return admin_url('admin.php?page=wc-orders');
}


/* =======================================================
 * PANTALLAS PERMITIDAS
 * ======================================================= */
function belctech_pos_is_allowed_admin_screen() {

    $pagenow   = $GLOBALS['pagenow'] ?? '';
    $page      = $_GET['page'] ?? '';
    $post_type = $_GET['post_type'] ?? '';
    $post_id   = isset($_GET['post']) ? absint($_GET['post']) : 0;

    // POS
    if ($pagenow === 'admin.php' && $page === 'woopos') {
        return true;
    }

    // Orders HPOS
    if ($pagenow === 'admin.php' && $page && strpos($page, 'wc-orders') !== false) {
        return true;
    }

    // Orders legacy
    if ($pagenow === 'edit.php' && $post_type === 'shop_order') {
        return true;
    }

    // Editar pedido
    if ($pagenow === 'post.php' || $pagenow === 'post-new.php') {

        if ($post_type === 'shop_order') return true;

        if ($post_id > 0 && get_post_type($post_id) === 'shop_order') {
            return true;
        }
    }

    return false;
}


/* =======================================================
 * CSS VISUAL
 * ======================================================= */
add_action('admin_head', function () {

    if (!belctech_pos_is_locked_user()) return;

    echo '<style>
        #adminmenu > li { display:none !important; }

        #adminmenu li.toplevel_page_woopos,
        #adminmenu li.menu-top.toplevel_page_woocommerce {
            display:block !important;
        }

        #adminmenu li.menu-top.toplevel_page_woocommerce ul.wp-submenu li {
            display:none !important;
        }

        #adminmenu li.menu-top.toplevel_page_woocommerce ul.wp-submenu a[href*="wc-orders"],
        #adminmenu li.menu-top.toplevel_page_woocommerce ul.wp-submenu a[href*="shop_order"] {
            display:block !important;
        }

        .notice, .update-nag, .welcome-panel { display:none !important; }
    </style>';

}, 99);


/* =======================================================
 * LIMPIAR MENÚ
 * ======================================================= */
add_action('admin_menu', function () {

    if (!belctech_pos_is_locked_user()) return;

    global $menu, $submenu;

    if (!is_array($menu)) return;

    foreach ($menu as $key => $item) {
        $slug = $item[2] ?? '';
        if ($slug !== 'woopos' && $slug !== 'woocommerce') {
            unset($menu[$key]);
        }
    }

    // Submenu WooCommerce → solo pedidos
    if (isset($submenu['woocommerce'])) {
        foreach ($submenu['woocommerce'] as $k => $sub_item) {

            $slug = $sub_item[2] ?? '';

            if (
                strpos($slug, 'wc-orders') === false &&
                $slug !== 'edit.php?post_type=shop_order'
            ) {
                unset($submenu['woocommerce'][$k]);
            }
        }
    }

}, 999);


/* =======================================================
 * SEGURIDAD URL (FIX IMPORTANTE)
 * ======================================================= */
add_action('admin_init', function () {

    if (!is_admin() || !belctech_pos_is_locked_user()) return;

    // Permitir sistema interno
    if (
        wp_doing_ajax() ||
        (defined('REST_REQUEST') && REST_REQUEST) ||
        (defined('DOING_CRON') && DOING_CRON)
    ) {
        return;
    }

    global $pagenow;

    // Archivos core permitidos
    $allowed_files = [
        'admin-ajax.php',
        'admin-post.php',
        'async-upload.php',
        'update.php',
        'upgrade.php'
    ];

    if (in_array($pagenow, $allowed_files, true)) return;

    if (!belctech_pos_is_allowed_admin_screen()) {
        wp_safe_redirect(admin_url('admin.php?page=woopos'));
        exit;
    }

}, 20);


/* =======================================================
 * LOGIN REDIRECT
 * ======================================================= */
add_filter('login_redirect', function ($redirect_to, $requested_redirect_to, $user) {

    if ($user instanceof WP_User && in_array($user->user_login, ['bodega', 'bodega2'], true)) {
        return admin_url('admin.php?page=woopos');
    }

    return $redirect_to;

}, 10, 3);


/* =======================================================
 * QUITAR ADMIN BAR
 * ======================================================= */
add_action('after_setup_theme', function () {

    if (belctech_pos_is_locked_user()) {
        show_admin_bar(false);
    }

});


/* =======================================================
 * CAPACIDADES NECESARIAS
 * ======================================================= */
add_filter('user_has_cap', function ($allcaps, $caps, $args, $user) {

    if (!($user instanceof WP_User) || !in_array($user->user_login, ['bodega', 'bodega2'], true)) {
        return $allcaps;
    }

    $grant_caps = [
        'read'                     => true,
        'woopos_access_pos'        => true,

        'edit_shop_orders'         => true,
        'edit_others_shop_orders'  => true,
        'publish_shop_orders'      => true,
        'read_private_shop_orders' => true,
        'edit_shop_order'          => true,
        'read_shop_order'          => true,
    ];

    foreach ($grant_caps as $cap => $grant) {
        $allcaps[$cap] = $grant;
    }

    return $allcaps;

}, 10, 4);


/* =======================================================
 * BOTÓN VOLVER → PEDIDOS
 * ======================================================= */
add_action('admin_footer', function () {

    if (!belctech_pos_is_locked_user()) return;

    $screen = function_exists('get_current_screen') ? get_current_screen() : null;

    if (!$screen || $screen->id !== 'toplevel_page_woopos') return;

    $orders_url = esc_url(belctech_pos_orders_admin_url());
    ?>

    <script>
    document.addEventListener('DOMContentLoaded', function () {

        var cards = document.querySelectorAll('.woopos-side-cards a.woopos-side-card');
        if (!cards.length) return;

        cards[0].setAttribute('href', '<?php echo $orders_url; ?>');

    });
    </script>

    <?php

}, 99);
