<?php

// VC element: et_gmap_parent
vc_map( array(
	'name' => __('Google Map', 'belctech-ecommerce'),
	'description'	=> esc_html__( 'Add a Google map with markers', 'belctech-ecommerce' ),
	'category' => __('Belctech', 'belctech-ecommerce'),
	'base' => 'et_gmap_parent',
	'icon' => 'et_gmap_parent',
	'as_parent' => array('only' => 'et_gmap'),
	'controls' => 'full',
	'content_element' => true,
	'show_settings_on_create' => false,
	'js_view' => 'VcColumnView',
	'params' => array(
		array(
		  'type' => 'textfield',
		  'heading' => __('Map Height', 'belctech-ecommerce'),
		  'param_name' => 'height',
		  'admin_label' => true,
		  'value' => 50,
		  'description' => __('Height of the map in vh (0-100). For example, 50 will be 50% of viewport height and 100 will be full height. <small>Add your Google Maps API in Appearance > Customize > General Settings.</small>', 'belctech-ecommerce')
		),
		array(
			'type'           => 'textfield',
			'heading'        => __( 'Map Zoom', 'belctech-ecommerce' ),
			'param_name'     => 'zoom',
			'value'					 => '0',
			'description'    => __( 'Set map zoom level. Leave 0 to automatically fit to bounds.', 'belctech-ecommerce' )
		),
		array(
			'type'           => 'checkbox',
			'heading'        => __( 'Map Controls', 'belctech-ecommerce' ),
			'param_name'     => 'map_controls',
			'std'            => 'panControl, zoomControl, mapTypeControl, scaleControl',
			'value'          => array(
				__('Pan Control', 'belctech-ecommerce')             => 'panControl',
				__('Zoom Control', 'belctech-ecommerce')            => 'zoomControl',
				__('Map Type Control', 'belctech-ecommerce')        => 'mapTypeControl',
				__('Scale Control', 'belctech-ecommerce')           => 'scaleControl',
				__('Street View Control', 'belctech-ecommerce')     => 'streetViewControl'
			),
			'description'    => __( 'Toggle map options.', 'belctech-ecommerce' )
		),

		array(
			'type'           => 'dropdown',
			'heading'        => __( 'Map Type', 'belctech-ecommerce' ),
			'param_name'     => 'map_type',
			'std'            => 'roadmap_custom',
			'value'          => array(
				__('Custom Roadmap', 'belctech-ecommerce')   => 'roadmap_custom',
				__('Default Roadmap (no custom styles)', 'belctech-ecommerce')   => 'roadmap',
				__('Satellite', 'belctech-ecommerce') => 'satellite',
				__('Hybrid', 'belctech-ecommerce')    => 'hybrid',
			),
			'description' => __( 'Choose map style.', 'belctech-ecommerce' ),
			'group' => __( 'Map Styling','belctech-ecommerce' ),
		),

		array(
			'type' => 'dropdown',
			'heading' => __( 'Map Style', 'belctech-ecommerce' ),
			'param_name' => 'map_style',
			'description' => __( 'Select a custom map style.', 'belctech-ecommerce' ),
			'value' => array(
				__( 'Paper', 'belctech-ecommerce' ) => 'paper',
				__( 'Light', 'belctech-ecommerce' ) => 'light',
				__( 'Dark', 'belctech-ecommerce' ) => 'dark',
				__( 'Grayscale', 'belctech-ecommerce' ) => 'grayscale',
				__( 'Countries', 'belctech-ecommerce' ) => 'countries'
			),
			'std' => 'paper',
			'dependency'	=> array(
				'element'	=> 'map_type',
				'value'		=> 'roadmap_custom'
			),
			'group' => __( 'Map Styling','belctech-ecommerce' ),
		),

		array(
			'type' => 'textarea_raw_html',
			'heading' => __( 'Use Your Own Map Style', 'belctech-ecommerce' ),
			'param_name' => 'custom_map_style',
			'description'    => sprintf(__( 'Paste your own style code here. Browse map styles or create your own in %s SnazzyMaps %s.', 'belctech-ecommerce' ),'<a href="https://snazzymaps.com/" target="_blank">','</a>', 'belctech-ecommerce' ),
			'dependency'	=> array(
				'element'	=> 'map_type',
				'value'		=> 'roadmap_custom'
			),
			'group' => __( 'Map Styling','belctech-ecommerce' ),
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Locations List', 'belctech-ecommerce' ),
			'param_name' => 'locations_list',
			'description' => __( 'Show a list with locations.', 'belctech-ecommerce' ),
			'value' => array(
				__( 'Enable', 'belctech-ecommerce' ) => '1'
			),
			'group' => __( 'Locations List','belctech-ecommerce' ),
		),
		array(
			'type'           => 'dropdown',
			'heading'        => __( 'Locations list style', 'belctech-ecommerce' ),
			'param_name'     => 'locations_layout',
			'std'            => 'horizontal',
			'value'          => array(
				__('Horizontal', 'belctech-ecommerce')   => 'horizontal',
				__('Vertical', 'belctech-ecommerce') => 'vertical',
			),
			'description' => __( 'Choose locations list layout.', 'belctech-ecommerce' ),
			'dependency'	=> array(
				'element'	=> 'locations_list',
				'value'		=> '1'
			),
			'group' => __( 'Locations List','belctech-ecommerce' ),
		),
		array(
			'type'           => 'dropdown',
			'heading'        => __( 'Locations rows/columns style', 'belctech-ecommerce' ),
			'param_name'     => 'locations_columns',
			'std'            => '4',
			'value'          => array(
				'2' => '2',
				'3' => '3',
				'4' => '4',
				'5' => '5',
			),
			'description' => __( 'Number of columns(horizontal) or rows(vertical).', 'belctech-ecommerce' ),
			'dependency'	=> array(
				'element'	=> 'locations_list',
				'value'		=> '1'
			),
			'group' => __( 'Locations List','belctech-ecommerce' ),
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Autoselect first location', 'belctech-ecommerce' ),
			'param_name' => 'autoselect_first',
			'description' => __( 'Center the first location on load. Otherwise, it will load in the middle of all locations.', 'belctech-ecommerce' ),
			'std'            => '1',
			'value' => array(
				__( 'Enable', 'belctech-ecommerce' ) => '1'
			),
			'group' => __( 'Locations List','belctech-ecommerce' ),
		),

	),
) );

// Extend element with the WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_ET_Gmap_Parent extends WPBakeryShortCodesContainer { }
}