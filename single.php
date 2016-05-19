<?php 

	/**
		@author:  jlv
		@version: 1.0
	 */

?>

<?php get_header() ?>

<section class="Container">
	<div class="Inner">
		<div class="Columns">
			<div class="Column Column-one">
				<?php if (have_posts()): while(have_posts()): the_post(); ?>
				<div class="SingleTitle"><?php the_title() ?></div>
				<div class="SingleTime"><?php echo "Hace " . human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) ?></div>
				<div class="SingleContent"><?php the_content() ?></div>
				<?php endwhile; endif; wp_reset_postdata() ?>
			</div>
			<div class="Column Column-two">
				<?php $FeaturedPost = new WP_Query( array('post_type' => 'post', 'posts_per_page' => 10 ) ) ?>
				<?php if ($FeaturedPost->have_posts()): while($FeaturedPost->have_posts()): $FeaturedPost->the_post(); ?>
				<div class="Post">
					<div class="Post-time"><?php echo "Hace " . human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) ?></div>
					<a class="Post-title" href="<?php the_permalink() ?>"><?php the_title() ?></a>
				</div>
				<?php endwhile; endif; wp_reset_postdata() ?>
			</div>
			<?php get_sidebar() ?>
		</div>
	</div>
</section>

<?php get_footer() ?>