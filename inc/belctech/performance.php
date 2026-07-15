<?php
/** Conservative performance defaults that do not alter commerce behavior. */

defined( 'ABSPATH' ) || exit;

function belctech_has_any_shortcode( $tags ) {
	global $post;
	if ( ! $post instanceof WP_Post || empty( $post->post_content ) ) return false;
	foreach ( $tags as $tag ) if ( has_shortcode( $post->post_content, $tag ) ) return true;
	return false;
}

function belctech_has_product_content() {
	return belctech_has_any_shortcode( array( 'products', 'product', 'product_page', 'product_category', 'product_categories', 'sale_products', 'best_selling_products', 'top_rated_products', 'featured_products', 'et_product_slider', 'et_product_masonry', 'et_product_category_grid' ) );
}

function belctech_needs_woocommerce_assets() {
	if ( function_exists( 'is_woocommerce' ) && ( is_woocommerce() || is_cart() || is_checkout() || is_account_page() ) ) return true;
	if ( belctech_has_product_content() ) return true;
	return function_exists( 'WC' ) && WC()->cart && ! WC()->cart->is_empty();
}

function belctech_needs_wpbakery_assets() {
	global $post;
	if ( ! $post instanceof WP_Post || empty( $post->post_content ) ) return false;
	return false !== strpos( $post->post_content, '[vc_' ) || false !== strpos( $post->post_content, '[et_' );
}

function belctech_needs_carousel() {
	if ( function_exists( 'is_product' ) && is_product() ) return true;
	if ( function_exists( 'is_cart' ) && is_cart() ) return true;
	if ( get_theme_mod( 'campaign_bar', false ) ) return true;
	return belctech_has_any_shortcode( array( 'et_banner_slider', 'et_product_slider', 'et_image_slider', 'et_testimonial_slider', 'et_content_carousel' ) );
}

function belctech_needs_masonry() {
	if ( is_home() || ( is_archive() && ! ( function_exists( 'is_woocommerce' ) && is_woocommerce() ) ) ) return true;
	return belctech_has_any_shortcode( array( 'et_product_masonry', 'et_portfolio', 'et_posts' ) );
}

function belctech_needs_popup() {
	if ( get_theme_mod( 'popup_modal', false ) || get_theme_mod( 'main_header_login_popup', false ) || get_theme_mod( 'wp_gallery_popup', false ) ) return true;
	if ( function_exists( 'is_woocommerce' ) && ( is_woocommerce() || is_cart() || is_checkout() ) ) return true;
	return belctech_has_any_shortcode( array( 'et_lightbox', 'et_video_lightbox' ) );
}

function belctech_cached_custom_styles() {
	$key = 'belctech_css_' . md5( wp_json_encode( get_theme_mods() ) );
	$css = get_transient( $key );
	if ( false === $css ) {
		$css = function_exists( 'belctech_custom_styles' ) ? belctech_custom_styles() : '';
		set_transient( $key, $css, WEEK_IN_SECONDS );
	}
	return $css;
}

remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
add_filter( 'emoji_svg_url', '__return_false' );

add_action( 'wp_enqueue_scripts', static function () {
	if ( ! is_user_logged_in() ) wp_dequeue_style( 'dashicons' );
	wp_dequeue_script( 'wp-embed' );
	foreach ( array( 'modernizr', 'mobile-detect', 'in-viewport', 'magnific-popup', 'sticky-kit', 'jquery-slick', 'isotope-pk', 'packery', 'arrive', 'belctech-app', 'belctech-swatches', 'belctech-buy-now' ) as $handle ) {
		wp_script_add_data( $handle, 'strategy', 'defer' );
	}
}, 100 );

// Gift-card plugins enqueue checkout helpers globally. The home has no gift-card
// form, so these requests can be omitted there without affecting product flows.
add_action( 'wp_enqueue_scripts', static function () {
	if ( ! is_front_page() ) return;
	foreach ( array( 'jquery-ui-datepicker', 'mwb_wgm_balance_check', 'namejs' ) as $handle ) {
		wp_dequeue_script( $handle );
	}
	foreach ( array( 'mwb_wgm_common_css', 'name' ) as $handle ) {
		wp_dequeue_style( $handle );
	}
}, 999 );

add_filter( 'wp_resource_hints', static function ( $urls, $relation ) {
	if ( 'dns-prefetch' === $relation ) return array_values( array_diff( $urls, array( '//s.w.org' ) ) );
	return $urls;
}, 10, 2 );

