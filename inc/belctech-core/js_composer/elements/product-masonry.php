<?php

// VC element: et_product
vc_map( array(
	'name' => esc_html__('Product Masonry', 'belctech-ecommerce'),
	'description' => esc_html__('Add WooCommerce products', 'belctech-ecommerce'),
	'category' => esc_html__('Belctech', 'belctech-ecommerce'),
	'base' => 'et_product_masonry',
	'icon' => 'et_product_masonry',
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
			'description' => esc_html__('Enter the products IDs you would like to display separated by comma', 'belctech-ecommerce'),
			'dependency' => array(
				'element' => 'product_sort',
				'value' => array('by-id')
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
					'sale-products',
					'featured-products'
				)
			)
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Per page', 'belctech-ecommerce'),
			'param_name' => 'item_count',
			'value' => '4',
			'description' => esc_html__('The number of products to show.', 'belctech-ecommerce'),
			'dependency' => array(
				'element' => 'product_sort',
				'value' => array(
					'by-category',
					'sale-products',
					'top-rated',
					'latest-products',
					'best-sellers',
					'featured-products'
				)
			)
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
	    'type' => 'dropdown',
	    'heading' => esc_html__('Product Style', 'belctech-ecommerce' ),
	    'param_name' => 'item_style',
	    'group' => __( 'Styling','belctech-ecommerce' ),
	    'std'=> 'style4',
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
      'heading' => esc_html__('Margins between items', 'belctech-ecommerce' ),
      'param_name' => 'item_margins',
      'group' => __( 'Styling','belctech-ecommerce' ),
      'std'=> 'regular-padding',
      'value' => array(
	__( 'Regular', 'belctech-ecommerce' ) => 'regular-padding',
	__( 'No Margins', 'belctech-ecommerce' ) => 'no-padding'
      ),
      'description' => esc_html__('Adjust the space between items', 'belctech-ecommerce' )
	  ),
		array(
      'type' => 'checkbox',
      'heading' => esc_html__('Category navigation', 'belctech-ecommerce' ),
      'param_name' => 'category_navigation',
      'value' => array(
		__( 'Yes', 'belctech-ecommerce' ) => 'true'
	),
      'description' => esc_html__('Show category navigation filter on top', 'belctech-ecommerce' ),
      'dependency' => array(
	'element' => 'product_sort',
	'value' => array('by-category')
      )
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