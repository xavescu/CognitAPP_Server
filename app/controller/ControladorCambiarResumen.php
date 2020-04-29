<?php
require_once('controller/Controlador.php');

class ControladorCambiarResumen extends Controlador {

    public function serve() {
        $errs  = array(false, false, false, false);

        if (isset($_POST['nombre'])) {
            if(!existsResumen($_POST['id'], $_POST['nombre']))
                $errs[0] = !updateResumenNombre($_POST['id'], $_POST['nombre']);
            else 
                $errs[0] = true;
        }

        if (isset($_POST['texto']))
            $errs[1] = !updateResumenTexto($_POST['id'], $_POST['texto']);

        if (isset($_POST['tipo']))
            $errs[2] = !updateResumenTipo($_POST['id'], $_POST['tipo']);

        if (isset($_POST['tema']))
            $errs[3] = !updateResumenTema($_POST['id'], $_POST['tema']);

        $error = $errs[0] || $errs[1] || $errs[2] || $errs[3];

        if ($error) {
            http_response_code(400);
            header('Content-Type: application/json');
            echo '{ "status" : false }';
        } else {
            $changed['status'] = true;
            header('Content-Type: application/json');
            echo json_encode($changed, JSON_PRETTY_PRINT);
        }
    }
}