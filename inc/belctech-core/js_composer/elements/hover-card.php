<?php

// VC element: et_hovercard

vc_map( array(
	'name' => esc_html__('Hover Card', 'belctech-ecommerce' ),
	'base' => 'et_hovercard',
	'icon' => 'et_hovercard',
	'category' => esc_html__('Belctech', 'belctech-ecommerce' ),
	'params' => array(
		 array(
			'type'           => 'vc_link',
			'heading'        => esc_html__( 'Box link', 'belctech-ecommerce' ),
			'param_name'     => 'link',
			'description'    => esc_html__( 'Add a URL (optional)', 'belctech-ecommerce' ),
		),
		array(
		  'type' => 'textfield',
		  'heading' => esc_html__('Min Height', 'belctech-ecommerce' ),
		  'param_name' => 'min_height',
		  'description' => esc_html__('Please enter the minimum height you would like for you box. Enter in number of pixels - Don\'t enter \'px\', default is \'300\'', 'belctech-ecommerce' )
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Extra Class Name', 'belctech-ecommerce' ),
			'param_name' => 'extra_class',
		),
    array(
			'type'  => 'textfield',
			'heading' => esc_html__('Title', 'belctech-ecommerce' ),
			'param_name' => 'normal_title',
			'group' => esc_html__('Normal', 'belctech-ecommerce' )
		),
		array(
			'type' => 'colorpicker',
			'heading' => esc_html__('Title Color', 'belctech-ecommerce' ),
			'param_name' => 'normal_title_color',
			'group' => esc_html__('Normal', 'belctech-ecommerce' )
		),
		array(
			'type' => 'attach_image',
			'heading' => esc_html__('Background Image', 'belctech-ecommerce' ),
			'param_name' => 'normal_bg_image',
			'group' => esc_html__('Normal', 'belctech-ecommerce' )
		),
		array(
      'type'           => 'colorpicker',
      'heading'        => esc_html__('Background Color', 'belctech-ecommerce' ),
      'param_name'     => 'normal_bg_color',
      'group' => esc_html__('Normal', 'belctech-ecommerce' ),
      'dependency' => array(
        'element' => 'highlight',
        'value'   => array( 'true' )),
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
      'std'       => ''
    ),
    array(
      'type'      => 'dropdown',
      'heading'     => __('Icon', 'belctech-ecommerce' ),
      'param_name'  => 'icon_type',
      'description' => __( 'Select icon type.', 'belctech-ecommerce' ),
      'value'     => array(
	__( 'No Icon', 'belctech-ecommerce' )  => 'no_icon',
        __( 'Font Icon', 'belctech-ecommerce' ) => 'icon',
        __( 'Image', 'belctech-ecommerce' )   => 'image_id'
      ),
      'std'       => 'no_icon',
      'group' => esc_html__('Hover', 'belctech-ecommerce' )
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
      'dependency'  => array(
        'element' => 'icon_type',
        'value'   => 'icon'
      ),
      'group' => esc_html__('Hover', 'belctech-ecommerce' )
    ),
    array(
      'type'      => 'iconpicker',
      'heading'     => __( 'Icon', 'belctech-ecommerce' ),
      'param_name'  => 'icon_pixeden',
      'description'   => __( 'Select icon from library.', 'belctech-ecommerce' ),
      'value'     => 'pe-7s-close',
      'settings'    => array(
        'type'      => 'pixeden',
        'emptyIcon'   => false,
        'iconsPerPage'  => 3000
      ),
      'dependency'  => array(
        'element' => 'icon_library',
        'value'   => 'pixeden'
      ),
      'group' => esc_html__('Hover', 'belctech-ecommerce' )
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
      'group' => esc_html__('Hover', 'belctech-ecommerce' )
    ),
    array(
      'type'      => 'attach_image',
      'heading'     => __( 'Image', 'belctech-ecommerce' ),
      'param_name'  => 'image_id',
      'description' => __( 'Select image from the media library.', 'belctech-ecommerce' ),
      'dependency'  => array(
        'element' => 'icon_type',
        'value'   => array( 'image_id' )
      ),
      'group' => esc_html__('Hover', 'belctech-ecommerce' )
    ),
		array(
			'type'  => 'textfield',
			'heading' => esc_html__('Title', 'belctech-ecommerce' ),
			'param_name' => 'hover_title',
			'group' => esc_html__('Hover', 'belctech-ecommerce' )
		),
		array(
			'type' => 'textarea_safe',
			'heading' => esc_html__('Content', 'belctech-ecommerce' ),
			'param_name' => 'hover_content',
			'group' => esc_html__('Hover', 'belctech-ecommerce' )
		),
		array(
			'type' => 'colorpicker',
			'heading' => esc_html__('Icon Color', 'belctech-ecommerce' ),
			'param_name' => 'hover_icon_color',
			 'dependency'  => array(
        'element' => 'icon_type',
        'value'   => 'icon'
      ),
			'group' => esc_html__('Hover', 'belctech-ecommerce' )
		),
		array(
			'type' => 'colorpicker',
			'heading' => esc_html__('Title Color', 'belctech-ecommerce' ),
			'param_name' => 'hover_title_color',
			'group' => esc_html__('Hover', 'belctech-ecommerce' )
		),
		array(
			'type' => 'colorpicker',
			'heading' => esc_html__('Content Color', 'belctech-ecommerce' ),
			'param_name' => 'hover_content_color',
			'group' => esc_html__('Hover', 'belctech-ecommerce' )
		),
		array(
      'type'           => 'colorpicker',
      'heading'        => esc_html__('Background Color', 'belctech-ecommerce' ),
      'param_name'     => 'hover_bg_color',
      'group' => esc_html__('Hover', 'belctech-ecommerce' ),
      'dependency' => array(
        'element' => 'highlight',
        'value'   => array( 'true' )),
    ),
	),
	'description' => esc_html__('Add a Hover Card', 'belctech-ecommerce' )
) );