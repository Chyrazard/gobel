<?php
/**
 * Template file for displaying default header
 *
 * @package Belctech
 */
?>

<header id="header" class="<?php echo esc_attr( implode( ' ', (array) apply_filters( 'belctech_header_class', array() ) ) ); ?>">

	<?php do_action( 'belctech_header_inner' ); ?>

</header>