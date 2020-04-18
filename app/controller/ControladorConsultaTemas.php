<?php
require_once('controller/Controlador.php');

class ControladorConsultaTemas extends Controlador {

    public function serve() {
        $temas['temas'] = getTemasByAssignaturaId($_POST['id']);
        $temas['status'] = true;
        header('Content-Type: application/json');
        echo json_encode($temas, JSON_PRETTY_PRINT);
    }

}