<?php

// VC element: et_video_lightbox

vc_map( array(
	'name' => esc_html__('Video Lightbox', 'belctech-ecommerce'),
	'description' => esc_html__('With icon or image link', 'belctech-ecommerce'),
	'category' => esc_html__('Belctech', 'belctech-ecommerce'),
	'base' => 'et_video_lightbox',
	'icon' => 'et_video_lightbox',

	'params'	=> array(
	  array(
		'type'					=> 'dropdown',
		'heading'			=> esc_html__('Style', 'belctech-ecommerce'),
		'param_name'		=> 'style',
		'value'					=> array(
			__( 'Just Icon', 'belctech-ecommerce' )	=> 'lightbox-icon',
			__( 'With Image', 'belctech-ecommerce' )	=> 'lightbox-image',
			__( 'With Text', 'belctech-ecommerce' )	=> 'lightbox-text',
		)
	  ),
	  array(
		'type'           => 'textfield',
		'heading'        => esc_html__( 'Video Link', 'belctech-ecommerce' ),
		'param_name'     => 'video',
		'admin_label'		 => true,
		'description'    => esc_html__( 'URL of the video Youtube, Vimeo, etc.', 'belctech-ecommerce' ),
	  ),
	  array(
		'type'           => 'textfield',
		'heading'        => esc_html__( 'Text for the link', 'belctech-ecommerce' ),
		'param_name'     => 'video_text',
		'admin_label'		 => true,
		'description'    => esc_html__( 'Text you want to show next to the icon', 'belctech-ecommerce' ),
		'dependency'		 => array(
			'element' => 'style',
			'value' => array('lightbox-text')
		)
	  ),
	  array(
		'type'					=> 'dropdown',
		'heading'			=> esc_html__('Icon Style', 'belctech-ecommerce'),
		'param_name'		=> 'icon_style',
		'value'					=> array(
			__( 'Pulse', 'belctech-ecommerce' )	=> 'pulse',
			__( 'Simple', 'belctech-ecommerce' )	=> 'simple',
		),
		'std'						=> 'pulse',
		'group' => __( 'Styling','belctech-ecommerce' ),
	  ),
	  array(
		'type'					=> 'dropdown',
		'heading'			=> esc_html__('Icon Size', 'belctech-ecommerce'),
		'param_name'		=> 'icon_size',
		'value'					=> array(
			__( 'Small', 'belctech-ecommerce' )	=> 'small',
			__( 'Medium', 'belctech-ecommerce' )	=> 'medium',
			__( 'Large', 'belctech-ecommerce' )	=> 'large',
		),
		'std'						=> 'medium',
		'group' => __( 'Styling','belctech-ecommerce' ),
	  ),
	  array(
		'type' => 'dropdown',
		'heading' => __( 'Icon Color', 'belctech-ecommerce' ),
		'description'	=> esc_html__( 'Color of the Play Icon', 'belctech-ecommerce' ),
		'param_name' => 'icon_color',
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
		'type'					=> 'colorpicker',
		'heading'			=> esc_html__( 'Icon Custom Color', 'belctech-ecommerce' ),
		'param_name'		=> 'icon_color_custom',
		'dependency'		 => array(
			'element' => 'icon_color',
			'value' => array('custom')
		),
		'group' => __( 'Styling','belctech-ecommerce' ),
	  ),
	  array(
		'type'           => 'attach_image',
		'heading'        => esc_html__( 'Select Image', 'belctech-ecommerce' ),
		'param_name'     => 'image',
		'description'    => esc_html__( 'Select image from media library.', 'belctech-ecommerce' ),
		'dependency'		 => array(
			'element' => 'style',
			'value' => array('lightbox-image')
		)
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
		'type'						=> 'dropdown',
		'heading'				=> esc_html__('Image Hover Style', 'belctech-ecommerce'),
		'param_name'			=> 'hover_style',
		'value'						=> array(
			__( 'No Animation', 'belctech-ecommerce' )	=> '',
			__( 'Image Zoom', 'belctech-ecommerce' )		=> 'hover-zoom',
		),
		'dependency'			=> array(
			'element' => 'style',
			'value' => array('lightbox-image')
		),
		'group' => __( 'Styling','belctech-ecommerce' ),
	  )
	),

) );
