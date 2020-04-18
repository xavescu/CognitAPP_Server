<?php
require_once('controller/Controlador.php');

class ControladorConsultaExamenes extends Controlador {

    public function serve() {
        $resumenes['resumenes'] = getExamenesByTemaId($_POST['id']);
        $resumenes['tema'] = $_POST['id'];
        $resumenes['status'] = true;
        
        header('Content-Type: application/json');
        echo json_encode($resumenes, JSON_PRETTY_PRINT);
    }

}