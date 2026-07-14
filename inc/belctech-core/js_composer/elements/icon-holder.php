<?php

// VC element: et_icon_holder
vc_map( array(
	'name' => __( 'Icon Holder', 'belctech-ecommerce' ),
	'description' => __( 'Container for Icon Box elements', 'belctech-ecommerce' ),
	'category' => esc_html__('Belctech', 'belctech-ecommerce'),
	'base' => 'et_icon_holder',
	'icon' => 'et_icon_holder',
	'as_parent' => array( 'only' => 'et_iconbox' ),
	'controls' => 'full',
	'content_element' => true,
	'show_settings_on_create' => false,
	'js_view' => 'VcColumnView',
	'params' => array(
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Columns Large', 'belctech-ecommerce'),
			'description' => esc_html__('1200px and up', 'belctech-ecommerce'),
			'param_name' => 'columns_large',
			'value' => array(
				__( '1 Column', 'belctech-ecommerce' ) => '1',
				__( '2 Columns', 'belctech-ecommerce' ) => '2',
				__( '3 Columns', 'belctech-ecommerce' ) => '3',
				__( '4 Columns', 'belctech-ecommerce' ) => '4',
				__( '5 Columns', 'belctech-ecommerce' ) => '5'
			),
			'std' => '3',
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Columns Medium', 'belctech-ecommerce'),
			'description' => esc_html__('max-width: 1199px', 'belctech-ecommerce'),
			'param_name' => 'columns_medium',
			'value' => array(
				__( '1 Column', 'belctech-ecommerce' ) => '1',
				__( '2 Columns', 'belctech-ecommerce' ) => '2',
				__( '3 Columns', 'belctech-ecommerce' ) => '3',
				__( '4 Columns', 'belctech-ecommerce' ) => '4',
				__( '5 Columns', 'belctech-ecommerce' ) => '5'
			),
			'std' => '2',
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Columns Mobile', 'belctech-ecommerce'),
			'description' => esc_html__('max-width: 767px', 'belctech-ecommerce'),
			'param_name' => 'columns_small',
			'value' => array(
				__( '1 Column', 'belctech-ecommerce' ) => '1',
				__( '2 Columns', 'belctech-ecommerce' ) => '2',
			),
			'std' => '1',
		),
		array(
			'type' => 'checkbox',
			'heading' => __('Center Columns', 'belctech-ecommerce'),
			'param_name' => 'center',
			'value' => array(
				__( 'Yes', 'belctech-ecommerce' ) => 'true'
			)
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Extra Class Name', 'belctech-ecommerce'),
			'param_name' => 'extra_class',
		),
	)
) );

// Extend element with the WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_ET_Icon_Holder extends WPBakeryShortCodesContainer {}
}