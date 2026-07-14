<?php // Image shortcode
vc_map( array(
	'name' => 'Image',
	'description' => esc_html__('Add an animated image', 'belctech-ecommerce'),
	'category' => esc_html__('Belctech', 'belctech-ecommerce'),
	'base' => 'et_image',
	'icon' => 'et_image',
	'params' => array(
		array(
			'type' => 'attach_image',
			'heading' => esc_html__('Select Image', 'belctech-ecommerce'),
			'param_name' => 'image'
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Display Caption?', 'belctech-ecommerce'),
			'param_name' => 'caption',
			'value' => array(
				__( 'Yes', 'belctech-ecommerce' ) => 'true'
			),
			'description' => esc_html__('If selected, the image caption will be displayed.', 'belctech-ecommerce'),
			'group' => __( 'Text','belctech-ecommerce' ),
		),
		array(
			'type'           => 'textarea_html',
			'heading'        => esc_html__( 'Text Below Image', 'belctech-ecommerce' ),
			'param_name'     => 'content',
			'group' => __( 'Text','belctech-ecommerce' ),
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Full Width?', 'belctech-ecommerce'),
			'param_name' => 'full_width',
			'value' => array(
				__( 'Yes', 'belctech-ecommerce' ) => 'true'
			),
			'description' => esc_html__('If selected, the image will always fill its container', 'belctech-ecommerce')
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
      'group' => __( 'Styling','belctech-ecommerce' ),
    ),
		array(
		  'type' => 'textfield',
		  'heading' => esc_html__('Image size', 'belctech-ecommerce'),
		  'param_name' => 'img_size',
		  'description' => esc_html__('Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Leave empty to use "full" size.', 'belctech-ecommerce')
		),
		array(
		  'type' => 'dropdown',
		  'heading' => esc_html__('Image alignment', 'belctech-ecommerce'),
		  'param_name' => 'alignment',
		  'value' => array(
			__( 'Align left', 'belctech-ecommerce' ) => 'alignleft',
			__( 'Align right', 'belctech-ecommerce' ) => 'alignright',
			__( 'Align center', 'belctech-ecommerce' ) => 'aligncenter'
		  ),
		  'description' => esc_html__('Select image alignment.', 'belctech-ecommerce')
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Link to Full-Width Image?', 'belctech-ecommerce'),
			'param_name' => 'lightbox',
			'value' => array(
				__( 'Yes', 'belctech-ecommerce' ) => 'true'
			)
		),
		array(
		  'type' => 'vc_link',
		  'heading' => esc_html__('Image link', 'belctech-ecommerce'),
		  'param_name' => 'img_link',
		  'description' => esc_html__('Enter url if you want this image to have link.', 'belctech-ecommerce'),
		  'dependency' => array(
			'element' => 'lightbox',
			'is_empty' => true
		  )
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Extra Class Name', 'belctech-ecommerce'),
			'param_name' => 'extra_class',
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Border Radius', 'belctech-ecommerce'),
			'param_name' => 'border_radius',
			'group' => __( 'Styling','belctech-ecommerce' ),
			'description' => esc_html__('You can add your own border-radius code here. For ex: 2px 2px 4px 4px', 'belctech-ecommerce')
		),
		array(
			'type'						=> 'dropdown',
			'heading'				=> esc_html__('Box Shadow', 'belctech-ecommerce'),
			'param_name'			=> 'box_shadow',
			'value'						=> array(
				__( 'No Shadow', 'belctech-ecommerce' ) => '',
				__( 'Small', 'belctech-ecommerce' ) => 'small-shadow',
				__( 'Medium', 'belctech-ecommerce' ) => 'medium-shadow',
				__( 'Large', 'belctech-ecommerce' ) => 'large-shadow',
				__( 'X-Large', 'belctech-ecommerce' ) => 'xlarge-shadow',
			),
			'dependency' => array(
				'element' => 'style',
				'value' => array('lightbox-style2')
			),
			'group' => __( 'Styling','belctech-ecommerce' ),
		),
		array(
			'type'						=> 'dropdown',
			'heading'				=> esc_html__('Image Max Width', 'belctech-ecommerce'),
			'param_name'			=> 'max_width',
			'value'						=> array(
				'100%' => 'size_100',
				'125%' => 'size_125',
				'150%' => 'size_150',
				'175%' => 'size_175',
				'200%' => 'size_200',
				'225%' => 'size_225',
				'250%' => 'size_250',
				'275%' => 'size_275',
			),
			'std' => 'size_100',
			'group' => __( 'Styling','belctech-ecommerce' ),
			'description' => esc_html__('By default, image is contained within the columns, by setting this, you can extend the image over the container', 'belctech-ecommerce')
		),
	),

) );
