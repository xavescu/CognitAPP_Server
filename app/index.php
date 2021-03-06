<?php
require 'vendor/autoload.php';

$router = new AltoRouter();

$router->map( 'GET', '/', function() {
    echo 'cognitapp';
});

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

$router->map('POST', '/getPdf', function() {
    require __DIR__ . '/controller/ControladorGenerarPdf.php';
    $c = new ControladorGenerarPdf();
    $c->serve();
});

/* EXAMENES */
$router->map('POST', '/queryExamenes', function() {
    require __DIR__ . '/controller/ControladorConsultaExamenes.php';
    $c = new ControladorConsultaExamenes();
    $c->serve();
});

/* USER */
$router->map('POST', '/queryUser', function() {
    require __DIR__ . '/controller/ControladorConsultaUsuario.php';
    $c = new ControladorConsultaUsuario();
    $c->serve();
});

$router->map('POST', '/disableTutorial', function() {
    require __DIR__ . '/controller/ControladorDesactivarTutorial.php';
    $c = new ControladorDesactivarTutorial();
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

$router->map('POST', '/ocr64', function() {
    require __DIR__ . '/controller/ControladorOCR.php';
    $c = new ControladorOCR();
    $c->serve64();
});

/* FITES */
$router->map('POST', '/storeFita', function() {
    require __DIR__ . '/controller/ControladorGuardarFita.php';
    $c = new ControladorGuardarFita();
    $c->serve();
});

$router->map('POST', '/getFites', function() {
    require __DIR__ . '/controller/ControladorConsultaFites.php';
    $c = new ControladorConsultaFites();
    $c->serve();
});

$router->map('POST', '/completarFita', function() {
    require __DIR__ . '/controller/ControladorCompletarFita.php';
    $c = new ControladorCompletarFita();
    $c->serve();
});

/* COMPARTIR */

$router->map('POST', '/share', function() {
    require __DIR__ . '/controller/ControladorCompartir.php';
    $c = new ControladorCompartir();
    $c->serve();
});

$router->map('GET', '/document/[a:code]', function($code) {
    require __DIR__ . '/controller/ControladorDocument.php';
    $c = new ControladorDocument($code);
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