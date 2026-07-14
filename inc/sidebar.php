<?php
function belctech_register_sidebars() {

	/* Blog Sidebar */

	register_sidebar(array(
		'id' => 'blog',
		'name' => esc_html__('Blog Sidebar', 'belctech-ecommerce' ),
		'description' => esc_html__('Blog home/category sidebar', 'belctech-ecommerce' ),
		'before_widget' => '<div id="%1$s" class="widget cf %2$s">',
		'after_widget' => '</div>',
	));

	/* Single Post Sidebar */

	register_sidebar(array(
		'id' => 'single',
		'name' => esc_html__('Post Sidebar', 'belctech-ecommerce' ),
		'description'   => esc_html__('Single post sidebar', 'belctech-ecommerce' ),
		'before_widget' => '<div id="%1$s" class="widget cf %2$s">',
		'after_widget' => '</div>',
	));

	/* Page Sidebar */

	register_sidebar(array(
		'id' => 'page',
		'name' => esc_html__('Page Sidebar', 'belctech-ecommerce' ),
		'description'   => esc_html__('Must be enabled per page. Otherwise, pages don\'t display the sidebar', 'belctech-ecommerce' ),
		'before_widget' => '<div id="%1$s" class="widget cf %2$s">',
		'after_widget' => '</div>',
	));

	/* Mobile Sidebar */

	register_sidebar(array(
		'id' => 'offcanvas-menu',
		'name' => esc_html__('Off-Canvas Menu Panel', 'belctech-ecommerce' ),
		'description'   => esc_html__('Displayed under menu in off canvas panel', 'belctech-ecommerce' ),
		'before_widget' => '<div id="%1$s" class="widget cf %2$s">',
		'after_widget' => '</div>',
	));

	/* Shop Sidebar */
	if ( belctech_wc_active() ) {

		register_sidebar(array(
			'id' => 'widgets-shop',
			'name' => esc_html__( 'Shop Sidebar', 'belctech-ecommerce' ),
			'description' => esc_html__('Shop sidebar (top, side, offcanvas)', 'belctech-ecommerce' ),
			'before_widget' => '<div id="%1$s" class="widget cf %2$s">',
			'after_widget' => '</div>',
		));
	}

	/* Footer Widgets Sidebar */

	register_sidebar(array(
		'name' => esc_html__('Footer de 4 columnas - Columna 1', 'belctech-ecommerce'),
		'id' => 'footer1',
		'before_widget' => '<div id="%1$s" class="widget cf %2$s">',
		'after_widget' => '</div>',
	));

	register_sidebar(array(
		'name' => esc_html__('Footer de 4 columnas - Columna 2', 'belctech-ecommerce'),
		'id' => 'footer2',
		'before_widget' => '<div id="%1$s" class="widget cf %2$s">',
		'after_widget' => '</div>',
	));

	register_sidebar(array(
		'name' => esc_html__('Footer de 4 columnas - Columna 3', 'belctech-ecommerce'),
		'id' => 'footer3',
		'before_widget' => '<div id="%1$s" class="widget cf %2$s">',
		'after_widget' => '</div>',
	));

	register_sidebar(array(
		'name' => esc_html__('Footer de 4 columnas - Columna 4', 'belctech-ecommerce'),
		'id' => 'footer4',
		'before_widget' => '<div id="%1$s" class="widget cf %2$s">',
		'after_widget' => '</div>',
	));

}

add_action( 'widgets_init', 'belctech_register_sidebars' );
