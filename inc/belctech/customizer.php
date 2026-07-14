<?php
/** Lean native Customizer controls for the theme's primary commerce workflows. */

defined( 'ABSPATH' ) || exit;

function belctech_swatch_color_definitions() {
	return array(
		'amarillo'      => array( 'label' => 'Amarillo', 'default' => '#F2CF45', 'aliases' => array( 'amarillo' ) ),
		'azul'          => array( 'label' => 'Azul / Azul navy', 'default' => '#416B9B', 'aliases' => array( 'azul', 'azul-navy', 'azulnavy' ) ),
		'azul-claro'    => array( 'label' => 'Azul claro', 'default' => '#9CCFE5', 'aliases' => array( 'azul-claro', 'azulclaro' ) ),
		'beige'         => array( 'label' => 'Beige', 'default' => '#D8C4A8', 'aliases' => array( 'beige' ) ),
		'blanco'        => array( 'label' => 'Blanco', 'default' => '#FFFFFF', 'aliases' => array( 'blanco' ) ),
		'cafe'          => array( 'label' => 'Cafe / Marron', 'default' => '#76513B', 'aliases' => array( 'cafe', 'cafe-oscuro', 'cafeoscuro', 'marron' ) ),
		'coral'         => array( 'label' => 'Coral', 'default' => '#EF7D73', 'aliases' => array( 'coral' ) ),
		'crema'         => array( 'label' => 'Crema', 'default' => '#F7F1E7', 'aliases' => array( 'crema' ) ),
		'fucsia'        => array( 'label' => 'Fucsia', 'default' => '#D83A8E', 'aliases' => array( 'fucsia' ) ),
		'gris'          => array( 'label' => 'Gris', 'default' => '#9A9A9A', 'aliases' => array( 'gris' ) ),
		'morado'        => array( 'label' => 'Morado', 'default' => '#74518A', 'aliases' => array( 'morado' ) ),
		'naranja'       => array( 'label' => 'Naranja', 'default' => '#EF8D32', 'aliases' => array( 'naranja' ) ),
		'negro'         => array( 'label' => 'Negro', 'default' => '#222222', 'aliases' => array( 'negro' ) ),
		'rojo'          => array( 'label' => 'Rojo', 'default' => '#C73535', 'aliases' => array( 'rojo' ) ),
		'rosado'        => array( 'label' => 'Rosa / Rosado', 'default' => '#E6A8BD', 'aliases' => array( 'rosa', 'rosado' ) ),
		'terracota'     => array( 'label' => 'Terracota', 'default' => '#E35336', 'aliases' => array( 'terracota' ) ),
		'verde'         => array( 'label' => 'Verde', 'default' => '#4F7C52', 'aliases' => array( 'verde' ) ),
		'verde-menta'   => array( 'label' => 'Verde menta', 'default' => '#A8DFC1', 'aliases' => array( 'verde-menta', 'verdementa' ) ),
		'verde-militar' => array( 'label' => 'Verde militar', 'default' => '#4B5320', 'aliases' => array( 'verde-militar', 'verdemilitar' ) ),
		'vino-tinto'    => array( 'label' => 'Vino tinto / Uva vino', 'default' => '#7B263A', 'aliases' => array( 'vino-tinto', 'vinotinto', 'uva-vino', 'uvavino' ) ),
	);
}

function belctech_sanitize_swatch_assignments( $value ) {
	$lines = preg_split( '/\r\n|\r|\n/', (string) $value );
	$clean = array();
	foreach ( $lines as $line ) {
		if ( ! preg_match( '/^\s*([^:=]+?)\s*[:=]\s*(#[0-9a-fA-F]{3}(?:[0-9a-fA-F]{3})?)\s*$/', $line, $matches ) ) continue;
		$slug = sanitize_title( remove_accents( trim( $matches[1] ) ) );
		$color = sanitize_hex_color( $matches[2] );
		if ( $slug && $color ) $clean[ $slug ] = strtoupper( $color );
	}
	$output = array();
	foreach ( $clean as $slug => $color ) $output[] = $slug . ' = ' . $color;
	return implode( "\n", $output );
}

