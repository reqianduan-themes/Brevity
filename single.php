<?php get_header(); ?>

	<div role="main">


		<?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?>
			<article class="post">
				<div id="main">

				
					<div class="banner" style="height: 634.3333333333334px; background-image: url(img/main.jpg); background-attachment: fixed; background-size: 100% 683px;">
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
							<?php echo get_avatar($author_id); ?>
						</a>
						<a href="<?php echo get_author_posts_url($author_id); ?>" title="查看作者">
							<h3><?php the_author_meta('display_name'); ?></h3>
						</a>
					</div>
				</div>

				<div id="content" class="post-content">
					<div class="post">
						<?php the_content(); ?>
					</div>
					
					<div class="post-meta">
						<time datetime="2014-07-02">Jul 02 2014 08:59:27 </time> 
						<?php getThemeShare(); ?>
                    </div>

					<div id="respond" clas="post-comment">
						<?php comments_template(); ?>
					</div>
				</div>
				
				<div id="more-post">
					<div class="title">
						<h2>更多阅读</h2>
						<h3>FURTHER READING</h3>
					</div>
					<div class="posts" id="posts">
						<div class="reco">
							<a href="/shi-jie-bei-kai-chang-shao-dao-ba-xi-qu-sa-ye">
								<div class="l-box">
									<div class="post-bg" style="background-image:url(img/default.jpg);"></div>
									<div class="post-author-img" style="background-image:url(img/avatar.jpg);filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='img/avatar.jpg',sizingMethod='scale');"></div>
									<h2>世界杯开场哨：到巴西去撒野</h2>
									<h4>刘伯峰</h4>
								</div>
							</a>
						</div>
					</div>
				</div>
			</article>
		<?php endwhile; ?><?php endif; ?>
	</div>

<?php get_footer(); ?>