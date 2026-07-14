<?php

defined( 'ABSPATH' ) || exit;

/* =======================================================
 * CHYRAZ — PAGO AUTOMÁTICO (2 CLICS PAYU)
 * ======================================================= */

function belctech_auto_click_payu_button() {

    // Solo en checkout y cuando viene con key (pedido generado)
    if (!is_checkout() || !isset($_GET['key'])) {
        return;
    }

    ?>

    <script>
        document.addEventListener("DOMContentLoaded", function () {

            const payuButton = document.querySelector("#submit_payu_latam");

            if (!payuButton) return;

            // Auto click
            payuButton.click();

        });
    </script>

    <?php
}

add_action('wp_footer', 'belctech_auto_click_payu_button');