function belctech_customize_register( WP_Customize_Manager $customizer ) {
	$customizer->add_panel( 'belctech_header', array( 'title' => __( 'Header', 'belctech-ecommerce' ), 'priority' => 30 ) );
	$customizer->add_panel( 'belctech_shop', array( 'title' => __( 'Shop', 'belctech-ecommerce' ), 'priority' => 31 ) );
	$customizer->add_panel( 'belctech_product', array( 'title' => __( 'Single Product', 'belctech-ecommerce' ), 'priority' => 32 ) );
	$customizer->add_panel( 'belctech_footer', array( 'title' => __( 'Footer', 'belctech-ecommerce' ), 'priority' => 33 ) );
	$customizer->add_section( 'belctech_swatches_assign', array(
		'title'       => __( 'Swatchers Assign', 'belctech-ecommerce' ),
		'description' => __( 'Assign colors using the same variation slug shown as data-value in product swatches.', 'belctech-ecommerce' ),
		'priority'    => 34,
	) );

	belctech_customizer_section( $customizer, 'belctech_header_layout', 'Layout', 'belctech_header' );
	belctech_customizer_section( $customizer, 'belctech_header_brand', 'Logo and dimensions', 'belctech_header' );
	belctech_customizer_section( $customizer, 'belctech_header_campaign', 'Campaign bar', 'belctech_header' );
	belctech_customizer_section( $customizer, 'belctech_shop_cards', 'Product cards', 'belctech_shop' );
	belctech_customizer_section( $customizer, 'belctech_shop_quickview', 'Quick view', 'belctech_shop' );
	belctech_customizer_section( $customizer, 'belctech_product_layout', 'Product layout', 'belctech_product' );
	belctech_customizer_section( $customizer, 'belctech_product_gallery', 'Product gallery', 'belctech_product' );
	belctech_customizer_section( $customizer, 'belctech_product_size', 'Size guide', 'belctech_product' );
	belctech_customizer_section( $customizer, 'belctech_footer_columns', 'Footer de 4 columnas', 'belctech_footer' );

	belctech_customize_field( $customizer, 'header_sticky', 'Sticky header', 'belctech_header_layout', 'checkbox', true );
	belctech_customize_field( $customizer, 'belctech_transparent_header', 'Transparent header at top', 'belctech_header_layout', 'checkbox', true );
	$header_versions = array();
	foreach ( range( 1, 9 ) as $number ) {
		$header_versions[ 'v' . $number ] = 'Header V' . $number;
	}
	belctech_customize_field( $customizer, 'header_version', 'Header preset', 'belctech_header_layout', 'select', 'v6', $header_versions );
	belctech_customize_field( $customizer, 'header_full_width', 'Full-width header', 'belctech_header_layout', 'checkbox', false );
	belctech_customize_field( $customizer, 'main_header_login_icon', 'Account display', 'belctech_header_layout', 'select', 'icon', array( 'icon' => 'User icon', 'text' => 'My account text' ) );
	belctech_customize_field( $customizer, 'main_header_login_popup', 'Account login popup (heavier)', 'belctech_header_layout', 'checkbox', false );
	belctech_customize_field( $customizer, 'site_logo', 'General logo', 'belctech_header_brand', 'image', '' );
	belctech_customize_field( $customizer, 'site_logo_dark', 'Logo on transparent header', 'belctech_header_brand', 'image', '' );
	belctech_customize_field( $customizer, 'header_height', 'Desktop header height', 'belctech_header_brand', 'number', 90, array( 'min' => 56, 'max' => 160, 'step' => 1 ) );
	belctech_customize_field( $customizer, 'header_height_sticky', 'Sticky header height', 'belctech_header_brand', 'number', 70, array( 'min' => 48, 'max' => 110, 'step' => 1 ) );
	belctech_customize_field( $customizer, 'header_height_mobile', 'Mobile header height', 'belctech_header_brand', 'number', 60, array( 'min' => 48, 'max' => 90, 'step' => 1 ) );
	belctech_customize_field( $customizer, 'logo_height', 'Normal logo height', 'belctech_header_brand', 'number', 42, array( 'min' => 16, 'max' => 90, 'step' => 1 ) );
	belctech_customize_field( $customizer, 'logo_height_sticky', 'Sticky logo height', 'belctech_header_brand', 'number', 28, array( 'min' => 14, 'max' => 70, 'step' => 1 ) );
	belctech_customize_field( $customizer, 'logo_height_mobile', 'Mobile logo height', 'belctech_header_brand', 'number', 30, array( 'min' => 14, 'max' => 60, 'step' => 1 ) );

	$legacy_campaign = get_theme_mod( 'campaign_bar_content', '' );
	$legacy_items = get_theme_mod( 'campaign_bar_items', array() );
	if ( is_array( $legacy_items ) && ! empty( $legacy_items[0]['campaign_text'] ) ) $legacy_campaign = $legacy_items[0]['campaign_text'];
	belctech_customize_field( $customizer, 'campaign_bar', 'Show campaign bar', 'belctech_header_campaign', 'checkbox', false );
	belctech_customize_field( $customizer, 'campaign_bar_message_1', 'Message 1', 'belctech_header_campaign', 'textarea', $legacy_campaign );
	belctech_customize_field( $customizer, 'campaign_bar_link_1', 'Message 1 link', 'belctech_header_campaign', 'url', '' );
	belctech_customize_field( $customizer, 'campaign_bar_message_2', 'Message 2', 'belctech_header_campaign', 'textarea', '' );
	belctech_customize_field( $customizer, 'campaign_bar_link_2', 'Message 2 link', 'belctech_header_campaign', 'url', '' );
	belctech_customize_field( $customizer, 'campaign_bar_message_3', 'Message 3', 'belctech_header_campaign', 'textarea', '' );
	belctech_customize_field( $customizer, 'campaign_bar_link_3', 'Message 3 link', 'belctech_header_campaign', 'url', '' );
	belctech_customize_field( $customizer, 'campaign_layout', 'Message layout', 'belctech_header_campaign', 'select', 'slider', array( 'slider' => 'Rotate messages', 'inline' => 'Show messages inline' ) );
	belctech_customize_field( $customizer, 'campaign_autoplay_speed', 'Rotation speed (ms)', 'belctech_header_campaign', 'number', 3000, array( 'min' => 1500, 'max' => 12000, 'step' => 250 ) );
	belctech_customize_field( $customizer, 'campaign_slider_transition', 'Transition', 'belctech_header_campaign', 'select', 'slide', array( 'slide' => 'Slide', 'fade' => 'Fade' ) );
	belctech_customize_field( $customizer, 'campaign_bar_dismissible', 'Allow visitors to close it', 'belctech_header_campaign', 'checkbox', false );
	belctech_customize_field( $customizer, 'campaign_bar_background_color', 'Background color', 'belctech_header_campaign', 'color', '#e97a7e' );
	belctech_customize_field( $customizer, 'campaign_bar_font_color', 'Text color', 'belctech_header_campaign', 'color', '#ffffff' );

	belctech_customize_field( $customizer, 'shop_product_listing', 'Card style', 'belctech_shop_cards', 'select', 'style1', array( 'style1' => 'Style 1', 'style2' => 'Style 2', 'style3' => 'Style 3', 'style4' => 'Style 4' ) );
	belctech_customize_field( $customizer, 'shop_product_img_hover', 'Additional image on hover', 'belctech_shop_cards', 'checkbox', true );
	belctech_customize_field( $customizer, 'archive_show_swatches', 'Color/image swatches', 'belctech_shop_cards', 'checkbox', true );
	belctech_customize_field( $customizer, 'archive_check_variants_stock', 'Mark unavailable variations', 'belctech_shop_cards', 'checkbox', true );
	belctech_customize_field( $customizer, 'archive_swatches_position', 'Swatch position', 'belctech_shop_cards', 'select', 'bottom', array( 'bottom' => 'Below card', 'side' => 'Image side' ) );
	belctech_customize_field( $customizer, 'product_quickview', 'Enable quick view', 'belctech_shop_quickview', 'checkbox', true );
	belctech_customize_field( $customizer, 'product_quickview_atc', 'Add to cart in quick view', 'belctech_shop_quickview', 'checkbox', true );

	belctech_customize_field( $customizer, 'product_layout_single', 'Product layout', 'belctech_product_layout', 'select', 'regular', array( 'regular' => 'Regular', 'showcase' => 'Showcase', 'no-padding' => 'No padding', 'full-width' => 'Full width' ) );
	belctech_customize_field( $customizer, 'product_details_style', 'Details style', 'belctech_product_layout', 'select', 'tabs', array( 'tabs' => 'Tabs', 'accordion' => 'Accordion', 'vertical' => 'Vertical' ) );
	belctech_customize_field( $customizer, 'product_sticky_bar', 'Sticky product bar', 'belctech_product_layout', 'checkbox', true );
	belctech_customize_field( $customizer, 'product_single_buy_now', 'Show Buy now button', 'belctech_product_layout', 'checkbox', true );
	belctech_customize_field( $customizer, 'product_buy_now_label', 'Buy now label', 'belctech_product_layout', 'text', 'Comprar ahora' );
	belctech_customize_field( $customizer, 'product_button_radius', 'Product button radius', 'belctech_product_layout', 'number', 6, array( 'min' => 0, 'max' => 24, 'step' => 1 ) );
	belctech_customize_field( $customizer, 'product_gallery_style', 'Gallery style', 'belctech_product_gallery', 'select', 'carousel', array( 'carousel' => 'Slider', 'column' => 'Column', 'grid' => 'Grid' ) );
	belctech_customize_field( $customizer, 'product_gallery_transition', 'Slider transition', 'belctech_product_gallery', 'select', 'slide', array( 'slide' => 'Slide', 'fade' => 'Fade' ) );
	belctech_customize_field( $customizer, 'product_image_lightbox', 'Image lightbox', 'belctech_product_gallery', 'checkbox', true );
	belctech_customize_field( $customizer, 'product_image_hover_zoom', 'Image zoom', 'belctech_product_gallery', 'checkbox', false );
	belctech_customize_field( $customizer, 'product_size_guide', 'Enable size guide', 'belctech_product_size', 'checkbox', true );
	belctech_customize_field( $customizer, 'product_size_page', 'Default size guide page', 'belctech_product_size', 'dropdown-pages', '' );

	belctech_customize_field( $customizer, 'footer_widgets', 'Enable footer', 'belctech_footer_columns', 'checkbox', true );
	belctech_customize_field( $customizer, 'footer_widgets_columns', 'Columns', 'belctech_footer_columns', 'select', 4, array( 1 => '1', 2 => '2', 3 => '3', 4 => '4' ) );
	belctech_customize_field( $customizer, 'footer_widgets_mode', 'Color scheme', 'belctech_footer_columns', 'select', 'light', array( 'light' => 'Light', 'dark' => 'Dark' ) );
	belctech_customize_field( $customizer, 'footer_bar_copyright', 'Copyright', 'belctech_footer_columns', 'textarea', '© [current_year] Belctech' );

	foreach ( belctech_swatch_color_definitions() as $slug => $definition ) {
		belctech_customize_field( $customizer, 'belctech_swatch_color_' . str_replace( '-', '_', $slug ), $definition['label'], 'belctech_swatches_assign', 'color', $definition['default'] );
	}
	belctech_customize_field( $customizer, 'belctech_swatch_default_color', 'Fallback color', 'belctech_swatches_assign', 'color', '#CCCCCC' );
	$customizer->add_setting( 'belctech_swatch_custom_assignments', array(
		'default'           => '',
		'sanitize_callback' => 'belctech_sanitize_swatch_assignments',
		'transport'         => 'refresh',
	) );
	$customizer->add_control( 'belctech_swatch_custom_assignments', array(
		'label'       => __( 'Additional colors', 'belctech-ecommerce' ),
		'description' => __( 'One per line. Example: lavanda = #B8A2D8', 'belctech-ecommerce' ),
		'section'     => 'belctech_swatches_assign',
		'settings'    => 'belctech_swatch_custom_assignments',
		'type'        => 'textarea',
	) );
}
add_action( 'customize_register', 'belctech_customize_register', 20 );

