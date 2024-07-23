<?php get_header(); ?>
<main role="blog">
	<!--<section class="breadcrumb-area bg-img">
			<div class="container">
			<div class="row">
				<div class="col-12">
					<h2><?php the_title(); ?></h2>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?=_HOST_;?>">Inicio</a></li>
						<li class="breadcrumb-item"><a href="<?=_HOST_;?>/blog">Blog</a></li>
					</ol>
				</div>
			</div>
		</div>
	</section> -->
	<section id="view-blog" class="section padding pt-0">
		<div class="container">
			<div class="row">
				<div class="col col-md-12 col-xs-12">
					<article id="post-<?=$post->ID; ?>" <?php post_class(); ?>>
						<div class="body">
							<h2 class="title-view-blog"><?php the_title(); ?></h2>
							<?php
							if(has_post_thumbnail()){
								$thumb_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'large');
								$src = $thumb_src['0'];
								$src_t = get_post_meta(get_post_thumbnail_id($post->ID), '_wp_attachment_image_alt', true);
							}
							if($src){?>
								<div class="imagen text-center">
									<img src="<?php echo $src; ?>" alt="<?php echo @$src_t; ?>" />
								</div>
								<?php } ?>
								<div class="texto">
									<?php
									if (have_posts()){
										while (have_posts()) {
											the_post();
										# setPostViews($post->ID);
											the_content();
										}
									}
									?>
								</div>
								<div class="pie">
									<p class="entry-meta">
										<?php if ( in_array( 'category', get_object_taxonomies( get_post_type() ) ) ) { ?>
											<span>Categoría: <?php echo get_the_category_list( _x( ', ', '', 'base' ) ); ?></span>
										<?php } ?>
									</p>
								</div>
								<div id="valoracion">
									<?php if(function_exists('the_ratings')) { the_ratings(); } ?>
								</div>
								<div class="navigation padding pt-0">
									<h6>Seguir Leyendo:</h6>
									<div class="text-left float-left">
										<?php previous_post_link('%link', '<span class="btn btn-purple">Anterior</span>'); ?>
									</div>
									<div class="text-right float-right">
										<?php next_post_link('%link', '<span class="btn btn-purple">Siguente</span>'); ?>
									</div>
								</div>
								<div class="facebook">
									<div class="fb-comments" data-href="<?=get_permalink();?>" data-width="100%" data-numposts="8"></div>
								</div>
							</div>
						</article>
					</div>
				</div>
			</div>
		</section>

		<?php
		$terms = get_the_terms( $post->ID, 'category');
		$categ = array();
		if ($terms){
			foreach ($terms as $term) {
				$categ[] = $term->term_id;
			}
		}

		if (count($categ) > 0) {
			$loop	= new WP_QUERY(array(
				'category__in'		=> $categ,
				'posts_per_page'	=> 6,
				'post__not_in'		=>array(get_the_ID()),
				'orderby'			=>'rand'
			));
		}
		?>
	<!-- <?php if ( $loop->have_posts() ){ ?>
		<section id="blog" class="section padding pt-0">
			<div class="container">
				<div class="head">
					<h2>Artículos Relacionados</h2>
				</div>
				<div class="body row">
					<?php
					while ( $loop->have_posts() ){
						$loop->the_post();
						$post = $loop->post;
						get_template_part( 'content', get_post_format() );
					}
					?>
				</div>
			</div>
		</section>
		<?php } ?> -->

	</main>
	<?php get_footer(); ?>