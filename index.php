<?php get_header(); ?>

<div class="container container_blog">

	<div class="blog-and-sidebar">
		<div class="blog">
			<?php
			while (have_posts()) : the_post(); ?>
			
				<article class="blog-post-in-loop">
					<a class="imagelink" href="<?php the_permalink() ?>" title="<?php echo get_the_title(); ?>"><img class="post-image"  src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>"></a>
						<h1 class='blogpost_title'><a href="<?php echo the_permalink(); ?>"><?php echo get_the_title(); ?></a></h1>
						<p class='post-excerpt'><?php echo get_the_excerpt(); ?></p>
						<div class='read-more'><a href="<?php echo the_permalink(); ?>"><?php _e('Read More','newtheme'); ?></a></div>
					</div>
				</article>
			<?php
			endwhile;
			?>

			<div class="pagination-otside">
				<div class="pagination">
					<?php if (function_exists("pagination")) {
						pagination();
					} ?>
				</div>
			</div>
		</div>
		<?php if (is_active_sidebar('blog_right_sidebar')) : ?>
			<aside class="sidebar">
			<?php get_sidebar( 'blog_right_sidebar' ); ?>
			</aside>
		<?php endif; ?>
	</div>
</div>



<?php get_footer(); ?>