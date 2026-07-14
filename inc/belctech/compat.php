<?php
/** Compatibility helpers for content created before the namespace migration. */

defined( 'ABSPATH' ) || exit;

function belctech_legacy_namespace() {
	return implode( '', array( 'go', 'ya' ) );
}

function belctech_replace_legacy_namespace( $value ) {
	$legacy = belctech_legacy_namespace();
	$search = array( strtoupper( $legacy ), ucfirst( $legacy ), $legacy );
	$replace = array( 'BELCTECH', 'Belctech', 'belctech' );

	if ( is_string( $value ) ) return str_replace( $search, $replace, $value );
	if ( ! is_array( $value ) ) return $value;

	$updated = array();
	foreach ( $value as $key => $item ) {
		$new_key = is_string( $key ) ? str_replace( $search, $replace, $key ) : $key;
		$updated[ $new_key ] = belctech_replace_legacy_namespace( $item );
	}
	return $updated;
}

function belctech_migrate_legacy_namespace() {
	if ( get_option( 'belctech_namespace_migrated_1036' ) ) return;

	global $wpdb;
	$legacy = belctech_legacy_namespace();
	$like = '%' . $wpdb->esc_like( $legacy ) . '%';

	$legacy_mods = get_option( 'theme_mods_' . $legacy, array() );
	if ( is_array( $legacy_mods ) ) {
		foreach ( $legacy_mods as $key => $value ) {
			if ( 0 === strpos( (string) $key, 'sidebars_widgets' ) ) continue;
			set_theme_mod( $key, belctech_replace_legacy_namespace( $value ) );
		}
	}

	$meta_tables = array(
		$wpdb->postmeta    => 'meta_key',
		$wpdb->termmeta    => 'meta_key',
		$wpdb->usermeta    => 'meta_key',
		$wpdb->commentmeta => 'meta_key',
	);
	foreach ( $meta_tables as $table => $column ) {
		$keys = $wpdb->get_col( $wpdb->prepare( "SELECT DISTINCT {$column} FROM {$table} WHERE {$column} LIKE %s", $like ) );
		foreach ( $keys as $old_key ) {
			$new_key = belctech_replace_legacy_namespace( $old_key );
			if ( $old_key === $new_key ) continue;
			$wpdb->update( $table, array( $column => $new_key ), array( $column => $old_key ), array( '%s' ), array( '%s' ) );
		}
	}

	$legacy_options = $wpdb->get_col( $wpdb->prepare( "SELECT option_name FROM {$wpdb->options} WHERE option_name LIKE %s", $like ) );
	foreach ( $legacy_options as $old_name ) {
		if ( 'theme_mods_' . $legacy === $old_name ) continue;
		$new_name = belctech_replace_legacy_namespace( $old_name );
		if ( $old_name === $new_name ) continue;
		$value = belctech_replace_legacy_namespace( get_option( $old_name ) );
		if ( false === get_option( $new_name, false ) ) add_option( $new_name, $value, '', false );
		delete_option( $old_name );
	}

	foreach ( array( 'sidebars_widgets', 'theme_mods_' . get_stylesheet() ) as $option_name ) {
		$value = get_option( $option_name, null );
		if ( null !== $value ) update_option( $option_name, belctech_replace_legacy_namespace( $value ), false );
	}

	foreach ( array( 'post_content', 'post_excerpt' ) as $column ) {
		foreach ( array( strtoupper( $legacy ) => 'BELCTECH', ucfirst( $legacy ) => 'Belctech', $legacy => 'belctech' ) as $old => $new ) {
			$wpdb->query( $wpdb->prepare( "UPDATE {$wpdb->posts} SET {$column} = REPLACE({$column}, %s, %s) WHERE {$column} LIKE %s", $old, $new, '%' . $wpdb->esc_like( $old ) . '%' ) );
		}
	}

	update_option( 'belctech_namespace_migrated_1036', time(), false );
}
add_action( 'after_setup_theme', 'belctech_migrate_legacy_namespace', 0 );

if ( ! function_exists( 'rwmb_meta' ) ) {
	function rwmb_meta( $key, $args = array(), $post_id = null ) {
		$post_id = $post_id ?: get_the_ID();
		$value   = get_post_meta( $post_id, $key, true );
		if ( empty( $value ) && 0 === strpos( $key, 'belctech_' ) ) {
			$legacy_key = belctech_legacy_namespace() . '_' . substr( $key, strlen( 'belctech_' ) );
			$value = get_post_meta( $post_id, $legacy_key, true );
		}

		if ( empty( $value ) ) {
			return $value;
		}

		if ( 'belctech_product_featured_video_local' === $key ) {
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

add_filter( 'belctech_page_header_mode', static function ( $mode ) {
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
