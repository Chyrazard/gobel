<?php
/**
 * The template for displaying the meta on single posts
 *
 * @link    https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Belctech
 */
?>

<aside class="post-meta">
	<span class="post-author"><?php esc_html_e('By', 'belctech-ecommerce'); ?> <?php the_author_posts_link(); ?> <?php esc_html_e( 'on', 'belctech-ecommerce' ); ?></span>
	<time class="time" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php the_date(); ?></time>
</aside>