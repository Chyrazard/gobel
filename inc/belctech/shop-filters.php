<?php
/** Native, dependency-free WooCommerce catalog filters. */

defined( 'ABSPATH' ) || exit;

function belctech_filter_widget_args() {
	return array(
		'before_widget' => '<li class="widget %s">',
		'after_widget'  => '</li>',
		'before_title'  => '<h6 class="widgettitle"><span>',
		'after_title'   => '</span></h6>',
	);
}

function belctech_render_active_filters() {
	$chips = belctech_get_active_filter_chips();
	if ( ! $chips ) return;
	?>
	<li class="widget widget_layered_nav_filters belctech-active-filters-widget">
		<h6 class="widgettitle"><span><?php esc_html_e( 'Filtros activos', 'belctech-ecommerce' ); ?></span></h6>
		<ul class="belctech-active-filter-chips">
			<?php foreach ( $chips as $chip ) : ?>
				<li>
					<a href="<?php echo esc_url( $chip['url'] ); ?>" rel="nofollow" aria-label="<?php echo esc_attr( sprintf( __( 'Quitar filtro: %s', 'belctech-ecommerce' ), $chip['label'] ) ); ?>">
						<span><?php echo esc_html( $chip['label'] ); ?></span><span class="belctech-filter-chip-remove" aria-hidden="true">&times;</span>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
	</li>
	<?php
}

function belctech_filter_current_url() {
	$request = isset( $_SERVER['REQUEST_URI'] ) ? wp_unslash( $_SERVER['REQUEST_URI'] ) : '/';
	return home_url( $request );
}

function belctech_filter_query_keys() {
	$keys = array();
	foreach ( array_keys( $_GET ) as $key ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		$key = sanitize_key( $key );
		if ( 0 === strpos( $key, 'filter_' ) || 0 === strpos( $key, 'query_type_' ) || in_array( $key, array( 'min_price', 'max_price', 'rating_filter', 'on_sale' ), true ) ) {
			$keys[] = $key;
		}
	}
	return array_unique( $keys );
}

function belctech_filter_value( $key ) {
	if ( ! isset( $_GET[ $key ] ) ) return ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended
	$value = wp_unslash( $_GET[ $key ] ); // phpcs:ignore WordPress.Security.NonceVerification.Recommended
	return is_scalar( $value ) ? sanitize_text_field( (string) $value ) : '';
}

function belctech_filter_price_label( $value ) {
	if ( '' === $value ) return '';
	if ( function_exists( 'wc_price' ) ) {
		return trim( html_entity_decode( wp_strip_all_tags( wc_price( (float) $value ) ), ENT_QUOTES, get_bloginfo( 'charset' ) ) );
	}
	return number_format_i18n( (float) $value );
}

function belctech_get_active_filter_chips() {
	$chips       = array();
	$filter_keys = belctech_filter_query_keys();
	$current_url = remove_query_arg( array( 'product-page', 'paged' ), belctech_filter_current_url() );

	if ( belctech_sale_filter_is_active() ) {
		$chips[] = array(
			'label' => __( 'En descuento', 'belctech-ecommerce' ),
			'url'   => remove_query_arg( 'on_sale', $current_url ),
		);
	}

	foreach ( $filter_keys as $key ) {
		if ( 'on_sale' === $key || 0 === strpos( $key, 'query_type_' ) ) continue;

		if ( 0 === strpos( $key, 'filter_' ) ) {
			$attribute = substr( $key, 7 );
			$taxonomy  = 0 === strpos( $attribute, 'pa_' ) ? $attribute : ( function_exists( 'wc_attribute_taxonomy_name' ) ? wc_attribute_taxonomy_name( $attribute ) : 'pa_' . $attribute );
			$values    = array_values( array_unique( array_filter( array_map( 'sanitize_title', explode( ',', belctech_filter_value( $key ) ) ) ) ) );
			$heading   = function_exists( 'wc_attribute_label' ) ? wc_attribute_label( $taxonomy ) : ucfirst( str_replace( array( '-', '_' ), ' ', $attribute ) );

			foreach ( $values as $value ) {
				$term      = taxonomy_exists( $taxonomy ) ? get_term_by( 'slug', $value, $taxonomy ) : false;
				$name      = $term instanceof WP_Term ? $term->name : ucfirst( str_replace( '-', ' ', $value ) );
				$remaining = array_values( array_diff( $values, array( $value ) ) );
				$url       = $remaining ? add_query_arg( $key, implode( ',', $remaining ), $current_url ) : remove_query_arg( array( $key, 'query_type_' . $attribute ), $current_url );
				$chips[]   = array(
					'label' => trim( $heading . ': ' . $name ),
					'url'   => $url,
				);
			}
			continue;
		}

		if ( 'min_price' === $key || 'max_price' === $key ) {
			if ( 'max_price' === $key && in_array( 'min_price', $filter_keys, true ) ) continue;
			$minimum = belctech_filter_price_label( belctech_filter_value( 'min_price' ) );
			$maximum = belctech_filter_price_label( belctech_filter_value( 'max_price' ) );
			if ( $minimum || $maximum ) {
				$chips[] = array(
					'label' => sprintf( __( 'Precio: %1$s - %2$s', 'belctech-ecommerce' ), $minimum ?: '0', $maximum ?: __( 'sin límite', 'belctech-ecommerce' ) ),
					'url'   => remove_query_arg( array( 'min_price', 'max_price' ), $current_url ),
				);
			}
			continue;
		}

		if ( 'rating_filter' === $key ) {
			$rating = absint( belctech_filter_value( $key ) );
			if ( $rating ) {
				$chips[] = array(
					'label' => sprintf( _n( '%s estrella o más', '%s estrellas o más', $rating, 'belctech-ecommerce' ), $rating ),
					'url'   => remove_query_arg( $key, $current_url ),
				);
			}
		}
	}

	return $chips;
}

