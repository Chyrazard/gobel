<?php
/**
 * Template file for displaying mobile header
 *
 * @package Belctech
 */
?>

<?php do_action('belctech_before_header_mobile') ?>

<?php do_action( 'belctech_hamburger', 'mobile' ); ?>

<?php get_template_part( 'inc/templates/header-parts/logo' ); ?>

<div class="mobile-header-icons">
	<?php do_action( 'belctech_mobile_header_icons', 'mobile_header' ); ?>
</div>

<?php do_action('belctech_after_header_mobile') ?>