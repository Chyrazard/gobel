<?php

// VC element: et_counter

vc_map( array(
	'name' => esc_html__('Counter', 'belctech-ecommerce' ),
	'base' => 'et_counter',
	'icon' => 'et_counter',
	'category' => esc_html__('Belctech', 'belctech-ecommerce' ),
	'params' => array(
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Style', 'belctech-ecommerce' ),
			'param_name' => 'style',
			'std' => 'counter-top',
			'value' => array(
				__( 'Counter Top', 'belctech-ecommerce' ) => 'counter-top',
				__( 'Counter Bottom', 'belctech-ecommerce' ) => 'counter-bottom',
				__( 'Counter Left', 'belctech-ecommerce' ) => 'counter-left',
				__( 'Counter Right', 'belctech-ecommerce' ) => 'counter-right',
			)
		),
		array(
			'type' => 'dropdown',
			'heading' => __('Icon Type', 'belctech-ecommerce' ),
			'param_name' => 'icon_type',
			'description' => __( 'Select icon type.', 'belctech-ecommerce' ),
			'value' => array(
				__( 'Font Icon', 'belctech-ecommerce' ) => 'icon',
				__( 'Image', 'belctech-ecommerce' ) => 'image_id'
			),
			'std' => 'icon',
			'dependency' => array(
				'element' => 'style',
				'value' => array( 'counter-top','counter-bottom' )),
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Icon library', 'belctech-ecommerce' ),
			'value' => array(
				__( 'Pixeden 7 Stroke', 'belctech-ecommerce' ) => 'pixeden',
				__( 'Font Awesome', 'belctech-ecommerce' ) => 'fontawesome',
			),
			'admin_label' => true,
			'param_name' => 'icon_library',
			'description' => __( 'Select icon library.', 'belctech-ecommerce' ),
			'std' => 'pixeden',
			'dependency' => array(
				'element' => 'icon_type',
				'value' => 'icon'
			)
		),
		array(
			'type' => 'iconpicker',
			'heading' => __( 'Icon', 'belctech-ecommerce' ),
			'param_name' => 'icon_pixeden',
			'description' => __( 'Select icon from library.', 'belctech-ecommerce' ),
			'value' => 'pe-7s-close',
			'settings' => array(
				'type' => 'pixeden',
				'emptyIcon' => false,
				'iconsPerPage' => 3000
			),
			'dependency' => array(
				'element' => 'icon_library',
				'value' => 'pixeden'
			)
		),
		array(
			'type' => 'iconpicker',
			'heading' => __( 'Icon', 'belctech-ecommerce' ),
			'param_name' => 'icon_fontawesome',
			'value' => 'fa fa-adjust',
			'settings' => array(
				'emptyIcon' => false,
				'iconsPerPage' => 4000,
			),
			'dependency' => array(
				'element' => 'icon_library',
				'value' => 'fontawesome',
			),
			'description' => __( 'Select icon from library.', 'belctech-ecommerce' ),
		),
		array(
			'type' => 'attach_image',
			'heading' => __( 'Image', 'belctech-ecommerce' ),
			'param_name' => 'image_id',
			'description' => __( 'Select image from the media library.', 'belctech-ecommerce' ),
			'dependency' => array(
				'element' => 'icon_type',
				'value' => array( 'image_id' )
			)
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Image Style', 'belctech-ecommerce' ),
			'param_name' => 'image_style',
			'description' => __( 'Select an image style.', 'belctech-ecommerce' ),
			'value' => array(
				__( 'Default', 'belctech-ecommerce' ) => 'default',
				__( 'Rounded', 'belctech-ecommerce' ) => 'rounded'
			),
			'std' => 'default',
			'dependency' => array(
				'element' => 'icon_type',
				'value' => array( 'image_id' )
			)
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Image Width', 'belctech-ecommerce' ),
			'param_name' => 'icon_image_width',
			'description' => esc_html__( 'If you are using an image, you can set custom width here. Default is 64 (pixels).', 'belctech-ecommerce' ),
			'dependency' => array(
				'element' => 'icon_type',
				'value' => array( 'image_id' )),
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Counter Color', 'belctech-ecommerce' ),
			'param_name' => 'counter_color',
			'value' => array(
				__( 'Default', 'belctech-ecommerce' ) => '',
        __( 'Dark', 'belctech-ecommerce' ) => 'dark',
        __( 'Light', 'belctech-ecommerce' ) => 'light',
        __( 'Accent Color', 'belctech-ecommerce' ) => 'accent',
        __( 'Custom', 'belctech-ecommerce' ) => 'custom'
			),
			'std' => '',
			'group' => __( 'Styling','belctech-ecommerce' ),
		),
		array(
			'type' => 'colorpicker',
			'heading' => esc_html__('Counter Custom Color', 'belctech-ecommerce' ),
			'param_name' => 'counter_color_custom',
			'dependency' => array(
				'element' => 'counter_color',
				'value' => array( 'custom' )
			),
			'group' => __( 'Styling','belctech-ecommerce' ),
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Icon Color', 'belctech-ecommerce' ),
			'param_name' => 'icon_color',
			'value' => array(
				__( 'Default', 'belctech-ecommerce' ) => '',
        __( 'Dark', 'belctech-ecommerce' ) => 'dark',
        __( 'Light', 'belctech-ecommerce' ) => 'light',
        __( 'Accent Color', 'belctech-ecommerce' ) => 'accent',
        __( 'Custom', 'belctech-ecommerce' ) => 'custom'
			),
			'dependency' => array(
				'element' => 'icon_type',
				'value' => array('icon')
			),
			'std' => '',
			'group' => __( 'Styling','belctech-ecommerce' ),
		),
		array(
			'type' => 'colorpicker',
			'heading' => esc_html__('Icon Custom Color', 'belctech-ecommerce' ),
			'param_name' => 'icon_color_custom',
			'dependency' => array(
				'element' => 'icon_color',
				'value' => array( 'custom' )
			),
			'group' => __( 'Styling','belctech-ecommerce' ),
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Text Color', 'belctech-ecommerce' ),
			'param_name' => 'text_color',
			'value' => array(
				__( 'Default', 'belctech-ecommerce' ) => '',
        __( 'Dark', 'belctech-ecommerce' ) => 'dark',
        __( 'Light', 'belctech-ecommerce' ) => 'light',
        __( 'Custom', 'belctech-ecommerce' ) => 'custom'
			),
			'std' => '',
			'group' => __( 'Styling','belctech-ecommerce' ),
		),
		array(
			'type' => 'colorpicker',
			'heading' => esc_html__('Text Custom Color', 'belctech-ecommerce' ),
			'param_name' => 'text_color_custom',
			'dependency' => array(
				'element' => 'text_color',
				'value' => array( 'custom' )
			),
			'group' => __( 'Styling','belctech-ecommerce' ),
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Number to Count', 'belctech-ecommerce' ),
			'param_name' => 'counter',
			'admin_label' => true
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Speed of the counter animation', 'belctech-ecommerce' ),
			'param_name' => 'speed',
			'value' => '2000',
			'description' => esc_html__('Speed of the counter animation, default 1500', 'belctech-ecommerce' ),
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Title', 'belctech-ecommerce' ),
			'param_name' => 'title',
			'admin_label' => true
		),
		array(
			'type' => 'textarea',
			'heading' => esc_html__( 'Description', 'belctech-ecommerce' ),
			'param_name' => 'description',
			'description' => esc_html__( 'Include a small description for this counter', 'belctech-ecommerce' ),
		),
	),
	'description' => esc_html__('Counters with icons', 'belctech-ecommerce' )
) );
