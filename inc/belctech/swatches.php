<?php
/** Native WooCommerce color and image variation swatches. */

defined( 'ABSPATH' ) || exit;

function belctech_asset_version( $relative_path ) {
	$path = BELCTECH_THEME_DIR . '/' . ltrim( $relative_path, '/' );
	return file_exists( $path ) ? (string) filemtime( $path ) : BELCTECH_THEME_VERSION;
}

// The theme's visual layer is global, independently of the swatch provider.
add_action( 'wp_enqueue_scripts', static function () {
	wp_enqueue_style( 'belctech-native', BELCTECH_THEME_URI . '/assets/css/belctech.css', array( 'belctech-ecommerce' ), belctech_asset_version( 'assets/css/belctech.css' ) );
	wp_add_inline_style( 'belctech-native', belctech_design_css() );
}, 30 );

// Let an already-active Woo Variation Swatches plugin keep ownership until it
// is deactivated. The native provider takes over automatically afterwards.
if ( defined( 'BELCTECH_EXTERNAL_SWATCHES' ) ) {
	return;
}

add_filter( 'product_attributes_type_selector', static function ( $types ) {
	$types['color'] = __( 'Color', 'belctech-ecommerce' );
	$types['image'] = __( 'Image', 'belctech-ecommerce' );
	$types['button'] = __( 'Button', 'belctech-ecommerce' );
	return $types;
} );

function belctech_attribute_taxonomies() {
	if ( ! function_exists( 'wc_get_attribute_taxonomies' ) ) return;
	foreach ( wc_get_attribute_taxonomies() as $attribute ) {
		$taxonomy = wc_attribute_taxonomy_name( $attribute->attribute_name );
		if ( 'color' === $attribute->attribute_type ) {
			add_action( $taxonomy . '_add_form_fields', 'belctech_color_add_field' );
			add_action( $taxonomy . '_edit_form_fields', 'belctech_color_edit_field' );
		} elseif ( 'image' === $attribute->attribute_type ) {
			add_action( $taxonomy . '_add_form_fields', 'belctech_image_add_field' );
			add_action( $taxonomy . '_edit_form_fields', 'belctech_image_edit_field' );
		}
		add_action( 'created_' . $taxonomy, 'belctech_save_swatch_term' );
		add_action( 'edited_' . $taxonomy, 'belctech_save_swatch_term' );
	}
}
add_action( 'admin_init', 'belctech_attribute_taxonomies' );

function belctech_color_add_field() {
	echo '<div class="form-field"><label for="product_attribute_color">' . esc_html__( 'Swatch color', 'belctech-ecommerce' ) . '</label><input type="color" name="product_attribute_color" id="product_attribute_color" value="#000000"></div>';
}
function belctech_color_edit_field( $term ) {
	$value = get_term_meta( $term->term_id, 'product_attribute_color', true ) ?: '#000000';
	echo '<tr class="form-field"><th><label for="product_attribute_color">' . esc_html__( 'Swatch color', 'belctech-ecommerce' ) . '</label></th><td><input type="color" name="product_attribute_color" id="product_attribute_color" value="' . esc_attr( $value ) . '"></td></tr>';
}
function belctech_image_add_field() {
	echo '<div class="form-field"><label for="product_attribute_image">' . esc_html__( 'Swatch image ID', 'belctech-ecommerce' ) . '</label><input type="number" name="product_attribute_image" id="product_attribute_image"></div>';
}
function belctech_image_edit_field( $term ) {
	$value = absint( get_term_meta( $term->term_id, 'product_attribute_image', true ) );
	echo '<tr class="form-field"><th><label for="product_attribute_image">' . esc_html__( 'Swatch image ID', 'belctech-ecommerce' ) . '</label></th><td><input type="number" name="product_attribute_image" id="product_attribute_image" value="' . esc_attr( $value ) . '"><p class="description">' . esc_html__( 'Attachment ID from the Media Library.', 'belctech-ecommerce' ) . '</p></td></tr>';
}
function belctech_save_swatch_term( $term_id ) {
	if ( isset( $_POST['product_attribute_color'] ) ) update_term_meta( $term_id, 'product_attribute_color', sanitize_hex_color( wp_unslash( $_POST['product_attribute_color'] ) ) );
	if ( isset( $_POST['product_attribute_image'] ) ) update_term_meta( $term_id, 'product_attribute_image', absint( $_POST['product_attribute_image'] ) );
}

