<?php

defined( 'ABSPATH' ) || exit;

/* =======================================================
 * CHYRAZ — AUTO CREAR / ASIGNAR USUARIO DESDE CHECKOUT
 * - No bloquea checkout
 * - No exige login
 * - Si existe email → asigna pedido
 * - Si no existe → crea usuario
 * ======================================================= */

add_action('woocommerce_checkout_order_processed', function ($order_id) {

    $order = wc_get_order($order_id);
    if (!$order) return;

    // Si ya tiene usuario asignado → salir
    if ($order->get_user_id()) return;

    $email      = $order->get_billing_email();
    $first_name = $order->get_billing_first_name();
    $last_name  = $order->get_billing_last_name();

    if (!$email) return;

    /* =======================================================
     * 1. SI YA EXISTE USUARIO → SOLO ASIGNAR
     * ======================================================= */
    if (email_exists($email)) {

        $user = get_user_by('email', $email);

        if ($user) {
            $order->set_customer_id($user->ID);
            $order->save();
        }

        return; // 🔥 IMPORTANTE: no crear duplicado
    }

    /* =======================================================
     * 2. SI NO EXISTE → CREAR USUARIO
     * ======================================================= */

    $password = wp_generate_password();

    $user_id = wc_create_new_customer($email, '', $password);

    if (is_wp_error($user_id)) return;

    // Agregar datos
    wp_update_user([
        'ID'         => $user_id,
        'first_name' => $first_name,
        'last_name'  => $last_name,
    ]);

    // Asignar pedido al usuario nuevo
    $order->set_customer_id($user_id);
    $order->save();

    // Enviar email para que cree su contraseña
    wp_new_user_notification($user_id, null, 'user');

});
