<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Belctech
 */

 get_header(); ?>

<div class="type-page page-padding">
<div class="container">
	<div class="row content404">
		<div class="col-12">
			<div class="empty-circle"><?php get_template_part('assets/img/svg/x.svg'); ?></div>
			<h4><?php esc_html_e( 'Oops! Page not found.', 'belctech-ecommerce' ); ?></h4>
			<p><?php esc_html_e( 'We are sorry, but the page you\'re looking for cannot be found.', 'belctech-ecommerce' ); ?></p>
			<a class="button outlined" href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Back to homepage', 'belctech-ecommerce'); ?></a>
		</div>
	</div>
</div>
</div>

<?php get_footer(); ?>