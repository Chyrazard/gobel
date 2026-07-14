<?php

// VC element: et_banner_slider
vc_map( array(
	'name' => __( 'Banner Slider', 'belctech-ecommerce' ),
	'description' => __( 'Create a banner slider', 'belctech-ecommerce' ),
	'category' => esc_html__('Belctech', 'belctech-ecommerce'),
	'base' => 'et_banner_slider',
	'icon' => 'et_banner_slider',
	'as_parent' => array( 'only' => 'et_banner' ),
	'controls' => 'full',
	'content_element' => true,
	'show_settings_on_create' => false,
	'js_view' => 'VcColumnView',
	'params' => array(
		array(
			'type'			=> 'checkbox',
			'heading'		=> __( 'Adaptive Height', 'belctech-ecommerce' ),
			'param_name'	=> 'adaptive_height',
			'description'	=> __( 'Enable adaptive height for each slide.', 'belctech-ecommerce' ),
			'value'			=> array(
				__( 'Enable', 'belctech-ecommerce' )	=> '1'
			)
		),
		array(
			'type'			=> 'checkbox',
			'heading'		=> __( 'Arrows', 'belctech-ecommerce' ),
			'param_name'	=> 'arrows',
			'description'	=> __( 'Display "prev" and "next" arrows.', 'belctech-ecommerce' ),
			'value'			=> array(
				__( 'Enable', 'belctech-ecommerce' )	=> '1'
			)
		),
		array(
			'type'			=> 'checkbox',
			'heading'		=> __( 'Pagination', 'belctech-ecommerce' ),
			'param_name'	=> 'pagination',
			'description'	=> __( 'Display pagination dots.', 'belctech-ecommerce' ),
			'value'			=> array(
				__( 'Enable', 'belctech-ecommerce' )	=> '1'
			)
		),
		array(
			'type'			=> 'dropdown',
			'heading'		=> __( 'Pagination Color', 'belctech-ecommerce' ),
			'param_name'	=> 'pagination_color',
			'description'	=> __( 'Select pagination color.', 'belctech-ecommerce' ),
			'value'		=> array(
				__( 'Light', 'belctech-ecommerce' )	=> 'light',
				__( 'Gray', 'belctech-ecommerce' )	=> 'gray',
				__( 'Dark', 'belctech-ecommerce' )	=> 'dark'
			),
			'std'			=> 'gray'
		),
		array(
			'type'			=> 'checkbox',
			'heading'		=> __( 'Infinite Loop', 'belctech-ecommerce' ),
			'param_name'	=> 'infinite',
			'description'	=> __( 'Infinite loop sliding.', 'belctech-ecommerce' ),
			'value'			=> array(
				__( 'Enable', 'belctech-ecommerce' )	=> '1'
			)
		),
		array(
			'type'			=> 'dropdown',
			'heading'		=> __( 'Animation Type', 'belctech-ecommerce' ),
			'param_name'	=> 'animation',
			'description'	=> __( 'Select animation type.', 'belctech-ecommerce' ),
			'value'		=> array(
				__( 'Fade', 'belctech-ecommerce' )  => 'fade',
				__( 'Slide', 'belctech-ecommerce' ) => 'slide'
			),
			'std'			=> 'slide'
		),
		array(
			'type'      => 'textfield',
			'heading'     => __( 'Animation Speed', 'belctech-ecommerce' ),
			'param_name'  => 'speed',
			'description' => __( 'Enter animation speed in milliseconds (1 second = 1000 milliseconds).', 'belctech-ecommerce' )
		),
		array(
			'type'			=> 'checkbox',
			'heading'		=> __( 'Autoplay', 'belctech-ecommerce' ),
			'param_name'	=> 'autoplay',
			'value'			=> array(
				__( 'Enable', 'belctech-ecommerce' )	=> '1'
			)
		),
		array(
			'type'      => 'textfield',
			'heading'     => __( 'Autoplay Speed', 'belctech-ecommerce' ),
			'param_name'  => 'autoplay_speed',
			'description' => __( 'Enter autoplay interval in milliseconds (1 second = 1000 milliseconds).', 'belctech-ecommerce' ),
			'std'			=> '4000',
			'dependency' => array(
				'element' => 'autoplay',
				'value' => array( '1' )
			)
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Pause on hover', 'belctech-ecommerce'),
			'param_name' => 'pause',
			'description' => esc_html__('Pause autoplay on hover.', 'belctech-ecommerce'),
			'value' => array(
				__( 'Enable', 'belctech-ecommerce' )	=> '1'
			),
			'dependency' => array(
				'element' => 'autoplay',
				'value' => array( '1' )
			)
		),
	)
) );

// Extend element with the WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_ET_Banner_Slider extends WPBakeryShortCodesContainer {}
}