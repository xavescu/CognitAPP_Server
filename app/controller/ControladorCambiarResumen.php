<?php
require_once('controller/Controlador.php');

class ControladorCambiarResumen extends Controlador {

    public function serve() {
        $errs  = array(false, false, false, false);

        if (!empty($_POST['nombre'])) {
            if(!existsResumen($_POST['id'], $_POST['nombre']))
                $errs[0] = !updateResumenNombre($_POST['id'], $_POST['nombre']);
            else 
                $errs[0] = true;
        }

        if (!empty($_POST['texto']))
            $errs[1] = !updateResumenTexto($_POST['id'], $_POST['texto']);

        if (!empty($_POST['tipo']))
            $errs[2] = !updateResumenTipo($_POST['id'], $_POST['tipo']);

        if (!empty($_POST['tema']))
            $errs[3] = !updateResumenTema($_POST['id'], $_POST['tema']);

        $error = $errs[0] || $errs[1] || $errs[2] || $errs[3];

        if ($error) {
            http_response_code(400);
            header('Content-Type: application/json');
            echo '{ "status" : false }';
        } else {
            header('Content-Type: application/json');
            echo '{ "status" : true }';
        }
    }
}