function belctech_customizer_section( $customizer, $id, $title, $panel ) {
	$customizer->add_section( $id, array( 'title' => __( $title, 'belctech-ecommerce' ), 'panel' => $panel ) );
}

function belctech_customize_field( $customizer, $id, $label, $section, $type, $default, $choices = array() ) {
	$sanitize = 'sanitize_text_field';
	if ( 'checkbox' === $type ) $sanitize = 'belctech_sanitize_checkbox';
	if ( 'number' === $type ) $sanitize = 'absint';
	if ( 'textarea' === $type ) $sanitize = 'wp_kses_post';
	if ( 'image' === $type ) $sanitize = 'esc_url_raw';
	if ( 'url' === $type ) $sanitize = 'esc_url_raw';
	if ( 'color' === $type ) $sanitize = 'sanitize_hex_color';
	$customizer->add_setting( $id, array( 'default' => $default, 'sanitize_callback' => $sanitize, 'transport' => 'refresh' ) );
	$args = array( 'label' => __( $label, 'belctech-ecommerce' ), 'section' => $section, 'settings' => $id, 'type' => $type );
	if ( 'number' === $type ) {
		$args['input_attrs'] = $choices;
	} else {
		$args['choices'] = $choices;
	}
	if ( 'image' === $type ) {
		$customizer->add_control( new WP_Customize_Image_Control( $customizer, $id, $args ) );
	} elseif ( 'color' === $type ) {
		$customizer->add_control( new WP_Customize_Color_Control( $customizer, $id, $args ) );
	} else {
		$customizer->add_control( $id, $args );
	}
}

