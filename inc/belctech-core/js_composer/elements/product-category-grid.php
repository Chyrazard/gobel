<?php

// VC element: et_product_category_grid
vc_map( array(
	'name' => esc_html__('Product Category Masonry', 'belctech-ecommerce'),
	'description' => esc_html__('Display Product Categories in Masonry layout', 'belctech-ecommerce'),
	'category' => esc_html__('Belctech', 'belctech-ecommerce'),
	'base' => 'et_product_category_grid',
	'icon' => 'et_product_category_grid',
	'params'	=> array(
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Product Category', 'belctech-ecommerce'),
			'param_name' => 'cat',
			'value' => belctech_product_categories_array(),
			'description' => esc_html__('Select the categories you would like to display', 'belctech-ecommerce')
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Order by', 'belctech-ecommerce'),
			'param_name' => 'order_by',
			'value' => array(
				__( 'Name', 'belctech-ecommerce' ) => 'name',
				__( 'Id', 'belctech-ecommerce' ) => 'id',
				__( 'Slug', 'belctech-ecommerce' ) => 'slug',
				__( 'Menu Order', 'belctech-ecommerce' ) => 'menu_order'
			),
			'std' => 'name'
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Sort Order', 'belctech-ecommerce'),
			'param_name' => 'sort_order',
			'value' => array(
				__( 'Ascending', 'belctech-ecommerce' ) => 'ASC',
				__( 'Descending', 'belctech-ecommerce' ) => 'DESC',
			),
			'std' => 'ASC'
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Style', 'belctech-ecommerce'),
			'param_name' => 'style',
			'admin_label' => true,
			'value' => array(
				__( 'Style 1', 'belctech-ecommerce' ) => 'style1',
				__( 'Style 2', 'belctech-ecommerce' ) => 'style2',
				__( 'Style 3', 'belctech-ecommerce' ) => 'style3'
			),
			'description' => esc_html__('This applies different grid structures', 'belctech-ecommerce')
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Rounded Corners', 'belctech-ecommerce'),
			'param_name' => 'rounded_corners',
		  'value' => array(
				__( 'Yes', 'belctech-ecommerce' ) => 'true'
			),
		),
	),

) );