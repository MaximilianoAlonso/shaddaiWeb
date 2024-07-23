<article id="post-<?=$post->ID; ?>" class="col-lg-5 col-md-12 post">
	<a href="<?=esc_url( get_permalink() ) ;?>" class="shadow">
		<?php
		if(has_post_thumbnail()){
			$thumb_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'large');
			$src = $thumb_src['0'];
		}
		if($src){?>
			<div class="imagen">
				<img src="<?php echo $src; ?>" alt="<?php echo @$src_t; ?>" style="width: 100%;">
			</div>
		<?php } ?>
		<div class="texto">
			<?php
			the_title( '<h2 class="entry-title">', '</h2>' );
			?>
			<p><?php echo limitar_caracters(180);  ?></p>

			<div class="footer text-right">
				<button type="button" class="btn btn-primary btn-shaddai"><i class="fal fa-long-arrow-right"></i> Leer más</button>
			</div>
		</div>
	</a>
</article>