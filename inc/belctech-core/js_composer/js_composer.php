<?php
/**
 * Integrate with WPBakery Page Builder.
 */

class Belctech_Core_JS_Composer {

	/**
	 * Initialize.
	 */
	public static function init() {

		// Remove Welcome redirects
		remove_action( 'vc_activation_hook', 'vc_page_welcome_set_redirect' );
		remove_action( 'init', 'vc_page_welcome_redirect' );
		remove_action( 'admin_init', 'vc_page_welcome_redirect' );

		// Remove admin bar menu
		remove_action( 'admin_bar_menu', array( vc_frontend_editor(), 'adminBarEditLink' ), 1000 );

		if ( function_exists( 'vc_license' ) ) {
			remove_action( 'admin_notices', array( vc_license(), 'adminNoticeLicenseActivation' ) );
		}

	}

	public static function init_shortcodes() {

		if ( ! function_exists('wpbakery')) return;

		include( BELCTECH_VC_DIR . 'shortcodes/banner-slider.php' );
		include( BELCTECH_VC_DIR . 'shortcodes/banner.php' );
		include( BELCTECH_VC_DIR . 'shortcodes/blog-posts.php' );
		include( BELCTECH_VC_DIR . 'shortcodes/button.php' );
		include( BELCTECH_VC_DIR . 'shortcodes/content-carousel.php' );
		include( BELCTECH_VC_DIR . 'shortcodes/countdown.php' );
		include( BELCTECH_VC_DIR . 'shortcodes/counter.php' );
		include( BELCTECH_VC_DIR . 'shortcodes/gmap.php' );
		include( BELCTECH_VC_DIR . 'shortcodes/gmap-parent.php' );
		include( BELCTECH_VC_DIR . 'shortcodes/hover-card.php' );
		include( BELCTECH_VC_DIR . 'shortcodes/icon-holder.php' );
		include( BELCTECH_VC_DIR . 'shortcodes/icon-box.php' );
		include( BELCTECH_VC_DIR . 'shortcodes/image.php' );
		include( BELCTECH_VC_DIR . 'shortcodes/image-slider.php' );
		include( BELCTECH_VC_DIR . 'shortcodes/lightbox.php' );
		include( BELCTECH_VC_DIR . 'shortcodes/pricing-table.php' );
		include( BELCTECH_VC_DIR . 'shortcodes/pricing-column.php' );
		include( BELCTECH_VC_DIR . 'shortcodes/team-member.php' );
		include( BELCTECH_VC_DIR . 'shortcodes/testimonial-slider.php' );
		include( BELCTECH_VC_DIR . 'shortcodes/testimonial.php' );
		include( BELCTECH_VC_DIR . 'shortcodes/type-auto.php' );
		include( BELCTECH_VC_DIR . 'shortcodes/type-stroke.php' );
		include( BELCTECH_VC_DIR . 'shortcodes/video-lightbox.php' );

		if ( post_type_exists( 'portfolio' ) ) {
			include( BELCTECH_VC_DIR . 'shortcodes/portfolio.php' );
		}

		if (belctech_wc_exists()) {
			include( BELCTECH_VC_DIR . 'shortcodes/product-masonry.php' );
			include( BELCTECH_VC_DIR . 'shortcodes/product-slider.php' );
			include( BELCTECH_VC_DIR . 'shortcodes/product-category-grid.php' );
		}

	}

	/**
	 * Customize default shortcodes of WPBakery Page Builder.
	 */
	public static function customize_elements() {

		include( BELCTECH_VC_DIR . 'vc_elements.php' );
	}

	/**
	 * Undocumented function
	 */
	public static function add_templates() {

		if ( ! get_theme_mod('js_composer_standalone', false) == true ) {
		if (class_exists('WPBakeryVisualComposerAbstract')) {
		// Remove "Template library" tab from Templates modal
				if ( isset( wpbakery()->shared_templates ) ) {
					remove_filter( 'vc_get_all_templates', array( wpbakery()->shared_templates, 'addTemplatesTab' ) );
		}
			}
		}

		// Add new templates
		$vc_element_templates_dir = BELCTECH_VC_DIR . 'vc_elements/';
		vc_set_shortcodes_templates_dir( $vc_element_templates_dir );

		// Belctech intentionally omits remote demo templates. Existing shortcodes
		// and the custom VC element templates remain fully compatible.

	}


	/**
	 * Map theme's shortcodes.
	 */
	public static function map_shortcodes() {
		// Include new VC elements
		include( BELCTECH_VC_DIR . 'elements/banner-slider.php' );
		include( BELCTECH_VC_DIR . 'elements/banner.php' );
		include( BELCTECH_VC_DIR . 'elements/blog-posts.php' );
		include( BELCTECH_VC_DIR . 'elements/button.php' );
		include( BELCTECH_VC_DIR . 'elements/content-carousel.php' );
		include( BELCTECH_VC_DIR . 'elements/countdown.php' );
		include( BELCTECH_VC_DIR . 'elements/counter.php' );
		include( BELCTECH_VC_DIR . 'elements/gmap.php' );
		include( BELCTECH_VC_DIR . 'elements/gmap-parent.php' );
		include( BELCTECH_VC_DIR . 'elements/hover-card.php' );
		include( BELCTECH_VC_DIR . 'elements/icon-holder.php' );
		include( BELCTECH_VC_DIR . 'elements/icon-box.php' );
		include( BELCTECH_VC_DIR . 'elements/image.php' );
		include( BELCTECH_VC_DIR . 'elements/image-slider.php' );
		include( BELCTECH_VC_DIR . 'elements/lightbox.php' );
		include( BELCTECH_VC_DIR . 'elements/pricing-table.php' );
		include( BELCTECH_VC_DIR . 'elements/pricing-column.php' );
		include( BELCTECH_VC_DIR . 'elements/team-member.php' );
		include( BELCTECH_VC_DIR . 'elements/testimonial-slider.php' );
		include( BELCTECH_VC_DIR . 'elements/testimonial.php' );
		include( BELCTECH_VC_DIR . 'elements/type-auto.php' );
		include( BELCTECH_VC_DIR . 'elements/type-stroke.php' );
		include( BELCTECH_VC_DIR . 'elements/video-lightbox.php' );

		if ( post_type_exists( 'portfolio' ) ) {
			include( BELCTECH_VC_DIR . 'elements/portfolio.php' );
		}

		if (belctech_wc_exists()) {
			include( BELCTECH_VC_DIR . 'elements/product-masonry.php' );
			include( BELCTECH_VC_DIR . 'elements/product-slider.php' );
			include( BELCTECH_VC_DIR . 'elements/product-category-grid.php' );
		}

		// Include custom params
		include( BELCTECH_VC_DIR . 'params/iconpicker.php' );

	}

}
