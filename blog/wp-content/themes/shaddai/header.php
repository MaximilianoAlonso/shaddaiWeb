<?php
/**
* Template Base
*
* @package WordPress
* @subpackage Base
* @since Base 1.0
*/

$agente = @$_SERVER['HTTP_USER_AGENT'];
$google_page_speed = false;
if (preg_match("/Google Page Speed Insights/i", $agente)) {
	$google_page_speed = true;
}

if (preg_match("/Chrome-Lighthouse/i", $agente)) {
	$google_page_speed = true;
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
	
	<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-DEYTJGXSV7"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-DEYTJGXSV7');
</script>
	
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<title><?php if(is_home()) { echo get_bloginfo("title"); } else { echo wp_title( '', true, 'right' ); } ?></title>
	<?php wp_head(); ?>
	<meta property="fb:app_id" content="140729863428582" />
	<meta property="fb:admins" content="100001960917113" />
	<meta property="fb:admins" content="1320108323" />
	<link rel="shortcut icon" type="image/x-icon" href="<?=_HOST_;?>/assets/frondend/default/images/favicon.png" />
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?=_HOST_;?>/assets/frondend/default/recursos/fontawesome/css/all.css">
	<link rel="stylesheet" href="<?=_HOST_;?>/assets/frondend/default/recursos/owlcarousel/assets/owl.carousel.min.css">
	<link rel="stylesheet" href="<?=_HOST_;?>/assets/frondend/default/recursos/owlcarousel/assets/owl.theme.default.min.css">
	<link rel="stylesheet" href="<?=_HOST_;?>/assets/frondend/default/css/main.css">
	<?php if ($google_page_speed != true): ?>

	<?php endif ?>
	<style>
		/* =WordPress Core
-------------------------------------------------------------- */
.alignnone {
  margin: 5px 20px 20px 0;
}

.aligncenter,
div.aligncenter {
  display: block;
  margin: 5px auto 5px auto;
}

.alignright {
  float:right;
  margin: 5px 0 20px 20px;
}

.alignleft {
  float: left;
  margin: 5px 20px 20px 0;
}

a img.alignright {
  float: right;
  margin: 5px 0 20px 20px;
}

a img.alignnone {
  margin: 5px 20px 20px 0;
}

a img.alignleft {
  float: left;
  margin: 5px 20px 20px 0;
}

a img.aligncenter {
  display: block;
  margin-left: auto;
  margin-right: auto;
}

.wp-caption {
  background: #fff;
  border: 1px solid #f0f0f0;
  max-width: 96%; /* Image does not overflow the content area */
  padding: 5px 3px 10px;
  text-align: center;
}

.wp-caption.alignnone {
  margin: 5px 20px 20px 0;
}

.wp-caption.alignleft {
  margin: 5px 20px 20px 0;
}

.wp-caption.alignright {
  margin: 5px 0 20px 20px;
}

.wp-caption img {
  border: 0 none;
  height: auto;
  margin: 0;
  max-width: 98.5%;
  padding: 0;
  width: auto;
}

.wp-caption p.wp-caption-text {
  font-size: 11px;
  line-height: 17px;
  margin: 0;
  padding: 0 4px 5px;
}

/* Text meant only for screen readers. */
.screen-reader-text {
  border: 0;
  clip: rect(1px, 1px, 1px, 1px);
  clip-path: inset(50%);
  height: 1px;
  margin: -1px;
  overflow: hidden;
  padding: 0;
  position: absolute !important;
  width: 1px;
  word-wrap: normal !important; /* Many screen reader and browser combinations announce broken words as they would appear visually. */
}

.screen-reader-text:focus {
  background-color: #eee;
  clip: auto !important;
  clip-path: none;
  color: #444;
  display: block;
  font-size: 1em;
  height: auto;
  left: 5px;
  line-height: normal;
  padding: 15px 23px 14px;
  text-decoration: none;
  top: 5px;
  width: auto;
  z-index: 100000;
  /* Above WP toolbar. */
}
.size-auto, 
.size-full,
.size-large,
.size-medium,
.size-thumbnail {
  max-width: 100%;
  height: auto;
}

blockquote {
  -moz-box-sizing: border-box;
  box-sizing: border-box;
  margin: 2em 0;
  padding: 1.75em 1.75em;
  border-left: #321ABE 0.4em solid;
  font-style: italic;
}


@media screen and (min-width: 782px){
  .admin-bar header.navbar-light{
    top: 20px;
  }
}
	</style>
</head>
<body <?php body_class(); ?>>
	<?php if ($google_page_speed != true): ?>
	<?php endif ?>
	<header>
		<div id="header-bottom">
	        <div class="container">
	            <div class="float-left col-md-2">
	                <a href="<?=_HOST_;?>" id="logo">
	                    <img src="<?=_HOST_;?>/assets/frondend/default/images/logo.png" alt="Shaddai">
	                </a>
	            </div>
	            <div class="float-left col-md-6">
	                <nav class="navbar navbar-expand-lg navbar-dark">
	                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".navbarsShaddai" aria-controls="navbarsShaddai" aria-expanded="false" aria-label="Toggle navigation">
	                        <span class="navbar-toggler-icon"></span>
	                    </button>
	                    <div class="collapse navbar-collapse">
	                        <ul class="navbar-nav mr-auto">
	                            <li class="nav-item">
	                                <a class="nav-link" href="<?=_HOST_;?>">Inicio</a>
	                            </li>
	                            <li class="nav-item">
	                                <a class="nav-link" href="<?=_HOST_;?>/nuestra-firma">Nuestra Firma</a>
	                            </li>
	                            <li class="nav-item">
	                                <a class="nav-link" href="<?=_HOST_;?>/servicios">Servicios</a>
	                            </li>
	                            <li class="nav-item active">
	                                <a class="nav-link" href="<?=_HOST_;?>/blog">Blog</a>
	                            </li>
	                            <li class="nav-item">
	                                <a class="nav-link" href="<?=_HOST_;?>/contacto">Contacto</a>
	                            </li>
	                        </ul>
	                    </div>
	                </nav>
	            </div>
	            <div class="float-right float-contact col-md-4">
	                <ul class="nav-contact">
	                    <li class="phone">
	                        <a class="nav-link" href="<?=_HOST_;?>">
	                            +51 990 208 144<br>
	                            <small>¿Necesitas ayuda?</small>
	                        </a>
	                    </li>
	                    <li class="quote">
	                        <a class="nav-link btn-shaddai" href="<?=_HOST_;?>/contacto">Cotizar Ahora</a>
	                    </li>
	                </ul>
	            </div>
	        </div>
    	</div>
    	<div id="header-movil">
	        <nav class="navbar navbar-expand-lg navbar-light d-flex d-lg-none">
	            <div class="collapse navbar-collapse navbarsShaddai">
	                <ul class="navbar-nav mr-auto text-center">
	                    <li class="nav-item">
	                        <a class="nav-link" href="<?=_HOST_;?>">Home</a>
	                    </li>
	                    <li class="nav-item">
	                        <a class="nav-link" href="<?=_HOST_;?>/nuestra-firma">Sobre mí</a>
	                    </li>
	                    <li class="nav-item">
	                        <a class="nav-link" href="<?=_HOST_;?>/servicios">Servicios</a>
	                    </li>
	                    <li class="nav-item active">
	                        <a class="nav-link" href="<?=_HOST_;?>/blog">Blog</a>
	                    </li>
	                    <li class="nav-item">
	                        <a class="nav-link" href="<?=_HOST_;?>/contacto">Contacto</a>
	                    </li>
	                </ul>
	            </div>
	        </nav>
    	</div>
	</header>