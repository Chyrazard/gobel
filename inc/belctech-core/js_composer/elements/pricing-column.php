<?php

// VC element: et_pricing_table

vc_map( array(
	'name' => esc_html__('Pricing Table Column', 'belctech-ecommerce' ),
  'description' => esc_html__('Add a pricing table column', 'belctech-ecommerce' ),
  'category' => esc_html__('Belctech', 'belctech-ecommerce'),
	'base' => 'et_pricing_column',
	'icon' => 'et_pricing_column',
	'as_child' => array('only' => 'et_pricing_table'),
	'params'	=> array(
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Highlight this column?', 'belctech-ecommerce' ),
			'param_name' => 'highlight',
			'value' => array(
				__( 'Yes', 'belctech-ecommerce' )	=> 'true'
			),
			'description' => esc_html__('If enabled, this column will be hightlighted. See the Styling tab.', 'belctech-ecommerce' ),
		),
		array(
      'type'      => 'dropdown',
      'heading'     => __('Icon Type', 'belctech-ecommerce' ),
      'param_name'  => 'icon_type',
      'description' => __( 'Select icon type.', 'belctech-ecommerce' ),
      'value'     => array(
        __( 'Font Icon', 'belctech-ecommerce' ) => 'icon',
        __( 'Image', 'belctech-ecommerce' )   => 'image_id'
      ),
      'std'       => 'icon',
      'dependency' => array(
        'element' => 'style',
        'value'   => array( 'counter-top','counter-bottom' )),
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
      )
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
      'type'      => 'attach_image',
      'heading'     => __( 'Image', 'belctech-ecommerce' ),
      'param_name'  => 'image_id',
      'description' => __( 'Select image from the media library.', 'belctech-ecommerce' ),
      'dependency'  => array(
        'element' => 'icon_type',
        'value'   => array( 'image_id' )
      )
    ),
		array(
			'type'           => 'textfield',
			'heading'        => esc_html__( 'Title', 'belctech-ecommerce' ),
			'param_name'     => 'title',
			'admin_label'	 => true,
			'description'    => esc_html__( 'Title of this pricing column', 'belctech-ecommerce' ),
		),
		array(
			'type'           => 'textfield',
			'heading'        => esc_html__( 'Price', 'belctech-ecommerce' ),
			'param_name'     => 'price',
			'description'    => esc_html__( 'Price of this pricing column.', 'belctech-ecommerce' ),
		),
		array(
			'type'           => 'textfield',
			'heading'        => esc_html__( 'Sub Title', 'belctech-ecommerce' ),
			'param_name'     => 'sub_title',
			'description'    => esc_html__( 'Some information under the price.', 'belctech-ecommerce' ),
		),
		array(
			'type'           => 'textarea_html',
			'heading'        => esc_html__( 'Description', 'belctech-ecommerce' ),
			'param_name'     => 'content',
			'description'    => esc_html__( 'Include a small description for this box, this text area supports HTML too.', 'belctech-ecommerce' ),
		),
		array(
			'type'           => 'vc_link',
			'heading'        => esc_html__( 'Pricing CTA Button', 'belctech-ecommerce' ),
			'param_name'     => 'link',
			'description'    => esc_html__( 'Button at the end of the pricing table.', 'belctech-ecommerce' ),
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
      'std'       => 'animation bottom-to-top'
    ),
		array(
      'type'           => 'colorpicker',
      'heading'        => esc_html__('Background Color', 'belctech-ecommerce' ),
      'param_name'     => 'background_color',
      'group' => __( 'Styling','belctech-ecommerce' ),
      'dependency' => array(
        'element' => 'highlight',
        'value'   => array( 'true' )),
    ),
		array(
      'type'           => 'colorpicker',
      'heading'        => esc_html__('Price Color', 'belctech-ecommerce' ),
      'param_name'     => 'price_color',
      'group' => __( 'Styling','belctech-ecommerce' ),
      'dependency' => array(
        'element' => 'highlight',
        'value'   => array( 'true' )),
    ),
    array(
      'type'           => 'colorpicker',
      'heading'        => esc_html__('Icon Color', 'belctech-ecommerce' ),
      'param_name'     => 'icon_color',
      'group' => __( 'Styling','belctech-ecommerce' ),
      'dependency' => array(
        'element' => 'highlight',
        'value'   => array( 'true' )),
    ),
    array(
      'type'           => 'colorpicker',
      'heading'        => esc_html__('Title Color', 'belctech-ecommerce' ),
      'param_name'     => 'title_color',
      'group' => __( 'Styling','belctech-ecommerce' ),
      'dependency' => array(
        'element' => 'highlight',
        'value'   => array( 'true' )),
    ),
    array(
      'type'           => 'colorpicker',
      'heading'        => esc_html__('Button Color', 'belctech-ecommerce' ),
      'param_name'     => 'button_color',
      'group' => __( 'Styling','belctech-ecommerce' ),
      'dependency' => array(
        'element' => 'highlight',
        'value'   => array( 'true' )),
    ),
	),

) );

// Extend element with the WPBakeryShortCode class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_ET_Pricing_Column extends WPBakeryShortCode {}
}