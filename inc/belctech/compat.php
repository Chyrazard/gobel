<?php
/** Compatibility helpers for content created with Goya. */

defined( 'ABSPATH' ) || exit;

function belctech_migrate_goya_theme_mods() {
	if ( get_option( 'belctech_goya_mods_migrated' ) ) return;
	$legacy = get_option( 'theme_mods_goya', array() );
	if ( is_array( $legacy ) ) {
		foreach ( $legacy as $key => $value ) {
			if ( 0 === strpos( (string) $key, 'sidebars_widgets' ) ) continue;
			set_theme_mod( $key, $value );
		}
	}
	update_option( 'belctech_goya_mods_migrated', time(), false );
}
add_action( 'after_switch_theme', 'belctech_migrate_goya_theme_mods', 1 );

if ( ! function_exists( 'rwmb_meta' ) ) {
	function rwmb_meta( $key, $args = array(), $post_id = null ) {
		$post_id = $post_id ?: get_the_ID();
		$value   = get_post_meta( $post_id, $key, true );

		if ( empty( $value ) ) {
			return $value;
		}

		if ( 'goya_product_featured_video_local' === $key ) {
			$values = is_array( $value ) ? $value : array( $value );
			return array_values( array_filter( array_map( static function ( $video ) {
				if ( is_array( $video ) && isset( $video['src'] ) ) {
					return $video;
				}
				$url = is_numeric( $video ) ? wp_get_attachment_url( (int) $video ) : $video;
				return $url ? array( 'src' => $url ) : null;
			}, $values ) ) );
		}

		if ( false !== strpos( $key, 'featured_gallery' ) ) {
			$ids = is_array( $value ) ? $value : preg_split( '/[,\s]+/', (string) $value );
			$size = isset( $args['size'] ) ? $args['size'] : 'full';
			$images = array();
			foreach ( array_filter( array_map( 'absint', $ids ) ) as $id ) {
				$src = wp_get_attachment_image_src( $id, $size );
				if ( $src ) {
					$images[ $id ] = array( 'ID' => $id, 'url' => $src[0], 'full_url' => wp_get_attachment_url( $id ) );
				}
			}
			return $images;
		}

		return $value;
	}
}

// The original loop checks this class before rendering its variation form.
// Remember whether the real plugin owns the implementation to prevent duplicate
// markup while users transition away from it.
$belctech_active_plugins = (array) get_option( 'active_plugins', array() );
$belctech_network_plugins = is_multisite() ? (array) get_site_option( 'active_sitewide_plugins', array() ) : array();
$belctech_swatches_plugin_active = in_array( 'woo-variation-swatches/woo-variation-swatches.php', $belctech_active_plugins, true ) || isset( $belctech_network_plugins['woo-variation-swatches/woo-variation-swatches.php'] );

if ( $belctech_swatches_plugin_active || class_exists( 'Woo_Variation_Swatches' ) ) {
	if ( ! defined( 'BELCTECH_EXTERNAL_SWATCHES' ) ) define( 'BELCTECH_EXTERNAL_SWATCHES', true );
} else {
	if ( ! defined( 'BELCTECH_NATIVE_SWATCHES' ) ) define( 'BELCTECH_NATIVE_SWATCHES', true );
}

add_filter( 'goya_page_header_mode', static function ( $mode ) {
	if ( function_exists( 'is_checkout' ) && is_checkout() ) {
		return 'page-header-regular';
	}
	return get_theme_mod( 'belctech_transparent_header', true ) ? 'page-header-transparent' : $mode;
}, 20 );

add_filter( 'body_class', static function ( $classes ) {
	$classes[] = 'belctech-ecommerce';
	if ( get_theme_mod( 'belctech_transparent_header', true ) ) $classes[] = 'belctech-transparent-header';
	return $classes;
} );
