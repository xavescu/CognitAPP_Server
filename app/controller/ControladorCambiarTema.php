<?php
require_once('controller/Controlador.php');

class ControladorCambiarTema extends Controlador {

    public function serve() {
        $errs  = array(false, false, false, false);

        if (isset($_POST['nombre']))
            if(!existsTema($_POST['id'], $_POST['nombre']))
                $errs[0] = !updateTemaNombre($_POST['id'], $_POST['nombre']);
            else
                $errs[0] = true;
        if (isset($_POST['texto']))
            $errs[1] = !updateTemaSubject($_POST['id'], $_POST['texto']);

        $error = $errs[0] || $errs[1];

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