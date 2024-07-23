<?php get_header(); ?>
<main role="blog">
	<section class="blog">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h2>Últimos artículos</h2>
				</div>
			</div>
		</div>
	</section>
	<section id="blog" class="section padding pt-0">
		<div class="container">
			<div class="row">
				<div class="col-md-9 col-xs-12">
					<div class="row">
						<?php if ( have_posts() ) { ?>
						<?php
						while ( have_posts() ) {
							the_post();
							get_template_part( 'content', get_post_format() );
						}
						?>
						<?php
						if (function_exists("wp_bs_pagination")){
							echo '<div class="col-12">';
							echo wp_bs_pagination();
							echo '</div>';
						}
						?>
					<?php } ?>
					</div>
				</div>
				<div class="col-md-3 right-sdetail">
					<!-- <div class="other-services">
						<div class="title">
							<p class="text-left"><img src="<?=_HOST_;?>/assets/frondend/default/images/decor-3.png" alt="Shaddai">Artículos populares</p>
							<ul>
								<a href="#">
									<li class="{{active}}">
										<img src="" alt="">
										<h3></h3>
										<p></p>
									</li>
								</a>
							</ul>
						</div>
					</div> -->
					<?php
					if ( is_active_sidebar( 'sidebar' ) ) { ?>
						<?php dynamic_sidebar( 'sidebar' ); ?>
					<?php } ?>
					<div class="contact-services">
						<form>
							<div class="title">
								<h2>Contáctanos</h2>
							</div>
							<div class="form-row">
								<div class="form-group col-md-12">
									<input type="text" class="form-control" id="name" name="name" placeholder="Nombre">
								</div>
								<div class="form-group col-md-12">
									<input type="text" class="form-control" id="company" name="company" placeholder="Empresa">
								</div>
								<div class="form-group col-md-12">
									<input type="text" class="form-control" id="phone" name="phone" placeholder="Teléfono">
								</div>
								<div class="form-group col-md-12">
									<input type="email" class="form-control" id="email" name="email" placeholder="Correo">
								</div>
							</div>
							<div class="form-group">
								<textarea class="form-control" id="message" name="message" placeholder="Mensaje" rows="3"></textarea>
							</div>
							<button type="submit" class="btn btn-primary btn-shaddai">Enviar Mensaje</button>
						</form>
					</div>
					<div class="help-services">
						<div class="title">
							<h2>Contáctanos</h2>
							<p>informes@estudioshaddai.com</p>
							<p>990 208 144</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

</main>

<?php get_footer(); ?>