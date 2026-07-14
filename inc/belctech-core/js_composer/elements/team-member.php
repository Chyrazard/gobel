<?php

// VC element: et_team_member
vc_map( array(
	'name' => esc_html__('Team Member', 'belctech-ecommerce'),
	'description' => esc_html__('Display your team members in a stylish way', 'belctech-ecommerce'),
	'category' => esc_html__('Belctech', 'belctech-ecommerce'),
	'base' => 'et_team_member',
	'icon' => 'et_team',
	'params' => array(
		array(
			'type' => 'attach_image', //attach_images
			'heading' => esc_html__('Select Team Member Image', 'belctech-ecommerce'),
			'param_name' => 'image',
			'description' => esc_html__('Minimum size is 270x270 pixels', 'belctech-ecommerce')
		),
		array(
			'type'			=> 'dropdown',
			'heading'		=> __( 'Image Style', 'belctech-ecommerce' ),
			'param_name'	=> 'style',
			'description'	=> __( 'Select image style.', 'belctech-ecommerce' ),
			'value'		=> array(
				__( 'Default', 'belctech-ecommerce' )  => 'default',
				__( 'Rounded', 'belctech-ecommerce' ) => 'rounded'
			),
			'std'			=> 'default'
		),
		array(
			'type'			=> 'dropdown',
			'heading'		=> __( 'Animation', 'belctech-ecommerce' ),
			'param_name'	=> 'animation',
			'value'		=> array(
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
			'std'			=> 'animation bottom-to-top'
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Name', 'belctech-ecommerce'),
			'param_name' => 'name',
			'admin_label' => true,
			'description' => esc_html__('Enter name of the team member', 'belctech-ecommerce')
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Position', 'belctech-ecommerce'),
			'param_name' => 'position',
			'description' => esc_html__('Enter position/title of the team member', 'belctech-ecommerce')
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Facebook', 'belctech-ecommerce'),
			'param_name' => 'facebook',
			'description' => esc_html__('Enter Facebook Link', 'belctech-ecommerce')
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Twitter', 'belctech-ecommerce'),
			'param_name' => 'twitter',
			'description' => esc_html__('Enter Twitter Link', 'belctech-ecommerce')
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Pinterest', 'belctech-ecommerce'),
			'param_name' => 'pinterest',
			'description' => esc_html__('Enter Pinterest Link', 'belctech-ecommerce')
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Linkedin', 'belctech-ecommerce'),
			'param_name' => 'linkedin',
			'description' => esc_html__('Enter Linkedin Link', 'belctech-ecommerce')
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Instagram', 'belctech-ecommerce'),
			'param_name' => 'instagram',
			'description' => esc_html__('Enter Instagram Link', 'belctech-ecommerce')
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('VK', 'belctech-ecommerce'),
			'param_name' => 'vk',
			'description' => esc_html__('Enter VK Link', 'belctech-ecommerce')
		),
	),

) );