function belctech_sanitize_checkbox( $value ) {
	return (bool) $value;
}

function belctech_topbar_elements_list() {
	return apply_filters( 'belctech_topbar_elements_list', array(
		'menu'       => __( 'Menu Top Bar', 'belctech-ecommerce' ),
		'currency'   => __( 'Currency Selector', 'belctech-ecommerce' ),
		'language'   => __( 'Language Selector', 'belctech-ecommerce' ),
		'social'     => __( 'Social Icons', 'belctech-ecommerce' ),
		'text'       => __( 'Text 1', 'belctech-ecommerce' ),
		'text2'      => __( 'Text 2', 'belctech-ecommerce' ),
		'text3'      => __( 'Text 3', 'belctech-ecommerce' ),
		'search'     => __( 'Search Icon', 'belctech-ecommerce' ),
		'search-box' => __( 'Search Box', 'belctech-ecommerce' ),
		'cart'       => __( 'Cart Icon', 'belctech-ecommerce' ),
		'hamburger'  => __( 'Hamburger Icon', 'belctech-ecommerce' ),
		'wishlist'   => __( 'Wishlist Icon', 'belctech-ecommerce' ),
		'account'    => __( 'Account Link', 'belctech-ecommerce' ),
	) );
}

function belctech_header_elements_list() {
	return apply_filters( 'belctech_header_elements_list', array(
		'logo'           => __( 'Logo', 'belctech-ecommerce' ),
		'account'        => __( 'Account Link', 'belctech-ecommerce' ),
		'cart'           => __( 'Cart Icon', 'belctech-ecommerce' ),
		'currency'       => __( 'Currency Selector', 'belctech-ecommerce' ),
		'hamburger'      => __( 'Hamburger Icon', 'belctech-ecommerce' ),
		'language'       => __( 'Language Selector', 'belctech-ecommerce' ),
		'menu-primary'   => __( 'Menu Primary', 'belctech-ecommerce' ),
		'menu-secondary' => __( 'Menu Secondary', 'belctech-ecommerce' ),
		'search'         => __( 'Search Icon', 'belctech-ecommerce' ),
		'search-box'     => __( 'Search Box', 'belctech-ecommerce' ),
		'social'         => __( 'Social Icons', 'belctech-ecommerce' ),
		'text'           => __( 'Text 1', 'belctech-ecommerce' ),
		'text2'          => __( 'Text 2', 'belctech-ecommerce' ),
		'text3'          => __( 'Text 3', 'belctech-ecommerce' ),
		'wishlist'       => __( 'Wishlist Icon', 'belctech-ecommerce' ),
	) );
}