function belctech_swatch_type( $attribute ) {
	$taxonomy = wc_attribute_taxonomy_name( str_replace( 'pa_', '', $attribute ) );
	foreach ( wc_get_attribute_taxonomies() as $item ) {
		if ( wc_attribute_taxonomy_name( $item->attribute_name ) === $taxonomy && in_array( $item->attribute_type, array( 'color', 'image', 'button' ), true ) ) {
			return $item->attribute_type;
		}
	}

	$label = function_exists( 'wc_attribute_label' ) ? wc_attribute_label( $attribute ) : $attribute;
	$key   = sanitize_title( remove_accents( str_replace( 'pa_', '', $attribute ) . ' ' . $label ) );

	if ( false !== strpos( $key, 'color' ) || false !== strpos( $key, 'colour' ) ) {
		return 'color';
	}

	// Native swatches are the default for variation choices; no select-only plugin metadata is required.
	return 'button';
}

function belctech_swatch_color( $term, $option ) {
	$name = sanitize_title( remove_accents( $term instanceof WP_Term ? $term->name . ' ' . $term->slug : $option ) );
	$option_slug = sanitize_title( remove_accents( $option ) );
	$custom_lines = preg_split( '/\r\n|\r|\n/', (string) get_theme_mod( 'belctech_swatch_custom_assignments', '' ) );
	$custom_colors = array();
	foreach ( $custom_lines as $line ) {
		if ( ! preg_match( '/^\s*([^:=]+?)\s*[:=]\s*(#[0-9a-fA-F]{3}(?:[0-9a-fA-F]{3})?)\s*$/', $line, $matches ) ) continue;
		$custom_slug = sanitize_title( remove_accents( trim( $matches[1] ) ) );
		$custom_color = sanitize_hex_color( $matches[2] );
		if ( $custom_slug && $custom_color ) $custom_colors[ $custom_slug ] = $custom_color;
	}
	if ( isset( $custom_colors[ $option_slug ] ) ) return $custom_colors[ $option_slug ];
	uksort( $custom_colors, static function ( $first, $second ) { return strlen( $second ) - strlen( $first ); } );
	foreach ( $custom_colors as $custom_slug => $custom_color ) {
		if ( false !== strpos( $name, $custom_slug ) ) return $custom_color;
	}

	$definitions = belctech_swatch_color_definitions();
	$matched_definition = '';
	$alias_map = array();
	foreach ( $definitions as $slug => $definition ) {
		foreach ( $definition['aliases'] as $alias ) {
			if ( $alias === $option_slug ) $matched_definition = $slug;
			$alias_map[ $alias ] = $slug;
		}
	}
	if ( ! $matched_definition ) {
		uksort( $alias_map, static function ( $first, $second ) { return strlen( $second ) - strlen( $first ); } );
		foreach ( $alias_map as $alias => $slug ) {
			if ( false !== strpos( $name, $alias ) ) {
				$matched_definition = $slug;
				break;
			}
		}
	}
	if ( $matched_definition ) {
		$definition = $definitions[ $matched_definition ];
		$setting = 'belctech_swatch_color_' . str_replace( '-', '_', $matched_definition );
		$assigned = sanitize_hex_color( get_theme_mod( $setting, $definition['default'] ) );
		if ( $assigned ) return $assigned;
	}

	$color = '';
	if ( $term instanceof WP_Term ) {
		foreach ( array( 'product_attribute_color', 'wvs_color', 'color' ) as $meta_key ) {
			$color = sanitize_hex_color( get_term_meta( $term->term_id, $meta_key, true ) );
			if ( $color ) break;
		}
	}

	if ( $color ) return $color;

	$fallback = sanitize_hex_color( get_theme_mod( 'belctech_swatch_default_color', '#CCCCCC' ) ) ?: '#CCCCCC';
	return apply_filters( 'belctech_swatch_fallback_color', $fallback, $name, $term );
}

function belctech_is_size_attribute( $attribute ) {
	$label = function_exists( 'wc_attribute_label' ) ? wc_attribute_label( $attribute ) : $attribute;
	$key = sanitize_title( remove_accents( str_replace( 'pa_', '', $attribute ) . ' ' . $label ) );
	return false !== strpos( $key, 'talla' ) || false !== strpos( $key, 'size' ) || false !== strpos( $key, 'tamano' );
}

