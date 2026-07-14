<?php

// VC element: et_typestroke

vc_map( array(
	'base'  => 'et_typestroke',
	'name' => esc_html__('Stroke Type', 'belctech-ecommerce' ),
	'description' => esc_html__('Text with Stroke style', 'belctech-ecommerce' ),
	'category' => esc_html__('Belctech', 'belctech-ecommerce' ),
	'icon' => 'et_typestroke',
	'params' => array(
		array(
			'type'       => 'textarea_safe',
			'heading'    => esc_html__( 'Content', 'belctech-ecommerce' ),
			'param_name' => 'slide_text',
			'value'		 => '<h2>Type Stroke</h2>',
			'description'=> 'Enter the content to display with stroke.',
			'admin_label' => true,
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Text Size', 'belctech-ecommerce' ),
			'param_name' => 'text_size',
			'value' => array(
				__( 'Small (14 px)', 'belctech-ecommerce' ) => 'small',
				__( 'Medium (24px)', 'belctech-ecommerce' ) => 'medium',
				__( 'Large (32px)', 'belctech-ecommerce' ) => 'large',
				__( 'X-Large (48px)', 'belctech-ecommerce' ) => 'xlarge',
				__( 'XX-Large (72px)', 'belctech-ecommerce' ) => 'xxlarge',
				__( 'Custom Size', 'belctech-ecommerce' ) => 'custom',
			),
			'std' => 'medium',
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Custom Text Size', 'belctech-ecommerce' ),
			'param_name' => 'text_size_custom',
			'description' => esc_html__('Add the unit, for example: 28px. It will be scaled down on smaller devices.', 'belctech-ecommerce' ),
			'dependency' => array(
				'element' => 'text_size',
				'value' => array( 'custom' )
			),
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Text Color', 'belctech-ecommerce' ),
			'param_name' => 'text_color',
			'value' => array(
				__( 'Default', 'belctech-ecommerce' ) => '',
				__( 'Dark', 'belctech-ecommerce' ) => 'dark',
				__( 'Light', 'belctech-ecommerce' ) => 'light',
				__( 'Accent Color', 'belctech-ecommerce' ) => 'accent',
				__( 'Custom', 'belctech-ecommerce' ) => 'custom'
			),
			'std' => '',
		),
		array(
			'type' => 'colorpicker',
			'heading' => esc_html__('Custom Text Color', 'belctech-ecommerce' ),
			'param_name' => 'text_color_custom',
			'dependency' => array(
				'element' => 'text_color',
				'value' => array( 'custom' )
			),
		),
		array(
		  'type'					=> 'textfield',
		  'heading'			=> esc_html__('Stroke Width', 'belctech-ecommerce' ),
		  'param_name'		=> 'stroke_width',
		  'std'=> '',
		  'description'	=> esc_html__('Enter the value for the stroke width (default: 1px) ', 'belctech-ecommerce' )
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Extra Class Name', 'belctech-ecommerce' ),
			'param_name' => 'extra_class',
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Animation', 'belctech-ecommerce' ),
			'param_name' => 'animation',
			'value' => array(
				__( 'None', 'belctech-ecommerce' )               => '',
				__( 'Right to Left', 'belctech-ecommerce' )      => 'animation right-to-left',
				__( 'Left to Right', 'belctech-ecommerce' )      => 'animation left-to-right',
				__( 'Right to Left - 3D', 'belctech-ecommerce' ) => 'animation right-to-left-3d',
				__( 'Left to Right - 3D', 'belctech-ecommerce' ) => 'animation left-to-right-3d',
				__( 'Bottom to Top', 'belctech-ecommerce' )      => 'animation bottom-to-top',
				__( 'Top to Bottom', 'belctech-ecommerce' )      => 'animation top-to-bottom',
				__( 'Bottom to Top - 3D', 'belctech-ecommerce' ) => 'animation bottom-to-top-3d',
				__( 'Top to Bottom - 3D', 'belctech-ecommerce' ) => 'animation top-to-bottom-3d',
				__( 'Scale', 'belctech-ecommerce' )              => 'animation scale',
				__( 'Fade', 'belctech-ecommerce' )               => 'animation fade',
			)
		),
	)
) );
