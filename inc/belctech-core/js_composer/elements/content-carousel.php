<?php

// Content Carousel Shortcode
vc_map( array(
	'name' => esc_html__('Content Carousel', 'belctech-ecommerce'),
	'description' => esc_html__('Display your content in a carousel', 'belctech-ecommerce'),
	'category' => esc_html__('Belctech', 'belctech-ecommerce'),
	'base' => 'et_content_carousel',
	'icon' => 'et_content_carousel',
	'as_parent' => array('except' => 'et_content_carousel'),

	'show_settings_on_create' => true,
	'content_element' => true,
	'params' => array(
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Columns', 'belctech-ecommerce'),
			'param_name' => 'columns',
			'value' => array(
				__( '1 Column', 'belctech-ecommerce' ) => '1',
				__( '2 Columns', 'belctech-ecommerce' ) => '2',
				__( '3 Columns', 'belctech-ecommerce' ) => '3',
				__( '4 Columns', 'belctech-ecommerce' ) => '4',
				__( '5 Columns', 'belctech-ecommerce' ) => '5',
				__( '6 Columns', 'belctech-ecommerce' ) => '6'
			),
			'std' => '1',
			'description' => esc_html__('Select the layout.', 'belctech-ecommerce' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Animation', 'belctech-ecommerce'),
			'param_name' => 'animation',
			'value' => array(
				__( 'Slide', 'belctech-ecommerce' ) => 'slide',
				__( 'Fade', 'belctech-ecommerce' ) => 'fade',
			),
			'std' => 'slide',
		),

		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Infinite', 'belctech-ecommerce'),
			'param_name' => 'infinite',
			'value' => array(
				__( 'Enable', 'belctech-ecommerce' ) => 'true'
			),
			'description' => esc_html__('Infinite loop sliding.', 'belctech-ecommerce'),
		),

		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Auto Play', 'belctech-ecommerce'),
			'param_name' => 'autoplay',
			'value' => array(
				__( 'Enable', 'belctech-ecommerce' ) => 'true'
			),
			'description' => esc_html__('If enabled, the carousel will autoplay.', 'belctech-ecommerce'),
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Speed of the AutoPlay', 'belctech-ecommerce'),
			'param_name' => 'autoplay_speed',
			'value' => '4000',
			'description' => esc_html__('Speed of the autoplay, default 4000 (4 seconds)', 'belctech-ecommerce'),
			'dependency' => array(
				'element' => 'autoplay',
				'value' => array('true')
			)
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Pause on hover', 'belctech-ecommerce'),
			'param_name' => 'pause',
			'value' => array(
				__( 'Enable', 'belctech-ecommerce' ) => 'true'
			),
			'description' => esc_html__('Pause autoplay on hover.', 'belctech-ecommerce'),
			'dependency' => array(
				'element' => 'autoplay',
				'value' => array('true')
			)
		),
		array(
			'type' => 'checkbox',
			'heading' => __('Center Slides', 'belctech-ecommerce'),
			'param_name' => 'center',
			'value' => array(
				__( 'Yes', 'belctech-ecommerce' ) => 'true'
			)
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Margins between items', 'belctech-ecommerce'),
			'param_name' => 'margins',
			'std'=> 'regular-padding',
			'value' => array(
				__( 'Regular', 'belctech-ecommerce' ) => 'regular-padding',
				__( 'Mini', 'belctech-ecommerce' ) => 'mini-padding',
				__( 'Pixel', 'belctech-ecommerce' ) => 'pixel-padding',
				__( 'None', 'belctech-ecommerce' ) => 'no-padding'
			),
			'description' => esc_html__('This will change the margins between items', 'belctech-ecommerce' )
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Navigation Dots', 'belctech-ecommerce'),
			'param_name' => 'pagination',
			'value' => array(
				__( 'Enable', 'belctech-ecommerce' )	=> 'true'
			),
			'group' => __( 'Navigation','belctech-ecommerce' ),
		),
		array(
			'type'			=> 'checkbox',
			'heading'		=> __( 'Arrows', 'belctech-ecommerce' ),
			'param_name'	=> 'arrows',
			'description'	=> __( 'Display "prev" and "next" arrows.', 'belctech-ecommerce' ),
			'value'			=> array(
				__( 'Enable', 'belctech-ecommerce' )	=> 'true'
			),
			'group' => __( 'Navigation','belctech-ecommerce' ),
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Overflow Visible?', 'belctech-ecommerce'),
			'param_name' => 'overflow',
			'value' => array(
				__( 'Yes', 'belctech-ecommerce' ) => 'overflow-visible'
			),
			'std' => '',
			'description' => esc_html__('Show semi-transparent previous and next slides', 'belctech-ecommerce' ),
			'group' => __( 'Navigation','belctech-ecommerce' ),
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Extra Class Name', 'belctech-ecommerce'),
			'param_name' => 'extra_class',
		),
	),
	'js_view' => 'VcColumnView',
) );

class WPBakeryShortCode_ET_Content_Carousel extends WPBakeryShortCodesContainer { }