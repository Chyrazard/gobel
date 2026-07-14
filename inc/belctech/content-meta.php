<?php
/** Native layout controls for pages, posts and portfolio items. */

defined( 'ABSPATH' ) || exit;

add_action( 'add_meta_boxes', static function () {
	add_meta_box( 'belctech-page-layout', __( 'Belctech layout', 'belctech-ecommerce' ), 'belctech_content_meta_box', array( 'page', 'post', 'portfolio' ), 'side', 'default' );
} );

function belctech_content_meta_box( WP_Post $post ) {
	wp_nonce_field( 'belctech_content_meta', 'belctech_content_nonce' );
	$prefix = 'page' === $post->post_type ? 'goya_page_' : ( 'post' === $post->post_type ? 'goya_post_' : 'goya_portfolio_' );
	$fields = array(
		$prefix . 'transparent_header' => array( 'Transparent header', array( '' => 'Default', 'transparent' => 'Transparent' ) ),
		$prefix . 'header_style' => array( 'Header text', array( '' => 'Default', 'dark-title' => 'Dark', 'light-title' => 'Light' ) ),
	);
	if ( 'page' === $post->post_type ) {
		$fields += array(
			'goya_page_title_style' => array( 'Title', array( '' => 'Default', 'regular' => 'Regular', 'hero' => 'Hero', 'hide' => 'Hidden' ) ),
			'goya_page_hero_title_style' => array( 'Hero text', array( '' => 'Default', 'dark-title' => 'Dark', 'light-title' => 'Light' ) ),
			'goya_page_sidebar_position' => array( 'Sidebar', array( '' => 'None', 'left' => 'Left', 'right' => 'Right' ) ),
			'goya_page_disable_footer' => array( 'Disable footer', 'checkbox' ),
		);
	} elseif ( 'post' === $post->post_type ) {
		$fields['goya_post_featured_video'] = array( 'Featured video URL', 'url' );
	} else {
		$fields += array(
			'goya_portfolio_title_style' => array( 'Title', array( '' => 'Default', 'regular' => 'Regular', 'hero' => 'Hero', 'parallax' => 'Parallax', 'hide' => 'Hidden' ) ),
			'goya_portfolio_masonry_size' => array( 'Masonry size', array( '' => 'Default', 'small' => 'Small', 'large' => 'Large', 'horizontal' => 'Horizontal', 'vertical' => 'Vertical' ) ),
		);
	}
	foreach ( $fields as $key => $field ) belctech_meta_input( $post, $key, $field[0], $field[1] );
}

add_action( 'save_post', static function ( $post_id ) {
	if ( ! isset( $_POST['belctech_content_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['belctech_content_nonce'] ) ), 'belctech_content_meta' ) ) return;
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( ! current_user_can( 'edit_post', $post_id ) ) return;
	$post_type = get_post_type( $post_id );
	$prefix = 'page' === $post_type ? 'goya_page_' : ( 'post' === $post_type ? 'goya_post_' : 'goya_portfolio_' );
	$keys = array( $prefix . 'transparent_header', $prefix . 'header_style' );
	if ( 'page' === $post_type ) $keys = array_merge( $keys, array( 'goya_page_title_style', 'goya_page_hero_title_style', 'goya_page_sidebar_position', 'goya_page_disable_footer' ) );
	if ( 'post' === $post_type ) $keys[] = 'goya_post_featured_video';
	if ( 'portfolio' === $post_type ) $keys = array_merge( $keys, array( 'goya_portfolio_title_style', 'goya_portfolio_masonry_size' ) );
	foreach ( $keys as $key ) {
		$value = isset( $_POST[ $key ] ) ? sanitize_text_field( wp_unslash( $_POST[ $key ] ) ) : '';
		if ( '' === $value ) delete_post_meta( $post_id, $key ); else update_post_meta( $post_id, $key, $value );
	}
} );
