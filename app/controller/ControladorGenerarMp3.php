<?php
require_once('controller/Controlador.php');

class ControladorGenerarMp3 extends Controlador {

    public function serve() {
    	if(empty($_POST['text']) || empty($_POST['filename'])) {
    		http_response_code(400);
    		echo '{"error": true}';
    	}
    	else {
		    $text = $_POST['text'];
		    $filename = $_POST['filename']; //Without extension

		    //Generate the mp3
		    $cmd = '/home/willywonka/cognitapp/app/scripts/tts.sh ' . $filename . ' "' . $text . '"';
		    var_dump($cmd);
		    shell_exec($cmd);

		    //Path of the mp3 file
		    $mp3 = '/tmp/' . $filename . '.mp3';
		    header("Content-Transfer-Encoding: binary");
		    header("Content-Type: audio/mpeg");
		    header('Content-length: ' . filesize($mp3)); 
		    //If this is a secret filename then don't include it.
		    header('Content-Disposition: attachment;filename="'.$filename.'.mp3"');
		    //Otherwise you can add it like so, in order to give the download a filename
		    //header('Content-Disposition: inline;filename='.$filename);
		    header('Cache-Control: no-cache');


		    readfile($mp3);
		    exit;
		}
    }

}