function belctech_product_lcp_image_id() {
	static $image_id = null;
	if ( null !== $image_id ) return $image_id;
	$image_id = 0;
	if ( ! function_exists( 'is_product' ) || ! is_product() || ! function_exists( 'wc_get_product' ) ) return $image_id;

	$product = wc_get_product( get_queried_object_id() );
	if ( ! $product ) return $image_id;
	$image_id = (int) $product->get_image_id();
	if ( ! $product->is_type( 'variable' ) ) return $image_id;

	$defaults = $product->get_default_attributes();
	if ( empty( $defaults ) || ! class_exists( 'WC_Data_Store' ) ) return $image_id;
	$match_attributes = array();
	foreach ( $defaults as $name => $value ) $match_attributes[ 'attribute_' . sanitize_title( $name ) ] = $value;
	$data_store   = WC_Data_Store::load( 'product' );
	$variation_id = $data_store->find_matching_product_variation( $product, $match_attributes );
	if ( $variation_id ) {
		$variation = wc_get_product( $variation_id );
		if ( $variation && $variation->get_image_id() ) $image_id = (int) $variation->get_image_id();
	}
	return $image_id;
}

function belctech_product_gallery_image_ids() {
	static $image_ids = null;
	if ( null !== $image_ids ) return $image_ids;
	$image_ids = array();
	if ( ! function_exists( 'is_product' ) || ! is_product() || ! function_exists( 'wc_get_product' ) ) return $image_ids;
	$product = wc_get_product( get_queried_object_id() );
	if ( ! $product ) return $image_ids;
	$image_ids = array_map( 'intval', $product->get_gallery_image_ids() );
	if ( $product->get_image_id() ) $image_ids[] = (int) $product->get_image_id();
	return array_values( array_unique( $image_ids ) );
}

add_filter( 'wp_get_attachment_image_attributes', static function ( $attributes, $attachment ) {
	$attributes['decoding'] = 'async';
	if ( false !== strpos( ' ' . ( $attributes['class'] ?? '' ) . ' ', ' product_thumbnail_hover ' ) && ! empty( $attributes['src'] ) ) {
		$attributes['data-belctech-hover-src'] = $attributes['src'];
		if ( ! empty( $attributes['srcset'] ) ) $attributes['data-belctech-hover-srcset'] = $attributes['srcset'];
		if ( ! empty( $attributes['sizes'] ) ) $attributes['data-belctech-hover-sizes'] = $attributes['sizes'];
		$attributes['src'] = 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==';
		unset( $attributes['srcset'], $attributes['sizes'] );
	}
	if ( function_exists( 'is_product' ) && is_product() && $attachment instanceof WP_Post ) {
		$attachment_id = (int) $attachment->ID;
		if ( in_array( $attachment_id, belctech_product_gallery_image_ids(), true ) ) $attributes['loading'] = 'eager';
		if ( in_array( $attachment_id, array( (int) get_post_thumbnail_id( get_queried_object_id() ), belctech_product_lcp_image_id() ), true ) ) {
			$attributes['loading'] = 'eager';
			$attributes['fetchpriority'] = 'high';
		}
	}
	return $attributes;
}, 20, 2 );

// The store uses Jost globally; keep it local and remove every remote font import.
add_filter( 'wp_get_custom_css', static function ( $css ) {
	return preg_replace( '#@import[^\r\n]*fonts\.googleapis\.com[^\r\n]*(?:\r?\n|$)#i', '', (string) $css );
}, 999 );

add_action( 'wp_head', static function () {
	echo '<link rel="preload" href="' . esc_url( BELCTECH_THEME_URI . '/assets/fonts/jost-latin.woff2' ) . '" as="font" type="font/woff2" crossorigin>';
}, 2 );

add_action( 'wp_head', static function () {
	if ( ! is_front_page() ) return;
	?>
	<style id="belctech-home-banner-critical">
	.banner-movil-wrapper{display:none}
	@media(max-width:1024px){
		.banner-movil-wrapper{display:block;position:relative;width:100vw;left:50%;right:50%;margin-left:-50vw;margin-right:-50vw;overflow:hidden;margin-top:-1px;padding-top:0}
		.banner-movil-inner{position:relative;width:100%;aspect-ratio:1080/1920}
		.banner-movil-img{width:100%;height:auto;display:block}
		.banner-movil-img:not(.first){position:absolute;inset:0;opacity:0}
	}
	</style>
	<?php
}, 2 );

add_action( 'wp_head', static function () {
	$image_id = belctech_product_lcp_image_id();
	if ( ! $image_id || $image_id === (int) get_post_thumbnail_id( get_queried_object_id() ) ) return;
	$src    = wp_get_attachment_image_url( $image_id, 'woocommerce_single' );
	$srcset = wp_get_attachment_image_srcset( $image_id, 'woocommerce_single' );
	if ( ! $src ) return;
	echo '<link rel="preload" as="image" href="' . esc_url( $src ) . '" fetchpriority="high"';
	if ( $srcset ) echo ' imagesrcset="' . esc_attr( $srcset ) . '" imagesizes="(max-width: 767px) 100vw, 58vw"';
	echo '>';
}, 3 );

