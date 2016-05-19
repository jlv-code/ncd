<?php 

	/**
		@author:  jlv
		@version: 1.0
	 */

?>

<?php get_header() ?>

<section class="Container">
	<div class="Inner">
		<div class="Featured">
			<div class="Ads"></div>
			<div class="FeaturedPost">
				<?php $FeaturedPost = new WP_Query( array('post_type' => 'post', 'posts_per_page' => 1, 'post__in' => get_option( 'sticky_posts' ) ) ) ?>
				<?php if ($FeaturedPost->have_posts()): while($FeaturedPost->have_posts()): $FeaturedPost->the_post(); ?>
				<div class="FeaturedPost-info">
					<div class="FeaturedPost-cat"><?php the_category( ' ' ) ?></div>
					<div class="FeaturedPost-time"><?php echo "Hace " . human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) ?></div>
					<div class="FeaturedPost-title"><?php the_title() ?></div>
					<div class="FeaturedPost-excerpt"><?php the_excerpt() ?></div>
					<a class="FeaturedPost-readmore" href="<?php the_permalink() ?>">Leer más</a>
				</div>
				<div class="FeaturedPost-image"><?php the_post_thumbnail( 'large' ) ?></div>
				<?php endwhile; endif; wp_reset_postdata() ?>
			</div>
		</div>
		<div class="Columns">
			<div class="Column Column-one">
				<?php $Post = new WP_Query( array('post_type' => 'post', 'posts_per_page' => 10 ) ) ?>
				<?php if ($Post->have_posts()): while($Post->have_posts()): $Post->the_post(); ?>
				<div class="Post">
					<a class="Post-image" href="<?php the_permalink() ?>"><?php the_post_thumbnail( 'large' ); ?></a>
					<div class="Post-cat"><?php the_category( ' ' ) ?></div>
					<div class="Post-time"><?php echo "Hace " . human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) ?></div>
					<a class="Post-title" href="<?php the_permalink() ?>"><?php the_title() ?></a>
					<div class="Post-excerpt"><?php the_excerpt() ?></div>
				</div>
				<?php endwhile; endif; wp_reset_postdata() ?>
			</div>
			<div class="Column Column-two">
				<?php $Post = new WP_Query( array('post_type' => 'post', 'posts_per_page' => 20 ) ) ?>
				<?php if ($Post->have_posts()): while($Post->have_posts()): $Post->the_post(); ?>
				<div class="Post">
					<a class="Post-image" href="<?php the_permalink() ?>"><?php the_post_thumbnail( 'medium' ); ?></a>
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