function belctech_footer_elements_list() {
	return apply_filters( 'belctech_footer_elements_list', array(
		'copyright'         => __( 'Copyright', 'belctech-ecommerce' ),
		'currency'          => __( 'Currency Selector', 'belctech-ecommerce' ),
		'currency_language' => __( 'Currency & Language Selector', 'belctech-ecommerce' ),
		'language'          => __( 'Language Selector', 'belctech-ecommerce' ),
		'menu'              => __( 'Menu Footer', 'belctech-ecommerce' ),
		'social'            => __( 'Social Icons', 'belctech-ecommerce' ),
		'text'              => __( 'Text 1', 'belctech-ecommerce' ),
		'text2'             => __( 'Text 2', 'belctech-ecommerce' ),
	) );
}

function belctech_mobile_header_elements_list() {
	return apply_filters( 'belctech_mobile_header_elements_list', array(
		'cart'     => __( 'Cart', 'belctech-ecommerce' ),
		'account'  => __( 'Account', 'belctech-ecommerce' ),
		'search'   => __( 'Search', 'belctech-ecommerce' ),
		'wishlist' => __( 'Wishlist', 'belctech-ecommerce' ),
		'currency' => __( 'Currency Selector', 'belctech-ecommerce' ),
		'language' => __( 'Language Selector', 'belctech-ecommerce' ),
		'text'     => __( 'Text 1', 'belctech-ecommerce' ),
	) );
}

