<?php

// VC element: et_typeauto

vc_map( array(
	'base'  => 'et_typeauto',
	'name' => esc_html__('Auto Type', 'belctech-ecommerce' ),
	'description' => esc_html__('Animated text typing', 'belctech-ecommerce' ),
	'category' => esc_html__('Belctech', 'belctech-ecommerce' ),
	'icon' => 'et_typeauto',
	'params' => array(
		array(
			'type'       => 'textarea_safe',
			'heading'    => esc_html__( 'Content', 'belctech-ecommerce' ),
			'param_name' => 'typed_text',
			'value'		 => '<h2>Your animated text *Belctech;WordPress*</h2>',
			'description'=> __( 'Enter the content to display with typing text. <br />
			Text within <strong>*</strong> will be animated, for example: <strong>*Sample text*</strong>. <br />Text separator is <strong>;</strong> for example: <strong>*Belctech;WordPress*</strong>', 'belctech-ecommerce' ),
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
			'heading' => __( 'Animated Text Color', 'belctech-ecommerce' ),
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
	    'type' => 'textfield',
	    'heading' => esc_html__('Type Speed', 'belctech-ecommerce' ),
	    'param_name' => 'typed_speed',
	    'description' => esc_html__('Speed of the type animation. Default is 50', 'belctech-ecommerce' )
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Show Cursor', 'belctech-ecommerce' ),
			'param_name' => 'cursor',
			'value' => array(
				__( 'Yes', 'belctech-ecommerce' ) => '1'
			),
			'description' => esc_html__('If enabled, the text will always animate, looping through the sentences used.', 'belctech-ecommerce' ),
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Loop', 'belctech-ecommerce' ),
			'param_name' => 'loop',
			'value' => array(
				__( 'Yes', 'belctech-ecommerce' ) => '1'
			),
			'description' => esc_html__('If enabled, the text will always animate, looping through the sentences used.', 'belctech-ecommerce' ),
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Extra Class Name', 'belctech-ecommerce' ),
			'param_name' => 'extra_class',
		),
	)
) );
