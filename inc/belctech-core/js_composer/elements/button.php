<?php

// VC element: et_button
vc_map( array(
	 'name'			=> esc_html__( 'Button', 'belctech-ecommerce' ),
	 'description'	=> esc_html__( 'Stylish button', 'belctech-ecommerce' ),
	 'category' => esc_html__('Belctech', 'belctech-ecommerce'),
	 'base'			=> 'et_button',
	 'icon'			=> 'et_button',
	 'params'			=> array(
		array(
			'type'			=> 'textfield',
			'heading'		=> __( 'Title', 'belctech-ecommerce' ),
			'param_name'	=> 'title',
			'description'	=> __( 'Add button title.', 'belctech-ecommerce' ),
			'value'		=> __( 'Button', 'belctech-ecommerce' )
		),
		array(
			'type'			=> 'vc_link',
			'heading'		=> __( 'URL (Link)', 'belctech-ecommerce' ),
			'param_name'	=> 'link',
			'description'	=> __( 'Add a button link.', 'belctech-ecommerce' )
		),

		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Add Arrow', 'belctech-ecommerce'),
			'param_name' => 'add_arrow',
			'value' => array(
				__( 'Yes', 'belctech-ecommerce' ) => 'true'
			),
			'description' => esc_html__('If enabled, will show an arrow on hover.', 'belctech-ecommerce'),
		),
		array(
			'type'			=> 'dropdown',
			'heading'		=> __( 'Size', 'belctech-ecommerce' ),
			'param_name'	=> 'size',
			'description'	=> __( 'Select button size.', 'belctech-ecommerce' ),
			'value'			=> array(
				__( 'Large', 'belctech-ecommerce' )			=> 'lg',
				__( 'Medium', 'belctech-ecommerce' )		=> 'md',
				__( 'Small', 'belctech-ecommerce' )		=> 'sm',
			),
			'std'			=> 'md'
		),
		array(
			'type'      => 'dropdown',
			'heading'     => __( 'Animation', 'belctech-ecommerce' ),
			'param_name'  => 'animation',
			'value'     => array(
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
			),
		),
		array(
			'type'			=> 'dropdown',
			'heading'		=> __( 'Style', 'belctech-ecommerce' ),
			'param_name'	=> 'style',
			'description'	=> __( 'Select button style.', 'belctech-ecommerce' ),
			'value'		=> array(
				__( 'Solid', 'belctech-ecommerce' )			=> 'solid',
				__( 'Solid Rounded', 'belctech-ecommerce' )	=> 'solid rounded',
				__( 'Outlined', 'belctech-ecommerce' )			=> 'outlined',
				__( 'Outlined Rounded', 'belctech-ecommerce' )	=> 'outlined rounded',
				__( 'Link', 'belctech-ecommerce' )				=> 'link',
			),
			'std'			=> 'solid',
			'group' => __( 'Styling','belctech-ecommerce' ),
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Link/Button Color', 'belctech-ecommerce' ),
			'description' => __( 'Also border color if "Outlined Button" is selected', 'belctech-ecommerce' ),
			'param_name' => 'color',
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
			'type'			=> 'colorpicker',
			'heading'		=> __( 'Custom Color', 'belctech-ecommerce' ),
			'description'	=> __( 'Link/Button custom color.', 'belctech-ecommerce' ),
			'param_name'	=> 'color_custom',
			'group' => __( 'Styling','belctech-ecommerce' ),
			'dependency' => array(
				'element' => 'color',
				'value' => array('custom')
			),
		),
		array(
			'type'			=> 'colorpicker',
			'heading'		=> __( 'Text Color (solid buttons)', 'belctech-ecommerce' ),
			'description'	=> __( 'Text color for solid buttons.', 'belctech-ecommerce' ),
			'param_name'	=> 'text_color_custom',
			'group' => __( 'Styling','belctech-ecommerce' ),
			'dependency' => array(
				'element' => 'color',
				'value' => array('custom')
			),
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Add Shadow on Hover?', 'belctech-ecommerce'),
			'param_name' => 'shadow',
			'group' => __( 'Styling','belctech-ecommerce' ),
			'value' => array(
				__( 'Yes', 'belctech-ecommerce' ) => 'button-shadow'
			),
			'dependency' => array(
				'element' => 'style',
				'value' => array('solid', 'solid rounded')
			),
			'description' => esc_html__('If enabled, this will add a shadow to the button', 'belctech-ecommerce'),
		),
		array(
			'type'			=> 'dropdown',
			'heading'		=> __( 'Align', 'belctech-ecommerce' ),
			'param_name'	=> 'align',
			'description'	=> __( 'Select button alignment.', 'belctech-ecommerce' ),
			'value'			=> array(
				__( 'Left', 'belctech-ecommerce' )		=> 'left',
				__( 'Center', 'belctech-ecommerce' )	=> 'center',
				__( 'Right', 'belctech-ecommerce' )	=> 'right',
				__( 'Full Width', 'belctech-ecommerce' )	=> 'full'
			),
			'group' => __( 'Styling','belctech-ecommerce' ),
			'std'			=> 'left'
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Extra Class', 'belctech-ecommerce' ),
			'description' => esc_html__('Add a class for more customization', 'belctech-ecommerce' ),
			'param_name' => 'extra_class',
			'group' => __( 'Styling','belctech-ecommerce' ),
		),
	)
) );
