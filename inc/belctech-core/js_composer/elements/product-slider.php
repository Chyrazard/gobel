<?php

// VC element: et_product
vc_map( array(
	'name' => esc_html__('Products Grid/Carousel', 'belctech-ecommerce'),
	'description' => esc_html__('Add WooCommerce products', 'belctech-ecommerce'),
	'category' => esc_html__('Belctech', 'belctech-ecommerce'),
	'base' => 'et_product_slider',
	'icon' => 'et_product_slider',
	'admin_label' => true,
	'params'	=> array(
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Products', 'belctech-ecommerce'),
			'param_name' => 'product_sort',
			'value' => array(
				__( 'Latest Products', 'belctech-ecommerce' ) => 'latest-products',
				__( 'Best Sellers', 'belctech-ecommerce' ) => 'best-sellers',
				__( 'Top Rated', 'belctech-ecommerce' ) => 'top-rated',
				__( 'Featured Products', 'belctech-ecommerce' ) => 'featured-products',
				__( 'Sale Products', 'belctech-ecommerce' ) => 'sale-products',
				__( 'By Category', 'belctech-ecommerce' ) => 'by-category',
				__( 'By Tag', 'belctech-ecommerce' ) => 'by-tag',
				__( 'By Product ID', 'belctech-ecommerce' ) => 'by-id',
				),
			'admin_label' => true,
			'description' => esc_html__('Select the batch of products to show.', 'belctech-ecommerce')
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Product Category', 'belctech-ecommerce'),
			'param_name' => 'cat',
			'value' => belctech_product_categories_array(),
			'description' => esc_html__('Choose categories to show.', 'belctech-ecommerce'),
			'dependency' => array(
				'element' => 'product_sort',
				'value' => array('by-category')
			)
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Product IDs', 'belctech-ecommerce'),
			'param_name' => 'product_ids',
			'description' => esc_html__('Enter the product IDs separated by comma', 'belctech-ecommerce'),
			'dependency' => array(
				'element' => 'product_sort',
				'value' => array('by-id')
			)
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Product Tags', 'belctech-ecommerce'),
			'param_name' => 'product_tag',
			'description' => esc_html__('Enter the product tags separated by comma', 'belctech-ecommerce'),
			'dependency' => array(
				'element' => 'product_sort',
				'value' => array('by-tag')
			)
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Order by', 'js_composer' ),
			'param_name' => 'orderby',
			'description' => sprintf( __( 'Select how to sort retrieved products. More at %s.', 'js_composer' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
			'value'		=> array(
				__( 'Date', 'js_composer' ) => 'date',
				__( 'ID', 'js_composer' ) => 'ID',
				__( 'Author', 'js_composer' ) => 'author',
				__( 'Title', 'js_composer' ) => 'title',
				__( 'Modified', 'js_composer' ) => 'modified',
				__( 'Random', 'js_composer' ) => 'rand',
				__( 'Comment count', 'js_composer' ) => 'comment_count',
				__( 'Menu order', 'js_composer' ) => 'menu_order'
			),
			'std' => 'date',
			'save_always'	=> true,
			'dependency' => array(
				'element' => 'product_sort',
				'value' => array(
					'by-category',
					'by-tag',
					'sale-products',
					'featured-products'
				)
			)
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Sort order', 'js_composer' ),
			'param_name' => 'order',
			'description' => sprintf( __( 'Designates the ascending or descending order. More at %s.', 'js_composer' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
			'value'		=> array(
				__( 'Descending', 'js_composer' )	=> 'DESC',
				__( 'Ascending', 'js_composer' )	=> 'ASC'
			),
			'std' => 'DESC',
			'save_always'	=> true,
			'dependency' => array(
				'element' => 'product_sort',
				'value' => array(
					'by-category',
					'by-tag',
					'sale-products',
					'featured-products'
				)
			)
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Limit', 'belctech-ecommerce'),
			'param_name' => 'item_count',
			'value' => '4',
			'description' => esc_html__('The number of products to show.', 'belctech-ecommerce'),
			'dependency' => array(
				'element' => 'product_sort',
				'value' => array(
					'by-category',
					'by-tag',
					'sale-products',
					'top-rated',
					'latest-products',
					'best-sellers',
					'featured-products'
				)
			)
		),
		array(
	    'type' => 'dropdown',
	    'heading' => esc_html__('Product Style', 'belctech-ecommerce' ),
	    'param_name' => 'item_style',
	    'group' => __( 'Styling','belctech-ecommerce' ),
	    'std'=> 'style1',
	    'value' => array(
		__( 'Style 1', 'belctech-ecommerce' ) => 'style1',
		__( 'Style 2', 'belctech-ecommerce' ) => 'style2',
		__( 'Style 3', 'belctech-ecommerce' ) => 'style3',
		__( 'Style 4', 'belctech-ecommerce' ) => 'style4'
	    ),
	    'description' => esc_html__('Select Items Style', 'belctech-ecommerce' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Columns', 'belctech-ecommerce'),
			'param_name' => 'columns',
			'value' => array(
				__( '5 Columns', 'belctech-ecommerce' ) => '5',
				__( '4 Columns', 'belctech-ecommerce' ) => '4',
				__( '3 Columns', 'belctech-ecommerce' ) => '3',
				__( '2 Columns', 'belctech-ecommerce' ) => '2',
				__( '1 Columns', 'belctech-ecommerce' ) => '1'
			),
			'description' => esc_html__('Number of columns on desktops.', 'belctech-ecommerce'),
			'std'			=> '4'
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Mobile Columns', 'belctech-ecommerce'),
			'param_name' => 'columns_mobile',
			'value' => array(
				__( '2 Columns', 'belctech-ecommerce' ) => '2',
				__( '1 Columns', 'belctech-ecommerce' ) => '1'
			),
			'description' => esc_html__('Number of columns on mobiles.', 'belctech-ecommerce'),
			'std'			=> '2'
		),

		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Carousel', 'belctech-ecommerce'),
			'param_name' => 'carousel',
			'admin_label' => true,
			'value' => array(
				__( 'Yes', 'belctech-ecommerce' ) => 'yes',
				__( 'No', 'belctech-ecommerce' ) => 'no'
			),
			'description' => esc_html__('Select yes to display the products in a carousel.', 'belctech-ecommerce'),
			'std'			=> 'yes',
			'group' => __( 'Carousel','belctech-ecommerce' ),
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Columns to scroll', 'belctech-ecommerce'),
			'param_name' => 'scroll',
			'value' => array(
				__( 'Same as columns', 'belctech-ecommerce' ) => 'columns',
				'1' => '1'
			),
			'description' => esc_html__('Number of columns to scroll.', 'belctech-ecommerce'),
			'std'			=> 'columns',
			'dependency'	=> array(
				'element'	=> 'carousel',
				'value'   => array( 'yes' ),
			),
			'group' => __( 'Carousel','belctech-ecommerce' ),
		),
		array(
			'type'			=> 'checkbox',
			'heading'		=> __( 'Infinite Loop', 'belctech-ecommerce' ),
			'param_name'	=> 'infinite',
			'description'	=> __( 'Infinite loop sliding.', 'belctech-ecommerce' ),
			'value'			=> array(
				__( 'Enable', 'belctech-ecommerce' )	=> 'true'
			),
			'dependency' => array(
				'element' => 'carousel',
				'value' => 'yes'
			),
			'group' => __( 'Carousel','belctech-ecommerce' ),
		),
		array(
			'type'			=> 'checkbox',
			'heading' => __('Center Slides', 'belctech-ecommerce'),
			'param_name' => 'center',
			'value' => array(
				__( 'Yes', 'belctech-ecommerce' ) => 'true'
			),
			'group' => __( 'Carousel','belctech-ecommerce' ),
		),
		array(
			'type'			=> 'checkbox',
			'heading'		=> __( 'Autoplay', 'belctech-ecommerce' ),
			'param_name'	=> 'autoplay',
			'value'			=> array(
				__( 'Enable', 'belctech-ecommerce' )	=> '1'
			),
			'dependency' => array(
				'element' => 'carousel',
				'value' => 'yes'
			),
			'group' => __( 'Carousel','belctech-ecommerce' ),
		),
		array(
			'type'      => 'textfield',
			'heading'     => __( 'Autoplay Speed', 'belctech-ecommerce' ),
			'param_name'  => 'autoplay_speed',
			'description' => __( 'Enter autoplay interval in milliseconds (1 second = 1000 milliseconds).', 'belctech-ecommerce' ),
			'std'			=> '2500',
			'dependency' => array(
				'element' => 'autoplay',
				'value' => array( '1' )
			),
			'group' => __( 'Carousel','belctech-ecommerce' ),
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Pause on hover', 'belctech-ecommerce'),
			'param_name' => 'pause',
			'description' => esc_html__('Pause autoplay on hover.', 'belctech-ecommerce'),
			'value' => array(
				__( 'Enable', 'belctech-ecommerce' )	=> '1'
			),
			'dependency' => array(
				'element' => 'autoplay',
				'value' => array( '1' )
			),
			'group' => __( 'Carousel','belctech-ecommerce' ),
		),
		array(
			'type' => 'checkbox',
			'heading'		=> __( 'Navigation Dots', 'belctech-ecommerce' ),
			'param_name' => 'pagination',
			'description'	=> __( 'Display pagination dots.', 'belctech-ecommerce' ),
			'value' => array(
				__( 'Enable', 'belctech-ecommerce' ) => 'true'
			),
			'dependency'	=> array(
				'element'	=> 'carousel',
				'value'   => array( 'yes' ),
			),
			'group' => __( 'Carousel','belctech-ecommerce' ),
		),
		array(
			'type' => 'checkbox',
			'heading' => __('Hide Out of Stock', 'belctech-ecommerce'),
			'param_name' => 'hide_out_of_stock',
			'value' => array(
				__( 'Yes', 'belctech-ecommerce' ) => 'yes'
			),
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Show Variations', 'belctech-ecommerce'),
			'param_name' => 'show_variations',
			'value' => array(
				__( 'Yes', 'belctech-ecommerce' ) => 'true'
			),
			'description' => esc_html__('Show variations (requires "WooCommerce Variation Swatches" plugin) .', 'belctech-ecommerce'),
		),
	),

) );