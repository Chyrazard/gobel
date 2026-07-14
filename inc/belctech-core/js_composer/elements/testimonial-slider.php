<?php

// VC element: et_testimonial_slider
vc_map( array(
	'name' => esc_html__('Testimonial Slider', 'belctech-ecommerce'),
	'description' => __( 'Create a testimonials slider', 'belctech-ecommerce' ),
	'category' => esc_html__('Belctech', 'belctech-ecommerce'),
	'base' => 'et_testimonial_slider',
	'icon' => 'et_testimonial_slider',
	'content_element'	=> true,

	'js_view' => 'VcColumnView',
	'as_parent' => array('only' => 'et_testimonial'),
	'params'	=> array(
		array(
			'type'			=> 'checkbox',
			'heading'		=> __( 'Arrows', 'belctech-ecommerce' ),
			'param_name'	=> 'arrows',
			'description'	=> __( 'Display "prev" and "next" arrows.', 'belctech-ecommerce' ),
			'value'			=> array(
				__( 'Enable', 'belctech-ecommerce' )	=> 'true'
			)
		),
		array(
			'type'			=> 'checkbox',
			'heading'		=> __( 'Pagination', 'belctech-ecommerce' ),
			'param_name'	=> 'pagination',
			'description'	=> __( 'Display pagination.', 'belctech-ecommerce' ),
			'value'			=> array(
				__( 'Enable', 'belctech-ecommerce' )	=> 'true'
			)
		),

		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Columns', 'belctech-ecommerce'),
			'param_name' => 'columns',
			'value' => array(
				__( '4 Columns', 'belctech-ecommerce' ) => '4',
				__( '3 Columns', 'belctech-ecommerce' ) => '3',
				__( '2 Columns', 'belctech-ecommerce' ) => '2',
				__( '1 Columns', 'belctech-ecommerce' ) => '1'
			),
			'description' => esc_html__('Number of columns in desktop size.', 'belctech-ecommerce'),
			'std'			=> '1'
		),

		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Mobile Columns', 'belctech-ecommerce'),
			'param_name' => 'columns_mobile',
			'value' => array(
				__( '2 Columns', 'belctech-ecommerce' ) => '2',
				__( '1 Columns', 'belctech-ecommerce' ) => '1'
			),
			'description' => esc_html__('Number of columns on mobiles.', 'belctech-ecommerce'),
			'std'			=> '1'
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
			'description' => __( 'Enter animation speed in milliseconds (1 second = 1000 milliseconds). Default is 600.', 'belctech-ecommerce' )
		),
		array(
			'type'			=> 'checkbox',
			'heading'		=> __( 'Autoplay', 'belctech-ecommerce' ),
			'param_name'	=> 'autoplay',
			'description'	=> __( 'Change slides automatically.', 'belctech-ecommerce' ),
			'value'			=> array(
				__( 'Enable', 'belctech-ecommerce' )	=> 'true'
			)
		),
		array(
			'type'      => 'textfield',
			'heading'     => __( 'Autoplay Speed', 'belctech-ecommerce' ),
			'param_name'  => 'autoplay_speed',
			'description' => __( 'Enter autoplay in milliseconds (1 second = 1000 milliseconds). Default is 2500.', 'belctech-ecommerce' ),
			'dependency'  => array(
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
	)
) );

// Extend element with the WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_ET_Testimonial_Slider extends WPBakeryShortCodesContainer {}
}