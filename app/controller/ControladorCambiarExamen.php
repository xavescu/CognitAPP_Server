<?php
require_once('controller/Controlador.php');

class ControladorCambiarExamen extends Controlador {

    public function serve() {
        $changed=false;
        if ($_POST['nuevonombre']) {
            $change=updateResumenNombre($_POST['nombre'],$_POST['id'],$_POST['nuevonombre']); //tambe serveix per examen
            if ($change==1) {
                $changed['nombre']=true;
            }
        }
        if ($_POST['nuevotexto']) {
            $change=updateResumenTexto($_POST['nombre'],$_POST['id'],$_POST['nuevotexto']);//tambe serveix per examen
            if ($change==1) {
                $changed['texto']=true;
            }
        }
        if ($_POST['nuevoTema']) {
            $change=updateResumenTema($_POST['nombre'],$_POST['id'],$_POST['nuevotema']);//tambe serveix per examen
            if ($change==1) {
                $changed['tema']=true;
            }
        }
        if ($changed) {
            $changed['status'] = true;
            header('Content-Type: application/json');
            echo json_encode($changed, JSON_PRETTY_PRINT);
        } else {
            http_response_code(400);
            header('Content-Type: application/json');
            echo '{ "status" : False }';
        }
    }

}