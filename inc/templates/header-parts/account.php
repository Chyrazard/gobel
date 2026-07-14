<?php
/**
 * Template part for displaying the sign-in
 *
 * @package Belctech
 */

if( ! belctech_wc_active() ) {
	return;
}
?>

<?php do_action( 'belctech_get_myaccount_link', true ); ?>