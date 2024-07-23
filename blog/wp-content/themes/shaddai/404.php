<?php get_header(); ?>
<main role="blog">
    <section class="breadcrumb-area bg-img">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<h2>Blog</h2>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?=_HOST_;?>">Inicio</a></li>
						<li class="breadcrumb-item"><a href="<?=_HOST_;?>/blog">Blog</a></li>
					</ol>
				</div>
			</div>
		</div>
	</section>
	<section id="lista-blog" class="padding section">
		<div class="container">
			<div class="head">
				<div class="frase">
					<span class="linea"></span>
					Blog
				</div>
				<h2>404</h2>
			</div>
			<div class="body">
				<div class="alert alert-warning" role="alert">
					No sean encontrado registros para mostrar
				</div>
			</div>
		</div>
	</section>

</main>

<?php get_footer(); ?>