<?php

defined( 'ABSPATH' ) || exit;

/* =======================================================
 *  PACK 2 — PRODUCTO 4397 — STOCK DINÁMICO REAL
 *  SOLO EN postid-16476
 * ======================================================= */

add_action('wp_footer', function () {

    if (!is_product() || !in_array('postid-16476', get_body_class())) {
        return;
    }

    $product_id = 4397;
    $product = wc_get_product($product_id);

    if (!$product) {
        return;
    }

    $pack_price = "139.900";
    ?>

    <style>
        .bundle-wrapper { margin-bottom:25px; padding:20px; border:2px solid #ddd; border-radius:10px; }
        .bundle-title { font-size:20px; font-weight:600; margin-bottom:15px; }
        .bundle-product { display:flex; gap:15px; margin-bottom:20px; padding-bottom:15px; border-bottom:1px solid #eee; }
        .bundle-product img { width:70px; height:70px; border-radius:8px; object-fit:cover; }

        .stock-status { margin-top:8px; font-size:14px; font-weight:600; }
        .stock-ok { color:#0a8a00; }
        .stock-bad { color:#c40000; }

        button#add-bundle { width:100%; padding:12px; font-size:16px; margin-top:15px; }

        #bundle-loading {
            position:fixed; top:0; left:0; right:0; bottom:0;
            background:rgba(0,0,0,.6); display:none;
            align-items:center; justify-content:center; z-index:999999;
        }

        #bundle-loading span {
            background:#fff; padding:20px 30px; border-radius:10px;
            font-size:20px; font-weight:600;
        }
    </style>

    <div id="bundle-loading"><span>Agregando tu paquete...</span></div>

    <script>
    document.addEventListener("DOMContentLoaded", function() {

        let cartBox = document.querySelector(".cart");
        if (!cartBox) return;

        cartBox.insertAdjacentHTML("beforebegin", `
            <div class="bundle-wrapper">
                <div class="bundle-title">🔥 Escoge 3 unidades del producto</div>

                <?php for ($i = 1; $i <= 3; $i++): ?>
                <div class="bundle-product" data-index="<?php echo $i; ?>">
                    <img src="<?php echo esc_url(wp_get_attachment_url($product->get_image_id())); ?>" />
                    <div>
                        <strong>Unidad <?php echo $i; ?></strong>

                        <?php
                        $attributes = $product->get_attributes();
                        foreach ($attributes as $attr_name => $attr) {
                            echo '<br><select class="bundle-variation" data-attr="'.$attr_name.'" data-index="'.$i.'">';
                            echo '<option value="">Selecciona '.wc_attribute_label($attr_name).'…</option>';

                            foreach ($attr->get_options() as $option_id) {
                                $term = get_term($option_id);
                                if ($term && !is_wp_error($term)) {
                                    echo '<option value="'.$term->slug.'">'.$term->name.'</option>';
                                }
                            }

                            echo '</select>';
                        }
                        ?>

                        <div class="stock-status" id="stock-status-<?php echo $i; ?>"></div>
                    </div>
                </div>
                <?php endfor; ?>

                <div class="bundle-total">PACK TOTAL: <strong>$<?php echo $pack_price; ?></strong></div>
                <button id="add-bundle" class="button alt" disabled>Comprar ahora</button>
                <div class="bundle-error" style="display:none; margin-top:10px; color:red;"></div>
            </div>
        `);

        const addButton = document.getElementById("add-bundle");

        async function fetchVariationStock(pid, attrs) {
            let res = await fetch("<?php echo admin_url('admin-ajax.php'); ?>", {
                method:"POST",
                credentials:"same-origin",
                headers:{ "Content-Type":"application/x-www-form-urlencoded" },
                body:
                    "action=check_variation_stock" +
					"&nonce=<?php echo esc_js( wp_create_nonce( 'belctech_bundle' ) ); ?>" +
                    "&pid=" + encodeURIComponent(pid) +
                    "&attrs=" + encodeURIComponent(JSON.stringify(attrs))
            });

            return res.json();
        }

        async function validateAllUnits() {

            let used = {};
            let allOk = true;

            for (let box of document.querySelectorAll(".bundle-product")) {

                let index = box.dataset.index;
                let statusDiv = document.getElementById("stock-status-" + index);

                let attrs = {};
                box.querySelectorAll(".bundle-variation").forEach(sel => {
                    attrs[sel.dataset.attr] = sel.value;
                });

                if (Object.values(attrs).includes("")) {
                    statusDiv.innerHTML = "";
                    allOk = false;
                    continue;
                }

                let check = await fetchVariationStock(<?php echo $product_id; ?>, attrs);

                if (!check.success) {
                    statusDiv.innerHTML = "<span class='stock-bad'>✖ SIN STOCK</span>";
                    allOk = false;
                    continue;
                }

                let vId = check.variation_id;
                let stockReal = check.stock;

                let alreadyUsed = used[vId] || 0;
                let stockVirtual = stockReal - alreadyUsed;

                if (stockVirtual <= 0) {
                    statusDiv.innerHTML = "<span class='stock-bad'>✖ SIN STOCK</span>";
                    allOk = false;
                    continue;
                }

                statusDiv.innerHTML = "<span class='stock-ok'>✔ DISPONIBLE</span>";
                used[vId] = alreadyUsed + 1;
            }

            addButton.disabled = !allOk;
        }

        document.querySelectorAll(".bundle-variation").forEach(sel => {
            sel.addEventListener("change", validateAllUnits);
        });

        addButton.addEventListener("click", async function() {

            let loading = document.getElementById("bundle-loading");
            loading.style.display = "flex";

            let products = [];

            document.querySelectorAll(".bundle-product").forEach(box => {
                let attrs = {};
                box.querySelectorAll(".bundle-variation").forEach(sel => {
                    attrs[sel.dataset.attr] = sel.value;
                });
                products.push({ pid: <?php echo $product_id; ?>, attrs });
            });

            for (let p of products) {

                let add = await fetch("<?php echo admin_url('admin-ajax.php'); ?>", {
                    method:"POST",
                    credentials:"same-origin",
                    headers:{ "Content-Type":"application/x-www-form-urlencoded" },
                    body:
                        "action=add_custom_bundle" +
						"&nonce=<?php echo esc_js( wp_create_nonce( 'belctech_bundle' ) ); ?>" +
                        "&pid=" + encodeURIComponent(p.pid) +
                        "&attrs=" + encodeURIComponent(JSON.stringify(p.attrs))
                });

				let result;
				try { result = await add.json(); } catch (error) { result = { success: false }; }

				if (!add.ok || !result.success) {
                    loading.style.display = "none";
                    document.querySelector(".bundle-error").innerHTML =
                        "Error al agregar uno de los productos.";
                    document.querySelector(".bundle-error").style.display = "block";
                    return;
                }
            }

            window.location.href = "<?php echo esc_url(wc_get_checkout_url()); ?>";
        });

    });
    </script>

    <?php
});


/* =======================================================
 * DESCUENTO AUTOMÁTICO REF 025
 * ======================================================= */

add_action('woocommerce_cart_calculate_fees', function() {

    if (is_admin() && !defined('DOING_AJAX')) return;

    $target_id = 4397;
    $precio_especial = 139900;

    $cantidad = 0;
    $subtotal_original = 0;

    foreach (WC()->cart->get_cart() as $cart_item) {
        if ((int)$cart_item['product_id'] === $target_id) {
            $cantidad += $cart_item['quantity'];
            $subtotal_original += $cart_item['line_subtotal'];
        }
    }

    if ($cantidad === 3) {

        $descuento = $subtotal_original - $precio_especial;

        if ($descuento > 0) {
            WC()->cart->add_fee(
                "Descuento por paquete Ref 025 (3 unidades)",
                -$descuento
            );
        }
    }

});