function belctech_sort_swatch_options( $options, $attribute ) {
	if ( ! belctech_is_size_attribute( $attribute ) ) return $options;

	$order = array(
		'xxs' => 10,
		'xs' => 20,
		's' => 30,
		'small' => 30,
		'm' => 40,
		'medium' => 40,
		'l' => 50,
		'large' => 50,
		'xl' => 60,
		'xxl' => 70,
		'xxxl' => 80,
		'unica' => 90,
		'unica-talla' => 90,
	);
	$indexed = array();
	foreach ( array_values( $options ) as $index => $option ) {
		$term = taxonomy_exists( $attribute ) ? get_term_by( 'slug', $option, $attribute ) : false;
		$sort_name = $term instanceof WP_Term ? $term->name : $option;
		$key = sanitize_title( remove_accents( $sort_name ) );
		$indexed[] = array(
			'value' => $option,
			'index' => $index,
			'order' => isset( $order[ $key ] ) ? $order[ $key ] : 1000 + $index,
		);
	}
	usort( $indexed, static function ( $first, $second ) {
		if ( $first['order'] === $second['order'] ) return $first['index'] - $second['index'];
		return $first['order'] - $second['order'];
	} );

	return wp_list_pluck( $indexed, 'value' );
}

function belctech_variation_swatches_html( $html, $args ) {
	if ( empty( $args['attribute'] ) || empty( $args['product'] ) || ! $args['product'] instanceof WC_Product ) return $html;
	$type = belctech_swatch_type( $args['attribute'] );
	$options = $args['options'] ?: $args['product']->get_variation_attributes()[ $args['attribute'] ] ?? array();
	$options = belctech_sort_swatch_options( $options, $args['attribute'] );
	$selected = $args['selected'] ?? $args['product']->get_variation_default_attribute( $args['attribute'] );
	$items = '';
	foreach ( $options as $option ) {
		$term = taxonomy_exists( $args['attribute'] ) ? get_term_by( 'slug', $option, $args['attribute'] ) : false;
		$name = $term instanceof WP_Term ? $term->name : apply_filters( 'woocommerce_variation_option_name', $option, null, $args['attribute'], $args['product'] );
		$class = array( 'variable-item', $type . '-variable-item' );
		if ( (string) $selected === (string) $option ) $class[] = 'selected';
		$content = esc_html( $name );
		if ( 'color' === $type ) {
			$color = belctech_swatch_color( $term, $option );
			$content = '<span class="variable-item-span variable-item-span-color" style="background-color:' . esc_attr( $color ) . '"></span>';
		} elseif ( 'image' === $type ) {
			$image_id = $term instanceof WP_Term ? absint( get_term_meta( $term->term_id, 'product_attribute_image', true ) ) : 0;
			$content = $image_id ? wp_get_attachment_image( $image_id, 'thumbnail' ) : esc_html( $name );
		}
		$items .= '<li class="' . esc_attr( implode( ' ', $class ) ) . '" role="radio" tabindex="0" aria-checked="' . ( (string) $selected === (string) $option ? 'true' : 'false' ) . '" aria-label="' . esc_attr( $name ) . '" data-value="' . esc_attr( $option ) . '" data-title="' . esc_attr( $name ) . '"><span class="variable-item-contents">' . $content . '</span></li>';
	}

	if ( '' === $items ) return $html;

	$html = preg_replace( '/<select\b/', '<select data-belctech-native-select="1" aria-hidden="true" tabindex="-1"', $html, 1 );
	return $html . '<ul class="variable-items-wrapper belctech-variable-items ' . esc_attr( $type ) . '-variable-items-wrapper" role="radiogroup" aria-label="' . esc_attr( wc_attribute_label( $args['attribute'] ) ) . '">' . $items . '</ul>';
}
add_filter( 'woocommerce_dropdown_variation_attribute_options_html', 'belctech_variation_swatches_html', 20, 2 );

function belctech_card_color_attribute( $product ) {
	if ( ! $product instanceof WC_Product_Variable ) return '';
	foreach ( array_keys( $product->get_variation_attributes() ) as $attribute ) {
		if ( 'color' === belctech_swatch_type( $attribute ) ) return $attribute;
	}
	return '';
}