function belctech_optimize_front_page_content( $content ) {
	if ( ! is_front_page() || ! class_exists( 'WP_HTML_Tag_Processor' ) ) return $content;

	$processor = new WP_HTML_Tag_Processor( $content );
	$desktop_hero_seen = false;
	while ( $processor->next_tag() ) {
		$tag = $processor->get_tag();
		if ( 'IMG' === $tag ) {
			$class = ' ' . (string) $processor->get_attribute( 'class' ) . ' ';
			if ( false !== strpos( $class, ' banner-movil-img ' ) ) {
				if ( false !== strpos( $class, ' first ' ) ) {
					$processor->set_attribute( 'loading', 'eager' );
					$processor->set_attribute( 'fetchpriority', 'high' );
				} else {
					$processor->set_attribute( 'data-belctech-banner-src', (string) $processor->get_attribute( 'src' ) );
					$processor->set_attribute( 'src', 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==' );
					$processor->set_attribute( 'loading', 'lazy' );
					$processor->set_attribute( 'fetchpriority', 'low' );
				}
			} elseif ( false !== strpos( $class, ' ultra-img ' ) ) {
				$attachment_id = attachment_url_to_postid( (string) $processor->get_attribute( 'src' ) );
				if ( $attachment_id ) {
					$srcset = wp_get_attachment_image_srcset( $attachment_id, 'full' );
					if ( $srcset ) $processor->set_attribute( 'srcset', $srcset );
					$processor->set_attribute( 'sizes', '(max-width: 767px) 50vw, 25vw' );
				}
			} elseif ( ! $desktop_hero_seen && false !== strpos( $class, ' et_image_slider-img ' ) ) {
				$processor->set_attribute( 'loading', 'eager' );
				$processor->set_attribute( 'fetchpriority', 'high' );
				$desktop_hero_seen = true;
			}
		} elseif ( 'A' === $tag ) {
			$class = ' ' . (string) $processor->get_attribute( 'class' ) . ' ';
			if ( false !== strpos( $class, ' try ' ) && ! $processor->get_attribute( 'aria-label' ) ) {
				$processor->set_attribute( 'aria-label', 'Ver nueva coleccion' );
			}
		}
	}

	return $processor->get_updated_html();
}
add_filter( 'the_content', 'belctech_optimize_front_page_content', 99 );

add_action( 'wp_footer', static function () {
	if ( ! is_front_page() ) return;
	?>
	<script data-no-optimize="1">
	(function () {
		var images = document.querySelectorAll('.banner-movil-img[data-belctech-banner-src]');
		images.forEach(function (image, index) {
			window.setTimeout(function () {
				image.src = image.getAttribute('data-belctech-banner-src');
				image.removeAttribute('data-belctech-banner-src');
			}, 4500 + (index * 3000));
		});
	}());
	</script>
	<?php
}, 20 );

function belctech_optimize_footer_brand( $html ) {
	if ( ! class_exists( 'WP_HTML_Tag_Processor' ) || false === strpos( (string) $html, 'logo-png-BELC.png' ) ) return $html;
	$processor = new WP_HTML_Tag_Processor( $html );
	while ( $processor->next_tag( 'img' ) ) {
		$src = (string) $processor->get_attribute( 'src' );
		if ( false === strpos( $src, 'logo-png-BELC.png' ) ) continue;
		$processor->set_attribute( 'src', BELCTECH_THEME_URI . '/assets/img/belctech-footer-logo.png' );
		$processor->set_attribute( 'alt', 'Belctech' );
		$processor->set_attribute( 'width', '32' );
		$processor->set_attribute( 'height', '32' );
	}
	return $processor->get_updated_html();
}
add_filter( 'theme_mod_footer_bar_copyright', 'belctech_optimize_footer_brand', 20 );
add_filter( 'theme_mod_footer_bar_custom_text', 'belctech_optimize_footer_brand', 20 );
add_filter( 'theme_mod_footer_bar_custom_text2', 'belctech_optimize_footer_brand', 20 );

// Non-commerce pages receive the large shop stylesheet without blocking first
// paint. It is still ready for the header mini-cart when the user interacts.
add_filter( 'style_loader_tag', static function ( $html, $handle ) {
	if ( 'belctech-shop' !== $handle || belctech_needs_woocommerce_assets() ) return $html;
	$html = str_replace( "media='all'", "media='print' onload=\"this.media='all'\"", $html );
	return $html . '<noscript>' . str_replace( "media='print' onload=\"this.media='all'\"", "media='all'", $html ) . '</noscript>';
}, 20, 2 );

add_filter( 'heartbeat_settings', static function ( $settings ) {
	$screen = function_exists( 'get_current_screen' ) ? get_current_screen() : null;
	if ( ! $screen || ! in_array( $screen->base, array( 'post', 'post-new' ), true ) ) $settings['interval'] = 60;
	return $settings;
} );

// Use WordPress native image loading instead of the older JavaScript lazy loader.
add_filter( 'belctech_do_lazyload', '__return_false', 100 );
