<?php get_header(); ?>

	<div  class="site-head" style="background-image:url(<?php echo getThemeOption('d_head_bg'); ?>) ">
		<div class="vertical">
			<div class="site-head-content inner">
				<h3><?php echo get_option('blogname'); ?> - <?php echo get_option('blogdescription'); ?></h3>
				<img src="<?php bloginfo('template_url'); ?>/img/logo.png" alt="<?php echo get_option('blogname'); ?> - <?php echo get_option('blogdescription'); ?>">
			</div>
		</div>
	</div>

	<div class="content" role="main">
		<?php if (have_posts()) : ?>
			<?php while (have_posts()) : the_post(); ?>
				<article class="entry">
					<header class="entry-header">
						<span class="entry-meta">
							<time>
								<?php the_time('Y/m/d H:i'); ?>
							</time>
						</span>
						<h2 class="entry-title">
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</h2>
					</header>

					<section class="entry-excerpt">
						<a href="<?php the_permalink(); ?>"><?php getThumbnail(); ?></a>
						<p>
							<?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 200, '...'); ?>
						</p>
					</section>
				</article>
			<?php endwhile; ?>

			<div class="pagination" role="navigation">
		    	<?php getPagination(9); ?>
		    </div>
	    <?php else : ?>
    		<h2>Not Found</h2>
    	<?php endif; ?>	
	</div>

	<div id="sub-site">
		<div class="page page-game">
			<div class="text">
				<h6>WordPress</h6>
				<a href="#" target="_blank">
					<h3>主题定制</h3>
				</a>
				<a href="#" target="_blank">
					<div class="btn_view"></div>
				</a>
			</div>

		</div>
	</div>

<?php get_footer(); ?>