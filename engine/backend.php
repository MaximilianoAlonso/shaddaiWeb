<?php

$app->group('/admin', function () use ($app) {

	$app->get('', '\App\Backend\Index');

	$app->get('/index', '\App\Backend\Index');
	$app->map(['GET', 'POST'], '/login', '\App\Backend\Index:login');
	$app->map(['GET', 'POST'], '/perfil', '\App\Backend\Index:perfil');
	$app->get('/salir', '\App\Backend\Index:salir');

	/*Sistema*/

	$app->group('/sistema', function () use ($app) {
		$app->map(['GET', 'POST'], '/config', '\App\Backend\Sistema\Configuraciones');
		$app->map(['GET', 'POST'], '/areas', '\App\Backend\Sistema\Areas');
		$app->map(['GET', 'POST'], '/areas/agregar', '\App\Backend\Sistema\Areas:add');
		$app->map(['GET', 'POST'], '/areas/editar/{id:[0-9]+}', '\App\Backend\Sistema\Areas:edit');

		$app->map(['GET', 'POST'], '/trabajadores', '\App\Backend\Sistema\Trabajadores');
		$app->map(['GET', 'POST'], '/trabajadores/agregar', '\App\Backend\Sistema\Trabajadores:add');
		$app->map(['GET', 'POST'], '/trabajadores/editar/{id:[0-9]+}', '\App\Backend\Sistema\Trabajadores:edit');

		$app->map(['GET', 'POST'], '/usuarios', '\App\Backend\Sistema\Usuarios');
		$app->map(['GET', 'POST'], '/usuarios/agregar', '\App\Backend\Sistema\Usuarios:add');
		$app->map(['GET', 'POST'], '/usuarios/editar/{id}', '\App\Backend\Sistema\Usuarios:edit');

	});

	/* Mantenimientos */
	$app->group('/mantenimientos', function () use ($app) {
		$app->map(['GET', 'POST'], '/slider', '\App\Backend\Mantenimientos\Slider');
		$app->map(['GET', 'POST'], '/isesion', '\App\Backend\Mantenimientos\Isesion');
		$app->map(['GET', 'POST'], '/productos', '\App\Backend\Mantenimientos\Productos');
		$app->map(['GET', 'POST'], '/servicios', '\App\Backend\Mantenimientos\Servicios');
		$app->map(['GET', 'POST'], '/cursos', '\App\Backend\Mantenimientos\Cursos');
		$app->map(['GET', 'POST'], '/blog', '\App\Backend\Mantenimientos\Blog');
		$app->map(['GET', 'POST'], '/galeria', '\App\Backend\Mantenimientos\Galeria');
		$app->map(['GET', 'POST'], '/eventos', '\App\Backend\Mantenimientos\Eventos');
		$app->map(['GET', 'POST'], '/testimonios', '\App\Backend\Mantenimientos\Testimonios');
		$app->map(['GET', 'POST'], '/partners', '\App\Backend\Mantenimientos\Partners');
		$app->map(['GET', 'POST'], '/equipo', '\App\Backend\Mantenimientos\Equipo');
	});

	/* Paginas */

	$app->group('/paginas', function () use ($app) {

		$app->map(['GET', 'POST'], '/home', '\App\Backend\Paginas:home');

		$app->map(['GET', 'POST'], '/ambientes', '\App\Backend\Paginas:ambientes');

		$app->map(['GET', 'POST'], '/eventos', '\App\Backend\Paginas:eventos');

		$app->map(['GET', 'POST'], '/galeria', '\App\Backend\Paginas:galeria');

		$app->map(['GET', 'POST'], '/nosotros', '\App\Backend\Paginas:nosotros');

		$app->map(['GET', 'POST'], '/testimonios', '\App\Backend\Paginas:testimonios');

		$app->map(['GET', 'POST'], '/servicios', '\App\Backend\Paginas:servicios');

		$app->map(['GET', 'POST'], '/cursos', '\App\Backend\Paginas:cursos');

		$app->map(['GET', 'POST'], '/blog', '\App\Backend\Paginas:blog');

		$app->map(['GET', 'POST'], '/contactanos', '\App\Backend\Paginas:contactanos');

		$app->map(['GET', 'POST'], '/personalizados', '\App\Backend\Paginas\Personalizados');
		$app->map(['GET', 'POST'], '/personalizados/agregar', '\App\Backend\Paginas\Personalizados:add');
		$app->map(['GET', 'POST'], '/personalizados/editar/{id:[0-9]+}', '\App\Backend\Paginas\Personalizados:edit');

	});

	/* Preguntas Frecuentes */

	$app->group('/preguntas', function () use ($app) {

		$app->map(['GET', 'POST'], '', '\App\Backend\Preguntas');
		$app->map(['GET', 'POST'], '/agregar', '\App\Backend\Preguntas:add');
		$app->map(['GET', 'POST'], '/editar/{id:[0-9]+}', '\App\Backend\Preguntas:edit');
		$app->map(['GET', 'POST'], '/orden', '\App\Backend\Preguntas:orden');

		$app->group('/{preguntas:[0-9]+}', function () use ($app) {

			$app->map(['GET', 'POST'], '/respuestas', '\App\Backend\Preguntas\Respuestas');
			$app->map(['GET', 'POST'], '/respuestas/agregar', '\App\Backend\Preguntas\Respuestas:add');
			$app->map(['GET', 'POST'], '/respuestas/editar/{id:[0-9]+}', '\App\Backend\Preguntas\Respuestas:edit');
			$app->map(['GET', 'POST'], '/respuestas/orden', '\App\Backend\Preguntas\Respuestas:orden');

		});

	});

	/* Productos */

	$app->group('/productos', function () use ($app) {

		$app->map(['GET', 'POST'], '', '\App\Backend\Productos');
		$app->map(['GET', 'POST'], '/agregar', '\App\Backend\Productos:add');
		$app->map(['GET', 'POST'], '/editar/{id:[0-9]+}', '\App\Backend\Productos:edit');
		$app->map(['GET', 'POST'], '/orden', '\App\Backend\Productos:orden');

		$app->map(['GET', 'POST'], '/imagenes/{productos:[0-9]+}', '\App\Backend\Productos\Imagenes');
		$app->map(['GET', 'POST'], '/imagenes/{productos:[0-9]+}/agregar', '\App\Backend\Productos\Imagenes:add');
		$app->map(['GET', 'POST'], '/imagenes/{productos:[0-9]+}/editar/{id:[0-9]+}', '\App\Backend\Productos\Imagenes:edit');
		$app->map(['GET', 'POST'], '/imagenes/{productos:[0-9]+}/orden', '\App\Backend\Productos\Imagenes:orden');


		$app->map(['GET', 'POST'], '/lineas', '\App\Backend\Productos\Lineas');
		$app->map(['GET', 'POST'], '/lineas/agregar', '\App\Backend\Productos\Lineas:add');
		$app->map(['GET', 'POST'], '/lineas/editar/{id:[0-9]+}', '\App\Backend\Productos\Lineas:edit');
		$app->map(['GET', 'POST'], '/lineas/orden', '\App\Backend\Productos\Lineas:orden');


		$app->map(['GET', 'POST'], '/categorias', '\App\Backend\Productos\Categorias');
		$app->map(['GET', 'POST'], '/categorias/agregar', '\App\Backend\Productos\Categorias:add');
		$app->map(['GET', 'POST'], '/categorias/editar/{id:[0-9]+}', '\App\Backend\Productos\Categorias:edit');
		$app->map(['GET', 'POST'], '/categorias/orden', '\App\Backend\Productos\Categorias:orden');


		$app->map(['GET', 'POST'], '/subcategorias', '\App\Backend\Productos\SubCategorias');
		$app->map(['GET', 'POST'], '/subcategorias/agregar', '\App\Backend\Productos\SubCategorias:add');
		$app->map(['GET', 'POST'], '/subcategorias/editar/{id:[0-9]+}', '\App\Backend\Productos\SubCategorias:edit');
		$app->map(['GET', 'POST'], '/subcategorias/orden', '\App\Backend\Productos\SubCategorias:orden');


	});

	/* Servicios */

	$app->group('/servicios', function () use ($app) {

		$app->map(['GET', 'POST'], '', '\App\Backend\Servicios');
		$app->map(['GET', 'POST'], '/agregar', '\App\Backend\Servicios:add');
		$app->map(['GET', 'POST'], '/editar/{id:[0-9]+}', '\App\Backend\Servicios:edit');
		$app->map(['GET', 'POST'], '/orden', '\App\Backend\Servicios:orden');


		$app->group('/imagenes', function () use ($app) {

			$app->map(['GET', 'POST'], '/{servicios:[0-9]+}', '\App\Backend\Servicios\Imagenes');
			$app->map(['GET', 'POST'], '/{servicios:[0-9]+}/agregar', '\App\Backend\Servicios\Imagenes:add');
			$app->map(['GET', 'POST'], '/{servicios:[0-9]+}/editar/{id:[0-9]+}', '\App\Backend\Servicios\Imagenes:edit');
			$app->map(['GET', 'POST'], '/{servicios:[0-9]+}/orden', '\App\Backend\Servicios\Imagenes:orden');


			$app->group('/{servicios:[0-9]+}/adicionales', function () use ($app) {

				$app->map(['GET', 'POST'], '/{imagenes:[0-9]+}', '\App\Backend\Servicios\Imagenes\Adicionales');
				$app->map(['GET', 'POST'], '/{imagenes:[0-9]+}/agregar', '\App\Backend\Servicios\Imagenes\Adicionales:add');
				$app->map(['GET', 'POST'], '/{imagenes:[0-9]+}/editar/{id:[0-9]+}', '\App\Backend\Servicios\Imagenes\Adicionales:edit');
				$app->map(['GET', 'POST'], '/{imagenes:[0-9]+}/orden', '\App\Backend\Servicios\Imagenes\Adicionales:orden');
			});

		});

		$app->map(['GET', 'POST'], '/lineas', '\App\Backend\Servicios\Lineas');
		$app->map(['GET', 'POST'], '/lineas/agregar', '\App\Backend\Servicios\Lineas:add');
		$app->map(['GET', 'POST'], '/lineas/editar/{id:[0-9]+}', '\App\Backend\Servicios\Lineas:edit');
		$app->map(['GET', 'POST'], '/lineas/orden', '\App\Backend\Servicios\Lineas:orden');


		$app->map(['GET', 'POST'], '/categorias', '\App\Backend\Servicios\Categorias');
		$app->map(['GET', 'POST'], '/categorias/agregar', '\App\Backend\Servicios\Categorias:add');
		$app->map(['GET', 'POST'], '/categorias/editar/{id:[0-9]+}', '\App\Backend\Servicios\Categorias:edit');
		$app->map(['GET', 'POST'], '/categorias/orden', '\App\Backend\Servicios\Categorias:orden');


		$app->map(['GET', 'POST'], '/subcategorias', '\App\Backend\Servicios\SubCategorias');
		$app->map(['GET', 'POST'], '/subcategorias/agregar', '\App\Backend\Servicios\SubCategorias:add');
		$app->map(['GET', 'POST'], '/subcategorias/editar/{id:[0-9]+}', '\App\Backend\Servicios\SubCategorias:edit');
		$app->map(['GET', 'POST'], '/subcategorias/orden', '\App\Backend\Servicios\SubCategorias:orden');
	});

	/* Cursos */

	$app->group('/cursos', function () use ($app) {

		$app->map(['GET', 'POST'], '', '\App\Backend\Cursos');
		$app->map(['GET', 'POST'], '/agregar', '\App\Backend\Cursos:add');
		$app->map(['GET', 'POST'], '/editar/{id:[0-9]+}', '\App\Backend\Cursos:edit');
		$app->map(['GET', 'POST'], '/orden', '\App\Backend\Cursos:orden');


		$app->group('/imagenes', function () use ($app) {

			$app->map(['GET', 'POST'], '/{cursos:[0-9]+}', '\App\Backend\Cursos\Imagenes');
			$app->map(['GET', 'POST'], '/{cursos:[0-9]+}/agregar', '\App\Backend\Cursos\Imagenes:add');
			$app->map(['GET', 'POST'], '/{cursos:[0-9]+}/editar/{id:[0-9]+}', '\App\Backend\Cursos\Imagenes:edit');
			$app->map(['GET', 'POST'], '/{cursos:[0-9]+}/orden', '\App\Backend\Cursos\Imagenes:orden');


			$app->group('/{cursos:[0-9]+}/adicionales', function () use ($app) {

				$app->map(['GET', 'POST'], '/{imagenes:[0-9]+}', '\App\Backend\Cursos\Imagenes\Adicionales');
				$app->map(['GET', 'POST'], '/{imagenes:[0-9]+}/agregar', '\App\Backend\Cursos\Imagenes\Adicionales:add');
				$app->map(['GET', 'POST'], '/{imagenes:[0-9]+}/editar/{id:[0-9]+}', '\App\Backend\Cursos\Imagenes\Adicionales:edit');
				$app->map(['GET', 'POST'], '/{imagenes:[0-9]+}/orden', '\App\Backend\Cursos\Imagenes\Adicionales:orden');
			});

		});

		$app->map(['GET', 'POST'], '/lineas', '\App\Backend\Cursos\Lineas');
		$app->map(['GET', 'POST'], '/lineas/agregar', '\App\Backend\Cursos\Lineas:add');
		$app->map(['GET', 'POST'], '/lineas/editar/{id:[0-9]+}', '\App\Backend\Cursos\Lineas:edit');
		$app->map(['GET', 'POST'], '/lineas/orden', '\App\Backend\Cursos\Lineas:orden');


		$app->map(['GET', 'POST'], '/categorias', '\App\Backend\Cursos\Categorias');
		$app->map(['GET', 'POST'], '/categorias/agregar', '\App\Backend\Cursos\Categorias:add');
		$app->map(['GET', 'POST'], '/categorias/editar/{id:[0-9]+}', '\App\Backend\Cursos\Categorias:edit');
		$app->map(['GET', 'POST'], '/categorias/orden', '\App\Backend\Cursos\Categorias:orden');


		$app->map(['GET', 'POST'], '/subcategorias', '\App\Backend\Cursos\SubCategorias');
		$app->map(['GET', 'POST'], '/subcategorias/agregar', '\App\Backend\Cursos\SubCategorias:add');
		$app->map(['GET', 'POST'], '/subcategorias/editar/{id:[0-9]+}', '\App\Backend\Cursos\SubCategorias:edit');
		$app->map(['GET', 'POST'], '/subcategorias/orden', '\App\Backend\Cursos\SubCategorias:orden');
	});


	/* Blog */

	$app->group('/blog', function () use ($app) {

		$app->map(['GET', 'POST'], '', '\App\Backend\Blog');
		$app->map(['GET', 'POST'], '/agregar', '\App\Backend\Blog:add');
		$app->map(['GET', 'POST'], '/editar/{id:[0-9]+}', '\App\Backend\Blog:edit');
		$app->map(['GET', 'POST'], '/orden', '\App\Backend\Blog:orden');


		$app->group('/imagenes', function () use ($app) {

			$app->map(['GET', 'POST'], '/{blog:[0-9]+}', '\App\Backend\Blog\Imagenes');
			$app->map(['GET', 'POST'], '/{blog:[0-9]+}/agregar', '\App\Backend\Blog\Imagenes:add');
			$app->map(['GET', 'POST'], '/{blog:[0-9]+}/editar/{id:[0-9]+}', '\App\Backend\Blog\Imagenes:edit');
			$app->map(['GET', 'POST'], '/{blog:[0-9]+}/orden', '\App\Backend\Blog\Imagenes:orden');


			$app->group('/{blog:[0-9]+}/adicionales', function () use ($app) {

				$app->map(['GET', 'POST'], '/{imagenes:[0-9]+}', '\App\Backend\Blog\Imagenes\Adicionales');
				$app->map(['GET', 'POST'], '/{imagenes:[0-9]+}/agregar', '\App\Backend\Blog\Imagenes\Adicionales:add');
				$app->map(['GET', 'POST'], '/{imagenes:[0-9]+}/editar/{id:[0-9]+}', '\App\Backend\Blog\Imagenes\Adicionales:edit');
				$app->map(['GET', 'POST'], '/{imagenes:[0-9]+}/orden', '\App\Backend\Blog\Imagenes\Adicionales:orden');
			});

		});

		$app->map(['GET', 'POST'], '/lineas', '\App\Backend\Blog\Lineas');
		$app->map(['GET', 'POST'], '/lineas/agregar', '\App\Backend\Blog\Lineas:add');
		$app->map(['GET', 'POST'], '/lineas/editar/{id:[0-9]+}', '\App\Backend\Blog\Lineas:edit');
		$app->map(['GET', 'POST'], '/lineas/orden', '\App\Backend\Blog\Lineas:orden');


		$app->map(['GET', 'POST'], '/categorias', '\App\Backend\Blog\Categorias');
		$app->map(['GET', 'POST'], '/categorias/agregar', '\App\Backend\Blog\Categorias:add');
		$app->map(['GET', 'POST'], '/categorias/editar/{id:[0-9]+}', '\App\Backend\Blog\Categorias:edit');
		$app->map(['GET', 'POST'], '/categorias/orden', '\App\Backend\Blog\Categorias:orden');


		$app->map(['GET', 'POST'], '/subcategorias', '\App\Backend\Blog\SubCategorias');
		$app->map(['GET', 'POST'], '/subcategorias/agregar', '\App\Backend\Blog\SubCategorias:add');
		$app->map(['GET', 'POST'], '/subcategorias/editar/{id:[0-9]+}', '\App\Backend\Blog\SubCategorias:edit');
		$app->map(['GET', 'POST'], '/subcategorias/orden', '\App\Backend\Blog\SubCategorias:orden');
	});

	/* Galeria */

	$app->group('/galeria', function () use ($app) {

		$app->map(['GET', 'POST'], '', '\App\Backend\Galeria');
		$app->map(['GET', 'POST'], '/agregar', '\App\Backend\Galeria:add');
		$app->map(['GET', 'POST'], '/editar/{id:[0-9]+}', '\App\Backend\Galeria:edit');
		$app->map(['GET', 'POST'], '/orden', '\App\Backend\Galeria:orden');

		$app->map(['GET', 'POST'], '/imagenes/{galeria:[0-9]+}', '\App\Backend\Galeria\Imagenes');
		$app->map(['GET', 'POST'], '/imagenes/{galeria:[0-9]+}/agregar', '\App\Backend\Galeria\Imagenes:add');
		$app->map(['GET', 'POST'], '/imagenes/{galeria:[0-9]+}/editar/{id:[0-9]+}', '\App\Backend\Galeria\Imagenes:edit');
		$app->map(['GET', 'POST'], '/imagenes/{galeria:[0-9]+}/orden', '\App\Backend\Galeria\Imagenes:orden');


		$app->map(['GET', 'POST'], '/lineas', '\App\Backend\Galeria\Lineas');
		$app->map(['GET', 'POST'], '/lineas/agregar', '\App\Backend\Galeria\Lineas:add');
		$app->map(['GET', 'POST'], '/lineas/editar/{id:[0-9]+}', '\App\Backend\Galeria\Lineas:edit');
		$app->map(['GET', 'POST'], '/lineas/orden', '\App\Backend\Galeria\Lineas:orden');


		$app->map(['GET', 'POST'], '/categorias', '\App\Backend\Galeria\Categorias');
		$app->map(['GET', 'POST'], '/categorias/agregar', '\App\Backend\Galeria\Categorias:add');
		$app->map(['GET', 'POST'], '/categorias/editar/{id:[0-9]+}', '\App\Backend\Galeria\Categorias:edit');
		$app->map(['GET', 'POST'], '/categorias/orden', '\App\Backend\Galeria\Categorias:orden');


		$app->map(['GET', 'POST'], '/subcategorias', '\App\Backend\Galeria\SubCategorias');
		$app->map(['GET', 'POST'], '/subcategorias/agregar', '\App\Backend\Galeria\SubCategorias:add');
		$app->map(['GET', 'POST'], '/subcategorias/editar/{id:[0-9]+}', '\App\Backend\Galeria\SubCategorias:edit');
		$app->map(['GET', 'POST'], '/subcategorias/orden', '\App\Backend\Galeria\SubCategorias:orden');
	});

	/* Eventos */

	$app->group('/eventos', function () use ($app) {

		$app->map(['GET', 'POST'], '', '\App\Backend\Eventos');
		$app->map(['GET', 'POST'], '/agregar', '\App\Backend\Eventos:add');
		$app->map(['GET', 'POST'], '/editar/{id:[0-9]+}', '\App\Backend\Eventos:edit');
		$app->map(['GET', 'POST'], '/orden', '\App\Backend\Eventos:orden');

		$app->map(['GET', 'POST'], '/imagenes/{eventos:[0-9]+}', '\App\Backend\Eventos\Imagenes');
		$app->map(['GET', 'POST'], '/imagenes/{eventos:[0-9]+}/agregar', '\App\Backend\Eventos\Imagenes:add');
		$app->map(['GET', 'POST'], '/imagenes/{eventos:[0-9]+}/editar/{id:[0-9]+}', '\App\Backend\Eventos\Imagenes:edit');
		$app->map(['GET', 'POST'], '/imagenes/{eventos:[0-9]+}/orden', '\App\Backend\Eventos\Imagenes:orden');


		$app->map(['GET', 'POST'], '/lineas', '\App\Backend\Eventos\Lineas');
		$app->map(['GET', 'POST'], '/lineas/agregar', '\App\Backend\Eventos\Lineas:add');
		$app->map(['GET', 'POST'], '/lineas/editar/{id:[0-9]+}', '\App\Backend\Eventos\Lineas:edit');
		$app->map(['GET', 'POST'], '/lineas/orden', '\App\Backend\Eventos\Lineas:orden');


		$app->map(['GET', 'POST'], '/categorias', '\App\Backend\Eventos\Categorias');
		$app->map(['GET', 'POST'], '/categorias/agregar', '\App\Backend\Eventos\Categorias:add');
		$app->map(['GET', 'POST'], '/categorias/editar/{id:[0-9]+}', '\App\Backend\Eventos\Categorias:edit');
		$app->map(['GET', 'POST'], '/categorias/orden', '\App\Backend\Eventos\Categorias:orden');


		$app->map(['GET', 'POST'], '/subcategorias', '\App\Backend\Eventos\SubCategorias');
		$app->map(['GET', 'POST'], '/subcategorias/agregar', '\App\Backend\Eventos\SubCategorias:add');
		$app->map(['GET', 'POST'], '/subcategorias/editar/{id:[0-9]+}', '\App\Backend\Eventos\SubCategorias:edit');
		$app->map(['GET', 'POST'], '/subcategorias/orden', '\App\Backend\Eventos\SubCategorias:orden');
	});


	/* Slider */

	$app->map(['GET', 'POST'], '/slider', '\App\Backend\Slider');
	$app->map(['GET', 'POST'], '/slider/agregar', '\App\Backend\Slider:add');
	$app->map(['GET', 'POST'], '/slider/editar/{id:[0-9]+}', '\App\Backend\Slider:edit');
	$app->map(['GET', 'POST'], '/slider/orden', '\App\Backend\Slider:orden');

	/* Equipo */

	$app->map(['GET', 'POST'], '/equipo', '\App\Backend\Equipo');
	$app->map(['GET', 'POST'], '/equipo/agregar', '\App\Backend\Equipo:add');
	$app->map(['GET', 'POST'], '/equipo/editar/{id:[0-9]+}', '\App\Backend\Equipo:edit');
	$app->map(['GET', 'POST'], '/equipo/orden', '\App\Backend\Equipo:orden');

	/* Isesion */

	$app->map(['GET', 'POST'], '/isesion', '\App\Backend\Isesion');
	$app->map(['GET', 'POST'], '/isesion/agregar', '\App\Backend\Isesion:add');
	$app->map(['GET', 'POST'], '/isesion/editar/{id:[0-9]+}', '\App\Backend\Isesion:edit');
	$app->map(['GET', 'POST'], '/isesion/orden', '\App\Backend\Isesion:orden');


	/* Testimonios */

	$app->map(['GET', 'POST'], '/testimonios', '\App\Backend\Testimonios');
	$app->map(['GET', 'POST'], '/testimonios/agregar', '\App\Backend\Testimonios:add');
	$app->map(['GET', 'POST'], '/testimonios/editar/{id:[0-9]+}', '\App\Backend\Testimonios:edit');
	$app->map(['GET', 'POST'], '/testimonios/orden', '\App\Backend\Testimonios:orden');


	/* Partners */

	$app->map(['GET', 'POST'], '/partners', '\App\Backend\Partners');
	$app->map(['GET', 'POST'], '/partners/agregar', '\App\Backend\Partners:add');
	$app->map(['GET', 'POST'], '/partners/editar/{id:[0-9]+}', '\App\Backend\Partners:edit');
	$app->map(['GET', 'POST'], '/partners/orden', '\App\Backend\Partners:orden');

	$app->map(['GET', 'POST'], '/elfinder', '\App\Backend\elFinder');

})->add($SesionAdmin);