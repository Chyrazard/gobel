<?php // Image shortcode
vc_map( array(
	'name' => __('Image Slider', 'belctech-ecommerce'),
	'description' => __('Add Slider with your images', 'belctech-ecommerce'),
	'category' => __('Belctech', 'belctech-ecommerce'),
	'base' => 'et_image_slider',
	'icon' => 'et_image_slider',
	'params'	=> array(
		array(
			'type' => 'attach_images',
			'heading' => __('Select Images', 'belctech-ecommerce'),
			'param_name' => 'images'
		),
		array(
		  'type' => 'textfield',
		  'heading' => esc_html__('Image size', 'belctech-ecommerce'),
		  'param_name' => 'img_size',
		  'description' => esc_html__('Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "full" size.', 'belctech-ecommerce')
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Display Caption?', 'belctech-ecommerce'),
			'param_name' => 'caption',
			'value' => array(
				__( 'Yes', 'belctech-ecommerce' ) => 'true'
			),
			'description' => esc_html__('If selected, the image caption will be displayed.', 'belctech-ecommerce'),
		),
		array(
			'type'			=> 'textfield',
			'heading' => __( 'Columns (Desktop)', 'belctech-ecommerce' ),
			'param_name' => 'columns',
			'description' => __( 'Number of columns to show.', 'belctech-ecommerce' ),
			'value'		=> '1',
		),
		array(
			'type'			=> 'textfield',
			'heading' => __( 'Mobile Columns', 'belctech-ecommerce' ),
			'param_name' => 'columns_mobile',
			'description' => __( 'Number of columns for mobiles.', 'belctech-ecommerce' ),
			'value'		=> '1',
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
			'heading'		=> __( 'Infinite Loop', 'belctech-ecommerce' ),
			'param_name' => 'infinite',
			'description'	=> __( 'Infinite loop sliding.', 'belctech-ecommerce' ),
			'value' => array(
				__( 'Enable', 'belctech-ecommerce' ) => 'true'
			),
		),
		array(
			'type' => 'dropdown',
			'heading' => __('Use lightbox?', 'belctech-ecommerce'),
			'param_name' => 'lightbox',
			'value' => array(
				__( 'Yes', 'belctech-ecommerce' ) => 'yes',
				__( 'No', 'belctech-ecommerce' ) => 'no',
			),
			'std' => 'no',
		),
		array(
			'type' => 'checkbox',
			'heading' => __('Center Images', 'belctech-ecommerce'),
			'param_name' => 'center',
			'value' => array(
				__( 'Yes', 'belctech-ecommerce' ) => 'true'
			)
		),
		array(
			'type' => 'checkbox',
			'heading' => __('Arrows', 'belctech-ecommerce'),
			'param_name' => 'arrows',
			'description'	=> __( 'Display "prev" and "next" arrows.', 'belctech-ecommerce' ),
			'value' => array(
				__( 'Yes', 'belctech-ecommerce' ) => 'true'
			),
			'dependency' => array(
				'element' => 'lightbox',
				'value' => array('no')
			),
			'group' => __( 'Navigation','belctech-ecommerce' ),
		),
		array(
			'type' => 'checkbox',
			'heading' => __('Navigation Dots', 'belctech-ecommerce'),
			'param_name' => 'pagination',
			'value' => array(
				__( 'Yes', 'belctech-ecommerce' ) => 'true'
			),
			'group' => __( 'Navigation','belctech-ecommerce' ),
		),

		array(
			'type' => 'checkbox',
			'heading' => __('Overflow Visible?', 'belctech-ecommerce'),
			'param_name' => 'overflow',
			'value' => array(
				__( 'Yes', 'belctech-ecommerce' ) => 'overflow-visible'
			),
			'description' => __('Show semi-transparent previous and next slides', 'belctech-ecommerce' ),
			'group' => __( 'Navigation','belctech-ecommerce' ),
		),
		array(
			'type' => 'checkbox',
			'heading' => __('Auto Play', 'belctech-ecommerce'),
			'param_name' => 'autoplay',
			'value' => array(
				__( 'Yes', 'belctech-ecommerce' ) => 'true'
			),
			'group' => __( 'Navigation','belctech-ecommerce' ),
			'description' => __('If enabled, the carousel will autoplay.', 'belctech-ecommerce'),
		),
		array(
			'type' => 'textfield',
			'heading' => __('Speed of the AutoPlay', 'belctech-ecommerce'),
			'param_name' => 'autoplay_speed',
			'value' => '4000',
			'group' => __( 'Navigation','belctech-ecommerce' ),
			'description' => __('Speed of the autoplay, default 4000 (4 seconds)', 'belctech-ecommerce'),
			'dependency' => array(
				'element' => 'autoplay',
				'value' => array('true')
			)
		),
		array(
			'type' => 'checkbox',
			'heading' => __('Pause on hover', 'belctech-ecommerce'),
			'param_name' => 'pause',
			'value' => array(
				__( 'Enable', 'belctech-ecommerce' ) => 'true'
			),
			'group' => __( 'Navigation','belctech-ecommerce' ),
			'description' => __('Pause autoplay on hover.', 'belctech-ecommerce'),
			'dependency' => array(
				'element' => 'autoplay',
				'value' => array('true')
			)
		),
		array(
			'type' => 'textfield',
			'heading' => __('Extra Class Name', 'belctech-ecommerce'),
			'param_name' => 'extra_class',
		),
	),
) );