<?php
/**
 * Template part for displaying the wishlist icon
 *
 * @package Belctech
 */

if( ! belctech_wc_active() ) {
	return;
}

do_action( 'belctech_quick_wishlist' );
