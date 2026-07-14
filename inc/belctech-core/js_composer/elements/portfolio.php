<?php

// Portfolio Masonry/Grid
vc_map( array(
	'name' => esc_html__('Portfolio', 'belctech-ecommerce' ),
	'description' => esc_html__('Display your Portfolio items', 'belctech-ecommerce' ),
	'category' => esc_html__('Belctech', 'belctech-ecommerce'),
	'base' => 'et_portfolio',
	'icon' => 'et_portfolio',
	'params'	=> array(
		array(
	    'type' => 'dropdown',
	    'heading' => esc_html__('Portfolio Layout', 'belctech-ecommerce' ),
	    'param_name' => 'portfolio_layout',
	    'std'=> 'grid',
	    'value' => array(
		__( 'List', 'belctech-ecommerce' ) => 'list',
		__( 'Grid Columns', 'belctech-ecommerce' ) => 'grid',
		__( 'Masonry - Packery (filterable)', 'belctech-ecommerce' ) => 'masonry',
		__( 'Masonry - Columns Only (filterable)', 'belctech-ecommerce' ) => 'masonry-columns',
	    ),
	    'admin_label' => true,
	    'description' => esc_html__('Select Portfolio Layout', 'belctech-ecommerce' )
		),
		array(
      'type' => 'checkbox',
      'heading' => esc_html__('Alternate columns', 'belctech-ecommerce' ),
      'param_name' => 'alternate_cols',
      'value' => array(
		__( 'Yes', 'belctech-ecommerce' ) => 'true'
	),
      'description' => esc_html__('Alternate image/text columns in List view', 'belctech-ecommerce' ),
      'dependency'	=> array(
		'element'	=> 'portfolio_layout',
		'value'	=> 'list'
	    ),
	  ),
		array(
	    'type' => 'dropdown',
	    'heading' => esc_html__('Columns', 'belctech-ecommerce' ),
	    'param_name' => 'columns',
	    'std'=> '4',
	    'value' => array(
		__( '6 Columns', 'belctech-ecommerce' ) => '6',
		__( '4 Columns', 'belctech-ecommerce' ) => '4',
		__( '3 Columns', 'belctech-ecommerce' ) => '3',
		__( '2 Columns', 'belctech-ecommerce' ) => '2'
	    ),
	    'admin_label' => true,
	    'description' => esc_html__('Colums in Grid layout', 'belctech-ecommerce' ),
	    'dependency'	=> array(
		'element'	=> 'portfolio_layout',
		'value'	=> array( 'grid', 'masonry-columns' )
	    ),
		),
		array(
	    'type' => 'dropdown',
	    'heading' => esc_html__('Items Style', 'belctech-ecommerce' ),
	    'param_name' => 'item_style',
	    'group' => __( 'Styling','belctech-ecommerce' ),
	    'std'=> 'regular',
	    'value' => array(
		__( 'Regular', 'belctech-ecommerce' ) => 'regular',
		__( 'Overlay', 'belctech-ecommerce' ) => 'overlay',
		__( 'Hover Card', 'belctech-ecommerce' ) => 'hover-card'
	    ),
	    'admin_label' => true,
	    'description' => esc_html__('Select Items Style', 'belctech-ecommerce' ),
	    'dependency'	=> array(
		'element'	=> 'portfolio_layout',
		'value'	=> array( 'grid', 'masonry', 'masonry-columns' )
	    ),
		),
		array(
      'type'      => 'dropdown',
      'heading'     => __( 'Animation', 'belctech-ecommerce' ),
      'param_name'  => 'animation',
      'group' => __( 'Styling','belctech-ecommerce' ),
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
      'dependency'	=> array(
	'element'	=> 'portfolio_layout',
	'value'	=> array( 'grid', 'masonry', 'masonry-columns' )
      ),
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
      'description' => esc_html__('Adjust the space between items', 'belctech-ecommerce' ),
      'dependency'	=> array(
		'element'	=> 'portfolio_layout',
		'value'	=> array( 'grid', 'masonry', 'masonry-columns' )
	    ),
	  ),
	  array(
      'type' => 'checkbox',
      'heading' => esc_html__('Categories to show', 'belctech-ecommerce' ),
      'param_name' => 'category_filter',
      'value' => belctech_get_portfolio_categories(),
      'description' => esc_html__('Narrow items by category or leave empty to show items from all categories', 'belctech-ecommerce' )
	  ),
		array(
			'type'			=> 'textfield',
			'heading'		=> __( 'Post count', 'belctech-ecommerce' ),
			'param_name'	=> 'num_posts',
			'description'	=> __( 'How many items to show. Use -1 to show all.', 'belctech-ecommerce' ),
			'std'=> '6',
		),
	  array(
      'type' => 'checkbox',
      'heading' => esc_html__('Load More Button', 'belctech-ecommerce' ),
      'param_name' => 'loadmore',
      'value' => array(
		__( 'Yes', 'belctech-ecommerce' ) => 'true'
	),
      'description' => esc_html__('Add "Load More" button at the bottom. Only if Post Count > 1', 'belctech-ecommerce' ),
	  ),
	  array(
      'type' => 'checkbox',
      'heading' => esc_html__('Category navigation', 'belctech-ecommerce' ),
      'param_name' => 'category_navigation',
      'value' => array(
		__( 'Yes', 'belctech-ecommerce' ) => 'true'
	),
      'description' => esc_html__('Show category navigation filter on top', 'belctech-ecommerce' ),
      'dependency'	=> array(
		'element'	=> 'portfolio_layout',
		'value'	=> array( 'masonry', 'masonry-columns' )
	    ),
	  ),

	),

) );