function belctech_design_css() {
	$header        = max( 56, min( 160, absint( get_theme_mod( 'header_height', 90 ) ) ) );
	$sticky        = max( 48, min( 110, absint( get_theme_mod( 'header_height_sticky', 70 ) ) ) );
	$logo          = max( 16, min( 90, absint( get_theme_mod( 'logo_height', 42 ) ) ) );
	$logo_sticky   = max( 14, min( 70, absint( get_theme_mod( 'logo_height_sticky', 28 ) ) ) );
	$logo_mobile   = max( 14, min( 60, absint( get_theme_mod( 'logo_height_mobile', 30 ) ) ) );
	$campaign_bg   = sanitize_hex_color( get_theme_mod( 'campaign_bar_background_color', get_theme_mod( 'campaign_bar_background', '#e97a7e' ) ) ) ?: '#e97a7e';
	$campaign_text = sanitize_hex_color( get_theme_mod( 'campaign_bar_font_color', get_theme_mod( 'campaign_bar_text_color', '#ffffff' ) ) ) ?: '#ffffff';
	$button_radius = max( 0, min( 24, absint( get_theme_mod( 'product_button_radius', 6 ) ) ) );

	return ':root{--belctech-header-height:' . $header . 'px;--belctech-sticky-height:' . $sticky . 'px;--belctech-campaign-bg:' . $campaign_bg . ';--belctech-campaign-text:' . $campaign_text . ';--belctech-product-button-radius:' . $button_radius . 'px;}'
		. '.et-global-campaign{background-color:var(--belctech-campaign-bg)!important;color:var(--belctech-campaign-text)!important}'
		. '@media(min-width:992px){.site-header,.header-spacer{height:' . $header . 'px!important}.header_on_scroll:not(.megamenu-active) .site-header,.header_on_scroll:not(.megamenu-active) .header-spacer{height:' . $sticky . 'px!important}.site-header .logoimg{width:auto!important;max-height:' . $logo . 'px!important;object-fit:contain}.header_on_scroll:not(.megamenu-active) .site-header .logoimg{max-height:' . $logo_sticky . 'px!important}.site-header .main-navigation .et-header-menu>li{align-self:center;height:auto!important;min-height:0!important;pointer-events:none}.site-header .main-navigation .et-header-menu>li>a,.site-header .main-navigation .et-header-menu>li>.sub-menu{pointer-events:auto}.site-header .main-navigation .et-header-menu>li>a{align-self:center;display:inline-flex!important;flex:0 0 auto;height:auto!important;min-height:0!important;padding-bottom:0;padding-top:0;width:auto!important}}'
		. '@media(max-width:991px){.site-header .logoimg{width:auto!important;max-height:' . $logo_mobile . 'px!important;object-fit:contain}}';
}