function belctech_card_swatch_map( $product, $attribute, $options ) {
	$cached = get_post_meta( $product->get_id(), '_belctech_card_swatch_map', true );
	if ( is_array( $cached ) && isset( $cached['version'], $cached['attribute'], $cached['items'] ) && 3 === (int) $cached['version'] && $attribute === $cached['attribute'] ) {
		return $cached['items'];
	}

	$items = array_fill_keys( $options, array( 'available' => false, 'image' => '' ) );
	$product_image_id = absint( $product->get_image_id() );
	$product_image = $product_image_id ? wp_get_attachment_image_url( $product_image_id, 'woocommerce_thumbnail' ) : '';
	// Prefix-free variation attributes use keys such as "pa_color", not "attribute_pa_color".
	$attribute_key = sanitize_title( $attribute );
	foreach ( $product->get_children() as $variation_id ) {
		$variation = wc_get_product( $variation_id );
		if ( ! $variation instanceof WC_Product_Variation || ! $variation->is_purchasable() || ! $variation->is_in_stock() ) continue;

		$attributes = $variation->get_variation_attributes( false );
		$value = isset( $attributes[ $attribute_key ] ) ? (string) $attributes[ $attribute_key ] : '';
		$targets = '' === $value ? $options : array( $value );
		$image_id = absint( $variation->get_image_id() );
		$image = $image_id ? wp_get_attachment_image_url( $image_id, 'woocommerce_thumbnail' ) : '';

		foreach ( $targets as $target ) {
			if ( ! isset( $items[ $target ] ) ) continue;
			$items[ $target ]['available'] = true;
			if ( $image && ! $items[ $target ]['image'] ) $items[ $target ]['image'] = $image;
		}
	}
	foreach ( $items as &$item ) {
		if ( $item['available'] && ! $item['image'] ) $item['image'] = $product_image;
	}
	unset( $item );

	update_post_meta( $product->get_id(), '_belctech_card_swatch_map', array( 'version' => 3, 'attribute' => $attribute, 'items' => $items ) );
	return $items;
}

function belctech_render_loop_color_swatches( $product ) {
	if ( ! $product instanceof WC_Product_Variable ) return;
	$attribute = belctech_card_color_attribute( $product );
	if ( ! $attribute ) return;

	$attributes = $product->get_variation_attributes();
	$options = isset( $attributes[ $attribute ] ) ? array_values( $attributes[ $attribute ] ) : array();
	if ( ! $options ) return;

	$map = belctech_card_swatch_map( $product, $attribute, $options );
	$items = '';
	foreach ( $options as $option ) {
		$term = taxonomy_exists( $attribute ) ? get_term_by( 'slug', $option, $attribute ) : false;
		$name = $term instanceof WP_Term ? $term->name : $option;
		$data = isset( $map[ $option ] ) ? $map[ $option ] : array( 'available' => false, 'image' => '' );
		$classes = array( 'variable-item', 'color-variable-item' );
		if ( ! $data['available'] ) $classes[] = 'disabled';
		$items .= '<li class="' . esc_attr( implode( ' ', $classes ) ) . '" role="radio" tabindex="' . ( $data['available'] ? '0' : '-1' ) . '" aria-checked="false" aria-disabled="' . ( $data['available'] ? 'false' : 'true' ) . '" aria-label="' . esc_attr( $name ) . '" data-value="' . esc_attr( $option ) . '" data-card-image="' . esc_url( $data['image'] ) . '"><span class="variable-item-contents"><span class="variable-item-span variable-item-span-color" style="background-color:' . esc_attr( belctech_swatch_color( $term, $option ) ) . '"></span></span></li>';
	}

	echo '<ul class="variable-items-wrapper belctech-card-swatches color-variable-items-wrapper" role="radiogroup" aria-label="' . esc_attr( wc_attribute_label( $attribute ) ) . '">' . $items . '</ul>';
}

function belctech_clear_card_swatch_cache( $product_id ) {
	$product_id = absint( $product_id );
	if ( 'product_variation' === get_post_type( $product_id ) ) $product_id = wp_get_post_parent_id( $product_id );
	if ( $product_id ) delete_post_meta( $product_id, '_belctech_card_swatch_map' );
}
add_action( 'woocommerce_update_product', 'belctech_clear_card_swatch_cache' );
add_action( 'woocommerce_update_product_variation', 'belctech_clear_card_swatch_cache' );

add_action( 'wp_enqueue_scripts', static function () {
	if ( ! function_exists( 'is_woocommerce' ) ) return;
	global $post;
	$content = $post instanceof WP_Post ? $post->post_content : '';
	$has_product_block = has_shortcode( $content, 'et_product_slider' ) || has_shortcode( $content, 'et_product_masonry' );
	if ( ! is_woocommerce() && ! is_cart() && ! is_checkout() && ! $has_product_block ) return;
	wp_enqueue_script( 'belctech-swatches', BELCTECH_THEME_URI . '/assets/js/belctech-swatches.js', array( 'jquery' ), belctech_asset_version( 'assets/js/belctech-swatches.js' ), true );
}, 30 );
