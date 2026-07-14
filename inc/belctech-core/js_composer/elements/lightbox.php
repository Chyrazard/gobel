<?php

// VC element: et_lightbox
vc_map( array(
 'name' => esc_html__( 'Lightbox', 'belctech-ecommerce' ),
 'description' => esc_html__( 'Lightbox modal with custom content', 'belctech-ecommerce' ),
 'category' => esc_html__('Belctech', 'belctech-ecommerce'),
 'base' => 'et_lightbox',
 'icon' => 'et_lightbox',
 'params' => array(
		array(
			'type' => 'dropdown',
			'heading' => __('Link Type', 'belctech-ecommerce' ),
			'param_name' => 'link_type',
			'description' => __( 'Select lightbox link type.', 'belctech-ecommerce' ),
			'value' => array(
				__( 'Link', 'belctech-ecommerce' ) => 'link',
				__( 'Button', 'belctech-ecommerce' ) => 'btn',
				__( 'Image', 'belctech-ecommerce' ) => 'image'
			),
			'std' => 'link'
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Title', 'belctech-ecommerce' ),
			'param_name' => 'title',
			'description' => __( 'Enter a lightbox link/button title.', 'belctech-ecommerce' )
		),
		// Dependency: link_type - btn
		array(
			'type' => 'dropdown',
			'heading' => __( 'Button Style', 'belctech-ecommerce' ),
			'param_name' => 'button_style',
			'description' => __( 'Select button style.', 'belctech-ecommerce' ),
			'value' => array(
				__( 'Solid', 'belctech-ecommerce' ) => 'solid',
				__( 'Solid Rounded', 'belctech-ecommerce' ) => 'solid rounded',
				__( 'Outlined', 'belctech-ecommerce' ) => 'outlined',
				__( 'Outlined Rounded', 'belctech-ecommerce' ) => 'outlined rounded',
				__( 'Link', 'belctech-ecommerce' ) => 'link'
			),
			'std' => 'solid',
			'dependency' => array(
				'element' => 'link_type',
				'value' => array( 'btn' )
			)
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Button Align', 'belctech-ecommerce' ),
			'param_name' => 'button_align',
			'value' => array(
				__( 'Left', 'belctech-ecommerce' ) => 'left',
				__( 'Center', 'belctech-ecommerce' ) => 'center',
				__( 'Right', 'belctech-ecommerce' ) => 'right'
			),
			'std' => 'center',
			'dependency' => array(
				'element' => 'link_type',
				'value' => array( 'btn' )
			)
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Button Size', 'belctech-ecommerce' ),
			'param_name' => 'button_size',
			'description' => __( 'Select button size.', 'belctech-ecommerce' ),
			'value' => array(
				__( 'Mini', 'belctech-ecommerce' ) => 'xs',
				__( 'Small', 'belctech-ecommerce' ) => 'sm',
				__( 'Normal', 'belctech-ecommerce' ) => 'md',
				__( 'Large', 'belctech-ecommerce' ) => 'lg'
			),
			'std' => 'lg',
			'dependency' => array(
				'element' => 'link_type',
				'value' => array( 'btn' )
			)
		),
		array(
			'type' => 'colorpicker',
			'heading' => __( 'Button Color', 'belctech-ecommerce' ),
			'param_name' => 'button_color',
			'description' => __( 'Select button color.', 'belctech-ecommerce' ),
			'dependency' => array(
				'element' => 'link_type',
				'value' => array( 'btn' )
			)
		),

		// Dependency: link_type - image
		array(
			'type' => 'attach_image',
			'heading' => __( 'Link Image', 'belctech-ecommerce' ),
			'param_name' => 'link_image_id',
			'description' => __( 'Select image from the media library.', 'belctech-ecommerce' ),
			'dependency' => array(
				'element' => 'link_type',
				'value' => array( 'image' )
			),
			'group' => __( 'Source','belctech-ecommerce' ),
		),
		array(
			'type' => 'dropdown',
			'heading' => __('Lightbox Type', 'belctech-ecommerce' ),
			'param_name' => 'content_type',
			'description' => __( 'Select content type.', 'belctech-ecommerce' ),
			'value' => array(
				__( 'Image', 'belctech-ecommerce' ) => 'image',
				__( 'Video', 'belctech-ecommerce' ) => 'iframe',
				__( 'HTML', 'belctech-ecommerce' ) => 'inline'
			),
			'std' => 'image',
			'group' => __( 'Source','belctech-ecommerce' ),
		),
		// Dependency: content_type - image
		array(
			'type' => 'attach_image',
			'heading' => __( 'Lightbox Image', 'belctech-ecommerce' ),
			'param_name' => 'content_image_id',
			'description' => __( 'Select image from the media library.', 'belctech-ecommerce' ),
			'dependency' => array(
				'element' => 'content_type',
				'value' => array( 'image' )
			),
			'group' => __( 'Source','belctech-ecommerce' ),
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Lightbox Image Caption', 'belctech-ecommerce' ),
			'param_name' => 'content_image_caption',
			'description' => __( 'Display image caption.', 'belctech-ecommerce' ),
			'value' => array(
				__( 'Enable', 'belctech-ecommerce' ) => '1'
			),
			'dependency' => array(
				'element' => 'content_type',
				'value' => array( 'image' )
			),
			'group' => __( 'Source','belctech-ecommerce' ),
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Video URL', 'belctech-ecommerce' ),
			'param_name' => 'content_url',
			'description' => __( 'Insert a Video URL. <strong>YouTube video:</strong> http://www.youtube.com/watch?v=xxxx', 'belctech-ecommerce' ),
			'dependency' => array(
				'element' => 'content_type',
				'value' => array( 'iframe' )
			),
			'group' => __( 'Source','belctech-ecommerce' ),
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Source ID', 'belctech-ecommerce' ),
			'param_name' => 'content_selector',
			'description' => __( 'If the content is in another element of this page use the ID of that element(# included):<strong>#lightbox-id</strong><br>Or use the editor below to add the content.', 'belctech-ecommerce' ),
			'dependency' => array(
				'element' => 'content_type',
				'value' => array( 'inline' )
			),
			'group' => __( 'Source','belctech-ecommerce' ),
		),
		array(
		  'type' => 'textarea_html',
		  'heading' => __( 'Custom Content', 'belctech-ecommerce' ),
		  'param_name' => 'content',
		  'description' => __( 'Add the custom content for the ligthbox', 'belctech-ecommerce' ),
		  'dependency' => array(
			'element' => 'content_type',
			'value' => array( 'inline' )
		  ),
		  'group' => __( 'Source','belctech-ecommerce' ),
		),
	)
) );