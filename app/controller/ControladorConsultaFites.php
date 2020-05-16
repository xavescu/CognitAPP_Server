<?php
require_once('controller/Controlador.php');

class ControladorConsultaFites extends Controlador {

    public function serve() {
        $temas['fites'] = getFites($_POST['id']);
        $temas['status'] = true;
        header('Content-Type: application/json');
        echo json_encode($temas, JSON_PRETTY_PRINT);
    }

}