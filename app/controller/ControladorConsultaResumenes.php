<?php
require_once('controller/Controlador.php');

class ControladorConsultaResumenes extends Controlador {

    public function serve() {
        $resumenes['resumenes'] = getResumenesByTemaId($_POST['id']);
        $resumenes['tema'] = $_POST['id'];
        $resumenes['status'] = true;

        header('Content-Type: application/json');
        echo json_encode($resumenes, JSON_PRETTY_PRINT);
    }

}