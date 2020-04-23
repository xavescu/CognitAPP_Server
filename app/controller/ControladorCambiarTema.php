<?php
require_once('controller/Controlador.php');

class ControladorCambiarTema extends Controlador {

    public function serve() {
        $changed=false;
        if ($_POST['nuevonombre']) {
            $change=updateTemaNombre($_POST['nombre'],$_POST['id'],$_POST['nuevonombre']);
            if ($change==1) {
                $changed['nombre'] = true;
            }
        }
        $nombre = empty($_POST['nuevonombre']) ? $_POST['nombre'] : $_POST['nuevonombre'];
        if ($_POST['nuevaasignatura']) {
            $change=updateTemaSubject($nombre,$_POST['id'],$_POST['nuevaasignatura']);
            if ($change==1) {
                $changed['asignatura']=true;
            }
        }
        if ($changed) {
            $changed['status'] = true;
            header('Content-Type: application/json');
            echo json_encode($changed, JSON_PRETTY_PRINT);
        } else {
            http_response_code(400);
            header('Content-Type: application/json');
            echo '{ "status" : false }';
        }
    }

}