function belctech_render_toolbar_active_filters() {
	$chips = belctech_get_active_filter_chips();
	if ( ! $chips ) return;
	?>
	<div class="belctech-toolbar-active-filters" aria-label="<?php esc_attr_e( 'Filtros activos', 'belctech-ecommerce' ); ?>">
		<?php foreach ( $chips as $chip ) : ?>
			<a href="<?php echo esc_url( $chip['url'] ); ?>" rel="nofollow" aria-label="<?php echo esc_attr( sprintf( __( 'Quitar filtro: %s', 'belctech-ecommerce' ), $chip['label'] ) ); ?>">
				<span><?php echo esc_html( $chip['label'] ); ?></span><span class="belctech-filter-chip-remove" aria-hidden="true">&times;</span>
			</a>
		<?php endforeach; ?>
	</div>
	<?php
}

function belctech_sale_filter_is_active() {
	return '1' === belctech_filter_value( 'on_sale' );
}

function belctech_preserve_sale_filter_in_layered_nav( $link ) {
	if ( belctech_sale_filter_is_active() ) {
		$link = add_query_arg( 'on_sale', '1', $link );
	}
	return remove_query_arg( array( 'product-page', 'paged' ), $link );
}
add_filter( 'woocommerce_layered_nav_link', 'belctech_preserve_sale_filter_in_layered_nav', 20 );

function belctech_render_sale_filter() {
	$active = belctech_sale_filter_is_active();
	$url    = remove_query_arg( array( 'product-page', 'paged' ), belctech_filter_current_url() );
	$url    = $active ? remove_query_arg( 'on_sale', $url ) : add_query_arg( 'on_sale', '1', $url );
	?>
	<li class="widget belctech-sale-filter-widget">
		<h6 class="widgettitle"><span><?php esc_html_e( 'Promociones', 'belctech-ecommerce' ); ?></span></h6>
		<ul class="belctech-sale-filter">
			<li class="<?php echo $active ? 'is-active' : ''; ?>">
				<a href="<?php echo esc_url( $url ); ?>" rel="nofollow" aria-pressed="<?php echo $active ? 'true' : 'false'; ?>">
					<span class="belctech-sale-filter-check" aria-hidden="true"></span>
					<span><?php esc_html_e( 'En descuento', 'belctech-ecommerce' ); ?></span>
				</a>
			</li>
		</ul>
	</li>
	<?php
}

function belctech_apply_sale_catalog_filter( $query ) {
	if ( ! belctech_sale_filter_is_active() || ! function_exists( 'wc_get_product_ids_on_sale' ) ) return;

	$sale_ids = array_map( 'absint', wc_get_product_ids_on_sale() );
	$included = $query->get( 'post__in' );
	if ( is_array( $included ) && $included ) {
		$sale_ids = array_values( array_intersect( $included, $sale_ids ) );
	}

	$query->set( 'post__in', $sale_ids ? $sale_ids : array( 0 ) );
}
add_action( 'woocommerce_product_query', 'belctech_apply_sale_catalog_filter', 20 );

function belctech_render_filter_actions() {
	$keys = belctech_filter_query_keys();
	if ( ! $keys ) return;
	$url = remove_query_arg( array_merge( $keys, array( 'product-page', 'paged' ) ), belctech_filter_current_url() );
	?>
	<li class="belctech-filter-actions">
		<a class="belctech-clear-filters" href="<?php echo esc_url( $url ); ?>" rel="nofollow"><?php esc_html_e( 'Limpiar todos los filtros', 'belctech-ecommerce' ); ?></a>
	</li>
	<?php
}

add_filter( 'sidebars_widgets', static function ( $sidebars ) {
	if ( is_admin() || empty( $sidebars['widgets-shop'] ) ) return $sidebars;
	$sidebars['widgets-shop'] = array_values(
		array_filter(
			$sidebars['widgets-shop'],
			static function ( $widget_id ) {
				return 0 !== strpos( $widget_id, 'woocommerce_product_categories-' ) && 0 !== strpos( $widget_id, 'product_categories-' );
			}
		)
	);
	return $sidebars;
} );

add_filter( 'widget_display_callback', static function ( $instance, $widget, $args ) {
	if ( isset( $args['id'] ) && 'widgets-shop' === $args['id'] && $widget instanceof WC_Widget_Product_Categories ) {
		return false;
	}
	return $instance;
}, 10, 3 );

function belctech_render_default_shop_filters() {
	if ( ! class_exists( 'WooCommerce' ) ) return;
	$args = belctech_filter_widget_args();

	if ( class_exists( 'WC_Widget_Price_Filter' ) ) {
		the_widget( 'WC_Widget_Price_Filter', array( 'title' => __( 'Precio', 'belctech-ecommerce' ) ), $args );
	}
	if ( class_exists( 'WC_Widget_Layered_Nav' ) && function_exists( 'wc_get_attribute_taxonomies' ) ) {
		foreach ( wc_get_attribute_taxonomies() as $attribute ) {
			$taxonomy = wc_attribute_taxonomy_name( $attribute->attribute_name );
			$terms = taxonomy_exists( $taxonomy ) ? get_terms( array( 'taxonomy' => $taxonomy, 'hide_empty' => true, 'number' => 1, 'fields' => 'ids' ) ) : array();
			if ( is_wp_error( $terms ) || ! $terms ) continue;
			the_widget(
				'WC_Widget_Layered_Nav',
				array(
					'title'        => $attribute->attribute_label,
					'attribute'    => $attribute->attribute_name,
					'display_type' => 'list',
					'query_type'   => 'and',
				),
				$args
			);
		}
	}
}
