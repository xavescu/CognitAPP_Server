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

$router->map('POST', '/mp3', function() {
    require __DIR__ . '/controller/ControladorGenerarMp3.php';
    $c = new ControladorGenerarMp3();
    $c->serve();
});

/* ASIGNATURAS */
$router->map('POST', '/storeSubject', function() {
    require __DIR__ . '/controller/ControladorGuardarAsignatura.php';
    $c = new ControladorGuardarAsignatura();
    $c->serve();
});

$router->map('POST', '/querySubjects', function() {
    require __DIR__ . '/controller/ControladorConsultaAsignaturas.php';
    $c = new ControladorConsultaAsignaturas();
    $c->serve();
});

$router->map('POST', '/deleteSubject', function() {
    require __DIR__ . '/controller/ControladorBorrarAsignatura.php';
    $c = new ControladorBorrarAsignatura();
    $c->serve();
});

$router->map('POST', '/changeSubject', function() {
    require __DIR__ . '/controller/ControladorCambiarAsignatura.php';
    $c = new ControladorCambiarAsignatura();
    $c->serve();
});

/* TEMAS */
$router->map('POST', '/storeTema', function() {
    require __DIR__ . '/controller/ControladorGuardarTema.php';
    $c = new ControladorGuardarTema();
    $c->serve();
});

$router->map('POST', '/queryTemas', function() {
    require __DIR__ . '/controller/ControladorConsultaTemas.php';
    $c = new ControladorConsultaTemas();
    $c->serve();
});

$router->map('POST', '/deleteTema', function() {
    require __DIR__ . '/controller/ControladorBorrarTema.php';
    $c = new ControladorBorrarTema();
    $c->serve();
});

$router->map('POST', '/changeTema', function() {
    require __DIR__ . '/controller/ControladorCambiarTema.php';
    $c = new ControladorCambiarTema();
    $c->serve();
});

/* RESUMENES */
$router->map('POST', '/storeResumen', function() {
    require __DIR__ . '/controller/ControladorGuardarResumen.php';
    $c = new ControladorGuardarResumen();
    $c->serve();
});

$router->map('POST', '/queryResumenes', function() {
    require __DIR__ . '/controller/ControladorConsultaResumenes.php';
    $c = new ControladorConsultaResumenes();
    $c->serve();
});

$router->map('POST', '/deleteResumen', function() {
    require __DIR__ . '/controller/ControladorBorrarResumen.php';
    $c = new ControladorBorrarResumen();
    $c->serve();
});

$router->map('POST', '/changeResumen', function() {
    require __DIR__ . '/controller/ControladorCambiarResumen.php';
    $c = new ControladorCambiarResumen();
    $c->serve();
});

/* EXAMENES */
$router->map('POST', '/storeExamen', function() {
    require __DIR__ . '/controller/ControladorGuardarExamen.php';
    $c = new ControladorGuardarExamen();
    $c->serve();
});

$router->map('POST', '/queryExamenes', function() {
    require __DIR__ . '/controller/ControladorConsultaExamenes.php';
    $c = new ControladorConsultaExamenes();
    $c->serve();
});

$router->map('POST', '/deleteExamen', function() {
    require __DIR__ . '/controller/ControladorBorrarExamen.php';
    $c = new ControladorBorrarExamen();
    $c->serve();
});

$router->map('POST', '/changeExamen', function() {
    require __DIR__ . '/controller/ControladorCambiarExamen.php';
    $c = new ControladorCambiarExamen();
    $c->serve();
});

/* USER */
$router->map('POST', '/queryUser', function() {
    require __DIR__ . '/controller/ControladorConsultaUsuario.php';
    $c = new ControladorConsultaUsuario();
    $c->serve();
});

$router->map('POST', '/updateUser', function() {
    require __DIR__ . '/controller/ControladorCambiarUsuario.php';
    $c = new ControladorCambiarUsuario();
    $c->serve();
});

/* OCR */
$router->map('POST', '/ocr', function() {
    require __DIR__ . '/controller/ControladorOCR.php';
    $c = new ControladorOCR();
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