<?php if (have_posts()) : ?>
	<div class="row <?php echo esc_attr( belctech_pagination_style() ); ?> masonry" data-layoutmode="packery">
		<?php while (have_posts()) : the_post(); ?>
			<?php get_template_part( 'inc/templates/blogbit/masonry'); ?>
		<?php endwhile; ?>
	</div>
	<?php do_action('belctech_blog_pagination'); ?>
<?php else : ?>
  <?php get_template_part( 'inc/templates/not-found' ); ?>
<?php endif; ?>
