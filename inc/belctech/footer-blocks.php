<?php
/** Gutenberg footer pattern and block-widget defaults. */

defined( 'ABSPATH' ) || exit;

add_action( 'init', static function () {
	if ( ! function_exists( 'register_block_pattern' ) ) return;
	register_block_pattern_category( 'belctech', array( 'label' => __( 'Belctech Ecommerce', 'belctech-ecommerce' ) ) );
	register_block_pattern( 'belctech/footer-four-columns', array(
		'title' => __( 'Footer de 4 columnas', 'belctech-ecommerce' ),
		'categories' => array( 'belctech' ),
		'content' => '<!-- wp:group {"className":"belctech-footer-pattern","layout":{"type":"default"}} --><div class="wp-block-group belctech-footer-pattern"><!-- wp:group --><div class="wp-block-group"><!-- wp:heading {"level":4} --><h4>Brand</h4><!-- /wp:heading --><!-- wp:paragraph --><p>Add blocks or custom HTML.</p><!-- /wp:paragraph --></div><!-- /wp:group --><!-- wp:group --><div class="wp-block-group"><!-- wp:heading {"level":4} --><h4>Shop</h4><!-- /wp:heading --></div><!-- /wp:group --><!-- wp:group --><div class="wp-block-group"><!-- wp:heading {"level":4} --><h4>Help</h4><!-- /wp:heading --></div><!-- /wp:group --><!-- wp:group --><div class="wp-block-group"><!-- wp:heading {"level":4} --><h4>Contact</h4><!-- /wp:heading --></div><!-- /wp:group --></div><!-- /wp:group -->',
	) );
} );

add_action( 'after_switch_theme', static function () {
	$defaults = array(
		'footer_widgets' => true,
		'footer_widgets_columns' => 4,
		'header_sticky' => true,
		'archive_show_swatches' => true,
		'archive_check_variants_stock' => true,
	);
	foreach ( $defaults as $key => $value ) {
		if ( null === get_theme_mod( $key, null ) ) set_theme_mod( $key, $value );
	}
} );
