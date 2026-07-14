<?php
/**
 * Template part for displaying the cart icon
 *
 * @package Belctech
 */
if( ! belctech_wc_active() ) {
	return;
}
?>

<?php do_action( 'belctech_quick_cart' ); ?>
