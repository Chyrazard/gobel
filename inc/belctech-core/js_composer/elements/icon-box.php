<?php

// VC element: et_iconbox

vc_map( array(
	 'name'			=> __( 'Icon Box', 'belctech-ecommerce' ),
	 'description'	=> __( 'Feature box with image or icon.', 'belctech-ecommerce' ),
	 'category' => esc_html__('Belctech', 'belctech-ecommerce'),
	 'base'			=> 'et_iconbox',
	 'icon'			=> 'et_iconbox',
	 'params'			=> array(

		array(
			'type'			=> 'dropdown',
			'heading'		=> __('Icon Type', 'belctech-ecommerce' ),
			'param_name'	=> 'icon_type',
			'description'	=> __( 'Select icon type.', 'belctech-ecommerce' ),
			'value'		=> array(
				__( 'Font Icon', 'belctech-ecommerce' )	=> 'icon',
				__( 'Image', 'belctech-ecommerce' )		=> 'image_id',
				__( 'External Image', 'belctech-ecommerce' )		=> 'external_img'
			),
			'std'			=> 'icon',
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
			'dependency'	=> array(
				'element'	=> 'icon_type',
				'value'		=> 'icon'
			)
		),
		array(
			'type'			=> 'iconpicker',
			'heading'		=> __( 'Icon', 'belctech-ecommerce' ),
			'param_name'	=> 'icon_pixeden',
			'description'	=> __( 'Select icon from library.', 'belctech-ecommerce' ),
			'value'		=> 'pe-7s-close',
			'settings'		=> array(
				'type'			=> 'pixeden',
				'emptyIcon'	=> false,
				'iconsPerPage'	=> 500
			),
			'dependency'	=> array(
				'element'	=> 'icon_library',
				'value'		=> 'pixeden'
			)
		),
		array(
			'type' => 'iconpicker',
			'heading' => __( 'Icon', 'belctech-ecommerce' ),
			'param_name' => 'icon_fontawesome',
			'value' => 'fa fa-adjust',
			'settings' => array(
				'emptyIcon' => false,
				'iconsPerPage' => 500,
			),
			'dependency' => array(
				'element' => 'icon_library',
				'value' => 'fontawesome',
			),
			'description' => __( 'Select icon from library.', 'belctech-ecommerce' ),
		),
		array(
			'type'			=> 'textfield',
			'heading'		=> __( 'External Image', 'belctech-ecommerce' ),
			'param_name'	=> 'image_url',
			'description'	=> __( 'Image Link', 'belctech-ecommerce' ),
			'dependency'	=> array(
				'element'	=> 'icon_type',
				'value'	=> array( 'external_img' )
			)
		),
		array(
			'type'			=> 'attach_image',
			'heading'		=> __( 'Image', 'belctech-ecommerce' ),
			'param_name'	=> 'image_id',
			'description'	=> __( 'Select image from the media library.', 'belctech-ecommerce' ),
			'dependency'	=> array(
				'element'	=> 'icon_type',
				'value'	=> array( 'image_id' )
			)
		),
		array(
			'type'			=> 'dropdown',
			'heading'		=> __( 'Image Style', 'belctech-ecommerce' ),
			'param_name'	=> 'image_style',
			'description'	=> __( 'Select an image style.', 'belctech-ecommerce' ),
			'value'		=> array(
				__( 'Default', 'belctech-ecommerce' )	=> 'default',
				__( 'Rounded', 'belctech-ecommerce' )	=> 'rounded'
			),
			'std'			=> 'default',
			'dependency'	=> array(
				'element'	=> 'icon_type',
				'value'	=> array( 'image_id' )
			)
		),
		array(
			'type'			=> 'textfield',
			'heading'		=> __( 'Title', 'belctech-ecommerce' ),
			'param_name'	=> 'title',
			'description'	=> __( 'Enter a feature title.', 'belctech-ecommerce' )
		),
		array(
			'type'			=> 'textfield',
			'heading'		=> __( 'Sub-title', 'belctech-ecommerce' ),
			'param_name'	=> 'subtitle',
			'description'	=> __( 'Enter a sub-title.', 'belctech-ecommerce' )
		),
		array(
			'type'			=> 'textarea_html',
			'heading'		=> __( 'Description', 'belctech-ecommerce' ),
			'param_name'	=> 'content', // Important: Only one textarea_html param per content element allowed and it should have "content" as a "param_name"
			'description'	=> __( 'Enter a feature description.', 'belctech-ecommerce' )
		),
		array(
			'type'			=> 'vc_link',
			'heading'		=> __( 'Link', 'belctech-ecommerce' ),
			'param_name'	=> 'link',
			'description'	=> __( 'Add a link for the icon and title.', 'belctech-ecommerce' )
		),
		array(
			'type'			=> 'dropdown',
			'heading'		=> __('Layout', 'belctech-ecommerce' ),
			'param_name'	=> 'layout',
			'description'	=> __( 'Select a layout.', 'belctech-ecommerce' ),
			'value'		=> array(
				__( 'Default', 'belctech-ecommerce' )		=> 'default',
				__( 'Centered', 'belctech-ecommerce' )		=> 'centered',
				__( 'Icon Right', 'belctech-ecommerce' )	=> 'icon_right',
				__( 'Icon Left', 'belctech-ecommerce' )		=> 'icon_left'
			),
			'std'			=> 'default',
			'group' => __( 'Styling','belctech-ecommerce' ),
		),
		array(
			'type'			=> 'dropdown',
			'heading'		=> __( 'Icon Style', 'belctech-ecommerce' ),
			'param_name'	=> 'icon_style',
			'value'		=> array(
				__( 'Icon Only', 'belctech-ecommerce' )		=> 'simple',
				__( 'Solid Background', 'belctech-ecommerce' )	=> 'background',
				__( 'With Border', 'belctech-ecommerce' )		=> 'border'
			),
			'std'			=> 'simple',
			'dependency'	=> array(
				'element'	=> 'icon_type',
				'value'	=> array( 'icon' )
			),
			'group' => __( 'Styling','belctech-ecommerce' ),
		),
		array(
			'type' => 'dropdown',
			'heading'		=> __( 'Icon Color', 'belctech-ecommerce' ),
			'param_name' => 'icon_color',
			'value' => array(
				__( 'Default', 'belctech-ecommerce' ) => '',
				__( 'Dark', 'belctech-ecommerce' ) => 'dark',
				__( 'Light', 'belctech-ecommerce' ) => 'light',
				__( 'Accent Color', 'belctech-ecommerce' ) => 'accent',
				__( 'Custom', 'belctech-ecommerce' ) => 'custom'
			),
			'std' => '',
			'dependency'	=> array(
				'element'	=> 'icon_type',
				'value'	=> array( 'icon' )
			),
			'group' => __( 'Styling','belctech-ecommerce' ),
		),
		array(
			'type'			=> 'colorpicker',
			'heading'		=> __( 'Icon Custom Color', 'belctech-ecommerce' ),
			'param_name'	=> 'icon_color_custom',
			'dependency'	=> array(
				'element'	=> 'icon_color',
				'value'	=> array( 'custom' )
			),
			'group' => __( 'Styling','belctech-ecommerce' ),
		),
		array(
			'type'			=> 'colorpicker',
			'heading'		=> __( 'Icon Background', 'belctech-ecommerce' ),
			'param_name'	=> 'icon_background_color_custom',
			'description'	=> __( 'For "Solid Background" style only.', 'belctech-ecommerce' ),
			'dependency'	=> array(
				'element'	=> 'icon_color',
				'value'	=> array( 'custom' )
			),
			'group' => __( 'Styling','belctech-ecommerce' ),
		),
		array(
			'type' => 'dropdown',
			'heading'		=> __( 'Text Color Scheme', 'belctech-ecommerce' ),
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
			'type'			=> 'colorpicker',
			'heading'		=> __( 'Title Color', 'belctech-ecommerce' ),
			'param_name'	=> 'title_color',
			'dependency'	=> array(
				'element'	=> 'text_color',
				'value'	=> array( 'custom' )
			),
			'group' => __( 'Styling','belctech-ecommerce' ),
		),
		array(
			'type'			=> 'colorpicker',
			'heading'		=> __( 'Subtitle Color', 'belctech-ecommerce' ),
			'param_name'	=> 'subtitle_color',
			'dependency'	=> array(
				'element'	=> 'text_color',
				'value'	=> array( 'custom' )
			),
			'group' => __( 'Styling','belctech-ecommerce' ),
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
			'std'			=> 'animation bottom-to-top',
			'group' => __( 'Styling','belctech-ecommerce' ),
		),
		array(
			'type'			=> 'dropdown',
			'heading'		=> __('Bottom Spacing', 'belctech-ecommerce' ),
			'param_name'	=> 'bottom_spacing',
			'value'		=> array(
				__( 'None', 'belctech-ecommerce' )	=> 'none',
				__( 'Small', 'belctech-ecommerce' )		=> 'small',
				__( 'Medium', 'belctech-ecommerce' )	=> 'medium',
				__( 'Large', 'belctech-ecommerce' )		=> 'large'
			),
			'std'			=> 'none',
			'group' => __( 'Styling','belctech-ecommerce' ),
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