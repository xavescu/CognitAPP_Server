<?php
require 'vendor/autoload.php';

$router = new AltoRouter();

$router->map( 'GET', '/', function() {
    echo 'cognitapp';
});

/*$router->map( 'GET', '/article/[a:wiki]', function($wiki) {
    require __DIR__ . '/controller/articleWiki.php';
});*/

$router->map('POST', '/login', function() {
    require __DIR__ . '/controller/ControladorLogin.php';
    $c = new ControladorLogin();
    $c->serve();
});

$router->map('POST', '/register', function() {
    require __DIR__ . '/controller/ControladorRegistro.php';
    $c = new ControladorRegistro();
    $c->serve();
});

$router->map('POST', '/storeSubject', function() {
    require __DIR__ . '/controller/ControladorGuardarAsignatura.php';
    $c = new ControladorGuardarAsignatura();
    $c->serve();
});

$match = $router->match();

if( is_array($match) && is_callable( $match['target'] ) ) {
	call_user_func_array( $match['target'], $match['params'] ); 
} else {
	// no route was matched
	header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
}

?>