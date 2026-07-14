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
	if ( ! class_exists( 'WC_Widget_Layered_Nav_Filters' ) ) return;
	the_widget(
		'WC_Widget_Layered_Nav_Filters',
		array( 'title' => __( 'Filtros activos', 'belctech-ecommerce' ) ),
		belctech_filter_widget_args()
	);
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

function belctech_sale_filter_is_active() {
	return isset( $_GET['on_sale'] ) && '1' === sanitize_text_field( wp_unslash( $_GET['on_sale'] ) ); // phpcs:ignore WordPress.Security.NonceVerification.Recommended
}

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
