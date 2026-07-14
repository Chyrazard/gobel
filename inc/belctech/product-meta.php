<?php
/** Native product metaboxes; no Meta Box plugin required. */

defined( 'ABSPATH' ) || exit;

function belctech_product_meta_boxes() {
	add_meta_box( 'belctech-product-media', __( 'Belctech: video and size guide', 'belctech-ecommerce' ), 'belctech_product_media_box', 'product', 'normal', 'high' );
	add_meta_box( 'belctech-product-layout', __( 'Belctech: product layout', 'belctech-ecommerce' ), 'belctech_product_layout_box', 'product', 'normal', 'high' );
}
add_action( 'add_meta_boxes_product', 'belctech_product_meta_boxes' );

function belctech_product_media_box( WP_Post $post ) {
	wp_nonce_field( 'belctech_product_meta', 'belctech_product_nonce' );
	belctech_meta_input( $post, 'belctech_product_featured_video', 'Remote video URL', 'url', 'YouTube, Vimeo or MP4. Multiple URLs may be comma-separated.' );
	belctech_meta_input( $post, 'belctech_product_featured_video_local', 'Local MP4 URL', 'url', 'A local video takes priority over a remote URL.' );
	belctech_meta_input( $post, 'belctech_product_featured_video_vertical', 'Vertical video lightbox', 'checkbox' );
	belctech_meta_input( $post, 'belctech_product_sizing_guide', 'Size guide page', 'page' );
}

function belctech_product_layout_box( WP_Post $post ) {
	$fields = array(
		'belctech_product_transparent_header' => array( 'Transparent header', array( '' => 'Global default', 'transparent' => 'Transparent' ) ),
		'belctech_product_header_style' => array( 'Header text', array( '' => 'Global default', 'dark-title' => 'Dark', 'light-title' => 'Light' ) ),
		'belctech_product_showcase_background' => array( 'Product info background', 'color' ),
		'belctech_product_showcase_style' => array( 'Product info text', array( '' => 'Global default', 'dark-text' => 'Dark', 'light-text' => 'Light' ) ),
		'belctech_product_layout_single' => array( 'Product layout', array( '' => 'Global default', 'regular' => 'Regular', 'showcase' => 'Showcase', 'no-padding' => 'No padding', 'full-width' => 'Full width' ) ),
		'belctech_product_gallery_style' => array( 'Gallery', array( '' => 'Global default', 'carousel' => 'Slider', 'column' => 'Column', 'grid' => 'Grid' ) ),
		'belctech_product_details_style' => array( 'Details', array( '' => 'Global default', 'tabs' => 'Tabs', 'accordion' => 'Accordion', 'vertical' => 'Vertical' ) ),
		'belctech_product_description_layout' => array( 'Description width', array( '' => 'Global default', 'boxed' => 'Boxed', 'full' => 'Full width' ) ),
		'belctech_product_masonry_size' => array( 'Masonry card size', array( '' => 'Default', 'small' => 'Small', 'large' => 'Large', 'horizontal' => 'Horizontal', 'vertical' => 'Vertical' ) ),
	);
	foreach ( $fields as $key => $field ) belctech_meta_input( $post, $key, $field[0], $field[1] );
}

function belctech_meta_input( $post, $key, $label, $type, $description = '' ) {
	$value = get_post_meta( $post->ID, $key, true );
	echo '<p class="belctech-meta-field"><label for="' . esc_attr( $key ) . '"><strong>' . esc_html( $label ) . '</strong></label><br>';
	if ( is_array( $type ) ) {
		echo '<select class="widefat" id="' . esc_attr( $key ) . '" name="' . esc_attr( $key ) . '">';
		foreach ( $type as $option => $text ) echo '<option value="' . esc_attr( $option ) . '" ' . selected( $value, $option, false ) . '>' . esc_html( $text ) . '</option>';
		echo '</select>';
	} elseif ( 'checkbox' === $type ) {
		echo '<input type="checkbox" id="' . esc_attr( $key ) . '" name="' . esc_attr( $key ) . '" value="1" ' . checked( $value, 1, false ) . '>';
	} elseif ( 'page' === $type ) {
		wp_dropdown_pages( array( 'name' => $key, 'id' => $key, 'selected' => $value, 'show_option_none' => 'Use global setting', 'option_none_value' => '' ) );
	} else {
		echo '<input class="widefat" type="' . esc_attr( $type ) . '" id="' . esc_attr( $key ) . '" name="' . esc_attr( $key ) . '" value="' . esc_attr( $value ) . '">';
	}
	if ( $description ) echo '<span class="description">' . esc_html( $description ) . '</span>';
	echo '</p>';
}

function belctech_save_product_meta( $post_id ) {
	if ( ! isset( $_POST['belctech_product_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['belctech_product_nonce'] ) ), 'belctech_product_meta' ) ) return;
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( ! current_user_can( 'edit_post', $post_id ) ) return;
	$keys = array( 'belctech_product_featured_video', 'belctech_product_featured_video_local', 'belctech_product_featured_video_vertical', 'belctech_product_sizing_guide', 'belctech_product_transparent_header', 'belctech_product_header_style', 'belctech_product_showcase_background', 'belctech_product_showcase_style', 'belctech_product_layout_single', 'belctech_product_gallery_style', 'belctech_product_details_style', 'belctech_product_description_layout', 'belctech_product_masonry_size' );
	foreach ( $keys as $key ) {
		$value = isset( $_POST[ $key ] ) ? sanitize_text_field( wp_unslash( $_POST[ $key ] ) ) : '';
		if ( '' === $value ) delete_post_meta( $post_id, $key ); else update_post_meta( $post_id, $key, $value );
	}
}
add_action( 'save_post_product', 'belctech_save_product_meta' );
