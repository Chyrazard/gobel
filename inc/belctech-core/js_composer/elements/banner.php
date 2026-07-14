<?php

// VC element: et_banner
vc_map( array(
	'name' => __( 'Banner', 'belctech-ecommerce' ),
	'description' => __( 'Responsive banner', 'belctech-ecommerce' ),
	'base' => 'et_banner',
	'icon' => 'et_banner',
	'category' => esc_html__('Belctech', 'belctech-ecommerce'),
	'params' => array(
		array(
			'type' => 'dropdown',
			'heading' => __( 'Content Layout', 'belctech-ecommerce' ),
			'param_name' => 'layout',
			'description' => __( 'Select content layout. "Inherit" matches the site global container width', 'belctech-ecommerce' ),
			'value' => array(
				__( 'Full Width', 'belctech-ecommerce' ) => 'full',
				__( 'Inherit', 'belctech-ecommerce' ) => 'boxed',
			),
			'std' => 'full',
		),
		array(
			'type' => 'attach_image',
			'heading' => __( 'Image', 'belctech-ecommerce' ),
			'param_name' => 'image_id',
			'description' => __( 'Add a banner image.', 'belctech-ecommerce' )
		),
		array(
			'type'      => 'attach_image',
			'heading'     => __( 'Image - Tablet/Mobile', 'belctech-ecommerce' ),
			'param_name'  => 'alt_image_id',
			'description'   => __( 'Set an optional banner image to display on smaller screens (max-width: 767px).', 'belctech-ecommerce' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Image Type', 'belctech-ecommerce' ),
			'param_name' => 'image_type',
			'description' => __( '1. Responsive: the image size determines the banner height. 2) Background image: you can set your preferred height.', 'belctech-ecommerce' ),
			'value' => array(
				__( 'Responsive Image', 'belctech-ecommerce' ) => 'fluid',
				__( 'CSS Background Image', 'belctech-ecommerce' ) => 'css'
			),
			'std' => 'fluid'
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Banner Height', 'belctech-ecommerce' ),
			'param_name' => 'height',
			'description' => __( 'Proportional to screen height', 'belctech-ecommerce' ),
			'value' => array(
				'10%' => '10',
				'20%' => '20',
				'30%' => '30',
				'40%' => '40',
				'50%' => '50',
				'60%' => '60',
				'70%' => '70',
				'80%' => '80',
				'90%' => '90',
				'100%' => '100',
				__( 'Custom Height', 'belctech-ecommerce' ) => 'custom',
			),
			'std' => '50',
			'dependency' => array(
				'element' => 'image_type',
				'value' => array( 'css' )
			),
			'group' => __( 'Size','belctech-ecommerce' ),
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Custom Banner Height', 'belctech-ecommerce' ),
			'param_name' => 'custom_height',
			'description' => __( 'Enter banner height with unit (eg. 300px).', 'belctech-ecommerce' ),
			'dependency' => array(
				'element' => 'height',
				'value' => array( 'custom' )
			),
			'group' => __( 'Size','belctech-ecommerce' ),
		),

		array(
			'type' => 'dropdown',
			'heading' => __( 'Banner Height  - Mobiles', 'belctech-ecommerce' ),
			'param_name' => 'height_mobile',
			'description' => __( 'Proportional to screen height', 'belctech-ecommerce' ),
			'value' => array(
				__( 'Same as desktop', 'belctech-ecommerce' ) => '',
				'10%' => '10',
				'20%' => '20',
				'30%' => '30',
				'40%' => '40',
				'50%' => '50',
				'60%' => '60',
				'70%' => '70',
				'80%' => '80',
				'90%' => '90',
				'100%' => '100',
				__( 'Custom Height', 'belctech-ecommerce' ) => 'custom',
			),
			'std' => '',
			'dependency' => array(
				'element' => 'image_type',
				'value' => array( 'css' )
			),
			'group' => __( 'Size','belctech-ecommerce' ),
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Custom Banner Height - Mobiles', 'belctech-ecommerce' ),
			'param_name' => 'custom_height_mobile',
			'description' => __( 'Enter banner height with unit (eg. 300px).', 'belctech-ecommerce' ),
			'dependency' => array(
				'element' => 'height_mobile',
				'value' => array( 'custom' )
			),
			'group' => __( 'Size','belctech-ecommerce' ),
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Image size', 'belctech-ecommerce'),
			'param_name' => 'img_size',
			'description' => esc_html__('Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Leave empty to use "full" image size.', 'belctech-ecommerce'),
			'group' => __( 'Size','belctech-ecommerce' ),
		),
		array(
		  'type' => 'textfield',
		  'heading' => esc_html__('"Sizes" attribute', 'belctech-ecommerce'),
		  'param_name' => 'img_sizes',
		  'description' => esc_html__('Enter image \'sizes\' attribute for responsive image loading. Leave empty if unsure.', 'belctech-ecommerce'),
		  'group' => __( 'Size','belctech-ecommerce' ),
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Default Color Scheme', 'belctech-ecommerce' ),
			'param_name' => 'text_color_scheme',
			'description' => __( 'This is the Default banner text color. You can override the color of each element.', 'belctech-ecommerce' ),
			'value' => array(
				__( 'Dark', 'belctech-ecommerce' ) => 'dark',
				__( 'Light', 'belctech-ecommerce' ) => 'light'
			),
			'std' => 'dark',
		),
		array(
			'type' => 'colorpicker',
			'heading' => __( 'Banner Background', 'belctech-ecommerce' ),
			'param_name' => 'background_color',
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Hover Effect', 'belctech-ecommerce' ),
			'param_name' => 'hover_effect',
			'description' => __( 'Animation on hover.', 'belctech-ecommerce' ),
			'value' => array(
				__( 'None', 'belctech-ecommerce' ) => '',
				__( 'Border', 'belctech-ecommerce' ) => 'hover-border',
				__( 'Zoom', 'belctech-ecommerce' ) => 'hover-zoom',
				__( 'Border & Zoom', 'belctech-ecommerce' ) => 'hover-border hover-zoom'
			),
		),
		array(
			'type' => 'colorpicker',
			'heading' => __( 'Hover Border Color', 'belctech-ecommerce' ),
			'param_name' => 'border_color',
			'description' => __( 'Border color used on hover effect.', 'belctech-ecommerce' ),
			'dependency' => array(
				'element' => 'hover_effect',
				'value' => array( 'hover-border', 'hover-border hover-zoom' )
			)
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Extra Class', 'belctech-ecommerce' ),
			'description' => esc_html__('Add a class for more customization', 'belctech-ecommerce' ),
			'param_name' => 'extra_class',
		),
		array(
			'type' => 'vc_link',
			'heading' => __( 'Link (URL)', 'belctech-ecommerce' ),
			'param_name' => 'link',
			'description' => __( 'Set a banner link.', 'belctech-ecommerce' ),
			'group' => __( 'Link','belctech-ecommerce' ),
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Link Type', 'belctech-ecommerce' ),
			'param_name' => 'link_type',
			'description' => __( 'Full banner link (text/button not visible) or text/button link only', 'belctech-ecommerce' ),
			'value' => array(
				__( 'Banner Link', 'belctech-ecommerce' ) => 'banner_link',
				__( 'Text/Button Link', 'belctech-ecommerce' ) => 'text_link'
			),
			'std' => 'banner_link',
			'group' => __( 'Link','belctech-ecommerce' ),
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Link Style', 'belctech-ecommerce' ),
			'param_name' => 'link_style',
			'value' => array(
				__( 'Solid Button', 'belctech-ecommerce' ) => 'solid',
				__( 'Outlined Button', 'belctech-ecommerce' ) => 'outlined',
				__( 'Text Link', 'belctech-ecommerce' ) => 'link'
			),
			'std' => 'link_style',
			'dependency' => array(
				'element' => 'link_type',
				'value' => array( 'text_link' )
			),
			'group' => __( 'Link','belctech-ecommerce' ),
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Text/Button Link Color', 'belctech-ecommerce' ),
			'description' => __( 'Also border color if "Outlined Button" is selected', 'belctech-ecommerce' ),
			'param_name' => 'link_color',
			'value' => array(
				__( 'Default', 'belctech-ecommerce' ) => '',
				__( 'Dark', 'belctech-ecommerce' ) => 'dark',
				__( 'Light', 'belctech-ecommerce' ) => 'light',
				__( 'Accent Color', 'belctech-ecommerce' ) => 'accent',
				__( 'Custom', 'belctech-ecommerce' ) => 'custom'
			),
			'std' => '',
			'group' => __( 'Link','belctech-ecommerce' ),
		),
		array(
			'type' => 'colorpicker',
			'heading' => __( 'Text/Button Link Color', 'belctech-ecommerce' ),
			'param_name' => 'link_color_custom',
			'dependency' => array(
				'element' => 'link_color',
				'value' => array( 'custom' )
			),
			'group' => __( 'Link','belctech-ecommerce' ),
		),
		array(
			'type' => 'colorpicker',
			'heading' => __( 'Button Background', 'belctech-ecommerce' ),
			'param_name' => 'link_background_custom',
			'dependency' => array(
				'element' => 'link_color',
				'value' => array( 'custom' )
			),
			'group' => __( 'Link','belctech-ecommerce' ),
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Title', 'belctech-ecommerce' ),
			'param_name' => 'title',
			'group' => __( 'Content','belctech-ecommerce' ),
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Title Size', 'belctech-ecommerce' ),
			'param_name' => 'title_size',
			'value' => array(
				__( 'Small', 'belctech-ecommerce' ) => 'small',
				__( 'Medium', 'belctech-ecommerce' ) => 'medium',
				__( 'Large', 'belctech-ecommerce' ) => 'large',
				__( 'X-Large', 'belctech-ecommerce' ) => 'xlarge',
				__( 'XX-Large', 'belctech-ecommerce' ) => 'xxlarge',
			),
			'std' => 'medium',
			'group' => __( 'Content','belctech-ecommerce' ),
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Title Tag', 'belctech-ecommerce' ),
			'param_name' => 'title_tag',
			'description' => __( 'Select a title HTML tag.', 'belctech-ecommerce' ),
			'value' => array(
				'h1' => 'h1',
				'h2' => 'h2',
				'h3' => 'h3',
				'h4' => 'h4',
				'h5' => 'h5',
				'h6' => 'h6'
			),
			'std' => 'h2',
			'group' => __( 'Content','belctech-ecommerce' ),
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Title Color', 'belctech-ecommerce' ),
			'param_name' => 'title_color',
			'value' => array(
				__( 'Default', 'belctech-ecommerce' ) => '',
				__( 'Dark', 'belctech-ecommerce' ) => 'dark',
				__( 'Light', 'belctech-ecommerce' ) => 'light',
				__( 'Accent Color', 'belctech-ecommerce' ) => 'accent',
				__( 'Custom', 'belctech-ecommerce' ) => 'custom'
			),
			'std' => '',
			'group' => __( 'Content','belctech-ecommerce' ),
		),
		array(
			'type' => 'colorpicker',
			'heading' => __( 'Custom Title Color', 'belctech-ecommerce' ),
			'param_name' => 'title_color_custom',
			'dependency' => array(
				'element' => 'title_color',
				'value' => array( 'custom' )
			),
			'group' => __( 'Content','belctech-ecommerce' ),
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Subtitle/Label', 'belctech-ecommerce' ),
			'param_name' => 'subtitle',
			'group' => __( 'Content','belctech-ecommerce' ),
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Subtitle Type', 'belctech-ecommerce' ),
			'param_name' => 'subtitle_type',
			'description' => __( 'Text only or Label style', 'belctech-ecommerce' ),
			'group' => __( 'Content','belctech-ecommerce' ),
			'value' => array(
				__( 'Text', 'belctech-ecommerce' ) => 'text_style',
				__( 'Label', 'belctech-ecommerce' ) => 'tag_style'
			),
			'std' => 'text_style'
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Subtitle Tag', 'belctech-ecommerce' ),
			'param_name' => 'subtitle_tag',
			'description' => __( 'Select a subtitle HTML tag.', 'belctech-ecommerce' ),
			'value' => array(
				'h1' => 'h1',
				'h2' => 'h2',
				'h3' => 'h3',
				'h4' => 'h4',
				'h5' => 'h5',
				'h6' => 'h6',
				'p'    => 'p',
				'div'  => 'div'
			),
			'std' => 'h4',
			'group' => __( 'Content','belctech-ecommerce' ),
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Subtitle/Label Color', 'belctech-ecommerce' ),
			'param_name' => 'subtitle_color',
			'value' => array(
				__( 'Default', 'belctech-ecommerce' ) => '',
				__( 'Dark', 'belctech-ecommerce' ) => 'dark',
				__( 'Light', 'belctech-ecommerce' ) => 'light',
				__( 'Accent Color', 'belctech-ecommerce' ) => 'accent',
				__( 'Custom', 'belctech-ecommerce' ) => 'custom'
			),
			'std' => '',
			'group' => __( 'Content','belctech-ecommerce' ),
		),
		array(
			'type' => 'colorpicker',
			'heading' => __( 'Custom Subtitle/Label Color', 'belctech-ecommerce' ),
			'param_name' => 'subtitle_color_custom',
			'dependency' => array(
				'element' => 'subtitle_color',
				'value' => array( 'custom' )
			),
			'group' => __( 'Content','belctech-ecommerce' ),
		),
		array(
			'type' => 'colorpicker',
			'heading' => __( 'Subtitle/Label Background', 'belctech-ecommerce' ),
			'description' => __( 'Used for Label style', 'belctech-ecommerce' ),
			'param_name' => 'subtitle_background_custom',
			'dependency' => array(
				'element' => 'subtitle_color',
				'value' => array( 'custom' )
			),
			'group' => __( 'Content','belctech-ecommerce' ),
		),
		array(
			'type' => 'textarea_html',
			'heading' => __( 'Extra Content', 'belctech-ecommerce' ),
			'param_name' => 'content',
			'description' => __( 'For tablet/desktop screens only.', 'belctech-ecommerce' ),
			'group' => __( 'Content','belctech-ecommerce' ),
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Text Animation (Banner Slider)', 'belctech-ecommerce' ),
			'param_name' => 'text_animation',
			'description' => __( 'Select a text animation (used by the Banner Slider).', 'belctech-ecommerce' ),
			'value' => array(
				__( 'None', 'belctech-ecommerce' ) => '',
				'fadeIn' => 'fadeIn',
				'fadeInDown' => 'et-fadeInDown',
				'fadeInLeft' => 'et-fadeInLeft',
				'fadeInRight' => 'et-fadeInRight',
				'fadeInUp' => 'et-fadeInUp'
			),
			'group' => __( 'Text Layout','belctech-ecommerce' ),
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Text Position', 'belctech-ecommerce' ),
			'param_name' => 'text_position',
			'value' => array(
				__( 'Center', 'belctech-ecommerce' ) => 'h_center-v_center',
				__( 'Top Left', 'belctech-ecommerce' ) => 'h_left-v_top',
				__( 'Top Center', 'belctech-ecommerce' ) => 'h_center-v_top',
				__( 'Top Right', 'belctech-ecommerce' ) => 'h_right-v_top',
				__( 'Center Left', 'belctech-ecommerce' ) => 'h_left-v_center',
				__( 'Center Right', 'belctech-ecommerce' ) => 'h_right-v_center',
				__( 'Bottom Left', 'belctech-ecommerce' ) => 'h_left-v_bottom',
				__( 'Bottom Center', 'belctech-ecommerce' ) => 'h_center-v_bottom',
				__( 'Bottom Right', 'belctech-ecommerce' ) => 'h_right-v_bottom'
			),
			'std' => 'h_center-v_center',
			'group' => __( 'Text Layout','belctech-ecommerce' ),
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Text Alignment', 'belctech-ecommerce' ),
			'param_name' => 'text_alignment',
			'value' => array(
				__( 'Left', 'belctech-ecommerce' ) => 'align_left',
				__( 'Center', 'belctech-ecommerce' ) => 'align_center',
				__( 'Right', 'belctech-ecommerce' ) => 'align_right'
			),
			'std' => 'align_left',
			'group' => __( 'Text Layout','belctech-ecommerce' ),
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Text Width', 'belctech-ecommerce' ),
			'param_name' => 'text_width',
			'description' => __( 'Default is 50%', 'belctech-ecommerce' ),
			'group' => __( 'Text Layout','belctech-ecommerce' ),
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Text Padding', 'belctech-ecommerce' ),
			'param_name' => 'text_padding',
			'description' => __( 'Default is 15% (relative to "Text Width" value above)', 'belctech-ecommerce' ),
			'group' => __( 'Text Layout','belctech-ecommerce' ),
		),
	 )
) );
