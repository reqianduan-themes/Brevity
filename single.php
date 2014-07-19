<?php get_header(); ?>

	<div role="main">
		<?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?>
			<article class="post">
				<div id="main">
					<div class="banner" style="height: 634.3333333333334px; background-image: url(<?php echo getThumbnailUrl(); ?>); background-attachment: fixed; background-size: 100% 683px;">
						<div class="banner_bg" style="height: 634.3333333333334px;">
							<div class="banner-head">
								<h1><?php the_title(); ?></h1>
							</div>
						</div>
					</div>
				</div>

				<div class="author_info">
					<div id="author">
						<?php $author_id = get_the_author_meta('ID'); ?>
						<a href="<?php echo get_author_posts_url($author_id); ?>" target="_blank" class="pic">
							<img src="<?php echo getAvatarUrl($author_id); ?>" style="width:100%;height:100%;border-radius:50%;">
						</a>
						<a href="<?php echo get_author_posts_url($author_id); ?>" title="查看作者">
							<h4><?php the_author_meta('display_name'); ?></h4>
						</a>
						<time><?php the_time('Y/m/d H:i'); ?></time> 
					</div>
				</div>

				<div id="content">
					<div class="post">
						<?php the_content(); ?>
					</div>
					
					<div class="post-meta">
						<?php the_tags('',' ',''); ?>
                    </div>
					
					<?php getThemeShare(); ?>

					<div id="respond" clas="post-comment">
						<?php comments_template(); ?>
					</div>
				</div>

				<?php include('inc/post-related.php'); ?>

			</article>
		<?php endwhile; ?><?php endif; ?>
	</div>

<?php get_footer(); ?>