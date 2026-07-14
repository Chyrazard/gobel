<?php
$author = get_post_meta( $id, 'belctech_portfolio_author', true);
$date = get_post_meta( $id, 'belctech_portfolio_date', true);
$website = get_post_meta( $id, 'belctech_portfolio_website', true);
?>

<?php if ( !empty($author) || !empty($date) || !empty($website['url']) ) { ?>
<ul class="post-meta">
	<?php if (!empty($author)) { ?>
		<li><?php echo esc_html__( 'Author', 'belctech-ecommerce' ) . '<span>' . $author . '</span>'; ?></li>
	<?php } ?>
	<?php if (!empty($date)) { ?>
		<li><?php echo esc_html__( 'Date', 'belctech-ecommerce' ) . '<span>' . date('F j, Y', $date) . '</span>'; ?></li>
	<?php } ?>
	<?php if (!empty($website['url'])) { ?>
		<li><?php echo esc_html__( 'Website', 'belctech-ecommerce' ) . '<span><a href="' . $website['url'] . '" target="_blank">' . $website['text'] . '</a></span>'; ?></li>
	<?php } else if (!empty($website['text'])) { ?>
		<li><?php echo esc_html__( 'Website', 'belctech-ecommerce' ) . '<span>' . $website['text'] . '</span>'; ?></li>
	<?php } ?>
</ul>
<?php } ?>