function belctech_campaign_bar_items( $legacy_items ) {
	if ( false === get_theme_mod( 'campaign_bar_message_1', false ) ) return $legacy_items;

	$items = array();
	for ( $index = 1; $index <= 3; $index++ ) {
		$message = trim( (string) get_theme_mod( 'campaign_bar_message_' . $index, '' ) );
		if ( '' === $message ) continue;
		$items[] = array(
			'campaign_text' => $message,
			'campaign_link' => esc_url_raw( get_theme_mod( 'campaign_bar_link_' . $index, '' ) ),
			'campaign_button' => '',
		);
	}
	return $items;
}
add_filter( 'belctech_campaign_bar_items', 'belctech_campaign_bar_items', 20 );

// Existing Belctech installations often carry an oversized logo value. Cap it once
// when Belctech is first loaded, while keeping every size editable afterwards.
function belctech_apply_logo_defaults() {
	if ( get_option( 'belctech_logo_defaults_102' ) ) return;
	$current = absint( get_theme_mod( 'logo_height', 42 ) );
	if ( 0 === $current || $current > 48 ) set_theme_mod( 'logo_height', 42 );
	if ( false === get_theme_mod( 'logo_height_sticky', false ) ) set_theme_mod( 'logo_height_sticky', 28 );
	if ( false === get_theme_mod( 'logo_height_mobile', false ) ) set_theme_mod( 'logo_height_mobile', 30 );
	update_option( 'belctech_logo_defaults_102', 1, false );
}
add_action( 'after_setup_theme', 'belctech_apply_logo_defaults', 30 );

function belctech_apply_account_icon_default() {
	if ( get_option( 'belctech_account_icon_default_108' ) ) return;
	set_theme_mod( 'main_header_login_icon', 'icon' );
	update_option( 'belctech_account_icon_default_108', 1, false );
}
add_action( 'after_setup_theme', 'belctech_apply_account_icon_default', 31 );

function belctech_apply_buy_now_default() {
	if ( get_option( 'belctech_buy_now_default_109' ) ) return;
	set_theme_mod( 'product_single_buy_now', true );
	update_option( 'belctech_buy_now_default_109', 1, false );
}
add_action( 'after_setup_theme', 'belctech_apply_buy_now_default', 32 );

function belctech_apply_performance_defaults() {
	if ( get_option( 'belctech_performance_defaults_115' ) ) return;
	set_theme_mod( 'main_header_login_popup', false );
	set_theme_mod( 'page_transition', false );
	update_option( 'belctech_performance_defaults_115', 1, false );
}
add_action( 'after_setup_theme', 'belctech_apply_performance_defaults', 33 );
