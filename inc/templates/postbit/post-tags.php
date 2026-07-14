<?php
/**
 * The template for displaying the post tags
 *
 * @link    https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Belctech
 */
?>

<div class="article-tags">
	<?php
	$tag_list = get_the_tag_list( '', ', ' );

	if ( $tag_list ) {
		echo esc_html__( 'Tags:', 'belctech-ecommerce' ) . '&nbsp;' . $tag_list . '';
	} ?>
</div>