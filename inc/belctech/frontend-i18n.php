<?php
/** Native Spanish translations for the public theme interface. */

defined( 'ABSPATH' ) || exit;

function belctech_frontend_spanish_dictionary() {
	return array(
		'Active Filters:'                          => 'Filtros activos:',
		'All'                                      => 'Todos',
		'All Categories'                           => 'Todas las categorías',
		'All items loaded'                         => 'Todos los elementos cargados',
		'All posts loaded.'                        => 'Todas las publicaciones cargadas.',
		'All products loaded.'                     => 'Todos los productos cargados.',
		'Already a member?'                        => '¿Ya tienes una cuenta?',
		'Back to Cart'                             => 'Volver al carrito',
		'Back to Shop'                             => 'Volver a la tienda',
		'Back to homepage'                         => 'Volver al inicio',
		'Best Sellers'                             => 'Más vendidos',
		'Cart'                                     => 'Carrito',
		'Categories'                               => 'Categorías',
		'Close'                                    => 'Cerrar',
		'Comments are closed'                      => 'Los comentarios están cerrados',
		'Continue Shopping'                        => 'Seguir comprando',
		'Empty Cart'                               => 'Vaciar carrito',
		'Featured Products'                        => 'Productos destacados',
		'Filters'                                  => 'Filtros',
		'Latest Products'                          => 'Productos recientes',
		'Leave a comment'                          => 'Dejar un comentario',
		'Load More'                                => 'Cargar más',
		'Login with %s'                            => 'Ingresar con %s',
		'Max Price:'                               => 'Precio máximo:',
		'Min Price:'                               => 'Precio mínimo:',
		'My Account'                               => 'Mi cuenta',
		'New'                                      => 'Nuevo',
		'Next'                                     => 'Siguiente',
		'No results'                               => 'Sin resultados',
		'Not a member?'                            => '¿No tienes una cuenta?',
		'Off'                                      => 'de descuento',
		'Oops! Page not found.'                    => 'Página no encontrada.',
		'Order By:'                                => 'Ordenar por:',
		'Out of Stock'                             => 'Agotado',
		'Please fill in the required fields'       => 'Completa los campos obligatorios',
		'Posted in:'                               => 'Publicado en:',
		'Prev'                                     => 'Anterior',
		'Previous'                                 => 'Anterior',
		'Quick View'                               => 'Vista rápida',
		'Related Items'                            => 'Productos relacionados',
		'Related Posts'                            => 'Publicaciones relacionadas',
		'Remove'                                   => 'Quitar',
		'Remove All'                               => 'Quitar todos',
		'Sale'                                     => 'Oferta',
		'Search'                                   => 'Buscar',
		'Search &hellip;'                          => 'Buscar…',
		'Search For:'                              => 'Buscar:',
		'Search Results for: '                     => 'Resultados de búsqueda para: ',
		'Scroll To Top'                            => 'Volver arriba',
		'Share'                                    => 'Compartir',
		'Shop'                                     => 'Tienda',
		'Tagged:'                                  => 'Etiquetado:',
		'Top Rated'                                => 'Mejor valorados',
		'Updating&hellip;'                         => 'Actualizando…',
		'View All'                                 => 'Ver todo',
		'Watch Video'                              => 'Ver video',
		'We are sorry, but the page you\'re looking for cannot be found.' => 'La página que buscas no existe o fue movida.',
		'Wishlist'                                 => 'Lista de deseos',
		'days'                                     => 'días',
		'default'                                  => 'predeterminado',
		'hours'                                    => 'horas',
		'latest'                                   => 'más recientes',
		'minutes'                                  => 'minutos',
		'popularity'                               => 'popularidad',
		'price high to low'                        => 'precio: mayor a menor',
		'price low to high'                        => 'precio: menor a mayor',
		'rating'                                   => 'valoración',
		'seconds'                                  => 'segundos',
	);
}

function belctech_translate_frontend_text( $translated, $text, $domain ) {
	if ( 'belctech-ecommerce' !== $domain ) return $translated;
	if ( is_admin() && ! ( function_exists( 'wp_doing_ajax' ) && wp_doing_ajax() ) ) return $translated;

	$dictionary = belctech_frontend_spanish_dictionary();
	return isset( $dictionary[ $text ] ) ? $dictionary[ $text ] : $translated;
}
add_filter( 'gettext', 'belctech_translate_frontend_text', 20, 3 );

function belctech_translate_frontend_text_with_context( $translated, $text, $context, $domain ) {
	return belctech_translate_frontend_text( $translated, $text, $domain );
}
add_filter( 'gettext_with_context', 'belctech_translate_frontend_text_with_context', 20, 4 );
