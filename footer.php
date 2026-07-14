<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the .site-content div and all content after.
 *
 * @link    https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Belctech
 */
 ?>
		</div><!-- End role["main"] -->

	</div><!-- End .page-wrapper-inner -->

	<?php
	// Elementor footer or default
	if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'footer' ) ) {
		do_action( 'belctech_footer' );
	} ?>

</div> <!-- End #wrapper -->

<?php do_action( 'belctech_after_site' ) ?>

<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */
	 wp_footer();
?>
</body>
</html>