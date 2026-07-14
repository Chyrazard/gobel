<?php

// VC element: et_posts
vc_map( array(
	 'name' => __( 'Blog Posts', 'belctech-ecommerce' ),
	 'description' => __( 'Display posts from the blog Masonry,Grid../Slider', 'belctech-ecommerce' ),
	 'base' => 'et_posts',
	 'icon' => 'et_posts',
	 'category' => __('Belctech', 'belctech-ecommerce'),
	 'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Number of Posts', 'belctech-ecommerce' ),
			'param_name' => 'num_posts',
			'description' => __( 'Enter max number of posts to display.', 'belctech-ecommerce' ),
			'value' => '8'
		),
		array(
	    'type'			=> 'dropdown',
	    'heading'		=> __( 'Order By', 'belctech-ecommerce' ),
	    'param_name'	=> 'orderby',
	    'description'	=> __( 'Select posts order-by.', 'belctech-ecommerce' ),
	    'value'		=> array(
        'None'          => 'none',
        'ID'            => 'ID',
        'Author'        => 'author',
        'Title'         => 'title',
        'Name'          => 'name',
        'Date'          => 'date',
        'Random'        => 'rand',
        'Commen Count'  => 'comment_count',
        'Menu Order'    => 'menu_order',
        'IDs Option'    => 'post__in'
	    ),
	    'std'			=> 'none'
	),
		array(
	    'type'			=> 'dropdown',
	    'heading'		=> __( 'Order', 'belctech-ecommerce' ),
	    'param_name'	=> 'order',
	    'description'	=> __( 'Select posts order.', 'belctech-ecommerce' ),
	    'value'			=> array(
		'Descending'	=> 'desc',
		'Ascending'		=> 'asc'
	    ),
	    'std'			=> 'asc'
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Categories to show', 'belctech-ecommerce' ),
			'param_name' => 'category',
			'description' => esc_html__('Narrow posts by category or leave empty to show posts from all categories', 'belctech-ecommerce' ),
			'value' => belctech_get_post_categories(),
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Tags', 'belctech-ecommerce' ),
			'param_name' => 'tag',
			'description' => __( 'List separated by commas. If set, they will be used instead of the categories above.', 'belctech-ecommerce' ),
			'value' => ''
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Style', 'belctech-ecommerce' ),
			'param_name' => 'style',
			'description' => __( 'Posts style.', 'belctech-ecommerce' ),
			'value' => array(
				__( 'Grid', 'belctech-ecommerce' ) => 'grid',
				__( 'Masonry', 'belctech-ecommerce' ) => 'masonry',
				__( 'Cards', 'belctech-ecommerce' ) => 'cards',
				__( 'Classic', 'belctech-ecommerce' ) => 'classic',
				__( 'List', 'belctech-ecommerce' ) => 'list',
				__( 'Carousel', 'belctech-ecommerce' ) => 'carousel',
			),
			'std' => 'grid'
		),
		array(
			'type'			=> 'textfield',
			'heading' => __( 'Columns', 'belctech-ecommerce' ),
			'param_name' => 'columns',
			'description' => __( 'Select number of carousel columns.', 'belctech-ecommerce' ),
			'value'		=> '3',
			'dependency' => array(
				'element' => 'style',
				'value' => array('carousel')
			),
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Post Excerpt', 'belctech-ecommerce' ),
			'param_name' => 'post_excerpt',
			'description' => __( 'Display post excerpt.', 'belctech-ecommerce' ),
			'value' => array(
				__( 'Enable', 'belctech-ecommerce' ) => '1'
			),
			'dependency' => array(
				'element' => 'style',
				'value' => 'carousel'
			),
		)
	 )
) );